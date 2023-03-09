<?php /*a:2:{s:69:"/www/wwwroot/ls.chnssl.com/addon/discount/shop/view/discount/add.html";i:1614520098;s:23:"app/shop/view/base.html";i:1660100996;}*/ ?>
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
	.layui-table-body{max-height: 480px !important;}
	.layui-form-item .layui-input-inline.end-time{float: none;}
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
			<li>管理员可以在此页添加限时折扣活动</li>
			<li>活动时间不可与列表中的折扣活动时间冲突</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>活动名称：</label>
		<div class="layui-input-block">
			<input type="text" name="discount_name" lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">
			<p>活动名称将显示在限时折扣活动列表中，方便商家管理使用</p>
		</div>
	</div>

	<div class="layui-form-item layui-form-text">
		<label class="layui-form-label">备注：</label>
		<div class="layui-input-block">
			<textarea name="remark" class="layui-textarea ns-len-long"></textarea>
		</div>
		<div class="ns-word-aux">
			<p>备注是商家对限时折扣活动的补充说明文字，在商品详情页-优惠信息位置显示；非必填选项</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>活动时间：</label>
		<div class="layui-inline">
			<div class="layui-input-inline">
				<input type="text" id="start_time" name="start_time" lay-verify="required" class="layui-input ns-len-mid" autocomplete="off" readonly>
				<i class="ns-calendar"></i>
			</div>
			<span class="layui-form-mid">-</span>
			<div class="layui-input-inline end-time">
				<input type="text" id="end_time" name="end_time" lay-verify="required|time" class="layui-input ns-len-mid" autocomplete="off" readonly>
				<i class="ns-calendar"></i>
			</div>
		</div>
	</div>

	<div class="layui-form-item goods_list">
		<label class="layui-form-label"><span class="required">*</span>商品选择：</label>
		<div class="layui-input-block">
			<table id="selected_goods_list" lay-filter="selected_goods_list"></table>
			<button class="layui-btn ns-bg-color" onclick="addGoods()">选择商品</button>
		</div>
	</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
</div>

<!-- 操作 -->
<script type="text/html" id="operation">
	<div class="ns-table-btn">
		<a class="layui-btn" onclick="delGoods(this,{{d.sku_id}})">删除</a>
	</div>
</script>

<script type="text/html" id="discountPrice">
	<input type="number" class="layui-input ns-len-input discount_price" value="{{d.discount_price}}" onchange="setGoodsSku('discount_price', {{d.sku_id}}, this)" lay-verify="discount_price" min="0.00"/>
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


