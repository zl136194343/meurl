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

use addon\community\model\CommunityAccount;
use addon\community\model\community\Config as CommunityConfig;
use app\model\community\goods\GoodsStock;
use app\model\member\MemberAccount as MemberAccountModel;
use app\model\message\Message;
use addon\community\model\order\Config as ConfigModel;
use app\model\system\Menu;
use app\model\verify\Verify;

/**
 * 社区自提订单
 *
 * @author Administrator
 *
 */
class CommunityOrder extends OrderCommon
{

    /*****************************************************************************************订单状态***********************************************/
    // 订单创建
    const ORDER_CREATE = 0;

    // 订单已支付
    const ORDER_PAY = 1;

    // 订单待提货
    const ORDER_PENDING_DELIVERY = 2;

    // 订单已发货（配货）
    const ORDER_DELIVERY = 3;

    // 订单已提货
    const ORDER_TAKE_DELIVERY = 4;

    // 订单已结算完成
    const ORDER_COMPLETE = 10;

    // 订单已关闭
    const ORDER_CLOSE = -1;
    /***********************************************************************************订单项  配送状态**************************************************/
    // 配货中
    const DELIVERY_WAIT = 0;

    // 已送达
    const DELIVERY_DOING = 1;

    // 已提货
    const DELIVERY_FINISH = 2;

    /**
     * 订单类型
     *
     * @var int
     */
    public $order_type = 2;


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
     * 配送状态
     */
    public $delivery_status = [
        self::DELIVERY_WAIT   => [
            'status' => self::DELIVERY_WAIT,
            'name'   => '配货中',
            'color'  => ''
        ],
        self::DELIVERY_DOING  => [
            'status' => self::DELIVERY_DOING,
            'name'   => '已送达',
            'color'  => ''
        ],
        self::DELIVERY_FINISH => [
            'status' => self::DELIVERY_FINISH,
            'name'   => '已提货',
            'color'  => ''
        ]
    ];

