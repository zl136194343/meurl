<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use Db;

class LogController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function index()
    {
        $text = input('get.text');
        $list = Db::table('log')->order('id','desc')->paginate(30);
        if(isset($text) && !empty($text)){
            $list = Db::table('log')->whereLike('uid', '%' . $text . '%')->order('id','desc')->paginate(30);
        }
        $fy = $list->render();
        $info = [
            'title' => '资金记录',
            'uinfo' => $this->admin_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('log/index', $info);
    }
}
