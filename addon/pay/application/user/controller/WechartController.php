<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Exception;
use think\Request;
use Wechart\Wechart;
use Db;

class WechartController extends CommonController
{
    function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $info = [
            'title' => '微信商户入驻',
            'uinfo' => $this->user_uinfo
        ];
        return view('wechart/index', $info);
    }

    //开始申请
    public function do_add()
    {
        $data = input('post.');
        if (!isset($data['id_card_name']) || empty($data['id_card_name']) || !isset($data['id_card_number']) || empty($data['id_card_number']) || !isset($data['id_card_valid_time']) || empty($data['id_card_valid_time']) || !isset($data['id_card_copy']) || empty($data['id_card_copy']) || !isset($data['id_card_national']) || empty($data['id_card_national']) || !isset($data['account_name']) || empty($data['account_name']) || !isset($data['account_bank']) || empty($data['account_bank']) || !isset($data['bank_name']) || empty($data['bank_name']) || !isset($data['store_name']) || empty($data['store_name']) || !isset($data['store_street']) || empty($data['store_street']) || !isset($data['store_entrance_pic']) || empty($data['store_entrance_pic']) || !isset($data['indoor_pic']) || empty($data['indoor_pic']) || !isset($data['merchant_shortname']) || empty($data['merchant_shortname']) || !isset($data['service_phone']) || empty($data['service_phone']) || !isset($data['product_desc']) || empty($data['product_desc']) || !isset($data['contact']) || empty($data['contact']) || !isset($data['contact_phone']) || empty($data['contact_phone']) || !isset($data['contact_email']) || empty($data['contact_email'])) return json(['code' => -1, 'msg' => '请确保每项不为空！']);
        if (!strexists($data['id_card_valid_time'], '/') || !strexists($data['id_card_valid_time'], '-')) return json(['code' => -1, 'msg' => '请按照提示输入身份证有效期！']);
        //解析身份证有效期
        $data['id_card_valid_time'] = explode('/', $data['id_card_valid_time']);
        //拼接成微信所用格式
        $data['id_card_valid_time'] = '["' . $data['id_card_valid_time'][0] . '","' . $data['id_card_valid_time'][1] . '"]';
        $data['business_code'] = time();
        $arr = [
            'sid' => $data['business_code'],
            'id_card_name' => $data['id_card_name'],
            'id_card_number' => $data['id_card_number'],
            'id_card_valid_time' => $data['id_card_valid_time'],
            'id_card_copy' => $data['id_card_copy'],
            'id_card_national' => $data['id_card_national'],
            'account_name' => $data['account_name'],
            'account_bank' => $data['account_bank'],
            'bank_name' => $data['bank_name'],
            'store_name' => $data['store_name'],
            'store_street' => $data['store_street'],
            'store_entrance_pic' => $data['store_entrance_pic'],
            'indoor_pic' => $data['indoor_pic'],
            'merchant_shortname' => $data['merchant_shortname'],
            'service_phone' => $data['service_phone'],
            'product_desc' => $data['product_desc'],
            'contact' => $data['contact'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
            'rate' => config('wx_rate'),
            'u_id' => $this->user_uinfo['uid'],
            'addtime' => date('Y-m-d H:i:s')
        ];
        //入驻费率
        $data['rate'] = config('wx_rate');
        //实例化微信操作类
        $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
        //发起提交请求
        $res = $m->submit($data);
        if (!$res) {
            return json(['code' => -1, 'msg' => '提交失败,您可能处于微信黑名单!']);
        }
        if ($res == 1) {
            $row = Db::table('submit')->insert($arr);
            if (!$row) return json(['code' => -1, 'msg' => '提交失败！']);
            return json(['code' => 1, 'msg' => '提交成功!']);
        }
        return json(['code' => -1, 'msg' => $res]);
    }

    public function list()
    {
        $list = Db::table('submit')->where(['u_id' => $this->user_uinfo['uid']])->order('sid', 'desc')->select();
        $arr = [];
        foreach ($list as $v) {
            $order = Db::table('order')->where(['mchid' => $v['mchid'], 'state' => 1])->where('addtime','>',date('Y-m-d').' 00:00:00')->sum('money');
            $arr[] = [
                'mchid' => $v['mchid'],
                'money' => $order
            ];
        }
        $info = [
            'uinfo' => $this->user_uinfo,
            'title' => '微信商户列表',
            'list' => $list,
            'arr' => $arr
        ];
        return view('wechart/list', $info);
    }

    //查询申请结果
    public function query($sid)
    {
        $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
        $res = $m->query($sid);
        if (!$res) return json(['code' => -1, 'msg' => '暂无实时状态！']);
        if (isset($res['sign_url'])) {
            return json(['code' => 2, 'sign_url' => $res['sign_url']]);
        } else {
            if ($res['applyment_state'] == 'FINISH') {
                Db::table('submit')->where(['sid' => $sid])->update(['mchid' => $res['sub_mch_id']]);
                return json(['code' => 1, 'msg' => '状态：' . $res['applyment_state']]);
            }
            if(isset($res['desc'])){
                return json(['code' => 3, 'msg' => '状态：' . $res['applyment_state'] . ',微信返回状态：' . $res['applyment_state_desc'] . ',详细信息：' . $res['desc']]);
            }
            return json(['code' => 3, 'msg' => '状态：' . $res['applyment_state'] . ',微信返回状态：' . $res['applyment_state_desc']]);
        }
    }

    //完成支付配置
    public function pay_config($sub_mch_id)
    {
        $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
        $res = $m->pay_config($sub_mch_id);
        $res2 = $m->appid_config($sub_mch_id, config('wx_pay_appid'));
        Db::table('submit')->where(['mchid' => $sub_mch_id])->update(['config_state' => 1]);
        if ($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS' && $res2['return_code'] == 'SUCCESS' && $res2['result_code'] == 'SUCCESS') return json(['code' => 1, 'msg' => '初始化成功,商户可以使用啦！']);
        return json(['code' => -1, 'msg' => '设置失败！']);
    }

    //查询提现记录
    public function cash_query($sub_mch_id)
    {
        $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
        $res = $m->cash_query($sub_mch_id);
        $row = Db::table('submit')->where(['mchid' => $sub_mch_id])->find();
        if ($row) {
            $name = $row['merchant_shortname'];
        } else {
            $name = '未知';
        }
        $info = [
            'title' => '商户' . $sub_mch_id . ' - 提现记录',
            'uinfo' => $this->user_uinfo,
            'list' => $res,
            'name' => $name
        ];
        return view('wechart/cash', $info);
    }

    //修改结算账号
    public function edit_cash($sub_mch_id)
    {
        $info = [
            'title' => '商户-' . $sub_mch_id . '-结算账号修改',
            'uinfo' => $this->user_uinfo,
            'sub_mch_id' => $sub_mch_id
        ];
        return view('wechart/edit_cash', $info);
    }

    public function do_edit_cash($sub_mch_id)
    {
        $data = input('post.');
        if (!isset($data['account_number']) || empty($data['account_number']) || !isset($data['account_bank']) || empty($data['account_bank']) || !isset($data['bank_name']) || empty($data['bank_name']) || !isset($data['bank_address_code']) || empty($data['bank_address_code'])) return json(['code' => -1, 'msg' => '请确保每项不为空！']);
        $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
        $res = $m->edit_cash($sub_mch_id, $data['account_number'], $data['account_number'], $data['bank_name'], $data['bank_address_code']);
        if (!$res) return json(['code' => -1, 'msg' => '修改失败！']);
        if ($res != 1) return json(['code' => -1, 'msg' => $res]);
        return json(['code' => 1, 'msg' => '修改成功！']);
    }

    //上传图片并获取微信media_id
    public function upload()
    {
        $file = request()->file('fileupload');
        $info = $file->validate(['size' => 2097152, 'ext' => 'jpg,png,gif,JPG,jpeg,JPEG,PNG,GIF'])->move('./uploads');
        if ($info) {
            $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
            $media_id = $m->upload('./uploads/' . $info->getSaveName());
            $arr = [
                'code' => 1,
                'msg' => '上传成功！',
                'media_id' => $media_id
            ];
            return json($arr);
        } else {
            return json(['code' => -1, 'msg' => '上传失败,文件过大或文件格式不正确！']);
        }
    }

    //微信城市编码
    public function citycode()
    {
        $q = input('get.q');
        if (!isset($q) || empty($q)) die;
        $m = new Wechart(config('wx_mchid'), config('wx_key'), config('wx_apiv3_key'), config('wx_cert_path'), config('wx_key_path'), config('wx_appid'));
        $data = $m->citycode();
        $data = json_decode($data, 1);
        $arr = [];
        foreach ($data as $k => $v) {
            $guo = $v;
            $guo_name = $k;
        }
        //匹配省
        foreach ($guo as $k => $v) {
            if (preg_match("/$q/", $k)) {
                if (isset($v['code'])) {
                    $arr[] = [
                        'text' => $guo_name . ',' . $k,
                        'id' => $v['code']
                    ];
                }
                if (is_array($v)) {
                    foreach ($v as $i => $j) {
                        if (isset($j['code'])) {
                            $arr[] = [
                                'text' => $guo_name . ',' . $k . ',' . $i,
                                'id' => $j['code']
                            ];
                        }
                        if (is_array($j)) {
                            foreach ($j as $a => $b) {
                                if (isset($b['code'])) {
                                    $arr[] = [
                                        'text' => $guo_name . ',' . $k . ',' . $i . ',' . $a,
                                        'id' => $b['code']
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
        //匹配市
        foreach ($guo as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $i => $j) {
                    if (preg_match("/$q/", $i)) {
                        if (isset($j['code'])) {
                            $arr[] = [
                                'text' => $guo_name . ',' . $k . ',' . $i,
                                'id' => $j['code']
                            ];
                        }
                        if (is_array($j)) {
                            foreach ($j as $a => $b) {
                                if (isset($b['code'])) {
                                    $arr[] = [
                                        'text' => $guo_name . ',' . $k . ',' . $i . ',' . $a,
                                        'id' => $b['code']
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
        //匹配县
        foreach ($guo as $k => $v) {
            foreach ($v as $i => $j) {
                if (is_array($j)) {
                    foreach ($j as $a => $b) {
                        if (preg_match("/$q/", $a)) {
                            if (isset($b['code'])) {
                                $arr[] = [
                                    'text' => $guo_name . ',' . $k . ',' . $i . ',' . $a,
                                    'id' => $b['code']
                                ];
                            }
                        }
                    }
                }
            }
        }
        $array['results'] = $arr;
        return json($array);
    }
}
