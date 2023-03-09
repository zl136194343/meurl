<?php /*a:2:{s:63:"/www/wwwroot/ls.chnssl.com/app/admin/view/diy/member_index.html";i:1614518648;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1660099950;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/colorPicker/css/colorpicker.css"/>
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/diyview/css/member_icon/iconfont.css"/>
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/diyview/css/member_index.css"/>
<link rel="stylesheet" href="https://ls.chnssl.com/public/static/ext/diyview/css/diyview.css"/>
<style>
	.ns-body-content {
		padding-left: 0 !important;
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
				
<div id="diyView" class='layui-form'>
	<div class="components-box">
		<div class="preview-wrap" style="flex:1">

	        <div class="preview-restore-wrap">
		        <div class="dv-wrap">
		            <div class='diy-view-wrap layui-form'>

		                <div class="preview-head">
		                    <span>会员中心</span>
		                </div>

		                <div class="preview-block">

		                    <!-- 会员信息 -->
		                    <div @click="currentIndex=0" class="draggable-element" :class="{selected: currentIndex == 0}">
		                        <div class="member-info">
		                            <div class="preview-draggable" :style="{backgroundColor:data.bgColor,backgroundImage: data.bgImg ?  'url(' + changeImgUrl(data.bgImg) + ')' : ''}">
		                                <div class="info">
		                                    <div class="info-img">
		                                        <img src="https://ls.chnssl.com/public/static/ext/diyview/img/member_index/member_head.png" alt="">
		                                    </div>
		                                    <div class="info-content">
		                                        <span class="info-name" :style="{color:data.textColor}">会员昵称</span>
		                                        <span class="info-grad">会员等级</span>
		                                    </div>
		                                    <div class="info-set">
		                                        <i class="iconfont icon-shezhi" :style="{color:data.textColor}"></i>
		                                    </div>
		                                </div>
		                                <div class="wallet" :style="{color:data.textColor}">
		                                    <div class="wallet-item wallet-balance">
		                                        <span>0.00</span>
		                                        <span>余额</span>
		                                    </div>
		                                    <span class="wallet-item-border"></span>
		                                    <div class="wallet-item wallet-integral">
		                                        <span>0</span>
		                                        <span>积分</span>
		                                    </div>
		                                    <span class="wallet-item-border"></span>
		                                    <div class="wallet-item wallet-discount-coupon">
		                                        <span>0</span>
		                                        <span>优惠券</span>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="edit-attribute" v-show="currentIndex == 0">
		                                <div class="attr-wrap">
		                                    <div class="restore-wrap">
		                                        <h2 class="attr-title">会员信息</h2>

			                                    <div class="layui-form-item">
				                                    <label class="layui-form-label sm">页面风格</label>
				                                    <div class="layui-input-block">
					                                    <template v-for="(item,index) in topStyleList">
						                                    <div @click="data.topStyle=item.value" :class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (data.topStyle==item.value) }">
							                                    <i class="layui-anim layui-icon">&#xe63f;</i>
							                                    <div>{{item.text}}</div>
						                                    </div>
					                                    </template>
				                                    </div>
													<div class="ns-word-aux ns-diy-word-aux">系统风格跟随商城风格进行整体变化</div>
			                                    </div>
			                                    <template v-if="data.topStyle == topStyleList[1].value">
													<div class="diy-text-color">
														<color v-bind:data="{ field: 'textColor', label : '文字颜色', value:data.textColor }"></color>
													</div>

			                                        <div class="layui-form-item">
			                                            <label class="layui-form-label sm">背景颜色</label>
			                                            <div class="layui-input-block color-list">
			                                                <div class="colorSelector" v-for="(item,index) in bgColorList" :key="index" :class="{'selected':data.bgColor==item}">
			                                                    <div :style="{background: item}" @click="data.bgColor=item"></div>
			                                                </div>
			                                                <div class="diy-color-wrap">
			                                                    <color v-bind:data="{ field : 'bgColor', label : '', value:data.bgColor }" :class="{'selected':bgColorList.indexOf(data.bgColor)==-1}"></color>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="layui-form-item">
			                                            <label class="layui-form-label sm">背景图片</label>
			                                            <div class="layui-input-block ns-img-upload">
			                                                <img-sec-upload :data="{data:data,field:'bgImg'}"></img-sec-upload>
			                                            </div>
			                                            <div class="ns-word-aux ns-diy-word-aux">建议使用半透明图片，尺寸：750px * 332px</div>
			                                        </div>
			                                    </template>

		                                    </div>
		                                </div>
		                            </div>

		                        </div>
		                    </div>

		                    <!-- 订单信息 -->
		                    <div class="draggable-element disabled">
		                        <div class="order-info">
		                            <div class="preview-draggable">
		                                <div class="order-info-title">
		                                    <span class="all-order">全部订单</span>
		                                    <span class="check-order">查看全部订单<i class="iconfont icon-right"></i></span>
		                                </div>
		                                <ul class="order-info-content">
		                                    <li class="content-item">
		                                        <div class="content-item-icon">
		                                            <img src="<?php echo img('upload/uniapp/member/index/order/default_order_1.png'); ?>" alt="">
		                                        </div>
		                                        <span>待付款</span>
		                                    </li>
		                                    <li class="content-item">
		                                        <div class="content-item-icon">
		                                            <img src="<?php echo img('upload/uniapp/member/index/order/default_order_2.png'); ?>" alt="">
		                                        </div>
		                                        <span>待发货</span>
		                                    </li>
		                                    <li class="content-item">
		                                        <div class="content-item-icon">
		                                            <img src="<?php echo img('upload/uniapp/member/index/order/default_order_3.png'); ?>" alt="">
		                                        </div>
		                                        <span>等收货</span>
		                                    </li>
		                                    <li class="content-item">
		                                        <div class="content-item-icon">
		                                            <img src="<?php echo img('upload/uniapp/member/index/order/default_order_4.png'); ?>" alt="">
		                                        </div>
		                                        <span>待评价</span>
		                                    </li>
		                                    <li class="content-item">
		                                        <div class="content-item-icon">
		                                            <img src="<?php echo img('upload/uniapp/member/index/order/default_order_5.png'); ?>" alt="">
		                                        </div>
		                                        <span>退款</span>
		                                    </li>
		                                </ul>
		                            </div>
		                        </div>
		                    </div>

		                    <!-- 会员等级 -->
							<div class="draggable-element" @click="currentIndex=1" :class="{selected: currentIndex == 1}">
								<div  class="draggable-element disabled">
									<div class="member-grade">
										<div class="preview-draggable">
											<div class="grade-icon">
												<i></i>
												<span>白银会员</span>
											</div>
											<div class="member-equities">
												<span>会员等级更多权益</span>
												<i></i>
											</div>
										</div>
									</div>
								</div>
								<div class="edit-attribute" v-show="currentIndex == 1">
									<div class="attr-wrap">
										<div class="restore-wrap">
											<h2 class="attr-title">会员等级</h2>
											<div class="layui-form-item">
												<label class="layui-form-label sm">显示状态</label>
												<div class="layui-input-block">
													<div @click="data.level=1" :class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : data.level==1 }">
														<i class="layui-anim layui-icon">&#xe63f;</i>
														<div>显示</div>
													</div>
													<div @click="data.level=0" :class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : data.level==0 }">
														<i class="layui-anim layui-icon">&#xe63f;</i>
														<div>隐藏</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

		                    <!-- 常用工具 -->
		                    <div @click="currentIndex=3" class="draggable-element" :class="{selected: currentIndex == 3}">
		                        <div class="common-tools">
		                            <div class="preview-draggable">
		                                <div class="tools-title">
		                                    <span>常用工具</span>
		                                </div>
		                                <ul class="tools-list" :class="[data.menuStyle, parseInt(data.insertGap) ? 'insert-gap' : '']">
		                                    <li class="tools-item" v-for="item in handleMenuList" v-if="item.isShow == 1">
		                                        <div class="tools-item-icon">
		                                            <img :src="changeImgUrl(item.img)" alt="">
		                                        </div>
		                                        <span>{{item.text}}</span>
			                                    <i class="iconfont icon-right" v-if="data.menuStyle=='list'"></i>
		                                    </li>
		                                </ul>
		                            </div>

		                            <div class="edit-attribute" style="display: none" v-show="currentIndex == 3">
		                                <div class="attr-wrap">
		                                    <div class="restore-wrap">
		                                        <h2 class="attr-title">常用工具</h2>

		                                        <div class="layui-form-item">
		                                            <label class="layui-form-label sm">样式</label>
		                                            <div class="layui-input-block">
		                                                <template v-for="(item,index) in menuStyleList">
		                                                    <div @click="data.menuStyle=item.value" :class="{ 'layui-unselect layui-form-radio' : true,'layui-form-radioed' : (data.menuStyle==item.value) }">
		                                                        <i class="layui-anim layui-icon">&#xe63f;</i>
		                                                        <div>{{item.text}}</div>
		                                                    </div>
		                                                </template>
		                                            </div>
		                                        </div>

		                                        <div class="layui-form-item" v-show="data.menuStyle == menuStyleList[1].value">
		                                            <label class="layui-form-label sm">插入间隔</label>
		                                            <div class="layui-input-block">
		                                                <div class="layui-unselect layui-form-switch" @click="data.insertGap=data.insertGap == 1 ? 0 : 1" :class="{ 'layui-form-onswitch' : (data.insertGap == 1) }">
		                                                    <em></em>
		                                                    <i></i>
		                                                </div>
		                                            </div>
		                                        </div>

			                                    <div class="menu-list">
				                                    <ul>
					                                    <li v-for="(item,index) in data.menuList" :data-index="index" :data-sort="index">
						                                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" :class="{ 'layui-form-checked' : (item.isShow == 1) }" @click="item.isShow= item.isShow == 1 ? 0 : 1">
							                                    <i class="layui-icon layui-icon-ok"></i>
						                                    </div>
		                                                    <div class="info-wrap" >
		                                                        <span>{{item.text}}</span>
			                                                    <span v-if="item.remark" class="tips">（{{item.remark}}）</span>
		                                                    </div>
						                                    <i class="iconfont icon-delete" title="删除" @click="deleteMenu(index)" v-if="item.isSystem == 0"></i>
						                                    <i class="iconfont icon-bianji" title="编辑" @click="editMenu(index)"></i>
					                                    </li>
				                                    </ul>
				                                    <button class="layui-btn layui-btn-primary sm" @click="addMenu()">添加菜单</button>
			                                    </div>

		                                    </div>
		                                </div>
		                            </div>

		                        </div>
		                    </div>

		                </div>

		            </div>
		        </div>
	        </div>
		</div>
		<div class="custom-save">
			<button class="layui-btn ns-bg-color" @click="save">保存</button>
		</div>
	</div>
</div>
<?php if(!empty($info)): ?>
<input type="hidden" id="info" value='<?php echo htmlentities($info); ?>' />
<?php endif; ?>
<script type="text/html" id="editMenuHtml">
	<div class="layui-form">

		<div class="layui-form-item">
			<label class="layui-form-label sm">菜单名称：</label>
			<div class="layui-input-block">
				<input type="text" name="menu_text" value="{{d.text ? d.text : ''}}" lay-verify="required" placeholder="请输入菜单名称" maxlength="10" class="layui-input ns-len-short">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label sm">菜单图标：</label>
			<div class="layui-input-block img-upload">
				<div class="upload-img-block">
					<div class="upload-img-box" id="menuImgUpload">
						{{# if(d.img){ }}
						<img src="{{ns.img(d.img)}}" />
						{{# }else{ }}
						<div class="ns-upload-default">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png" />
						</div>
						{{# } }}
					</div>
					<input type="hidden" name="menu_img" value="{{d.img ? d.img : ''}}"/>
					{{# if(d.img){ }}
					<i class="del show">x</i>
					{{# }else{ }}
					<i class="del">x</i>
					{{# } }}
				</div>
			</div>

			<div class="ns-word-aux sm">
				<p>建议尺寸100px*100px</p>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label sm">跳转链接</label>
			<div class="layui-input-block">
				{{# if(d.link && d.link.title){ }}
				<span class="js-select-link-text">{{d.link.title}}</span>
				{{# }else{ }}
				<span class="js-select-link-text" style="display: none;"></span>
				{{# } }}
				{{# if(d.tag != 'servicer'){ }}
				<button class="layui-btn layui-btn-primary sm" onclick="selectLink({{d.i}})">选择</button>
				{{# } }}
			</div>
		</div>

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
    var post = '<?php echo htmlentities($app_module); ?>';
    var height = $(window).height();// 自适应全屏，调整高度
    var commonHeight = height - 214;
    $(".preview-wrap .preview-restore-wrap .dv-wrap").css("height", (commonHeight) + "px");
    $(".edit-attribute .attr-wrap").css("height", (commonHeight - 34) + "px");
    $(".preview-block").css("min-height", (commonHeight - 120) + "px");

    var form,laytpl;
    layui.use(['form', 'laytpl'], function() {
        form = layui.form;
        laytpl = layui.laytpl;
    });
</script>
<script src="https://ls.chnssl.com/public/static/js/vue.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/colorPicker/js/colorpicker.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/jquerycolorpicker/js/paigusu.min.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/ddsort.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/components.js"></script>
<script src="https://ls.chnssl.com/public/static/ext/diyview/js/member_index.js"></script>

</body>
</html>