<?php

namespace app\geetest\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;
use Geetest\Geetest;

class GeetestController extends CommonController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $GtSdk = new Geetest(config('captcha_id'), config('private_key'));
        $data = array("user_id" => 'public', "client_type" => "web", "ip_address" => $_SERVER['REMOTE_ADDR']);
        $status = $GtSdk->pre_process($data, 1);
        session('gtserver', $status);
        session('user_id', 'public');
        echo $GtSdk->get_response_str();
    }
}
