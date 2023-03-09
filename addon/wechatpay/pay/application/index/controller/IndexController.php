<?php

namespace app\index\controller;

use app\common\controller\CommonController;
use think\Controller;
use think\Request;

class IndexController extends CommonController
{
    public function index()
    {
        return view('index/index');
    }
}
