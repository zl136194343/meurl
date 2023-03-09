<?php /*a:2:{s:55:"/www/wwwroot/ls.chnssl.com/app/admin/view/diy/edit.html";i:1614515898;s:23:"app/shop/view/base.html";i:1660100996;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/colorPicker/css/colorpicker.css" />
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/diyview/css/diyview.css" />
<style>
	/*访问店铺*/
	.ns-login-box{display: flex;}
	.ns-shop-ewm a{display: inline-block;line-height: 60px;cursor: pointer;}
	.ns-shop-ewm{position: relative;}
	.side-pic-img{display: inline-block;width: 35px;height: 35px;margin-top: 20px;line-height: 35px;text-align: center;border-radius: 50%;overflow: hidden;}
	.side-pic-img img{width: 100%;height: 100%;}
	/*h5预览*/
	.goods-preview{position: relative;}
	.goods-preview .qrcode-wrap{background: #f4f6f8;display: inline-block;padding: 10px;text-align: center;position: absolute;left: 40px;top:40px;overflow: hidden; height: 130px;width: 150px;}
	.goods-preview .qrcode-wrap img{width: 100px;height: 100px;}
	.goods-preview .qrcode-wrap .tips{font-size: 12px;margin-top: 10px;}
	.goods-preview .phone-wrap{width: 253px;height: 510px;margin-left: 230px;background: url(https://ls.chnssl.com/app/admin/view/public/img/iphone_shell.png) no-repeat;background-size: 100% auto;position: relative;}
	.goods-preview .phone-wrap .iframe-wrap{width: 230px;height: 448px;position: absolute;top: 49px;left: 12px;overflow: hidden;display: inline-block;}
	.goods-preview .phone-wrap .iframe-wrap iframe{width: 264px;height: 500px;margin-top: -34px;margin-left: -18px;transform:scale(0.86);}
	.goods-preview .qrcode-wrap input {
	    margin-top: 30px;
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
			
				
<div id="diyView" <?php if($app_module=="shop"): ?> class="merchant-wrap" <?php else: ?> class="platform-wrap" <?php endif; ?>>

	<!-- 组件列表 -->
	<div class="component-list">
		<nav>
			<?php if(is_array($diy_view_utils) || $diy_view_utils instanceof \think\Collection || $diy_view_utils instanceof \think\Paginator): if( count($diy_view_utils)==0 ) : echo "" ;else: foreach($diy_view_utils as $k=>$vo): ?>
			<h3 data-index="<?php echo htmlentities($k); ?>"><img src="https://ls.chnssl.com/public/static/ext/diyview/img/component_down.png" /><?php echo htmlentities($vo['type_name']); ?></h3>
			<ul data-index="<?php echo htmlentities($k); ?>">
				<?php if($vo['type'] == 'SYSTEM' && (($app_module == 'admin' && $name != 'DIY_VIEW_GOODS_CATEGORY') || ($app_module == 'shop' && $name != 'DIY_VIEW_SHOP_GOODS_CATEGORY') || ($app_module == 'city' && $name == 'DIY_VIEW_CITY_INDEX'))): ?>
				<li title="弹出广告" v-on:click='changeCurrentIndex(-98)'>
					<img src="https://ls.chnssl.com/public/static/ext/diyview/img/icon/pop_adv.png" data-icon="https://ls.chnssl.com/public/static/ext/diyview/img/icon/pop_adv.png" data-icon-selected="https://ls.chnssl.com/public/static/ext/diyview/img/icon/pop_adv_selected<?php echo $app_module=='shop' ? '' : '_admin'; ?>.png" />
					<span>弹出广告</span>
					<!--<span class="js-component-add-count">1/1</span>-->
				</li>
				<?php endif; if(is_array($vo['list']) || $vo['list'] instanceof \think\Collection || $vo['list'] instanceof \think\Paginator): if( count($vo['list'])==0 ) : echo "" ;else: foreach($vo['list'] as $li_k=>$li): ?>
				<li title="<?php echo htmlentities($li['title']); ?>"
					<?php if($li['value']): ?>v-on:click='addComponent(<?php echo htmlentities($li['value']); ?>,{ name : "<?php echo htmlentities($li['name']); ?>", title : "<?php echo htmlentities($li['title']); ?>", max_count : <?php echo htmlentities($li['max_count']); ?>, addon_name : "<?php echo htmlentities($li['addon_name']); ?>", controller : "<?php echo htmlentities($li['controller']); ?>", is_delete : "<?php echo htmlentities($li['is_delete']); ?>" })'
					v-bind:class="{ 'disabled' : !checkComponentIsAdd('<?php echo htmlentities($li['name']); ?>',<?php echo htmlentities($li['max_count']); ?>) }"
					<?php else: ?>:class="{'disabled':true}"<?php endif; if($app_module=="shop"): ?> class="merchant-item" <?php else: ?> class="platform-item" <?php endif; ?>>
					<img src="https://ls.chnssl.com/<?php echo htmlentities($li['icon']); ?>" data-icon="https://ls.chnssl.com/<?php echo htmlentities($li['icon']); ?>" data-icon-selected="https://ls.chnssl.com/<?php echo htmlentities($li['icon_selected']); ?>" />
					<span><?php echo htmlentities($li['title']); ?></span>
					<!--<span class="js-component-add-count">{{getComponentAddCount('<?php echo htmlentities($li['name']); ?>')}}/<?php if($li['max_count']): ?><?php echo htmlentities($li['max_count']); else: ?>不限<?php endif; ?></span>-->
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</nav>
	</div>

	<div class="preview-wrap">

		<div class="preview-restore-wrap">

			<div class="dv-wrap">

				<?php if(empty($disabled_page_set) || (($disabled_page_set instanceof \think\Collection || $disabled_page_set instanceof \think\Paginator ) && $disabled_page_set->isEmpty())): ?>
				<button class="layui-btn layui-btn-primary position-page-btn" v-on:click="changeCurrentIndex(-99)">页面设置</button>
				<?php endif; ?>

				<div class='diy-view-wrap layui-form' v-bind:style="{ backgroundColor : global.bgColor,backgroundImage : 'url('+changeImgUrl(global.bgUrl)+')' }">

					<div class="preview-head" <?php if(empty($disabled_page_set) || (($disabled_page_set instanceof \think\Collection || $disabled_page_set instanceof \think\Paginator ) && $disabled_page_set->isEmpty())): ?>v-on:click="changeCurrentIndex(-99)"<?php endif; ?>>
						<!-- 风格1 -->
						<div v-if="global.navStyle == 1" class="preview-head_div" v-bind:style="{ backgroundColor : global.topNavColor,color:global.textNavColor,textAlign:global.textImgPosLink}">
							<span v-bind:style="{ textAlign:global.textImgPosLink}" v-if="global.navStyle == 1">{{global.title}}</span>
						</div>
						<!-- 风格3 -->
						<div v-if="global.navStyle == 3" class="preview-head_div" v-bind:style="{ backgroundColor : global.topNavColor,color:global.textNavColor,textAlign:global.textImgPosLink}">
							<div class="img_text_search">
								<div class="img" v-bind:style="{backgroundImage : 'url('+changeImgUrl(global.topNavImg)+')'}"></div>
								<div class="top-search-box border-circle" style="border-radius:30px;background: rgb(255, 255, 255); text-align: center;color:#909399;line-height: 2.1;border:1px solid #E6E6E6">
									<i class="iconfont iconsousuo" style="color: #909399;float:left;margin-left:10px;"></i>请输入商品名称
								</div>
							</div>
						</div>
						<!-- 风格2 -->
						<div v-if="global.navStyle == 2" class="preview-head_div" v-bind:style="{ backgroundColor : global.topNavColor,color:global.textNavColor}">
							<div class="search" >
								<div class="img" v-bind:style="{backgroundImage : 'url('+changeImgUrl(global.topNavImg)+')'}"></div>
								<span >{{global.title}}</span>
							</div>
						</div>

						<div v-bind:class="{selected : currentIndex==-99}" v-bind:data-sort="-99" style="display:none;" <?php if(empty($disabled_page_set) || (($disabled_page_set instanceof \think\Collection || $disabled_page_set instanceof \think\Paginator ) && $disabled_page_set->isEmpty())): ?>v-show="data.length==0 || currentIndex==-99"<?php else: ?>v-show="currentIndex==-99"<?php endif; ?>>
							<div class="edit-attribute">
								<div class="attr-wrap">
									<div class="restore-wrap">
										<h2 class="attr-title">页面设置</h2>
										<div class="layui-form-item">
											<label class="layui-form-label sm">页面名称</label>
											<div class="layui-input-block">
												<input type="text" v-model="global.title" placeholder="请输入页面名称" class="layui-input" maxlength="15">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label sm">选择风格</label>
											<div class="layui-input-block">
												<div v-if="global.navStyle" class="ns-input-text ns-text-color selected-style" v-on:click="selectPageStyle">风格{{global.navStyle}} <i class="layui-icon layui-icon-right"></i></div>
												<div v-else class="ns-input-text selected-style" v-on:click="selectPageStyle">选择 <i class="layui-icon layui-icon-right"></i></div>
											</div>
										</div>
										<div class="layui-form-item" v-if="global.navStyle == 3 || global.navStyle == 2">
											<label class="layui-form-label sm">图片</label>
											<div class="layui-input-block ns-img-upload">
												<img-sec-upload v-bind:data="{ data : global, field : 'topNavImg', text: '' }"></img-sec-upload>
											</div>
										</div>
										<nc-link v-bind:data="{ field : global.moreLink }"></nc-link>
										<div class="layui-form-item ns-icon-radio"  v-if="global.navStyle == 1">
											<label class="layui-form-label sm">展示位置</label>
											<div class="layui-input-block">
												<template v-for="(item, index) in textImgPositionList" v-bind:k="index">
													<span v-bind:class="{'layui-hide':item.value != global.textImgPosLink}">{{item.text}}</span>
												</template>
												<ul class="ns-icon">
													<li v-for="(item, index) in textImgPositionList" v-bind:k="index" v-bind:class="{'ns-text-color ns-border-color ns-bg-color-diaphaneity':item.value == global.textImgPosLink}" @click="global.textImgPosLink = item.value">
														<img v-if="item.value == global.textImgPosLink" :src="item.selectedSrc" />
														<img v-else :src="item.src" />
													</li>
												</ul>
											</div>
										</div>

										<!-- <div class="layui-form-item" >
											<label class="layui-form-label sm">页面名称</label>
											<div class="layui-input-block">
												<input type="text" v-model="global.title" placeholder="请输入页面名称" class="layui-input" maxlength="50">
											</div>
										</div> -->
										<div class="template-edit-title">
											<h3>底部导航</h3>
											<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
										</div>
										<div class="template-edit-wrap">
											<div class="layui-form-item ns-checkbox-wrap">
												<label class="layui-form-label sm">底部导航</label>
												<div class="layui-input-block">
													<span v-if="global.openBottomNav == true">显示</span>
													<span v-else>隐藏</span>
													<div v-if="global.openBottomNav == true" v-on:click="global.openBottomNav = false" class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>
													<div v-else v-on:click="global.openBottomNav = true" class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>

													<!-- <div v-on:click="global.openBottomNav = true" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : global.openBottomNav }"><i class="layui-anim layui-icon">&#xe63f;</i><div>显示</div></div>
													<div v-on:click="global.openBottomNav = false" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : !global.openBottomNav }"><i class="layui-anim layui-icon">&#xe63f;</i><div>隐藏</div></div> -->
													<!-- <div class="layui-unselect layui-form-switch" v-on:click="global.openBottomNav=!global.openBottomNav" v-bind:class="{ 'layui-form-onswitch' : global.openBottomNav }" lay-skin="_switch">
														<em></em>
														<i></i>
													</div> -->
												</div>
												<div class="ns-word-aux ns-diy-word-aux">此处控制当前页面底部导航菜单是否显示</div>
											</div>
										</div>

										<div class="template-edit-title">
											<h3>页面显示样式</h3>
											<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
										</div>

										<div class="template-edit-wrap">
											<template v-if="globalLazyLoad">
												<color v-bind:data="{ field : 'bgColor', label : '页面颜色', value : global.bgColor, defaultcolor : '#ffffff', global: 1 }"></color>
												<color v-bind:data="{ field : 'topNavColor', label : '顶部颜色', value : global.topNavColor, defaultcolor : '#ffffff', global: 1 }"></color>
												<color v-bind:data="{ field : 'textNavColor', label : '标题颜色', value : global.textNavColor, defaultcolor : '#333333', global: 1 }"></color>
											</template>
											<div class="layui-form-item ns-checkbox-wrap">
												<label class="layui-form-label sm">顶部透明</label>
												<div class="layui-input-block">
													<span v-if="global.topNavbg == true">是</span>
													<span v-else>否</span>
													<div v-if="global.topNavbg == true" v-on:click="global.topNavbg = false" class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>
													<div v-else v-on:click="global.topNavbg = true" class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label sm">背景图片</label>
												<div class="layui-input-block ns-img-upload">
													<img-sec-upload v-bind:data="{ data : global, field : 'bgUrl', text: '' }"></img-sec-upload>
												</div>
											</div>
										</div>

										<?php if($app_module=="admin"): ?>
										<div class="template-edit-title">
											<h3>小程序收藏</h3>
											<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
										</div>
										<div class="template-edit-wrap">
											<div class="layui-form-item ns-checkbox-wrap">
												<label class="layui-form-label sm">显示状态</label>
												<div class="layui-input-block">
													<span v-if="global.mpCollect == true">显示</span>
													<span v-else>隐藏</span>
													<div v-if="global.mpCollect == true" v-on:click="global.mpCollect = false" class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>
													<div v-else v-on:click="global.mpCollect = true" class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon layui-icon-ok"></i></div>
												</div>
												<div class="ns-word-aux ns-diy-word-aux">首次进入小程序是否显示添加小程序提示</div>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>

							</div>

						</div>

					</div>

					<!-- 弹出广告 -->
					<div v-bind:class="{selected : currentIndex==-98}" v-bind:data-sort="-98" style="display:none;" v-show="currentIndex==-98">

						<div class="edit-attribute">
							<div class="attr-wrap">
								<div class="restore-wrap">
									<h2 class="attr-title">弹出广告</h2>

									<nc-link v-bind:data="{ field : global.popWindow.link, label : '弹出链接' }"></nc-link>

									<div class="layui-form-item">
										<label class="layui-form-label sm">弹出广告</label>
										<div class="layui-input-block ns-img-upload">
											<img-sec-upload v-bind:data="{ data : global.popWindow, field : 'imageUrl', text: '' }"></img-sec-upload>
										</div>
										<div class="ns-word-aux ns-diy-word-aux">建议上传图片大小：362px * 502px</div>
									</div>

									<div class="template-edit-title">
										<h3>弹出形式</h3>
										<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
									</div>

									<div class="template-edit-wrap" style="padding-left: 10px;">
										<div v-on:click="global.popWindow.count=-1" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (global.popWindow.count==-1) }"><i class="layui-anim layui-icon <?php echo htmlentities($app_module); ?>">&#xe63f;</i><div>不弹出</div></div>
										<div v-on:click="global.popWindow.count=1" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (global.popWindow.count==1) }"><i class="layui-anim layui-icon <?php echo htmlentities($app_module); ?>" >&#xe63f;</i><div>首次弹出</div></div>
										<div v-on:click="global.popWindow.count=0" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (global.popWindow.count==0) }"><i class="layui-anim layui-icon <?php echo htmlentities($app_module); ?>" >&#xe63f;</i><div>每次弹出</div></div>
									</div>
									<!-- <div class="layui-form-item ns-icon-radio">
										<label class="layui-form-label sm">弹出形式</label>
										<div class="layui-input-block">
											<div v-on:click="global.popWindow.count=-1" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (global.popWindow.count==-1) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>不弹出</div></div>
											<div v-on:click="global.popWindow.count=1" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (global.popWindow.count==1) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>首次弹出</div></div>
											<div v-on:click="global.popWindow.count=0" v-bind:class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (global.popWindow.count==0) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>每次弹出</div></div>
										</div>
									</div> -->
								</div>
							</div>

						</div>

					</div>

					<div class="preview-block">

						<template v-for="(nc,index) in data" v-bind:k="index">

							<div v-bind:data-index="index" v-on:click="changeCurrentIndex(nc.index)" v-bind:class="{ 'draggable-element nc-border-color-selected' : true,selected : currentIndex == nc.index }" v-bind:data-sort="index">
								<?php if(is_array($diy_view_utils) || $diy_view_utils instanceof \think\Collection || $diy_view_utils instanceof \think\Paginator): if( count($diy_view_utils)==0 ) : echo "" ;else: foreach($diy_view_utils as $key=>$vo): if(is_array($vo['list']) || $vo['list'] instanceof \think\Collection || $vo['list'] instanceof \think\Paginator): if( count($vo['list'])==0 ) : echo "" ;else: foreach($vo['list'] as $key=>$li): ?>
								<template v-if="nc.type == '<?php echo htmlentities($li['name']); ?>'">
									<?php echo event('DiyViewUtils',['controller'=>$li['controller'],'addon_name'=>$li['addon_name']],true); ?>
								</template>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>

						</template>

						<!--背景占位，防止右侧编辑栏闪动-->
						<div class="edit-attribute-placeholder"></div>

					</div>

				</div>
			</div>

		</div>
	</div>

	<!-- 预览 -->
	<template slot="preview">
		<div class="nav_style" >
			<div class="sytle">
				<div class="text-title" onclick="changeStyle(1)" :class="{active:global.navStyle == 1}">
					<img src="https://ls.chnssl.com/public/static/ext/diyview/img/nav_style/nav_style1.png"/>
				</div>
				<div class="text-title" onclick="changeStyle(2)" :class="{active:global.navStyle == 2}">
					<img src="https://ls.chnssl.com/public/static/ext/diyview/img/nav_style/nav_style3.png"/>
				</div>
				<div class="text-title" onclick="changeStyle(3)" :class="{active:global.navStyle == 3}">
					<img src="https://ls.chnssl.com/public/static/ext/diyview/img/nav_style/nav_style4.png"/>
				</div>
			</div>
		</div>
	</template>
	<div class="custom-save">
		<button class="layui-btn ns-bg-color save">保存</button>
		<?php if(!(empty($qrcode_info) || (($qrcode_info instanceof \think\Collection || $qrcode_info instanceof \think\Paginator ) && $qrcode_info->isEmpty()))): ?>
		<button class="layui-btn ns-bg-color" onclick="preview()">预览</button>
		<?php endif; ?>
	</div>
