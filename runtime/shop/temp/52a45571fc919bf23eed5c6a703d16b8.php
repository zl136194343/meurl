<?php /*a:2:{s:65:"/www/wwwroot/ls.chnssl.com/app/shop/view/goodscategory/lists.html";i:1614516200;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
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
	.table_body {
		font-family: arial;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.goods-category-list .layui-table td {
		border-left: 0;
		border-right: 0;
	}
	.goods-category-list .layui-table .switch {
		font-size: 16px;
		cursor: pointer;
		width: 12px;
		line-height: 1;
		display: inline-block;
		text-align: center;
		vertical-align: middle;
	}
	.goods-category-list .layui-table img {width: 40px;}
	.goods-category-list .layui-table td {
		border-left: 0;
		border-right: 0;
	}
	.goods-category-list .layui-table .switch {
		font-size: 16px;
		cursor: pointer;
		width: 12px;
		line-height: 1;
		display: inline-block;
		text-align: center;
		vertical-align: middle;
	}
	.goods-category-list .layui-table img {width: 40px;}
	/* 分类样式 */
	.table_div{
		color:#666
	}
	.table_head{
		display: flex;
		font-weight: bold;
		background-color: #F7F7F7;
	}
	.table_head li{
		height: 40px;
		line-height: 40px;
		border: 0;
		border-bottom: 1px solid #e6e6e6;
		padding: 9px 15px;
		font-size: 14px;
		
	}
	.table_head li:first-child{
		padding-right: 0;
		
	}
	.table_tr{
		display: flex;
		border-bottom: 1px solid #e6e6e6;
	}
	.table_tr .table_td{
		position: relative;
		padding: 11px 15px 8px;
		min-height: 30px;
		line-height: 33px;
		font-size: 14px;
	}
	.table_tr .table_td span{
		cursor: pointer;
	}
	.table_tr .table_td span>img{
		width:12px;
		height:12px
	}
	.table_tr .table_td span>img.rotate{
		transform:rotate(90deg);
	}
	.table_tr .table_td .ns-img-box{
		width:30px;
		height:30px;
		line-height: 30px;
	}
	.table_tr .table_td:first-child{
		padding-right:0
	}
	.table_tr .ns-table-btn {
	    display: flex;
	    flex-wrap: wrap;
	}
	.table_tr .layui-btn {
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    height: 23px;
	    border-radius: 50px;
	    background-color: transparent;
	    color: #ff8143;
	    text-align: center;
	    padding: 2px 8px 2px 0;
	    margin: 5px 0 5px 5px;
	    position: relative;
	}
	.table_two_div{
		display: none;
	}
	.table_three{
		display: none;
	}
	.empty_switch{
		display: inline-block;
		width:30px;
		height:25px;
		padding-right:15px;
	}
	.js-switch{display: inline-block;height:30px;width:30px;text-align: center;}
	.table_move{
		cursor: move;float:left;margin-right: 10px;
	}
	.table_moves{
		cursor: move;float:left;margin-right: 10px;
	}
	.tables_move{
		cursor: move;float:left;margin-right: 20px;padding-left: 70px;
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
			<li>展示了商家所有的商品分类，商家添加商品的时候需要选择对应的商品分类，用户可以根据商品分类搜索商品</li>
			<li>点击商品分类名前“+”符号，显示当前商品分类的下级分类</li>
			<li>商家可以添加、编辑、删除自己的商品分类</li>
			<li>商家可以通过拖拽进行分类排序</li>
		</ul>
	</div>
</div>

<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="addCategory()">添加商品分类</button>
</div>
<div class="goods-category-list">
	<div class="table_div" >
		<ul class="table_head">
			<li style="width:30px"></li>
			<li style="flex:6">分类名称</li>
			<li style="flex:2">简称</li>
			<li style="flex:2">图片</li>
			<!-- <li style="flex:2">排序</li> -->
			<li style="flex:2">是否显示</li>
			<li style="flex:2">操作</li>
		</ul>
		<div  class="table_body">
			<?php if($list): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $index=>$vo): ?>
			<div class="table_one" data-index="<?php echo htmlentities($index); ?>" data-sort="<?php echo htmlentities($vo['sort']); ?>" data-cateid="<?php echo htmlentities($vo['category_id']); ?>">
				<div class="table_tr">
					<div class="table_td" style="width:60px">
						<div class="table_move iconfont icontuodong"></div>
						<?php if(!(empty($vo['child_list']) || (($vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator ) && $vo['child_list']->isEmpty()))): ?>
						<span class="switch ns-text-color js-switch" data-category-id="<?php echo htmlentities($vo['category_id']); ?>" data-level="<?php echo htmlentities($vo['level']); ?>" data-open="0">+</span>
						<?php endif; ?>
					</div>
					<div class="table_td" style="flex:6"><?php echo htmlentities($vo['category_name']); ?></div>
					<div class="table_td" style="flex:2"><?php echo htmlentities($vo['short_name']); ?></div>
					<div class="table_td" style="flex:2">
						<?php if(!(empty($vo['image']) || (($vo['image'] instanceof \think\Collection || $vo['image'] instanceof \think\Paginator ) && $vo['image']->isEmpty()))): ?>
						<div class="ns-img-box">
							<img layer-src src="<?php echo img($vo['image']); ?>"/>
						</div>
						<?php endif; ?>
					</div>
					<!-- <div class="table_td" style="flex:2">
						<input type="number" class="layui-input ns-len-short" value="<?php echo htmlentities($vo['sort']); ?>" onchange="editSort('<?php echo htmlentities($vo['category_id']); ?>')" id="category_sort<?php echo htmlentities($vo['category_id']); ?>">
					</div> -->
					<div class="table_td" style="flex:2">
						<?php if($vo['is_show'] == 1): ?>是<?php else: ?>否<?php endif; ?>
					</div>
					
					<div class="table_td" style="flex:2">
						<div class="ns-table-btn">
							<a class="layui-btn" href="<?php echo addon_url('shop/goodscategory/editcategory',['category_id'=>$vo['category_id']]); ?>">编辑</a>
							<a class="layui-btn" href="javascript:deleteCategory(<?php echo htmlentities($vo['category_id']); ?>);">删除</a>
						</div>
					</div>
				</div>
				<?php if(!(empty($vo['child_list']) || (($vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator ) && $vo['child_list']->isEmpty()))): ?>
					<div class="table_two_div">
					<?php if(is_array($vo['child_list']) || $vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator): if( count($vo['child_list'])==0 ) : echo "" ;else: foreach($vo['child_list'] as $key=>$second): ?>
					<div class="table_two" data-index="<?php echo htmlentities($index); ?>" data-sort="<?php echo htmlentities($second['sort']); ?>" data-cateid="<?php echo htmlentities($second['category_id']); ?>">
					<div class="table_tr">
						<div class="table_td" style="width:30px">
							
						</div>
						<div class="table_td" style="flex:6.2">
							<div class="table_moves iconfont icontuodong"></div>
							<?php if(!(empty($second['child_list']) || (($second['child_list'] instanceof \think\Collection || $second['child_list'] instanceof \think\Paginator ) && $second['child_list']->isEmpty()))): ?>
							<span class="switch ns-text-color js-switch" data-category-id="<?php echo htmlentities($second['category_id']); ?>" data-level="<?php echo htmlentities($second['level']); ?>" data-open="0" style="padding-right: 15px;">+</span>
							<?php else: ?>
							<span class="switch ns-text-color empty_switch" >  </span>
							<?php endif; ?>
							<span><?php echo htmlentities($second['category_name']); ?></span>
						</div>
						<div class="table_td" style="flex:2"><?php echo htmlentities($vo['short_name']); ?></div>
						<div class="table_td" style="flex:2">
							<?php if(!(empty($vo['image']) || (($vo['image'] instanceof \think\Collection || $vo['image'] instanceof \think\Paginator ) && $vo['image']->isEmpty()))): ?>
							<div class="ns-img-box">
								<img layer-src src="<?php echo img($vo['image']); ?>"/>
							</div>
							<?php endif; ?>
						</div>
						<!-- <div class="table_td" style="flex:2">
							<input type="number" class="layui-input ns-len-short" value="<?php echo htmlentities($second['sort']); ?>" onchange="editSort('<?php echo htmlentities($second['category_id']); ?>')" id="category_sort<?php echo htmlentities($second['category_id']); ?>">
						</div> -->
						<div class="table_td" style="flex:2">
							<?php if($second['is_show'] == 1): ?>是<?php else: ?>否<?php endif; ?>
						</div>
						<div class="table_td" style="flex:2">
							<div class="ns-table-btn">
								<a class="layui-btn" href="<?php echo addon_url('shop/goodscategory/editcategory',['category_id'=>$second['category_id']]); ?>">编辑</a>
								<a class="layui-btn" href="javascript:deleteCategory(<?php echo htmlentities($second['category_id']); ?>);">删除</a>
							</div>
						</div>
					</div>
					<?php if(!(empty($second['child_list']) || (($second['child_list'] instanceof \think\Collection || $second['child_list'] instanceof \think\Paginator ) && $second['child_list']->isEmpty()))): ?>
						
					<div class="table_three">
						<?php if(is_array($second['child_list']) || $second['child_list'] instanceof \think\Collection || $second['child_list'] instanceof \think\Paginator): if( count($second['child_list'])==0 ) : echo "" ;else: foreach($second['child_list'] as $key=>$third): ?>
						<div class="table_tr" data-sort="<?php echo htmlentities($third['sort']); ?>" data-cateid="<?php echo htmlentities($third['category_id']); ?>">
							<div class="table_td" style="width:30px"></div>
							<div class="table_td" style="flex:6">
								<span style="padding-left: 80px;"><?php echo htmlentities($third['category_name']); ?></span>
							</div>
							<div class="table_td" style="flex:2"><?php echo htmlentities($third['short_name']); ?></div>
							<div class="table_td" style="flex:2">
								<?php if(!(empty($third['image']) || (($third['image'] instanceof \think\Collection || $third['image'] instanceof \think\Paginator ) && $third['image']->isEmpty()))): ?>
								<div class="ns-img-box">
									<img layer-src src="<?php echo img($third['image']); ?>"/>
								</div>
								<?php endif; ?>
							</div>
							<!-- <div class="table_td" style="flex:2">
								<input type="number" class="layui-input ns-len-short" value="<?php echo htmlentities($second['sort']); ?>" onchange="editSort('<?php echo htmlentities($second['category_id']); ?>')" id="category_sort<?php echo htmlentities($second['category_id']); ?>">
							</div> -->
							<div class="table_td" style="flex:2">
								<?php if($third['is_show'] == 1): ?>是<?php else: ?>否<?php endif; ?>
							</div>
							<div class="table_td" style="flex:2">
								<div class="ns-table-btn">
									<a class="layui-btn" href="<?php echo addon_url('admin/goodscategory/editcategory',['category_id'=>$third['category_id']]); ?>">编辑</a>
									<a class="layui-btn" href="javascript:deleteCategory(<?php echo htmlentities($third['category_id']); ?>);">删除</a>
								</div>
							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						
					</div>
					<?php endif; ?>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				<?php endif; ?>
			</div>
			
			<?php endforeach; endif; else: echo "" ;endif; else: ?>
			<div class="table_tr">
				<div class="table_td" style="flex:1;text-align: center;">暂无数据</div>
			</div>
			<?php endif; ?>
		</div>
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


