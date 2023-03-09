<?php /*a:2:{s:57:"/www/wwwroot/ls.chnssl.com/app/shop/view/album/lists.html";i:1614516186;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/shop/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		.layui-logo{height: 100%;display: flex;align-items: center;}
		.layui-logo a{display: flex;justify-content: center;align-items: center;width: 200px;height: 50px;}
		.layui-logo a img{max-height: 100%;max-width: 100%;}
		.goods-preview .qrcode-wrap {max-width: 130px;  overflow: hidden;}
		.goods-preview .qrcode-wrap input {top: 300px;position: absolute;}
		@media only screen and (max-width: 1340px) {
			.layui-nav .layui-nav-item a {
				padding: 0 15px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 1200px) {
			.layui-nav .layui-nav-item a {
				padding: 0 10px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 920px) {
			.layui-nav .layui-nav-item a {
				padding: 0 5px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 1090px) {
			.ns-shop-ewm {
				display: none;
			}
		}
		.copy_link{cursor:pointer;}
		.goods-preview{position: relative;}
		.pic_big{display:none;width:220px !important;height:220px !important;margin:auto;position: absolute;left:0;top:0;z-index:100;}
		.pic_ori:hover .pic_big{display:block;}
	</style>
	
<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/shop/view/public/css/picture_manager.css" />

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="https://ls.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="https://ls.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<?php endif; ?>
				</a>
			</div>
			<ul class="layui-nav layui-layout-left">
				<?php foreach($menu as $menu_k => $menu_v): ?>
				<li class="layui-nav-item">
					<a href="<?php echo htmlentities($menu_v['url']); ?>" <?php if($menu_v['selected']): ?>class="active"<?php endif; ?>>
						<span><?php echo htmlentities($menu_v['title']); ?></span>
					</a>
				</li>
				<?php if($menu_v['selected']): 
					$second_menu = $menu_v["child_list"];
					 ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			
			<!-- 账号 -->
			<div class="ns-login-box layui-layout-right">
				<div class="ns-shop-ewm"> 
					<a href="#" onclick="getShopUrl()">访问店铺</a>
				</div>
				
				<ul class="layui-nav ns-head-account">
					<li class="layui-nav-item layuimini-setting">
						<a href="javascript:;">
							<?php echo htmlentities($user_info['username']); ?></a>
						<dl class="layui-nav-child">
							<dd class="ns-reset-pass" onclick="resetPassword();">
								<a href="javascript:;">修改密码</a>
							</dd>
							<dd>
								<a href="<?php echo addon_url('shop/login/logout'); ?>" class="login-out">退出登录</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
		
		
		
		<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
		<div class="layui-side ns-second-nav">
			<div class="layui-side-scroll">
				
				<!--二级菜单 -->
				<ul class="layui-nav layui-nav-tree">
					<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
					<li class="layui-nav-item <?php if($menu_second_v['selected']): ?>layui-this layui-nav-itemed<?php endif; ?>">
						<a href="<?php if(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty())): ?><?php echo htmlentities($menu_second_v['url']); else: ?>javascript:;<?php endif; ?>" class="layui-menu-tips">
							<div class="stair-menu<?php if($menu_v['selected']): ?> ative<?php endif; ?>">
								<img src="https://ls.chnssl.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
							</div>
							<span><?php echo htmlentities($menu_second_v['title']); ?></span>
						</a>
						
						<?php if(!(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty()))): ?>
						<dl class="layui-nav-child">
							<?php foreach($menu_second_v["child_list"] as $menu_third_k => $menu_third_v): ?>
							<dd class="<?php if($menu_third_v['selected']): ?> layui-this<?php endif; ?>">
								<a href="<?php echo htmlentities($menu_third_v['url']); ?>" class="layui-menu-tips">
									<i class="fa fa-tachometer"></i><span class="layui-left-nav"><?php echo htmlentities($menu_third_v['title']); ?></span>
								</a>
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
		
		
		<!-- 面包屑 -->
		
		<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
		<div class="ns-crumbs<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?> submenu-existence<?php endif; ?>">
			<span class="layui-breadcrumb" lay-separator="-">
				<?php foreach($crumbs as $crumbs_k => $crumbs_v): if(count($crumbs) >= 3): if($crumbs_k == 1): ?>
					<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
					<?php endif; if($crumbs_k == 2): ?>
					<a><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
					<?php endif; else: if($crumbs_k == 1): ?>
					<a><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
					<?php endif; ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</span>
		</div>
		<?php endif; if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?>
		<div class="ns-body layui-body" style="left: 0; top: 60px;">
		<?php else: ?>
		<div class="ns-body layui-body">
		<?php endif; ?>
			<!-- 内容 -->
			<div class="ns-body-content">
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
			
				
<!-- 搜索框 -->
<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="uploadImg()">上传图片</button>

    <div class="layui-form">
        <div class="layui-input-inline">
            <input type="text" name="search_keys" placeholder="请输入图片名称" autocomplete="off" class="layui-input album-img-sreach">
            <button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
                <i class="layui-icon">&#xe615;</i>
			</button>
		</div>
	</div>
</div>

<div class="album-box">
	<ul class="album-list ns-bg-color-light-gray">
		<li><button class="layui-btn layui-btn-primary ns-text-color ns-border-color" onclick="addGrouping()">添加分组</button></li>
	</ul>
	<div class="album-content">
		<div class="album-content-title">
			<span id="album_name">默认分组</span>
			<span>|</span>
			<a href="javascript:modifyGrouping();" class="ns-text-color">重命名</a>
			<a href="javascript:deleteGrouping();" class="ns-text-color">删除分组</a>
		</div>
		
		<ul class="album-img-box"></ul>
		
		<div class="album-foot-operation">
			<div class="album-content-bar layui-form ns-bg-color-light-gray">
				<input type="checkbox" name="album-select" lay-filter="allChoose" lay-skin="primary" title="全选">
			</div>
			<button class="layui-btn ns-bg-color" onclick="modifyImgGroup()">修改分组</button>
			<button class="layui-btn ns-bg-color" onclick="deleteImg()">删除</button>
			<div id="paged" class="page"></div>
		</div>
	</div>
	<!-- 存储图片路径 -->
	<input type="hidden" id="hidden_image_path">
</div>


			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

		<!--	<div class="ns-footer">
				
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
				
			</div>-->

		</div>
		<!-- </div>	 -->
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
		$("body").on("mouseenter",".pic_ori",function(){
			$(".pic_big").show();
		});
		$("body").on("mouseleave",".pic_ori",function(){
			$(".pic_big").hide();
		});
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
				url: ns.url("shop/login/modifypassword"),
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
		
		layui.use('element', function() {
			var element = layui.element;
			element.init();
		});

		function getShopUrl(e) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: ns.url("shop/shop/shopUrl"),
				success: function(res) {
					if(res.data.path.h5.status == 1) {
						layui.use('laytpl', function(){
							var laytpl = layui.laytpl;
							
							laytpl($("#shop_h5_preview").html()).render(res.data, function (html) {
								var layerIndex = layer.open({
									title: '访问店铺',
									skin: 'layer-tips-class',
									type: 1,
									area: ['600px', '600px'],
									content: html,
								});
							});
						})
					} else {
						layer.msg(res.data.path.h5.message);
					}
				}
			});
		}
		
	</script>
	
	<!-- 店铺预览 -->
	<script type="text/html" id="shop_h5_preview">
		<div class="goods-preview">
			<img src="{{# if(d.path.weapp.img){ }}{{ ns.img(d.path.weapp.img) }}{{# } }}" alt="推广二维码" class="pic_big">
			<div class="qrcode-wrap">
				{{# if(d.path.h5.img){ }}
				<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
				<p class="tips ns-text-color">扫码访问店铺 <a class="copy_link ns-text-color" href="javascript:ns.copy('h5_preview_1');">复制链接</a></p>
				<br/>
				<input type="text" id="h5_preview_1" value="{{d.path.h5.url}}" readonly />
				{{# } }}
				{{# if(d.path.weapp.img){ }}
				<img src="{{ ns.img(d.path.weapp.img) }}" alt="推广二维码"  class="pic_ori">
				<p class="tips ns-text-color">扫码访问店铺</p>
				{{# } }}
			</div>
			<div class="phone-wrap">
				<div class="iframe-wrap">
					<iframe src="{{ d.path.h5.url }}&preview=1" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</script>


<!-- 多图上传 -->
<script type="text/html" id="multuple_html">
	<div class="layui-form multuple-list-box">
		<div class="layui-form-item">
			<label class="layui-form-label sm">本地图片</label>
			<ul class="layui-input-block multuple-list">
				<li class="multuple-list-img" id="ImgUpload">
					<span class="ns-bg-color">+</span>
					<span class="ns-text-color-black">点击添加图片</span>
				</li>
			</ul>
		</div>
		<div class="ns-form-row sm">
			<button class="layui-btn layui-btn-disabled" disabled="disabled" id="chooseListAction">提交</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>
	</div>
</script>

<!-- 相册展示 -->
<script type="text/html" id="list_html">
	{{# layui.each(d.list,function(index, item){ }}
    <li>
        <div class="album-pic">
            <img layer-src src="{{ ns.img(item.pic_path + '?time=' + parseInt(new Date().getTime()/1000)) }}" alt="{{item.pic_name}}">
        </div>
        <div class="layui-form album-img-select">
            <input type="checkbox" name="check[]" value="{{item.pic_id}}" lay-skin="primary" title="{{item.pic_name}}">
        </div>
        <div class="album-img-operation">
            <a href="javascript:;" class="ns-text-color" data-pic-name="{{item.pic_name}}" data-id="{{item.pic_id}}" onclick="modifyImgName(this)">改名</a>|
            <a href="javascript:;" class="ns-text-color" data-path="{{ns.img(item.pic_path)}}" onclick="copyLink(this)">链接</a>|
            <a href="javascript:;" class="ns-text-color" data-id="{{item.pic_id}}" onclick="modifyImgGroup(this)">分组</a>|
			<a href="javascript:;" class="ns-text-color" data-id="{{item.pic_id}}" onclick="modifyFile(this)">替换</a>|
            <a href="javascript:;" class="ns-text-color" data-id="{{item.pic_id}}" onclick="deleteImg(this)">删除</a>
        </div>

    </li>
    {{# }) }}
</script>

<!-- 图片分组 -->
<script type="text/html" id="pic_group">
	<div class="layui-form img-group">
        <?php foreach($album_list as $album_list_k => $album_list_v): ?>
        <div class="layui-input-block">
            {{# if(d == <?php echo htmlentities($album_list_v['album_id']); ?> ){ }}
            <input type="radio" name="group" checked value="<?php echo htmlentities($album_list_v['album_id']); ?>" title="<?php echo htmlentities($album_list_v['album_name']); ?>">
            {{# }else{ }}
            <input type="radio" name="group" value="<?php echo htmlentities($album_list_v['album_id']); ?>" title="<?php echo htmlentities($album_list_v['album_name']); ?>">
            {{# } }}
        </div>
        <?php endforeach; ?>
    </div>
</script>

<!-- 替换图片 -->
<script type="text/html" id="modify_file_html">
	<div class="layui-form multuple-list-box">
		<div class="layui-form-item">
			<label class="layui-form-label sm">本地图片</label>
			<ul class="layui-input-block multuple-list">
				<li class="multuple-list-img" id="modifyFile">
					<span class="ns-bg-color">+</span>
					<span class="ns-text-color-black">点击添加图片</span>
				</li>
			</ul>
		</div>
		<div class="ns-form-row sm">
			<button class="layui-btn layui-btn-disabled" disabled="disabled" id="modifyFileAction">提交</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>
	</div>
</script>

<!-- 复制链接 -->
<script type="text/html" id="copy_path">
	<div class="layui-form">
        <div class="layui-input-block">
            <input type="text" class="ns-len-long layui-input ns-link-input" name="" id="path_file" value="{{d}}" readonly >
            <button class="layui-btn layui-btn-primary" onclick="JScopy()">复制</button>
        </div>
    </div>
</script>

<script>
	var form, upload, laytpl, layer, laypage, layer_one,
		picture_arr = [],
		uploadListIns,
		limit = 14,
		album_id = $(".album-list li.item-this").attr("data-album");

	$(function() {
		layui.use(['form', 'laytpl', 'laypage', 'layer', 'upload'], function() {
			form = layui.form;
			laytpl = layui.laytpl;
			laypage = layui.laypage;
			layer = layui.layer;
			upload = layui.upload;
			
			form.render();
			init(); //初始化数据

			//监听图片搜索
			form.on('submit(search)', function() {
				getFileAlbumList(1, limit); //图片加载
			});

			//分组切换
			$(".album-list .group-item").click(function() {
				$(this).addClass("item-this").siblings().removeClass("item-this");
				album_id = $(this).attr("data-album");
				album_name = $(this).data('album_name');
				$("#album_name").empty().html(album_name);
				getFileAlbumList(1, limit);
			});

			/**
			 * 全选
			 */
			form.on("checkbox(allChoose)", function(data) {
				$("input[name='check[]']").each(function() {
					this.checked = data.elem.checked;
				});
				form.render('checkbox');
			})
		});
	});

	/**
	 * 初始化数据
	 */
	function init() {
		albumList(); //相册分组
		getFileAlbumList(1, limit); //图片加载
	}
	
	/**
	 * 替换图片，单张
	 */
	function modifyFile(data) {

		laytpl($("#modify_file_html").html()).render({}, function(html) {
			layer_one = layer.open({
				type: 1,
				area: ['580px', '430px'],
				title: '替换图片',
				content: html,
				cancel: function() {
					$("#modifyFileAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
				},
				success: function(res) {

					//上传图片
					upload.render({
						elem: '#modifyFile',
						url: ns.url("shop/album/modifyFile"),
						data: {
							album_id: album_id,
							pic_id: $(data).attr('data-id')
						},
						multiple: true,
						auto: false,
						bindAction: '#modifyFileAction',
						choose: function(obj) {
							//将每次选择的文件追加到文件队列
							var files = this.files = obj.pushFile();

							//预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
							obj.preview(function(index, file, result) {

								//追加预览图片
								var html = '';
								html += '<li class="multuple-list-img nc-upload-wrap" index="' + index + '">';
								html += '<img src="' + result + '" alt="' + file.name + '">';
								html += '<span class="upload-close-modal"  id="upload_img_' + index + '">×</span>';
								html += '<div class="upload-image-curtain">50%</div>';
								html += '</li>';
								$(".multuple-list").prepend(html);

								//删除预览图片
								$("#upload_img_" + index).bind("click", function() {
									delete files[index];
									delete picture_arr[index]; //删除所选队列
									$(this).parent('.nc-upload-wrap').remove();

									// uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选

									//禁止点击
									if ($(".multuple-list li").length <= 1) {
										$("#modifyFileAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled",
												"disabled");
										//未选择图片时，显示添加按钮
										$("#modifyFile").show();
									}

								});

								//禁止点击
								if ($(".multuple-list li").length > 1) {
									$("#modifyFileAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr(
											"disabled");
									//隐藏添加按钮，仅替换一张图片
									$("#modifyFile").hide();
								}
							});
						},
						done: function(res, index) {
							picture_arr.push(res.data);

							var image_box = $(".nc-upload-wrap[index='" + index + "']").parent().find(".upload-image-curtain");
							image_box.text("50%");
							image_box.show();

							if (res.code >= 0) {
								setTimeout(function() {
									image_box.text("100%");
								}, 500);
								setTimeout(function() {
									getFileAlbumList(1, limit);
									location.reload();
									layer.close(layer_one);
								}, 1000);
								return delete this.files[index]; //删除文件队列已经上传成功的文件
							} else {
								setTimeout(function() {
									image_box.text("上传失败");
								}, 500);
								laytpl.msg(res.message); //删除文件队列已经上传成功的文件
							}
						}
					});

				}
			})
		});

	}
	
	/**
	 * 多图上传
	 */
	function uploadImg() {

		laytpl($("#multuple_html").html()).render({}, function(html) {
			layer_one = layer.open({
				type: 1,
				area: ['580px', '430px'],
				title: '本地上传',
				content: html,
				cancel: function() {
					$("#chooseListAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
				},
				success: function(res) {
					//上传图片
					upload.render({
						elem: '#ImgUpload',
						url: ns.url("shop/upload/album"),
						data: {
							album_id: album_id
						},
						multiple: true,
						auto: false,
						bindAction: '#chooseListAction',
						choose: function(obj) {
							//将每次选择的文件追加到文件队列
							var files = this.files = obj.pushFile();

							//预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
							obj.preview(function(index, file, result) {

								//追加预览图片
								var html = '';
								html += '<li class="multuple-list-img nc-upload-wrap" index="' + index + '">';
								html += '<img src="' + result + '" alt="' + file.name + '">';
								html += '<span class="upload-close-modal"  id="upload_img_' + index + '">×</span>';
								html += '<div class="upload-image-curtain">50%</div>';
								html += '</li>';
								$(".multuple-list").prepend(html);

								//删除预览图片
								$("#upload_img_" + index).bind("click", function() {
									delete files[index];
									delete picture_arr[index]; //删除所选队列
									$(this).parent('.nc-upload-wrap').remove();
									// uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选

									//禁止点击
									if ($(".multuple-list li").length <= 1) {
										$("#chooseListAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
									}
								});

								//禁止点击
								if ($(".multuple-list li").length > 1) {
									$("#chooseListAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr("disabled");
								}
							});
						},
						done: function(res, index) {
							picture_arr.push(res.data);

							var image_box = $(".nc-upload-wrap[index='" + index + "']").parent().find(".upload-image-curtain");
							image_box.text("50%");
							image_box.show();

							if (res.code >= 0) {
								setTimeout(function() {
									image_box.text("100%");
								}, 500);
								setTimeout(function() {
									getFileAlbumList(1, limit);
									// location.reload();
									layer.close(layer_one);
								}, 1000);
								return delete this.files[index]; //删除文件队列已经上传成功的文件
							} else {
								setTimeout(function() {
									image_box.text("上传失败");
								}, 500);
								laytpl.msg(res.message); //删除文件队列已经上传成功的文件
							}
						}
						,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
							$("#chooseListAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
						}
						,allDone: function(obj){
							$("#chooseListAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr("disabled");
						},error: function(index, upload){
							$("#chooseListAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr("disabled");
						}
					});

				}
			})
		});

	}

	/**
	 * 图片加载
	 */
	function getFileAlbumList(page, limit) {

		$.ajax({
			url: ns.url("shop/Album/lists"),
			type: "POST",
			dataType: "JSON",
			async: false,
			data: {
				album_id: album_id,
				pic_name: $(".album-img-sreach").val(),
				limit: limit,
				page: page
			},
			success: function(res) {

				laytpl($("#list_html").html()).render(res.data, function(html) {
					$(".album-img-box").html(html);
					loadImgMagnify();
				});
				
				$("#paged").empty();
				if (res.data.count > 0) {
					//调用分页
					laypage.render({
						elem: "paged",
						count: res.data.count,
						curr: page, //当前页
						limit: limit,
						jump: function(obj, first) {
							if (!first) {
								getFileAlbumList(obj.curr, obj.limit);
							}
							form.render('checkbox');
						}
					})
				}
			}
		})
	}

	/**
	 * 相册分组
	 */
	function albumList() {
        $.ajax({
			url: ns.url("shop/Album/getAlbumList"),
			type: 'POST',
			async: false,
			dataType: 'JSON',
			success: function(res) {
				var albumList = res.data,
					html = "";

				for (key in albumList) {
					if (Number(key) == 0) {
						album_id = albumList[key].album_id;
						html += '<li class="item-this group-item" data-album=' + albumList[key].album_id +
							' data-album_name=' + albumList[key].album_name + '><span class="ns-text-color-black">' + albumList[key].album_name +
							'</span><sapn class="num ns-text-color-dark-gray">' + albumList[key].num + '</sapn></li>';
					} else {
						html += '<li class="group-item" data-album=' + albumList[key].album_id + ' data-album_name=' + albumList[key].album_name + '><span class="ns-text-color-black">' +
							albumList[key].album_name + '</span><sapn class="num ns-text-color-dark-gray">' + albumList[key].num +
							'</sapn></li>';
					}
				}
				$(".album-list").prepend(html);
			}
		});
    }

	/**
	 * 添加分组
	 */
	var flag_add_group = false;

	function addGrouping() {

		var laryer_add = layer.prompt({
			formType: 3,
			title: '添加分组',
			area: ["350px"]
		}, function(value) {
			if (flag_add_group) return;
			flag_add_group = true;

			$.ajax({
				url: ns.url("shop/Album/addAlbum"),
				data: {
					"album_name": value
				},
				type: "POST",
				dataType: "JSON",
				success: function(res) {
					layer.msg(res.message);
					flag_add_group = false;

					if (res.code == 0) {
						location.reload();
					}
				}
			})
		})
	}

	/**
	 * 修改分组
	 */
	var flag_modify_group = false;

	function modifyGrouping() {

		layer.prompt({
			formType: 3,
			title: '修改分组名称',
			area: ["350px"]
		}, function(value) {
			if (flag_modify_group) return;
			flag_modify_group = true;

			$.ajax({
				url: ns.url("shop/Album/editAlbum"),
				data: {
					"album_name": value,
					album_id: album_id
				},
				type: "POST",
				dataType: "JSON",
				success: function(res) {
					layer.msg(res.message);
					flag_modify_group = false;

					if (res.code == 0) {
						location.reload();
					}
				}
			})
		})
	}

	/**
	 * 删除分组
	 */
	var flag_delete_group = false;

	function deleteGrouping() {

		layer.confirm('如果分组内有图片则不可删除！请将图片移动到其他分组再进行选择！', {
			btn: ['确定', '取消']
		}, function() {
			if (flag_delete_group) return;
			flag_delete_group = true;
			$.ajax({
				type: "POST",
				async: true,
				url: ns.url("shop/Album/deleteAlbum"),
				data: {
					album_id: album_id
				},
				dataType: "JSON",
				success: function(data) {
					flag_delete_group = false;

					layer.msg(data.message);

					if (data.code == 0) {
						location.reload();
					}
				}
			});
		}, function() {
			layer.close();
		});
	}

	/**
	 * 修改图片名字
	 */
	var flag_modify_pic;

	function modifyImgName(data) {
		layer.prompt({
			formType: 3,
			title: '修改图片名称',
			area: ["640px"],
			value: $(data).attr('data-pic-name'),
		}, function(value) {
			if (flag_modify_pic) return;
			flag_modify_pic = true;

			$.ajax({
				url: ns.url("shop/Album/modifyPicName"),
				data: {
					pic_name: value,
					pic_id: $(data).attr('data-id'),
					album_id: album_id,
				},
				type: "POST",
				dataType: "JSON",
				success: function(res) {
					layer.msg(res.message);
					flag_modify_pic = false;

					if (res.code == 0) {
                        getFileAlbumList(1, limit);
                        layer.closeAll('page');
					}
				}
			})
		})
	}
	
	/**
	 * 修改图片分组
	 */
	function modifyImgGroup(data) {
		var pic_ids = [],
			url = '';
		
		if (!data) {
			$("input[name='check[]']:checked").each(function(index, item) {
				pic_ids.push($(item).val());
			});
		}else{
			pic_ids.push($(data).attr("data-id"));
		}
		url = ns.url("shop/Album/modifyFileAlbum");

		laytpl($("#pic_group").html()).render(album_id, function(html) {
			layer.open({
				type: 1,
				title: '修改图片分组',
				area: ["350px"],
				btn: ['保存', '取消'],
				content: html,
				yes: function(index, layero) {
					$.ajax({
						url: url,
						type: 'POST',
						async: false,
						dataType: 'JSON',
						data: {
							pic_id: pic_ids.toString(),
							album_id: $(".img-group input[name='group']:checked").val(),
						},
						success: function(res) {
							layer.msg(res.message);
							if (res.code == 0) {
                                location.reload();
							}
						}
					})
				}
			});
			form.render();
		})

	}

	/**
	 * 删除图片
	 */
	var flag_delete_img = false;

	function deleteImg(data) {
		var pic_ids = [],
			url = '';
		if (!data) {
			$("input[name='check[]']:checked").each(function(index, item) {
				pic_ids.push($(item).val());
			});
		}else{
			pic_ids.push($(data).attr("data-id"));
		}
		if(pic_ids.length<=0){
			layer.msg('请至少选择一张图片');
			return false;
		}
		pic_ids = pic_ids.toString();
		url = ns.url("shop/Album/deleteFile");

		layer.confirm('若删除，不会对目前已使用该图片的相关业务造成影响。', {
			btn: ['确定', '取消']
		}, function() {
			if (flag_delete_img) return;
			flag_delete_img = true;
			$.ajax({
				type: "POST",
				async: true,
				url: url,
				data: {
					pic_id: pic_ids,
					album_id: album_id
				},
				dataType: "JSON",
				success: function(data) {
					flag_delete_img = false;

					layer.msg(data.message);

					if (data.code == 0) {
						location.reload();
					}
				}
			});
		}, function() {
			layer.close();
		});
	}

	/**
	 * 链接
	 */
	function copyLink(data) {
		laytpl($("#copy_path").html()).render($(data).attr("data-path"), function(html) {
			layer.open({
				type: 1,
				area: ["800px"],
				title: '复制链接',
				content: html,
			})
		})
	}

	function JScopy() {
		ns.copy("path_file", function(res) {
			$("#hidden_image_path").val(res.url);
		});
	}
</script>

</body>

</html>