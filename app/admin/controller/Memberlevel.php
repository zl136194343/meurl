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

namespace app\admin\controller;

use app\model\member\MemberLevel as MemberLevelModel;

/**
 * 会员等级管理 控制器
 */
class Memberlevel extends BaseAdmin
{
	/**
	 * 会员等级列表
	 */
	public function levelList()
	{
		if (request()->isAjax()) {
			$page = input('page', 1);
			$page_size = input('page_size', PAGE_LIST_ROWS);
			$search_text = input('search_text', '');
			
			$condition = [];
			$condition[] = [ 'level_name', 'like', "%" . $search_text . "%" ];
			$order = 'growth asc';
			$field = '*';
			
			$member_level_model = new MemberLevelModel();
			$list = $member_level_model->getMemberLevelPageList($condition, $page, $page_size, $order, $field);
			
			return $list;
		} else {

			return $this->fetch('memberlevel/level_list');
		}
	}
	
	/**
	 * 会员等级添加
	 */
	public function addLevel()
	{
		if (request()->isAjax()) {
			$data = [
				'level_name' => input('level_name', ''),
				'growth' => input('growth', 0.00),
				'remark' => input('remark', ''),
				'discount' => input('discount', '')
			];

			$member_level_model = new MemberLevelModel();
			$this->addLog("会员等级添加:" . $data['level_name']);
			return $member_level_model->addMemberLevel($data);
		} else {
			return $this->fetch('memberlevel/add_level');
		}
	}
	
	/**
	 * 会员等级修改
	 */
	public function editLevel()
	{
		if (request()->isAjax()) {
			$data = [
				'level_name' => input('level_name', ''),
				'growth' => input('growth', 0.00),
				'remark' => input('remark', ''),
				'discount' => input('discount', ''),
				'check_rate'=>input('check_rate',0)
			];
			
			$level_id = input('level_id', 0);

			$member_level_model = new MemberLevelModel();
			$this->addLog("会员等级修改:" . $data['level_name']);
			return $member_level_model->editMemberLevel($data, [ [ 'level_id', '=', $level_id ] ]);
		} else {
			
			$level_id = input('get.level_id', 0);
			$member_level_model = new MemberLevelModel();
			$level_info = $member_level_model->getMemberLevelInfo([ [ 'level_id', '=', $level_id ] ]);
			$this->assign('level_info', $level_info);
			
			return $this->fetch('memberlevel/edit_level');
		}
	}
	
	/**
	 * 会员等级删除
	 */
	public function deleteLevel()
	{
		$level_ids = input('level_ids', '');
		$member_level_model = new MemberLevelModel();
		$this->addLog("会员等级删除id:" . $level_ids);
		return $member_level_model->deleteMemberLevel([ [ 'level_id', 'in', $level_ids ] ]);
	}
	
	/**
	 * 设置默认
	 */
	public function setDefault(){
		if (request()->isAjax()) {
			$level_id = input('level_id', '');
			$member_level_model = new MemberLevelModel();
			$res = $member_level_model->setDefaultLevel($level_id);
			return $res;
		}
	}
}