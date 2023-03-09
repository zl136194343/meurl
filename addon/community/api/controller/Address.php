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

namespace addon\community\api\controller;

use addon\community\model\system\Address as AddressModel;
use app\model\web\Config as WebConfig;

/**
 * 地址管理
 * @author Administrator
 *
 */
class Address extends BaseApi
{

    /**
     * 基础信息
     */
    public function info()
    {
        $id      = $this->params['id'];
        $address = new AddressModel();
        $info    = $address->getAreaInfo($id);
        return $this->response($info);
    }

    /**
     * 列表信息
     */
    public function lists()
    {
        $pid     = isset($this->params['pid']) ? $this->params['pid'] : 0;
        
        $address = new AddressModel();
       
        $list    = $address->getAddTree(3);
        return $this->response($list);
    }

    /**
     * 树状结构信息
     */
    public function tree()
    {
        $id      = $this->params['id'];
        $address = new AddressModel();
        $tree    = $address->getAreas($id);
        return $this->response($tree);
    }

    /**
     * IP 定位
     * @return false|string
     */
    public function ipLocation()
    {
        $web_config_model = new WebConfig();
        $map_config       = $web_config_model->getMapConfig()['data']['value'];
        $key              = $map_config['tencent_map_key'];

        if (empty($key)) {
            return $this->response($this->error('', 'REQUEST_FAIL'));
        }
        try {
            $url = 'https://apis.map.qq.com/ws/location/v1/ip';
            $url .= '?' . http_build_query(['key' => $key, 'ip' => request()->ip()]);
            $res = json_decode(http($url, 0), true);

            if ($res['status'] == 0) {
                return $this->response($this->success($res['result']));
            } else {
                return $this->response($this->error('', $res['message']));
            }
        } catch (\Exception $e) {
            return $this->response($this->error('', $e->getMessage()));
        }
    }
       
}