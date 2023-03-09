<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\Controller;
use app\model\order\OrderCommon as OrderCommonModel;
use app\model\delivery\Order as DeliveryOrderModel;

/**
 * 打印
 * Class Printer
 * @package app\shop\controller
 */
class Printer extends Controller
{

    /**
     * 批量打印发货单
     * @return mixed
     */
    public function batchPrintOrder()
    {
        $order_id            = input('order_id', 0);
        $order_common_model  = new OrderCommonModel();
        $order_detail_result = $order_common_model->getUnRefundOrderDetail($order_id);
        $order_detail        = $order_detail_result["data"];
        $this->assign("order_detail", $order_detail);
        return $this->fetch('order/batch_print_order');
    }

    /********************************** 配货单打印 start ****************************************************/

    /**
     * 打印商品出库单
     */
    public function communityDeliveryGoodsGather()
    {
        $delivery_order_model = new DeliveryOrderModel();
        $info                 = $delivery_order_model->getGoodsGather([['delivery_id', '=', input('delivery_id', 0)]])['data'];
        $this->assign([
            'info' => $info
        ]);
        return $this->fetch('community_delivery/print/goods_gather');
    }

    /**
     * 打印团长对货单
     */
    public function communityDeliveryLeaderInvoice()
    {
        $delivery_order_model = new DeliveryOrderModel();
        $info                 = $delivery_order_model->getLeaderInvoice([['delivery_id', '=', input('delivery_id', 0)]])['data'];
        $this->assign([
            'info' => $info
        ]);
        return $this->fetch('community_delivery/print/leader_invoice');
    }

    /********************************** 配货单打印 end ****************************************************/
}