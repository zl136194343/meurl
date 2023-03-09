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


namespace addon\goodscircle\event;

use addon\goodscircle\model\Config;
use addon\goodscircle\model\GoodsCircle;

/**
 * 活动展示
 */
class OrderPay
{

    /**
     * 订单支付
     * @param unknown $order
     * @return multitype:
     */
	public function handle($param = [])
	{
        $config_model = new Config();
        $config = $config_model->getGoodscircleConfig($param['site_id']);
        $config = $config['data'];
        if (isset($config['is_use']) && $config['is_use']) {
            $goods_circle = new GoodsCircle($param['site_id']);
            $goods_circle->importOrder($param['order_id']);
        }
	}
}