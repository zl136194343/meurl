<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */


namespace app\event;

use Carbon\Carbon;
use app\model\member\Customer;

/*use app\model\shop\ShopOrderCalc as ShopOrderCalcModel;
use app\model\system\Stat;*/
/**
 * 订单支付后店铺点单计算
 */
class SendmemberGl
{
	/**
	 * 传入订单信息
	 * @param unknown $data
	 */
	public function handle($data)
	{
	    $model = new Customer();
        $time = Carbon::today()->timestamp;
        
        $res = $model->shopCustomer($time);
        //每天定时刷新对应的粉丝列表
        $model->syncWechatFans(0);
        $model->syncWechatFans(1);
        return $res;
	}
	
}