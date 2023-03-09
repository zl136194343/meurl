<?php
/*
 * 路由配置
 */

$admin_dir = 'nbpay';
define('ADMIN_DIR', $admin_dir);

//后台路由组
Route::group('/' . ADMIN_DIR, function () {
    //网站配置
    Route::get('/config', 'admin/ConfigController/index');
    Route::get('/yz_config', 'admin/ConfigController/yz_config');
    Route::get('/email_config', 'admin/ConfigController/email_config');
    Route::get('/wx_config', 'admin/ConfigController/wx_config');
    Route::get('/ali_config', 'admin/ConfigController/ali_config');
    Route::get('/invite_config', 'admin/ConfigController/invite_config');
    Route::post('/do_config', 'admin/ConfigController/do_config');

    //管理员配置
    Route::get('/member_add', 'admin/MemberController/add');
    Route::post('/do_member_add', 'admin/MemberController/do_add');
    Route::get('/member_edit/:id', 'admin/MemberController/edit');
    Route::post('/do_member_edit/:id', 'admin/MemberController/do_edit');
    Route::get('/member_del/:id', 'admin/MemberController/del');
    Route::get('/member', 'admin/MemberController/index');

    //登录
    Route::get('/login', 'admin/LoginController/index');
    Route::post('/do_login', 'admin/LoginController/do_login');
    Route::post('/logout', 'admin/LoginController/logout');

    //用户
    Route::get('/user/create', 'admin/UserController/create');
    Route::post('/user/insert', 'admin/UserController/insert');
    Route::get('/user/index', 'admin/UserController/index');
    Route::get('/user/edit/:id', 'admin/UserController/edit');
    Route::post('/user/update', 'admin/UserController/update');
    Route::post('/user/del', 'admin/UserController/delete');
    Route::post('/user/seal', 'admin/UserController/seal');

    //会员
    Route::get('/vip/create', 'admin/VipController/create');
    Route::post('/vip/insert', 'admin/VipController/insert');
    Route::get('/vip/index', 'admin/VipController/index');
    Route::get('/vip/edit/:id', 'admin/VipController/edit');
    Route::post('/vip/update', 'admin/VipController/update');
    Route::post('/vip/del', 'admin/VipController/delete');

    //订单
    Route::get('/order', 'admin/OrderController/order');

    //申请记录
    Route::get('/submit', 'admin/SubmitController/index');

    //充值记录
    Route::get('/recharge', 'admin/RechargeController/index');

    //资金记录
    Route::get('/log', 'admin/LogController/index');

    //公告
    Route::get('/notice/add', 'admin/NoticeController/add');
    Route::post('/notice/do_add', 'admin/NoticeController/do_add');
    Route::get('/notice/edit/:id', 'admin/NoticeController/edit');
    Route::post('/notice/do_edit/:id', 'admin/NoticeController/do_edit');
    Route::get('/notice/del/:id', 'admin/NoticeController/del');
    Route::get('/notice', 'admin/NoticeController/list');

    //首页
    Route::get('/index', 'admin/IndexController/index');
    Route::get('/', 'admin/IndexController/index');
});

$user_dir = 'user';
define('USER_DIR', $user_dir);

//用户路由组
Route::group('/' . USER_DIR, function () {
    Route::get('/vip', 'user/IndexController/vip');
    Route::post('/do_vip', 'user/IndexController/do_vip');
    Route::get('/info', 'user/IndexController/info');
    Route::post('/do_info', 'user/IndexController/do_info');
    Route::get('/token', 'user/IndexController/docking');
    Route::post('/do_token', 'user/IndexController/do_docking');
    Route::get('/index', 'user/IndexController/index');
    Route::get('/look_notice/:id', 'user/IndexController/look_notice');
    Route::get('/wechart', 'user/WechartController/list');
    Route::get('/wechart_add', 'user/WechartController/add');
    Route::get('/wechart_query/:sid', 'user/WechartController/query');
    Route::post('/do_wechart_add', 'user/WechartController/do_add');
    Route::get('/do_wechart_config/:sub_mch_id', 'user/WechartController/pay_config');
    Route::get('/cash_query/:sub_mch_id', 'user/WechartController/cash_query');
    Route::get('/edit_cash/:sub_mch_id', 'user/WechartController/edit_cash');
    Route::post('/do_edit_cash/:sub_mch_id', 'user/WechartController/do_edit_cash');
    Route::post('/wechart_upload', 'user/WechartController/upload');
    Route::get('/wechart_citycode', 'user/WechartController/citycode');
    Route::get('/order', 'user/OrderController/order');
    Route::get('/recharge', 'user/RechargeController/index');
    Route::post('/do_recharge', 'user/RechargeController/do');
    Route::get('/getshop', 'user/RechargeController/getshop');
    Route::get('/recharge_list', 'user/RechargeController/list');
    Route::get('/log', 'user/LogController/index');
    Route::get('/invite', 'user/InviteController/index');
    Route::get('/invite_user', 'user/InviteController/invite_user');
    Route::get('/invite_list', 'user/InviteController/invite_list');
    Route::get('/tui_order', 'user/OrderController/tui_order');
    Route::get('/', 'user/IndexController/index');
})->middleware('Login');

Route::get('/recharge_notify', 'user/RechargeController/notify');

//API路由组
Route::group('/api', function () {
    Route::get('/mp_pay', 'api/ApiController/mp_pay');
    Route::get('/do_mp_pay', 'api/ApiController/do_mp_pay');
    Route::get('/scan_pay', 'api/ApiController/scan_pay');
    Route::post('/wx_notify', 'api/ApiController/wx_notify');
    Route::get('/query_order', 'api/ApiController/query_order');
    Route::get('/refund_order', 'api/ApiController/refund_order');
    Route::post('/citycode', 'api/SubmitController/citycode');
    Route::post('/upload', 'api/SubmitController/upload');
    Route::post('/wechart_add', 'api/SubmitController/wechart_add');
    Route::post('/query', 'api/SubmitController/query');
    Route::post('/pay_config', 'api/SubmitController/pay_config');
});

//登录页面
Route::get('/user/login', 'user/LoginController/login');
//验证登录
Route::post('/user/do_login', 'user/LoginController/do_login');
//退出登录
Route::post('/user/logout', 'user/LoginController/logout');
//注册页面
Route::get('/user/reg', 'user/LoginController/reg');
//验证注册
Route::post('/user/do_reg', 'user/LoginController/do_reg');
//极限验证
Route::post('/geetest', 'geetest/GeetestController/index');

//首页
Route::get('/index','index/IndexController/index')->cache(6000);
Route::get('/','index/IndexController/index')->cache(6000);