    /**
     * 订单支付
     * @param $order_info
     * @param $pay_type
     * @return array
     */
    public function orderPay($order_info, $pay_type)
    {
        
        if ($order_info['order_status'] != 0) return $this->error();

        $verify           = new Verify();
        $order_goods_list = model("commander_order_goods")->getList([["order_id", "=", $order_info["order_id"]]],
            "sku_image,sku_name,price,num,order_goods_id,goods_id,sku_id");
        $item_array       = [];
        foreach ($order_goods_list as $k => $v) {
            $item_array[] = [
                "img"            => $v["sku_image"],
                "name"           => $v["sku_name"],
                "price"          => $v["price"],
                "num"            => $v["num"],
                "order_goods_id" => $v["order_goods_id"],
                "remark_array"   => []
            ];
        }
        $pay_time            = time();
       
        $remark_array        = [
            ["title" => '订单金额', "value" => $order_info["order_money"]],
            ["title" => '订单编号', "value" => $order_info["order_no"]],
            ["title" => '创建时间', "value" => time_to_date($order_info["create_time"])],
            ["title" => '付款时间', "value" => time_to_date($pay_time)],
            ["title" => '社区名称', "value" => $order_info["delivery_community"]],
        ];
        
        $verify_content_json = $verify->getVerifyJson($item_array, $remark_array);
        
        $code          = $verify->addVerify("community", $order_info['site_id'], $order_info['site_name'], $verify_content_json);
        
        $pay_type_list = $this->getPayType();
        

        // 计算佣金
        $join = [['community_level cl', 'ch.level_id=cl.level_id', 'left']];
        $header = model('community_leader')->getInfo([['ch.cl_id', '=', $order_info['cl_id']]], 'cl.commission_money,cl.commission_rate', 'ch', $join);
        
        $config_model = new CommunityConfig();
        $config = $config_model->getConfig($order_info['site_id'])['data']['value'];
        
        if($config['commission_type'] == 1){
            $commission = round($order_info['order_money'] * $header['commission_rate'] * 0.01, 2);
        }else{
            $commission = $header['commission_money'];
        }
        
        // 计算送达时间
        $config_model = new ConfigModel();
        //社区订单设置
        $trade_config = $config_model->getTradeConfig($order_info['site_id']);
        $pick_time =date('H:i:s', $trade_config['data']['value']['pickup_time']);
        $book_time =date('H:i:s', $trade_config['data']['value']['book_time']);
        switch($trade_config['data']['value']['delivery_type']){
            case 1:
                // 当日达
                if(time() < strtotime(date('Y-m-d').' '.$book_time)){
                    // 支付时间早于设置时间，那么今日送达
                    $arrive_time = strtotime(date('Y-m-d').' '.$pick_time);
                }else{
                    // 支付时间晚于设置时间，那么明日送达
                    $arrive_time = strtotime(date('Y-m-d').' '.$pick_time.'+1day');
                }
                break;
            case 2:
                // 次日达
                $arrive_time = strtotime(date('Y-m-d').' '.$pick_time.'+1day');
                break;
            case 3:
                // 隔日达
                $arrive_time = strtotime(date('Y-m-d').' '.$pick_time.'+2day');
                break;
            default:
                // 默认当日送
                $arrive_time = strtotime(date('Y-m-d').' '.$pick_time);
                break;
        }
        // 更新订单数据
        $data          = [
            "order_status"        => self::ORDER_PAY,
            "order_status_name"   => $this->order_status[self::ORDER_PAY]["name"],
            "pay_status"          => 1,
            "order_status_action" => json_encode($this->order_status[self::ORDER_PAY], JSON_UNESCAPED_UNICODE),
            "delivery_code"       => $code['data']['verify_code'],
            "pay_time"            => $pay_time,
            "is_enable_refund"    => 1,
            "pay_type"            => $pay_type,
            "pay_type_name"       => $pay_type_list[$pay_type],
            "commission"          => $commission,
            "arrive_time"          => $arrive_time,
        ];
        
      $re = model('commander_order')->update($data, [
            ["order_id", "=", $order_info["order_id"]],
            ["order_status", "=", self::ORDER_CREATE],
        ]);

        // 更新订单项状态
        $order_goods_data = ["delivery_status_name" => "配货中"];
        $res              = model('commander_order_goods')->update($order_goods_data, [['order_id', '=', $order_info["order_id"]]]);

        // 生成提货码
        $verify->qrcode($code['data']['verify_code'], "all", "community", $order_info['site_id'], "create");

        // 添加团长统计信息
        model('community_leader')->setInc([['cl_id', '=', $order_info['cl_id']]], 'order_num');
        model('community_leader')->setInc([['cl_id', '=', $order_info['cl_id']]], 'order_money', $order_info['order_money']);
        return $this->success($res);
    }

    /**
     * 主动提货
     * @param $delivery_code
     * @return array
     */
    public function verify($delivery_code)
    {
        $order_info = model("commander_order")->getInfo([['delivery_code', '=', $delivery_code]], 'order_id, order_type, sign_time, order_status, delivery_code,site_id');
        if (empty($order_info))
            return $this->error([], "ORDER_EMPTY");

        $result = $this->activeTakeDelivery($order_info["order_id"]);
        if ($result["code"] < 0) {
            return $result;
        }
        
        //核销发送通知
        $message_model = new Message();
        $message_model->sendMessage(['keywords' => "VERIFY", 'order_id' => $order_info['order_id'], 'site_id' => $order_info['site_id']]);
        return $result;
    }

    /**
     * 订单提货
     * @param $order_id
     * @return array
     */
    public function orderTakeDelivery($order_id)
    {
        $res = model('commander_order_goods')->update(['delivery_status' => 1, 'delivery_status_name' => "已提货"], [['order_id', '=', $order_id], ['refund_status', '<>', 3]]);
        return $this->success($res);
    }

    /**
     * 退款完成操作
     * @param $order_goods_info
     */
    public function refund($order_goods_info)
    {
        //是否入库
        if ($order_goods_info["is_refund_stock"] == 1) {
            $goods_stock_model = new GoodsStock();
            $item_param        = [
                "sku_id" => $order_goods_info["sku_id"],
                "num"    => $order_goods_info["num"],
            ];
            //返还库存
            $goods_stock_model->incStock($item_param);
        }
    }

