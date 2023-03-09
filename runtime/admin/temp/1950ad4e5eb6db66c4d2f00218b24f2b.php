<?php /*a:2:{s:68:"/www/wwwroot/ls.chnssl.com/app/admin/view/member/account_detail.html";i:1614515912;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1660099950;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞友情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞友情')); ?>">
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
	.panel-content { padding-left: 15px; box-sizing: border-box; }
	.ns-custom-panel .custom-panel-title .panel-content { width: calc(100% - 190px); }
	.ns-account-value, .ns-split { line-height: 34px; }
	.ns-custom-panel .custom-panel-from { display: block; }
	.layui-input-block + .layui-word-aux {
	    display: block;
	    margin-left: 100px;
	}
	.ns-shop-account {
		display: flex;
		align-items: center;
		position: relative;
		padding: 15px;
		box-sizing: border-box;
	}
	
	.ns-shop-detail p {
		display: inline-block;
		width: 300px;
		line-height: 30px;
	}
</style>

</head>
<body>

<div class="ns-logo">
	
	<span>赞友情平台端</span>

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
				
<div class="ns-custom-panel">
	<div class="ns-form">
		<div class="layui-card-body ns-item-block-parent ns-shop-account">
			<div class="ns-item-pic">
				<?php if($member_info['headimg']): ?>
				<img src="<?php echo img($member_info['headimg']); ?>" alt="">
				<?php else: ?>
				<img src="https://ls.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
				<?php endif; ?>
			</div>
			<div class="ns-shop-detail">
				<p><strong>用户名：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['username']); ?></span></p>
				<p><strong>昵称：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['nickname']); ?></span></p>
				<p><strong>真实姓名：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['realname']); ?></span></p>
				<br>
				<p><strong>手机号：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['mobile']); ?></span></p>
				<p><strong>邮箱：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['email']); ?></span></p>
				<p><strong>注册时间：</strong><span class="ns-text-color-dark-gray ns-end-time"><?php echo time_to_date($member_info['reg_time']); ?></span></p>
			</div>
		</div>
	</div>

	<div class="custom-panel-from ns-form">
		<div class="layui-form" lay-filter="pointForm">
			<div class="layui-form-item">
				<label class="layui-form-label">积分：</label>
				<div class="layui-input-inline ns-len-short ns-account-value" id="member_point"><?php echo htmlentities($member_info['point']); ?></div>
				<button class="layui-btn layui-btn-primary" onclick="savePoint(this)" data-num="<?php echo htmlentities($member_info['point']); ?>">调整</button>
			</div>
		</div>

		<div class="layui-form">
			<div class="layui-form-item">
				<label class="layui-form-label">余额（不可提现）：</label>
				<div class="layui-input-inline ns-len-short ns-account-value" id="member_balance"><?php echo htmlentities($member_info['balance']); ?></div>
				<button class="layui-btn layui-btn-primary" onclick="saveBalance(this)" data-num="<?php echo htmlentities($member_info['balance']); ?>">调整</button>
			</div>
		</div>
		
		<div class="layui-form">
			<div class="layui-form-item">
				<label class="layui-form-label">余额（可提现）：</label>
				<div class="layui-input-inline ns-len-short ns-account-value" id="member_balance_money"><?php echo htmlentities($member_info['balance_money']); ?></div>
				<button class="layui-btn layui-btn-primary" onclick="saveBalanceMoney(this)" data-num="<?php echo htmlentities($member_info['balance_money']); ?>">调整</button>
			</div>
		</div>

		<div class="layui-form">
			<div class="layui-form-item">
				<label class="layui-form-label">成长值：</label>
				<div class="layui-input-inline ns-len-short ns-account-value" id="member_growth"><?php echo htmlentities($member_info['growth']); ?></div>
				<button class="layui-btn layui-btn-primary" onclick="saveGrowth(this)" data-num="<?php echo htmlentities($member_info['growth']); ?>">调整</button>
			</div>
		</div>
	</div>
	
	<div class="ns-screen layui-collapse" lay-filter="selection_panel">
		<div class="layui-colla-item">
			<h2 class="layui-colla-title">筛选</h2>
			<form class="layui-colla-content layui-form layui-show">
				<div class="layui-form-item">
					<div class="layui-inline">
					<label class="layui-form-label">账户类型：</label>
					<div class="layui-input-inline">
						<select name="account_type" lay-filter="account_type">
							<option value="">请选择</option>
							<?php foreach($account_type_arr as $account_type_arr_k => $account_type_arr_v): ?>
							<option value="<?php echo htmlentities($account_type_arr_k); ?>"><?php echo htmlentities($account_type_arr_v); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">来源类型：</label>
						<div class="layui-input-inline">
							<select name="from_type" class="from_type">
								<option value="">请选择</option>
							</select>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
					<label class="layui-form-label">发生时间：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_date" id="start_date" placeholder="开始时间" autocomplete="off" readonly>
					</div>
					<div class="layui-input-inline ns-split">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
					<div class="layui-input-inline ns-len-mid">
						<input type="text" class="layui-input" name="end_date" id="end_date" placeholder="结束时间" autocomplete="off" readonly>
					</div>
					</div>
				</div>

				<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['member_id']); ?>" id="member_id"/>

				<div class="ns-form-row">
					<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</form>
		</div>
	</div>

<table id="member_account" lay-filter="member_account"></table>

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
	var date = <?php echo htmlentities($member_info['reg_time']); ?>;
	$(".reg-time").text(ns.time_to_date(date, "YYYY-MM-DD"));
	
	var form,
		table,
		laydate,
		laytpl,
		repeat_flag = false, //防重复标识
		currentDate = new Date(),
		minDate = "";
	
	currentDate.setDate(currentDate.getDate() - 7);
	
	layui.use(['form', 'laydate', 'laytpl'], function() {
		form = layui.form;
		laydate = layui.laydate;
		laytpl = layui.laytpl;
		form.render();

		//开始时间
		laydate.render({
			elem: '#start_date',
			type: 'datetime'
		});
		
		//结束时间
		laydate.render({
			elem: '#end_date',
			type: 'datetime'
		});

        //根据账户类型获取来源类型
        form.on('select(account_type)', function (data) {

            $.ajax({
                type: "POST",
                url: ns.url("admin/member/getfromtype"),
                data: {type:data.value},
                dataType: 'JSON',
                success: function(res) {

                    var html = '<option value="">请选择</option>';
                    $.each(res,function(k,v){
                        html += '<option value="'+k+'">'+v.type_name+'</option>';
                    });

                    $('.from_type').html(html);
					form.render();
                }
            });
        });

		/**
		 * 重新渲染结束时间
		 * */
		function reRender() {
			$("#reg_end_date").remove();
			$(".end-time").html('<input type="text" class="layui-input" name="reg_end_date" id="reg_end_date" placeholder="请输入结束时间">');
			laydate.render({
				elem: '#reg_end_date',
				min: minDate
			});
		}

		table = new Table({
			elem: '#member_account',
			url: ns.url("admin/member/accountDetail"),
			where:{
			    member_id : $("#member_id").val(),
			},
			cols: [
				[{
					field: 'account_type_name',
					title: '账户类型',
					width: '15%',
					unresize: 'false'
				}, {
					field: 'account_data',
					title: '数据金额',
					width: '15%',
					unresize: 'false'
				}, {
					field: 'type_name',
					title: '发生方式',
					width: '15%',
					unresize: 'false'
				}, {
					field: 'remark',
					title: '备注',
					width: '35%',
					unresize: 'false'
				}, {
					field: 'create_time',
					title: '发生时间',
					width: '20%',
					unresize: 'false',
					templet: function(data) {
						return ns.time_to_date(data.create_time);
					}
				}]
			]
		});
		
		/**
		 * 表单验证
		 */
		form.verify({
			num: function(value) {
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}
				
				if (value == "") {
					return false;
				}
				if (val.length > 2) {
					return '保留小数点后两位'
				}
			}
		});
		
		form.on('submit(search)', function(data) {
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
			return false;
		});
		
		form.on('submit(savePoint)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var point = <?php echo htmlentities($member_info['point']); ?>;
			if (point*1 + data.field.adjust_num*1 < 0) {
				layer.msg('积分不可以为负数');
				repeat_flag = false;
				return ;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustPoint"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;
					
					if (res.code == 0) {
						$("#member_point").html(res.data.point);
						$("#member_point").next().attr('data-num', res.data.point);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});
		
		form.on('submit(saveBalance)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var balance = <?php echo htmlentities($member_info['balance']); ?>;
			if (balance*1 + data.field.adjust_num*1 < 0) {
				layer.msg('当前余额（不可提现）不可以为负数');
				repeat_flag = false;
				return ;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustBalance"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;
					
					if (res.code == 0) {
						$("#member_balance").html(res.data.balance);
						$("#member_balance").next().attr('data-num', res.data.balance);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});
		
		form.on('submit(saveBalanceMoney)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var balance = <?php echo htmlentities($member_info['balance_money']); ?>;
			if (balance*1 + data.field.adjust_num*1 < 0) {
				layer.msg('余额(可提现)不可以为负数');
				repeat_flag = false;
				return ;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustBalanceMoney"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;
					
					if (res.code == 0) {
						$("#member_balance_money").html(res.data.balance_money);
						$("#member_balance_money").next().attr('data-num', res.data.balance_money);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});
		
		form.on('submit(saveGrowth)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var growth = <?php echo htmlentities($member_info['growth']); ?>;
			if (growth*1 + data.field.adjust_num*1 < 0) {
				layer.msg('成长值不可以为负数');
				repeat_flag = false;
				return;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustGrowth"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;
					
					if (res.code == 0) {
						$("#member_growth").html(res.data.growth);
						$("#member_growth").next().attr('data-num', res.data.growth);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});
	});
	
	function savePoint(e) {
		var point = $(e).attr('data-num');
		var data = {
			point : point
		};
		laytpl($("#point").html()).render(data, function(html) {
			layer.open({
				title: '调整积分',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}
	
	function saveBalance(e) {
		var balance = $(e).attr('data-num');
		var data = {
			balance : balance
		};
		laytpl($("#balance").html()).render(data, function(html) {
			layer.open({
				title: '调整余额（不可提现）',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}
	
	function saveBalanceMoney(e) {
		var balance_money = $(e).attr('data-num');
		var data = {
			balance_money : balance_money
		};
		laytpl($("#balance_money").html()).render(data, function(html) {
			layer.open({
				title: '调整余额（可提现）',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}
	
	function saveGrowth(e) {
		var growth = $(e).attr('data-num');
		var data = {
			growth : growth
		};
		laytpl($("#growth").html()).render(data, function(html) {
			layer.open({
				title: '调整成长值',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}
</script>

<!-- 积分弹框html -->
<script type="text/html" id="point">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前积分：</label>
			<div class="layui-input-block ns-account-value">{{ d.point }}</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前值相加不能小于0，可保留两位小数</span>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>
		
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="savePoint">确定</button>
		</div>
		
		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.point }}" />
	</div>
</script>

<!-- 余额弹框html -->
<script type="text/html" id="balance">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前余额（不可提现）：</label>
			<div class="layui-input-block ns-account-value">{{ d.balance }}</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前值相加不能小于0，可保留两位小数</span>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>
		
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="saveBalance">确定</button>
		</div>
		
		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.balance }}" />
	</div>
</script>

<!-- 余额（可提现）弹框html -->
<script type="text/html" id="balance_money">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前余额（可提现）：</label>
			<div class="layui-input-block ns-account-value">{{ d.balance_money }}</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前值相加不能小于0，可保留两位小数</span>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>
		
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="saveBalanceMoney">确定</button>
		</div>
		
		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.balance_money }}" />
	</div>
</script>

<!-- 成长值弹框html -->
<script type="text/html" id="growth">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前成长值：</label>
			<div class="layui-input-block ns-account-value">{{ d.growth }}</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前值相加不能小于0，可保留两位小数</span>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>
		
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="saveGrowth">确定</button>
		</div>
		
		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.growth }}" />
	</div>
</script>

</body>
</html>