</div>

<?php if(!(empty($qrcode_info) || (($qrcode_info instanceof \think\Collection || $qrcode_info instanceof \think\Paginator ) && $qrcode_info->isEmpty()))): ?>
<!-- 页面预览 -->
<script type="text/html" id="h5_preview">
	<div class="goods-preview">
		<div class="qrcode-wrap">
			<img src="<?php echo img($qrcode_info['path']['h5']['img']); ?>" alt="推广二维码">
			<p class="tips ns-text-color">扫码访问页面 <a class="ns-text-color" href="javascript:ns.copy('h5_preview_1');">复制链接</a></p>
			<input type="text" id="h5_preview_1" value="<?php echo htmlentities($qrcode_info['path']['h5']['url']); ?>" readonly />
		</div>
		<div class="phone-wrap">
			<div class="iframe-wrap">
				<iframe id="iframe" src="<?php echo htmlentities($qrcode_info['path']['h5']['url']); ?>" frameborder="0"></iframe>
				<div class="empty">
					<img src="https://ls.chnssl.com/public/static/img/wap_not_found.png" />
					<p>当前手机页面无法访问</p>
					<a href="https://www.kancloud.cn/niucloud/niushop_b2c_v4/1842146" class="ns-text-color" target="_blank">请检查手机端域名配置以及伪静态</a>
				</div>
			</div>
		</div>
	</div>
