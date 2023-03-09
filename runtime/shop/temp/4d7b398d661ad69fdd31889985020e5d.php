<?php /*a:3:{s:64:"/www/wwwroot/ls.chnssl.com/app/shop/view/orderrefund/detail.html";i:1614516208;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;s:71:"/www/wwwroot/ls.chnssl.com/app/shop/view/orderrefund/refund_action.html";i:1656568300;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/order_detail.css"/>
<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/shop/view/public/css/refund_detail.css" />

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
			
				
<div class="order-detail">
    <div class="layui-row layui-col-space1 order-detail-info" >
        <div class="layui-col-md4 order-detail-left" >
            <div class="layui-card">
                <div class="layui-card-header nav-title">退款订单信息</div>
                <div class="layui-card-body">
                    <div class="layui-form">
                    	 <div class="layui-form-item">
                            <label class="layui-form-label">订单编号：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($order_info['order_no']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">退款编号：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($detail['refund_no']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">买家：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><a class="ns-text-color" target="_blank" href='<?php echo addon_url("shop/member/detail?member_id=".$order_info["member_id"]); ?>'><?php echo htmlentities($order_info['nickname']); ?></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">申请人：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($order_info['name']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">申请时间：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo time_to_date($detail['refund_action_time']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item order-detail-hr"></div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">付款方式：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($order_info['pay_type_name']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">配送方式：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_info['delivery_type_name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">联系电话：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_info['mobile']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item order-detail-hr"></div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">订单类型：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_info['order_type_name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">营销活动：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_info['promotion_type_name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md8 order-detail-operation">
            <div class="layui-card">
                <div class="layui-card-header">退款状态：<?php echo htmlentities($detail['refund_status_name']); ?></div>
                <div class="layui-card-body">
                    <p class="order-detail-tips"></p>
                    <?php if(!empty($detail['refund_action'])): ?>
                    <div class="ns-form-row">
                        <?php foreach($detail['refund_action'] as $k => $v): ?>
                        <button type="button" class="layui-btn ns-bg-color" onclick="<?php echo htmlentities($v['event']); ?>(<?php echo htmlentities($detail['order_goods_id']); ?>);"><?php echo htmlentities($v['title']); ?></button>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <br>
                    <i class="layui-icon  layui-icon-about"></i>
                </div>
            </div>
        </div>
        <div class="order-detail-dl">
            <dl>
                <dt>温馨提醒</dt>
                <dd>如果未发货，请点击同意退款给买家。</dd>
                <dd>如果实际已发货，请主动与买家联系。</dd>
                <dd>如果订单整体退款后，优惠券和余额会退还给买家。</dd>
            </dl>
        </div>
    </div>
</div>

<div>
    <div class="layui-row ns-form">
        <div class="layui-col-md4">
            <h4 class="refund-title">售后商品</h4>
            <ul class="refund-box">
                <li class="refund-item">
                    <div class="goods-item">
                        <div class="image-wrap">
							<?php if($detail['sku_image']): ?>
							<img alt="商品图片" layer-src src="<?php echo img($detail['sku_image']); ?>">
							<?php endif; ?>
                        </div>
                        <div class="detail-wrap">
                            <h4 class="title"><span><?php echo htmlentities($detail['sku_name']); ?></span></h4>
                            <p class="gray"></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="layui-col-md4">
            <h4 class="refund-title">售后信息</h4>
            <ul class="refund-box">
                <li class="refund-item">
                    <label class="refund-label">退款方式：</label>
                    <div class="refund-content"><span class="refund-money"><?php if($detail['refund_type'] == 1): ?>仅退款<?php else: ?>退货退款<?php endif; ?></span></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">退款金额：</label>
                    <div class="refund-content"><span class="refund-money">￥<?php echo htmlentities($detail['refund_apply_money']); if($detail['refund_delivery_money'] > 0): ?>(含运费￥<?php echo htmlentities($detail['refund_delivery_money']); ?>)<?php endif; ?></span> </div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">联系方式：</label>
                    <div class="refund-content"><?php echo htmlentities($order_info['mobile']); ?></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">退款原因：</label>
                    <div class="refund-content"><?php echo htmlentities($detail['refund_reason']); ?></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">退款说明：</label>
                    <div class="refund-content"><?php echo htmlentities($detail['refund_remark']); ?></div>
                </li>
            </ul>
        </div>
        <div class="layui-col-md4">
            <h4 class="refund-title">购买信息</h4>
            <ul class="refund-box">
                <li class="refund-item">
                    <label class="refund-label">商品单价：</label>
                    <div class="refund-content"><span class="refund-money">￥<?php echo htmlentities($detail['price']); ?></span> x<?php echo htmlentities($detail['num']); ?>件</div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">实付金额：</label>
                    <div class="refund-content"><span class="refund-money">￥<?php echo htmlentities($detail['real_goods_money']); ?></span></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">配送状态：</label>
                    <div class="refund-content"><?php echo htmlentities($detail['delivery_status_name']); ?> </div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">订单编号：</label>
                    <div class="refund-content"> <a target="_blank"class="ns-text-color" href="<?php echo addon_url('shop/order/detail',['order_id'=>$order_info['order_id']]); ?>"><?php echo htmlentities($order_info['order_no']); ?></a></div>
                </li>
            </ul>
        </div>

    </div>

    <?php if($detail['refund_type'] == 2 && $detail['refund_status'] > 1 && $detail['refund_delivery_no'] != ''): ?>
    <div class="refund-block ns-form">
        <h3 class="refund-block-title">退货物流</h3>
        <div class="refund-block-content">
            <ul class="refund-box">
                <li class="refund-item">
                    <label class="refund-label">物流公司：</label>
                    <div class="refund-content"><?php echo htmlentities($detail['refund_delivery_name']); ?></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">物流单号：</label>
                    <div class="refund-content"><?php echo htmlentities($detail['refund_delivery_no']); ?></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">物流说明：</label>
                    <div class="refund-content"><?php echo htmlentities($detail['refund_delivery_remark']); ?></div>
                </li>
                <li class="refund-item">
                    <label class="refund-label">是否入库：</label>
                    <div class="refund-content"><?php if($detail['is_refund_stock'] == 1): ?>入库<?php else: ?>不入库<?php endif; ?></div>
                </li>
            </ul>
        </div>
    </div>
    <?php endif; ?>
    <div class="refund-block ns-form">
        <h3 class="refund-block-title">售后日志</h3>
        <div class="refund-block-content">
            <ul class="layui-timeline">
                <?php foreach($detail['refund_log_list'] as $log_k => $log_item): ?>
                <li class="layui-timeline-item">
                    <?php if($log_item["action_way"] == 1): ?>
                    <span class="refund-way layui-timeline-axis refund-buyer">买</span>
                    <?php elseif($log_item["action_way"] == 2): ?>
                    <span class="refund-way layui-timeline-axis seller-buyer ns-bg-color">商</span>
                    <?php else: ?>
                    <span class="refund-way layui-timeline-axis platform-buyer">平</span>
                    <?php endif; ?>
                    <div class="layui-timeline-content layui-text">
                        <div class="layui-timeline-title"><?php echo htmlentities($log_item['action']); ?><span style="display:inline-block;float:right;margin-right:40px;"><?php echo time_to_date($log_item['action_time']); ?></span></div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
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


<!-- 维权操作 -->
<style>
    .refund-view-list{margin-top:20px;font-size:14px;line-height:20px;color:#323233;color:var(--theme-stroke-1,#323233)}
	.refund-view-item {margin-bottom: 10px;}
    /*!*display: -ms-flexbox;*!*//*!*display: flex;*!*/.refund-view-item-label{width:75px; vertical-align: top;}
    .refund-view-item-content{display:inline-block}
