<?php /*a:2:{s:57:"/www/wwwroot/ls.chnssl.com/app/shop/view/cert/reopen.html";i:1614516190;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
    .ns-body-content{padding: 0;margin: 10px;background-color: #fff;}
    /* 公共*/
    h2.apply-h2-title{margin-top: 80px;margin-bottom: 80px;font-size:34px;font-weight:400;color:rgba(93,93,93,1);text-align: center;}
    .apply-btn-box{margin-top: 50px;margin-bottom: 30px;text-align: center;}
    .ns-dis-input{background-color: #f7f7f7; cursor: no-drop;}
    .ns-dis-input:hover{border-color: #e6e6e6 !important;}
    /* 选择店铺等级 */
    .store-level{padding: 0 50px 50px;margin: auto;display: flex;flex-wrap: wrap;justify-content: center;}
    .store-level > li:first-of-type{margin-left: 0;}
    .store-level > li{margin-bottom: 30px;margin-left: 20px;padding: 50px 35px 30px;width: 260px;text-align: center;background-color: #fff;box-sizing: border-box;border: 1px solid #E9E9E9;border-radius: 2px;}
    .store-level > li:hover{border-color: transparent; box-shadow: 0 0 20px 0 rgba(0,0,0,.07);}
    .store-level .group_name{margin: 10px;font-size: 18px;font-weight: 400;line-height: 25px;color: #323233;}
    .store-level .remark{display: inline-block;margin: 0 -10px 20px;font-size: 12px;line-height: 19px;color: #646566;}
    .store-level-sublevel{padding-top: 20px;border-top: 1px solid #f2f2f2;}
    .store-level-sublevel li{text-align: left;height: 28px;line-height: 28px;color: #646566;}
    .store-level-sublevel li .is-checked{color: #ccc;}
    .store-level button{margin-top: 25px;}
    /* 申请续签 */
    .payment-voucher{width: 760px;margin: auto;}
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
			
				
<!-- 开店套餐 -->
<div class="store-level-box">
    <h2 class="apply-h2-title">选择开店套餐</h2>
    <ul class="store-level">
        <?php foreach($group_info as $shop_group_key => $shop_group_val): ?>
        <li data-group_id = <?php echo htmlentities($shop_group_val["group_id"]); ?>>
            <h2 class="group_name"><?php echo htmlentities($shop_group_val["group_name"]); ?></h2>
            <span class="remark"><?php echo htmlentities($shop_group_val["remark"]); ?></span>
            <ul class="store-level-sublevel">
                <?php foreach($shop_group_val["promotion"] as $promotion_key => $promotion_val): ?>
                <li>
                    <?php if($promotion_val['is_checked'] == 1): ?><span class="ns-text-color">√</span><?php else: ?><span class="ns-red-color">×</span><?php endif; ?>
                    <span class="<?php if($promotion_val['is_checked'] != 1): ?> is-checked<?php endif; ?>"><?php echo htmlentities($promotion_val['title']); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
            <button class="layui-btn ns-bg-color">￥ <?php echo htmlentities($shop_group_val['fee']); ?>/年</button>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- 提交支付凭证 -->
<div class="payment-voucher layui-hide layui-form">
    <h2 class="apply-h2-title">填写申请续签支付信息</h2>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>店铺名称：</label>
        <div class="layui-input-inline">
            <input type="text" name="shop_name" disabled class="layui-input ns-dis-input ns-len-long" value="<?php echo htmlentities($shop['site_name']); ?>">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>开店套餐：</label>
        <div class="layui-input-inline">
            <input type="text" disabled class="layui-input ns-dis-input ns-len-long" name="shop_group_name" value="">
        </div>
    </div>
    <!-- 开店套餐id隐藏域 -->
    <input type="hidden" class="layui-input" name="shop_group_id" value="">

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>主营行业：</label>
        <div class="layui-input-inline">
            <input type="text" disabled class="layui-input ns-dis-input ns-len-long" name="category_name" value="<?php echo htmlentities($shop['category_name']); ?>">
        </div>
    </div>

    <!-- 主营行业id隐藏域 -->
    <input type="hidden" class="layui-input" name="category_id" value="<?php echo htmlentities($shop['category_id']); ?>">

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>入驻时长：</label>
        <div class="layui-input-inline">
            <select name="apply_year" lay-verify="required" lay-search="" lay-filter="apply_year">
                <option value="">请选择入驻时长</option>
                <?php $__FOR_START_1577173389__=1;$__FOR_END_1577173389__=5;for($i=$__FOR_START_1577173389__;$i < $__FOR_END_1577173389__;$i+=1){ ?>
                <option value="<?php echo htmlentities($i); ?>"><?php echo htmlentities($i); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="layui-word-aux">年</div>
    </div>

    <!--<div class="layui-form-item">-->
        <!--<label class="layui-form-label"><span class="required">*</span>保证金：</label>-->
        <!--<div class="layui-input-block">-->
            <!--<p class="ns-input-text color-red payment-cash-deposit">0.00 元</p>-->
        <!--</div>-->
    <!--</div>-->

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>服务费：</label>
        <div class="layui-input-block">
            <p class="ns-input-text color-red payment-service">0.00 元</p>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>总计：</label>
        <div class="layui-input-block">
            <p class="ns-input-text color-red payment-store-charges">0.00 元</p>
        </div>
        <div class="ns-word-aux">说明： 店铺费用 = 服务费 * 入驻年限；</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label img-upload-lable"><span class="required">*</span>付款凭证：</label>
        <div class="layui-input-inline img-upload">
            <div class="upload-img-block icon"  data-upload data-id="voucher" data-name="paying_money_certificate">
                <!-- <div class="upload-img-box" id="voucher">
                    <div class="ns-upload-default">
                        <img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" />
                        <p>点击上传</p>
                    </div>
                </div> -->
				<div class="upload-img-box">
					<div class="ns-upload-default" id="voucher">
						<div class="upload">
							<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="voucher"/>
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
					<input type="hidden" class="layui-input" name="paying_money_certificate" lay-verify="required"/>
				</div>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">付款凭证说明：</label>
        <div class="layui-input-inline">
            <textarea name="paying_money_certificate_explain" class="layui-textarea ns-len-long" placeholder="请输入付款凭证说明"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">收款账户信息：</label>
        <div class="layui-input-block">
            <!-- 结算信息 -->
            <table class="layui-table">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <tbody>
                <tr>
                    <td align="right">银行开户名：</td>
                    <td><?php echo htmlentities($receivable_config['value']['bank_account_name']); ?></td>
                    <td align="right">银行账户：</td>
                    <td><?php echo htmlentities($receivable_config['value']['bank_account_no']); ?></td>
                </tr>
                <tr>
                    <td align="right">开户名称：</td>
                    <td><?php echo htmlentities($receivable_config['value']['bank_name']); ?></td>
                    <td align="right">开户所在地：</td>
                    <td><?php echo htmlentities($receivable_config['value']['bank_address']); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="apply-btn-box">
        <button class="ns-bg-color layui-btn" lay-submit lay-filter="payment-voucher-complete">点击提交</button>
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
    var groupId,groupName;

    /**
     * 开店套餐
     */
    $("body").on("click",".store-level button",function () {

        //获取开店套餐id和名称
        groupId = $(this).parent().attr("data-group_id");
        groupName = $(this).parent().find(".group_name").text();

        $("input[name='shop_group_name']").val(groupName);
        $("input[name='shop_group_id']").val(groupId);

        paymentAmount();

        $(".store-level-box").addClass("layui-hide");
        $(".payment-voucher").removeClass("layui-hide");
    });

    /* 资质审核 - 计算缴费金额 */
    function paymentAmount() {
        var categoryId = "<?php echo htmlentities($shop['category_id']); ?>",
            applyYear = $(".payment-voucher select[name=apply_year] option:selected").val();
        if (categoryId && groupId && applyYear) {
            $.ajax({
                url: ns.url("shop/shopreopen/getReopenMoney"),
                data: {
                    "apply_year": applyYear,
                    "group_id": groupId
                },
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
//                    $(".payment-cash-deposit").text(data.code.paying_deposit + "元");
                    $(".payment-service").text(data.data.fee + "元");
                    $(".payment-store-charges").text(data.data.money + ' 元');
                }
            })
        }
    }

    layui.use("form",function () {
        var form = layui.form;
		form.render();
		
        form.on('select(apply_year)', function (data) {
            paymentAmount();
        });

        /* 支付凭证 */
        form.on('submit(payment-voucher-complete)', function (data) {
            $.ajax({
                url: ns.url("shop/cert/reopen"),
                dataType: 'JSON',
                type: 'POST',
                data: data.field,
                success: function (data) {
                    if (data.code == 0) {
                        layer.msg("申请续签成功" ,{anim: 5},function(){
                            location.href = ns.url("shop/account/reopenlist");
                        })
                    }else{
                        layer.msg(data.message);
                    }
                }
            })
        });
    });

    /* 图片上传 */
	var voucher = new Upload({
			elem: '#voucher',
			 url: ns.url("shop/upload/image"),
		});
</script>

</body>

</html>