<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="discount-price">折扣价</button>
</script>
<script>
	var goods_id = [], selectedGoodsId = [], sku_list = [];

	layui.use(['form', 'laydate'], function() {
		var form = layui.form,
			laydate = layui.laydate,
			repeat_flag = false, //防重复标识
			currentDate = new Date(),
			minDate = "";
		form.render();

		currentDate.setDate(currentDate.getDate() + 30);

		renderTable(sku_list); // 初始化表格

		laydate.render({
			elem: '#start_time', //指定元素
			type: 'datetime',
			value: new Date(),
			done: function(value) {
				minDate = value;
				reRender();
			}
		});

		//结束时间
		laydate.render({
			elem: '#end_time', //指定元素
			type: 'datetime',
			value: new Date(currentDate)
		});

		/**
		 * 重新渲染结束时间
		 * */
		function reRender() {
			$("#end_time").remove();
			$(".end-time").html('<input type="text" id="end_time" name="end_time" placeholder="请输入结束时间" lay-verify="required|time" class = "layui-input ns-len-mid" autocomplete="off"> ');
			laydate.render({
				elem: '#end_time',
				type: 'datetime',
				min: minDate
			});
		}

		form.on('submit(save)', function(data) {

			var goods_data = [];

			for (var i in sku_list){
				var goods = {};
				goods.goods_id = sku_list[i]['goods_id'];
				if(goods_data.length == 0){
					goods_data.push(goods);
				}else {
					$.each(goods_data, function(index, event){
						if(goods_data.length == index+1 && event.goods_id != goods.goods_id){
							goods_data.push(goods);
						}
					})
				}
			}

			if(sku_list.length == 0){
				layer.msg('请选择商品', {icon: 5, anim: 6});
				return false;
			}

			$.each(goods_data, function (i, e) {
				goods_data[i]['sku_list'] = [];
				$.each(sku_list, function (index, event) {
					if(event.goods_id == e.goods_id) {
						goods_data[i]['sku_list'].push(event);
					}
				})
			});

			data.field.goods_data = goods_data;
			if (repeat_flag) return;
			repeat_flag = true;
			$.ajax({
				url: ns.url("discount://shop/discount/add"),
				data: data.field,
				dataType: 'JSON',
				type: 'POST',
				success: function(res) {
					repeat_flag = false;

					if (res.code == 0) {
						layer.confirm('添加成功', {
							title: '操作提示',
							btn: ['返回列表', '继续添加'],
							closeBtn: 0,
							yes: function() {
								location.href = ns.url("discount://shop/discount/lists")
							},
							btn2: function() {
								location.href = ns.url("discount://shop/discount/add");
							}
						});
					} else {
						layer.msg(res.message);
					}
				}
			});
		});

		/**
		 * 表单验证
		 */
		form.verify({
			time: function(value) {
				var now_time = (new Date()).getTime();
				var start_time = (new Date($("#start_time").val())).getTime();
				var end_time = (new Date(value)).getTime();
				if (now_time > end_time) {
					return '结束时间不能小于当前时间!'
				}
				if (start_time > end_time) {
					return '结束时间不能小于开始时间!';
				}
			},

			discount_price: function(value, item) {
				if (value == "" || value == 0) {
					return;
				}
				if (value < 0) {
					return '折扣金额不能小于0';
				}

			}
		});

	});

	function delGoods(obj,id) {
		var goods_ids = [];
		for (let i = 0; i < sku_list.length; i++){
			if (sku_list[i].sku_id == parseInt(id)){
				sku_list.splice(i,1);
			}
		}
		for (let i = 0; i < sku_list.length; i++){
			goods_ids.push(sku_list[i].goods_id);
		}
		$(obj).parents("tr").remove();
		selectedGoodsId = goods_ids.toString();
	}

	// 表格渲染
	function renderTable(sku_list) {
		//展示已知数据
		table = new Table({
			elem: '#selected_goods_list',
			page: false,
			limit: Number.MAX_VALUE,
			cols: [
				[{
					width: "3%",
					type: 'checkbox',
					unresize: 'false'
				},{
					field: 'sku_name',
					title: '商品名称',
					width: '23%',
					unresize: 'false',
					templet: function(data) {
						var html = '';
						html += `
							<div class="goods-title">
								<div class="goods-img">
									<img layer-src src="${data.sku_image ? ns.img(data.sku_image) : ''}" alt="">
								</div>
								<p class="ns-multi-line-hiding goods-name" data-goods_id="${data.goods_id}" data-sku_id="${data.sku_id}" title="${data.sku_name}">${data.sku_name}</p>
							</div>
						`;
						return html;
					}
				}, {
					field: 'price',
					title: '商品价格',
					unresize: 'false',
					align: 'left',
					width: '15%',
					templet: function(data) {
						return '<p class="ns-line-hiding" title="'+ data.price +'">￥<span>' + data.price +'</span></p>';
					}
				}, {
					field: 'stock',
					title: '库存',
					unresize: 'false',
					width: '10%',
					templet: function(data) {
						return '<p class="stock">' + data.stock +'</p>';
					}
				}, {
					title: '<span title="折扣价">折扣价<span>',
					unresize: 'false',
					width: '13%',
					templet: '#discountPrice'

				}, {
					title: '操作',
					toolbar: '#operation',
					width: '10%',
					unresize: 'false'
				}]
			],
			data: sku_list,
			toolbar: '#toolbarOperation'
		});
		/**
		 * 批量操作
		 */
		table.toolbar(function(obj) {

			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			switch (obj.event) {
				case "discount-price":
					editInput(0,obj);
					break;
			}
		});
	}

	function editInput(textIndex=0,data) {
		var text = [{
			name: '折扣价',
			value: 'discount_price'
		}];

		layer.open({
			type: 1,
			title:"修改"+text[textIndex].name,
			area:['600px'],
			btn:["保存","返回"],
			content: `
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>${text[textIndex].name}：</label>
				<div class="layui-input-block">
					<input type="text" name="bargain_edit_input" lay-verify="required" autocomplete="off" class="layui-input ns-len-mid"  placeholder="请输入${text[textIndex].name}">
				</div>
			</div>
		`,
			yes: function(index, layero){
				var val = $("input[name='bargain_edit_input']").val();
				if (!val){
					layer.msg("请输入" + text[textIndex].name);
					return false;
				}
				data.data.forEach(function (item,index) {
					sku_list.forEach(function (skuItem,skuIndex) {
						if (item.sku_id == skuItem.sku_id){
							sku_list[skuIndex][text[textIndex].value] = val;
						}
					})
				});
				renderTable(sku_list);
				layer.closeAll();
			}
		});
	}

	/* 商品 */
	function addGoods(){

		goodsSelect(function (res) {
			if (!res.length) return false;
			for(var i=0;i<res.length;i++) {
				for (var k = 0; k < res[i].selected_sku_list.length; k++) {
					var item = res[i].selected_sku_list[k];
					item.discount_price = item.price;
					goods_id.push(item.goods_id);
					sku_list.push(item);
				}
			}
			renderTable(sku_list);
			selectedGoodsId = goods_id;


		}, selectedGoodsId);
	}

	function setGoodsSku(type, sku_id, obj){
		$.each(sku_list, function (i, e) {
			if(sku_id == e.sku_id){
				sku_list[i][type] = $(obj).val();
			}
		})
	}

	function back() {
		location.href = ns.url("discount://shop/discount/lists");
	}
</script>

</body>

</html>