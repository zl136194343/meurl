<?php /*a:2:{s:70:"/www/wwwroot/ls.chnssl.com/addon/fenxiao/shop/view/fenxiao/config.html";i:1658475966;s:23:"app/shop/view/base.html";i:1654828558;}*/ ?>
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
	
<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/shop/view/public/css/goods_edit.css" />
<style>
	.good-name, .good-price {
		line-height: 34px;
	}
	
	@media screen and (min-width: 1514px) {
		.ns-len-short {width: 80px!important;}
	}
	@media screen and (max-width: 1513px) {
		.ns-len-short {width: 58px!important;}
	}
	#rule_list .layui-input {display: inline-block;}
	.layui-table[lay-size=lg] td, .layui-table[lay-size=lg] th {padding: 15px;}
	.ns-align-right {text-align: right;}
	.ns-line-height {height: 45px; line-height: 45px;}
	input[disabled] {background-color: #F5F5F5;}
	.layui-input {
		display: inline-block;
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
			
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>分销商层级与后台配置有关，最多三级分销。</li>
			<li>分销商等级与分销商的分销订单数，分销订单总额，自购订单数，自购订单总额，分销商下线人数，分销商的下级分销商人数有关。</li>
			<li>商品分销总佣金不得超过商品实际价格的50%。</li>
			<li>分销佣金是根据当前分销订单所属分销商等级或者商品自定义的计算规则进行结算。</li>
			<li>分销结算说明： A 、B 、C是分销商，C的上级为B，B的上级为A。
				分佣按照所属分销商的等级佣金比率进行分配，分销商C的等级分佣比率为一级10%，二级5%，三级2%，
				订单属于分销商C，则C获得商品实付金额10%，B获得商品实付金额5%，A获得商品实付金额2%。
				若C推荐的普通用户D购买商品，则该订单属于C；若C购买商品，则该订单属于C。</li>
		</ul>
	</div>
</div>

<div class="layui-form">
	<div class="layui-card ns-card-common">
		<div class="layui-card-header">
			<span class="ns-card-title">商品信息</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item goods-image-wrap">
				<label class="layui-form-label">商品图片：</label>
				<div class="layui-input-block">
					<!--商品主图项-->
					<div class="js-goods-image"><img layer-src src="<?php echo img($goods_info['goods_image']); ?>" width = "50px"/></div>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">商品名称：</label>
				<div class="layui-input-inline good-name"><?php echo htmlentities($goods_info['goods_name']); ?></div>
			</div>
		</div>
	</div>

	<div class="layui-card ns-card-common">
		<div class="layui-card-header">
			<span class="ns-card-title">佣金设置</span>
		</div>
		
		<div class="layui-card-body">
			<div class="layui-form-item goods-image-wrap">
				<label class="layui-form-label">是否参与分销：</label>
				<div class="layui-input-block">
					<input type="radio" name="is_fenxiao" value="1" title="参与" lay-filter="is_fenxiao" <?php if($goods_info['is_fenxiao'] == 1): ?>checked<?php endif; ?>>
					<input type="radio" name="is_fenxiao" value="0" title="不参与" lay-filter="is_fenxiao" <?php if($goods_info['is_fenxiao'] == 0): ?>checked<?php endif; ?>>
				</div>
			</div>

			<!--<div class="layui-form-item goods-image-wrap <?php if($goods_info['is_fenxiao'] == 0): ?>layui-hide<?php endif; ?>" id="fenxiao_price">
				<label class="layui-form-label">分销计算价格：</label>
				<div class="layui-input-block">
					<table class="layui-table" lay-skin="line">
						<thead>
						<colgroup>
							<col width="40%">
							<col width="20%">
							<col width="20%">
							<col width="20%">
						</colgroup>
						<tr>
							<th>商品规格</th>
							<th>销售价</th>
							<th>成本价</th>
							<th class="ns-align-center">分销计算价</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($goods_info['sku_data'] as $sku): ?>
						<tr>
							<td>
								<div class="ns-line-hiding ns-line-height">
									<?php echo htmlentities($sku['sku_name']); ?>
								</div>
							</td>
							<td><?php echo htmlentities($sku['discount_price']); ?></td>
							<td><?php echo htmlentities($sku['cost_price']); ?></td>
							<td class="ns-align-center">
								<input type="number" name="fenxiao_price[<?php echo htmlentities($sku['sku_id']); ?>]" class="layui-input ns-len-short ns-input-rate" value="<?php echo htmlentities($sku['fenxiao_price']); ?>"> 元
							</td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<div class="ns-word-aux">
					<p>未设置分销计算价以该商品实付金额来计算佣金，设置后以该价格来计算佣金。</p>
				</div>
			</div>-->

			<div class="layui-form-item <?php if($goods_info['is_fenxiao'] == 0): ?>layui-hide<?php endif; ?>" id="fenxiao_type">
				<label class="layui-form-label">佣金规则：</label>
				<div class="layui-input-inline good-name">
					<input type="radio" name="fenxiao_type" value="1" title="默认规则" lay-filter="fenxiao_type" <?php if($goods_info['fenxiao_type'] == 1): ?>checked<?php endif; ?>>
					<input type="radio" name="fenxiao_type" value="2" title="单独设置" lay-filter="fenxiao_type" <?php if($goods_info['fenxiao_type'] == 2): ?>checked<?php endif; ?>>
				</div>
			</div>
			
			<div class="layui-form-item" id="default_rule" <?php if($goods_info['fenxiao_type'] == 2): ?> style="display:none" <?php endif; ?>>
				<label class="layui-form-label"></label>
				<div class="layui-input-block">
					<table class="layui-table" id="default_rule_list" lay-skin="line" lay-size="lg">
						<colgroup>
							<col width="25%">
							<col width="25%">
							<?php if($fenxiao_config['level'] >= 2): ?>
							<col width="25%">
							<?php endif; if($fenxiao_config['level'] >= 3): ?>
							<col width="25%">
							<?php endif; ?>
						</colgroup>
						<thead>
							<tr>
								<th>默认规则</th>
								<th>平台分销员比例</th>
								<!--<?php if($fenxiao_config['level'] >= 2): ?>
								<th>二级佣金比例</th>
								<?php endif; if($fenxiao_config['level'] >= 3): ?>
								<th>三级佣金比例</th>
								<?php endif; ?>-->
							</tr>
						</thead>
						<tbody>
							<?php foreach($fenxiao_level as $level): ?>
							<tr>
								<td><?php echo htmlentities($level['level_name']); ?></td>
								<td><?php echo htmlentities($level['one_rate']); ?>%</td>
							<!--	<?php if($fenxiao_config['level'] >= 2): ?>
								<td><?php echo htmlentities($level['two_rate']); ?>%</td>
								<?php endif; if($fenxiao_config['level'] >= 3): ?>
								<td><?php echo htmlentities($level['three_rate']); ?>%</td>
								<?php endif; ?>-->
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
				
			<div class="layui-form-item" id="personal_rule" <?php if($goods_info['fenxiao_type'] == 1): ?> style="display:none" <?php endif; ?>>
				<label class="layui-form-label"></label>
				<div class="layui-input-block">
					<table class="layui-table" id="rule_list" lay-skin="line" lay-size="lg">
						<colgroup>
							<col width="15%">
							<col width="10%">
							<col width="9%">
							<col width="22%">
						<!--	<?php if($fenxiao_config['level'] >= 2): ?>
							<col width="20%">
							<?php endif; if($fenxiao_config['level'] >= 3): ?>
							<col width="20%">
							<?php endif; ?>-->
						</colgroup>
						<thead>
							<tr>
								<th>商品规格</th>
								<th><p class="ns-align-right">价格</p></th>
								<th><p class="ns-line-hiding" title="分销商等级名称">分销商等级名称</p></th>
								<th>平台分销员佣金比例</th>
								<!--<?php if($fenxiao_config['level'] >= 2): ?>
								<th>二级佣金比例</th>
								<?php endif; if($fenxiao_config['level'] >= 3): ?>
								<th>三级佣金比例</th>
								<?php endif; ?>-->
							</tr>
						</thead>
						<tbody>
							<?php foreach($fenxiao_level as $level): ?>
							<tr>
								<?php foreach($goods_info['sku_data'] as $sku): ?>
								<input name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][sku_id][]" value="<?php echo htmlentities($sku['sku_id']); ?>" hidden />
								<input name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][sku_price][]" value="<?php echo htmlentities($sku['price']); ?>" hidden />
								<?php endforeach; ?>
								<td>
									<?php foreach($goods_info['sku_data'] as $sku): ?>
									<p class="ns-line-hiding ns-line-height" title="<?php echo htmlentities($sku['sku_name']); ?>"><?php echo htmlentities($sku['sku_name']); ?></p>
									<?php endforeach; ?>
								</td>
								<td>
									<?php foreach($goods_info['sku_data'] as $sku): ?>
									<p class="ns-align-right ns-line-height" title="￥<?php echo htmlentities($sku['price']); ?>">￥<?php echo htmlentities($sku['price']); ?></p>
									<?php endforeach; ?>
								</td>
								<td><?php echo htmlentities($level['level_name']); ?></td>
								<td>
									<?php foreach($goods_info['sku_data'] as $sku): ?>
									<div class="ns-line-height">
										<input class="layui-input ns-len-short ns-input-rate" type="number" min="0" max="100" lay-verify="required|flnum" name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][one_rate][]" value="<?php echo !empty($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['one_rate']) ? htmlentities($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['one_rate']) : ''; ?>"> %&nbsp;&nbsp;或
										<input class="layui-input ns-len-short ns-input-num" type="number" min="0" lay-verify="required|flnum" name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][one_money][]" value="<?php echo !empty($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['one_money']) ? htmlentities($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['one_money']) : ''; ?>"> 元
									</div>
									<?php endforeach; ?>
								</td>
