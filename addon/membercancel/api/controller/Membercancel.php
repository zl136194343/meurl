<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */
namespace addon\membercancel\api\controller;

use app\api\controller\BaseApi;
use addon\membercancel\model\MemberCancel as MemberCancelModel;
use app\model\member\Config as ConfigModel;

/**
 * 会员注销
 * Class MemberCancel
 * @package app\api\controller
 */
class Membercancel extends BaseApi
{

    /**
     * 获取注销信息
     */
    public function info()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_cancel_model = new MemberCancelModel();
        $member_cancel_info = $member_cancel_model->getMemberCancelInfo(
            [
                ['member_id', '=', $this->member_id]
            ],
            'status,reason,audit_time'
        );
        return $this->response($member_cancel_info);
    }

    /**
     * 账户信息
     */
    public function accountInfo()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_cancel_model = new MemberCancelModel();
        $member_account_info = $member_cancel_model->getMemberAccountInfo($this->member_id);
        return $this->response($member_account_info);
    }

    /**
     * 申请注销
     */
    public function apply()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_cancel_model = new MemberCancelModel();
        $res = $member_cancel_model->applyMemberCancel(['member_id' => $this->member_id]);
        return $this->response($res);
    }


    /**
     *  撤销申请
     */
    public function cancelApply()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_cancel_model = new MemberCancelModel();
        $res = $member_cancel_model->cancelApplyMemberCancel($this->member_id);
        return $this->response($res);
    }


    /**
     * 获取注销设置
     */
    public function config()
    {
        $config_model = new ConfigModel();
        $config_info = $config_model->getCancelConfig();
        $value = $config_info['data']['value'];
        return $this->response($this->success($value));
    }

    /**
     * 获取注销协议
     */
    public function agreement()
    {
        $config_model = new ConfigModel();
        $document_info = $config_model->getCancelDocument();
        return $this->response($document_info);
    }


}