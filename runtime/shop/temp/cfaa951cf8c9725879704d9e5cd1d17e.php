<?php /*a:2:{s:61:"/www/wwwroot/ls.chnssl.com/app/shop/view/store/add_store.html";i:1660101461;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/shop/view/public/css/common.css" />
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
			IMGPATH:"https://ls.chnssl.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	#container{ width: 650px; height: 500px; }
	.empty-address{ display: none; }
	.address-content {display: inline-block;vertical-align: top;}
	.ns-form {margin-top: 0;}
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="https://ls.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="https://ls.chnssl.com/app/shop/view/public/img/shop_logo.png">
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
				<div class="ns-shop-ewm"> 
					<a href="#" onclick="getShopUrl()">访问店铺</a>
				</div>
				
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
								<img src="https://ls.chnssl.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
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
			
				
<div class="layui-form ns-form" lay-filter="editselffetch">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>门店名称：</label>
		<div class="layui-input-block">
			<input type="text" name="store_name" autocomplete="off" lay-verify="store_name" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">门店的名称（招牌）</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">门店图片：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box ">
					<div class="ns-upload-default" id="storeUpload">
						<div class="upload">
							<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="imgUpload"/>
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
					<input type="hidden" name="store_image" >
				</div>
			</div>
		</div>
		<div class="ns-word-aux">
			<p>门店图片在PC及移动端对应页面及列表作为门店标志出现。</p>
			<p>建议图片尺寸：100 * 100像素，图片格式：jpg、png、jpeg。</p>
		</div>
	</div>
<!--	<div class="layui-form-item">-->
<!--		<label class="layui-form-label img-upload-lable">门店图片：</label>-->
<!--		<div class="layui-input-block img-upload">-->
<!--			<div class="upload-img-block">-->
<!--				<div class="upload-img-box">-->
<!--					<div class="ns-upload-default">-->
<!--						<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" />-->
<!--						<p>点击上传</p>-->
<!--					</div>-->
<!--				</div>-->
<!--				<p id="storeUpload" class="no-replace">替换</p>-->
<!--				<input type="hidden" name="store_image" value=""/>-->
<!--				<i class="del">x</i>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="ns-word-aux">-->
<!--			<p>门店图片在PC及移动端对应页面及列表作为门店标志出现。</p>-->
<!--			<p>建议图片尺寸：100 * 100像素，图片格式：jpg、png、jpeg。</p>-->
<!--		</div>-->
<!--	</div>-->

	<div class="layui-form-item">
		<label class="layui-form-label">门店电话：</label>
		<div class="layui-input-block">
			<input type="text" name="telphone" autocomplete="off" class="layui-input  ns-len-long" lay-verify="tel">
		</div>
		<div class="ns-word-aux">请输入正确的电话号码或者手机号</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">营业状态：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="status" value="1" lay-skin="switch">
		</div>
		<div class="ns-word-aux">是否开启营业，关闭即停业</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">是否启用自提：</label>
		<div class="layui-input-block">
			<input type="checkbox" value="1" name="is_pickup" lay-skin="switch">
		</div>
		<div class="ns-word-aux">开启自提后，用户可在购买商品时选择到店自提，可到最近的门店自提</div>
	</div>

	<!--自提点地址-->
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>门店地址：</label>
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="province_id" lay-filter="province_id" lay-verify="province_id">
				<option value="">请选择省份</option>
				<?php foreach($province_list as $k => $v): ?>
				<option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="city_id"  lay-filter="city_id" lay-verify="city_id">
				<option value="">请选择城市</option>
			</select>
		</div>
		
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="district_id"  lay-filter="district_id" lay-verify="district_id">
				<option value="">请选择区/县</option>
			</select>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"></label>
		<div class="layui-input-block">
			<input type="text" name="address"  placeholder="请填写门店的具体地址。" lay-verify="required" autocomplete="off" class="layui-input ns-len-long address-content" value="">
			<input type = "hidden" name="longitude" lay-verify="required" class="layui-input"/>
			<input type = "hidden" name="latitude" lay-verify="required" class="layui-input"/>
			<button class='layui-btn-primary layui-btn' onclick="refreshFrom();">查找地址</button>
		</div>
		<div class="ns-word-aux">点击查找地址可在地图上显示输入的地理位置</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">地图定位：</label>
		<div class="layui-input-block ns-special-length">
			<div id="container" class="selffetch-map"></div>
		</div>
		<div class="ns-word-aux empty-address">请选择地理位置！在地图上点击得到的地理位置会自动填入到对应的输入框中</div>
	</div>

	<div class="layui-form-item layui-hide">
		<label class="layui-form-label">是否启用外卖配送：</label>
		<div class="layui-input-block">
			<input type="checkbox"  value="1"  name="is_o2o" lay-skin="switch">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">营业时间：</label>
		<div class="layui-input-block">
			<input type="text" name="open_date" class="layui-input ns-len-long">

		</div>
		<div class="ns-word-aux ">例：上午9:00-12:00，下午2:00-6:00</div>
	</div>

	<?php if($is_exit == 1): ?>
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>门店账号：</label>
		<div class="layui-input-block">
			<input type="text" name="username" lay-verify="required" placeholder="请输入门店账号" autocomplete="off" class="layui-input ns-len-mid">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>门店密码：</label>
		<div class="layui-input-block">
			<input type="password" name="password" lay-verify="required" placeholder="请输入门店密码" autocomplete="off" class="layui-input ns-len-mid">
		</div>
	</div>
	<?php endif; ?>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>

</div>

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

		<!--	<div class="ns-footer">
				
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
				
			</div>-->

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


<script type="text/javascript" src="<?php echo get_http_type(); ?>://webapi.amap.com/maps?v=1.4.6&amp;key=<?php if(empty($map_key['gaode_map_key'])): ?>2df5711d4e2fd9ecd1622b5a53fc6b1d<?php else: ?><?php echo htmlentities($map_key['gaode_map_key']); ?><?php endif; ?>"></script>
<script type="text/javascript" src="https://ls.chnssl.com/app/shop/view/public/js/address.js"></script>
<script type="text/javascript" src="https://ls.chnssl.com/public/static/js/map_address.js"></script>
<script>
	var form, repeat_flag, map_class;

	layui.use(['form'], function() {
		form = layui.form;
		repeat_flag = false;//防重复标识

		form.render();

        //地图展示
		map_class = new mapClass("container",{lat:'',lng:''});
		form.render();

		/**
		 * 验证码
		 */
        form.verify({
            required : function(value, item){
                var msg = $(item).attr("placeholder") != undefined ? $(item).attr("placeholder") : '';
                if(value == '') return msg;
            },
            province_id : function(value, item){
                if(value == ''){
                    return '请选择省份';
                }
            },
            city_id : function(value, item){
                if(value == ''){
                    return '请选择城市';
                }
            },
            district_id : function(value, item){
                if(value == ''){
                    return '请选择区/县';
                }
            },
			store_name : function (value,item) {
				if(value == ""){
					return '请输入门店名称';
				}
			}
        });

		// 门店LOGO
		var store_upload = new Upload({
			elem: '#storeUpload',
			url: ns.url("shop/upload/image"),
		});
		
        form.on('submit(save)', function(data){
           
            if( data.field.longitude == "" || data.field.latitude == ""){
                layer.msg('请确认地理位置!');
                $(".empty-address").show();
                return;
            }else{
                $(".empty-address").hide();
            }
           
            var full_address  = [];
            full_address.push($("select[name=province_id] option:selected").text());
			full_address.push($("select[name=city_id] option:selected").text());
			full_address.push($("select[name=district_id] option:selected").text());

            data.field.full_address = full_address.toString();
			
            if(repeat_flag) return;
            repeat_flag = true;
			
			//删除图片
			if(!data.field.store_image) store_upload.delete();
			
            $.ajax({
                type : "POST",
                dataType: 'JSON',
                url : ns.url("shop/store/addStore"),
                async : true,
                data : data.field,
                success : function(res) {
					repeat_flag = false;

					if (res.code == 0) {
						layer.confirm('添加成功', {
							title: '操作提示',
							btn: ['返回列表', '继续添加'],
							yes: function() {
								location.href = ns.url("shop/store/lists")
							},
							btn2: function() {
								location.href = ns.url("shop/store/addStore");
							}
						});
					} else {
						layer.msg(res.message);
					}
                }
            })
        });
	});
	
	function back() {
		location.href = ns.url("shop/store/lists");
	}

    /**
     * 重新渲染表单
     */
    function refreshFrom(){
        form.render();
        orderAddressChange();//改变地址
        map_class.mapChange();
    }

    //动态改变订单地址赋值
    function orderAddressChange(){
        map_class.address.province = $("select[name=province_id]").val();
        map_class.address.province_name = $("select[name=province_id] option:selected").text();
        map_class.address.city = $("select[name=city_id]").val();
        map_class.address.city_name = $("select[name=city_id] option:selected").text();
        map_class.address.district = $("select[name=district_id]").val();
        map_class.address.district_name = $("select[name=district_id] option:selected").text();
        map_class.address.address = $("input[name=address]").val()
	}

    /**
     * 地址下拉框（主要用于坐标记录）
     */
    function selectCallBack(){
        $("input[name=longitude]").val(map_class.address.longitude);//坐标
        $("input[name=latitude]").val(map_class.address.latitude);//坐标
    }

    //地图点击回调事件
    function mapChangeCallBack(){
        $("input[name=address]").val(map_class.address.address);//详细地址
        $("input[name=longitude]").val(map_class.address.longitude);//坐标
        $("input[name=latitude]").val(map_class.address.latitude);//坐标

        $.ajax({
            type : "POST",
            dataType: 'JSON',
            url : ns.url("shop/address/getGeographicId"),
            async : true,
            data : {
                "address" : map_class.address.area
            },
            success : function(data) {
				map_class.address.province = data.province_id;
                map_class.address.city = data.city_id;
                map_class.address.district = data.district_id;
                map_class.address.township = data.subdistrict_id;
                map_class.map_change = false;
                form.val("editselffetch", {
                    "province_id": data.province_id
                });
                $("select[name=province_id]").change();
                form.val("editselffetch", {
                    "city_id": data.city_id
                });
                $("select[name=city_id]").change();
                form.val("editselffetch", {
                    "district_id": data.district_id
                });
                refreshFrom();//重新渲染form
                map_class.map_change = true;
            }
        });
	}

</script>

</body>

</html>