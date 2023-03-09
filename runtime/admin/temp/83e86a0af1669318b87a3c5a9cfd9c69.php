<?php /*a:2:{s:68:"/www/wwwroot/ls.chnssl.com/app/admin/view/community/goods/lists.html";i:1657517003;s:51:"/www/wwwroot/ls.chnssl.com/app/admin/view/base.html";i:1654841781;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/goods_lists.css">
<style>
    .export-record{margin-left:20px;}
	.promotion-addon span {
		border-radius: 3px;
		border: 1px solid;
		font-size: 12px;
		line-height: 14px;
		padding: 2px 4px;
		margin-right: 3px;
		margin-top: 3px;
		color: #FFFFFF;
	}
	.btn-color{
		color:#FF6A00;
		cursor: pointer;
	}
	.btn-color:hover{
		color:#FF6A00;
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
				
<div class="ns-tips layui-collapse">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>当前显示的是已经审核通过的商品</li>
			<li>如果商家的商品操作违规，平台可以操作违规下架，违规下架的商品需要商家编辑审核之后才能重新上架</li>
		</ul>
	</div>
</div>

<!-- 按钮容器 -->
<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="add()">添加商品</button>
</div>

<!-- 筛选面板 -->
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">商品名称：</label>
					<div class="layui-input-inline">
						<input type="text" name="search_text" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">店内分类：</label>
					<div class="layui-input-inline">
						<select name="goods_shop_category_ids" lay-filter="goods_shop_category_ids">
							<option value="0" data-level="0">顶级分类</option>
							<?php if(is_array($goods_shop_category_list) || $goods_shop_category_list instanceof \think\Collection || $goods_shop_category_list instanceof \think\Paginator): if( count($goods_shop_category_list)==0 ) : echo "" ;else: foreach($goods_shop_category_list as $key=>$vo): ?>
							<option value="<?php echo htmlentities($vo['category_id']); ?>" data-level="<?php echo htmlentities($vo['level']); ?>"><?php echo htmlentities($vo['category_name']); ?></option>
								<?php if(!(empty($vo['child_list']) || (($vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator ) && $vo['child_list']->isEmpty()))): if(is_array($vo['child_list']) || $vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator): if( count($vo['child_list'])==0 ) : echo "" ;else: foreach($vo['child_list'] as $key=>$vo_child): ?>
								<option value="<?php echo htmlentities($vo_child['category_id']); ?>" data-level="<?php echo htmlentities($vo_child['level']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($vo_child['category_name']); ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								<?php endif; ?>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">销量：</label>
					<div class="layui-input-inline">
						<input type="number" name="start_sale" id="start_sale" lay-verify="int" placeholder="最低销量" class="layui-input" autocomplete="off">
					</div>
					<div class="layui-form-mid">-</div>
					<div class="layui-input-inline">
						<input type="number" name="end_sale" id="end_sale" lay-verify="int" placeholder="最高销量" class="layui-input" autocomplete="off">
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">商品类型：</label>
					<div class="layui-input-inline">
						<select name="goods_class" lay-filter="goods_class">
							<option value="">全部</option>
							<option value="1">实物商品</option>
							<option value="2">虚拟商品</option>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">营销活动：</label>
					<div class="layui-input-inline">
						<select name="promotion_type" lay-filter="promotion_type">
							<option value="">全部</option>
							<?php if(is_array($promotion_type) || $promotion_type instanceof \think\Collection || $promotion_type instanceof \think\Paginator): if( count($promotion_type)==0 ) : echo "" ;else: foreach($promotion_type as $key=>$vo): ?>
							<option value="<?php echo htmlentities($vo['type']); ?>"><?php echo htmlentities($vo['name']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
			</div>

			<input type="hidden" name="goods_state" />
			<input type="hidden" name="verify_state" />
			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="export">导出商品</button>
                <a class='layui-btn layui-btn-primary' href='<?php echo addon_url("shop/goods/export"); ?>' target="_blank">商品导出记录</a>
			</div>
		</form>
	</div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="goods_list_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="">全部</li>
		<li lay-id="1" data-type="goods_state">销售中</li>
		<li lay-id="0" data-type="goods_state">仓库中</li>

	</ul>
	<div class="layui-tab-content">
		<table id="goods_list" lay-filter="goods_list"></table>
	</div>
</div>

<!-- 商品信息 -->
<script type="text/html" id="goods_info">
	<div class="ns-table-title">
		<div class="contraction" data-goods-id="{{d.goods_id}}" data-open="0">
			<span>+</span>
		</div>
		<div class="ns-title-pic" id="goods_img_{{d.goods_id}}">
			<img layer-src src="{{ns.img(d.goods_image.split(',')[0], 'small')}}"/>
		</div>
		<div class="ns-title-content">
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.goods_name}}" lay-event="preview">{{d.goods_name}}</a>
			{{# if(d.promotion_addon && d.promotion_addon_list){ }}
			<div class="promotion-addon">
				{{# for(var i=0;i<d.promotion_addon_list.length;i++){ }}
				<a href="{{ns.url( d.promotion_addon_list[i].shop_url )}}"><span class="ns-bg-color" title="{{d.promotion_addon_list[i].name}}">{{ d.promotion_addon_list[i].short }}</span></a>
				{{# } }}
			</div>
			{{# } }}
		</div>
	</div>
</script>

<!-- 操作 -->
<script type="text/html" id="action">
	<div class="operation-wrap" data-goods-id="{{d.goods_id}}">
		<div class="popup-qrcode-wrap"><img class="popup-qrcode-loadimg" src="https://ls.chnssl.com/public/static/loading/loading.gif" /></div>
		<div class="ns-table-btn">
			{{# if(d.verify_state == 1 && d.goods_state == 1){ }}
			<!--<a class="layui-btn" lay-event="select">推广</a>-->
			<a class="layui-btn" lay-event="edit">编辑</a>
			<a class="layui-btn" lay-event="delete">删除</a>
			<a class="layui-btn" lay-event="off_goods">下架</a>
			{{# } else if(d.verify_state == 1 && d.goods_state == 0){ }}
			<!--<a class="layui-btn" lay-event="select">推广</a>-->
			<a class="layui-btn" lay-event="edit">编辑</a>
			<a class="layui-btn" lay-event="delete">删除</a>
			<a class="layui-btn" lay-event="on_goods">上架</a>
			{{# } else if(d.verify_state == 0){ }}
			<a class="layui-btn" lay-event="edit">编辑</a>
			<a class="layui-btn" lay-event="delete">删除</a>
			{{# }else{ }}
			<a class="layui-btn" lay-event="edit">编辑</a>
			<a class="layui-btn" lay-event="delete">删除</a>
			{{# } }}
			<a class="layui-btn" lay-event="copy">复制</a>
			<a class="layui-btn" lay-event="browse_records">浏览记录</a>
		</div>
	</div>
</script>
<!-- 批量操作 -->
<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="delete">批量删除</button>
	<button class="layui-btn layui-btn-primary" lay-event="batch_set">批量设置</button>
</script>
<!-- 批量操作 -->
<script type="text/html" id="batchOperation">
	<button class="layui-btn layui-btn-primary" lay-event="delete">批量删除</button>
	<button class="layui-btn layui-btn-primary" lay-event="batch_set">批量设置</button>
</script>

<!-- SKU商品列表 -->
<script type="text/html" id="skuList">
	<tr class="js-sku-list-{{d.index}}" id="sku_img_{{d.index}}">
		<td></td>
		<td colspan="7">
			<ul class="sku-list">
				{{# for(var i=0;i<d.list.length;i++){ }}
				<li>
					<div class="img-wrap">
						<img layer-src src="{{ns.img(d.list[i].sku_image, 'small')}}">
					</div>
					<div class="info-wrap">
						<span class="sku-name">{{d.list[i].sku_name}}</span>
						<span class="price">价格：￥{{d.list[i].price}}</span>
						<span class="stock">库存：{{d.list[i].stock}}</span>
						<span class="sale_num">销量：{{d.list[i].sale_num}}</span>
					</div>
				</li>
				{{# } }}
			</ul>
		</td>
	</tr>
</script>

<!-- 商品推广 -->
<script type="text/html" id="goods_url">
	{{# if(d.path.h5.status == 1){ }}
	<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
	<p class="qrcode-item-description">扫码后直接访问商品</p>
	<a class="ns-text-color" href="javascript:ns.copy('h5_url_{{ d.goods_id }}');">复制链接</a>
	<a class="ns-text-color" href="{{ ns.img(d.path.h5.img) }}" download>下载二维码</a>
	<input class="layui-input nc-len-mid" type="text" value="{{ d.path.h5.url }}" id="h5_url_{{ d.goods_id }}" readonly>
	{{# } }}
</script>

<!-- 商品预览 -->
<script type="text/html" id="goods_preview">
	<div class="goods-preview">
		<div class="qrcode-wrap">
			<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
			<p class="tips ns-text-color">手机扫码购买</p>
		</div>
		<div class="phone-wrap">
			<div class="iframe-wrap">
				<iframe src="{{ d.path.h5.url }}&preview=1" frameborder="0"></iframe>
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


<!-- 编辑库存html -->
<script type="text/html" id="edit_stock">
	<div class="layui-form" id="edit_stock_block" lay-filter="form">
		<table class="layui-table" lay-skin="line">
			<colgroup>
				<col width="16%">
				<col width="12%">
				<col width="12%">
				<col width="12%">
				<col width="12%">
				<col width="12%">
				<col width="12%">
				<col width="12%">
			</colgroup>
			<thead>
				<tr>
					<th>sku名称</th>
					<th>销售价</th>
					<th>划线价</th>
					<th>成本价</th>
					<th>库存</th>
					<th>重量(kg)</th>
					<th>体积(m³)</th>
					<th>sku编码</th>
				</tr> 
			</thead>
			<tbody>
				{{#  layui.each(d, function(index, item){ }}
				<tr>
					<td><input type="hidden" name="sku_list[{{index}}][sku_id]" value="{{ item.sku_id }}" class="layui-input">{{ item.sku_name }}</td>
					<td><input type="number" name="sku_list[{{index}}][price]" value="{{ item.price }}" class="layui-input" lay-verify="flo"></td>
					<td><input type="number" name="sku_list[{{index}}][market_price]" value="{{ item.market_price }}" class="layui-input" lay-verify="flo"></td>
					<td><input type="number" name="sku_list[{{index}}][cost_price]" value="{{ item.cost_price }}" class="layui-input" lay-verify="flo"></td>
					<td><input type="number" name="sku_list[{{index}}][stock]" value="{{ item.stock }}" class="layui-input" lay-verify="int"></td>
					<td><input type="number" name="sku_list[{{index}}][weight]" value="{{ item.weight }}" class="layui-input" lay-verify="flo"></td>
					<td><input type="number" name="sku_list[{{index}}][volume]" value="{{ item.volume }}" class="layui-input" lay-verify="flo"></td>
					<td><input type="text" name="sku_list[{{index}}][sku_no]" value="{{ item.sku_no }}" class="layui-input"></td>
				</tr>
				{{#  }); }}
			</tbody>
		</table>
		
		<div class="ns-form-row">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="edit_stock">确定</button>
			<button class="layui-btn layui-btn-primary" onclick="closeStock()">返回</button>
		</div>
	</div>
</script>

<!-- 批量操作 -->
<script type="text/html" id="batchSet">
	<div class="batch-set-wrap">
		<div class="tips">每次仅能设置一项，点击保存成功之后生效</div>
		<div class="set-wrap">
			<div class="tab-wrap">
				<ul>
					<li class="active" data-type="category">分类</li>
					<li data-type="shop_category">店内分类</li>
					<li data-type="limit">起售 / 限购</li>
					<li data-type="shipping">包邮设置</li>
				</ul>
			</div>
			<div class="content-wrap">
				<div class="tab-item tab-show category">
					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">分类：</label>
							<div class="layui-input-block">
								<div class="layui-input-inline">
									<select name="batch_category">
										<option value="0">请选择分类</option>
										<?php foreach($category_list as $category_k => $category_v): ?>
											<option value="<?php echo htmlentities($category_v['category_id']); ?>"  data-level="<?php echo htmlentities($category_v['level']); ?>" ><?php echo htmlentities($category_v['category_name']); ?></option>
											<?php if(!(empty($category_v['child_list']) || (($category_v['child_list'] instanceof \think\Collection || $category_v['child_list'] instanceof \think\Paginator ) && $category_v['child_list']->isEmpty()))): if(is_array($category_v['child_list']) || $category_v['child_list'] instanceof \think\Collection || $category_v['child_list'] instanceof \think\Paginator): if( count($category_v['child_list'])==0 ) : echo "" ;else: foreach($category_v['child_list'] as $key=>$second_child): ?>
													<option value="<?php echo htmlentities($second_child['category_id']); ?>" data-level="<?php echo htmlentities($second_child['level']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($second_child['category_name']); ?></option>
													<?php if(!(empty($second_child['child_list']) || (($second_child['child_list'] instanceof \think\Collection || $second_child['child_list'] instanceof \think\Paginator ) && $second_child['child_list']->isEmpty()))): if(is_array($second_child['child_list']) || $second_child['child_list'] instanceof \think\Collection || $second_child['child_list'] instanceof \think\Paginator): if( count($second_child['child_list'])==0 ) : echo "" ;else: foreach($second_child['child_list'] as $key=>$third_child): ?>
															<option value="<?php echo htmlentities($third_child['category_id']); ?>" data-level="<?php echo htmlentities($third_child['level']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($third_child['category_name']); ?></option>
														<?php endforeach; endif; else: echo "" ;endif; ?>
													<?php endif; ?>
											<?php endforeach; endif; else: echo "" ;endif; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-item shop_category">
					<div class="layui-form">
						<div class="layui-form-item ">
							<label class="layui-form-label">店内分类：</label>
							<div class="layui-input-block">
								<div class="layui-input-inline js-goods-shop-category"></div>
								<button class="layui-btn layui-btn-primary add_shop_category">添加</button>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-item limit">
					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">商品限购：</label>
							<div class="layui-input-block">
								<input type="number" name="batch_max_buy" value="0" lay-verify="max_buy" class="layui-input ns-len-short" autocomplete="off">
								<div class="layui-form-mid">/件</div>
							</div>
							<div class="ns-word-aux">该限购为终身限购，0为不限购</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商品起售：</label>
							<div class="layui-input-block">
								<input type="number" name="batch_min_buy" value="0" lay-verify="min_buy" class="layui-input ns-len-short" autocomplete="off">
								<div class="layui-form-mid">/件</div>
							</div>
							<div class="ns-word-aux">起售数量超出商品库存时，买家无法购买该商品</div>
						</div>
					</div>
				</div>

				<div class="tab-item shipping">
					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">是否包邮：</label>
							<div class="layui-input-block">
								<div class="layui-input-inline">
									<input type="radio" name="is_free_shipping" value="1" title="是" checked>
									<input type="radio" name="is_free_shipping" value="0" title="否">
								</div>
							</div>
						</div>
						<div class="layui-form-item shipping_template" style="display:none;">
							<label class="layui-form-label">运费模板：</label>
							<div class="layui-input-block">
								<div class="layui-input-inline">
									<select name="batch_shipping_template" lay-search="">
										<option value="0">请选择运费模板</option>
										<?php if(is_array($express_template_list) || $express_template_list instanceof \think\Collection || $express_template_list instanceof \think\Paginator): if( count($express_template_list)==0 ) : echo "" ;else: foreach($express_template_list as $key=>$vo): ?>
										<option value="<?php echo htmlentities($vo['template_id']); ?>"><?php echo htmlentities($vo['template_name']); ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="ns-word-aux">该设置仅对实物商品有效</div>
					</div>
				</div>

				<div class="tab-item result">
					<img src="https://ls.chnssl.com/app/shop/view/public/img/success.png">
					<div class="text">设置成功</div>
				</div>
			</div>
		</div>
		<div class="footer-wrap">
			<button class="layui-btn layui-btn-primary" onclick="layer.closeAll()">取消</button>
			<button class="layui-btn ns-bg-color" onclick="batchSetting()">保存</button>
		</div>
	</div>
</script>

<!--店内分类-->
<script type="text/html" id="shop_category_html">
	<div class="item">
		<select class='shop_category_class' name="batch_shop_category[]" lay-search=""  lay-filter="batch_shop_category">
			<option value="0">请选择店内分类</option>
			<?php foreach($goods_shop_category_list as $shop_k => $shop_v): ?>
				<option value="<?php echo htmlentities($shop_v['category_id']); ?>"  data-level="<?php echo htmlentities($shop_v['level']); ?>" ><?php echo htmlentities($shop_v['category_name']); ?></option>
				<?php if(!(empty($shop_v['child_list']) || (($shop_v['child_list'] instanceof \think\Collection || $shop_v['child_list'] instanceof \think\Paginator ) && $shop_v['child_list']->isEmpty()))): if(is_array($shop_v['child_list']) || $shop_v['child_list'] instanceof \think\Collection || $shop_v['child_list'] instanceof \think\Paginator): if( count($shop_v['child_list'])==0 ) : echo "" ;else: foreach($shop_v['child_list'] as $key=>$vo_child): ?>
					<option value="<?php echo htmlentities($vo_child['category_id']); ?>" data-level="<?php echo htmlentities($vo_child['level']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($vo_child['category_name']); ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<i class="layui-icon layui-icon-close"></i>
	</div>
</script>
<script src="https://ls.chnssl.com/app/admin/view/public/js/community/goods_edit_category.js"></script>
<script src="https://ls.chnssl.com/app/admin/view/public/js/community/goods_list.js"></script>

</body>
</html>