<?php /*a:2:{s:63:"/www/wwwroot/ls.chnssl.com/app/shop/view/orderrefund/lists.html";i:1614516210;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/order_list.css"/>

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
			
				
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show"  lay-filter="order_list">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">商品名称：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="sku_name">
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">订单编号：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="order_no">
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">退款编号：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="refund_no">
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">申请时间：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_time" placeholder="开始时间" id="start_time" readonly>
						<i class="ns-calendar"></i>
					</div>
					<div class="layui-form-mid">-</div>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="end_time" placeholder="结束时间" id="end_time" readonly>
						<i class="ns-calendar"></i>
					</div>
					<button class="layui-btn layui-btn-primary date-picker-btn" onclick="datePick(7, this);return false;">近7天</button>
					<button class="layui-btn layui-btn-primary date-picker-btn" onclick="datePick(30, this);return false;">近30天</button>
				</div>
			</div>
			
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">退款状态：</label>
					<div class="layui-input-inline">
						<select name="refund_status" lay-filter="refund_status">
							<option value="">全部</option>
							<?php foreach($refund_status_list as $k => $status_val): ?>
							<option value="<?php echo htmlentities($status_val['status']); ?>"><?php echo htmlentities($status_val['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">退款方式：</label>
					<div class="layui-input-inline">
						<select name="refund_type" >
							<option value="">全部</option>
							<?php foreach($refund_type_list as $refund_type_k => $refund_type_v): ?>
							<option value="<?php echo htmlentities($refund_type_k); ?>"><?php echo htmlentities($refund_type_v); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit id="btn_search"lay-filter="btn_search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				<button class="layui-btn layui-btn-primary" lay-submit lay-filter="batch_export" >批量导出</button>
				<a class="layui-btn layui-btn-primary" href="<?php echo addon_url('shop/orderrefund/export'); ?>" target="_blank">查看已生成报表</a>
			</div>
			<input type="hidden" name="status" />
			<input type="hidden" name="page" />
		</form>
	</div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="order_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="">全部</li>
		<?php foreach($refund_status_list as $k => $status_val): if($status_val['status']!=0): ?>
		<li lay-id="<?php echo htmlentities($status_val['status']); ?>"><?php echo htmlentities($status_val['name']); ?></li>
		<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<div class="layui-tab-content">
		<div id="order_list"></div>
	</div>
</div>

<div id="order_page"></div>
<div id="order_operation"></div>

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


<script src="https://ls.chnssl.com/app/shop/view/public/js/refund_list.js"></script>
<script>
    var laypage,element, form, hash_url;
    /**
     *通过hash获取页数
     */
    function getHashPage(){
        var page = 1;
        var hash = location.hash;

        var hash_arr = hash.split("&");
        $.each(hash_arr,function(index, itemobj){
            var item_arr = itemobj.split("=");
            if(item_arr.length == 2){
                if(item_arr[0].indexOf("page") != "-1"){
                    page = item_arr[1];
                }
            }
        });
        return page;
    }

    //从hash中获取数据
    function getHashData(){
        var hash = ns.urlReplace(location.hash);

        var hash_arr = hash.split("&");
        var form_json = {
            "end_time" : "",
            "sku_name" : "",
            "refund_type" : "",
            "order_no" : "",
            "delivery_status" : "",
            "refund_status" : "",
            "start_time" : "",
            "refund_no" : "",
            "delivery_no" : "",
            "refund_delivery_no" : "",
            "page" : ""
        };
        if(hash_arr.length > 0){
            // page = hash_arr[0].replace('#!page=', '');
            $.each(hash_arr,function(index, itemobj){
                var item_arr = itemobj.split("=");
                if(item_arr.length == 2){
                    $.each(form_json,function(key, form_val){
                        if(item_arr[0].indexOf(key) != "-1"){
                            form_json[key] = item_arr[1];
                        }
                    })

                }

            })
        }
        form.val("order_list", form_json);

		setStatusTab(form_json.refund_status);
        return form_json;

    }
    layui.use(['laypage','laydate','form', 'element'], function(){
        form = layui.form;
        laypage = layui.laypage;
        element = layui.element;
        var laydate = layui.laydate;
		form.render();
		
        //渲染时间
        laydate.render({
            elem: '#start_time'
            ,type: 'datetime'
            ,change: function(value, date, endDate){
                $(".date-picker-btn").removeClass("selected");
            }
        });
        laydate.render({
            elem: '#end_time'
            ,type: 'datetime'
            ,change: function(value, date, endDate){
                $(".date-picker-btn").removeClass("selected");
            }
        });

        //监听筛选事件
        form.on('submit(btn_search)', function(data){
            data.field.page = 1;
            setHashOrderList(data.field);
			setStatusTab(data.field.refund_status);
            return false;
        });

        //批量导出
        form.on('submit(batch_export)', function(data){
            // location.href = ns.url("shop/order/exportRefundOrder",data.field);

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: ns.url("shop/orderrefund/exportrefundorder"),
				data: data.field,
				success: function (res) {

				}
			});
			window.open(ns.url("shop/orderrefund/export",{}));

            return false;
        });

		//监听Tab切换，以改变地址hash值
		element.on('tab(order_tab)', function(){
			var status = this.getAttribute('lay-id');
			form.val("order_list", {"refund_status":status});

			var hash_data = getHashList();
			hash_data.refund_status = status;
			hash_data.page = 1;
			setHashOrderList(hash_data);
		});

        getOrderList();//筛选
        getHashData();

    });
    //哈希值 订单数据
    function setHashOrderList(data){
        var hash = "";
        $.each(data,function(index, itemobj){
            if(itemobj != ""){
                if(hash == ""){
                    hash += "#!"+index +"="+itemobj;
                }else{
                    hash += "&"+index +"="+itemobj;
                }
            }
        });
        // window.location.href = hash;
        hash_url = hash;
        location.hash = hash;
        getOrderList();
    }

	function getHashList(){
		var hash = ns.urlReplace(location.hash);
		var hash_arr = hash.split("&");

		var form_json = {
			"end_time" : "",
			"sku_name" : "",
			"refund_type" : "",
			"order_no" : "",
			"delivery_status" : "",
			"refund_status" : "",
			"start_time" : "",
			"refund_no" : "",
			"delivery_no" : "",
			"refund_delivery_no" : "",
			"page" : ""
		};
		if(hash_arr.length > 0){
			// page = hash_arr[0].replace('#!page=', '');
			$.each(hash_arr,function(index, itemobj){
				var item_arr = itemobj.split("=");
				if(item_arr.length == 2){
					$.each(form_json,function(key, form_val){
						if(item_arr[0].indexOf(key) != "-1"){
							form_json[key] = item_arr[1];
						}
					})
				}
			})
		}

		return form_json;
	}

	function setStatusTab(refund_status){
		$(".layui-tab-title li").removeClass("layui-this");
		$(".layui-tab-title li").each(function(){
			var status = $(this).attr("lay-id");
			if(status == refund_status){
				$(this).addClass("layui-this")
			}
		});
	}
    var order = new Order();
    function getOrderList(){
        var url = ns.url("shop/orderrefund/lists", ns.urlReplace(location.hash.replace('#!', '')));

        $.ajax({
            type : 'get',
            dataType: 'json',
            url :url,
            success : function(res){
                if(res.code == 0){
                    order.setData(res.data);
                    $("#order_list").html(order.fetch());
                    laypage.render({
                        elem: 'order_page',
                        count: res.data.count,
                        curr: getHashPage(),
                        layout: ['count','prev', 'page', 'next'],
                        // hash: 'page',
                        jump: function(obj, first){
                            //首次不执行
                            if(!first){
                                var hash_data = getHashData();
                                hash_data.page = obj.curr;
                                setHashOrderList(hash_data);
                                // $("#btn_search").click();//筛选
                            }
                        }
                    });
                }else{
                    layer.msg(res.message);
                }
            }
        });
    }

    /**
     * 七天时间
     */
    function datePick(date_num,event_obj){
        $(".date-picker-btn").removeClass("selected");
        $(event_obj).addClass('selected');
        // alert(new Date().format("yyyy-MM-dd hh:mm"));
        var now_date = new Date();

        Date.prototype.Format = function (fmt,date_num) { //author: meizz
            this.setDate(this.getDate()-date_num);
            var o = {
                "M+": this.getMonth() + 1, //月份
                "d+": this.getDate(), //日
                "H+": this.getHours(), //小时
                "m+": this.getMinutes(), //分
                "s+": this.getSeconds(), //秒
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度
                "S": this.getMilliseconds() //毫秒
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        };
        // var now_time =  new Date().Format("yyyy-MM-dd HH:mm:ss",0);//当前日期
        var now_time =  new Date().Format("yyyy-MM-dd 23:59:59",0);//当前日期
        var before_time =  new Date().Format("yyyy-MM-dd 00:00:00",date_num-1);//前几天日期
        $("input[name=start_time]").val(before_time,0);
        $("input[name=end_time]").val(now_time,date_num-1);

    }
</script>

<!-- 商品预览 -->
<script type="text/html" id="goods_preview">
	<div class="goods-preview">
		<div class="qrcode-wrap">
			<img src="{{ ns.img(d.path.h5.img) }}" alt="推广二维码">
			<p class="tips ns-text-color">扫码可在手机端查看</p>
		</div>
		<div class="phone-wrap">
			<div class="iframe-wrap">
				<iframe src="{{ d.path.h5.url }}&preview=1" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</script>

</body>

</html>