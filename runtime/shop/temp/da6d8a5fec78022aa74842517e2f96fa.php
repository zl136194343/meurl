<?php /*a:2:{s:75:"/www/wwwroot/ls.chnssl.com/app/shop/view/shopacceptmessage/member_list.html";i:1614518768;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
	
<style>
	.ns-reason-box p{white-space: normal;line-height: 1.5;}
	.layui-table-header .layui-table-cell{overflow: inherit;}
	.ns-prompt .iconfont{font-size: 16px;color: rgba(0,0,0,0.7);cursor: pointer;font-weight: 500;margin-left: 3px;}
	.layui-form-item .layui-form-checkbox[lay-skin=primary] {margin-top: 0;}
</style>

</head>

<body>


<!-- 添加会员 -->
<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">手机号：</label>
					<div class="layui-input-inline">
						<input type="text" name="mobile" placeholder="手机号" autocomplete="off" class="layui-input ">
					</div>
				</div>
			</div>
			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
			</div>
		</form>
	</div>
</div>

<table id="member_list" lay-filter="member_list"></table>

<!-- 用户信息 -->
<script type="text/html" id="userdetail">
	<div class='ns-table-title'>
		<div class='ns-title-pic'>
            <img layer-src src="{{ns.img(d.headimg)}}" onerror="this.src = 'https://ls.chnssl.com/app/shop/view/public/img/default_headimg.png' ">
		</div>
		<div class='ns-title-content'>
			<p class="layui-elip">{{d.nickname}}</p>
		</div>
	</div>
</script>

<!-- 手机号 -->
<script type="text/html" id="mobile">
	<div class='ns-table-title'>
		{{# if(d.mobile){ }}
		<span>{{ d.mobile }}</span>
		{{# }else{ }}
		<span style="color: red;">未绑定（不能接收短信消息）</span>
		{{# } }}
	</div>
</script>
<!-- 邮箱 -->
<script type="text/html" id="email">
	<div class='ns-table-title'>
		{{# if(d.email){ }}
		<span>{{ d.email }}</span>
		{{# }else{ }}
		<span style="color: red;">未绑定（不能接收邮箱消息）</span>
		{{# } }}
	</div>
</script>
<!-- 微信公众号 -->
<script type="text/html" id="wx_openid">
	<div class='ns-table-title'>
		{{# if(d.wx_openid != ''){ }}
		<span style="color: green;">已绑定</span>
		{{# }else{ }}
		<span style="color: red;">未绑定（不能接收微信公众号消息）</span>
		{{# } }}
	</div>
</script>

<!-- 工具栏操作 -->
<script type="text/html" id="operation">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="add">添加</a>
	</div>
</script>


<script type="text/javascript">
	var table, form, laytpl, laydate,
		repeat_flag = false;

	layui.use(['form', 'laytpl', 'laydate'], function() {
		form = layui.form;
		laytpl = layui.laytpl;
		form.render();

		table = new Table({
			elem: '#member_list',
			url: ns.url("shop/shopacceptmessage/memberlist"),
			cols: [
				[
                    {
                        field: 'userdetail',
                        title: '账户',
                        width: '25%',
                        unresize: 'false',
                        templet: '#userdetail'
					}, {
						title: '手机号',
						unresize: 'false',
						templet: "#mobile"
					}, {
						title: '微信openid',
						unresize: 'false',
						templet: "#wx_openid"
					}, {
						title: '操作',
						width: '10%',
						unresize: 'false',
						toolbar: '#operation'
					}
				]
			]
		});

		/**
		 * 监听工具栏操作
		 */
		 table.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {

				case 'add': //添加
					addShopMember(data.member_id);
					break;
			}
		});

		/**
		 * 添加商家会员
		 */
		function addShopMember(member_id) {
			layer.confirm('添加后该会员将接收消息通知',{shade: 0},function() {
				if (repeat_flag) return false;
				repeat_flag = true;
				$.ajax({
					url: ns.url("shop/shopacceptmessage/add"),
					data: {member_id:member_id},
					dataType: 'JSON',
					type: 'POST',
					success: function(res) {
						layer.msg(res.message);
						repeat_flag = false;

						if (res.code == 0) {
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
						}
					}
				});
			}, function () {
				layer.close();
				repeat_flag = false;
			});
		}

		/**
		 * 搜索功能
		 */
		form.on('submit(search)', function(data) {
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
			return false;
		});

	});

</script>


</body>

</html>