</script>
<?php endif; if(!empty($diy_view_info) && !empty($diy_view_info['value'])): ?>
    <input type="hidden" id="info" value='<?php echo htmlentities($diy_view_info['value']); ?>' />
<?php endif; if(!empty($diy_view_info) && !empty($diy_view_info['name'])): ?>
    <input type="hidden" id="name" value="<?php echo htmlentities($diy_view_info['name']); ?>" />
<?php elseif(!empty($name)): ?>
    <input type="hidden" id="name" value="<?php echo htmlentities($name); ?>" />
<?php else: ?>
    <input type="hidden" id="name" value="DIY_VIEW_RANDOM_<?php echo htmlentities($time); ?>" />
<?php endif; ?>
<input type="hidden" id="cityIsExit" >

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
	var STATICIMG = 'https://ls.chnssl.com/public/static/img';
    var STATICEXT = 'https://ls.chnssl.com/public/static/ext';
    var store_id = '<?php echo htmlentities($store_id); ?>';
	var link_url = '<?php echo htmlentities($app_module); ?>/diy/link';


    // 自适应全屏，调整高度
    var height = $(window).height();
	if( post === 'shop' ) {
		var commonHeight = height - 214;
	} else {
		var commonHeight = height - 254;
	}
	$(".component-list nav").css("height", (commonHeight + 20) + "px");
	$(".preview-wrap .preview-restore-wrap .dv-wrap").css("height", (commonHeight) + "px");
	$(".edit-attribute .attr-wrap").css("height", (commonHeight) + "px");
	if( post === 'shop' ) {
		$(".edit-attribute-placeholder").css("height", (height - 214) + "px");
	} else {
	}
	$(".preview-block").css("min-height", (commonHeight - 120) + "px");

	$("body").on("click",".component-list h3",function () {
		var index = $(this).attr("data-index");
		var ul = $(".component-list ul[data-index='" + index + "']");
		if (ul.height()) {
			$(this).find("img").attr("src", "https://ls.chnssl.com/public/static/ext/diyview/img/component_right.png");
			if (!ul.attr("data-height")) ul.attr("data-height", ul.height());
			ul.animate({opacity: 0, height: 0},100);
		} else {
			$(this).find("img").attr("src", "https://ls.chnssl.com/public/static/ext/diyview/img/component_down.png");
			ul.animate({opacity: 1, height: ul.attr("data-height") + "px"},100);
		}

	}).on("mousemove",".component-list ul li",function () {
		var icon_selected = $(this).find("img").attr("data-icon-selected");
		$(this).find("img").attr("src", icon_selected);
	}).on("mouseout",".component-list ul li",function () {
		var icon = $(this).find("img").attr("data-icon");
		$(this).find("img").attr("src", icon);
	});

	<?php if(!(empty($qrcode_info) || (($qrcode_info instanceof \think\Collection || $qrcode_info instanceof \think\Paginator ) && $qrcode_info->isEmpty()))): ?>
	function preview() {
		$.ajax({
			type : 'get',
			url : "<?php echo htmlentities($qrcode_info['path']['h5']['url']); ?>&preview=1&store_id=<?php echo $store_id==0 ? '' : htmlentities($store_id); ?>",
			dataType : 'json',
			error:function (obj) {
				var layerIndex = layer.open({
					title: '访问页面',
					skin: 'layer-tips-class',
					type: 1,
					area: ['600px', '600px'],
					content: $("#h5_preview").html(),
					success:function () {
						if(obj.status == 0 || obj.status == 200){
							$("#iframe").show();
							$(".goods-preview .phone-wrap .iframe-wrap .empty").hide();
						}else{
							$(".goods-preview .phone-wrap .iframe-wrap .empty").show();
							$("#iframe").hide();
						}
					}
				});
			}
		});
	}
	<?php endif; ?>
