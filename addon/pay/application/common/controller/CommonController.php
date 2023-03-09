<?php

namespace app\common\controller;

use think\Controller;
use think\Request;
use Db;

class CommonController extends Controller
{
    function __construct()
    {
        parent::__construct();
        //初始化Cookie
        cookie(['expire' => 3600 * 24 * 30, 'path' => '/']);

        //加载站点配置
        if (cache('conf')) {
            $conf = json_decode(cache('conf'), 1);
            foreach ($conf as $key => $value) {
                config($conf[$key]['k'], $conf[$key]['v']);
            }
        } else {
            $conf = Db::table('config')->select();
            cache('conf', json_encode($conf));
            foreach ($conf as $key => $value) {
                config($conf[$key]['k'], $conf[$key]['v']);
            }
        }

        //后台用户信息
        $admin_token = cookie('admin_token');
        if ($admin_token) {
            $this->admin_uinfo = Db::table('member')->where(['auth' => $admin_token])->find();
        } else {
            $this->admin_uinfo = false;
        }

        //前台用户信息
        $user_uinfo = session('index_user');
        if ($user_uinfo) {
            $this->user_uinfo = Db::table('user')->where('uid', $user_uinfo['uid'])->find();
        } else {
            $this->user_uinfo = NULL;
        }

        //删除一天前所有未支付订单&未支付充值订单
        $today = date("Y-m-d") . ' 00:00:00';
        Db::table('order')->where(['state' => 0])->where('addtime', '<', $today)->delete();
        Db::table('recharge')->where(['state' => 0])->where('addtime', '<', $today)->delete();
    }

    public function admin_login()
    {
        if (!$this->admin_uinfo) {
            $this->error('未登录！', '/' . ADMIN_DIR . '/login.html');
        }
    }
}