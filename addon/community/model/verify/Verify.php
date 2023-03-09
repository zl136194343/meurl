<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 */

namespace addon\community\model\verify;

use app\model\BaseModel;

/**
 * 核销编码管理
 */
class Verify extends BaseModel
{

    /**
     * 获取核销类型
     */
    public function getVerifyType()
    {
        $verify_type = event("VerifyType", []);
        $type        = [
            'pickup'       => [
                'name' => '订单自提',
            ],
           'virtualgoods' => [
               'name' => '虚拟商品',
           ],
            'community' => [
                'name' => '社区自提',
            ],
        ];
        foreach ($verify_type as $k => $v) {
            $type = array_merge($type, $v);
        }
        return $type;
    }

    /**
     * 添加待核销记录
     * @param unknown $data
     */
    public function addVerify($type, $site_id, $site_name, $content_array)
    {
        $code       = $this->getCode();
        $type_array = $this->getVerifyType();
        $data       = [
            'site_id'             => $site_id,
            'site_name'           => $site_name,
            'verify_code'         => $code,
            'verify_type'         => $type,
            'verify_type_name'    => $type_array[$type]['name'],
            'verify_content_json' => json_encode($content_array, JSON_UNESCAPED_UNICODE),
            'create_time'         => time()
        ];

        $res = model("verify")->add($data);
        return $this->success(['verify_code' => $code]);
    }


    /**
     * 编辑待核销记录
     * @param unknown $data
     */
    public function editVerify($data, $condition)
    {

        $res = model("verify")->update($data, $condition);
        return $this->success($res);
    }

    /**
     * 获取code值
     */
    public function getCode()
    {
        return random_keys(12);
    }

    /**
     * 执行核销
     * @param $verifier_info
     * @param $code
     */
    public function verify($verifier_info, $code)
    {
        model('verify')->startTrans();
        try {
            
            $verify_info = model("verify")->getInfo([['verify_code', '=', $code]], 'id, verify_code, verify_type, verify_type_name, verify_content_json, verifier_id, verifier_name, is_verify');
            
            if (empty($verifier_info)) {
                return $this->error();
            }
            if ($verify_info['is_verify'] == 0) {
                //开始核销
                $data_verify = [
                    'verifier_id'   => $verifier_info["verifier_id"] ?? 0,
                    'cl_id'         => $verifier_info["cl_id"] ?? 0,
                    'verifier_name' => $verifier_info['verifier_name'],
                    'is_verify'     => 1,
                    'verify_time'   => time()
                ];
                model("verify")->update($data_verify, [['verify_code', '=', $verify_info['verify_code']]]);
                
                $result      = event("CommunityOrderVerify", ['verify_type' => $verify_info['verify_type'], 'verify_code' => $code], true);
               
                if (!empty($result) && $result['code'] < 0) {
                    model('verify')->rollback();
                    return $result;
                }
            } else {
                 
                model('verify')->rollback();
                return $this->error('', "IS_VERIFYED");
            }

            model('verify')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('verify')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取核销信息
     * @param array $condition
     * @param string $field
     */
    public function getVerifyInfo($condition, $field = '*')
    {
        $res = model('verify')->getInfo($condition, $field);
        //验证是否存在
        if (!empty($res)) {
            $json_array  = json_decode($res["verify_content_json"], true);//格式化存储数据

            $res["data"] = $json_array;
            return $this->success($res);
        } else {
            return $this->error([], "找不到核销码信息!");
        }
    }

    /**
     * 获取核销列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getVerifyList($condition = [], $field = '*', $order = '', $limit = null)
    {

        $list = model('verify')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取核销分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getVerifyPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('verify')->pageList($condition, $field, $order, $page, $page_size);
        foreach ($list["list"] as $k => $v) {
            $temp                             = json_decode($v['verify_content_json'], true);
            unset($list["list"][$k]["verify_content_json"]);
            $list["list"][$k]["remark_array"] = $temp["remark_array"];
            $list["list"][$k]["item_array"]   = $temp["item_array"];
            foreach ($list["list"][$k]["item_array"] as &$item){
                $item['refund_status_name'] = model('order_goods')->getValue([['order_goods_id', '=', $item['order_goods_id']]], 'refund_status_name');
            }
        }
        return $this->success($list);
    }

    /**
     * 验证数据详情
     * @param $item_array
     * @param $remark_array
     */
    public function getVerifyJson($item_array, $remark_array)
    {
        $json_array = array(
            "item_array"   => $item_array,
            "remark_array" => $remark_array,
        );
        return $json_array;
    }

    /**
     * 检测会员是否具备当前核销码的核销权限
     * @param $member_id
     * @param $verify_code
     */
    public function checkMemberVerify($member_id, $verify_code,$mobile)
    {
        $verify_info = model("verify")->getInfo([["verify_code", "=", $verify_code]]);
        
        if (empty($verify_info))
            return $this->error([], "当前核销码不存在!");

        $site_id = $verify_info["site_id"];
        //按核销id查出对应的核销码
       // $delivery_code = model('member')->getInfo([["mobile", "=", $mobile]],'cl_id');
        // 验证核销身份 dump($verify_info);die;
         
        switch ($verify_info['verify_type']){
            case 'community':
                // 验证团长权限
                /*$condition     = [
                    ["member_id", "=", $member_id],
                    ['cl_id','=',$cl_id]
                ];*/
                $verifier = model("community_leader")->getInfo([['cl_id','=',$member_id]], "cl_id,name");
               
                //if ($member_id != $delivery_code['cl_id']) return $this->error([], "无核销权限[101]");
                
                $map = [['cl_id', '=', $member_id], ['delivery_code', '=', $verify_info]];
                
                $order = model("commander_order")->getInfo($map, "order_id");
               
                if (empty($order)) return $this->error([], "无核销权限[102]");
                //查出团长id
                $verifier = ['cl_id'=>$member_id, 'verifier_name'=>$verifier['name']];
               
                break;
            default:
                // 验证核销员身份
                $condition     = [
                    ["member_id", "=", $member_id],
                    ["site_id", "=", $site_id]
                ];
                $verifier = model("verifier")->getInfo($condition, "verifier_id,verifier_name");
                if (empty($verifier)) {
                    return $this->error([], "无核销权限[102]");
                }
                break;
        }
        $temp                        = json_decode($verify_info['verify_content_json'], true);
        unset($verify_info["verify_content_json"]);
        $verify_info["remark_array"] = $temp["remark_array"];
        $verify_info["item_array"]   = $temp["item_array"];
        foreach ($verify_info["item_array"] as &$item){
            $item['refund_status_name'] = model('commander_order_goods')->getValue([['order_goods_id', '=', $item['order_goods_id']]], 'refund_status_name');
        }

        $data = [
            "verify"   => $verify_info,
            "verifier" => $verifier,
        ];
        return $this->success($data);

    }

    /**
     * 生成核销码二维码
     * @param $code
     * @param $type
     */
    public function qrcode($code, $app_type, $verify_type, $site_id, $type = 'create')
    {
        $data = [
            'site_id'     => $site_id,
            'app_type'    => $app_type, // all为全部
            'type'        => $type, // 类型 create创建 get获取
            'data'        => [
                "code" => $code
            ],
            'page'        => '/otherpages/verification/detail/detail',
            'qrcode_path' => 'upload/qrcode/' . $verify_type,
            'qrcode_name' => $verify_type . '_' . $code . '_' . $site_id,
        ];
        $res  = event('Qrcode', $data, true);
        return $res;
    }
}