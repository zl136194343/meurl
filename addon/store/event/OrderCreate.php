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


namespace addon\store\event;

use addon\store\model\StoreGoodsSku;
use addon\store\model\StoreMember as StoreMemberModel;
use app\model\order\OrderCommon;

/**
 * 添加下单用户为门店用户
 */
class OrderCreate
{
    
	public function handle($data)
	{
        $order_model = new OrderCommon();
        $order_info = $order_model->getOrderInfo([ [ 'order_id', '=', $data['order_id'] ] ], 'site_id,member_id,delivery_store_id');
        $order_info = $order_info['data'];
        if (!empty($order_info) && !empty($order_info['delivery_store_id'])) {
            //添加店铺关注记录
            $shop_member_model = new StoreMemberModel();
            $res = $shop_member_model->addStoreMember($order_info['delivery_store_id'], $order_info['member_id']);
            if($res["code"] < 0){
                return $res;
            }

        }
          if($order_info["delivery_store_id"] > 0) {
              //减少库存
              $order_goods_list_result = $order_model->getOrderGoodsList([['order_id', '=', $data['order_id']]], "num,sku_id");
              $order_goods_list = $order_goods_list_result["data"];
              foreach ($order_goods_list as $k => $v) {
                  $store_goods_sku_model = new StoreGoodsSku();
                  $stock_result = $store_goods_sku_model->decStock(["store_id" => $order_info["delivery_store_id"], "sku_id" => $v["sku_id"], "store_stock" => $v["num"]]);
                  if ($stock_result["code"] < 0) {
                      return $stock_result;
                  }
              }
              return $stock_result;
          }
	}
}