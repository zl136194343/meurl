<?php

namespace app\api\controller;

use app\common\controller\CommonController;
use app\common\model\Log;
use think\Controller;
use think\Request;
use Wechart\Wechart;
use Yansongda\Pay\Pay;
use Nb_Pay\Nb_Pay;
use Db;

class ApiController extends CommonController
{
    public function mp_pay()
    {
        $code = input('get.code');
        if (!isset($code)) {
            $data = input('get.');
            //取消mchid传值不传则为轮训
            //if (!isset($data['mchid']) || empty($data['mchid'])) $this->error('商户号MCHID不可为空');
            if (!isset($data['id']) || empty($data['id'])) $this->error('对接ID不可为空');
            if (!isset($data['trade_no']) || empty($data['trade_no'])) $this->error('订单号Trade_no不可为空');
            if (!isset($data['name']) || empty($data['name'])) $this->error('商品名称Name不可为空');
            if (!isset($data['notify_url']) || empty($data['notify_url'])) $this->error('支付结果通知地址Notify_url不可为空');
            if (!isset($data['money']) || empty($data['money'])) $this->error('金额Money不可为空');
            if (!isset($data['sign']) || empty($data['sign'])) $this->error('签名Sign不可为空');
            if (!isset($data['sign_type']) || empty($data['sign_type'])) $this->error('签名方式Sign_Type不可为空');
            if (!is_numeric($data['money']) || $data['money'] <= 0) $this->error('金额不合法！');
            $data['money'] = round($data['money'], 2);
            $info = Db::table('user')->where(['uid' => $data['id']])->find();
            if (!$info) $this->error('商户不存在！');
            if ($info['status'] != 1) $this->error('商户状态不正常，无法支付！');
            if ($info['uprice'] <= 0) $this->error('商户预存款不足，无法支付！');
            $pay = new Nb_Pay($info['uid'], $info['docking']);
            if (!$pay->verify($data)) $this->error('签名有误,请检查后重试！');
            //数据库随机取出申请好的商户用于轮训
            $data['mchid'] = Db::table('submit')
                ->where(['u_id' => $info['id']])
                ->where(['config_state' => 1])
                ->orderRaw('rand()')
                ->find();
            $m = Db::table('submit')->where(['mchid' => $data['mchid']])->find();
            if (!$m) $this->error('商户号MCHID不存在！');
            if ($m['config_state'] != 1) $this->error('商户号未初始化！');
            $trade_no = date("YmdHis") . rand(11111, 99999);
            $arr = [
                'trade_no' => $trade_no,
                'out_trade_no' => $data['trade_no'],
                'mchid' => $data['mchid'],
                'u_id' => $data['id'],
                'o_name' => $data['name'],
                'money' => $data['money'],
                'm_type' => '1',
                'notify_url' => $data['notify_url'],
                'addtime' => date('Y-m-d H:i:s')
            ];
            $order = Db::table('order')->insert($arr);
            if (!$order) $this->error('订单发起失败！');
            $oinfo = Db::table('order')->where(['trade_no' => $trade_no])->find();
            if ($oinfo['state'] == 1) $this->error('该订单已支付！');
            $redirect_uri = urlencode('http://' . $_SERVER['HTTP_HOST'] . '/api/mp_pay.html?trade_no=' . $trade_no);
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . config('wx_pay_appid') . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=snsapi_base&state=STATE&connect_redirect=1#wechat_redirect';
            header("Location: {$url}");
        } else {
            $trade_no = input('get.trade_no');
            if (!isset($trade_no) || empty($trade_no)) $this->error('订单号Trade_no不可为空！');
            $order = Db::table('order')->where(['trade_no' => $trade_no])->find();
            if (!$order) $this->error('订单不存在！');
            $urlObj["appid"] = config('wx_pay_appid');
            $urlObj["secret"] = config('wx_pay_secret');
            $urlObj["code"] = $code;
            $urlObj["grant_type"] = "authorization_code";
            $bizString = "";
            foreach ($urlObj as $k => $v) {
                if ($k != "sign") {
                    $bizString .= $k . "=" . $v . "&";
                }
            }
            $bizString = trim($bizString, "&");
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
            $ch = curl_init();
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
            //取出openid
            $data = json_decode($res, true);
            if (!isset($data['openid'])) $this->error('openid获取失败！');
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/api/do_mp_pay.html?trade_no=' . $trade_no . '&openid=' . $data['openid'];
            header("Location: {$url}");
        }
    }

