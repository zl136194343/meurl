<?php /*a:2:{s:74:"/www/wwwroot/www.hunqin.com/app/admin/view/membercluster/cluster_list.html";i:1614518650;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"婚业汇联管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'婚业汇联管理系统')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/admin/view/public/img/"
		};

	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/member_cluster.css" />

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://xyhl.chnssl.com/app/admin/view/public/img/logo.png">-->
	</div>
	<span>婚业汇联管理系统</span>
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
						<img src="https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
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
				
<div class="layui-collapse ns-tips" >
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">操作提示</h2>
        <ul class="layui-colla-content layui-show">
            <li>点击批量处理，可以针对符合条件的会员群体进行批量操作，比如：发放优惠券，调整积分，余额等</li>
        </ul>
    </div>
</div>

<!-- 添加会员群体 -->
<div class="ns-single-filter-box">
    <button type="button" class="layui-btn ns-bg-color" onclick="window.location.href='<?php echo addon_url("admin/membercluster/addCluster"); ?>'">添加群体</button>
</div>

<div class="ns-screen layui-collapse" lay-filter="selection_panel">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title"></h2>
        <form class="layui-colla-content layui-form layui-show">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">群体名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="cluster_name" placeholder="群体名称" autocomplete="off" class="layui-input ">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">更新时间</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="start_date" id="start_date" placeholder="请输入开始时间" autocomplete="off" readonly>
                    </div>
                    <div class="layui-input-inline ns-split">-</div>
                    <div class="layui-input-inline end-time">
                        <input type="text" class="layui-input" name="end_date" id="end_date" placeholder="请输入结束时间" autocomplete="off" readonly>
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

<table id="cluster_list" lay-filter="cluster_list"></table>

<!-- 工具栏操作 -->
<script type="text/html" id="operation">
    <div class="ns-table-btn">
        <a class="layui-btn" lay-event="member">查看会员</a>
        <a class="layui-btn" lay-event="info">编辑</a>
        <a class="layui-btn" lay-event="delete">删除</a>
        <a class="layui-btn" lay-event="more">批量处理</a>
        <div class="more-operation">
            <a class="operation" lay-event="recive_coupon">发放优惠券</a>
            <a class="operation" lay-event="adjust_balance">调整余额</a>
            <a class="operation" lay-event="adjust_integral">调整积分</a>
            <a class="operation" lay-event="export_cluster_member">导出</a>
        </div>
    </div>
</script>

<!-- 积分弹框html -->
<script type="text/html" id="point">
    <div class="layui-form integral-bounced">

        <div class="layui-form-item">
            <label class="layui-form-label">调整数额：</label>
            <div class="layui-input-block amount">
                <input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
            </div>
            <span class="ns-word-aux">调整数额与当前积分数相加不能小于0</span>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备注：</label>
            <div class="layui-input-block ns-len-long">
                <textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
            </div>
        </div>

        <div class="ns-form-row">
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="savePoint">确定</button>
        </div>

        <input type="hidden" name="cluster_id" value="{{d.cluster_id}}" />
    </div>
</script>

<!-- 余额弹框html -->
<script type="text/html" id="balance">
    <div class="layui-form">

        <div class="layui-form-item">
            <label class="layui-form-label">调整数额（不可提现）：</label>
            <div class="layui-input-block">
                <input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
            </div>
            <span class="ns-word-aux">调整数额与当前不可提现余额相加不能小于0</span>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备注：</label>
            <div class="layui-input-block ns-len-long">
                <textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
            </div>
        </div>

        <div class="ns-form-row">
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="saveBalance">确定</button>
        </div>

        <input type="hidden" name="cluster_id" value="{{d.cluster_id}}" />
    </div>
</script>

			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
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


<script type='text/javascript' src='https://xyhl.chnssl.com/app/admin/view/public/js/member_cluster.js'></script>
<script type="text/javascript">
    var table, form, laytpl, laydate,
        repeat_flag = false,
        currentDate = new Date(),
        minDate = "";

    layui.use(['form', 'laytpl', 'laydate'], function() {
        form = layui.form;
        laytpl = layui.laytpl;
        laydate = layui.laydate;
        currentDate.setDate(currentDate.getDate() - 7);
        form.render();

        //注册开始时间
        laydate.render({
            elem: '#start_date',
            type: 'datetime'
        });

        //注册结束时间
        laydate.render({
            elem: '#end_date',
            type: 'datetime'
        });

        /**
         * 重新渲染结束时间
         * */
        function reRender() {
            $("#reg_end_date").remove();
            $(".end-time").html('<input type="text" class="layui-input" name="reg_end_date" id="reg_end_date" placeholder="请输入结束时间">');
            laydate.render({
                elem: '#reg_end_date',
                min: minDate
            });
        }

        table = new Table({
            elem: '#cluster_list',
            url: ns.url("admin/membercluster/clusterList"),
            cols: [
                [
                    {
                    field: 'cluster_name',
                    title: '群体名称',
                    width: '25%',
                    unresize: 'false'
                }, {
                    field: 'member_num',
                    title: '人数',
                    width: '25%',
                    unresize: 'false',
                    templet: function (data) {
                        return "<a href='"+ns.url("admin/member/memberList?cluster_id=" + data.cluster_id)+"'>"+"<span class='ns-text-color'>"+data.member_num+"</span>"+"</a>";
                    }
                }, {
                    field: 'update_time',
                    title: '更新时间',
                    width: '25%',
                    unresize: 'false',
                    templet: function (data) {
                        return ns.time_to_date(data.update_time);
                    }
                }, {
                    title: '操作',
                    width: '25%',
                    unresize: 'false',
                    toolbar: '#operation'
                }
                ]
            ],
        });

        /**
         * 监听工具栏操作
         */
        table.tool(function(obj) {
            var data = obj.data;
            switch (obj.event) {
                case 'info': //编辑
                    location.href = ns.url("admin/membercluster/editCluster?cluster_id=" + data.cluster_id);
                    break;
                case 'delete': //删除
                    delCluster(data.cluster_id);
                    break;
                case 'adjust_balance': //调整余额
                    adjustBalance(data);
                    break;
                case 'adjust_integral': //调整积分
                    adjustIntegral(data);
                    break;
                case 'more': //更多
                    $('.more-operation').css('display', 'none');
                    $(obj.tr).find('.more-operation').css('display', 'block');
                    break;
                case 'recive_coupon': //发放优惠券
                    selectCoupon(data);
                    break;
                case 'export_cluster_member': //导出相应会员
                    exportClusterMember(data.cluster_id);
                    break;
                case 'member': //查看会员
                    window.open(ns.url("admin/member/memberList?cluster_id=" + data.cluster_id));
                    break;
            }
        });

        $(document).click(function(event) {
            if ($(event.target).attr('lay-event') != 'more' && $('.more-operation').not(':hidden').length) {
                $('.more-operation').css('display', 'none');
            }
        });

        /**
         * 删除
         */
        function delCluster(cluster_ids) {

            if (repeat_flag) return false;
            repeat_flag = true;

            layer.confirm('确认删除会员群体？', function() {
                $.ajax({
                    url: ns.url("admin/membercluster/deleteCluster"),
                    data: {cluster_ids:cluster_ids},
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

        // 调整余额
        function adjustBalance(e){
            laytpl($("#balance").html()).render(e, function(html) {
                layer.open({
                    title: '调整余额（不可提现）',
                    skin: 'layer-tips-class',
                    type: 1,
                    area: ['800px'],
                    content: html
                });
            });
        }

        //调整积分
        function adjustIntegral(e){
            laytpl($("#point").html()).render(e, function(html) {
                layer.open({
                    title: '调整积分',
                    skin: 'layer-tips-class',
                    type: 1,
                    area: ['800px'],
                    content: html
                });
            });
        }
        var repeat_flag_point = false;
        form.on('submit(savePoint)', function(data) {
            if (repeat_flag_point) return false;
            repeat_flag_point = true;

            if (data.field.adjust_num == 0) {
                layer.msg('调整数值不能为0');
                repeat_flag_point = false;
                return ;
            }
            if (data.field.adjust_num < 0) {
                layer.msg('积分不可以为负数');
                repeat_flag_point = false;
                return ;
            }
            $.ajax({
                type: "POST",
                url: ns.url("admin/membercluster/sendPoint"),
                data: data.field,
                dataType: 'JSON',
                success: function(res) {
                    layer.msg(res.message);
                    repeat_flag_point = false;

                    if (res.code == 0) {
                        layer.closeAll('page');
                        table.reload();
                    }
                }
            });
        });

        var repeat_flag_balance = false;
        form.on('submit(saveBalance)', function(data) {
            if (repeat_flag_balance) return false;
            repeat_flag_balance = true;

            if (data.field.adjust_num == 0) {
                layer.msg('调整数值不能为0');
                repeat_flag_balance = false;
                return ;
            }
            if (data.field.adjust_num < 0) {
                layer.msg('当前余额（不可提现）不可以为负数');
                repeat_flag_balance = false;
                return ;
            }
            $.ajax({
                type: "POST",
                url: ns.url("admin/membercluster/sendBalance"),
                data: data.field,
                dataType: 'JSON',
                success: function(res) {
                    layer.msg(res.message);
                    repeat_flag_balance = false;

                    if (res.code == 0) {
                        layer.closeAll('page');
                        table.reload();
                    }
                }
            });
        });

        /**
         * 导出群体内会员信息
         */
        function exportClusterMember(cluster_id) {
            location.href = ns.url("admin/membercluster/exportClusterMember",{"cluster_id":cluster_id});
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
            return false;
        });

        $(".search-form").click(function() {
            $(".layui-form-search").show();
            $(this).hide();
        });

        $(".form-hide-btn").click(function() {
            $(".layui-form-search").hide();
            $(".search-form").show();
        });

        /**
         * 发放优惠券
         */
        function selectCoupon(data) {
            laytpl($("#recive_coupon").html()).render(data, function(html) {
                layer_coupon = layer.open({
                    title: '选择优惠券',
                    skin: 'layer-tips-class',
                    type: 1,
                    area: ['700px', '542px'],
                    content: html,
                });
                renderCoupon("", data.member_id);
            });
        }
    });
</script>

<!-- 发放优惠券弹框 -->
<script type="text/html" id="recive_coupon">
    <div class="recive-coupon">
        <div class="coupon-modal">
            <div class="coupon-list all-coupon">
                <div class="title ns-bg-color-gray">可选优惠券</div>
                <div class="box"></div>
            </div>
            <button class="add">添加</button>
            <div class="coupon-list selected-coupon">
                <div class="title ns-bg-color-gray">已选优惠券</div>
                <div class="box"></div>
            </div>
        </div>
        <div class="modal-operation">
            <button class="layui-btn ns-bg-color save-btn" data_id="{{d.cluster_id}}">确定</button>
            <button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
        </div>
    </div>
</script>

</body>
</html>