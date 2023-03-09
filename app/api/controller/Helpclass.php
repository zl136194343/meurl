<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\api\controller;

use app\model\web\Help as HelpModel;

class Helpclass extends BaseApi
{
	
	/**
	 * 列表信息
	 */
	public function lists()
	{
		$app_module = isset($this->params['app_module']) ? $this->params['app_module'] : 'admin';//admin：普通帮助，shop：入驻店铺时看的帮助
		
		$help = new HelpModel();
		$condition = [
			[ 'app_module', '=', $app_module ]
		];
		$list = $help->getHelpClassList($condition, 'class_id, class_name', 'sort desc');
		$order = 'create_time desc';
		$field = 'id,title';
		if (!empty($list['data'])) {
			
			foreach ($list['data'] as $k => $v) {
				$condition = [
					[ 'app_module', '=', $app_module ],
					[ 'class_id', '=', $v['class_id'] ],
				];
				$child_list = $help->getHelpList($condition, $field, $order);
				$child_list = $child_list['data'];
				$list['data'][ $k ]['child_list'] = $child_list;
			}
		}
		return $this->response($list);
	}

	/**
	 * 帮助分类
	 * @return false|string
	 */
	public function classLists(){

		$app_module = isset($this->params['app_module']) ? $this->params['app_module'] : 'admin';//admin：普通帮助，shop：入驻店铺时看的帮助

		$help = new HelpModel();
		$condition = [
			[ 'app_module', '=', $app_module ]
		];
		$list = $help->getHelpClassList($condition, 'class_id, class_name', 'sort desc');
		return $this->response($list);
	}
}