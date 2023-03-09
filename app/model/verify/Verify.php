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

namespace app\model\verify;

use app\model\BaseModel;
use app\model\order\OrderCommon;
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
        $type = [
            'pickup' => [
                'name' => '订单自提',
            ],
            'virtualgoods' => [
                'name' => '虚拟商品',
            ],
            'community' => [
                'name' => '社区商品',
            ]
            
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
    public function addVerify($type, $site_id, $site_name, $content_array, $relate_id = 0)
    {
        
        $code = $this->getCode($relate_id);
        
        $type_array = $this->getVerifyType();
        $site_name =$site_name?$site_name:'';
        
        $data = [
            'site_id' => $site_id,
            'site_name' => $site_name,
            'verify_code' => $code,
            'verify_type' => $type,
            'verify_type_name' => $type_array[ $type ][ 'name' ],
            'verify_content_json' => json_encode($content_array, JSON_UNESCAPED_UNICODE),
            'create_time' => time(),
            'relate_id' => $relate_id//todo 增加记录业务关联id
        ];
       
        $res = model("verify")->add($data);
        return $this->success([ 'verify_code' => $code ]);
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
    public function getCode($unique)
    {
        $code = createno('verify_no', '', $unique);
        //todo  生成编号
        return $code;
//		return random_keys(12);
    }

    /**
     * 执行核销
     * @param $verifier_info
     * @param $code
     * @return array
     */
    public function verify($verifier_info, $code)
    {
        model('verify')->startTrans();
        try {
//            $verifier = new Verifier();
//            $verifier_info = $verifier->getVerifierInfo([['verifier_id', '=', $verifier_id]], 'site_id, verifier_name');
//            if(empty($verifier_info['data']))
//            {
//                return $this->error('', "VERIFIER_FAIL");
//            }
            $verify_info = model("verify")->getInfo([ [ 'verify_code', '=', $code ] ], 'id, verify_code, verify_type, verify_type_name, verify_content_json, verifier_id, verifier_name, is_verify');
            if (empty($verifier_info)) {
                return $this->error();
            }
            if ($verify_info[ 'is_verify' ] == 0) {
                //开始核销
                $data_verify = [
                    'verifier_id' => $verifier_info[ "verifier_id" ],
                    'verifier_name' => $verifier_info[ 'verifier_name' ],
                    'is_verify' => 1,
                    'verify_time' => time(),
                ];
                
                $res = model("verify")->update($data_verify, [ [ 'id', '=', $verify_info[ 'id' ] ] ]);
                
                $order_info = model("order")->getInfo([['virtual_code','=',$code]],'order_id,is_lease');
                
                
                $OrderCommon = new OrderCommon();
                if ($order_info['is_lease'] == 1) {
                    // 说明是租赁订单  
                    $OrderCommon->orderSetZl([['order_id','=',$order_info['order_id']]]);
                    event("Verify", [ 'verify_type' => $verify_info[ 'verify_type' ], 'verify_code' => $code ]);
                }else{
                    $OrderCommon->orderCommonTakeDelivery([['order_id','=',$order_info['order_id']]]);
                    event("Verify", [ 'verify_type' => $verify_info[ 'verify_type' ], 'verify_code' => $code ]);
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
            $json_array = json_decode($res[ "verify_content_json" ], true);//格式化存储数据
            $json_array['item_array'] = array_values($json_array['item_array']);
            $res[ "data" ] = $json_array;
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
        foreach ($list[ "list" ] as $k => $v) {
            $temp = json_decode($v[ 'verify_content_json' ], true);
            $list[ "list" ][ $k ][ "item_array" ] = array_values($temp[ "item_array" ]);
            $list[ "list" ][ $k ][ "remark_array" ] = $temp[ "remark_array" ];
            unset($list[ "list" ][ $k ][ "verify_content_json" ]);
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
        $json_array = array (
            "item_array" => $item_array,
            "remark_array" => $remark_array,
        );
        return $json_array;
    }

    /**
     * 检测会员是否具备当前核销码的核销权限
     * @param $member_id
     * @param $verify_code
     */
    public function checkMemberVerify($member_id, $verify_code)
    {
        $verify_info = model("verify")->getInfo([ [ "verify_code", "=", $verify_code ] ]);
        if (empty($verify_info))
            return $this->error([], "当前核销码不存在!");

        $site_id = $verify_info[ "site_id" ];
        //验证核销员身份
        $condition = array (
            [ "member_id", "=", $member_id ],
            [ "site_id", "=", $site_id ]
        );
        $verifier_info = model("verifier")->getInfo($condition, "verifier_id,verifier_name");
        if (empty($verifier_info))
            return $this->error([], "没有店铺" . $verify_info[ "site_name" ] . "的核销权限!");

        $temp = json_decode($verify_info[ 'verify_content_json' ], true);
        $verify_info[ "item_array" ] = array_values($temp[ "item_array" ]);
        $verify_info[ "remark_array" ] = $temp[ "remark_array" ];
        unset($verify_info[ "verify_content_json" ]);

        $data = array (
            "verify" => $verify_info,
            "verifier" => $verifier_info,
        );
        return $this->success($data);

    }

    /**
     * 生成核销码二维码
     * @param $code
     * @param $type
     */
    public function qrcode($code, $app_type, $verify_type, $type)
    {
        $data = [
            'app_type' => $app_type, // all为全部
            'type' => $type, // 类型 create创建 get获取
            'data' => [
                "code" => $code
            ],
            'page' => '/otherpages/verification/detail/detail',
            'qrcode_path' => 'upload/qrcode/' . $verify_type,
            'qrcode_name' => $verify_type . '_' . $code,
        ];
        /*dump($data);die;*/
        $res = event('Qrcode', $data, true);
        /*dump($res);die;*/
        return $res;
    }
}