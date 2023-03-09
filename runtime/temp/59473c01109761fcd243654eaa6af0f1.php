<?php /*a:2:{s:66:"/www/wwwroot/ls.chnssl.com/addon/store/store/view/index/index.html";i:1614519644;s:32:"addon/store/store/view/base.html";i:1654843035;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($store_info['store_name']) && ($store_info['store_name'] !== '')?$store_info['store_name']:"小谷粒门店端")); ?></title>
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
	
<style>
	.layui-card-body{width: 100%; box-sizing: border-box; display: flex; justify-content: space-between;}
	.ns-member {width: 32%; height: 180px; margin-bottom: 20px; box-sizing: border-box; border: 1px solid #E5E5E5; padding: 20px;}
	.ns-member-num{color: red; font-size: 30px; height: 50px; line-height: 50px; margin-top: 30px;}
	.ns-member-title{color: #666666; font-size: 16px;}
	
	/* 门店信息 */
	.ns-survey-shop{display: flex;align-items: center;padding: 20px 0px 35px 20px!important;flex-wrap: nowrap;box-sizing: border-box;}
	.ns-img-box {width: 80px; height: 80px; line-height: 80px; flex-shrink: 0;}
	.ns-surver-shop-detail{max-width: 1164px;display: flex;flex-wrap: wrap;}
	.ns-survey-shop-name {margin-right: 50px; margin-left: 10px; flex-shrink: 0; font-size: 18px;}
	.ns-surver-shop-detail p {width: 340px;line-height: 40px;padding: 0 10px;}
	
	/* 概况*/
	.ns-survey-detail{padding: 20px;margin-top: 20px;}
	.ns-survey-detail-title{display: flex;justify-content: space-between;margin-bottom: 20px;}
	.ns-survey-detail-name{font-size: 18px;}
	.ns-survey-detail-time{color: #999999;}
	.ns-survey-detail-acount{box-sizing: border-box;}
	.ns-survey-detail-con{padding: 35px 20px 0;display: inline-block;width: 33%;height: 180px;box-sizing: border-box;vertical-align: top;}
	.ns-survey-detail-aco{color: #999999;line-height: 30px;}
	.ns-survey-detail-yesterday{color: #333333;line-height: 30px;}
	.ns-survey-detail-num{font-size: 30px;color: red;line-height: 50px;}
	.ns-survey-detail-aim{box-sizing: border-box;padding-left: 50px;}

	.img_size{width:100%;height:100%;}
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-side ns-second-nav">
			<div class="layui-side-scroll">
				<div class="ns-logo">
					<div class="logo-box" id="logo">
						<?php if(!empty($store_info['store_image'])): ?>
						<img layer-src src="<?php echo img($store_info['store_image']); ?>" class="img_size"/>
						<?php else: ?>
						<img layer-src src="<?php echo img($default_img['default_store_img']); ?>" class="img_size"/>
						<?php endif; ?>
					</div>
					<p class="store-name"><?php echo htmlentities($store_info['store_name']); ?></p>
				</div>
				<!--一级菜单 -->
				<ul class="layui-nav layui-nav-tree">
					<?php foreach($menu as $menu_k => $menu_v): ?>
					<li class="layui-nav-item layui-nav-itemed <?php if($menu_v['selected']): ?>layui-this<?php endif; ?>">
						<a href="<?php echo htmlentities($menu_v['url']); ?>" class="layui-menu-tips">
							<div class="stair-menu">
								<img src="https://ls.chnssl.com/<?php echo htmlentities($menu_v['icon']); ?>" alt="">
							</div>
							<span><?php echo htmlentities($menu_v['title']); ?></span>
						</a>
					</li>
					<?php if($menu_v['selected']): 
					$second_menu = $menu_v["child_list"];
					 ?>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		
		<!-- 面包屑 -->
		
		<div class="ns-crumbs<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?> submenu-existence<?php endif; ?>">
			<span class="layui-breadcrumb" lay-separator="-">
				<?php foreach($crumbs as $crumbs_k => $crumbs_v): if($crumbs_k == count($crumbs) - 1): ?>
					<a><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
					<?php else: ?>
					<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</span>
			
			<div class="layui-header ns-user">
				<!-- 账号 -->
				<ul class="layui-nav">
					<li class="layui-nav-item">
						<div class="ns-img-box" id="logo_bot">
							<?php if(!empty($store_info['store_image'])): ?>
							<img layer-src src="<?php echo img($store_info['store_image']); ?>" class="img_size"/>
							<?php else: ?>
							<img layer-src src="<?php echo img($default_img['default_store_img']); ?>" class="img_size"/>
							<?php endif; ?>
						</div>
						
						<a href="javascript:;"><?php echo htmlentities($user_info['username']); ?></a>
						<dl class="layui-nav-child">
							<!-- <dd class="ns-reset-pass" onclick="resetPassword();">
								<a href="javascript:;">修改密码</a>
							</dd> -->
							<dd>
								<a href="<?php echo addon_url('store://store/login/logout'); ?>" class="login-out">退出登录</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
		

		<div class="ns-body layui-body <?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>exist<?php endif; ?>">
			<!-- 四级菜单 -->
			
			<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
			<div class="layui-header">
				<ul class="layui-nav layui-layout-left">
					<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
					<li class="layui-nav-item">
						<a href="<?php echo htmlentities($menu_second_v['url']); ?>" class="layui-menu-tips <?php if($menu_second_v['selected']): ?>layui-this<?php endif; ?>">
							<span><?php echo htmlentities($menu_second_v['title']); ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			

			<!-- 内容 -->
			<div class="ns-body-content">
				
<div class="ns-survey">
	<!-- 门店信息 -->
	<div class="layui-card ns-survey-shop">
		<div class="ns-img-box" id="img">
			<?php if(!empty($store_info['store_image'])): ?>
				<img layer-src src="<?php echo img($store_info['store_image']); ?>" class="img_size"/>
			<?php else: ?>
				<img layer-src src="<?php echo img($default_img['default_store_img']); ?>" class="img_size"/>
			<?php endif; ?>
		</div>
		<p class="ns-survey-shop-name"><strong><?php echo htmlentities($store_info['store_name']); ?></strong></p>
		<div class="ns-surver-shop-detail">
			<p class="ns-line-hiding"><strong>门店名称：</strong><span class="ns-text-color-dark-gray" title="<?php echo htmlentities($store_info['store_name']); ?>"><?php echo htmlentities($store_info['store_name']); ?></span></p>
			<p class="ns-line-hiding"><strong>用户名：</strong><span class="ns-text-color-dark-gray" title="<?php echo htmlentities($user_info['username']); ?>"><?php echo htmlentities($user_info['username']); ?></span></p>
			<p class="ns-line-hiding"><strong>店铺地址：</strong><span class="ns-text-color-dark-gray" title="<?php echo htmlentities($store_info['full_address']); ?>"><?php echo htmlentities($store_info['full_address']); ?></span></p>
			<p class="ns-line-hiding"><strong>联系方式：</strong><span class="ns-text-color-dark-gray" title="<?php echo htmlentities($store_info['telphone']); ?>"><?php echo htmlentities($store_info['telphone']); ?></span></p>
			<p class="ns-line-hiding"><strong>登录时间：</strong><span class="ns-text-color-dark-gray" title="<?php echo date('Y-m-d H:i:s', $user_info['login_time']); ?>"><?php echo date('Y-m-d H:i:s', $user_info['login_time']); ?></span></p>
			<p class="ns-line-hiding"><strong>营业时间：</strong><span class="ns-text-color-dark-gray" title="<?php echo htmlentities($store_info['open_date']); ?>"><?php echo htmlentities($store_info['open_date']); ?></span></p>
		</div>
	</div>
	
	<!-- 概况 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">门店概况</span>
		</div>
		<div class="layui-card-body">
			<div class="ns-member">
				<p class="ns-member-num"><?php echo htmlentities($member_count); ?></p>
				<p class="ns-member-title">门店会员数</p>
			</div>
	
			<div class="ns-member">
				<p class="ns-member-num">￥<?php echo htmlentities($store_info['order_complete_money']); ?></p>
				<p class="ns-member-title">门店订单金额</p>
			</div>
	
			<div class="ns-member">
				<p class="ns-member-num"><?php echo htmlentities($store_info['order_complete_num']); ?></p>
				<p class="ns-member-title">门店订单数</p>
			</div>
		</div>
	</div>

</div>

			</div>

			<!--<div class="ns-footer">
				
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
				
			</div>-->
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
				url: ns.url("shop/login/modifypassword"),
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
		
	</script>


<script>
</script>

</body>

</html>