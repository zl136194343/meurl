<?php /*a:2:{s:57:"/www/wwwroot/ls.chnssl.com/app/shop/view/index/index.html";i:1661854063;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/index.css">
<style>
	.btn_label{padding: 2px;border: 1px solid #ff8143;border-radius: 2px;color: #ff8143;font-size: 12px;line-height: 12px;float:left;text-overflow: ellipsis;max-width:100px;overflow: hidden;white-space: nowrap;margin:5px 5px 0 0;}
	.btn_label:nth-child(2){margin:5px 5px 0 10px;}
	.white_box{clear:both;}
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
				<?php endif; if(isset($shop['is_reopen']) && $shop['is_reopen']  == 3): ?>
<div class="expire-hint">
	<div class="expire-logo">
		<img src="https://ls.chnssl.com/app/shop/view/public/img/warning.png" >
	</div>
	<div class="expire-center">
		<h3>
			<?php if($shop_info['shop_status'] == 0): ?>
				店铺已暂停服务，无法正常营业
			<?php else: ?>
				店铺已经过期，请尽快续费
			<?php endif; if($shop['cert_id'] == 0): ?>
			<a class="ns-text-color shop_auth_apply layui-btn-radius">立即认证</a>
			<?php else: if($is_reopen == 1): ?>
				<a class="ns-text-color reopen_apply layui-btn-radius">立即续费</a>
				<?php else: ?>
				<a class="ns-text-color reopen_apply_detail layui-btn-radius">立即续费</a>
				<?php endif; ?>
			<?php endif; ?>
		</h3>
		<p><span class="ns-red-color">剩余0天</span>（已到期）<span> 咨询电话：<?php echo htmlentities($website_info['web_phone']); ?></span></p>
	</div>
</div>
<?php elseif(isset($shop['is_reopen']) && $shop['is_reopen'] == 2): ?>
<div class="expire-hint">
	<div class="expire-logo">
		<img src="https://ls.chnssl.com/app/shop/view/public/img/warning.png" >
	</div>
	<div class="expire-center">
		<h3>店铺即将到期，请尽快续费
			<?php if($shop['cert_id'] == 0): ?>
			<a class="ns-text-color shop_auth_apply layui-btn-radius">立即认证</a>
			<?php else: if($is_reopen == 1): ?>
				<a class="ns-text-color reopen_apply layui-btn-radius">立即续费</a>
				<?php else: ?>
				<a class="ns-text-color reopen_apply_detail layui-btn-radius">立即续费</a>
				<?php endif; ?>
			<?php endif; ?>
		</h3>
		<p><span class="ns-red-color">剩余<?php echo htmlentities($shop['expires_date']); ?>天</span> <span> 咨询电话：<?php echo htmlentities($website_info['web_phone']); ?></span></p>
	</div>
</div>
<?php endif; ?>
<div class="ns-survey">
	<div class="ns-survey-left">
		<div class="ns-survey-item">
			<!-- 商家信息 -->
			<div class="ns-survey-shop">
				<div class="ns-item-pic">
					<?php if(!empty($shop['avatar'])): ?>
					<img layer-src src="<?php echo img($shop['avatar']); ?>" class="img_size"/>
					<?php else: ?>
					<img layer-src src="<?php echo img($default_img['default_shop_img']); ?>" class="img_size"/>
					<?php endif; ?>
				</div>

				<div class="ns-surver-shop-detail">
					<div>
						<div class="ns-survey-shop-name"><?php echo htmlentities($shop['site_name']); ?></div>
						<div class="btn_label"><?php echo htmlentities($shop['group_name']); ?></div>
						<?php if($shop['cert_id'] == 0): ?>
						<a href="<?php echo url('shop/cert/index'); ?>" class="ns-text-color-dark-gray ns-red-color btn_label">未认证</a>
						<?php else: ?>
						<div class="btn_label">已认证</div>
						<?php endif; ?>
						<div class="white_box"></div>
					</div>

					<p>主营行业：<span class="ns-text-color-dark-gray"><?php echo htmlentities($shop['category_name']); ?></span></p>
					<p>店铺状态：
						<span class="ns-text-color-dark-gray">
						<?php if($shop['shop_status'] == 1): ?>
							<span class="ns-text-color-dark-gray">正常</span>
						<?php else: ?>
							<span class="ns-text-color-dark-gray ns-red-color">关闭</span>
						<?php endif; ?>
						</span>
					</p>
					<p>到期时间：<span class="ns-text-color-dark-gray">
						<?php if($shop['expire_time'] == 0): ?>
						永久
						<?php else:  echo date("Y-m-d", $shop['expire_time']); ?>
						<?php endif; ?>
						</span>
					</p>
				</div>
			</div>
			<div class="num_block">
				<div class="num_box" onclick="location.href='<?php echo addon_url('shop/order/lists'); ?>#!order_status=0'">
					<div class="num_box_text">待付款订单</div>
					<div class="num_box_num"><?php echo htmlentities($num_data['waitpay']); ?></div>
				</div>
				<div class="num_box" onclick="location.href='<?php echo addon_url('shop/delivery/lists'); ?>'">
					<div class="num_box_text">待发货订单</div>
					<div class="num_box_num"><?php echo htmlentities($num_data['waitsend']); ?></div>
				</div>
				<div class="num_box" onclick="location.href='<?php echo addon_url('shop/orderrefund/lists'); ?>'">
					<div class="num_box_text">退款中订单</div>
					<div class="num_box_num"><?php echo htmlentities($num_data['refund']); ?></div>
				</div>
				<div class="num_box" onclick="location.href='<?php echo addon_url('shop/goods/lists'); ?>'">
					<div class="num_box_text">库存预警</div>
					<div class="num_box_num"><?php echo htmlentities($num_data['goods_stock_alarm']); ?></div>
				</div>
				<div class="num_box" onclick="location.href='<?php echo addon_url('shop/goods/lists'); ?>'">
					<div class="num_box_text">商品待审核</div>
					<div class="num_box_num"><?php echo htmlentities($num_data['wait_audit_count']); ?></div>
				</div>
				<div class="num_box" onclick="location.href='<?php echo addon_url('shop/goods/lists'); ?>'">
					<div class="num_box_text">商品违规下架</div>
					<div class="num_box_num"><?php echo htmlentities($num_data['audit_refuse_count']); ?></div>
				</div>
			</div>
		</div>
		<!-- 今日统计 -->
		<div class="layui-card ns-survey-info ns-card-common today_box">
			<div class="layui-card-body">
				<div class="ns-survey-detail-con">
					<p class="ns-survey-detail-aco">今日订单数</p>
					<div class="ns-survey-line"></div>
					<div class="ns-survey-bottom">
						<p class="ns-survey-detail-num ns-text-color"><?php echo htmlentities($stat_day['order_pay_count']); ?></p>
						<div class="ns-survey-detail-rate">
							<?php 
							$t = $stat_day['order_pay_count'];
							$y = $stat_yesterday['order_pay_count'];
							 ?>
							<div>日同比 <span><?php echo $t>$y ? '+'  :  ''; ?><?php echo htmlentities($day_rate['order_pay_count']); ?></span><i class="layui-icon layui-icon-triangle-d <?php echo $t>$y ? 'layui-icon-increase ns-text-color'  : htmlentities($t == $y ? 'is-null' : ''); ?>"></i></div>
							<div>昨日订单数 <span><?php echo htmlentities($stat_yesterday['order_pay_count']); ?> </span></div>
							<!--<i class="layui-icon layui-icon-triangle-d"></i>-->
						</div>
						<div class="ns-survey-detail-split"></div>
						<div class="ns-survey-line"></div>
						<div class="ns-survey-detail-total">
							<span>订单总数</span>
							<span><?php echo htmlentities($shop_stat_sum['order_pay_count']); ?></span>
						</div>
						<!-- <p class="ns-survey-detail-yesterday">昨日：<?php if(isset($stat_yesterday['order_total'])): ?><?php echo htmlentities($stat_yesterday['order_total']); else: ?> 0.00 <?php endif; ?></p> -->
						<div class="title ns-prompt-block">
							<div class="ns-prompt">
								<button class="layui-btn layui-btn-primary ns-text-color ns-border-color ns-survey-yesterday-btn">昨日</button>
								<div class="ns-prompt-box">
									<div class="ns-prompt-con">
										订单数：<?php echo htmlentities($stat_yesterday['order_pay_count']); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="ns-survey-detail-con">
					<p class="ns-survey-detail-aco">今日销售额(元)</p>
					<div class="ns-survey-line"></div>
					<div class="ns-survey-bottom">
						<p class="ns-survey-detail-num ns-text-color"><?php if(isset($stat_day['order_total'])): ?><?php echo htmlentities($stat_day['order_total']); else: ?> 0.00 <?php endif; ?></p>
						<div class="ns-survey-detail-rate">
							<?php 
							$t = $stat_day['order_total'];
							$y = $stat_yesterday['order_total'];
							 ?>
							<div>日同比 <span><?php echo $t>$y ? '+'  :  ''; ?><?php echo htmlentities($day_rate['order_total']); ?></span><i class="layui-icon layui-icon-triangle-d <?php echo $t>$y ? 'layui-icon-increase ns-text-color'  : htmlentities($t == $y ? 'is-null' : ''); ?>"></i></div>
							<div>昨日销售额(元) <span><?php echo htmlentities($stat_yesterday['order_total']); ?> </span>
								<!--<i class="layui-icon layui-icon-triangle-d"></i>-->
							</div>
						</div>
						<div class="ns-survey-detail-split"></div>
						<div class="ns-survey-line"></div>
						<div class="ns-survey-detail-total">
							<span>销售总额</span>
							<span><?php echo htmlentities($shop_stat_sum['order_total']); ?></span>
						</div>
						<!-- <p class="ns-survey-detail-yesterday">昨日：<?php if(isset($stat_yesterday['order_total'])): ?><?php echo htmlentities($stat_yesterday['order_total']); else: ?> 0.00 <?php endif; ?></p> -->
						<div class="title ns-prompt-block">
							<div class="ns-prompt">
								<button class="layui-btn layui-btn-primary ns-text-color ns-border-color ns-survey-yesterday-btn">昨日</button>
								<div class="ns-prompt-box">
									<div class="ns-prompt-con">销售额： <?php if(isset($stat_yesterday['order_total'])): ?><?php echo htmlentities($stat_yesterday['order_total']); else: ?> 0.00 <?php endif; ?>元</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="ns-survey-detail-con">
					<p class="ns-survey-detail-aco">今日新增店铺收藏数</p>
					<div class="ns-survey-line"></div>
					<div class="ns-survey-bottom">
						<p class="ns-survey-detail-num ns-text-color"><?php echo htmlentities($stat_day['collect_shop']); ?></p>
						<div class="ns-survey-detail-rate">
							<?php 
							$t = $stat_day['collect_shop'];
							$y = $stat_yesterday['collect_shop'];
							 ?>
							<div>日同比 <span><?php echo $t>$y ? '+'  :  ''; ?><?php echo htmlentities($day_rate['collect_shop']); ?></span><i class="layui-icon layui-icon-triangle-d <?php echo $t>$y ? 'layui-icon-increase ns-text-color'  : htmlentities($t == $y ? 'is-null' : ''); ?>"></i></div>
							<div>昨日新增店铺收藏数 <span><?php echo htmlentities($stat_yesterday['collect_shop']); ?> </span></div>
						</div>
						<div class="ns-survey-detail-split"></div>
						<div class="ns-survey-line"></div>
						<div class="ns-survey-detail-total">
							<span>店铺收藏总数</span>
							<span><?php echo htmlentities($shop_stat_sum['collect_shop']); ?></span>
						</div>
						<div class="title ns-prompt-block">
							<div class="ns-prompt">
								<button class="layui-btn layui-btn-primary ns-text-color ns-border-color ns-survey-yesterday-btn">昨日</button>
								<div class="ns-prompt-box">
									<div class="ns-prompt-con">店铺收藏数：<?php if(isset($stat_yesterday['collect_shop'])): ?><?php echo htmlentities($stat_yesterday['collect_shop']); else: ?> 0 <?php endif; ?></div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="ns-survey-detail-con">
					<p class="ns-survey-detail-aco">今日浏览量</p>
					<div class="ns-survey-line"></div>
					<div class="ns-survey-bottom">
						<p class="ns-survey-detail-num ns-text-color"><?php echo htmlentities($stat_day['visit_count']); ?></p>
						<div class="ns-survey-detail-rate">
							<?php 
							$t = $stat_day['visit_count'];
							$y = $stat_yesterday['visit_count'];
							 ?>
							<div>日同比 <span><?php echo $t>$y ? '+'  :  ''; ?><?php echo htmlentities($day_rate['visit_count']); ?></span><i class="layui-icon layui-icon-triangle-d <?php echo $t>$y ? 'layui-icon-increase ns-text-color'  : htmlentities($t == $y ? 'is-null' : ''); ?>"></i></div>
							<div>昨日浏览量 <span><?php echo htmlentities($stat_yesterday['visit_count']); ?></span>
								<!--<i class="layui-icon layui-icon-triangle-d"></i>-->
							</div>
						</div>
						<div class="ns-survey-detail-split"></div>
						<div class="ns-survey-line"></div>
						<div class="ns-survey-detail-total">
							<span>总浏览量</span>
							<span><?php echo htmlentities($shop_stat_sum['visit_count']); ?></span>
						</div>
						<div class="title ns-prompt-block">
							<div class="ns-prompt">
								<button class="layui-btn layui-btn-primary ns-text-color ns-border-color ns-survey-yesterday-btn">昨日</button>
								<div class="ns-prompt-box">
									<div class="ns-prompt-con">
										浏览量：<?php if(isset($stat_yesterday['visit_count'])): ?><?php echo htmlentities($stat_yesterday['visit_count']); else: ?> 0 <?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
		<!--统计图-->
		<div class="echarts-wrap">
			<div class="echarts-order f_box_border">
				<h5>近十天订单数(个)</h5>
				<div id="order"></div>
			</div>

			<div class="echarts-money f_box_border">
				<h5>销售额(元)</h5>
				<div id="money"></div>
			</div>
		</div>
        <!-- 常用功能 -->
        <div class="layui-card ns-card-common">
            <div class="layui-card-header layui-card-headers">
                <div>
                    <span class="ns-card-title"><strong>常用功能</strong></span>
                    <span class="ns-card-sub">更新时间：<?php echo htmlentities($today); ?></span>
                </div>
            </div>

			<div class="layui-card-body layui-card-bodys">
				<div class="ns-item-block-parent">
					<a class="ns-item-block ns-item-block-hover-a" href="<?php echo url('shop/goods/addgoods'); ?>">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="https://ls.chnssl.com/app/shop/view/public/img/menu_icon/issue_good.png">
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title">发布商品</div>
								<p class="ns-item-content-desc">发布实物商品</p>
							</div>
						</div>
					</a>
					<a class="ns-item-block ns-item-block-hover-a" href="<?php echo url('shop/order/lists'); ?>">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="https://ls.chnssl.com/app/shop/view/public/img/menu_icon/order_select.png">
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title">订单查询</div>
								<p class="ns-item-content-desc">查询系统普通订单</p>
							</div>
						</div>
					</a>
					<a class="ns-item-block ns-item-block-hover-a" href="<?php echo url('shop/diy/index'); ?>">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="https://ls.chnssl.com/app/shop/view/public/img/menu_icon/page_decoration.png">
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title">页面装修</div>
								<p class="ns-item-content-desc">主页面进行装修</p>
							</div>
						</div>
					</a>
					<a class="ns-item-block ns-item-block-hover-a" href="<?php echo url('shop/account/reopenlist'); ?>">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="https://ls.chnssl.com/app/shop/view/public/img/menu_icon/shop_apply.png">
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title">店铺续签</div>
								<p class="ns-item-content-desc">店铺续签管理</p>
							</div>
						</div>
					</a>
				</div>
			</div>
        </div>

		<!-- 插件 -->
		<div class="addon-tool">

			<!-- 插件 -->
			<div class="layui-card ns-card-common">
				<?php if($count['shopcount']!=0): ?>
				<div class="layui-card-header layui-card-headers">
					<div>
						<span class="ns-card-title">营销活动</span>
						<a class="ns-text-color" href="<?php echo addon_url('shop/promotion/index'); ?>">更多</a>
					</div>
				</div>
				<?php endif; ?>
				<div class="layui-card-body layui-card-bodys">
					<div class="ns-item-block-parent addon_block">
						<?php  $num = 0;  foreach($promotion as $list_k => $list_v): if(empty($list_v['is_developing']) || (($list_v['is_developing'] instanceof \think\Collection || $list_v['is_developing'] instanceof \think\Paginator ) && $list_v['is_developing']->isEmpty())): if(in_array($list_v['show_type'],['shop','member']) && $num <5):  $num++; ?>
						<a class="addon-tool-item" <?php if(empty($list_v['is_developing']) || (($list_v['is_developing'] instanceof \think\Collection || $list_v['is_developing'] instanceof \think\Paginator ) && $list_v['is_developing']->isEmpty())): ?> href="<?php echo addon_url($list_v['url']); ?>" <?php endif; ?>>
							<div class="ns-item-block-wrap">
								<div class="ns-item-pic">
									<img src="<?php echo img($list_v['icon']); ?>">
								</div>
								<div class="ns-item-con">
									<div class="ns-item-content-title"><?php echo htmlentities($list_v['title']); ?></div>
									<p class="ns-item-content-desc ns-line-hiding" title="<?php echo htmlentities($list_v['description']); ?>"><?php echo htmlentities($list_v['description']); ?></p>
								</div>
							</div>
						</a>
						<?php endif; ?>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<div class="layui-card ns-card-common">
				<?php if($count['toolcount']!=0): ?>
				<div class="layui-card-header layui-card-headers">
					<div>
						<span class="ns-card-title">应用工具</span>
						<a class="ns-text-color" href="<?php echo addon_url('shop/promotion/tool'); ?>">更多</a>
					</div>
				</div>
				<?php endif; ?>
				<div class="layui-card-body layui-card-bodys">
					<div class="ns-item-block-parent addon_block">
						<?php  $tool_num = 0;  foreach($promotion as $list_k => $list_v): if(empty($list_v['is_developing']) || (($list_v['is_developing'] instanceof \think\Collection || $list_v['is_developing'] instanceof \think\Paginator ) && $list_v['is_developing']->isEmpty())): if($list_v['show_type'] == 'tool' && $tool_num < 5):  $tool_num++;  ?>
						<a class="addon-tool-item" <?php if(empty($list_v['is_developing']) || (($list_v['is_developing'] instanceof \think\Collection || $list_v['is_developing'] instanceof \think\Paginator ) && $list_v['is_developing']->isEmpty())): ?> href="<?php echo addon_url($list_v['url']); ?>" <?php endif; ?>>
							<div class="ns-item-block-wrap">
								<div class="ns-item-pic">
									<img src="<?php echo img($list_v['icon']); ?>">
								</div>
								<div class="ns-item-con">
									<div class="ns-item-content-title"><?php echo htmlentities($list_v['title']); ?></div>
									<p class="ns-item-content-desc ns-line-hiding" title="<?php echo htmlentities($list_v['description']); ?>"><?php echo htmlentities($list_v['description']); ?></p>
								</div>
							</div>
						</a>
						<?php endif; ?>

						<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ns-survey-right">
		<!-- 访问店铺 -->
	<!--	<a href="#" onclick="getShopUrl()">
			<div class="access_shop">访问店铺</div>
		</a>-->
		<!-- 客服 -->
<!--		<div class="layui-card ns-survey-customer-service">-->
<!--			<div class="ns-item-block-parent customer_service">-->
<!--				<a href="">-->
<!--					<div class="ns-item-block-wrap">-->
<!--						<div class="ns-item-pic">-->
<!--							<?php if($website_info['web_qrcode']): ?>-->
<!--							<img src="<?php echo img($website_info['web_qrcode']); ?>">-->
<!--							<?php else: ?>-->
<!--							<?php endif; ?>-->
<!--							<img src="https://ls.chnssl.com/public/static/img/listen.png">-->
<!--						</div>-->
<!--						<div class="ns-item-con">-->
<!--							<div class="ns-item-content-title">联系客服</div>-->
<!--							<p class="ns-item-content-desc">电话：<?php echo htmlentities($website_info['web_phone']); ?></p>-->
<!--						</div>-->
<!--					</div>-->
<!--				</a>-->
<!--			</div>-->
<!--		</div>-->

		<!-- 店铺评分 -->
		<div class="layui-card ns-survey-guide">
			<div class="layui-card-header"><span><i></i>店铺评分</span></div>
			<div class="layui-card-body">
				<a class="layui-elip" href="javascript:;">描述相符：<?php echo htmlentities($shop['shop_desccredit']); ?> 分</a>
				<a class="layui-elip" href="javascript:;">服务态度：<?php echo htmlentities($shop['shop_servicecredit']); ?> 分</a>
				<a class="layui-elip" href="javascript:;">配送服务：<?php echo htmlentities($shop['shop_deliverycredit']); ?> 分</a>
			</div>
		</div>
		
		<!-- 入驻指南 -->
		<div class="layui-card ns-survey-guide">
			<div class="layui-card-header"><span><i></i>入驻指南</span><a class="ns-text-color" href="<?php echo url('shop/shopjoin/guide'); ?>">更多</a></div>
			<div class="layui-card-body">
                <?php foreach($shop_join_guide_list as $list_k => $list_v): ?>
			    <a class="layui-elip" href="<?php echo url('shop/shopjoin/guidedetail'); ?>?guide_index=<?php echo htmlentities($list_v['guide_index']); ?>">
			    	<span class="date"><?php echo htmlentities(date('m/d',!is_numeric($list_v['create_time'])? strtotime($list_v['create_time']) : $list_v['create_time'])); ?></span><span><?php echo htmlentities($list_v['title']); ?></span>
			    </a>
                <?php endforeach; ?>
			</div>
		</div>
		<!-- 网站公告 -->
		<!--<div class="layui-card ns-survey-help">
			<div class="layui-card-header"><span><i></i>网站公告</span><a class="ns-text-color" href="<?php echo url('shop/notice/lists'); ?>">更多</a></div>
			<div class="layui-card-body">
				<?php foreach($notice_list as $list_k => $list_v): ?>
				<a class="layui-elip" href="<?php echo url('shop/notice/detail'); ?>?id=<?php echo htmlentities($list_v['id']); ?>">
					<span class="adorn ns-bg-color"><?php echo htmlentities($list_k+1); ?></span><span><?php echo htmlentities($list_v['title']); ?></span>
				</a>
				<?php endforeach; ?>
			</div>
		</div>-->

		<!-- 入驻帮助 -->
		<div class="layui-card ns-survey-help">
			<div class="layui-card-header"><span><i></i>商家帮助</span><a class="ns-text-color" href="<?php echo url('shop/shophelp/helplist'); ?>">更多</a></div>
			<div class="layui-card-body">
                <?php foreach($help_list as $list_k => $list_v): ?>
			    <a class="layui-elip" href="<?php echo url('shop/shophelp/helpDetail'); ?>?help_id=<?php echo htmlentities($list_v['id']); ?>">
			    	<span class="type">[<?php echo htmlentities($list_v['class_name']); ?>]</span><span><?php echo htmlentities($list_v['title']); ?></span>
			    </a>
                <?php endforeach; ?>
			</div>
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


<script src="https://ls.chnssl.com/app/admin/view/public/js/echarts.min.js"></script>
<script>
    var table, form, laytpl, laydate, repeat_flag = false;
    layui.use(['form', 'laytpl', 'laydate'], function() {
        form = layui.form;
        laytpl = layui.laytpl;
        laydate = layui.laydate;
		form.render();

        /**
         * 监听开店套餐下拉选(添加)
         */
        form.on('select(shop_group)', function (data) {        //对应lay-filter
            obj.group_id = data.value;
            moneyChange(obj);
        });

        /**
         * 监听续签年限(添加)
         */
        form.on('select(apply_year)', function (data) {        //对应lay-filter
            obj.apply_year = data.value;
            moneyChange(obj);
        });

        function moneyChange(data) {
            $.ajax({
                type: "POST",
                url: ns.url("shop/Apply/getApplyMoney"),
                data: data,
                dataType: 'JSON',
                success: function(res) {
                    repeat_flag = false;

                    $(".paying-amount").text(res.data.paying_amount + '元');
                    $(".pay-amount").val(res.data.paying_amount);
                    if (res.code == 0) {
                        layer.closeAll('page');
                    }
                }
            });
        }

        //申请续签
        $(".reopen_apply").click(function () {
            location.href = ns.url("shop/cert/reopen");
        });
        //编辑续签
        $(".reopen_apply_detail").click(function () {
            location.href = ns.url("shop/cert/editreopeninfo");
        });
        //认证
        $(".shop_auth_apply").click(function () {
            location.href = ns.url("shop/cert/index");
        });
    })