    public function do_mp_pay()
    {
        $data = input('get.');
        $trade_no = $data['trade_no'];
        if (!isset($trade_no) || empty($trade_no)) $this->error('订单号Trade_no不可为空！');
        $oinfo = Db::table('order')->where(['trade_no' => $trade_no])->find();
        if (!$oinfo) $this->error('订单不存在！');
        //发起支付请求
        $config = [
            'app_id' => config('wx_appid'),
            'mch_id' => config('wx_mchid'),
            'key' => config('wx_key'),
            'sub_mch_id' => $oinfo['mchid'],
            'sub_app_id' => config('wx_pay_appid'),
            'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/api/wx_notify.html',
            'cert_client' => config('wx_cert_path'),
            'cert_key' => config('wx_key_path'),
            'mode' => 'service',
        ];
        $oinfo['money'] = $oinfo['money'] * 100;
        $order = [
            'out_trade_no' => $trade_no,
            'body' => $oinfo['o_name'],
            'total_fee' => $oinfo['money'],
            'sub_openid' => $data['openid']
        ];
        $result = Pay::wechat($config)->mp($order);
        $result = json_decode($result, 1);
        //查出商户名称
        $sinfo = Db::table('submit')->where(['mchid' => $oinfo['mchid']])->find();
        $name = $sinfo['merchant_shortname'];
        $arr = [
            'res' => $result,
            'name' => $name,
            'money' => $oinfo['money'] / 100
        ];
        return view('wechart/index', $arr);
    }

    public function scan_pay()
    {
        $data = input('get.');
        //if (!isset($data['mchid']) || empty($data['mchid'])) return json(['code' => -1, 'msg' => '商户号MCHID不可为空']);
        if (!isset($data['id']) || empty($data['id'])) return json(['code' => -1, 'msg' => '对接ID不可为空']);
        if (!isset($data['trade_no']) || empty($data['trade_no'])) return json(['code' => -1, 'msg' => '订单号Trade_no不可为空']);
        if (!isset($data['name']) || empty($data['name'])) return json(['code' => -1, 'msg' => '商品名称Name不可为空']);
        if (!isset($data['notify_url']) || empty($data['notify_url'])) return json(['code' => -1, 'msg' => '支付结果通知地址Notify_url不可为空']);
        if (!isset($data['money']) || empty($data['money'])) return json(['code' => -1, 'msg' => '金额Money不可为空']);
        if (!isset($data['sign']) || empty($data['sign'])) return json(['code' => -1, 'msg' => '签名Sign不可为空']);
        if (!isset($data['sign_type']) || empty($data['sign_type'])) return json(['code' => -1, 'msg' => '签名方式Sign_Type不可为空']);
        if (!is_numeric($data['money']) || $data['money'] <= 0) return json(['code' => -1, 'msg' => '金额不合法！']);
        $data['money'] = round($data['money'], 2);
        $info = Db::table('user')->where(['uid' => $data['id']])->find();
        if (!$info) return json(['code' => -1, 'msg' => '商户不存在！']);
        if ($info['status'] != 1) return json(['code' => -1, 'msg' => '商户状态不正常，无法支付！']);
        if ($info['uprice'] <= 0) return json(['code' => -1, 'msg' => '商户预存款不足，无法支付！']);
        $pay = new Nb_Pay($info['uid'], $info['docking']);
        if (!$pay->verify($data)) return json(['code' => -1, 'msg' => '签名有误,请检查后重试！']);
        //数据库随机取出申请好的商户用于轮训
        $data['mchid'] = Db::table('submit')
            ->where(['u_id' => $info['id']])
            ->where(['config_state' => 1])
            ->orderRaw('rand()')
            ->find();
        $m = Db::table('submit')->where(['mchid' => $data['mchid']])->find();
        if (!$m) return json(['code' => -1, 'msg' => '商户号MCHID不存在！']);
        if ($m['config_state'] != 1) return json(['code' => -1, 'msg' => '商户号未初始化！']);
        $trade_no = date("YmdHis") . rand(11111, 99999);
        $arr = [
            'trade_no' => $trade_no,
            'out_trade_no' => $data['trade_no'],
            'mchid' => $data['mchid'],
            'u_id' => $data['id'],
            'o_name' => $data['name'],
            'money' => $data['money'],
            'm_type' => '2',
            'notify_url' => $data['notify_url'],
            'addtime' => date('Y-m-d H:i:s')
        ];
        $order = Db::table('order')->insert($arr);
        if (!$order) return json(['code' => -1, 'msg' => '订单发起失败！']);
        $oinfo = Db::table('order')->where(['trade_no' => $trade_no])->find();
        if ($oinfo['state'] == 1) return json(['code' => -1, 'msg' => '该订单已支付！']);
        $config = [
            'app_id' => config('wx_appid'),
            'mch_id' => config('wx_mchid'),
            'key' => config('wx_key'),
            'sub_mch_id' => $data['mchid'],
            'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/api/wx_notify.html',
            'cert_client' => config('wx_cert_path'),
            'cert_key' => config('wx_key_path'),
            'mode' => 'service',
        ];
        $data['money'] = $data['money'] * 100;
        $order = [
            'out_trade_no' => $trade_no,
            'body' => $data['name'],
            'total_fee' => $data['money'],
        ];
        $result = Pay::wechat($config)->scan($order);
        $result = json_decode($result, 1);
        if (isset($result['code_url']) && !empty($result['code_url'])) {
            return json(['code' => 1, 'code_url' => $result['code_url']]);
        } else {
            return json(['code' => -1, 'msg' => '发起扫码支付失败!']);
        }
    }

