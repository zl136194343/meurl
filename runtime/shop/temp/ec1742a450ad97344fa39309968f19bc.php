<?php /*a:2:{s:65:"D:\phpstudy_pro\WWW\www.hunqin.com\app\shop\view\shop\config.html";i:1657271043;s:58:"D:\phpstudy_pro\WWW\www.hunqin.com\app\shop\view\base.html";i:1654828558;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="http://www.hunqin.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/app/shop/view/public/css/common.css" />
	<script src="http://www.hunqin.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="http://www.hunqin.com/public/static/ext/layui/layui.js"></script>
	<script src="http://www.hunqin.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "http://www.hunqin.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"http://www.hunqin.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="http://www.hunqin.com/public/static/js/common.js"></script>
	<script src="http://www.hunqin.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("http://www.hunqin.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="http://www.hunqin.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="http://www.hunqin.com/app/shop/view/public/img/shop_logo.png">
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
								<img src="http://www.hunqin.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
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
			
				
<div  class="layui-form">
	<div class="layui-form-item">
		<label class="layui-form-label">开店套餐：</label>
		<div class="layui-input-inline">
			<p class="ns-input-text ns-len-mid"><?php echo htmlentities($shop_info['group_name']); ?></p>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">主营行业：</label>
		<div class="layui-input-inline">
			<p class="ns-input-text ns-len-mid"><?php echo htmlentities($shop_info['category_name']); ?></p>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">店铺名称：</label>
		<div class="layui-input-inline">
			<p class="ns-input-text ns-len-mid"><?php echo htmlentities($shop_info['site_name']); ?></p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">店铺logo：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box <?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="logoUpload">
						<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
						<div id="preview_logoUpload" class="preview_img">
							<img layer-src src="<?php echo img($shop_info['logo']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="http://www.hunqin.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
					<input type="hidden" name="logo" value="<?php echo htmlentities($shop_info['logo']); ?>"/>
				</div>
			</div>
		</div>

		<div class="ns-word-aux">
			<p>建议图片尺寸：200*60像素；图片格式：jpg、png、jpeg。</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">店铺头像：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box <?php if(!(empty($shop_info['avatar']) || (($shop_info['avatar'] instanceof \think\Collection || $shop_info['avatar'] instanceof \think\Paginator ) && $shop_info['avatar']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="avatarUpload">
						<?php if(!(empty($shop_info['avatar']) || (($shop_info['avatar'] instanceof \think\Collection || $shop_info['avatar'] instanceof \think\Paginator ) && $shop_info['avatar']->isEmpty()))): ?>
						<div id="preview_avatarUpload" class="preview_img">
							<img layer-src src="<?php echo img($shop_info['avatar']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="http://www.hunqin.com/app/shop/view/public/img/upload_img.png" data-id="avatarUpload"/>
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
					<input type="hidden" name="avatar" value="<?php echo htmlentities($shop_info['avatar']); ?>"/>
				</div>
			</div>
		</div>
		<div class="ns-word-aux">
			<p>建议图片尺寸：800*800像素；图片格式：jpg、png、jpeg。</p>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">店铺大图：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box <?php if(!(empty($shop_info['banner']) || (($shop_info['banner'] instanceof \think\Collection || $shop_info['banner'] instanceof \think\Paginator ) && $shop_info['banner']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="bannerUpload">
						<?php if(!(empty($shop_info['banner']) || (($shop_info['banner'] instanceof \think\Collection || $shop_info['banner'] instanceof \think\Paginator ) && $shop_info['banner']->isEmpty()))): ?>
						<div id="preview_bannerUpload" class="preview_img">
							<img layer-src src="<?php echo img($shop_info['banner']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="http://www.hunqin.com/app/shop/view/public/img/upload_img.png" data-id="bannerUpload"/>
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
					<input type="hidden" name="banner" value="<?php echo htmlentities($shop_info['banner']); ?>"/>
				</div>
			</div>
		</div>
		<div class="ns-word-aux">
			<p>建议图片高度：150像素；图片格式：jpg、png、jpeg。</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">店铺简介：</label>
		<div class="layui-input-block">
			<textarea name="seo_description" class="layui-textarea ns-len-long"><?php echo htmlentities($shop_info['seo_description']); ?></textarea>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">店铺关键字：</label>
		<div class="layui-input-block">
			<input type="text" name="seo_keywords" autocomplete="off" value="<?php echo htmlentities($shop_info['seo_keywords']); ?>" class="layui-input ns-len-long">
			<span class="layui-word-aux">多个关键字之间用英文“,”隔开</span>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否隐藏店铺：</label>
		<div class="layui-input-block">

			<input type="radio" name="conceal" <?php if($shop_info['conceal'] == 0): ?>checked<?php endif; ?> value="0">未隐藏
			<input type="radio" name="conceal" <?php if($shop_info['conceal'] == 1): ?>checked<?php endif; ?> value="1">隐藏

		</div>
	</div>
	
	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
	</div>
</div>

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>http://www.hunqin.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>http://www.hunqin.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
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


<script>
	layui.use(['form'], function(){
		var form = layui.form,
			repeat_flag = false; //防重复标识
			
		form.render();
			
		form.on('submit(save)', function(data){
			if (repeat_flag) return;
			repeat_flag = true;
			
			//图片删除
			if(!data.field.logo) logo_upload.delete();
			if(!data.field.avatar) avatar_upload.delete();
			if(!data.field.banner) banner_upload.delete();
			
			$.ajax({
				type: 'POST',
				url: ns.url("shop/shop/config"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;
					if (res.code == 0) {
						setTimeout(function(){ location.reload(); }, 1000);
					}
				}
			});
		});

		// 店铺LOGO
		var logo_upload = new Upload({
			elem: '#logoUpload'
		});

		// 店铺头像
		var avatar_upload = new Upload({
			elem: '#avatarUpload'
		});

		// 店铺大图
		var banner_upload = new Upload({
			elem: '#bannerUpload'
		});
	});
</script>

</body>

</html>