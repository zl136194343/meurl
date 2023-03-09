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

namespace app\model\system;

use app\model\BaseModel;
use app\model\system\Config as ConfigModel;

/**
 * 接口api配置
 */
class Api extends BaseModel
{


    /***************************************************************接口api 开始********************************************************/
    /**
     * 获取api配置
     */
    public function getApiConfig()
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'admin' ], [ 'config_key', '=', 'API_CONFIG' ] ]);
        return $res;
    }

    /**
     * 设置api配置
     * @param $data
     * @return \multitype
     */
    public function setApiConfig($data, $is_use)
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, 'api配置', $is_use, [ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'admin' ], [ 'config_key', '=', 'API_CONFIG' ] ]);
        return $res;
    }
    /***************************************************************接口api 结束********************************************************/

}