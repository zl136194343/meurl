<?php /*a:4:{s:65:"/www/wwwroot/ls.chnssl.com/app/shop/view/virtualorder/detail.html";i:1657765008;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;s:71:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_common_action.html";i:1616032162;s:70:"/www/wwwroot/ls.chnssl.com/app/shop/view/order/order_adjust_price.html";i:1614516208;}*/ ?>
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
                                    <div class="layui-form-mid layui-word-aux"><a class="ns-text-color" target="_blank" href='<?php echo addon_url("shop/member/detail?member_id=".$order_detail["member_id"]); ?>'><?php echo htmlentities($order_detail['nickname']); ?></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item order-detail-hr"></div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号：</label>
                            <div class="layui-input-block">
                                <div class="layui-inline">
                                    <div class="layui-form-mid layui-word-aux">
                                        <p><?php echo htmlentities($order_detail['mobile']); ?></p>
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
                <div class="layui-card-header">订单状态：<?php echo htmlentities($order_detail['order_status_name']); ?></div>
                <div class="layui-card-body">
                    <p class="order-detail-tips"></p>
                    <button class="layui-btn ns-bg-color" onclick="orderRemark('<?php echo htmlentities($order_detail['order_id']); ?>')">备注</button>
                    <?php 
                    $order_json_data = json_decode($order_detail['order_status_action'], true);
                    $action = $order_json_data['action'];
                     foreach($action as $action_k => $action_item): ?>
                    <a class="layui-btn ns-bg-color" href="javascript:orderAction('<?php echo htmlentities($action_item['action']); ?>', '<?php echo htmlentities($order_detail['order_id']); ?>')"><?php echo htmlentities($action_item['title']); ?></a>
                    <?php endforeach; ?>
                    <br>
                    <i class="layui-icon  layui-icon-about"></i>
                </div>
            </div>
        </div>
        <div class="order-detail-dl">
            <dl>
                <dt>提醒：</dt>
                <dd>交易成功后，平台将把货款结算至你的店铺账户余额，您可以申请提现；</dd>
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
            <div class="settlement-inner">
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
        </div>
    </div>
</div>
<?php endif; if(!empty($order_log_list)): ?>
<div class="order-log-view">
    <table class="layui-table" lay-filter="parse-table-order-product" lay-skin="line" lay-size="lg">
        <thead>
            <tr>
                <th lay-data="">操作</th>
                <th lay-data="">操作人</th>
                <th lay-data="">操作端口</th>
                <th lay-data="">订单状态</th>
                <th lay-data="">操作时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order_log_list as $list_l => $order_log_item): ?>
            <tr>
                <td><?php echo htmlentities($order_log_item['action']); ?></td>
                <td><?php echo htmlentities($order_log_item['nick_name']); ?></td>
                <td><?php echo htmlentities($order_log_item['module']); ?></td>
                <td><?php echo htmlentities($order_log_item['order_status_name']); ?></td>
                <td><?php echo time_to_date($order_log_item['action_time']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
                    <a class="ns-text-color" href='<?php echo addon_url("shop/orderrefund/detail?order_goods_id=".$order_goods_item["order_goods_id"]); ?>'><?php echo htmlentities($order_goods_item['refund_status_name']); ?></a>
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
            <div>订单调价：￥<?php echo htmlentities($order_detail["adjust_money"]); ?></div>
            <div>配送费用：￥<?php echo htmlentities($order_detail["delivery_money"]); ?></div>
            <div>平台会员等级优惠：￥<?php echo htmlentities($order_detail["dj_money"]); ?></div>
            <div>平台优惠券：￥<?php echo htmlentities($order_detail["platform_coupon_total_money"]); ?></div>
            <div>发票费用：￥<?php echo htmlentities($order_detail["invoice_money"]); ?></div>
            <div>发票邮寄费用：￥<?php echo htmlentities($order_detail["invoice_delivery_money"]); ?></div>
            <div>订单共<?php echo htmlentities($order_detail["goods_num"]); ?>件商品，总计：<span>￥<?php echo htmlentities($order_detail["order_money"]); ?></span></div>
        </div>
    </div>
</div>
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



</body>

</html>