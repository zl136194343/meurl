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

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;

/**
 * 订单交易设置
 */
class Config extends BaseModel
{
    /**
     * 获取订单事件时间设置
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function getOrderEventTimeConfig($site_id, $app_module = 'admin')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'ORDER_EVENT_TIME_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'auto_close' => 30,//订单未付款自动关闭时间 数字 单位(天)
                'auto_take_delivery' => 14,//订单发货后自动收货时间 数字 单位(天)
                'auto_complete' => 7,//订单收货后自动完成时间 数字 单位(天)
                'invoice_status' => 0,//发票状态（0关闭 1开启）
                'invoice_rate' => 0,//发票比率（0关闭 1开启）
                'invoice_content' => '',//发内容（0关闭 1开启）
                'invoice_money' => 0,//发票运费（0关闭 1开启）
            ];
        }
        return $res;
    }

    /**
     * 设置订单事件时间
     */
    public function setOrderEventTimeConfig($data, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '订单事件时间设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'COMMUNITY_ORDER_EVENT_TIME_CONFIG' ] ]);
        return $res;
    }


    /**
     * 获取订单返积分设置
     */
    public function getOrderBackPointConfig($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'ORDER_BACK_POINT_CONFIG' ] ]);
        return $res;
    }

    /**
     * 设置订单返积分
     */
    public function setOrderBackPointConfig($data, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '订单返积分设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'ORDER_BACK_POINT_CONFIG' ] ]);
        return $res;
    }

    /**
     * 获取订单评价设置
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function getOrderEvaluateConfig($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'ORDER_EVALUATE_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'evaluate_status' => 1,//订单评价状态（0关闭 1开启）
                'evaluate_show' => 1,//显示评价（0关闭 1开启）
                'evaluate_audit' => 1,//评价审核状态（0关闭 1开启）
            ];
        }
        return $res;
    }

    /**
     * 设置订单评价设置
     */
    public function setOrderEvaluateConfig($data, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '订单事件时间设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'ORDER_EVALUATE_CONFIG' ] ]);
        return $res;
    }
    /**
     * 设置社区团购交易发货时间
     */
    public function setTradeConfig($data, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '订单发货时间设置', 1, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'ORDER_TRADE_CONFIG']]);
        return $res;
    }

    /**
     * 获取社区团购交易设置
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function getTradeConfig($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'ORDER_TRADE_CONFIG']]);
        if (empty($res['data']['value'])) {
            $res['data']['value'] = [
                'book_time'     => 0,// 发货下单时间点
                'pickup_time'   => 0,// 自提时间点
                'delivery_type' => 1,// 发货类型 1当日达 2次日达 3隔日达
            ];
        }
        return $res;
    }
}