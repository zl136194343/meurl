<?php /*a:2:{s:58:"/www/wwwroot/ls.chnssl.com/app/shop/view/shop/contact.html";i:1614516272;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
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
	#container{height: 500px; }
	.address-content {display: inline-block;vertical-align: top;}
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
			
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>通过地图定位来填充联系地址或通过点击"查找按钮"来锁定地图上的具体位置</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form" lay-filter="storeform">

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>联系人姓名：</label>
		<div class="layui-input-block">
			<input type="text" name="name" lay-verify="required" autocomplete="off" class="layui-input ns-len-long" value="<?php echo htmlentities($info['name']); ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>联系人手机号：</label>
		<div class="layui-input-block">
			<input type="number" name="mobile" lay-verify="required" autocomplete="off" class="layui-input ns-len-long" value="<?php echo htmlentities($info['mobile']); ?>">
		</div>
		<div class="ns-word-aux">请输入联系人手机号</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required"></span>联系人电话：</label>
		<div class="layui-input-block">
			<input type="number" name="telephone" autocomplete="off" class="layui-input ns-len-long" value="<?php echo htmlentities($info['telephone']); ?>">
		</div>
		<div class="ns-word-aux">请输入联系人电话</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>联系地址：</label>
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="province_id" lay-filter="province_id" lay-verify="province_id">
				<option value="">请选择省份</option>
				<?php foreach($province_list as $k => $v): ?>
				<option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="city_id" lay-filter="city_id" lay-verify="city_id">
				<option value="">请选择城市</option>
			</select>
		</div>
		
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="district_id" lay-filter="district_id" lay-verify="district_id">
				<option value="">请选择区/县</option>
			</select>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"></label>
		<div class="layui-input-block">
			<input type="text" name="address" placeholder="请输入详细地址，以方便买家联系（请勿重复填写省市区）" lay-verify="address" autocomplete="off" class="layui-input ns-len-long address-content" value="<?php echo htmlentities($info['address']); ?>">
			<input type="hidden" name="longitude" lay-verify="required" class="layui-input" value="<?php echo htmlentities($info['longitude']); ?>"/>
			<input type="hidden" name="latitude" lay-verify="required" class="layui-input" value="<?php echo htmlentities($info['latitude']); ?>"/>
			<button class="layui-btn-primary layui-btn" onclick="refreshFrom();">查找地址</button>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">地图定位：</label>
		<div class="layui-input-block ns-special-length">
			<div id="container" class="selffetch-map"></div>
		</div>
		<div class="ns-word-aux empty-address layui-hide">请选择地理位置！</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">qq：</label>
		<div class="layui-input-block">
			<input type="text" name="qq" value="<?php echo htmlentities($info['qq']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">阿里旺旺：</label>
		<div class="layui-input-block">
			<input type="text" name="ww" value="<?php echo htmlentities($info['ww']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>

    <div class="layui-form-item">
        <label class="layui-form-label">邮箱：</label>
        <div class="layui-input-block">
            <input type="text" name="email" value="<?php echo htmlentities($info['email']); ?>" autocomplete="off" class="layui-input ns-len-long">
        </div>
        <div class="ns-word-aux">用于接收消息</div>
    </div>

	<div class="layui-form-item">
	    <label class="layui-form-label">工作日：</label>
	    <div class="layui-input-block" id="work_week">
			<input type="checkbox" name="work_week1" value="1" title="周一" lay-skin="primary">
			<input type="checkbox" name="work_week2" value="2" title="周二" lay-skin="primary">
			<input type="checkbox" name="work_week3" value="3" title="周三" lay-skin="primary">
			<input type="checkbox" name="work_week4" value="4" title="周四" lay-skin="primary">
			<input type="checkbox" name="work_week5" value="5" title="周五" lay-skin="primary">
			<input type="checkbox" name="work_week6" value="6" title="周六" lay-skin="primary">
			<input type="checkbox" name="work_week7" value="7" title="周日" lay-skin="primary">
	    </div>
	</div>
	
	<div class="layui-inline">
		<label class="layui-form-label">营业时间：</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" id="start_time" placeholder="开始时间" autocomplete="off" value="<?php if($info['start_time']): ?> <?php echo htmlentities($info['start_time']); ?> <?php endif; ?>" readonly>
			<i class="ns-calendar"></i>
			<input type="hidden" class="layui-input start-time" name="start_time">
		</div>
		<div class="layui-input-inline">-</div>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" id="end_time" placeholder="结束时间" autocomplete="off" value="<?php if($info['end_time']): ?> <?php echo htmlentities($info['end_time']); ?> <?php endif; ?>" readonly>
			<i class="ns-calendar"></i>
			<input type="hidden" class="layui-input end-time" name="end_time">
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
<script type="text/javascript">
	var form, laydate, repeat_flag, map_class;
	
	/**
	 * 初始化营业时间
	 */
	var startTime = "<?php echo htmlentities($info['start_time']); ?>",
		endTime = "<?php echo htmlentities($info['end_time']); ?>";
	if (Number(startTime)){
		$("#start_time").val(ns.time_to_date(startTime, "h:m:s"));
		$(".start-time").val(startTime);
	}
	
	if (Number(endTime)){
		$("#end_time").val(ns.time_to_date(endTime, "h:m:s"));
		$(".end-time").val(endTime);
	}

	layui.use(['laydate', 'form'], function() {
		form = layui.form;
		laydate = layui.laydate;
		repeat_flag = false;//防重复标识
		
		form.render();
		
		if('<?php echo htmlentities($info['latitude']); ?>' == "" || '<?php echo htmlentities($info['longitude']); ?>' == ""){
		    var latlng = {lat:'',lng:''};
		}else{
		    var latlng = {lat:'<?php echo htmlentities($info['latitude']); ?>',lng:'<?php echo htmlentities($info['longitude']); ?>'};
		}

		//初始化联系地址
		var initdata = {province_id : '<?php echo htmlentities($info['province']); ?>', city_id : '<?php echo htmlentities($info['city']); ?>', district_id : '<?php echo htmlentities($info['district']); ?>'};
		initAddress(initdata, "storeform");

		//初始化工作日
		var workWeek = "<?php echo htmlentities($info['work_week']); ?>",
			workArr = workWeek.split(",");

		for (var i = 0; i < workArr.length; i++){
			$("input[name=work_week"+ workArr[i] +"]").prop("checked",true);
		}
		
		form.render();

		//地图展示
		map_class = new mapClass("container", latlng);
		form.render();
		
		//获取 - 开始时间
		var start_hours, start_minutes, start_seconds;
		laydate.render({
			elem: '#start_time',
			type: 'time',
			done: function(value, date){
				start_hours = date.hours;
				start_minutes = date.minutes;
				start_seconds = date.seconds;
				$(".start-time").val(ns.date_to_time(date.year + "-" + date.month + "-" + date.date + " " + date.hours + ":" + date.minutes + ":" + date.seconds))
			}
		});
		
		//获取 - 结束时间
		laydate.render({
			elem: '#end_time',
			type: 'time',
			done: function(value, date){
				$(".end-time").val(ns.date_to_time(date.year + "-" + date.month + "-" + date.date + " " + date.hours + ":" + date.minutes + ":" + date.seconds))
			}
		});

		form.on('submit(save)', function(data) {

			if( data.field.longitude == "" || data.field.latitude == ""){
			    layer.msg('请确认地理位置!');
			    $(".empty-address").removeClass("layui-hide");
			    return;
			}else{
			    $(".empty-address").addClass("layui-hide");
			}
			
			var province_name = $("select[name=province_id] option:selected").text();
			var city_name = $("select[name=city_id] option:selected").text();
			var district_name = $("select[name=district_id] option:selected").text();
			
			//地址id
			data.field.province = data.field.province_id;
			data.field.city = data.field.city_id;
			data.field.district = data.field.district_id;
			data.field.community = data.field.community_id;
			
			//地址name
			data.field.province_name = province_name;
			data.field.city_name = city_name;
			data.field.district_name = district_name;
			
			data.field.full_address = province_name + city_name + district_name;

			//工作日
			var week_arr = [];
			$("#work_week input").each(function () {
				if ($(this).is(":checked")) {
					week_arr.push($(this).val());
				}
			});
			data.field.work_week = week_arr.toString();
			
			if ($("#start_time").val() > $("#end_time").val()) {
				layer.msg("结束时间不能小于开始时间！");
				return;
			}
 
			if (repeat_flag) return;
			repeat_flag = true;
			
			$.ajax({
				url: ns.url("shop/shop/contact"),
				data: data.field,
				type: "POST",
				dataType: "JSON",
				success: function(res) {
					repeat_flag = false;
					layer.msg(res.message);
					if (res.code == 0) {
						location.reload();
					}
				}
			});
		});

		//表单验证
		form.verify({
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
			community_id : function(value, item){
			    if(value == ''){
			        return '请选择街道';
			    }
			},
			address: function(value) {
				if (value == '') {
					return '请输入详细地址';
				}
			},
		});
	});

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
	    map_class.address.township = $("select[name=community_id]").val();
	    map_class.address.township_name = $("select[name=community_id] option:selected").text();
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
	            form.val("storeform", {
	                "province_id": data.province_id
	            });
	            $("select[name=province_id]").change();
	            form.val("storeform", {
	                "city_id": data.city_id
	            });
	            $("select[name=city_id]").change();
	            form.val("storeform", {
	                "district_id": data.district_id
	            });
	            $("select[name=district_id]").change();
	            form.val("storeform", {
	                "community_id": data.subdistrict_id
	            });
	            refreshFrom();//重新渲染form
	            map_class.map_change = true;
	        }
	    });
	}
</script>

</body>

</html>