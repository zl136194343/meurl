<?php /*a:2:{s:65:"/www/wwwroot/ls.chnssl.com/app/admin/view/consulting/add_con.html";i:1657009596;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1654841781;}*/ ?>
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
    .required {
        margin-right: 3px;
    }
    
    .ns-check-member {
        position: relative;
    }
    
    .ns-check-member .layui-btn {
        position: absolute;
        top: 0;
        right: 1px;
        border-color: #e5e5e5;
        padding: 0 10px;
        border-right: 0;
    }
    
    .ns-store-company,
    .ns-pay-company,
    .ns-pay-alipay,
    .ns-shop-own {
        display: none;
    }
    /* 关联会员 */
    
    .ns-search-result {
        border: 1px solid;
        padding: 15px 30px 15px 15px;
        display: flex;
        align-items: center;
        position: relative;
        margin-top: 10px;
    }
    
    .ns-search-res-img {
        width: 50px;
        height: 50px;
        margin-right: 5px;
        text-align: center;
        line-height: 50px;
    }
    
    .ns-search-res-img img {
        max-width: 100%;
        max-height: 100%;
    }
    
    .ns-search-res-intro p {
        line-height: 24px;
    }
    
    .ns-search-res-close {
        position: absolute;
        top: 5px;
        right: 5px;
    }
    
    .ns-card-common:first-of-type {
        margin-top: 0;
    }
    
    .ns-form-row {
        margin-top: 0;
    }
    
    .ns-check-member .layui-input:focus+.layui-btn {
        border-color: #4685FD;
    }
    
    .ns-store-company,
    .ns-pay-company {
        margin-top: 10px;
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
				
<div class="layui-form">
    <!-- 店铺信息 -->


    <!-- 申请类型 -->


    <!-- 企业店铺独有 -->


    <!-- 公共部分 -->
    <!-- 联系人信息 -->
    <div class="layui-card ns-card-common ns-card-brief">
        <div class="layui-card-header">
            <span class="ns-card-title">资讯信息</span>
        </div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label ns-company-name">标题：</label>
                <div class="layui-input-inline">
                    <input name="title" type="text" class="layui-input ns-len-long" autocomplete="off">
                </div>
            </div>
            
            	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">资讯封面：</label>
		<div class="layui-input-block img-upload">
			<div class="upload-img-block">
				<div class="upload-img-box">
					<div class="ns-upload-default" id="logoUpload">
						<div class="upload">
							<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
							<p>点击上传</p>
						</div>
						
					</div>
					<div class="operation" >
						<div>
							<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
							<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
						</div>
						<div class="replace_img js-replace">点击替换</div>
					</div>
					<input type="hidden" name="logo" value=""/>
				</div>
			</div>
		</div>
		

	<script src="https://ls.chnssl.com/app/shop/view/public/js/common.js"></script>

		<div class="ns-word-aux">
			<p>建议图片尺寸：800x800像素；图片格式：jpg、png、jpeg。</p>
		</div>
	</div>

            <div class="layui-form-item">
                <label class="layui-form-label">资讯详情：</label>
                <div class="layui-input-inline ns-special-length">

                    <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>


                </div>
            </div>
            <script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.config.js"></script>
            <script type="text/javascript" charset="utf-8" src="https://ls.chnssl.com/public/static/ext/ueditor/ueditor.all.js">
            </script>
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
                }
            </style>

            <!--<div class="layui-form-item">
                <label class="layui-form-label ns-company-phone">内容：</label>
                <div class="layui-input-block">
                    <textarea name="content" id="demo" lay-verify="mobile" class="layui-textarea ns-len-long" cols="10" rows="10"></textarea>
                </div>
                <script>
                    layui.use('layedit', function() {

                        var layedit = layui.layedit;
                        layedit.set({
                            uploadImage: {
                                url: "upload",
                                type: 'post'
                            }
                        })
                        layedit.build('demo'); //创建编辑器ajax

                    });
                </script>
            </div>-->


        </div>
    </div>

    <!-- 营业执照 税务 -->
    <!-- 企业店铺独有 -->


    <!-- 身份证件 -->


    <!-- 对公账户信息 -->
    <!-- 企业店铺独有 -->


    <!-- 结算信息 -->

    <!-- 个人信息 -->

    <div class="layui-card ns-card-common ns-card-brief">
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label">是否推荐：</label>
                <div class="layui-input-block" id="cert_type">
                    <input type="radio" name="stustas" lay-filter="certType" value="0" title="推荐" checked>
                    <input type="radio" name="stustas" lay-filter="certType" value="1" title="不推荐">
                </div>
            </div>
        </div>
    </div>
    <div class="ns-single-filter-box">
        <div class="ns-form-row">
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
            <button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
        </div>
    </div>

    <!-- 隐藏域 -->
    <!--	<input type="hidden" name="contacts_card_electronic_2" />   &lt;!&ndash; 身份证正面 &ndash;&gt;-->
    <!--	<input type="hidden" name="contacts_card_electronic_3" />   &lt;!&ndash; 身份证反面 &ndash;&gt;-->
    <!--	<input type="hidden" name="business_licence_number_electronic" />   &lt;!&ndash; 营业执照电子版 &ndash;&gt;-->
    <!-- <input type="hidden" name="tax_registration_certificate_electronic" /> -->
    <!-- 税务登记证号电子版 -->
    
    
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


