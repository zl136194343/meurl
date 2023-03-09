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

use addon\membersignin\model\Signin;
use app\model\member\MemberSignin as MemberSigninModel;

class Membersignin extends BaseApi
{

    /**
     * 是否已签到
     */
    public function issign()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_signin = new MemberSigninModel();
        $res = $member_signin->isSign($token['data']['member_id']);
        return $this->response($res);
    }

    /**
     * 签到
     */
    public function signin()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_signin = new MemberSigninModel();
        $res = $member_signin->signin($token['data']['member_id']);
        return $this->response($res);
    }

    /**
     * 签到奖励规则
     * @return string
     */
    public function award()
    {
        $member_signin = new MemberSigninModel();
        $info = $member_signin->getAward();
        return $this->response($info);
    }

    /**
     * 获取签到记录
     */
    public function getSignRecords()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_signin = new MemberSigninModel();

        $date = strtotime(date('Y-m-01 00:00:00')) - 86400 * 6;
        $condition = [
            ['member_id', '=', $this->member_id??241],
            ['create_time', 'between', [$date, time()]],
            ['action', '=', 'membersignin']
        ];

        $list = $member_signin->getMemberSigninList($condition, 'create_time', 'id asc');
        $arr = [];
        foreach($list['data'] as $l){
            $arr[] =['date'=>date('Y-m-d',$l['create_time']),'info'=>'已签到'] ;
            
        }
        return $this->response($this->success($arr));
    }

    /**
     * 获取签到是否开启
     */
    public function getSignStatus()
    {
        $config_model = new Signin();
        $config_result = $config_model->getConfig();
        return $this->response($config_result);
    }

}