</style>
<!-- 售后申请同意 -->
<script type="text/html" id="refund_agree_html">
    <div style="padding:10px;">
        <div class="layui-form refund-agree-html" id='refund_agree'lay-filter="refund_agree">
            <div style="color: #666;">注意 : 该笔订单通过在线付款，商家同意后，退款将自动原路退回买家付款账户。</div>
            <div class="refund-view-list">
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款方式：</label>
                    <div class="refund-view-item-content"><?php if($detail['refund_type'] == 1): ?>仅退款<?php else: ?>退货退款<?php endif; ?></div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款金额：</label>
                    <div class="refund-view-item-content">
                        ￥<input type="text" class="layui-input" style="display:inline-block;width:60%" name="money" value="<?php echo htmlentities($detail['refund_apply_money']); if($detail['refund_delivery_money'] > 0): ?>(含运费￥<?php echo htmlentities($detail['refund_delivery_money']); ?>)<?php endif; ?>">
                        <span class="refund-money"></span>
                        <input type="hidden" class="layui-input" name="hidden_money" value="<?php echo htmlentities($detail['refund_apply_money']); if($detail['refund_delivery_money'] > 0): ?>(含运费￥<?php echo htmlentities($detail['refund_delivery_money']); ?>)<?php endif; ?>">
                    </div>
                    
                </div>
            </div>
            <input type="hidden" name="order_goods_id" value="<?php echo htmlentities($detail['order_goods_id']); ?>"/>
            <button class="layui-btn"  lay-submit id="submit_agree" lay-filter="submit_agree" style="display:none;">保存</button>
        </div>
    </div>
