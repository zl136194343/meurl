<?php /*a:2:{s:67:"/www/wwwroot/ls.chnssl.com/app/admin/view/shop/settlement_info.html";i:1614515996;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
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
				
<div class="layui-form ns-form">
	<div class="layui-form-item">
		<label class="layui-form-label">结算账户类型：</label>
		<div class="layui-input-inline">
			<?php if(in_array("bank", $support_transfer_type)): ?>
			<input type="radio" name="bank_type" lay-filter="payType" value="1" title="银行卡" <?php echo $cert_info['bank_type']==1 ? 'checked'  :  !$cert_info['bank_type'] ? 'checked' : ''; ?>>
			<?php endif; if(in_array("alipay", $support_transfer_type)): ?>
			<input type="radio" name="bank_type" lay-filter="payType" value="2" title="支付宝" <?php echo $cert_info['bank_type']==2 ? 'checked'  :  ''; ?>>
			<?php endif; if(in_array("wechatpay", $support_transfer_type)): ?>
			<input type="radio" name="bank_type" lay-filter="payType" value="3" title="微信" <?php echo $cert_info['bank_type']==3 ? 'checked'  :  ''; ?>>
			<?php endif; ?>
		</div>
	</div>
	<!-- 银行卡 -->
	<?php if($cert_info['bank_type'] == 1): ?>
	<div class="ns-pay-bank">
	<?php else: ?>
	<div class="ns-pay-bank" style="display: none">
	<?php endif; ?>

		<div class="layui-form-item">
			<label class="layui-form-label ns-pay-alipay-name">结算银行开户名：</label>
			<div class="layui-input-inline">
				<?php if($cert_info['bank_type'] == 1): ?>
				<input name="settlement_bank_account_name" id="settlement_bank_account_name" type="text" value="<?php echo htmlentities($cert_info['settlement_bank_account_name']); ?>" class="layui-input ns-len-long" autocomplete="off">
				<?php else: ?>
				<input name="settlement_bank_account_name" id="settlement_bank_account_name" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
				<?php endif; ?>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label ns-pay-alipay-account">结算公司银行账号：</label>
			<div class="layui-input-inline">
				<?php if($cert_info['bank_type'] == 1): ?>
				<input name="settlement_bank_account_number" id="settlement_bank_account_number" type="text" lay-verify="required" value="<?php echo htmlentities($cert_info['settlement_bank_account_number']); ?>" class="layui-input ns-len-long" autocomplete="off">
				<?php else: ?>
				<input name="settlement_bank_account_number" id="settlement_bank_account_number" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
				<?php endif; ?>

			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">结算开户银行支行名称：</label>
			<div class="layui-input-inline">
				<?php if($cert_info['bank_type'] == 1): ?>
				<input name="settlement_bank_name" type="text" id="settlement_bank_name" lay-verify="required" value="<?php echo htmlentities($cert_info['settlement_bank_name']); ?>" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
				<?php else: ?>
				<input name="settlement_bank_name" type="text" id="settlement_bank_name"  value="" class="layui-input ns-len-long" autocomplete="off">
				<?php endif; ?>
			</div>
		</div>

		<div class="layui-form-item" data-flag="area">
			<label class="layui-form-label">结算开户银行所在地：</label>
			<div class="layui-input-inline">
				<?php if($cert_info['bank_type'] == 1): ?>
				<input name="settlement_bank_address" type="text" id="settlement_bank_address"  value="<?php echo htmlentities($cert_info['settlement_bank_address']); ?>" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
				<?php else: ?>
				<input name="settlement_bank_address" type="text" id="settlement_bank_address"  value="" class="layui-input ns-len-long" autocomplete="off">
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if($cert_info['bank_type'] == 2): ?>
	<div class="ns-pay-zfb">
	<?php else: ?>
	<div class="ns-pay-zfb" style="display: none">
	<?php endif; ?>
		<div class="layui-form-item">
			<label class="layui-form-label">用户真实姓名：</label>
			<div class="layui-input-inline">
				<?php if($cert_info['bank_type'] == 2): ?>
				<input name="zfb_settlement_bank_account_name" id="settlement_zfb_account_name" lay-verify="required" type="text" value="<?php echo htmlentities($cert_info['settlement_bank_account_name']); ?>" class="layui-input ns-len-long" autocomplete="off">
				<?php else: ?>
				<input name="zfb_settlement_bank_account_name" id="settlement_zfb_account_name" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
				<?php endif; ?>
			</div>
		</div>

		<div class="layui-form-item" data-flag="area">
			<label class="layui-form-label">支付宝账号：</label>
			<div class="layui-input-inline">
				<?php if($cert_info['bank_type'] == 2): ?>
				<input name="zfb_settlement_bank_account_number" id="settlement_zfb_account_number" lay-verify="required" type="text" value="<?php echo htmlentities($cert_info['settlement_bank_account_number']); ?>" class="layui-input ns-len-long" autocomplete="off">
				<?php else: ?>
				<input name="zfb_settlement_bank_account_number" id="settlement_zfb_account_number" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
				<?php endif; ?>

			</div>
		</div>
	</div>

	<!-- 微信 -->
	<?php if($cert_info['bank_type'] == 3): ?>
	<div class="ns-pay-win">
		<?php else: ?>
		<div class="ns-pay-win" style="display: none">
			<?php endif; ?>
			<div class="layui-form-item">
				<label class="layui-form-label type_3_settlement_bank_account_name"><span class="required">*</span>微信绑定：</label>
				<div class="layui-input-block shop-bind">
					<div class="ns-img-box" style="height: 100px!important;width: auto;">
						<image layer-src src="<?php echo addon_url('admin/shop/shopBindQrcode'); ?>"/>
						<div class="img-load layui-hide">点击重新加载</div>
					</div>
				</div>
				<div class="ns-word-aux">请扫描二维码与微信绑定</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label ns-pay-alipay-name">用户真实姓名：</label>
				<div class="layui-input-inline">
					<?php if($cert_info['bank_type'] == 3): ?>
					<input name="weixin_settlement_bank_account_name" type="text"  id="weixin_settlement_bank_account_name"  value="<?php echo htmlentities($cert_info['settlement_bank_account_name']); ?>" class="layui-input ns-len-long" autocomplete="off">
					<?php else: ?>
					<input name="weixin_settlement_bank_account_name" type="text" id="weixin_settlement_bank_account_name"  value="" class="layui-input ns-len-long" autocomplete="off">
					<?php endif; ?>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">微信昵称：</label>
				<div class="layui-input-inline">
					<?php if($cert_info['bank_type'] == 3): ?>
					<input name="weixin_settlement_bank_address" id="weixin_settlement_bank_address" type="text" value="<?php echo htmlentities($cert_info['settlement_bank_address']); ?>" disabled class="layui-input ns-dis-input ns-len-long" autocomplete="off" lay-verify="required">
					<?php else: ?>
					<input name="weixin_settlement_bank_address" id="weixin_settlement_bank_address" type="text" value="" class="layui-input ns-len-long ns-dis-input" disabled autocomplete="off">
					<?php endif; ?>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">微信账号：</label>
				<div class="layui-input-inline">
					<?php if($cert_info['bank_type'] == 3): ?>
					<input name="weixin_settlement_bank_name" id="weixin_settlement_bank_name"  type="text" value="<?php echo htmlentities($cert_info['settlement_bank_name']); ?>" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
					<?php else: ?>
					<input name="weixin_settlement_bank_name" id="weixin_settlement_bank_name"  type="text" value="" class="layui-input ns-len-long" autocomplete="off">
					<?php endif; ?>
				</div>
			</div>

			<!-- 微信openid -->
			<?php if($cert_info['bank_type'] == 3): ?>
			<input name="weixin_settlement_bank_account_number" value="<?php echo htmlentities($cert_info['settlement_bank_account_number']); ?>" type="hidden" class="layui-input">
			<?php else: ?>
			<input name="weixin_settlement_bank_account_number" value="" type="hidden" class="layui-input">
			<?php endif; ?>
		</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
	
	<input class="ns-bank-type" type="hidden" value="<?php echo htmlentities($cert_info['bank_type']); ?>" />
	<input name="site_id" type="text" lay-verify="" value="<?php echo htmlentities($site_id); ?>" class="layui-input layui-hide">
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
	layui.use(['form', 'laydate'], function() {
		var form = layui.form,
			bankType = "<?php echo htmlentities($cert_info['bank_type']); ?>",
			repeat_flag = false; //防重复标识
		form.render();

		// 监听提交
		form.on('submit(save)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			bankType = data.field.bank_type;
			if(parseInt(bankType) == 2){
				data.field.settlement_bank_account_name = data.field.zfb_settlement_bank_account_name;
				data.field.settlement_bank_account_number = data.field.zfb_settlement_bank_account_number;
			}else if(parseInt(bankType) == 3){
				if (!data.field.weixin_settlement_bank_account_number){
					layer.msg("请先与微信进行绑定");
					return false;
				}
				data.field.settlement_bank_account_name = data.field.weixin_settlement_bank_account_name;
				data.field.settlement_bank_account_number = data.field.weixin_settlement_bank_account_number; //openid
				data.field.settlement_bank_address = data.field.weixin_settlement_bank_address;
				data.field.settlement_bank_name = data.field.weixin_settlement_bank_name;
			}
			$.ajax({
				type: 'POST',
				url: ns.url("admin/shop/settlementInfo"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					repeat_flag = false;
					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("admin/shop/lists")
							},
							btn2: function() {
								location.reload();
							}
						});
					} else {
						layer.msg(res.message);
					}
				}
			});
		});

		/**
		 * 表单验证
		 */
		form.verify({
			bankcard: function(value) {
				var reg = /^([1-9]{1})(\d{14}|\d{18})$/;
				if (value == '') {
					return;
				}
				if (!reg.test(value)) {
					return '请输入正确的银行卡号!';
				}
			}
		});

		form.on('radio(payType)', function(data) { //判断支付方式，显示对应的表单
			var value = data.value;

			$(".ns-pay-zfb").hide();
			$(".ns-pay-win").hide();
			$(".ns-pay-bank").hide();
            if (value == 1) {
				$(".ns-pay-zfb").hide();
				$(".ns-pay-bank").show();
				$(".ns-pay-win").hide();

				$("#settlement_bank_account_name").attr("lay-verify", "required");
				$("#settlement_bank_account_number").attr("lay-verify", "required");
				$("#settlement_bank_name").attr("lay-verify", "required");
				$("#settlement_bank_address").attr("lay-verify", "required");

				$("#settlement_zfb_account_name").attr("lay-verify", "");
				$("#settlement_zfb_account_number").attr("lay-verify", "");

				$("#weixin_settlement_bank_account_name").attr("lay-verify", "");
				$("#weixin_settlement_bank_name").attr("lay-verify", "");
				$("#weixin_settlement_bank_address").attr("lay-verify", "");
            } else  if (value == 2) {

                $(".ns-pay-zfb").show();
				$(".ns-pay-bank").hide();
				$(".ns-pay-win").hide();

				$("#settlement_zfb_account_name").attr("lay-verify", "required");
				$("#settlement_zfb_account_number").attr("lay-verify", "required");

				$("#settlement_bank_name").attr("lay-verify", "");
				$("#settlement_bank_address").attr("lay-verify", "");
				$("#settlement_bank_account_name").attr("lay-verify", "");
				$("#settlement_bank_account_number").attr("lay-verify", "");

				$("#weixin_settlement_bank_account_name").attr("lay-verify", "");
				$("#weixin_settlement_bank_name").attr("lay-verify", "");
				$("#weixin_settlement_bank_address").attr("lay-verify", "");
            }else  if (value == 3){
				$(".ns-pay-win").show();
				$(".ns-pay-bank").hide();
				$(".ns-pay-zfb").hide();

				$("#settlement_bank_account_name").attr("lay-verify", "");
				$("#settlement_bank_account_number").attr("lay-verify", "");
				$("#settlement_bank_name").attr("lay-verify", "");
				$("#settlement_bank_address").attr("lay-verify", "");

				$("#settlement_zfb_account_name").attr("lay-verify", "");
				$("#settlement_zfb_account_number").attr("lay-verify", "");

				$("#weixin_settlement_bank_account_name").attr("lay-verify", "required");
				$("#weixin_settlement_bank_name").attr("lay-verify", "required");
				$("#weixin_settlement_bank_address").attr("lay-verify", "required");
				var intervalId;
				shopBind();

				function shopBind() {
					intervalId = window.setInterval(
							function () {
								$.ajax({
									async: 'false',
									type: 'POST',
									dataType: 'JSON',
									url: "<?php echo url('admin/shop/checkShopBind'); ?>",
									success: function (res) {
										if (res.code == -10001 && res.data.is_expire == 1){
											$(".ns-pay-win .img-load").removeClass("layui-hide");
											clearInterval(intervalId);
											return false;
										}

										if (res.code >= 0){
											$(".ns-pay-win .img-load").removeClass("layui-hide");
											$(".ns-pay-win .img-load").html('恭喜您绑定成功！<p class="ns-text-color">重新绑定</p>');
											$("input[name='weixin_settlement_bank_account_number']").val(res.data.openid)
											$("#weixin_settlement_bank_address").val(res.data.userinfo.nickName);
											$(".weixin-nickname").attr("data-state", res.code);
											$(".weixin-nickname").removeClass("layui-hide");
											clearInterval(intervalId);
											return false;
										}
									}
								});
							}, 500
					);
				}

				$('body').on("click",".ns-pay-win .img-load",function () {
					if(parseInt($(".weixin-nickname").attr("data-state")) >= 0){
						$(".weixin-nickname").addClass("layui-hide");
					}
					$(".ns-pay-win img").attr('src',"<?php echo addon_url('admin/shop/shopBindQrcode'); ?>?time="+ Math.random());
					$(".ns-pay-win .img-load").addClass("layui-hide");
					shopBind();
				});
			}
		});
	});
	
	function back() {
		location.href = ns.url("admin/shop/lists");
	}
</script>

</body>
</html>