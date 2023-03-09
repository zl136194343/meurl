<?php /*a:2:{s:73:"/www/wwwroot/ls.chnssl.com/app/shop/view/express/edit_print_template.html";i:1614516194;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
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
    .design-sketch{border:1px solid #ccc;position:relative}
    .design-sketch div{display:inline-block;border:1px solid #ccc;padding:10px;margin:8px;border-radius:2px;color:#555;white-space:nowrap;user-select:none;background-color:#fff;line-height:1}
    .design-sketch div i{position:absolute;top:-10px;right:-10px;display:none;width:20px;height:20px;border-radius:10px;background-color:rgba(0,0,0,.5);color:#fff;text-align:center;line-height:20px;z-index:99}
    .print-option{display:inline-block;border:1px solid;line-height:1;padding:10px;margin-left:5px;margin-bottom:8px;border-radius:2px;color:#545454;cursor:pointer}
    .ns-bg-color-gray{background-color:#e5e5e5!important}
    .ns-border-color-gray{border-color:#e5e5e5!important}
    .ns-form{margin-top:0}
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
				<?php endif; ?>
			
				
<div class="layui-form ns-form">
    <input type="hidden" name="company_id" value="<?php echo htmlentities($company_id); ?>">
    <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>">

    <div class="layui-form-item">
        <label class="layui-form-label">打印字体大小：</label>
        <div class="layui-input-block">
			<?php if($info['font_size']): ?>
            <input type="number" name="font_size" value="<?php echo htmlentities($info['font_size']); ?>" class="layui-input print-size ns-len-short" autocomplete="off">
			<?php else: ?>
			<input type="number" value="14" name="font_size" class="layui-input print-size ns-len-short" autocomplete="off">
			<?php endif; ?>
        </div>
		<div class="ns-word-aux">
			<p>请输入字体大小，字体单位：px，用于控制打印模板的文字大小</p>
		</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">显示尺寸：</label>
        <div class="layui-input-block">
            <div class="layui-input-inline">
				<?php if($info['width']): ?>
                <input name="width" type="number" value="<?php echo htmlentities($info['width']); ?>" lay-verify="int" class="layui-input show-width ns-len-short" autocomplete="off">
				<?php else: ?>
				<input name="width" type="number" value="766" lay-verify="int" class="layui-input show-width ns-len-short" autocomplete="off">
				<?php endif; ?>
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline">
				<?php if($info['height']): ?>
				<input name="height" type="number" value="<?php echo htmlentities($info['height']); ?>" lay-verify="int" class="layui-input show-height ns-len-short" autocomplete="off">
				<?php else: ?>
                <input name="height" type="number" value="510" lay-verify="int" class="layui-input show-height ns-len-short" autocomplete="off">
				<?php endif; ?>
            </div>
        </div>
		<div class="ns-word-aux">
			<p>尺寸单位：px，用于控制打印模板的尺寸</p>
		</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">打印选项：</label>
        <div class="layui-input-block">
            <?php foreach($print_item_list as $print_k=>$print_v): ?>
            <span class="print-option ns-border-color-gray" data-print-name="<?php echo htmlentities($print_v['item_name']); ?>"><?php echo htmlentities($print_v['item_title']); ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">效果图预览：</label>
        <div class="layui-input-block design-sketch">
        </div>
    </div>
	
	<div class="layui-form-item">
	    <label class="layui-form-label img-upload-lable">打印背景图：</label>
	    <div class="layui-input-block">
	        <div class="upload-img-block">
				<div class="upload-img-box <?php if(!(empty($info['background_image']) || (($info['background_image'] instanceof \think\Collection || $info['background_image'] instanceof \think\Paginator ) && $info['background_image']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="printBackground">
						<?php if($info['background_image']): ?>
						<div id="preview_printBackground" class="preview_img">
							<img layer-src src="<?php echo img($info['background_image']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png"/>
							<p>点击上传</p>
						</div>
						<?php endif; ?>
					</div>
					<div class="operation">
						<div>
							<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
							<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
						</div>
						<div class="replace_img js-replace">点击替换</div>
					</div>
					<input type="hidden" class="bg-img-pri" name="background_image" value="<?php echo htmlentities($info['background_image']); ?>" />   <!-- 预览背景图 -->
				</div>
	            <!-- <div class="upload-img-box" id="printBackground">
	                <?php if(empty($info['background_image'])): ?>
	                <div class="ns-upload-default">
	                	<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" />
	                	<p>点击上传</p>
	                </div>
	                <?php else: ?>
	                <img src="<?php echo img($info['background_image']); ?>" alt="">
	                <?php endif; ?>
	            </div> -->
	        </div>
	    </div>
		<p class="ns-word-aux">上传打印背景图会在打印时以背景形式显示在打印纸上，可在效果预览图中查看效果</p>
	</div>

    <div class="ns-form-row">
        <button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
        <button type="reset" class="layui-btn layui-btn-primary" onclick="back()">返回</button>
    </div>

    <input type="hidden" class="print-con" value="<?php echo htmlentities($info['content_json']); ?>" />   <!-- 打印内容 -->
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


<script src="https://ls.chnssl.com/public/static/js/Tdrag.min.js"></script>
<script>
    $(document).ready(function () {
        var img = $(".bg-img-pri").val();
        $(".design-sketch").css({
			"background": "url("+ ns.img(img) +") no-repeat center/ cover",
			"width": $("input[name=width]").val(),
			"height": $("input[name=height]").val()
		});

        if ($(".print-con").val() != '') {
            var arr = JSON.parse($(".print-con").val());
            var fontSize = $("input[name=font_size]").val();
			if (fontSize == '') {
				fontSize = 14;
			}
            for (index in arr) {
                var class_name = arr[index].item_name,
                    span_text = arr[index].item_title,
                    top = arr[index].top,
                    left = arr[index].left;
				
				$(".print-option").each(function () {
					var print_name = $(this).attr("data-print-name");
					if (class_name == print_name) {
						$(this).addClass("ns-bg-color-gray");
						$(this).css("cursor", "not-allowed");
					}
				});
				
                var html = '<div class="span_' + class_name + '" style="top: '+ top +'px; left: '+ left +'px; font-size: '+ fontSize +'px;">'+
								'<span>' + span_text + '</span>'+
								'<i class="iconfont iconclose_light" onclick="remove(this)"></i>'+
							'</div>';
                $(".design-sketch").append(html);
				
				$(".span_" + arr[index].item_name).hover(function () {
					$(this).find("i").show();
				}, function () {
					$(this).find("i").hide();
				});

                $(".span_" + arr[index].item_name).Tdrag({
                    scope: ".design-sketch"
                });
            }
        }
    });
</script>
<script>
    layui.use(['form'],function() {
        var form = layui.form,
            repeat_flag = false; //防重复标识
		form.render();
	    
        /**
         * 打印背景图
         */
		
		var bg_upload = new Upload({
			elem: '#printBackground',
			callback:function (res) {
				if (res.code >= 0) {
					$(".design-sketch").css("background", "url("+ ns.img(res.data.pic_path) +") no-repeat center/ cover");
				}
			},
			deleteCallback:function () {
				$(".design-sketch").css("background", "");
			}
		});
		
		
        /**
         * 监听提交
         */
        form.on('submit(save)', function(data) {
            var content = [];
            $(".design-sketch div").each(function () {
                var item = {};
                item.item_name = $(this).attr("class").substring(5);
                item.item_title = $(this).text();
                item.left = $(this).position().left;
                item.top = $(this).position().top;
                content.push(item);
            });
            data.field.content_json = JSON.stringify(content);
			
            if (repeat_flag) return;
            repeat_flag = true;
			
			//删除图片
			if(!data.field.background_image) bg_upload.delete();
			
            $.ajax({
                url: ns.url("shop/express/editPrintTemplate"),
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(res){
                    repeat_flag = false;

					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("shop/express/expressCompany");
							},
							btn2: function() {
								location.reload();
							}
						});
					}else{
						layer.msg(res.message);
					}
                }
            });
        });

        /**
         * 预览内容添加
         */
        $(".print-option").click(function(){
            var dataValue = $(this).text(),
                dataId = $(this).attr("data-print-name");
            var fontSize = $("input[name=font_size]").val();
            if (fontSize == '') {
                fontSize = 14;
            }
		
            if ($(".span_"+ dataId).length > 0) {
                return false;
            } else {
				$(this).addClass("ns-bg-color-gray");
				$(this).css("cursor", "not-allowed");
			}
			
            var html = '<div class="span_' + dataId + '" style="font-size: '+ fontSize +'px;">'+
							'<span>' + dataValue + '</span>'+
							'<i class="iconfont iconclose_light" onclick="remove(this)"></i>'+
						'</div>';
            $(".design-sketch").append(html);
			
			$(".span_" + dataId).hover(function () {
				$(this).find("i").show();
			}, function () {
				$(this).find("i").hide();
			});

            $(".span_" + dataId).Tdrag({
                scope: ".design-sketch"
            });
        });

        /**
         * 改变效果图宽和高
         */
        $(".show-width").blur(function(){
            $(".design-sketch").css("width", $(this).val());
            $("#realWidth").text($(this).val() * $(".proportion").val() + "px");
        });

        $(".show-height").blur(function(){
            $(".design-sketch").css("height", $(this).val());
            $("#realHeight").text($(this).val() * $(".proportion").val() + "px");
        });

        /**
         *  打印字体大小
         */
        $(".print-size").blur(function(){
            $(".design-sketch span").css("font-size", $(this).val() + "px");
        });
    });
	
	function remove(e) {
		var that = e;
		$(that).parent().remove();
		
		var attr_name = $(that).parent().attr("class").substring(5);
		$(".print-option").each(function () {
			var print_name = $(this).attr("data-print-name");
			if (attr_name == print_name) {
				$(this).removeClass("ns-bg-color-gray");
				$(this).css("cursor", "pointer");
			}
		});
	}

    function back(){
        location.href = ns.url("shop/express/expressCompany");
    }
</script>

</body>

</html>