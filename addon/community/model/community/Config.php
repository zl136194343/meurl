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

namespace addon\community\model\community;

use app\model\BaseModel;
use app\model\system\Config as ConfigModel;

/**
 * 团长配置
 */
class Config extends BaseModel
{
    /**
     * 设置团长基础配置
     * @param array $params
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function setConfig(array $params, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->setConfig($params, '团长基础配置', 1, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'LEADER_BASIC_CONFIG']]);
        return $res;
    }

    /**
     * 获取团长基础配置
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function getConfig($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', 0], ['app_module', '=', $app_module], ['config_key', '=', 'LEADER_BASIC_CONFIG']]);
        if (empty($res['data']['value'])) {
            $res['data']['value'] = [
                // 团长佣金类型 1: 比例, 2: 金额
                'commission_type'    => 1,
                // 社区距离限制
                'community_distance' => 1000,
                // 允许团长申请
                'is_allow_apply'     => 0
            ];
        }
        return $res;
    }

    /**
     * 设置团长注册协议配置
     * @param array $params
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function setSettledAgreement(array $params, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->setConfig($params, '团长入驻协议', 1, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'LEADER_SETTLED_AGREEMENT_CONFIG']]);
        return $res;
    }

    /**
     * 获取团长注册协议配置
     * @param $site_id
     * @param string $app_module
     * @return array
     */
    public function getSettledAgreement($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'LEADER_SETTLED_AGREEMENT_CONFIG']]);
        if (empty($res['data']['value'])) {
            $res['data']['value'] = [
                // 协议标题
                'title'   => '',
                // 协议内容
                'content' => ''
            ];
        }
        return $res;
    }
    
    /**
     * 团长提现配置
     * @return multitype:string mixed
     */
    public function getFenxiaoWithdrawConfig()
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'LEADER_WITHDRAW_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'withdraw' => 0,//最低提现额度
                'withdraw_rate' => 0,//佣金提现手续费
                'min_no_fee' => 0,//最低免手续费区间
                'max_no_fee' => 0,//最高免手续费区间
                'withdraw_status' => 1,//提现审核
                'withdraw_type' => 0,//提现方式
            ];
        }
        return $res;
    }
    
     /**
     * 团长设置提现配置
     * @return multitype:string mixed
     */
    public function setFenxiaoWithdrawConfig($params, $site_id=0, $app_module = 'shop')
    {
        $config = new ConfigModel();
       
        $res = $config->setConfig($params, '团长提现协议', 1, [['site_id', '=', 0], ['app_module', '=', $app_module], ['config_key', '=', 'LEADER_WITHDRAW_CONFIG']]);
        return $res;
    }
}