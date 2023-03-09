<?php /*a:2:{s:71:"/www/wwwroot/ls.chnssl.com/addon/fenxiao/admin/view/withdraw/lists.html";i:1614520038;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
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
    .ns-card-brief:nth-child(1){
        margin-top: 0;
    }
    .layui-card-body{
        display: flex;
        flex-wrap: wrap;
        padding-bottom: 0 !important;
        padding-left: 50px !important;
        padding-right: 50px !important;
    }
    .layui-card-body .content{
        width: 33.3%;
        margin-bottom: 30px;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: center;
    }
    .layui-card-body .money{
        font-size: 20px;
        color: #000;
        font-weight: bold;
        margin-top: 10px;
        max-width: 250px;
    }
    .layui-card-body .subhead{
        font-size: 12px;
        margin-left: 3px;
        cursor: pointer;
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
				

<div class="ns-screen layui-collapse" lay-filter="selection_panel">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">筛选</h2>
        <form class="layui-colla-content layui-form layui-show">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">提现流水号：</label>
                    <div class="layui-input-inline">
                        <input type="text" id="withdraw_no" name="withdraw_no" placeholder="请输入提现流水号" class="layui-input">
                    </div>
                </div>
				
                <div class="layui-inline">
                    <label class="layui-form-label">分销商店铺名：</label>
                    <div class="layui-input-inline">
                        <input type="text" id="fenxiao_name" name="fenxiao_name" placeholder="请输入分销商店铺名" class="layui-input">
                    </div>
                </div>
				
                <div class="layui-inline">
                    <label class="layui-form-label">分销商等级：</label>
                    <div class="layui-input-inline">
                        <select name="level_id" lay-filter="status">
                            <option value="">全部</option>
                            <?php if(!empty($level)): foreach($level as $v): ?>
                            <option value="<?php echo htmlentities($v['level_id']); ?>"><?php echo htmlentities($v['level_name']); ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">申请时间：</label>

                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="start_time"  id="start_time" autocomplete="off" placeholder="开始时间" >
                    </div>
                    <div class="layui-form-mid">-</div>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="end_time" id="end_time" autocomplete="off" placeholder="结束时间" >
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

<div class="layui-tab ns-table-tab" lay-filter="status">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="">全部</li>
		<li lay-id="1">待审核</li>
		<li lay-id="2">已审核</li>
        <li lay-id="-1">无效</li>
	</ul>
	
	<div class="layui-tab-content">
		<table id="fenxiao_withdraw_list" lay-filter="fenxiao_withdraw_list"></table>
	</div>
</div>

<!--商家信息-->
<!--<script type="text/html" id="fenxiao_info">-->
    <!--<div class="layui-elip">分销商：{{d.fenxiao_name}}</div>-->
    <!--<div class="layui-elip">分销等级：{{d.level_name}}</div>-->
<!--</script>-->

<!--账户信息-->
<script type="text/html" id="account">
    {{# if(d.bank_type == 1){ }}
    <div class="layui-elip">账户类型：银行卡</div>
    <div class="layui-elip">账户名称：{{d.settlement_bank_name}}</div>
    <div class="layui-elip">提现账号：{{d.settlement_bank_account_number}}</div>
    <div class="layui-elip">开户名：{{d.settlement_bank_account_name}}</div>
    {{# }else{ }}
    <div class="layui-elip">账户类型：支付宝</div>
    <div class="layui-elip" title="支付宝账号：{{d.settlement_bank_account_number}}">
        支付宝账号：{{d.settlement_bank_account_number}}</div>
    <div class="layui-elip" title="支付宝用户名：{{d.settlement_bank_account_name}}">
        支付宝用户名：{{d.settlement_bank_account_name}}</div>
    {{# } }}

</script>

<!--时间-->
<script type="text/html" id="times">
    <div class="layui-elip" title="申请时间：{{ns.time_to_date(d.create_time)}}">
        申请时间：{{ns.time_to_date(d.create_time)}}</div>
    <div class="layui-elip" title="到账时间：{{ns.time_to_date(d.payment_time)}}">
        转账时间：{{ns.time_to_date(d.payment_time)}}</div>
</script>

<!--状态-->
<script type="text/html" id="status">
    {{# if(d.status == 1){ }}
    <div class="layui-elip" style="color: red">待审核</div>
    {{# }else if(d.status == 2){ }}
    <div class="layui-elip" style="color: green">已审核</div>
    {{# }else if(d.status == -1){ }}
    <span style="color: gray;">无效</span>
    {{# } }}
</script>

<!--操作-->
<script type="text/html" id="action">
    <div class="ns-table-btn">
        <a class="layui-btn" lay-event="detail">查看</a>
        {{# if(d.status == 1){ }}
        <a class="layui-btn" lay-event="apply_pass">通过</a>
        <a class="layui-btn" lay-event="apply_refuse">拒绝</a>
        {{# } }}
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
    layui.use(['form', 'laytpl', 'laydate', 'element'], function() {
        var table,
            form = layui.form,
            laydate = layui.laydate,
			element = layui.element,
            currentDate = new Date(),
            repeat_flag = false,
            laytpl = layui.laytpl;
        minDate = "";
        form.render();

        currentDate.setDate(currentDate.getDate() - 7);

        //申请开始时间
        laydate.render({
            elem: '#start_time',
            type: 'datetime'
        });

        //申请结束时间
        laydate.render({
            elem: '#end_time',
            type: 'datetime'
        });

        /**
         * 重新渲染结束时间
         */
        function reRender(){
            $("#end_time").remove();
            $(".end-time").html('<input type="text" class="layui-input" placeholder="申请结束时间" name="end_date" id="end_time" >');
            laydate.render({
                elem: '#end_time',
                type: 'datetime',
                min: minDate
            });
        }
		
		//监听Tab切换
		element.on('tab(status)', function(data) {
			var status = $(this).attr("lay-id");
			table.reload( {
				page: {
					curr: 1
				},
				where: {
					'status': status
				}
			});
		});
        
        /**
         * 表格加载
         */
        table = new Table({
            elem: '#fenxiao_withdraw_list',
            url: ns.url("fenxiao://admin/withdraw/lists"),
            cols: [
                [{
                    width: "3%",
                    type: 'checkbox',
                    unresize: 'false'
                },{
                    field: 'withdraw_no',
                    title: '提现流水编号',
                    unresize: 'false',
                    width:'15%'
                },{
                    field:'fenxiao_name',
                    title: '分销商',
                    unresize: 'false',
                    width:'15%',
                }, {
                    field: 'money',
                    title: '提现佣金',
                    unresize: 'false',
                    width:'10%',
					align: 'right',
					templet: function(data){
						return '￥'+ data.money;
					}
                }, {
                    field: 'withdraw_rate_money',
                    title: '提现手续费',
                    unresize: 'false',
                    width:'10%',
					align: 'right',
					templet: function(data){
						return '￥'+ data.withdraw_rate_money;
					}
                }, {
                    field: 'real_money',
                    title: '实际到账金额',
                    unresize: 'false',
                    width:'10%',
					align: 'right',
					templet: function(data){
						return '￥'+ data.real_money;
					}
                },{
                    field: 'status',
                    title: '状态',
                    unresize: 'false',
                    width:'10%',
                    templet: "#status"
                },{
                    title: '时间',
                    unresize: 'false',
                    width:'15%',
                    templet: "#times"
                }, {
                    title: '操作',
                    toolbar: '#action',
                    unresize: 'false',
                    width:'12%'
                }]
            ],
            toolbar: "#toolbarOperation",
            bottomToolbar: "#batchOperation"
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
            var data = obj.data,
                event = obj.event;

            switch (event){
                case 'detail': //查看
                    withdrawDetail(data);
                    break;
                case 'apply_pass': //通过
                    applyPass(data.id);
                    break;

                case 'apply_refuse'://拒绝

                    if (repeat_flag) return false;
                    repeat_flag = true;

                    layer.confirm('确定要拒绝申请吗?', function() {
                        $.ajax({
                            url: ns.url("fenxiao://admin/withdraw/withdrawrefuse"),
                            data: {'id':data.id},
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
                    break;
            }
        });

        /**
         * 批量操作
         */
        table.toolbar(function(obj) {

            if (obj.data.length < 1) {
                layer.msg('请选择要操作的数据');
                return;
            }

            switch (obj.event) {
                case "apply_pass":
                    var id_array = new Array();
                    for (i in obj.data) id_array.push(obj.data[i].id);
                    applyPass(id_array.toString());
                    break;
            }
        });
        table.bottomToolbar(function(obj) {

            if (obj.data.length < 1) {
                layer.msg('请选择要操作的数据');
                return;
            }

            switch (obj.event) {
                case "apply_pass":
                    var id_array = new Array();
                    for (i in obj.data) id_array.push(obj.data[i].id);
                    applyPass(id_array.toString());
                    break;
            }
        });

        /**
         * 通过
         */
        function applyPass(id) {
            if (repeat_flag) return false;
            repeat_flag = true;

            layer.confirm('确定要通过申请吗?', function() {
                $.ajax({
                    url: ns.url("fenxiao://admin/withdraw/withdrawpass"),
                    data: {'id':id},
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
         * 拒绝
         */
        function applyReject(id) {

            if (repeat_flag) return false;
            repeat_flag = true;

            layer.confirm('确定要拒绝申请吗?', function() {
                $.ajax({
                    url: ns.url("admin/shopaccount/applyreject"),
                    data: {'apply_id':id},
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

        //提交
        form.on('submit(repass)', function(data) {

            $.ajax({
                url: ns.url("admin/shopaccount/applypay"),
                data: data.field,
                dataType: 'JSON',
                type: 'POST',
                success: function(res) {
                    layer.msg(res.message);
                    repeat_flag = false;

                    if (res.code == 0) {
                        layer.closeAll("page");
                        table.reload();
                    }
                }
            });

        });

        /**
         * 备注
         */
        function memo(data) {
            laytpl($("#memo_content").html()).render(data, function(html) {
                layer_memo = layer.open({
                    title: '备注',
                    skin: 'layer-tips-class',
                    type: 1,
                    area: ['450px'],
                    content: html,
                });
            });
        }

        form.on('submit(submit_memo)', function(data) {
            if (repeat_flag) return false;
            repeat_flag = true;

            $.ajax({
                type: "POST",
                url: ns.url("admin/shopaccount/editshopwithdrawmemo"),
                data: data.field,
                dataType: 'JSON',
                success: function(res) {
                    layer.msg(res.message);
                    repeat_flag = false;

                    if (res.code == 0) {
                        layer.closeAll('page');
                        table.reload();
                    }
                }
            });
        });

        //详情
        function withdrawDetail(data) {
            var detailHtml = $("#withdrawDetail").html();
            laytpl(detailHtml).render(data, function(html) {
                layer.open({
                    type: 1,
                    title: '提现详情',
                    area: ['500px'],
                    content: html

                });
            })
        }
    });
</script>

<script type="text/html" id="toolbarOperation">
    <button class="layui-btn layui-btn-primary" lay-event="apply_pass">批量通过</button>
</script>
<script type="text/html" id="batchOperation">
    <button class="layui-btn layui-btn-primary" lay-event="apply_pass">批量通过</button>
    <!--<button class="layui-btn layui-btn-primary" lay-event="apply_pay">批量转账</button>-->
</script>

<script type="text/html" id="withdrawDetail">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
        </colgroup>
        <tbody>
        <tr>
            <td>分销商店铺名称</td>
            <td>{{d.fenxiao_name}}</td>
        </tr>
        <tr>
            <td>提现金额</td>
            <td>{{d.money}}元</td>
        </tr>
        <tr>
            <td>提现手续费率</td>
            <td>{{d.withdraw_rate}}%</td>
        </tr>
        <tr>
            <td>提现手续费</td>
            <td>{{d.withdraw_rate_money}}元</td>
        </tr>
        <tr>
            <td>实际到账金额</td>
            <td>{{d.real_money}}元</td>
        </tr>
        <tr>
            <td>状态</td>
            {{# if(d.status == 1){ }}
            <td>待审核</td>
            {{# }else if(d.status == 2){ }}
            <td>已审核</td>
            {{# }else if(d.status == -1){ }}
            <td>无效</td>
            {{# } }}
        </tr>
        <tr>
            <td>申请时间</td>
            <td>{{ ns.time_to_date(d.create_time) }}</td>
        </tr>
        {{# if(d.status == 2){ }}
		<tr>
			<td>到账时间</td>
			<td>{{ ns.time_to_date(d.payment_time) }}</td>
		</tr>
		{{# } }}
        {{# if(d.status == -1){ }}
        <tr>
            <td>审核时间</td>
            <td>{{ ns.time_to_date(d.payment_time) }}</td>
        </tr>
        {{# } }}
        </tbody>
    </table>
</script>

</body>
</html>