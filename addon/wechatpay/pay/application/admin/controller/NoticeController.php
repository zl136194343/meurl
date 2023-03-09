<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Db;

class NoticeController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function list()
    {
        $list = Db::table('notice')->order('pid', 'asc')->select();
        $info = [
            'title'=>'公告列表',
            'uinfo'=>$this->admin_uinfo,
            'list'=>$list
        ];
        return view('notice/index', $info);
    }

    public function edit($id)
    {
        $row = Db::table('notice')->where(['id' => $id])->find();
        if (!$row) return json(['code'=>-1,'msg'=>'非法请求！']);
        $info = [
            'title'=>'公告编辑',
            'uinfo'=>$this->admin_uinfo,
            'row'=>$row
        ];
        return view('notice/edit', $info);
    }

    public function do_edit($id)
    {
        $data = input('post.');
        $row = Db::table('notice')->where(['id' => $id])->update($data);
        if ($row) {
            return json(['code'=>1,'msg'=>'修改成功！']);
        } else {
            return json(['code'=>-1,'msg'=>'修改失败！']);
        }
    }

    public function add()
    {
        $info = [
            'title'=>'添加公告',
            'uinfo'=>$this->admin_uinfo,
        ];
        return view('notice/add', $info);
    }

    public function do_add()
    {
        $data = input('post.');
        $data['date'] = time();
        $row = Db::table('notice')->insert($data);
        if ($row) {
            return json(['code'=>1,'msg'=>'添加成功！']);
        } else {
            return json(['code'=>-1,'msg'=>'添加失败！']);
        }
    }

    public function del($id)
    {
        $row = Db::table('notice')->where(['id' => $id])->delete();
        if ($row) {
            return json(['code'=>1,'msg'=>'删除成功！']);
        } else {
            return json(['code'=>-1,'msg'=>'删除失败！']);
        }
    }
}
