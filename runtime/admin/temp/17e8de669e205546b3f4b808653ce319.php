<?php /*a:2:{s:61:"/www/wwwroot/ls.chnssl.com/app/admin/view/shop/cert_info.html";i:1614515996;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
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
	.cert-info-name { line-height: 34px; }
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
			<span class="ns-card-title">申请类型</span>
		</div>
		
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">申请类型：</label>
				<div class="layui-input-block ns-len-mid">
					<p class="cert-info-name"><?php echo $cert_info['cert_type']==1 ? '个人店铺'  :  '企业店铺'; ?></p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 企业店铺独有 -->
	<?php if($cert_info['cert_type'] == 2): ?>
	<!-- 公司信息 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">企业信息</span>
		</div>
		
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">公司名称：</label>
				<div class="layui-input-block">
					<input name="company_name" type="text" value="<?php echo htmlentities($cert_info['company_name']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item" data-flag="area">
				<label class="layui-form-label">公司地址：</label>
				<div class="layui-input-inline ns-len-mid">
					<select name="company_province_id" data-type="province" data-init="<?php echo htmlentities($cert_info['company_province_id']); ?>" lay-filter="comProvince"></select>
				</div>
				<div class="layui-input-inline ns-len-mid">
					<select name="company_city_id" data-type="city" data-init="<?php echo htmlentities($cert_info['company_city_id']); ?>" lay-filter="comCity"></select>
				</div>
				<div class="layui-input-inline ns-len-mid">
					<select name="company_district_id" data-type="district" data-init="<?php echo htmlentities($cert_info['company_district_id']); ?>" lay-filter="comDistrict"></select>
				</div>
				<!-- <div class="layui-input-inline">
					<input name="company_address" type="text" value="<?php echo htmlentities($cert_info['company_address']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div> -->
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label"></label>
				<div class="layui-input-inline">
					<input name="company_address" type="text" value="<?php echo htmlentities($cert_info['company_address']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- 公共部分 -->
	<!-- 联系人手机号身份证 -->
	<!-- 联系人信息 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<?php if($cert_info['cert_type'] == 1): ?>
			<span class="ns-card-title">联系人信息</span>
			<?php else: ?>
			<span class="ns-card-title">法人代表信息</span>
			<?php endif; ?>
		</div>
		
		<div class="layui-card-body">
			<div class="layui-form-item">
				<?php if($cert_info['cert_type'] == 1): ?>
				<label class="layui-form-label">联系人姓名：</label>
				<?php else: ?>
				<label class="layui-form-label">法人姓名：</label>
				<?php endif; ?>
				<div class="layui-input-block">
					<input name="contacts_name" type="text" value="<?php echo htmlentities($cert_info['contacts_name']); ?>" class="layui-input ns-len-mid" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item">
				<?php if($cert_info['cert_type'] == 1): ?>
				<label class="layui-form-label">联系人手机：</label>
				<?php else: ?>
				<label class="layui-form-label">法人联系电话：</label>
				<?php endif; ?>
				<div class="layui-input-block">
					<input name="contacts_mobile" type="text" lay-verify="mobile" value="<?php echo htmlentities($cert_info['contacts_mobile']); ?>" class="layui-input ns-len-mid" autocomplete="off">
				</div>
			</div>
		</div>
	</div>
	
	<!-- 企业店铺独有 -->
	<?php if($cert_info['cert_type'] == 2): ?>
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">企业资质</span>
		</div>
		
		<div class="layui-card-body">
			<!-- 营业执照 税务 -->
			<div class="layui-form-item">
				<label class="layui-form-label">统一社会信用码：</label>
				<div class="layui-input-block">
					<input name="business_licence_number" type="text" value="<?php echo htmlentities($cert_info['business_licence_number']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable">营业执照电子版：</label>
				<div class="layui-input-block">
					<div class="upload-img-block img-upload">
						<div class="upload-img-box <?php if(!(empty($cert_info['business_licence_number_electronic']) || (($cert_info['business_licence_number_electronic'] instanceof \think\Collection || $cert_info['business_licence_number_electronic'] instanceof \think\Paginator ) && $cert_info['business_licence_number_electronic']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="license">
								<?php if($cert_info['business_licence_number_electronic']): ?>
								<div id="preview_license" class="preview_img">
									<img layer-src src="<?php echo img($cert_info['business_licence_number_electronic']); ?>" class="img_prev"/>
								</div>
								<?php else: ?>
								<div class="upload">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
									<p>点击上传</p>
								</div>
								<?php endif; ?>
							</div>
							<div class="operation">
								<div>
									<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
									<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
								</div>
								<div class="replace_img js-replace">点击替换</div>
							</div>
							<input type="hidden" name="business_licence_number_electronic" value="<?php echo htmlentities($cert_info['business_licence_number_electronic']); ?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">法定经营范围：</label>
				<div class="layui-input-inline ns-len-long">
					<textarea name="business_sphere" class="layui-textarea"><?php echo htmlentities($cert_info['business_sphere']); ?></textarea>
				</div>
			</div>
			
			<!-- <div class="layui-form-item">
				<label class="layui-form-label">税务登记证号：</label>
				<div class="layui-input-block">
					<input name="tax_registration_certificate" type="text" value="<?php echo htmlentities($cert_info['tax_registration_certificate']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable">税务登记证号电子版：</label>
				<div class="layui-input-block img-upload">
					<div class="upload-img-block icon">
						<div class="upload-img-box" id="taxlicense">
							<?php if($cert_info['tax_registration_certificate_electronic']): ?>
								<img src="<?php echo img($cert_info['tax_registration_certificate_electronic']); ?>" />
							<?php else: ?>
								<div class="ns-upload-default">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png" />
									<p>点击上传</p>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<?php endif; ?>

	<!-- 联系人身份证件 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<?php if($cert_info['cert_type'] == 1): ?>
			<span class="ns-card-title">联系人身份证件</span>
			<?php else: ?>
			<span class="ns-card-title">法人身份证件</span>
			<?php endif; ?>
		</div>
		
		<div class="layui-card-body">
			<div class="layui-form-item">
				<?php if($cert_info['cert_type'] == 1): ?>
				<label class="layui-form-label">联系人身份证：</label>
				<?php else: ?>
				<label class="layui-form-label">法人身份证号：</label>
				<?php endif; ?>
				<div class="layui-input-block">
					<input name="contacts_card_no" type="text" lay-verify="idcard" value="<?php echo htmlentities($cert_info['contacts_card_no']); ?>" class="layui-input ns-len-mid">
				</div>
			</div>

			<div class="layui-form-item">
				<?php if($cert_info['cert_type'] == 1): ?>
				<label class="layui-form-label img-upload-lable">申请人身份证正面：</label>
				<?php else: ?>
				<label class="layui-form-label img-upload-lable">法人身份证正面：</label>
				<?php endif; ?>
				<div class="layui-input-block">
					<div class="upload-img-block img-upload">
						<div class="upload-img-box <?php if(!(empty($cert_info['contacts_card_electronic_2']) || (($cert_info['contacts_card_electronic_2'] instanceof \think\Collection || $cert_info['contacts_card_electronic_2'] instanceof \think\Paginator ) && $cert_info['contacts_card_electronic_2']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="idCardPicFront">
								<?php if($cert_info['contacts_card_electronic_2']): ?>
								<div id="preview_idCardPicFront" class="preview_img">
									<img layer-src src="<?php echo img($cert_info['contacts_card_electronic_2']); ?>" class="img_prev"/>
								</div>
								<?php else: ?>
								<div class="upload">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
									<p>点击上传</p>
								</div>
								<?php endif; ?>
							</div>
							<div class="operation">
								<div>
									<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
									<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
								</div>
								<div class="replace_img js-replace">点击替换</div>
							</div>
							<input type="hidden" name="contacts_card_electronic_2" value="<?php echo htmlentities($cert_info['contacts_card_electronic_2']); ?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<?php if($cert_info['cert_type'] == 1): ?>
				<label class="layui-form-label img-upload-lable">申请人身份证反面：</label>
				<?php else: ?>
				<label class="layui-form-label img-upload-lable">法人身份证反面：</label>
				<?php endif; ?>
				<div class="layui-input-block">
					<div class="upload-img-block img-upload">
						<div class="upload-img-box <?php if(!(empty($cert_info['contacts_card_electronic_3']) || (($cert_info['contacts_card_electronic_3'] instanceof \think\Collection || $cert_info['contacts_card_electronic_3'] instanceof \think\Paginator ) && $cert_info['contacts_card_electronic_3']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="idCardPicBack">
								<?php if($cert_info['contacts_card_electronic_3']): ?>
								<div id="preview_idCardPicBack" class="preview_img">
									<img layer-src src="<?php echo img($cert_info['contacts_card_electronic_3']); ?>" class="img_prev"/>
								</div>
								<?php else: ?>
								<div class="upload">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
									<p>点击上传</p>
								</div>
								<?php endif; ?>
							</div>
							<div class="operation">
								<div>
									<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
									<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
								</div>
								<div class="replace_img js-replace">点击替换</div>
							</div>
							<input type="hidden" name="contacts_card_electronic_3" value="<?php echo htmlentities($cert_info['contacts_card_electronic_3']); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 对公账户信息 -->
	<!-- 企业店铺独有 -->
	<?php if($cert_info['cert_type'] == 2): ?>
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">对公账户</span>
		</div>
		
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">银行开户名：</label>
				<div class="layui-input-block">
					<input name="bank_account_name" type="text" value="<?php echo htmlentities($cert_info['bank_account_name']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">公司银行账号：</label>
				<div class="layui-input-block">
					<input name="bank_account_number" type="text" lay-verify="required" value="<?php echo htmlentities($cert_info['bank_account_number']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">开户银行支行名称：</label>
				<div class="layui-input-block">
					<input name="bank_name" type="text" value="<?php echo htmlentities($cert_info['bank_name']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
			
			<div class="layui-form-item" data-flag="area">
				<label class="layui-form-label">开户银行所在地：</label>
				<div class="layui-input-block">
					<input name="bank_address" type="text" value="<?php echo htmlentities($cert_info['bank_address']); ?>" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="ns-single-filter-box">
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>
	</div>
	
	<!-- 隐藏域 -->
	<input type="hidden" value="<?php echo htmlentities($site_id); ?>" name="site_id" />
<!--	<input type="hidden" value="<?php echo htmlentities($cert_info['business_licence_number_electronic']); ?>" name="business_licence_number_electronic" />-->
<!--	<input type="hidden" value="<?php echo htmlentities($cert_info['tax_registration_certificate_electronic']); ?>" name="tax_registration_certificate_electronic" />-->
<!--	<input type="hidden" value="<?php echo htmlentities($cert_info['contacts_card_electronic_1']); ?>" name="contacts_card_electronic_1" />-->
<!--	<input type="hidden" value="<?php echo htmlentities($cert_info['contacts_card_electronic_2']); ?>" name="contacts_card_electronic_2" />-->
<!--	<input type="hidden" value="<?php echo htmlentities($cert_info['contacts_card_electronic_3']); ?>" name="contacts_card_electronic_3" />-->
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


<script src="https://ls.chnssl.com/app/admin/view/public/js/address.js"></script>
<script>
	layui.use(['form', 'laydate'], function() {
		var form = layui.form,
			repeat_flag = false; //防重复标识
		form.render();

		initArea(form); //初始化三级联动

		// 申请人身份证正面
		var idCardPicFront_upload = new Upload({
			elem: '#idCardPicFront',
			url: ns.url("admin/upload/upload"),
		});

		// 申请人身份证反面
		var idCardPicBack_upload = new Upload({
			elem: '#idCardPicBack',
			url: ns.url("admin/upload/upload"),
		});

		// 营业执照电子版
		var license_upload = new Upload({
			elem: '#license',
			url: ns.url("admin/upload/upload"),
		});
		
		//税务登记证电子版
		var uploadInst_upload = new Upload({
			elem: '#taxlicense',
			url: ns.url("admin/upload/upload"),
		});
		
		/**
		 * 监听保存
		 */
		form.on('submit(save)', function(data) {
			
			if (repeat_flag) return false;
			repeat_flag = true;
			
			//删除图片
			if(!data.field.contacts_card_electronic_2) idCardPicFront_upload.delete();
			if(!data.field.contacts_card_electronic_3) idCardPicBack_upload.delete();
			if(!data.field.business_licence_number_electronic) license_upload.delete();
			
			$.ajax({
				type: 'POST',
				url: ns.url("admin/shop/certInfo"),
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
	});
	
	function back() {
		location.href = ns.url("admin/shop/lists");
	}
</script>

</body>
</html>