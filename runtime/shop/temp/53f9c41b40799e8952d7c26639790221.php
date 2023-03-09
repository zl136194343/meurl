<?php /*a:2:{s:65:"/www/wwwroot/www.hunqin.com/app/shop/view/member/tixing_edit.html";i:1668581371;s:51:"/www/wwwroot/www.hunqin.com/app/shop/view/base.html";i:1654828558;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/shop/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	
<style>
	.ns-form {margin-top: 0;}
	.ns-calendar {
      position: absolute;
      top: 7px;
      right: 8px;
      width: 50px;
      height: 34px;
      z-index: 0;
    }
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="https://xyhl.chnssl.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="https://xyhl.chnssl.com/app/shop/view/public/img/shop_logo.png">
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
								<img src="https://xyhl.chnssl.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
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
			
				
<!--<script src="https://xyhl.chnssl.com/public/static/ext/drag-arrange.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/video/videojs-ie8.min.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/video/video.min.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/searchable_select/searchable_select.js"></script>-->

<script src="https://xyhl.chnssl.com/app/shop/view/public/js/category_select.js"></script>
<div class="layui-form ns-form">
<div class="ns-pay-win">
<div class="layui-form-item js-new-attr-list">
						<label class="layui-form-label"></label>
						<div class="layui-input-block">
							<div class="layui-form">
								<table class="layui-table">
									<colgroup>
										<col width="20%" />
										<col width="20%" />
										<col width="20%" />
										<col width="30%" />
										<col width="10%" />
									</colgroup>
									<thead>
									<tr>
									    <th>标题</th>
										<th>推送人</th>
										<th>推送时间</th>
										<th >
											备注

										</th>
										
									</tr>
									</thead>
									<tbody class="ns-attr-new">
	    								<tr class="goods-attr-tr goods-new-attr-tr">
                                		<td>
                                		<input type="text" class="layui-input add-attr-title" value="<?php echo htmlentities($ts['attr_title']); ?>" />
                                		</td>
                                		<td>
                                		    <select name="select_base_cityname" id="select_base_cityname" lay-filter="select_base_cityname" xm-select="select_base_cityname" xm-select-type="1"><?php if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $key=>$vo): ?><option value="<?php echo htmlentities($vo['member_id']); ?>" <?php if(in_array($vo['member_id'],$ts['attr_id'] ,false)): ?>selected<?php endif; ?> name="<?php echo htmlentities($vo['name']); ?>"><?php echo htmlentities($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>
                                		</td>
                                		<!--<td>
                                		
                                		<div  class="layui-inline"><div class="layui-input-inline"><input type="date" name="end" class="layui-input" id="end_time" value="<?php echo date('Y-m-d H:i:s',$ts['attr_value_name']); ?>"  placeholder="选择时间"></div></div>
                                		</td>-->
                                		<td><div class="layui-inline"><div class="layui-input-inline"><input type="text" name="end" class="layui-input" value="<?php echo date('Y-m-d H:i:s',$ts['attr_value_name']); ?>" id="end_time" placeholder="<?php echo date('Y-m-d H:i:s',$ts['attr_value_name']); ?>"></div></div></td>
                                		<td>
                                		<input type="text" class="layui-input add-attr-reamk" value="<?php echo htmlentities($ts['reamk']); ?>" />
                                		</td>
                                		<td>
                                		
                                		</tr>
									</tbody>
								</table>
							</div>
							<input type="hidden" name="id" id="id" value="<?php echo htmlentities($ts['id']); ?>" />
							<input type="hidden" name="customer_id" id="customer_id" value="<?php echo htmlentities($ts['customer_id']); ?>" />
							<!--<button class="layui-btn layui-btn-primary" onclick="addNewAttr()">添加参数</button>-->
						</div>
					</div>

	<div class="ns-form-row">
		<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
	</div>
</div>
 <link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/shop/view/public/css/formSelects-v4.css" media="all">

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
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


<!--<script src="https://raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.min.js" type="text/javascript" charset="utf-8"></script>
-->
<script>
        layui.config({
        base: "https://xyhl.chnssl.com/app/shop/view/public/js/" //路径为插件
  }).extend({
        formSelects: 'formSelects-v4'
  });
	    layui.use(['form','laydate','formSelects'], function() {
		var form = layui.form,
			repeat_flag = false; //防重复标识
				formSelects =  layui.formSelects;
		form.render();

		/**
		 * 监听保存
		 */
		 var time = new Date();
		 var currentTime = time.toLocaleDateString + " " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
		form.on('submit(save)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var goodsAttrFormat = [];
				$(".ns-attr-new .goods-new-attr-tr").each(function (i) {
	/*			var attr_id = $(this).find(".add-attr-name").val();*/
				var attr_value = $(this).find("#end_time").val();
				var attr_title = $(this).find(".add-attr-title").val();
				var attr_reamk = $(this).find(".add-attr-reamk").val();
				var attr_name = JSON.stringify(layui.formSelects.value('select_base_cityname', 'name'));
				var attr_id = JSON.stringify(layui.formSelects.value('select_base_cityname', 'valStr'));
				/*var sort = $(this).find(".add-attr-sort").val();*/
				var attr = {};
				
				
					attr.attr_name = attr_name;
					attr.attr_id = attr_id;
					attr.attr_value_name = attr_value;
					attr.attr_title = attr_title;
					attr.reamk = attr_reamk;
					attr.id = $('#id').val();
					attr.customer_id = $('#customer_id').val();
					goodsAttrFormat.push(attr);
					
				
			});
			
			console.log(goodsAttrFormat)
			
			data.field.goodsAttrFormat = goodsAttrFormat;
			$.ajax({
				url: ns.url("shop/member/tixingEdit"),
				data: data.field,
				dataType: 'JSON', //服务器返回json格式数据
				type: 'POST', //HTTP请求类型
				success: function(res) {
					repeat_flag = false;
					if (res.code == 0) {
						layer.confirm('添加成功', {
							title:'操作提示',
							btn: ['返回列表', '继续添加'],
							yes: function(){
								location.href = ns.url("shop/member/tixingList?id="+<?php echo htmlentities($ts['customer_id']); ?>)
							},
							btn2: function() {
								location.href = ns.url("shop/member/tixingAdd")
							}
						});
					}else{
						layer.msg(res.message);
					}
				}
			});
		});
		var  laydate = layui.laydate;
		/*var formSelects = layui.xm_select;*/
		laydate.render({
			elem: '#end_time', //指定元素
			type: 'datetime',
			min: currentTime
		});
		/**
		 * 表单验证
		 */
	
	});
 	function back(){
		location.href = ns.url("shop/member/tixingList?id="+<?php echo htmlentities($ts['customer_id']); ?>);
	}
	var repeat_flag_member = false;
	var html, val
	function checkMember() {
		var parent = $(".ns-check-member");
		var con = parent.find(".ns-member-name").val();
		$(".layui-word-aux").remove();
		$(".ns-search-result").remove();

		if (repeat_flag_member) return false;
		repeat_flag_member = true;

		if (con == "" || con == null || con.trim() == "") {
			repeat_flag = false;
		} else {
			$.ajax({
				type: 'POST',
				url: ns.url("shop/verify/searchMember"),
				data: {
					'search_text': con
				},
				dataType: 'JSON',
				success: function(res) {
					// layer.msg(res.message);
					repeat_flag_member = false;

					if (res.data == null) {
						html = '<span class="layui-word-aux">未找到该用户</span>';
						val = res.data;
					} else {
						html = '<div class="ns-search-result layui-input-inline ns-border-color-gray">' +
								'<div class="ns-search-res-img">' +
								'<img src="' + ns.img(res.data.headimg) + '" onerror="javascript:this.src=\'https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png\';"/>' +
								'</div>' +
								'<div class="ns-search-res-intro">' +
								'<p>用户名：' + res.data.realname + '</p>' +
								'<p>电话：' + res.data.mobile + '</p>' +
								'</div>' +
								'<div class="ns-search-res-close" onclick="closeMember()">' +
								'<i class="iconfont iconclose_light"></i>' +
								'</div>' +
								'</div>';
						val = res.data.member_id;
					}

					$(".ns-member-id").attr("value", val);
					$("#weixin_settlement_bank_account_name").val(res.data.realname);
					$("#weixin_settlement_bank_address").val(res.data.nickname);
					$("#weixin_settlement_bank_name").val(res.data.mobile);
					$("input[name='member_id']").val(res.data.member_id);

					$(".ns-check-member").append(html);
				}
			});
		}
	}
	
	function addNewAttr() {
	var html = '<tr class="goods-attr-tr goods-new-attr-tr">' +
		'<td>' +
		'<input type="text" class="layui-input add-attr-title" />' +
		'</td>' +
		'<td>' +
		'<select style="display:block" name="brand_id" lay-search="" class="layui-input add-attr-name" lay-filter="select_base_cityname" xm-select="select_base_cityname" xm-select-type="1"><option value="">请选择推送人员</option><?php if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $key=>$vo): ?><option value="<?php echo htmlentities($vo['member_id']); ?>" name="<?php echo htmlentities($vo['name']); ?>"><?php echo htmlentities($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>' +
		'</td>' +
		'<td>' +
		
		'<div class="layui-inline"><div class="layui-input-inline"><input type="date" name="end" class="layui-input" id="end_time"  placeholder="选择时间"></div></div>' +
		'</td>' +
		'<td>' +
		'<input type="text" class="layui-input add-attr-reamk" />' +
		'</td>' +
		'<td>' +
		'<div class="ns-table-btn"><a class="layui-btn" onclick="delAttr(this)">删除</a></div>' +
		'</td>' +
		'</tr>';

	$(".ns-attr-new").append(html);
	$('.ns-null-data').hide();
	isNullTable();
}
	function isNullTable() {
	var len = $(".ns-attr-new .goods-attr-tr").length;
	if (len == 0) {
		$(".ns-attr-new").html('<tr class="ns-null-data"><td colspan="4" align="center">无数据</td></tr>');
	} else {
		$(".ns-attr-new .ns-null-data").remove();
	}
}
function delAttr(obj) {
	$(obj).parents("tr").remove();
	isNullTable();
}
</script>

</body>

</html>