<?php /*a:2:{s:62:"/www/wwwroot/ls.chnssl.com/app/admin/view/shop/basic_info.html";i:1614515996;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞有情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞有情')); ?>">
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
	.required { margin-right: 3px; }
	/* 关联会员 */
	.ns-check-member { position: relative; }
	.ns-check-member .layui-btn { position: absolute; top: 0; right: 1px; border-color: #e5e5e5; padding: 0 10px; border-right: 0; }
	.ns-search-result { border: 1px solid; padding: 15px 30px 15px 15px; display: flex; align-items: center; position: relative; }
	.ns-search-res-img { width: 50px; height: 50px; margin-right: 5px; text-align: center; line-height: 50px; }
	.ns-search-res-img img { max-width: 100%; max-height: 100%; }
	.ns-search-res-intro p { line-height: 24px; }
	.ns-search-res-close { position: absolute; top: 5px; right: 5px; }
	.reset_pass{
		height: 23px;
		border-radius: 50px;
		background-color: transparent;
		font-size: 13px;
		color: #4685FD;
		padding: 2px 8px 2px 0;
		margin: 5px 0 5px 5px;
	}
</style>

</head>
<body>

<div class="ns-logo">
	
	<span>赞有情平台端</span>

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
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>店铺名称：</label>
		<div class="layui-input-block">
			<input name="site_name" type="text" value="<?php echo htmlentities($shop_info['site_name']); ?>" disabled lay-verify="required" class="layui-input ns-len-long" autocomplete="off">
		</div>
		<p class="ns-word-aux">店铺名称不可编辑</p>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">到期时间：</label>
		<div class="layui-input-block">
			<input name="expire_time" type="text" id="laydate" value="<?php if($shop_info['expire_time']): ?><?php echo date('Y-m-d', $shop_info['expire_time']); ?><?php endif; ?>"
			 class="layui-input ns-len-mid" autocomplete="off">
		</div>
		<div class="ns-word-aux">
			<p>店铺关闭时间，与入驻时长相关联</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">卖家账号：</label>
		<div class="layui-input-block ns-input-text">
			<?php $shop_info_json = json_encode($shop_info);?>
			<?php echo htmlentities($shop_info['username']); ?>  <a class="reset_pass" href="javascript:resetPass(<?php echo htmlentities($shop_info_json); ?>)">重置密码</a>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否自营：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_own" value="1" lay-filter="whether_autotrophy" lay-skin="switch" <?php if($shop_info['is_own'] == 1): ?> checked <?php endif; ?> />
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>主营行业：</label>
		<div class="layui-input-block ns-len-mid">
			<select class="ns-category" name="category_id" lay-verify="required" lay-filter="shop_category">
				<option value="">请选择</option>
				<?php if(is_array($shop_category_list) || $shop_category_list instanceof \think\Collection || $shop_category_list instanceof \think\Paginator): $i = 0; $__LIST__ = $shop_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?>
				<option value="<?php echo htmlentities($category['category_id']); ?>" <?php echo $shop_info['category_id']==$category['category_id'] ? 'selected'  :  ''; ?>><?php echo htmlentities($category['category_name']); ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>

	<!-- 非自营 -->
	<div class="layui-form-item <?php if($shop_info['is_own'] == 1): ?>layui-hide<?php endif; ?>">
		<label class="layui-form-label"><span class="required">*</span>开店套餐：</label>
		<div class="layui-input-block ns-len-mid">
			<select class="ns-group" name="group_id" lay-verify="required" lay-filter="shop_group">
				<option value="">请选择</option>
				<?php if(is_array($shop_group_list) || $shop_group_list instanceof \think\Collection || $shop_group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $shop_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
				<option value="<?php echo htmlentities($group['group_id']); ?>" <?php echo $shop_info['group_id']==$group['group_id'] ? 'selected'  :  ''; ?>><?php echo htmlentities($group['group_name']); ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>

	<!-- 自营 -->
	<div class='layui-form-item <?php if($shop_info['is_own'] != 1): ?>layui-hide<?php endif; ?> '>
		<label class="layui-form-label"><span class="required">*</span>开店套餐：</label>
		<div class="layui-input-block ns-len-mid">
			<select class="ns-group" name="own_group_id" lay-verify="required" lay-filter="shop_group">
				<option value="">请选择</option>
				<?php if(is_array($shop_own_group_list) || $shop_own_group_list instanceof \think\Collection || $shop_own_group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $shop_own_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
				<option value="<?php echo htmlentities($group['group_id']); ?>" <?php echo $shop_info['group_id']==$group['group_id'] ? 'selected'  :  ''; ?>><?php echo htmlentities($group['group_name']); ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>

	<!--<div class="layui-form-item ns-check-member-box">-->
		<!--<label class="layui-form-label">关联前台会员：</label>-->
		<!--<div class="layui-input-inline ns-check-member">-->
			<!--<input type="text" id="search_text" name="search_text" value="" placeholder="请输入会员名或手机" class="layui-input ns-len-mid ns-member-name" autocomplete="off">-->
			<!--<button type="button" class="layui-btn layui-btn-primary" onclick="checkMember()">-->
				<!--<i class="layui-icon">&#xe615;</i>-->
			<!--</button>-->
			<!--<input class="ns-member-id" type="text" name="member_id" hidden value="" />-->
		<!--</div>-->
		<!---->
		<!--<?php if(!empty($shop_info['member_id']) && !empty($member_info)): ?>-->
			<!--<div class="ns-search-result layui-input-inline ns-border-color-gray">-->
				<!--<div class="ns-search-res-img">-->
					<!--<?php if($member_info['headimg']): ?>-->
					<!--<img src="<?php echo img($member_info['headimg']); ?>" />-->
					<!--<?php endif; ?>-->
				<!--</div>-->
				<!--<div class="ns-search-res-intro">-->
					<!--<p>用户名：<?php echo htmlentities($member_info['username']); ?></p>-->
					<!--<p>电话：<?php echo htmlentities($member_info['mobile']); ?></p>-->
				<!--</div>-->
				<!--<div class="ns-search-res-close" onclick="closeMember()">-->
					<!--<i class="iconfont iconclose_light"></i>-->
				<!--</div>-->
			<!--</div>-->
		<!--<?php endif; ?>-->
	<!--</div>-->

	<div class="layui-form-item">
		<label class="layui-form-label">店铺状态：</label>
		<div class="layui-input-block">
			<input type="radio" name="shop_status" lay-filter="shop_status" value="1" title="正常" <?php if($shop_info['shop_status'] == 1): ?> checked <?php endif; ?>>
			<input type="radio" name="shop_status" lay-filter="shop_status" value="0" title="关闭" <?php if($shop_info['shop_status'] != 1): ?> checked <?php endif; ?>>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">排序号：</label>
		<div class="layui-input-block">
			<input name="sort" type="number" class="layui-input ns-len-short" lay-verify="int" value="<?php echo htmlentities($shop_info['sort']); ?>">
		</div>
		<div class="ns-word-aux">
			<p>排序值必须是整数</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">店铺logo：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box <?php if($shop_info['logo']): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="logoImg">
						<?php if($shop_info['logo']): ?>
						<div id="preview_logoImg" class="preview_img">
							<img layer-src src="<?php echo img($shop_info['logo']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
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
					<input type="hidden" name="logo" value="<?php echo htmlentities($shop_info['logo']); ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">店铺头像（大图）：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box <?php if($shop_info['avatar']): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="avatarImg">
						<?php if($shop_info['avatar']): ?>
						<div id="preview_avatarImg" class="preview_img">
							<img layer-src src="<?php echo img($shop_info['avatar']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
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
					<input type="hidden" name="avatar" value="<?php echo htmlentities($shop_info['avatar']); ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable">店铺条幅：</label>
		<div class="layui-input-block">
			<div class="upload-img-block img-upload">
				<div class="upload-img-box <?php if($shop_info['banner']): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="bannerImg">
						<?php if($shop_info['banner']): ?>
						<div id="preview_bannerImg" class="preview_img">
							<img layer-src src="<?php echo img($shop_info['banner']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png"/>
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
					<input type="hidden" name="banner" value="<?php echo htmlentities($shop_info['banner']); ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">店铺关键字：</label>
		<div class="layui-input-block">
			<input name="seo_keywords" type="text" value="<?php echo htmlentities($shop_info['seo_keywords']); ?>" class="layui-input ns-len-long" autocomplete="off">
		</div>
		<div class="ns-word-aux">
			<p>关键字之间请用英文逗号分隔</p>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">店铺简介：</label>
		<div class="layui-input-inline ns-len-long">
			<textarea name="seo_description" class="layui-textarea"><?php echo htmlentities($shop_info['seo_description']); ?></textarea>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">联系电话：</label>
		<div class="layui-input-block">
			<input name="telephone" type="text" value="<?php echo htmlentities($shop_info['telephone']); ?>" lay-verify="mobile" class="layui-input ns-len-mid" autocomplete="off">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否推荐：</label>
		<div class="layui-input-block">
			<input type="radio" name="is_recommend" lay-filter="is_recommend" value="1" title="开启" <?php if($shop_info['is_recommend'] == 1): ?> checked <?php endif; ?>>
			<input type="radio" name="is_recommend" lay-filter="is_recommend" value="0" title="关闭" <?php if($shop_info['is_recommend'] == 0): ?> checked <?php endif; ?>>
		</div>
		<p class="ns-word-aux">开启后，会在客户端店铺列表优先展示</p>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">服务保障：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="shop_qtian" title="7天退换" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_qtian'] == 1): ?> checked <?php endif; ?>>
			<input type="checkbox" name="shop_zhping" title="正品保障" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_zhping'] == 1): ?> checked <?php endif; ?>>
			<input type="checkbox" name="shop_erxiaoshi" title="两小时发货" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_erxiaoshi'] == 1): ?> checked <?php endif; ?>>
			<input type="checkbox" name="shop_tuihuo" title="退货承诺" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_tuihuo'] == 1): ?> checked <?php endif; ?>>
			<input type="checkbox" name="shop_shiyong" title="试用中心" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_shiyong'] == 1): ?> checked <?php endif; ?>>
			<input type="checkbox" name="shop_shiti" title="实体验证" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_shiti'] == 1): ?> checked <?php endif; ?>>
			<input type="checkbox" name="shop_xiaoxie" title="消协保证" lay-skin="primary" value="1" lay-filter="service" <?php if($shop_info['shop_xiaoxie'] == 1): ?> checked <?php endif; ?>>
		</div>
	</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
	
	<!-- 隐藏域 -->
	<input type="hidden" value="<?php echo htmlentities($shop_info['site_id']); ?>" name="site_id" />
<!--	<input type="hidden" value="<?php echo htmlentities($shop_info['logo']); ?>" name="logo" />-->
<!--	<input type="hidden" value="<?php echo htmlentities($shop_info['avatar']); ?>" name="avatar" />-->
<!--	<input type="hidden" value="<?php echo htmlentities($shop_info['banner']); ?>" name="banner" />-->
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
	var laytpl;
	layui.use(['form', 'laydate','laytpl'], function() {
		var form = layui.form,
			laydate = layui.laydate,
			autotrphyChecked = parseInt("<?php echo htmlentities($shop_info['is_own']); ?>"),
			repeat_flag = false; //防重复标识

		laytpl = layui.laytpl;
		form.render();

		laydate.render({
			elem: '#laydate'
		});

		form.render();

		// logo上传
		var logo_upload = new Upload({
			elem: '#logoImg'
		});

		// 店铺头像上传
		var avatar_upload = new Upload({
			elem: '#avatarImg'
		});

		// 店铺横幅上传
		var banner_upload = new Upload({
			elem: '#bannerImg'
		});
		
		/**
		 * 表单验证
		 */
		form.verify({
			int: function(value) {
				if (value == "") {
					return false;
				}
				if (value < 0 || value > 100 || !(value % 1 === 0)) {
					return '请输入0-100之间的整数'
				}
			}
		});

		// 是否自营
		form.on('switch(whether_autotrophy)', function(data){
			autotrphyChecked = data.elem.checked ? 1 : 0;
			autotrophy();
		});

		autotrophy();
		function autotrophy(){
			if(autotrphyChecked == 1){
				$('select[name="own_group_id"]').attr("lay-verify",'required').parents('.layui-form-item').removeClass("layui-hide");
				$('select[name="group_id"]').attr("lay-verify",'').parents('.layui-form-item').addClass("layui-hide");
			}else{
				$('select[name="group_id"]').attr("lay-verify",'required').parents('.layui-form-item').removeClass("layui-hide");
				$('select[name="own_group_id"]').attr("lay-verify",'').parents('.layui-form-item').addClass("layui-hide");
			}
		}
		
		/**
		 * 监听保存
		 */
		form.on('submit(save)', function(data) {
			if(autotrphyChecked == 1){
				data.field.group_id = data.field.own_group_id;
			}
			
			var group_id = data.field.group_id,
				group_name = $(".ns-group").find("option[value=" + group_id + "]").text(),
				category_id = data.field.category_id,
				category_name = $(".ns-category").find("option[value=" + category_id + "]").text();
			
			data.field.group_name = group_name;
			data.field.category_name = category_name;
			
			if (repeat_flag) return false;
			repeat_flag = true;
			
			// 删除图片
			if(!data.field.logo) logo_upload.delete();
			if(!data.field.avatar) avatar_upload.delete();
			if(!data.field.banner) banner_upload.delete();
			
			$.ajax({
				url: ns.url("admin/shop/basicInfo"),
				data: data.field,
				type: "POST",
				dataType: "JSON",
				success: function(res) {
					repeat_flag = false;
					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("admin/shop/lists")
							},
							btn2: function() {
								location.reload();
							}
						});
					} else {
						layer.msg(res.message);
					}
				}
			});
		});

		form.on('submit(repass)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;

			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: ns.url("admin/shopuser/modifyPassword"),
				data: data.field,
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;

					if (res.code == 0) {
						layer.closeAll('page');
					}
				}
			});
		});

		/**
		 * 表单验证
		 */
		form.verify({
			repass: function(value) {
				if (value != $("#user_new_pass").val()) {
					return "输入错误,两次密码不一致!";
				}
			}
		});

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
		
		if(repeat_flag) return false;
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
				success: function (res) {
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
										'<p>用户名：'+ res.data.username +'</p>' +
										'<p>电话：'+ res.data.mobile +'</p>' +
									'</div>' +
									'<div class="ns-search-res-close" onclick="closeMember()">' +
										'<i class="iconfont iconclose_light"></i>' +
									'</div>' +
								'</div>';
						val = res.data.member_id;
					}
					
					$(".ns-member-id").attr("value", val);
					$(".ns-check-member-box").append(html);
				}
			});
		}
	}
	
	function closeMember() {
		$(".ns-search-result").hide();
	}
	
	function back() {
		location.href = ns.url("admin/shop/lists");
	}

	function closePass() {
		layer.close(layer_pass);
	}

	function resetPass(data){
		laytpl($("#pass_change").html()).render(data, function(html) {
			layer_pass = layer.open({
				title: '重置密码',
				skin: 'layer-tips-class',
				type: 1,
				area: ['550px'],
				content: html,
			});
		});
	}
</script>
<!-- 重置密码弹框html -->
<script type="text/html" id="pass_change">
	<div class="layui-form" id="reset_pass">
		<div class="layui-form-item">
			<label class="layui-form-label mid"><span class="required">*</span>新密码</label>
			<div class="layui-input-block">
				<input type="password" id="user_new_pass" name="password" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label mid"><span class="required">*</span>确认新密码</label>
			<div class="layui-input-block">
				<input type="password" name="password" required lay-verify="repass" class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
			</div>
			<span class="ns-word-aux mid">请再一次输入密码，两次输入密码须一致</span>
		</div>

		<div class="ns-form-row mid">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="repass">确定</button>
			<button class="layui-btn layui-btn-primary" onclick="closePass()">返回</button>
		</div>

		<input class="reset-pass-id" type="hidden" name="site_id" value="{{d.site_id}}"/>
		<input class="reset-pass-id" type="hidden" name="username" value="{{d.username}}"/>
	</div>
</script>


</body>
</html>