<script src="https://ls.chnssl.com/public/static/ext/drag-arrange.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/ddsort.js"></script>
<script>
	$(function() {
		var tempPos = '';
		$('.table_one').arrangeable({
			dragSelector: '.table_move',
			callback:function(e){
				var temparr = [];
				$('.table_one').each(function(index,item){
					var tempObj = {};
					tempObj.category_id = item.getAttribute('data-cateid');
					tempObj.sort = index;
					temparr.push(tempObj)
				});
				setTimeout(function(){
					$.ajax({
						url: ns.url("shop/goodscategory/modifySort"),
						data: {category_sort_array : JSON.stringify(temparr)},
						dataType: 'JSON',
						type: 'POST',
						async: false,
						success: function (res) {
							layer.msg(res.message);
						}
					});
				},100);
			}
		});
		$('.table_two').arrangeable({
			dragSelector: '.table_moves',
			callback:function(e){
				var temparrs = [];
				$('.table_two').each(function(index,item){
					var tempObjs = {};
					tempObjs.category_id = item.getAttribute('data-cateid');
					tempObjs.sort = index;
					temparrs.push(tempObjs)
				})
				console.log(temparrs);
				setTimeout(function(){
					$.ajax({
						url: ns.url("shop/goodscategory/modifySort"),
						data: {category_sort_array : JSON.stringify(temparrs)},
						dataType: 'JSON',
						type: 'POST',
						async: false,
						success: function (res) {
							layer.msg(res.message);
						}
					});
				},100);
			}
		});
		$('.table_three_tr').arrangeable({
			dragSelector: '.tables_move',
			callback:function(e){
				var temparres = [];
				$('.table_three_tr').each(function(index,item){
					var tempObjes = {};
					tempObjes.category_id = item.getAttribute('data-cateid');
					tempObjes.sort = index;
					temparres.push(tempObjes)
				})
				console.log(temparres);
				setTimeout(function(){
					$.ajax({
						url: ns.url("shop/goodscategory/modifySort"),
						data: {category_sort_array : JSON.stringify(temparres)},
						dataType: 'JSON',
						type: 'POST',
						async: false,
						success: function (res) {
							layer.msg(res.message);
						}
					});
				},100);
			}
		});
	});

