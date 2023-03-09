<?php /*a:2:{s:69:"/www/wwwroot/ls.chnssl.com/addon/gift/admin/view/giftorder/lists.html";i:1614520012;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
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
				
<div class="layui-collapse ns-tips">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">操作提示</h2>
        <ul class="layui-colla-content layui-show">
            <li>可搜索礼品名称、关键字搜索出具体礼品卡信息</li>
            <li>可进行礼品添加、删除、编辑等操作</li>
        </ul>
    </div>
</div>

<!-- 搜索框 -->
<div class="ns-single-filter-box">

    <div class="layui-form">
        <div class="layui-input-inline">
            <input type="text" name="search_text" placeholder="请输入礼品名称" class="layui-input" autocomplete="off">
            <button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
                <i class="layui-icon">&#xe615;</i>
            </button>
        </div>
    </div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="type_name">
    <ul class="layui-tab-title">
        <li class="layui-this" lay-id="">全部</li>
        <li lay-id="2">未配送</li>
        <li lay-id="1">已配送</li>
    </ul>

    <div class="layui-tab-content">
        <table id="gift_order_list" lay-filter="gift_order_list"></table>
    </div>
</div>

<!-- 礼品信息 -->
<script type="text/html" id="gift_info">
    <div class='ns-table-tuwen-box'>
        <div class='ns-img-box'>
			{{#  if(d.gift_image){  }}
            <img layer-src src="{{ns.img(d.gift_image.split(',')[0])}}">
			{{#  }  }}
        </div>
        <div class='ns-font-box'>
            <p class="ns-multi-line-hiding">礼品名称：{{d.gift_name}}</p>
            <p class="ns-multi-line-hiding">领取数量：{{d.num}}</p>
        </div>
    </div>
</script>

<!-- 编辑删除操作 -->
<script type="text/html" id="action">
    <div class="ns-table-btn">
        <a class="layui-btn" lay-event="express">配送管理</a>
        <a class="layui-btn" lay-event="detail">查看</a>
    </div>
</script>
<script type="text/html" id="express_status">
    {{# if(d.express_status == 0){}}
    未配送
    {{# } }}
    {{# if(d.express_status == 1){}}
    已配送
    {{# } }}
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
    layui.use(['form','laytpl', 'element'], function() {
        var table,
            form = layui.form,
            laytpl = layui.laytpl,
            element = layui.element,
            repeat_flag = false; //防重复标识
        form.render();

        //监听Tab切换
        element.on('tab(type_name)', function(data) {
            var type = $(this).attr("lay-id");
            table.reload( {
                page: {
                    curr: 1
                },
                where: {
                    'express_status': type
                }
            });
        });

        table = new Table({
            elem: '#gift_order_list',
            url: ns.url("gift://admin/giftorder/lists"),
            where:{gift_id:"<?php echo htmlentities($gift_id); ?>"},
            cols: [
                [{
					field: 'gift_name,num',
					title: '礼品名称 / 领取数量',
					width: '20%',
					unresize: 'false',
					templet: '#gift_info',
				},{
                    field: 'member_name',
                    title: '会员信息',
                    unresize: 'false',
                    width: '25%',
                    templet: '<div>会员名称：{{d.member_name}}<br>会员电话：{{d.mobile}}<br>会员地址：{{d.full_address}}</div>',
                }, {
                    field: 'express_status',
                    title: '配送信息',
                    unresize: 'false',
                    width: '10%',
                    templet: '#express_status'
                }, {
                    field: 'get_type_name',
                    title: '获取方式',
                    unresize: 'false',
                    width: '10%'
                },  {
                    title: '操作',
                    toolbar: '#action',
                    unresize: 'false',
                    width: '15%'
                }]
            ]
        });

        /**
         * 监听工具栏操作
         */
        table.tool(function(obj) {
            var data = obj.data;
            switch (obj.event) {
                case 'detail': //查看
                    detail(data);
                    break;
                case 'express': //配送管理
                    express(data);
                    break;
            }
        });
        /**
         * 配送管理
         */
        function express(data) {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ns.url("gift://admin/giftorder/detail"),
                data: {'order_id': data.order_id},
                success: function (res) {
                    laytpl($("#express").html()).render(res.data, function(html) {
                        layer.open({
                            title: '配送管理',
                            skin: 'layer-tips-class',
                            type: 1,
                            area: ['800px'],
                            content: html
                        });
                    });
                }
            });
        }
        
        form.on('submit(express)', function(data){
            layer.closeAll();
            $.ajax({
                url: ns.url("gift://admin/giftorder/express"),
                data: data.field,
                type: "POST",
                dataType: "JSON",
                success: function(res) {
                    if (res.code == 0) {
                        layer.confirm('礼品配送成功', {
                            title:'操作提示',
                            btn: ['返回列表'],
                            yes: function(){
                                location.href = ns.url("gift://admin/giftorder/lists");
                            }
                        });
                    }else{
                        layer.msg(res.message);
                        repeat_flag = false;
                    }
                }
            });

        });

        /**
         订单详情
         */
        function detail(data) {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ns.url("gift://admin/giftorder/detail"),
                data: {'order_id': data.order_id},
                success: function (res) {
                    laytpl($("#detail").html()).render(res.data, function(html) {
                        layer.open({
                            title: '礼品订单详情',
                            skin: 'layer-tips-class',
                            type: 0,
                            area: ['450px'],
                            content: html
                        });
                    });
                }
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
        
    });
