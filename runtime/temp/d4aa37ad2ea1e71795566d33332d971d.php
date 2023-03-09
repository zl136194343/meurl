<?php /*a:2:{s:70:"/www/wwwroot/ls.chnssl.com/addon/pintuan/admin/view/pintuan/lists.html";i:1614519886;s:24:"app/admin/view/base.html";i:1661854360;}*/ ?>
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
	.ns-screen{margin-bottom: 15px;}
	.contraction span {
		cursor: pointer;
		display: inline-block;
		width: 17px;
		height: 17px;
		text-align: center;
		line-height: 14px;
		user-select: none;
	}
	.sku-list {
		overflow: hidden;
		padding: 0 45px;
	}
	.sku-list li .img-wrap {
		vertical-align: middle;
		margin-right: 8px;
		width: 120px;
		height: 120px;
		text-align: center;
		line-height: 120px;
	}
	.sku-list li .img-wrap img {
		max-width: 100%;
		max-height: 100%;
	}
	.sku-list li .info-wrap span.sku-name {
		-webkit-line-clamp: 2;
		margin-bottom: 5px;
	}
	.sku-list li .info-wrap span {
		display: -webkit-box;
		margin-bottom: 5px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: normal;
		word-break: break-all;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 1;
	}
	.sku-list li {
		float: left;
		display: flex;
		padding: 10px;
		margin-right: 10px;
		margin-bottom: 10px;
		border: 1px solid #EFEFEF;
		width: 294px;
		height: 110px;
		align-items: center;
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
				


<!-- 搜索框 -->
<div class="ns-single-filter-box">

	<div class="layui-form">
		<div class="layui-input-inline">
			<input type="text" name="site_name" placeholder="请输入店铺名称" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-input-inline">
			<input type="text" name="start_time" id="start_time" placeholder="开始时间" class="layui-input" autocomplete="off" readonly>
			<i class="ns-calendar"></i>
		</div>
		<div class="layui-input-inline end-time">
			<input type="text" name="end_time" id="end_time" placeholder="结束时间" class="layui-input" autocomplete="off" readonly>
			<i class="ns-calendar"></i>
		</div>
		<div class="layui-input-inline">
			<input type="text" name="goods_name" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
			<button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
				<i class="layui-icon">&#xe615;</i>
			</button>
		</div>
	</div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="pintuan_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="">全部</li>
		<li lay-id="6">未开始</li>
		<li lay-id="1">进行中</li>
		<li lay-id="2">已结束</li>
		<li lay-id="3">已失效</li>
	</ul>
	<div class="layui-tab-content">
		<table id="pintuan_list" lay-filter="pintuan_list"></table>
	</div>
</div>

<!-- 商品 -->
<script type="text/html" id="goods">
	<div class="ns-table-title">

		<div class="contraction" data-id="{{d.pintuan_id}}" data-open="0">
			<span>+</span>
		</div>

		<div class="ns-title-pic">
			{{#  if(d.goods_image){  }}
			<img layer-src src="{{ns.img(d.goods_image.split(',')[0],'small')}}"/>
			{{#  }  }}
		</div>
		<div class="ns-title-content">
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color">{{d.goods_name}}</a>
		</div>
	</div>
</script>

<!-- 时间 -->
<script id="time" type="text/html">
	<div class="layui-elip">开始时间：{{ns.time_to_date(d.start_time)}}</div>
	<div class="layui-elip">结束时间：{{ns.time_to_date(d.end_time)}}</div>
</script>

<!-- 状态 -->
<script type="text/html" id="status">
	{{#  if(d.status == 0){  }}
	未开始
	{{#  }else if(d.status == 1){  }}
	进行中
	{{#  }else if(d.status == 2){  }}
	已结束
	{{#  }else if(d.status == 3){  }}
	已失效
	{{#  }  }}
</script>

<!-- 操作 -->
<script type="text/html" id="operation">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="check">查看</a>
		{{# if(d.status == 0){ }}
		<a class="layui-btn" lay-event="delete">删除</a>
		{{# }else if(d.status == 1){ }}
		<a class="layui-btn" lay-event="team">拼团列表</a>
		<a class="layui-btn" lay-event="invalid">结束</a>
		{{# }else if(d.status == 2){ }}
		<a class="layui-btn" lay-event="team">拼团列表</a>
		<a class="layui-btn" lay-event="delete">删除</a>
		{{# }else if(d.status == 3){ }}
		<a class="layui-btn" lay-event="delete">删除</a>
		{{# } }}
	</div>
</script>

<!-- 商品sku -->
<script type="text/html" id="skuList">
	<tr class="js-list-{{d.index}}" id="sku_img_{{d.index}}">
		<td colspan="9">
			<ul class="sku-list">
				{{# for(var i=0; i<d.list.length; i++){ }}
				<li>
					<div class="img-wrap">
						<img layer-src src="{{ns.img(d.list[i].sku_image)}}">
					</div>
					<div class="info-wrap">
						<span class="sku-name" title="{{d.list[i].sku_name}}">{{d.list[i].sku_name}}</span>
						<span class="price">商品价格：￥{{d.list[i].price}}</span>
						<span class="price">拼团价：￥{{d.list[i].pintuan_price}}</span>
					</div>
				</li>
				{{# } }}
			</ul>
		</td>
	</tr>
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
	$(function () {
		$("body").on("click", ".contraction", function () {

			var pintuan_id = $(this).attr("data-id");
			var open = $(this).attr("data-open");
			var tr = $(this).parent().parent().parent().parent();
			var index = tr.attr("data-index");
			if (open == 1) {
				$(this).children("span").text("+");
				$(".js-list-" + index).remove();
			} else {
				$(this).children("span").text("-");
				$.ajax({
					url: ns.url("pintuan://admin/pintuan/getSkuList"),
					data: {pintuan_id: pintuan_id},
					dataType: 'JSON',
					type: 'POST',
					async: false,
					success: function (res) {

						var sku_list = $("#skuList").html();
						var data = {
							list: res.data,
							index: index
						};
						laytpl(sku_list).render(data, function (html) {
							tr.after(html);
						});
						layer.photos({
							photos: '.img-wrap',
							anim: 5
						});
					}
				});
			}
			$(this).attr("data-open", (open == 0 ? 1 : 0));
		});
		layui.use(['form', 'element','laytpl', 'laydate'], function () {
			laytpl = layui.laytpl;
			var table,
					form = layui.form,
					laydate = layui.laydate,
					element = layui.element,
					repeat_flag = false; //防重复标识
			form.render();

			//开始时间
			laydate.render({
				elem: '#start_time' //指定元素
				, done: function (value, date, endDate) {
					start_time = ns.date_to_time(value);

				}
			});
			//结束时间
			laydate.render({
				elem: '#end_time' //指定元素
				, done: function (value, date, endDate) {
					end_time = ns.date_to_time(value);
				}
			});

			//监听Tab切换，以改变地址hash值
			element.on('tab(pintuan_tab)', function () {
				table.reload({
					page: {
						curr: 1
					},
					where: {
						'status': this.getAttribute('lay-id')
					}
				});
			});

			table = new Table({
				elem: '#pintuan_list',
				url: ns.url("pintuan://admin/pintuan/lists"),
				cols: [
					[{
						title: '拼团商品',
						unresize: 'false',
						width: '20%',
						templet: '#goods'
					}, {
						field:'site_name',
						title: '店铺名称',
						unresize: 'false',
						width: '8%'
					}, {
						title: '商品价格',
						unresize: 'false',
						width: '8%',
						templet: function (data) {
							return '￥' + data.price;
						}
					}, {
						field:'pintuan_price',
						title: '拼团价格',
						unresize: 'false',
						width: '7%',
						sort:true,
						templet: function (data) {
							return '￥' + data.pintuan_price;
						}
					}, {
						field: 'group_num',
						title: '开团组数',
						unresize: 'false',
						sort:true,
						width: '7%'
					}, {
						field: 'success_group_num',
						title: '成团组数',
						unresize: 'false',
						sort:true,
						width: '7%'
					}, {
						field: 'order_num',
						title: '购买人数',
						unresize: 'false',
						sort:true,
						width: '8%'
					}, {
						title: '活动时间',
						unresize: 'false',
						width: '15%',
						templet: '#time'
					}, {
						title: '状态',
						unresize: 'false',
						width: '6%',
						templet: '#status'
					}, {
						title: '操作',
						toolbar: '#operation',
						unresize: 'false',
						width: '12%'
					}]
				],

			});

			table.on("sort",function (obj) {
				table.reload({
					page: {
						curr: 1
					},
					where: {
						order:obj.field,
						sort:obj.type
					}
				});
			});

			/**
			 * 搜索功能
			 */
			form.on('submit(search)', function (data) {
				table.reload({
					page: {
						curr: 1
					},
					where: data.field
				});
			});

			/**
			 * 监听工具栏操作
			 */
			table.tool(function (obj) {
				var data = obj.data;
				switch (obj.event) {
					case 'edit': //编辑
						location.href = ns.url("pintuan://admin/pintuan/edit", {"pintuan_id": data.pintuan_id});
						break;
					case 'check': //查看
						location.href = ns.url("pintuan://admin/pintuan/detail", {"pintuan_id": data.pintuan_id});
						break;
					case 'team': //开团团队
						location.href = ns.url("pintuan://admin/pintuan/group", {"pintuan_id": data.pintuan_id});
						break;
					case 'delete': //删除
						deletePintuan(data.pintuan_id);
						break;
					case 'invalid': //使失效
						invalidPintuan(data.pintuan_id);
						break;
				}
			});

			/**
			 * 删除
			 */
			function deletePintuan(pintuan_id) {
				layer.confirm('确定要删除该拼团活动吗?', function () {
					if (repeat_flag) return;
					repeat_flag = true;

					$.ajax({
						url: ns.url("pintuan://admin/pintuan/delete"),
						data: {
							pintuan_id: pintuan_id
						},
						dataType: 'JSON',
						type: 'POST',
						success: function (res) {
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

			//使失效
			function invalidPintuan(pintuan_id) {

				layer.confirm('确定要结束拼团活动吗?', function () {
					if (repeat_flag) return;
					repeat_flag = true;

					$.ajax({
						url: ns.url("pintuan://admin/pintuan/invalid"),
						data: {
							pintuan_id: pintuan_id
						},
						dataType: 'JSON',
						type: 'POST',
						success: function (res) {
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
		});

	});
	function add() {
		location.href = ns.url("pintuan://admin/pintuan/add");
	}
</script>

</body>
</html>