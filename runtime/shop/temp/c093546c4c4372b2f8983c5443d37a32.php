<?php /*a:9:{s:57:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/lists.html";i:1614516206;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;s:71:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_common_action.html";i:1616032162;s:70:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_adjust_price.html";i:1614516208;s:64:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_action.html";i:1614516206;s:72:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_address_update.html";i:1614516206;s:82:"/www/wwwroot/ls.chnssl.com/app/shop/view/storeorder/store_order_take_delivery.html";i:1614518768;s:73:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_delivery_action.html";i:1614516208;s:84:"/www/wwwroot/ls.chnssl.com/app/shop/view/localorder/local_order_delivery_action.html";i:1614516202;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/order_list.css"/>
<style>
	.ns-table-tab .layui-tab-content {padding-top: 0;}
    .layui-table-cell{text-align:center;}
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
			
				
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title"></h2>
        <form class="layui-colla-content layui-form layui-show" lay-filter="order_list">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">搜索方式：</label>
                    <div class="layui-input-inline">
                        <select name="order_label" >
                            <?php foreach($order_label_list as $k => $label_val): ?>
                            <option value="<?php echo htmlentities($k); ?>"><?php echo htmlentities($label_val); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="search" autocomplete="off" class="layui-input" />
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">下单时间：</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="start_time" placeholder="开始时间" id="start_time" readonly>
                        <i class="ns-calendar"></i>
                    </div>
                    <div class="layui-form-mid">-</div>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="end_time" placeholder="结束时间" id="end_time" readonly>
                        <i class="ns-calendar"></i>
                    </div>
                    <a class="layui-btn layui-btn-primary date-picker-btn" onclick="datePick(7, this);return false;">近7天</a>
                    <a class="layui-btn layui-btn-primary date-picker-btn" onclick="datePick(30, this);return false;">近30天</a>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">订单类型：</label>
                    <div class="layui-input-inline">
                        <select name="order_type" lay-filter="order_type">
                            <?php foreach($order_type_list as $order_type_k => $order_type_val): ?>
                            <option value="<?php echo htmlentities($order_type_val['type']); ?>"><?php echo htmlentities($order_type_val['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">订单状态：</label>
                    <div class="layui-input-inline">
                        <select name="order_status" lay-filter="order_status">
                            <option value="">全部</option>
                            <?php foreach($order_status_list as $k => $status_val): ?>
                            <option value="<?php echo htmlentities($k); ?>"><?php echo htmlentities($status_val); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">营销类型：</label>
                    <div class="layui-input-inline">
                        <select name="promotion_type" lay-filter="promotion_type">
                            <option value="">全部</option>
                            <?php foreach($promotion_type as $promotion_type_k => $promotion_type_val): ?>
                            <option value="<?php echo htmlentities($promotion_type_val['type']); ?>"><?php echo htmlentities($promotion_type_val['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">付款方式：</label>
                    <div class="layui-input-inline">
                        <select name="pay_type" >
                            <option value="">全部</option>
                            <?php foreach($pay_type_list as $pay_type_k => $pay_type_v): ?>
                            <option value="<?php echo htmlentities($pay_type_k); ?>"><?php echo htmlentities($pay_type_v); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">订单来源：</label>
                    <div class="layui-input-inline">
                        <select name="order_from">
                            <option value="">全部</option>
                            <?php foreach($order_from_list as $order_from_key => $order_from_v): ?>
                            <option value="<?php echo htmlentities($order_from_key); ?>"><?php echo htmlentities($order_from_v['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">结算状态：</label>
                    <div class="layui-input-inline">
                        <select name="settlement_state">
                            <option value="">全部</option>
                            <option value="1">已结算</option>
                            <option value="2">未结算</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ns-form-row">
                <button class="layui-btn ns-bg-color" lay-submit id="btn_search"lay-filter="btn_search">筛选</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <button class="layui-btn layui-btn-primary" lay-submit lay-filter="batch_export_order_goods" >导出订单商品</button>
                <button class="layui-btn layui-btn-primary" lay-submit lay-filter="batch_export_order" >导出订单</button>
                <a class="layui-btn layui-btn-primary" href="<?php echo addon_url('shop/order/export'); ?>" target="_blank">查看已生成报表</a>
            </div>
            <input type="hidden" name="status" />
            <input type="hidden" name="page" />
        </form>
    </div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="order_tab">
    <ul class="layui-tab-title">
        <li class="layui-this" lay-id="">全部订单</li>
    </ul>
    <div class="layui-tab-content">
        <div id="order_list"></div>
    </div>
</div>

<div id="order_page"></div>
<div id="order_operation"></div>

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


<script type="text/javascript">
var laytpl;
var form;
//渲染模板引擎
layui.use(['laytpl','form'], function(){
    laytpl = layui.laytpl;
    form = layui.form;
	form.render();
});
/**
 * 订单操作
 * @param fun
 * @param order_id
 */
function orderAction(fun, order_id){
    eval(fun+"("+order_id+")");
}

//打印发货单
function printDeliverOrder(order_id){

    var url = ns.url("shop/printer/batchprintorder",{order_id: order_id});

    var LODOP=getLodop();
    LODOP.PRINT_INIT("发货单打印");
    LODOP.ADD_PRINT_TBURL(5,10,"770","95%",url);
    LODOP.SET_PRINT_STYLEA(0,"HOrient",3);
    LODOP.SET_PRINT_STYLEA(0,"VOrient",3);
    LODOP.ADD_PRINT_TEXT(590,680,130,22,"页号：第#页/共&页");
    LODOP.SET_PRINT_STYLEA(0,"ItemType",2);
    LODOP.SET_PRINT_STYLEA(0,"Horient",1);
    LODOP.SET_PRINT_STYLEA(0,"Vorient",1);
    LODOP.SET_SHOW_MODE("MESSAGE_GETING_URL",""); //该语句隐藏进度条或修改提示信息

    LODOP.PREVIEW(); //预览
}

/**
 *订单备注
 **/
function orderRemark(order_id){
    $.ajax({
        type : "post",
        url : ns.url("shop/order/getOrderInfo"),
        async : true,
        data : {order_id : order_id},
        dataType: 'json',
        success : function(res) {
            if (res.code == 0) {
                layer.prompt({
                    formType: 2,
                    value: res.data.remark,
                    title: '卖家备注',
                    area: ['400px', '100px'], //自定义文本域宽高
                    yes: function(index, layero){
                        var value = layero.find(".layui-layer-input").val();
                        if(value.trim().length == 0){
                            layer.msg("请填写备注！");
                            return false;
                        }
                        $.ajax({
                            type: "post",
                            url: ns.url("shop/order/orderRemark"),
                            async: true,
                            dataType: 'json',
                            data: {order_id : order_id, remark : value},
                            success: function (res) {
                                layer.msg(res.message, {}, function () {
                                    if (res.code == 0) {
                                        layer.close(index);
                                        location.reload();
                                    }
                                });
                            }
                        })
                    }
                });
            } else {
                layer.msg(res.message);
            }
        }
    })
}

/**
 * 关闭订单
 * @param order_id
 */
function orderClose(order_id){
	layer.confirm('确定要关闭该订单吗?', function() {
		$.ajax({
			url: ns.url("shop/order/close"),
			data: {order_id : order_id},
			dataType: 'JSON',
			type: 'POST',
			success: function(res) {
				layer.msg(res.message);
				
				if (res.code == 0) {
					location.reload();
				}
			}
		});
	}, function () {
		layer.close();
	});
}

/**
 * 延长收货
 * @param order_id
 */
