<?php /*a:2:{s:65:"/www/wwwroot/www.hunqin.com/app/admin/view/member/reg_config.html";i:1614515916;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"婚业汇联管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'婚业汇联管理系统')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/admin/view/public/img/"
		};

	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	.layui-form-item .layui-form-checkbox[lay-skin=primary] {
		margin-top: 0;
	}
	.ns-text-color-red:hover {
		color: red;
	}
	.desc{
		margin-bottom: 15px;border:1px dashed #4685FD;padding: 5px 10px;background: #d9e6ff;color: #4685FD;width: 65%;
	}
	.ns-word-aux{
		width: 50%!important;
	}
</style>

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://xyhl.chnssl.com/app/admin/view/public/img/logo.png">-->
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
						<img src="https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
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
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>规定注册是可选择的类型，注册用户名、密码的规则</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form">
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<div>
				<span class="ns-card-title">普通登录注册设置</span>
			</div>
		</div>
		<div class="layui-card-body">
			<div class="desc">
				设置在非第三方平台(第三方平台是指微信公众号，微信小程序，支付宝小程序等平台内部)或第三方平台自动注册未开启情况下会员的注册登录方式。
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label ">用户名：</label>
				<div class="layui-input-block">
					<input type="checkbox" name="register" value="username" title="注册" lay-skin="primary" <?php if(!empty($value['register']) && in_array('username', $value['register'])): ?>checked<?php endif; ?>>
					<input type="checkbox" name="login" value="username" title="登录" lay-skin="primary" <?php if(!empty($value['login']) && in_array('username', $value['login'])): ?>checked<?php endif; ?>>
				</div>
				<div class="ns-word-aux">用户名是指通过用户名加密码的注册登录方式。</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label ">手机号：</label>
				<div class="layui-input-block">
					<input type="checkbox" name="register" value="mobile" title="注册" lay-skin="primary" <?php if(!empty($value['register']) && in_array('mobile', $value['register'])): ?>checked<?php endif; ?>>
					<input type="checkbox" name="login" value="mobile" title="登录" lay-skin="primary" <?php if(!empty($value['login']) && in_array('mobile', $value['login'])): ?>checked<?php endif; ?>>
				</div>
				<div class="ns-word-aux">手机号是指通过手机号加动态验证码的注册登录方式。</div>
				<div class="ns-word-aux">启用前需配置好“注册验证”，“动态码登录”短信模板，<a href="<?php echo addon_url('admin/message/lists'); ?>" class="ns-text-color" >前去配置</a></div>
			</div>

		</div>
	</div>

	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<div>
				<span class="ns-card-title">第三方平台注册设置</span>
			</div>
		</div>
		<div class="layui-card-body">
			<div class="desc">
				第三方平台注册是指在微信公众号，微信小程序，支付宝小程序等平台下会员的注册方式.
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label ">允许三方平台自动注册：</label>
				<div class="layui-input-block">
					<input type="checkbox" name="third_party" value="1" lay-filter="third_party" lay-skin="switch" <?php if(isset($value['third_party']) && $value['third_party'] == 1): ?> checked <?php endif; ?> >
				</div>
				<div class="ns-word-aux">第三方直接注册是指系统通过获取第三方的粉丝信息直接注册会员，会员用户名随机生成，昵称是第三方获取的用户昵称，注册过程中会将第三方平台获取的信息绑定到注册的会员，方便后期直接自动登录。若关闭，系统将按照普通注册方式注册会员。</div>
				<div class="ns-word-aux ns-text-color">注∶第三方直接注册会员如果不强制绑定手机情况下会导致在不同第三方平台会员无法统一，如果只是在微信环境（微信公众号与微信小程序），可以通过绑定<a href="https://open.weixin.qq.com/" class="ns-text-color" target="_blank">微信开放平台</a>获取unionid实现账户统一。</div>
			</div>

			<div class="layui-form-item <?php if(isset($value['third_party']) && $value['third_party'] != 1): ?>layui-hide<?php endif; ?>" id="bindMobile">
				<label class="layui-form-label ">是否强制绑定手机：</label>
				<div class="layui-input-block">
					<input type="checkbox" name="bind_mobile" value="1" lay-filter="bind_mobile" lay-skin="switch" <?php if(isset($value['bind_mobile']) && $value['bind_mobile'] == 1): ?> checked <?php endif; ?> >
				</div>
				<div class="ns-word-aux">为了实现不同的第三方平台用户账户的统一，需要在注册过程中强制绑定用户手机，通过手机实现微信平台与支付宝平台，抖音平台等账号的统一。开启之后在对应会员相关页面会引导会员绑定手机账号。</div>
				<div class="ns-word-aux">启用前需配置好“账户绑定”短信模板，<a href="<?php echo addon_url('admin/message/lists'); ?>" class="ns-text-color" >前去配置</a></div>
			</div>
		</div>
	</div>

	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<div>
				<span class="ns-card-title">密码设置</span>
			</div>
		</div>
		<div class="layui-card-body">

			<div class="layui-form-item">
				<label class="layui-form-label ">密码最小长度：</label>
				<div class="layui-input-block">
					<input type="number" min="0" name="pwd_len" class="layui-input ns-len-short" lay-verify="pwd_lens" value="<?php echo htmlentities($value['pwd_len']); ?>">
				</div>
				<div class="ns-word-aux">新用户注册时密码最小长度，0或不填为不限制</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label ">密码复杂程度设置：</label>
				<div class="layui-input-block" id="pwd_complexity">
					<input type="checkbox" name="pwd_complexity" value="number" title="数字" lay-skin="primary" <?php if(!empty($value) && in_array('number', $value['pwd_complexity_arr'])): ?>checked<?php endif; ?>>
					<input type="checkbox" name="pwd_complexity" value="letter" title="小写字母" lay-skin="primary" <?php if(!empty($value) && in_array('letter', $value['pwd_complexity_arr'])): ?>checked<?php endif; ?>>
					<input type="checkbox" name="pwd_complexity" value="upper_case" title="大写字母" lay-skin="primary" <?php if(!empty($value) && in_array('upper_case', $value['pwd_complexity_arr'])): ?>checked<?php endif; ?>>
					<input type="checkbox" name="pwd_complexity" value="symbol" title="符号" lay-skin="primary" <?php if(!empty($value) && in_array('symbol', $value['pwd_complexity_arr'])): ?>checked<?php endif; ?>>
				</div>
				<div class="ns-word-aux">设置密码复杂度</div>
			</div>
		</div>
	</div>

	<div class="ns-form-row">
		<button type="button" class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
	</div>
</div>

			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
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
            repeat_flag = false; //防重复
        form.render();

        form.on('submit(save)', function(data) {
            var pwd_complexity_array = [], register = [], login = [];

            $("#pwd_complexity input:checked").each(function(){
                pwd_complexity_array.push($(this).val())
            });

            $("[name='register']:checked").each(function(){
                register.push($(this).val())
            });

            $("[name='login']:checked").each(function(){
                login.push($(this).val())
            });

            if (login.length == 0){
                layer.msg('请至少启用一种登录方式', {icon: 5});
                return false;
            }

            data.field.register = register.toString();
            data.field.login = login.toString();
            data.field.pwd_complexity = pwd_complexity_array.toString();

            if (repeat_flag) return;
            repeat_flag = true;

            $.ajax({
                url: ns.url("admin/member/regConfig"),
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(res) {
                    layer.msg(res.message);
                    repeat_flag = false;
                    if (res.code == 0) {
                        location.reload();
                    }
                }
            });
        });

        form.on('switch(third_party)', function(data) {
            if($(data.elem).is(':checked')){
                $('#bindMobile').removeClass('layui-hide');
            } else {
                $('#bindMobile').addClass('layui-hide');
            }
        });

        /**
         * 表单验证
         */
        form.verify({
            pwd_lens: function(value, item){ //value：表单的值、item：表单的DOM对象
                if(!new RegExp("^[0-9]*$").test(value)){
                    return '密码长度只能是正整数！';
                }
            }
        });

    });
</script>

</body>
</html>