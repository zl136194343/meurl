<?php /*a:2:{s:64:"/www/wwwroot/ls.chnssl.com/app/admin/view/config/web_config.html";i:1616032148;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
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
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>站点设置包括网站的基本信息设置，SEO设置以及网站官方联系方式等</li>
			<li>可根据SEO设置优化网站排名</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>网站标题：</label>
		<div class="layui-input-block">
			<input type="text" name="title" lay-verify="required" value="<?php echo htmlentities($website_info['data']['title']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">网站名称，将显示在前台顶部欢迎信息等位置</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">网站logo：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box <?php if(!(empty($website_info['data']['logo']) || (($website_info['data']['logo'] instanceof \think\Collection || $website_info['data']['logo'] instanceof \think\Paginator ) && $website_info['data']['logo']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="webLogoUpload">
						<?php if($website_info['data']['logo']): ?>
						<div id="preview_webLogoUpload" class="preview_img">
							<img layer-src src="<?php echo img($website_info['data']['logo']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
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
					<input type="hidden" name="logo" value="<?php echo htmlentities($website_info['data']['logo']); ?>">
				</div>
			</div>
		</div>
		<div class="ns-word-aux">默认网站LOGO，通用头部显示，最佳显示尺寸为200px*60px</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">网站描述：</label>
		<div class="layui-input-block">
			<textarea name="desc" class="layui-textarea ns-len-long"><?php echo htmlentities($website_info['data']['desc']); ?></textarea>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">网站关键字：</label>
		<div class="layui-input-block">
			<input type="text" name="keywords" value="<?php echo htmlentities($website_info['data']['keywords']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">用于网站搜索引擎的优化，关键字之间请用英文逗号分隔</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">网站地址：</label>
		<div class="layui-input-block">
			<input type="text" name="web_address" value="<?php echo htmlentities($website_info['data']['web_address']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">网站公众号二维码：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box <?php if(!(empty($website_info['data']['web_qrcode']) || (($website_info['data']['web_qrcode'] instanceof \think\Collection || $website_info['data']['web_qrcode'] instanceof \think\Paginator ) && $website_info['data']['web_qrcode']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="webQrcodeUpload">
						<?php if($website_info['data']['web_qrcode']): ?>
						<div id="preview_webQrcodeUpload" class="preview_img">
							<img layer-src src="<?php echo img($website_info['data']['web_qrcode']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
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
					<input type="hidden" name="web_qrcode" value="<?php echo htmlentities($website_info['data']['web_qrcode']); ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">网站邮箱：</label>
		<div class="layui-input-block">
			<input type="text" name="web_email" value="<?php echo htmlentities($website_info['data']['web_email']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">网站联系方式：</label>
		<div class="layui-input-block">
			<input type="text" name="web_phone" value="<?php echo htmlentities($website_info['data']['web_phone']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">网站QQ：</label>
		<div class="layui-input-block">
			<input type="text" name="web_qq" value="<?php echo htmlentities($website_info['data']['web_qq']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">网站微信：</label>
		<div class="layui-input-block">
			<input type="text" name="web_weixin" value="<?php echo htmlentities($website_info['data']['web_weixin']); ?>" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<!--<div class="layui-form-item">-->
		<!--<label class="layui-form-label">手机端域名：</label>-->
		<!--<div class="layui-input-block">-->
			<!--<input type="text" name="wap_domain" value="<?php echo htmlentities($website_info['data']['wap_domain']); ?>" autocomplete="off" class="layui-input ns-len-long">-->
		<!--</div>-->
	<!--</div>-->

	<!--<div class="layui-form-item">-->
		<!--<label class="layui-form-label">电脑端域名：</label>-->
		<!--<div class="layui-input-block">-->
			<!--<input type="text" name="web_domain" value="<?php echo htmlentities($website_info['data']['web_domain']); ?>" autocomplete="off" class="layui-input ns-len-long">-->
		<!--</div>-->
	<!--</div>-->
	<?php if(addon_is_exit('pc')): ?>
	<div class="layui-form-item">
		<label class="layui-form-label">pc端是否启用：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="web_status" value="1" lay-skin="switch" <?php if($website_info['data']['web_status'] == 1): ?> checked <?php endif; ?> />
		</div>
	</div>
	<?php endif; ?>
	<div class="layui-form-item">
		<label class="layui-form-label">手机端是否启用：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="wap_status" value="1" lay-skin="switch" <?php if($website_info['data']['wap_status'] == 1): ?> checked <?php endif; ?> />
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">网站关闭原因：</label>
		<div class="layui-input-block">
			<textarea name="close_reason" class="layui-textarea ns-len-long"><?php echo htmlentities($website_info['data']['close_reason']); ?></textarea>
		</div>
	</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
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


<script>
	layui.use(['form'], function() {
		var form = layui.form,
			repeat_flag = false; //防重复标识
		form.render();
		form.on('submit(save)', function(data) {
			if (data.field.web_status == undefined) {
				data.field.web_status = 0;
			}

			if (data.field.wap_status == undefined) {
				data.field.wap_status = 0;
			}

			if (repeat_flag) return;
			repeat_flag = true;
			
			//图片删除
			if(!data.field.logo) web_upload.delete();
			if(!data.field.web_qrcode) web_qrcode_upload.delete();
			
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: ns.url("admin/config/webConfig"),
				data: data.field,
				success: function(res) {
					layer.msg(res.message);
					if (res.code == 0) {
						location.reload();
					}else{
						repeat_flag = false;
					}
				}
			});
		});

		// 上传logo
		var web_upload = new Upload({
			elem: '#webLogoUpload',
			url: ns.url("admin/upload/upload"),
		});

		// 二维码
		var web_qrcode_upload = new Upload({
			elem: '#webQrcodeUpload',
			url: ns.url("admin/upload/upload"),
		});

	});
</script>

</body>
</html>