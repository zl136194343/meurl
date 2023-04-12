<?php /*a:2:{s:67:"D:\phpstudy_pro\WWW\www.xiaofu.live\app\shop\view\member\index.html";i:1671499746;s:59:"D:\phpstudy_pro\WWW\www.xiaofu.live\app\shop\view\base.html";i:1671499744;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="http://www.xiaofuaaa.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="http://www.xiaofuaaa.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="http://www.xiaofuaaa.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="http://www.xiaofuaaa.com/app/shop/view/public/css/common.css" />
	<script src="http://www.xiaofuaaa.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="http://www.xiaofuaaa.com/public/static/ext/layui/layui.js"></script>
	<script src="http://www.xiaofuaaa.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "http://www.xiaofuaaa.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"http://www.xiaofuaaa.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="http://www.xiaofuaaa.com/public/static/js/common.js"></script>
	<script src="http://www.xiaofuaaa.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("http://www.xiaofuaaa.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	.ns-member-block{display: flex;justify-content: space-between;}
	.ns-member-block .layui-card{box-shadow: initial;margin-bottom: 0;width: calc((100% - 30px) / 4);margin-right: 9px;height: 180px;box-sizing: border-box;}
	.ns-member-block .layui-card:last-child{margin-right: 0}
	.ns-member-num{color: red;font-size: 30px;line-height: 50px;}
	.ns-member-title{color: #666666;font-size: 16px;}
	.layui-card-body{width: 100%;height: 100%;box-sizing: border-box;padding-left: 20px;display: flex;justify-content: space-between;align-items: center;}
	.ns-card-member{align-items: flex-start;}
	#china_echart{width: 600px;height: 600px;flex-shrink: 0;margin: 0 50px}
	.ns-member-table{flex: 1;}
	.layui-table-view .layui-table thead tr{background-color: #F5F5F5;}
	.ns-split{width: 30px;}
	.ns-member-block .layui-card{border: 1px solid #f1f1f1}
	.ns-member-table{max-width: 600px;}
	@media screen and (max-width: 1330px){.ns-member-block .layui-card:nth-child(4){width: 420px;}
		#china_echart{width: 500px;height: 500px;}}
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-header">
			<div class="layui-logo">
				<a href="">
					<?php if(!(empty($shop_info['logo']) || (($shop_info['logo'] instanceof \think\Collection || $shop_info['logo'] instanceof \think\Paginator ) && $shop_info['logo']->isEmpty()))): ?>
					<img src="<?php echo img($shop_info['logo']); ?>" onerror=src="http://www.xiaofuaaa.com/app/shop/view/public/img/shop_logo.png">
					<!-- <h1>开源商城</h1> -->
					<?php else: ?>
					<img src="http://www.xiaofuaaa.com/app/shop/view/public/img/shop_logo.png">
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
								<img src="http://www.xiaofuaaa.com/<?php echo htmlentities($menu_second_v['icon']); ?>" alt="">
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
			
				
<div class="ns-member-block">
	<div class="layui-card">
		<div class="layui-card-body">
			<div class="ns-member">
				<p class="ns-member-num"><?php echo htmlentities($data['total_count']); ?></p>
				<p class="ns-member-title">累计会员数</p>
			</div>
		</div>
	</div>
	
	<div class="layui-card">
		<div class="layui-card-body">
			<div class="ns-member">
				<p class="ns-member-num"><?php echo htmlentities($data['newadd_count']); ?></p>
				<p class="ns-member-title">今日新增会员数</p>
			</div>
		</div>
	</div>

	<div class="layui-card">
		<div class="layui-card-body">
			<div class="ns-member">
				<p class="ns-member-num"><?php echo htmlentities($data['subscribe_count']); ?></p>
				<p class="ns-member-title">关注会员数</p>
			</div>
		</div>
	</div>

	<div class="layui-card">
		<div class="layui-card-body">
			<div class="ns-member">
				<p class="ns-member-num"><?php echo htmlentities($data['buyed_count']); ?></p>
				<p class="ns-member-title">下单会员数</p>
			</div>
			<div id="main" style="width: 250px; height: 160px;"></div>
		</div>
	</div>
</div>

<div class="layui-card ns-card-common ns-card-brief">
	<div class="layui-card-header">
		<span class="ns-card-title">会员分布</span>
	</div>
	<div class="layui-card-body ns-card-member">
		<div id="china_echart"></div>
		<div class="ns-split"></div>
		<div class="ns-member-table">
			<table id="member_list" lay-filter="member_list" class="layui-table"></table>
		</div>
	</div>
</div>

			</div>
			
			<!-- 版权信息 -->
<!--			<div class="ns-footer">-->
<!--				<div class="ns-footer-img">-->
<!--					<a href="#"><img style="-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: grayscale(100%);filter: gray;" src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>http://www.xiaofuaaa.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
<!--				</div>-->
<!--			</div>-->

			<!--<div class="ns-footer">-->
			<!--	-->
			<!--	<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>http://www.xiaofuaaa.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>-->
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


<script src="http://www.xiaofuaaa.com/public/static/ext/echarts.min.js"></script>
<script src="http://www.xiaofuaaa.com/public/static/ext/china.js"></script>
<script>
	layui.use('form', function() {
		var table, form = layui.form;
		form.render();
		
		table = new Table({
			elem: '#member_list',
			url: ns.url("shop/member/areaCount"),
			where: {
				handle: true
			},
			parseData: function(res) { //res 即为原始返回的数据
				return {
					"code": res.code, //解析接口状态
					"msg": res.message, //解析提示文本
					"count": res.data.list.length, //解析数据长度
					"data": res.data.list //解析数据列表
				};
			},
			page: false,
			cols: [
				[
					{
						field: 'LAY_INDEX',
						title: '排名',
						unresize: 'false',
						width: '20%',
						templet: function (data) {
							return data.LAY_INDEX;
						}
					}, {
						field: 'name',
						title: '地区',
						unresize: 'false',
						width: '30%'
					}, {
						field: 'value',
						title: '会员数',
						unresize: 'false',
						width: '25%'
					}, {
						field: 'ratio',
						title: '会员占比',
						unresize: 'false',
						width: '25%',
						templet: function (data) {
							return data.ratio + '%';
						}
					}
				]
			]
		});
	});
	
	// 基于准备好的dom，初始化echarts实例
	var myChart = echarts.init(document.getElementById('main'));

	// 指定图表的配置项和数据
	option = {
		tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b}: {c} ({d}%)'
		},
		legend: {
	        orient: 'vertical',
	        left: 0,
	        data: ['下单会员数', '未下单会员数']
	    },
		color: ['#ff8143', '#eee'],
		series: [{
			width: 120,
			height: 120,
			top: 30,
			left: 130,
			name: '',
			type: 'pie',
			radius: ['50%', '70%'],
			avoidLabelOverlap: false,
    		label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '12',
                    color: '#ff8143'
                }
            },
            labelLine: {
                show: false
            },
			data: [
				{
					value: <?php echo htmlentities($data['buyed_count']); ?>,
					name: '下单会员数',
					tooltip: {
						trigger: 'item',
						backgroundColor: 'rgba(255, 255, 255, 0.7)',
						borderColor: '#999',
						borderWidth: 1,
						padding: 10,
						textStyle: {
							fontSize: 12,
							color: '#333'
						}
					}
				},
				{
					value: <?php echo htmlentities($data['total_count'] - $data['buyed_count']); ?>,
					name: '未下单会员数',
					tooltip: {
						trigger: 'item',
						backgroundColor: 'rgba(255, 255, 255, 0.7)',
						borderColor: '#999',
						borderWidth: 1,
						padding: 10,
						textStyle: {
							color: '#333',
							fontSize: 12
						}
					}
				}
			]
		}]
	};

	// 使用刚指定的配置项和数据显示图表。
	if(!Float32Array.prototype.slice) {
		Float32Array.prototype.slice = function () {
			return new Float32Array(this).subarray(this.arguments);
		}
	}
	myChart.setOption(option);

	var china_echart = echarts.init(document.getElementById('china_echart'));
	var china_option = {
		tooltip: {
			formatter: function(params, ticket, callback) {
				return params.seriesName + '<br />' + params.name + '：' + params.value
			}
		},
		visualMap: {
			min: 0,
			max: 1500,
			left: 'left',
			top: 'bottom',
			text: ['高', '低'],
			inRange: {
				color: ['#F5F5F5', '#ff8143']
			},
			show: false
		},
		geo: {
			map: 'china',
			roam: false,
			zoom: 1.23,
			label: {
				normal: {
					show: true,
					fontSize: '10',
					color: 'rgba(0,0,0,0.7)'
				}
			},
			itemStyle: {
				normal: {
					borderColor: 'rgba(0, 0, 0, 0.2)'
				},
				emphasis: {
					areaColor: '#e0ffff',
					shadowOffsetX: 0,
					shadowOffsetY: 0,
					shadowBlur: 20,
					borderWidth: 0,
					shadowColor: 'rgba(0, 0, 0, 0.5)'
				}
			}
		},
		series: [{
			name: '会员数',
			type: 'map',
			geoIndex: 0,
			data: [{"name":"北京","value":0},{"name":"天津","value":0},{"name":"河北","value":0},{"name":"山西","value":0},{"name":"内蒙古","value":0},{"name":"辽宁","value":0},{"name":"吉林","value":0},{"name":"黑龙江","value":0},{"name":"上海","value":0},{"name":"江苏","value":0},{"name":"浙江","value":0},{"name":"安徽","value":0},{"name":"福建","value":0},{"name":"江西","value":0},{"name":"山东","value":0},{"name":"河南","value":0},{"name":"湖北","value":0},{"name":"湖南","value":0},{"name":"广东","value":0},{"name":"广西","value":0},{"name":"海南","value":0},{"name":"重庆","value":0},{"name":"四川","value":0},{"name":"贵州","value":0},{"name":"云南","value":0},{"name":"西藏","value":0},{"name":"陕西","value":0},{"name":"甘肃","value":0},{"name":"青海","value":0},{"name":"宁夏","value":0},{"name":"新疆","value":0},{"name":"香港","value":0},{"name":"澳门","value":0},{"name":"台湾","value":0}]
		}]
	};
	china_echart.setOption(china_option);
	
	function areaCount(){
		 $.ajax({
            url: ns.url("shop/member/areaCount"),
            dataType: 'JSON',
            type: 'POST',
            success : function(res) {
            	if (res.data.list.length > 0) {
            		china_option.series[0].data = res.data.list;
            	}
            	china_echart.setOption(china_option);
            }
        })
	}
	areaCount();
</script>

</body>

</html>