</script>
<script>
	var ten_day_json = <?php echo json_encode($ten_day, JSON_UNESCAPED_UNICODE); ?> ;

	function getDay(day){
		var today = new Date();
		var targetday_milliseconds = today.getTime() + 1000 * 60 * 60 * 24 * day;
		today.setTime(targetday_milliseconds); //注意，这行是关键代码
		var tYear = today.getFullYear();
		var tMonth = today.getMonth();
		var tDate = today.getDate();
		tMonth = doHandleMonth(tMonth + 1);
		tDate = doHandleMonth(tDate);
		return tMonth + "-" + tDate;
	}

	function doHandleMonth(month){
		var m = month;
		if(month.toString().length == 1){
			m = "0" + month;
		}
		return m;
	}

	var data = [getDay(-9), getDay(-8), getDay(-7), getDay(-6), getDay(-5), getDay(-4), getDay(-3), getDay(-2), getDay(-1), getDay(0)];
	// 基于准备好的dom，初始化echarts实例
	var myChart = echarts.init(document.getElementById('order'));

	// 指定图表的配置项和数据
	option = {
		xAxis: {
			type: 'category',
			data: data
		},
		yAxis: {
			type: 'value'
		},
		tooltip: {
			formatter: function(params, ticket, callback) {
				return "日期：" + data[params.dataIndex] + '<br />' + params.seriesName + "：" + params.value;
			},
			backgroundColor: 'rgba(0, 0, 0, 0.5)',
			padding: [5, 10],
			textStyle: {
				color: '#fff',
				lineHeight: 30,
			}
		},
		series: [{
			name: ['订单数'],
			data: ten_day_json.order_pay_count,
			type: 'bar',
			showBackground: true,
			barCategoryGap: '50%',
			itemStyle: {
				color: new echarts.graphic.LinearGradient(
					0, 0, 0, 1,
					[
						{offset: 0, color: '#ff8143'},
						{offset: 1, color: '#ff8143'}
					]
				)
			}
		}]
	};

	// 使用刚指定的配置项和数据显示图表。
	myChart.setOption(option);

	// 基于准备好的dom，初始化echarts实例
	var moneyChart = echarts.init(document.getElementById('money'));

	// 指定图表的配置项和数据
	moneyOption = {
		xAxis: {
			type: 'category',
			data: data
		},
		yAxis: {
			type: 'value'
		},
		tooltip: {
			trigger: 'axis',
			showContent: true,
			backgroundColor: 'rgba(0, 0, 0, 0.5)',
			padding: [5, 10],
			textStyle: {
				color: '#fff',
				lineHeight: 30,
			},
			formatter: function(params, ticket, callback) {
				return "日期：" + params[0].axisValue + '<br />' + params[0].seriesName + "：" + params[0].value + "元";
			},
		},
		series: [{
			name: ['销售额'],
			data: ten_day_json.order_total,
			type: 'line',
			smooth: true,
			itemStyle: {
				color: '#ff8143'
			}
		}]
	};

	// 使用刚指定的配置项和数据显示图表。
	moneyChart.setOption(moneyOption);
</script>

</body>

</html>