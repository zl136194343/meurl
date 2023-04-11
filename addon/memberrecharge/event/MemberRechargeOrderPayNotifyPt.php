<?php


namespace addon\memberrecharge\event;
use addon\memberrecharge\model\MemberrechargeOrder;

class MemberRechargeOrderPayNotifyPt
{
    public function handle($data)
    {
        $model = new MemberrechargeOrder();
        $res = $model->orderPayPt($data);
        return $res;
    }
}