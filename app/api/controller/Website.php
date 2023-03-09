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

use app\model\web\WebSite as WebsiteModel;

/**
 * 网站设置
 * @author Administrator
 *
 */
class Website extends BaseApi
{
	/**
	 * 基础信息
	 */
	public function info()
	{
		$site_id = isset($this->params['site_id']) ? $this->params['site_id'] : 0;
		$filed = 'title,logo,desc,web_qrcode,web_status,close_reason,wap_status,keywords,web_email,web_phone';
		$website_model = new WebsiteModel();
		$info = $website_model->getWebSite([['site_id', '=', $site_id]], $filed);
		return $this->response($info);
	}

	public function wapQrcode()
	{
		$site_id = isset($this->params['site_id']) ? $this->params['site_id'] : 0;
		$website_model = new WebsiteModel();
		$info = $website_model->qrcode($site_id);
		return $this->response($info);
	}
}
