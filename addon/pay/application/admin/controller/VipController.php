<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Db;

class VipController extends CommonController
{

    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function create()
    {
        return view('vip/create', ['title' => '添加会员等级', 'uinfo' => $this->admin_uinfo]);
    }

    public function insert()
    {
        $vname = input('post.vname');
        $vprice = input('post.vprice');
        $price = input('post.price');
        $wx_rate = input('post.wx_rate');
        $info = input('post.info');

        if (empty($vname) || empty($vprice) || empty($price) || empty($wx_rate) || empty($info)) return json('请确保各项不为空');

        $data = ['vname' => $vname, 'vprice' => $vprice, 'price' => $price, 'wx_rate' => $wx_rate, 'info' => $info];


        $res = Db::table('vip')->insert($data);

        if ($res) {
            return json('添加成功');
        } else {
            return json('添加失败');
        }
    }

    public function index()
    {
        $vip = Db::table('vip')->select();
        return view('/vip/index', ['title' => '会员列表', 'vip' => $vip, 'uinfo' => $this->admin_uinfo]);
    }

    public function edit($id)
    {
        $vip = Db::table('vip')->where('vid', $id)->find();
        return view('/vip/edit', ['title' => '会员信息修改', 'vip' => $vip, 'uinfo' => $this->admin_uinfo]);
    }

    public function update()
    {
        $vid = input('post.vid');
        $vname = input('post.vname');
        $vprice = input('post.vprice');
        $price = input('post.price');
        $wx_rate = input('post.wx_rate');
        $info = input('post.info');
        if (empty($vname) || empty($vprice) || empty($price) || empty($wx_rate) || empty($info)) return json('请确保各项不能为空');

        $data = ['vname' => $vname, 'vprice' => $vprice, 'price' => $price, 'wx_rate' => $wx_rate, 'info' => $info];

        $res = Db::table('vip')->where('vid', $vid)->update($data);

        if ($res) {
            return json('修改成功');
        } else {
            return json('修改失败');
        }
    }

    public function delete()
    {
        $vid = input('post.vid');
        $res = Db::table('vip')->where('vid', $vid)->delete();
        if ($res) {
            Db::table('user')->where('v_id', $vid)->update(['v_id' => 0]);
            return json('删除成功');
        } else {
            return json('删除失败');
        }
    }
}
