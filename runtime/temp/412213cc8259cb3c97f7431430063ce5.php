<?php /*a:2:{s:66:"/www/wwwroot/ls.chnssl.com/addon/store/store/view/login/login.html";i:1660101267;s:32:"addon/store/store/view/base.html";i:1614519642;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($store_info['store_name']) && ($store_info['store_name'] !== '')?$store_info['store_name']:"多商户门店")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/addon/store/store/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/addon/store/store/view/public/img/",
			site_id:"<?php echo isset($store_id) ? htmlentities($store_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		.img_size{width:100%;height:100%;}
	</style>
	
<link rel="stylesheet" href="https://ls.chnssl.com/addon/store/store/view/public/css/login.css">

</head>

<body>

<div class="layui-layout layui-layout-admin">
	<div class="apply-header">
		<div class="apply-header-box">
			<div class="apply-header-title">
				<?php if(!(empty($website_info['logo']) || (($website_info['logo'] instanceof \think\Collection || $website_info['logo'] instanceof \think\Paginator ) && $website_info['logo']->isEmpty()))): ?>
				<img src="<?php echo img($website_info['logo']); ?>">
				<?php else: ?>
				<!--<img src="https://ls.chnssl.com/addon/store/store/view/public/img/login/login_logo.png" alt="">-->
				<?php endif; ?>
				<span class="ns-text-color">赞友情门店端</span>
			</div>
			<!--<span class="phone">联系电话：<?php echo htmlentities($website_info['web_phone']); ?> </span>-->
		</div>
	</div>
</div>
<div class="login-body">
	<div class="login-content">
		<span class="shop-icon"></span>
		<div class="logo-box">
			<span>门店登录</span>
		</div>
		<div class="layui-form">
			<div class="login-input login-info">
				<div class="login-icon">
					<img src="https://ls.chnssl.com/addon/store/store/view/public/img/login/login_username.png" alt="">
				</div>
				<input type="text" name="username" lay-verify="userName" placeholder="请输入用户名" autocomplete="off" class="layui-input">
			</div>
			<div class="login-input login-info">
				<div class="login-icon">
					<img src="https://ls.chnssl.com/addon/store/store/view/public/img/login/login_password.png" alt="">
				</div>
				<input type="password" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
			</div>
			<?php if($store_login == 1): ?>
			<div class="login-input login-verification">
				<input type="text" name="captcha" lay-verify="verificationCode" placeholder="请输入验证码" autocomplete="off" class="layui-input">
				<div class="login-verify-code-img">
					<img id='verify_img' src="<?php echo htmlentities($captcha['img']); ?>" alt='captcha' onclick="verificationCode()"/>
				</div>
			</div>
			<?php endif; ?>
			<button id="login_btn" type="button" class="layui-btn ns-bg-color ns-login-btn" lay-submit lay-filter="login">登录</button>

		</div>
	</div>

<!--	<div class="ns-login-bottom">
		<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
		<p>
			<?php if(!(empty($copyright['company_name']) || (($copyright['company_name'] instanceof \think\Collection || $copyright['company_name'] instanceof \think\Paginator ) && $copyright['company_name']->isEmpty()))): ?>
			<a href="<?php if(!(empty($copyright['copyright_link']) || (($copyright['copyright_link'] instanceof \think\Collection || $copyright['copyright_link'] instanceof \think\Paginator ) && $copyright['copyright_link']->isEmpty()))): ?><?php echo htmlentities($copyright['copyright_link']); else: ?>javascript:;<?php endif; ?>" target="_blank"><?php echo htmlentities($copyright['company_name']); ?></a>
			<?php else: ?>
			<a href="https://www.niushop.com" target="_blank">上海牛之云网络科技有限公司</a>
			<?php endif; if(!(empty($copyright['icp']) || (($copyright['icp'] instanceof \think\Collection || $copyright['icp'] instanceof \think\Paginator ) && $copyright['icp']->isEmpty()))): ?>
			<a href="https://beian.miit.gov.cn/" target="_blank">&nbsp;&nbsp;备案号<?php echo htmlentities($copyright['icp']); ?></a>
			<?php endif; ?>
		</p>
		<?php if(!(empty($copyright['gov_record']) || (($copyright['gov_record'] instanceof \think\Collection || $copyright['gov_record'] instanceof \think\Paginator ) && $copyright['gov_record']->isEmpty()))): ?><a class="gov-box" href="<?php echo htmlentities($copyright['gov_url']); ?>" target="_blank"><img src="https://ls.chnssl.com/app/shop/view/public/img/gov_record.png" alt=""><?php echo htmlentities($copyright['gov_record']); ?></a><?php endif; ?>
	</div>-->
</div>




<script type="text/javascript">

	var form,
		login_repeat_flag = false;
	function verificationCode(){
		$.ajax({
			type: "get",
			url: "<?php echo addon_url('store://store/login/captcha'); ?>",
			dataType: "JSON",
			async: false,
			success: function (res) {
				var data = res.data;
				$("#verify_img").attr("src",data.img);
				$("input[name='captcha_id']").val(data.id);
			}
		});
	}


	layui.use('form', function(){
		form = layui.form;

		/* 登录 */
		form.on('submit(login)', function(data) {

			if (login_repeat_flag) return;
			login_repeat_flag = true;

			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: '<?php echo addon_url("store://store/login/login"); ?>',
				data: data.field,
				success: function(res) {

					if (res.code == 0) {
						layer.msg('登录成功',{anim: 5,time: 1000},function () {
							window.location = ns.url('store://store/index/index');
						});
					} else {
						layer.msg(res.message);
						login_repeat_flag = false;
						verificationCode()
					}

				}
			})
		});

		/**
		 * 表单验证
		 */
		form.verify({
			userName: function(value) {
				if (!value.trim()) {
					return "账号不能为空";
				}
			},
			password: function(value) {
				if (!value.trim()) {
					return "密码不能为空";
				}
			},
			verificationCode: function(value) {
				if (!value.trim()) {
					return "验证码不能为空";
				}
			}

		});
	});

	$("body").on("blur",".login-content .login-input",function(){
		$(this).removeClass("ns-border-color");
	});
	$("body").on("focus",".login-content .login-input",function(){
		$(this).addClass("ns-border-color");
	});

	$(document).keydown(function (event) {
		if (event.keyCode == 13) {
			$(".ns-login-btn").trigger("click");
		}
	});
</script>

</body>

</html>