</script>
<!-- 详情弹框html -->
<script type="text/html" id="detail">
    <table class="layui-table ns-table-detail">
        <colgroup>
            <col width="120">
            <col width="270">
        </colgroup>
        <tbody>
        <tr>
            <td>订单编号</td>
            <td>{{d.order_no}}</td>
        </tr>
        <tr>
            <td>礼品名称</td>
            <td>{{d.gift_name}}</td>
        </tr>
        <tr>
            <td>领取数量</td>
            <td>{{d.num}}</td>
        </tr>
        <tr>
            <td>会员名称</td>
            <td>{{d.member_name}}</td>
        </tr>
        <tr>
            <td>会员电话</td>
            <td>{{d.mobile}}</td>
        </tr>
        <tr>
            <td>详细地址</td>
            <td>{{d.full_address}}</td>
        </tr>
        <tr>
            <td>配送状态</td>
            <td>{{d.express_status==1 ? '已配送' : '未配送'}}</td>
        </tr>
        <tr>
            <td>物流公司</td>
            <td>{{d.express_company_name}}</td>
        </tr>
        <tr>
            <td>配送编码</td>
            <td>{{d.express_no}}</td>
        </tr>
        <tr>
            <td>说明</td>
            <td id="remark">{{d.remark}}</td>
        </tr>
        </tbody>
    </table>
</script>
<!-- 配送管理html -->
<script type="text/html" id="express">
    <div class="layui-form ns-form">
        <div class="layui-form-item">
            <label class="layui-form-label mid">配送编码：</label>
            <div class="layui-input-block">
                <input type="text" name="express_no" value="{{d.express_no}}" required  lay-verify="required" autocomplete="off" class="layui-input ns-len-long">
            </div>
        </div>
		
        <div class="layui-form-item">
            <label class="layui-form-label mid">物流公司：</label>
            <div class="layui-input-block">
                <input type="text" name="express_company_name" value="{{d.express_company_name}}" required  lay-verify="required"  autocomplete="off" class="layui-input ns-len-long">
            </div>
        </div>
       
        <input type="hidden" name="order_id" value="{{d.order_id}}" class="layui-input">
		
		<div class="ns-form-row mid">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="express">配送</button>
			<button type="reset" onclick="cancel()" class="layui-btn ns-bg-color">取消</button>
		</div>
    </div>
</script>
<script>
    function cancel()
    {
        layer.closeAll()
    }
</script>

</body>
</html>