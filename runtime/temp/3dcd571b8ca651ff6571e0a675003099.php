<?php /*a:2:{s:68:"/www/wwwroot/ls.chnssl.com/addon/supply/supply/view/login/login.html";i:1660101875;s:61:"/www/wwwroot/ls.chnssl.com/addon/supply/supply/view/base.html";i:1614519542;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($supply_info['title']) && ($supply_info['title'] !== '')?$supply_info['title']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/addon/supply/supply/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/addon/supply/supply/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/addon/supply/supply/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		.layui-logo{height: 100%;display: flex;align-items: center;}
		.layui-logo a{display: flex;justify-content: center;align-items: center;width: 200px;height: 50px;}
		.layui-logo a img{max-height: 100%;max-width: 100%;}
		.img_size{width:100%;height:100%;}
	</style>
	
<link rel="stylesheet" href="https://ls.chnssl.com/addon/supply/supply/view/public/css/login.css">
<style>
	/* .login-body{background-image: url("<?php echo img('https://ls.chnssl.com/addon/supply/supply/view/public/img/login/login_bg.png'); ?>"); background-size: cover;} */
</style>

</head>

<body>

<div class="layui-layout layui-layout-admin">
	<div class="apply-header">
		<div class="apply-header-box">
			<div class="apply-header-title">
				<a href="<?php echo addon_url('supply://supply/index/index'); ?>">
					<?php if(!(empty($website_info['logo']) || (($website_info['logo'] instanceof \think\Collection || $website_info['logo'] instanceof \think\Paginator ) && $website_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($website_info['logo']); ?>">
					<?php else: ?>
					<!--<img src="https://ls.chnssl.com/addon/supply/supply/view/public/img/shop_logo.png">-->
					<?php endif; ?>
					<span class="ns-text-color">赞友情供应商端</span>
				</a>
			</div>
			<span class="phone">联系电话：<?php echo htmlentities($website_info['web_phone']); ?> </span>
		</div>
	</div>
</div>
<div class="login-body">
	<div class="login-content">
		
		<div class="ns-login-middel">
			<div class="ns-login-box">
				<div class="ns-login-banner">
					<div class="layui-carousel" id="test1">
						<div carousel-item>
							<div class="ns-banner-box">
								<img src="https://ls.chnssl.com/addon/supply/supply/view/public/img/login/supply_1.png" />
								<p>供应商是直接向零售商提供商品及相应服务的企业及分支机构、个体工商户，为平台提供活跃的商品互通机制。</p>
							</div>
							<div class="ns-banner-box">
								<img src="https://ls.chnssl.com/addon/supply/supply/view/public/img/login/supply_2.png" />
								<p>平台创新性的加入求购单，为供求双方提供更多的选择，活跃供货市场、提供更多渠道、丰富商家的商品多样性。</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="ns-login-mid"></div>
				
				<div class="layui-form login-form">
					<h1>供应商管理中心</h1>
					
					<div class="layui-form-item">
						<img class="ns-input-icon" src="https://ls.chnssl.com/app/shop/view/public/img/login/login_username.png" alt="">
						<input type="text" name="username" lay-verify="userName" placeholder="请输入用户名" autocomplete="off" class="layui-input">
					</div>
				
					<div class="layui-form-item">
						<img class="ns-input-icon" src="https://ls.chnssl.com/app/shop/view/public/img/login/login_password.png" alt="">
						<input type="password" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
					</div>
				
					<?php if($supply_login == 1): ?>
					<div class="layui-form-item verify-code-box">
						<input type="text" name="captcha" lay-verify="verificationCode" placeholder="请输入验证码" class="layui-input" value="">
						<div class="verify-code-img">
							<img id='verify_img' src="<?php echo htmlentities($captcha['img']); ?>" alt='captcha' onclick="verificationCode()" />
						</div>
					</div>
					<input type="hidden" name="captcha_id" value="<?php echo htmlentities($captcha['id']); ?>">
					<?php endif; ?>
				
					<div class="layui-form-item">
						<button class="layui-btn layui-btn-fluid ns-bg-color ns-login-btn" lay-submit lay-filter="login">登 录</button>
						<p class="operation-register">还没有成为我们的伙伴？<a href="javascript:;" class="ns-text-color" onclick="register()">&nbsp;申请入驻</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="ns-login-bottom">
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
		<?php if(!(empty($copyright['gov_record']) || (($copyright['gov_record'] instanceof \think\Collection || $copyright['gov_record'] instanceof \think\Paginator ) && $copyright['gov_record']->isEmpty()))): ?><a class="gov-box" href="<?php echo htmlentities($copyright['gov_url']); ?>" target="_blank"><img src="https://ls.chnssl.com/addon/supply/supply/view/public/img/gov_record.png" alt=""><?php echo htmlentities($copyright['gov_record']); ?></a><?php endif; ?>
	</div>
</div>


<script>
	layui.use('carousel', function() {
		var carousel = layui.carousel;
		carousel.render({
			elem: '#test1',
			width: '100%', //设置容器宽度
			arrow: 'none', //始终显示箭头
			anim: 'default' //切换动画方式
		});
	});
</script>
<script type="text/javascript">
	/**
	 * 验证码
	 */
	function verificationCode(){
		$.ajax({
			type: "get",
			url: "<?php echo addon_url('supply://supply/login/captcha'); ?>",
			dataType: "JSON",
			async: false,
			success: function (res) {
				var data = res.data;
				$("#verify_img").attr("src",data.img);
				$("input[name='captcha_id']").val(data.id);
			}
		});
	}

	var form, login_repeat_flag = false;
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
				url: '<?php echo addon_url("supply://supply/login/login"); ?>',
				data: data.field,
				success: function(res) {

					if (res.code == 0) {
						layer.msg('登录成功',{anim: 5,time: 500},function () {
							window.location = ns.url('supply://supply/index/index');
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
		location.href = ns.url("supply://supply/login/register");
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