function extendTakeDelivery(order_id){
    layer.confirm('确定要延长该订单的收货时间吗?<br/><span style="color:red;size:12px;">提示:单次延长收货可以延迟三天的自动收货时间</span>', {title:'提示'},function() {
        $.ajax({
            url: ns.url("shop/order/extendtakedelivery"),
            data: {order_id : order_id},
            dataType: 'JSON',
            type: 'POST',
            success: function(res) {
                layer.msg(res.message);

                if (res.code == 0) {
                    location.reload();
                }
            }
        });
    }, function () {
        layer.close();
    });
}

/**
 * 线下支付
 * @param order_id
 */
function offlinepay(order_id) {

	$.ajax({
		url: ns.url("shop/order/offlinePay"),
		data: {order_id: order_id},
		dataType: 'JSON',
		type: 'POST',
		success: function (res) {
			layer.msg(res.message);

			if (res.code >= 0) {
				location.reload();
			}
		}
	});

}

</script>
<!-- 修改订单价格 -->
<!-- 调整价格模态 -->
<script type="text/html" id="adjust_price_html">
    <div style="padding:10px;">
        <div class="layui-form adjust-price-html" id='adjust_price'lay-filter="adjust_price">
            <div style="color: #666;">注意 : 只有订单未付款时才支持改价,改价后请联系买家刷新订单核实订单金额后再支付。</div>
            <table class="layui-table">
				<colgroup>
                    <col width="10%">
                    <col width="4%">
                    <col width="6%">
                    <col width="4%">
                    <col width="9%">
                    <col width="4%">
                    <col width="8%">
                    <col width="9%">
                    <col width="6%">
                    <col width="9%">
                    <col width="8%">
                    <col width="9%">
                    <col width="8%">
                    <col width="6%">
				</colgroup>
                <thead>
                <tr>
                    <th>商品信息</th>
                    <th>单价</th>
                    <th>数量</th>
                    <th>小计</th>
                    <th>商品总额</th>
                    <th>优惠</th>
                    <th>优惠券</th>
                    <th>平台优惠券</th>
                    <th>余额</th>
                    <th>发票费用</th>
                    <th>发票邮寄</th>
                    <th>调整金额</th>
                    <th>运费</th>
                    <th>总计</th>
                </tr>
                </thead>
                <tbody>
                    {{#  layui.each(d.order_goods, function(index, item){ }}
                        <tr data-order_money="{{ d.order_money }}"data-adjust_money="{{ d.adjust_money }}"data-delivery_money="{{ d.delivery_money }}"data-balance_money="{{ d.balance_money }}"data-promotion_money="{{ d.promotion_money }}" data-coupon_money="{{ d.coupon_money }}" data-goods_money="{{ d.goods_money }}"
                            data-adjust_money="{{ d.adjust_money }}"data-delivery_money="{{ d.delivery_money }}" data-invoice_rate="{{ d.invoice_rate }}"
                            data-invoice_delivery_money="{{ d.invoice_delivery_money }}"  data-platform_coupon_total_money="{{ d.platform_coupon_total_money }}" data-is_invoice="{{ d.is_invoice }}">
                            <td>{{ item.sku_name }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.num }}</td>
                            <td>{{ item.goods_money }}</td>
                            {{#  if(index == 0){ }}
                                <td rowspan="{{ d.order_goods.length }}">{{ d.goods_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}">{{ d.promotion_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}">{{ d.coupon_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}">{{ d.platform_coupon_total_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}">{{ d.balance_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}" class="adjust-invoice-money">{{ d.invoice_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}" class="adjust-invoice-delivery-money">{{ d.invoice_delivery_money }}</td>
                                <td rowspan="{{ d.order_goods.length }}"><input type="number" name="adjust_money"  class="layui-input ns-len-small adjust-money" onchange="adjustChange(this);" value="{{ d.adjust_money }}"/></td>
                                <td rowspan="{{ d.order_goods.length }}"><input type="number"  name="delivery_money"class="layui-input ns-len-small delivery-money" onchange="adjustChange(this);" value="{{ d.delivery_money }}"/></td>
                                <td rowspan="{{ d.order_goods.length }}" class="adjust-pay-money">{{ d.pay_money }}</td>
                            {{#  } }}
                        </tr>
                    {{#  }); }}
                </tbody>
            </table>
            <div style="color: #666;">
                <p><a class="ns-text-color">实际商品金额</a> = 商品总额 - 优惠金额 - 优惠券金额 - 平台优惠券金额 + 调价</p>
                <p><a class="ns-text-color">发票费用</a> = 实际商品金额 * 发票比率</p>
                <p>实付金额 = <a class="ns-text-color">实际商品金额</a> + <a class="ns-text-color">发票费用</a> + 运费 +  发票邮寄费用 - 余额</p>
            </div>
            <input type="hidden" name="order_id" value="{{ d.order_id }}"/>
            <button class="layui-btn"  lay-submit id="submit_price" lay-filter="submit_price" style="display:none;">保存</button>
        </div>
    </div>
</script>
<script>
    var form;
    /**
     * 订单调价
     */
    function orderAdjustMoney(order_id) {
        $.ajax({
            type: "post",
            url: ns.url("shop/order/getOrderDetail"),
            async: true,
            dataType: 'json',
            data: {
                "order_id": order_id
            },
            success: function (res) {
                if(res.code == 0){
                    //获取模板
                    var getTpl = $("#adjust_price_html").html();
                    var data = res.data;
                    //渲染模板
                    laytpl(getTpl).render(data, function(html) {
                        layer.open({
                            type: 1,
                            shadeClose: true,
                            shade: 0.3,
                            offset: 'auto',
                            scrollbar: true,
                            fixed: false,
                            title: "调整价格",
                            area: ['1300px', 'auto'],
                            btn: ['确定', '取消'],
                            yes: function(index, layero){
                                $("#submit_price").click();
                            },
                            btn2: function(index, layero){
                                layer.close(index);
                            },
                            content:  html,
                            cancel: function(){
                                //右上角关闭回调
                                //return false 开启该代码可禁止点击该按钮关闭
                            },
                            success: function(layero, index){
                                var repeat_flag = false;//防重复标识
                                form.render();

                                form.on('submit(submit_price)', function(data){
                                    if(repeat_flag)return;
                                    repeat_flag = true;

                                    $.ajax({
                                        url: ns.url("shop/order/adjustPrice"),
                                        type: "POST",
                                        dataType: "JSON",
                                        async: false,
                                        data: data.field,
                                        success: function (res) {
                                            layer.msg(res.message);
                                            if(res.code == 0){
                                                layer.closeAll();
                                                location.reload();
                                            }else{
                                                repeat_flag = false;
                                            }

                                        }
                                    });
                                    return false;
                                });
                            }
                        });
                        form.render();
                    });
                }
            }
        })

    }

    function adjustChange(obj){
        // var parent_obj = $(obj).parent().parent();
        // var o_order_money = parent_obj.attr("data-order_money");
        // var o_adjust_money = parent_obj.attr("data-adjust_money");
        // var o_delivery_money = parent_obj.attr("data-delivery_money");
        // var o_balance_money = parent_obj.attr("data-balance_money");
        // var adjust_money = $(obj).parent().parent().find(".adjust-money").val();
        // var delivery_money = $(obj).parent().parent().find(".delivery-money").val();
        // var total_money = parseFloat(o_order_money) - parseFloat(o_adjust_money) - parseFloat(o_delivery_money) + parseFloat(adjust_money) + parseFloat(delivery_money) - parseFloat(o_balance_money);
        // $(obj).parent().parent().find(".adjust-pay-money").text(total_money.toFixed(2))

        var parent_obj = $(obj).parent().parent();
        var o_order_money = parent_obj.attr("data-order_money");
        var o_adjust_money = parent_obj.attr("data-adjust_money");
        var o_delivery_money = parent_obj.attr("data-delivery_money");
        var o_balance_money = parent_obj.attr("data-balance_money");
        var invoice_delivery_money = parent_obj.attr("data-invoice_delivery_money");
        var promotion_money = parent_obj.attr("data-promotion_money");
        var platform_coupon_total_money = parent_obj.attr("data-platform_coupon_total_money");
        var coupon_money = parent_obj.attr("data-coupon_money");
        var goods_money = parent_obj.attr("data-goods_money");
        var is_invoice = parent_obj.attr("data-is_invoice");
        var adjust_money = $(obj).parent().parent().find(".adjust-money").val();
        var delivery_money = $(obj).parent().parent().find(".delivery-money").val();
        var real_goods_money = parseFloat(goods_money) - parseFloat(promotion_money) - parseFloat(coupon_money) + parseFloat(adjust_money) - parseFloat(platform_coupon_total_money);
        var invoice_rate = is_invoice == 1 ? parent_obj.attr("data-invoice_rate") : 0;
        var invoice_money = Math.round(parseFloat(real_goods_money) * parseFloat(invoice_rate)/100 * 100) / 100;

        var total_money = parseFloat(goods_money) - parseFloat(promotion_money) - parseFloat(coupon_money) - parseFloat(platform_coupon_total_money) + parseFloat(adjust_money) + parseFloat(invoice_delivery_money) + parseFloat(invoice_money) + parseFloat(delivery_money) - parseFloat(o_balance_money);
        var total_money = Math.round(total_money * 100) / 100;
        $(obj).parent().parent().find(".adjust-invoice-money").text(invoice_money);
        // $(obj).parent().parent().find(".adjust-invoice-delivery-money").text(total_money);
        // var total_money = parseFloat(o_order_money) - parseFloat(o_adjust_money) - parseFloat(o_delivery_money) + parseFloat(adjust_money) + parseFloat(delivery_money);
        $(obj).parent().parent().find(".adjust-pay-money").text(total_money)
    }
</script>
<!-- 修改订单收货地址 -->
<!-- 修改订单收货地址 -->
<script type="text/javascript" src="<?php echo get_http_type(); ?>://webapi.amap.com/maps?v=1.4.6&amp;key=2df5711d4e2fd9ecd1622b5a53fc6b1d"></script>
<script type="text/javascript" src="https://ls.chnssl.com/app/shop/view/public/js/address.js"></script>
<script type="text/javascript" src="https://ls.chnssl.com/public/static/js/map_address.js"></script>
<style>
    .update-address-html .order-map{width:876px;height:380px}
</style>

<!-- 修改收货地址模态 -->
<div id="update_address_box" class="update-address-box"></div>
<script type="text/html" id="update_address_html">

    <div class="layui-form update-address-html" id='update_address'lay-filter="update_address">
        <input type="hidden" name="order_id" value="{{ d.order_id }}"/>
        <!--自提点地址-->
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="required">* </span>收货地址</label>
            <div class="layui-input-inline area-select">
                <select name="province_id" lay-filter="province_id" lay-verify="province_id">
                    <option value="">请选择省份</option>
                </select>
            </div>
            <div class="layui-input-inline area-select">
                <select name="city_id"  lay-filter="city_id" lay-verify="city_id">
                    <option value="">请选择城市</option>
                </select>
            </div>
            <div class="layui-input-inline area-select">
                <select name="district_id"  lay-filter="district_id" lay-verify="district_id">
                    <option value="">请选择区/县</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-inline" >
                <input type="text" name="address"  placeholder="请填写具体地址" lay-verify="address" autocomplete="off" class="layui-input address-content ns-len-long" value="{{# if(d.address != undefined){}}{{ d.address}}{{#  } }}">
            </div>

            {{# if(d.order_type == 3){ }}
            <input type = "hidden" name="longitude" lay-verify="required" class="layui-input" value="{{# if(d.longitude != undefined){}}{{ d.longitude}}{{#  } }}"/>
            <input type = "hidden" name="latitude" lay-verify="required" class="layui-input"value="{{# if(d.latitude != undefined){}}{{ d.latitude}}{{#  } }}"/>
            <button class='layui-btn-primary layui-btn' onclick="refreshFrom();">查找地址</button>
            {{# } }}
        </div>
        {{# if(d.order_type == 3){ }}
        <!--地图定位-->
        <div class="layui-form-item">
            <label class="layui-form-label">地图定位</label>
            <div class="layui-input-block ns-special-length">
                <div id="container" class="order-map"></div>
            </div>
        </div>
        {{# } }}
        <!--联系人方式-->
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">收货人</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" placeholder="请填写收货联系人" autocomplete="off" class="layui-input selffetch-input ns-len-mid" value="{{# if(d.name != undefined){}}{{ d.name}}{{#  } }}">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">手机号码</label>
                <div class="layui-input-block">
                    <input type="text" name="mobile" lay-verify="phone" placeholder="请填写手机号码" autocomplete="off" class="layui-input selffetch-input ns-len-mid" value="{{# if(d.mobile != undefined){}}{{d.mobile }}{{#  } }}">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">固定号码</label>
                <div class="layui-input-block">
                    <input type="text" name="telephone" placeholder="请填写固定号码" autocomplete="off" class="layui-input selffetch-input ns-len-mid" value="{{# if(d.telephone != undefined){}}{{d.telephone }}{{#  } }}">
                </div>
            </div>
        </div>
        <button class="layui-btn"  lay-submit id="submit_address" lay-filter="submit_address" style="display:none;">保存</button>
    </div>
</script>
<!-- 地址编辑 -->
<script>
    var map_class, form,latlng;
    /**
     * 订单地址修改
     */
    function orderAddressUpdate(order_id) {
        $.ajax({
            type: "post",
            url: ns.url("shop/order/getOrderInfo"),
            async: true,
            dataType: 'json',
            data: {
                "order_id": order_id
            },
            success: function (res) {
                if(res.code == 0){
                    //获取模板
                    var getTpl = $("#update_address_html").html();
                    //渲染模板
                    var order_data = res.data;
                    laytpl(getTpl).render(order_data, function(html) {
                        layer.open({
                            type: 1,
                            shadeClose: true,
                            shade: 0.3,
                            offset: 'auto',
                            scrollbar: true,
                            fixed: false,
                            title: "编辑收货地址",
                            area: ['1200px'],
                            btn: ['确定', '取消'],
                            yes: function(index, layero){
                                $("#submit_address").click();
                            },
                            btn2: function(index, layero){
                                layer.close(index);
                            },
                            content:  html,
                            cancel: function(){
                                //右上角关闭回调
                                //return false 开启该代码可禁止点击该按钮关闭
                            },
                            success: function(layero, index){


                                form.render();
                                //初始化省级地址
                                getAreaList(0, 1);
                                var repeat_flag = false;//防重复标识
                                form.render();
                                var initdata = {province_id : order_data.province_id, city_id : order_data.city_id, district_id : order_data.district_id};
                                initAddress(initdata, "update_address");

                                if(order_data.order_type == 3) {
                                    if ($.isEmptyObject(order_data) == true) {
                                        latlng = {lat: '', lng: ''};
                                    } else {
                                        latlng = {lat: order_data.latitude, lng: order_data.longitude};
                                    }

                                    map_class = new mapClass("container", latlng);
                                }
                                form.render();

                                form.on('submit(submit_address)', function(data){
                                    if(data.field.province_id == ''){
                                        layer.msg('请选择省份', {icon: 5, anim: 6});
                                        return;
                                    }
                                    if(data.field.city_id == ''){
                                        layer.msg('请选择城市', {icon: 5, anim: 6});
                                        return;
                                    }
                                    if(data.field.district_id == ''){
                                        layer.msg('请选择区/县', {icon: 5, anim: 6});
                                        return;
                                    }
                                    if(data.field.address == ''){
                                        layer.msg('请输入详细地址', {icon: 5, anim: 6});
                                        return;
                                    }
                                    //外卖订单修改地址必须选坐标
                                    if(order_data.order_type == 3){
                                        if(data.field.latitude == '' || data.field.longitude == ''  ){
                                            layer.msg('外卖订单必须选择地图坐标', {icon: 5, anim: 6});
                                            return;
                                        }
                                    }
                                    var province_name = $("option[value='" + data.field.province_id + "']").text();
                                    var city_name = $("option[value='" + data.field.city_id + "']").text();
                                    var district_name = $("option[value='" + data.field.district_id + "']").text();
                                    // var community_name = $("option[value='" + data.field.community_id + "']").text();
                                    data.field.province_name = province_name;
                                    data.field.city_name = city_name;
                                    data.field.district_name = district_name;
                                    // data.field.community_name = community_name;
                                    data.field.full_address = province_name +'-'+ city_name +'-'+ district_name;

                                    if(repeat_flag)return;
                                    repeat_flag = true;
                                    $.ajax({
                                        url: ns.url("shop/order/editaddress"),
                                        type: "POST",
                                        dataType: "JSON",
                                        async: false,
                                        data: data.field,
                                        success: function (res) {
                                            layer.msg(res.message);
                                            if(res.code == 0){
                                                layer.closeAll();
                                                location.reload();
                                            }else{
                                                repeat_flag = false;
                                            }
                                        }
                                    });
                                    return false;
                                });
                            }
                        });
                        form.render();
                    });
                }
            }
        })

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
        // map_class.address.township = $("select[name=community_id]").val();
        // map_class.address.township_name = $("select[name=community_id] option:selected").text();
        map_class.address.address = $("input[name=address]").val()
    }

    /**
     * 地址下拉框（主要用于坐标记录）
     */
    function selectCallBack(){
        $("input[name=longitude]").val(map_class.address.longitude);//坐标
        $("input[name=latitude]").val(map_class.address.latitude);//坐标
        $("input[name=address]").val(map_class.address.address);//详细地址
        // console.log(map_class.address);
    }
    //地图点击回调时间
    function mapChangeCallBack(){

        $("input[name=address]").val(map_class.address.address);//详细地址
        $("input[name=longitude]").val(map_class.address.longitude);//坐标
        $("input[name=latitude]").val(map_class.address.latitude);//坐标
        $.ajax({
            type : "post",
            url : ns.url("shop/address/getGeographicId"),
            dataType: 'json',
            async : true,
            data : {
                "address" : map_class.address.area
            },
            success : function(data) {
                map_class.address.province = data.province_id;
                map_class.address.city = data.city_id;
                map_class.address.district = data.district_id;
                // map_class.address.township = data.community_id;
                map_class.map_change = false;
                form.val("update_address", {
                    "province_id": data.province_id // "name": "value"
                });
                $("select[name=province_id]").change();
                form.val("update_address", {
                    "city_id": data.city_id // "name": "value"
                });
                $("select[name=city_id]").change();
                form.val("update_address", {
                    "district_id": data.district_id // "name": "value"
                });
                $("select[name=district_id]").change();
                // form.val("update_address", {
                //     "community_id": data.community_id // "name": "value"
                // });
                refreshFrom();//重新渲染form
                map_class.map_change = true;
            }
        })
    }
</script>

<!-- 门店自提  提货 -->
<script>
	/**
	 * 直接提货
	 * @param order_id
	 */
	function storeOrderTakedelivery(order_id) {
		layer.confirm('确定要直接提货吗?', {title: '提示'}, function () {
			$.ajax({
				url: ns.url("shop/storeorder/storeOrderTakedelivery"),
				data: {order_id: order_id},
				dataType: 'JSON',
				type: 'POST',
				success: function (res) {
					layer.msg(res.message);

					if (res.code == 0) {
						location.reload();
					}
				}
			});
		}, function () {
			layer.close();
		});
	}
</script>
<!-- 发货 -->
<!-- 订单物流发货 -->
<style>
	.delivery-box{padding:20px;/*border-bottom:1px solid #e6e6e6;*/}
	.layui-table-body{overflow:unset;}
	.delivery-content{padding: 7px 0!important;}
	.layui-table-view{border-top:1px solid #eee;border-bottom:1px solid #eee;}
	.order-delivery .layui-table
	.layui-form #order_goods_list thead th, .layui-form #order_goods_list tbody tr{border-bottom: 1px solid #E6E6E6;}
	.layui-form #order_goods_list thead th{background-color: #F5F5F5;line-height: 30px;}
</style>
<!--发送订单弹出框-->
<script type="text/html" id="order_delivery_html">
<div class="order-delivery">
    <div class="layui-form">
		<div class="layui-form-item" style="display:none;">
			<div class="layui-form-mid layui-word-aux delivery-content">
				待发货<span class="delivery-count">0</span>，已选<span class="deliveryed_count">0</span>
			</div>
		</div>
		
		<input type="hidden" value="{{ d.order_id }}" name="order_id"/>
		<div class="layui-form-item">
			<label class="layui-form-label">收货地址：</label>
			<div class="layui-input-block">
				<p class="ns-input-text ns-len-mid">{{ d.order_info.full_address }} {{ d.order_info.address }}</p>
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">发货方式：</label>
			<div class="layui-input-block">
				<input type="radio" lay-filter="delivery_type" name="delivery_type" value="1" title="物流发货" checked>
				<input type="radio" lay-filter="delivery_type" name="delivery_type" value="0" title=无需物流 >
			</div>
		</div>
		
		<div class="express-type">
		    <div class="layui-form-item">
		        <div class="layui-block">
		            <label class="layui-form-label"><span class="required">*</span>物流公司：</label>
		            <div class="layui-input-block ns-len-mid">
		                <select name="express_company_id" lay-search lay-filter="express_company">
							<option value="">请选择物流公司</option>
		                    {{#  layui.each(d.express_company, function(index, item){ }}
		                        <option value="{{ item.company_id }}">{{ item.company_name }}</option>
		                    {{#  }); }}
		                </select>
		            </div>
		        </div>
			</div>
				
			<div class="layui-form-item">
		        <div class="layui-block">
		            <label class="layui-form-label"><span class="required">*</span>快递单号：</label>
		            <div class="layui-input-block">
		                <input type="text" name="delivery_no" placeholder="" autocomplete="off" class="layui-input ns-len-mid">
		            </div>
		        </div>
		    </div>
		</div>
		
		<div class="ns-form-row">
			<button type="button" class="layui-btn" lay-submit id="button_delivery_order" lay-filter="button_delivery_order" style="display:none;">保存</button>
		</div>

		<table id="order_goods_list" class="layui-table" lay-filter="order_goods" lay-skin="line">
			<colgroup>
				<col width="5%">
				<col width="38%">
				<col width="15%">
				<col width="20%">
				<col width="22%">
			</colgroup>
			<thead>
				<tr>
					<th><input type="checkbox" lay-skin="primary" lay-filter="selectAllTop" /></th>
					<th>商品名称</th>
					<th>数量</th>
					<th>物流单号</th>
					<th>状态</th>
				</tr>
			</thead>
			<tbody>
				{{#  layui.each(d.order_goods_list, function(index, item){ }}
					<tr>
						<td><input type="checkbox" lay-skin="primary" class="order_goods_id" lay-filter="select{{ item.order_goods_id }}" value="{{ item.order_goods_id }}" {{#  if(item.delivery_status != 0 || d.order_info.is_lock == 1){ }} disabled {{#  } }} /></td>
						<td>{{ item.sku_name }}</td>
						<td>{{ item.num }}</td>
						<td>{{ item.delivery_no }}</td>
						<td>
							{{ item.delivery_status_name }}
							{{# if(item.refund_status != 0){ }}
								<br/>{{ item.refund_status_name }}<a href="{{ns.url('shop/orderrefund/detail?order_goods_id='+item.order_goods_id) }}"  target="_blank" class="ns-text-color">(处理维权)</a>
							{{# } }}
						</td>
					</tr>
				{{#  }); }}
				{{#  if(d.order_goods_list.length === 0){ }}
					<tr>
						<td colspan="5">无数据</td>
					</tr>
				{{#  } }}
			</tbody>
		</table>
    </div>
</div>
</script>

<!-- 批量订单发货 -->
<script type="text/html" id="order_batch_delivery_html">
	<div class="order-delivery">
		<div class="layui-form">

			<input type="hidden" name="type" value="manual">
			<?php if(addon_is_exit('electronicsheet',$user_info['site_id']) == 1): ?>
			<div class="layui-form-item">
				<label class="layui-form-label">发货类型：</label>
				<div class="layui-input-block">
					<input type="radio" lay-filter="delivery_mode" name="type" value="electronicsheet" title="电子面单" checked>
					<input type="radio" lay-filter="delivery_mode" name="type" value="manual" title="手动发货" >
				</div>
			</div>
			<input type="hidden" name="sheet_exists" value="1">
			<?php else: ?>
			<input type="hidden" name="sheet_exists" value="2">
			<?php endif; ?>

			<div class="layui-form-item <?php if(addon_is_exit('electronicsheet',$user_info['site_id']) == 1): ?> layui-hide <?php endif; ?> delivery-type">
				<label class="layui-form-label">发货方式：</label>
				<div class="layui-input-block">
					<input type="radio" lay-filter="delivery_type" name="delivery_type" value="1" title="物流发货" checked>
					<input type="radio" lay-filter="delivery_type" name="delivery_type" value="0" title=无需物流 >
				</div>
			</div>

			<?php if(addon_is_exit('electronicsheet',$user_info['site_id']) == 1): ?>
			<div class="layui-form-item express-mode">
				<label class="layui-form-label">面单模版：</label>
				<div class="layui-input-block ns-len-mid">
					<select name="template_id" lay-search lay-filter="express_company">
						<option value="">请选择面单模版</option>
					</select>
				</div>
			</div>
			<?php endif; ?>

			<div class="express-type">
				<div class="layui-form-item logistics-company <?php if(addon_is_exit('electronicsheet',$user_info['site_id']) == 1): ?>layui-hide<?php endif; ?>">
					<label class="layui-form-label">物流公司：</label>
					<div class="layui-input-block ns-len-mid">
						<select name="express_company_id" lay-search lay-filter="express_company">
							<option value="">请选择物流公司</option>
							{{#  layui.each(d.express_company, function(index, item){ }}
							<option value="{{ item.company_id }}">{{ item.company_name }}</option>
							{{#  }); }}
						</select>
					</div>
				</div>
			</div>

			<div class="ns-form-row">
				<button type="button" class="layui-btn" lay-submit id="button_delivery_order" lay-filter="button_delivery_order" style="display:none;">保存</button>
			</div>

			<div id="order_goods_list_box">
				<table class="layui-table order_goods_list" lay-filter="order_goods" lay-skin="line">
					<colgroup>
						<col>
						<col width="30%">
						<col width="50%">
						<col width="20%">
					</colgroup>
					<thead>
					<tr>
						<th></th>
						<th>订单号</th>
						<th>收货地址</th>
						<th>操作</th>
					</tr>
					</thead>
				</table>

				<table class="layui-table order_goods_list" lay-filter="order_goods" lay-skin="line">
					<colgroup>
						<col width="">
						<col width="30%">
						<col width="50%">
						<col width="20%">
					</colgroup>
					<tbody>
					{{#  layui.each(d.order_goods_list, function(order_goods_key, order_goods_item){ }}
					<tr>
						<td>{{ order_goods_item.order_no }}</td>
						<td>{{ order_goods_item.full_address }}</td>
						<td><a href="javascript:;" class="ns-text-color goods-item-remove" data-order-id="{{order_goods_item.order_id}}">删除</a></td>
					</tr>
					{{#  }); }}
					{{#  if(d.order_goods_list.length === 0){ }}
					<tr>
						<td colspan="3" align="center">无数据</td>
					</tr>
					{{#  } }}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</script>

<script>
    /**
     * 订单发货
     */
	var submitting = false;
    function orderDelivery(order_id) {
		$.ajax({
			type: "post",
			url: ns.url("shop/order/getOrderInfo"),
			async: true,
			dataType: 'json',
			data: {
				"order_id": order_id
			},
			success: function (res) {
				if (res.code == 0) {
					var product_arr = [];
					layui.use(['table', 'form', 'laytpl'], function () {
						var laytpl = layui.laytpl, table = layui.table, form = layui.form;
						form.render();
						//获取模板
						var getTpl = $("#order_delivery_html").html();
						//渲染模板
						var data = {order_info: res.data};
						//查询订单信息
						$.ajax({
							type: "post",
							url: ns.url("shop/express/getShopExpressCompanyList"),
							dataType: 'json',
							async: false,
							success: function (res) {
								if (res.code == 0) {
									data.express_company = res.data;
								}
							}
						});
						//订单项
						$.ajax({
							type: "post",
							url: ns.url("shop/order/getOrderGoodsList"),
							dataType: 'json',
							async: false,
							data: {
								"order_id": order_id
							},
							success: function (res) {
								if (res.code == 0) {
									data.order_goods_list = res.data;
								}
							}
						});
						laytpl(getTpl).render(data, function (html) {
							layer.open({
								type: 1,
								shadeClose: true,
								shade: 0.3,
								fixed: false,
								scrollbar: false,
								title: "订单发货",
								area: '800px',
								btn: ['提交'],
								yes: function (index, layero) {
									$("#button_delivery_order").click();
								},
								content: html,
								cancel: function (index, layero) {
									//右上角关闭回调
									layer.close(index);
									//return false 开启该代码可禁止点击该按钮关闭
								},
								success: function (layero, index) {
									form.render();
									form.on('radio(delivery_type)', function (data) {
										if (data.value == 1) {
											$(".express-type").show();
										} else {
											$(".express-type").hide();
										}

									});

									form.on('submit(button_delivery_order)', function (data) {
										var express_company_id = data.field.express_company_id;
										if (data.field.delivery_type == 1 && express_company_id <= 0) {
											layer.msg('请选择物流公司', {time: 2000, icon: 5});
											return;
										}
										var order_goods_id_array = [];
										$(".order_goods_id").each(function (i) {
											var checked = $(this).prop("checked");
											if (checked) {
												order_goods_id_array.push($(this).val());
											}
										});
										if (order_goods_id_array == "") {
											layer.msg('请选择发货商品', {time: 2000, icon: 5});
											return;
										}
										var order_goods_ids = order_goods_id_array.toString();
										if (data.field.delivery_no == "" && data.field.delivery_type == 1) {
											layer.msg('物流单号不能为空', {time: 2000, icon: 5});
											return;
										}
										data.field.order_goods_ids = order_goods_ids;
										if (submitting) {
											return false;
										}
										submitting = true;
										$.ajax({
											type: "post",
											url: '<?php echo addon_url("shop/order/delivery"); ?>',
											async: true,
											dataType: 'json',
											data: data.field,
											success: function (res) {
												if (res.code == 0) {
													layer.msg("发货成功");
													location.reload();
												} else {
													layer.msg(res.message);
													submitting = false;
												}
											}
										})
									});

									/**
									 * 监听全选
									 */
									form.on('checkbox(selectAllTop)', function (data) {
										if (data.elem.checked) {
											$("tr .order_goods_id:checkbox").each(function () {
												if ($(this).attr("disabled") == undefined) {
													$(this).prop("checked", true);
												}
											});
										} else {
											$("tr .order_goods_id:checkbox").each(function () {
												$(this).prop("checked", false);
											});
										}
										form.render();
									});

									/**
									 * 监听每一行的复选框
									 */
									var len = $("tbody .order_goods_id").length;

									for (var i = 0; i < len; i++) {
										var num = $(".order_goods_id").eq(i).val();

										form.on('checkbox(select' + num + ')', function (data) {
											if ($("tbody .order_goods_id:checked").length == len) {
												$("input[lay-filter='selectAllTop']").prop("checked", true);
											} else {
												$("input[lay-filter='selectAllTop']").prop("checked", false);
											}

											form.render();
										});
									}

									//复选框选中
									table.on('checkbox(order_goods)', function (obj) {
										if (obj.type == "all") {
											var data = table.checkStatus('product_table');
											var checkbox_data = data.data;
											product_arr = [];
											if (obj.checked) {
												$.each(checkbox_data, function (index, itemobj) {
													product_arr.push(itemobj.order_goods_id);
												})

											}
										} else {
											if (obj.checked) {
												// if(index != -1){
												product_arr.push(obj.data.order_goods_id);
												// }
											} else {
												var index = $.inArray(obj.data.order_goods_id, product_arr);
												product_arr.splice(index, 1);
											}
										}

										$(".deliveryed_count").text(product_arr.length);
									});

								}

							});
						})

					})
				}
			}
		})

	}

	/**
	 * 批量发货
	 */
	var batchSubmitting = false;
	function orderBatchDelivery(order_data) {
		layui.use(['table', 'form', 'laytpl'], function () {
			var laytpl = layui.laytpl, table = layui.table, form = layui.form;
			form.render();
			//获取模板
			var getTpl = $("#order_batch_delivery_html").html();
			//渲染模板
			var data = {order_goods_list: order_data};
			//查询订单信息
			$.ajax({
				type: "post",
				url: ns.url("shop/express/getShopExpressCompanyList"),
				dataType: 'json',
				async: false,
				success: function (res) {
					if (res.code == 0) {
						data.express_company = res.data;
					}
				}
			});

			laytpl(getTpl).render(data, function (html) {
				layer.open({
					type: 1,
					shadeClose: true,
					shade: 0.3,
					fixed: false,
					scrollbar: false,
					title: "订单发货",
					area: '800px',
					btn: ['保存'],
					yes: function (index, layero) {
						$("#button_delivery_order").click();
					},
					content: html,
					cancel: function (index, layero) {
						//右上角关闭回调
						layer.close(index);
						//return false 开启该代码可禁止点击该按钮关闭
					},
					success: function (layero, index) {

						var sheetExists = $("input[name='sheet_exists']").val();


						var deliveryModeIdent = "";
						if (sheetExists == 1){
							expressTemplate();
							deliveryModeIdent = "electronicsheet";
						}else if(sheetExists == 2){
							deliveryModeIdent = "manual";
						}

						$("#order_goods_list_box").html(tableContentChange(sheetExists));

						form.render();
						form.on('radio(delivery_type)', function (data) {
							if (data.value == 1) {
								$("#order_goods_list_box").html(tableContentChange(2));
								$(".express-type").show();
							} else {
								$("#order_goods_list_box").html(tableContentChange(1));
								$(".express-type").hide();
							}

						});

						form.on('radio(delivery_mode)', function(data){
							deliveryModeIdent = data.value;
							if(data.value == "electronicsheet"){
								$(".express-mode").removeClass("layui-hide");
								$(".express-number").addClass("layui-hide");
								$(".delivery-type").addClass("layui-hide");
								$(".logistics-company").addClass("layui-hide");
								$("#order_goods_list_box").html(tableContentChange(1))
							}else if(data.value == "manual"){
								$(".express-mode").addClass("layui-hide");
								$(".express-number").removeClass("layui-hide");
								$(".logistics-company").removeClass("layui-hide");
								$(".delivery-type").removeClass("layui-hide");
								$("#order_goods_list_box").html(tableContentChange(2))
							}
						});

						$("body").on("click",".order_goods_list:eq(1) .goods-item-remove",function () {

							$(this).parents("tr").remove();
							var orderId = $(this).attr("data-order-id");
							//数组的删除
							Array.prototype.remove = function(val) {
								var index = this.indexOf(val);
								if (index > -1) {
									this.splice(index, 1);
								}
							};

							Array.prototype.indexOf = function(val) {
								for (var i = 0; i < this.length; i++) {
									if (this[i].order_id == val) return i;
								}
								return -1;
							};

							data.order_goods_list.remove(orderId);

							var html = '<tr>';
							html += '<td colspan="5" align="center">无数据</td>';
							html += '</tr>';

							if (!$(".order_goods_list:eq(1) tbody").text().trim()){
								$(".order_goods_list:eq(1) tbody").html(html)
							}
						});

						form.on('submit(button_delivery_order)', function (data) {
							var express_company_id = data.field.express_company_id;
							var template_id = data.field.template_id;
							if (template_id <= 0 && deliveryModeIdent == "electronicsheet") {
								layer.msg('请选择面单模版', {time: 2000, icon: 5});
								return;
							}

							if (data.field.delivery_type == 1 && express_company_id <= 0 && deliveryModeIdent == "manual") {
								layer.msg('请选择物流公司', {time: 2000, icon: 5});
								return;
							}

							var order_list = [];
							for (var orderItem = 0; orderItem < $(".order_goods_list:eq(1) tbody tr").length; orderItem++){
								var json = {order_id: '',delivery_no: ''};
								json.order_id = $(".order_goods_list:eq(1) tbody tr").eq(orderItem).find(".goods-item-remove").attr("data-order-id");
								if($(".order_goods_list:eq(1) tbody tr").eq(orderItem).find("input").length){
									json.delivery_no = $(".order_goods_list:eq(1) tbody tr").eq(orderItem).find("input").val();
								}
								order_list.push(json);
							}

							data.field.order_list = order_list;

							if (batchSubmitting) {
								return false;
							}

							batchSubmitting = true;
							$.ajax({
								type: "post",
								url: '<?php echo addon_url("shop/delivery/batchdelivery"); ?>',
								async: true,
								dataType: 'json',
								data: data.field,
								success: function (res) {
									layer.msg(res.message, {}, function () {
										if (res.code == 0) {
											location.reload();
										} else {
											batchSubmitting = false;
										}
									});

								}
							})
						});

						form.verify({
							required: function(value, item){ //value：表单的值、item：表单的DOM对象
								if(!value){
									return '物流单号为空';
								}
							}
						});

						function tableContentChange(type){
							var html = '<table class="layui-table order_goods_list" lay-filter="order_goods" lay-skin="line">';
							html += '<colgroup>';
							if (type == 2){
								html += '<col width="20%">';
								html += '<col width="40%">';
								html += '<col width="20%">';
								html += '<col width="20%">';
							}else if(type == 1){
								html += '<col>';
								html += '<col width="30%">';
								html += '<col width="50%">';
								html += '<col width="20%">';
							}
							html += '</colgroup>';

							html += '<thead>';
							if (type == 2) {
								html += '<tr>';
								html += '<th>订单号</th>';
								html += '<th>收货地址</th>';
								html += '<th>物流单号</th>';
								html += '<th>操作</th>';
								html += '</tr>';
							}else if(type == 1){
								html += '<tr>';
								html += '<th></th>';
								html += '<th>订单号</th>';
								html += '<th>收货地址</th>';
								html += '<th>操作</th>';
								html += '</tr>';
							}
							html += '</thead>';
							html += '</table>';

							html += '<table class="layui-table order_goods_list" lay-filter="order_goods" lay-skin="line">';
							html += '<colgroup>';
							if (type == 2){
								html += '<col width="20%">';
								html += '<col width="40%">';
								html += '<col width="20%">';
								html += '<col width="20%">';
							}else if(type == 1){
								html += '<col>';
								html += '<col width="30%">';
								html += '<col width="50%">';
								html += '<col width="20%">';
							}
							html += '</colgroup>';
							html += '<tbody>';
							if (data.order_goods_list.length > 0){
								for (var i = 0; i < data.order_goods_list.length; i++){
									if (type == 2) {
										html += '<tr>';
										html += `<td>${data.order_goods_list[i].order_no}</td>`;
										html += `<td>${data.order_goods_list[i].full_address}</td>`;
										html += `<td><input lay-verify="required" class="layui-input" type="number"></td>`;
										html += `<td><a href="javascript:;" class="ns-text-color goods-item-remove" data-order-id="${data.order_goods_list[i].order_id}">删除</a></td>`;
										html += '</tr>';
									}else if(type == 1){
										html += '<tr>';
										html += `<td></td>`;
										html += `<td>${data.order_goods_list[i].order_no}</td>`;
										html += `<td>${data.order_goods_list[i].full_address}</td>`;
										html += `<td><a href="javascript:;" class="ns-text-color goods-item-remove" data-order-id="${data.order_goods_list[i].order_id}">删除</a></td>`;
										html += '</tr>';
									}
								}
							}else{
								html += '<tr>';
								html += '<td colspan="4" align="center">无数据</td>';
								html += '</tr>';
							}
							html += '</tbody>';

							html += '</table>';

							return html
						}
					}

				});
			})
		})
	}

	/**
	 * 电子面单模版
	 */
	function expressTemplate(){
		$.ajax({
			type: "post",
			url: ns.url("shop/delivery/getexpresselectronicsheetlist"),
			dataType: 'json',
			success: function(res){
				if (res.code >= 0){
					var templateList = res.data;
					var html = '';
					html += '<select name="template_id" lay-search lay-filter="express_company">';
					html += '<option value="">请选择面单模版</option>';
					for (var i = 0; i < templateList.length; i++){
						html += '<option value='+ templateList[i].id +'>'+ templateList[i].template_name+'</option>';
					}
					html += '</select>';
					$(".express-mode div").html(html);
					form.render();
				}
			}
		})
	}
</script>

<!-- 外卖发货 -->
<!-- 订单物流发货 -->
<style>
    .delivery-box{padding:20px}
    .layui-table-body{overflow:unset}
    .delivery-content{padding:7px 0!important}
    .layui-table-view{border-top:1px solid #eee;border-bottom:1px solid #eee}
    .layui-form #order_goods_list tbody tr,.layui-form #order_goods_list thead th{border-bottom:1px solid #e6e6e6}
    .layui-form #order_goods_list thead th{background-color:#f5f5f5;line-height:30px}
    .order-delivery .ns-input-text{height:auto;min-height:34px}
</style>
<!--发送订单弹出框-->
<script type="text/html" id="local_order_delivery_html">
    <div class="order-delivery">
        <div class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">收货地址：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text ns-len-long">{{ d.order_info.full_address }} {{ d.order_info.address }}</p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">发货方式：</label>
                <div class="layui-input-block">
                    <input type="radio" lay-filter="delivery_type" name="delivery_type" value="default" title="商家自配送" checked>
                    <input type="radio" lay-filter="delivery_type" name="delivery_type" value="default" title="第三方配送" disabled>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">配送员：</label>
                <div class="layui-input-block">
                    <input type="text" name="deliverer" lay-verify="required" placeholder="" autocomplete="off" class="layui-input ns-len-mid">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">配送员手机号：</label>
                <div class="layui-input-block">
                    <input type="text" name="deliverer_mobile" lay-verify="required|phone" placeholder="" autocomplete="off" class="layui-input ns-len-mid">
                </div>
            </div>

            <input type="hidden" name="order_id" value="{{ d.order_info.order_id }}" class="layui-input" />
            <div class="ns-form-row">
                <button type="button" class="layui-btn" lay-submit id="button_local_delivery_order" lay-filter="button_local_delivery_order" style="display:none;">保存</button>
            </div>
        </div>
    </div>
</script>

<script>
/**
 * 同城配送订单发货
 */
var submitting = false;

function orderLocalDelivery(order_id) {
    var product_arr = [];
    layui.use(['table', 'form', 'laytpl'], function () {
        var laytpl = layui.laytpl, table = layui.table, form = layui.form;
        form.render();
        //获取模板
        var getTpl = $("#local_order_delivery_html").html();
        //渲染模板
        var data = {};
        //查询订单信息
        $.ajax({
            type: "post",
            url: ns.url("shop/order/getorderinfo"),
            dataType: 'json',
            async: false,
            data: {
                "order_id": order_id
            },
            success: function (res) {
                if (res.code == 0) {
                    data.order_info = res.data;
                }
            }
        });

        laytpl(getTpl).render(data, function (html) {
            layer.open({
                type: 1,
                shadeClose: true,
                shade: 0.3,
                fixed: false,
                scrollbar: false,
                title: "订单发货",
                area: '800px',
                btn: ['保存'],
                yes: function (index, layero) {
                    $("#button_local_delivery_order").click();
                },
                content: html,
                cancel: function (index, layero) {
                    //右上角关闭回调
                    layer.close(index);
                    //return false 开启该代码可禁止点击该按钮关闭
                },
                success: function (layero, index) {
                    form.render();

                    form.on('submit(button_local_delivery_order)', function (data) {
                        if (submitting) {
                            return false;
                        }
                        submitting = true;

                        $.ajax({
                            type: "post",
                            url: ns.url("shop/localorder/delivery"),
                            async: true,
                            dataType: 'json',
                            data: data.field,
                            success: function (res) {
                                layer.msg(res.message, {}, function () {
                                    if (res.code == 0) {
                                        layer.close(index);
                                        location.reload();
                                    } else {
                                        submitting = false;
                                    }
                                });
                            }
                        })
                    });

                }

            });
        })
    })

}
</script>
<script src="https://ls.chnssl.com/app/shop/view/public/js/order_list.js"></script>
<script src="https://ls.chnssl.com/app/shop/view/public/js/lodop_funcs.js"></script>
<script>
    var laypage,element, form, hash_url;
    var is_refresh = false;
    var order_type_status_json = <?php echo json_encode($order_type_list); ?>;
    /**
     *通过hash获取页数
     */
    function getHashPage(){
        var page = 1;
        var hash = location.hash;

        var hash_arr = hash.split("&");
        $.each(hash_arr,function(index, itemobj){
            var item_arr = itemobj.split("=");
            if(item_arr.length == 2){
                if(item_arr[0].indexOf("page") != "-1"){
                    page = item_arr[1];
                }
            }
        });
        return page;
    }

    //从hash中获取数据
    function getHashData(){
        var hash = ns.urlReplace(location.hash);

        var hash_arr = hash.split("&");

        var form_json = {
            "end_time" : "",
            "order_from" : "",
            "order_label" : $("select[name=order_label]").val(),
            "order_name" : "",
            "order_status" : "",
            "promotion_type" : "",
            "pay_type" : "",
            "search" : "",
            "start_time" : "",
            "order_type" : 'all',
            "page" : ""
        };
        if(hash_arr.length > 0){
            // page = hash_arr[0].replace('#!page=', '');
            $.each(hash_arr,function(index, itemobj){
                var item_arr = itemobj.split("=");
                if(item_arr.length == 2){
                    $.each(form_json,function(key, form_val){
                        if(item_arr[0].indexOf(key) != "-1"){
                            form_json[key] = item_arr[1];
                        }
                    })
                }
            })
        }
        resetOrderStatus(form_json.order_type, 2);
        form.val("order_list", form_json);
        setOrderStatusTab(form_json.order_status);
        return form_json;
    }

    /**
     * 获取哈希值order_type
     */
    function getHashOrderType(){
        var hash = ns.urlReplace(location.hash);
        var hash_arr = hash.split("&");
        var order_type = "all";
        if(hash_arr.length > 0){
            // page = hash_arr[0].replace('#!page=', '');
            $.each(hash_arr,function(index, itemobj){
                var item_arr = itemobj.split("=");
                if(item_arr.length == 2){
                    if(item_arr[0].indexOf("order_type") != "-1") {
                        order_type = item_arr[1];
                    }
                }
            })
        }
        return order_type;
    }

    layui.use(['laypage','laydate','form', 'element'], function(){
        form = layui.form;
        laypage = layui.laypage;
        element = layui.element;
        var laydate = layui.laydate;
		form.render();

        //渲染时间
        laydate.render({
            elem: '#start_time'
            ,type: 'datetime'
            ,change: function(value, date, endDate){
                $(".date-picker-btn").removeClass("selected");
            }
        });
        laydate.render({
            elem: '#end_time'
            ,type: 'datetime'
            ,change: function(value, date, endDate){
                $(".date-picker-btn").removeClass("selected");
            }
        });

        //监听筛选事件
        form.on('submit(btn_search)', function(data){
            is_refresh = true;
            data.field.page = 1;
            resetOrderStatus(data.field.order_type, 2);
            setHashOrderList(data.field);
            setOrderStatusTab(data.field.order_status);
            return false;
        });

        //批量导出（订单项）
        form.on('submit(batch_export_order_goods)', function(data){
            // location.href = ns.url("shop/order/exportOrderGoods",data.field);
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: ns.url("shop/order/exportordergoods"),
                data: data.field,
                success: function (res) {

                }
            });
            window.open(ns.url("shop/order/export",{}));
            // location.href = ns.url("shop/order/orderexportlist",{});
            return false;
        });

        //批量导出（订单）
        form.on('submit(batch_export_order)', function(data){
            // location.href = ns.url("shop/order/exportOrder",data.field);
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: ns.url("shop/order/exportorder"),
                data: data.field,
                success: function (res) {

                }
            });
            window.open(ns.url("shop/order/export",{}));
            // location.href = ns.url("shop/order/orderexportlist",{});
            return false;
        });

        //订单类型
        form.on('select(order_type)', function(data){
            resetOrderStatus(data.value, 1);
            return false;
        });

        //监听Tab切换，以改变地址hash值
        element.on('tab(order_tab)', function(){
            var status = this.getAttribute('lay-id');
            form.val("order_list", {"order_status":status});

            var hash_data = getHashList();
            hash_data.order_status = status;
            hash_data.page = 1;
            setHashOrderList(hash_data);
        });
        getHashData();
        getOrderList();//筛选

    });

    function setOrderStatusTab(order_status){
        $(".layui-tab-title li").removeClass("layui-this");
        $(".layui-tab-title li").each(function(){
            var status = $(this).attr("lay-id");
            if(status == order_status){
                $(this).addClass("layui-this")
            }
        });
    }
    //重置状态tab 选项卡
    function resetOrderStatus(order_type, is_tab){
        var hash_order_type = getHashOrderType();
        if(hash_order_type != order_type || is_refresh == false){
            if(is_tab != 1 || is_refresh == false) {
                $(".layui-tab-title li").not(':first').remove();
                $(".layui-tab-title li").find(":first").addClass("layui-this");
            }
            if(is_tab != 2 || is_refresh == false){
                $("select[name=order_status] option").not(':first').remove();
            }

            var status_item = order_type_status_json[order_type]["status"];
            $.each(status_item,function(index, itemobj){
                if(is_tab != 1 || is_refresh == false) {
                    $(".layui-tab-title").append('<li lay-id="' + index + '">' + itemobj + '</li>');
                }
                if(is_tab != 2 || is_refresh == false) {
                    $("select[name=order_status]").append('<option value="' + index + '">' + itemobj + '</option>');
                }
            });
            form.render('select');
        }
    }
    //哈希值 订单数据
    function setHashOrderList(data){
        var hash = "";
        $.each(data,function(index, itemobj){
            if(itemobj != "" && itemobj != "all"){
                if(hash == ""){
                    hash += "#!"+index +"="+itemobj;
                }else{
                    hash += "&"+index +"="+itemobj;
                }
            }
        });
        // window.location.href = hash;
        hash_url = hash;
        location.hash = hash;
        getOrderList();
    }

    function getHashList(){
        var hash = ns.urlReplace(location.hash);
        var hash_arr = hash.split("&");

        var form_json = {
            "end_time" : "",
            "order_from" : "",
            "order_label" : $("select[name=order_label]").val(),
            "order_name" : "",
            "order_status" : "",
            "promotion_type" : "",
            "pay_type" : "",
            "search" : "",
            "start_time" : "",
            "order_type" : 'all',
            "page" : ""
        };
        if(hash_arr.length > 0){
            // page = hash_arr[0].replace('#!page=', '');
            $.each(hash_arr,function(index, itemobj){
                var item_arr = itemobj.split("=");
                if(item_arr.length == 2){
                    $.each(form_json,function(key, form_val){
                        if(item_arr[0].indexOf(key) != "-1"){
                            form_json[key] = item_arr[1];
                        }
                    })
                }
            })
        }

        return form_json;
    }

    var order = new Order();
    function getOrderList(){
        var url = ns.url("shop/order/lists", ns.urlReplace(location.hash.replace('#!', '')));

        $.ajax({
            type : 'get',
            dataType: 'json',
            url :url,
            success : function(res){
                if(res.code == 0){
                    order.setData(res.data);
                    $("#order_list").html(order.fetch());
                    laypage.render({
                        elem: 'order_page',
                        count: res.data.count,
                        curr: getHashPage(),
                        layout: ['count', 'prev', 'page', 'next'],
                        // hash: 'page',
                        jump: function(obj, first){
                            //首次不执行
                            if(!first){
                                var hash_data = getHashData();
                                hash_data.page = obj.curr;
                                setHashOrderList(hash_data);
                                // $("#btn_search").click();//筛选
                            }
                        }
                    });
                }else{
                    layer.msg(res.message);
                }
            }
        });
    }

    /**
     * 七天时间
     */
    function datePick(date_num,event_obj){
        $(".date-picker-btn").removeClass("selected");
        $(event_obj).addClass('selected');
        // alert(new Date().format("yyyy-MM-dd hh:mm"));
        var now_date = new Date();

        Date.prototype.Format = function (fmt,date_num) { //author: meizz
            this.setDate(this.getDate()-date_num);
            var o = {
                "M+": this.getMonth() + 1, //月份
                "d+": this.getDate(), //日
                "H+": this.getHours(), //小时
                "m+": this.getMinutes(), //分
                "s+": this.getSeconds(), //秒
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度
                "S": this.getMilliseconds() //毫秒
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        };
        // var now_time =  new Date().Format("yyyy-MM-dd HH:mm:ss",0);//当前日期
        var now_time =  new Date().Format("yyyy-MM-dd 23:59:59",0);//当前日期
        var before_time =  new Date().Format("yyyy-MM-dd 00:00:00",date_num-1);//前几天日期
        $("input[name=start_time]").val(before_time,0);
        $("input[name=end_time]").val(now_time,date_num-1);

    }
</script>

<!-- 商品预览 -->
<script type="text/html" id="goods_preview">
	<div class="goods-preview">
		<div class="qrcode-wrap">
			<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
			<p class="tips ns-text-color">扫码可在手机端查看</p>
		</div>
		<div class="phone-wrap">
			<div class="iframe-wrap">
				<iframe src="{{ d.path.h5.url }}&preview=1" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</script>

</body>

</html>