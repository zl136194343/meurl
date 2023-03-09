<?php /*a:2:{s:65:"/www/wwwroot/www.hunqin.com/app/shop/view/shopwithdraw/lists.html";i:1614516276;s:51:"/www/wwwroot/www.hunqin.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
    .ns-card-common:first-of-type{margin-top: 0;}
    .layui-card-body{display: flex;padding-bottom: 0 !important;padding-right: 50px !important;padding-left: 50px !important;flex-wrap: wrap;}
    .layui-card-body .content{width: 33.3%;display: flex;flex-direction: column;margin-bottom: 30px;justify-content: center;}
    .layui-card-body .money{font-size: 20px;color: #666;font-weight: bold;margin-top: 10px;max-width: 250px;}
    .layui-card-body .subhead{font-size: 12px;margin-left: 3px;cursor: pointer;}
	.ns-single-filter-box {background-color: transparent;}
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
			
				
<div class="layui-card ns-card-common ns-card-brief">
    <div class="layui-card-header">
        <div>
            <span class="ns-card-title">提现金额</span>
        </div>
    </div>
    <div class="layui-card-body">
        <div class="content">
            <p class="title">已提现(元)</p>
            <p class="money"><?php echo htmlentities($account_withdraw); ?></p>
        </div>
        <div class="content">
            <p class="title">提现中(元)</p>
            <p class="money"><?php echo htmlentities($account_withdraw_apply); ?></p>
        </div>
    </div>
</div>

<!-- 筛选面板 -->
<div class="ns-single-filter-box">
    <div class="layui-form">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" name="start_time" id="start_time" placeholder="开始时间" class="layui-input" autocomplete="off" readonly>
                <i class="ns-calendar"></i>
            </div>
            <div class="layui-input-inline end-time">
                <input type="text" name="end_time" id="end_time" placeholder="结束时间" class="layui-input" autocomplete="off" readonly>
                <i class="ns-calendar"></i>
            </div>
            <button class="layui-btn layui-btn-primary" lay-submit lay-filter="search">搜索</button>
        </div>
    </div>
</div>

<div class="layui-tab ns-table-tab" lay-filter="goods_list_tab">

    <div class="layui-tab-content">
        <table id="account_list" lay-filter="account_list"></table>
    </div>
</div>


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


<script type="text/html" id="action">
    <div class="ns-table-btn">
        <a class="layui-btn" lay-event="detail">查看</a>
    </div>
</script>

<script type="text/html" id="money">
	<span style="color: red; padding-right: 30px;">￥{{ d.money }}</span>
</script>

<script>
    var start_time,end_time;
    layui.use(['element', 'laytpl','laydate','form'], function () {
        var table,
            form = layui.form,
            laydate = layui.laydate,
            element = layui.element,
            laytpl = layui.laytpl;
		form.render();

        //监听Tab切换，以改变地址hash值
        element.on('tab(goods_list_tab)', function () {
            table.reload({
                page: {
                    curr: 1
                },
                where: {
                    'status': this.getAttribute('data-status')
                }
            });
        });


        //开始时间
        laydate.render({
            elem: '#start_time' //指定元素
            ,done: function(value, date, endDate){
                start_time = ns.date_to_time(value);

            }
        });
        //结束时间
        laydate.render({
            elem: '#end_time' //指定元素
            ,done: function(value, date, endDate){
                end_time = ns.date_to_time(value);
            }
        });

        /**
         * 搜索功能
         */
        form.on('submit(search)', function (data) {
            data.field.start_time = start_time;
            data.field.end_time = end_time;
            table.reload({
                page: {
                    curr: 1
                },
                where: data.field
            });
            return false;
        });

        table = new Table({
            elem: '#account_list',
            url: ns.url("shop/shopwithdraw/lists"),
            cols: [
                [{
                    field: 'withdraw_no',
                    title: '账单编号',
                    unresize: 'false',
                    width:'15%',
                }, {
                    field:'money',
                    title: '<span style="padding-right: 30px;">提现金额（元）</span>',
                    unresize: 'false',
                    width:'17%',
					align: 'right',
                    templet: '#money'
                }, {
                    field:'name',
                    title: '姓名',
                    unresize: 'false',
                    width:'12%',
                }, {
                    field:'mobile',
                    title: '电话',
                    unresize: 'false',
                    width:'12%',

                }, {
                    title: '账户类型',
                    unresize: 'false',
                    width:'10%',
                    templet: function (res){
                        return res.bank_type == 1 ? "银行" : "支付宝";
                    }
                }, {
                    title: '状态',
                    unresize: 'false',
                    width:'10%',
                    templet: function (res){
                        var str = '';
                        if(res.status == 2){
                            str = '<span style="color:green;">已提现</span>';
                        }else{
                            str = '<span style="color:red;">提现中</span>';
                        }
                        return str;
                    }
                }, {
                    field: 'apply_time',
                    title: '时间',
                    unresize: 'false',
                    width:'16%',
                    templet: function (res){
                        if(res.apply_time == 0){
                            return '--';
                        }else{
                            return ns.time_to_date(res.apply_time)
                        }
                    }
                },{
                    title: '操作',
                    unresize: 'false',
                    width:'8%',
                    templet: '#action'
                }]
            ]
        });

        /**
         * 监听工具栏操作
         */
        table.tool(function(obj) {
            var data = obj.data,
                event = obj.event;
            switch (event){
                case 'detail': //查看
                    withdrawDetail(data);
                    break;
            }
        });

        //详情
        function withdrawDetail(data) {
            var detailHtml = $("#withdrawDetail").html();
            laytpl(detailHtml).render(data, function(html) {
                layer.open({
                    type: 1,
                    title: '提现详情',
                    area: ['500px'],
                    content: html

                });
            })
        }

    });

    $(".withdrawal-record").click(function () {
        location.href = ns.url("shop/shopwithdraw/lists");
    });

