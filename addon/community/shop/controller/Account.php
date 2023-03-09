<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace addon\community\shop\controller;

use app\model\community\CommunityAccount;
use app\model\community\Leader as LeaderModel;
use app\model\delivery\Clerk as ClerkModel;
use app\model\delivery\Order as DeliveryOrderModel;
use app\model\member\Withdraw as MemberWithdrawModel;
use app\model\system\Stat as StatModel;
use app\model\web\Account as AccountModel;
use app\model\order\OrderCommon as OrderCommonModel;
use Carbon\Carbon;

class Account extends BaseShop
{
    /**
     * 财务概况
     */
    public function dashboard()
    {
        $stat_model           = new StatModel();
        $leader_model         = new LeaderModel();
        $clerk_model          = new ClerkModel();
        $delivery_order_model = new DeliveryOrderModel();
        $common_model         = new OrderCommonModel();
        $account_model        = new AccountModel();
        $community_account    = new CommunityAccount();
        $withdraw_model       = new MemberWithdrawModel();

        $today     = Carbon::now();
        $yesterday = Carbon::yesterday();
        $condition = [['site_id', '=', $this->site_id]];

        // 今日统计数据
        $stat_today  = $stat_model->getStatShop($this->site_id, $today->year, $today->month, $today->day)['data'];
        $today_range = [$today->today()->timestamp, time()];
        $today_data  = [
            // 订单数
            'order_pay_count'                   => $stat_today['order_pay_count'],
            // 销售额
            'order_total'                       => $stat_today['order_total'],
            // 退款金额
            'refund_total'                      => $stat_today['refund_total'],
            // 退款申请
            'refund_total_count'                => $common_model->getOrderGoodsCount(array_merge($condition, [
                ['refund_status', '<>', 0],
                ['refund_action_time', 'between', $today_range]
            ]), 'order_goods_id')['data'],
            // 新增团长
            'community_leader'                  => $stat_today['leader_count'],
            // 团长佣金
            'community_leader_commission_total' => $community_account->getCommunityAccountSum(array_merge($condition, [
                ['type', '=', 'order'],
                ['create_time', 'between', $today_range],
            ]))['data'],
            // 新增配送员
            'community_clerk'                   => $clerk_model->getClerkCount(array_merge($condition, [
                ['create_time', 'between', $today_range]
            ]))['data'],
            // 配送单数
            'community_delivery'                => $delivery_order_model->getOrderCount(array_merge($condition, [
                ['create_time', 'between', $today_range]
            ]))['data'],
            // 转账数
            'balance_withdraw'                  => $withdraw_model->getMemberWithdrawSum(array_merge($condition, [
                ['status', '=', 2],
                ['payment_time', 'between', $today_range]
            ]), 'money')['data'],
            // 申请提现
            'balance_withdraw_apply'            => $withdraw_model->getMemberWithdrawSum(array_merge($condition, [
                ['status', 'in', '0, 1'],
                ['apply_time', 'between', $today_range]
            ]), 'apply_money')['data'],
        ];


        // 昨日统计数据
        $stat_yesterday  = $stat_model->getStatShop($this->site_id, $yesterday->year, $yesterday->month, $yesterday->day)['data'];
        $yesterday_range = [$yesterday->startOfDay()->timestamp, $yesterday->endOfDay()->timestamp];
        $yesterday_data  = [
            // 订单数
            'order_pay_count'                   => $stat_yesterday['order_pay_count'],
            // 销售额
            'order_total'                       => $stat_yesterday['order_total'],
            // 退款金额
            'refund_total'                      => $stat_yesterday['refund_total'],
            // 退款申请
            'refund_total_count'                => $common_model->getOrderGoodsCount(array_merge($condition, [
                ['refund_status', '<>', 0],
                ['refund_action_time', 'between', $yesterday_range]
            ]), 'order_goods_id')['data'],
            // 新增团长
            'community_leader'                  => $stat_yesterday['leader_count'],
            // 团长佣金
            'community_leader_commission_total' => $community_account->getCommunityAccountSum(array_merge($condition, [
                ['type', '=', 'order'],
                ['create_time', 'between', $yesterday_range]
            ]))['data'],
            // 新增配送员
            'community_clerk'                   => $clerk_model->getClerkCount(array_merge($condition, [
                ['create_time', 'between', $yesterday_range]
            ]))['data'],
            // 配送单数
            'community_delivery'                => $delivery_order_model->getOrderCount(array_merge($condition, [
                ['create_time', 'between', $yesterday_range]
            ]))['data'],
            // 转账数
            'balance_withdraw'                  => $withdraw_model->getMemberWithdrawSum(array_merge($condition, [
                ['status', '=', 2],
                ['payment_time', 'between', $yesterday_range]
            ]), 'money')['data'],
            // 申请提现
            'balance_withdraw_apply'            => $withdraw_model->getMemberWithdrawSum(array_merge($condition, [
                ['status', 'in', '0, 1'],
                ['apply_time', 'between', $yesterday_range]
            ]), 'apply_money')['data'],
        ];

        // 日同比数据
        $day_rate_data = [];
        foreach ($today_data as $key => $val) $day_rate_data[$key] = diff_rate($val, $yesterday_data[$key]);

        // 总数数据
        $shop_stat_sum      = $stat_model->getShopStatSum($this->site_id)['data'];
        $member_account_sum = $account_model->getMemberBalanceSum($this->site_id)['data'];
        $total_data         = [
            // 订单总数
            'order_pay_count'                   => $shop_stat_sum['order_pay_count'],
            // 销售总额
            'order_total'                       => $shop_stat_sum['order_total'],
            // 退款总额
            'refund_total'                      => $shop_stat_sum['refund_total'],
            // 退款总数
            'refund_total_count'                => $common_model->getOrderGoodsCount(array_merge($condition, [['refund_status', '<>', 0]]), 'order_goods_id')['data'],
            // 团长总数
            'community_leader'                  => $leader_model->getLeaderCount(array_merge($condition, [
                ['status', 'in', LeaderModel::STATUS_NORMAL . ',' . LeaderModel::STATUS_FREEZE]
            ]))['data'],
            // 团长总结算佣金
            'community_leader_commission_total' => $leader_model->getLeaderSum($condition)['data'],
            // 配送员总数
            'community_clerk'                   => $clerk_model->getClerkCount($condition)['data'],
            // 配送单总数
            'community_delivery'                => $delivery_order_model->getOrderCount(array_merge($condition, [['is_delete', '=', 0]]))['data'],
            // 提现转账总额
            'balance_withdraw'                  => $member_account_sum['balance_withdraw'],
            // 提现中金额
            'balance_withdraw_apply'            => $member_account_sum['balance_withdraw_apply'],
        ];

        $this->assign([
            'today_data'        => $today_data,
            'yesterday_data'    => $yesterday_data,
            'day_rate_data'     => $day_rate_data,
            'total_data'        => $total_data,
            'order_total_money' => 0,
        ]);

        return $this->fetch('account/dashboard');
    }
}