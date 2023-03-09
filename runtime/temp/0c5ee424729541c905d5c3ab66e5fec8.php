<?php /*a:2:{s:68:"/www/wwwroot/ls.chnssl.com/addon/supply/admin/view/supplier/add.html";i:1614519478;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞友情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞友情')); ?>">
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
	.ns-form {margin-top: 0;}
	.ns-store-company, .ns-pay-company, .ns-pay-alipay, .ns-shop-own { display: none; }
</style>

</head>
<body>

<div class="ns-logo">
	
	<span>赞友情平台端</span>

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
				
<form class="layui-form ns-form">
	<!-- 供应商信息 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">供应商信息</span>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>供应商名称：</label>
			<div class="layui-input-block">
				<input name="title" type="text" lay-verify="required" class="layui-input ns-len-long" autocomplete="off">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">LOGO：</label>
			<div class="layui-input-block">
				<div class="upload-img-block img-upload">

					<div class="upload-img-box">
						<div class="ns-upload-default" id="imgUpload">
							<div class="upload">
								<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
								<p>点击上传</p>
							</div>
						</div>
						<div class="operation">
							<div>
								<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
								<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
							</div>
							<div class="replace_img js-replace">点击替换</div>
						</div>
						<input type="hidden" name="logo" value="">
					</div>
				</div>
			</div>
			<div class="ns-word-aux">
				<p>建议图片尺寸：200px * 100px。</p>
				<p>图片格式：jpg、png、jpeg。</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>主营行业：</label>
			<div class="layui-input-block ns-len-mid">
				<select class="ns-category" name="category_id" lay-verify="required">
					<option value="">选择主营行业</option>
					<?php if(is_array($category_list) || $category_list instanceof \think\Collection || $category_list instanceof \think\Paginator): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo htmlentities($category['category_id']); ?>"><?php echo htmlentities($category['category_name']); ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>

		<div class="layui-form-item ns-shop-time">
			<label class="layui-form-label"><span class="required">*</span>入驻时长：</label>
			<div class="layui-input-block ns-len-mid">
				<select name="year" lay-verify="required">
					<option value="">选择入驻时长</option>
					<option value="1">一年</option>
					<option value="2">二年</option>
					<option value="3">三年</option>
					<option value="4">四年</option>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>供应商关键字：</label>
			<div class="layui-input-block">
				<input name="keywords" type="text"  lay-verify="required" class="layui-input ns-len-long" autocomplete="off">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>供应商简介：</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea ns-len-long" lay-verify="required" name="desc"></textarea>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>联系电话：</label>
			<div class="layui-input-block">
				<input type="text" name="supplier_phone" lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">供应商QQ：</label>
			<div class="layui-input-block">
				<input type="text" name="supplier_qq" autocomplete="off" class="layui-input ns-len-long">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">供应商微信：</label>
			<div class="layui-input-block">
				<input type="text" name="supplier_weixin" autocomplete="off" class="layui-input ns-len-long">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">供应商邮箱：</label>
			<div class="layui-input-block">
				<input type="text" name="supplier_email" lay-verify="isemail" autocomplete="off" class="layui-input ns-len-long">
			</div>
		</div>
	</div>

	<!-- 申请类型 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">申请类型</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">申请类型：</label>
				<div class="layui-input-block" id="cert_type">
					<input type="radio" name="cert_type" lay-filter="certType" value="1" title="个人" checked>
					<input type="radio" name="cert_type" lay-filter="certType" value="2" title="企业" >
				</div>
			</div>
		</div>
	</div>

	<!-- 企业店铺独有 -->
	<div class="ns-store-company">

		<!-- 企业信息 -->
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">企业信息</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">公司名称：</label>
					<div class="layui-input-block">
						<input name="company_name" type="text" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>

				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label">公司地址：</label>
					<div class="layui-input-inline ns-len-mid">
						<select name="company_province_id" data-type="province" data-init="" lay-filter="comProvince"></select>
					</div>
					<div class="layui-input-inline ns-len-mid">
						<select name="company_city_id" data-type="city" data-init="" lay-filter="comCity"></select>
					</div>
					<div class="layui-input-inline ns-len-mid">
						<select name="company_district_id" data-type="district" data-init="" lay-filter="comDistrict"></select>
					</div>
				</div>
				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label">详细地址：</label>
					<div class="layui-input-inline">
						<input name="company_address" type="text" placeholder="请输入详细地址" class="layui-input ns-len-mid" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 公共部分 -->
	<!-- 联系人信息 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">联系人信息</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label ns-company-name">联系人姓名：</label>
				<div class="layui-input-inline">
					<input name="contacts_name" type="text" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label ns-company-phone">联系人手机：</label>
				<div class="layui-input-block">
					<input name="contacts_mobile" type="text" lay-verify="mobile" class="layui-input ns-len-long" autocomplete="off">
				</div>
				<span class="ns-word-aux">请填写有效的手机号，如有问题可通过该手机号联系到商家</span>
			</div>
		</div>
	</div>

	<!-- 营业执照 税务 -->
	<!-- 企业店铺独有 -->
	<div class="ns-store-company">
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">企业资质</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label">统一社会信用码：</label>
					<div class="layui-input-block">
						<input name="business_licence_number" type="text" class="layui-input ns-len-long" autocomplete="off">
					</div>
					<span class="ns-word-aux">请填写三证合一之后的营业执照上的统一社会信用代码</span>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label img-upload-lable">营业执照电子版：</label>
					<div class="layui-input-block">
						<div class="upload-img-block img-upload">
							<div class="upload-img-box">
								<div class="ns-upload-default" id="license">
									<div class="upload">
										<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
										<p>点击上传</p>
									</div>
								</div>
								<div class="operation">
									<div>
										<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
										<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
									</div>
									<div class="replace_img js-replace">点击替换</div>
								</div>
								<input type="hidden" name="business_licence_number_electronic" value="">
							</div>
						</div>
					</div>
					<span class="ns-word-aux">请上传营业执照传真图片或者照片，营业执照包括边框内容要全部显示，不能遮挡</span>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">法定经营范围：</label>
					<div class="layui-input-block ns-len-long">
						<textarea name="business_sphere" class="layui-textarea"></textarea>
					</div>
					<span class="ns-word-aux">经营范围（可填写营业执照上的经营范围内容）</span>
				</div>

				<!-- <div class="layui-form-item">
					<label class="layui-form-label">税务登记证号：</label>
					<div class="layui-input-block">
						<input name="tax_registration_certificate" type="text" class="layui-input ns-len-long" autocomplete="off">
					</div>
					<span class="ns-word-aux">税务登记证号即为三证合一之后的营业执照上的统一社会信用代码，三证合一之前为税务登记证上的编码</span>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label img-upload-lable">税务登记证电子版：</label>
					<div class="layui-input-block img-upload">
						<input type="hidden" class="layui-input" name="tax_registration_certificate_electronic" />
						<div class="upload-img-block icon">
							<div class="upload-img-box" id="taxlicense">
								<div class="ns-upload-default">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png" />
									<p>点击上传</p>
								</div>
							</div>
						</div>
					</div>
					<span class="ns-word-aux">税务登记证传真图片或者照片，包括边框在内的内容都需要显示</span>
				</div> -->
			</div>
		</div>
	</div>

	<!-- 身份证件 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">联系人身份证件</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label ns-company-ident">联系人身份证号：</label>
				<div class="layui-input-inline">
					<input name="contacts_card_no" type="text" lay-verify="idcard" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable ns-company-pic-front">申请人身份证正面：</label>
				<div class="layui-input-block">
					<div class="upload-img-block img-upload">
						<div class="upload-img-box">
							<div class="ns-upload-default" id="idCardPicFront">
								<div class="upload">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
									<p>点击上传</p>
								</div>
							</div>
							<div class="operation">
								<div>
									<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
									<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
								</div>
								<div class="replace_img js-replace">点击替换</div>
							</div>
							<input type="hidden" name="contacts_card_electronic_2" value="">
						</div>
					</div>
				</div>
				<span class="ns-word-aux">上传申请人身份证正面，即有本人照片与身份证号的那一面</span>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable ns-company-pic-back">申请人身份证反面：</label>
				<div class="layui-input-block">
					<div class="upload-img-block img-upload">
						<div class="upload-img-box">
							<div class="ns-upload-default" id="idCardPicBack">
								<div class="upload">
									<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
									<p>点击上传</p>
								</div>
							</div>
							<div class="operation">
								<div>
									<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
									<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
								</div>
								<div class="replace_img js-replace">点击替换</div>
							</div>
							<input type="hidden" name="contacts_card_electronic_3" value="">
						</div>
					</div>
				</div>
				<span class="ns-word-aux">上传申请人身份证反面，即有身份登记地址的那一面</span>
			</div>
		</div>
	</div>

	<!-- 对公账户信息 -->
	<!-- 企业店铺独有 -->
	<div class="ns-pay-company">
		<div class="layui-card ns-card-common ns-card-brief">
			<div class="layui-card-header">
				<span class="ns-card-title">对公账户</span>
			</div>
			<div class="layui-card-body">
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="required">*</span>银行开户名：</label>
					<div class="layui-input-block">
						<input name="bank_account_name" type="text" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label"><span class="required">*</span>公司银行账号：</label>
					<div class="layui-input-inline">
						<input name="bank_account_number" type="text" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label"><span class="required">*</span>开户银行名称：</label>
					<div class="layui-input-inline">
						<input name="bank_name" type="text" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>

				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label"><span class="required">*</span>开户银行所在地：</label>
					<div class="layui-input-inline ns-len-mid">
						<select class="bank-province" data-type="province" data-init="" lay-filter="bankProvince"></select>
					</div>
					<div class="layui-input-inline ns-len-mid">
						<select class="bank-city" data-type="city" data-init="" lay-filter="bankCity"></select>
					</div>
					<div class="layui-input-inline ns-len-mid">
						<select class="bank-district" data-type="district" data-init="" lay-filter="bankDistrict"></select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 结算信息 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">结算账户</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>结算账户类型：</label>
				<div class="layui-input-inline ns-len-mid">
					<input type="radio" name="bank_type" lay-filter="payType" value="1" title="银行卡" checked>
					<input type="radio" name="bank_type" lay-filter="payType" value="2" title="支付宝">
				</div>
			</div>
			<!--银行卡-->
			<div class="ns-pay-bank">
				<div class="layui-form-item">
					<label class="layui-form-label ns-pay-alipay-name"><span class="required">*</span>结算银行开户名：</label>
					<div class="layui-input-inline">
						<input name="settlement_bank_account_name" id="settlement_bank_account_name" type="text" value="" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label ns-pay-alipay-account"><span class="required">*</span>结算公司银行账号：</label>
					<div class="layui-input-inline">
						<input name="settlement_bank_account_number" id="settlement_bank_account_number" type="text" value="" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="required">*</span>结算开户银行支行名称：</label>
					<div class="layui-input-inline">
						<input name="settlement_bank_name" id="settlement_bank_name" type="text" value="" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
					</div>
				</div>

				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label"><span class="required">*</span>结算开户银行所在地：</label>
					<div class="layui-input-inline">
						<input name="settlement_bank_address" id="settlement_bank_address" type="text" value="" class="layui-input ns-len-long" autocomplete="off" lay-verify="required">
					</div>
				</div>
			</div>
			<!-- 支付宝 -->
			<div class="ns-pay-zfb" style="display: none">
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="required">*</span>用户真实姓名：</label>
					<div class="layui-input-inline">
						<input name="zfb_settlement_bank_account_name" id="settlement_zfb_account_name" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>

				<div class="layui-form-item" data-flag="area">
					<label class="layui-form-label"><span class="required">*</span>支付宝账号：</label>
					<div class="layui-input-inline">
						<input name="zfb_settlement_bank_account_number" id="settlement_zfb_account_number" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="ns-pay-win" style="display: none">
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
					<label class="layui-form-label ns-pay-alipay-name"><span class="required">*</span>用户真实姓名：</label>
					<div class="layui-input-inline">
						<input name="weixin_settlement_bank_account_name" id="weixin_settlement_bank_account_name" type="text" value="" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">微信昵称：</label>
					<div class="layui-input-inline">
						<input name="weixin_settlement_bank_address" type="text" value="" class="layui-input ns-len-long ns-dis-input" autocomplete="off" disabled>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label"><span class="required">*</span>微信账号：</label>
					<div class="layui-input-inline">
						<input name="weixin_settlement_bank_name" id="weixin_settlement_bank_name"  type="text" value="" class="layui-input ns-len-long" autocomplete="off">
					</div>
				</div>
				<!-- 微信openid -->
				<input name="weixin_settlement_bank_account_number" value="" type="hidden" class="layui-input">
			</div>
		</div>
	</div>

	<!-- 个人信息 -->
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">用户信息</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>供应商登录用户名：</label>
				<div class="layui-input-ns">
					<input name="username" type="text" lay-verify="required" class="layui-input ns-len-long" autocomplete="off">
				</div>
				<span class="ns-word-aux">用于登录供应商后台</span>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>供应商登录密码：</label>
				<div class="layui-input-inline">
					<input name="password" type="text" lay-verify="required" class="layui-input ns-len-long" autocomplete="off">
				</div>
			</div>
		</div>
	</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button type="reset" class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
</form>

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
	layui.use(['form'], function() {
		var form = layui.form,
			repeat_flag = false;//防重复标识
		form.render();

		initArea(form); //三级联动初始化

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

		// 普通图片上传
		var imgUpload_upload = new Upload({
			elem: '#imgUpload',
			url: ns.url("admin/upload/upload"),
		});
		
		//税务登记证电子版
		// var taxlicense_upload = new Upload({
		// 	elem: '#taxlicense',
		// 	url: ns.url("admin/upload/upload"),
		// });
		
		form.on('submit(save)', function (data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			
			//删除图片
			if(!data.field.contacts_card_electronic_2) idCardPicFront_upload.delete();
			if(!data.field.contacts_card_electronic_3) idCardPicBack_upload.delete();
			if(!data.field.business_licence_number_electronic) license_upload.delete();
			if(!data.field.logo) imgUpload_upload.delete();
			
			var bank_address = '';

			data.field.category_name = $("select[name=category_id] option:selected").text();
			//对公账户
			bank_address += $("select[lay-filter=bankProvince] option:selected").text();
			bank_address += $("select[lay-filter=bankCity] option:selected").text();
			bank_address += $("select[lay-filter=bankDistrict] option:selected").text();
			data.field.bank_address = bank_address;

			//结算账户
			bankType = data.field.bank_type;
			if(parseInt(bankType) == 2){
				data.field.settlement_bank_account_name = data.field.zfb_settlement_bank_account_name;
				data.field.settlement_bank_account_number = data.field.zfb_settlement_bank_account_number;
				data.field.settlement_bank_address = "";
				data.field.settlement_bank_name = "";
			}
			
			$.ajax({
				url: ns.url('supply://admin/supplier/add'),
				data: data.field,
				dataType: 'json',
				type: 'post',
				success: function (res) {
					repeat_flag = false;
					
					if (res.code == 0) {
						layer.confirm('添加成功', {
							title:'操作提示',
							btn: ['返回列表', '继续添加'],
							yes: function(){
								location.href = ns.url("supply://admin/supplier/index")
							},
							btn2: function() {
								location.href = ns.url("supply://admin/supplier/add")
							}
						})
					}else{
						layer.msg(res.message);
					}
				}
			});
			return false;
		});

		/**
		 * select监听
		 */
		form.on('radio(is_own)', function(data) { //店铺等级中如果is_own=1，则入驻时长可以不填，否则必选
			autotrophy = data.value;
			//判断入驻时长是否必填,如果分组is_own=1 不必填 0 必填
			if (autotrophy == 0) {
				$(".ns-shop-time").show();
				$(".ns-shop-is-own").show();
				$(".ns-shop-own").hide();
				$(".ns-shop-time select").attr("lay-verify", "required");
				$(".ns-shop-is-own .ns-group").attr("lay-verify", "required");
				$(".ns-shop-own .ns-group").removeAttr("lay-verify");
			} else {
				$(".ns-shop-time").hide();
				$(".ns-shop-is-own").hide();
				$(".ns-shop-own").show();
				$(".ns-shop-time select").removeAttr("lay-verify");
				$(".ns-shop-is-own .ns-group").removeAttr("lay-verify");
				$(".ns-shop-own .ns-group").attr("lay-verify", "required");
			}
		});

		form.on('radio(certType)', function(data) { //为企业店铺时，显示企业独有部分，否则隐藏
			var value = data.value;
			if (value == 1) {
				$(".ns-store-company").hide();
				$(".ns-pay-company").hide();
				$(".ns-company-person").text("联系人信息");
				$(".ns-company-name").text("联系人姓名");
				$(".ns-company-phone").text("联系人电话");
				$(".ns-company-identity").text("联系人身份证件");
				$(".ns-company-ident").text("联系人身份证号");
				$(".ns-company-pic-front").text("申请人身份证正面");
				$(".ns-company-pic-back").text("申请人身份证反面");
			} else {
				$(".ns-store-company").show();
				$(".ns-pay-company").show();
				$(".ns-company-person").text("法人代表信息：");
				$(".ns-company-name").text("法人姓名：");
				$(".ns-company-phone").text("法人联系电话：");
				$(".ns-company-identity").text("法人身份证件：");
				$(".ns-company-ident").text("法人身份证号：");
				$(".ns-company-pic-front").text("法人身份证正面：");
				$(".ns-company-pic-back").text("法人身份证反面：");
			}
		});

		form.on('radio(payType)', function(data) { //判断支付方式，显示对应的表单
			payType = data.value;
			if (payType == 1) {
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
				form.render("select");
			} else if(payType == 2){
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
			}
		});

		/**
		 * 表单验证
		 */
		form.verify({
			bankprovince: function(value){
				if (value == -1) return '请选择省';
			},
			bankcity: function(value){
				if (value == -1) return '请选择市';
			},
			bankdistrict: function(value, item){
				if (value == -1 && $(item).find('option').length > 1) return '请选择区县';
			},
		});
	});
	
	function back(){
		location.href = ns.url("supply://admin/supplier/index")
	}
</script>

</body>
</html>