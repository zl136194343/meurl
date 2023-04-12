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

namespace addon\membersignin\admin\controller;

use addon\membersignin\model\Signin;
use app\admin\controller\BaseAdmin;
use app\model\system\Config as ConfigModel;

/**
 * 会员签到
 */
class Config extends BaseAdmin
{
	
	public function index()
	{
		$config_model = new Signin();
		$config = new ConfigModel();
        if (request()->isAjax()) {
            $data   = input("json", "{}");
            $cycle   = input("cycle", 30);
            $is_use = input("is_use", 0);//是否启用
            $data   = json_decode($data,true);
            $res    = $config_model->setConfig(['cycle' => $cycle, 'reward' => $data], $is_use);
            $goods_id = input("goods_id", 0);
            
             $res = $config->setConfig(['goods_id'=>$goods_id], '签到浏览商品设置', 1, [ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'admin' ], [ 'config_key', '=', 'GOODS_MEMBERSIGNIN_CONFIG' ] ]);
            $this->addLog("设置会员签到奖励");
            return $res;
        } else {
            $config_result = $config_model->getConfig();
            $this->assign('config', $config_result['data']);
            
             $res = $config->getConfig([ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'admin' ], [ 'config_key', '=', 'GOODS_MEMBERSIGNIN_CONFIG' ] ]);
             
             $goods = model('goods')->getInfo([['sku_id','=',$res['data']['value']['goods_id']]],'sku_id,goods_name');
                
             $this->assign('goods', $goods);
            return $this->fetch('config/index');
        }
	}


	
}