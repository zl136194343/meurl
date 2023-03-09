<?php /*a:2:{s:70:"/www/wwwroot/ls.chnssl.com/addon/fenxiao/admin/view/config/basics.html";i:1614520028;s:24:"app/admin/view/base.html";i:1660099950;}*/ ?>
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
    .ns-form-row{margin-top: 0;}
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
				
<div class="layui-form ns-form">
    <!-- 基础上传 -->
    <div class="layui-card ns-card-common ns-card-brief">
        <div class="layui-card-header">
            <span class="ns-card-title">分销设置</span>
        </div>
        <div class="layui-card-body">

            <div class="layui-form-item">
                <label class="layui-form-label">是否开启分销：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="radio" name="level_config" value="0" lay-filter="open_distribution" title="关闭" <?php if($basics_info['level'] == 0): ?> checked <?php endif; ?>/>
                        <input type="radio" name="level_config" value="1" lay-filter="open_distribution" title="开启" <?php if($basics_info['level'] > 0): ?> checked <?php endif; ?>/>
                    </div>
                </div>
            </div>

            <div class="layui-form-item distribution-index <?php if($basics_info['level'] == 0): ?>layui-hide<?php endif; ?>">
                <label class="layui-form-label">分销层级：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="radio" name="level" value="1" title="一级分销" <?php if($basics_info['level'] == 1 || $basics_info['level'] == 0): ?> checked <?php endif; ?>/>
                        <input type="radio" name="level" value="2" title="二级分销" <?php if($basics_info['level'] == 2): ?> checked <?php endif; ?>/>
                        <input type="radio" name="level" value="3" title="三级分销" <?php if($basics_info['level'] == 3): ?> checked <?php endif; ?>/>
                    </div>
                </div>
                <div class="ns-word-aux ">默认佣金比例请到分销商等级进行设置</div>
            </div>
            <div class="layui-form-item distribution-index <?php if($basics_info['level'] == 0): ?>layui-hide<?php endif; ?>">
                <label class="layui-form-label">是否需要审核：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="radio" name="is_examine" value="1" lay-filter="level" title="开启" <?php if($basics_info['is_examine'] == 1): ?> checked <?php endif; ?>/>
                        <input type="radio" name="is_examine" value="0" lay-filter="level" title="关闭" <?php if($basics_info['is_examine'] != 1): ?> checked <?php endif; ?>/>
                    </div>
                </div>
                <div class="ns-word-aux ">开启后，分销商申请需要后台审核</div>
            </div>
        </div>

    </div>

    <div class="layui-card ns-card-common ns-card-brief distribution-index <?php if($basics_info['level'] == 0): ?>layui-hide<?php endif; ?>">
        <div class="layui-card-header">
            <span class="ns-card-title">分销商资格</span>
        </div>
        <div class="layui-card-body">

            <div class="layui-form-item distributor">
                <label class="layui-form-label">成为分销商条件：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="radio" name="fenxiao_condition" value="0" lay-filter="fenxiao_condition" title="无条件" <?php if($fenxiao_info['fenxiao_condition'] == 0): ?> checked <?php endif; ?>/>
                        <input type="radio" name="fenxiao_condition" value="1" lay-filter="fenxiao_condition" title="申请" <?php if($fenxiao_info['fenxiao_condition'] == 1): ?> checked <?php endif; ?>/>
                        <input type="radio" name="fenxiao_condition" value="2" lay-filter="fenxiao_condition" title="消费次数" <?php if($fenxiao_info['fenxiao_condition'] == 2): ?> checked <?php endif; ?>/>
                        <input type="radio" name="fenxiao_condition" value="3" lay-filter="fenxiao_condition" title="消费金额" <?php if($fenxiao_info['fenxiao_condition'] == 3): ?> checked <?php endif; ?>/>
                    </div>
                </div>
                <div class="ns-word-aux"></div>
            </div>

            <div class="layui-form-item layui-hide consume_count">
                <label class="layui-form-label">累计消费次数：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="number" name="consume_count" value="<?php echo htmlentities($fenxiao_info['consume_count']); ?>" autocomplete="off" class="layui-input ns-len-small">
                    </div>
                    <div class="layui-form-mid">次</div>
                </div>
            </div>

            <div class="layui-form-item layui-hide consume_money">
                <label class="layui-form-label">累计消费金额：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="number" name="consume_money" value="<?php echo htmlentities($fenxiao_info['consume_money']); ?>" autocomplete="off" class="layui-input ns-len-small">
                    </div>
                    <div class="layui-form-mid">元</div>
                </div>
            </div>

            <div class="layui-form-item  layui-hide consume_condition">
                <label class="layui-form-label">消费条件：</label>
                <div class="layui-input-block">
                    <div class="layui-input-inline">
                        <input type="radio" name="consume_condition" value="1" lay-filter="level" title="付款后" checked/>
                        <input type="radio" name="consume_condition" value="2" lay-filter="level" title="订单完成" <?php if($fenxiao_info['consume_condition'] == 2): ?> checked <?php endif; ?>/>
                    </div>
                </div>
                <div class="ns-word-aux">默认佣金比例请到分销商等级进行设置</div>
            </div>

            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">完善资料：</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<div class="layui-input-inline">-->
                        <!--<input type="radio" name="perfect_info" value="1" lay-filter="level" title="需要" <?php if($fenxiao_info['perfect_info'] == 1): ?> checked <?php endif; ?>/>-->
                        <!--<input type="radio" name="perfect_info" value="0" lay-filter="level" title="不需要" <?php if($fenxiao_info['perfect_info'] != 1): ?> checked <?php endif; ?>/>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
			
        </div>
    </div>
    
    <div class="layui-card ns-card-common ns-card-brief" style="margin-top: 0;">
        <div class="layui-card-body" style="padding-top: 0;">
            <div class="ns-form-row">
                <button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
            </div>
        </div>
    </div>

    <!--<div class="layui-card ns-card-common ns-card-brief">-->
        <!--<div class="layui-card-header">-->
            <!--<span class="ns-card-title">上下线关系</span>-->
        <!--</div>-->
        <!--<div class="layui-card-body">-->

            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">成为下线条件：</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<div class="layui-input-inline">-->
                        <!--<input type="radio" name="child_condition" value="1" lay-filter="child_condition" title="首次点击分享链接" checked />-->
                        <!--<input type="radio" name="child_condition" value="2" lay-filter="child_condition" title="首次下单" <?php if($relation_info['child_condition'] == 2): ?> checked <?php endif; ?>/>-->
                        <!--<input type="radio" name="child_condition" value="3" lay-filter="child_condition" title="首次付款" <?php if($relation_info['child_condition'] == 3): ?> checked <?php endif; ?>/>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->

        <!--</div>-->
    <!--</div>-->

    
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


