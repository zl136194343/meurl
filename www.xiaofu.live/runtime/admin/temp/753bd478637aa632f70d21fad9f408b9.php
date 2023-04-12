<?php /*a:2:{s:60:"/www/wwwroot/ls.chnssl.com/app/admin/view/refund/detail.html";i:1614515994;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1654841781;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"小谷粒管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'小谷粒管理系统')); ?>">
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
<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/admin/view/public/css/refund_detail.css" />

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://ls.chnssl.com/app/admin/view/public/img/logo.png">-->
	</div>
	<span>小谷粒管理系统</span>
	<!--<span>服务电话：400-886-7993</span>-->
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
                <div class="layui-card-header nav-title">退款订单信息</div>
                <div class="layui-card-body">
                    <div class="layui-form">
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
                                    <div class="layui-form-mid layui-word-aux"><a class="ns-text-color" target="_blank" href='<?php echo addon_url("admin/member/editmember?member_id=".$order_info["member_id"]); ?>'><?php echo htmlentities($order_info['nickname']); ?></a></div>
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
                        <div class="layui-form-item order-detail-hr">
                        </div>
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
                <dd>如果未发货，请点击同意退款给买家。</dd>
                <dd>如果实际已发货，请主动与买家联系。</dd>
                <dd>如果订单整体退款后，优惠券和余额会退还给买家。</dd>
            </dl>
        </div>
    </div>
</div>

<div>

    <!-- <div class="refund-line"></div> -->
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
                    <div class="refund-content"><span class="refund-money">￥<?php echo htmlentities($detail['refund_apply_money']); ?></span> </div>
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
                    <div class="refund-content"> <a target="_blank"class="ns-text-color" href="<?php echo addon_url('admin/order/detail',['order_id'=>$order_info['order_id']]); ?>"><?php echo htmlentities($order_info['order_no']); ?></a></div>
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
        <h3 class="refund-block-title">维权日志</h3>
        <div class="refund-block-content">
            <ul class="layui-timeline">
                <?php foreach($detail['refund_log_list'] as $log_k => $log_item): ?>
                <li class="layui-timeline-item">
                    <?php if($log_item["action_way"] == 1): ?>
                    <span class="refund-way layui-timeline-axis refund-buyer">买</span>
                    <?php elseif($log_item["action_way"] == 2): ?>
                    <span class="refund-way layui-timeline-axis seller-buyer">商</span>
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