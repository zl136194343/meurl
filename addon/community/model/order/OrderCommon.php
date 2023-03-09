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

namespace addon\community\model\order;

use addon\coupon\model\Coupon;
use app\model\express\ExpressPackage;
use app\model\express\LocalPackage;
use app\model\community\CommunityGoods as Goods ;
use app\model\community\GoodsStock;
use app\model\community\CommanderAccount;
use app\model\member\MemberAccount;

use app\model\system\Cron;
use app\model\system\Pay;
use app\model\verify\Verify;
use think\facade\Cache;
use app\model\BaseModel;
use app\model\message\Message;
use think\facade\Db;
use app\model\web\Account;

/**
 * 常规订单操作
 *
 * @author Administrator
 *
 */
class OrderCommon extends BaseModel
{
    /*****************************************************************************************订单基础状态（其他使用）********************************/
    // 订单待付款
    const ORDER_CREATE = 0;

    // 订单已支付
    const ORDER_PAY = 1;

    // 订单已发货（配货）
    const ORDER_DELIVERY = 3;

    // 订单待提货
    const ORDER_PENDING_DELIVERY = 2;
    // 订单已收货
    const ORDER_TAKE_DELIVERY = 4;

    // 订单已结算完成
    const ORDER_COMPLETE = 10;
    // 订单已关闭
    const ORDER_CLOSE = -1;

    /*********************************************************************************订单支付状态****************************************************/
    // 待支付
    const PAY_WAIT = 0;

    // 支付中
    const PAY_DOING = 1;

    // 已支付
    const PAY_FINISH = 2;

    /**************************************************************************支付方式************************************************************/
    const OFFLINEPAY = 10;


    /**
     * 基础订单状态(不同类型的订单可以不使用这些状态，但是不能冲突)
     * @var unknown
     */

