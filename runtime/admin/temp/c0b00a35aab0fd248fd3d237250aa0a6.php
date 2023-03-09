<?php /*a:2:{s:67:"/www/wwwroot/ls.chnssl.com/app/admin/view/express/edit_company.html";i:1614515900;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1661854360;}*/ ?>
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
	.design-sketch{
		border: 1px solid #ccc;
		position: relative;
	}
	.design-sketch div{
		display: inline-block;
		border: 1px solid #ccc;
		padding: 10px;
		margin: 8px;
		border-radius: 2px;
		color: #555;
		white-space: nowrap;
		user-select: none;
		background-color: #fff;
		line-height: 1;
	}
	.design-sketch div i {
		position: absolute;
		top: -10px;
		right: -10px;
		display: none;
		width: 20px;
		height: 20px;
		border-radius: 10px;
		background-color: rgba(0, 0, 0, .5);
		color: #FFFFFF;
		text-align: center;
		line-height: 20px;
		z-index: 99;
	}
	.print-option{
		display: inline-block;
		border: 1px solid;
		line-height: 1;
		padding: 10px;
		margin-left: 5px;
		margin-bottom: 8px;
		border-radius: 2px;
		color: #545454;
		cursor: pointer;
	}
	.ns-form-row {
		margin-top: 0;
	}
	.express-sheet-rule .ns-form-row{margin-left: 200px;}
	.ns-border-color-gray{border-color: #E5E5E5!important;}
	.ns-bg-color-gray{background-color: #E5E5E5!important;}
	.ns-discount {margin-bottom: 15px; display: flex; justify-content: space-between; height: 34px; line-height: 34px; padding: 5px 15px;  background-color: #F6FBFD; border: 1px dashed #BCE8F1; }
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
				
<div class="layui-form">
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">物流公司信息</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label"><span class="required">*</span>物流公司名称：</label>
				<div class="layui-input-inline">
					<input type="text" name="company_name" value="<?php echo htmlentities($company_info['data']['company_name']); ?>" class="layui-input ns-len-long">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable ns-short-label ">物流公司LOGO：</label>
				<div class="layui-input-inline">
					<div class="upload-img-block">
						<div class="upload-img-box <?php if(!(empty($company_info['data']['logo']) || (($company_info['data']['logo'] instanceof \think\Collection || $company_info['data']['logo'] instanceof \think\Paginator ) && $company_info['data']['logo']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="companyLOGO">
								<?php if(!empty($company_info['data']['logo'])): ?>
								<div id="preview_companyLOGO" class="preview_img">
									<img layer-src src="<?php echo img($company_info['data']['logo']); ?>" class="img_prev"/>
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
							<input type="hidden" name="logo" value="<?php echo htmlentities($company_info['data']['logo']); ?>" />
						</div>
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">排序：</label>
				<div class="layui-input-block">
					<input type="number" name="sort" value="<?php echo htmlentities($company_info['data']['sort']); ?>" lay-verify="sorts" autocomplete="off" class="layui-input ns-len-short">
				</div>
				<div class="ns-word-aux">排序值必须为整数</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">URL：</label>
				<div class="layui-input-block">
					<input type="text" name="url" lay-verify="required" value="<?php echo htmlentities($company_info['data']['url']); ?>" class="layui-input ns-len-long">
				</div>
				<p class="ns-word-aux">请输入物流公司官方网址</p>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">快递鸟编码：</label>
				<div class="layui-input-inline">
					<input type="text" name="express_no_kdniao" value="<?php echo htmlentities($company_info['data']['express_no_kdniao']); ?>" class="layui-input ns-len-long">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">快递100免费版编码：</label>
				<div class="layui-input-inline">
					<input type="text" name="express_no_kd100_free" value="<?php echo htmlentities($company_info['data']['express_no_kd100_free']); ?>" class="layui-input ns-len-long">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">快递100付费版编码：</label>
				<div class="layui-input-inline">
					<input type="text" name="express_no_kd100" value="<?php echo htmlentities($company_info['data']['express_no_kd100']); ?>" class="layui-input ns-len-long">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">菜鸟物流接口编码：</label>
				<div class="layui-input-inline">
					<input type="text" name="express_no_cainiao" value="<?php echo htmlentities($company_info['data']['express_no_cainiao']); ?>" class="layui-input ns-len-long">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">快递查询接口编码：</label>
				<div class="layui-input-inline">
					<input type="text" name="express_no_ext" value="<?php echo htmlentities($company_info['data']['express_no_ext']); ?>" class="layui-input ns-len-long">
				</div>
			</div>
		</div>
	</div>
	
	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">订单发票设置</span>
		</div>
		<div class="layui-card-body">
			<div class="layui-form-item">
				<label class="layui-form-label">打印字体大小：</label>
				<div class="layui-input-block">
					<div class="layui-input-inline">
						<input type="number" name="font_size" lay-verify="int" value="<?php echo htmlentities($company_info['data']['font_size']); ?>" class="layui-input print-size ns-len-short">
					</div>
					<span class="layui-form-mid">px</span>
				</div>
				<div class="ns-word-aux">字体大小必须为正整数</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">比例：</label>
				<div class="layui-input-block">
					<input type="number" name="scale" value="<?php echo htmlentities($company_info['data']['scale']); ?>" class="layui-input proportion ns-len-short">
				</div>
				<div class="ns-word-aux">比例为当前显示尺寸与实际尺寸的比例</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">显示尺寸：</label>
				<div class="layui-input-block">
					<div class="layui-input-inline">
						<input name="width" type="number" value="<?php echo htmlentities($company_info['data']['width']); ?>" lay-verify="int" class="layui-input show-width ns-len-short">
					</div>
					<div class="layui-form-mid">-</div>
					<div class="layui-input-inline">
						<input name="height" type="number" value="<?php echo htmlentities($company_info['data']['height']); ?>" lay-verify="int" class="layui-input show-height ns-len-short">
					</div>
				</div>
				<div class="ns-word-aux">尺寸单位：px，用于打印模板预览效果的尺寸，值为整数且不能小于0</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">实际尺寸：</label>
				<div class="layui-input-block">
					<div class="layui-input-inline">
						<span id="realWidth"></span>
					</div>
					<div class="layui-form-mid">*</div>
					<div class="layui-input-inline">
						<span id="realHeight"></span>
					</div>
				</div>
				<div class="ns-word-aux">单位：px，实际尺寸由当前尺寸乘以比例所得</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">打印选项：</label>
				<div class="layui-input-block">
					<?php foreach($print_item_list as $print_k=>$print_v): ?>
					<span class="print-option ns-border-color-gray" data-print-name="<?php echo htmlentities($print_v['item_name']); ?>"><?php echo htmlentities($print_v['item_title']); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">效果图预览：</label>
				<div class="layui-input-block design-sketch">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable">打印背景图：</label>
				<div class="layui-input-block">
					<div class="upload-img-block">
						<div class="upload-img-box <?php if(!(empty($company_info['data']['background_image']) || (($company_info['data']['background_image'] instanceof \think\Collection || $company_info['data']['background_image'] instanceof \think\Paginator ) && $company_info['data']['background_image']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="printBackground">
								<?php if(!empty($company_info['data']['background_image'])): ?>
								<div id="preview_printBackground" class="preview_img">
									<img layer-src src="<?php echo img($company_info['data']['background_image']); ?>" class="img_prev"/>
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
							<input type="hidden" name="background_image" value="<?php echo htmlentities($company_info['data']['background_image']); ?>" />
						</div>
						<!-- <div class="upload-img-box" id="printBackground">
							<?php if(empty($company_info['data']['background_image'])): ?>
							<div class="ns-upload-default">
								<img src="https://ls.chnssl.com/app/admin/view/public/img/upload_img.png" />
								<p>点击上传</p>
							</div>
							<?php else: ?>
								<img src="<?php echo img($company_info['data']['background_image']); ?>" alt="">
							<?php endif; ?>
						</div> -->
					</div>
				</div>
				<div class="ns-word-aux">打印模板背景图</div>
			</div>
		</div>
	</div>

	<div class="layui-card ns-card-common ns-card-brief">
		<div class="layui-card-header">
			<span class="ns-card-title">电子面单</span>
		</div>
		<div class="layui-card-body">

			<div class="layui-form-item">
				<label class="layui-form-label img-upload-lable">是否支持电子面单：</label>
				<div class="layui-input-block">
					<input type="checkbox" name="is_electronicsheet" lay-skin="switch" lay-filter="express_sheet" <?php if($company_info['data']['is_electronicsheet'] == 1): ?>checked <?php endif; ?>>
				</div>
			</div>

			<div class="layui-form-item express-sheet-rule <?php if($company_info['data']['is_electronicsheet'] != 1): ?>layui-hide<?php endif; ?>">
				<label class="layui-form-label">电子面单规则：</label>

				<div class="ns-discount-box"></div>

				<div class="layui-input-block ns-form-row">
					<span class="layui-form-mid">面单模版</span>
					<div class="layui-input-inline">
						<input type="text" class="layui-input ns-len-short" id="template_style" lay-verify="num" autocomplete="off">
					</div>
					<span class="layui-form-mid">,TemplateSize</span>
					<div class="layui-input-inline">
						<input type="text" class="layui-input ns-len-short" id="template_size" lay-verify="num" autocomplete="off">
					</div>
					<button class="layui-btn ns-bg-color" onclick="submitRule()">确定规则设置</button>
				</div>
			</div>

		</div>
	</div>

	<div class="ns-single-filter-box">
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
			<button type="reset" class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>
	</div>
	
	<input type="hidden" name="company_id" value="<?php echo htmlentities($company_info['data']['company_id']); ?>" />
	
	<input type="hidden" class="bg-img-pri" value="<?php echo htmlentities($company_info['data']['background_image']); ?>" />
	<input type="hidden" class="print-con" value="<?php echo htmlentities($company_info['data']['content_json']); ?>" />   <!-- 打印内容 -->
	
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


<script src="https://ls.chnssl.com/public/static/js/Tdrag.min.js"></script>
<script>
	$(document).ready(function () {
		var img = $(".bg-img-pri").val();
		$("#realWidth").text($(".proportion").val() * $(".show-width").val());
		$("#realHeight").text($(".proportion").val() * $(".show-height").val());
		$(".design-sketch").css({
			"width": $(".show-width").val() + "px",
			"height": $(".show-height").val() + "px",
			"background": "url("+ img +") no-repeat center/ cover"
		});
		
		var arr = JSON.parse($(".print-con").val());
		var fontSize = $("input[name=font_size]").val();
		if (fontSize == 0 || fontSize == '') {
			fontSize = 14;
		}
		for (index in arr) {
			var class_name = arr[index].item_name,
				span_text = arr[index].item_title,
				top = arr[index].top, 
				left = arr[index].left;
				
			$(".print-option").each(function () {
				var print_name = $(this).attr("data-print-name");
				if (class_name == print_name) {
					$(this).addClass("ns-bg-color-gray");
					$(this).css("cursor", "not-allowed");
				}
			});
			
			var html = '<div class="span_' + class_name + '" style="top: '+ top +'px; left: '+ left +'px;">'+
							'<span style="font-size: '+ fontSize +'px;">' + span_text + '</span>'+
							'<i class="iconfont iconclose_light" onclick="remove(this)"></i>'+
						'</div>';
						
			$(".design-sketch").append(html);
			
			$(".span_" + arr[index].item_name).hover(function () {
				$(this).find("i").show();
			}, function () {
				$(this).find("i").hide();
			});
			
			$(".span_" + arr[index].item_name).Tdrag({
				scope: ".design-sketch"
			});
		}
	});
</script>
<script>
    var delRule,submitRule,expressSheetChecked,printStyle='<?php echo html_entity_decode($company_info['data']['print_style']); ?>' ? JSON.parse('<?php echo html_entity_decode($company_info['data']['print_style']); ?>') : [];
    layui.use(['form'],function() {
		var form = layui.form,
			repeat_flag = false; //防重复标识
		form.render();

		/**
		 * logo
		 */
		var companyLOGO_upload = new Upload({
			elem: '#companyLOGO',
			url: ns.url("admin/upload/upload"),
		});
		
		/**
		 * 打印背景图
		 */
		var bg_upload = new Upload({
			elem: '#printBackground',
			url: ns.url("admin/upload/upload"),
			callback:function (res) {
				if (res.code >= 0) {
					$(".design-sketch").css("background", "url("+ ns.img(res.data.pic_path) +") no-repeat center/ cover");
				}
			},
			deleteCallback:function () {
				$(".design-sketch").css("background", "");
			}
		});

		form.on('submit(save)', function(data) {
            if (expressSheetChecked && !printStyle.length){
                layer.msg("电子面单规则不能为空");
                return false;
            }

			var content = [];
			$(".design-sketch div").each(function () {
				var item = {};
				item.item_name = $(this).attr("class").substring(5);
				item.item_title = $(this).text();
				item.left = $(this).position().left;
				item.top = $(this).position().top;
				content.push(item);
			});
			data.field.content_json = JSON.stringify(content);

            if (expressSheetChecked) data.field.is_electronicsheet = 1;
            data.field.print_style = JSON.stringify(printStyle);

	        if (repeat_flag) return;
	        repeat_flag = true;
			
			//图片删除
			if(!data.field.logo) companyLOGO_upload.delete();
			if(!data.field.background_image) bg_upload.delete();
			
			$.ajax({
				url: ns.url("admin/express/editCompany"),
				data: data.field,
				dataType: 'JSON',
				type: 'POST',
				success: function(res){
					repeat_flag = false;

				    if(res.code == 0){
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("admin/express/expressCompany")
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
		
		/**
		 * 预览内容添加
		 */
		$(".print-option").click(function(){
			var dataValue = $(this).text(),
				dataId = $(this).attr("data-print-name");
			var fontSize = $("input[name=font_size]").val();
			if (fontSize == '' || fontSize == 0) {
				fontSize = 14;
			}
			if ($(".span_"+ dataId).length > 0) {
				return false;
			} else {
				$(this).addClass("ns-bg-color-gray");
				$(this).css("cursor", "not-allowed");
			}
			
			var html = '<div class="span_' + dataId + '" style="font-size: '+ fontSize +'px;">'+
							'<span>' + dataValue + '</span>'+
							'<i class="iconfont iconclose_light" onclick="remove(this)"></i>'+
						'</div>';
			
			$(".design-sketch").append(html);
			
			$(".span_" + dataId).hover(function () {
				$(this).find("i").show();
			}, function () {
				$(this).find("i").hide();
			});
			
			$(".span_" + dataId).Tdrag({
				scope: ".design-sketch"
			});
		});
		
		/**
		 * 改变效果图宽和高
		 */
		$(".show-width").blur(function(){
			$(".design-sketch").css("width", $(this).val());
			$("#realWidth").text($(this).val() * $(".proportion").val() + "px");
		});
		
		$(".show-height").blur(function(){
			$(".design-sketch").css("height", $(this).val());
			$("#realHeight").text($(this).val() * $(".proportion").val() + "px");
		});
		
		/**
		 * 实际尺寸
		 */
		$(".proportion").blur(function () {
			$(this).val();
			$("#realWidth").text($(this).val() * $(".show-width").val() + "px");
			$("#realHeight").text($(this).val() * $(".show-height").val() + "px");
		});
		
		/**
		 *  打印字体大小
		 */
		$(".print-size").blur(function(){
			$(".design-sketch span").css("font-size", $(this).val() + "px");
		});
		
		/**
		 * 表单验证
		 */
		form.verify({
			sorts: function(value){ 
				if (value == '') {
					return;
				}
				if (value%1 != 0) {
					return '排序数值必须为整数';
				}
				if (value < 0) {
					return '排序数值必须为大于0';
				}
			},
			int: function (value) {
				if (value == '') {
					return;
				}
				if (value < 0 && value%1 != 0) {
					return '请输入正整数!'
				}
			}
		});

        //电子面单
        var printStyleInfo = '<?php echo html_entity_decode($company_info['data']['print_style']); ?>' ? JSON.parse('<?php echo html_entity_decode($company_info['data']['print_style']); ?>') : [];
        if (printStyleInfo.length){
            for (var i = 0; i < printStyleInfo.length; i++){
                var html = '<div class="ns-discount ns-form-row">'+
                    '<div class="ns-discount-con">'+
                    '<p>电子面单模版风格：<span class="required">' + printStyleInfo[i].template_name + '</span>，TemplateSize值：<span class="required template-size">' + printStyleInfo[i].template_size + '</span></p>'+
                    '</div>'+
                    '<div class="ns-discount-del">'+
                    '<button class="layui-btn ns-bg-color" onclick="delRule(this)">删除</button>'+
                    '</div>'+
                    '</div>';
                $(".ns-discount-box").append(html);
            }
        }

        form.on('switch(express_sheet)', function(data){
            expressSheetChecked = data.elem.checked;
            data.elem.checked ? $(".express-sheet-rule").removeClass("layui-hide") : $(".express-sheet-rule").addClass("layui-hide");
        });

        submitRule = function() {
            var templateStyle = $("#template_style").val().trim(),
                templateSize = $("#template_size").val().trim();

            if (!templateStyle) {
                layer.msg("面单模版不能为空", {icon: 5, anim: 6});
                return false;
            }

            for (var i=0; i < $(".ns-discount-box .ns-discount").length; i++) {
                var ident= $(".ns-discount-box .ns-discount").eq(i).find(".template-size").text();
                if (templateSize == ident) {
                    layer.msg("TemplateSize值已添加，不可重复添加！");
                    return false;
                }
            }

            var html = '<div class="ns-discount ns-form-row">'+
                '<div class="ns-discount-con">'+
                '<p>电子面单模版风格：<span class="required">' + templateStyle + '</span>，TemplateSize值：<span class="required template-size">' + templateSize + '</span></p>'+
                '</div>'+
                '<div class="ns-discount-del">'+
                '<button class="layui-btn ns-bg-color" onclick="delRule(this)">删除</button>'+
                '</div>'+
                '</div>';
            $(".ns-discount-box").append(html);
            printStyle.push({template_name:templateStyle,template_size:templateSize});
        };

        delRule = function(obj) {
            var val = $(obj).parents(".ns-discount").find(".template-size").text();

            for (var i = 0; i < printStyle.length; i++){
                if (printStyle[i].template_size == val){
                    printStyle.splice(i,1);
                }
            }

            $(obj).parent().parent().remove();
        }

	});
	
	function remove(e) {
		var that = e;
		$(that).parent().remove();
		
		var attr_name = $(that).parent().attr("class").substring(5);
		$(".print-option").each(function () {
			var print_name = $(this).attr("data-print-name");
			if (attr_name == print_name) {
				$(this).removeClass("ns-bg-color-gray");
				$(this).css("cursor", "pointer");
			}
		});
	}
	
	function back(){
		location.href = ns.url("admin/express/expressCompany");
	}
</script>

</body>
</html>