<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Db;

class OrderController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function order()
    {
        $data = input();
        $list = Db::table('order')->order('trade_no', 'desc')->paginate(30);
        //定义开始时间和结束时间搜索
        if (isset($data['starttime']) && !empty($data['starttime']) && isset($data['stoptime']) && !empty($data['stoptime'])) {
            $data['starttime'] = $data['starttime'] . ' 00:00:00';
            $data['stoptime'] = $data['stoptime'] . ' 00:00:00';
            if ($data['starttime'] < $data['stoptime']) {
                $list = Db::table('order')->where('addtime', '>=', $data['starttime'])->where('addtime', '<', $data['stoptime'])->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime']]);
                //通过订单号搜索
                if (isset($data['trade_no']) && !empty($data['trade_no'])) {
                    $list = Db::table('order')->whereLike('trade_no', '%' . $data['trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'trade_no' => $data['trade_no']]);
                }
                //通过商户订单号搜索
                if (isset($data['out_trade_no']) && !empty($data['out_trade_no'])) {
                    $list = Db::table('order')->whereLike('out_trade_no', '%' . $data['out_trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'out_trade_no' => $data['out_trade_no']]);
                }
                //通过商户号搜索
                if (isset($data['mchid']) && !empty($data['mchid'])) {
                    $list = Db::table('order')->whereLike('mchid', '%' . $data['mchid'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'mchid' => $data['mchid']]);
                }
                //通过商品名称搜索
                if (isset($data['name']) && !empty($data['name'])) {
                    $list = Db::table('order')->whereLike('o_name', '%' . $data['name'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'name' => $data['name']]);
                }
                //通过商户ID搜索
                if (isset($data['u_id']) && !empty($data['u_id'])) {
                    $list = Db::table('order')->whereLike('u_id', '%' . $data['u_id'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'u_id' => $data['u_id']]);
                }
            }
        }
        //通过订单号搜索
        if (isset($data['trade_no']) && !empty($data['trade_no'])) {
            $list = Db::table('order')->whereLike('trade_no', '%' . $data['trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['trade_no' => $data['trade_no']]);
        }
        //通过商户订单号搜索
        if (isset($data['out_trade_no']) && !empty($data['out_trade_no'])) {
            $list = Db::table('order')->whereLike('out_trade_no', '%' . $data['out_trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['out_trade_no' => $data['out_trade_no']]);
        }
        //通过商户号搜索
        if (isset($data['mchid']) && !empty($data['mchid'])) {
            $list = Db::table('order')->whereLike('mchid', '%' . $data['mchid'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['mchid' => $data['mchid']]);
        }
        //通过商品名称搜索
        if (isset($data['name']) && !empty($data['name'])) {
            $list = Db::table('order')->whereLike('o_name', '%' . $data['name'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['name' => $data['name']]);
        }
        //通过商户ID搜索
        if (isset($data['u_id']) && !empty($data['u_id'])) {
            $list = Db::table('order')->whereLike('u_id', '%' . $data['u_id'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['u_id' => $data['u_id']]);
        }
        $fy = $list->render();
        $info = [
            'title' => '订单列表',
            'uinfo' => $this->admin_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('order/index', $info);
    }
}