</script>

<script type="text/html" id="withdrawDetail">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
        </colgroup>
        <tbody>
        <tr>
            <td>店铺名称</td>
            <td>{{d.site_name}}</td>
        </tr>
        <tr>
            <td>联系人</td>
            <td>{{d.name}}</td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td>{{d.mobile}}</td>
        </tr>
        <tr>
            <td>账户类型</td>
            {{# if(d.bank_type == 1){ }}
            <td>银行卡</td>
            {{# }else{ }}
            <td>支付宝</td>
            {{# } }}
        </tr>
        {{# if(d.bank_type == 1){ }}
        <tr>
            <td>账户名称</td>
            <td>{{d.settlement_bank_name}}</td>
        </tr>
        <tr>
            <td>提现账号</td>
            <td>{{d.settlement_bank_account_number}}</td>
        </tr>
        <tr>
            <td>开户名</td>
            <td>{{d.settlement_bank_account_name}}</td>
        </tr>
        {{# }else{ }}
        <tr>
            <td>支付宝用户名</td>
            <td>{{d.settlement_bank_account_name}}</td>
        </tr>
        <tr>
            <td>支付宝账号</td>
            <td>{{d.settlement_bank_account_number}}</td>
        </tr>
        {{# } }}
        <tr>
            <td>提现金额</td>
            <td>{{d.money}}元</td>
        </tr>
        <tr>
            <td>状态</td>
            {{# if(d.status == 0){ }}
            <td>待审核</td>
            {{# }else if(d.status == 1){ }}
            <td>待转账</td>
            {{# }else if(d.status == 2){ }}
            <td>已转账</td>
            {{# }else if(d.status == -1){ }}
            <td>已拒绝</td>
            {{# } }}
        </tr>
        <tr>
            <td>申请时间</td>
            <td>{{ ns.time_to_date(d.apply_time) }}</td>
        </tr>
        {{# if(d.status == 2){ }}
        <tr>
            <td>转账时间</td>
            <td>{{ ns.time_to_date(d.payment_time) }}</td>
        </tr>
        <tr>
            <td>转账凭证</td>
            <td><img src="{{ ns.img(d.paying_money_certificate) }}" alt=""></td>
        </tr>
        <tr>
            <td>转账凭证说明</td>
            <td>{{ d.paying_money_certificate_explain }}</td>
        </tr>
        {{# } }}
        <tr>
            <td>是否结算周期</td>
            {{# if(d.is_period == 0){ }}
            <td>否</td>
            {{# }else{ }}
            <td>是</td>
            {{# } }}
        </tr>
        <tr>
            <td>结算周期名称</td>
            <td>{{d.period_name}}</td>
        </tr>
        <tr>
            <td>备注</td>
            <td>{{d.memo}}</td>
        </tr>
        </tbody>
    </table>
</script>


</body>

</html>