    /**
     * 订单详情
     * @param $order_info
     */
    public function orderDetail($order_info)
    {
        $data = [];
        if (!empty($order_info['delivery_id'])) {
            $data = model('community_delivery')->getInfo([['delivery_id', '=', $order_info['delivery_id']]],
                'delivery_no,clerk_name,clerk_mobile');
        }
        return $data;
    }

    /**
     * 主动提货
     * @param $order_id
     */
    public function activeTakeDelivery($order_id){
        $order_condition = [['order_id', '=', $order_id], ['order_type', '=', 5]];
        $order_info = model('commander_order')->getInfo($order_condition, 'delivery_code, order_status, site_id');
        if(empty($order_info)) return $this->error();

        if($order_info['order_status'] != self::ORDER_PENDING_DELIVERY) return $this->error([], '只有待提货状态的订单才可以提货');

        $result = $this->orderCommonTakeDelivery($order_id);
        if ($result["code"] < 0)  return $result;

        //核销发送通知
        $message_model = new Message();
        $message_model->sendMessage(['keywords' => "VERIFY", 'order_id' => $order_id, 'site_id' => $order_info['site_id']]);
        return $result;
    }

    /**
     * 社区确认收货
     * @param $delivery_id
     * @return array|int
     */
    public function communityReceive($delivery_id)
    {
        // 变更订单状态
        $order_data = [
            'order_status'         => self::ORDER_PENDING_DELIVERY,
            'order_status_name'    => $this->order_status[self::ORDER_PENDING_DELIVERY]["name"],
            'delivery_status'      => self::DELIVERY_DOING,
            'delivery_status_name' => $this->delivery_status[self::DELIVERY_DOING]["name"],
            'order_status_action'  => json_encode($this->order_status[self::ORDER_PENDING_DELIVERY], JSON_UNESCAPED_UNICODE),
            'delivery_time'        => time()
        ];
        $result = model('commander_order')->update($order_data, [['delivery_id', "=", $delivery_id]]);

        // TODO 到货通知

        return $result;
    }

    /**
     * 社区订单完成后操作
     * @param $order_id
     * @return array
     */
    public function orderComplete($order_id)
    {
        $orders = model("commander_order")->getInfo([['order_id', '=', $order_id], ['is_settlement', '=', 0]], 'site_id,order_id,cl_id,cl_name,commission,order_money,refund_money');
        if (empty($orders['cl_id'])) {
            return $this->success();
        }
        // 同时修改订单状态为已结算
        model("commander_order")->startTrans();
        try {
            model('community_leader')->setInc([['cl_id', '=', $orders['cl_id']]], 'order_complete_num');
            model('community_leader')->setInc([['cl_id', '=', $orders['cl_id']]], 'order_complete_money', $orders['order_money']-$orders['refund_money']);
            model('commander_order')->update(['is_settlement' => 1], [['order_id', '=', $order_id]]);
            // 添加团长帐户流水
            $community_account = new CommunityAccount();
            $community_account->addAccount($orders['cl_id'], $orders['cl_name'], 'commander_order', $orders['commission'], $order_id, $orders['site_id']);
            // 团长统计总佣金
            model('community_leader')->setInc([['cl_id', '=', $orders['cl_id']]], 'commission_total', $orders['commission']);
            // 添加团长的会员账户流水
            $header = model('community_leader')->getInfo([['cl_id', '=', $orders['cl_id']]], 'cl_id,member_id');
            $member_account = new MemberAccountModel();
            $member_account->addMemberAccount($orders['site_id'], $header['member_id'], 'balance_money', $orders['commission'], 'community', '社区订单结算', '社区订单结算');
            model("commander_order")->commit();
            return $this->success();
        } catch (\Exception $e) {
            model("commander_order")->rollback();
            return $this->error($e->getMessage());
        }
    }

}
