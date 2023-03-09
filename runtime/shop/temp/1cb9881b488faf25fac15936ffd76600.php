<?php /*a:2:{s:69:"D:\phpstudy_pro\WWW\www.hunqin.com\app\shop\view\goods\add_goods.html";i:1656054031;s:58:"D:\phpstudy_pro\WWW\www.hunqin.com\app\shop\view\base.html";i:1654828558;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="http://www.hunqin.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/app/shop/view/public/css/common.css" />
	<script src="http://www.hunqin.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="http://www.hunqin.com/public/static/ext/layui/layui.js"></script>
	<script src="http://www.hunqin.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "http://www.hunqin.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"http://www.hunqin.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="http://www.hunqin.com/public/static/js/common.js"></script>
	<script src="http://www.hunqin.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("http://www.hunqin.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	
<link rel="stylesheet" href="http://www.hunqin.com/public/static/ext/video/video.css">
<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/ext/searchable_select/searchable_select.css" />
<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/css/common.css" />
<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/public/static/css/main.css" />
<link rel="stylesheet" type="text/css" href="http://www.hunqin.com/app/shop/view/public/css/goods_edit.css" />

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="http://www.hunqin.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="http://www.hunqin.com/app/shop/view/public/img/shop_logo.png">
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
								<img src="http://www.hunqin.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
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
	<div class="ns-tab layui-tab layui-tab-brief" lay-filter="goods_tab">
		<ul class="layui-tab-title">
			<li class="layu1i-this" lay-id="basic">基础设置</li>
			<li lay-id="detail">商品详情</li>
			<li lay-id="attr">商品参数</li>
			<li lay-id="wenjuan" id="wenjuan" style="display: none;">问卷调查</li>
		</ul>

		<div class="layui-tab-content">

			<!-- 基础设置 -->
			<div class="layui-tab-item layui-show">

				<!-- 商品类型 -->
				<div class="layui-card ns-card-common">
					<div class="layui-card-header">
						<span class="ns-card-title">商品类型</span>
					</div>

					<div class="layui-card-body commodity-type-box" >
						<div class="commodity-type-item ns-border-color" onclick="location.href = ns.url('shop/goods/addGoods')">
							<span class="ns-text-color">实物商品</span>
							<span>(需要物流)</span>
						</div>
						<div class="commodity-type-item" onclick="location.href = ns.url('shop/virtualgoods/addGoods')">
							<span>虚拟商品</span>
							<span>(无需物流)</span>
						</div>
					</div>

				</div>

				<div class="layui-card ns-card-common">
					<div class="layui-card-header">
						<span class="ns-card-title">基础信息</span>
					</div>

					<div class="layui-card-body">
						<div class="layui-form-item">
							<label class="layui-form-label"><span class="required">*</span>商品名称：</label>
							<div class="layui-input-inline">
								<input name="goods_name" type="text" placeholder="请输入商品名称，不能超过100个字符" maxlength="100" autocomplete="off" lay-verify="goods_name" class="layui-input ns-len-long">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">促销语：</label>
							<div class="layui-input-inline">
								<textarea class="layui-textarea ns-len-long" name="introduction" maxlength="100" lay-verify="introduction" placeholder="请输入促销语，不能超过100个字符"></textarea>
							</div>
						</div>

						<div class="layui-form-item goods-image-wrap">
							<label class="layui-form-label"><span class="required">*</span>商品主图：</label>
							<div class="layui-input-block">
								<!--商品主图项-->
								<div class="js-goods-image"></div>
							</div>
							<div class="ns-word-aux">第一张图片将作为商品主图,支持同时上传多张图片,多张图片之间可随意调整位置；支持jpg、gif、png格式上传或从图片空间中选择，建议使用尺寸800x800像素以上、大小不超过1M的正方形图片，上传后的图片将会自动保存在图片空间的默认分类中，最多上传10张（至少1张）</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">商品视频：</label>
							<div class="layui-input-block">
								<div class="video-thumb">
									<video id="goods_video" class="video-js vjs-big-play-centered" controls="" poster="http://www.hunqin.com/app/shop/view/public/img/goods_video_preview.png" preload="auto"></video>
									<video id="temp_goods_video" class="video-js vjs-big-play-centered" controls="" poster="http://www.hunqin.com/app/shop/view/public/img/goods_video_preview.png" preload="auto"></video>
									<span class="delete-video hide" onclick="deleteVideo()"></span>
								</div>
								<div id="videoUpload" title="商品视频" style="position: absolute;left: 0;width: 250px;height: 90px;opacity: 0;cursor: pointer;z-index:10;"></div>
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label"></label>
							<div class="layui-input-block">
								<input type="text" name="video_url" placeholder="在此输入外链视频地址" autocomplete="off" class="layui-input ns-len-long">
							</div>
							<div class="file-title ns-word-aux">
								<div>注意事项：</div>
								<ul>
									<li>1、检查upload文件夹是否有读写权限。</li>
									<li>2、PHP默认上传限制为2MB，需要在php.ini配置文件中修改“post_max_size”和“upload_max_filesize”的大小。</li>
									<li>3、视频支持手动输入外链视频地址或者上传本地视频文件</li>
									<li>4、必须上传.mp4视频格式</li>
									<li>5、视频文件大小不能超过500MB</li>
								</ul>
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">关键词：</label>
							<div class="layui-input-block">
								<input type="text" name="keywords" placeholder="商品关键词用于SEO搜索，不能超过100个字符" maxlength="100" autocomplete="off" class="layui-input ns-len-long">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">商品品牌：</label>
							<div class="layui-input-inline ns-len-mid">
								<select name="brand_id" lay-search="" lay-filter="brand_id">
									<option value="">请选择商品品牌</option>
									<?php if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $key=>$vo): ?>
									<option value="<?php echo htmlentities($vo['brand_id']); ?>"><?php echo htmlentities($vo['brand_name']); ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								<input type="hidden" name="brand_name" />
							</div>
						</div>

						<div class="layui-form-item js-goods-shop-category">
							<label class="layui-form-label">店内分类：</label>
							<div class="layui-input-inline"></div>
							<button class="layui-btn layui-btn-primary">添加</button>
						</div>

						<?php if($is_install_supply): ?>
						<div class="layui-form-item js-supplier">
							<label class="layui-form-label">供应商：</label>
							<div class="layui-input-inline">
								<select name="supplier">
									<option value="">请选择供应商</option>
									<?php if(is_array($supplier_list) || $supplier_list instanceof \think\Collection || $supplier_list instanceof \think\Paginator): if( count($supplier_list)==0 ) : echo "" ;else: foreach($supplier_list as $key=>$vo): ?>
									<option value="<?php echo htmlentities($vo['supplier_site_id']); ?>"><?php echo htmlentities($vo['title']); ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								<input type="hidden" name="supplier_id" />
							</div>
						</div>
						<?php endif; ?>

						<div class="layui-form-item ns-goods-category-wrap">
							<label class="layui-form-label"><span class="required">*</span>商品分类：</label>
							<div class="layui-input-block ns-goods-cate">
								<div class="ns-goods-category-wrap-box">
									<div class="goods-category-con-wrap">
										<div class="layui-block">
											<div class="layui-input-inline ns-cate-input-defalut">
												<input type="text" readonly lay-verify="required" autocomplete="off" class="layui-input ns-len-mid select-category" />
												<input type="hidden" class="category_id" />
												<input type="hidden" class="category_id_1" />
												<input type="hidden" class="category_id_2" />
												<input type="hidden" class="category_id_3" />
												<input type="hidden"  id="select_category_id">
												<input type="hidden"  name="category_id">
												<!-- <button class="layui-btn layui-btn-primary" onclick="selectedCategoryPopup(this)">选择</button> -->
											</div>
											<!--<a href="javascript:addGoodsCate();" class="ns-text-color js-add-category">添加分类</a>-->
										</div>
									</div>
									<div class="category-wrap hide">
										<div class="goodsCategory one goodsCategory_1">
											<ul></ul>
										</div>
										<div class="goodsCategory goodsCategory_2 two hide" style="border-left:0;">
											<ul></ul>
										</div>
										<div class="goodsCategory goodsCategory_3 three hide">
											<ul></ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- 价格库存 -->
				<div class="layui-card ns-card-common">
					<div class="layui-card-header">
						<span class="ns-card-title">价格库存</span>
					</div>

					<div class="layui-card-body">

						<div class="layui-form-item">
							<label class="layui-form-label">启用多规格：</label>
							<div class="layui-input-inline">
								<input type="checkbox" value="1" lay-skin="switch" name="spec_type" lay-filter="spec_type" lay-verify="spec_type">
								<input type="hidden" id="spec_type_status" value="0">
							</div>
						</div>

						<!-- 单规格 -->
						<div class="js-single-spec">

							<div class="layui-form-item">
								<label class="layui-form-label"><span class="required">*</span>销售价：</label>
								<div class="layui-input-block">
									<input type="text" name="price" placeholder="0.00" lay-verify="price" class="layui-input ns-len-short" autocomplete="off">
									<div class="layui-form-mid">元</div>
								</div>
								<div class="ns-word-aux">商品没有相关优惠活动的实际卖价</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">划线价：</label>
								<div class="layui-input-block">
									<input type="text" name="market_price" placeholder="0.00" lay-verify="market_price" class="layui-input ns-len-short" autocomplete="off">
									<div class="layui-form-mid">元</div>
								</div>
								<div class="ns-word-aux">商品没有优惠活动显示的划线价格，如果商品有折扣等优惠活动划线价显示销售价</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">成本价：</label>
								<div class="layui-input-block">
									<input type="text" name="cost_price" placeholder="0.00" class="layui-input ns-len-short" lay-verify="cost_price" autocomplete="off">
									<div class="layui-form-mid">元</div>
								</div>
								<div class="ns-word-aux">成本价将不会对前台会员展示，用于商家统计使用</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">重量：</label>
								<div class="layui-input-block">
									<input type="text" name="weight" placeholder="0.00" class="layui-input ns-len-short" lay-verify="weight" autocomplete="off">
									<div class="layui-form-mid">kg</div>
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">体积：</label>
								<div class="layui-input-block">
									<input type="text" name="volume" placeholder="0.00" class="layui-input ns-len-short" lay-verify="volume" autocomplete="off">
									<div class="layui-form-mid">m3</div>
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">商品编码：</label>
								<div class="layui-input-inline">
									<input type="text" name="sku_no" placeholder="请输入商品编码" maxlength="50" class="layui-input ns-len-long" autocomplete="off">
								</div>
							</div>

						</div>

						<!-- 多规格 -->
						<div class="js-more-spec">

							<!--规格项/规格值-->
							<div class="spec-edit-list"></div>

							<div class="layui-form-item js-add-spec">
								<label class="layui-form-label"></label>
								<div class="layui-input-inline">
									<button class="layui-btn ns-bg-color" type="button">添加规格</button>
								</div>
							</div>

							<div class="layui-form-item batch-operation-sku">
								<label class="layui-form-label">批量操作：</label>
								<div class="layui-input-inline">
									<span class="ns-text-color" data-field="spec_name">副标题</span>
									<span class="ns-text-color" data-field="price" data-verify="price">销售价</span>
									<span class="ns-text-color" data-field="market_price" data-verify="market_price">划线价</span>
									<span class="ns-text-color" data-field="cost_price" data-verify="cost_price">成本价</span>
									<span class="ns-text-color" data-field="stock" data-verify="stock">库存</span>
									<span class="ns-text-color" data-field="stock_alarm" data-verify="stock_alarm">库存预警</span>
									<span class="ns-text-color" data-field="weight" data-verify="weight">重量(kg)</span>
									<span class="ns-text-color" data-field="volume" data-verify="volume">体积(m³)</span>
									<span class="ns-text-color" data-field="sku_no" data-verify="">商品编码</span>
									<input type="text" class="layui-input ns-len-short" name="batch_operation_sku" autocomplete="off" />
									<button class="layui-btn ns-bg-color confirm" type="button">确定</button>
									<button class="layui-btn layui-btn-primary cancel" type="button">取消</button>
								</div>
							</div>

							<!--sku列表-->
							<div class="layui-form-item sku-table">
								<label class="layui-form-label"></label>
								<div class="layui-input-block"></div>
							</div>

						</div>

						<div class="layui-form-item js-goods-stock-wrap">
							<label class="layui-form-label"><span class="required">*</span>库存：</label>
							<div class="layui-input-block">
								<input type="number" name="goods_stock" placeholder="0" lay-verify="goods_stock" class="layui-input ns-len-short" autocomplete="off">
								<div class="layui-form-mid">件</div>
							</div>
						</div>

						<div class="layui-form-item js-goods-stock-wrap">
							<label class="layui-form-label">库存预警：</label>
							<div class="layui-input-block">
								<input type="number" name="goods_stock_alarm" placeholder="0" lay-verify="goods_stock_alarm" class="layui-input ns-len-short" autocomplete="off">
								<div class="layui-form-mid">件</div>
							</div>
							<div class="ns-word-aux">商品库存少于预警数量，商品列表库存数量标红显示，0为不预警。</div>
						</div>
					</div>
				</div>

				<!-- 配送信息 -->
				<div class="layui-card ns-card-common">
					<div class="layui-card-header">
						<span class="ns-card-title">配送信息</span>
					</div>
					<div class="layui-card-body">

						<div class="layui-form-item">
							<label class="layui-form-label">是否免邮：</label>
							<div class="layui-input-block">
								<input type="radio" name="is_free_shipping" value="1" title="是" lay-filter="is_free_shipping" checked>
								<input type="radio" name="is_free_shipping" value="0" title="否" lay-filter="is_free_shipping">
							</div>
						</div>

						<div class="layui-form-item js-shipping-template">
							<label class="layui-form-label">运费模板：</label>
							<div class="layui-input-inline">
								<select name="shipping_template" lay-search="" lay-verify="shipping_template">
									<option value="">请选择运费模板</option>
									<?php if(is_array($express_template_list) || $express_template_list instanceof \think\Collection || $express_template_list instanceof \think\Paginator): if( count($express_template_list)==0 ) : echo "" ;else: foreach($express_template_list as $key=>$vo): ?>
									<option value="<?php echo htmlentities($vo['template_id']); ?>"><?php echo htmlentities($vo['template_name']); ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
							<div class="layui-input-inline">
								<a class="default ns-text-color" href="<?php echo addon_url('shop/express/addtemplate'); ?>" target="_blank">配送管理</a>
							</div>
						</div>
					</div>
				</div>

				<!-- 其他信息 -->
				<div class="layui-card ns-card-common">
					<div class="layui-card-header">
						<span class="ns-card-title">其他信息</span>
					</div>

					<div class="layui-card-body">

						<div class="layui-form-item">
							<label class="layui-form-label">限购：</label>
							<div class="layui-input-block">
								<input type="number" name="max_buy" placeholder="" lay-verify="max_buy" class="layui-input ns-len-short" autocomplete="off">
								<div class="layui-form-mid">件</div>
							</div>
							<div class="ns-word-aux">该限购为终身限购，0为不限购</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">起售：</label>
							<div class="layui-input-block">
								<input type="number" name="min_buy" placeholder="" lay-verify="min_buy" class="layui-input ns-len-short" autocomplete="off">
								<div class="layui-form-mid">件</div>
							</div>
							<div class="ns-word-aux">起售数量超出商品库存时，买家无法购买该商品</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">单位：</label>
							<div class="layui-input-block">
								<input type="text" name="unit" placeholder="请输入单位" autocomplete="off" class="layui-input ns-len-short">
							</div>
						</div>

<!--						<div class="layui-form-item">-->
<!--							<label class="layui-form-label">排序：</label>-->
<!--							<div class="layui-input-block">-->
<!--								<input type="number" name="sort" class="layui-input ns-len-short" placeholder="0" autocomplete="off">-->
<!--							</div>-->
<!--							<div class="ns-word-aux">商品默认排序号为0，数字越大，排序越靠前，数字重复，则最新添加的靠前。</div>-->
<!--						</div>-->

						<div class="layui-form-item goods_state">
							<label class="layui-form-label"><span class="required">*</span>是否上架：</label>
							<div class="layui-input-block">
								<input type="radio" name="goods_state" value="1" title="立刻上架" checked lay-filter="goods_state">
								<input type="radio" name="goods_state" value="0" title="放入仓库" lay-filter="goods_state">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">定时下架：</label>
							<div class="layui-input-block">
								<input type="radio" name="timer_off_status" value="1" title="启用" lay-filter="timer_off">
								<input type="radio" name="timer_off_status" value="2" title="不启用" checked lay-filter="timer_off">
							</div>
							<div class="ns-word-aux">启用定时下架后，到达设定时间，此商品将自动下架。</div>
						</div>

						<div class="layui-form-item timer_off">
							<label class="layui-form-label"></label>
							<div class="layui-input-inline">
								<input type="text" id="timer_off" name="timer_off" class="layui-input ns-len-mid" autocomplete="off" readonly>
								<i class="ns-calendar"></i>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">是否开启问卷调查：</label>
							<div class="layui-input-block" >
								<input type="radio" name="wj_off" value="1" title="启用"  lay-filter="wj_off">
								<input type="radio" name="wj_off" value="2" title="不启用" checked lay-filter="wj_off">
							</div>

						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">销售额：</label>
							<div class="layui-input-block" >
								<input type="radio" name="is_sale" value="0" title="不展示"  lay-filter="is_sale">
								<input type="radio" name="is_sale" value="1" title="展示" checked lay-filter="is_sale">
							</div>

						</div>
					</div>
				</div>
			</div>

			<!-- 商品详情 -->
			<div class="layui-tab-item">
				<div class="ns-form">
					<div class="layui-form-item">
						<label class="layui-form-label">商品详情：</label>
						<div class="layui-input-inline ns-special-length">
							<script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
						</div>
					</div>
				</div>
				<script type="text/javascript" charset="utf-8" src="http://www.hunqin.com/public/static/ext/ueditor/ueditor.config.js"></script>
				<script type="text/javascript" charset="utf-8" src="http://www.hunqin.com/public/static/ext/ueditor/ueditor.all.js"> </script>
				<script type="text/javascript" charset="utf-8" src="http://www.hunqin.com/public/static/ext/ueditor/lang/zh-cn/zh-cn.js"></script>
			</div>

			<!-- 商品属性 -->
			<div class="layui-tab-item">
				<div class="ns-form">
					<div class="layui-form-item">
						<label class="layui-form-label">参数模板：</label>
						<div class="layui-input-block ns-len-mid">
							<select name="goods_attr_class" lay-search="" lay-filter="goods_attr_class">
								<option value="">请选择参数模板</option>
								<?php if(is_array($attr_class_list) || $attr_class_list instanceof \think\Collection || $attr_class_list instanceof \think\Paginator): if( count($attr_class_list)==0 ) : echo "" ;else: foreach($attr_class_list as $key=>$vo): ?>
								<option value="<?php echo htmlentities($vo['class_id']); ?>"><?php echo htmlentities($vo['class_name']); ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<input type="hidden" name="goods_attr_name" />
						</div>
						<div class="ns-word-aux">商品可以添加自定义参数，也可以通过参数模板批量设置参数</div>
					</div>

					<div class="layui-form-item js-new-attr-list">
						<label class="layui-form-label"></label>
						<div class="layui-input-block">
							<div class="layui-form">
								<table class="layui-table">
									<colgroup>
										<col width="30%" />
										<col width="40%" />
										<col width="20%" />
										<col width="10%" />
									</colgroup>
									<thead>
									<tr>
										<th>参数名</th>
										<th>参数值</th>
										<th class="ns-prompt-block">
											排序
											<div class="ns-prompt">
												<i class="iconfont iconwenhao1"></i>
												<div class="ns-prompt-box">
													<div class="ns-prompt-con">设置排序，改变商品参数展示顺序</div>
												</div>
											</div>
										</th>
										<th>操作</th>
									</tr>
									</thead>
									<tbody class="ns-attr-new">
										<tr class="ns-null-data">
											<td colspan="4" align="center">无数据</td>
										</tr>
									</tbody>
								</table>
							</div>
							<button class="layui-btn layui-btn-primary" onclick="addNewAttr()">添加参数</button>
						</div>
					</div>
				</div>
			</div>

			<!--	问卷调查-->

			<div class="layui-tab-item" >
				<div class="ns-form">
					<table id="myTable" class="insert-tab" width="100%">
						<tbody>
						<tr>
							<th width="10%"><i class="require-red">*</i>问卷名称：</th>
							<td>
								<input class="common-text required" id="catename" name="catename" size="50" value="" type="text">
							</td>
						</tr>
						<tr>
							<th>问卷描述：</th>
							<td><textarea name="desc" class="common-textarea" id="desc" cols="30" style="width: 50%;" rows="2"></textarea></td>
						</tr>
						<tr>
							<td>
								<p style="text-align: right;">问题 1</p>
								<a href="#del" class="delwt" style="text-align: right;"> <p  >-删除问题</p> </a>
							</td>
							<td>
								<p>问题标题</p><input class="common-text" id="title1" name="title[]" size="50" value="" type="text">
								<p>问题类型：
									<input name="type[0]" value="0" type="radio" checked="" lay-filter="type_status"/> 单选题
									<input name="type[0]" value="2" type="radio" lay-filter="type_status" /> 填空题
								</p>
								<div class="ipt_div">
								<p>选项1：<input class="common-text" name="answer1[]" size="50" value="" type="text"></p>
								<p>选项2：<input class="common-text" name="answer2[]" size="50" value="" type="text"></p>
								<p>选项3：<input class="common-text" name="answer3[]" size="50" value="" type="text"></p>
								<p>选项4：<input class="common-text" name="answer4[]" size="50" value="" type="text"></p>
								<p>选项5：<input class="common-text" name="answer5[]" size="50" value="" type="text"></p>
								<p>选项6：<input class="common-text" name="answer6[]" size="50" value="" type="text"></p>
								</div>
							</td>
						</tr></table>
					<table   class="insert-tab" width="100%">
						<tr><th width="10%">



							<a href="#num"> <p  onclick="insRow()">＋增加一个问题</p> </a>
						</th><td> </td></tr>
						<tr>
							<th></th>
							<td>
						<span id="num" style="display: none">1</span>
							</td>
						</tr>
						</tbody></table><p style="height: 250px"> </p>
				</div>
			</div>

		</div>
	</div>

	<div class="fixed-btn">
		<button class="layui-btn layui-btn-primary ns-border-color ns-text-color js-prev" lay-submit="" lay-filter="prev">上一步</button>
		<button class="layui-btn ns-bg-color js-save" lay-submit="" lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary ns-border-color ns-text-color js-next" lay-submit="" lay-filter="next">下一步</button>
	</div>
</div>

<!--选择商品分类-->
<script type="text/html" id="selectedCategory">

	<div class="category-list">

		<div class="item">
			<!--后续做搜索-->
			<ul>
				<?php if(is_array($goods_category_list) || $goods_category_list instanceof \think\Collection || $goods_category_list instanceof \think\Paginator): if( count($goods_category_list)==0 ) : echo "" ;else: foreach($goods_category_list as $key=>$vo): ?>
				{{# if(d.category_id_1 == '<?php echo htmlentities($vo['category_id']); ?>' ){ }}
				<li data-category-id="<?php echo htmlentities($vo['category_id']); ?>" data-commission-rate="<?php echo htmlentities($vo['commission_rate']); ?>" data-level="<?php echo htmlentities($vo['level']); ?>" class="selected">
					{{# }else{ }}
				<li data-category-id="<?php echo htmlentities($vo['category_id']); ?>" data-commission-rate="<?php echo htmlentities($vo['commission_rate']); ?>" data-level="<?php echo htmlentities($vo['level']); ?>">
					{{# } }}
					<span class="category-name"><?php echo htmlentities($vo['category_name']); ?></span>
					<span class="right-arrow"></span>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>

		<div class="item" data-level="2">
			<!--后续做搜索-->
			<ul></ul>
		</div>

		<div class="item" data-level="3">
			<!--后续做搜索-->
			<ul></ul>
		</div>

	</div>

	<div class="selected-category-wrap">
		<label>您当前选择的是：</label>
		<span class="js-selected-category"></span>
	</div>
</script>

<!--规格项模板-->
<script type="text/html" id="specTemplate">

	{{# for(var i=0;i<d.list.length;i++){ }}
	<div class="spec-item" data-index="{{i}}">
		<div class="layui-form-item spec">
			<label class="layui-form-label">规格项{{i+1}}：</label>
			<div class="layui-input-inline">
				<select name="spec_item">
					<option value="0"></option>
					{{# if(d.list[i].spec_name != ''){ }}
					<option value="{{d.list[i].spec_id}}" data-attr-name="{{d.list[i].spec_name}}" selected>{{d.list[i].spec_name}}</option>
					{{# }else{ }}
					{{# } }}
				</select>
				<i class="layui-icon layui-icon-close" data-index="{{i}}"></i>
			</div>

			{{# if(i==0){ }}
			<div class="layui-input-inline">
				{{# if(d.add_spec_img){ }}
				<input type="checkbox" name="add_spec_img" title="添加规格图片" lay-skin="primary" lay-filter="add_spec_img" checked>
				{{# }else{ }}
				<input type="checkbox" name="add_spec_img" title="添加规格图片" lay-skin="primary" lay-filter="add_spec_img">
				{{# } }}
			</div>
			{{# } }}
		</div>

		{{# if(d.list[i].spec_name != ''){ }}
		<div class="layui-form-item spec-value">
			{{# }else{ }}
			<div class="layui-form-item spec-value" style="display:none;">
				{{# } }}
				<label class="layui-form-label"></label>
				<div class="layui-input-block spec-value">
					{{# if(d.list[i].value.length){ }}
					<ul>
						{{# for(var j=0;j<d.list[i].value.length;j++){ }}
						<li data-index="{{j}}" data-parent-index="{{i}}" >
							{{# if(i==0 && d.add_spec_img){ }}
							<div class="img-wrap">
								{{# if(d.list[i].value[j].image){ }}
								<img src="{{ns.img(d.list[i].value[j].image)}}" alt="">
								{{# }else{ }}
								<img src="http://www.hunqin.com/app/shop/view/public/img/goods_spec_value_empty.png" alt="">
								{{# } }}
							</div>
							{{# } }}
							<span>{{d.list[i].value[j].spec_value_name}}</span>
							<i class="layui-icon layui-icon-close" data-parent-index="{{i}}" data-index="{{j}}"></i>
						</li>
						{{# } }}
					</ul>
					{{# } }}

					<a class="ns-text-color" href="javascript:;" data-index="{{i}}">+添加规格值</a>

					<div class="add-spec-value-popup" data-index="{{i}}">
						<select name="spec_value_item"></select>
						<button class="layui-btn layui-btn-primary ns-border-color ns-text-color js-cancel-spec-value">取消</button>
					</div>

				</div>
			</div>

		</div>
		{{# } }}
</script>

<!--SKU列表模板-->
<script type="text/html" id="skuTableTemplate">

	{{# if(d.skuList.length){ }}
	<table class="layui-table">
		<colgroup></colgroup>
		<thead>
		<tr>
			{{# if(d.showSpecName){ }}
			<th colspan="{{d.colSpan}}" style="min-width: 60px;">商品规格</th>
			{{# } }}
			<th rowspan="{{d.rowSpan}}">SKU图片</th>
			<th rowspan="{{d.rowSpan}}">副标题</th>
			<th rowspan="{{d.rowSpan}}"><span class="required">*</span>销售价</th>
			<th rowspan="{{d.rowSpan}}">划线价</th>
			<th rowspan="{{d.rowSpan}}">成本价</th>
			<th rowspan="{{d.rowSpan}}"><span class="required">*</span>库存</th>
			<th rowspan="{{d.rowSpan}}">库存预警</th>
			<th rowspan="{{d.rowSpan}}">重量(kg)</th>
			<th rowspan="{{d.rowSpan}}">体积(m³)</th>
			<th rowspan="{{d.rowSpan}}">SKU编码</th>
			<th rowspan="{{d.rowSpan}}" style="white-space: nowrap;">默认展示</th>
		</tr>
		{{# if(d.colSpan>1){ }}
		<tr>
			{{# for(var i=0;i<d.specList.length;i++){ }}
			<th>{{d.specList[i].spec_name}}</th>
			{{# } }}
		</tr>
		{{# } }}
		</thead>
		<tbody>
		{{# for(var i=0;i<d.skuList.length;i++){ }}
		<tr>
			<td id="sku_img_{{i}}">
				{{# for(var j=0;j<d.skuList[i].sku_images_arr.length;j++){ }}
				<div class="img-wrap" data-index="{{j}}" data-parent-index="{{i}}">
					<a href="javascript:void(0)">
						<img src="{{ns.img(d.skuList[i].sku_images_arr[j],'small')}}" layer-src />
					</a>
					<div class="operation">
						<i title="图片预览" class="iconfont iconreview js-preview"></i>
						<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
					</div>
				</div>
				{{# } }}
				{{# if(d.skuList[i].sku_images_arr.length<d.goods_sku_max){ }}
				<div class="upload-sku-img" data-index="{{i}}"><i class="layui-icon layui-icon-add-1"></i></div>
				{{# } }}
			</td>
			<td>
				<input type="text" name="spec_name" placeholder="副标题" maxlength="100" value="{{d.skuList[i].spec_name}}" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="price" placeholder="销售价" lay-verify="sku_price" value="{{d.skuList[i].price}}" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="market_price" placeholder="划线价" value="{{d.skuList[i].market_price}}" lay-verify="sku_market_price" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="cost_price" placeholder="成本价" value="{{d.skuList[i].cost_price}}" lay-verify="sku_cost_price" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="stock" placeholder="库存" value="{{d.skuList[i].stock}}" lay-verify="sku_stock" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="stock_alarm" placeholder="库存预警" value="{{d.skuList[i].stock_alarm}}" lay-verify="sku_stock_alarm" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="weight" placeholder="重量(kg)" value="{{d.skuList[i].weight}}" lay-verify="sku_weight" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="volume" placeholder="体积(m³)" value="{{d.skuList[i].volume}}" lay-verify="sku_volume" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td>
				<input type="text" name="sku_no" placeholder="SKU编码" value="{{d.skuList[i].sku_no}}" maxlength="50" class="layui-input ns-len-small" autocomplete="off" data-index="{{i}}">
			</td>
			<td style="min-width: 40px;">
				<div class="is-default" data-index="{{i}}" lay-filter="is_default_{{i}}">
					{{# if(d.skuList[i].is_default == 1) { }}
					<input type="checkbox" data-index="{{i}}" name="is_default" lay-filter="is_default_{{i}}" lay-skin="switch" checked>
					{{# }else { }}
					<input type="checkbox" data-index="{{i}}" name="is_default" lay-filter="is_default_{{i}}" lay-skin="switch">
					{{# } }}
				</div>
			</td>
		</tr>
		{{# } }}

		</tbody>
	</table>
	{{# } }}
	<div class="ns-word-aux ns-text-color" style="margin: 10px 0 0 0;">默认展示，是多规格商品在客户访问商品时，默认显示的商品规格</div>
</script>

<!--商品主图列表-->
<script type="text/html" id="goodsImage">
	{{# if(d.list.length){ }}
	{{# for(var i=0;i<d.list.length;i++){ }}
	<div class="item upload_img_square_item" data-index="{{i}}">
		<div class="img-wrap">
			<img src="{{ns.img(d.list[i])}}" layer-src>
		</div>
		<div class="operation">
			<i title="图片预览" class="iconfont iconreview js-preview"></i>
			<i title="删除图片" class="layui-icon layui-icon-delete js-delete" data-index="{{i}}"></i>
			<div class="replace_img" data-index="{{i}}">点击替换</div>
		</div>
	</div>
	{{# } }}
	{{# if(d.list.length < d.max){ }}
	<div class="item js-add-goods-image">+</div>
	{{# } }}
	{{# }else{ }}
	<div class="item js-add-goods-image">+</div>
	{{# } }}
</script>

<!--属性列表模板-->
<script type="text/html" id="attrTemplate">
	{{# for(var i=0;i<d.list.length;i++){ }}
	<tr class="goods-attr-tr goods-attr-temp" data-attr-class-id="{{d.list[i].attr_class_id}}" data-attr-class-name="{{d.list[i].attr_class_name}}" data-attr-id="{{d.list[i].attr_id}}" data-attr-name="{{d.list[i].attr_name}}" data-attr-type="{{d.list[i].attr_type}}">
		<td>{{d.list[i].attr_name}}</td>
		<td>
			{{# if(d.list[i].attr_type == 1){ }}
			{{# for(var j=0;j<d.list[i].attr_value_format.length;j++){ }}
			<input type="radio" name="attr_value_{{d.list[i].attr_id}}" value="{{d.list[i].attr_value_format[j].attr_value_id}}" title="{{d.list[i].attr_value_format[j].attr_value_name}}" data-attr-value-name="{{d.list[i].attr_value_format[j].attr_value_name}}" />
			{{# } }}
			{{# }else if(d.list[i].attr_type == 2){ }}
			{{# for(var j=0;j<d.list[i].attr_value_format.length;j++){ }}
			<input type="checkbox" name="attr_value_{{d.list[i].attr_id}}" value="{{d.list[i].attr_value_format[j].attr_value_id}}" title="{{d.list[i].attr_value_format[j].attr_value_name}}" data-attr-value-name="{{d.list[i].attr_value_format[j].attr_value_name}}" lay-skin="primary">
			{{# } }}
			{{# }else if(d.list[i].attr_type == 3){ }}
			<input type="text" name="attr_value_{{d.list[i].attr_id}}" placeholder="{{d.list[i].attr_name}}" class="layui-input ns-len-mid" autocomplete="off">
			{{# } }}
		</td>
		<td><input type="number" name="" value="{{d.list[i].sort ? d.list[i].sort : 0}}" placeholder="" class="layui-input attr-sort" autocomplete="off"></td>
		<td><div class="ns-table-btn"><a class="layui-btn" onclick="delAttr(this)">删除</a></div></td>
	</tr>
	{{# } }}
</script>

<!--店内分类-->
<script type="text/html" id="goodsShopCategory">
{{# for(var i=0;i<d.list.length;i++){ }}
<div class="item" data-index="{{i}}">
	<select id="category" name="goods_shop_category_{{i}}" lay-search="" lay-filter="goods_shop_category_{{i}}" data-index="{{i}}">
		<option value=""></option>
		<?php if(is_array($goods_shop_category_list) || $goods_shop_category_list instanceof \think\Collection || $goods_shop_category_list instanceof \think\Paginator): if( count($goods_shop_category_list)==0 ) : echo "" ;else: foreach($goods_shop_category_list as $key=>$vo): ?>
		{{# if(d.list[i] == <?php echo htmlentities($vo['category_id']); ?> ){ }}
		<option value="<?php echo htmlentities($vo['category_id']); ?>" selected><?php echo htmlentities($vo['category_name']); ?></option>
		{{# }else{ }}
		<option value="<?php echo htmlentities($vo['category_id']); ?>"><?php echo htmlentities($vo['category_name']); ?></option>
		{{# } }}
		<?php if(!(empty($vo['child_list']) || (($vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator ) && $vo['child_list']->isEmpty()))): if(is_array($vo['child_list']) || $vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator): if( count($vo['child_list'])==0 ) : echo "" ;else: foreach($vo['child_list'] as $key=>$second): ?>
		{{# if(d.list[i] == <?php echo htmlentities($second['category_id']); ?> ){ }}
		<option value="<?php echo htmlentities($second['category_id']); ?>" selected>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($second['category_name']); ?></option>
		{{# }else{ }}
		<option value="<?php echo htmlentities($second['category_id']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($second['category_name']); ?></option>
		{{# } }}
		<?php endforeach; endif; else: echo "" ;endif; ?>
		<?php endif; ?>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
	<i class="layui-icon layui-icon-close" data-index="{{i}}"></i>
</div>
{{# } }}
</script>

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>http://www.hunqin.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>http://www.hunqin.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
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


<script src="http://www.hunqin.com/public/static/ext/drag-arrange.js"></script>
<script src="http://www.hunqin.com/public/static/ext/video/videojs-ie8.min.js"></script>
<script src="http://www.hunqin.com/public/static/ext/video/video.min.js"></script>
<script src="http://www.hunqin.com/public/static/ext/searchable_select/searchable_select.js"></script>
<script src="http://www.hunqin.com/app/shop/view/public/js/goods_edit.js"></script>
<script src="http://www.hunqin.com/app/shop/view/public/js/category_select.js"></script>
<script>
	function insRow()
	{

		n = parseFloat(num.innerHTML)+1;
		num.innerHTML= n;
		 s=n-1;
		var x=document.getElementById('myTable').insertRow(-1)
		var y=x.insertCell(0)
		var z=x.insertCell(1)
		y.innerHTML='<p style="text-align: right;"> 问题 ' + n + '&nbsp; <a href="#del" class="delwt"> <p   style="text-align: right;">-删除问题</p></a> </p>'
		z.innerHTML='<p>问题标题</p><input class="common-text" name="title[]" size="50" value="" type="text">                                        <p>问题类型：<input name="type[' + s + ']" value="0" type="radio" checked="" style="display:inline-block" class="xuanzhe"/>  单选题  <input name="type[' + s + ']" value="2" type="radio" style="display:inline-block" class="tiankong" /> 填空题</p>                                        <div class="ipt_div"><p>选项1：<input class="common-text" name="answer1[]" size="50" value="" type="text"></p>                                        <p>选项2：<input class="common-text" name="answer2[]" size="50" value="" type="text"></p>                                        <p>选项3：<input class="common-text" name="answer3[]" size="50" value="" type="text"></p>                                        <p>选项4：<input class="common-text" name="answer4[]" size="50" value="" type="text"></p>                                        <p>选项5：<input class="common-text" name="answer5[]" size="50" value="" type="text"></p>                                        <p>选项6：<input class="common-text" name="answer6[]" size="50" value="" type="text"></p></div>'
	}

	function tiankong() {
		$(this).parent().parent().find('.ipt_div').css('display','none');
	}
	function xuanzhe() {
		$(this).parent().parent().find('.ipt_div').css('display','inline-block');
	}
	$(function () {
		$('body').on("click",'.xuanzhe',function () {
			$(this).parent().parent().find('.ipt_div').css('display','inline-block');
		})
		$('body').on("click",'.tiankong',function () {
			$(this).parent().parent().find('.ipt_div').css('display','none');
		})
		$('body').on("click",'.delwt',function () {
			$(this).parents('tr').remove();
			num.innerHTML = parseFloat(num.innerHTML) -1;
		})

	})

</script>

</body>

</html>