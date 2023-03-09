<?php /*a:2:{s:66:"/www/wwwroot/www.hunqin.com/app/shop/view/account/reopen_list.html";i:1614516186;s:51:"/www/wwwroot/www.hunqin.com/app/shop/view/base.html";i:1654828558;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/shop/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	.ns-shop-account {
		display: flex;
		align-items: center;
		position: relative;
		padding: 15px;
		box-sizing: border-box;
	}

	.ns-shop-detail p {
		display: inline-block;
		width: 300px;
		line-height: 30px;
	}

	.ns-shop-account>a {
		position: absolute;
		right: 15px;
		bottom: 15px;
		cursor: pointer;
	}
	
	#renewal_list {
		margin-top: 15px;
	}
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="https://xyhl.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="https://xyhl.chnssl.com/app/shop/view/public/img/shop_logo.png">
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
								<img src="https://xyhl.chnssl.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
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
			<li>1、店铺到期30日内可以申请续签</li>
			<li>2、请认准官方收款账户，支付凭据上传之后请联系官方客服人员</li>
		</ul>
	</div>
</div>

<?php if(isset($apply_data['is_reopen']) && $apply_data['is_reopen']  == 2 && $apply_data['cert_id'] == 0): ?>
<div class="ns-form">
	<input class="end-time" type="hidden" value="<?php echo htmlentities($apply_data['end_time']); ?>" />
	<button class="ns-bg-color layui-btn shop_auth_apply">申请续签</button>
</div>
<?php elseif(isset($apply_data['is_reopen']) && $apply_data['is_reopen']  == 2 && $apply_data['cert_id'] > 0): ?>
<div class="ns-form">
	<input class="end-time" type="hidden" value="<?php echo htmlentities($apply_data['end_time']); ?>" />
	<?php if($is_reopen == 1): ?>
	<button class="ns-bg-color layui-btn reopen_apply">申请续签</button>
	<?php else: ?>
	<button class="ns-bg-color layui-btn reopen_apply_detail">申请续签</button>
	<?php endif; ?>
</div>
<?php endif; ?>
<div class="ns-form">
	<input class="end-time" type="hidden" value="<?php echo htmlentities($apply_data['end_time']); ?>" />

	<div class="layui-card-body ns-item-block-parent ns-shop-account">
		<div class="ns-item-pic" id="shop_img">
			<?php if($apply_data['logo']): ?>
			<img layer-src src="<?php echo img($apply_data['logo']); ?>" />
			<?php else: ?>
			<img layer-src src="https://xyhl.chnssl.com/public/static/img/default_shop.png" />
			<?php endif; ?>
		</div>
		<div class="ns-shop-detail">
			<p><strong>店铺名称：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($apply_data['site_name']); ?></span></p>
			<p><strong>店铺分类：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($apply_data['category_name']); ?></span></p>
			<br>
			<p><strong>开店套餐：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($apply_data['group_name']); ?></span></p>
			<p><strong>到期时间：</strong><span class="ns-text-color-dark-gray ns-end-time"><?php echo htmlentities($apply_data['expire_time']); ?></span></p>
		</div>
		<?php if(isset($apply_data['is_reopen']) && $apply_data['is_reopen']  == 3): ?>
		<a class="ns-text-color" onclick="addRenewal()">续签>></a>
		<?php endif; ?>
	</div>
</div>
<table id="renewal_list" lay-filter="renewal_list"></table>

<input class="shop-group-id" type="hidden" value="<?php echo htmlentities($apply_data['group_id']); ?>" name="group_id" />  <!-- 分组ID -->
<input class="shop-category-id" type="hidden" value="<?php echo htmlentities($apply_data['category_id']); ?>" name="category_id" />  <!-- 分类ID -->

<!-- 付款凭证 -->
<script type="text/html" id="paymentVoucher">
	<div class="ns-img-box">
	{{#  if(d.paying_money_certificate){  }}
		<img layer-src src="{{ns.img(d.paying_money_certificate)}}"/>
	{{#  }  }}
	</div>
</script>

<!-- 状态 -->
<script type="text/html" id="status">
	{{#  if(d.apply_state == 1){  }}
	待审核
	{{#  }else if(d.apply_state == -1){  }}
	审核失败
	{{#  }else if(d.apply_state == 2){  }}
	审核成功
	{{#  }  }}
</script>

<!-- 工具栏操作 -->
<script type="text/html" id="action">

	<div class="ns-table-btn">
		{{#  if(d.apply_state == 1 || d.apply_state == 2){  }}
		<a class="layui-btn" lay-event="show">查看</a>
		<a class="layui-btn" lay-event="del">删除</a>
		{{#  }else if(d.apply_state == -1){  }}
		<a class="layui-btn" lay-event="show">查看</a>
		<a class="layui-btn" lay-event="del">删除</a>
		<a class="layui-btn" lay-event="edit">编辑</a>
		{{#  }  }}
	</div>

</script>

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
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
	// 到期时间
	var end_time = $(".end-time").val();
//	var end_time_date = ns.time_to_date(end_time);
//	$(".ns-end-time").text(end_time_date);

	var table, form, laytpl, laydate, repeat_flag = false;
	layui.use(['form', 'laytpl', 'laydate'], function() {
		form = layui.form;
		laytpl = layui.laytpl;
		laydate = layui.laydate;

		form.render();
		
		table = new Table({
			elem: '#renewal_list',
			url: ns.url("shop/shopreopen/index"),
			cols: [
				[{
                    field: 'reopen_no',
                    title: '续签编号',
                    unresize: 'false'
                },{
					field: 'apply_year',
					title: '续签时长（年）',
					unresize: 'false'
				}, {
					field: 'paying_amount',
					title: '缴费金额（元）',
					unresize: 'false'
				}, {
					field: 'paying_money_certificate',
					title: '付款凭证',
					unresize: 'false',
					templet: '#paymentVoucher'
				}, {
					title: '状态',
					unresize: 'false',
					templet: '#status'
				}, {
					field: 'create_time',
					title: '创建时间',
					unresize: 'false',
					templet: function(data) {
						return ns.time_to_date(data.create_time)
					}
				}, {
					title: '操作',
					unresize: 'false',
					toolbar: '#action',
				}]
			]
		});

		/**
		 * 监听工具栏操作
		 */
		var obj_edit = {};
		table.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case 'edit': //编辑
                    location.href = ns.url("shop/cert/editreopeninfo?id="+data.id);
					break;
				case 'del': //删除

					deleteApply(data.id);
					break;
                case 'show':

                    laytpl($("#renewal_show").html()).render(data, function(html) {
                        layer_edit_renewal = layer.open({
                            title: '续签记录详情',
                            skin: 'layer-tips-class',
                            type: 1,
                            area: ['650px'],
                            content: html,
                        });
                    });
                    break;
			}
		});

		/**
		 * 删除
		 */
		function deleteApply(id) {
			if (repeat_flag) return false;
			repeat_flag = true;

			layer.confirm('确定要删除续签申请吗?', function() {
				$.ajax({
					url: ns.url("shop/Shopreopen/deleteReopen"),
					data: {id: id},
					dataType: 'JSON',
					type: 'POST',
					success: function(res) {
						layer.msg(res.message);
						repeat_flag = false;

						if (res.code == 0) {
							table.reload();
						}
					}
				});
			}, function () {
				layer.close();
				repeat_flag = false;
			});
		}

	});

    //申请续签
    $(".reopen_apply").click(function () {
        location.href = ns.url("shop/cert/reopen");
    });
    //认证
    $(".shop_auth_apply").click(function () {
        location.href = ns.url("shop/cert/index");
    });
    //编辑续签
    $(".reopen_apply_detail").click(function () {
        location.href = ns.url("shop/cert/editreopeninfo");
    });

</script>
<script type="text/html" id="renewal_show">
	<table class="layui-table">
		<colgroup>
			<col width="30%">
			<col width="70%">
		</colgroup>
		<thead>
		<tr>
			<th>店铺名称</th>
			<th><?php echo htmlentities($apply_data['site_name']); ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>开店套餐</td>
			<td>{{d.shop_group_name}}</td>
		</tr>
		<tr>
			<td>续签时长</td>
			<td>{{d.apply_year}}年</td>
		</tr>
		<tr>
			<td>支付凭证</td>
			<td>
				{{#  if(d.paying_money_certificate){  }}
				<div class="ns-img-box">
					<img layer-src src={{ns.img(d.paying_money_certificate)}} alt="">
				</div>
				{{#  }  }}
			</td>
		</tr>
		<tr>
			<td>付款凭证说明</td>
			<td>
				<div style="word-break: break-all;">{{d.paying_money_certificate_explain}}</div>
			</td>
		</tr>
		</tbody>
	</table>
</script>

</body>

</html>