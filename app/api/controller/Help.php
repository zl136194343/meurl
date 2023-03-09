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

/**
 * 系统帮助
 * @author Administrator
 *
 */
class Help extends BaseApi
{
	
	/**
	 * 基础信息
	 */
	public function info()
	{
		$help_id = isset($this->params['id']) ? $this->params['id'] : 0;
		if (empty($help_id)) {
			return $this->response($this->error('', 'REQUEST_ID'));
		}
		$help = new HelpModel();
		$info = $help->getHelpInfo($help_id);
		return $this->response($info);
	}
	
	/**
	 * 分页列表信息
	 */
	public function page()
	{
		$page = isset($this->params['page']) ? $this->params['page'] : 1;
		$page_size = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;
		$app_module = isset($this->params['app_module']) ? $this->params['app_module'] : 'admin';//admin：普通帮助，shop：入驻店铺时看的帮助
		$class_id = isset($this->params['class_id']) ? $this->params['class_id'] : 0;
		
		$condition = [
			[ 'app_module', '=', $app_module ],
			[ 'class_id', '=', $class_id ],
		];
		$order = 'create_time desc';
		$field = 'id,title,class_id,class_name,sort,create_time';
		$help = new HelpModel();
		$list = $help->getHelpPageList($condition, $page, $page_size, $order, $field);
		return $this->response($list);
	}
	public function sysm()
	{
	    //使用说明
	    $list = model('sysm')->getList([['pid','=',0]]);
	    return $this->response(success('','',$list));
	}
	
	public function sysmInfo()
	{
	    //使用说明
	    $id = input('id','');
	    $page = isset($this->params['page']) ? $this->params['page'] : 1;
		$page_size = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;
	    $list = model('sysm')->pageList([['pid|id','=',$id]],'*','sort desc',$page,$page_size);
	    return $this->response(success('','',$list));
	}
}