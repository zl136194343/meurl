<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Db;

class SubmitController extends CommonController
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
        $search = trim($search);
        $submit = Db::table('submit')
            ->alias('s')
            ->join(['user'=>'u'], 's.u_id=u.uid')
            ->where('s.sid|s.id_card_name|s.merchant_shortname|u.uname|s.contact_phone', 'like', '%' . $search . '%')
            ->order('sid', 'desc')
            ->paginate(30, false, ['query' => ['search' => $search]]);
        return view('/submit/index', ['title' => '商户列表', 'uinfo' => $this->admin_uinfo, 'submit' => $submit]);
    }
}
