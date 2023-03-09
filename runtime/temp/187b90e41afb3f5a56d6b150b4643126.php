<?php /*a:2:{s:88:"/www/wwwroot/ls.chnssl.com/addon/community/shop/view/community_delivery/order/lists.html";i:1657527620;s:62:"/www/wwwroot/ls.chnssl.com/addon/community/shop/view/base.html";i:1657516832;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"小谷粒管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'小谷粒管理系统')); ?>">
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
    .layui-table-box {
        overflow: inherit;
    }
    .layui-table-body {
        overflow: inherit;
    }
    .layui-table-view td:last-child>div {
        overflow: inherit;
    }
    .ns-table-btn {
        position: relative;
    }
    .ns-table-btn .more-operation {
        display: none;
        font-size: 14px;
        line-height: 20px;
        background-color: #fff;
        box-shadow: 0 2px 8px 0 rgba(200, 201, 204, .5);
        position: absolute;
        z-index: 2000;
        border-radius: 2px;
        padding: 13px 12px;
        top: 40px;
        right: 55%;
        transform: translateX(10px);
    }
    .ns-table-btn .more-operation:before {
        right: 14px;
        top: -14px;
        border: solid transparent;
        content: "";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-color: transparent;
        border-bottom-color: #fff;
        border-width: 8px;
    }
    .ns-table-btn .more-operation .operation {
        display: block;
        text-align: right;
        margin-bottom: 12px;
        cursor: pointer;
    }
</style>

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://ls.chnssl.com/app/admin/view/public/img/logo.png">-->
	</div>
	<span>小谷粒管理系统</span>
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
				

<!-- 筛选面板 -->
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title"></h2>
        <form class="layui-colla-content layui-form layui-show" lay-filter="selection_panel_form">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">搜索方式：</label>
                    <div class="layui-input-inline">
                        <select name="select_field_type">
                            <?php foreach($field_list['select'] as $key => $val): ?>
                            <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="select_field_value" autocomplete="off" class="layui-input" placeholder="请按照搜索方式搜索"/>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">时间类型：</label>
                    <div class="layui-input-inline">
                        <select name="time_field_type">
                            <?php foreach($field_list['time'] as $key => $val): ?>
                            <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="text" name="start_date" placeholder="开始时间" class="layui-input choose-date" autocomplete="off">
                        <i class="ns-calendar"></i>
                    </div>
                    <div class="layui-form-mid">-</div>
                    <div class="layui-input-inline">
                        <input type="text" name="end_date" placeholder="结束时间" class="layui-input choose-date" autocomplete="off">
                        <i class="ns-calendar"></i>
                    </div>
                </div>
            </div>

            <input type="hidden" name="delivery_status">
            <div class="ns-form-row">
                <button type="button" class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <a class="layui-btn layui-btn-primary" href="<?php echo url('community://shop/communitydelivery/exportlist'); ?>" target="_blank">导出列表</a>
            </div>
        </form>
    </div>
</div>

<!-- 列表 -->
<div class="layui-tab ns-table-tab" lay-filter="page_tab">
    <ul class="layui-tab-title">
        <li class="layui-this" lay-id="">全部</li>
        <?php if(is_array($status_data) || $status_data instanceof \think\Collection || $status_data instanceof \think\Paginator): $i = 0; $__LIST__ = $status_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li lay-id="<?php echo htmlentities($vo['status']); ?>"><?php echo htmlentities($vo['name']); ?></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="layui-tab-content">
        <table id="page_list" lay-filter="page_list"></table>
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


<script src="https://ls.chnssl.com/app/shop/view/public/js/lodop_funcs.js"></script>

<script type="text/javascript">
    layui.use(['form', 'element', 'laydate'], function(form, element, laydate) {
        // 防重复标识
        var is_submit = false;

        var table = new Table({
            elem: '#page_list',
            url: ns.url('community://shop/communitydelivery/orderlist'),
            toolbar: (function () {
                var html = '';

                html += '<div class="tool-temp-btns">';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="batch_delivery">批量配送</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="delivery">一键配送</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="batch_complete">批量收货</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="complete">一键收货</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="export_goods_gather">导出商品出库单</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="export_leader_invoice">导出团长对货单</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="print_goods_gather">打印商品出库单</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="print_leader_invoice">打印团长对货单</button>';
                html += '</div>';

                return html;
            })(),
            cols: [
                [
                    {
                        width: '2%',
                        type: 'checkbox'
                    },
                    {
                        title: '配送单',
                        width: '12%',
                        templet: function (data) {
                            var html = '';

                            html += '<p style="color: '+ data.delivery_status_info.color +';">'+ data.delivery_status_info.name +'</p>';
                            html += '<p class="ns-multi-line-hiding" title="'+ data.delivery_no +'">'+ data.delivery_no +'</p>';

                            return html;
                        },
                    },
                    {
                        title: '团长',
                        width: '16%',
                        templet: function (data) {
                            var html = '',
                                default_img = 'https://ls.chnssl.com/app/shop/view/public/img/default_headimg.png';

                            html += '<div class="ns-table-title">';
                                html += '<div class="ns-title-pic">';
                                    html += '<img layer-src src="'+ (data.leader_community_img ? ns.img(data.leader_community_img) : default_img) +'" onerror="this.src = \'' + default_img + '\'">';
                                html += '</div>';
                                html += '<div class="ns-title-content">';
                                    html += '<p class="ns-multi-line-hiding" title="'+ data.leader_name +'">'+ data.leader_name +'</p>';
                                    html += '<p class="ns-multi-line-hiding" title="'+ data.leader_mobile +'">'+ data.leader_mobile +'</p>';
                                    html += '<div title="'+ (data.leader_full_address + data.leader_address) +'">';
                                        html += '<p class="ns-multi-line-hiding">'+ data.leader_full_address +'</p>';
                                        html += '<p class="ns-multi-line-hiding">'+ data.leader_address +'</p>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';

                            return html;
                        },
                    },
                    {
                        title: '自提点',
                        width: '10%',
                        templet: function (data) {
                            return '<p class="ns-multi-line-hiding" title="'+ data.leader_community +'">'+ data.leader_community +'</p>';
                        },
                    },
                    {
                        title: '路线名称',
                        width: '10%',
                        templet: function (data) {
                            return '<p class="ns-multi-line-hiding" title="'+ data.line_name +'">'+ data.line_name +'</p>';
                        },
                    },
                    {
                        title: '配送员',
                        width: '14%',
                        templet: function (data) {
                            var html = '',
                                default_img = 'https://ls.chnssl.com/app/shop/view/public/img/default_headimg.png';

                            html += '<div class="ns-table-title">';
                                html += '<div class="ns-title-pic">';
                                    html += '<img layer-src src="'+ (data.clerk_headimg ? ns.img(data.clerk_headimg) : default_img) +'" onerror="this.src = \'' + default_img + '\'">';
                                html += '</div>';
                                html += '<div class="ns-title-content">';
                                    html += '<p class="ns-multi-line-hiding" title="'+ data.clerk_name +'">'+ data.clerk_name +'</p>';
                                    html += '<p class="ns-multi-line-hiding" title="'+ data.clerk_mobile +'">'+ data.clerk_mobile +'</p>';
                                html += '</div>';
                            html += '</div>';

                            return html;
                        },
                    },
                    {
                        title: '时间',
                        width: '15%',
                        templet: function (data) {
                            var html = '';

                            html += '<p class="ns-multi-line-hiding">创建时间：'+ ns.time_to_date(data.create_time) +'</p>';
                            html += '<p class="ns-multi-line-hiding">预计自提：'+ ns.time_to_date(data.arrive_time) +'</p>';
                            if (data.delivery_time) {
                                html += '<p class="ns-multi-line-hiding">配送时间：'+ ns.time_to_date(data.delivery_time) +'</p>';
                            }
                            if (data.complete_time) {
                                html += '<p class="ns-multi-line-hiding">送达时间：'+ ns.time_to_date(data.complete_time) +'</p>';
                            }

                            return html;
                        },
                    },
                    {
                        title: '数量',
                        width: '10%',
                        templet: function (data) {
                            var html = '';

                            html += '<p class="ns-multi-line-hiding">订单数量：'+ data.order_num +'</p>';
                            html += '<p class="ns-multi-line-hiding">商品数量：'+ data.goods_num +'</p>';

                            return html;
                        },
                    },
                    {
                        title: '操作',
                        width: '10%',
                        templet: function (data) {
                            var html = '';

                            html += '<div class="ns-table-btn">';
                                html += '<a class="layui-btn" href="'+ ns.url('community://shop/communitydelivery/orderdetail', {delivery_id: data.delivery_id}) +'" target="_blank">详情</a>';
                                html += '<a class="layui-btn" lay-event="more">更多</a>';
                                html += '<div class="more-operation">';
                                    data.delivery_status_info.action.forEach(function (v) {
                                        html += '<a class="operation" lay-event="'+ v.action +'">'+ v.name +'</a>';
                                    });
                                    html += '<a class="operation" lay-event="export_goods_gather">导出商品出库单</a>';
                                    html += '<a class="operation" lay-event="export_leader_invoice">导出团长对货单</a>';
                                    html += '<a class="operation" lay-event="print_goods_gather">打印商品出库单</a>';
                                    html += '<a class="operation" lay-event="print_leader_invoice">打印团长对货单</a>';
                                html += '</div>';
                            html += '</div>';

                            return html;
                        },
                    }
                ]
            ],
            bottomToolbar: (function () {
                var html = '';

                html += '<div class="tool-temp-btns">';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="batch_delivery">批量配送</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="delivery">一键配送</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="batch_complete">批量收货</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="complete">一键收货</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="export_goods_gather">导出商品出库单</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="export_leader_invoice">导出团长对货单</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="print_goods_gather">打印商品出库单</button>';
                    html += '<button class="layui-btn layui-btn-primary" lay-event="print_leader_invoice">打印团长对货单</button>';
                html += '</div>';

                return html;
            })(),
        });

        // 渲染时间
        lay('.choose-date').each(function(){
            laydate.render({
                elem: this,
                trigger: 'click',
                type: 'datetime'
            });
        });

        // 监听Tab切换
        element.on('tab(page_tab)', function () {
            var delivery_status = $(this).attr('lay-id');

            $('input[type="hidden"][name="delivery_status"]').val(delivery_status)

            table.reload({
                page: {
                    curr: 1
                },
                where: {
                    delivery_status: delivery_status
                }
            });
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
         * 监听行工具操作
         */
        table.tool(function(obj) {
            var data = obj.data,
                delivery_id = data.delivery_id;

            switch (obj.event) {
                // 更多
                case 'more':
                    (function () {
                        var more_el = '.more-operation',
                            hide = function(event) {
                                if (event.target && $(event.target).attr('lay-event') !== 'more') {
                                    $(more_el).hide();
                                }
                            };

                        $(more_el).hide();
                        $(obj.tr).find(more_el).show();

                        $(document).off('click', hide).on('click', hide)
                    })();
                    break;
                // 更新
                case 'update':
                    layer.confirm('更新该配送单的基础信息, 确定要更新吗?', function(index) {
                        layer.close(index);
                        updateOrder(delivery_id);
                    });
                    break;
                // 开始配送
                case 'delivery':
                    layer.confirm('确定要配送吗?', function(index) {
                        layer.close(index);
                        orderDelivery(delivery_id);
                    });
                    break;
                // 确认收货
                case 'complete':
                    layer.confirm('确定要收货吗?', function(index) {
                        layer.close(index);
                        orderComplete(delivery_id);
                    });
                    break;
                // 删除
                case 'delete':
                    layer.confirm('确定要删除吗?', function(index) {
                        layer.close(index);
                        deleteOrder(delivery_id);
                    });
                    break;
                // 导出商品出库单
                case 'export_goods_gather':
                    exportOrder('goods_gather', {
                        select_field_type: 'delivery_no',
                        select_field_value: data.delivery_no,
                        delivery_id: delivery_id
                    });
                    break;
                // 导出团长对货单
                case 'export_leader_invoice':
                    exportOrder('leader_invoice', {
                        select_field_type: 'delivery_no',
                        select_field_value: data.delivery_no,
                        delivery_id: delivery_id
                    });
                    break;
                // 打印商品出库单
                case 'print_goods_gather':
                    printCommunityDeliveryOrder('goods_gather', delivery_id);
                    break;
                // 打印团长对货单
                case 'print_leader_invoice':
                    printCommunityDeliveryOrder('leader_invoice', delivery_id);
                    break;
            }
        });

        /**
         * 监听头部工具栏操作
         */
        table.toolbar(function (obj) {
            toolbar(obj)
        })

        /**
         * 监听底部工具栏操作
         */
        table.bottomToolbar(function (obj) {
            toolbar(obj)
        });

        /**
         * 工具栏操作
         */
        function toolbar(obj) {
            var data = obj.data,
                id_arr = [],
                error = function () {
                    if (data.length > 0) {
                        return false;
                    }

                    layer.msg('请选择要操作的数据');
                    return true;
                }

            for (i in data) id_arr.push(data[i].delivery_id);
            var ids = id_arr.toString();

            switch (obj.event) {
                // 一键更新
                case 'update':
                    layer.confirm('只针对【待配送】状态的配送单更新部分基础信息, 确定要更新吗?', function(index) {
                        layer.close(index);
                        updateOrder();
                    });
                    break;
                // 批量配送
                case 'batch_delivery':
                    if (!error()) {
                        layer.confirm('此操作会把<span class="ns-text-color">已选</span>【待配送】状态的配送单更新为【配送中】状态, 确定要批量配送吗?', function(index) {
                            layer.close(index);
                            orderDelivery(ids);
                        });
                    }
                    break;
                // 一键配送
                case 'delivery':
                    layer.confirm('此操作会把【待配送】状态的配送单<span class="ns-text-color">全部</span>更新为【配送中】状态, 确定要一键配送吗?', function(index) {
                        layer.close(index);
                        orderDelivery();
                    });
                    break;
                // 批量收货
                case 'batch_complete':
                    if (!error()) {
                        layer.confirm('此操作会把<span class="ns-text-color">已选</span>【配送中】状态的配送单更新为【已送达】状态, 确定要批量收货吗?', function(index) {
                            layer.close(index);
                            orderComplete(ids);
                        });
                    }
                    break;
                // 一键收货
                case 'complete':
                    layer.confirm('此操作会把【配送中】状态的配送单<span class="ns-text-color">全部</span>更新为【已送达】状态, 确定要一键收货吗?', function(index) {
                        layer.close(index);
                        orderComplete();
                    });
                    break;
                // 导出商品出库单
                case 'export_goods_gather':
                    exportOrder('goods_gather', form.val('selection_panel_form'));
                    break;
                // 导出团长对货单
                case 'export_leader_invoice':
                    exportOrder('leader_invoice', form.val('selection_panel_form'));
                    break;
                // 打印商品出库单
                case 'print_goods_gather':
                    if (!error()) {
                        id_arr.forEach(function (delivery_id) {
                            printCommunityDeliveryOrder('goods_gather', delivery_id, true);
                        })
                    }
                    break;
                // 打印团长对货单
                case 'print_leader_invoice':
                    if (!error()) {
                        id_arr.forEach(function (delivery_id) {
                            printCommunityDeliveryOrder('leader_invoice', delivery_id, true);
                        })
                    }
                    break;
            }
        }

        /**
         * 更新配送单
         * @param delivery_ids
         */
        function updateOrder(delivery_ids) {
            var layer_index;

            delivery_ids = delivery_ids ? String(delivery_ids) : '';

            if (is_submit) return false;
            is_submit = true;

            $.ajax({
                url: ns.url('community://shop/communitydelivery/updateOrder'),
                data: {delivery_ids : delivery_ids},
                dataType: 'JSON',
                type: 'POST',
                beforeSend : function(){
                    // 显示加载中提示
                    layer_index = layer.load();
                },
                complete : function () {
                    // 关闭加载中提示
                    layer.close(layer_index);
                },
                success: function (res) {
                    is_submit = false;
                    layer.msg(res.message);

                    if (res.code == 0) {
                        table.reload();
                    }
                },
                error: function () {
                    is_submit = false;
                    layer.msg('操作异常');
                }
            });
        }

        /**
         * 配送单配送
         * @param delivery_ids
         */
        function orderDelivery(delivery_ids) {
            var layer_index;

            delivery_ids = delivery_ids ? String(delivery_ids) : '';

            if (is_submit) return false;
            is_submit = true;

            $.ajax({
                url: ns.url('community://shop/communitydelivery/orderDelivery'),
                data: {delivery_ids : delivery_ids},
                dataType: 'JSON',
                type: 'POST',
                beforeSend : function(){
                    // 显示加载中提示
                    layer_index = layer.load();
                },
                complete : function () {
                    // 关闭加载中提示
                    layer.close(layer_index);
                },
                success: function (res) {
                    is_submit = false;
                    layer.msg(res.message);

                    if (res.code == 0) {
                        table.reload();
                    }
                },
                error: function () {
                    is_submit = false;
                    layer.msg('操作异常');
                }
            });
        }

        /**
         * 配送单收货
         * @param delivery_ids
         */
        function orderComplete(delivery_ids) {
            var layer_index;

            delivery_ids = delivery_ids ? String(delivery_ids) : '';

            if (is_submit) return false;
            is_submit = true;

            $.ajax({
                url: ns.url('community://shop/communitydelivery/orderComplete'),
                data: {delivery_ids : delivery_ids},
                dataType: 'JSON',
                type: 'POST',
                beforeSend : function(){
                    // 显示加载中提示
                    layer_index = layer.load();
                },
                complete : function () {
                    // 关闭加载中提示
                    layer.close(layer_index);
                },
                success: function (res) {
                    is_submit = false;
                    layer.msg(res.message);

                    if (res.code == 0) {
                        table.reload();
                    }
                },
                error: function () {
                    is_submit = false;
                    layer.msg('操作异常');
                }
            });
        }

        /**
         * 删除配送单
         * @param delivery_ids
         */
        function deleteOrder(delivery_ids) {
            var layer_index;

            delivery_ids = delivery_ids ? String(delivery_ids) : '';

            if (is_submit) return false;
            is_submit = true;

            $.ajax({
                url: ns.url('community://shop/communitydelivery/deleteOrder'),
                data: {delivery_ids : delivery_ids},
                dataType: 'JSON',
                type: 'POST',
                beforeSend : function(){
                    // 显示加载中提示
                    layer_index = layer.load();
                },
                complete : function () {
                    // 关闭加载中提示
                    layer.close(layer_index);
                },
                success: function (res) {
                    is_submit = false;
                    layer.msg(res.message);

                    if (res.code == 0) {
                        table.reload();
                    }
                },
                error: function () {
                    is_submit = false;
                    layer.msg('操作异常');
                }
            });
        }

        /**
         * 导出配送单
         * @param type
         * @param condition
         */
        function exportOrder(type, condition) {
            var layer_index;

            layer.prompt({
                formType: 3,
                title: '导出记录名称',
                maxlength: 30
            }, function(value, index, elem){
                var reg_en = /[`~!@#$%^&*()_+<>?:"{},.\/; '[\]]/im,
                    reg_cn = /[·！#￥（——）：；“”‘、，|《。》？、【】[\]]/im;

                if(reg_en.test(value) || reg_cn.test(value)) {
                    elem.focus();
                    layer.msg('名称不能包含特殊字符');
                    return;
                }

                var data = $.extend(($.isPlainObject(condition) ? condition : {}), {
                    export_type : type,
                    export_name: value
                });

                layer.close(index);

                if (is_submit) return false;
                is_submit = true;

                new Promise(function (resolve, reject) {

                    // 添加导出记录
                    $.ajax({
                        url: ns.url('community://shop/communitydelivery/addExport'),
                        data: data,
                        dataType: 'JSON',
                        type: 'POST',
                        beforeSend : function(){
                            // 显示加载中提示
                            layer_index = layer.load();
                        },
                        complete : function () {
                            // 关闭加载中提示
                            layer.close(layer_index);
                        },
                        success: function (res) {

                            layer.msg(res.message);

                            if (res.code == 0) {
                                resolve(res.data);
                            } else {
                                reject();
                            }
                        },
                        error: function () {
                            layer.msg('操作异常');
                            reject()
                        }
                    });
                }).then(function (res) {

                    // 执行导出
                    $.ajax({
                        url: ns.url('community://shop/communitydelivery/exportOrder'),
                        data: {export_id: res},
                        dataType: 'JSON',
                        type: 'POST',
                        success: function (res) {},
                    });

                    // 跳转导出页面
                    is_submit = false;
                    window.open(ns.url("shop/communitydelivery/exportList"));

                }).catch(function (reason) {
                    is_submit = false;
                })
            });
        }

        /**
         * 打印
         * @param type
         * @param delivery_id
         * @param is_batch
         */
        function printCommunityDeliveryOrder(type, delivery_id, is_batch) {
            var url = '',
                title = '';
            switch (type) {
                case 'goods_gather':
                    url = ns.url('community://shop/printer/communityDeliveryGoodsGather', {delivery_id: delivery_id});
                    title = '商品出库单';
                    break;
                case 'leader_invoice':
                    url = ns.url('community://shop/printer/communityDeliveryLeaderInvoice', {delivery_id: delivery_id});
                    title = '团长对货单';
                    break;
            }
            if (!delivery_id) {
                layer.msg('参数错误');
                return;
            }
            if (!url) {
                layer.msg('类型错误');
                return;
            }

            var LODOP = getLodop();
            LODOP.PRINT_INIT(title);
            LODOP.ADD_PRINT_TBURL(5,10,"770","95%",url);
            LODOP.SET_PRINT_STYLEA(0,"HOrient",3);
            LODOP.SET_PRINT_STYLEA(0,"VOrient",3);
            LODOP.ADD_PRINT_TEXT(590,680,130,22,"页号：第#页/共&页");
            LODOP.SET_PRINT_STYLEA(0,"ItemType",2);
            LODOP.SET_PRINT_STYLEA(0,"Horient",1);
            LODOP.SET_PRINT_STYLEA(0,"Vorient",1);
            LODOP.SET_SHOW_MODE("MESSAGE_GETING_URL",""); //该语句隐藏进度条或修改提示信息

            if (is_batch) {
                // 直接打印
                LODOP.PRINT();
            } else {
                // 预览
                LODOP.PREVIEW();
            }
        }
    });
</script>

</body>
</html>