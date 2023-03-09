<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use app\common\model\Log;
use think\Controller;
use think\Request;
use Db;
use Nb_Pay\Nb_Pay;

class RechargeController extends CommonController
{
    public function index()
    {
        $info = [
            'title' => '余额充值',
            'uinfo' => $this->user_uinfo,
        ];
        return view('recharge/index', $info);
    }

    public function do()
    {
        $money = input('post.money');
        if (!is_numeric($money) || $money <= 0) $this->error('金额不合法！');
        $money = round($money, 2);
        $trade_no = date("YmdHis") . rand(11111, 99999);
        $arr = [
            'trade_no' => $trade_no,
            'uid' => $this->user_uinfo['uid'],
            'money' => $money,
            'addtime' => date('Y-m-d H:i:s')
        ];
        $row = Db::table('recharge')->insert($arr);
        if (!$row) $this->error('订单发起失败！');
        if (checkmobile()) {
            $pay = new Nb_Pay('12', '35caee203fe70164468c260b482b2130');
            $code_url = $pay->mp_pay($trade_no, config('sitename') . '充值余额', $money, 'http://' . $_SERVER['HTTP_HOST'] . '/recharge_notify.html', '1551598641');
            $m = 1;
        } else {
            $pay = new Nb_Pay('12', '35caee203fe70164468c260b482b2130');
            $code_url = $pay->scan_pay($trade_no, config('sitename') . '充值余额', $money, 'http://' . $_SERVER['HTTP_HOST'] . '/recharge_notify.html', '1551598641');
            if (!$code_url) $this->error('发起支付失败！');
            $m = 0;
        }
        $info = [
            'title' => '订单支付',
            'uinfo' => $this->user_uinfo,
            'code_url' => $code_url,
            'm' => $m,
            'trade_no' => $trade_no
        ];
        return view('recharge/pay', $info);
    }

    public function notify()
    {
        $data = input();
        $pay = new Nb_Pay('12', '35caee203fe70164468c260b482b2130');
        if ($pay->verify($data)) {
            if ($data['trade_status'] == 'TRADE_SUCCESS') {
                $order = Db::table('recharge')->where(['trade_no' => $data['out_trade_no']])->find();
                if (!$order) exit('fail');
                if ($order['state'] != 1) {
                    Db::table('recharge')->where(['trade_no' => $data['out_trade_no']])->update(['state' => 1, 'endtime' => date('Y-m-d H:i:s')]);
                    //查询用户
                    $u = Db::table('user')->where(['uid' => $order['uid']])->find();
                    Log::create(['uid' => $order['uid'], 'msg' => '在线充值余额' . $order['money'] . '元', 'time' => date('Y-m-d H:i:s')]);
                    //处理返利
                    if (config('invite_sw') == 1) {
                        if ($u['s_uid']) {
                            //给上级加款
                            $su = Db::table('user')->where(['uid' => $u['s_uid']])->find();
                            $su['money'] = $su['uprice'] + round($order['money'] * (config('invite_rate') / 100), 2);
                            Db::table('user')->where(['uid' => $u['s_uid']])->update(['uprice' => $su['money']]);
                            //返利记录
                            Db::table('invite')->insert(['uid' => $u['uid'], 's_uid' => $su['uid'], 'money' => round($order['money'] * (config('invite_rate') / 100), 2), 'time' => date('Y-m-d H:i:s')]);
                            //资金记录
                            Log::create(['uid' => $su['uid'], 'msg' => '下级用户UID[' . $u['uid'] . ']充值返利' . (round($order['money'] * (config('invite_rate') / 100), 2)) . '元', 'time' => date('Y-m-d H:i:s')]);
                        }
                    }
                    $money = $u['uprice'] + $order['money'];
                    Db::table('user')->where(['uid' => $order['uid']])->update(['uprice' => $money]);
                }
                exit('success');
            } else {
                exit('fail');
            }
        } else {
            exit('fail');
        }
    }

    public function getshop()
    {
        $trade_no = input('get.trade_no');
        if (!isset($trade_no) || empty($trade_no)) return json(['code' => -1, 'msg' => '订单号不能为空！']);
        $order = Db::table('recharge')->where(['trade_no' => $trade_no])->find();
        if (!$order) return json(['code' => -1, 'msg' => '订单不存在！']);
        if ($order['state'] != 1) return json(['code' => -1, 'msg' => '未支付！']);
        return json(['code' => 1, 'msg' => '支付成功！']);
    }

    public function list()
    {
        $lsit = Db::table('recharge')->where(['uid' => $this->user_uinfo['uid']])->limit('50')->order('trade_no', 'desc')->select();
        $info = [
            'title' => '充值记录',
            'uinfo' => $this->user_uinfo,
            'list' => $lsit
        ];
        return view('recharge/list', $info);
    }
}
