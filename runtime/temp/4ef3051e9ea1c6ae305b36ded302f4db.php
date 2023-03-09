<?php /*a:2:{s:69:"/www/wwwroot/ls.chnssl.com/addon/fenxiao/shop/view/fenxiao/lists.html";i:1658462028;s:23:"app/shop/view/base.html";i:1654828558;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/goods_lists.css">
<style>
	.layui-table-view {margin-top: 15px;}
	.layui-table-header {overflow: inherit;}
	.layui-table-cell {overflow: inherit}
	.ns-prompt .iconfont {font-size: 16px; font-weight: 500; color: rgba(0,0,0,0.7); margin-left: 3px; cursor: pointer;}
</style>

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
			<!--	<div class="ns-shop-ewm"> 
					<a href="#" onclick="getShopUrl()">访问店铺</a>
				</div>-->
				
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
                    <label class="layui-form-label">是否参与：</label>
                    <div class="layui-input-inline">
                        <select name="is_fenxiao" lay-filter="is_fenxiao">
                            <option value="">全部</option>
                            <option value="1">已参与</option>
                            <option value="0">未参与</option>
                        </select>
                    </div>
                </div>
            </div>

			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	</div>
</div>

<table id="goods_list" lay-filter="goods_list"></table>

<!-- 商品信息 -->
<script type="text/html" id="goods_info">
	<div class="ns-table-title">
		<div class="ns-title-pic">
			<img layer-src src="{{ns.img(d.goods_image.split(',')[0], 'small')}}"/>
		</div>
		<div class="ns-title-content">
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.goods_name}}">{{d.goods_name}}</a>
		</div>
	</div>
</script>

<!-- 操作 -->
<script type="text/html" id="action">
	<div class="operation-wrap" data-goods-id="{{d.goods_id}}">
		<div class="popup-qrcode-wrap"><img class="popup-qrcode-loadimg" src="https://ls.chnssl.com/public/static/loading/loading.gif" /></div>
		<div class="ns-table-btn">
			{{# if(d.is_fenxiao == 1){ }}
			<a class="layui-btn" lay-event="config">佣金设置</a>
			<a class="layui-btn" lay-event="modify">取消分销</a>
			{{# }else{ }}
			<a class="layui-btn" lay-event="modify">参与分销</a>
			{{# } }}
		</div>
	</div>
</script>

<!-- 批量操作 -->
<script type="text/html" id="batchOperation">
	<button class="layui-btn layui-btn-primary" lay-event="join">参与分销</button>
	<button class="layui-btn layui-btn-primary" lay-event="cancel">取消分销</button>
</script>

<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="join">参与分销</button>
	<button class="layui-btn layui-btn-primary" lay-event="cancel">取消分销</button>
</script>


			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
			<!--	-->
			<!--</div>-->

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


<script>
	var form, element, repeat_flag, table;
	$(function () {
		layui.use(['form', 'element'], function () {
			form = layui.form;
			repeat_flag = false; //防重复标识
			element = layui.element;

			refreshTable();
			form.render();

			// 监听工具栏操作
			table.tool(function (obj) {
				var data = obj.data;
				switch (obj.event) {
					case 'config':
						//编辑
						location.href = ns.url("fenxiao://shop/fenxiao/config", {"goods_id": data.goods_id});
						break;
					case 'modify':
						//删除
						modifyFenxiao(data.goods_id, data.is_fenxiao);
						break;
				}
			});

			// 搜索功能
			form.on('submit(search)', function (data) {
				table.reload({
					page: {
						curr: 1
					},
					where: data.field
				});
				return false;
			});
		});
	});

	// 刷新表格列表
	function refreshTable() {
		var cols = [
			[{
                type: 'checkbox',
                unresize: 'false',
                width: '3%'
            },{
				title: '商品名称',
				unresize: 'false',
				width: '25%',
				templet: '#goods_info'
			}, {
				field: 'price',
				title: '<span style="padding-right: 15px;">价格(元)</span>',
				unresize: 'false',
				width: '10%',
				align: 'right',
				templet: function (data) {
					return '<span style="padding-right: 15px;">￥' + data.price + '</span>';
				}
			}, {
				field: 'goods_stock',
				title: '库存',
				unresize: 'false',
				width: '8%'
			}, {
				field: 'sale_num',
				title: '销量',
				unresize: 'false',
				width: '10%'
			}, {
					field: 'one_rate',
					title: '佣金比例',
					unresize: 'false',
					width:'10%',
					templet: function(data) {
						return data.one_rate+"%";
					}
				},{
				title: '销售状态',
				unresize: 'false',
				width: '10%',
				templet: function (data) {
					var str = '';
					if (data.goods_state == 1) {
						str = '<span style="color: green">销售中</span>';
					} else if (data.goods_state == 0) {
						str = '<span style="color: red">仓库中</span>';
					}
					return str;
				}
			}, {
				title: '是否参与',
				unresize: 'false',
				width: '10%',
				templet: function (data) {
					var  str = '';
					if (data.is_fenxiao == 0) {
						str = '未参与';
					} else if (data.is_fenxiao == 1) {
						str = '已参与';
					}
					return str;
				}
			}, {
				title: '<div class="ns-prompt-block">' + '规则' +
							'<div class="ns-prompt">' +
								'<i class="iconfont iconwenhao1"></i>'+
								'<div class="ns-prompt-box" >' +
									'<div class="ns-prompt-con">' +
										'<ul style="font-weight: 100">'+
											'<li>1、分销商层级与后台配置有关，最多三级分销。</li>'+
											'<li>2、分销商等级与分销商的分销订单数，分销订单总额，自购订单数，自购订单总额，分销商下线人数，分销商的下级分销商人数有关。</li>'+
											'<li>3、商品分销总佣金不得超过商品实际价格的50%。</li>'+
											'<li>4、分销佣金是根据当前分销订单所属分销商等级或者商品自定义的计算规则进行结算。</li>'+
											'<li>5、分销结算说明： A 、B 、C是分销商，C的上级为B，B的上级为A。' +
						'分佣按照所属分销商的等级佣金比率进行分配，分销商C的等级分佣比率为一级10%，二级5%，三级2%，' +
						'订单属于分销商C，则C获得商品实付金额10%，B获得商品实付金额5%，A获得商品实付金额2%。' +
						'若C推荐的普通用户D购买商品，则该订单属于C；若C购买商品，则该订单属于C。</li>'+
										'</ul>'+
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>',
				unresize: 'false',
				width: '10%',
				templet: function (data) {
					var  str = '';
					if (data.fenxiao_type == 1) {
						str = '默认规则';
					} else if (data.fenxiao_type == 2) {
						str = '单独设置';
					}
					return str;
				}
			}, {
				title: '操作',
				toolbar: '#action',
				unresize: 'false',
				width: '15%'
			}]
		];

		table = new Table({
			elem: '#goods_list',
			url: ns.url("fenxiao://shop/fenxiao/lists"),
			cols: cols,
            bottomToolbar: "#batchOperation",
            toolbar: '#toolbarOperation',
			where: {
				search_text: $("input[name='search_text']").val(),
				start_sale: $("input[name='start_sale']").val(),
				end_sale: $("input[name='end_sale']").val(),
				category_id: $("input[name='category_id']").val(),
			}
		});

		// 批量操作
		table.toolbar(function (obj) {
			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}
			var id_array = new Array();
			for (i in obj.data) id_array.push(obj.data[i].goods_id);
			switch (obj.event) {
				case "join":
					joinFenxiao(id_array);
					break;
				case 'cancel':
					//下架
					cancelFenxiao(id_array);
					break;
			}
		});
        // 批量操作
        table.bottomToolbar(function (obj) {
            if (obj.data.length < 1) {
                layer.msg('请选择要操作的数据');
                return;
            }
            var id_array = new Array();
            for (i in obj.data) id_array.push(obj.data[i].goods_id);
            switch (obj.event) {
                case "join":
                    joinFenxiao(id_array);
                    break;
                case 'cancel':
                    //下架
                    cancelFenxiao(id_array);
                    break;
            }
        });
	}

	//配置参与状态
	function modifyFenxiao(goods_id, is_fenxiao) {
		layer.confirm('确定要进行更改吗?', function () {
			if (repeat_flag) return;
			repeat_flag = true;
			$.ajax({
				url: ns.url("fenxiao://shop/fenxiao/modify"),
				data: {goods_id: goods_id, is_fenxiao:is_fenxiao},
				dataType: 'JSON',
				type: 'POST',
				success: function (res) {
					layer.msg(res.message);
					repeat_flag = false;
					if (res.code == 0) {
						table.reload();
					}
				}
			});
		});
	}

	//参与分销
    function joinFenxiao(goods_ids){
        layer.confirm('批量参与分销的商品，如果之前未配置佣金规则，则使用默认规则，是否继续？', {title: '提示'}, function () {
            if (repeat_flag) return;
            repeat_flag = true;

            $.ajax({
                url: ns.url("fenxiao://shop/fenxiao/setGoodsIsFenxiao"),
                data: {goods_ids: goods_ids.toString(), is_fenxiao: 1},
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    layer.msg(res.message);
                    repeat_flag = false;
                    if (res.code == 0) {
                        table.reload();
                    }
                }
            });
        });
    }

    //取消分销
    function cancelFenxiao(goods_ids) {
        layer.confirm('是否设置商品不参与分销?', {title: '提示'}, function () {
            if (repeat_flag) return;
            repeat_flag = true;

            $.ajax({
                url: ns.url("fenxiao://shop/fenxiao/setGoodsIsFenxiao"),
                data: {goods_ids: goods_ids.toString()},
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    layer.msg(res.message);
                    repeat_flag = false;
                    if (res.code == 0) {
                        table.reload();
                    }
                }
            });
        });
    }
</script>

</body>

</html>