<?php /*a:2:{s:66:"/www/wwwroot/ls.chnssl.com/addon/notes/admin/view/notes/lists.html";i:1614520490;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
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
	.ns-screen{margin-top: 15px;}
	.goods-type{display: flex;justify-content: space-between;}
	.goods-type .item-type{display: flex;flex-direction: column;align-items: center;padding: 20px;border: 1px solid #e5e5e5;border-radius: 5px;cursor: pointer;}
	.goods-type .item-type ~ .item-type{margin-left: 20px;}
	.goods-type .item-img{display: flex;justify-content: center;align-content: center;width: 260px;height: 350px;}
	.goods-type .item-img img{max-width: 100%;max-height: 100%;}
	.goods-type .item-content{margin-top: 15px;text-align: center;}
	.goods-type .item-content .description{margin-top: 10px;font-size: 12px;color: #999;line-height: 1.6;}
	.layui-layer-page .layui-layer-content{padding: 30px;}

	.ns-reason-box{display: none;width: 350px;box-sizing: border-box;padding: 20px;border: 1px solid #aaa;border-radius: 5px;background-color: #FFF;position: absolute;top: 50px;z-index: 999;color: #666;line-height: 30px;left: 0px;font-weight: normal;}
	.ns-reason-box:before, .ns-reason-box:after{content: "";border: solid transparent;height: 0;position: absolute;width: 0;}
	.ns-reason-box:before{border-width: 12px;border-bottom-color: #aaa;top: -12px;left: 43px;border-top: none;}
	.ns-reason-growth:before{left: 56px;}
	.ns-reason-box:after{border-width: 10px;border-bottom-color: #FFF;top: -20px;left: 45px;}
	.ns-reason-growth:after{left: 58px;}
	.ns-reason-box p{white-space: normal;line-height: 1.5;}
	.layui-table-header{overflow: inherit;}
	.layui-table-header .layui-table-cell{overflow: inherit;}
	.ns-prompt-block.balance, .ns-prompt-block.growth {justify-content: flex-end;}
	.layui-form-item .layui-form-checkbox[lay-skin=primary] {margin-top: 0;}
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
				

<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">筛选</h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">

				<div class="layui-inline">
					<label class="layui-form-label">笔记名称：</label>
					<div class="layui-input-inline">
						<input type="text" name="note_title" placeholder="请输入笔记名称" class="layui-input">
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label">商家名称：</label>
					<div class="layui-input-inline">
						<input type="text" name="site_name" placeholder="请输入商家名称" class="layui-input">
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label">笔记类型：</label>
					<div class="layui-input-inline">
						<select name="note_type" lay-filter="status">
							<option value="">全部</option>
							<?php foreach($note_type as $v): ?>
							<option value="<?php echo htmlentities($v['type']); ?>"><?php echo htmlentities($v['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

			</div>

			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">笔记分组：</label>
					<div class="layui-input-inline">
						<select name="group_id" lay-filter="status">
							<option value="">全部</option>
							<?php foreach($group_list as $v): ?>
							<option value="<?php echo htmlentities($v['group_id']); ?>"><?php echo htmlentities($v['group_name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">发布时间：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_time"  id="start_time" autocomplete="off" placeholder="开始时间" readonly>
						<i class="ns-calendar"></i>
					</div>
					<div class="layui-form-mid">-</div>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="end_time" id="end_time" autocomplete="off" placeholder="结束时间" readonly>
						<i class="ns-calendar"></i>
					</div>
				</div>
			</div>

			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	</div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="notes_tab">

	<div class="layui-tab-content">
		<table id="notes_list" lay-filter="notes_list"></table>
	</div>
</div>

<!-- 商品 -->
<script type="text/html" id="goods">
	<div class="ns-table-title">
		<div class="ns-title-pic">
			{{#  if(d.goods_image){  }}
			<img layer-src src="{{ns.img(d.goods_image.split(',')[0],'small')}}"/>
			{{#  }  }}
		</div>
		<div class="ns-title-content">
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.goods_name}}">{{d.goods_name}}</a>
		</div>
	</div>
</script>

<!-- 时间 -->
<script id="time" type="text/html">
	<div class="layui-elip">开始：{{ns.time_to_date(d.start_time)}}</div>
	<div class="layui-elip">结束：{{ns.time_to_date(d.end_time)}}</div>
</script>

<!-- 操作 -->
<script type="text/html" id="operation">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="edit">编辑</a>
		<a class="layui-btn" lay-event="del">删除</a>
	</div>
</script>

<!-- 排序 -->
<script type="text/html" id="editSort">
	<input name="sort" type="number" onchange="editSort({{d.note_id}},this)" value="{{d.sort}}" placeholder="请输入排序" class="layui-input edit-sort ns-len-short">
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
	var laytpl,table,form,laydate,repeat_flag;
	layui.use(['form', 'element','laydate','laytpl'], function() {
		form = layui.form;
		laytpl = layui.laytpl;
		laydate = layui.laydate;
		repeat_flag = false; //防重复标识

		form.render();

        //渲染时间
        laydate.render({
            elem: '#start_time',
            type: 'datetime'
        });

        laydate.render({
            elem: '#end_time',
            type: 'datetime'
        });

		table = new Table({
			elem: '#notes_list',
			url: ns.url("notes://admin/notes/lists"),
			where:{
				status:1
			},
			cols: [
				[{
			    	field:'note_title',
					title: '笔记标题',
					unresize: 'false',
					width: '23%'
				},{
					field:'site_name',
					title: '商家名称',
					unresize: 'false',
					width: '15%'
				}, {
					field: 'group_name',
					title: '所属分组',
					unresize: 'false'

				}, {
					field: 'read_num',
					title: '阅读次数',
					unresize: 'false'

				}, {
					field: 'dianzan_num',
					title: '点赞次数',
					unresize: 'false'
				}, {
			    	title: '发布时间',
                    unresize: 'false',
					templet:function(data){
						return ns.time_to_date(data.create_time);
					}
                }, {
					title: '操作',
					toolbar: '#operation',
					unresize: 'false',
					width: '12%'
				}]
			]

		});

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
            return false;
		});

		/**
		 * 监听工具栏操作
		 */
		table.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case 'edit': //编辑
					location.href = ns.url("notes://admin/notes/edit", {"note_id": data.note_id,"note_type": data.note_type});
					break;
				case 'del': //删除
					deleteNotes(data.note_id);
					break;
			}
		});

		/**
		 * 删除
		 */
		function deleteNotes(note_id) {
			layer.confirm('确定要删除该笔记吗?', function() {
				if (repeat_flag) return;
				repeat_flag = true;

				$.ajax({
					url: ns.url("notes://admin/notes/delete"),
					data: {
						note_id: note_id
					},
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
			}, function() {
				layer.close();
				repeat_flag = false;
			});
		}

	});

    // 监听单元格编辑
    function editSort(id, event) {
        var data = $(event).val();
        if (!new RegExp("^-?[1-9]\\d*$").test(data)) {
            layer.msg("排序号只能是整数");
            return;
        }
        if(data<0){
            layer.msg("排序号必须大于0");
            return ;
        }
        $.ajax({
            type: 'POST',
            url: ns.url("notes://admin/notes/modifySort"),
            data: {
                sort: data,
                note_id: id
            },
            dataType: 'JSON',
            success: function(res) {
                layer.msg(res.message);
                if (res.code == 0) {
                    table.reload();
                }
            }
        });
    }

	function add() {
        var html = $("#addNote").html();
        laytpl(html).render({}, function (html) {
            layer.open({
                type: 1,
                title: '选择笔记类型',
                area: ['700px'],
                content: html

            });
        });
	}

	$("body").on("mouseenter",".goods-type .item-type",function () {
		$(this).addClass("ns-border-color");
	});
	$("body").on("mouseleave",".goods-type .item-type",function () {
		$(this).removeClass("ns-border-color");
	});
</script>

</body>
</html>