<?php /*a:2:{s:63:"/www/wwwroot/www.hunqin.com/app/admin/view/config/customer.html";i:1666065759;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"婚业汇联管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'婚业汇联管理系统')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/admin/view/public/img/"
		};

	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
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
	.table_body {
		font-family: arial;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.goods-category-list .layui-table td {
		border-left: 0;
		border-right: 0;
	}
	.goods-category-list .layui-table .switch {
		font-size: 16px;
		cursor: pointer;
		width: 12px;
		line-height: 1;
		display: inline-block;
		text-align: center;
		vertical-align: middle;
	}
	.goods-category-list .layui-table img {width: 40px;}
	.goods-category-list .layui-table td {
		border-left: 0;
		border-right: 0;
	}
	.goods-category-list .layui-table .switch {
		font-size: 16px;
		cursor: pointer;
		width: 12px;
		line-height: 1;
		display: inline-block;
		text-align: center;
		vertical-align: middle;
	}
	.goods-category-list .layui-table img {width: 40px;}
	/* 分类样式 */
	.table_div{
		color:#666
	}
	.table_head{
		display: flex;
		font-weight: bold;
		background-color: #F7F7F7;
	}
	.table_head li{
		height: 40px;
		line-height: 40px;
		border: 0;
		border-bottom: 1px solid #e6e6e6;
		padding: 9px 15px;
		font-size: 14px;
		
	}
	.table_head li:first-child{
		padding-right: 0;
		
	}
	.table_tr{
		display: flex;
		border-bottom: 1px solid #e6e6e6;
	}
	.table_tr .table_td{
		position: relative;
		padding: 11px 15px 8px;
		min-height: 30px;
		line-height: 33px;
		font-size: 14px;
	}
	.table_tr .table_td span{
		cursor: pointer;
	}
	.table_tr .table_td span>img{
		width:12px;
		height:12px
	}
	.table_tr .table_td span>img.rotate{
		transform:rotate(90deg);
	}
	.table_tr .table_td .ns-img-box{
		width:30px;
		height:30px;
		line-height: 30px;
	}
	.table_tr .table_td:first-child{
		padding-right:0
	}
	.table_tr .ns-table-btn {
	    display: flex;
	    flex-wrap: wrap;
	}
	.table_tr .layui-btn {
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    height: 23px;
	    border-radius: 50px;
	    background-color: transparent;
	    color: #4685FD;
	    text-align: center;
	    padding: 2px 8px 2px 0;
	    margin: 5px 0 5px 5px;
	    position: relative;
	}
	.table_two_div{
		display: none;
	}
	.table_three{
		display: none;
	}
	.empty_switch{
		display: inline-block;
		width:30px;
		height:25px;
		padding-right:15px;
	}
	.js-switch{display: inline-block;height:30px;width:30px;text-align: center;}
	.table_move{
		cursor: move;float:left;margin-right: 10px;
	}
	.table_moves{
		cursor: move;float:left;margin-right: 10px;
	}
	.tables_move{
		cursor: move;float:left;margin-right: 20px;padding-left: 70px;
	}
</style>

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://xyhl.chnssl.com/app/admin/view/public/img/logo.png">-->
	</div>
	<span>婚业汇联管理系统</span>
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
						<img src="https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
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
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>客户服务项目分类由平台端进行维护</li>
		</ul>
	</div>
</div>
<div class="ns-single-filter-box">
	<button class="layui-btn ns-bg-color" onclick="addCategory()">添加服务项目分类</button>
</div>
<div class="goods-category-list layui-table-view">
	<div class="table_div" >
		<ul class="table_head">
			<li style="width:30px"></li>
			<li style="flex:6">分类名称</li>
			<!-- <li style="flex:2">排序</li> -->
			<li style="flex:2">是否显示</li>
			<li style="flex:2">操作</li>
		</ul>
		<div  class="table_body">
			<?php if($list): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $index=>$vo): ?>
			<div class="table_one" data-index="<?php echo htmlentities($index); ?>" data-sort="<?php echo htmlentities($vo['sort']); ?>" data-cateid="<?php echo htmlentities($vo['id']); ?>">
				<div class="table_tr">
					<div class="table_td" style="width:30px"><?php echo htmlentities($vo['id']); ?></div>
					<div class="table_td" style="flex:6"><?php echo htmlentities($vo['type_name']); ?></div>
					
					<div class="table_td" style="flex:2">
						<?php if($vo['is_show'] == 0): ?>是<?php else: ?>否<?php endif; ?>
					</div>
					
					<div class="table_td" style="flex:2">
						<div class="ns-table-btn">
							<a class="layui-btn" href="<?php echo addon_url('admin/config/editCategory',['id'=>$vo['id']]); ?>">编辑</a>
							<a class="layui-btn" href="javascript:deleteCategory(<?php echo htmlentities($vo['id']); ?>);">删除</a>
						</div>
					</div>
				</div>
			</div>
			
			<?php endforeach; endif; else: echo "" ;endif; else: ?>
			<div class="table_tr">
				<div class="table_td" style="flex:1;text-align: center;">暂无数据</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
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


