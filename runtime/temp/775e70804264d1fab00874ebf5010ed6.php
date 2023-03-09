<?php /*a:2:{s:74:"/www/wwwroot/ls.chnssl.com/addon/membersignin/admin/view/config/index.html";i:1614519914;s:24:"app/admin/view/base.html";i:1661854360;}*/ ?>
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
	
<style>
	.ns-noboder-searchbox {margin-right: 0 !important;}
	.ns-search-noborder {border-width: 1px;width: 42px;border-style: solid;text-align: center;border-color: #e6e6e6;padding: 0px !important;cursor: pointer;}

	.ns-width {width: 115px;}
	.layui-block {overflow: hidden; margin-bottom: 20px;}
	.layui-table+button {margin-top: 15px;}
	.ns-empty {text-align: center;}
	.layui-table[lay-size=lg] td, .layui-table[lay-size=lg] th {
		padding: 15px;
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
		<h2 class="layui-colla-title">操作说明</h2>
		<ul class="layui-colla-content layui-show">
			<li>用户可在签到页每日签到一次，每日签到按设置的每日奖励进行发放，连续签到天数大于设置的天数，按最后一日的奖励进行发放；若签到中断则重新计算；</li>
			<li>点击 “+” 按钮可以添加更多的推荐奖励规则</li>
			<li>点击删除图标按钮可以删除该条规则</li>
		</ul>
	</div>
</div>

<div class="layui-form ns-form">
	<div class="layui-form-item">
		<label class="layui-form-label">是否启用：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_use" lay-filter="is_use" value="1" lay-skin="switch" <?php if(!empty($config) && $config['is_use']==1): ?>checked<?php endif; ?>>
		</div>
	</div>

	<div class="reward-wrap <?php if(!empty($config) && $config['is_use']!=1): ?>layui-hide<?php endif; ?>">
		<div class="layui-form-item">
			<label class="layui-form-label"><span class="required">*</span>签到周期：</label>
			<div class="layui-input-block">
				<div class="layui-input-inline">
					<input type="number" name="cycle" lay-verify="required|number|int|cycle" value="<?php echo !empty($config['value']['cycle']) ? htmlentities($config['value']['cycle']) : 30; ?>" autocomplete="off" class="layui-input ns-len-short"><input type="hidden" value="签到周期" />
				</div>
				<div class="layui-form-mid">天</div>
			</div>
			<div class="ns-word-aux">
				<p>签到周期需在7-100天内</p>
			</div>
		</div>

		<div class="layui-form-item">
			<div class="layui-block">
				<label class="layui-form-label"><span class="required">*</span>每日签到：</label>
				<label class="layui-form-mid ns-width">每日签到赠送奖励</label>
				<div class="layui-input-inline ns-len-short">
					<input type="number" name="point" lay-verify="everyday|number|int" value="<?php echo !empty($config['value']['reward'][0]['point']) ? htmlentities($config['value']['reward'][0]['point']) : ''; ?>" autocomplete="off" class="layui-input ">
				</div>
				<span class="layui-form-mid">积分</span>
			</div>

			<div class="layui-block">
				<label class="layui-form-label"></label>
				<label class="layui-form-mid ns-width"></label>
				<div class="layui-input-inline ns-len-short">
					<input type="number" name="growth" lay-verify="everyday|number|flnum" value="<?php echo !empty($config['value']['reward'][0]['growth']) ? htmlentities($config['value']['reward'][0]['growth']) : ''; ?>" autocomplete="off" class="layui-input ">
				</div>
				<span class="layui-form-mid">成长值</span>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">连续签到：</label>

			<div class="layui-input-block">
				<table class="layui-table" id="sign" lay-skin="line" lay-size="lg">
					<colgroup>
						<col width="40%">
						<col width="20%">
						<col width="20%">
						<col width="20%">
					</colgroup>
					<thead>
					<tr>
						<th>连续签到天数</th>
						<th>奖励积分</th>
						<th>奖励成长值</th>
						<th class="operation">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php if(count($config['value']['reward']) > 1): foreach($config['value']['reward'] as $k =>$v): if($k>0): ?>
					<tr>
						<td><input type="number" class="layui-input ns-len-short day" value="<?php echo htmlentities($v['day']); ?>" lay-verify="required|int|day" autocomplete="off" /><input type="hidden" value="连续签到天数" /></td>
						<td><input type="number" class="layui-input ns-len-short point" value="<?php echo htmlentities($v['point']); ?>" lay-verify="signDay|number|int" autocomplete="off" /></td>
						<td><input type="number" class="layui-input ns-len-short growth" value="<?php echo htmlentities($v['growth']); ?>" lay-verify="signDay|number|int" autocomplete="off" /></td>
						<td><div class="ns-table-btn"><a href="javascript:;" class="layui-btn" onclick="deleteSign(this)">删除连续签到</a></div></td>
					</tr>
					<?php endif; ?>
					<?php endforeach; else: ?>
					<tr class="ns-empty-box">
						<td colspan="5">
							<div class="ns-empty">暂无数据</div>
						</td>
					</tr>
					<?php endif; ?>
					</tbody>
				</table>
				<button class="layui-btn ns-bg-color" onclick="addSign()">添加连续签到奖励</button>
			</div>
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
	layui.use('form', function() {
		var form = layui.form,
				repeat_flag = false; //防重复标识
		form.render();

		form.on('submit(save)', function(data) {
			var arr = [];
			arr.push({point: data.field.point, growth:data.field.growth, day: 1});

			$(".layui-table tbody tr").each(function () {
				if (!$(this).hasClass("ns-empty-box")) {
					var point = $(this).find(".point").val(),
							growth = $(this).find(".growth").val(),
							day = $(this).find(".day").val();
					arr.push({point: point, growth: growth, day: day});
				}
			});
			data.field.json = JSON.stringify(arr);

			if (repeat_flag) return;
			repeat_flag = true;

			$.ajax({
				type: 'POST',
				url: ns.url("membersignin://admin/config/index"),
				dataType: 'JSON',
				data: data.field,
				success: function (res) {
					repeat_flag = false;
					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title: '操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function () {
								location.href = ns.url("admin/promotion/member")
							},
							btn2: function () {
								location.reload();
							}
						});
					} else {
						layer.msg(res.message);
					}
				}
			})
		});

		var isEnable = $('.signin [name="is_use"]').is(':checked');

		form.on('switch(is_use)', function(data) {
			isEnable = $(data.elem).is(':checked');
			if (isEnable) {
				$('.reward-wrap').removeClass('layui-hide');
			} else {
				$('.reward-wrap').addClass('layui-hide');
			}
		});

		form.verify({
			everyday: function(){
				var point = $('[name="point"]').val(),
						growth = $('[name="growth"]').val();
				if (isEnable && (!/[\S]+/.test(point) && !/[\S]+/.test(growth))) {
					return "每日签到奖励至少设置一项";
				}
			},
			number: function (value, item) {
				if (isEnable) {
					var str = $(item).parents(".layui-block").find("span").text();
					var _str = $(item).siblings().val();
					if (value != '' && value <= 0) {
						if (str) {
							return str + "不能小于等于0";
						} else {
							return _str + "不能小于等于0";
						}
					}
				}
			},
			int: function (value, item) {
				if (isEnable && value != '') {
					var str = $(item).parents(".layui-block").find("span").text();
					var _str = $(item).siblings().val();
					if (value%1 != 0) {
						if (str) {
							return str + "必须为整数";
						} else {
							return _str + "必须为整数";
						}
					}
				}
			},
			flnum: function (value, item) {
				if (isEnable && value != '') {
					var str = $(item).parents(".layui-block").find("span").text();
					var _str = $(item).siblings().val();
					var arrMen = value.split(".");
					var val = 0;
					if (arrMen.length == 2) {
						val = arrMen[1];
					}
					if (val.length > 2) {
						if (str) {
							return str + "最多可保留两位小数";
						} else {
							return _str + "最多可保留两位小数";
						}
					}
				}
			},
			required: function (value, item) {
				if (isEnable) {
					var str = $(item).parents(".layui-block").find("span").text();
					var _str = $(item).siblings().val();

					if (value.trim() == "" || value == undefined || value == null) {
						if (str) {
							return str + "不能为空";
						} else {
							return _str + "不能为空";
						}
					}
				}
			},
			day: function(value, item){
				if (isEnable) {
					var cycle = $('[name="cycle"]').val();
					if (parseInt(value) < 2) {
						return "连签天数不能小于2天";
					}
					if (parseInt(value) > parseInt(cycle)) {
						return "最大连签天数不能大于签到周期";
					}
					var index = $(item).parents('tr').index();
					if (index) {
						var agoDay = $('.signin tbody tr:eq('+ (index - 1) +') .day').val();
						if (parseInt(value) <= parseInt(agoDay)) {
							return "连续签到天数不能相同或者小于上一个连签天数";
						}
					}
				}
			},
			signDay: function(value, item){
				if (isEnable) {
					var point = $(item).parents('tr').find('.point').val(),
							growth = $(item).parents('tr').find('.growth').val();
					if (isEnable && (!/[\S]+/.test(point) && !/[\S]+/.test(growth))) {
						return "连签奖励至少设置一项";
					}
				}
			},
			cycle: function(value) {
				if (isEnable) {
					if (parseInt(value) < 7 || parseInt(value) > 100) {
						return '签到周期需在7-100天内';
					}
				}
			}
		});

	});

	function addSign() {
		$("#sign").find("tbody .ns-empty-box").remove();
		var html = '';
		html += `<tr>`+
				`<td><input type="number" class="layui-input ns-len-short day" lay-verify="required|number|int" autocomplete="off" /><input type="hidden" value="连续签到天数" /></td>`+
				`<td><input type="number" class="layui-input ns-len-short point" lay-verify="required|number|int" autocomplete="off" /><input type="hidden" value="连续签到积分" /></td>`+
				`<td><input type="number" class="layui-input ns-len-short growth" lay-verify="required|number|int" autocomplete="off" /><input type="hidden" value="连续签到成长值" /></td>`+
				`<td><div class="ns-table-btn"><a href="javascript:;" class="layui-btn" onclick="deleteSign(this)">删除连续签到</a></div></td>`+
				`</tr>`;

		$("#sign").find("tbody").append(html);
	}

	function deleteSign(e) {
		$(e).parents("tr").remove();

		if ($(".layui-table tbody tr").length == 0) {
			$(".layui-table tbody").html('<tr class="ns-empty-box"><td colspan="5"><div class="ns-empty">暂无数据</div></td></tr>');
		}
	}

	function back(){
		location.href = ns.url("admin/promotion/member");
	}
</script>

</body>
</html>