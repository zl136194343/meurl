<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */

namespace addon\community\api\controller;

use app\model\express\ExpressPackage;
use addon\community\model\order\Order as OrderModel;
use addon\community\model\order\OrderCommon as OrderCommonModel;
use addon\community\model\order\OrderRefund as OrderRefundModel;

class Order extends BaseApi
{

    /**
     * 详情信息
     */
    public function detail()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $order_common_model = new OrderCommonModel();
        $order_id           = isset($this->params['order_id']) ? $this->params['order_id'] : 0;
        $result             = $order_common_model->getMemberOrderDetail($order_id, $this->member_id??1);
        
        $verify_code = model('verify')->getInfo([['verify_code','=',$result['data']['delivery_code']]],'id');
        $result['data']['delivery_community_info'] = json_decode($result['data']['delivery_community_info'],true);
        $result['data']['delivery_community_info']['store_image']=model('member')->getInfo([['self_cl_id','=',$result['data']['delivery_community_id']]],'headimg')['headimg'];
        
        $result['data']['member_info'] = model('member')->getInfo([['member_id','=',$result['data']['member_id']]],'headimg,mobile,nickname');
        
        $result['data']['virtual_code'] = $verify_code['id'];
        return $this->response($result);
    }

    /**
     * 列表信息
     */
    public function lists()
    {
        /*$token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);*/
        $order_common_model = new OrderCommonModel();
        $condition          = array(
          
            ["is_delete", '=', 0]
        );
        if(!empty($this->params['cl_id'])) {
            $condition[] = ["cl_id", "=", $this->params['cl_id']];
        }else{
            $condition[] = ["member_id", "=", $this->member_id??30];
        }
        $order_status       = isset($this->params['order_status']) ? $this->params['order_status'] : 'all';
         
        switch ($order_status) {
            case "waitpay"://待付款
                $condition[] = ["order_status", "=", 0];
                break;
            case "waitsend"://待发货
                $condition[] = ["order_status", "=", 1];
                break;
            case "waitconfirm"://待收货
                $condition[] = ["order_status", "in", [2, 3]];
                break;
            case "waitrate"://待评价
                $condition[] = ["order_status", "in", [4, 10]];
                $condition[] = ["is_evaluate", "=", 1];
                break;
            case "refund":// 退款中
                $condition[] = ["refund_status", ">", 0];
                break;
        }
        
        $mobile       = isset($this->params['mobile']) ? $this->params['mobile'] : '';
        
        if(!empty($mobile)){
            //用团长手机号查出对应的id
             $re = model('member')->getInfo([['mobile','=',$mobile]],'self_cl_id');
            $condition[] = ['cl_id','=',$re['self_cl_id']];
        }
       
//		if (c !== "all") {
//			$condition[] = [ "order_status", "=", $order_status ];
//		}

        $page_index = isset($this->params['page']) ? $this->params['page'] : 1;
        $page_size  = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;
        $res        = $order_common_model->getMemberOrderPageList($condition, $page_index, $page_size, "create_time desc");
        
        
        return $this->response($res);
    }

    /**
     * 订单评价基础信息
     */
    public function evluateinfo()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $order_id = isset($this->params['order_id']) ? $this->params['order_id'] : 0;
        if (empty($order_id)) {
            return $this->response($this->error('', 'REQUEST_ORDER_ID'));
        }

        $order_common_model = new OrderCommonModel();
        $order_info         = $order_common_model->getOrderInfo([
            ['order_id', '=', $order_id],
            ['member_id', '=', $token['data']['member_id']],
            ['order_status', 'in', ('4,10')],
            ['is_evaluate', '=', 1],
        ], 'evaluate_status,evaluate_status_name');

        $res = $order_info['data'];
        if (!empty($res)) {
            if ($res['evaluate_status'] == 2) {
                return $this->response($this->error('', '该订单已评价'));
            } else {
                $condition   = [
                    ['order_id', '=', $order_id],
                    ['member_id', '=', $token['data']['member_id']],
                    ['refund_status', '<>', 3],
                ];
                $list        = $order_common_model->getOrderGoodsList($condition, 'order_goods_id,order_id,order_no,site_id,member_id,goods_id,sku_id,sku_name,sku_image,price,num');
                $list        = $list['data'];
                $res['list'] = $list;
                return $this->response($this->success($res));
            }
        } else {
            return $this->response($this->error('', '没有找到该订单'));
        }

    }

    /**
     * 订单收货(收到所有货物)
     */
    public function takeDelivery()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $order_id = isset($this->params['order_id']) ? $this->params['order_id'] : 0;
        if (empty($order_id)) {
            return $this->response($this->error('', 'REQUEST_ORDER_ID'));
        }
        $order_model = new OrderCommonModel();
        $result      = $order_model->orderCommonTakeDelivery($order_id);
        return $this->response($result);
    }

    /**
     * 关闭订单
     */
    public function close()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $order_id = isset($this->params['order_id']) ? $this->params['order_id'] : 0;
        if (empty($order_id)) {
            return $this->response($this->error('', 'REQUEST_ORDER_ID'));
        }
        $order_model = new OrderModel();
        $result      = $order_model->orderClose($order_id);
        return $this->response($result);
    }

    /**
     * 获取订单数量
     */
    public function num()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        if (empty($this->params['order_status'])) {
            return $this->response($this->error('', 'REQUEST_ORDER_STATUS'));
        }

        $order_common_model = new OrderCommonModel();
        $order_refund_model = new OrderRefundModel();

        $data = [];
        foreach (explode(',', $this->params['order_status']) as $order_status) {
            $condition = array(
                ["member_id", "=", $this->member_id],
            );
            switch ($order_status) {
                case "waitpay"://待付款
                    $condition[] = ["order_status", "=", 0];
                    break;
                case "waitsend"://待发货
                    $condition[] = ["order_status", "=", 1];
                    break;
                case "waitconfirm"://待收货
                    $condition[] = ["order_status", "in", [2, 3]];
                    break;
                case "waitrate"://待评价
                    $condition[] = ["order_status", "in", [4, 10]];
                    $condition[] = ["is_evaluate", "=", 1];
                    break;
            }
            if ($order_status == 'refunding') {
                $result              = $order_refund_model->getRefundOrderGoodsCount([
                    ["member_id", "=", $this->member_id],
                    ["refund_status", "not in", [0, 3]]
                ]);
                $data[$order_status] = $result['data'];
            } else {
                $result              = $order_common_model->getOrderCount($condition);
                $data[$order_status] = $result['data'];
            }
        }
        return $this->response(success(0, '', $data));
    }

    /**
     * 订单包裹信息
     */
    public function package()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $order_id              = isset($this->params['order_id']) ? $this->params['order_id'] : '';//订单id
        $express_package_model = new ExpressPackage();
        $condition             = array(
            ["member_id", "=", $this->member_id],
            ["order_id", "=", $order_id],
        );
        $result                = $express_package_model->package($condition);
        if ($result) return $this->response($this->success($result));
        else return $this->response($this->error());
    }

    /**
     * 订单支付
     * @return string
     */
    public function pay()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $order_ids = isset($this->params['order_ids']) ? $this->params['order_ids'] : '';//订单id
        if (empty($order_ids)) return $this->response($this->error('', "订单数据为空"));
        $order_common_model = new OrderCommonModel();
        $result             = $order_common_model->splitOrderPay($order_ids);
        return $this->response($result);
    }

    /**
     * 列表信息
     */
    public function deliveryOrderList()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $page = input('page', 1);
        $size = input('size', PAGE_LIST_ROWS);
        $delivery_id  = input('delivery_id', 0);
        $status  = input('status', '');

        if(empty($delivery_id)) return $this->response($this->error('', '配送单ID不能为空'));

        $condition          = [
            ["delivery_id", "=", $delivery_id],
            ["site_id", "=", $this->site_id],
            ["is_delete", '=', 0]
        ];
        switch ($status) {
            case "waitpay"://待付款
                $condition[] = ["order_status", "=", 0];
                break;
            case "waitsend"://待发货
                $condition[] = ["order_status", "=", 1];
                break;
            case "waitconfirm"://待收货
                $condition[] = ["order_status", "in", [2, 3]];
                break;
            case "waitrate"://待评价
                $condition[] = ["order_status", "in", [4, 10]];
                $condition[] = ["is_evaluate", "=", 1];
                break;
        }
        $order_common_model = new OrderCommonModel();
        $res = $order_common_model->getOrderPageList($condition, $page, $size, "create_time desc");
        return $this->response($res);
    }
    /**
     * 列表信息
     */
    public function headerOrderList()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $page = input('page', 1);
        $size = input('size', PAGE_LIST_ROWS);
        $status  = input('status', '');

        $community = model('community_leader')->getInfo([['member_id', '=', $this->member_id]], 'cl_id');
        $condition          = [
            ["cl_id", "=", $community['cl_id']],
            ["site_id", "=", $this->site_id],
            ["is_delete", '=', 0]
        ];
        switch ($status) {
            case "waitpay"://待付款
                $condition[] = ["order_status", "=", 0];
                break;
            case "waitsend"://待发货
                $condition[] = ["order_status", "=", 1];
                break;
            case "waitconfirm"://待收货
                $condition[] = ["order_status", "in", [2, 3]];
                break;
            case "waitrate"://待评价
                $condition[] = ["order_status", "in", [4, 10]];
                $condition[] = ["is_evaluate", "=", 1];
                break;
        }
        $order_common_model = new OrderCommonModel();
        $res = $order_common_model->getOrderPageList($condition, $page, $size, "create_time desc");
        return $this->response($res);
    }
}
