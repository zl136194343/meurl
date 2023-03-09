<?php /*a:2:{s:65:"/www/wwwroot/ls.chnssl.com/addon/coupon/shop/view/coupon/add.html";i:1614520112;s:23:"app/shop/view/base.html";i:1660100996;}*/ ?>
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
	.ns-discount { display: flex; justify-content: space-between; height: 34px; line-height: 34px; padding: 5px 15px; background-color: #F6FBFD; border: 1px dashed #BCE8F1; }
	.ns-exchange-type {padding: 0 20px; position: relative;}
	.ns-exchange-type:hover {border: 1px solid #ff8143;}
	.ns-exchange-selected {border: 1px solid #ff8143;}
	.ns-exchange-selected:after {
		content: "";
		display: inline-block;
		width: 20px;
		height: 20px;
		background-image: url(https://ls.chnssl.com/app/shop/view/public/img/selected.png);
		position: absolute;
		bottom: 0;
		right: 0;
	}
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
			<li>标识“<span class="required">*</span>”的选项为必填项，其余为选填项</li>
			<li>有效期类型可选固定时间和自领取之日起
				<p>1、固定时间：选择结束日期，所有领取的优惠券有效期都截止在结束日期当天</p>
				<p>2、自领取之日起：填写一个数字，表示从领取之日起有效期持续多少天</p>
			</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form">

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>优惠券名称：</label>
		<div class="layui-input-block">
			<input type="text" name="coupon_name" lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>

	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">优惠券类型：</label>
			<div class="layui-input-block">
				<button class="layui-btn layui-btn-primary ns-exchange-type ns-exchange-selected" data-status="reward">满减</button>
				<button class="layui-btn layui-btn-primary ns-exchange-type" data-status="discount">折扣</button>
				<input type="hidden" name="type" value="reward">
			</div>
		</div>
	</div>

	<div class="layui-form-item" id="coupon_type">
		<label class="layui-form-label"><span class="required">*</span>优惠券面额：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="money" min="0" lay-verify="required|number|money|gtzero" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">元</span>
		</div>
		<div class="ns-word-aux">
			<p>价格不能小于0，可保留两位小数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>发放数量：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="count" min="0" lay-verify="required|number|int|gtzero" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">张</span>
		</div>
		<div class="ns-word-aux">
			<p>发放数量必须大于0，且必须为整数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>最大领取数量：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="max_fetch" min="0" value="1" lay-verify="required|number|int|max" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">张</span>
		</div>
		<div class="ns-word-aux">
			<p>数量不能小于0，且必须为整数；设置为0时，可无限领取</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>满多少元可以使用：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="at_least" min="0" lay-verify="required|number|money" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">元</span>
		</div>
		<div class="ns-word-aux">
			<p>价格不能小于0，无门槛请设为0</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">优惠券图片：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box">
					<div class="ns-upload-default" id="couponImg">
						<div class="upload">
							<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png"/>
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
					<input type="hidden" name="image" value=""/>
				</div>
			</div>
		</div>
		<div class="ns-word-aux">
			<p>建议尺寸：325*95像素</p>
			<p>图片上传默认不限制大小</p>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否允许直接领取：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_show" lay-filter="" value="1" lay-skin="switch" checked />
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">有效期类型：</label>
		<div class="layui-input-block">
			<input type="radio" name="validity_type" value="0" lay-filter="filter" checked="checked" title="固定时间">
			<input type="radio" name="validity_type" value="1" lay-filter="filter" title="领取之日起">
		</div>
	</div>

	<div class="layui-form-item ns-end-time">
		<label class="layui-form-label">活动结束时间：</label>
		<div class="layui-input-block">
			<input type="text" name="end_time" lay-verify="time" id="end_time" class="layui-input ns-len-mid" autocomplete="off" readonly>
		</div>
	</div>

	<div class="layui-form-item ns-fixed-term layui-hide">
		<label class="layui-form-label">领取之日起：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" min="1" max="365" value="10" name="fixed_term" lay-verify="days" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">天有效</span>
		</div>
		<div class="ns-word-aux">
			<p>不能小于0，且必须为整数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>活动商品：</label>
		<div class="layui-input-block">
			<input type="radio" name="goods_type" lay-filter="goods_type" value="1" title="全部商品参与" checked>
			<input type="radio" name="goods_type" lay-filter="goods_type" value="2" title="指定商品参与">
		</div>
	</div>

	<div class="layui-form-item goods_list" style="display:none">
		<label class="layui-form-label"></label>
		<div class="layui-input-block">

			<table id="selected_goods_list"></table>
			<button class="layui-btn ns-bg-color" onclick="addGoods()">选择商品</button>
		</div>
	</div>
	<input type="hidden" name="goods_ids">

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
</div>

<!-- 操作 -->
<script type="text/html" id="action">
	<div class="ns-table-btn">
		<a class="layui-btn" onclick="delGoods({{d.goods_id}})">删除</a>
	</div>
</script>

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


<script>
    var submitRule, delRule,table;
    var goods_list = [], selectedGoodsId = [], goods_id=[];

    layui.use(['form', 'laydate','form'], function() {
        var form = layui.form,
            laydate = layui.laydate,
            repeat_flag = false; //防重复标识
        currentDate = new Date();  //当前时间
        form.render();

        currentDate.setDate(currentDate.getDate() + 10);  //10天后的日期

        // 时间模块
        laydate.render({
            elem: '#end_time', //指定元素
            type: 'datetime',
            value: currentDate
        });

		// 图片上传
		var couponImg_upload = new Upload({
			elem: '#couponImg',
			url: ns.url("shop/upload/image"),
		});

        renderTable(goods_list); // 初始化表格

        //监听活动商品类型
        form.on('radio(goods_type)', function(data){
            var value = data.value;

            if(value == 1){
                $(".goods_list").hide();
            }
            if(value == 2){
                $(".goods_list").show();
            }
        });

        // 监听单选按钮
        form.on('radio(filter)', function(data) {
            if (data.value == 0) {
                $('.ns-end-time').removeClass('layui-hide');
                $('.ns-fixed-term').addClass('layui-hide');
            } else {
                $('.ns-fixed-term').removeClass('layui-hide');
                $('.ns-end-time').addClass('layui-hide');
            }
        });

        /**
         * 表单验证
         */
        form.verify({
            days: function(value) {
                if (value == '') {
                    return;
                }
                if (value%1 != 0) {
                    return '请输入整数';
                }
            },
            number: function (value) {
                if (value < 0) {
                    return '请输入大于或等于0的数!'
                }
            },
            int: function (value) {
                if (value%1 != 0) {
                    return '请输入整数!'
                }
                if (value < 0) {
                    return '请输入大于0的数!'
                }
            },
            money: function (value) {
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}
				if (val.length > 2) {
					return '保留小数点后两位'
				}
            },
            time: function(value) {
                var now_time = (new Date()).getTime();
                var end_time = (new Date(value)).getTime();
                if (now_time > end_time) {
                    return '结束时间不能小于当前时间!'
                }
            },
            max: function(value) {
                var _count = $("input[name=count]").val();
                if (parseFloat(value) > parseFloat(_count)) {
                    return '最大领取数量不能超过发放数量!';
                }
            },
            fl: function(value, item) {
                var str = $(item).parents(".layui-form-item").find("label").text().split("*").join("");
                str = str.substring(0, str.length - 1);

                if (value < 1) {
                    return str + "不能小于1折";
                }

                if (value > 9.9) {
                    return str + "不能大于9.9折";
                }

                var arrMen = value.split(".");
                var val = 0;
                if (arrMen.length == 2) {
                    val = arrMen[1];
                }
                if (val.length > 2) {
                    return str + "最多可保留两位小数";
                }
            },
			gtzero: function(value) {
				if (parseFloat(value) <= 0) {
					return '请输入大于0的数!'
				}
			},
        });

        /**
         * 监听提交
         */
        form.on('submit(save)', function(data) {

            if (data.field.is_show == undefined) {
                data.field.is_show = 0;
            }

            if(data.field.goods_type != 1){
                if(data.field.goods_ids == ''){
                    layer.msg("请选择商品");
                    return;
                }
            }

            if (repeat_flag) return;
            repeat_flag = true;
			
			//删除图片
			if(!data.field.image) couponImg_upload.delete();
			
            $.ajax({
                url: ns.url("coupon://shop/coupon/add"),
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(res) {
                    repeat_flag = false;

                    if (res.code == 0) {
                        layer.confirm('添加成功', {
                            title:'操作提示',
                            btn: ['返回列表', '继续添加'],
                            yes: function(){
                                location.href = ns.url("coupon://shop/coupon/lists")
                            },
                            btn2: function() {
                                location.href = ns.url("coupon://shop/coupon/add")
                            }
                        });
                    }else{
                        layer.msg(res.message);
                    }
                }
            });

        });

        submitRule = function() {
            var money = $("#money").val().trim(),
                discount_money = $("#discount_money").val().trim();

            if (Number(money) == "0" || Number(discount_money) == "0") {
                layer.msg("满减金额不能为空！", {icon: 5, anim: 6});
                return false;
            }
            if (Number(money) < 0 || Number(discount_money) < 0) {
                layer.msg("金额不能小于0！", {icon: 5, anim: 6});
                return false;
            }
            if (Number(money) * 100 % 1 != 0 || Number(discount_money) * 100 % 1 != 0) {
                layer.msg("金额最多保留小数点后两位！", {icon: 5, anim: 6});
                return false;
            }

            for (var i=0; i<$(".ns-discount-box .ns-discount").length; i++) {
                var money_num = $(".ns-discount-box .ns-discount").eq(i).find(".money-num").text();
                if (money == money_num) {
                    layer.msg("该金额规则已添加，不可重复添加！");
                    return false;
                }
            }

            var html = '<div class="ns-discount ns-form-row">'+
                '<div class="ns-discount-con">'+
                '<p>单笔订单满<span class="required money-num">' + money + '</span>元，立减现金<span class="required discount_money-num">' + discount_money + '</span>元</p>'+
                '</div>'+
                '<div class="ns-discount-del">'+
                '<button class="layui-btn ns-bg-color" onclick="delRule(this)">删除</button>'+
                '</div>'+
                '</div>';
            $(".ns-discount-box").append(html);
        };

        delRule = function(obj) {
            $(obj).parent().parent().remove();
        };

        $(".ns-exchange-type").click(function() {
            $(this).addClass("ns-exchange-selected");
            $(this).siblings("button").removeClass("ns-exchange-selected");

            var type = $(this).attr('data-status');

            var current_type = $("input[name='type']").val();
            if(current_type == type){
                return false;
            }

            $("input[name='type']").val(type);

            var html = '';
            if(type == 'reward'){
                html += '<label class="layui-form-label"><span class="required">*</span>优惠券面额：</label>' +
						'<div class="layui-input-block">' +
							'<div class="layui-input-inline">' +
								'<input type="number" name="money" min="0" lay-verify="required|number|money" autocomplete="off" class="layui-input ns-len-short">' +
							'</div>' +
							'<span class="layui-form-mid">元</span>' +
						'</div>' +
						'<div class="ns-word-aux">' +
							'<p>价格不能小于0，可保留两位小数</p>' +
						'</div>';

                $('.discount_limit').remove();
			}

            if(type == 'discount'){
                html += '<label class="layui-form-label"><span class="required">*</span>优惠券折扣：</label>' +
                    '<div class="layui-input-block">' +
                    '<div class="layui-input-inline">' +
                    '<input type="number" name="discount" min="1" lay-verify="required|fl" autocomplete="off" class="layui-input ns-len-short">' +
                    '</div>' +
                    '<span class="layui-form-mid">折</span>' +
                    '</div>' +
                    '<div class="ns-word-aux">' +
                    '<p>优惠券折扣不能小于1折，且不可大于9.9折，可保留两位小数</p>' +
                    '</div>';

		    	var discount_limit = '';
                discount_limit += '<div class="layui-form-item discount_limit">' +
                    '<label class="layui-form-label">最多优惠：</label>' +
                    '<div class="layui-input-block">' +
                    '<div class="layui-input-inline">' +
                    '<input type="number" name="discount_limit" min="0" lay-verify="number|int" autocomplete="off" class="layui-input ns-len-short">' +
                    '</div>' +
                    '<span class="layui-form-mid">元</span>' +
                    '</div>' +
                    '</div>';
                $('#coupon_type').after(discount_limit);
            }
			$('#coupon_type').html(html);
        });

    });

    // 表格渲染
    function renderTable(goods_list) {
        //展示已知数据
        table = new Table({
            elem: '#selected_goods_list',
            cols: [
                [{
                    field: 'goods_name',
                    title: '商品名称',
                    unresize: 'false',
                    width: '50%'
                }, {
                    field: 'price',
                    title: '商品价格(元)',
                    unresize: 'false',
                    align: 'right',
                    width: '20%',
                    templet: function(data) {
                        return '￥' + data.price;
                    }
                }, {
                    field: 'goods_stock',
                    title: '库存',
                    unresize: 'false',
                    align: 'center',
                    width: '20%'
                }, {
                    title: '操作',
                    toolbar: '#action',
                    unresize: 'false',
                    width: '10%'
                }],
            ],
            data: goods_list,
        });
    }

    // 删除选中商品
    function delGoods(id) {
        var i, j;
        $.each(goods_list, function(index, item) {
            var goods_id = item.goods_id;

            if (id == Number(goods_id)) {
                i = index;
            }
        });
        goods_list.splice(i, 1);
        renderTable(goods_list);

        $.each(selectedGoodsId, function(index, item) {
            if (id == Number(item)) {
                j = index;
            }
        });
        selectedGoodsId.splice(j, 1);
        goods_id = selectedGoodsId;
        $("input[name='goods_ids']").val(goods_id.toString());
    }

    /* 商品 */
    function addGoods(){
        goodsSelect(function (res) {
			selectedGoodsId = [];
			goods_id = [];
			goods_list = [];
			if (!res.length) return false;
            for(var i=0;i<res.length;i++) {
                goods_id.push(res[i].goods_id);
                goods_list.push(res[i]);
            }

            renderTable(goods_list);
            $("input[name='goods_ids']").val(goods_id.toString());
            selectedGoodsId = goods_id;

        },selectedGoodsId, {mode: "spu"});
    }

    function back() {
        location.href = ns.url("coupon://shop/coupon/lists");
    }
</script>

</body>

</html>