<?php /*a:2:{s:75:"/www/wwwroot/ls.chnssl.com/addon/pointexchange/admin/view/exchange/add.html";i:1614519854;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞友情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞友情')); ?>">
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
	
<style>
	.gift-box .layui-form{padding: 0!important;}
	.ns-layer-box .layui-layer-content{overflow: auto !important;background-color: #f7f7f7;}
	.exchange-coupon, .exchange-red-packet {display: none;}
	.ns-form{margin-top: 0;}
	.ns-exchange-type {padding: 0 20px; position: relative;}
	.ns-exchange-type:hover {border: 1px solid #4685FD;}
	.ns-exchange-selected {border: 1px solid #4685FD;}
	.ns-exchange-selected:after {
		content: "";
		display: inline-block;
		width: 20px;
		height: 20px;
		background-image: url(https://ls.chnssl.com/public/static/img/selected.png);
		position: absolute;
		bottom: 0;
		right: 0;
	}
	.layui-input{
		display:inline-block;
	}
</style>

</head>
<body>

<div class="ns-logo">
	
	<span>赞友情平台端</span>

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
				
<div class="ns-form">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">兑换类型：</label>
			<div class="layui-input-block">
				<!-- <input type="radio" lay-filter="exchange_type" name="type" value="1" title="礼品" checked>
				<input type="radio" lay-filter="exchange_type" name="type" value="2" title="优惠券">
				<input type="radio" lay-filter="exchange_type" name="type" value="3" title="红包"> -->
				<button class="layui-btn layui-btn-primary ns-exchange-type ns-exchange-selected" id="gift_btn">礼品</button>
				<button class="layui-btn layui-btn-primary ns-exchange-type" id="coupon_btn">优惠券</button>
				<button class="layui-btn layui-btn-primary ns-exchange-type" id="red_packet_btn">红包</button>
			</div>
		</div>
	</div>

	<!-- 礼品 -->
	<div class="exchange-gift layui-form content">
		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>选择礼品：</label>
			<div class="layui-input-block">
				<!-- <button class="layui-btn ns-bg-color upload-gift">添加</button> -->

				<div class="upload-img-block square">
					<div class="upload-img-box upload-gift" id="gift_img" lay-verify="select">
						<div class="ns-upload-default">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png" />
							<p>选择礼品</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">礼品名称：</label>
			<div class="layui-input-block" id="gift_name">
				<p class="ns-input-text">请选择礼品</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">礼品价格（元）：</label>
			<div class="layui-input-block" id="gift_price">
				<p class="ns-input-text">请选择礼品</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">库存：</label>
			<div class="layui-input-block" id="gift_stock">
				<p class="ns-input-text">请选择礼品</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>兑换方式：</label>
			<div class="layui-input-block">
				<input type="radio" name="pay_type" lay-filter="pay_type" value="0" title="积分" checked>
				<input type="radio" name="pay_type" lay-filter="pay_type" value="1" title="积分+金额">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>兑换积分：</label>
			<div class="layui-input-block pay_price">
				<input type="number" name="point" min="0" lay-verify="required_point" placeholder="兑换积分" value="" class="layui-input ns-len-short">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">是否上架：</label>
			<div class="layui-input-block">
				<input type="checkbox" name="state" lay-skin="switch" value="1" lay-filter="state" checked>
			</div>
		</div>

		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save_gift">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>

		<input type="hidden" name="gift_id">
		<input type="hidden" name="type" value="1">
	</div>

	<!-- 优惠券 -->
	<div class="exchange-coupon content layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>选择优惠券：</label>
			<div class="layui-input-block">
				<!-- <button class="layui-btn ns-bg-color upload-coupon">添加</button> -->

				<div class="upload-img-block square">
					<div class="upload-img-box upload-coupon" id="coupon_img" lay-verify="select">
						<div class="ns-upload-default">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png" />
							<p>选择优惠券</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">优惠券名称：</label>
			<div class="layui-input-block" id="coupon_name">
				<p class="ns-input-text ns-len-long">请选择优惠券</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">优惠券面值（元）：</label>
			<div class="layui-input-block" id="coupon_price">
				<p class="ns-input-text ns-len-long">请选择优惠券</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>兑换积分：</label>
			<div class="layui-input-block">
				<input type="number" name="point" min="0" lay-verify="required|gtzero" placeholder="兑换积分数" value="" class="layui-input ns-len-short">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">是否上架：</label>
			<div class="layui-input-block">
				<input type="checkbox" name="state" lay-skin="switch" value="1" lay-filter="state" checked>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">优惠券描述：</label>
			<div class="layui-input-block ns-special-length">
				<script id="container" name="content" type="text/plain" style="height: 300px;"></script>
			</div>
		</div>

		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save_coupon">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>

		<input type="hidden" name="coupon_type_id">
		<input type="hidden" name="type" value="2">
	</div>

	<!-- 红包 -->
	<div class="exchange-red-packet content layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>名称：</label>
			<div class="layui-input-block">
				<input type="text" name="name" lay-verify="required" placeholder="请输入红包名称" value="" class="layui-input ns-len-long">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label img-upload-lable">红包封面：</label>
			<div class="layui-input-block ">
				<div class="upload-img-block square">
					<div class="upload-img-box">
						<div class="ns-upload-default" id="redPacket">
							<div class="upload">
								<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
								<p>点击上传</p>
							</div>
						</div>
						<div class="operation">
							<div>
								<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
								<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
							</div>
							<div class="replace_img js-replace">点击替换</div>
						</div>
						<input type="hidden" name="image" value="">
					</div>
				</div>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>发放红包数量：</label>
			<div class="layui-input-block">
				<input type="number" name="stock" min="0" lay-verify="required|required_balance_stock" placeholder="红包数量" value="" class="layui-input ns-len-short">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>兑换积分：</label>
			<div class="layui-input-block">
				<input type="number" name="point" min="0" lay-verify="required|gtzero" placeholder="兑换积分数" value="" class="layui-input ns-len-short">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>余额：</label>
			<div class="layui-input-block">
				<input type="number" name="balance" min="0" lay-verify="required|required_balance" placeholder="红包余额" value="" class="layui-input ns-len-short">
			</div>
			<p class="ns-word-aux">兑换的红包会以余额的形式发放给指定会员</p>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">是否上架：</label>
			<div class="layui-input-block">
				<input type="checkbox" name="state" lay-skin="switch" value="1" lay-filter="state" checked>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>红包描述：</label>
			<div class="layui-input-block ns-special-length">
				<script id="containerT" name="content" type="text/plain" style="height: 300px;"></script>
			</div>
		</div>

		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>

		<input type="hidden" name="type" value="3">
		<input type="hidden" name="" id="redPacketContent" value="" />
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


<script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/lang/zh-cn/zh-cn.js"></script>

<script>
	var giftTable, couponTable, form, laytpl, upload,
			exchangeType = 1;

	//实例化富文本
	var ue = UE.getEditor('container'),
			ue_t = UE.getEditor('containerT'),
			html = '';

	// 已经添加的兑换列表
	var gift_list = [];
	var coupon_list = [];
	$.ajax({
		url: ns.url("pointexchange://admin/exchange/lists"),
		dataType: 'JSON',
		type: 'POST',
		async: false,
		success: function(res) {
			var data = res.data.list;
			for (var i=0; i<data.length; i++) {
				if (data[i].type == 1) {
					gift_list.push(data[i].type_id);
				}
				if (data[i].type == 2) {
					coupon_list.push(data[i].type_id);
				}
			}
		}
	});

	layui.use(['form', 'laytpl', "upload"], function(){
		form = layui.form;
		laytpl = layui.laytpl;
		upload = layui.upload;
		form.render();

		/* form.on('radio(exchange_type)', function(data){
            exchangeType = data.value;
            $(".content").addClass("display-none").eq(exchangeType - 1).removeClass("display-none");
        }); */

		$(".ns-exchange-type").click(function() {
			$(this).addClass("ns-exchange-selected");
			$(this).siblings("button").removeClass("ns-exchange-selected");

			if ($(this).index() == 0) {
				$(".exchange-gift").show();
				$(".exchange-coupon").hide();
				$(".exchange-red-packet").hide();
			} else if ($(this).index() == 1) {
				$(".exchange-coupon").show();
				$(".exchange-gift").hide();
				$(".exchange-red-packet").hide();
			} else if ($(this).index() == 2) {
				$(".exchange-red-packet").show();
				$(".exchange-gift").hide();
				$(".exchange-coupon").hide();
			}
		});

		// 红包封面图片上传
		var redPacket_upload = new Upload({
			elem: '#redPacket',
			url: ns.url("admin/upload/upload")
		});
		/**
		 * 礼品列表搜索
		 */
		form.on('submit(gift-search)', function(data) {
			giftTable.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
		});

		form.verify({
			gtzero: function(value) {
				if (parseFloat(value) <= 0) {
					return '请输入大于0的数!'
				}
			}
		});

		/**
		 * 优惠券列表搜索
		 */
		form.on('submit(coupon-search)', function(data) {
			couponTable.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
		});

		/**
		 * 监听表单提交
		 */
		form.on('submit(save_gift)', function(data) {
			//删除图片
			if(!data.field.image) redPacket_upload.delete();
			
			var field = data.field;
			var _val = $("input[name='gift_id']").val();
			if (!_val) {
				layer.msg('请选择兑换礼品', {icon: 5, anim: 6});
				return;
			}

			if (data.field.state == undefined) {
				data.field.state = 0;
			}

			ajax_save(data.field);
		});

		form.on('submit(save_coupon)', function(data) {
			var field = data.field;
			var _val = $("input[name='coupon_type_id']").val();
			if (!_val) {
				layer.msg('请选择兑换优惠券', {icon: 5, anim: 6});
				return;
			}

			if(field.pay_type == 1){
				if(parseFloat(field.price) <= 0){
					layer.msg('兑换价格不能为0', {icon: 5, anim: 6});
					return;
				}
			}
			if (data.field.state == undefined) {
				data.field.state = 0;
			}

			ue.ready(function() {   //对编辑器的操作最好在编辑器ready之后再做
				html = ue.getContent();   //获取html内容，返回: <p>hello</p>
			});

			data.field.content = html;
			ajax_save(data.field);
		});

		form.on('submit(save)', function(data) {
			if (data.field.state == undefined) {
				data.field.state = 0;
			}

			ue_t.ready(function() {   //对编辑器的操作最好在编辑器ready之后再做
				html = ue_t.getContent();   //获取html内容，返回: <p>hello</p>
			});

			data.field.content = html;
			ajax_save(data.field);
		});


		//监听兑换方式
		form.on('radio(pay_type)', function(data){
			var value = data.value;
			var html = '';
			if(value == 1){
				html = '<input type="number" name="point" min="0" lay-verify="required_point" autocomplete="off" class="layui-input ns-len-short"> 积分' +
						'&nbsp;&nbsp;+ &nbsp;&nbsp;<input type="number" name="price" min="0" lay-verify="required_money" autocomplete="off" class="layui-input ns-len-short"> 元' +
						'';
			}
			if(value == 0){
				html = '<input type="number" name="point" min="0"  lay-verify="required" autocomplete="off" class="layui-input ns-len-short"> 积分';
			}
			$('.pay_price').html(html);
		});


		form.verify({
			required_point: function(value) {
				if (value == "") {
					return '积分不能为空';
				}
				if (Number(value) <= 0){
					return '积分必须大于0！';
				}
			},
			required_money: function(value) {
				if (value == "") {
					return '金额不能为空';
				}
				if (Number(value) <= 0){
					return '价格必须大于0！';
				}
			},
			required_balance_stock: function(value) {
				if (Number(value) <= 0){
					return '发放红包数量必须大于0！';
				}
			},
			required_balance: function(value) {
				if (Number(value) <= 0){
					return '红包余额必须大于0！';
				}
			}
		});

		function ajax_save(data) {
			$.ajax({
				url: ns.url("pointexchange://admin/exchange/add"),
				data: data,
				dataType: 'JSON',
				type: 'POST',
				async: false,
				success: function (res) {
					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("pointexchange://admin/exchange/lists")
							},
							btn2: function() {
								location.reload();
							}
						});
					} else {
						layer.msg(res.message, {icon: 5, anim: 6});
					}
				}
			});
		}
	});

	/* 礼品 */
	$("body").on("click", ".upload-gift",function () {
		layer.open({
			type: 1,
			area: ["850px","600px"],
			title: '礼品列表选择',
			skin: 'ns-layer-box',
			content: $("#giftList").html()
		});

		giftTable = new Table({
			elem: "#gift_list",
			url: ns.url("gift://admin/gift/lists"),
			where: {'gift_state': 1},
			cols: [
				[{
					title: '礼品名称',
					unresize: 'false',
					width: '40%',
					templet: '#giftName'
				}, {
					field: 'gift_keywords',
					title: '礼品关键字',
					unresize: 'false',
					width: '20%'
				}, {
					field: 'gift_price',
					title: '礼品价格（元）',
					unresize: 'false',
					width: '16%'
				}, {
					field: 'gift_stock',
					title: '库存',
					unresize: 'false',
					width: '12%'
				}, {
					title: '操作',
					toolbar: '#action',
					align: 'center',
					unresize: 'false',
					width: '12%'
				}]
			]
		});

		giftTable.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case "add":
					addGift(data);
					break;
			}
		});

		function addGift(data){
			var img_path = ns.img(data.gift_image);
			$("#gift_name").html("<p class='ns-input-text'>"+data.gift_name+"</p>");
			if (data.gift_image != "") {
				$("#gift_img").html('<img src="'+ img_path +'" />');
			} else {
				$("#gift_img").html("");
			}
			$("#gift_price").html("<p class='ns-input-text'>"+data.gift_price+"</p>");
			$("#gift_stock").html("<p class='ns-input-text'>"+data.gift_stock+"</p>");
			$(".select-gift-list tbody").html(html);
			$("input[name=gift_id]").val(data.gift_id);
			layer.closeAll();
		}

		/* function addGift2(data){
             console.log(data);

             var html = `<tr>`;
             html += `<td> `;
             html += `<div class="ns-table-tuwen-box"> `;
             html += `<div class="ns-img-box"> `;
             html += `<img src="${ns.img(data.gift_image)}">`;
             html += `</div> `;
             html += `<div class="ns-font-box">`;
             html += `<p class="ns-multi-line-hiding">${data.gift_name}</p>`;
             html += `</div>`;
             html += `</div> `;
             html += `</td> `;
             html += `<td>${data.gift_price}</td>`;
             html += `<td>${data.gift_stock}</td>`;
             html += `<td>${data.gift_state == 1 ? '正常' : '锁定'}</td>`;
             html += `</tr> `;
             $("input[name=gift_id]").val(data.gift_id);
             layer.closeAll();
         } */
	});

	/* 优惠券 */
	$("body").on("click", ".upload-coupon",function () {
		layer.open({
			type: 1,
			area: ["900px","600px"],
			title: '优惠券列表',
			skin: 'ns-layer-box',
			content: $("#couponList").html()
		});

		couponTable = new Table({
			elem: "#coupon_list",
			url: ns.url("platformcoupon://admin/platformcoupon/lists"),
			where: {'status': 1},
			cols: [
				[{
					title: '优惠券名称',
					unresize: 'false',
					width: '20%',
					templet: '#couponName'
				}, {
					field: 'money',
					title: '优惠券面额（元）',
					unresize: 'false',
					width: '15%'
				}, {
					field: 'count',
					title: '发放数量',
					unresize: 'false',
					width: '15%'
				}, {
					field: 'max_fetch',
					title: '最大领取数量',
					unresize: 'false',
					width: '15%'
				}, {
					field: 'gift_state',
					title: '有效期限',
					unresize: 'false',
					width: '25%',
					templet: function (res) {
						if(res.validity_type == 0){
							return "有效时间至" + ns.time_to_date(res.end_time);
						}else{
							return "有效时间" + res.fixed_term + "天";
						}
					}
				}, {
					title: '操作',
					toolbar: '#couponOperation',
					unresize: 'false',
					align: 'center',
					width: '10%'
				}]
			]
		});

		couponTable.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case "add":
					addcoupon(data);
					break;
			}
		});



		function addcoupon(data){
			var img_path = ns.img(data.image);
			$("#coupon_name").html("<p class='ns-input-text ns-len-long'>"+data.platformcoupon_name+"</p>");
			if (data.image) {
				$("#coupon_img").html('<img src="'+ img_path +'" />');
			} else {
				$("#coupon_img").html("");
			}
			$("#coupon_price").html("<p class='ns-input-text ns-len-long'>"+data.money+"</p>");
			$("input[name=coupon_type_id]").val(data.platformcoupon_type_id);
			layer.closeAll();
		}

		/* function addcoupon2(data){
            console.log(data);
            var html = `<tr>`;
            html += `<td> `;
            html += `<div class="ns-table-tuwen-box"> `;
            html += `<div class="ns-img-box"> `;
            html += `<img src="${ns.img(data.image)}">`;
            html += `</div> `;
            html += `<div class="ns-font-box">`;
            html += `<p class="ns-multi-line-hiding">${data.coupon_name}</p>`;
            html += `</div>`;
            html += `</div> `;
            html += `</td> `;
            html += `<td>${data.money}</td>`;
            html += `<td>${data.count}</td>`;
            html += `<td>${data.max_fetch}</td>`;
            html += `<td>${data.validity_type == 0 ? "有效时间至" + ns.time_to_date(data.end_time) : "有效时间" + data.fixed_term + "天"}</td>`;
            html += `<td>${data.status_name}</td>`;
            html += `</tr> `;
            $(".select-coupon-list tbody").html(html);
            $("input[name=coupon_type_id]").val(data.coupon_type_id);
            layer.closeAll();
        } */
	});

	//返回
	function back() {
		location.href = ns.url("pointexchange://admin/exchange/lists");
	}

