<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\community\api\controller;

use addon\community\model\community\Withdraw as WithdrawModel;
use addon\community\model\community\Leader ;

/**
 * 团长提现
 */
class Communitywithdraw extends BaseApi
{

    /**
     * 申请提现
     */
    public function apply()
    {
        /*$token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);*/

        $member_id = $this->member_id??30;
        $money = isset($this->params[ 'money' ]) ? $this->params[ 'money' ] : '';
        $cl_id = isset($this->params[ 'cl_id' ]) ? $this->params[ 'cl_id' ] : '';
        if (empty($money)) {
            return $this->response($this->error('', 'REQUEST_MONEY'));
        }
        if (empty($cl_id)) {
            return $this->response($this->error('', '团长id不能为空'));
        }

        $data = [
            'member_id' => $member_id,
            'money' => $money,
            'cl_id' => $cl_id
        ];
        
        $withdraw_model = new WithdrawModel();
        $res = $withdraw_model->addCommunityWithdraw($data);

        return $this->response($res);
    }

    /**
     * 提现记录分页
     * @return false|string
     */
    public function page()
    {

        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $cl_id = isset($this->params[ 'cl_id' ]) ? $this->params[ 'cl_id' ] : 0;
        if (empty($cl_id)) {
            return $this->error('', '团长id不能为空');
        }
        $page = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        $status = isset($this->params[ 'status' ]) ? $this->params[ 'status' ] : 0;// 当前状态 1待审核 2待转账 3已转账 -1 已拒绝

        $condition = [
            [ 'commander_id', '=', $cl_id ]
        ];
        if (!empty($status)) {
            $condition[] = [ 'status', '=', $status ];
        }

        $order = 'id desc';
        $withdraw_model = new WithdrawModel();
        $list = $withdraw_model->getFenxiaoWithdrawPageList($condition, $page, $page_size, $order);
        return $this->response($list);
    }
    
     /**
     * 提现详情
     * @return false|string
     */
    public function details()
    {

        /*$token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);*/
        $id= isset($this->params[ 'id' ]) ? $this->params[ 'id' ] : 0;// 当前状态 1待审核 2待转账 3已转账 -1 已拒绝
        
        
        if (empty($id)) {
            return $this->error('', '订单id不能为空');
        }
    $condition[] = [ 'id', '=', $id ];
        $order = 'id desc';
        $withdraw_model = new WithdrawModel();
        $list = $withdraw_model->getFenxiaoWithdrawInfo($condition);
        return $this->response($list);
    }

}