</script>
<script src="https://ls.chnssl.com/public/static/js/vue.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/colorPicker/js/colorpicker.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/async_load_css.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/ddsort.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.config.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.all.js"> </script>
<script src="https://ls.chnssl.com/public/static/ext/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/components.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/custom_template.js"></script>
<script>
	var cityIsExit = <?php echo addon_is_exit('city'); ?>; //判断有无城市分站插件
	var cityName = "<?php echo htmlentities($name); ?>"; //区分微页面
	if (cityIsExit && cityName && cityName == 'DIY_VIEW_INDEX' || cityIsExit && cityName && cityName == 'DIY_VIEW_CITY_INDEX'){
		$("#cityIsExit").val(true);
	}

	<?php if(!empty($diy_view_info) && (!empty($diy_view_info['value']) || !empty($diy_view_info['id']) )): ?>
	var id = "<?php echo htmlentities($diy_view_info['id']); ?>";
	var info = JSON.parse($("#info").val().toString().replace(/\@/g, "'"));

	if(!$.isEmptyObject(info) && info.value){
		for(var i=0;i<info.value.length;i++) vue.addComponent(info.value[i]);
		vue.setGlobal(info.global);
	}else{
		vue.setGlobal({ title : "<?php echo htmlentities($diy_view_info['title']); ?>" });
	}

	<?php if($disabled_page_set): ?>
	vue.currentIndex=0;
	<?php endif; ?>
		vue.title = "<?php echo htmlentities($diy_view_info['title']); ?>";
	<?php else: ?>
		var id = 0;
		vue.globalLazyLoad = true;
	<?php endif; ?>

	//设置默认logo
	if(!vue.global.topNavImg){vue.global.topNavImg = 'https://ls.chnssl.com/app/admin/view/public/img/logo.png';}

	var repeat_flag = false;//防重复标识
	$("button.save").click(function() {

		// 刷新排序
		vue.refresh();
		setTimeout(function () {

			if (vue.verify()) {

				//全局属性
				var global = JSON.stringify(vue.global);
				global = eval("(" + global + ")");

				//组件属性
				var value = JSON.stringify(vue.data).replace(/\@/g, "");
				value = eval(value);

				//重新排序
				value.sort(function (a, b) {
					return a.sort - b.sort;
				});

				for (var item in value) {
					delete value[item].verify;
					delete value[item].lazyLoad;
					delete value[item].lazyLoadCss;
					delete value[item].index;
					delete value[item].sort;
					delete value[item].outerCountJs;
				}

				if (repeat_flag) return;
				repeat_flag = true;

				var v = {
					global: global,
					value: value
				};

				$.ajax({
					type: "post",
					url: "<?php echo addon_url($request_url); ?>",
					data: {id: id, name: $("#name").val(), title: vue.global.title, value: JSON.stringify(v)},
					dataType: "JSON",
					success: function (res) {
						layer.msg(res.message);
						if (res.code == 0) {

							if (id > 0 || $("#name").val() != "DIY_VIEW_RANDOM_<?php echo htmlentities($time); ?>") {
								location.reload();
							} else {
								location.href = ns.url("<?php echo htmlentities($app_module); ?>/diy/lists");
							}

						} else {
							repeat_flag = false;
						}
					}
				});
			}
		}, 100);
	});

	//导航样式切换
	function changeStyle(val){
		$('.text-title:nth-child('+(val)+')').css('border',"1px solid #4685FD").siblings().css('border',"1px solid #ccc");
		vue.global.navStyle = val;
		// vue.$forceUpdate()
	}
</script>

</body>

</html>