<script>
    layui.use(['form'], function() {
        var form = layui.form,
            openDistribution = "<?php echo htmlentities($basics_info['level']); ?>",
            repeat_flag = false; //防重复标识
        form.render();

        form.on('submit(save)', function(data) {
            if (repeat_flag) return;
            repeat_flag = true;
            if(!parseInt(openDistribution)){
                data.field.level = data.field.level_config;
            }

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ns.url("fenxiao://admin/config/basics"),
                data: data.field,
                success: function(res) {
                    layer.msg(res.message);
					repeat_flag = false;
                    if (res.code == 0) {
                        location.reload();
                    }
                }
            });
        });

        form.on('radio(open_distribution)', function(data){
            openDistribution = data.value;
            if (!parseInt(openDistribution)){
                $(".distribution-index").addClass('layui-hide');
                return false;
            }
            $(".distribution-index").removeClass('layui-hide');
        });

        //监听成为分销商条件选择
        form.on('radio(fenxiao_condition)', function(data){
            var value = data.value;
            distributionConditions(value);
        });
        
        distributionConditions("<?php echo htmlentities($fenxiao_info['fenxiao_condition']); ?>");
        function distributionConditions (value){
            value = parseInt(value);

            $('.consume_count').addClass("layui-hide");
            $('.consume_money').addClass("layui-hide");
            $('.consume_condition').addClass("layui-hide");
            $('.apply').addClass("layui-hide");

            //无条件
            if(value == 0){
                $(".distributor .ns-word-aux").text("默认成为分销商");
            }
            //申请
            if(value == 1){
                $('.apply').removeClass("layui-hide");
                $(".distributor .ns-word-aux").text("需申请通过，才可以成为分销商");
            }
            //消费次数
            if(value == 2){
                $('.consume_count').removeClass("layui-hide");
                $('.consume_condition').removeClass("layui-hide");

                $(".distributor .ns-word-aux").text("当消费次数达到一定数量并申请通过才可以成为分销商");
            }
            //消费金额
            if(value == 3){
                $('.consume_money').removeClass("layui-hide");
                $('.consume_condition').removeClass("layui-hide");

                $(".distributor .ns-word-aux").text("当消费金额达到一定数量并申请通过才可以成为分销商");
            }
        }
        
    });
</script>

</body>
</html>