<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * @author : niuteam
 */

namespace app\api\controller;

use app\model\shop\Shop as ShopModel;
use app\model\system\Servicer;
use app\model\web\Config as ConfigModel;

class Config extends BaseApi
{

    /**
     * 详情信息
     */
    public function defaultimg()
    {
        $upload_config_model = new ConfigModel();
        $res = $upload_config_model->getDefaultImg($this->site_id, 'shop');
        if (!empty($res[ 'data' ][ 'value' ])) {
            return $this->response($this->success($res[ 'data' ][ 'value' ]));
        } else {
            return $this->response($this->error());
        }
    }

    /**
     * 版权信息
     */
    public function copyright()
    {
        $config_model = new ConfigModel();
        $res = $config_model->getCopyright($this->site_id, 'shop');
        return $this->response($this->success($res[ 'data' ][ 'value' ]));
    }

    /**
     * 获取当前时间戳
     * @return false|string
     */
    public function time()
    {
        $time = time();
        return $this->response($this->success($time));
    }

    /**
     * 获取验证码配置
     */
    public function getCaptchaConfig(){
        
        $config_model = new ConfigModel();
        $info = $config_model->getCaptchaConfig();
        return $this->response($this->success($info));
    }

    /**
     * 客服配置
     */
    public function servicer(){
        $servicer_model = new Servicer();
        $result = $servicer_model->getServicerConfig()['data'] ?? [];
        return $this->response($this->success($result['value'] ?? []));
    }

    /**
     * 详情信息
     */
    public function community()
    {
        $config_model = new \app\model\order\Config();
        $res = $config_model->getTradeConfig($this->site_id, $this->app_module);
        $data = $res['data']['value'];
        if (!empty($data)) {
            switch ($data['delivery_type']) {
                case 1:
                    if(time() < strtotime(date('Y-m-d').' '.date('H:i:s', $data['book_time']))){
                        $data['pickup_time'] = strtotime(date('Y-m-d').' '.date('H:i:s', $data['pickup_time']));
                    }else{
                        $data['pickup_time'] = strtotime(date('Y-m-d', strtotime('+1day')).' '.date('H:i:s', $data['pickup_time']));
                    }
                    break;
                case 2:
                    $data['pickup_time'] = strtotime(date('Y-m-d', strtotime('+1day')).' '.date('H:i:s', $data['pickup_time']));
                    break;
                case 3:
                    $data['pickup_time'] = strtotime(date('Y-m-d', strtotime('+2day')).' '.date('H:i:s', $data['pickup_time']));
                    break;
            }
            $data['book_time'] = strtotime(date('Y-m-d H:i:s', $data['book_time']));
            return $this->response($this->success($data));
        } else {
            return $this->response($this->error());
        }
    }

    /**
     * 联系信息
     */
    public function contact(){
        $shop_model = new ShopModel();
        $shop_info_result = $shop_model->getShopInfo([["site_id", "=", $this->site_id]], 'name,telephone,mobile,address,full_address');
        $shop_info = $shop_info_result[ "data" ];
        return $this->response($this->success($shop_info));
    }
}