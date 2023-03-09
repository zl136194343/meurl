<?php /*a:2:{s:56:"/www/wwwroot/ls.chnssl.com/app/admin/view/diy/style.html";i:1614515900;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1660099950;}*/ ?>
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
    .ns-exchange-type {
        display: inline-block;
        width: 142px;
        height: 68px;
        border: 1px solid #ededed;
        border-radius: 4px;
        margin-right: 10px;
        line-height: 68px;
        position: relative;
        box-shadow: 4px 4px 6px #f5f5f5;
    }
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
    .style{
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding: 0 20px;
    }
    .style div {
        width: 50px;
        height: 16px;
    }
    .style p {
        margin-left: 15px;
        font-size: 12px;
        color: #333;
    }
	
    .style.style-red div {background: url(https://ls.chnssl.com/app/admin/view/public/img/style/color_panel.png) no-repeat 0 0;}
	.style.style-green div{background: url(https://ls.chnssl.com/app/admin/view/public/img/style/color_panel.png) no-repeat -77px 0;}
	.style.style-blue div{background: url(https://ls.chnssl.com/app/admin/view/public/img/style/color_panel.png) no-repeat -156px 0;}
	.style.style-pink div{background: url(https://ls.chnssl.com/app/admin/view/public/img/style/pink.png) no-repeat;}
	.style.style-golden div{background: url(https://ls.chnssl.com/app/admin/view/public/img/style/golden.png) no-repeat;}

    .style_theme{
        margin-top: 58px;
    }
    .style_theme img {
        margin-right: 64px;
        height: 534px;
        width: 300px;
        -webkit-box-shadow: 5px 5px 20px #f5f5f5;
        box-shadow: 5px 5px 20px #f5f5f5;
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
				

<div class="layui-form ns-form">

    <div class="layui-form">
        <div class="layui-form-item">
            <div class="layui-input-block">

                <div class="ns-exchange-type ns-exchange-selected exchange_default"  data-status="default">
                    <div class="style style-red"><div></div><p>热情红</p></div>
                </div>

                <div class="ns-exchange-type exchange_blue" data-status="blue">
                    <div class="style style-blue"><div></div><p>商务蓝</p></div>
                </div>

                <div class="ns-exchange-type exchange_green" data-status="green">
                    <div class="style style-green"><div></div><p>纯净绿</p></div>
                </div>

                <div class="ns-exchange-type exchange_pink" data-status="pink">
                    <div class="style style-pink"><div></div><p>樱花粉</p></div>
                </div>

                <div class="ns-exchange-type exchange_golden" data-status="golden">
                    <div class="style style-golden"><div></div><p>魅力金</p></div>
                </div>

                <input type="hidden" name="style_theme" <?php if(isset($style_theme['style_theme'])): ?> value="<?php echo htmlentities($style_theme['style_theme']); ?>" <?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">

                <div class="style_theme style_theme_default">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-default-1.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-default-2.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-default-3.png" alt="">
                </div>

                <div class="style_theme style_theme_blue">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-blue-1.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-blue-2.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-blue-3.png" alt="">
                </div>

                <div class="style_theme style_theme_green">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-green-1.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-green-2.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-green-3.png" alt="">
                </div>

                <div class="style_theme style_theme_pink">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-pink-1.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-pink-2.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-pink-3.png" alt="">
                </div>

                <div class="style_theme style_theme_golden">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-golden-1.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-golden-2.png" alt="">
                    <img src="https://ls.chnssl.com/app/admin/view/public/img/style/decorate-golden-3.png" alt="">
                </div>

            </div>
        </div>

        <div class="ns-form-row style_theme" >
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
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


<script>
    var style_theme = $("input[name='style_theme']").val();
    style_theme = style_theme == '' ? 'default' : style_theme;

    $("input[name='style_theme']").val(style_theme);

    $('.exchange_'+style_theme).addClass("ns-exchange-selected");
    $('.exchange_'+style_theme).siblings("div").removeClass("ns-exchange-selected");

    $('.style_theme_'+style_theme).show();
    $('.style_theme_'+style_theme).siblings(".style_theme").hide();

    $(".ns-exchange-type").click(function() {
        $(this).addClass("ns-exchange-selected");
        $(this).siblings("div").removeClass("ns-exchange-selected");

        var style_theme = $(this).attr('data-status');
        $("input[name='style_theme']").val(style_theme);

        $('.style_theme_'+style_theme).show();
        $('.style_theme_'+style_theme).siblings(".style_theme").hide();
    });

    layui.use('form', function() {
        var form = layui.form,
            repeat_flag = false; //防重复标识

        /**
         * 监听提交
         */
        form.on('submit(save)', function(data) {

            if (repeat_flag) return;
            repeat_flag = true;

            $.ajax({
                url: ns.url("admin/diy/style"),
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(res) {
                    repeat_flag = false;
                    layer.msg(res.message);
                }
            });

        });
    });

</script>

</body>
</html>