<?php /*a:2:{s:59:"/www/wwwroot/ls.chnssl.com/app/admin/view/order/detail.html";i:1661755379;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞有情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞有情')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/admin/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/app/admin/view/public/img/"
		};

	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		@media only screen and (max-width: 1130px) {
			.layui-nav .layui-nav-item a {
				margin-left: 25px;
			}
		}
		@media only screen and (max-width: 1030px) {
			.layui-nav .layui-nav-item a {
				margin-left: 10px;
			}
		}
	</style>
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/admin/view/public/css/order_detail.css"/>
<link rel="stylesheet" href="https://ls.chnssl.com/app/admin/view/public/css/package.css"/>

</head>
<body>

<div class="ns-logo">
	
	<span>赞有情平台端</span>

</div>

<div class="layui-layout layui-layout-admin">
	
	<div class="layui-header">
		<!-- 一级菜单 -->
		<ul class="layui-nav layui-layout-left">
			<?php $second_menu = []; foreach($menu as $menu_k => $menu_v): ?>
			<li class="layui-nav-item <?php if($menu_v['selected']): ?> layui-this<?php endif; ?>">
				<a href="<?php echo htmlentities($menu_v['url']); ?>"><?php echo htmlentities($menu_v['title']); ?></a>
			</li>
			<?php if($menu_v['selected']): 
				$second_menu = $menu_v['child_list'];
				 ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<ul class="layui-nav layui-layout-right">
			<li class="layui-nav-item">
				<a href="javascript:;">
					<div class="ns-img-box">
						<img src="https://ls.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
					</div>
					<?php echo htmlentities($user_info['username']); ?>
				</a>
				<dl class="layui-nav-child">
					<dd class="ns-reset-pass" onclick="resetPassword();">
						<a href="javascript:;">修改密码</a>
					</dd>
					<dd>
						<a onclick="clearCache()" href="javascript:;">清除缓存</a>
					</dd>
					<dd>
						<a href="<?php echo addon_url('admin/login/logout'); ?>" class="login-out">退出登录</a>
					</dd>
				</dl>
			</li>
		</ul>
	</div>
	

	<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
	<div class="layui-side">
		<div class="layui-side-scroll">
			<span class="ns-side-title"><?php echo htmlentities($crumbs[0]['title']); ?></span>
			<!-- 二三级菜单-->
			<ul class="layui-nav layui-nav-tree"  lay-filter="test">
				<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
				<li class="layui-nav-item <?php if($menu_second_v['selected']): ?> layui-nav-itemed <?php endif; if(!$menu_second_v['child_list'] && $menu_second_v['selected']): ?> layui-this<?php endif; ?>">
					<a class="layui-menu-tips" href="<?php if(!$menu_second_v['child_list']): ?> <?php echo htmlentities($menu_second_v['url']); else: ?>javascript:;<?php endif; ?>"><?php echo htmlentities($menu_second_v['title']); ?></a>
					<?php if(!(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty()))): ?>
					<dl class="layui-nav-child">
						<?php foreach($menu_second_v["child_list"] as $menu_third_k => $menu_third_v): ?>
						<dd class="<?php if($menu_third_v['selected']): ?> layui-this<?php endif; ?>">
							<a href="<?php echo htmlentities($menu_third_v['url']); ?>"><?php echo htmlentities($menu_third_v['title']); ?></a>
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

	<div class="layui-body<?php if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?> child_no_exit<?php endif; ?>">
		<!-- 面包屑 -->
		
		<?php if(count($second_menu) > 0): ?>
		<div class="ns-crumbs<?php if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?> child_no_exit<?php endif; ?>">
		<span class="layui-breadcrumb" lay-separator="-">
			<?php foreach($crumbs as $crumbs_k => $crumbs_v): if(count($crumbs) == ($crumbs_k + 1)): ?>
			<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
			<?php else: ?>
			<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
			<?php endif; ?>
			<?php endforeach; ?>
		</span>
		</div>
		<?php endif; ?>
		
		<div class="ns-body-content <?php if(count($second_menu) < 1): ?> crumbs_no_exit<?php endif; ?>">
			<div class="ns-body">
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
                <div class="layui-card-header nav-title">订单信息</div>
                <div class="layui-card-body">
                    <div class="layui-form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">订单编号：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($order_detail['order_no']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">订单类型：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($order_detail['order_type_name']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">订单来源：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_detail['order_from_name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">付款方式：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><?php echo htmlentities($order_detail['pay_type_name']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">买家：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux"><a class="ns-text-color" target="_blank" href='<?php echo addon_url("admin/member/editmember?member_id=".$order_detail["member_id"]); ?>'><?php echo htmlentities($order_detail['nickname']); ?></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item order-detail-hr"></div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">配送方式：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_detail['delivery_type_name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">收货人：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_detail['name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">联系电话：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_detail['mobile']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">收货地址：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_detail['full_address']); ?>-<?php echo htmlentities($order_detail['address']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="layui-form-item order-detail-hr"></div>
						<div class="layui-form-item">
						    <label class="layui-form-label">营销活动：</label>
						    <div class="layui-input-block">
						        <div class="layui-inline">
						            <div class="layui-form-mid layui-word-aux">
						                <p><?php echo htmlentities($order_detail['promotion_type_name']); ?></p>
						            </div>
						        </div>
						    </div>
						</div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">买家留言：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <?php if($order_detail['buyer_message'] == ""): ?>
                                        <p>-</p>
                                        <?php else: ?>
                                        <p><?php echo htmlentities($order_detail['buyer_message']); ?></p>
                                        <?php endif; ?>
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
                <div class="layui-card-header">订单状态：<?php echo htmlentities($order_detail['order_status_name']); if($order_detail['order_status'] == 3 && (!empty($order_detail['take_delivery_execute_time']) && $order_detail['take_delivery_execute_time'] > 0)): ?>(还剩<?php echo timediff(time(),$order_detail['take_delivery_execute_time']); ?>自动确认)<?php endif; ?></div>
                <div class="layui-card-body">
                    <p class="order-detail-tips"></p>
                    <br>
                    <i class="layui-icon  layui-icon-about"></i>
                </div>
            </div>
        </div>
        <!--<div class="layui-col-md12">-->
        <!--<div class="layui-card">-->
        <!--<div class="layui-card-header">订单商品</div>-->
        <!--<div class="layui-card-body">-->
        <!---->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <div class="order-detail-dl">
            <dl>
                <dt>温馨提醒</dt>
                <dd>交易成功后，平台将把货款结算至你的店铺账户余额，你可申请提现；</dd>
                <dd>请及时关注你发出的包裹状态，确保能配送至买家手中；</dd>
                <dd>如果买家表示未收到货或者货物有问题，请及时联系买家积极处理，友好协商；</dd>
            </dl>
        </div>
    </div>
</div>
<?php if($order_detail['is_invoice'] == 1): ?>
<div style="height: 15px;"></div>
<div class="layui-row ns-form invoice-view">

    <div class="layui-col-md6">
        <h4 class="invoice-title">发票信息</h4>
        <ul class="invoice-box">
            <li class="invoice-item">
                <label class="invoice-label">发票类型：</label>
                <div class="invoice-content"><?php if($order_detail['invoice_type'] == 1): ?>纸质<?php else: ?>电子<?php endif; if($order_detail['is_tax_invoice'] == 1): ?>专票<?php else: ?>普票<?php endif; ?></div>
            </li>

            <li class="invoice-item">
                <label class="invoice-label">发票抬头：</label>
                <div class="invoice-content"><?php echo htmlentities($order_detail['invoice_title']); ?></div>
            </li>
            <li class="invoice-item">
                <label class="invoice-label">发票抬头类型：</label>
                <div class="invoice-content"><?php echo $order_detail['invoice_title_type']==1 ? '个人'  :  '企业'; ?></div>
            </li>
            <?php if($order_detail['invoice_title_type'] == 2): ?>
            <li class="invoice-item">
                <label class="invoice-label">纳税人识别号：</label>
                <div class="invoice-content"><?php echo htmlentities($order_detail['taxpayer_number']); ?></div>
            </li>
            <?php endif; ?>
            <li class="invoice-item">
                <label class="invoice-label">发票内容：</label>
                <div class="invoice-content"><?php echo htmlentities($order_detail['invoice_content']); ?></div>
            </li>
            <?php if($order_detail['invoice_type'] == 1): ?>
            <li class="invoice-item">
                <label class="invoice-label">发票邮寄地址：</label>
                <div class="invoice-content"><?php echo htmlentities($order_detail['invoice_full_address']); ?></div>
            </li>
            <?php else: ?>
            <li class="invoice-item">
                <label class="invoice-label">发票接收邮件：</label>
                <div class="invoice-content"><?php echo htmlentities($order_detail['invoice_email']); ?></div>
            </li>
            <?php endif; ?>
        </ul>

    </div>
    <div class="layui-col-md6">
        <h4 class="invoice-title">发票费用</h4>
        <ul class="invoice-box">
            <li class="invoice-item">
                <label class="invoice-label">发票费用：</label>
                <div class="invoice-content"><span class="invoice-money">￥<?php echo htmlentities($order_detail['invoice_money']); ?></span> </div>
            </li>
            <li class="invoice-item">
                <label class="invoice-label">发票税率：</label>
                <div class="invoice-content"><span class="invoice-money"><?php echo htmlentities($order_detail['invoice_rate']); ?>%</span> </div>
            </li>
            <li class="invoice-item">
                <label class="invoice-label">发票邮寄费用：</label>
                <div class="invoice-content"><span class="invoice-money">￥<?php echo htmlentities($order_detail['invoice_delivery_money']); ?></span> </div>
            </li>
        </ul>
    </div>
</div>
<?php endif; ?>
<div style="height: 15px;"></div>

<?php if($order_detail['pay_status'] > 0): ?>
<div class="layui-card">
    <div class="layui-card-header nav-title">结算信息</div>
    <div class="layui-card-body">
        <div class="settlement-view">
            <div class="settlement-inner settlement_block">
                <div class="settlement_line">
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">店铺结算金额：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['shop_money']); ?></div>
                    </div>
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">平台结算金额：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['platform_money']); ?></div>
                    </div>
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">结&nbsp;&nbsp;算&nbsp;&nbsp;状&nbsp;&nbsp;&nbsp;态：</label>
                        <div class="settlement-inner-content-item-label-value"><?php if($order_detail['is_settlement'] == 1): ?>已结算<?php else: ?>待结算<?php endif; ?></div>
                    </div>
                </div>
                <div class="settlement_line">
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">店铺退款金额：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['refund_shop_money']); ?></div>
                    </div>
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">平台退款金额：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['refund_platform_money']); ?></div>
                    </div>
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">平台优惠券平台承担金额：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['platform_coupon_money']); ?></div>
                    </div>
                </div>
                <div class="settlement_line">
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">平台优惠券平台承担金额（退款部分）：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['refund_platform_coupon_money']); ?></div>
                    </div>
                    <div class="settlement-inner-content-item">
                        <label class="settlement-inner-content-item-label">总支出佣金：</label>
                        <div class="settlement-inner-content-item-label-value">￥<?php echo htmlentities($order_detail['commission']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; if(!empty($order_detail['package_list'])): ?>
<!-- 物流信息 -->
<div class="layui-tab ns-table-tab">
    <ul class="layui-tab-title">
        <?php foreach($order_detail['package_list'] as $package_k => $package_v): ?>
        <li <?php if($package_k == 0): ?>class="layui-this"<?php endif; ?>><?php echo htmlentities($package_v['package_name']); ?></li>
        <?php endforeach; ?>
    </ul>
    <div class="layui-tab-content" style="background-color: #FFF;">
        <?php foreach($order_detail['package_list'] as $package_k => $package_v): ?>
        <div class="layui-tab-item<?php if($package_k == 0): ?> layui-show<?php endif; ?>">
            <div class="package-inner">
                <div class="package-inner-content">
                    <div class="package-inner-content-item">
                        <label class="package-inner-content-item-label">发货时间：</label>
                        <div class="package-inner-content-item-label-value"><?php echo time_to_date($package_v["delivery_time"]); ?></div>
                    </div>
                    <?php if($package_v['delivery_type'] == 1): ?>
                    <div class="package-inner-content-item">
                        <label class="package-inner-content-item-label">物流公司：</label>
                        <div class="package-inner-content-item-label-value">
                            <div><?php echo htmlentities($package_v['express_company_name']); ?></div>
                        </div>
                    </div>
                    <div class="package-inner-content-item">
                        <label class="package-inner-content-item-label">运单号：</label>
                        <div class="package-inner-content-item-label-value">
                            <div><?php echo htmlentities($package_v['delivery_no']); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="package-inner-goods-box">
                        <div class="package-inner-goods-block" >
                            <div class="package-inner-goods-container">
                                <div class="package-inner-goods-list">
                                    <?php foreach($package_v['goods_list'] as $goods_k => $goods_v): ?>
                                    <div class="package-inner-goods-item">
                                        <div class="package-inner-goods-item-inner">
                                            <!-- <img src="<?php echo img($goods_v['sku_image']); ?>" alt="<?php echo $goods_v['sku_name']; ?>" class="package-inner-goods-item-image"> -->
                                            <img src="<?php echo img($goods_v['sku_image']); ?>" class="package-inner-goods-item-image">
                                            <p class="package-inner-goods-item-name ns-line-hiding ns-line-text" title="<?php echo $goods_v['sku_name']; ?>"><?php echo $goods_v['sku_name']; ?></p>
                                            <p class="package-inner-goods-item-name">数量：<?php echo htmlentities($goods_v['num']); ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="package-inner-express">
                    <div class="package-inner-content-item">
                        <label class="package-inner-content-item-label-">物流状态：</label><span class="package-inner-content-item-label-value"><?php if($package_v['trace']['success']): ?><?php echo htmlentities($package_v['trace']['status_name']); else: ?><?php echo htmlentities($package_v['trace']['reason']); ?><?php endif; ?> </span>
                    </div>
                    <?php if($package_v['trace']['success']): ?>
                    <div class="package-inner-express-box">
                        <ul class="layui-timeline">
                            <?php foreach($package_v['trace']['list'] as $trace_k => $trace_v): ?>
                            <li class="layui-timeline-item">
                                <span class="time-circle layui-timeline-axis" style="background-color: #f38421;"></span>
                                <div class="layui-timeline-content layui-text">
                                    <div class="express-timeline-title"><?php echo htmlentities($trace_v['datetime']); ?></div>
                                    <p><?php echo htmlentities($trace_v['remark']); ?></p>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="order-detail-table">
    <table class="layui-table" lay-filter="parse-table-order-product" lay-skin="line" lay-size="lg">
        <thead>
			<tr>
				<th lay-data="{field:'product_name', width:200}">商品</th>
				<th lay-data="{field:'price'}">价格（元）</th>
				<th lay-data="{field:'sale_num'}">数量</th>
				<th lay-data="{field:'total_money'}">小计（元）</th>
				<th lay-data="{field:'refund_status'}">退款状态</th>
				<th lay-data="{field:'shipping_status'}">状态</th>
			</tr>
        </thead>
        <tbody>

        <?php foreach($order_detail['order_goods'] as $list_k => $order_goods_item): ?>
        <tr>
            <td><?php echo htmlentities($order_goods_item['sku_name']); if($order_goods_item['is_present'] == 1): ?>&nbsp;&nbsp;<div class="present-label">赠品</div><?php endif; ?></td>
            <td><?php echo htmlentities($order_goods_item['price']); ?></td>
            <td><?php echo htmlentities($order_goods_item['num']); ?></td>
            <td><?php echo htmlentities($order_goods_item['goods_money']); ?></td>
            <td>
                <?php if($order_goods_item['refund_status'] != 0): ?>
                <a class="ns-text-color" href='<?php echo addon_url("admin/refund/detail?order_goods_id=".$order_goods_item["order_goods_id"]); ?>'><?php echo htmlentities($order_goods_item['refund_status_name']); ?></a>
                <?php endif; ?>
            </td>
            <td><?php echo htmlentities($order_goods_item['delivery_status_name']); ?></td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <div class="layui-row order-detail-total">
        <div class="layui-col-md9">&nbsp;</div>
        <div class="layui-col-md3 order-money-box" >
            <div>商品总额：￥<?php echo htmlentities($order_detail["goods_money"]); ?></div>
            <div>店铺优惠券：￥<?php echo htmlentities($order_detail["coupon_money"]); ?></div>
            <div>店铺优惠：￥<?php echo htmlentities($order_detail["promotion_money"]); ?></div>
            <div>等级优惠：￥<?php echo htmlentities($order_detail["dj_money"]); ?></div>
            <div>军人优惠：￥<?php echo htmlentities($order_detail["soldier_money"]); ?></div>
            <div>订单调价：￥<?php echo htmlentities($order_detail["adjust_money"]); ?></div>
            <div>配送费用：￥<?php echo htmlentities($order_detail["delivery_money"]); ?></div>
            <div>平台优惠券：￥<?php echo htmlentities($order_detail["platform_coupon_total_money"]); ?></div>
            <div>发票费用：￥<?php echo htmlentities($order_detail["invoice_money"]); ?></div>
            <div>发票邮寄费用：￥<?php echo htmlentities($order_detail["invoice_delivery_money"]); ?></div>
            <div>订单共<?php echo htmlentities($order_detail["goods_num"]); ?>件商品，总计：<span>￥<?php echo htmlentities($order_detail["order_money"]); ?></span></div>
        </div>
    </div>
</div>

			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
			</div>-->
		</div>
	</div>
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

	// $(".ns-reset-pass").on('click', function() {
	// 	$(this).removeClass('layui-this');
	// })

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
            url: ns.url("admin/login/modifypassword"),
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

	/**
	 * 打开相册
	 */
	function openAlbum(callback, imgNum) {
		layui.use(['layer'], function () {
			//iframe层-父子操作
			layer.open({
				type: 2,
				title: '图片管理',
				area: ['825px', '675px'],
				fixed: false, //不固定
				btn: ['保存', '返回'],
				content: ns.url("admin/album/album?imgNum=" + imgNum),
				yes: function (index, layero) {
					var iframeWin = window[layero.find('iframe')[0]['name']];//得到iframe页的窗口对象，执行iframe页的方法：

					iframeWin.getCheckItem(function (obj) {
						if (typeof callback == "string") {
							try {
								eval(callback + '(obj)');
								layer.close(index);
							} catch (e) {
								console.error('回调函数' + callback + '未定义');
							}
						} else if (typeof callback == "function") {
							callback(obj);
							layer.close(index);
						}

					});
				}
			});
		});
	}

	layui.use('element', function() {
		var element = layui.element;
		element.init();
	});
</script>



</body>
</html>