$(function () {
	loadImgMagnify();  //图片放大
	
	//展开收齐点击事件
	$(".js-switch").click(function () {
		var category_id = $(this).attr("data-category-id");
		var level = $(this).attr("data-level");
		var open = parseInt($(this).attr("data-open").toString());
		if(open){
			$(".goods-category-list .layui-table tr[data-category-id-"+ level+"='" + category_id + "']").hide();
			// $(this).children("img").removeClass('rotate');
			$(this).text("+");
			if(level == 1) $(this).parents('.table_tr').siblings('.table_two_div').hide();
			else if(level == 2) $(this).parents('.table_tr').siblings('.table_three').hide();
			
		}else{
			$(".goods-category-list .layui-table tr[data-category-id-"+ level+"='" + category_id + "']").show();
			$(this).text("-");
			// $(this).children("img").addClass('rotate');
			if(level == 1) $(this).parents('.table_tr').siblings('.table_two_div').show();
			else if(level == 2) $(this).parents('.table_tr').siblings('.table_three').show();
			
		}
		$(this).attr("data-open", (open ? 0 : 1));
		
	});
});

// var tempPos = '';
// bindDragSort('.table_body' ,'.table_one');
// bindDragSort('.table_two_div' ,'.table_two');
// bindDragSort('.table_three' ,'.table_tr');
// function bindDragSort(paremtElem,childElem){
// 	$(paremtElem ).DDSort({
// 	    target: childElem,
// 	    floatStyle: {
// 	        'border': '1px solid #ccc',
// 	        'background-color': '#fff'
// 	    },
// 		down:function(e){
// 			tempPos = $(this).data('sort');
// 		},
// 		up:function(e){
// 			var index = $(this).index(),self = $(this);
// 			if(index != tempPos){
// 				var temparr = [];
// 				$(childElem).each(function(index,item){
// 					var tempObj = {};
// 					tempObj.category_id = item.getAttribute('data-cateid');
// 					tempObj.sort = index;
// 					temparr.push(tempObj)
// 				});
// 				setTimeout(function(){
// 					$.ajax({
// 						url: ns.url("shop/goodscategory/modifySort"),
// 						data: {category_sort_array : JSON.stringify(temparr)},
// 						dataType: 'JSON',
// 						type: 'POST',
// 						async: false,
// 						success: function (res) {
// 							self.data('sort',index);
// 							layer.msg(res.message);
// 						}
// 					});
// 				},100);
// 			}
//
// 		}
// 	});
// }

function deleteCategory(category_id) {
	
	layer.confirm('子级分类也会删除，请谨慎操作', function() {
		$.ajax({
			url: ns.url("shop/goodscategory/deleteCategory"),
			data: {category_id : category_id},
			dataType: 'json',
			type: 'post',
			async: false,
			success: function (res) {
				layer.msg(res.message);
				if (res.code == 0) {
					location.reload();
				}
			}
		});
	});
}
function addCategory() {
	location.href = ns.url("shop/goodscategory/addcategory");
}

// 监听单元格编辑
function editSort(id, event) {
    var data = $(event).val();
    if (!new RegExp("^-?[1-9]\\d*$").test(data)) {
        layer.msg("排序号只能是整数");
        return;
    }
    if(data<0){
        layer.msg("排序号必须大于0");
        return ;
    }
    $.ajax({
        type: 'POST',
        url: ns.url("shop/goodscategory/editCategorySort"),
        data: {
            sort: data,
            category_id: id
        },
        dataType: 'JSON',
        success: function(res) {
            layer.msg(res.message);
            if (res.code == 0) {
                table.reload();
            }
        }
    });
}

</script>

</body>

</html>