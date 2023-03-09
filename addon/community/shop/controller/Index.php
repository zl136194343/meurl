<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\shop\controller;

use app\model\community\Leader as LeaderModel;
use app\model\goods\Goods as GoodsModel;
use app\model\member\Member as MemberModel;
use app\model\system\Stat;
use Carbon\Carbon;
use app\model\web\Account as AccountModel;
use app\model\order\OrderCommon;
use app\model\order\OrderRefund as OrderRefundModel;

class Index extends BaseShop
{

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $this->assign('shop_status', 1);

        //基础统计信息
        $stat_shop_model = new Stat();
        $today           = Carbon::now();
        $yesterday       = Carbon::yesterday();
        $stat_today      = $stat_shop_model->getStatShop($this->site_id, $today->year, $today->month, $today->day);
        $stat_yesterday  = $stat_shop_model->getStatShop($this->site_id, $yesterday->year, $yesterday->month, $yesterday->day);
        $this->assign("stat_day", $stat_today['data']);
        $this->assign("stat_yesterday", $stat_yesterday['data']);
        $this->assign("today", $today);

        //获取总数
        $shop_stat_sum                        = $stat_shop_model->getShopStatSum($this->site_id);
        $goods_model                          = new GoodsModel();
        $goods_sum                            = $goods_model->getGoodsTotalCount(['site_id' => $this->site_id, 'is_delete' => 0]);
        $shop_stat_sum['data']['goods_count'] = $goods_sum['data'];
        $this->assign('shop_stat_sum', $shop_stat_sum['data']);

        //会员总数
        $member_model = new MemberModel();
        $member_count = $member_model->getMemberCount([['site_id', '=', $this->site_id]]);
        $this->assign('member_count', $member_count['data']);

        //日同比
        $day_rate['order_pay_count'] = diff_rate($stat_today['data']['order_pay_count'], $stat_yesterday['data']['order_pay_count']);
        $day_rate['order_total']     = diff_rate($stat_today['data']['order_total'], $stat_yesterday['data']['order_total']);
        $day_rate['collect_goods']   = diff_rate($stat_today['data']['collect_goods'], $stat_yesterday['data']['collect_goods']);
        $day_rate['visit_count']     = diff_rate($stat_today['data']['visit_count'], $stat_yesterday['data']['visit_count']);
        $day_rate['member_count']    = diff_rate($stat_today['data']['member_count'], $stat_yesterday['data']['member_count']);
        $day_rate['leader_count']    = diff_rate($stat_today['data']['leader_count'], $stat_yesterday['data']['leader_count']);

