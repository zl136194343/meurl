<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */


namespace addon\wechatpay\event;

use addon\wechatpay\model\Pay as PayModel;
/**
 * 原路退款
 */
class PayRefund
{
    /**
     * 原路退款
     */
    public function handle($params)
    {
        if($params["pay_info"]["pay_type"] == "wechatpay"){
            $pay_model = new PayModel();
            $result = $pay_model->refund($params);
            return $result;
        }
    }
}