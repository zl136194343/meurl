<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */
namespace addon\pointexchange\admin\controller;

use addon\pointexchange\model\Order as ExchangeOrderModel;
use app\admin\controller\BaseAdmin;
use addon\pointexchange\model\Pointexchange as PointexchangeModel;
/**
 * 兑换发放订单
 */
class Pointexchange extends BaseAdmin
{
	
	/**
	 * 兑换订单列表
	 * @return mixed
	 */
	public function lists()
	{
		
		$exchange_id = input('exchange_id', '');
		if (request()->isAjax()) {
			$page = input('page', 1);
			$page_size = input('page_size', PAGE_LIST_ROWS);
			$search_text = input('search_text', '');
			$condition = [];
			if ($search_text) {
				$condition[] = [ 'exchange_name', 'like', '%' . $search_text . '%' ];
			}
			
			$type = input('type', '');
			if ($type) {
				$condition[] = [ 'type', '=', $type ];
			}
			
			if ($exchange_id) {
				$condition[] = [ 'exchange_id', '=', $exchange_id ];
			}
			
			$order = 'create_time desc';
			$field = '*';
			
			$exchange_order_model = new ExchangeOrderModel();
			return $exchange_order_model->getExchangePageList($condition, $page, $page_size, $order, $field);
		} else {
			$this->assign('exchange_id', $exchange_id);
			$this->forthMenu();
			return $this->fetch("exchange_order/lists");
		}
		
	}
	
	/**订单详情
	 * @return mixed
	 */
	public function detail()
	{
		$order_id = input('order_id', 0);
		$order_model = new ExchangeOrderModel();
		$order_info = $order_model->getOrderInfo([ [ 'order_id', '=', $order_id ] ]);
		$order_info = $order_info["data"];
		$this->assign("order_info", $order_info);
		return $this->fetch('exchange_order/detail');
	}
	
	    /**积分商城轮播
     * @return mixed
     */
    public function banner()
    {
        $config_model = new PointexchangeModel();
        if (request()->isAjax()) {
            //轮播
            $data = [
                'banner1' => input('banner1', ''),
                'banner2' => input('banner2', ''),
                'banner3' => input('banner3', ''),
                'banner4' => input('banner4', ''),
                'banner5' => input('banner5', ''),

            ];
            $res = $config_model->setConfig($data,[ [ 'site_id', '=', 1 ] ]);
            return $res;
        } else {
            //轮播
            $config_result = $config_model->getConfig([ [ 'site_id', '=', 1 ] ]);

            $this->assign('config', $config_result[ 'data' ]);
            return $this->fetch('pointexchange/banner');
        }
    }

}