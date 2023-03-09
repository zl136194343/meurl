<?php /*a:2:{s:64:"/www/wwwroot/ls.chnssl.com/addon/city/city/view/login/login.html";i:1614520148;s:57:"/www/wwwroot/ls.chnssl.com/addon/city/city/view/base.html";i:1614520142;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($city_info['title']) && ($city_info['title'] !== '')?$city_info['title']:"多商户城市分站")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'Niushop开源商城')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/addon/city/city/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#27ABFF';
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/public/static/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/addon/city/city/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
	</style>
	
<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/addon/city/city/view/public/css/login.css" />

	<script type="text/javascript">
	</script>
</head>
<body>

<div class="layui-layout layui-layout-admin">
	<div class="layui-header ns-login-top">
		<div class="layui-logo">
			<img src="https://ls.chnssl.com/addon/city/city/view/public/img/login/logo.png" />
			<span class="ns-login-font">开源商城</span>
			<span class="ns-login-split">|</span>
			<span class="ns-text-color ns-login-desc">多商户城市分站管理系统</span>
		</div>
		<ul class="layui-nav layui-layout-right">
			<li class="layui-nav-item">
				<a>联系电话：<?php echo htmlentities($website_info['web_phone']); ?></a>
			</li>
		</ul>
	</div>

	<div class="ns-login-middel">
		<div class="ns-login-box">
			<div class="ns-login-banner">
				<div class="layui-carousel" id="test1">
					<div carousel-item>
						<div class="ns-banner-box">
							<img src="https://ls.chnssl.com/addon/city/city/view/public/img/login/shanghai.png" />
							<p>上海，是中国省级行政区、直辖市、国家中心城市，中国国际经济、金融、贸易、航运、科技创新中心。</p>
						</div>
						<div class="ns-banner-box">
							<img src="https://ls.chnssl.com/addon/city/city/view/public/img/login/wuhan.png" />
							<p>武汉，是湖北省省会，中部六省唯一的副省级市，特大城市，全国重要的工业基地、科教基地和综合交通枢纽 。</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="ns-login-mid"></div>
			
			<div class="layui-form login-form">
				<h1>多商户城市分站管理系统</h1>
				
				<div class="layui-form-item">
					<img class="ns-input-icon" src="https://ls.chnssl.com/app/shop/view/public/img/login/login_username.png" alt="">
					<input type="text" name="username" lay-verify="userName" placeholder="请输入用户名" autocomplete="off" class="layui-input">
				</div>
			
				<div class="layui-form-item">
					<img class="ns-input-icon" src="https://ls.chnssl.com/app/shop/view/public/img/login/login_password.png" alt="">
					<input type="password" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
				</div>
				<?php if($city_login == 1): ?>
				<div class="layui-form-item verify-code-box">
					<input type="text" name="captcha" lay-verify="verificationCode" placeholder="请输入验证码" class="layui-input" value="">
					<div class="verify-code-img">
						<img id='verify_img' src="<?php echo htmlentities($captcha['img']); ?>" alt='captcha' onclick="verificationCode()" />
					</div>
				</div>
				<?php endif; ?>
				<div class="layui-form-item ns-login-btn">
					<button class="layui-btn layui-btn-fluid ns-bg-color" lay-submit lay-filter="login">登 录</button>
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
		<?php if(!(empty($copyright['gov_record']) || (($copyright['gov_record'] instanceof \think\Collection || $copyright['gov_record'] instanceof \think\Paginator ) && $copyright['gov_record']->isEmpty()))): ?><a class="gov-box" href="<?php echo htmlentities($copyright['gov_url']); ?>" target="_blank"><img src="https://ls.chnssl.com/app/shop/view/public/img/gov_record.png" alt=""><?php echo htmlentities($copyright['gov_record']); ?></a><?php endif; ?>
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
	function verificationCode() {
		$.ajax({
			type: "get",
			url: "<?php echo addon_url('city://city/login/captcha'); ?>",
			dataType: "JSON",
			async: false,
			success: function(res) {
				var data = res.data;
				$("#verify_img").attr("src", data.img);
				$("input[name='captcha_id']").val(data.id);
			}
		});
	}

	layui.use('form', function() {
		var form = layui.form,
			repeat_flag = false; //防重复标识

		form.on('submit(login)', function(data) {

			if (repeat_flag) return false;
			repeat_flag = true;

			$.ajax({
				type: "POST",
				url: "<?php echo addon_url('city://city/login/login'); ?>",
				data: data.field,
				dataType: "JSON",
				success: function(res) {
					if (res.code == 0) {
						layer.msg('登录成功', {
							anim: 5,
							time: 1000
						}, function() {
							window.location = "<?php echo addon_url('city://city/index/index'); ?>";
						})
					} else {
						layer.msg(res.message);
						repeat_flag = false;
						verificationCode();
					}
				}
			});
		});

		$(document).keydown(function(event) {
			if (event.keyCode == 13) {
				$(".ns-login-btn button").trigger("click");
			}
		});

		/**
		 * 表单验证
		 */
		form.verify({
			userName: function(value) {
				if (!value) {
					return "用户名不能为空";
				}
			},
			password: function(value) {
				if (!value) {
					return "密码不能为空";
				}
			},
			verificationCode: function(value) {
				if (!value) {
					return "验证码不能为空";
				}
			}

		});
	});
</script>

</body>
</html>