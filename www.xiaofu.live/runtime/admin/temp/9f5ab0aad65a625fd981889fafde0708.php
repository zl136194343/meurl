<?php /*a:2:{s:92:"/www/wwwroot/www.xiaofu.live/www.xiaofu.live/app/admin/view/dtgl/memberlabel/label_list.html";i:1671503234;s:69:"/www/wwwroot/www.xiaofu.live/www.xiaofu.live/app/admin/view/base.html";i:1673488049;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"小福名片管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'小福名片管理系统')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://www.xiaofu.live/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://www.xiaofu.live/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://www.xiaofu.live/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://www.xiaofu.live/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://www.xiaofu.live/app/admin/view/public/css/common.css" />
	<script src="https://www.xiaofu.live/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://www.xiaofu.live/public/static/js/jquery.cookie.js"></script>
	<script src="https://www.xiaofu.live/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://www.xiaofu.live/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://www.xiaofu.live/app/admin/view/public/img/"
		};

	</script>
	<script src="https://www.xiaofu.live/public/static/js/common.js"></script>
	<script src="https://www.xiaofu.live/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://www.xiaofu.live/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	<div class="logo-box">
		<!--<img src="https://www.xiaofu.live/app/admin/view/public/img/logo.png">-->
	</div>
	<span>小福名片管理系统</span>
	<!--<span>服务电话：400-886-7993</span>-->
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
						<img src="https://www.xiaofu.live/app/admin/view/public/img/default_headimg.png" alt="">
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
			<li>会员标签是平台为了更加有效的对会员进行管理和分组。</li>
			<li>用户可以针对会员设置相应的标签，方便查找和管理。</li>
		</ul>
	</div>
</div>
<!-- 搜索框 -->
<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="window.location.href='<?php echo addon_url("admin/card/addLabel"); ?>'">添加标签</button>

	<div class="layui-form">
		<div class="layui-input-inline">
			<input type="text" id="search_text" name="search_text" placeholder="请输入标签名称" autocomplete="off" class="layui-input">
			<button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
			  <i class="layui-icon">&#xe615;</i>
			</button>
		</div>
	</div>
</div>

<!-- 会员标签列表 -->
<table id="label_info" lay-filter="label_info" ></table>

<script type="text/html" id="label_id">
	{{#  layui.each(res.data, function(index, item){ }}
	<input type="checkbox" name="label_id" value="{{item.label_id}}"  />
	{{#  }); }}
</script>

<script type="text/html" id="action">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="edit">编辑</a>
		<a class="layui-btn" lay-event="delete">删除</a>
	</div>
</script>

<!-- 批量删除 -->
<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="del">批量删除</button>
</script>
<!-- 批量删除 -->
<script type="text/html" id="batchOperation">
	<button class="layui-btn layui-btn-primary" lay-event="del">批量删除</button>
</script>

<!-- 编辑排序 -->
<script type="text/html" id="editSort">
	<input name="sort" type="number" onchange="editSort({{d.label_id}}, this)" value="{{d.sort}}" class="layui-input edit-sort ns-sort-len">
</script>

			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://www.xiaofu.live/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
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
	var form, table;
	layui.use(['form'], function() {
		form = layui.form;
		var repeat_flag = false;

		table = new Table({
			elem: '#label_info',
			url: ns.url("admin/card/biaoqian"),
			cols: [
				[
					{
						width: "3%",
						type: 'checkbox',
						templet: '#label_id',
						unresize:'false'
						
					}, {
						field: 'label_name',
						title: '标签名称',
						width: '17%',
						unresize:'false'
					}, {
						unresize:'false', 
						field: 'remark',
						title: '备注',
						width: '30%',
					}, {
						unresize:'false',
						field: 'modify_time',
						title: '创建时间',
						width: '20%',
						templet: function (data) {
							return ns.time_to_date(data.create_time); //创建时间转换方法
						}
					}, {
						unresize:'false',
						title: '排序',
						width: '10%',
						align: 'center',
						templet: '#editSort'
					}, {
						unresize:'false',
						title: '操作',
						width: '20%',
						toolbar: '#action'
					}
				]
			],
			toolbar: "#toolbarOperation",
			bottomToolbar: "#batchOperation"
		});
		
		/**
		* 监听工具栏操作
		*/
		table.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case 'edit': //编辑
					location.href = ns.url("admin/card/editLabel?label_id="+data.label_id)
					break;
				case 'delete': //删除
					deleteLabel(data.label_id);
					break;
			}
		});

		/**
		* 删除
		*/
		function deleteLabel(label_ids) {
			if (repeat_flag) return false;
			repeat_flag = true;
			
			layer.confirm('确定要删除该标签吗?', function() {
				$.ajax({
					url: ns.url("admin/card/deleteLabel"),
					data: {label_ids: label_ids},
					dataType: 'JSON',
					type: 'POST',
					success: function(res) {
						layer.msg(res.message);
						repeat_flag = false;

						if (res.code == 0) {
							table.reload();
						}
					}
				});
			}, function () {
				layer.close();
				repeat_flag = false;
			});
		}
		
		/**
		* 批量操作
		*/
		table.toolbar(function(obj) {

			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			switch (obj.event) {
				case "del":
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].label_id);
					deleteLabel(id_array.toString());
					break;
			}
		});
		table.bottomToolbar(function(obj) {
		
			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			switch (obj.event) {
				case "del":
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].label_id);
					deleteLabel(id_array.toString());
					break;
			}
		});

		// 搜索
		form.on('submit(search)', function(data){
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
		});
	});
	
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
	 		url: ns.url("admin/card/modifySort"),
	 		data: {
	 			sort: data,
	 			label_id: id
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