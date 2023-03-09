<?php /*a:2:{s:57:"/www/wwwroot/ls.chnssl.com/app/shop/view/local/local.html";i:1614516202;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
	.map-view{position:relative}
	.map-block-view{display:none}
	.map-block{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:1100px}
	.local-map{-webkit-box-flex:0;-webkit-flex:0 0 750px;-ms-flex:0 0 750px;flex:0 0 750px;height:500px;border:1px solid #ededed;margin-right:20px;border-radius:4px;overflow-y:hidden;position:relative;padding-bottom:45px}
	.overlayers{-webkit-box-flex:1;-webkit-flex:1 1 auto;-ms-flex:1 1 auto;flex:1 1 auto;border:1px solid #ededed;border-radius:4px;width:100%;height:494px;overflow-y:auto}
	.overlayers::-webkit-scrollbar{width:10px;height:1px}
	.overlayers::-webkit-scrollbar-thumb{border-radius:10px;box-shadow:inset 0 0 5px #ff8143;background:#ff8143}
	.overlayers::-webkit-scrollbar-track{box-shadow:inset 0 0 5px #ededed;border-radius:10px;background:#ededed}
	.map{height:500px;width:100%;position:relative}
	.region-list{width:310px}
	.region-list li{padding:30px 12px;position:relative;border:1px solid transparent;border-bottom-color:#ebedf0}
	.region-checked{border-color:#ff8143!important}
	.area-content{overflow:hidden;margin:8px 0}
	.area-label{display:inline-block;width:70px;float:left}
	.area-input-inline{float:left;width:190px}
	.region-add-block{width:290px}
	.region-add-block button{display:block;padding:0;margin:10px auto;font-size:14px;width:196px;color:#323233;line-height:32px;background:#fff;outline:0;border:1px solid #dcdee0;border-radius:2px;cursor:pointer}
	.region-add-block button:hover{border-color:#ff8143;color:#ff8143}
	.region-view{display:none;}
	.radius-view{display:none;}
	.administrative-view{display:none;}
	.administrative-region-view{display:none;}
	.administrative-radius-view{display:none;}
	.time-view{display:none;}
	.time-type-view{display:none;}
	.area-block-delete{position:absolute;top:-2px;right:5px;font-size:12px;cursor:pointer}
	.layui-form-item .layui-form-checkbox[lay-skin=primary] {margin-top: 0;}
	.layui-form-radio {margin-top: 0;}
</style>
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/layui/extend/formSelects-v4.css" />

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
			
				
<div class="layui-form">
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">同城配送基础设置</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">配送方式：</label>
				<div class="layui-input-inline">
					<input type="checkbox" name="type" value="default" title="商家自配送" lay-skin="primary" checked>
					<!--<input type="checkbox" name="type" value="other" title="第三方配送"lay-skin="primary" disabled >-->
				</div>
			</div>

			<!--配送时间设置-->
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">配送时间设置：</label>
					<div class="layui-input-block">
						<input type="radio" name="time_is_open" value="1" title="开启"  lay-filter="time_is_open" <?php if($local_info['time_is_open'] == 1): ?>checked<?php endif; ?>/>
						<input type="radio" name="time_is_open" value="0" title="关闭"  lay-filter="time_is_open" <?php if($local_info['time_is_open'] == 0 || !isset($local_info['time_is_open'])): ?>checked<?php endif; ?>/>
					</div>
					<div class="ns-word-aux">开启后，买家下单选择同城配送时，可选择配送时间，提交订单后，将在买家备注中显示。</div>
				</div>
			</div>
			<div class="layui-form-item time-view" <?php if($local_info['time_is_open'] == 0): ?> style="display:none;"<?php endif; ?>>
				<div class="layui-inline">
					<label class="layui-form-label"></label>
					<div class="layui-input-inline">
						<input type="radio" name="time_type" value="0" title="全天" lay-filter="time_type" <?php if($local_info['time_type'] == 0 || !isset($local_info['time_type'])): ?>checked<?php endif; ?>/>
						<input type="radio" name="time_type" value="1" title="自定义" lay-filter="time_type" <?php if($local_info['time_type'] == 1): ?>checked<?php endif; ?>/>
					</div>
				</div>
			</div>
			<div class="time-view">
				<div class="layui-form-item time-type-view">
					<div class="layui-inline">
						<label class="layui-form-label"></label>
						<div class="layui-input-inline">
							<input type="checkbox" value="1" class='time-week' name="time_week[]" title="周一" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(1,$local_info['time_week'])): ?> checked <?php endif; ?>>
							<input type="checkbox" value="2" class='time-week' name="time_week[]" title="周二" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(2,$local_info['time_week'])): ?> checked <?php endif; ?>>
							<input type="checkbox" value="3" class='time-week' name="time_week[]" title="周三" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(3,$local_info['time_week'])): ?> checked <?php endif; ?>>
							<input type="checkbox" value="4" class='time-week' name="time_week[]" title="周四" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(4,$local_info['time_week'])): ?> checked <?php endif; ?>>
							<input type="checkbox" value="5" class='time-week' name="time_week[]" title="周五" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(5,$local_info['time_week'])): ?> checked <?php endif; ?>>
							<input type="checkbox" value="6" class='time-week' name="time_week[]" title="周六" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(6,$local_info['time_week'])): ?> checked <?php endif; ?>>
							<input type="checkbox" value="0" class='time-week' name="time_week[]" title="周日" lay-skin="primary" <?php if(!empty($local_info['time_week']) && in_array(0,$local_info['time_week'])): ?> checked <?php endif; ?>>
						</div>
					</div>
				</div>
				<div class="layui-form-item time-type-view" >
					<label class="layui-form-label"></label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" id="startTime" lay-verify="start_time"placeholder="配送开始时间" value="" readonly >
						<input type="hidden" class="layui-input" name="start_time" placeholder="配送开始时间" value="<?php echo htmlentities($local_info['start_time']); ?>">
					</div>
					<div class="layui-form-mid layui-word-aux">~</div>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" id="endTime" lay-verify="end_time" placeholder="配送结束时间" value="" readonly >
						<input type="hidden" class="layui-input" name="end_time"placeholder="配送结束时间" value="<?php echo htmlentities($local_info['end_time']); ?>">
					</div>
				</div>
			</div>
	</div>

	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">配送区域设置</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">店铺地址：</label>
				<div class="layui-input-block">
				<div class="layui-input-inline">
					<input type="text" class="layui-input ns-len-long" readonly disabled  value="<?php echo htmlentities($shop_detail['full_address']); ?>">
				</div>
				<div class="layui-form-mid layui-word-aux"><a href="<?php echo addon_url('shop/shop/contact'); ?>" target='_brank' class="ns-text-color">修改</a></div>
				</div>
				<div class="ns-word-aux">配送区域以此地址为起点进行距离计算。</div>
			</div>

			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">配送区域：</label>
					<div class="layui-input-block">
						<input type="radio" name="area_type" value="1" title="服务半径" lay-filter="area_type" <?php if($local_info['area_type'] == 1): ?>checked<?php endif; ?>/>
						<input type="radio" name="area_type" value="2" title="自定义区域" lay-filter="area_type" <?php if($local_info['area_type'] == 2): ?>checked<?php endif; ?>/>
						<input type="radio" name="area_type" value="3" title="行政区域" lay-filter="area_type" <?php if($local_info['area_type'] == 3): ?>checked<?php endif; ?>/>
					</div>
					<div class="ns-word-aux">订单中商品在优惠前的价格（不包含运费）低于起送金额时，买家无法下单</div>
				</div>
			</div>
			<div class="layui-form-item administrative-view">
				<label class="layui-form-label"><span class="required">*</span>可配送区域：</label>
				<div class="layui-input-inline  ns-len-long area-select">
					<select name="district_id" xm-select="district_id" lay-filter="district_id" lay-verify="district_id">
						<?php foreach($district_list as $k => $v): ?>
							<option value="<?php echo htmlentities($v['id']); ?>" <?php if(in_array($v['id'], $local_info['area_array'])): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="layui-form-item radius-view">
				<div class="layui-inline">
					<label class="layui-form-label"></label>
					<div class="layui-input-block">
						<div class="layui-form-mid">距离</div>
						<div class="layui-input-inline">
							<input type="number" name="radius_start_distance" lay-verify="radius_start_distance" class="layui-input" value="<?php if($local_info['area_type'] == 1): ?><?php echo htmlentities($local_info['start_distance']); ?><?php endif; ?>">
						</div>
						<div class="layui-form-mid">公里以内,配送费用</div>
						<div class="layui-input-inline" style="width: 100px;">
							<input type="number" name="radius_start_delivery_money" lay-verify="radius_start_delivery_money" placeholder="￥" autocomplete="off" class="layui-input" value="<?php if($local_info['area_type'] == 1): ?><?php echo htmlentities($local_info['start_delivery_money']); ?><?php endif; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="layui-form-item radius-view">
				<div class="layui-inline">
					<label class="layui-form-label"></label>
					<div class="layui-input-block">

						<div class="layui-form-mid">距离每增加</div>
						<div class="layui-input-inline">
							<input type="number" name="radius_continued_distance" lay-verify="radius_continued_distance"  class="layui-input"  value="<?php if($local_info['area_type'] == 1): ?><?php echo htmlentities($local_info['continued_distance']); ?><?php endif; ?>">
						</div>
						<div class="layui-form-mid">公里，运费将增加</div>
						<div class="layui-input-inline" style="width: 100px;">
							<input type="number" name="radius_continued_delivery_money" lay-verify="radius_continued_delivery_money"  placeholder="￥" autocomplete="off" class="layui-input" value="<?php if($local_info['area_type'] == 1): ?><?php echo htmlentities($local_info['continued_delivery_money']); ?><?php endif; ?>">
						</div>
					</div>
					<div class="ns-word-aux">当配送区域交叉时，以最低费用计算费用。 因考虑实际送货路况，配送费按汽车导航距离计算，非地图直线距离。</div>

				</div>
			</div>

			<div class="layui-inline map-block-view">
				<label class="layui-form-label">地图定位：</label>
				<div class="layui-input-block map-view">
					<div class="map-block">
						<div class="local-map">
							<div class="map" id="container"></div>
						</div>
						<div class="overlayers">
							<ul class="region-list"></ul>
							<div class="region-add-block">
								<button onclick="addArea();">增加配送区域</button>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

	<div class="layui-card ns-card-common ns-card-brief administrative-view">
		<div class="layui-card-header">
			<span class="ns-card-title">配送价格</span>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">起送价格：</label>
				<div class="layui-input-block">
					<div class="layui-input-inline">
						<input type="number" name='xz_start_money' lay-verify="xz_start_money"  class="layui-input" value="<?php if($local_info['area_type'] == 3): ?><?php echo htmlentities($local_info['start_money']); ?><?php endif; ?>">
					</div>
					<div class="layui-form-mid">元</div>
				</div>
				<div class="ns-word-aux">订单中商品在优惠券的价格（不包含运费）低于配送价时，买家无法下单</div>
			</div>
		</div>
		<div class="layui-form-item administrative-region-view">
			<div class="layui-inline">
				<label class="layui-form-label">配送费：</label>
				<div class="layui-input-inline">
					<div class="layui-input-inline">
						<input type="number" name='xz_delivery_money'  lay-verify="xz_delivery_money"class="layui-input administrative-delivery-money"value="<?php if($local_info['area_type'] == 3): ?><?php echo htmlentities($local_info['delivery_money']); ?><?php endif; ?>">
					</div>
					<div class="layui-form-mid">元</div>
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">阶梯价：</label>
				<div class="layui-input-inline">
					<div class="layui-input-inline">
						<input type="checkbox" name="is_open_step" value="1" lay-skin="switch" lay-filter="is_open_step" <?php if(isset($local_info['is_open_step']) && $local_info['is_open_step'] == 1): ?>checked<?php endif; ?>/>
					</div>
					<div class="layui-form-mid">元</div>
				</div>

			</div>
		</div>

		<div class="layui-form-item administrative-radius-view">
			<div class="layui-inline">
				<label class="layui-form-label"></label>
				<div class="layui-input-inline">

					<div class="layui-form-mid">半径</div>
					<div class="layui-input-inline">
						<input type="number" name="xz_start_distance"  lay-verify="xz_start_distance"class="layui-input"value="<?php if($local_info['area_type'] == 3): ?><?php echo htmlentities($local_info['start_distance']); ?><?php endif; ?>">
					</div>
					<div class="layui-form-mid">公里以内,配送费用</div>
					<div class="layui-input-inline" style="width: 100px;">
						<input type="number" name="xz_start_delivery_money" placeholder="￥"  lay-verify="xz_start_delivery_money"autocomplete="off" class="layui-input" value="<?php if($local_info['area_type'] == 3): ?><?php echo htmlentities($local_info['start_delivery_money']); ?><?php endif; ?>">
					</div>
				</div>

			</div>
		</div>
		<div class="layui-form-item administrative-radius-view">
			<div class="layui-inline">
				<label class="layui-form-label"></label>
				<div class="layui-input-inline">
					<div class="layui-form-mid">距离每增加</div>
					<div class="layui-input-inline">
						<input type="number" name="xz_continued_distance"  lay-verify="xz_continued_distance"class="layui-input" value="<?php if($local_info['area_type'] == 3): ?><?php echo htmlentities($local_info['continued_distance']); ?><?php endif; ?>">
					</div>
					<div class="layui-form-mid">公里，运费将增加</div>
					<div class="layui-input-inline" style="width: 100px;">
						<input type="number" name="xz_continued_delivery_money"  lay-verify="xz_continued_delivery_money"placeholder="￥" autocomplete="off" class="layui-input"value="<?php if($local_info['area_type'] == 3): ?><?php echo htmlentities($local_info['continued_delivery_money']); ?><?php endif; ?>">
					</div>
				</div>

			</div>
		</div>

	</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
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


<script type="text/javascript" src="<?php echo get_http_type(); ?>://webapi.amap.com/maps?v=1.4.15&amp;key=<?php if(empty($map_key['gaode_map_key'])): ?>2df5711d4e2fd9ecd1622b5a53fc6b1d<?php else: ?><?php echo htmlentities($map_key['gaode_map_key']); ?><?php endif; ?>&plugin=AMap.CircleEditor,AMap.PolyEditor"></script>
<script type="text/javascript" src="https://ls.chnssl.com/app/shop/view/public/js/local.js"></script>
<script type="text/html" id="area-html">
	<li key = '{{ d.key }}'>
		<div class="area-content">
			<label class="area-label">区域名称</label>
			<div class="area-input-inline">
				<input type="text" class="layui-input area-name" lay-verify="area_name" value="{{ d.area_name || '' }}">
			</div>
		</div>
		<div class="area-content">
			<label class="area-label">起送价</label>
			<div class="area-input-inline">
				<input type="number" class="layui-input start-price" lay-verify="start_price" value="{{ d.start_price || '' }}">
			</div>
		</div>
		<div class="area-content region-view">
			<label class="area-label">配送费</label>
			<div class="area-input-inline">
				<input type="number" class="layui-input delivery-money" lay-verify="delivery_money" value="{{ d.delivery_money || ''  }}">
			</div>
		</div>
		<div class="area-content">
			<label class="area-label">划分方式</label>
			<div class="area-input-inline layui-input-inline">
				<input type="radio" name="rule_type{{ d.key }}" class='rule-type' value="circle" title="半径"  lay-filter="huafen_type{{ d.key }}" {{#  if(d.rule_type == 'circle' || d.rule_type == undefined){ }} checked{{#  } }} />
				<input type="radio" name="rule_type{{ d.key }}" class='rule-type' value="polygon" title="自定义"  lay-filter="huafen_type{{ d.key }}" {{#  if(d.rule_type == 'polygon'){ }} checked{{#  } }}/>
			</div>
		</div>
		<div class="area-block-delete ns-text-color" onclick="deleteArea('{{ d.key }}');">删除</div>
	</li>
</script>
<script>
var laytpl,form;
var init_key = 1;
<?php if(empty($local_info['local_area_array'])): ?>
	var area_array = [
		{
			rule_type:'circle'
		}
	];
<?php else: ?>
	var area_array = JSON.parse('<?php echo json_encode($local_info['local_area_array'], JSON_UNESCAPED_UNICODE); ?>');
<?php endif; ?>

	//全局定义一次, 加载formSelects
	layui.config({
		base: 'https://ls.chnssl.com/public/static/ext/layui/extend/'//此处路径请自行处理, 可以使用绝对路径
	}).extend({
		formSelects: 'formSelects-v4'
	});

	layui.use([ 'laydate', 'form', 'laytpl' , 'formSelects'], function() {
		var laydate = layui.laydate;
		var formSelects = layui.formSelects;

		form = layui.form;
		laytpl = layui.laytpl;
		//时间选择器
		laydate.render({
			elem: '#startTime',
		    type: 'time',
			value: "<?php echo date('H:i:s', strtotime(date('Y-m-d')) + $local_info['start_time']); ?>",
			done: function(value, date, endDate){
				var time = date.hours * 3600 + date.minutes * 60 + date.seconds;
				$("input[name=start_time]").val(time);
			}
		});

		//时间选择器
		laydate.render({
			elem: '#endTime'
			, type: 'time'
			,value: "<?php echo date('H:i:s', strtotime(date('Y-m-d')) + $local_info['end_time']); ?>"
			,done: function(value, date, endDate){
				var time = date.hours * 3600 + date.minutes * 60 + date.seconds;
				$("input[name=end_time]").val(time);
			}
		});

		//开启定时达
		form.on('radio(time_is_open)', function(data){
			timeChange(data.value);
		});

		//开启定时达
		form.on('radio(time_type)', function(data){
			timeTypeChange(data.value);
		});
		//区域类型
		form.on('radio(area_type)', function(data){
			areaChange(data.value);
		});

		//启用阶梯价
		form.on('switch(is_open_step)', function(data){
			stepPriceChange(data.elem.checked ? 1 : 0);
		});

		init();
		form.render();

		form.verify({
			start_time: function(value, item){ //value：表单的值、item：表单的DOM对象
				var end_time = $("input[name=end_time]").val();
				var start_time = $("input[name=start_time]").val();

				if(parseInt(start_time) > parseInt(end_time)){
					return '配送开始时间不能大于配送结束时间';
				}

			},
			end_time: function(value, item){ //value：表单的值、item：表单的DOM对象
				var end_time = $("input[name=end_time]").val();
				var start_time = $("input[name=start_time]").val();
				if(parseInt(start_time) > parseInt(end_time)){
					return '配送开始时间不能大于配送结束时间';
				}
			},
			radius_start_distance: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if(area_type == 1 && value == ''){
					return '请填写配送区域相关信息';
				}

				if(area_type == 1 && parseFloat(value) <= 0){
					return '距离不可以小于或等于0';
				}
			},
			radius_start_delivery_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if(area_type == 1 && value == ''){
					return '请填写配送区域相关信息';
				}

			},
			radius_continued_distance: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if(area_type == 1 && value == ''){
					return '请填写配送区域相关信息';

				}
				if(area_type == 1 && parseFloat(value) <= 0){
					return '距离不可以小于或等于0';
				}

			},
			radius_continued_delivery_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if(area_type == 1 && value == ''){
					return '请填写配送区域相关信息';
				}

			},

			xz_start_distance: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				var is_open_step = $("input[name=is_open_step]:checked").val();
				if(area_type == 3 && is_open_step == 1 && value == ''){
					return '请填写配送区域相关信息';
				}

				if(area_type == 3 && is_open_step == 1 &&  parseFloat(value) <= 0){
					return '距离不可以小于或等于0';
				}
			},
			xz_start_delivery_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				var is_open_step = $("input[name=is_open_step]:checked").val();
				if(area_type == 3 && is_open_step == 1 && value == ''){
					return '请填写配送区域相关信息';
				}

			},
			xz_continued_distance: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				var is_open_step = $("input[name=is_open_step]:checked").val();
				if(area_type == 3 && is_open_step == 1 && value == ''){
					return '请填写配送区域相关信息';
				}
				if(area_type == 3 && is_open_step == 1 &&  parseFloat(value) <= 0){
					return '距离不可以小于或等于0';
				}

			},
			xz_continued_delivery_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				var is_open_step = $("input[name=is_open_step]:checked").val();
				if(area_type == 3 && is_open_step == 1 && value == ''){
					return '请填写配送区域相关信息';

				}

			},

			xz_start_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				var is_open_step = $("input[name=is_open_step]:checked").val();
				if(area_type == 3 && value == ''){
					return '请填写配送区域相关信息';

				}

			},
			xz_delivery_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				var is_open_step = $("input[name=is_open_step]:checked").val();
				if(area_type == 3 && is_open_step == 0 && value == ''){
					return '请填写配送区域相关信息';

				}

			},

			start_price: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if((area_type == 1 || area_type == 2) && value == ''){
					return '请填写配送区域相关信息';

				}

			},
			delivery_money: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();

				if(area_type == 2 && value == ''){
					return '请填写配送区域相关信息';

				}

			},
			//配送区域
			area_name: function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if((area_type == 1 || area_type == 2) && value == ''){
					return '请填写配送区域相关信息';

				}

			},
			district_id : function(value, item){
				var area_type = $("input[name=area_type]:checked").val();
				if(area_type == 3 && value == ''){
					return '请填写配送区域相关信息';
				}

			}
		});

		var repeat_flag = false;
		//提交
		form.on('submit(save)', function(data) {

			if (repeat_flag) return false;
			repeat_flag = true;
			var field = data.field;
			var json = {};
			json.type = field.type;
			json.area_type = field.area_type;
			//是否开启定时达
			json.time_is_open = field.time_is_open;
			if(field.time_is_open){
				//时间类型
				json.time_type =  field.time_type;
				//自定义时间
				if(field.time_type == 1){
					var time_week = [];
					$('.time-week').each(function(){
						if($(this).prop('checked')){
							time_week.push($(this).val());
						}
					});
					json.time_week =  time_week.toString();
					json.start_time =  field.start_time;
					json.end_time =  field.end_time;
				}
			}
			switch(field.area_type){
				case '1':
					json.start_distance = field.radius_start_distance;
					json.start_delivery_money = field.radius_start_delivery_money;
					json.continued_distance = field.radius_continued_distance;
					json.continued_delivery_money = field.radius_continued_delivery_money;
					var local_area_json = eachOverlayers(field.area_type);
					json.local_area_json = JSON.stringify(local_area_json);
					break;
				case '2':
					var local_area_json = eachOverlayers(field.area_type);
					json.local_area_json = JSON.stringify(local_area_json);
					break;
				case '3':
					//地址id
					var area_array = formSelects.value('district_id', 'valStr');
					json.area_array = area_array;
					json.start_money = field.xz_start_money;
					json.is_open_step = field.is_open_step;
					if(field.is_open_step){
						json.start_distance = field.xz_start_distance;
						json.start_delivery_money = field.xz_start_delivery_money;
						json.continued_distance = field.xz_continued_distance;
						json.continued_delivery_money = field.xz_continued_delivery_money;

					}else{

						json.delivery_money = field.xz_delivery_money;
					}
					break;
			}
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: ns.url("shop/local/local"),
				data: json,
				success: function(res) {
					layer.msg(res.message);
					if (res.code == 0) {
						location.reload();
					} else {
						repeat_flag = false;
					}
				}
			});
		});

	});

	//删除区域
	function deleteArea(key){
		var parent = $('li[key='+key+']');
		parent.remove();
		removeOverlayers(key);
	}

	//遍历获取区域配置
	function eachOverlayers(area_type){
		var area_json = [];
		$('.region-list li').each(function(){
			var start_price = $(this).find('.start-price').val();
			var area_name = $(this).find('.area-name').val();
			var rule_type = $(this).find('.rule-type:checked').val();

			var key = $(this).attr('key');
			var path = getOverlayersPath(key, rule_type);
			var item_json = {
				start_price:start_price,
				area_name:area_name,
				rule_type:rule_type,
				path:path,
			};
			if(area_type == 2){
				var delivery_money = $(this).find('.delivery-money').val();
				item_json.delivery_money = delivery_money;
			}

			area_json.push(item_json);
		});
		return area_json;
	}

	$("body").on('click', '.region-list li', function(){
		$('.region-list li').removeClass('region-checked');

		$(this).addClass('region-checked');
		// var rule_type = $(this).find('.rule_type:checked');
		var key = $(this).attr('key');
		//创建覆盖物
		foursOverlayers(key);
	});

	//初始化
	function init(){
		//是否启用定时达
		timeChange($("input[name=time_is_open]:checked").val());
		//是否启用定时达
		timeTypeChange($("input[name=time_type]:checked").val());

		//初始化区域类型
		areaChange($("input[name=area_type]:checked").val());
		//初始化阶梯价
		stepPriceChange($("input[name=is_open_step]").prop('checked') ? 1 : 0);

		if('<?php echo htmlentities($shop_detail['latitude']); ?>' == "" || '<?php echo htmlentities($shop_detail['longitude']); ?>' == ""){
			var latlng = {lat:'',lng:''};
		}else{
			var latlng = {lat:'<?php echo htmlentities($shop_detail['latitude']); ?>',lng:'<?php echo htmlentities($shop_detail['longitude']); ?>'};
		}
		createMap('container', latlng);

		$.each(area_array, function(i, item){
			addArea(item);
		});
		form.render();
	}

	function timeChange(is_open){
		$('.time-view').hide();
		if(is_open == 0){

		}else if(is_open == 1){
			$('.time-view').show();
		}
	}
	function timeTypeChange(type){
		$('.time-type-view').hide();
		if(type == 0){

		}else if(type == 1){
			$('.time-type-view').show();
		}
	}

	function areaChange(area_type){
		$(".region-view").hide();
		$(".radius-view").hide();
		$(".administrative-view").hide();
		$(".map-block-view").hide();
		if(area_type== 1){
			$(".radius-view").show();
			$(".map-block-view").show();
		}else if(area_type == 2){
			$(".region-view").show();
			$(".map-block-view").show();
		}else if(area_type == 3){
			$(".administrative-view").show();
		}
	}

	function stepPriceChange(is_open){
		$(".administrative-region-view").hide();
		$(".administrative-radius-view").hide();
		if(is_open == 0){

			$(".administrative-region-view").show();
		}else if(is_open == 1){
			$(".administrative-radius-view").show();
		}
	}

	/**
	 * 创建配送区域
	 */
	function addArea(data){
		var temp_data = data != undefined ? data : [];
		var rule_type = temp_data.length == 0 ? 'circle' : data.rule_type;
		var key = init_key;
		temp_data['key'] = key;
		temp_data['rule_type'] = rule_type;
		var tpl = $("#area-html").html();
		laytpl(tpl).render(temp_data, function(html){
			$('.region-list li').removeClass('region-checked');
			$('.region-list').append(html);
			$('.region-list li').last().addClass('region-checked');
			form.render();

			form.on('radio(huafen_type'+key +')', function(data){
				var parent_obj = $(data.elem).parent().parent().parent();
				var rule_type = data.value;
				var key = parent_obj.attr('key');
				removeOverlayers(key);
				//创建覆盖物
				createOverlayers(rule_type, key);
			});
		});

		var path = data != undefined ? data.path : undefined;

		//创建覆盖物
		createOverlayers(rule_type, key, path);

		areaChange($("input[name=area_type]:checked").val());
		init_key++;

	}

	/**
	 * 创建覆盖物
	 * @param type
	 * @param key
	 */
	function createOverlayers(type, key, path) {
		switch (type) {
			//多边形
			case 'polygon': {
				createPolygon(key, getRandomColor(), getRandomColor(), path);
				break;
			}
			//圆
			case 'circle': {
				createCircle(key, getRandomColor(), getRandomColor(), path);
				break;
			}
		}
	}

	/**
	 * 随机生成颜色
	 * @returns {string}
	 */
	function getRandomColor(){
		return  '#' + (function(color){
			return (color +=  '0123456789abcdef'[Math.floor(Math.random()*16)])
			&& (color.length == 6) ?  color : arguments.callee(color);
		})('');
	}
/**
 * 一天内的时间比较
 * @param start_time
 * @param end_time
 * @returns {boolean}
 * @constructor
 */
function compareDate(start_time, end_time)
{
	var date = new Date();
	var start_time_arr = start_time.split(":");
	var end_time_arr = end_time.split(":");
	return date.setHours(end_time_arr[0],end_time_arr[1],end_time_arr[2]) > date.setHours(start_time_arr[0],start_time_arr[1],start_time_arr[2]);
}
</script>

</body>

</html>