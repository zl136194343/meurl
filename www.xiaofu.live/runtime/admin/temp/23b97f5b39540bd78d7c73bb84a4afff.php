<?php /*a:2:{s:67:"/www/wwwroot/ls.chnssl.com/app/admin/view/shopgroup/edit_group.html";i:1614516004;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
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
	
<style type="text/css">
	.tree-line{padding:10px 0;background:#ededed;margin-bottom:2px;line-height: 1.8;}
	.tree-line .layui-form{padding-left: 10px !important;}
	.tree-line .layui-form-checkbox{margin:0 10px !important;vertical-align:middle;}
	.ns-form {margin-top: 0;}
	.ns-item-block-hover-a {cursor: pointer;}
	.ns-input-box {position: absolute; right: 0; top: 50%; transform: translateY(-50%);}
	.layui-form-item .layui-form-checkbox[lay-skin=primary] {margin-top: 0;}
	.ns-item-content-desc{display:inline-block;white-space:nowrap;width:100%;overflow:hidden;text-overflow:ellipsis}
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
				
<div class="layui-form ns-form">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>套餐名称：</label>
		<div class="layui-input-block">
			<input name="group_name" type="text" lay-verify="required" class="layui-input ns-len-long" value="<?php echo htmlentities($group_info['data']['group_name']); ?>" autocomplete="off">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否自营：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_own" value="1" lay-skin="switch" <?php if($group_info['data']['is_own'] == 1): ?>checked<?php endif; ?> >
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">年费：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="fee" value="<?php echo htmlentities($group_info['data']['fee']); ?>" lay-verify="flo" autocomplete="off" class="layui-input ns-len-short" autocomplete="off">
			</div>
			<span class="layui-form-mid">元</span>
		</div>
		<div class="ns-word-aux">
			<p>年费不能小于0，可保留两位小数</p>
		</div>
	</div>
	
	<div class="layui-form-item layui-form-text">
		<label class="layui-form-label">描述：</label>
		<div class="layui-input-block">
			<textarea name="remark" class="layui-textarea ns-len-long"><?php echo htmlentities($group_info['data']['remark']); ?></textarea>
		</div>
	</div>
	
	<div class="layui-form-item layui-form-text" id="promotion_list">
		<div id="promotion">
			<label class="layui-form-label">店铺营销：</label>
			<div class="layui-input-block">
				<div class="site_list ns-item-block-parent ns-item-five">
					<?php foreach($promotions as $promotion): if($promotion['show_type'] == 'shop'): ?>
					<a class="ns-item-block ns-item-block-hover-a">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="<?php echo img($promotion['icon']); ?>" />
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title"><?php echo htmlentities($promotion['title']); ?></div>
								<p class="ns-item-content-desc"><?php echo htmlentities($promotion['description']); ?></p>
							</div>
						</div>

						<div class="ns-input-box">
							<input type="checkbox" <?php if($promotion['is_checked']): ?> checked <?php endif; ?> value="<?php echo htmlentities($promotion['name']); ?>" class="ns-input-checkbox" lay-filter="is_checked" lay-skin="primary">
						</div>
					</a>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		
		<div id = "admin">
			<label class="layui-form-label">平台推广：</label>
			<div class="layui-input-block">
				<div class="site_list ns-item-block-parent ns-item-five">
					<?php foreach($promotions as $promotion): if($promotion['show_type'] == 'admin'): ?>
					<a class="ns-item-block ns-item-block-hover-a">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="<?php echo img($promotion['icon']); ?>" />
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title"><?php echo htmlentities($promotion['title']); ?></div>
								<p class="ns-item-content-desc"><?php echo htmlentities($promotion['description']); ?></p>
							</div>
						</div>

						<div class="ns-input-box">
							<input type="checkbox" <?php if($promotion['is_checked']): ?> checked <?php endif; ?> value="<?php echo htmlentities($promotion['name']); ?>" class="ns-input-checkbox" lay-filter="is_checked" lay-skin="primary">
						</div>
					</a>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		
		<div id="member">
			<label class="layui-form-label">会员营销：</label>
			<div class="layui-input-block">
				<div class="site_list ns-item-block-parent ns-item-five">
					<?php foreach($promotions as $promotion): if($promotion['show_type'] == 'member'): ?>
					<a class="ns-item-block ns-item-block-hover-a">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="<?php echo img($promotion['icon']); ?>" />
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title"><?php echo htmlentities($promotion['title']); ?></div>
								<p class="ns-item-content-desc"><?php echo htmlentities($promotion['description']); ?></p>
							</div>
						</div>

						<div class="ns-input-box">
							<input type="checkbox" <?php if($promotion['is_checked']): ?> checked <?php endif; ?> value="<?php echo htmlentities($promotion['name']); ?>" class="ns-input-checkbox" lay-filter="is_checked" lay-skin="primary">
						</div>
					</a>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		
		<div id="tool">
			<label class="layui-form-label">应用工具：</label>
			<div class="layui-input-block">
				<div class="site_list ns-item-block-parent ns-item-five">
					<?php foreach($promotions as $promotion): if($promotion['show_type'] == 'tool'): ?>
					<a class="ns-item-block ns-item-block-hover-a">
						<div class="ns-item-block-wrap">
							<div class="ns-item-pic">
								<img src="<?php echo img($promotion['icon']); ?>" />
							</div>
							<div class="ns-item-con">
								<div class="ns-item-content-title"><?php echo htmlentities($promotion['title']); ?></div>
								<p class="ns-item-content-desc"><?php echo htmlentities($promotion['description']); ?></p>
							</div>
						</div>

						<div class="ns-input-box">
							<input type="checkbox" <?php if($promotion['is_checked']): ?> checked <?php endif; ?> value="<?php echo htmlentities($promotion['name']); ?>" class="ns-input-checkbox" lay-filter="is_checked" lay-skin="primary">
						</div>
					</a>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ns-form-row">
		<button class="layui-btn  ns-bg-color " lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>

	<input name="group_id" type="text"  class="layui-input layui-hide" value="<?php echo htmlentities($group_info['data']['group_id']); ?>">
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
	var promotion_items = $("#promotion a").length,
			extend_items = $("#admin a").length,
			tool_item = $('#tool a').length,
			interaction_items = $("#member a").length;
	if (promotion_items == 0) {
		$("#promotion").hide();
	}
	if (extend_items == 0) {
		$("#admin").hide();
	}
	if (interaction_items == 0) {
		$("#member").hide();
	}
	if (tool_item == 0) {
		$("#tool").hide();
	}
    layui.use('form', function() {
        var form = layui.form,
			repeat_flag = false;//防重复标识
		form.render();

		$(".ns-item-block").each(function() {
			var checkCon = $(this).find(".ns-input-checkbox");
			
			$(this).click(function() {
				if ($(checkCon).is(':checked')) {
					$(this).find(".layui-form-checkbox").removeClass("layui-form-checked");
					$(checkCon).prop("checked", false);
				} else {
					$(this).find(".layui-form-checkbox").addClass("layui-form-checked");
					$(checkCon).prop("checked", true);
				}
			});
			
			form.on("checkbox(is_checked)", function(data) {
				$(data.elem).parents(".ns-item-block").click();
			})
		});
		
        form.on('submit(save)', function (data) {
			if (repeat_flag) return;
            repeat_flag = true;

			var obj = $("#promotion_list input:checked");
			var addon_array = [];
			for (var i = 0; i < obj.length; i++) {
				addon_array.push(obj.eq(i).val());
			}
			data.field.addon_array = addon_array.toString();
	        
            $.ajax({
                url: ns.url("admin/shopgroup/editgroup"),
                data: data.field,
                type: "POST",
                dataType: "JSON",
                success: function (res) {
					repeat_flag = false;

					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("admin/shopgroup/lists")
							},
							btn2: function() {
								location.reload();
							}
						})
					}else{
						layer.msg(res.message);
					}
                }
            });
        });

		//表单验证
        form.verify({
			flo: function (value) {
				if (value == '') {
					return;
				}
				if (value < 0) {
					return '年费不能小于0！';
				}
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}
				if (val.length > 2) {
					return '年费最多可保留两位小数！'
				}
			}
        });
    });

	function back(){
		location.href = ns.url('admin/shopgroup/lists');
	}
</script>

</body>
</html>