<?php

namespace app\admin\controller;

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

    public function index()
    {
        $info = [
            'title' => '后台登录'
        ];
        return view('login/index', $info);
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
        $row = Db::table('member')->where(['username' => $data['username']])->find();
        if (!$row) return json(['code' => -1, 'msg' => '用户不存在！']);
        if (!password_verify($data['password'], $row['password'])) return json(['code' => -1, 'msg' => '密码错误！']);
        $cookie = md5(real_ip() . time());
        Db::table('member')->where(['username' => $row['username']])->update(['auth' => $cookie]);
        cookie('admin_token', $cookie);
        return json(['code' => 1, 'msg' => '登陆成功！']);
    }

    public function logout()
    {
        cookie('admin_token', null);
        return json(['code' => 1, 'msg' => '注销登录成功！']);
    }
}