        $this->assign('day_rate', $day_rate);
        //周同比
        $begin_last_week = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 7, date('Y'));
        $end_last_week   = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 7, date('Y'));

        $begin_week = mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"));
        $end_week   = mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y"));

        $stat_last_week = $stat_shop_model->getStatShopByCondition($this->site_id, $begin_last_week, $end_last_week);

        $stat_week                    = $stat_shop_model->getStatShopByCondition($this->site_id, $begin_week, $end_week);
        $week_rate                    = [];
        $week_rate['order_pay_count'] = diff_rate($stat_week['data']['order_pay_count'], $stat_last_week['data']['order_pay_count']);
        $week_rate['order_total']     = diff_rate($stat_week['data']['order_total'], $stat_last_week['data']['order_total']);
        $week_rate['collect_goods']   = diff_rate($stat_week['data']['collect_goods'], $stat_last_week['data']['collect_goods']);
        $week_rate['visit_count']     = diff_rate($stat_week['data']['visit_count'], $stat_last_week['data']['visit_count']);
        $week_rate['member_count']    = diff_rate($stat_week['data']['member_count'], $stat_last_week['data']['member_count']);
        $week_rate['leader_count']    = diff_rate($stat_week['data']['leader_count'], $stat_last_week['data']['leader_count']);

        $this->assign('week_rate', $week_rate);

        //订单数
        $order    = new OrderCommon();
        $waitpay  = $order->getOrderCount([['order_status', '=', 0], ['site_id', '=', $this->site_id], ['is_delete', '=', 0]]);
        $waitsend = $order->getOrderCount([['order_status', '=', 1], ['site_id', '=', $this->site_id], ['is_delete', '=', 0]]);

        $order_refund_model = new OrderRefundModel();
        $refund_num         = $order_refund_model->getRefundOrderGoodsCount([
            ["site_id", "=", $this->site_id],
            ["refund_status", "not in", [0, 3]]
        ]);
        $goods_stock_alarm  = $goods_model->getGoodsStockAlarm($this->site_id);

        $num_data = [
            'waitpay'           => $waitpay['data'],
            'waitsend'          => $waitsend['data'],
            'refund'            => $refund_num['data'],
            'goods_stock_alarm' => $goods_stock_alarm['data']
        ];

        // 团长申请
        $leader_model                   = new LeaderModel();
        $num_data['leader_apply_count'] = $leader_model->getLeaderCount([
            ['site_id', '=', $this->site_id],
            ['status', 'in', LeaderModel::STATUS_AUDIT_WAIT . ',' . LeaderModel::STATUS_AUDIT_REFUSE]
        ])['data'];

        // 会员账户
        $account_model              = new AccountModel();
        $num_data['member_account'] = $account_model->getMemberBalanceSum($this->site_id)['data'];

        // 团长总数
        $leader_count = $leader_model->getLeaderCount([
            ['site_id', '=', $this->site_id],
            ['status', 'in', LeaderModel::STATUS_NORMAL . ',' . LeaderModel::STATUS_FREEZE]
        ])['data'];
        $this->assign('leader_count', $leader_count);

        $this->assign('num_data', $num_data);

        //近十天的订单数以及销售金额
        $date_day        = getweeks();
        $order_total     = '';
        $order_pay_count = '';
        $member_count    = '';
        $leader_count    = '';
        foreach ($date_day as $k => $day) {
            $dayarr          = explode('-', $day);
            $stat_day[$k]    = $stat_shop_model->getStatShop($this->site_id, $dayarr[0], $dayarr[1], $dayarr[2]);
            $order_total     .= $stat_day[$k]['data']['order_total'] . ',';
            $order_pay_count .= $stat_day[$k]['data']['order_pay_count'] . ',';
            $member_count    .= $stat_day[$k]['data']['member_count'] . ',';
            $leader_count    .= $stat_day[$k]['data']['leader_count'] . ',';
        }
        $ten_day['order_total']     = explode(',', substr($order_total, 0, strlen($order_total) - 1));
        $ten_day['order_pay_count'] = explode(',', substr($order_pay_count, 0, strlen($order_pay_count) - 1));
        $ten_day['member_count']    = explode(',', substr($member_count, 0, strlen($member_count) - 1));
        $ten_day['leader_count']    = explode(',', substr($leader_count, 0, strlen($leader_count) - 1));
        $this->assign('ten_day', $ten_day);


        // 排行数据
        $rank_data = [
            // 团长
            'leader' => $leader_model->getLeaderList([
                ['site_id', '=', $this->site_id],
                ['status', 'in', LeaderModel::STATUS_NORMAL . ',' . LeaderModel::STATUS_FREEZE],
                ['order_complete_money', '>', 0]
            ], 'cl_id, name, order_complete_money', 'order_complete_money desc, cl_id asc', '', [], '', 10)['data'],
            // 商品
            'goods'  => $goods_model->getGoodsList([
                ['site_id', '=', $this->site_id],
                ['sale_num', '>', 0]
            ], 'goods_id, goods_name, sale_num', 'sale_num desc, goods_id asc', 10)['data']
        ];
        $this->assign('rank_data', $rank_data);

        return $this->fetch("index/index");
    }

}