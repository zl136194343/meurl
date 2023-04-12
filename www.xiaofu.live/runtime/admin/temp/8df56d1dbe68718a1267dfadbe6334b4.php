<?php /*a:2:{s:59:"/www/wwwroot/ls.chnssl.com/app/admin/view/diy/template.html";i:1614518648;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1660099950;}*/ ?>
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
    *{margin: 0;padding: 0;}
    li{list-style: none;}
    .template-list{
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
    }
    .template-list .template-item{
        overflow: hidden;
        position: relative;
        padding: 12px;
        margin-left: 32px;
        margin-bottom: 32px;
        width: 270px;
        height: 440px;
        border: 1px solid #e9e9e9;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .template-list .template-item .item-img{
        overflow: hidden;
        width: 244px;
        height: 355px;
    }
    .template-list .template-item .item-img img{
        max-width: 100%;
    }
    .template-list .template-item .item-hide{
        display: none;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: rgba(0,0,0,.6);
        text-align: center;
    }
    .template-list .template-item .item-name{
        display: block;
        padding-top: 7px;
        line-height: 22px;
        font-size: 14px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .template-list .item-hide .item-btn-box{
        position: absolute;
        top: 50%;
        left: 50%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        transform: translate(-50%, -50%);
    }
    .template-list .item-hide button{
        border: 1px solid #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 33px;
        width: 100px;
        color: #fff;
        background: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .template-list .template-item:hover .item-hide{
        display: block;
    }

    .template-box{
        position: relative;
        height: 100%;
    }
    .template-box .template-content{
        display: flex;
        justify-content: space-between;
        width: 530px;
        margin: auto;
    }
    .template-box .template-right{
        position: relative;
        height: 500px;
        width: 180px;
    }
    .template-box .template-right .right-list li {
        width: 82px;
        padding: 8px 0px;
        text-align: center;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .template-box .template-right .right-list li.active{
        color: #fff;
    }
    .template-box .template-right .right-code{
        position: absolute;
        bottom: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .template-box .template-right .right-code .img{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
    }
    .template-box .template-right .right-code .img img{
        max-width: 100%;
        max-height: 100%;
    }
    .template-list .item-hide button ~ button{
        margin-top: 15px;
    }
    .template-box .template-right .right-code span{
        display: block;
        margin-top: 20px;
        line-height: 12px;
        font-size: 12px;
        text-align: center;
        color: #666;
        margin-bottom: 20px;
    }
    .template-box .template-img{
        padding: 37px 13px 17px;
        width: 250px;
        height: 500px;
        background: url('https://ls.chnssl.com/app/admin/view/public/img/iphone_shell.png') no-repeat center / cover;
        box-sizing: border-box;
    }
    .template-box .template-img .template-img-box{
        width: 100%;
        height: 100%;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
        overflow: hidden;
    }
    .template-box .template-img img{
        max-width: 100%;
    }
    .template-box .template-operation{
        position: absolute;
        bottom: -12px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        border-top: 1px solid #e9e9e9;
        right: 0;
        left: 0;
        cursor: pointer;
    }
    .template-box .right-desc{
        position: absolute;
        bottom: 0;
    }
    .template-box .right-desc .desc-content{
        display: block;
        margin-top: 5px;
        text-indent: 2em;
        font-size: 12px;
        line-height: 1.5;
        color: #999;
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
				
<ul class="template-list"></ul>

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


<script type="text/html" id="templateShow">
    <div class="template-box">
        <div class="template-content">
            <div class="template-img">
                <div class="template-img-box">
                    <img src={{ns.img(d.image)}} alt="">
                </div>
            </div>
            <div class="template-right">
                <ul class="right-list">
                    <li class="ns-bg-color active">首页</li>
                </ul>
                <div class="right-desc">
                    <span class="desc-name">模板描述:</span>
                    <span class="desc-content">{{d.desc}}</span>
                </div>
            </div>
        </div>
        <div class="template-operation ns-text-color">立即使用</div>
    </div>
</script>
<script>
    initData();
    function initData(){
        var html = '';
        $.ajax({
            type: 'post',
            url: ns.url("admin/diy/template"),
            dataType: 'JSON',
            success: function(res) {
                var data =  res.data.list;
                if (res.code >= 0){
                    for (var i = 0; i< data.length; i++){
                      html += `<li class="template-item">`;
                        html += `<div class="item-img">`;
                            html += `<img src="${ns.img(data[i].image)}" alt="">`;
                        html += `</div>`;
                        html += `<span class="item-name">${data[i].title}</span>`;
                        html += `<div class="item-hide">`;
                            html += `<div class="item-btn-box">`;
                                html += `<button class="immediate-use">立即使用</button>`;
                                html += `<button class="preview">预览</button>`;
                            html += `</div>`;
                        html += `</div>`;
                        html += `<input type="hidden" name="temple_cotent" value='${JSON.stringify(data[i])}'>`;
                      html += `</li>`;
                    }

                    $(".template-list").html(html);
                }else
                    layer.msg(res.message);
            }
        });    
    }

    $("body").on('click','.template-item .preview',function () {
        var data = JSON.parse($(this).parents('.template-item').find('input[name="temple_cotent"]').val());
        data.value = JSON.parse(data.value);
        layui.use('laytpl', function(){
            var laytpl = layui.laytpl;
            laytpl($("#templateShow").html()).render(data,function (html) {
               layer.open({
                   type:1,
                   title:name,
                   area:['800px','653px'],
                   content:html,
               })
            })
        });
        $("body").on('click','.template-operation',function () {
            immediateUse(data);
        });

    });

    $("body").on('click','.template-item .immediate-use',function () {
        var data = JSON.parse($(this).parents('.template-item').find('input[name="temple_cotent"]').val());
        data.value = JSON.parse(data.value);
        immediateUse(data);
    });

    //立即使用
    function immediateUse(data) {
        $.ajax({
            type: 'post',
            url: ns.url("admin/diy/create"),
            data:{
                name: data.type,
                title: data.title,
                value: JSON.stringify(data.value),
                id: data.id
            },
            dataType: 'JSON',
            success: function(res) {
                layer.msg(res.message);
                if (res.code >= 0){
                    location.href = ns.url("admin/diy/index");
                }
            }
        });
    }
</script>

</body>
</html>