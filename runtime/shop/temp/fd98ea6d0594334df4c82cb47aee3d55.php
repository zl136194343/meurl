<?php /*a:2:{s:60:"/www/wwwroot/ls.chnssl.com/app/shop/view/verify/records.html";i:1614516284;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
	.ns-screen{margin-bottom: 15px;}
	.contraction span {
		cursor: pointer;
		display: inline-block;
		width: 17px;
		height: 17px;
		text-align: center;
		line-height: 14px;
		user-select: none;
	}
	.verify-list {
		overflow: hidden;
		padding: 0 45px;
	}
	.verify-list li .img-wrap {
		vertical-align: middle;
		margin-right: 8px;
		width: 120px;
		height: 120px;
		text-align: center;
		line-height: 120px;
	}
	.verify-list li .img-wrap img {
		max-width: 100%;
		max-height: 100%;
	}
	.verify-list li .info-wrap span.sku-name {
		-webkit-line-clamp: 2;
		margin-bottom: 5px;
	}
	.verify-list li .info-wrap span {
		display: -webkit-box;
		margin-bottom: 5px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: normal;
		word-break: break-all;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 1;
	}
	.verify-list li {
		float: left;
		display: flex;
		padding: 10px;
		margin-right: 10px;
		margin-bottom: 10px;
		border: 1px solid #EFEFEF;
		width: 294px;
		height: 140px;
		align-items: center;
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
			
				

<!-- 搜索框 -->
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">核销员名称：</label>
					<div class="layui-input-inline">
						<input type="text" name="verifier_name" placeholder="请输入核销员名称" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">核销类型：</label>
					<div class="layui-input-inline">
						<select name="verify_type">
							<option value="">请选择核销类型</option>
							<?php foreach($verify_type as $k => $v): ?>
							<option value="<?php echo htmlentities($k); ?>"><?php echo htmlentities($v['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">核销时间：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_time" id="start_time" autocomplete="off" placeholder="开始时间" readonly>
						<i class="ns-calendar"></i>
					</div>
					<div class="layui-form-mid">-</div>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="end_time" id="end_time" autocomplete="off" placeholder="结束时间" readonly>
						<i class="ns-calendar"></i>
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label">核销码：</label>
					<div class="layui-input-inline">
						<input type="text" name="verify_code" placeholder="请输入核销码" autocomplete="off" class="layui-input">
					</div>
				</div>
			</div>

			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	</div>
</div>

<table id="verify_list" lay-filter="verify_list"></table>

<!-- 核销信息 -->
<script type="text/html" id="verify_code">
	<div class="ns-table-title">
		<div class="contraction" data-id="{{d.id}}" data-open="0">
			<span>+</span>
		</div>
		<div class="ns-title-content">{{ d.verify_code }}</div>
	</div>
</script>

<!-- 核销内容 -->
<script type="text/html" id="verifyList">
	<tr class="js-list-{{d.index}}" id="sku_img_{{d.index}}">
		<td colspan="8">
			<ul class="verify-list">
				{{# for(var i=0; i<d.list.length; i++){ }}
				<li>
					<div class="img-wrap">
						<img layer-src src="{{ns.img(d.list[i].img)}}">
					</div>
					<div class="info-wrap">
						<span class="sku-name">{{d.list[i].name}}</span>
						<span class="price">价格：￥{{d.list[i].price}}</span>
						<span class="sale_num">数量：{{d.list[i].num}}</span>
					</div>
				</li>
				{{# } }}
			</ul>
		</td>
	</tr>
</script>

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
	var laytpl;
	$(function () {
		$("body").on("click", ".contraction", function () {

			var id = $(this).attr("data-id");
			var open = $(this).attr("data-open");
			var tr = $(this).parent().parent().parent().parent();
			var index = tr.attr("data-index");
			if (open == 1) {
				$(this).children("span").text("+");
				$(".js-list-" + index).remove();
			} else {
				$(this).children("span").text("-");
				$.ajax({
					url: ns.url("shop/verify/verifyInfo"),
					data: {id: id},
					dataType: 'JSON',
					type: 'POST',
					async: false,
					success: function (res) {
						var verify_list = $("#verifyList").html();
						var data = {
							list: res.data.data.item_array,
							index: index
						};

						laytpl(verify_list).render(data, function (html) {
							tr.after(html);
						});
						layer.photos({
							photos: '.img-wrap',
							anim: 5
						});
					}
				});
			}
			$(this).attr("data-open", (open == 0 ? 1 : 0));
		});

		layui.use(['form', 'laydate','laytpl'], function () {
			laytpl = layui.laytpl;
			var table,
					form = layui.form,
					laydate = layui.laydate;
			form.render();

			//渲染时间
			laydate.render({
				elem: '#start_time',
				type: 'datetime'
			});

			laydate.render({
				elem: '#end_time',
				type: 'datetime'
			});

			table = new Table({
				elem: '#verify_list',
				url: ns.url("shop/verify/records"), //数据接口
				cols: [
					[{
						title: '核销码',
						width: '20%',
						templet: '#verify_code'
					}, {
						field: 'verify_type_name',
						title: '核销类型',
						width: '14%'
					}, {
						field: 'verifier_name',
						title: '核销员',
						width: '13%'
					}, {
						field: 'verify_status',
						title: '状态',
						width: '13%',
						templet: function (data) {
							var verify_name = "";
							if (data.is_verify == 1) {
								verify_name = "已核销";
							} else {
								verify_name = "尚未核销";
							}
							return verify_name; //创建时间转换方法
						}
					}, {
						field: 'create_time',
						title: '创建时间',
						width: '20%',
						templet: function (data) {
							return ns.time_to_date(data.create_time); //创建时间转换方法
						}
					}, {
						field: 'verify_time',
						title: '核销时间',
						width: '20%',
						templet: function (data) {
							return ns.time_to_date(data.verify_time); //创建时间转换方法
						}
					}]
				]
			});

			/**
			 * 搜索功能
			 */
			form.on('submit(search)', function (data) {
				table.reload({
					page: {
						curr: 1
					},
					where: data.field
				});
				return false;
			});

		});

	})
</script>

</body>

</html>