<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use think\Controller;
use Db;

class InviteController extends CommonController
{
    public function index()
    {
        if (config('invite_sw') != 1) $this->error('邀请返利已关闭！');
        //取出一共邀请多少人
        $users = Db::table('user')->where(['s_uid' => $this->user_uinfo['uid']])->count();
        //取出一共获利金额
        $money = Db::table('invite')->where(['s_uid' => $this->user_uinfo['uid']])->sum('money');
        $info = [
            'title' => '邀请返利',
            'uinfo' => $this->user_uinfo,
            'users' => $users,
            'money' => $money
        ];
        return view('invite/index', $info);
    }

    public function invite_user()
    {
        if (config('invite_sw') != 1) $this->error('邀请返利已关闭！');
        $list = Db::table('user')->where(['s_uid' => $this->user_uinfo['uid']])->order('uid', 'desc')->paginate(30);
        $fy = $list->render();
        $info = [
            'title' => '邀请记录',
            'uinfo' => $this->user_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('invite/invite_user', $info);
    }

    public function invite_list()
    {
        if (config('invite_sw') != 1) $this->error('邀请返利已关闭！');
        $list = Db::table('invite')->where(['s_uid' => $this->user_uinfo['uid']])->order('id', 'desc')->paginate(30);
        $fy = $list->render();
        $info = [
            'title' => '返利记录',
            'uinfo' => $this->user_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('invite/invite_list', $info);
    }
}
