<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Db;
use Yansongda\Pay\Pay;

class OrderController extends CommonController
{
    public function order()
    {
        $data = input();
        $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->order('trade_no', 'desc')->paginate(30);
        //定义开始时间和结束时间搜索
        if (isset($data['starttime']) && !empty($data['starttime']) && isset($data['stoptime']) && !empty($data['stoptime'])) {
            $data['starttime'] = $data['starttime'] . ' 00:00:00';
            $data['stoptime'] = $data['stoptime'] . ' 00:00:00';
            if ($data['starttime'] < $data['stoptime']) {
                $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->where('addtime', '>=', $data['starttime'])->where('addtime', '<', $data['stoptime'])->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime']]);
                //通过订单号搜索
                if (isset($data['trade_no']) && !empty($data['trade_no'])) {
                    $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('trade_no', '%' . $data['trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'trade_no' => $data['trade_no']]);
                }
                //通过商户订单号搜索
                if (isset($data['out_trade_no']) && !empty($data['out_trade_no'])) {
                    $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('out_trade_no', '%' . $data['out_trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'out_trade_no' => $data['out_trade_no']]);
                }
                //通过商户号搜索
                if (isset($data['mchid']) && !empty($data['mchid'])) {
                    $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('mchid', '%' . $data['mchid'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'mchid' => $data['mchid']]);
                }
                //通过商品名称搜索
                if (isset($data['name']) && !empty($data['name'])) {
                    $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('o_name', '%' . $data['name'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['starttime' => $data['starttime'], 'stoptime' => $data['stoptime'], 'name' => $data['name']]);
                }
            }
        }
        //通过订单号搜索
        if (isset($data['trade_no']) && !empty($data['trade_no'])) {
            $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('trade_no', '%' . $data['trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['trade_no' => $data['trade_no']]);
        }
        //通过商户订单号搜索
        if (isset($data['out_trade_no']) && !empty($data['out_trade_no'])) {
            $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('out_trade_no', '%' . $data['out_trade_no'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['out_trade_no' => $data['out_trade_no']]);
        }
        //通过商户号搜索
        if (isset($data['mchid']) && !empty($data['mchid'])) {
            $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('mchid', '%' . $data['mchid'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['mchid' => $data['mchid']]);
        }
        //通过商品名称搜索
        if (isset($data['name']) && !empty($data['name'])) {
            $list = Db::table('order')->where(['u_id' => $this->user_uinfo['uid']])->whereLike('o_name', '%' . $data['name'] . '%')->order('trade_no', 'desc')->paginate(30)->appends(['name' => $data['name']]);
        }
        $fy = $list->render();
        $info = [
            'title' => '订单列表',
            'uinfo' => $this->user_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('order/index', $info);
    }

    public function tui_order()
    {
        $trade_no = input('get.trade_no');
        if (!isset($trade_no) || empty($trade_no)) return json(['code' => -1, 'msg' => '订单号不能为空！']);
        $order = Db::table('order')->where(['trade_no' => $trade_no])->order('trade_no', 'desc')->find();
        if (!$order) return json(['code' => -1, 'msg' => '订单不存在！']);
        if ($order['state'] == 2) return json(['code' => -1, 'msg' => '订单已全额退款！']);
        $config = [
            'app_id' => config('wx_appid'),
            'mch_id' => config('wx_mchid'),
            'key' => config('wx_key'),
            'sub_mch_id' => $order['mchid'],
            'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/api/wx_notify.html',
            'cert_client' => config('wx_cert_path'),
            'cert_key' => config('wx_key_path'),
            'mode' => 'service',
        ];
        $order = [
            'out_trade_no' => $order['trade_no'],
            'out_refund_no' => time(),
            'total_fee' => $order['money'] * 100,
            'refund_fee' => $order['money'] * 100,
            'refund_desc' => '退款',
        ];
        $result = Pay::wechat($config)->refund($order);
        $res = json_decode($result, 1);
        if ($res['return_code'] == 'SUCCESS' && $res['return_msg'] == 'OK' && $res['result_code'] == 'SUCCESS') {
            $row = Db::table('order')->where(['trade_no' => $trade_no])->update(['state' => 2]);
            if (!$row) return json(['code' => -1, 'msg' => '退款失败！']);
            return json(['code' => 1, 'msg' => '退款成功！']);
        }
        return json(['code' => -1, 'msg' => '退款失败！']);
    }
}