<!--								<?php if($fenxiao_config['level'] >= 2): ?>
								<td>
									<?php foreach($goods_info['sku_data'] as $sku): ?>
									<div class="ns-line-height">
										<input class="layui-input ns-len-short ns-input-rate" type="number" min="0" max="100" lay-verify="required|flnum" name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][two_rate][]" value="<?php echo !empty($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['two_rate']) ? htmlentities($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['two_rate']) : ''; ?>"> %&nbsp;&nbsp;或
										<input class="layui-input ns-len-short ns-input-num" type="number" min="0" lay-verify="required|flnum" name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][two_money][]"  value="<?php echo !empty($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['two_money']) ? htmlentities($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['two_money']) : ''; ?>"> 元
									</div>
									<?php endforeach; ?>
								</td>
								<?php endif; if($fenxiao_config['level'] >= 3): ?>
								<td>
									<?php foreach($goods_info['sku_data'] as $sku): ?>
									<div class="ns-line-height">
										<input class="layui-input ns-len-short ns-input-rate" type="number" min="0" max="100" lay-verify="required|flnum" name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][three_rate][]" value="<?php echo !empty($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['three_rate']) ? htmlentities($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['three_rate']) : ''; ?>"> %&nbsp;&nbsp;或
										<input class="layui-input ns-len-short ns-input-num" type="number" min="0" lay-verify="required|flnum" name="fenxiao[<?php echo htmlentities($level['level_id']); ?>][three_money][]" value="<?php echo !empty($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['three_money']) ? htmlentities($goods_info['fenxiao_skus'][$level['level_id'] . '_' . $sku['sku_id']]['three_money']) : ''; ?>"> 元
									</div>
									<?php endforeach; ?>
								</td>
								<?php endif; ?>-->
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ns-single-filter-box">
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>
		<input type="hidden" name="goods_id" value="<?php echo htmlentities($goods_info['goods_id']); ?>" />
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
	var goods_id = "";
	var fenxiao_type = <?php echo htmlentities($goods_info['fenxiao_type']); ?>;
	if (fenxiao_type == 1) {
		$(".layui-input").removeAttr("lay-verify");
	}
	layui.use(['form', 'laydate'], function() {
		var form = layui.form,
			laydate = layui.laydate,
			repeat_flag = false;

		form.render();

		$(".layui-input").each(function() {
			$(this).on('input', function(){
				var _this = $(this);
				if(_this.val() > 0){
					$(this).siblings().val('0.00');
					// $(this).siblings().attr('disabled', true);
					$(this).siblings().removeAttr("lay-verify");
				} else {
					// $(this).siblings().attr('disabled', false);
					$(this).siblings().attr("lay-verify", "required|flnum");
				}
			});
		});

		// 是否参与分销 is_fenxiao
        form.on("radio(is_fenxiao)", function (data) {
            if (data.value == 1) {
                $("#fenxiao_type,#fenxiao_price,#default_rule").removeClass("layui-hide");
                $(".layui-input").removeAttr("lay-verify");
            } else {
                $("#fenxiao_type,#fenxiao_price,#default_rule").addClass("layui-hide");
                $(".layui-input").attr("lay-verify", "required|flnum");
            }
        });

		//佣金规则
		form.on("radio(fenxiao_type)", function (data) {
			if (data.value == 1) {
				$("#default_rule").show();
				$("#personal_rule").hide();
				$(".layui-input").removeAttr("lay-verify");
			} else {
				$(".layui-input").attr("lay-verify", "required|flnum");
				$("#default_rule").hide();
				$("#personal_rule").show();
			}
		});

		/**
		 * 表单提交
		 */
		form.on('submit(save)', function(data){
			if(repeat_flag) return;
			repeat_flag = true;
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: ns.url("fenxiao://shop/fenxiao/config"),
				data: data.field,
				async: false,
				success: function(res){
					repeat_flag = false;
					if (res.code == 0) {
						layer.msg('操作成功');
						location.reload();
					}else{
						layer.msg(res.message);
					}
				}
			})
		});
		
		/**
		 * 表单验证
		 */
		form.verify({
			required: function (value) {
				if (value.trim() == '' || value < 0) {
					return '佣金比例不能为空，且必须大于0!';
				}
			},
			flnum: function (value) {
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}
				if (val.length > 2) {
					return "佣金比例最多可保留两位小数";
				}
			}
		});
	});
	
	function back() {
		location.href = ns.url("fenxiao://shop/fenxiao/lists");
	}
</script>

</body>

</html>