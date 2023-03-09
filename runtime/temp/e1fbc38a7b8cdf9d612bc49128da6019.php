<?php /*a:2:{s:66:"/www/wwwroot/ls.chnssl.com/addon/notes/admin/view/group/lists.html";i:1614520490;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
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
				

<!-- 搜索框 -->
<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="addGroup()">添加笔记分组</button>
	<div class="layui-form">
		<div class="layui-input-inline">
			<input type="text" name="group_name" placeholder="请输入笔记分组名称" autocomplete="off" class="layui-input">
			<button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
				<i class="layui-icon">&#xe615;</i>
			</button>
		</div>
	</div>
</div>

<table id="attr_class_list" lay-filter="attr_class_list"></table>

<!-- 编辑排序 -->
<script type="text/html" id="editSort">
	<input name="sort" type="number" onchange="editSort({{d.group_id}}, this)" value="{{d.sort}}" class="layui-input edit-sort ns-len-short">
</script>

<!-- 操作 -->
<script type="text/html" id="operation">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="edit">编辑</a>
		<a class="layui-btn" lay-event="delete">删除</a>
	</div>
</script>

<script type="text/html" id="addGroup">

	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label mid"><span class="required">*</span>笔记分组：</label>
			<div class="layui-input-block">
				<input name="group_name" type="text" placeholder="请输入笔记分组名称" lay-verify="required" class="layui-input ns-len-mid">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label mid">排序：</label>
			<div class="layui-input-block">
				<input name="sort" type="number" class="layui-input edit-sort ns-len-short">
			</div>
		</div>

		<div class="ns-form-row mid">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="closeAttrLayer()">返回</button>
		</div>
	</div>

</script>

<script type="text/html" id="editGroup">

	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label mid"><span class="required">*</span>笔记分组：</label>
			<div class="layui-input-block">
				<input name="group_name" type="text" value="{{ d.group_name }}" placeholder="请输入笔记分组名称" lay-verify="required" class="layui-input ns-len-mid">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label mid">排序：</label>
			<div class="layui-input-block">
				<input name="sort" type="number" value="{{ d.sort }}" class="layui-input edit-sort ns-len-short">
			</div>
		</div>
		<input type="hidden" name="group_id" value="{{ d.group_id }}">
		<div class="ns-form-row mid">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="edit_save">保存</button>
			<button class="layui-btn layui-btn-primary" onclick="closeAttrLayer()">返回</button>
		</div>
	</div>

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
    var laytpl, add_attr_index = -1,
        form, table;
    layui.use(['form', 'laytpl'], function() {
        var repeat_flag = false; //防重复标识
        laytpl = layui.laytpl;
        form = layui.form;
        form.render();

        table = new Table({
            elem: '#attr_class_list',
            url: ns.url("notes://admin/group/lists"),
            cols: [
                [ {
                    field: 'group_name',
                    title: '分组名称',
                    unresize: 'false'
                },{
                    field: 'notes_num',
                    title: '店铺笔记总数',
                    unresize: 'false'
                },{
                    field: 'release_num',
                    title: '笔记发布数',
                    unresize: 'false'
                },{
                    unresize:'false',
                    title: '排序',
                    width: '20%',
                    align: 'center',
                    templet: '#editSort'
                },{
                    title: '操作',
                    width: '15%',
                    toolbar: '#operation',
                    unresize: 'false'
                }]
            ]
        });

        /**
         * 监听工具栏操作
         */
        table.tool(function(obj) {
            var data = obj.data;
            switch (obj.event) {
                case 'edit':
                    editGroup(data);
                    break;
                case 'delete':
                    deleteGroup(data.group_id);
                    break;
            }
        });

        /**
         * 删除
         */
        function deleteGroup(group_id) {
            layer.confirm('确认删除该分组吗？', function() {
                $.ajax({
                    url: ns.url("notes://admin/group/delete"),
                    data: {
                        group_id:group_id
                    },
                    dataType: 'JSON',
                    type: 'POST',
                    success: function(res) {
                        layer.msg(res.message);
                        if (res.code == 0) {
                            table.reload();
                        }
                    }
                });
            });
        }

        /**
         * 搜索功能
         */
        form.on('submit(search)', function(data) {
            table.reload({
                page: {
                    curr: 1
                },
                where: data.field
            });
        });

        form.on('submit(save)', function(data) {

            if (repeat_flag) return false;
            repeat_flag = true;

            $.ajax({
                url: '<?php echo addon_url("notes://admin/group/add"); ?>',
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(data) {
                    layer.msg(data.message);
                    if (data.code == 0) {
                        table.reload();
                        layer.close(add_attr_index);
                    }
                    repeat_flag = false;
                }
            });
            return false;
        });

        form.on('submit(edit_save)', function(data) {

            if (repeat_flag) return false;
            repeat_flag = true;

            $.ajax({
                url: '<?php echo addon_url("notes://admin/group/edit"); ?>',
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(data) {
                    layer.msg(data.message);
                    if (data.code == 0) {
                        table.reload();
                        layer.close(add_attr_index);
                    }
                    repeat_flag = false;
                }
            });
            return false;
        });

        /**
         * 表单验证
         */
        form.verify({
            num: function(value) {
                if (value == '') {
                    return;
                }
                if (value % 1 != 0) {
                    return '排序数值必须为整数';
                }
                if (value < 0) {
                    return '排序数值必须为大于0';
                }
            }
        });
    });

    function addGroup() {
        var add_attr = $("#addGroup").html();
        laytpl(add_attr).render({}, function(html) {
            add_attr_index = layer.open({
                title: '添加笔记分组',
                skin: 'layer-tips-class',
                type: 1,
                area: ['500px'],
                content: html
            });
        });

    }

    function editGroup(data) {
        var add_attr = $("#editGroup").html();
        laytpl(add_attr).render(data, function(html) {
            add_attr_index = layer.open({
                title: '编辑笔记分组',
                skin: 'layer-tips-class',
                type: 1,
                area: ['500px'],
                content: html
            });
        });

    }

    function closeAttrLayer() {
        layer.close(add_attr_index);
    }

    // 监听单元格编辑
    function editSort(group_id, event){
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
            url: ns.url("notes://admin/group/modifySort"),
            data: {
                sort: data,
                group_id: group_id
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