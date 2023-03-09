<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use app\common\model\Log;
use think\Controller;
use think\Request;
use Db;

class IndexController extends CommonController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $order = Db::table('order')->where('u_id', $this->user_uinfo['uid'])->count();
        $user = Db::table('user')
            ->alias('u')
            ->join('vip v', 'u.v_id=v.vid')
            ->where('uid', $this->user_uinfo['uid'])
            ->find();
        $order_num = Db::table('order')
            ->where('u_id', $this->user_uinfo['uid'])
            ->where('state', 1)
            ->sum('money');
        $order_num = round($order_num, 2);
        //今日流水
        $order_t = Db::table('order')
            ->where('addtime', '>=', date('Y-m-d 00:00:00'))
            ->where('u_id', $this->user_uinfo['uid'])
            ->where('state', 1)
            ->sum('money');
        $order_t = round($order_t);
        //昨日流水
        $order_y = Db::table('order')
            ->where('addtime', '<', date('Y-m-d 00:00:00'))
            ->where('addtime', '>=', date('Y-m-d 00:00:00', strtotime("-1day")))
            ->where('u_id', $this->user_uinfo['uid'])
            ->where('state', 1)
            ->sum('money');
        $order_y = round($order_y, 2);
        if ($user['v_id'] !== 0) {
            $rate_y = round($order_y * $user['wx_rate'] / 100, 2);
            $rate_t = round($order_t * $user['wx_rate'] / 100, 2);
        } else {
            $rate_y = round($order_y * config('wx_default_rate') / 100, 2);
            $rate_t = round($order_t * config('wx_default_rate') / 100, 2);
        }

        //取出公告
        $notice = Db::table('notice')->order('pid', 'asc')->select();

        $info = [
            'title' => '用户中心',
            'uinfo' => $this->user_uinfo,
            'order' => $order,
            'user' => $user,
            'order_num' => $order_num,
            'order_y' => $order_y,
            'order_t' => $order_t,
            'rate_y' => $rate_y,
            'rate_t' => $rate_t,
            'notice' => $notice
        ];
        return view('index/index', $info);
    }

    public function look_notice($id)
    {
        $info = Db::table('notice')->where(['id' => $id])->find();
        if (!$info) return json(['code' => -1, 'msg' => '公告不存在！']);
        $info['code'] = 1;
        $info['date'] = date('Y-m-d H:i:s', $info['date']);
        //增加阅读次数
        $look = $info['look'] + 1;
        Db::table('notice')->where(['id' => $id])->update(['look' => $look]);
        return json($info);
    }

    public function vip()
    {
        $vip = Db::table('vip')->select();
        return view('/vip/index', ['title' => '办理会员', 'uinfo' => $this->user_uinfo, 'vip' => $vip]);
    }

    public function do_vip()
    {
        $id = input('post.vid');
        $vip = Db::table('vip')->where('vid', $id)->find();
        if ($this->user_uinfo['v_id'] != 0) {
            $date = date('Y-m-d', time());
            $date_expire = date('Y-m-d', strtotime("+1 months", strtotime(date('Ymd'))));
            //减去用户余额
            if ($this->user_uinfo['uprice'] != 0) {
                if ($id == $this->user_uinfo['v_id']) {
                    if ($this->user_uinfo['uprice'] - $vip['price'] < 0) return json(['code' => -1, 'msg' => '余额不足,请充值']);
                    $date_renew = date('Y-m-d', strtotime("+1 months", strtotime($this->user_uinfo['v_time_expire'])));
                    $price = $this->user_uinfo['uprice'] - $vip['price'];
                    Db::table('user')->where('uid', $this->user_uinfo['uid'])->update(['v_time_expire' => $date_renew, 'uprice' => $price]);
                    Log::create(['uid' => $this->user_uinfo['uid'], 'msg' => '续费VIP消费' . $vip['price'] . '元', 'time' => date('Y-m-d H:i:s')]);
                    return json(['code' => 1, 'msg' => '续费成功,消费' . $vip['price'] . '元']);
                }
                $user_vip = Db::table('vip')->where('vid', $this->user_uinfo['v_id'])->find();
                if ($user_vip['price'] > $vip['price']) {
                    return json(['code' => -1, 'msg' => '当前VIP等级大于所选VIP等级']);
                } else {
                    $date_1 = $this->user_uinfo['v_time_expire'];
                    $date_2 = date('Y-m-d');
                    $Date_List_a1 = explode("-", $date_1);
                    $Date_List_a2 = explode("-", $date_2);
                    $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);
                    $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);
                    $Days = round(($d1 - $d2) / 3600 / 24);
                    $cha = round($vip['price'] / date('t', strtotime(date('Y-m'))) * $Days, 2);

                    if ($this->user_uinfo['uprice'] - $cha < 0) {
                        return json(['code' => -1, 'msg' => '余额不足,请充值']);
                    } else {
                        $price = $this->user_uinfo['uprice'] - $cha;
                        Db::table('user')->where('uid', $this->user_uinfo['uid'])->update(['v_id' => $id, 'uprice' => $price]);
                        Log::create(['uid' => $this->user_uinfo['uid'], 'msg' => '升级VIP消费' . $cha . '元', 'time' => date('Y-m-d H:i:s')]);
                        return json(['code' => 1, 'msg' => '升级成功,消费' . $cha . '元']);
                    }
                }
            } else {
                return json(['code' => -1, 'msg' => '当前余额为0,请先充值余额']);
            }
        } else {
            $date = date('Y-m-d', time());
            $date_expire = date('Y-m-d', strtotime("+1 months", strtotime(date('Ymd'))));
            //减去用户余额
            if ($this->user_uinfo['uprice'] != 0) {
                if ($this->user_uinfo['uprice'] - $vip['price'] < 0) {
                    return json(['code' => -1, 'msg' => '余额不足,请充值']);
                } else {
                    $price = $this->user_uinfo['uprice'] - $vip['price'];
                    $data = ['uprice' => $price,
                        'v_id' => $id,
                        'v_time' => $date,
                        'v_time_expire' => $date_expire];
                    Db::table('user')->where('uid', $this->user_uinfo['uid'])->update($data);
                    Log::create(['uid' => $this->user_uinfo['uid'], 'msg' => '开通VIP消费' . $vip['price'] . '元', 'time' => date('Y-m-d H:i:s')]);
                    return json(['code' => 1, 'msg' => '购买成功消费' . $vip['price'] . '元']);
                }
            } else {
                return json(['code' => -1, 'msg' => '当前余额为0,请先充值余额']);
            }
        }
    }


    public function info()
    {
        $user = Db::table('user')
            ->alias('u')
            ->join('vip v', 'u.v_id=v.vid')
            ->where('uid', $this->user_uinfo['uid'])
            ->find();
        return view('/info/index', ['title' => '个人资料', 'uinfo' => $this->user_uinfo, 'user' => $user]);
    }

    public function do_info()
    {
        $data = input('post.');
        if (empty($data['upwd']) || empty($data['email']) || empty($data['qq'])) return json(['code' => -1, 'msg' => '请确保各项不为空']);
        if (!preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/', $data['email'])) return json(['code' => -1, 'msg' => '邮箱格式错误']);//验证邮箱
        if (!preg_match('/^\d{5,10}$/', $data['qq'])) return json(['code' => -1, 'msg' => 'QQ号码格式错误']);//验证QQ
        $res = Db::table('user')->where('uid', $this->user_uinfo['uid'])->find();
        $email_row = Db::table('user')->where('email', $data['email'])->find();
        if ($email_row) {
            if ($email_row['email'] !== $res['email']) return json(['code' => -1, 'msg' => '邮箱已存在']);
        }
        $qq_row = Db::table('user')->where('qq', $data['qq'])->find();
        if ($qq_row) {
            if ($qq_row['qq'] !== $res['qq']) return json(['code' => -1, 'msg' => 'QQ已存在']);
        }
        if ($data['token'] !== $res['token']) return json(['code' => -1, 'msg' => '验证失败']);
        $user_data = ['qq' => $data['qq'], 'email' => $data['email']];
        if ($data['upwd'] !== $res['upwd']) {
            if (!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/', $data['upwd'])) return json(['code' => -1, 'msg' => '密码格式不正确']);//须包含字母和数字，且长度在6-20之间
            $user_data['upwd'] = password_hash($data['upwd'], PASSWORD_DEFAULT);
        }
        $row = Db::table('user')->where('uid', $this->user_uinfo['uid'])->update($user_data);
        if ($row) {
            return json(['code' => 1, 'msg' => '修改成功']);
        } else {
            return json(['code' => -1, 'msg' => '修改失败']);
        }

    }

    public function docking()
    {
        return view('/token/index', ['title' => 'Token获取', 'uinfo' => $this->user_uinfo]);
    }

    public function do_docking()
    {
        $docking = md5(uniqid(microtime(true), true));
        if (cookie($this->user_uinfo['uid'])) return json(['code' => -1, 'msg' => '获取频繁,请十分钟后重试']);
        cookie($this->user_uinfo['uid'], true, 600);
        $res = Db::table('user')->where('uid', $this->user_uinfo['uid'])->update(['docking' => $docking]);
        if ($res) {
            return json(['code' => 1, 'msg' => '获取成功', 'docking' => $docking]);
        } else {
            return json(['code' => -1, 'msg' => '获取失败']);
        }
    }

    //订单列表
    public function order()
    {
        $order = Db::table('order')->where('u_id', $this->user_uinfo['uid'])->select();
        return view('/order/index', ['title' => '订单列表', 'order' => $order]);
    }
}
