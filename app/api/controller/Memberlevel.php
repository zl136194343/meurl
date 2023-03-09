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

use app\model\member\MemberLevel as MemberLevelModel;

class Memberlevel extends BaseApi
{
	/**
	 * 列表信息
	 */
	public function lists()
	{
		$member_level_model = new MemberLevelModel();
		$member_level_list = $member_level_model->getMemberLevelList([], 'level_id,level_name,growth,remark', 'growth asc');
		return $this->response($member_level_list);
	}
	
}