</script>
<!-- 售后申请拒绝 -->
<script type="text/html" id="refund_refuse_html">
    <div style="padding:10px;">
        <div class="layui-form refund-refuse-html" id='refund_refuse'lay-filter="refund_refuse">
            <div style="color: #666;">注意 : 建议你与买家协商后，再确定是否拒绝退款。如你拒绝退款后，买家可修改退款申请协议重新发起退款。</div>
            <div class="refund-view-list">
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款方式：</label>
                    <div class="refund-view-item-content"><?php if($detail['refund_type'] == 1): ?>仅退款<?php else: ?>退货退款<?php endif; ?></div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款金额：</label>
                    <div class="refund-view-item-content">
                        <span class="refund-money">￥<?php echo htmlentities($detail['refund_apply_money']); if($detail['refund_delivery_money'] > 0): ?>(含运费￥<?php echo htmlentities($detail['refund_delivery_money']); ?>)<?php endif; ?></span>
                    </div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">拒绝理由：</label>
                    <div class="refund-view-item-content">
                        <textarea name="refund_refuse_reason" placeholder="请填写您的拒绝理由!" class="layui-textarea ns-len-mid" style="overflow: hidden;word-wrap: break-word;resize: horizontal;height: 54px;"></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" name="order_goods_id" value="<?php echo htmlentities($detail['order_goods_id']); ?>"/>
            <button class="layui-btn"  lay-submit id="submit_refuse" lay-filter="submit_refuse" style="display:none;">保存</button>
        </div>
    </div>
</script>
<!-- 买家退货接收 -->
<script type="text/html" id="refund_take_delivery_html">
    <div style="padding:10px;">
        <div class="layui-form refund-take-delivery-html" id='refund_take_delivery'lay-filter="refund_take_delivery">
            <div style="color: #666;">注意 : 需你同意退款申请，买家才能退货给你；买家退货后你需再次确认收货后，退款将自动原路退回至买家付款账户。</div>
            <div class="refund-view-list">
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款方式：</label>
                    <div class="refund-view-item-content"><?php if($detail['refund_type'] == 1): ?>仅退款<?php else: ?>退货退款<?php endif; ?></div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款金额：</label>
                    <div class="refund-view-item-content">
                        <span class="refund-money">￥<?php echo htmlentities($detail['refund_apply_money']); if($detail['refund_delivery_money'] > 0): ?>(含运费￥<?php echo htmlentities($detail['refund_delivery_money']); ?>)<?php endif; ?></span>
                    </div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退货地址：</label>
                    <div class="refund-view-item-content"><?php echo htmlentities($detail['refund_address']); ?></div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">是否入库：</label>
                    <div class="refund-view-item-content">
                        <input type="radio" name="is_refund_stock" value="0" title="否"lay-skin="primary" checked>
                        <input type="radio" name="is_refund_stock" value="1" title="是"lay-skin="primary">
                    </div>
                </div>
            </div>
            <input type="hidden" name="order_goods_id" value="<?php echo htmlentities($detail['order_goods_id']); ?>"/>
            <button class="layui-btn"  lay-submit id="submit_take_delivery" lay-filter="submit_take_delivery" style="display:none;">保存</button>
        </div>
    </div>
