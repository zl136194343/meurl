<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */


namespace addon\community\event;

use addon\community\model\order\Config;
use app\model\system\Cron;

/**
 * 订单维权后事件
 */
class OrderRefundApply
{
	// 行为扩展的执行入口必须是run
	public function handle($data)
	{
        //todo 自动通过维权时间
       
        $order_config_model = new Config();
        $config = $order_config_model->getOrderEventTimeConfig(0)['data']['value'] ?? [];
       
        $auto_refund_confirm = $config['auto_refund_confirm'] ?? 0;
        $cron_model = new Cron();
        $now_time = time();//当前时间
        $execute_time = $now_time + $auto_refund_confirm * 86400;//自动收货时间
        $result = $cron_model->addCron(1, 1, "维权自动通过", "CommunityOrderRefundConfirm", $execute_time, $data['order_goods_id']);
        return $result;

    }
	
}