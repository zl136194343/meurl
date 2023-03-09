<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use Db;

class IndexController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    //交易流水
    static function order_7()
    {

        $order_one = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00'))
            ->where('state', 1)
            ->sum('money');
        $order_one = round($order_one, 2);
        $order_two = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00'))
            ->where('state', 1)
            ->sum('money');
        $order_two = round($order_two, 2);
        $order_three = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->where('state', 1)
            ->sum('money');
        $order_three = round($order_three, 2);
        $order_four = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->where('state', 1)
            ->sum('money');
        $order_four = round($order_four, 2);
        $order_five = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->where('state', 1)
            ->sum('money');
        $order_five = round($order_five, 2);
        $order_six = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->where('state', 1)
            ->sum('money');
        $order_six = round($order_six, 2);
        $order_seven = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-6day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->where('state', 1)
            ->sum('money');
        $order_seven = round($order_seven, 2);
        $order_7 = "'$order_seven'," . "'$order_six'," . "'$order_five'," . "'$order_four'," . "'$order_three'," . "'$order_two'," . "'$order_one'";
        return $order_7;
    }

    //统计表日期
    static function riqi()
    {
        $date_one = date('m月d日');
        $date_two = date('m月d日', strtotime("-1day"));
        $date_three = date('m月d日', strtotime("-2day"));
        $date_four = date('m月d日', strtotime("-3day"));
        $date_five = date('m月d日', strtotime("-4day"));
        $date_six = date('m月d日', strtotime("-5day"));
        $date_seven = date('m月d日', strtotime("-6day"));
        $riqi = "'$date_seven'," . "'$date_six'," . "'$date_five'," . "'$date_four'," . "'$date_three'," . "'$date_two'," . "'$date_one'";
        return $riqi;
    }

    //新用户
    static function user_xin()
    {
        $user_one = Db::table('user')
            ->where('created_at', '>=', date('Y-m-d 00:00:00'))
            ->count();
        $user_two = Db::table('user')
            ->where('created_at', '<', date('Y-m-d 00:00:00'))
            ->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->count();
        $user_three = Db::table('user')
            ->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->where('created_at', '<', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->count();
        $user_four = Db::table('user')
            ->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->where('created_at', '<', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->count();
        $user_five = Db::table('user')
            ->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->where('created_at', '<', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->count();
        $user_six = Db::table('user')
            ->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->where('created_at', '<', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->count();
        $user_seven = Db::table('user')
            ->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime("-6day")))
            ->where('created_at', '<', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->count();
        $user_7 = "'$user_seven'," . "'$user_six'," . "'$user_five'," . "'$user_four'," . "'$user_three'," . "'$user_two'," . "'$user_one'";
        return $user_7;
    }

    //新入商户
    static function submit()
    {
        $submit_one = Db::table('submit')
            ->where('addtime', '>=', date('Y-m-d 00:00:00'))
            ->count();
        $submit_two = Db::table('submit')
            ->where('addtime', '<', date('Y-m-d 00:00:00'))
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->count();
        $submit_three = Db::table('submit')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->count();
        $submit_four = Db::table('submit')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->count();
        $submit_five = Db::table('submit')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->count();
        $submit_six = Db::table('submit')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->count();
        $submit_seven = Db::table('submit')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-6day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->count();
        $submit_7 = "'$submit_seven'," . "'$submit_six'," . "'$submit_five'," . "'$submit_four'," . "'$submit_three'," . "'$submit_two'," . "'$submit_one'";
        return $submit_7;
    }

    //预存款充值 七天
    static function recharge()
    {
        $recharge_one = Db::table('recharge')
            ->where('addtime', '>', date('Y-m-d 00:00:00'))
            ->where('state', 1)
            ->sum('money');
        $recharge_one = round($recharge_one, 2);
        $recharge_two = Db::table('recharge')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00'))
            ->where('state', 1)
            ->sum('money');
        $recharge_two = round($recharge_two, 2);
        $recharge_three = Db::table('recharge')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->where('state', 1)
            ->sum('money');
        $recharge_three = round($recharge_three, 2);
        $recharge_four = Db::table('recharge')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-2day")))
            ->where('state', 1)
            ->sum('money');
        $recharge_four = round($recharge_four, 2);
        $recharge_five = Db::table('recharge')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-3day")))
            ->where('state', 1)
            ->sum('money');
        $recharge_five = round($recharge_five, 2);
        $recharge_six = Db::table('recharge')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-4day")))
            ->where('state', 1)
            ->sum('money');
        $recharge_six = round($recharge_six, 2);
        $recharge_seven = Db::table('recharge')
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-6day")))
            ->where('addtime', '<', date('Y-m-d 00:00:00', strtotime("-5day")))
            ->where('state', 1)
            ->sum('money');
        $recharge_seven = round($recharge_seven, 2);
        $recharge_7 = "'$recharge_seven'," . "'$recharge_six'," . "'$recharge_five'," . "'$recharge_four'," . "'$recharge_three'," . "'$recharge_two'," . "'$recharge_one'";
        return $recharge_7;
    }

    //已订单支付订单
    static function order_status()
    {
        $order_status = Db::table('order')
            ->where('state', 1)
            ->count();
        return $order_status;
    }

    //未支付订单
    static function order_fail()
    {
        $order_fail = Db::table('order')
            ->where('state', 0)
            ->count();
        return $order_fail;
    }

    //已封禁用户
    static function user_count()
    {
        $user_count = Db::table('user')->count();
        return $user_count;
    }

    public function index()
    {
        //订单数量
        $order = Db::table('order')->count();
        $user = Db::table('user')->count('uprice');
        //全站预存资金
        $num_user = Db::table('user')->sum('uprice');
        $num_user = round($num_user, 2);
        //全站交易流水
        $num_order = Db::table('order')
            ->where('state', 1)
            ->sum('money');
        $num_order = round($num_order, 2);
        //金额排名前十用户
        $user_10 = Db::table('user')->order('uprice', 'desc')->limit(10)->select();
        //统计表日期七天
        $riqi = IndexController::riqi();
        //预存充值七天
        //新用户七天
        $user_xin = IndexController::user_xin();
        //交易流水七天
        $order_7 = IndexController::order_7();
        //新入商户七天
        $submit_xin = IndexController::submit();
        //七天预存金额
        $recharge_7 = IndexController::recharge();
        //已支付订单
        $order_status = IndexController::order_status();
        //未支付订单
        $order_fail = IndexController::order_fail();
        //已封禁用户
        $user_count = IndexController::user_count();
        $info = [
            'title' => '后台管理',
            'uinfo' => $this->admin_uinfo,
            'order' => $order,
            'user' => $user,
            'num_user' => $num_user,
            'num_order' => $num_order,
            'user_10' => $user_10,
            'riqi' => $riqi,
            'order_7' => $order_7,
            'user_xin' => $user_xin,
            'submit_xin' => $submit_xin,
            'recharge_7' => $recharge_7,
            'order_status' => $order_status,
            'order_fail' => $order_fail,
            'user_count' => $user_count,
        ];
        return view('index/index', $info);
    }
}