    /**
     */
    public $order_status = [
        self::ORDER_CREATE           => [
            'status'          => self::ORDER_CREATE,
            'name'            => '待支付',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon.png',
            'action'          => [
                [
                    'action' => 'orderClose',
                    'title'  => '关闭订单',
                    'color'  => ''
                ],
                [
                    'action' => 'orderAdjustMoney',
                    'title'  => '调整价格',
                    'color'  => ''
                ],
            ],
            'member_action'   => [
                [
                    'action' => 'orderClose',
                    'title'  => '关闭订单',
                    'color'  => ''
                ],
                [
                    'action' => 'orderPay',
                    'title'  => '支付',
                    'color'  => ''
                ],
            ],
            'color'           => ''
        ],
        self::ORDER_PAY           => [
            'status'          => self::ORDER_PAY,
            'name'            => '配货中',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon-send.png',
            'action'          => [
            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
        self::ORDER_PENDING_DELIVERY => [
            'status'          => self::ORDER_PENDING_DELIVERY,
            'name'            => '待提货',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon-send.png',
            'action'          => [
            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
        self::ORDER_TAKE_DELIVERY    => [
            'status'          => self::ORDER_TAKE_DELIVERY,
            'name'            => '已提货',
            'is_allow_refund' => 1,
            'icon'            => 'upload/uniapp/order/order-icon-received.png',
            'action'          => [
            ],
            'member_action'   => [
            ],
            'color'           => ''
        ],
        self::ORDER_COMPLETE         => [
            'status'          => self::ORDER_COMPLETE,
            'name'            => '已完成',
            'is_allow_refund' => 1,
            'icon'            => 'upload/uniapp/order/order-icon-received.png',
            'action'          => [
            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
        self::ORDER_CLOSE            => [
            'status'          => self::ORDER_CLOSE,
            'name'            => '已关闭',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon-close.png',
            'action'          => [

            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
    ];
    /**
     * 基础支付方式(不考虑实际在线支付方式或者货到付款方式)
     * @var unknown
     */
    public $pay_type = [
        'ONLINE_PAY' => '在线支付',
        'BALANCE' => '余额支付',
        'OFFLINE_PAY' => '线下支付',
        'POINT' => '积分兑换'
    ];

    /**
     * 订单类型
     *
     * @var int
     */
    public $order_type = [
        4 => "虚拟订单",
        5 => "社区订单",
    ];

    /**
     * 获取支付方式
     */
    public function getPayType()
    {
        //获取订单基础的其他支付方式
        $pay_type = $this->pay_type;
        //获取当前所有在线支付方式
        $onlinepay = event('PayType', []);
        if (!empty($onlinepay)) {
            foreach ($onlinepay as $k => $v) {
                $pay_type[$v['pay_type']] = $v['pay_type_name'];
            }
        }
        return $pay_type;
    }

    /**
     * 订单类型(根据物流配送来区分)
     */
    public function getOrderTypeStatusList()
    {
        $list = [];
        $all_order_list = array_column($this->order_status, "name", "status");
        $all_order_list['refunding'] = '退款中';
        $list['all'] = array(
            "name" => "全部",
            "type" => 'all',
            "status" => $all_order_list
        );
        foreach ($this->order_type as $k => $v) {
            switch ($k) {
                case 4:
                    $order_model = new VirtualOrder();
                    break;
                case 5:
                    $order_model = new CommunityOrder();
                    break;
            }
            $temp_order_list = array_column($order_model->order_status, "name", "status");
            $temp_order_list['refunding'] = '退款中';

            $item = array(
                "name" => $v,
                "type" => $k,
                "status" => $temp_order_list
            );
            $list[$k] = $item;
        }
        return $list;
    }

    /**
     * 生成订单编号
     *
     * @param unknown $site_id
     */
    public function createOrderNo($site_id)
    {
        $time_str = date('YmdHi');
        $max_no = Cache::get($site_id . "_" . $time_str);
        if (!isset($max_no) || empty($max_no)) {
            $max_no = 1;
        } else {
            $max_no = $max_no + 1;
        }
        $order_no = $time_str . sprintf("%04d", $max_no);
        Cache::set($site_id . "_" . $time_str, $max_no);
        return $order_no;
    }
    /**********************************************************************************订单操作基础方法（订单关闭，订单完成，订单调价）开始********/

    /**
     * 订单删除
     *
     * @param unknown $condition
     */
    public function deleteOrder($condition)
    {
        $res = model('commander_order')->update(['is_delete' => 1], $condition);
        if ($res === false) {
            return $this->error();
        } else {
            return $this->success($res);
        }
    }

    /**
     * 订单完成
     *
     * @param int $order_id
     */
    public function orderComplete($order_id)
    {
        $cache = Cache::get("order_complete_execute_" . $order_id);
//        if (empty($cache)) {
//            Cache::set("order_complete_execute_" . $order_id, 1);
//        } else {
//            return $this->success();
//        }

        $lock_result = $this->verifyOrderLock($order_id);
        if ($lock_result["code"] < 0)
            return $lock_result;

        $order_info = model('commander_order')->getInfo([['order_id', '=', $order_id]], 'member_id, order_money, refund_money,order_status,site_id');

//        if ($order_info['order_status'] == self::ORDER_COMPLETE) {
//            return $this->success();
//        }
        $order_data = array(
            'order_status' => self::ORDER_COMPLETE,
            'order_status_name' => $this->order_status[self::ORDER_COMPLETE]["name"],
            'order_status_action' => json_encode($this->order_status[self::ORDER_COMPLETE], JSON_UNESCAPED_UNICODE),
            'finish_time' => time(),
            'is_enable_refund' => 0
        );
        $res = model('commander_order')->update($order_data, [['order_id', "=", $order_id]]);
        Cache::set("order_complete_execute_" . $order_id, '');
        //修改用户表order_complete_money和order_complete_num

        model('member')->setInc([['member_id', '=', $order_info['member_id']]], 'order_complete_money', $order_info['order_money'] - $order_info['refund_money']);
        model('member')->setInc([['member_id', '=', $order_info['member_id']]], 'order_complete_num');
        event('CommunityOrderComplete', ['order_id' => $order_id]);
        $order_refund_model = new OrderRefund();
        //订单项移除可退款操作
        $order_refund_model->removeOrderGoodsRefundAction([["order_id", "=", $order_id]]);
        //订单完成
        $message_model = new Message();
        $message_model->sendMessage(['keywords' => "ORDER_COMPLETE", 'order_id' => $order_id]);

        return $this->success($res);
    }

    /**
     * 订单关闭
     * @param int $order_id
     */
    public function orderClose($order_id)
    {

        model('commander_order')->startTrans();
        try {
            $order_info = model('commander_order')->getInfo([["order_id", "=", $order_id]], "coupon_id,pay_status,member_id,is_lock,balance_money,order_no,mobile,order_status,site_id");
            if ($order_info["order_status"] == -1) {
                model('commander_order')->commit();
                return $this->success();
            }
            $local_result = $this->verifyOrderLock($order_info);
            if ($local_result["code"] < 0) {
                model('commander_order')->rollback();
                return $local_result;
            }

            $order_data = array(
                'order_status' => self::ORDER_CLOSE,
                'order_status_name' => $this->order_status[self::ORDER_CLOSE]["name"],
                'order_status_action' => json_encode($this->order_status[self::ORDER_CLOSE], JSON_UNESCAPED_UNICODE),
                'close_time' => time(),
                'is_enable_refund' => 0
            );
            $res = model('commander_order')->update($order_data, [['order_id', "=", $order_id]]);

            //库存处理
            $condition = array(
                ["order_id", "=", $order_id]
            );
            //循环订单项 依次返还库存 并修改状态
            $order_goods_list = model('commander_order_goods')->getList($condition, "order_goods_id,sku_id,num,refund_status,use_point");
            $goods_stock_model = new GoodsStock();
            $order_refund_model = new OrderRefund();
            $goods_model = new Goods();

            $is_exist_refund = false;//是否存在退款

            $refund_point = 0;
            foreach ($order_goods_list as $k => $v) {
                //如果是已维权完毕的订单项, 库存不必再次返还
                if ($v["refund_status"] != $order_refund_model::REFUND_COMPLETE) {
                    $item_param = array(
                        "sku_id" => $v["sku_id"],
                        "num" => $v["num"],
                    );
                    //返还库存
                    $goods_stock_model->incStock($item_param);
                }

                if ($v["refund_status"] == $order_refund_model::REFUND_COMPLETE) {
                    $is_exist_refund = true;
                }

                //减少商品销量(必须支付过)
                if ($order_info["pay_status"] > 0) {
                    $goods_model->decGoodsSaleNum($v["sku_id"], $v["num"]);
                }

                $refund_point += $v['use_point'];
            }

            //订单项移除可退款操作
            $order_refund_model->removeOrderGoodsRefundAction([["order_id", "=", $order_id]]);

            //返还店铺优惠券
            $coupon_id = $order_info["coupon_id"];
            if ($coupon_id > 0) {
                $coupon_model = new Coupon();
                $coupon_model->refundCoupon($coupon_id, $order_info["member_id"]);
            }
            //平台优惠券

            //平台余额  退还余额
            if (!$is_exist_refund) {//因为订单完成后  只有全部退款完毕订单才会关闭
                if ($order_info["balance_money"] > 0) {
                    $member_account_model = new MemberAccount();
                    $result = $member_account_model->addMemberAccount($order_info['site_id'], $order_info["member_id"], "balance", $order_info["balance_money"], "refund", "余额返还", "订单关闭,返还余额:" . $order_info["balance_money"]);
                }
                // 订单关闭返还积分
                if ($refund_point > 0) {
                    $member_account_model = new MemberAccount();
                    $result = $member_account_model->addMemberAccount($order_info['site_id'], $order_info["member_id"], "point", $refund_point, "refund", "积分返还", "订单关闭,返还积分:" . $refund_point);
                }
            }
            //订单关闭后操作
            $close_result = event('CommanderOrderClose', ['order_id' => $order_id]);
            if (empty($close_result)) {
                foreach ($close_result as $k => $v) {
                    if (!empty($v) && $v["code"] < 0) {
                        model('commander_order')->rollback();
                        return $v;
                    }
                }
            }


            //订单关闭消息
            $message_model = new Message();
            $res = $message_model->sendMessage(['keywords' => "ORDER_CLOSE", 'order_id' => $order_id]);
            model('commander_order')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('commander_order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 订单线上支付
     * @param unknown $out_trade_no
     */
    public function orderOnlinePay($data)
    {
          
        model('commander_order')->startTrans();
        try {
             
            $out_trade_no = $data["out_trade_no"];
            $order_list = model('commander_order')->getList([['out_trade_no', '=', $out_trade_no]], '*');
            $message_list = [];
            //订单支付消息
            
            foreach ($order_list as $k => $order) {
                if ($order['order_status'] == -1) {
                    continue;
                }
                switch ($order['order_type']) {
                    case 1:
                        $order_model = new Order();
                        break;
                    case 4:
                        $order_model = new VirtualOrder();
                        break;
                    case 5:
                        $order_model = new CommunityOrder();
                        break;
                }
                  
                $order_model->orderPay($order, $data["pay_type"]);
                //同时将用户表的order_money和order_num更新
                model('member')->setInc([['member_id', '=', $order['member_id']]], 'order_money', $order['order_money']);
                model('member')->setInc([['member_id', '=', $order['member_id']]], 'order_num');

                //支付后商品增加销量
                $order_goods_list = model("commander_order_goods")->getList([["order_id", "=", $order["order_id"]]], "sku_id,num");
                
                $goods_model = new Goods();
                foreach ($order_goods_list as $ck => $v) {
                    $goods_model->incGoodsSaleNum($v["sku_id"], $v["num"]);
                }

                //订单项增加可退款操作
                $order_refund_model = new OrderRefund();
                $order_refund_model->initOrderGoodsRefundAction([["order_id", "=", $order["order_id"]]]);
               
                $message_list[] = $order;

                $order = model('commander_order')->getInfo([['order_id', '=', $order["order_id"]]], '*');
               
               
                $res = event("CommunityOrderPay", $order);
                
                $execute_time = $order['arrive_time'];
                //默认自动时间
                 $cron_model = new Cron();
                
                 $cron_model->addCron(1, 1, "订单自动抵达", "CronOrderArrive", $execute_time, $order['order_id']);
               
                $message_model = new Message();
                // 发送消息
                $param = ["keywords" => "ORDER_PAY"];
                $param = array_merge($param, $order);
                $message_model->sendMessage($param);
                
                //商家消息
               /* $param = ["keywords" => "BUYER_PAY"];
                $param = array_merge($param, $order);
                $message_model->sendMessage($param);*/
            }

            model('commander_order')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('commander_order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 订单线下支付
     * @param $order_id
     * @return array|\multitype
     */
    public function orderOfflinePay($order_id)
    {
        model('commander_order')->startTrans();
        try {
            $split_result = $this->splitOrderPay($order_id);
            if ($split_result["code"] < 0) return $split_result;

            $out_trade_no = $split_result["data"];
            $pay_model = new Pay();
            $result = $pay_model->onlinePay($out_trade_no, "OFFLINE_PAY", '', '');
            if ($result["code"] < 0) {
                model('commander_order')->rollback();
                return $result;
            }
            model('commander_order')->commit();
            return $result;
        } catch (\Exception $e) {
            model('commander_order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 拆分订单
     * @param $order_ids
     * @return \multitype
     */
    public function splitOrderPay($order_ids)
    {
        $order_ids = empty($order_ids) ? [] : explode(",", $order_ids);
        $order_list = model('commander_order')->getList([["order_id", "in", $order_ids], ["pay_status", "=", 0]], "pay_money,order_name,out_trade_no,order_id,pay_status,site_id,member_id");
        $order_count = count($order_list);
        //判断订单数是否匹配
        if (count($order_ids) > $order_count)
            return $this->error([], "选中订单中包含已支付数据!");

        $rewrite_order_ids = [];//受影响的id组
        $close_out_trade_no_array = [];
        $pay_money = 0;
        $pay_model = new Pay();
        $order_name_array = [];
        $site_id = 0;


        foreach ($order_list as $order_k => $item) {
            $member_id = $item['member_id'];
            $pay_money += $item["pay_money"];//累加金额
            $order_name_array[] = $item["order_name"];
            if (!in_array($item["out_trade_no"], $close_out_trade_no_array)) {
                $close_out_trade_no_array[] = $item["out_trade_no"];
            }
            $site_id = $item['site_id'];
//            $field_list = model('commander_order')->getColumn([["out_trade_no", "=", $item["out_trade_no"]]], "order_id");
        }

        //现有的支付单据完全匹配
        if (count($close_out_trade_no_array) == 1) {
            $out_trade_no = $close_out_trade_no_array[0];
            //必须是有效的支付单据
            $pay_info_result = $pay_model->getPayInfo($out_trade_no);
            if (!empty($pay_info_result["data"])) {
                $temp_order_count = model('commander_order')->getCount([["out_trade_no", "=", $out_trade_no], ["order_id", "not in", $order_ids]], "order_id");
                if ($temp_order_count == 0) {
                    return $this->success($out_trade_no);
                }
            }
        }
        //循环管理订单支付单据
        foreach ($close_out_trade_no_array as $close_k => $close_v) {
            $result = $pay_model->deletePay($close_v);//关闭旧支付单据
            if ($result["code"] < 0) {
                return $this->error([], "选中订单中包含已支付数据!");
            }
        }
        $order_name = implode(",", $order_name_array);
        //生成新的支付单据
        $out_trade_no = $pay_model->createOutTradeNo($member_id ?? 0);
        //修改交易流水号为新生成的
        model('commander_order')->update(["out_trade_no" => $out_trade_no], [["order_id", "in", $order_ids], ["pay_status", "=", 0]]);
        $result = $pay_model->addPay($site_id, $out_trade_no, "", $order_name, $order_name, $pay_money, '', 'OrderPayNotify', '');

        return $this->success($out_trade_no);
    }
    /************************************************************************ 订单调价 start **************************************************************************/
    /**
     * 订单金额调整
     * @param string $order_product_adjust_list order_product_id:adjust_money,order_product_id:adjust_money
     * @param string $shipping_money
     */
    public function orderAdjustMoney($order_id, $adjust_money, $delivery_money)
    {
        model('commander_order')->startTrans();
        try {
            //查询订单
            $order_info = model('commander_order')->getInfo(['order_id' => $order_id], 'site_id, out_trade_no,delivery_money, adjust_money, pay_money, order_money, promotion_money, coupon_money, goods_money, invoice_money, invoice_delivery_money, promotion_money, coupon_money, invoice_rate, invoice_delivery_money, balance_money, point_money');
            if (empty($order_info))
                return $this->error("", "找不到订单");

            if ($delivery_money < 0)
                return $this->error("", "配送费用不能小于0!");

            $real_goods_money = $order_info['goods_money'] - $order_info['promotion_money'] - $order_info['coupon_money'] - $order_info['point_money'];//计算出订单真实商品金额

            $new_goods_money = $real_goods_money + $adjust_money;

            if ($new_goods_money < 0)
                return $this->error("", "真实商品金额不能小于0!");

            $invoice_money = round(floor($new_goods_money * $order_info['invoice_rate']) / 100, 2);
            $new_order_money = $invoice_money + $new_goods_money + $delivery_money + $order_info['invoice_delivery_money'];

            if ($new_order_money < 0)
                return $this->error("", "订单金额不能小于0!");

            $pay_money = $new_order_money - $order_info['balance_money'];
            if ($pay_money < 0)
                return $this->error("", "实际支付不能小于0!");

            $data_order = array(
                'delivery_money' => $delivery_money,
                'pay_money' => $pay_money,
                'adjust_money' => $adjust_money,
                'order_money' => $new_order_money,
                'invoice_money' => $invoice_money
            );
            model('commander_order')->update($data_order, [['order_id', "=", $order_id]]);

            $order_goods_list = model('commander_order_goods')->getList([['order_id', "=", $order_id]], 'order_goods_id,goods_money,adjust_money,coupon_money,promotion_money,point_money');
            //将调价摊派到所有订单项
            $real_goods_money = $order_info['goods_money'] - $order_info['promotion_money'] - $order_info['coupon_money'] - $order_info['point_money'];
            $this->distributionGoodsAdjustMoney($order_goods_list, $real_goods_money, $adjust_money);

            //关闭原支付  生成新支付
            $pay_model = new Pay();
            $pay_result = $pay_model->deletePay($order_info["out_trade_no"]);//关闭旧支付单据
            if ($pay_result["code"] < 0) {
                model('commander_order')->rollback();
                return $pay_result;
            }
            $out_trade_no = $pay_result["data"];
            // 调价之后支付金额为0
            if($pay_money == 0){
                $this->orderOfflinePay($order_id);
            }

            model('commander_order')->commit();

            return $this->success();
        } catch (\Exception $e) {
            model('commander_order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 按比例摊派订单调价
     */
    public function distributionGoodsAdjustMoney($goods_list, $goods_money, $adjust_money)
    {
        $temp_adjust_money = $adjust_money;
        $last_key = count($goods_list) - 1;
        foreach ($goods_list as $k => $v) {
            $item_goods_money = $v['goods_money'] - $v['promotion_money'] - $v['coupon_money'] - $v['point_money'];
            if ($last_key != $k) {
                $item_adjust_money = round(floor($item_goods_money / $goods_money * $adjust_money * 100) / 100, 2);
            } else {
                $item_adjust_money = $temp_adjust_money;
            }
            $temp_adjust_money -= $item_adjust_money;
            $real_goods_money = $item_goods_money + $item_adjust_money;
            $real_goods_money = $real_goods_money < 0 ? 0 : $real_goods_money;
            $order_goods_data = array(
                'adjust_money' => $item_adjust_money,
                'real_goods_money' => $real_goods_money,
            );
            model('commander_order_goods')->update($order_goods_data, [['order_goods_id', '=', $v['order_goods_id']]]);
        }
        return $this->success();
    }

    /**
     * 订单删除
     * @param int $order_id
     */
    public function orderDelete($order_id)
    {

        model('commander_order')->startTrans();
        try {
            $order_info = model('commander_order')->getInfo([["order_id", "=", $order_id]], "order_status,site_id");
            if ($order_info["order_status"] != -1) {
                return $this->error([], '只有已经关闭的订单才能删除');
            }
            $order_data = array(
                'is_delete' => 1
            );
            $res = model('commander_order')->update($order_data, [['order_id', "=", $order_id]]);
            model('commander_order')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('commander_order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /************************************************************************ 订单调价 end **************************************************************************/
    /**
     * 订单编辑
     * @param $data
     * @param $condition
     */
    public function orderUpdate($data, $condition)
    {
        $order_model = model('commander_order');
        $res = $order_model->update($data, $condition);
        if ($res === false) {
            return $this->error();
        } else {
            return $this->success($res);
        }
    }

    /**
     * 订单发货
     * @param $order_id
     * @return array
     */
    public function orderCommonDelivery($order_id)
    {
        $order_common_model = new OrderCommon();
        $local_result = $order_common_model->verifyOrderLock($order_id);
        if ($local_result["code"] < 0)
            return $local_result;

        $order_info = model('commander_order')->getInfo([["order_id", "=", $order_id]], "order_type,site_id");
        switch ($order_info['order_type']) {
            case 1:
                $order_model = new Order();
                break;
            case 4:
                $order_model = new VirtualOrder();
                break;
            case 5:
                $order_model = new CommunityOrder();
                break;
        }
        $result = $order_model->orderDelivery($order_id);
        return $result;
    }

    /**
     * 订单收货
     *
     * @param int $order_id
     */
    public function orderCommonTakeDelivery($order_id)
    {
        $order_info = model('commander_order')->getInfo([['order_id', '=', $order_id]], '*');
        if (empty($order_info))
            return $this->error([], "ORDER_EMPTY");

        $local_result = $this->verifyOrderLock($order_id);
        if ($local_result["code"] < 0)
            return $local_result;

        if($order_info['order_status'] == self::ORDER_TAKE_DELIVERY){
            return $this->error('','该订单已收货');
        }
        switch ($order_info['order_type']) {
            case 1:
                $order_model = new Order();
                break;
            case 4:
                $order_model = new VirtualOrder();
                break;
            case 5:
                $order_model = new CommunityOrder();
                break;
        }
        model('commander_order')->startTrans();
        try {
            $res = $order_model->orderTakeDelivery($order_id);
            //改变订单状态
            $order_data = array(
                'order_status' => $order_model::ORDER_TAKE_DELIVERY,
                'order_status_name' => $order_model->order_status[$order_model::ORDER_TAKE_DELIVERY]["name"],
                'order_status_action' => json_encode($order_model->order_status[$order_model::ORDER_TAKE_DELIVERY], JSON_UNESCAPED_UNICODE),
                "is_evaluate" => 1,
                "evaluate_status" => 0,
                "evaluate_status_name" => "待评价",
                "sign_time" => time()
            );
            $res = model('commander_order')->update($order_data, [['order_id', '=', $order_id]]);
            $this->addCronOrderComplete($order_id, $order_info['site_id']);
            event('CommanderOrderTakeDelivery', ['order_id' => $order_id]);
            model('commander_order')->commit();

            //订单收货消息
            $message_model = new Message();
            $message_model->sendMessage(['keywords' => "ORDER_TAKE_DELIVERY", 'order_id' => $order_id]);

            $order_info['keywords'] = "BUYER_TAKE_DELIVERY";
            $message_model->sendMessage($order_info);

            return $this->success();
        } catch (\Exception $e) {
            model('commander_order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 添加订单自动完成事件
     * @param $order_id
     * @param $site_id
     */
    public function addCronOrderComplete($order_id, $site_id)
    {
        //获取订单自动完成时间
        $config_model = new Config();
        $event_time_config_result = $config_model->getOrderEventTimeConfig($site_id);
        $event_time_config = $event_time_config_result["data"];
        $now_time = time();
        if (!empty($event_time_config)) {
            $execute_time = $now_time + $event_time_config["value"]["auto_complete"] * 86400;//自动完成时间
        } else {
            $execute_time = $now_time + 86400;//尚未配置  默认一天
        }
        //设置订单自动完成事件
        $cron_model = new Cron();
        $result = $cron_model->addCron(1, 0, "订单自动完成", "CronCommanderOrderComplete", $execute_time, $order_id);
        return $this->success($result);
    }
    
    /**
     * 添加订单自动收货事件
     * @param $order_id
     * @param $site_id
     */
    public function addCronOrderTakeDelivery($order_id, $site_id)
    {
        //获取订单自动完成时间
        $config_model = new Config();
        $event_time_config_result = $config_model->getOrderEventTimeConfig($site_id);
        $event_time_config = $event_time_config_result["data"];
        $now_time = time();
        if (!empty($event_time_config)) {
            $execute_time = $now_time + $event_time_config["value"]["auto_complete"] * 86400;//自动收货时间
        } else {
            $execute_time = $now_time + 86400;//尚未配置  默认一天
        }
        //设置订单自动完成事件
        $cron_model = new Cron();
        $result = $cron_model->addCron(1, 0, "订单自动收货", "CronCommanderOrderTakeDelivery", $execute_time, $order_id);
        return $this->success($result);
    }

    /**
     * 订单解除锁定
     * @param $order_id
     */
    public function orderUnlock($order_id)
    {
        $data = array(
            "is_lock" => 0
        );
        $res = model('commander_order')->update($data, [["order_id", "=", $order_id]]);
        return $res;
    }

    /**
     * 订单锁定
     * @param $order_id
     * @return mixed
     */
    public function orderLock($order_id)
    {
        $data = array(
            "is_lock" => 1
        );
        $res = model('commander_order')->update($data, [["order_id", "=", $order_id]]);
        return $res;
    }

    /**
     * 验证订单锁定状态
     * @param $order_id
     */
    public function verifyOrderLock($param)
    {
        if (!is_array($param)) {
            $order_info = model('commander_order')->getInfo([["order_id", "=", $param]], "is_lock");
        } else {
            $order_info = $param;
        }
        if ($order_info["is_lock"] == 1) {//判断订单锁定状态
            return $this->error('', "ORDER_LOCK");
        } else {
            return $this->success();
        }
    }



    /**********************************************************************************订单操作基础方法（订单关闭，订单完成，订单调价）结束********/

    /****************************************************************************订单数据查询（开始）*************************************/

    /**
     * 获取订单详情
     *
     * @param array $order_id
     */
    public function getOrderDetail($order_id)
    {
        $order_info = model('commander_order')->getInfo([['order_id', "=", $order_id]]);

        if (empty($order_info))
            return $this->error('');

        $member_info = model('member')->getInfo([['member_id', "=", $order_info['member_id']]], 'nickname');

        $order_info['nickname'] = $member_info['nickname'];

        $order_goods_list = model('commander_order_goods')->getList([['order_id', "=", $order_id]]);
        $order_info['commander_order_goods'] = $order_goods_list;
        switch ($order_info['order_type']) {
            case 1:
                $order_model = new Order();
                break;
            case 4:
                $order_model = new VirtualOrder();
                break;
            case 5:
                $order_model = new CommunityOrder();
                break;
        }

        $temp_info = $order_model->orderDetail($order_info);
        $order_info = array_merge($order_info, $temp_info);

        return $this->success($order_info);
    }


    /**
     * 获取订单详情(为退款的订单项)
     * @param array $order_id
     */
    public function getUnRefundOrderDetail($order_id)
    {
        $order_info = model('commander_order')->getInfo([['order_id', "=", $order_id]]);

        if (empty($order_info))
            return $this->error('');

        $member_info = model('member')->getInfo([['member_id', "=", $order_info['member_id']]], 'nickname');

        $order_info['nickname'] = $member_info['nickname'];

        $order_goods_list = model('commander_order_goods')->getList([['order_id', "=", $order_id],['refund_status','=',0]]);
        $order_info['commander_order_goods'] = $order_goods_list;
        switch ($order_info['order_type']) {
            case 1:
                $order_model = new Order();
                break;
            case 4:
                $order_model = new VirtualOrder();
                break;
            case 5:
                $order_model = new CommunityOrder();
                break;
        }

        $temp_info = $order_model->orderDetail($order_info);
        $order_info = array_merge($order_info, $temp_info);

        return $this->success($order_info);
    }


    /**
     * 得到订单基础信息
     * @param $condition
     * @param string $field
     */
    public function getOrderInfo($condition, $field = "*")
    {
        $res = model('commander_order')->getInfo($condition, $field);
        return $this->success($res);
    }

    /**
     * 得到订单数量
     * @param $condition
     * @param string $field
     */
    public function getOrderCount($condition, $field = '*')
    {
        $res = model('commander_order')->getCount($condition, $field);
        return $this->success($res);
    }

    /**
     * 得到订单数量
     * @param $condition
     * @param string $field
     */
    public function getOrderGoodsCount($condition, $field = '*')
    {
        $res = model("commander_order_goods")->getCount($condition, $field);
        return $this->success($res);
    }

    /**
     * 退款中订单数量
     */
    public function getRefundOrderCount($condition){

        $field = 'o.order_id';
        $alias = 'o';
        $join = [
            [
                'order_goods og',
                'og.order_id = o.order_id',
                'left'
            ]
        ];
        $res = model('commander_order')->getJoinCount($condition, $field, $alias, $join);
        return $this->success($res);
    }

    /**
     * 获取订单列表
     *
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getOrderList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('commander_order')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取订单分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getOrderPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*', $alias = 'a', $join = [])
    {
        $order_list = model('commander_order')->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        if (!empty($order_list['list'])) {
            foreach ($order_list['list'] as $k => $v) {
                $order_goods_list = model("commander_order_goods")->getList([
                    'order_id' => $v['order_id']
                ]);
                
                $order_list['list'][$k]['commander_order_goods'] = $order_goods_list;
                //购买人信息
                $member_info = model('member')->getInfo(['member_id' => $v['member_id']],'nickname');
                $order_list['list'][$k]['nickname'] = $member_info['nickname'] ?? '';
            }
        }

        return $this->success($order_list);
    }

    /**
     * 订单列表（已商品为主）
     * @param array $condition
     * @return array
     */
    public function getOrderGoodsDetailList($condition = [])
    {
        $alias = 'og';
        $join = [
            [
                'commander_order o',
                'o.order_id = og.order_id',
                'left'
            ]
        ];
        $order_field = 'o.order_no,o.site_name,o.order_name,o.order_from_name,o.order_type_name,o.order_promotion_name,o.out_trade_no,o.out_trade_no_2,o.delivery_code,o.order_status_name,o.pay_status,o.delivery_status,o.refund_status,o.pay_type_name,o.delivery_type_name,o.name,o.mobile,o.telephone,o.full_address,o.buyer_ip,o.buyer_ask_delivery_time,o.buyer_message,o.goods_money,o.delivery_money,o.promotion_money,o.coupon_money,o.order_money,o.adjust_money,o.balance_money,o.pay_money,o.refund_money,o.pay_time,o.delivery_time,o.sign_time,o.finish_time,o.remark,o.goods_num,o.delivery_status_name,o.is_settlement,o.delivery_store_name,o.promotion_type_name,concat(full_address,"-",address),';

        $order_goods_field = 'og.sku_name,og.sku_no,og.is_virtual,og.goods_class_name,og.price,og.cost_price,og.num,og.goods_money,og.cost_money,og.delivery_no,og.refund_no,og.refund_type,og.refund_apply_money,og.refund_reason,og.refund_real_money,og.refund_delivery_name,og.refund_delivery_no,og.refund_time,og.refund_refuse_reason,og.refund_action_time,og.real_goods_money,og.refund_remark,og.refund_delivery_remark,og.refund_address,og.is_refund_stock';

        $list = model('commander_order_goods')->getList($condition, $order_field . $order_goods_field, 'og.order_goods_id desc', $alias, $join);
        return $this->success($list);
    }

    /**
     * 获取订单项详情
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getOrderGoodsInfo($condition = [], $field = '*')
    {
        $info = model("commander_order_goods")->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取订单列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getOrderGoodsList($condition = [], $field = '*', $order = '', $limit = null, $group = '')
    {
        $list = model('commander_order_goods')->getList($condition, $field, $order, '', '', $group, $limit);
        return $this->success($list);
    }
    /****************************************************************************订单数据查询结束*************************************/

    /****************************************************************************会员订单订单数据查询开始*************************************/

    /**
     * 会员订单详情
     * @param $order_id
     * @param $member_id
     */
    public function getMemberOrderDetail($order_id, $member_id)
    {
        $order_info = model('commander_order')->getInfo([['order_id', "=", $order_id], ["member_id", "=", $member_id]]);
        if (empty($order_info))
            return $this->error([], "当前订单不是本账号的订单!");

        $action = empty($order_info["order_status_action"]) ? [] : json_decode($order_info["order_status_action"], true);
        $member_action = $action["member_action"] ?? [];
        $order_info['action'] = $member_action;
        $order_goods_list = model('commander_order_goods')->getList([['order_id', "=", $order_id], ["member_id", "=", $member_id]]);

        foreach ($order_goods_list as $k => $v) {
            $refund_action = empty($v["refund_status_action"]) ? [] : json_decode($v["refund_status_action"], true);
            $refund_action = $refund_action["member_action"] ?? [];
            $order_goods_list[$k]["refund_action"] = $refund_action;
        }
        $order_info['commander_order_goods'] = $order_goods_list;
        $code_result = $this->orderQrcode($order_info);
        $order_info = array_merge($order_info, $code_result);
        $order_info["code_info"] = $code_result;

        switch ($order_info['order_type']) {
            case 1:
                $order_model = new Order();
                break;
            case 4:
                $order_model = new VirtualOrder();
                break;
            case 5:
                $order_model = new CommunityOrder();
                break;
        }

        $temp_info = $order_model->orderDetail($order_info);
        $order_info = array_merge($order_info, $temp_info);
        return $this->success($order_info);
    }

    /**
     * 会员订单分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getMemberOrderPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $order_list = model('commander_order')->pageList($condition, $field, $order, $page, $page_size);
        if (!empty($order_list['list'])) {
            foreach ($order_list['list'] as $k => &$v) {
                $order_goods_list = model("commander_order_goods")->getList([
                    'order_id' => $v['order_id']
                ]);
                $order_list['list'][$k]['commander_order_goods'] = $order_goods_list;
                $action = empty($v["order_status_action"]) ? [] : json_decode($v["order_status_action"], true);
                $member_action = $action["member_action"] ?? [];
                $verify_code = model('verify')->getInfo([['verify_code','=',$v['delivery_code']]],'id');
                $v['virtual_code'] = $verify_code['id'];
                $order_list['list'][$k]['action'] = $member_action;
                $v['create_time'] = $v['create_time']?date('Y-m-d H:i:s', $v['create_time']):"";
                 $v['pay_time'] = $v['pay_time']?date('Y-m-d H:i:s', $v['pay_time']):"";
                  $v['delivery_time'] = $v['delivery_time']?date('Y-m-d H:i:s', $v['delivery_time']):"";
                   $v['sign_time'] = $v['sign_time']?date('Y-m-d H:i:s', $v['sign_time']):"";
                    $v['finish_time'] = $v['finish_time']?date('Y-m-d H:i:s', $v['finish_time']):"";
                    $v['close_time'] = $v['close_time']?date('Y-m-d H:i:s', $v['close_time']):"";
            }
        }
        return $this->success($order_list);
    }
    
     /**
     * 会员订单分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getCommunityOrderPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $order_list = model('commander_order')->pageList($condition, $field, $order, $page, $page_size);
        if (!empty($order_list['list'])) {
            foreach ($order_list['list'] as $k => $v) {
                $order_goods_list = model("commander_order_goods")->getList([
                    'order_id' => $v['order_id']
                ]);
                $order_list['list'][$k]['commander_order_goods'] = $order_goods_list;
                $action = empty($v["order_status_action"]) ? [] : json_decode($v["order_status_action"], true);
                $member_action = $action["member_action"] ?? [];
                $order_list['list'][$k]['action'] = $member_action;
            }
        }
        return $this->success($order_list);
    }

    /**
     * 订单生成码
     * @param $order_info
     * @param $is_create
     */
    public function orderQrcode($order_info)
    {

        $app_type = input("app_type");
        switch ($order_info['order_type']) {
            case 4:
                $code = $order_info["virtual_code"];
                $verify_type = "virtualgoods";
                break;
            case 5:
                $code = $order_info["delivery_code"];
                $verify_type = "community";
                break;
            default:
                return [];
        }
        $verify_model = new Verify();
        $result = $verify_model->qrcode($code, $app_type, $verify_type, $order_info['site_id'], "get");
        $data = [];
        if (!empty($result) && $result["code"] >= 0) {
            $data[$verify_type] = $result["data"]["path"];
        }
        return $data;
    }

    /****************************************************************************会员订单订单数据查询结束*************************************/


    /***************************************************************** 交易记录 *****************************************************************/

    /**
     * 获取交易记录分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getTradePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('commander_order')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }
    
    


    /***************************************************************** 交易记录 *****************************************************************/
        public  function getStatus()
        {
            
            return $this->order_status;
        }
        
    /**
     * 平台整体对团长进行结算
     * @param int $end_time 截至时间
     */
    public function settlement($end_time)

    {
        //结算周期初始化
        //开始记录时间

        $last_period = model('commander_settlement_period')->getFirstData([], 'period_start_time, period_end_time', 'period_id desc');
        if (!empty($last_period)) {
            $start_time = $last_period['period_end_time'];
        } else {
            $start_time = time();
        }
        if ($end_time - $start_time < 3600 * 6) {
            return $this->success();
        }

        $period_no = date('YmdHi') . rand(1000, 9999);
        $period_id = model("commander_settlement_period")->add(["period_no" => $period_no, "create_time" => time(), "period_start_time" => $start_time, "period_end_time" => $end_time]);
        $shop_num = 0;
        $order_money = 0;
        $shop_money = 0;
        $platform_money = 0;
        $refund_money = 0;
        $refund_shop_money = 0;
        $refund_platform_money = 0;
        $commission = 0;
        $website_commission = 0;
        $platform_coupon_total_money = 0;
        $refund_platform_coupon_total_money = 0;
        //团长列表统计
        $shop_list = model("commander_leader")->getList([['status', '=', 1]], 'cl_id, name');
        //循环各个团长数据
        foreach ($shop_list as $k => $shop) {

            $site_id = $shop['cl_id'];
            $settlement = model("commander_order")->getInfo(
                [
                    ['order_status', '=', 10],
                    ['is_settlement', '=', 0],
                    ['cl_id', '=', $site_id],
                    ['pay_type', '<>', 'OFFLINE_PAY'],
                    ['finish_time', '<=', $end_time]
                ]
                , 'sum(order_money) as order_money, sum(refund_money) as refund_money,sum(commission) as commission'
            );

/*            $hospital_money = model("commander_order")->getInfo(
                [
                    ['order_status', '=', 10],
                    ['is_settlement', '=', 0],
                    ['hospital_id', '=', $site_id],
                    ['pay_type', '<>', 'OFFLINE_PAY'],
                    ['finish_time', '<=', $end_time]
                ]
                , 'sum(hospital_money) as hospital_money'
            );
            if (!empty($hospital_money) || !$settlement['hospital_money'] == null ){
                $settlement['shop_money'] += $hospital_money['hospital_money'];
            }*/

            if (empty($settlement) || $settlement['order_money'] == null) {
                //注意总支出佣金要再订单完成后统计到订单
                $settlement = [
                    'order_money' => 0,
                    'refund_money' => 0,
                    'shop_money' => 0,
                    'platform_money' => 0,
                    'refund_shop_money' => 0,
                    'refund_platform_money' => 0,
                    'commission' => 0,
                    'platform_coupon_money' => 0,
                    'refund_platform_coupon_money' => 0,
                    'hospital_money'=>0
                ];

            }

            //平台优惠券
//            $refund_rate = $settlement['order_money'] > 0 ? $settlement['refund_money'] / $settlement['order_money'] : 0;
//            $platform_coupon_money = $settlement['platform_coupon_money'] * (1 - $refund_rate);//平台优惠券平台部分
            //根据退款 来计算平台优惠券 店铺货区部分
            $platform_coupon_money = $settlement['platform_coupon_money'] - $settlement['refund_platform_coupon_money'];
//            $settlement['platform_coupon_money'] = $platform_coupon_money;

            $settlement['settlement_no'] = date('YmdHi') . $site_id . rand(1111, 9999);
            $settlement['cl_id'] = $site_id;
            $settlement['site_name'] = $shop['name'];
            $settlement['period_id'] = $period_id;
            $settlement['period_start_time'] = $start_time;
            $settlement['period_end_time'] = $end_time;
            if (addon_is_exit("city")) {
                if ($shop['website_id'] > 0) {
                    //处理
                    $settlement['website_id'] = $shop['website_id'];
                    //查看站点信息
                    $website_model = new WebSite();
                    $website = $website_model->getWebSite([['site_id', '=', $shop['website_id']]], 'site_area_name,order_rate');
                    $website_info = $website['data'];
                    //计算分站分成
                    if ($settlement['platform_money'] > 0) {
                        $settlement['website_commission'] = floor($settlement['platform_money'] * $website_info['order_rate']) / 100;
                    } else {
                        $settlement['website_commission'] = 0;
                    }

                }
            }
            $settlement['website_commission'] = isset($settlement['website_commission']) ? $settlement['website_commission'] : 0;

            $settlement_id = model("commander_settlement")->add($settlement);
            model("commander_order")->update(['is_settlement' => 1, "settlement_id" => $settlement_id], [['order_status', '=', 10], ['is_settlement', '=', 0], ['cl_id', '=', $shop['cl_id']], ['finish_time', '<=', $end_time]]);
            $shop_account = new CommanderAccount();
            //这里的备注还需要完善
            $shop_account->addAccount($shop['cl_id'], 'account', $settlement['commission'], "commander_order", $settlement_id, '团长结算，账单编号' . $settlement['settlement_no']);

            //平台也要进行统计
            $shop_num = $shop_num + 1;
            $order_money = $order_money + $settlement['order_money'];
            $shop_money = $shop_money + $settlement['commission'];
            $platform_money = $platform_money + $settlement['order_money'] - $settlement['commission'];
            $refund_money = $refund_money + $settlement['refund_money'];
            $refund_shop_money = $refund_money;
            $refund_platform_money = 0;
            $commission = $commission + $settlement['commission'];
            $website_commission = 0;
            $platform_coupon_total_money += 0;
            $refund_platform_coupon_total_money += 0;
        }



        $total_data = [
            'shop_num' => $shop_num,
            'order_money' => $order_money,
            'refund_money' => $refund_money,
            'shop_money' => $shop_money,
            'platform_money' => $platform_money,
            'refund_shop_money' => $refund_shop_money,
            'refund_platform_money' => $refund_platform_money,
            'commission' => $commission,
            'website_commission' => $website_commission,
            'platform_coupon_money' => $platform_coupon_total_money,
            'refund_platform_coupon_money' => $refund_platform_coupon_total_money,
        ];
        model("commander_settlement_period")->update($total_data, [['period_id', '=', $period_id]]);
/*        $account = new Account();
        $account->addAccount(0, 'account', $total_data['platform_money'] - $total_data['refund_platform_money'], "order", $period_id, '团长订单结算，账单编号:' . $period_no);*/
        return $this->success();
    }
    
        /**
     * 添加订单日志
     * @param array $data
     * @return array
     */
    public function addOrderLog($data)
    {
        $data[ 'action_time' ] = time();//操作时间
        $res = model("commander_order_log")->add($data);
        return $this->success($res);
    }

}