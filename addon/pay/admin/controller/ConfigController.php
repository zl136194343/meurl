<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use Db;

class ConfigController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function index()
    {
        $info = [
            'title' => '基本配置',
            'uinfo' => $this->admin_uinfo
        ];
        return view('config/index', $info);
    }

    public function yz_config()
    {
        $info = [
            'title' => '验证配置',
            'uinfo' => $this->admin_uinfo
        ];
        return view('config/yz_config', $info);
    }

    public function email_config()
    {
        $info = [
            'title' => '邮件配置',
            'uinfo' => $this->admin_uinfo
        ];
        return view('config/email_config', $info);
    }

    public function invite_config()
    {
        $info = [
            'title' => '邀请配置',
            'uinfo' => $this->admin_uinfo
        ];
        return view('config/invite_config', $info);
    }

    public function wx_config()
    {
        $info = [
            'title' => '微信配置',
            'uinfo' => $this->admin_uinfo
        ];
        return view('config/wx_config', $info);
    }

    public function ali_config()
    {
        $info = [
            'title' => '支付宝配置',
            'uinfo' => $this->admin_uinfo
        ];
        return view('config/ali_config', $info);
    }

    public function do_config()
    {
        $data = input('post.');
        foreach ($data as $k => $v) {
            if (Db::table('config')->where('k', $k)->find()) {
                $new = false;
            } else {
                $new = true;
            }
            if ($new) {
                Db::table('config')->insert(['k' => $k, 'v' => $v]);
            } else {
                Db::table('config')->update(['k' => $k, 'v' => $v]);
            }
        }
        cache('conf', null);
        return json(['code' => 1, 'msg' => '修改成功！']);
    }
}
