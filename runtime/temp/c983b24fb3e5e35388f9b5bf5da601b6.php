<?php /*a:2:{s:68:"/www/wwwroot/ls.chnssl.com/addon/bargain/shop/view/bargain/edit.html";i:1614520258;s:23:"app/shop/view/base.html";i:1654828558;}*/ ?>
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
	.ns-len-input{width: 100%;max-width: 120px;}
	.layui-table-view{margin-top: 0;}
	.layui-form-item .layui-input-inline.end-time{float: none;}
	.desc{margin-bottom: 15px;border:1px dashed #ff8143;padding: 5px 10px;background: #fff0e9;color: #ff8143;width: 65%;}
	.forbidden{cursor:not-allowed;background-color: #eee;}
	.layui-table-body{max-height: 480px !important;}
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
			
				
<div class="layui-form ns-form">
	<div class="desc">
		请自觉遵守微信关于规范外部链接内容管理的规范，防止由于微信封号导致不必要的损失。<a href="http://weixin.qq.com/cgi-bin/readtemplate?t=weixin_external_links_content_management_specification" target="_blank">点击查看详情</a>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>活动名称：</label>
		<div class="layui-input-block">
			<input type="text" name="bargain_name" lay-verify="required" value="<?php echo htmlentities($bargain_info['bargain_name']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">
			<p>活动名称将显示在活动列表中，方便商家管理</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>活动时间：</label>
		<div class="layui-inline">
			<div class="layui-input-inline ns-len-mid">
				<input type="text" id="start_time" name="start_time" value="<?php echo date('Y-m-d H:i:s', $bargain_info['start_time']); ?>" lay-verify="required" class="layui-input" autocomplete="off" readonly>
				<i class="ns-calendar"></i>
			</div>
			<span class="layui-form-mid">-</span>
			<div class="layui-input-inline ns-len-mid end-time">
				<input type="text" id="end_time" name="end_time" value="<?php echo date('Y-m-d H:i:s', $bargain_info['end_time']); ?>" lay-verify="required|time" class="layui-input" autocomplete="off" readonly>
				<i class="ns-calendar"></i>
			</div>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否参与分销：</label>
		<div class="layui-input-block">
			<input type="radio" name="is_fenxiao" value="0" title="不参与" <?php if($bargain_info['is_fenxiao'] == 0): ?>checked<?php endif; ?> >
			<input type="radio" name="is_fenxiao" value="1" title="参与" <?php if($bargain_info['is_fenxiao'] == 1): ?>checked<?php endif; ?> >
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">购买方式：</label>
		<div class="layui-input-block">
			<input type="radio" name="buy_type" value="0" title="任意金额可购买" <?php if($bargain_info['buy_type'] == 0): ?>checked<?php endif; ?> >
			<input type="radio" name="buy_type" value="1" title="砍到指定价格才可购买" <?php if($bargain_info['buy_type'] == 1): ?>checked<?php endif; ?> >
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">帮砍金额：</label>
		<div class="layui-input-block">
			<input type="radio" name="bargain_type" value="1" title="随机金额" <?php if($bargain_info['bargain_type'] == 1): ?>checked<?php endif; ?> >
			<input type="radio" name="bargain_type" value="0" title="固定金额" <?php if($bargain_info['bargain_type'] == 0): ?>checked<?php endif; ?> >
		</div>
		<div class="ns-word-aux">
			<p>设置每位帮砍用户的砍价金额规则</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否允许自己砍价：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_own" lay-filter="" <?php if($bargain_info['is_own'] == 1): ?>checked<?php endif; ?> value="1" lay-skin="switch" />
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>帮砍人数：</label>
		<div class="layui-input-block">
			<input type="number" name="bargain_num" value="<?php echo htmlentities($bargain_info['bargain_num']); ?>" lay-verify="required|int" data-min="2" data-max="100" data-unit="人" placeholder="2-100人" autocomplete="off" class="layui-input ns-len-short">
		</div>
		<div class="ns-word-aux">
			<p>每个用户同一件商品只可砍一刀</p>
			<p>帮砍人数为该砍价订单最少人数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>砍价有效期：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline ns-len-short">
				<input type="number" name="bargain_time" value="<?php echo htmlentities($bargain_info['bargain_time']); ?>" lay-verify="required|int" data-min="4" data-max="48" data-unit="小时" placeholder="4-48小时" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<div class="layui-form-mid">小时</div>
		</div>
		<div class="ns-word-aux">
			<p>自用户发起砍价到砍价截止的时间</p>
		</div>
	</div>

	<div class="layui-form-item goods_list">
		<label class="layui-form-label">活动商品：</label>
		<div class="layui-input-block">
			<table id="selected_goods_list" lay-filter="selected_goods_list"></table>
		</div>
	</div>

	<div class="layui-form-item layui-form-text">
		<label class="layui-form-label">活动规则说明：</label>
		<div class="layui-input-inline">
			<textarea name="remark" class="layui-textarea ns-len-long"><?php echo htmlentities($bargain_info['remark']); ?></textarea>
		</div>
	</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
	
	<input type="hidden" name="bargain_id" value="<?php echo htmlentities($bargain_info['bargain_id']); ?>" />
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


<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="money">首刀金额</button>
	<button class="layui-btn layui-btn-primary" lay-event="bargain-stock">砍价库存</button>
	<button class="layui-btn layui-btn-primary" lay-event="floor-price">底价</button>
</script>
<script>
    var sku_list = [];
	sku_list = <?php echo json_encode($bargain_info['goods_list'], JSON_UNESCAPED_UNICODE); ?>;

	sku_list.forEach(function (item,index) {
		item.is_delete = item.bargain_stock ? 1 : 2;
	});
    layui.use(['form', 'laydate'], function() {
        var form = layui.form,
            laydate = layui.laydate,
            repeat_flag = false,
            startDate = '<?php echo htmlentities($bargain_info['start_time']); ?>',
			endDate = '<?php echo htmlentities($bargain_info['end_time']); ?>',
            minDate = "";
        form.render();

        renderTable(sku_list); // 初始化表格

        //开始时间
        laydate.render({
            elem: '#start_time', //指定元素
            type: 'datetime',
            value: ns.time_to_date(startDate),
            done: function(value) {
                minDate = value;
                reRender();
            }
        });

        //结束时间
        laydate.render({
            elem: '#end_time', //指定元素
            type: 'datetime',
            value: ns.time_to_date(endDate)
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

        /**
         * 表单验证
         */
        form.verify({
			int: function(value, item) {
				var str = $(item).parents(".layui-form-item").find("label").text().split("*").join("");
				str = str.substring(0, str.length - 1);
				
				var min = $(item).attr("data-min");
				var max = $(item).attr("data-max");
				var unit = $(item).attr("data-unit");
				
				if (value < Number(min)) {
					return str + '不能小于' + min + unit;
				}
				if (value > Number(max)) {
					return str + '不能大于' + max + unit;
				}
				if (value % 1 != 0) {
					return str + '必须为整数';
				}
			},
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
            num: function(value) {
                if (value < 1 || value % 1 != 0) {
                    return '请输入大于0的正整数！';
                }
            },
            sum: function(value) {
                if (value < 2 || value % 1 != 0) {
                    return '参团人数不能小于2，且必须是整数！';
                }
            },
			bargain_first: function(value, item) {
				var price = $(item).parents("tr").find(".bargain-price").text();
				var min_price = $(item).parents("tr").find("input[lay-verify='min_price']").val();
				
				if (value == "" || value == 0) {
					return;
				}
				if (value < 0) {
					return '首刀金额不能小于0';
				}
				if (Number(value) >= Number(price)) {
					return '首刀金额必须小于商品价格';
				}
				if ((Number(value) + Number(min_price)) >= Number(price)) {
					return '首刀金额与底价之和必须小于商品价格';
				}
				
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
				    val = arrMen[1];
				}
				if (val.length > 2) {
				    return '首刀金额最多保留两位小数';
				}
			},
            bargain_stock: function(value, item) {
                var stock = $(item).parents("tr").find(".stock").text();
				if (value == "" || value == 0) {
					return;
				}
                if (Number(value) < 0) {
                    return '砍价库存不能小于0';
                }
                if (Number(value) > Number(stock)) {
                    return '砍价库存不能大于商品总库存';
                }
                if (value % 1 != 0) {
                    return '砍价库存必须为整数';
                }
            },
            min_price: function(value, item) {
                var price = $(item).parents("tr").find(".bargain-price").text();
				
				if (value == "" || value == 0) {
					return;
				}
                if (Number(value) < 0) {
                    return '商品底价不能小于0';
                }
                if (Number(value) > Number(price)) {
                    return '商品底价不能大于商品价格';
                }

                var arrMen = value.split(".");
                var val = 0;
                if (arrMen.length == 2) {
                    val = arrMen[1];
                }
                if (val.length > 2) {
                    return '商品底价最多保留两位小数';
                }
            }
        });

        /**
         * 监听提交
         */
        form.on('submit(save)', function(data){

			data.field.sku_ids = [];
			data.field.goods_id = sku_list[0].goods_id;
			sku_list.forEach(function (item,index) {
				if (item.is_delete == 2) return false;
				data.field.sku_ids.push(item.sku_id);
			});

            if (data.field.sku_ids.length == 0) {
                layer.msg("请选择参与活动商品！", {icon: 5, anim: 6});
                return;
            }

			var skuLisArr = [];
			sku_list.forEach(function(item,index) {
				var sku_detail = {};
				sku_detail.sku_id = item.sku_id;
				sku_detail.goods_id = item.goods_id;
				sku_detail.first_bargain_price = item.first_bargain_price || 0.00;
				sku_detail.bargain_stock = item.bargain_stock || item.stock;
				sku_detail.floor_price = item.floor_price || 0.00;
				sku_detail.is_delete = item.is_delete || 1;
				skuLisArr.push(sku_detail);
			});
			data.field.sku_list = skuLisArr;

            if(repeat_flag) return;
            repeat_flag = true;

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ns.url("bargain://shop/bargain/edit"),
                data: data.field,
                async: false,
                success: function(res){
                    repeat_flag = false;

                    if (res.code == 0) {
                        layer.confirm('编辑成功', {
                            title:'操作提示',
                            btn: ['返回列表', '继续编辑'],
                            yes: function(){
                                location.href = ns.url("bargain://shop/bargain/lists");
                            },
                            btn2: function() {
                                location.reload();
                            }
                        });
                    }else{
                        layer.msg(res.message);
                    }
                }
            })
        });
    });
	
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
	                align: 'right',
					width: '15%',
	                templet: function(data) {
	                    return '<p class="ns-line-hiding" title="'+ data.price +'">￥<span class="bargain-price">' + data.price +'</span></p>';
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
	                title: '<span title="首刀金额自定义">首刀金额自定义<span>',
	                unresize: 'false',
					width: '13%',
					templet: '#bargainFirst'
	            }, {
	                title: '砍价库存',
	                unresize: 'false',
					width: '13%',
					templet: '#bargainStock'
	            }, {
	                title: '底价',
	                unresize: 'false',
					width: '13%',
					templet: '#minPrice'
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
		var batchIdent = 1;
		table.toolbar(function(obj) {

			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			switch (obj.event) {
				case "money":
					editInput(0,obj);
					break;
				case "bargain-stock":
					editInput(1,obj);
					break;
				case "floor-price":
					editInput(2,obj);
					break;
			}
		});
	}

	function editInput(textIndex=0,data) {
		var text = [{
			name: '首刀金额',
			value: 'first_bargain_price'
		},{
			name: '砍价库存',
			value: 'bargain_stock'
		},{
			name: '底价',
			value: 'floor_price'
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
						<input type="text" name="bargain_edit_input" lay-verify="required" autocomplete="off" class="layui-input ns-len-mid" placeholder="请输入${text[textIndex].name}">
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

	function bargainFirst(index,event) {
		sku_list[index-1].first_bargain_price = event.srcElement.value;
	}

	function bargainStock(index,event) {
		sku_list[index-1].bargain_stock = event.srcElement.value;
	}

	function bargainMinPrice(index,event) {
		sku_list[index-1].floor_price = event.srcElement.value;
	}
    function back() {
        location.href = ns.url("bargain://shop/bargain/lists");
    }
	$("body").on("click",".no-participation",function(){
		$(this).text("设置参与");
		$(this).parents("tr").find("input").each(function (index,item) {
			$(item).attr("readonly",true);
			$(item).attr("disabled",true);
			$(item).addClass("forbidden");
		});
		$(this).addClass("participation").removeClass("no-participation");
		sku_list[$(this).parents("tr").attr("data-index")].is_delete = 2;
	});

	$("body").on("click",".participation",function(){
		$(this).text("设置不参与");
		$(this).parents("tr").find("input").each(function (index,item) {
			$(item).attr("readonly",false);
			$(item).attr("disabled",false);
			$(item).removeClass("forbidden");
		});
		$(this).removeClass("participation").addClass("no-participation");
		sku_list[$(this).parents("tr").attr("data-index")].is_delete = 1;
	});
</script>

<script type="text/html" id="bargainFirst">
	{{# if(!d.bargain_stock){ }}
	<input type="number" class="layui-input ns-len-input bargain-first forbidden" value="{{d.first_bargain_price}}" lay-verify="bargain_first" min="0.00" oninput="bargainFirst({{ d.LAY_INDEX }},event)" onporpertychange="bargainFirst({{ d.LAY_INDEX }},event)" readonly disabled/>
	{{# }else{ }}
	<input type="number" class="layui-input ns-len-input bargain-first" value="{{d.first_bargain_price}}" lay-verify="bargain_first" min="0.00" oninput="bargainFirst({{ d.LAY_INDEX }},event)" onporpertychange="bargainFirst({{ d.LAY_INDEX }},event)"/>
	{{# } }}
</script>

<script type="text/html" id="bargainStock">
	{{# if(!d.bargain_stock){ }}
	<input type="number" class="layui-input ns-len-input bargain-stock forbidden" value="{{d.bargain_stock}}" lay-verify="bargain_stock" min="0" oninput="bargainStock({{ d.LAY_INDEX }},event)" onporpertychange="bargainStock({{ d.LAY_INDEX }},event)" readonly disabled/>
	{{# }else{ }}
	<input type="number" class="layui-input ns-len-input bargain-stock" value="{{d.bargain_stock}}" lay-verify="bargain_stock" min="0" oninput="bargainStock({{ d.LAY_INDEX }},event)" onporpertychange="bargainStock({{ d.LAY_INDEX }},event)"/>
	{{# } }}
</script>

<script type="text/html" id="minPrice">
	{{# if(!d.bargain_stock){ }}
	<input type="number" class="layui-input ns-len-input min-price forbidden" value="{{d.floor_price}}" lay-verify="min_price" min="0.00" oninput="bargainMinPrice({{ d.LAY_INDEX }},event)" onporpertychange="bargainMinPrice({{ d.LAY_INDEX }},event)" readonly disabled/>
	{{# }else{ }}
	<input type="number" class="layui-input ns-len-input min-price" value="{{d.floor_price}}" lay-verify="min_price" min="0.00" oninput="bargainMinPrice({{ d.LAY_INDEX }},event)" onporpertychange="bargainMinPrice({{ d.LAY_INDEX }},event)"/>
	{{# } }}
</script>

<script type="text/html" id="operation">
	<div class="ns-table-btn">
		{{# if(!d.bargain_stock){ }}
		<a class="layui-btn participation">设置参与</a>
		{{# }else{ }}
		<a class="layui-btn no-participation">设置不参与</a>
		{{# } }}
	</div>
</script>

</body>

</html>