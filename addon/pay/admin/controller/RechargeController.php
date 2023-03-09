<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Db;

class RechargeController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function index()
    {
        $search = input('get.search');
        $list = Db::table('recharge')->order('trade_no','desc')->paginate(30);
        if(isset($search) && !empty($search)){
            $list = DB::table('recharge')->where('uid|trade_no', 'like', '%' . $search . '%')->order('trade_no','desc')->paginate(30)->appends(['search' => $search]);
        }
        $fy = $list->render();
        $info = [
            'title' => '充值记录',
            'uinfo' => $this->admin_uinfo,
            'list' => $list,
            'fy' => $fy
        ];
        return view('recharge/index', $info);
    }
}
