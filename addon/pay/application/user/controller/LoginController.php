<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use Geetest\Geetest;
use think\Controller;
use think\Request;
use Db;

class LoginController extends CommonController
{
    function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        //判断是否登录
        if (session('login_user')) {
            return redirect('/user/index');
        }
        return view('/login/index', ['title' => '登录']);
    }

    public function do_login()
    {
        $data = input('post.');
        $GtSdk = new Geetest(config('captcha_id'), config('private_key'));
        $gdata = array("user_id" => 'public', "client_type" => "web", "ip_address" => $_SERVER['REMOTE_ADDR']);
        if (session('gtserver') == 1) {
            $result = $GtSdk->success_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'], $gdata);
            if ($result) {
                $geetest = true;
            } else {
                $geetest = false;
            }
        } else {
            if ($GtSdk->fail_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'])) {
                $geetest = true;
            } else {
                $geetest = false;
            }
        }
        if (!$geetest) return json(['code' => -1, 'msg' => '请先完成滑动验证！']);
        if (!isset($data['username']) || !isset($data['password'])) return json(['code' => -1, 'msg' => '请确保每项不为空！']);
        $user = Db::table('user')->where('uname', $data['username'])->find();
        if (!$user) return json(['code' => -1, 'msg' => '账号或密码错误']);
        if ($user['status'] == 0) return json(['code' => -1, 'msg' => '用户已被封禁!']);
        if (password_verify($data['password'], $user['upwd'])) {
            session('index_user', $user);
            session('login_user', true);
            return json(['code' => 1, 'msg' => '登录成功']);
        } else {
            return json(['code' => -1, 'msg' => '账号或密码错误']);
        }
    }

    public function logout()
    {
        session('login_user', false);
        session('index_user', false);
        return json(['code' => 1, 'msg' => '已退出登录']);
    }

    public function reg()
    {
        //判断是否登录
        if (session('login_user')) {
            return redirect('/user/index');
        }

        return view('/login/reg', ['title' => '注册']);
    }

    public function do_reg()
    {
        $data = input('post.');
        $GtSdk = new Geetest(config('captcha_id'), config('private_key'));
        $gdata = array("user_id" => 'public', "client_type" => "web", "ip_address" => $_SERVER['REMOTE_ADDR']);
        if (session('gtserver') == 1) {
            $result = $GtSdk->success_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'], $gdata);
            if ($result) {
                $geetest = true;
            } else {
                $geetest = false;
            }
        } else {
            if ($GtSdk->fail_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'])) {
                $geetest = true;
            } else {
                $geetest = false;
            }
        }
        if (!$geetest) return json(['code' => -1, 'msg' => '请先完成滑动验证！']);
        if (empty($data['username']) || empty($data['password']) || empty($data['email']) || empty($data['qq'])) return json(['code' => -1, 'msg' => '请确保各项不为空']);
        if (!preg_match('/^[a-zA-z]\w{3,15}$/', $data['username'])) return json(['code' => -1, 'msg' => '用户名格式不正确']);//字母,数字,下划线组成,字母开头,4-16位
        if (!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/', $data['password'])) return json(['code' => -1, 'msg' => '密码格式不正确']);//须包含字母和数字，且长度在6-20之间
        if (!preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/', $data['email'])) return json(['code' => -1, 'msg' => '邮箱格式错误']);//验证邮箱
        if (!preg_match('/^\d{5,10}$/', $data['qq'])) return json(['code' => -1, 'msg' => 'QQ号码格式错误']);//验证QQ
        $uname_res = Db::table('user')->where('uname', $data['username'])->find();
        if ($uname_res) return json(['code' => -1, 'msg' => '用户名已存在']);
        $email_res = Db::table('user')->where('email', $data['email'])->find();
        if ($email_res) return json(['code' => -1, 'msg' => '邮箱已存在']);
        $qq_res = Db::table('user')->where('qq', $data['qq'])->find();
        if ($qq_res) return json(['code' => -1, 'msg' => 'QQ已存在']);
        $date = date('YmdHis', time());
        $token = password_hash(rand(1000, 10000), PASSWORD_DEFAULT);
        $upwd = password_hash($data['password'], PASSWORD_DEFAULT);
        $row = ['uname' => $data['username'], 'upwd' => $upwd, 'email' => $data['email'], 'qq' => $data['qq'], 'created_at' => $date, 'token' => $token];
        //邀请开始
        if (config('invite_sw') == 1) {
            $sid = input('get.id');
            if (isset($sid) && !empty($sid)) {
                $su = Db::table('user')->where(['uid' => $sid])->find();
                if ($su) {
                    $row['s_uid'] = $sid;
                }
                cookie('s_uid', $sid);
            }
            //防止用户东看西看导致邀请失败
            if (cookie('s_uid')) {
                $sid = cookie('s_uid');
                $su = Db::table('user')->where(['uid' => $sid])->find();
                if ($su) {
                    $row['s_uid'] = $sid;
                }
            }
        }
        $res = Db::table('user')->insertGetId($row);
        if ($res) {
            $user = Db::table('user')->where('uid', $res)->find();
            session('login_user', true);
            session('index_user', $user);
            return json(['code' => 1, 'msg' => '注册成功']);
        } else {
            return json(['code' => -1, 'msg' => '注册失败']);
        }
    }
}
