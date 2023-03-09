<?php

namespace app\admin\controller;

use app\common\controller\CommonController;
use app\common\model\Log;
use think\Controller;
use think\Request;
use Db;

class UserController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        //调用验证登录
        parent::admin_login();
    }

    public function create()
    {
        $vip = Db::table('vip')->select();
        return view('/user/create', ['title' => '添加用户', 'uinfo' => $this->admin_uinfo, 'vip' => $vip]);
    }

    public function insert()
    {
        $uname = input('post.uname');
        $upwd = input('post.upwd');
        $email = input('post.email');
        $qq = input('post.qq');
        $vid = input('post.v_id');
        $v_time_expire = input('post.v_time_expire');

        if (empty($uname) || empty($upwd) || empty($email) || empty($qq) || empty($vid) || empty($v_time_expire)) return json('请确保各项不为空');

        $upwd = password_hash($upwd, PASSWORD_DEFAULT);
        $token = password_hash(rand(1000, 10000), PASSWORD_DEFAULT);
        $created_at = date('YmdHis', time());

        $uname_res = Db::table('user')->where('uname', $uname)->find();
        if (!empty($uname_res)) return json('用户名已存在');
        $email_res = Db::table('user')->where('email', $email)->find();
        if (!empty($email_res)) return json('邮箱已存在');
        $qq_res = Db::table('user')->where('qq', $qq)->find();
        if (!empty($qq_res)) return json('qq已存在');

        $data = ['uname' => $uname,
            'upwd' => $upwd,
            'email' => $email,
            'qq' => $qq,
            'token' => $token,
            'created_at' => $created_at,
            'v_time_expire' => $v_time_expire,
            'v_id' => $vid];

        $res = Db::table('user')->insert($data);
        if ($res) {
            return json('添加成功');
        } else {
            return json('修改失败');
        }
    }

    public function index()
    {
        $search = input('get.search');
        $user = Db::table('user')
            ->alias('u')
            ->join(['vip' => 'v'], 'u.v_id=v.vid')
            ->order('created_at', 'desc')
            ->where('u.uname|u.qq|u.email|u.uid', 'like', '%' . $search . '%')
            ->paginate(30, false, ['query' => ['search' => $search]]);
        return view('/user/index', ['title' => '用户列表', 'uinfo' => $this->admin_uinfo, 'user' => $user]);
    }

    public function edit($id)
    {
        $token = input('get.token');
        $user = Db::table('user')->where('uid', $id)->find();
        if ($token !== $user['token']) {
            $this->error('验证失败');
        }
        $vip = Db::table('vip')->select();
        return view('/user/edit', ['title' => '修改用户信息', 'uinfo' => $this->admin_uinfo, 'vip' => $vip, 'user' => $user]);
    }

    public function update()
    {
        $uname = input('post.uname');
        $upwd = input('post.upwd');
        $email = input('post.email');
        $qq = input('post.qq');
        $v_id = input('post.v_id');
        $uid = input('post.uid');
        $token = input('post.token');
        $price = input('post.price');
        $v_time_expire = input('post.v_time_expire');

        if (empty($uname) || empty($email) || empty($qq) || !isset($v_id) || empty($uid) || empty($token) || empty($v_time_expire) || empty($price)) return json('请确保各项不为空');

        $user = Db::table('user')->where('uid', $uid)->find();
        if ($token !== $user['token']) return json('验证失败');
        $uname_row = Db::table('user')->where('uname', $uname)->find();
        if ($uname_row) {
            if ($user['uname'] !== $uname_row['uname']) return json('用户名已存在');
        }

        $email_row = Db::table('user')->where('email', $email)->find();
        if ($email_row) {
            if ($user['email'] !== $email_row['email']) return json('邮箱已存在');
        }

        $qq_row = Db::table('user')->where('qq', $qq)->find();
        if ($qq_row) {
            if ($user['qq'] !== $user['qq']) return json('QQ已存在');
        }

        $data = ['uname' => $uname, 'email' => $email, 'qq' => $qq, 'v_id' => $v_id, 'uprice' => $price, 'v_time_expire' => $v_time_expire];
        if ($upwd !== $user['upwd']) $data['upwd'] = password_hash($upwd, PASSWORD_DEFAULT);

        $res = Db::table('user')->where('uid', $uid)->update($data);
        Log::create(['uid' => $uid, 'msg' => '后台管理员修改余额为' . $price . '元', 'time' => date('Y-m-d H:i:s')]);
        if ($res) {
            return json('修改成功');
        } else {
            return json('修改失败');
        }


    }

    public function delete()
    {
        $uid = input('post.uid');
        $token = input('post.utoken');
        $user = Db::table('user')->where('uid', $uid)->find();
        if ($token !== $user['token']) return json('验证失败');
        $res = Db::table('user')->where('uid', $uid)->delete();
        if ($res) {
            return json('删除成功');
        } else {
            return json('删除失败');
        }

    }

    public function seal()
    {
        $data = input('post.');
        $user = Db::table('user')->where('uid', $data['uid'])->find();
        if ($user['token'] !== $data['utoken']) return json(['code' => -1, 'msg' => '验证失败']);
        $res = Db::table('user')->where('uid', $data['uid'])->update(['status' => $data['id']]);
        if ($data['id'] == 1) {
            if ($res) {
                return json(['code' => 1, 'msg' => '激活成功']);
            } else {
                return json(['code' => -1, 'msg' => '修改失败']);
            }
        } else {
            if ($res) {
                return json(['code' => 1, 'msg' => '封禁成功']);
            } else {
                return json(['code' => -1, 'msg' => '修改失败']);
            }
        }
    }
}
