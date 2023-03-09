<?php /*a:2:{s:84:"/www/wwwroot/ls.chnssl.com/addon/platformcoupon/admin/view/platformcoupon/lists.html";i:1614519866;s:24:"app/admin/view/base.html";i:1661854360;}*/ ?>
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
	.layui-layer-page .layui-layer-content { padding: 20px 30px; }
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
			<li>点击添加优惠券按钮可以添加优惠券，点击详情按钮可以查看优惠券详情</li>
			<li>进行中的优惠券需先关闭才可进行删除操作</li>
			<li>点击删除按钮可以删除优惠券</li>
			<li>时间超过优惠券设置的结束时间或有效期限时，优惠券自动关闭</li>
			<li>手动关闭优惠券后，用户将不能领取该优惠券，但是已经领取的优惠券（未到期）仍然可以使用</li>
		</ul>
	</div>
</div>

<!-- 按钮容器 -->
<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="add()">添加优惠券</button>
</div>

<!-- 筛选面板 -->
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">优惠券名称：</label>
					<div class="layui-input-inline">
						<input type="text" name="platformcoupon_name" placeholder="请输入优惠券名称" autocomplete="off" class="layui-input">
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">有效期限：</label>
					<div class="layui-input-inline">
						<select name="validity_type" lay-filter="validity_type">
							<option value="">全部</option>
							<option value="1">固定时间</option>
							<option value="2">相对时间</option>
						</select>
					</div>
				</div>
				<div class="layui-inline relative-time layui-hide">
				    <div class="layui-input-inline ns-split">从发券</div>
					<div class="layui-input-inline">
						<input type="number" class="layui-input ns-len-short" lay-verify="int" id="start_day" placeholder="开始天数" autocomplete="off">
					</div>
					<div class="layui-input-inline ns-split">至</div>
					<div class="layui-input-inline end-time">
						<input type="number" class="layui-input ns-len-short" lay-verify="int" id="end_day" placeholder="结束天数" autocomplete="off">
					</div>
				</div>
				<div class="layui-inline fixed-time layui-hide">
					<div class="layui-input-inline">
						<input type="text" class="layui-input" id="start_date" placeholder="开始时间" autocomplete="off" readonly>
						<i class="ns-calendar"></i>
					</div>
					<div class="layui-input-inline ns-split">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" id="end_date" placeholder="结束时间" autocomplete="off" readonly>
						<i class="ns-calendar"></i>
					</div>
				</div>
				<input type="hidden" class="layui-input" name="start_time">
				<input type="hidden" class="layui-input" name="end_time">
			</div>
			
			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	</div>
</div>

<div class="layui-tab ns-table-tab"  lay-filter="platformcoupon_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="">全部</li>
		<li lay-id="1">进行中</li>
		<li lay-id="-1">已关闭</li>
	</ul>
	<div class="layui-tab-content">
		<table id="platformcoupon_list" lay-filter="platformcoupon_list"></table>
	</div>
</div>

