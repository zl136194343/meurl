<?php

namespace app\user\controller;

use app\common\controller\CommonController;
use think\Controller;
use Db;

class LogController extends CommonController
{
    public function index()
    {
        $list = Db::table('log')->where(['uid' => $this->user_uinfo['uid']])->order('id', 'desc')->paginate(30);
        $fy = $list->render();
        $info = [
            'title' => '资金记录',
            'uinfo' => $this->user_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('log/index', $info);
    }
}
