<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use think\Controller;
use Db;

class MemberController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function index()
    {
        $list = Db::table('member')->select();
        $info = [
            'uinfo' => $this->admin_uinfo,
            'list' => $list,
            'title' => '管理员列表'
        ];
        return view('member/index', $info);
    }

    public function del($id)
    {
        if ($id == $this->admin_uinfo['id']) return json(['code' => -1, 'msg' => '自己删自己，脑壳瓦特了？']);
        $row = Db::table('member')->where(['id' => $id])->delete();
        if (!$row) return json(['code' => -1, 'msg' => '删除失败！']);
        return json(['code' => 1, 'msg' => '删除成功！']);
    }

    public function add()
    {
        $info = [
            'uinfo' => $this->admin_uinfo,
            'title' => '管理员添加'
        ];
        return view('member/add', $info);
    }

    public function do_add()
    {
        $data = input('post.');
        if (!isset($data['username']) || empty($data['username']) || !isset($data['password']) || empty($data['password']) || !isset($data['qq']) || empty($data['qq']) || !isset($data['email']) || empty($data['email'])) return json(['code' => -1, 'msg' => '请确保每项不为空！']);
        if (!preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/', $data['email'])) return json(['code' => -1, 'msg' => '邮箱格式不正确！']);
        if (strlen($data['qq']) < 5 || strlen($data['qq']) > 11) return json(['code' => -1, 'msg' => 'QQ格式不正确！']);
        $row = Db::table('member')->where(['username' => $data['username']])->find();
        if ($row) return json(['code' => -1, 'msg' => '此用户名已存在！']);
        $row = Db::table('member')->where(['qq' => $data['qq']])->find();
        if ($row) return json(['code' => -1, 'msg' => '此QQ已存在！']);
        $row = Db::table('member')->where(['email' => $data['email']])->find();
        if ($row) return json(['code' => -1, 'msg' => '此邮箱已存在！']);
        $arr = [
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'qq' => $data['qq'],
            'email' => $data['email'],
            'addtime' => date('Y-m-d H:i:s')
        ];
        $row = Db::table('member')->insert($arr);
        if (!$row) return json(['code' => -1, 'msg' => '添加失败！']);
        return json(['code' => 1, 'msg' => '添加成功！']);
    }

    public function edit($id)
    {
        $row = Db::table('member')->where(['id' => $id])->find();
        if (!$row) {
            $this->error('管理员不存在！');
        }
        unset($row['password']);
        $info = [
            'uinfo' => $this->admin_uinfo,
            'title' => '管理员编辑',
            'info' => $row
        ];
        return view('member/edit', $info);
    }

    public function do_edit($id)
    {
        $info = Db::table('member')->where(['id' => $id])->find();
        if (!$info) return json(['code' => -1, 'msg' => '管理员不存在！']);
        $data = input('post.');
        if (!isset($data['username']) || empty($data['username']) || !isset($data['qq']) || empty($data['qq']) || !isset($data['email']) || empty($data['email'])) return json(['code' => -1, 'msg' => '请确保必填项不为空！']);
        if (!preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/', $data['email'])) return json(['code' => -1, 'msg' => '邮箱格式不正确！']);
        if (strlen($data['qq']) < 5 || strlen($data['qq']) > 11) return json(['code' => -1, 'msg' => 'QQ格式不正确！']);
        $arr = [
            'username' => $data['username'],
            'qq' => $data['qq'],
            'email' => $data['email']
        ];
        if (isset($data['password']) && !empty($data['password'])) {
            $arr['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $row = Db::table('member')->where(['username' => $data['username']])->find();
        if ($row) {
            if ($row['username'] != $info['username']) return json(['code' => -1, 'msg' => '此用户名已存在！']);
        }
        $row = Db::table('member')->where(['qq' => $data['qq']])->find();
        if ($row) {
            if ($row['qq'] != $info['qq']) return json(['code' => -1, 'msg' => '此QQ已存在！']);
        }
        $row = Db::table('member')->where(['email' => $data['email']])->find();
        if ($row) {
            if ($row['email'] != $info['email']) return json(['code' => -1, 'msg' => '此邮箱已存在！']);
        }
        $row = Db::table('member')->where(['id' => $id])->update($arr);
        if (!$row) return json(['code' => -1, 'msg' => '修改失败！']);
        return json(['code' => 1, 'msg' => '修改成功！']);
    }
}