<script type="text/html" id="validity">
	{{#  if(d.validity_type == 0){  }}
	失效期：{{ ns.time_to_date(d.end_time) }}
	{{#  }else{  }}
	领取后，{{ d.fixed_term }}天有效
	{{#  }  }}
</script>

<!-- 操作 -->
<script type="text/html" id="action">
    <div class="ns-table-btn">
		<a class="layui-btn" lay-event="receive">领取记录</a>
		<!-- 进行中 -->
		{{#  if(d.status == 1){ }}
		<a class="layui-btn" lay-event="edit">编辑</a>
		<a class="layui-btn" lay-event="detail">详情</a>
		<a class="layui-btn" lay-event="close">关闭</a>
		{{#  } }}
		<!-- 已结束 -->
		{{#  if(d.status == 2){ }}
		<a class="layui-btn" lay-event="detail">详情</a>
		<a class="layui-btn" lay-event="del">删除</a>
		{{#  } }}
		<!-- 已关闭 -->
		{{#  if(d.status == -1){ }}
		<a class="layui-btn" lay-event="detail">详情</a>
		<a class="layui-btn" lay-event="del">删除</a>
		{{#  } }}
	</div>
</script>

<script type="text/html" id="platformcouponDetail">
	<table class="layui-table">
		<colgroup>
			<col width="150">
			<col width="200">
		</colgroup>
		<tbody>
			<tr>
				<td>类型名</td>
				<td>{{d.platformcoupon_name}}</td>
			</tr>
			<tr>
				<td>优惠券面额</td>
				<td>{{d.money}}元</td>
			</tr>

			<tr>
				<td>使用场景</td>
				<td>{{d.money}}元</td>
			</tr>

			<tr>
				<td>发放数量</td>
				<td>{{d.count}}张</td>
			</tr>
			<tr>
				<td>最大领取数量</td>
				<td>{{d.max_fetch}}张</td>
			</tr>
			<tr>
				<td>满多少元可以使用</td>
				<td>{{d.at_least}}元</td>
			</tr>
			<tr>
				{{#  if(d.validity_type == 0){  }}
				<td>有效时间至</td>
				<td>{{ ns.time_to_date(d.end_time) }}</td>
				{{#  }else{  }}
				<td>有效时间</td>
				<td>{{ d.fixed_term }}天</td>
				{{#  }  }}
			</tr>
		</tbody>
	</table>
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
	layui.use(['form', 'laytpl','laydate', 'element'], function() {
		var table,
			form = layui.form,
			laytpl = layui.laytpl,
			element = layui.element,
			laydate = layui.laydate,
			validityType = 0,
			repeat_flag = false; //防重复标识
		form.render();

		//监听Tab切换，以改变地址hash值
		element.on('tab(platformcoupon_tab)', function(){
			table.reload({
                page: {curr: 1},
                where: {'status': this.getAttribute('lay-id')},
            })
		});

        table = new Table({
            elem: '#platformcoupon_list',
            url: ns.url("platformcoupon://admin/platformcoupon/lists"),
            cols: [
                [{
                    field: 'platformcoupon_name',
                    title: '优惠券名称',
                    unresize: 'false',
                    width: '15%'
                }, {
                    field: 'money',
                    title: '<span style="padding-right: 15px;">面额</span>',
                    unresize: 'false',
                    width: '15%',
					align: 'right',
					templet: function(data) {
						return '<span style="padding-right: 15px;">￥'+ data.money +'</span>';
					}
                }, {
                    field: 'count',
                    title: '发放数量',
                    unresize: 'false',
                    width: '10%'
                }, {
                    title: '领取上限',
                    unresize: 'false',
                    width: '10%',
					templet: function(data){
						return data.max_fetch + '张/人';
					}
                }, {
                    title: '有效期限',
                    unresize: 'false',
                    templet: '#validity',
                    width: '22%'
                }, {
                    field: 'status_name',
                    title: '状态',
                    unresize: 'false',
                    width: '8%'
                }, {
                    title: '操作',
                    toolbar: '#action',
                    unresize: 'false',
                    width: '20%'
                }]
            ],
        });
		
		/**
		 * 监听工具栏操作
		 */
		table.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case 'edit': //编辑
					location.href = ns.url("platformcoupon://admin/platformcoupon/edit", {"platformcoupon_type_id": data.platformcoupon_type_id});
					break;
				case 'del': //删除
					layer.confirm('确定要删除该优惠券吗?', function() {
						if (repeat_flag) return false;
						repeat_flag = true;
						
						$.ajax({
							url: ns.url("platformcoupon://admin/platformcoupon/delete"),
							data: data,
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
					break;
				case 'close': //关闭
					layer.confirm('确定要关闭吗?', function() {
						if (repeat_flag) return false;
						repeat_flag = true;
						
						$.ajax({
							url: ns.url("platformcoupon://admin/platformcoupon/close", {"platformcoupon_type_id": data.platformcoupon_type_id}),
							data: data,
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
					break;
				case 'detail': //详情
                    location.href = ns.url("platformcoupon://admin/platformcoupon/detail", {"platformcoupon_type_id": data.platformcoupon_type_id});
					break;
                case 'receive': //领取记录
                    location.href = ns.url("platformcoupon://admin/platformcoupon/receive", {"platformcoupon_type_id": data.platformcoupon_type_id});
			}
		});

		//详情
		function platformcouponDetail(data) {
			var detailHtml = $("#platformcouponDetail").html();
			laytpl(detailHtml).render(data, function(html) {
				layer.open({
					type: 1,
					title: '优惠券详情',
					area: ['500px'],
					content: html

				});
			})
		}

		// 搜索
		form.on('submit(search)', function(data) {
			if(validityType == 2){
				data.field.start_time = $("#start_day").val();
				data.field.end_time = $("#end_day").val();
			}
			
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
			return false;
		});
		
		form.on('select(validity_type)', function(data){
			switch (data.value) {
				case '':
					$(".relative-time").addClass("layui-hide");
					$(".fixed-time").addClass("layui-hide");
					break;
				case '1':
					laydate.render({
						elem: '#start_date', //指定元素
						type: 'datetime',
						done: function(value, date, endDate){
							$("input[name='start_time']").val(ns.date_to_time(value));
						}
					});
					laydate.render({
						elem: '#end_date', //指定元素
						type: 'datetime',
						done: function(value, date, endDate){
							$("input[name='end_time']").val(ns.date_to_time(value));
						}
					});
					$(".relative-time").addClass("layui-hide");
					$(".fixed-time").removeClass("layui-hide");
					break;
				case '2':
					validityType = 2;
					$(".relative-time").removeClass("layui-hide");
					$(".fixed-time").addClass("layui-hide");
					break;

			}
		});
		
		form.verify({
			int: function(value) {
				if (value < 0) {
					return '发券天数不能小于0！';
				}
			}
		})
	});
	
	function add() {
		location.href = ns.url("platformcoupon://admin/platformcoupon/add");
	}
</script>

</body>
</html>