<script src="https://ls.chnssl.com/app/admin/view/public/js/address.js"></script>
<script>
    $(function() {
        goodsContent = UE.getEditor('editor');
    })
    layui.use(['form'], function() {
        var form = layui.form,

            $ = layui.jquery,
            payType = 1, //结算类型
            autotrophy = 0, //自营类型
            repeat_flag = false; //防重复标识

        form.render();

        initArea(form); //三级联动初始化

        form.on('submit(save)', function(data) {
            //添加

            /* data.field.content =layedit.getContent(indexs);*/
            // if (data.field.site_url == '') {
            //     layer.msg("请输入秀米链接");
            //     return false;
            // }

            var goods_content = goodsContent.getContent();
            data.field.goods_content = goods_content;

            $.ajax({
                type: 'POST',
                url: ns.url("admin/consulting/addCon"),
                data: data.field,
                dataType: 'JSON',
                success: function(res) {
                    repeat_flag = false;
                    if (res.code == 0) {
                        layer.confirm('添加成功', {
                            title: '操作提示',
                            btn: ['返回列表', '继续添加'],
                            yes: function() {
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
        form.on('radio(is_own)', function(data) { //店铺等级中如果is_own=1，则入驻时长可以不填，否则必选
            autotrophy = data.value;
            //判断入驻时长是否必填,如果分组is_own=1 不必填 0 必填
            if (autotrophy == 0) {
                $(".ns-shop-time").show();
                $(".ns-shop-is-own").show();
                $(".ns-shop-own").hide();
                $(".ns-shop-time select").attr("lay-verify", "required");
                $(".ns-shop-is-own .ns-group").attr("lay-verify", "required");
                $(".ns-shop-own .ns-group").removeAttr("lay-verify");
            } else {
                $(".ns-shop-time").hide();
                $(".ns-shop-is-own").hide();
                $(".ns-shop-own").show();
                $(".ns-shop-time select").removeAttr("lay-verify");
                $(".ns-shop-is-own .ns-group").removeAttr("lay-verify");
                $(".ns-shop-own .ns-group").attr("lay-verify", "required");
            }
        });

        form.on('radio(certType)', function(data) { //为企业店铺时，显示企业独有部分，否则隐藏
            var value = data.value;
            if (value == 1) {
                $(".ns-store-company").hide();
                $(".ns-pay-company").hide();
                $(".ns-company-person").text("联系人信息");
                $(".ns-company-name").text("联系人姓名");
                $(".ns-company-phone").text("联系人电话");
                $(".ns-company-identity").text("联系人身份证件");
                $(".ns-company-ident").text("联系人身份证号");
                $(".ns-company-pic-front").text("申请人身份证正面");
                $(".ns-company-pic-back").text("申请人身份证反面");
            } else {
                $(".ns-store-company").show();
                $(".ns-pay-company").show();
                $(".ns-company-person").text("法人代表信息：");
                $(".ns-company-name").text("法人姓名：");
                $(".ns-company-phone").text("法人联系电话：");
                $(".ns-company-identity").text("法人身份证件：");
                $(".ns-company-ident").text("法人身份证号：");
                $(".ns-company-pic-front").text("法人身份证正面：");
                $(".ns-company-pic-back").text("法人身份证反面：");
            }
        });

        form.on('radio(payType)', function(data) { //判断支付方式，显示对应的表单
            payType = data.value;
            if (payType == 1) {
                $(".ns-pay-zfb").hide();
                $(".ns-pay-bank").show();
                $(".ns-pay-win").hide();

                $("#settlement_bank_account_name").attr("lay-verify", "required");
                $("#settlement_bank_account_number").attr("lay-verify", "required");
                $("#settlement_bank_name").attr("lay-verify", "required");
                $("#settlement_bank_address").attr("lay-verify", "required");

                $("#settlement_zfb_account_name").attr("lay-verify", "");
                $("#settlement_zfb_account_number").attr("lay-verify", "");

                $("#weixin_settlement_bank_account_name").attr("lay-verify", "");
                $("#weixin_settlement_bank_name").attr("lay-verify", "");
                form.render("select");
            } else if (payType == 2) {
                $(".ns-pay-zfb").show();
                $(".ns-pay-bank").hide();
                $(".ns-pay-win").hide();

                $("#settlement_zfb_account_name").attr("lay-verify", "required");
                $("#settlement_zfb_account_number").attr("lay-verify", "required");

                $("#settlement_bank_name").attr("lay-verify", "");
                $("#settlement_bank_address").attr("lay-verify", "");
                $("#settlement_bank_account_name").attr("lay-verify", "");
                $("#settlement_bank_account_number").attr("lay-verify", "");

                $("#weixin_settlement_bank_account_name").attr("lay-verify", "");
                $("#weixin_settlement_bank_name").attr("lay-verify", "");
            } else if (payType == 3) {
                $(".ns-pay-win").show();
                $(".ns-pay-bank").hide();
                $(".ns-pay-zfb").hide();

                $("#settlement_bank_account_name").attr("lay-verify", "");
                $("#settlement_bank_account_number").attr("lay-verify", "");
                $("#settlement_bank_name").attr("lay-verify", "");
                $("#settlement_bank_address").attr("lay-verify", "");

                $("#settlement_zfb_account_name").attr("lay-verify", "");
                $("#settlement_zfb_account_number").attr("lay-verify", "");

                $("#weixin_settlement_bank_account_name").attr("lay-verify", "required");
                $("#weixin_settlement_bank_name").attr("lay-verify", "required");

                var intervalId;
                shopBind();

                function shopBind() {
                    intervalId = window.setInterval(
                        function() {
                            $.ajax({
                                async: 'false',
                                type: 'POST',
                                dataType: 'JSON',
                                url: "<?php echo url('admin/consulting/checkShopBind'); ?>",
                                success: function(res) {
                                    if (res.code == -10001 && res.data.is_expire == 1) {
                                        $(".ns-pay-win .img-load").removeClass("layui-hide");
                                        clearInterval(intervalId);
                                        return false;
                                    }

                                    if (res.code >= 0) {
                                        $(".ns-pay-win .img-load").removeClass("layui-hide");
                                        $(".ns-pay-win .img-load").html('恭喜您绑定成功！<p class="ns-text-color">重新绑定</p>');
                                        $("input[name='weixin_settlement_bank_account_number']").val(res.data.openid)
                                        $(".weixin-nickname input").val(res.data.userinfo.nickName);
                                        $(".weixin-nickname").attr("data-state", res.code);
                                        $(".weixin-nickname").removeClass("layui-hide");
                                        clearInterval(intervalId);
                                        return false;
                                    }
                                }
                            });
                        }, 500
                    );
                }

                $('body').on("click", ".ns-pay-win .img-load", function() {
                    if (parseInt($(".weixin-nickname").attr("data-state")) >= 0) {
                        $(".weixin-nickname").addClass("layui-hide");
                    }
                    $(".ns-pay-win img").attr('src', "<?php echo addon_url('admin/shop/shopBindQrcode'); ?>?time=" + Math.random());
                    $(".ns-pay-win .img-load").addClass("layui-hide");
                    shopBind();
                });
            }
        });

        /**
         * 表单验证
         */
        form.verify({
            

            bankprovince: function(value) {
                if (value == -1) return '请选择省';
            },
            bankcity: function(value) {
                if (value == -1) return '请选择市';
            },
            bankdistrict: function(value, item) {
                if (value == -1 && $(item).find('option').length > 1) return '请选择区县';
            },
        })

    });

    /**
     * 点击搜索
     */
    var repeat_flag = false;
    var html, val;

    function checkMember() {
        var parent = $(".ns-check-member");
        var con = parent.find(".ns-member-name").val();
        $(".layui-word-aux").remove();
        $(".ns-search-result").remove();

        if (repeat_flag) return false;
        repeat_flag = true;

        if (con == "" || con == null || con.trim() == "") {
            repeat_flag = false;
        } else {
            $.ajax({
                type: 'POST',
                url: ns.url("admin/member/searchMember"),
                data: {
                    'search_text': con
                },
                dataType: 'JSON',
                success: function(res) {
                    layer.msg(res.message);
                    repeat_flag = false;

                    if (res.data == null) {
                        html = '<span class="layui-word-aux">未找到该用户</span>';
                        val = res.data;
                    } else {
                        html = '<div class="ns-search-result layui-input-inline ns-border-color-gray">' +
                            '<div class="ns-search-res-img">' +
                            '<img src="' + ns.img(res.data.headimg) + '" />' +
                            '</div>' +
                            '<div class="ns-search-res-intro">' +
                            '<p>用户名：' + res.data.username + '</p>' +
                            '<p>电话：' + res.data.mobile + '</p>' +
                            '</div>' +
                            '<div class="ns-search-res-close" onclick="closeMember()">' +
                            '<i class="iconfont iconclose_light"></i>' +
                            '</div>' +
                            '</div>';
                        val = res.data.member_id;
                    }

                    $(".ns-member-id").attr("value", val);
                    $(".ns-check-member").append(html);
                }
            });
        }
    }

    function closeMember() {
        $(".ns-search-result").hide();
    }

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


</body>
</html>