    public function wx_notify()
    {
        $xml = file_get_contents('php://input', 'r');
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        if (!isset($data['out_trade_no'])) $this->error('订单号不可为空');
        $order = Db::table('order')->where(['trade_no' => $data['out_trade_no']])->find();
        if (!$order) $this->error('订单不存在');
        $config = [
            'app_id' => config('wx_appid'),
            'mch_id' => config('wx_mchid'),
            'key' => config('wx_key'),
            'sub_mch_id' => $order['mchid'],
            'sub_app_id' => config('wx_pay_appid'),
            'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/api/wx_notify.html',
            'cert_client' => config('wx_cert_path'),
            'cert_key' => config('wx_key_path'),
            'mode' => 'service',
        ];
        $result = Pay::wechat($config)->verify();
        if ($order['state'] != 1) {
            Db::table('order')->where(['trade_no' => $result['out_trade_no']])->update(['state' => 1, 'endtime' => date('Y-m-d H:i:s')]);
            //取出用户信息
            $uinfo = Db::table('user')
                ->alias('u')
                ->join('vip v', 'u.v_id=v.vid')
                ->where(['uid' => $order['u_id']])
                ->find();
            //扣服务费
            if ($uinfo['vid'] == 0) {
                $money = $order['money'] * (config('wx_default_rate') / 100);
            } elseif ($uinfo['v_time_expire'] < date('Y-m-d')) {
                $money = $order['money'] * (config('wx_default_rate') / 100);
            } else {
                $money = $order['money'] * ($uinfo['wx_rate'] / 100);
            }
            //扣余额
            $kmoney = round($uinfo['uprice'] - $money, 2);
            Db::table('user')->where(['uid' => $order['u_id']])->update(['uprice' => $kmoney]);
            if (is_numeric($money) && $money > 0 && !strexists($money, 'E')) {
                Log::create(['uid' => $order['u_id'], 'msg' => '交易扣除预存金' . $money . '元', 'time' => date('Y-m-d H:i:s')]);
            }
            //再取一次改变支付状态后的订单
            $order_last = Db::table('order')->where(['trade_no' => $data['out_trade_no']])->find();
            //执行支付结果异步通知
            do_notify(do_callback($order_last, $uinfo['docking']));
        }
        return Pay::wechat($config)->success()->send();
    }

