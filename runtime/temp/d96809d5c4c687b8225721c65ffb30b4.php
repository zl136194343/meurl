<?php /*a:2:{s:65:"/www/wwwroot/ls.chnssl.com/addon/city/admin/view/website/add.html";i:1614520128;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
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
	.layui-input {display: inline-block;}
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
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站名称：</label>
		<div class="layui-input-block">
			<input name="title" type="text" lay-verify="required" placeholder="请输入城市站点名称" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">分站图标：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box">
					<div class="ns-upload-default" id="logo">
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
					<input type="hidden" name="logo" value="">
				</div>
			</div>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">分站关键字：</label>
		<div class="layui-input-block">
			<input name="keywords" type="text" placeholder="请输入城市站点关键字" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">分站描述：</label>
		<div class="layui-input-block">
			<textarea class="layui-textarea ns-len-long" name="desc"></textarea>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站联系方式：</label>
		<div class="layui-input-block">
			<input type="text" name="web_phone" lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">分站邮箱：</label>
		<div class="layui-input-block">
			<input type="text" name="web_email" lay-verify="isemail" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">分站QQ：</label>
		<div class="layui-input-block">
			<input type="text" name="web_qq" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">分站微信：</label>
		<div class="layui-input-block">
			<input type="text" name="web_weixin" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站地址：</label>
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="province_id" lay-filter="province_id" lay-verify="province_id">
				<option value="">请选择省份</option>
				<?php foreach($province_list as $k => $v): ?>
				<option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="layui-input-inline ns-len-mid area-select">
			<select name="city_id" lay-filter="city_id" lay-verify="city_id">
				<option value="">请选择城市</option>
			</select>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站登录用户名：</label>
		<div class="layui-input-block">
			<input type="text" name="username" lay-verify="required" autocomplete="off" class="layui-input ns-len-mid">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站登录密码：</label>
		<div class="layui-input-block">
			<input type="password" name="password" lay-verify="required" autocomplete="off" class="layui-input ns-len-mid">
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站开店分佣比率：</label>
		<div class="layui-input-block">
			<input type="number" name="shop_rate" min="0" max="100" lay-verify="required|fl" autocomplete="off" class="layui-input ns-len-short"> %
		</div>
		<span class="ns-word-aux">分站开店佣金 = 店铺入驻金额 * 分站开店分佣比率</span>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>分站订单分佣比率：</label>
		<div class="layui-input-block">
			<input type="number" name="order_rate" min="0" max="100" lay-verify="required|fl" autocomplete="off" class="layui-input ns-len-short"> %
		</div>
		<span class="ns-word-aux">分站订单分佣 = 平台订单抽成 * 分站订单分佣比率</span>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">银行开户名：</label>
		<div class="layui-input-block">
			<input name="settlement_bank_account_name" type="text"  class="layui-input ns-len-long" autocomplete="off">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">公司银行账号：</label>
		<div class="layui-input-inline">
			<input name="settlement_bank_account_number" type="text" class="layui-input ns-len-long" autocomplete="off">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">开户银行名称：</label>
		<div class="layui-input-inline">
			<input name="settlement_bank_name" type="text" class="layui-input ns-len-long" autocomplete="off">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">开户银行所在地：</label>
		<div class="layui-input-inline">
			<input name="settlement_bank_address" type="text" class="layui-input ns-len-long" autocomplete="off">
		</div>
	</div>

	
	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
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


<script type="text/javascript" src="https://ls.chnssl.com/app/shop/view/public/js/address.js"></script>
<script>
	layui.use(['form'], function() {
		var form = layui.form,
			repeat_flag = false;

		// 分站图标上传
		var logo_upload = new Upload({
			elem: '#logo',
			url: ns.url("admin/upload/upload"),
		});
		
		form.on('submit(save)', function(data) {
			data.field.site_area_id = data.field.city_id;
			data.field.site_area_name = $("select[name=city_id] option:selected").text();
			
		    if (repeat_flag) return;
		    repeat_flag = true;
			
			//删除图片
			if(!data.field.logo) logo_upload.delete();
			
			$.ajax({
				dataType: 'JSON',
				type: 'POST',
				url: ns.url("city://admin/website/add"),
				data: data.field,
				success: function(res){

					if (res.code == 0) {
						layer.confirm('添加城市站点已成功', {
							title:'操作提示',
							btn: ['返回列表', '继续添加'],
							yes: function(){
								location.href = ns.url("city://admin/website/lists")
							},
							btn2: function() {
								location.href = ns.url("city://admin/website/add")
							}
						})
					}else{
                        repeat_flag = false;
						layer.msg(res.message);
					}
				}
			});
		});
		
		//表单验证
		form.verify({
			province_id : function(value, item){
			    if(value == ''){
			        return '请选择省份';
			    }
			},
			city_id : function(value, item){
			    if(value == ''){
			        return '请选择城市';
			    }
			},
			fl: function(value, item) {
				var str = $(item).parents(".layui-form-item").find("label").text().split("*").join("");
				str = str.substring(0, str.length - 1);
				
				if (value < 0) {
					return str + "不能小于0";
				}
				
				if (value > 100) {
					return str + "不能大于100";
				}
				
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}
				if (val.length > 2) {
					return str + "最多可保留两位小数";
				}
			},
			isemail: function(value) {
				var reg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
				if (value == '') {
					return;
				}
				if (!reg.test(value)) {
					return '请输入正确的邮箱!';
				}
			}
		});
	});
	
	function back() {
		location.href = ns.url("city://admin/website/lists")
	}
</script>

</body>
</html>