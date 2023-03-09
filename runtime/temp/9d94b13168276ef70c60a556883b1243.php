<?php /*a:2:{s:69:"/www/wwwroot/ls.chnssl.com/addon/bundling/shop/view/bundling/add.html";i:1614520240;s:23:"app/shop/view/base.html";i:1654828558;}*/ ?>
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
	#goods thead th{ background-color: #e6e6e6;}
	/* 优惠商品 */
	.goods-empty { width: 100%; display: flex; justify-content: center; align-items: center; }
	.goods-title{display: flex;align-items: center;}
	.goods-title .goods-img{display: flex;align-items: center;justify-content: center;width: 55px;height: 55px;margin-right: 5px;}
	.goods-title .goods-img img{max-height: 100%;max-width: 100%;}
	.goods-title .goods-name{flex: 1;line-height: 1.6;}
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
			<li>每个活动可添加2到6个商品</li>
			<li>凡选择指定优惠的商品，在这个商品的详细页将出现发布的优惠套装</li>
			<li>特殊商品不能参加该活动</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form" id="add_active">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>优惠套餐名称：</label>
		<div class="layui-input-block">
			<input type="text" name="bl_name" lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">
			<p>请认真填写组合优惠套餐名称，使顾客能从名称了解该套餐</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>商品：</label>
		<div class="layui-input-block">
			<table class="layui-table" id="goods" lay-skin="line" lay-size="lg">
				<colgroup>
					<col width="45%">
					<col width="20%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
				<tr>
					<th>商品名称</th>
					<th>价格</th>
					<th>库存</th>
					<th class="operation">操作</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td colspan="4">
						<div class="goods-empty">未添加商品</div>
					</td>
				</tr>
				</tbody>
			</table>
			<button class="layui-btn ns-bg-color" onclick="addGoods()">添加商品</button>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">优惠套餐价格：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="bl_price" onblur="bl_price" id="bl_price" lay-verify="flo" autocomplete="off" class="layui-input combined-price ns-len-short"
					   value="0.00" step="1" min="0.00">
			</div>
			<span class="layui-form-mid">元</span>
		</div>
		<div class="ns-word-aux">
			<p>价格不能小于0，可保留两位小数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">原价：</label>
		<div class="layui-input-block">
			<p class="ns-input-text"><span class="original-price">0.00</span>元</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">节省价：</label>
		<div class="layui-input-block">
			<p class="ns-input-text"><span class="save-prices">0.00</span>元</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">运费承担：</label>
		<div class="layui-input-block">
			<input type="radio" name="shipping_fee_type" value="1" title="卖家承担运费" checked>
			<input type="radio" name="shipping_fee_type" value="2" title="买家承担运费（快递）">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否上下架：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="status" lay-filter="isOpen" value="1" lay-skin="switch" checked />
		</div>
	</div>

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

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
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
	var form, selectGoodsSkuId = []; //已选商品id
	layui.use("form", function() {
		form = layui.form;
		var repeat_flag = false; //防重复标识
		form.on('submit(save)', function(data) {

			var num = $("#goods").find("tbody tr").length;
			if (num < 2) { //判断提交时商品数量是否在2-6之间
				layer.msg("商品数不可小于2个！", {
					icon: 5
				});
				return;
			}

			if (data.field.status == undefined) {
				data.field.status = 0;
			}
			data.field.sku_ids = selectGoodsSkuId.toString();

			if (repeat_flag) return;
			repeat_flag = true;

			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: ns.url("bundling://shop/bundling/add"),
				data: data.field,
				async: false,
				success: function(res) {
					repeat_flag = false;
					if (res.code == 0) {
						layer.confirm('添加成功', {
							title: '操作提示',
							btn: ['返回列表', '继续添加'],
							yes: function() {
								location.href = ns.url("bundling://shop/bundling/lists");
							},
							btn2: function() {
								location.href = ns.url("bundling://shop/bundling/add");
							}
						});
					} else {
						layer.msg(res.message);
					}
				}
			})
		});

		form.verify({
			flo: function(value) {
				if (value == '') {
					return;
				}
				var reg = /^(0|[1-9]\d*)(\s|$|\.\d{1,2}\b)/;
				if (!reg.test(value)) {
					return '价格不能小于0，可保留两位小数！'
				}
			}
		});
	});

	/**
	 * 添加商品
	 */
	function addGoods() {
		goodsSelect(function(res) {
			if (!res.length) return false;
			var price = 0.00;
			var html = $("#goods tbody .goods-empty").length ? '' : $("#goods tbody").html();
			for (var i = 0; i < res.length; i++) {
				for (var k = 0; k < res[i].selected_sku_list.length; k++) {
					var item = res[i].selected_sku_list[k];
					html += `<tr data-sku_id="${item.sku_id}">`;
					html +=
							`
						<td>
							<div class="goods-title">
								<div class="goods-img">
									<img layer-src src="${item.sku_image ? ns.img(item.sku_image) : ''}" alt="">
								</div>
								<p class="ns-multi-line-hiding goods-name">${item.sku_name}</p>
							</div>
						</td>
					`;
					html += `<td class='price-one'>${item.price }</td>`;
					html += `<td>${item.stock}</td>`;
					html +=
							`<td class='operation'> <div class='ns-table-btn '><a href='javascript:;' class='layui-btn' onclick='deleteGoods(this)'>删除商品</a></div></td>`;
					html += `</tr>`;

					price += Number(item.price);
					selectGoodsSkuId.push(item.sku_id);
				}
			}

			$("#goods tbody").html(html);
			$(".original-price").text(price.toFixed(2));
			$(".combined-price").val(price.toFixed(2));
			$(".save-prices").text(0);

		}, selectGoodsSkuId, {
			mode: "sku",
			max_num: 6,
			min_num: 2
		});
	}

	/**
	 * 删除商品
	 */
	function deleteGoods(data) {
		var obj = $(data).parent().parent().parent();
		$(obj).remove();
		priceCount(); //计算出当前总价格
		for (var i in selectGoodsSkuId) {
			if (selectGoodsSkuId[i] == Number($(obj).attr("data-sku_id"))) {
				selectGoodsSkuId.splice(i, 1);
			}
		}
	}

	/**
	 * 计算总价
	 */
	function priceCount() {
		var price_count = 0;
		$("#goods").find("tbody td.price-one").each(function(i) {
			var price_one = Number($(this).text());
			price_count += price_one;
		});
		$(".original-price").text(price_count.toFixed(2));
		$(".save-prices").text(0);
		$(".combined-price").val(price_count.toFixed(2));

		if (price_count == 0) {
			var html = '<tr>' +
					'<td colspan="4">' +
					'<div class="goods-empty">未选择添加商品</div>' +
					'</td>' +
					'</tr>';

			$("#goods tbody").html(html);
		}
	}

	$("#bl_price").blur(function() {
		var bl_price = $(this).val();
		if (bl_price < 0) {
			layer.msg("价格不能小于0，可保留两位小数");
		}
	});

	/**
	 * 计算组合套餐价格、原价、节省价
	 */
	$(".combined-price").blur(function() {
		var combinedPrice = $(this).val(),
				originalPrice = Number($(".original-price").text());

		if (combinedPrice > originalPrice) {
			$(this).val(originalPrice);
			layer.msg("优惠套餐价格不能高于原价");
			$(".save-prices").text(0);
		} else {
			var num = accSub(originalPrice, combinedPrice);
			$(".save-prices").text(num);
		}
	});

	// 两个浮点数相减
	function accSub(num1, num2) {
		var r1, r2, m;

		try {
			r1 = num1.toString().split(".")[1].length;
		} catch (e) {
			r1 = 0;
		}

		try {
			r2 = num2.toString().split(".")[1].length;
		} catch (e) {
			r2 = 0;
		}

		m = Math.pow(10, Math.max(r1, r2));
		n = (r1 >= r2) ? r1 : r2;
		return (Math.round(num1 * m - num2 * m) / m).toFixed(2);
	}

	//返回按钮
	function back() {
		location.href = ns.url("bundling://shop/bundling/lists");
	}
</script>

</body>

</html>