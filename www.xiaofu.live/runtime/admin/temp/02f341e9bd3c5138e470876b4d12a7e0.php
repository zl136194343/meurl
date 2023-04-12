<?php /*a:2:{s:65:"/www/wwwroot/www.hunqin.com/app/admin/view/shop/account_info.html";i:1671499720;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1671499700;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"婚业汇联管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'婚业汇联管理系统')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/admin/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/app/admin/view/public/img/"
		};

	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		@media only screen and (max-width: 1130px) {
			.layui-nav .layui-nav-item a {
				margin-left: 25px;
			}
		}
		@media only screen and (max-width: 1030px) {
			.layui-nav .layui-nav-item a {
				margin-left: 10px;
			}
		}
	</style>
	
<style>
    .ns-card-brief:nth-child(1){
        margin-top: 0;
    }
    .layui-card-body{
        display: flex;
        flex-wrap: wrap;
        padding-bottom: 0;
    }
    .layui-card-body .content{
        width: 25%;
        margin-bottom: 20px;
    }
    .layui-card-body .money{
        font-size: 20px;
        color: #000;
        font-weight: bold;
        margin-top: 10px;
        max-width: 250px;
    }
    .layui-card-body .subhead{
        font-size: 12px;
        margin-left: 3px;
        cursor: pointer;
    }
</style>

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://ls.chnssl.com/app/admin/view/public/img/logo.png">-->
	</div>
	<span>婚业汇联管理系统</span>
	<!--<span>服务电话：400-886-7993</span>-->
</div>

<div class="layui-layout layui-layout-admin">
	
	<div class="layui-header">
		<!-- 一级菜单 -->
		<ul class="layui-nav layui-layout-left">
			<?php $second_menu = []; foreach($menu as $menu_k => $menu_v): ?>
			<li class="layui-nav-item <?php if($menu_v['selected']): ?> layui-this<?php endif; ?>">
				<a href="<?php echo htmlentities($menu_v['url']); ?>"><?php echo htmlentities($menu_v['title']); ?></a>
			</li>
			<?php if($menu_v['selected']): 
				$second_menu = $menu_v['child_list'];
				 ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<ul class="layui-nav layui-layout-right">
			<li class="layui-nav-item">
				<a href="javascript:;">
					<div class="ns-img-box">
						<img src="https://ls.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
					</div>
					<?php echo htmlentities($user_info['username']); ?>
				</a>
				<dl class="layui-nav-child">
					<dd class="ns-reset-pass" onclick="resetPassword();">
						<a href="javascript:;">修改密码</a>
					</dd>
					<dd>
						<a onclick="clearCache()" href="javascript:;">清除缓存</a>
					</dd>
					<dd>
						<a href="<?php echo addon_url('admin/login/logout'); ?>" class="login-out">退出登录</a>
					</dd>
				</dl>
			</li>
		</ul>
	</div>
	

	<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
	<div class="layui-side">
		<div class="layui-side-scroll">
			<span class="ns-side-title"><?php echo htmlentities($crumbs[0]['title']); ?></span>
			<!-- 二三级菜单-->
			<ul class="layui-nav layui-nav-tree"  lay-filter="test">
				<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
				<li class="layui-nav-item <?php if($menu_second_v['selected']): ?> layui-nav-itemed <?php endif; if(!$menu_second_v['child_list'] && $menu_second_v['selected']): ?> layui-this<?php endif; ?>">
					<a class="layui-menu-tips" href="<?php if(!$menu_second_v['child_list']): ?> <?php echo htmlentities($menu_second_v['url']); else: ?>javascript:;<?php endif; ?>"><?php echo htmlentities($menu_second_v['title']); ?></a>
					<?php if(!(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty()))): ?>
					<dl class="layui-nav-child">
						<?php foreach($menu_second_v["child_list"] as $menu_third_k => $menu_third_v): ?>
						<dd class="<?php if($menu_third_v['selected']): ?> layui-this<?php endif; ?>">
							<a href="<?php echo htmlentities($menu_third_v['url']); ?>"><?php echo htmlentities($menu_third_v['title']); ?></a>
						</dd>
						<?php endforeach; ?>
					</dl>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<div class="layui-body<?php if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?> child_no_exit<?php endif; ?>">
		<!-- 面包屑 -->
		
		<?php if(count($second_menu) > 0): ?>
		<div class="ns-crumbs<?php if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?> child_no_exit<?php endif; ?>">
		<span class="layui-breadcrumb" lay-separator="-">
			<?php foreach($crumbs as $crumbs_k => $crumbs_v): if(count($crumbs) == ($crumbs_k + 1)): ?>
			<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
			<?php else: ?>
			<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
			<?php endif; ?>
			<?php endforeach; ?>
		</span>
		</div>
		<?php endif; ?>
		
		<div class="ns-body-content <?php if(count($second_menu) < 1): ?> crumbs_no_exit<?php endif; ?>">
			<div class="ns-body">
				<!-- 四级导航 -->
				<?php if(isset($forth_menu) && !empty($forth_menu)): ?>
				<div class="fourstage-nav layui-tab layui-tab-brief" lay-filter="edit_user_tab">
					<ul class="layui-tab-title">
						<?php if(is_array($forth_menu) || $forth_menu instanceof \think\Collection || $forth_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $forth_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
						<li class="<?php echo $menu['selected']==1 ? 'layui-this'  :  ''; ?>" lay-id="basic_info"><a href="<?php echo htmlentities($menu['parse_url']); ?>"><?php echo htmlentities($menu['title']); ?></a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				
<div class="layui-card ns-card-common ns-card-brief">
    <div class="layui-card-header">
        <div>
            <span class="ns-card-title">资产概况</span>
        </div>
    </div>
    <div class="layui-card-body">
        <div class="content">
            <p class="title">可用余额（元）</p>
            <p class="money"><?php echo htmlentities($account); ?></p>
        </div>
        <div class="content">
            <p class="title">已提现（元）/ 提现中（元）</p>
            <p class="money"><?php echo htmlentities($account_info['account_withdraw']); ?> / <?php echo htmlentities($account_info['account_withdraw_apply']); ?></p>
        </div>
        <div class="content">
            <p class="title">入驻费用（元）</p>
            <p class="money"><?php echo htmlentities($account_info['shop_open_fee']); ?></p>
        </div>
        <div class="content">
            <p class="title">保证金（元）</p>
            <p class="money"><?php echo htmlentities($account_info['shop_baozhrmb']); ?></p>
        </div>
    </div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="edit_user_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="account">账户收支</li>
		<li lay-id="account_withdraw">提现记录</li>
	</ul>
	<div class="layui-tab-content">

        <!--账户支出-->
		<div class="layui-tab-item layui-show" lay-filter="account_list_tab">

			<table id="account_list"></table>
		</div>

        <!--提现记录-->
        <div class="layui-tab-item " lay-filter="withdraw_list_tab">

            <table id="shop_withdraw_list"></table>
        </div>

        <!--待结算订单-->
        <div class="layui-tab-item" lay-filter="order_list_tab">
            <table id="order_list"></table>
        </div>

	</div>
</div>
<input id="site_id" type="hidden" value="<?php echo htmlentities($account_info['site_id']); ?>" />

<!--商家信息-->
<script type="text/html" id="shop_info">
    <div class="layui-elip">店铺名称：{{d.site_name}}</div>
    <div class="layui-elip">联系人：{{d.name}}</div>
    <div class="layui-elip">联系电话：{{d.mobile}}</div>
</script>

<!--账户信息-->
<script type="text/html" id="account">
    {{# if(d.bank_type == 1){ }}
    <div class="layui-elip">账户类型：银行卡</div>
    <div class="layui-elip">账户名称：{{d.settlement_bank_name}}</div>
    <div class="layui-elip">提现账号：{{d.settlement_bank_account_number}}</div>
    <div class="layui-elip">开户名：{{d.settlement_bank_account_name}}</div>
    {{# }else{ }}
    <div class="layui-elip">账户类型：支付宝</div>
    <div class="layui-elip">支付宝用户名：{{d.settlement_bank_account_name}}</div>
    <div class="layui-elip">支付宝账号：{{d.settlement_bank_account_number}}</div>
    {{# } }}

</script>

<!--时间-->
<script type="text/html" id="times">
    <div class="layui-elip">申请时间：{{ns.time_to_date(d.apply_time)}}</div>
    <div class="layui-elip">转账时间：{{ns.time_to_date(d.payment_time)}}</div>
</script>

<!--状态-->
<script type="text/html" id="status">
    {{# if(d.status == 0){ }}
    <div class="layui-elip">待审核</div>
    {{# }else if(d.status == 1){ }}
    <div class="layui-elip">待转账</div>
    {{# }else if(d.status == 2){ }}
    <div class="layui-elip">已转账</div>
    {{# }else if(d.status == -1){ }}
    <div class="layui-elip">已拒绝</div>
    {{# } }}
</script>


			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
			</div>-->
		</div>
	</div>
</div>

<!-- 重置密码弹框html -->
<div class="layui-form" id="reset_pass" style="display: none;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>原密码</label>
        <div class="layui-input-block">
            <input type="password" id="old_pass" name="old_pass" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
            <span class="required"></span>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>新密码</label>
        <div class="layui-input-block">
            <input type="password" id="new_pass" name="new_pass" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
            <span class="required"></span>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>确认新密码</label>
        <div class="layui-input-block">
            <input type="password" id="repeat_pass" name="repeat_pass" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
            <span class="required"></span>
        </div>
    </div>

    <div class="ns-form-row">
        <button class="layui-btn ns-bg-color" onclick="repass()">确定</button>
        <button class="layui-btn layui-btn-primary" onclick="closePass()">返回</button>
    </div>
</div>
<script type="text/javascript">
	layui.use('element',function () {
		var element = layui.element;
		element.render('breadcrumb');
	});
	function clearCache () {
		$.ajax({
			type: 'post',
			url: ns.url("admin/Login/clearCache"),
			dataType: 'JSON',
			success: function(res) {
				layer.msg(res.message);
				location.reload();
			}
		})
	}

    /**
     * 重置密码
     */
	var index;
    function resetPassword() {
        index = layer.open({
            type:1,
            content:$('#reset_pass'),
            offset: 'auto',
            area: ['650px']
        });

		setTimeout(function() {
			$(".ns-reset-pass").removeClass('layui-this');
		}, 1000);
    }

	// $(".ns-reset-pass").on('click', function() {
	// 	$(this).removeClass('layui-this');
	// })

    var repeat_flag = false;
    function repass(){
        var old_pass = $("#old_pass").val();
        var new_pass = $("#new_pass").val();
        var repeat_pass = $("#repeat_pass").val();

        if (old_pass == '') {
            $("#old_pass").focus();
            layer.msg("原密码不能为空");
            return;
        }

        if (new_pass == '') {
            $("#new_pass").focus();
            layer.msg("密码不能为空");
            return;
        } else if ($("#new_pass").val().length < 6) {
            $("#new_pass").focus();
            layer.msg("密码不能少于6位数");
            return;
        }
        if (repeat_pass == '') {
            $("#repeat_pass").focus();
            layer.msg("密码不能为空");
            return;
        } else if ($("#repeat_pass").val().length < 6) {
            $("#repeat_pass").focus();
            layer.msg("密码不能少于6位数");
            return;
        }
        if (new_pass != repeat_pass) {
            $("#repeat_pass").focus();
            layer.msg("两次密码输入不一样，请重新输入");
            return;
        }

        if(repeat_flag)return;
        repeat_flag = true;

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: ns.url("admin/login/modifypassword"),
            data: {"old_pass": old_pass,"new_pass": new_pass},
            success: function(res) {
                layer.msg(res.message);
                repeat_flag = false;

                if (res.code == 0) {
                    layer.close(index);
                    location.reload();
                }
            }
        });
    }

    function closePass() {
        layer.close(index);
	}

	/**
	 * 打开相册
	 */
	function openAlbum(callback, imgNum) {
		layui.use(['layer'], function () {
			//iframe层-父子操作
			layer.open({
				type: 2,
				title: '图片管理',
				area: ['825px', '675px'],
				fixed: false, //不固定
				btn: ['保存', '返回'],
				content: ns.url("admin/album/album?imgNum=" + imgNum),
				yes: function (index, layero) {
					var iframeWin = window[layero.find('iframe')[0]['name']];//得到iframe页的窗口对象，执行iframe页的方法：

					iframeWin.getCheckItem(function (obj) {
						if (typeof callback == "string") {
							try {
								eval(callback + '(obj)');
								layer.close(index);
							} catch (e) {
								console.error('回调函数' + callback + '未定义');
							}
						} else if (typeof callback == "function") {
							callback(obj);
							layer.close(index);
						}

					});
				}
			});
		});
	}

	layui.use('element', function() {
		var element = layui.element;
		element.init();
	});
