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

namespace addon\alipay\admin\controller;

use addon\alipay\model\Config as ConfigModel;
use app\admin\controller\BaseAdmin;
use think\facade\Config;

/**
 * 支付宝 控制器
 */
class Pay extends BaseAdmin
{
    public function config()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $app_id = input("app_id", "");//支付宝应用ID (支付宝分配给开发者的应用ID)
            $private_key = input("private_key", "");//应用私钥
            $public_key = input("public_key", "");//应用公钥
            $alipay_public_key = input("alipay_public_key", "");//支付宝公钥
            $app_type = input("app_type", "");//支持端口 如web app
            $pay_status = input("pay_status", 0);//支付启用状态
            $refund_status = input("refund_status", 0);//退款启用状态
            $transfer_status = input("transfer_status", 0);//转账启用状态
            $data = array (
                "app_id" => $app_id,
                "private_key" => $private_key,
                "public_key" => $public_key,
                "alipay_public_key" => $alipay_public_key,
                "refund_status" => $refund_status,
                "pay_status" => $pay_status,
                "transfer_status" => $transfer_status,
                "app_type" => $app_type
            );
            $result = $config_model->setPayConfig($data);
            return $result;
        } else {
            $info_result = $config_model->getPayConfig();
            $info = $info_result[ "data" ];

            if (!empty($info[ 'value' ])) {
                $app_type_arr = [];
                if (!empty($info[ 'value' ][ 'app_type' ])) {
                    $app_type_arr = explode(',', $info[ 'value' ][ 'app_type' ]);
                }
                $info[ 'value' ][ 'app_type_arr' ] = $app_type_arr;
            }
            $this->assign("info", $info);
            $this->assign("app_type", Config::get("app_type"));

            return $this->fetch("pay/config");
        }
    }
}