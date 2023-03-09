<?php /*a:2:{s:82:"/www/wwwroot/ls.chnssl.com/addon/platformcoupon/admin/view/platformcoupon/add.html";i:1614519866;s:24:"app/admin/view/base.html";i:1661854360;}*/ ?>
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
			<li>标识“<span class="required">*</span>”的选项为必填项，其余为选填项</li>
			<li>有效期类型可选固定时间和自领取之日起
				<p>1、固定时间：选择结束日期，所有领取的优惠券有效期都截止在结束日期当天</p>
				<p>2、自领取之日起：填写一个数字，表示从领取之日起有效期持续多少天</p>
			</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>优惠券名称：</label>
		<div class="layui-input-block">
			<input type="text" name="platformcoupon_name" lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>优惠券面额：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="money" lay-verify="required|number|money|gtzero" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">元</span>
		</div>
		<div class="ns-word-aux">
			<p>价格不能小于0，可保留两位小数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>使用场景：</label>
		<div class="layui-input-block">
			<input type="radio" name="use_scenario" lay-filter="use_scenario" value="1" title="全场通用" checked>
			<input type="radio" name="use_scenario" lay-filter="use_scenario" value="2" title="指定店铺">
		</div>
	</div>

	<div class="layui-form-item group_list" style="display: none">
		<label class="layui-form-label"></label>
		<div class="layui-input-block ns-len-long">
			<?php foreach($group_list as $k=>$v): ?>
			<input type="checkbox" name="group_ids[<?php echo htmlentities($k); ?>]" value="<?php echo htmlentities($v['group_id']); ?>"  lay-skin="primary" title="<?php echo htmlentities($v['group_name']); ?>" <?php if($k == 0): ?> checked="" <?php endif; ?>>
			<?php endforeach; ?>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>店铺分担比率：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="shop_split_rare" min="0" lay-verify="required|number|money|rate" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">%</span>
		</div>
		<div class="ns-word-aux">
			<p>订单使用时的平台优惠券优惠店铺承担部分</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>发放数量：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="count" min="0" lay-verify="required|number|int|gtzero" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">张</span>
		</div>
		<div class="ns-word-aux">
			<p>发放数量必须大于0，且必须为整数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>最大领取数量：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="max_fetch" min="0" value="1" lay-verify="required|number|int|max" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">张</span>
		</div>
		<div class="ns-word-aux">
			<p>数量不能小于0，且必须为整数；设置为0时，可无限领取</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>满多少元可以使用：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" name="at_least" lay-verify="required|number|money" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">元</span>
		</div>
		<div class="ns-word-aux">
			<p>价格不能小于0，无门槛请设为0</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">优惠券图片：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box ">
					<div class="ns-upload-default" id="platformcouponImg">
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
		<div class="ns-word-aux">
			<p>建议尺寸：325*95像素</p>
			<p>图片上传默认不限制大小</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否允许直接领取：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_show" lay-filter="" value="1" lay-skin="switch" checked />
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">有效期类型：</label>
		<div class="layui-input-block">
			<input type="radio" name="validity_type" value="0" lay-filter="filter" checked="checked" title="固定时间">
			<input type="radio" name="validity_type" value="1" lay-filter="filter" title="领取之日起">
		</div>
	</div>

	<div class="layui-form-item ns-end-time">
		<label class="layui-form-label">活动结束时间：</label>
		<div class="layui-input-block">
			<input type="text" name="end_time" lay-verify="time" id="end_time" class="layui-input ns-len-mid" autocomplete="off" readonly>
		</div>
	</div>

	<div class="layui-form-item ns-fixed-term layui-hide">
		<label class="layui-form-label">领取之日起：</label>
		<div class="layui-input-block">
			<div class="layui-input-inline">
				<input type="number" min="1" max="365" value="10" name="fixed_term" lay-verify="days" autocomplete="off" class="layui-input ns-len-short">
			</div>
			<span class="layui-form-mid">天有效</span>
		</div>
		<div class="ns-word-aux">
			<p>不能小于0，且必须为整数</p>
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


<script>
	layui.use(['laydate', 'form'], function() {
		var form = layui.form,
			laydate = layui.laydate,
			repeat_flag = false; //防重复标识
			currentDate = new Date();  //当前时间
		form.render();

		currentDate.setDate(currentDate.getDate() + 10);  //10天后的日期

		// 时间模块
		laydate.render({
			elem: '#end_time', //指定元素
			type: 'datetime',
			value: currentDate
		});

        //监听活动商品类型
        form.on('radio(use_scenario)', function(data){
            var value = data.value;
            if(value == 1){
                $(".group_list").hide();
            }
            if(value == 2){
                $(".group_list").show();
            }
        });

		/**
		 * 表单监听提交
		 */
		form.on('submit(save)', function(data) {
			if (data.field.is_show == undefined) {
				data.field.is_show = 0;
			}

			if (repeat_flag) return false;
			repeat_flag = true;
			
			//删除图片
			if(!data.field.image) platformcouponImg_upload.delete();
			
			$.ajax({
				url: ns.url("platformcoupon://admin/platformcoupon/add"),
				data: data.field,
				dataType: 'JSON',
				type: 'POST',
				success: function(res) {
					repeat_flag = false;

					if (res.code == 0) {
						layer.confirm('添加成功', {
							title:'操作提示',
							btn: ['返回列表', '继续添加'],
							yes: function(){
								location.href = ns.url("platformcoupon://admin/platformcoupon/lists")
							},
							btn2: function() {
								location.href = ns.url("platformcoupon://admin/platformcoupon/add")
							}
						});
					}else{
						layer.msg(res.message);
					}
				}
			});
		});

		// 监听单选按钮
		form.on('radio(filter)', function(data) {
			if (data.value == 0) {
				$('.ns-end-time').removeClass('layui-hide');
				$('.ns-fixed-term').addClass('layui-hide');
			} else {
				$('.ns-fixed-term').removeClass('layui-hide');
				$('.ns-end-time').addClass('layui-hide');
			}
		});

		// 图片上传
		var platformcouponImg_upload = new Upload({
			elem: '#platformcouponImg',
			url: ns.url("admin/upload/upload"),
		});

		form.verify({
			days: function(value) {
				if (value == '') {
					return;
				}
				if (value%1 != 0) {
					return '请输入整数';
				}
			},
			rate: function(value){
				if (value > 100) {
					return '分担比率不能大于100';
				}
			},
			number: function (value) {
				if (parseFloat(value) < 0) {
					return '请输入大于或等于0的数!'
				}
			},
			int: function (value) {
				if (value%1 != 0) {
					return '请输入整数!'
				}
				if (value <= 0) {
					return '请输入大于0的数!'
				}
			},
			money: function (value) {
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}
				if (val.length > 2) {
					return '保留小数点后两位'
				}
			},
			time: function(value) {
				var now_time = (new Date()).getTime();
				var end_time = (new Date(value)).getTime();
				if (now_time > end_time) {
					return '结束时间不能小于当前时间!'
				}
			},
			gtzero: function(value) {
				if (parseFloat(value) <= 0) {
					return '请输入大于0的数!'
				}
			},
			max: function(value) {
				var _count = $("input[name=count]").val();
				if (parseInt(value) > parseInt(_count)) {
					return '最大领取数量不能超过发放数量!';
				}
			}
		});
	});

	function back() {
		location.href = ns.url("platformcoupon://admin/platformcoupon/lists");
	}
</script>

</body>
</html>