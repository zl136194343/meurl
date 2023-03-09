<?php /*a:2:{s:56:"/www/wwwroot/www.hunqin.com/app/shop/view/shop/cert.html";i:1614516272;s:51:"/www/wwwroot/www.hunqin.com/app/shop/view/base.html";i:1654828558;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/shop/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	
<style>
	.layui-table{margin-top: 0;}
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="https://xyhl.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="https://xyhl.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<?php endif; ?>
				</a>
			</div>
			<ul class="layui-nav layui-layout-left">
				<?php foreach($menu as $menu_k => $menu_v): ?>
				<li class="layui-nav-item">
					<a href="<?php echo htmlentities($menu_v['url']); ?>" <?php if($menu_v['selected']): ?>class="active"<?php endif; ?>>
						<span><?php echo htmlentities($menu_v['title']); ?></span>
					</a>
				</li>
				<?php if($menu_v['selected']): 
					$second_menu = $menu_v["child_list"];
					 ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			
			<!-- 账号 -->
			<div class="ns-login-box layui-layout-right">
			<!--	<div class="ns-shop-ewm"> 
					<a href="#" onclick="getShopUrl()">访问店铺</a>
				</div>-->
				
				<ul class="layui-nav ns-head-account">
					<li class="layui-nav-item layuimini-setting">
						<a href="javascript:;">
							<?php echo htmlentities($user_info['username']); ?></a>
						<dl class="layui-nav-child">
							<dd class="ns-reset-pass" onclick="resetPassword();">
								<a href="javascript:;">修改密码</a>
							</dd>
							<dd>
								<a href="<?php echo addon_url('shop/login/logout'); ?>" class="login-out">退出登录</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
		
		
		
		<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
		<div class="layui-side ns-second-nav">
			<div class="layui-side-scroll">
				
				<!--二级菜单 -->
				<ul class="layui-nav layui-nav-tree">
					<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
					<li class="layui-nav-item <?php if($menu_second_v['selected']): ?>layui-this layui-nav-itemed<?php endif; ?>">
						<a href="<?php if(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty())): ?><?php echo htmlentities($menu_second_v['url']); else: ?>javascript:;<?php endif; ?>" class="layui-menu-tips">
							<div class="stair-menu<?php if($menu_v['selected']): ?> ative<?php endif; ?>">
								<img src="https://xyhl.chnssl.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
							</div>
							<span><?php echo htmlentities($menu_second_v['title']); ?></span>
						</a>
						
						<?php if(!(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty()))): ?>
						<dl class="layui-nav-child">
							<?php foreach($menu_second_v["child_list"] as $menu_third_k => $menu_third_v): ?>
							<dd class="<?php if($menu_third_v['selected']): ?> layui-this<?php endif; ?>">
								<a href="<?php echo htmlentities($menu_third_v['url']); ?>" class="layui-menu-tips">
									<i class="fa fa-tachometer"></i><span class="layui-left-nav"><?php echo htmlentities($menu_third_v['title']); ?></span>
								</a>
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
		
		
		<!-- 面包屑 -->
		
		<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
		<div class="ns-crumbs<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?> submenu-existence<?php endif; ?>">
			<span class="layui-breadcrumb" lay-separator="-">
				<?php foreach($crumbs as $crumbs_k => $crumbs_v): if(count($crumbs) >= 3): if($crumbs_k == 1): ?>
					<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
					<?php endif; if($crumbs_k == 2): ?>
					<a><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
					<?php endif; else: if($crumbs_k == 1): ?>
					<a><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
					<?php endif; ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</span>
		</div>
		<?php endif; if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?>
		<div class="ns-body layui-body" style="left: 0; top: 60px;">
		<?php else: ?>
		<div class="ns-body layui-body">
		<?php endif; ?>
			<!-- 内容 -->
			<div class="ns-body-content">
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
			
				
<!--认证类型-->
<table class="layui-table">
	<colgroup>
		<col width="25%">
		<col width="25%">
		<col width="25%">
		<col width="25%">
	</colgroup>
	<thead>
	<tr>
		<th colspan="4">认证类型</th>
	</tr>
	</thead>
	<tbody>

	<tr>
		<td align="right">认证类型：</td>
		<td colspan="3"><?php if($cert_info['cert_type'] == 2): ?>公司认证<?php else: ?>个人认证<?php endif; ?></td>
	</tr>

	</tbody>
</table>

<!-- 公司及联系人信息 -->
<table class="layui-table">
	<colgroup>
		<col width="25%">
		<col width="25%">
		<col width="25%">
		<col width="25%">
	</colgroup>
	<thead>
	<tr>
		<th colspan="4"><?php if($cert_info['cert_type'] == 2): ?>公司信息<?php else: ?>联系人信息<?php endif; ?></th>
	</tr>
	</thead>
	<tbody>
	<?php if($cert_info['cert_type'] == 2): ?>
	<tr>
		<td align="right">公司名称：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['company_name']); ?></td>
	</tr>
	<tr>
		<td align="right">公司所在地：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['company_full_address']); ?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td align="right"><?php if($cert_info['cert_type'] == 2): ?>法人姓名<?php else: ?>联系人姓名<?php endif; ?>：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['contacts_name']); ?></td>
	</tr>
	<tr>
		<td align="right"><?php if($cert_info['cert_type'] == 2): ?>法人手机号<?php else: ?>联系人手机号<?php endif; ?>：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['contacts_mobile']); ?></td>
	</tr>
	<tr>
		<td align="right"><?php if($cert_info['cert_type'] == 2): ?>法人身份证号<?php else: ?>联系人身份证号<?php endif; ?>：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['contacts_card_no']); ?></td>
	</tr>
	<tr>
		<td align="right"><?php if($cert_info['cert_type'] == 2): ?>法人身份证正面<?php else: ?>联系人身份证正面<?php endif; ?>：</td>
		<td>
			<?php if($cert_info['contacts_card_electronic_2']): ?>
			<div class="ns-img-box"><img layer-src src="<?php echo img($cert_info['contacts_card_electronic_2']); ?>" alt=""></div>
			<?php endif; ?>
		</td>
		<td align="right"><?php if($cert_info['cert_type'] == 2): ?>法人身份证反面<?php else: ?>联系人身份证反面<?php endif; ?>：</td>
		<td>
			<?php if($cert_info['contacts_card_electronic_3']): ?>
			<div class="ns-img-box"><img layer-src src="<?php echo img($cert_info['contacts_card_electronic_3']); ?>" alt=""></div>
			<?php endif; ?>
		</td>
	</tr>
	</tbody>
</table>

<!-- 营业执照信息 -->
<?php if($cert_info['cert_type'] == 2): ?>
<table class="layui-table">
	<colgroup>
		<col width="25%">
		<col width="25%">
		<col width="25%">
		<col width="25%">
	</colgroup>
	<thead>
	<tr>
		<th colspan="4">营业执照信息</th>
	</tr>
	</thead>
	<tbody>
	<!-- <?php if(!(empty($cert_info['tax_registration_certificate']) || (($cert_info['tax_registration_certificate'] instanceof \think\Collection || $cert_info['tax_registration_certificate'] instanceof \think\Paginator ) && $cert_info['tax_registration_certificate']->isEmpty()))): ?>
	<tr>
		<td align="right">税务登记证号：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['tax_registration_certificate']); ?></td>
	</tr>
	<?php endif; ?> -->
	<!-- <?php if(!(empty($cert_info['taxpayer_id']) || (($cert_info['taxpayer_id'] instanceof \think\Collection || $cert_info['taxpayer_id'] instanceof \think\Paginator ) && $cert_info['taxpayer_id']->isEmpty()))): ?>
	<tr>
		<td align="right">纳税人识别号：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['taxpayer_id']); ?></td>
	</tr>
	<?php endif; ?> -->
	<tr>
		<td align="right">统一社会信用码：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['business_licence_number']); ?></td>
	</tr>
	<?php if(!(empty($cert_info['business_sphere']) || (($cert_info['business_sphere'] instanceof \think\Collection || $cert_info['business_sphere'] instanceof \think\Paginator ) && $cert_info['business_sphere']->isEmpty()))): ?>
	<tr>
		<td align="right">法定经营范围：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['business_sphere']); ?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td align="right">营业执照电子版：</td>
		<td colspan="3">
			<?php if($cert_info['business_licence_number_electronic']): ?>
			<div class="ns-img-box"><img layer-src src="<?php echo img($cert_info['business_licence_number_electronic']); ?>" alt=""></div>
			<?php endif; ?>
		</td>
	</tr>
	<!-- <?php if(!(empty($cert_info['tax_registration_certificate_electronic']) || (($cert_info['tax_registration_certificate_electronic'] instanceof \think\Collection || $cert_info['tax_registration_certificate_electronic'] instanceof \think\Paginator ) && $cert_info['tax_registration_certificate_electronic']->isEmpty()))): ?>
	<tr>
		<td align="right">税务登记证号电子版：</td>
		<td colspan="3">
			<?php if($cert_info['tax_registration_certificate_electronic']): ?>
			<div class="ns-img-box"><img layer-src src="<?php echo img($cert_info['tax_registration_certificate_electronic']); ?>" alt=""></div>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?> -->
	</tbody>
</table>
<?php endif; ?>

<table class="layui-table">
	<colgroup>
		<col width="25%">
		<col width="25%">
		<col width="25%">
		<col width="25%">
	</colgroup>
	<thead>
	<tr>
		<th colspan="4">银行信息</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="right">银行开户名：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['bank_account_name']); ?></td>
	</tr>
	<tr>
		<td align="right">开户银行账号：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['bank_account_number']); ?></td>
	</tr>
	<tr>
		<td align="right">开户银行支行名称：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['bank_name']); ?></td>
	</tr>
	<?php if(!(empty($cert_info['bank_address']) || (($cert_info['bank_address'] instanceof \think\Collection || $cert_info['bank_address'] instanceof \think\Paginator ) && $cert_info['bank_address']->isEmpty()))): ?>
	<tr>
		<td align="right">开户银行支行所在地：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['bank_address']); ?></td>
	</tr>
	<?php endif; if(!(empty($cert_info['bank_code']) || (($cert_info['bank_code'] instanceof \think\Collection || $cert_info['bank_code'] instanceof \think\Paginator ) && $cert_info['bank_code']->isEmpty()))): ?>
	<tr>
		<td align="right">支行联行号：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['bank_code']); ?></td>
	</tr>
	<?php endif; ?>
	</tbody>
</table>

<table class="layui-table">
	<colgroup>
		<col width="25%">
		<col width="25%">
		<col width="25%">
		<col width="25%">
	</colgroup>
	<thead>
	<tr>
		<th colspan="4">结算账户信息</th>
	</tr>
	</thead>
	<tbody>
	<?php if($cert_info['bank_type'] == 2): ?>
	<tr>
		<td align="right">用户真实姓名：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_account_name']); ?></td>
	</tr>
	<tr>
		<td align="right">支付宝账号：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_account_number']); ?></td>
	</tr>
	<?php elseif($cert_info['bank_type'] == 1): ?>
	<tr>
		<td align="right">结算银行开户名：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_account_name']); ?></td>
	</tr>
	<tr>
		<td align="right">结算公司银行账号：</td>
		<td  colspan="3"><?php echo htmlentities($cert_info['settlement_bank_account_number']); ?></td>
	</tr>
	<tr>
		<td align="right">结算开户银行支行名称：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_name']); ?></td>
	</tr>
	<tr>
		<td align="right">结算开户银行所在地：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_address']); ?></td>
	</tr>
	<?php elseif($cert_info['bank_type'] == 3): ?>
	<tr>
		<td align="right">用户真实姓名：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_account_name']); ?></td>
	</tr>
	<tr>
		<td align="right">微信昵称：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_address']); ?></td>
	</tr>
	<tr>
		<td align="right">微信账号：</td>
		<td colspan="3"><?php echo htmlentities($cert_info['settlement_bank_name']); ?></td>
	</tr>
	<?php endif; ?>
	</tbody>
</table>

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
			<!--	-->
			<!--</div>-->

		</div>
		<!-- </div>	 -->
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
		$("body").on("mouseenter",".pic_ori",function(){
			$(".pic_big").show();
		});
		$("body").on("mouseleave",".pic_ori",function(){
			$(".pic_big").hide();
		});
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
		
		layui.use('element', function() {
			var element = layui.element;
			element.init();
		});

		function getShopUrl(e) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: ns.url("shop/shop/shopUrl"),
				success: function(res) {
					if(res.data.path.h5.status == 1) {
						layui.use('laytpl', function(){
							var laytpl = layui.laytpl;
							
							laytpl($("#shop_h5_preview").html()).render(res.data, function (html) {
								var layerIndex = layer.open({
									title: '访问店铺',
									skin: 'layer-tips-class',
									type: 1,
									area: ['600px', '600px'],
									content: html,
								});
							});
						})
					} else {
						layer.msg(res.data.path.h5.message);
					}
				}
			});
		}
		
	</script>
	
	<!-- 店铺预览 -->
	<script type="text/html" id="shop_h5_preview">
		<div class="goods-preview">
			<img src="{{# if(d.path.weapp.img){ }}{{ ns.img(d.path.weapp.img) }}{{# } }}" alt="推广二维码" class="pic_big">
			<div class="qrcode-wrap">
				{{# if(d.path.h5.img){ }}
				<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
				<p class="tips ns-text-color">扫码访问店铺 <a class="copy_link ns-text-color" href="javascript:ns.copy('h5_preview_1');">复制链接</a></p>
				<br/>
				<input type="text" id="h5_preview_1" value="{{d.path.h5.url}}" readonly />
				{{# } }}
				{{# if(d.path.weapp.img){ }}
				<img src="{{ ns.img(d.path.weapp.img) }}" alt="推广二维码"  class="pic_ori">
				<p class="tips ns-text-color">扫码访问店铺</p>
				{{# } }}
			</div>
			<div class="phone-wrap">
				<div class="iframe-wrap">
					<iframe src="{{ d.path.h5.url }}&preview=1" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</script>


<script src="https://xyhl.chnssl.com/app/admin/view/public/js/address.js"></script>
<script>
	layui.use('form', function() {
		var form = layui.form;
		form.render();
		initArea(form); //初始化三级联动
	});
</script>

</body>

</html>