    public function query_order()
    {
        $data = input('get.');
        if (!isset($data['id']) || empty($data['id'])) return json(['code' => -1, 'msg' => '对接ID不可为空']);
        if (!isset($data['trade_no']) || empty($data['trade_no'])) return json(['code' => -1, 'msg' => '订单号Trade_no不可为空']);
        if (!isset($data['sign']) || empty($data['sign'])) return json(['code' => -1, 'msg' => '签名Sign不可为空']);
        if (!isset($data['sign_type']) || empty($data['sign_type'])) return json(['code' => -1, 'msg' => '签名方式Sign_Type不可为空']);
        $info = Db::table('user')->where(['uid' => $data['id']])->find();
        if (!$info) return json(['code' => -1, 'msg' => '商户不存在！']);
        if ($info['status'] != 1) return json(['code' => -1, 'msg' => '商户状态不正常！']);
        $order = Db::table('order')->where(['out_trade_no' => $data['trade_no']])->order('trade_no', 'desc')->find();
        if (!$order) return json(['code' => -1, 'msg' => '订单不存在！']);
        $arr = [
            'trade_no' => $data['trade_no'],
            'name' => $order['name'],
            'money' => $order['money'],
            'mchid' => $order['mchid'],
            'addtime' => $order['addtime'],
            'endtime' => $order['endtime'],
            'state' => $order['state']
        ];
        return json(['code' => 1, 'msg' => '查询成功！', 'data' => $arr]);
    }

    public function refund_order()
    {
        $data = input('get.');
        if (!isset($data['id']) || empty($data['id'])) return json(['code' => -1, 'msg' => '对接ID不可为空']);
        if (!isset($data['trade_no']) || empty($data['trade_no'])) return json(['code' => -1, 'msg' => '订单号Trade_no不可为空']);
        if (!isset($data['sign']) || empty($data['sign'])) return json(['code' => -1, 'msg' => '签名Sign不可为空']);
        if (!isset($data['sign_type']) || empty($data['sign_type'])) return json(['code' => -1, 'msg' => '签名方式Sign_Type不可为空']);
        $info = Db::table('user')->where(['uid' => $data['id']])->find();
        if (!$info) return json(['code' => -1, 'msg' => '商户不存在！']);
        if ($info['status'] != 1) return json(['code' => -1, 'msg' => '商户状态不正常！']);
        $pay = new Nb_Pay($info['uid'], $info['docking']);
        if (!$pay->verify($data)) return json(['code' => -1, 'msg' => '签名有误,请检查后重试！']);
        $order = Db::table('order')->where(['out_trade_no' => $data['trade_no']])->order('trade_no', 'desc')->find();
        if (!$order) return json(['code' => -1, 'msg' => '订单不存在！']);
        if ($order['state'] == 2) return json(['code' => -1, 'msg' => '订单已全额退款！']);
        $config = [
            'app_id' => config('wx_appid'),
            'mch_id' => config('wx_mchid'),
            'key' => config('wx_key'),
            'sub_mch_id' => $order['mchid'],
            'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/api/wx_notify.html',
            'cert_client' => config('wx_cert_path'),
            'cert_key' => config('wx_key_path'),
            'mode' => 'service',
        ];
        $order = [
            'out_trade_no' => $order['trade_no'],
            'out_refund_no' => time(),
            'total_fee' => $order['money'] * 100,
            'refund_fee' => $order['money'] * 100,
            'refund_desc' => '退款',
        ];
        $result = Pay::wechat($config)->refund($order);
        $res = json_decode($result, 1);
        if ($res['return_code'] == 'SUCCESS' && $res['return_msg'] == 'OK' && $res['result_code'] == 'SUCCESS') {
            $row = Db::table('order')->where(['out_trade_no' => $data['trade_no']])->update(['state' => 2]);
            if (!$row) return json(['code' => -1, 'msg' => '退款失败！']);
            return json(['code' => 1, 'msg' => '退款成功！']);
        }
        return json(['code' => -1, 'msg' => '退款失败！']);
    }
}
