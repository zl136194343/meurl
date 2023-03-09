<?php /*a:2:{s:65:"/www/wwwroot/ls.chnssl.com/addon/wechat/admin/view/menu/menu.html";i:1614519374;s:24:"app/admin/view/base.html";i:1614515892;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"Niushop开源商城")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'Niushop开源商城')); ?>">
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/addon/wechat/admin/view/public/css/wx_menu.css">
<script src="https://ls.chnssl.com/addon/wechat/admin/view/public/js/common.js"></script>

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<img src="https://ls.chnssl.com/app/admin/view/public/img/logo.png">
	</div>
	<span>B2B2C多商户平台端</span>
	<span>服务电话：400-886-7993</span>
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
				
<div class='wx-menu' id='menu'>
    <div class='wx-menu-preview'>
        <div class='mobile-preview'>
            <div class='mobile-hd'>
                <span></span>
            </div>
            <div class='mobile-bd'>
                <div class='wx-menu-list'>
                    <template v-for="(item, index) in button">
                        <div class="wx-menu-item-box" v-bind:class="['wx-menu-item-box-' + index]">
                            <div class='wx-menu-item' v-bind:class="[index==menuIndex[0]&&-1==menuIndex[1] ? 'active' : '']" @click.stop='chooseMenu(index, -1)'>
                                <template v-if="item.name == ''">
                                    <span>菜单名称</span>
                                </template>
                                <template v-else>
                                    <span>{{item.name}}</span>
                                </template>
                            </div>
                            <template v-if="index==menuIndex[0]">
                                <div class='wx-sub-menu-list' v-if="item" v-bind:class="[button.length != undefined && button.length == 2 ? 'two' : '',button.length != undefined && button.length == 3 ? 'three' : '']">
                                    <div class='wx-sub-menu-item' v-bind:data="[second_index]" v-bind:class="[second_index==menuIndex[1] ? 'active' : '', 'wx-sub-menu-item-' + second_index]" v-for="(item2, second_index) in item.sub_button" @click.stop='chooseMenu(index, second_index)'>
                                        <template v-if="item2.name == ''">
                                            <span>子菜单名称</span>
                                        </template>
                                        <template v-else>
                                            <span>{{item2.name}}</span>
                                        </template>
                                    </div>
                                    <template v-if="subMenuPlusShow">
                                        <div class='wx-sub-menu-item' v-on:click.stop="addSubMenu(index)">+</div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>
                    <template v-if="button.length < 3">
                        <div class='wx-menu-item-box add-menu' v-on:click="addMenu">+</div>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <div class='wx-menu-form'>
        <div class='button-list-null' v-if='menuIndex[0] == -1'>点击左侧按钮 + 添加菜单</div>
        <template v-if="menuIndex[0] != -1">
            <div class='form-editor'>
                <div class='form-hd'>
                    <div class='form-hd-name'>{{name}}</div>
                    <div class='form-hd-del'><a href="javascript:void(0);" class='layui-btn layui-btn-primary layui-btn-xs' v-on:click='deleteMenu'>删除菜单</a></div>
                </div>
                <div class='form-bd'>
                    <div class='form-bd-list'>
                        <div class='form-bd-item'>
                            <label class='layui-form-label sm'>菜单名称</label>
                            <div class='item-group'>
                                <template v-if="menuIndex[1] == -1">
                                    <input type='text' class='input layui-input' :class="error_hint == 'name' ? 'error' : ''" value='' @keyup="checkName($event)" v-model='name' placeholder="请输入菜单名称">
                                    <p class="tip" :class="error_hint == 'name' ? 'error' : ''">字数不超过4个汉字或8个字母</p>
                                </template>
                                <template v-else>
                                    <input type='text' class='input layui-input' :class="error_hint == 'name' ? 'error' : ''" value='' @keyup="checkName($event, 'sub_button')" v-model='name' placeholder="请输入子菜单名称">
                                    <p class='tip' :class="error_hint == 'name' ? 'error' : ''">字数不超过8个汉字或16个字母</p>
                                </template>
                            </div>
                        </div>
                        <div class='form-bd-item'  v-if="(menuIndex[0] > -1 && (button[menuIndex[0]] == undefined || button[menuIndex[0]].sub_button == undefined || button[menuIndex[0]].sub_button[0] == undefined)) || (menuIndex[1] > -1)">
                            <label class='layui-form-label sm'>菜单内容</label>
                            <div class='item-group menu-type'>
                                <label class='radio-label'>
                                    <i class='layui-icon' :class="type == 'media' ? 'layui-icon-radio' : 'layui-icon-circle'"></i>
                                    <input type='radio' name='type' id='type1' value='media' v-model='type'>
                                    <span>发送素材内容</span>
                                </label>
                                <label class='radio-label'>
                                    <i class='layui-icon' :class="type == 'view' ? 'layui-icon-radio' : 'layui-icon-circle'"></i>
                                    <input type='radio' name='type' id='type2' value='view' v-model='type'>
                                    <span>跳转到网页</span>
                                </label>
                                <label class='radio-label'>
                                    <i class='layui-icon' :class="type == 'miniprogram' ? 'layui-icon-radio' : 'layui-icon-circle'"></i>
                                    <input type='radio' name='type' id='type3' value='miniprogram' v-model='type'>
                                    <span>跳转小程序</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='form-bd-content'>
                        <div class='menu-content' v-if='type == "media"'>
                            <div class="layui-tab layui-tab-brief">
                                <ul class="layui-tab-title wechat-media">
                                    <li :class="media_type == 'text' ? 'layui-this' : ''" @click="chooseMediaType(5)"><i class='layui-icon layui-icon-form'></i>文本消息</li>
                                    <li :class="media_type == 'graphic_message' ? 'layui-this' : ''" @click="chooseMediaType(1)"><i class='layui-icon layui-icon-tabs'></i>图文消息</li>
                                </ul>
                                <div class="layui-tab-content">
                                    <div class="layui-tab-item" :class="media_type == 'text' ? 'layui-show' : ''">
                                        <template v-if="text == '' || text == undefined">
                                            <div class='material-library' @click="material(5)">
                                                <i></i>
                                                <span>从素材库选择</span>
                                            </div>
                                            <div class='add-material' @click="addMaterial(5)">
                                                <i></i>
                                                <span>添加文本素材</span>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div class='text-message'>
                                                <div class='text-message-content'>
                                                    <div class="material-type">
                                                        <span>文本</span>
                                                    </div>
                                                    <div class="title">
                                                        <a href="javascript:void(0);" @click="previewText(text)">{{text}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class='del' @click="deleteMaterial(5)">删除</span>
                                        </template>
                                    </div>
                                    <div class="layui-tab-item" :class="media_type == 'graphic_message' ? 'layui-show' : ''">
                                        <template v-if="graphic_message[0] == undefined">
                                            <div class='material-library' @click="material(1)">
                                                <i></i>
                                                <span>从素材库选择</span>
                                            </div>
                                            <div class='add-material' @click="addMaterial(1)">
                                                <i></i>
                                                <span>新建图文素材</span>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div class='graphic-message-list'>
                                                <template v-for="(value, index) in graphic_message">
                                                    <div class='graphic-message-content'>
                                                        <div class="material-type">
                                                            <span>图文</span>
                                                        </div>
                                                        <div class="title">
                                                            <a href="javascript:void(0);" @click="preview(value.id, index)">{{value.title}}</a>
                                                        </div>
                                                    </div>
                                                    <template v-if="graphic_message.length == 1">
                                                        <div class='read-all' @click="preview(value.id)">
                                                            <div>阅读全文</div>
                                                            <i> > </i>
                                                        </div>
                                                    </template>
                                                </template>
                                            </div>
                                            <span class='del' @click="deleteMaterial(1)">删除</span>
                                        </template>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class='menu-content view' v-if='type == "view"'>
                            <p class='tip' style="margin: 10px 0 20px 0;padding-left: 5px;">订阅者点击该子菜单会跳转到一下链接</p>
                            <div class='form-bd-item'>
                                <label class='layui-form-label sm'>页面地址</label>
                                <div class='layui-input-inline'>
                                    <input type='text' class="input layui-input nc-len-mid" value='' v-model='url' placeholder='例：http://example.com'>
                                </div>
                            </div>
                        </div>
                        <div class='menu-content menu' v-if='type == "miniprogram"'>
                            <p class='tip' style="margin: 10px 0 20px 0;padding-left: 5px;">订阅者点击该子菜单会跳到以下小程序</p>
                            <div class='layui-form-item'>
                                <label class='layui-form-label'>备用网页</label>
                                <div class='layui-input-block'>
                                    <input type='text' id='miniprogram_url' class="layui-input nc-len-mid" value='' v-model='url' placeholder='例：http://example.com'>
                                    <p class='layui-form-mid layui-word-aux'>旧版微信客户端无法支持小程序，用户点击菜单时将会打开备用网页。</p>
                                </div>
                            </div>
                            <div class='layui-form-item'>
                                <label class='layui-form-label'>小程序APPID</label>
                                <div class='layui-input-block'>
                                    <input type='text' class="layui-input nc-len-mid" value='' v-model='appid'>
                                    <p class='layui-form-mid layui-word-aux'>小程序需要绑定当前公众号。</p>
                                </div>
                            </div>
                            <div class='layui-form-item'>
                                <label class='layui-form-label'>小程序页面路径</label>
                                <div class='layui-input-inline'>
                                    <input type='text' class="layui-input" value='' v-model='pagepath'>
                                </div>
                            </div>
                        </div>
                        <div class='menu-content' v-if='type == "event"'>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='click' v-model='eventType'>
                                <span>点击事件</span>
                            </label>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='scancode_push' v-model='eventType'>
                                <span>扫码推事件</span>
                            </label>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='scancode_waitmsg' v-model='eventType'>
                                <span>扫码推事件带提示</span>
                            </label>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='pic_sysphoto' v-model='eventType'>
                                <span>弹出系统拍照发图</span>
                            </label>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='pic_photo_or_album' v-model='eventType'>
                                <span>弹出拍照或者相册发图</span>
                            </label>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='pic_wechat' v-model='eventType'>
                                <span>弹出微信相册发图器</span>
                            </label>
                            <label class='radio-label'>
                                <input type='radio' name='eventType' value='location_select' v-model='eventType'>
                                <span>弹出地理位置选择器</span>
                            </label>
                            <div class='form-bd-item'>
                                <label class='item-label'>菜单KEY值</label>
                                <div class='item-group'>
                                    <input type='text' class='input' value='' v-model='key'>
                                    <p class='tip'>旧版微信客户端无法支持小程序，用户点击菜单时将会打开备用网页。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <div class='form-ft'>
        <button class='layui-btn ns-bg-color' @click="saveMenu">保存并发布</button>
    </div>
</div>

<!-- 添加文本消息 -->
<div class="layui-tab layui-tab-brief" id="add_material_text" style="display:none;">
    <ul class="layui-tab-title">
        <li class="layui-this">添加文本消息</li>
    </ul>
    <div class="layui-form" >
        <div class="layui-form-item">
            <label class="layui-form-label sm">内容</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="请输入内容" id="material_text_content" class="layui-textarea" maxlength="300" lay-verify='material_text_content'></textarea>
                <span class='input-text-hint'>剩余300</span>
            </div>
        </div>
        <div class="ns-form-row sm">
            <button class="layui-btn ns-bg-color" lay-submit lay-filter="addText">保存</button>
            <button type="reset" class="layui-btn layui-btn-primary" onclick="back()">取消</button>
        </div>
    </div>
</div>


			</div>

			<!-- 版权信息 -->
			<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
			</div>
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


<script src="https://ls.chnssl.com/public/static/js/vue.js"></script>
<script type="text/javascript" src="https://ls.chnssl.com/addon/wechat/admin/view/public/js/wx_menu.js"></script>
<script type="text/javascript" src="https://ls.chnssl.com/addon/wechat/admin/view/public/js/wx_material_mannager.js"></script>

</body>
</html>