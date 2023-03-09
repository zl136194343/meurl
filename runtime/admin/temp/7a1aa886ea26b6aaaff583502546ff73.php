<?php /*a:2:{s:70:"/www/wwwroot/www.hunqin.com/app/admin/view/shopapply/apply_detail.html";i:1667464071;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
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
	
<style type="text/css">
	.layui-input-block input,
	.layui-input-block input,
	.layui-input-block textarea {outline: none;border: none;}
	.ns-form-row{margin-top: 0;}
	.ns-store-company{margin-top: 10px;}
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
				
<div class="layui-form">
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">店铺信息</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>店铺名称：</label>
				<div class="layui-input-block">
					<input disabled name="shop_name" type="text" value="<?php echo htmlentities($apply_detail['shop_name']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>主营行业：</label>
				<div class="layui-input-block ns-len-mid">
					<input disabled name="category_name" type="text" value="<?php echo htmlentities($apply_detail['category_name']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>开店套餐：</label>
				<div class="layui-input-block ns-len-mid">
					<input disabled name="group_name" type="text" value="<?php echo htmlentities($apply_detail['group_name']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">入驻时长：</label>
				<div class="layui-input-block">
					<p class="ns-input-text">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($apply_detail['apply_year']); ?> 年</p>
				</div>
			</div>

			<div class="layui-form-item ns-check-member-box">
				<label class="layui-form-label">申请会员：</label>
				<div class="layui-input-block ns-len-mid">
					<input disabled name="member_name" type="text" value="<?php echo htmlentities($apply_detail['username']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>
		</div>
	</div>
	
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">认证类型</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">认证类型：</label>
				<div class="layui-input-block ns-len-mid">
					<?php if($apply_detail['cert_type'] == 1): ?>
					<input disabled type="text" name="cert_type" value="个人店铺" autocomplete="off" class="layui-input ns-len-small">
					<?php endif; if($apply_detail['cert_type'] == 2): ?>
					<input disabled type="text" name="cert_type" value="企业店铺" autocomplete="off" class="layui-input ns-len-small">
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- 联系人手机号身份证 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">法人信息</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label ns-company-name">联系人姓名：</label>
				<div class="layui-input-block">
					<input disabled name="contacts_name" type="text" value="<?php echo htmlentities($apply_detail['contacts_name']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label ns-company-phone">联系人电话：</label>
				<div class="layui-input-block">
					<input disabled name="contacts_mobile" type="text" value="<?php echo htmlentities($apply_detail['contacts_mobile']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label ns-company-ident">联系人身份证号：</label>
				<div class="layui-input-block">
					<input disabled name="contacts_card_no" type="text" value="<?php echo htmlentities($apply_detail['contacts_card_no']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable ns-company-pic-front">申请人身份证正面：</label>
				<div class="layui-input-block img-upload">
					<div class="upload-img-block icon">
						<div class="upload-img-box" id="idCardPicFront">
							<img layer-src src="<?php echo img($apply_detail['contacts_card_electronic_2']); ?>" alt="">
						</div>
					</div>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable ns-company-pic-back">申请人身份证反面：</label>
				<div class="layui-input-block img-upload">
					<div class="upload-img-block icon">
						<div class="upload-img-box" id="idCardPicBack">
							<img layer-src src="<?php echo img($apply_detail['contacts_card_electronic_3']); ?>" alt="">
						</div>
					</div>
				</div>
			</div>
			<!--<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable ns-company-pic-sc">申请人手持身份证：</label>
				<div class="layui-input-block img-upload">
					<div class="upload-img-block icon">
						<div class="upload-img-box" id="idCardPicSc">
							<img layer-src src="<?php echo img($apply_detail['contacts_card_electronic_1']); ?>" alt="">
						</div>
					</div>
				</div>
			</div>-->
		</div>
	</div>
	
	<!-- 企业店铺独有 -->
	<?php if($apply_detail['cert_type'] == 2): ?>
	<div class="ns-store-company">
		<!-- 公司信息 -->
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">企业信息</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">公司名称：</label>
					<div class="layui-input-block">
						<input disabled name="company_name" type="text" value="<?php echo htmlentities($apply_detail['company_name']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label">公司地址：</label>
					<div class="layui-input-block ns-len-small">
						<input disabled name="company_address" type="text" value="<?php echo htmlentities($apply_detail['company_full_address']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
			</div>
		</div>
		
		<!-- 营业执照 税务 -->
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">企业资质</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">统一社会信用码：</label>
					<div class="layui-input-block">
						<input disabled name="business_licence_number" type="text" value="<?php echo htmlentities($apply_detail['business_licence_number']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label img-upload-lable">营业执照电子版：</label>
					<div class="layui-input-block img-upload">
						<div class="upload-img-block icon">
							<div class="upload-img-box" id="license">
								<img layer-src src="<?php echo img($apply_detail['business_licence_number_electronic']); ?>" alt="">
							</div>
						</div>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">法定经营范围：</label>
					<div class="layui-input-block ns-len-mid">
						<p name="business_sphere" class="ns-input-text" disabled><?php echo htmlentities($apply_detail['business_sphere']); ?></p>
					</div>
				</div>
				
				<!-- <div class="layui-form-item">
					<label class="layui-form-label">税务登记证号：</label>
					<div class="layui-input-block">
						<input disabled name="tax_registration_certificate" type="text" value="<?php echo htmlentities($apply_detail['tax_registration_certificate']); ?>"
						 class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label img-upload-lable">税务登记证号电子版：</label>
					<div class="layui-input-block img-upload">
						<input disabled type="hidden" class="layui-input" name="tax_registration_certificate_electronic" />
						<div class="upload-img-block icon">
							<div class="upload-img-box" id="taxlicense">
								<img layer-src src="<?php echo img($apply_detail['tax_registration_certificate_electronic']); ?>" alt="">
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
		
		<!-- 对公账户信息 -->
		<!--<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">对公账户</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">银行开户名：</label>
					<div class="layui-input-block">
						<input disabled name="bank_account_name" type="text" value="<?php echo htmlentities($apply_detail['bank_account_name']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">公司银行账号：</label>
					<div class="layui-input-block">
						<input disabled name="bank_account_number" type="text" value="<?php echo htmlentities($apply_detail['bank_account_number']); ?>"
						 class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">开户银行支行名称：</label>
					<div class="layui-input-block">
						<input disabled name="bank_name" type="text" value="<?php echo htmlentities($apply_detail['bank_name']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label">开户银行所在地：</label>
					<div class="layui-input-block ns-len-small">
						<input disabled name="bank_address" type="text" value="<?php echo htmlentities($apply_detail['bank_address']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
			</div>
		</div>-->
		<?php endif; ?>
		
		<!-- 结算信息 -->
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">结算信息</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">结算账户类型：</label>
					<div class="layui-input-block ns-len-mid">
						<?php if($apply_detail['bank_type'] == 1): ?>
						<input disabled name="bank_type" type="text" value="银行卡" class="layui-input ns-len-mid">
						<?php elseif($apply_detail['bank_type'] == 2): ?>
						<input disabled name="bank_type" type="text" value="支付宝" class="layui-input ns-len-mid">
						<?php elseif($apply_detail['bank_type'] == 3): ?>
						<input disabled name="bank_type" type="text" value="微信" class="layui-input ns-len-mid">
						<?php endif; ?>
					</div>
				</div>
				
				<?php if($apply_detail['bank_type'] == 1): ?>
				<!-- 银行卡 -->
				<div class="ns-pay-bank">
					<div class="layui-form-item">
						<label class="layui-form-label">结算银行开户名：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_account_name" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_account_name']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				
					<div class="layui-form-item">
						<label class="layui-form-label">结算公司银行账号：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_account_number" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_account_number']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				
					<div class="layui-form-item">
						<label class="layui-form-label">结算开户银行支行名称：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_name" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_name']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				
					<div class="layui-form-item" data-flag="area">
						<label class="layui-form-label">结算开户银行所在地：</label>
						<div class="layui-input-block ns-len-small">
							<input disabled name="settlement_bank_address" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_address']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				</div>
				<?php elseif($apply_detail['bank_type'] == 2): ?>
				<!-- 支付宝 -->
				<div class="ns-pay-alipay">
					<div class="layui-form-item">
						<label class="layui-form-label">用户真实姓名：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_account_name" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_account_name']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				
					<div class="layui-form-item">
						<label class="layui-form-label">支付宝账号：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_account_number" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_account_number']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				</div>
				<?php elseif($apply_detail['bank_type'] == 3): ?>
				<!-- 微信 -->
				<div class="ns-pay-bank">
					<div class="layui-form-item">
						<label class="layui-form-label">用户真实姓名：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_account_name" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_account_name']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>

					<div class="layui-form-item" data-flag="area">
						<label class="layui-form-label">微信昵称：</label>
						<div class="layui-input-block ns-len-small">
							<input disabled name="settlement_bank_address" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_address']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">微信账户：</label>
						<div class="layui-input-block">
							<input disabled name="settlement_bank_name" type="text" value="<?php echo htmlentities($apply_detail['settlement_bank_name']); ?>" class="layui-input ns-len-mid">
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">审核状态</span>
			</div>
			<div class="layui-card-body">
				<?php if($apply_detail['apply_state'] == 1): ?>
				<div class="layui-form-item">
					<label class="layui-form-label">审核状态：</label>
					<div class="layui-input-block">
						<input disabled name="apply_state" type="text" value="认证信息审核中" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="ns-form-row">
					<button class="layui-btn ns-bg-color" lay-submit lay-filter="apply_pass">同意申请</button>
					<button class="layui-btn ns-bg-color" lay-submit lay-filter="apply_message">拒绝申请</button>
					<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
				</div>
				<?php endif; if($apply_detail['apply_state'] == -1): ?>
				<div class="layui-form-item">
					<label class="layui-form-label">审核状态：</label>
					<div class="layui-input-block">
						<input disabled name="apply_state" type="text" value="认证信息审核失败" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">拒绝理由：</label>
					<div class="layui-input-block">
						<input disabled name="apply_message" type="text" value="<?php echo htmlentities($apply_detail['apply_message']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="ns-form-row">
					<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
				</div>
				<?php endif; if($apply_detail['apply_state'] == 2): ?>
				<div class="layui-form-item">
					<label class="layui-form-label">审核状态：</label>
					<div class="layui-input-block">
						<input disabled name="apply_state" type="text" value="财务审核" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="ns-form-row">
					<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
				</div>
				<?php endif; if($apply_detail['apply_state'] == -2): ?>
				<div class="layui-form-item">
					<label class="layui-form-label">审核状态：</label>
					<div class="layui-input-block">
						<input disabled name="apply_state" type="text" value="财务审核失败" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">拒绝理由：</label>
					<div class="layui-input-block">
						<input disabled name="apply_message" type="text" value="<?php echo htmlentities($apply_detail['apply_message']); ?>" class="layui-input ns-len-mid">
					</div>
				</div>
				
				<div class="ns-form-row">
					<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
				</div>
				<?php endif; if($apply_detail['apply_state'] == 3): ?>
				<div class="layui-form-item">
					<label class="layui-form-label">审核状态：</label>
					<div class="layui-input-block">
						<input disabled name="apply_state" type="text" value="入驻通过" class="layui-input ns-len-mid">
					</div>
				</div>

				<div class="ns-form-row">
					<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
				</div>
				<?php endif; ?>
			</div>
		</div>

			<?php if($apply_detail['apply_state'] == 2): ?>
		<!-- <div class="ns-single-filter-box">

			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="open_shop">入驻通过</button>
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="edit_apply">修改资料</button>
				<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
			</div>
		</div> -->
			<?php endif; ?>

		<input name="apply_id" type="text" value="<?php echo htmlentities($apply_detail['apply_id']); ?>" class="layui-input layui-hide">
		<input id="cert_type" type="text" value="<?php echo htmlentities($apply_detail['cert_type']); ?>" class="layui-input layui-hide">
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
		layui.use(['form'], function() {
			var form = layui.form;

			// 同意申请
			form.on('submit(apply_pass)', function(data) {
				layer.confirm('确定要通过审核吗?', function() {

					$.ajax({
						url: ns.url("admin/shopapply/applyPass"),
						data: {
							"apply_id": data.field.apply_id,
						},
						dataType: 'JSON', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						success: function(res) {
							layer.msg(res.message);
							if (res.code == 0) {
								location.reload();
							}
						}
					});
				});
			});
			
			// 拒绝申请
			form.on('submit(apply_message)', function(data) {
				/**
				 * 拒绝理由弹窗
				 */
				layer.prompt({
					formType: 2,
					value: '',
					title: '请输入拒绝理由',
					area: ['300px', '100px'], //自定义文本域宽高
					yes: function(index, layero) {
						// 获取文本框输入的值
						var value = layero.find(".layui-layer-input").val();
						
						if (value) {
							$.ajax({
								url: ns.url("admin/shopapply/applyReject"),
								data: {
									"apply_id": data.field.apply_id,
									"reason": value
								},
								dataType: 'JSON', //服务器返回json格式数据
								type: 'POST', //HTTP请求类型
								success: function(res) {
									layer.msg(res.message);
									if (res.code == 0) {
										location.reload();
									}
								}
							});
							layer.close(index);
						} else {
							layer.msg('请输入拒绝原因!', {icon: 5, anim: 6});
						}
					}
				});
			});
		});
	
	
		$(function() {
			if ($('#cert_type').val() == 1) {
				$(".ns-company-person").text("联系人信息：");
				$(".ns-company-name").text("联系人姓名：");
				$(".ns-company-phone").text("联系人电话：");
				$(".ns-company-identity").text("联系人身份证件：");
				$(".ns-company-ident").text("联系人身份证号：");
				$(".ns-company-pic-front").text("申请人身份证正面：");
				$(".ns-company-pic-back").text("申请人身份证反面：");
				$(".ns-company-pic-sc").text("申请人手持身份证：");
			} else {
				$(".ns-company-person").text("法人代表信息：");
				$(".ns-company-name").text("法人姓名：");
				$(".ns-company-phone").text("法人联系电话：");
				$(".ns-company-identity").text("法人身份证件：");
				$(".ns-company-ident").text("法人身份证号：");
				$(".ns-company-pic-front").text("法人身份证正面：");
				$(".ns-company-pic-back").text("法人身份证反面：");
			}
		});

		function back() {
			location.href = ns.url("admin/shopapply/apply")
		}

		//初始化地址
		var company_province_id = "<?php echo htmlentities($apply_detail['company_province_id']); ?>",
			company_city_id = "<?php echo htmlentities($apply_detail['company_city_id']); ?>",
			company_district_id = "<?php echo htmlentities($apply_detail['company_district_id']); ?>",
			company_address = "<?php echo htmlentities($apply_detail['company_address']); ?>",
			address = "";
	</script>

</body>
</html>