<script src="https://xyhl.chnssl.com/public/static/ext/drag-arrange.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/diyview/js/ddsort.js"></script>
<script>

	$(function() {
		var tempPos = '';
		$('.table_one').arrangeable({
			dragSelector: '.table_move',
			callback:function(e){
				var temparr = [];
				$('.table_one').each(function(index,item){
					var tempObj = {};
					tempObj.category_id = item.getAttribute('data-cateid');
					tempObj.sort = index;
					temparr.push(tempObj)
				});
				setTimeout(function(){
					$.ajax({
						url: ns.url("admin/goodscategory/modifySort"),
						data: {category_sort_array : JSON.stringify(temparr)},
						dataType: 'JSON',
						type: 'POST',
						async: false,
						success: function (res) {
							layer.msg(res.message);
						}
					});
				},100);
			}
		});
		$('.table_two').arrangeable({
			dragSelector: '.table_moves',
			callback:function(e){
				var temparrs = [];
				$('.table_two').each(function(index,item){
					var tempObjs = {};
					tempObjs.category_id = item.getAttribute('data-cateid');
					tempObjs.sort = index;
					temparrs.push(tempObjs)
				})
				console.log(temparrs);
				setTimeout(function(){
					$.ajax({
						url: ns.url("admin/goodscategory/modifySort"),
						data: {category_sort_array : JSON.stringify(temparrs)},
						dataType: 'JSON',
						type: 'POST',
						async: false,
						success: function (res) {
							layer.msg(res.message);
						}
					});
				},100);
			}
		});
		$('.table_three_tr').arrangeable({
			dragSelector: '.tables_move',
			callback:function(e){
				var temparres = [];
				$('.table_three_tr').each(function(index,item){
					var tempObjes = {};
					tempObjes.category_id = item.getAttribute('data-cateid');
					tempObjes.sort = index;
					temparres.push(tempObjes)
				})
				console.log(temparres);
				setTimeout(function(){
					$.ajax({
						url: ns.url("admin/goodscategory/modifySort"),
						data: {category_sort_array : JSON.stringify(temparres)},
						dataType: 'JSON',
						type: 'POST',
						async: false,
						success: function (res) {
							layer.msg(res.message);
						}
					});
				},100);
			}
		});
	});

$(function () {
	loadImgMagnify();  //图片放大
	
	//展开收齐点击事件
	$(".js-switch").click(function () {
		var category_id = $(this).attr("data-category-id");
		var level = $(this).attr("data-level");
		var open = parseInt($(this).attr("data-open").toString());
		if(open){
			$(".goods-category-list .layui-table tr[data-category-id-"+ level+"='" + category_id + "']").hide();
			// $(this).children("img").removeClass('rotate');
			$(this).text("+");
			if(level == 1) $(this).parents('.table_tr').siblings('.table_two_div').hide();
			else if(level == 2) $(this).parents('.table_tr').siblings('.table_three').hide();
			
		}else{
			$(".goods-category-list .layui-table tr[data-category-id-"+ level+"='" + category_id + "']").show();
			$(this).text("-");
			// $(this).children("img").addClass('rotate');
			if(level == 1) $(this).parents('.table_tr').siblings('.table_two_div').show();
			else if(level == 2) $(this).parents('.table_tr').siblings('.table_three').show();
			
		}
		$(this).attr("data-open", (open ? 0 : 1));
		
	});
});

// var tempPos = '';
// bindDragSort('.table_body' ,'.table_one');
// bindDragSort('.table_two_div' ,'.table_two');
// bindDragSort('.table_three' ,'.table_tr');
// function bindDragSort(paremtElem,childElem){
// 	$(paremtElem ).DDSort({
// 	    target: childElem,
// 	    floatStyle: {
// 	        'border': '1px solid #ccc',
// 	        'background-color': '#fff'
// 	    },
// 		down:function(e){
// 			tempPos = $(this).data('sort');
// 		},
// 		up:function(e){
// 			var index = $(this).index(),self = $(this);
// 			if(index != tempPos){
// 				var temparr = [];
// 				$(childElem).each(function(index,item){
// 					var tempObj = {};
// 					tempObj.category_id = item.getAttribute('data-cateid');
// 					tempObj.sort = index;
// 					temparr.push(tempObj)
// 				});
// 				setTimeout(function(){
// 					$.ajax({
// 						url: ns.url("admin/goodscategory/modifySort"),
// 						data: {category_sort_array : JSON.stringify(temparr)},
// 						dataType: 'JSON',
// 						type: 'POST',
// 						async: false,
// 						success: function (res) {
// 							self.data('sort',index);
// 							layer.msg(res.message);
// 						}
// 					});
// 				},100);
// 			}
//
// 		}
// 	});
// }

function deleteCategory(category_id,level) {
	
	layer.confirm('子级分类也会删除，请谨慎操作', function() {
		$.ajax({
			url: ns.url("admin/config/deleteCategory"),
			data: {category_id : category_id},
			dataType: 'JSON',
			type: 'POST',
			async: false,
			success: function (res) {
				layer.msg(res.message);
				if (res.code == 0) {
					location.reload();
				}
			}
		});
	});
}
function addCategory() {
	location.href = ns.url("admin/config/addcategory");
}

// 监听单元格编辑
function editSort(category_id) {
    var sort = $("#category_sort"+category_id).val();

    if (!new RegExp("^-?[1-9]\\d*$").test(sort)) {
        layer.msg("排序号只能是整数");
        return;
    }
    if(sort<0){
        layer.msg("排序号必须大于0");
        return ;
    }
    $.ajax({
        type: 'POST',
        url: ns.url("admin/goodscategory/modifySort"),
        data: {
            sort: sort,
            category_id: category_id
        },
        dataType: 'JSON',
        success: function(res) {
            layer.msg(res.message);
            if (res.code == 0) {
                location.reload();
            }
        }
    });
}
</script>

</body>
</html>