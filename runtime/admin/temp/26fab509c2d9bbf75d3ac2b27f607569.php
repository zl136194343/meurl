<?php /*a:2:{s:56:"/www/wwwroot/ls.chnssl.com/app/admin/view/diy/lists.html";i:1614515898;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1660099950;}*/ ?>
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
	.layui-table-view td:last-child>div{overflow: inherit;}
	.operation-wrap{position: relative;}
	.layui-table-box{overflow: inherit;}
	.layui-table-body{overflow: inherit;}
	.set-home{display:inline-block;margin-left: 5px;padding: 3px;font-size: 12px;line-height: 1;color: #fff;}
	.popup-qrcode-wrap{text-align: center;background: #fff;border-radius: 2px;box-shadow: 0 2px 8px 0 rgba(200,201,204,.5);padding: 10px;position: absolute;z-index: 1;top: -73px;left: -180px;display: none;width: 170px;height: 230px;}
	.popup-qrcode-wrap:before, .popup-qrcode-wrap:after {left: 100%;top: 50%;border: solid transparent;content: " ";height: 0;width: 0;position: absolute;pointer-events: none;}
	.popup-qrcode-wrap:before {border-color: transparent;border-left-color: #e5e5e5;border-width: 8px;margin-top: -29px;}
	.popup-qrcode-wrap:after {border-color: transparent;border-left-color: #ffffff;border-width: 7px;margin-top: -31px;}
	.popup-qrcode-wrap img{width: 150px;height: 150px;max-width: initial;}
	.popup-qrcode-wrap p{font-size: 12px;margin: 5px 0;line-height: 1.8!important;}
	.popup-qrcode-wrap a{font-size: 12px;}
	.popup-qrcode-wrap input{opacity: 0;position: absolute;}
	.popup-qrcode-wrap .popup-qrcode-loadimg {width: 16px!important; height: 16px!important; margin-top: 107px;}
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
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>微页面是用户打开的具体内容页面，您可以完全实现自定义页面，不同模块组合及样式的自由编辑。</li>
			<li>好的页面可以吸引客户浏览的兴趣，快速找到自己想要买的商品，给客户带来良好的购物体验，最终实现高的转化率。</li>
			<li>创建不同活动页面，实现线上推广转化，提升网店的传播量。</li>
			<li>满足不同商家各种场景下页面的样式及推广诉求。</li>
		</ul>
	</div>
</div>

<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="location.href = ns.url('admin/diy/edit')">新建页面</button>
</div>

<table id="diy_list" lay-filter="diy_list"></table>

<script type="text/html" id="action">
	<div class="operation-wrap" data-id="{{d.id}}">
		<div class="ns-table-btn">
			<div class="popup-qrcode-wrap"><img class="popup-qrcode-loadimg" src="https://ls.chnssl.com/public/static/loading/loading.gif" /></div>
			{{# if(d.name != 'DIY_VIEW_INDEX'){ }}
			<a class="layui-btn" lay-event="setHome">设为主页</a>
			{{# } }}
			<a class="layui-btn" lay-event="promote">推广</a>
			<a class="layui-btn" lay-event="edit">编辑</a>
			<a class="layui-btn" lay-event="delete">删除</a>
		</div>
	</div>
</script>

<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="delete">批量删除</button>
</script>

<script type="text/html" id="batchOperation">
	<button class="layui-btn layui-btn-primary" lay-event="delete">批量删除</button>
</script>

<!-- 推广 -->
<script type="text/html" id="promote">
	{{# if(d.path.h5.status == 1){ }}
	<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
	<p class="qrcode-item-description">扫码后直接访问页面</p>
	<a class="ns-text-color" href="javascript:ns.copy('h5_url_{{ d.id }}');">复制链接</a>
	<a class="ns-text-color" href="{{ ns.img(d.path.h5.img) }}" download>下载二维码</a>
	<input class="layui-input nc-len-mid" type="text" value="{{ d.path.h5.url }}" id="h5_url_{{ d.id }}" readonly>
	{{# } }}
</script>

<!-- 编辑排序 -->
<script type="text/html" id="editSort">
	<input name="sort" type="number" onchange="editSort({{d.id}}, this)" value="{{d.sort}}" class="layui-input edit-sort ns-len-short">
</script>

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
	var laytpl;
	layui.use([ 'laytpl'], function () {
		laytpl = layui.laytpl;
	});
	var table = new Table({
		elem: '#diy_list',
		filter: "diy_list",
		url: ns.url("admin/diy/lists"),
		cols: [[{
			type: 'checkbox',
			unresize : 'true',
			width: '3%'
		}, {
			width: '42%',
			title: '名称',
			unresize : 'true',
			templet:function (res) {
				var html ='';
				html += `<span>${res.title}</span>`;
				if (res.name == 'DIY_VIEW_INDEX')
					html += `<span class="ns-bg-color set-home">主页</span>`;
				return html;
			}
		}, {
			width: '20%',
			title: '创建时间',
			unresize : 'true',
			templet: function (d) {
				return ns.time_to_date(d.create_time);
			}
		}, {
			field: 'click_num',
			width: '15%',
			title: '浏览量',
			unresize : 'true'
		},
		// 	{
		// 	field: 'sort',
		// 	width: '15%',
		// 	title: '排序',
		// 	align: 'center',
		// 	templet: '#editSort'
		// },
			{
			title: '操作',
			toolbar: '#action',
			width: '20%',
			unresize : 'true'
		}]],
		toolbar: '#toolbarOperation',
		bottomToolbar: "#batchOperation"
	});
	
	//监听工具条
	table.tool(function(obj) {
		var data = obj.data;
		if (obj.event === 'promote') {
			promote(data.id);
		} else if (obj.event === 'edit') {
			location.href = ns.url("admin/diy/edit", {
				id: data.id,
				name: data.name
			});
		} else if (obj.event == "delete") {
			layer.confirm('确定要删除该微页面模板吗', function (index) {
				$.ajax({
					type: "post",
					url: ns.url("admin/diy/deleteSiteDiyView"),
					data: {'id': data.id},
					dataType: "JSON",
					success: function (res) {
						layer.msg(res.message);
						if (res.code == 0) {
							table.reload();
						}
					}
				});
				layer.close(index);
			});
		} else if(obj.event == "setHome"){
			$.ajax({
				type: "post",
				url: ns.url("admin/diy/homePage"),
				data: {'id': data.id},
				dataType: "JSON",
				success: function (res) {
					layer.msg(res.message);
					if (res.code >= 0) {
						table.reload();
					}
				}
			});
		}
	});

	//批量操作
	table.toolbar(function(obj) {

		if(obj.data.length < 1){
			layer.msg('请选择要操作的数据');
			return;
		}

		switch (obj.event) {
			case "delete":
				layer.confirm('确定要删除该微页面模板吗', function (index) {
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].id);
					$.ajax({
						url: ns.url("admin/diy/deleteSiteDiyView"),
						data: {'id': id_array.toString()},
						dataType: "JSON",
						success: function (res) {
							layer.msg(res.message);
							if (res.code == 0) {
								table.reload();
							}
						}
					});
					layer.close(index);
				});
				break;
		}
	});

	//批量操作
	table.bottomToolbar(function(obj) {
		
		if(obj.data.length < 1){
			layer.msg('请选择要操作的数据');
			return;
		}
		
		switch (obj.event) {
			case "delete":
				layer.confirm('确定要删除微页面吗', function (index) {
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].id);
					$.ajax({
						url: ns.url("admin/diy/deleteSiteDiyView"),
						data: {'id': id_array.toString()},
						dataType: "JSON",
						success: function (res) {
							layer.msg(res.message);
							if (res.code == 0) {
								table.reload();
							}
						}
					});
					layer.close(index);
				});
				break;
		}
	});
	
	function promote(id) {
		$(".operation-wrap[data-id='" + id + "'] .popup-qrcode-wrap").show();
		$.ajax({
			type: "POST",
			url: ns.url("admin/diy/promote"),
			data: {
				'id': id,
			},
			dataType: 'JSON',
			success: function (res) {
				if(res.data.path.h5.status == 1) {
					res.data.id = id;
					laytpl($("#promote").html()).render(res.data, function (html) {
						$(".operation-wrap[data-id='" + id + "'] .popup-qrcode-wrap").html(html).show();
						
						$("body").click(function (e) {
							if (!$(e.target).closest(".popup-qrcode-wrap").length) {
								$(".operation-wrap[data-id='" + id + "'] .popup-qrcode-wrap").hide();
							}
						});
					});
				}else{
					layer.msg(res.data.path.h5.message);
				}
			}
		});
	}

	// 监听单元格编辑
	function editSort(id, event){
		var data = $(event).val();

		if (data == '') {
			$(event).val(0);
			data = 0;
		}

		if(!new RegExp("^-?[0-9]\\d*$").test(data)){
			layer.msg("排序号只能是整数");
			return ;
		}
		if(data<0){
			layer.msg("排序号必须大于0");
			return ;
		}
		$.ajax({
			type: 'POST',
			url: ns.url("admin/diy/modifySort"),
			data: {
				sort: data,
				id: id
			},
			dataType: 'JSON',
			success: function(res) {
				layer.msg(res.message);
				if(res.code==0){
					table.reload();
				}
			}
		});
	}
</script>

</body>
</html>