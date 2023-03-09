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

namespace app\model\express;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;

/**
 * 配送配置
 */
class Config extends BaseModel
{

    /*********************************************************************** 物流配送 start ***********************************************************************/
    /**
     * 物流配送配置
     * @param $site_id
     * @return \multitype
     */
    public function getExpressConfig($site_id)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'EXPRESS_CONFIG' ] ]);
        return $res;
    }

    /**
     * 设置物流配送配置
     * @param $data
     * @return \multitype
     */
    public function setExpressConfig($data, $is_use, $site_id)
    {
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $config = new ConfigModel();
        $res = $config->setConfig($data, '物流配送设置', $is_use, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'EXPRESS_CONFIG' ] ]);
        return $res;
    }

    /*********************************************************************** 物流配送 end ***********************************************************************/
    /*********************************************************************** 门店自提 start ***********************************************************************/
    /**
     * 门店自提配置
     * @param $site_id
     * @return \multitype
     */
    public function getStoreConfig($site_id)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'EXPRESS_STORE_CONFIG' ] ]);
        return $res;
    }

    /**
     * 设置门店自提配置
     * @param $data
     * @return \multitype
     */
    public function setStoreConfig($data, $is_use, $site_id)
    {
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $config = new ConfigModel();
        $res = $config->setConfig($data, '门店自提配置设置', $is_use, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'EXPRESS_STORE_CONFIG' ] ]);
        return $res;
    }
    /*********************************************************************** 门店自提 end ***********************************************************************/
    /*********************************************************************** 外卖配送 start ***********************************************************************/

    /**
     * 外卖配送配置
     * @param $site_id
     * @return \multitype
     */
    public function getLocalDeliveryConfig($site_id)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'EXPRESS_LOCAL_DELIVERY_CONFIG' ] ]);
        return $res;
    }

    /**
     * 设置外卖配送配置
     * @param $data
     * @return \multitype
     */
    public function setLocalDeliveryConfig($data, $is_use, $site_id)
    {
        if ($site_id === '') {
            return $this->error('', '缺少必须参数站点id');
        }
        $config = new ConfigModel();
        $res = $config->setConfig($data, '外卖配送配置设置', $is_use, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'EXPRESS_LOCAL_DELIVERY_CONFIG' ] ]);
        return $res;
    }
    /*********************************************************************** 外卖配送 end ***********************************************************************/
    /**
     * 外卖配送拖动配置
     * @param $site_id
     * @return \multitype
     */
    public function getDeliverTypeSort($site_id)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'DELIVERY_SORT_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'deliver_type' => 'express,store,local'
            ];
        }
        return $res;
    }

    public function setDeliverTypeSort($data, $site_id)
    {
        if ($site_id === '') {
            return $this->error('', '缺少必须参数站点id');
        }
        $config = new ConfigModel();
        $res = $config->setConfig($data, '配置方式排序设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'DELIVERY_SORT_CONFIG' ] ]);
        return $res;
    }
        /**
     * 社区自提配置
     * @param $site_id
     * @return array
     */
    public function getCommunityDeliveryConfig($site_id)
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', 'shop'], ['config_key', '=', 'EXPRESS_COMMUNITY_DELIVERY_CONFIG']]);
        if (empty($res['data']['create_time']))  $res['data']['is_use'] = 1;
        return $res;
    }
}