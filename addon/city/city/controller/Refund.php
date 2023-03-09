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

namespace addon\city\city\controller;

use app\model\order\OrderCommon;
use app\model\order\OrderRefund as OrderRefundModel;

/**
 * 维权 控制器
 */
class Refund extends BaseCity
{
    /**
     * 维权订单列表
     * @return mixed
     */
    public function lists()
    {

        $refund_status = input("refund_status", "");//退款状态
        $sku_name = input("sku_name", '');//商品名称
        $refund_type = input("refund_type", '');//退款方式
        $start_time = input("start_time", '');//开始时间
        $end_time = input("end_time", '');//结束时间
        $order_no = input("order_no", '');//订单编号
        $delivery_status = input("delivery_status", '');//物流状态
        $refund_no = input("refund_no", '');//退款编号
        $site_id = input("site_id", "");
        $delivery_no = input("delivery_no", '');//物流编号
        $refund_delivery_no = input("refund_delivery_no", '');//退款物流编号
        $order_refund_model = new OrderRefundModel();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $condition[] = [ 'nop.website_id', '=', $this->site_id ];
            //退款状态
            if ($refund_status != "") {
                $condition[] = [ "nop.refund_status", "=", $refund_status ];
            } else {
                $condition[] = [ "nop.refund_status", "<>", 0 ];
            }
            //物流状态
            if ($delivery_status != "") {
                $condition[] = [ "nop.delivery_status", "=", $delivery_status ];
            }
            //商品名称
            if ($sku_name != "") {
                $condition[] = [ "nop.sku_name", "like", "%$sku_name%" ];
            }
            //退款方式
            if ($refund_type != "") {
                $condition[] = [ "nop.refund_type", "=", $refund_type ];
            }
            //退款编号
            if ($refund_no != "") {
                $condition[] = [ "nop.refund_no", "like", "%$refund_no%" ];
            }
            //订单编号
            if ($order_no != "") {
                $condition[] = [ "nop.order_no", "like", "%$order_no%" ];
            }
            //物流编号
            if ($delivery_no != "") {
                $condition[] = [ "nop.delivery_no", "like", "%$delivery_no%" ];
            }
            //退款物流编号
            if ($refund_delivery_no != "") {
                $condition[] = [ "nop.refund_delivery_no", "like", "%$refund_delivery_no%" ];
            }

            if (!empty($start_time) && empty($end_time)) {
                $condition[] = [ "nop.refund_action_time", ">=", date_to_time($start_time) ];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = [ "nop.refund_action_time", "<=", date_to_time($end_time) ];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = [ 'nop.refund_action_time', 'between', [ date_to_time($start_time), date_to_time($end_time) ] ];
            }
            if (!empty($site_id)) {
                $condition[] = [ "no.site_id", "=", $site_id ];
            }
            $list = $order_refund_model->getRefundOrderGoodsPageList($condition, $page_index, $page_size, "nop.refund_action_time desc");
            return $list;
        } else {
            $refund_status_list = $order_refund_model->order_refund_status;
            $this->assign("refund_status_list", $refund_status_list);//退款状态
            $this->assign("refund_type_list", $order_refund_model->refund_type);//退款方式
            return $this->fetch("refund/lists", [], $this->replace);
        }
    }

    /**
     * 维权订单详情
     * @return mixed
     */
    public function detail()
    {
        $order_goods_id = input("order_goods_id", 0);
        //维权订单项信息
        $order_refund_model = new OrderRefundModel();
        $refund_condition = array (
            [ 'order_goods_id', '=', $order_goods_id ],
        );
        $detail_result = $order_refund_model->getRefundDetail($refund_condition);
        $detail = $detail_result[ "data" ];
        if (empty($detail))
            $this->error("操作失败!请重试");

        $order_common_model = new OrderCommon();
        $order_info_result = $order_common_model->getOrderInfo([ [ "order_id", "=", $detail[ "order_id" ] ] ]);
        $order_info = $order_info_result[ "data" ];
        if (empty($order_info))
            $this->error("操作失败!请重试");

        $this->assign("detail", $detail);
        $this->assign("order_info", $order_info);
        return $this->fetch("refund/detail", [], $this->replace);
    }

}