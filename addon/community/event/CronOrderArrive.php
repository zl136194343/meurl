<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\community\event;

use addon\community\model\order\OrderCommon;
use app\model\system\Cron;
/**
 * 订单自动抵达
 */
class CronOrderArrive
{
    // 行为扩展的执行入口必须是run
    public function handle($data)
    {
        
       
        $order             = new OrderCommon();
        $order_info_result = $order->getOrderInfo([["order_id", "=", $data["relate_id"]]], "arrive_time");
        
            /*file_put_contents('test.txt',json_encode($order->order_status[2]));*/
            $result = model('commander_order')->update(['order_status'=>2,'order_status_name'=>'待提货','order_status_action'=>json_encode($order->order_status[2])],[['order_id', "=", $data["relate_id"]]]);
             //自动收货
                $order ->addCronOrderTakeDelivery($data["relate_id"],0);
            return $result;
    }
}