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

namespace app\model\express;

use app\model\BaseModel;
use app\model\order\OrderCommon;

/**
 * 物流配送
 */
class ExpressPackage extends BaseModel
{

    /**
     * 修改物流单号和物流公司
     * @param $data
     * @return array
     */
    public function editOrderExpressDeliveryPackage($data)
    {
        $order_common_model = new OrderCommon();
        //订单状态
        $order_status = model('order')->getValue([['site_id', '=', $data['site_id']], ['order_id', '=', $data['order_id']]], 'order_status');
        if (empty($order_status)) {
            return $this->error('', '订单不存在');
        }
        if (!in_array($order_status,[$order_common_model::ORDER_PAY,$order_common_model::ORDER_DELIVERY])) {
            return $this->error('', '订单已收货或已完成');
        }
        //包裹信息
        $package_count = model('express_delivery_package')->getCount(
            [
                ['site_id', '=', $data['site_id']], ['order_id', '=', $data['order_id']], ['id', '=', $data['package_id']]
            ]
        );
        if($package_count == 0){
            return $this->error('','包裹信息不存在');
        }
        model("express_delivery_package")->startTrans();
        try {

            if ($data['delivery_type'] == 0) {
                $data['express_company_id'] = 0;
                $data['delivery_no'] = '';
                $express_company_name = '';
                $express_company_image = '';
            }else{
                if ($data['express_company_id'] == '') {
                    return $this->error('', '物流公司不能为空');
                }
                if ($data['delivery_no'] == '') {
                    return $this->error('', '物流单号不能为空');
                }
                //获取物流公司名称
                $express_company_info = model('express_company')->getInfo([['company_id', '=', $data['express_company_id']]], 'company_name,logo');
                $express_company_name = $express_company_info['company_name'];
                $express_company_image = $express_company_info['logo'];
            }

            $condition = [
                ['site_id', '=', $data['site_id']], ['order_id', '=', $data['order_id']], ['id', '=', $data['package_id']]
            ];
            model('express_delivery_package')->update(
                [
                    'delivery_type' => $data['delivery_type'],
                    'express_company_id' => $data['express_company_id'],
                    'express_company_name' => $express_company_name,
                    'delivery_no' => $data['delivery_no'],
                    'express_company_image' => $express_company_image
                ], $condition
            );

            model("express_delivery_package")->commit();
            return $this->success();

        } catch (\Exception $e) {
            model("express_delivery_package")->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取物流包裹列表
     * @param $condition
     * @param string $field
     */
    public function getExpressDeliveryPackageList($condition, $field = "*"){
        $list = model("express_delivery_package")->getList($condition, $field);
        return $this->success($list);
    }

    /**
     * 获取包裹信息
     * @param $condition
     */
    public function package($condition, $mobile = ''){
        $list_result = $this->getExpressDeliveryPackageList($condition);
        $list = $list_result["data"];
        $trace_model = new Trace();
        foreach($list as $k => $v){
            $temp_array = explode(",", $v["goods_id_array"]);
            if(!empty($temp_array)){
                foreach($temp_array as $temp_k => $temp_v){
                    $temp_str = str_replace("http://", "http//", $temp_v);
                    $temp_str = str_replace("https://", "https//", $temp_str);
                    $temp_item = explode(":", $temp_str);
                    $sku_image = str_replace("https//", "https://", $temp_item["3"]);
                    $sku_image = str_replace("http//", "http://", $sku_image);
                    $list[$k]["goods_list"][] = ["sku_name" => $temp_item["2"], "num" => $temp_item["1"], "sku_image" => $sku_image, "sku_id" => $temp_item["0"]];
                }
            }

            $trace_list = $trace_model->trace($v["delivery_no"],$v["express_company_id"], $mobile);
            $list[$k]["trace"] = $trace_list["data"];
        }
        return $list;

    }
    public function packageT($data, $mobile = ''){

        $trace_model = new Trace();
        $list = $trace_model->trace($data["express_no"],$data["express_company_id"], $mobile);
        return $list;

    }

}