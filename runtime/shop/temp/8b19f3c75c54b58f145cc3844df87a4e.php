<?php /*a:2:{s:65:"D:\phpstudy_pro\WWW\www.hunqin.com\app\shop\view\login\login.html";i:1666231231;s:58:"D:\phpstudy_pro\WWW\www.hunqin.com\app\shop\view\base.html";i:1654828558;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://www.hunqin.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://www.hunqin.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://www.hunqin.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://www.hunqin.com/app/shop/view/public/css/common.css" />
	<script src="https://www.hunqin.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://www.hunqin.com/public/static/ext/layui/layui.js"></script>
	<script src="https://www.hunqin.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://www.hunqin.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://www.hunqin.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://www.hunqin.com/public/static/js/common.js"></script>
	<script src="https://www.hunqin.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://www.hunqin.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		.layui-logo{height: 100%;display: flex;align-items: center;}
		.layui-logo a{display: flex;justify-content: center;align-items: center;width: 200px;height: 50px;}
		.layui-logo a img{max-height: 100%;max-width: 100%;}
		.goods-preview .qrcode-wrap {max-width: 130px;  overflow: hidden;}
		.goods-preview .qrcode-wrap input {top: 300px;position: absolute;}
		@media only screen and (max-width: 1340px) {
			.layui-nav .layui-nav-item a {
				padding: 0 15px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 1200px) {
			.layui-nav .layui-nav-item a {
				padding: 0 10px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 920px) {
			.layui-nav .layui-nav-item a {
				padding: 0 5px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 1090px) {
			.ns-shop-ewm {
				display: none;
			}
		}
		.copy_link{cursor:pointer;}
		.goods-preview{position: relative;}
		.pic_big{display:none;width:220px !important;height:220px !important;margin:auto;position: absolute;left:0;top:0;z-index:100;}
		.pic_ori:hover .pic_big{display:block;}
	</style>
	
<link rel="stylesheet" href="https://www.hunqin.com/app/shop/view/public/css/login.css">
<style>
	/* .login-body{background-image: url("<?php echo img('https://www.hunqin.com/app/shop/view/public/img/login/login_bg.png'); ?>"); background-size: cover;} */
</style>

</head>

<body>

<div class="layui-layout layui-layout-admin">
	<div class="apply-header">
		<div class="apply-header-box">
			<div class="apply-header-title">
				<a href="<?php echo url('shop/index/index'); ?>">
<!--					<?php if(!(empty($website_info['logo']) || (($website_info['logo'] instanceof \think\Collection || $website_info['logo'] instanceof \think\Paginator ) && $website_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($website_info['logo']); ?>">
					<?php else: ?>
					<img src="https://www.hunqin.com/app/shop/view/public/img/shop_logo.png">
					<?php endif; ?>-->
					<span class="ns-text-color">婚业汇联店铺端</span>
				</a>
			</div>
			<!--<span class="phone">联系电话：<?php echo htmlentities($website_info['web_phone']); ?> </span>-->
		</div>
	</div>
</div>
<div class="login-body">
	<div class="login-content">
		<h2>商家登录</h2>
<!--		<h3>登录之后可进入店铺或申请入驻</h3>-->
		<div class="layui-form">
			<div class="login-input login-info">
				<div class="login-icon">
					<img src="https://www.hunqin.com/app/shop/view/public/img/login/login_username.png" alt="">
				</div>
				<input type="text" name="username" lay-verify="userName" placeholder="请输入用户名" autocomplete="off" class="layui-input">
			</div>
			<div class="login-input login-info">
				<div class="login-icon">
					<img src="https://www.hunqin.com/app/shop/view/public/img/login/login_password.png" alt="">
				</div>
				<input type="password" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
			</div>
			<?php if($shop_login == 1): ?>
			<div class="login-input login-verification">
				<input type="text" name="captcha" lay-verify="verificationCode" placeholder="请输入验证码" autocomplete="off" class="layui-input">
				<div class="login-verify-code-img">
					<img id='verify_img' src="<?php echo htmlentities($captcha['img']); ?>" alt='captcha' onclick="verificationCode()"/>
				</div>
			</div>
			<input type="hidden" name="captcha_id" value="<?php echo htmlentities($captcha['id']); ?>">
			<?php endif; ?>
			<button id="login_btn" type="button" class="layui-btn ns-bg-color ns-login-btn" lay-submit lay-filter="login">登录</button>
			<!--<p class="operation-register">还没有成为我们的伙伴？<a href="javascript:register();" class="ns-text-color">&nbsp;申请入驻</a></p>-->
		</div>
	</div>

	<!--<div class="ns-login-bottom">
		<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://www.hunqin.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
		<p>
			<?php if(!(empty($copyright['company_name']) || (($copyright['company_name'] instanceof \think\Collection || $copyright['company_name'] instanceof \think\Paginator ) && $copyright['company_name']->isEmpty()))): ?>
			<a href="<?php if(!(empty($copyright['copyright_link']) || (($copyright['copyright_link'] instanceof \think\Collection || $copyright['copyright_link'] instanceof \think\Paginator ) && $copyright['copyright_link']->isEmpty()))): ?><?php echo htmlentities($copyright['copyright_link']); else: ?>javascript:;<?php endif; ?>" target="_blank"><?php echo htmlentities($copyright['company_name']); ?></a>
			<?php else: ?>
			<a href="https://www.niushop.com" target="_blank">榕森信息</a>
			<?php endif; if(!(empty($copyright['icp']) || (($copyright['icp'] instanceof \think\Collection || $copyright['icp'] instanceof \think\Paginator ) && $copyright['icp']->isEmpty()))): ?>
			<a href="https://beian.miit.gov.cn/" target="_blank">&nbsp;&nbsp;备案号<?php echo htmlentities($copyright['icp']); ?></a>
			<?php endif; ?>
		</p>
		<?php if(!(empty($copyright['gov_record']) || (($copyright['gov_record'] instanceof \think\Collection || $copyright['gov_record'] instanceof \think\Paginator ) && $copyright['gov_record']->isEmpty()))): ?><a class="gov-box" href="<?php echo htmlentities($copyright['gov_url']); ?>" target="_blank"><img src="https://www.hunqin.com/app/shop/view/public/img/gov_record.png" alt=""><?php echo htmlentities($copyright['gov_record']); ?></a><?php endif; ?>
	</div>-->
</div>


<script type="text/javascript">
	var form, login_repeat_flag = false;
	/**
	 * 验证码
	 */
	function verificationCode(){
		$.ajax({
			type: "get",
			url: "<?php echo url('shop/login/captcha'); ?>",
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
		form.render();

		/* 登录 */
		form.on('submit(login)', function(data) {

			if (login_repeat_flag) return;
			login_repeat_flag = true;

			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: '<?php echo url("shop/login/login"); ?>',
				data: data.field,
				success: function(res) {

					if (res.code == 0) {
						layer.msg('登录成功',{anim: 5,time: 500},function () {
							window.location = ns.url('shop/index/index');
						});
					} else {
						layer.msg(res.message);
						login_repeat_flag = false;
						verificationCode();
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

	function register(){
		location.href = ns.url("shop/login/register");
	}
	
	$("body").on("blur",".login-content .login-input",function(){
		$(this).removeClass("login-input-select");
	});
	$("body").on("focus",".login-content .login-input",function(){
		$(this).addClass("login-input-select");
	});

	$(document).keydown(function (event) {
		if (event.keyCode == 13) {
			$(".ns-login-btn").trigger("click");
		}
	});
</script>

</body>

</html>