</script>
<!-- 转账退款接收 -->
<script type="text/html" id="refund_transfer_html">
    <div style="padding:10px;">
        <div class="layui-form refund-transfer-html" id='refund_transfer'lay-filter="refund_transfer">
            <div style="color: #666;">注意 : 当你确认转账后，退款将自动原路退回至买家付款账户。</div>
            <div class="refund-view-list">
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款方式：</label>
                    <div class="refund-view-item-content"><?php if($detail['refund_type'] == 1): ?>仅退款<?php else: ?>退货退款<?php endif; ?></div>
                </div>
                <div class="refund-view-item">
                    <label class="refund-view-item-label">退款金额：</label>
                    <div class="refund-view-item-content">
                        <span class="refund-money">￥<?php echo htmlentities($detail['refund_apply_money']); if($detail['refund_delivery_money'] > 0): ?>(含运费￥<?php echo htmlentities($detail['refund_delivery_money']); ?>)<?php endif; ?></span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="order_goods_id" value="<?php echo htmlentities($detail['order_goods_id']); ?>"/>
            <button class="layui-btn"  lay-submit id="submit_transfer" lay-filter="submit_transfer" style="display:none;">保存</button>
        </div>
    </div>
</script>

<script>
    var laytpl;
    var form;
    //渲染模板引擎
    layui.use(['laytpl','form'], function(){
        laytpl = layui.laytpl;
        form = layui.form;
		form.render();
    });
    /**
     * 同意
     */
    function orderRefundAgree(order_goods_id) {

        //获取模板
        var getTpl = $("#refund_agree_html").html();
        var data = [];
        //渲染模板
        laytpl(getTpl).render(data, function(html) {
            layer.open({
                type: 1,
                shadeClose: true,
                shade: 0.3,
                offset: 'auto',
                scrollbar: true,
                fixed: false,
                title: "售后维权处理",
                area: ['700px', 'auto'],
                btn: ['确认退款', '取消'],
                yes: function(index, layero){
                    $("#submit_agree").click();
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
                    
                     
                    form.on('submit(submit_agree)', function(data){
                        if(repeat_flag)return;
                        
                        
                    
                        repeat_flag = true;
                        $.ajax({
                            url: ns.url("shop/orderrefund/agree"),
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
    /**
     * 拒绝
     */
    function orderRefundRefuse(order_goods_id) {

        //获取模板
        var getTpl = $("#refund_refuse_html").html();
        var data = [];
        //渲染模板
        laytpl(getTpl).render(data, function(html) {
            layer.open({
                type: 1,
                shadeClose: true,
                shade: 0.3,
                offset: 'auto',
                scrollbar: true,
                fixed: false,
                title: "售后维权处理",
                area: ['700px', 'auto'],
                btn: ['确认拒绝', '取消'],
                yes: function(index, layero){
                    $("#submit_refuse").click();
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

                    form.on('submit(submit_refuse)', function(data){
                        if(repeat_flag)return;
                        repeat_flag = true;
                        $.ajax({
                            url: ns.url("shop/orderrefund/refuse"),
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
    /**
     * 买家退货接收
     */
    function orderRefundTakeDelivery(order_goods_id) {

        //获取模板
        var getTpl = $("#refund_take_delivery_html").html();
        var data = [];
        //渲染模板
        laytpl(getTpl).render(data, function(html) {
            layer.open({
                type: 1,
                shadeClose: true,
                shade: 0.3,
                offset: 'auto',
                scrollbar: true,
                fixed: false,
                title: "售后维权处理",
                area: ['700px', 'auto'],
                btn: ['确认收到退货', '取消'],
                yes: function(index, layero){
                    $("#submit_take_delivery").click();
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

                    form.on('submit(submit_take_delivery)', function(data){
                        if(repeat_flag)return;
                        repeat_flag = true;
                        $.ajax({
                            url: ns.url("shop/orderrefund/receive"),
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

    /**
     * 退款转账
     */
    function orderRefundTransfer(order_goods_id) {

        //获取模板
        var getTpl = $("#refund_transfer_html").html();
        var data = [];
        //渲染模板
        laytpl(getTpl).render(data, function(html) {
            layer.open({
                type: 1,
                shadeClose: true,
                shade: 0.3,
                offset: 'auto',
                scrollbar: true,
                fixed: false,
                title: "售后维权处理",
                area: ['700px', 'auto'],
                btn: ['确认转账', '取消'],
                yes: function(index, layero){
                    $("#submit_transfer").click();
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

                    form.on('submit(submit_transfer)', function(data){
                        if(repeat_flag)return;
                        repeat_flag = true;
                        $.ajax({
                            url: ns.url("shop/orderrefund/complete"),
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
</script>

</body>

</html>