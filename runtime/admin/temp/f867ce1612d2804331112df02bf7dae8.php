<?php /*a:2:{s:68:"/www/wwwroot/www.hunqin.com/app/admin/view/memberwithdraw/lists.html";i:1614515920;s:24:"app/admin/view/base.html";i:1666314447;}*/ ?>
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
	
<style>
    .ns-card-common:first-of-type{margin-top: 0;}
    .layui-card-body{display: flex;padding-bottom: 0 !important;padding-right: 50px !important;padding-left: 50px !important;flex-wrap: wrap;}
    .layui-card-body .content{width: 33.3%;display: flex;flex-direction: column;margin-bottom: 30px;justify-content: center;}
    .layui-card-body .money{font-size: 20px;color: #000;font-weight: bold;margin-top: 10px;max-width: 250px;}
    .layui-card-body .subhead{font-size: 12px;margin-left: 3px;cursor: pointer;}
    .ns-single-filter-box {background-color: transparent;}
</style>

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
				

<div class="layui-card ns-card-common ns-card-brief">
    <div class="layui-card-header">
        <div>
            <span class="ns-card-title">提现概况</span>
        </div>
    </div>
    <div class="layui-card-body">

        <div class="content">
            <p class="title">会员可提现余额（元）</p>
            <p class="money"><?php echo htmlentities($member_balance_sum['balance_money']); ?></p>
        </div>
        <div class="content">
            <p class="title">会员已提现余额（元）</p>
            <p class="money"><?php echo htmlentities($member_balance_sum['balance_withdraw']); ?></p>
        </div>
        <div class="content">
            <div class="title ns-prompt-block">
                会员提现中余额（元）
                <div class="ns-prompt">
                    <i class="iconfont iconwenhao1"></i>
                    <div class="ns-prompt-box">
                        <div class="ns-prompt-con">会员提现中余额包含实际转账金额和手续费</div>
                    </div>
                </div>
            </div>
            <p class="money"><?php echo htmlentities($member_balance_sum['balance_withdraw_apply']); ?></p>
        </div>
    </div>
</div>

<!-- 搜索框 -->
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">筛选</h2>
        <form class="layui-colla-content layui-form layui-show">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">会员账号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="member_name" placeholder="会员用户名" autocomplete="off" class="layui-input ">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">提现方式</label>
                    <div class="layui-input-inline">
                        <select name="label_id">
                            <option value="">全部</option>
                            <?php foreach($transfer_type_list as $transfer_type_k=> $transfer_type_v): ?>
                            <option value="<?php echo htmlentities($transfer_type_k); ?>"><?php echo htmlentities($transfer_type_v); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
                        <select name="status">
                            <option value="all">全部</option>
                            <option value="0">待审核</option>
                            <option value="1">待转账</option>
                            <option value="2">已转账</option>
                            <option value="-1">已拒绝</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">申请时间</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="start_date" id="start_time" placeholder="请输入开始时间" autocomplete="off" readonly>
                    </div>
                    <div class="layui-input-inline ns-split">-</div>
                    <div class="layui-input-inline end-time">
                        <input type="text" class="layui-input" name="end_date" id="end_time" placeholder="请输入结束时间" autocomplete="off" readonly>
                    </div>
                </div>
            </div>
            <div class="ns-form-row">
                <button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
            </div>
        </form>
    </div>
</div>

<table id="withdraw_list" lay-filter="withdraw_list"></table>

<script type="text/html" id="status">
	{{# if(d.status == 0){ }}
	<div class="layui-elip" style="color: red">待审核</div>
	{{# }else if(d.status == 1){ }}
	<div class="layui-elip" style="color: blue">待转账</div>
	{{# }else if(d.status == 2){ }}
	<div class="layui-elip" style="color: green">已转账</div>
	{{# }else if(d.status == -1){ }}
	<div class="layui-elip" style="color: gray">已拒绝</div>
	{{# } }}
</script>

<!--操作-->
<script type="text/html" id="action">
    <div class="ns-table-btn">
        <a class="layui-btn" lay-event="detail">查看</a>
    {{#  if(d.status == 0){ }}
        <a href="javascript:;" class="layui-btn" lay-event="agree">同意</a>
        <a href="javascript:;" class="layui-btn" lay-event="refuse">拒绝</a>
    {{#  }else if(d.status == 1){ }}
        {{#  if(d.transfer_type != "bank"){ }}
            <?php if($is_exist): ?>
                <a href="javascript:;" class="layui-btn" lay-event="transfer">在线转账</a>
            <?php endif; ?>
        {{#  } }}
        <a href="javascript:;" class="layui-btn" lay-event="actiontransfer">手动转账</a>
    {{#  } }}
    </div>
</script>


<!-- 用户信息 -->
<script type="text/html" id="member_info">
    <div class='ns-table-tuwen-box'>
        <div class='ns-img-box'>
            <img layer-src src="{{ns.img(d.member_headimg)}}" onerror="this.src = 'https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png' ">
        </div>
        <div class='ns-font-box'>
            <p class="layui-elip">{{d.member_name}}</p>
        </div>
    </div>
</script>
<!--时间-->
<script type="text/html" id="apply_time">
    <div class="layui-elip">{{ns.time_to_date(d.apply_time)}}</div>
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


<script>
    var table, laytpl_index,certificate_upload;
    layui.use(['form', 'laydate','laytpl'], function() {
        var form = layui.form,
            laydate = layui.laydate,
            currentDate = new Date(),
            laytpl = layui.laytpl,
            minDate = "";
        form.render();

        currentDate.setDate(currentDate.getDate() - 7);

        //开始时间
        laydate.render({
            elem: '#start_time',
			type: 'datetime'
        });

        //结束时间
        laydate.render({
            elem: '#end_time',
			type: 'datetime'
        });

        /**
         * 重新渲染结束时间
         */
        function reRender(){
            $("#end_time").remove();
            $(".end-time").html('<input type="text" class="layui-input" placeholder="结束时间" name="end_date" id="end_time" >');
            laydate.render({
                elem: '#end_time',
                type: 'datetime',
                min: minDate
            });
        }

        /**
         * 表格加载
         */
        table = new Table({
            elem: '#withdraw_list',
            url: ns.url("admin/memberwithdraw/lists"),
            cols: [
                [{
					field: 'member_info',
					title: '会员信息',
                    width: '17%',
					unresize: 'false',
                    templet: '#member_info'
				}, {
					field: 'transfer_type_name',
					title: '提现方式',
					width: '10%',
					unresize: 'false',
				}, {
					field: 'apply_money',
					title: '申请提现金额',
					width: '10%',
					unresize: 'false',
					align: 'right',
					templet: function(data) {
						return '￥'+ data.apply_money
					}
				}, {
                    field: 'service_money',
                    title: '提现手续费',
					width: '10%',
                    unresize: 'false',
					align: 'right',
					templet: function(data) {
						return '￥'+ data.service_money
					}
                }, {
                    field: 'money',
                    title: '实际转账金额',
					width: '10%',
                    unresize: 'false',
					align: 'right',
					templet: function(data) {
						return '￥'+ data.money
					}
                }, {
                    field: 'status_name',
                    title: '提现状态',
                    width: '12%',
                    unresize: 'false',
					templet: '#status'
                },  {
					title: '申请时间',
					unresize: 'false',
					width: '15%',
					templet: '#apply_time'
				}, {
					title: '操作',
					width: '16%',
					toolbar: '#action',
					unresize: 'false'
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
            switch(obj.event){
                case 'detail':
                    detail(data);
                    break;
                case 'agree':
                    agree(data);
                    break;
                case 'refuse':
                    refuse(data);
                    break;
                <?php if($is_exist): ?>
                case 'transfer':
                    transfer(data);
                    break;
                <?php endif; ?>
                case 'actiontransfer':


                    laytpl($("#actiontransfer_html").html()).render(data, function(html) {
                        laytpl_index = layer.open({
                            title: '提现转账',
                            skin: 'layer-tips-class',
                            type: 1,
                            area: ['800px'],
                            content: html,
                        });
                    });
                    //转账凭证
					certificate_upload = new Upload({
						elem: '#certificate',
						url: ns.url("admin/upload/upload"),
					});
                    break;
            }
        });

        //提交
        form.on('submit(actiontransfer)', function(data) {
            actiontransfer(data.field);
            return false;
        });
    });

    /**
     * 查看详情
     */
    function detail(field) {
        location.href = ns.url("admin/memberwithdraw/detail",{id:field.id});

    }
    <?php if($is_exist): ?>
    /**
     * 自动转账
     */
    var transfer_repeat_flag = false;
    function transfer(field) {
		if(transfer_repeat_flag) return false;
		transfer_repeat_flag = true;
		
		layer.confirm('确定要进行自动转账吗?', function() {
			$.ajax({
				url: ns.url("memberwithdraw://admin/withdraw/transfer"),
				data: field,
				dataType: 'JSON', //服务器返回json格式数据
				type: 'POST', //HTTP请求类型
				success: function(res) {
                    transfer_repeat_flag = false;
				
					if (res.code >= 0) {
						table.reload({
							page: {
								curr: 1
							}
						});
                        location.reload();
					} else {

                        layer.closeAll();
						layer.msg(res.message);
					}
				}
			});
		}, function () {
			layer.closeAll();
            transfer_repeat_flag = false;
		});
    }
    <?php endif; ?>

    /**
     * 手动转账
     */
    var actiontransfer_repeat_flag = false;
    function actiontransfer(field) {
		if(actiontransfer_repeat_flag) return false;
		actiontransfer_repeat_flag = true;
		
		//删除图片
		if(!field.certificate) certificate_upload.delete();

        $.ajax({
            url: ns.url("admin/memberwithdraw/transferfinish"),
            data: field,
            dataType: 'JSON', //服务器返回json格式数据
            type: 'POST', //HTTP请求类型
            success: function(res) {
                actiontransfer_repeat_flag = false;
                if (res.code >= 0) {
                    table.reload({
                        page: {
                            curr: 1
                        }
                    });
                    location.reload();
                }else{
                    layer.msg(res.message);
                }
            }
        });

    }
    /**
     * 同意
     */
    var agree_repeat_flag = false;
    function agree(field) {
        if(agree_repeat_flag) return false;
        agree_repeat_flag = true;

		layer.confirm('确定要通过该转账申请吗?', function() {
			$.ajax({
			    url: ns.url("admin/memberwithdraw/agree"),
			    data: field,
			    dataType: 'JSON', //服务器返回json格式数据
			    type: 'POST', //HTTP请求类型
			    success: function(res) {
			        agree_repeat_flag = false;
					
			        if (res.code >= 0) {
			            table.reload({
			                page: {
			                    curr: 1
			                }
			            });

                        layer.closeAll();
			        } else {
                        layer.closeAll();
						layer.msg(res.message);
					}
			    }
			});
		}, function () {
			layer.closeAll();
			agree_repeat_flag = false;
		});
        
    }

    /**
     * 拒绝
     */
    var refuse_repeat_flag = false;
    function refuse(field) {

        layer.prompt({
			title: '拒绝理由', 
			formType: 2,
			yes: function(index, layero) {
				var value = layero.find(".layui-layer-input").val();
				
				if (value) {
					if(refuse_repeat_flag) return false;
					refuse_repeat_flag = true;

					field.refuse_reason = value;
					$.ajax({
						url: ns.url("admin/memberwithdraw/refuse"),
						data: field,
						dataType: 'JSON', //服务器返回json格式数据
						type: 'POST', //HTTP请求类型
						success: function(res) {
							layer.msg(res.message);
                            refuse_repeat_flag = false;
							
							if (res.code >= 0) {
								table.reload({
									page: {
										curr: 1
									},
								});
							}
						}
					});
					layer.close(index);
				} else {
					layer.msg('请输入拒绝理由!', {icon: 5, anim: 6});
				}
			}
        });
    }
	
	function closePass() {
		layer.close(laytpl_index);
	}
</script>

<!-- 在线转账html -->
<script type="text/html" id="actiontransfer_html">
    <div class="layui-form" lay-filter="form">
        <div class="layui-form-item">
            <label class="layui-form-label">真实姓名：</label>
            <div class="layui-input-block">
                <p class="ns-input-text ">{{ d.realname }}</p>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系电话：</label>
            <div class="layui-input-block">
                <p class="ns-input-text ">{{ d.mobile }}</p>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">提现类型：</label>
            <div class="layui-input-block">
                <p class="ns-input-text ">{{d.transfer_type_name}}</p>
            </div>
        </div>
        {{# if(d.transfer_type == "bank"){ }}

            <div class="layui-form-item">
                <label class="layui-form-label">账户名称：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text ">{{d.bank_name}}</p>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">银行账号：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text ">{{d.account_number}}</p>
                </div>
            </div>
        {{# }else if(d.transfer_type == "alipay"){ }}
            <div class="layui-form-item">
                <label class="layui-form-label">支付宝账号：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text ">{{d.account_number}}</p>
                </div>
            </div>
        {{# } }}
        <div class="layui-form-item">
            <label class="layui-form-label">申请提现金额：</label>
            <div class="layui-input-block">
                <p class="ns-input-text ">{{d.apply_money}}</p>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">提现手续费：</label>
            <div class="layui-input-block">
                <p class="ns-input-text ">{{d.service_money}}</p>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">提现金额：</label>
            <div class="layui-input-block">
                <p class="ns-input-text ">{{d.money}}</p>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label img-upload-lable">转账凭证：</label>
            <div class="layui-input-block img-upload">
				
                <div class="upload-img-block">
					<div class="upload-img-box">
						<div class="ns-upload-default" id="certificate">
							<div class="upload">
								<img src="https://xyhl.chnssl.com/app/admin/view/public/img/upload_img.png"/>
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
						<input type="hidden" name="certificate" value="">
					</div>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">转账凭证说明：</label>
            <div class="layui-input-block ns-len-long">
                <textarea name="certificate_remark" class="layui-textarea"></textarea>
            </div>
        </div>

        <input type="hidden" name="id" value="{{ d.id }}">
        <div class="ns-form-row">
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="actiontransfer">确定</button>
            <button class="layui-btn layui-btn-primary" onclick="closePass()">返回</button>
        </div>
    </div>
</script>

</body>
</html>