</script>


<script>
	layui.use(['element','form','laydate'], function() {
		var tableAccount,
			tableOrderCalc,
			tableAccountWithdraw,
            element = layui.element,
            laydate = layui.laydate,
			form = layui.form;
        form.render();

        //开始时间
        laydate.render({
            elem: '#start_time' //指定元素
            ,done: function(value, date, endDate){
                start_time = ns.date_to_time(value);

            }
        });
        //结束时间
        laydate.render({
            elem: '#end_time' //指定元素
            ,done: function(value, date, endDate){
                end_time = ns.date_to_time(value);
            }
        });
        //开始时间
        laydate.render({
            elem: '#start_time1' //指定元素
            ,done: function(value, date, endDate){
                start_time = ns.date_to_time(value);

            }
        });
        //结束时间
        laydate.render({
            elem: '#end_time1' //指定元素
            ,done: function(value, date, endDate){
                end_time = ns.date_to_time(value);
            }
        });
        //开始时间
        laydate.render({
            elem: '#start_time2' //指定元素
            ,done: function(value, date, endDate){
                start_time = ns.date_to_time(value);

            }
        });
        //结束时间
        laydate.render({
            elem: '#end_time2' //指定元素
            ,done: function(value, date, endDate){
                end_time = ns.date_to_time(value);
            }
        });
        /****************************************** 账户收支开始 **************************************/

        //监听Tab切换，以改变地址hash值
        element.on('tab(account_list_tab)', function () {
            table.reload({
                page: {
                    curr: 1
                },
                where: {
                    'type': this.getAttribute('data-status')
                }
            });
        });

        /**
         * 搜索功能
         */
        form.on('submit(account_search)', function (data) {
            data.field.start_time = start_time;
            data.field.end_time = end_time;
            table.reload({
                page: {
                    curr: 1
                },
                where: data.field
            });
            return false;
        });

		tableAccount = new Table({
			elem: '#account_list',
			url: ns.url("admin/shop/getshopaccount"),
			where: {
				"site_id": $("#site_id").val()
			},
			cols: [
                [{
                    field: 'account_no',
                    title: '账单编号',
                    unresize: 'false',
                },{
                    field: 'type_name',
                    title: '收支来源',
                    unresize: 'false',

                },{
                    field: 'account_data',
                    title: '金额（元）',
                    unresize: 'false',

                }, {
                    title: '收支类型',
                    unresize: 'false',
                    templet: function (res){
                        return res.account_data >= 0 ? "收入" : "支出";
                    }
                }, {
                    field: 'create_time',
                    title: '时间',
                    unresize: 'false',
                    templet: function (res){
                        if(res.create_time == 0){
                            return '--';
                        }else{
                            return ns.time_to_date(res.create_time)
                        }
                    }
                }, {
                    field: 'remark',
                    title: '说明',
                    unresize: 'false'
                }]
			]
		});
		/***********************************************账户收支结束*******************************/

        /***********************************************待结算订单开始*******************************/
		tableOrderCalc = new Table({
			elem: '#order_list',
			url: ns.url("admin/shop/getordercalc"),
			where: {
				"site_id": $("#site_id").val()
			},
			cols: [
                [{
                    field: 'order_no',
                    title: '订单编号',
                    unresize: 'false',

                }, {
                    field:'order_money',
                    title: '订单金额（元）',
                    unresize: 'false',

                }, {
                    field:'refund_money',
                    title: '退款金额（元）',
                    unresize: 'false',

                }, {
                    field:'shop_money',
                    title: '店铺金额（元）',
                    unresize: 'false',

                }, {
                    field:'platform_money',
                    title: '平台抽成（元）',
                    unresize: 'false',
                }, {
                    title: '状态',
                    unresize: 'false',
                    templet: function (res){
                        var str = '';
                        if(res.order_status != 0 && res.order_status != -1 && res.order_status != 10){
                            str = '进行中';
                        }else if(res.order_status == 10 && res.settlement_id == 0){
                            str = '待结算';
                        }else if(res.order_status == 10 && res.settlement_id != 0){
                            str = '已结算';
                        }
                        return str;
                    }
                }, {
                    field: 'finish_time',
                    title: '完成时间',
                    unresize: 'false',
                    templet: function (res){
                        if(res.finish_time == 0){
                            return '--';
                        }else{
                            return ns.time_to_date(res.finish_time)
                        }

                    }
                }]
			]
		});

        /***********************************************待结算订单结束*******************************/


        /***********************************************提现记录开始*******************************/
		tableAccountWithdraw = new Table({
            elem: '#shop_withdraw_list',
            url: ns.url("admin/shopaccount/withdrawlist"),
            where: {
                "site_id": $("#site_id").val()
            },
            cols: [
                [{
                    title: '商家信息',
                    width: '15%',
                    unresize: 'false',
                    templet: '#shop_info',
                }, {
                    field: 'withdraw_no',
                    title: '提现流水编号',
                    width: '10%',
                    unresize: 'false'
                }, {
                    title: '提现账户',
                    width: '15%',
                    unresize: 'false',
                    templet: '#account',
                }, {
                    field: 'money',
                    title: '提现金额',
                    width: '8%',
                    unresize: 'false'
                },{
                    field: 'status',
                    title: '状态',
                    width: '8%',
                    unresize: 'false',
                    templet: '#status'
                },{
                    title: '时间',
                    width: '17%',
                    unresize: 'false',
                    templet: '#times'
                }]
			]
		});

        /***********************************************提现记录结束*******************************/
		/**
		 * 搜索功能
		 */
		// 待结算
		form.on('submit(check)', function(data){
			tableOrderCalc.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
		});
		
		// 提现
		form.on('submit(search)', function(data){
			tableAccountWithdraw.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
		});

        // 保证金
        form.on('submit(search_deposit)', function(data){
            tableDeposit.reload({
                page: {
                    curr: 1
                },
                where: data.field
            });
        });

        /**
         * 监听工具栏操作
         */
        tableOrderCalc.tool(function(obj) {
            var data = obj.data,
                event = obj.event;
            switch (obj.event) {
                case 'basic': //查看
                    location.href = ns.url("admin/order/detail?order_id=" + data.order_id);
                    break;
            }
        });

        /**
         * 监听工具栏操作
         */
        /* tableReopen.tool(function(obj) {
            var data = obj.data,
                event = obj.event;
            switch (obj.event) {

                case 'reopen_pass': //通过
                    passApply(data.id, data.site_id);
                    break;
                case 'reopen_refuse': //拒绝
                    refuseApply(data.id);
                    break;
                case 'reopen_detail': //详情
                    alert(123);
                    location.href = ns.url("admin/shopreopen/reopendetail?id="+ data.id);
                    break;
            }
        }); */

        //通过申请
        /* function passApply(id, site_id) {
            if (repeat_flag) return false;
            repeat_flag = true;
            layer.confirm('确定要通过续签申请吗?', function() {
                $.ajax({
                    url: ns.url("admin/shopreopen/pass"),
                    data: {
                        "id": id,
                        "site_id": site_id
                    },
                    dataType: 'JSON',
                    type: 'POST',
                    success: function(res) {
                        layer.msg(res.message);
                        repeat_flag = false;

                        if (res.code == 0) {
                            table.reload();
                        }
                    }
                });
            }, function () {
                layer.close();
                repeat_flag = false;
            });
        } */

        //拒绝申请
        /* function refuseApply(id) {
            if (repeat_flag) return false;
            repeat_flag = true;
            layer.confirm('确定要拒绝续签申请吗?', function() {
                $.ajax({
                    url: ns.url("admin/shopreopen/fail"),
                    data: {
                        "id": id,
                    },
                    dataType: 'JSON',
                    type: 'POST',
                    success: function(res) {
                        layer.msg(res.message);
                        repeat_flag = false;

                        if (res.code == 0) {
                            table.reload();
                        }
                    }
                });
            }, function () {
                layer.close();
                repeat_flag = false;
            });
        } */
	})
</script>

</body>
</html>