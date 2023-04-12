<?php /*a:2:{s:59:"/www/wwwroot/ls.chnssl.com/app/admin/view/order/config.html";i:1661232352;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞有情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞有情')); ?>">
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
	.layui-form-label{
		width:250px;
	}
	.ns-word-aux{
		margin-left:250px;
	}
</style>

</head>
<body>

<div class="ns-logo">
	
	<span>赞有情平台端</span>

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
				
<div class="layui-form">
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">订单时间设置</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">未付款自动关闭时间：</label>
				<div class="layui-input-block">
				<div class="layui-input-inline">
					<input type="number" name="order_auto_close_time" value="<?php echo htmlentities($order_event_time_config['auto_close']); ?>" lay-verify="positiv" autocomplete="off" class="layui-input ns-len-short">
				</div>
					<span class="layui-form-mid">分钟</span>
				</div>
				<div class="ns-word-aux">订单开始后多长时间未付款自动关闭</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">发货后自动收货时间：</label>
				<div class="layui-input-block">
				<div class="layui-input-inline">
					<input type="number" name="order_auto_take_delivery_time" value="<?php echo htmlentities($order_event_time_config['auto_take_delivery']); ?>" lay-verify="positiv" autocomplete="off" class="layui-input ns-len-short">
				</div>
					<span class="layui-form-mid">天</span>
				</div>
				<div class="ns-word-aux">订单多长时间后自动收货</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">收货后自动完成时间：</label>
				<div class="layui-input-block">
				<div class="layui-input-inline">
					<input type="number" name="order_auto_complete_time" value="<?php echo htmlentities($order_event_time_config['auto_complete']); ?>" lay-verify="positiv" autocomplete="off" class="layui-input ns-len-short">
				</div>
					<span class="layui-form-mid">天</span>
				</div>
				<div class="ns-word-aux">收货后，多长时间订单自动完成</div>
			</div>
		</div>
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">退款设置</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">买家退货后商家自动确认收货时间：</label>
					<div class="layui-input-inline">
						<input type="number" name="auto_refund_take_delivery" value="<?php if(!empty($order_event_time_config['auto_refund_take_delivery'])): ?><?php echo htmlentities($order_event_time_config['auto_refund_take_delivery']); else: ?>0<?php endif; ?>" lay-verify="positiv" autocomplete="off" class="layui-input ns-len-short">
					</div>
					<span class="layui-form-mid">天</span>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">申请维权后,商家自动通过时间：</label>
					<div class="layui-input-inline">
						<input type="number" name="auto_refund_confirm" value="<?php if(!empty($order_event_time_config['auto_refund_confirm'])): ?><?php echo htmlentities($order_event_time_config['auto_refund_confirm']); else: ?>0<?php endif; ?>" lay-verify="positiv" autocomplete="off" class="layui-input ns-len-short">
					</div>
					<span class="layui-form-mid">天</span>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">维权被拒绝后,自动撤销维权时间：</label>
					<div class="layui-input-inline">
						<input type="number" name="auto_refund_cancel" value="<?php if(!empty($order_event_time_config['auto_refund_cancel'])): ?><?php echo htmlentities($order_event_time_config['auto_refund_cancel']); else: ?>0<?php endif; ?>" lay-verify="positiv" autocomplete="off" class="layui-input ns-len-short">
					</div>
					<span class="layui-form-mid">天</span>
				</div>
			</div>
		</div>

		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">评价设置</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">订单评价：</label>
					<div class="layui-input-block">
						<div class="layui-input-inline">
							<input type="radio" name="evaluate_status" value="0" title="关闭" autocomplete="off" class="layui-input ns-len-long" <?php if(empty($order_evaluate_config['evaluate_status']) || $order_evaluate_config['evaluate_status'] == 0): ?> checked <?php endif; ?>>
							<input type="radio" name="evaluate_status" value="1" title="开启" autocomplete="off" class="layui-input ns-len-long" <?php if(!empty($order_evaluate_config['evaluate_status']) && $order_evaluate_config['evaluate_status'] == 1): ?> checked <?php endif; ?>>
						</div>
					</div>
					<div class="ns-word-aux">开启订单评价功能</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">显示评价：</label>
					<div class="layui-input-block">
						<div class="layui-input-inline">
							<input type="radio" name="evaluate_show" value="0" title="关闭" autocomplete="off" class="layui-input ns-len-long" <?php if(empty($order_evaluate_config['evaluate_show']) || $order_evaluate_config['evaluate_show'] == 0): ?> checked <?php endif; ?>>
							<input type="radio" name="evaluate_show" value="1" title="开启" autocomplete="off" class="layui-input ns-len-long" <?php if(!empty($order_evaluate_config['evaluate_show']) && $order_evaluate_config['evaluate_show'] == 1): ?> checked <?php endif; ?>>
						</div>
					</div>
					<div class="ns-word-aux">前台商品详情是否显示评价</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">评价审核：</label>
					<div class="layui-input-block">
						<div class="layui-input-inline">
							<input type="radio" name="evaluate_audit" value="0" title="关闭" autocomplete="off" class="layui-input ns-len-long" <?php if(empty($order_evaluate_config['evaluate_audit']) || $order_evaluate_config['evaluate_audit'] == 0): ?> checked <?php endif; ?>>
							<input type="radio" name="evaluate_audit" value="1" title="开启" autocomplete="off" class="layui-input ns-len-long" <?php if(!empty($order_evaluate_config['evaluate_audit']) && $order_evaluate_config['evaluate_audit'] == 1): ?> checked <?php endif; ?>>
						</div>
					</div>
					<div class="ns-word-aux">评价是否需要后台审核</div>
				</div>
			</div>
		</div>
		
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">军人折扣比列设置</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">军人折扣比列：</label>
					<div class="layui-input-block">
						<div class="layui-input-inline">
							<input type="number" name="discount" value="<?php if(!empty($discount['discount'])): ?><?php echo htmlentities($discount['discount']); else: ?>0<?php endif; ?>" lay-verify="positivEinteger" autocomplete="off" class="layui-input ns-len-short">
						</div>
						<span class="layui-form-mid">%</span>
					</div>
					<div class="ns-word-aux">比率必须为0-100的整数</div>
				</div>

			</div>
		</div>
        <div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">投资利率设置</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">投资利率设置：</label>
					<div class="layui-input-block">
						<div class="layui-input-inline">
							<input type="number" name="invest" value="<?php if(!empty($invest['invest'])): ?><?php echo htmlentities($invest['invest']); else: ?>0<?php endif; ?>" autocomplete="off" class="layui-input ns-len-short">
						</div>
						<span class="layui-form-mid">%</span>
					</div>
					<!--<div class="ns-word-aux">比率必须为0-100的整数</div>-->
				</div>

			</div>
		</div>
	</div>
	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
	</div>
</div>


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
	layui.use('form', function() {
		var form = layui.form,
			repeat_flag = false; //防重复标识
		form.render();

		form.on('submit(save)', function(data) {
			if (repeat_flag) return;
			repeat_flag = true;
			
			$.ajax({
				type: 'POST',
				url: ns.url("admin/order/config"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					repeat_flag = false;
					if (res.code == 0 && !res.message) {
						location.reload();
						return;
					}
					layer.msg(res.message);
				}
			});
		});

		// 验证正整数
		form.verify({
			positivEinteger: function(value) {
				if (!new RegExp("^(\\d|[1-9]\\d|99)$").test(value)) {
					return '请输入0-99之间的正整数';
				}
			}
		});
		
		// 验证正数
		form.verify({
			positiv: function(value) {
				if (!new RegExp("^[0-9]+$").test(value)) {
					return '时间不能小于0，且必须是整数！';
				}
			}
		});
	});
</script>

</body>
</html>