<?php /*a:2:{s:62:"/www/wwwroot/ls.chnssl.com/app/admin/view/consulting/edit.html";i:1657009607;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1654841781;}*/ ?>
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
    .flex{display: flex;flex-wrap: wrap;}
    .flex .layui-form-item{width:50%}
    .ns-form-row{margin: 20px auto;}
    .layui-tab-brief li{border-bottom: 3px solid #FFFFFF;}
    .layui-tab-brief li.layui-this{border-bottom: 3px solid #ff6a00;}
    .panel-content { padding-left: 15px; box-sizing: border-box; }
    .ns-custom-panel .custom-panel-title .panel-content { width: calc(100% - 190px); }
    .ns-account-value, .ns-split { line-height: 34px; }
    .ns-custom-panel .custom-panel-from { display: flex; }
    .ns-custom-panel .custom-panel-from .layui-form-label{
        text-align: center;
    }
    .ns-custom-panel .custom-panel-from>div{
        text-align: center;
    }
    .ns-custom-panel .custom-panel-from .layui-form-item>div>span{
        margin-right: 10px;
    }
    .ns-custom-panel .custom-panel-from .layui-form-item>div>button{
        width: 20px;
        height: 20px;
        text-align: center;
        padding: 0;
        line-height: 20px;
        border:0;
        color:#FF6A00 ;
    }
    .layui-input-block + .layui-word-aux {
        display: block;
        margin-left: 100px;
    }
    .ns-admin-account {
        display: flex;
        align-items: center;
        position: relative;
        padding: 15px;
        box-sizing: border-box;
    }

    .ns-admin-detail p {
        display: inline-block;
        width: 300px;
        line-height: 30px;
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
				
<div class="layui-card ns-card-common ns-card-brief">
    <div class="layui-card-header">
        <span class="ns-card-title">资讯信息</span>
    </div>
    <div class="layui-card-body">
        <div class="layui-form-item">
            <label class="layui-form-label ns-company-name">标题：</label>
            <div class="layui-input-inline">
                <input name="title" type="text" id="title" class="layui-input ns-len-long" value="<?php echo htmlentities($verify_state['data']['title']); ?>"  autocomplete="off">

            </div>
        </div>
        
        
        	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">封面图：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box <?php if(!(empty($verify_state['data']['cover_img']) || (($verify_state['data']['cover_img'] instanceof \think\Collection || $verify_state['data']['cover_img'] instanceof \think\Paginator ) && $verify_state['data']['cover_img']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="logoUpload">
						<?php if(!(empty($verify_state['data']['cover_img']) || (($verify_state['data']['cover_img'] instanceof \think\Collection || $verify_state['data']['cover_img'] instanceof \think\Paginator ) && $verify_state['data']['cover_img']->isEmpty()))): ?>
						<div id="preview_logoUpload" class="preview_img">
							<img layer-src src="<?php echo img($verify_state['data']['cover_img']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
							<p>点击上传</p>
						</div>
						<?php endif; ?>
					</div>
					<div class="operation">
						<div>
							<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
							<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
						</div>
						<div class="replace_img js-replace">点击替换</div>
					</div>
					<input type="hidden" id="logo" name="logo" value="<?php echo htmlentities($verify_state['data']['cover_img']); ?>"/>
				</div>
			</div>
		</div>

		<div class="ns-word-aux">
			<p>建议图片尺寸：800x800像素；图片格式：jpg、png、jpeg。</p>
		</div>
	</div>
        
        <div class="layui-form-item">
            <label class="layui-form-label">资讯详情：</label>
            <div class="layui-input-inline ns-special-length">
                <input type="hidden" name="goods_content" value="<?php echo htmlentities($verify_state['data']['content']); ?>" />
                <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
            </div>
        </div>
            <script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.config.js"></script>
            <script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.all.js"> </script>
            <script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/lang/zh-cn/zh-cn.js"></script>

        <script>
            UE.registerUI('dialog', function(editor, uiName) {
                var btn = new UE.ui.Button({
                    name: 'xiumi-connect',
                    title: 'ç§€ç±³',
                    onclick: function() {
                        var dialog = new UE.ui.Dialog({
                            iframeUrl: 'xiumiUeDialogV5.html',
                            editor: editor,
                            name: 'xiumi-connect',
                            title: "ç§€ç±³å›¾æ–‡æ¶ˆæ¯åŠ©æ‰‹",
                            cssRules: "width: " + (window.innerWidth - 60) + "px;" + "height: " + (window.innerHeight - 60) + "px;",
                        });
                        dialog.render();
                        dialog.open();
                    }
                });
                return btn;
            });
        </script>
        <link rel="stylesheet" href="./xiumi-ue-v5.css">
        <style>
            .edui-button.edui-for-xiumi-connect .edui-button-wrap .edui-button-body .edui-icon {
                background-image: url("https://dl.xiumi.us/connect/ue/xiumi-connect-icon.png") !important;
                background-size: contain;
            }javascript:;
        </style>
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="required">*</span>是否推荐：</label>
            <div class="layui-input-block" id="stustas">
                <input type="radio" name="stustas" value="0" title="推荐" <?php echo $verify_state['data']['status']==0 ? 'checked'  :  ''; ?>>推荐
                <input type="radio" name="stustas" value="1" title="不推荐" <?php echo $verify_state['data']['status']==1 ? 'checked'  :  ''; ?>>不推荐
            </div>

        </div>
    </div>
    <div class="ns-single-filter-box">
        <div class="ns-form-row">
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
            <button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
        </div>
    </div>
</div>

<div class="layui-card-body">

</div>
<!-- 隐藏域 -->
<input type="hidden" name="con_id" id="con_id" value="<?php echo htmlentities($verify_state['data']['id']); ?>" />
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
    $(function() {
        goodsContent = UE.getEditor('editor');
        goodsContent.ready(function () {
            goodsContent.setContent($("input[name='goods_content']").val());
        });
    })
    layui.use(['form'], function() {
        var form = layui.form,
               /* indexs = layui.layedit.build('demo'),
                layedit = layui.layedit,*/
                $ = layui.jquery,
                payType = 1, //结算类型
                autotrophy = 0,//自营类型
                repeat_flag = false; //防重复标识

        form.render();



        form.on('submit(save)', function(data){
            //添加

//          data.field.content =layedit.getContent(indexs);
            data.field.id =$('#con_id').val();
//            data.field.title =$('#title').val();
            data.field.title =$('#title').val();
            data.field.stustas =$('input:radio:checked').val();
            data.field.logo =$('#logo').val();
            var goods_content = goodsContent.getContent();
            data.field.content = goods_content;
            $.ajax({
                type: 'POST',
                url: ns.url("admin/consulting/uploadStatus"),
                data: data.field,
                dataType: 'JSON',
                success: function(res) {
                    repeat_flag = false;
                    if (res.code == 0) {
                        layer.confirm('修改成功', {
                            title:'操作提示',
                            btn: ['返回列表'],
                            yes: function(){
                                location.href = ns.url("admin/consulting/lists")
                            },
                            btn2: function() {
                                location.href = ns.url("admin/consulting/addCon")
                            }
                        });
                    } else {
                        layer.msg(res.message);
                    }
                }
            });
        });

        /**
         * select监听
         */


        /**
         * 表单验证
         */
        form.verify({
            mobile: function(value) {
                var reg = /^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[0135678]|9[89])\d{8}$/;
                if (value == '') {
                    return;
                }
                if (!reg.test(value)) {
                    return '请输入正确的手机号码!';
                }
            },
            idcard: function(value) {
                var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                if (value == '') {
                    return;
                }
                if (!reg.test(value)) {
                    return '请输入正确的身份证号!';
                }
            },
            bankprovince: function(value){
                if (value == -1) return '请选择省';
            },
            bankcity: function(value){
                if (value == -1) return '请选择市';
            },
            bankdistrict: function(value, item){
                if (value == -1 && $(item).find('option').length > 1) return '请选择区县';
            },
        })

    });

    function back() {
        location.href = ns.url("admin/consulting/lists");
    }
    
    var logo_upload = new Upload({
			elem: '#logoUpload'
		});

		// 店铺头像
		var avatar_upload = new Upload({
			elem: '#avatarUpload'
		});

		// 店铺大图
		var banner_upload = new Upload({
			elem: '#bannerUpload'
		});
</script>

<!-- 积分弹框html -->

<!-- 余额弹框html -->

<!-- 余额（可提现）弹框html -->


<!-- 成长值弹框html -->


</body>
</html>