</script>

<!-- 礼品 -->
<script type="text/html" id="giftList">
	<div class="gift-box">
		<div class="ns-single-filter-box">
			<div class="layui-form">
				<div class="layui-input-inline ns-len-mid">
					<input type="text" name="search_text" placeholder="请输入礼品名称/关键字" class="layui-input ns-len-mid">
					<button type="button" class="layui-btn layui-btn-primary" lay-filter="gift-search" lay-submit>
						<i class="layui-icon">&#xe615;</i>
					</button>
				</div>
			</div>
		</div>
		<table id="gift_list" lay-filter="gift_list"></table>
	</div>
</script>

<!-- 礼品-名称 -->
<script type="text/html" id="giftName">
	<div class="ns-table-tuwen-box">
		<div class="ns-img-box">
			{{#  if(d.gift_image){  }}
			<img layer-src src="{{ns.img(d.gift_image.split(",")[0])}}" alt="">
			{{#  }  }}
		</div>
		<div class="ns-font-box">
			<p class="ns-multi-line-hiding">{{d.gift_name}}</p>
		</div>
	</div>
</script>

<!-- 礼品-操作 -->
<script type="text/html" id="action">
	<div class="ns-table-btn">
		{{# if($.inArray(d.gift_id, gift_list) != -1){ }}
		<p title="该礼品已参加积分兑换活动">已添加</p>
		{{# }else{ }}
		<a class="layui-btn" lay-event="add">添加</a>
		{{# } }}
	</div>
</script>

<!-- 优惠券 -->
<script type="text/html" id="couponList">
	<div class="gift-box">
		<div class="ns-single-filter-box">
			<div class="layui-form">
				<div class="layui-input-inline">
					<input type="text" name="coupon_name" placeholder="请输入礼品名称/关键字" class="layui-input ns-len-mid">
					<button type="button" class="layui-btn layui-btn-primary" lay-filter="coupon-search" lay-submit>
						<i class="layui-icon">&#xe615;</i>
					</button>
				</div>
			</div>
		</div>
		<table id="coupon_list" lay-filter="coupon_list"></table>
	</div>
</script>

<!-- 优惠券-名称 -->
<script type="text/html" id="couponName">
	<div class="ns-table-tuwen-box">
		<div class="ns-img-box">
			{{#  if(d.image){  }}
			<img layer-src src="{{ns.img(d.image.split(",")[0])}}" alt="">
			{{#  }  }}
		</div>
		<div class="ns-font-box">
			<p class="ns-multi-line-hiding">{{d.platformcoupon_name}}</p>
		</div>
	</div>
</script>

<!-- 优惠券-操作 -->
<script type="text/html" id="couponOperation">
	<div class="ns-table-btn">
		{{# if($.inArray(d.platformcoupon_type_id, coupon_list) != -1){ }}
		<a class="layui-btn" title="该优惠券已参加积分兑换活动">已添加</a>
		{{# }else{ }}
		<a class="layui-btn" lay-event="add">添加</a>
		{{# } }}
	</div>
</script>

</body>
</html>