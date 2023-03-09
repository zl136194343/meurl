<?php /*a:3:{s:68:"/www/wwwroot/ls.chnssl.com/addon/fenxiao/admin/view/goods/lists.html";i:1614520034;s:24:"app/admin/view/base.html";i:1660099950;s:78:"/www/wwwroot/ls.chnssl.com/addon/fenxiao/admin/view/goods/category_select.html";i:1614520032;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞友情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞友情')); ?>">
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
	

</head>
<body>

<div class="ns-logo">
	
	<span>赞友情平台端</span>

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
				

<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">筛选</h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">搜索方式：</label>
					<div class="layui-input-inline">
						<select name="search_text_type">
							<option value="goods_name">商品名称</option>
							<option value="site_name">店铺名称</option>
						</select>
					</div>
					<div class="layui-input-inline">
						<input type="text" name="search_text" autocomplete="off" class="layui-input" placeholder="输入商品名称/店铺名称" />
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
					<label class="layui-form-label">商品分类：</label>
					<div class="layui-input-inline">
						<style>
    .goods-category-container {display: inline-block;position: relative;z-index: 10}
    .goodsCategory{width: 185px;height: 300px;border: 1px solid #CCCCCC;position: absolute;z-index: 100;background: #fff;right: 0;overflow-y: auto;top: 34px;box-sizing: border-box}
    .goodsCategory::-webkit-scrollbar{width: 3px;}
    .goodsCategory::-webkit-scrollbar-track{-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);border-radius: 10px;background-color: #fff;}
    .goodsCategory::-webkit-scrollbar-thumb{height: 20px;border-radius: 10px;-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);background-color: #ccc;}
    .goodsCategory ul{height: 280px;margin-top: -2px;margin-left: 0;}
    .goodsCategory ul li{text-align: left;padding:0 10px;line-height: 30px;}
    .goodsCategory ul li i{float: right;line-height: 30px;}
    .goodsCategory ul li:hover{cursor: pointer;}
    .goodsCategory ul li:hover,.goodsCategory ul li.selected{background: #4685FD;color: #fff;}
    .goodsCategory ul li span{width: 110px;display: inline-block;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;vertical-align: middle;font-size:12px;}
    .one{left: 0;}
    .two{left: 185px;border-left:0;}
    .three{left: 326px;width: 185px;border-left:0;}
    .selectGoodsCategory{width: 185px;height: 45px;border:1px solid #CCCCCC;position: absolute;z-index: 100;left: 0;margin-top: 296px;box-sizing: border-box;border-collapse: collapse;background: #fff;}
    .selectGoodsCategory a{height: 30px;text-align: center;color: #fff;line-height: 30px; margin: 6px;padding: 0 5px;text-decoration:none;}
    .goodsCategory ul li i {float: right;line-height: 30px;}
    .hide {display: none;}
    .goods-category-mask {width: 100%;height: 100%;position: fixed;left: 0;top: 0;z-index: 9;}
	.confirm-select {border: 1px solid #4685FD;}
</style>
<div class="goods-category-container">
    <input type="text" autocomplete="off" show="false" class="layui-input select-category" placeholder="全部" readonly />
    <input type="hidden"  id="select_category_id">
    <input type="hidden"  name="category_id">
    <div class="category-wrap hide">
        <div class="goodsCategory one goodsCategory_1">
            <ul></ul>
        </div>
        <div class="goodsCategory goodsCategory_2 two hide" style="border-left:0;">
            <ul></ul>
        </div>
        <div class="goodsCategory goodsCategory_3 three hide">
            <ul></ul>
        </div>
        <div class="selectGoodsCategory">
            <a href="javascript:;" style="float:right;"  class="ns-bg-color confirm-select">确认选择</a>
            <a href="javascript:;" style="float:right;"  class="layui-btn-primary ns-text-color cancel-select">清空</a>
        </div>
    </div>
</div>
<div class="goods-category-mask hide"></div>

<script>
$(function() {
    getCategoryTree(1, 0);
});

//初始化分类
function getCategoryTree(level, pid) {
    $.ajax({
        url : ns.url("admin/goodscategory/getCategoryByParent"),
        dataType: 'JSON',
        type: 'POST',
        data: {'level':level, 'pid':pid},
        async: false,
        success: function(data) {
            var category_html = '';
            if(data['data']) {
                $.each(data.data, function(category_key, category_val) {
                    //一级分类
                    category_html += '<li data-value="'+category_val.category_id+'" data-level="'+level+'" pid="'+pid+'" child="'+(category_val.child_count >0)+'">';
                    category_html += '<span>'+category_val.category_name+'</span>';
                    if(category_val.child_count > 0) {
                        category_html += '<i class="layui-icon-right layui-icon"></i>';
                    }
                    category_html += '</li>';
                })
            }
            $('.goodsCategory_'+level+' ul').html(category_html);
        }
    })
}

$("body").on('click', '.goodsCategory ul li', function(){
    var level = $(this).attr('data-level');
    var value = $(this).attr('data-value');
    $('.goodsCategory_2,.goodsCategory_3').addClass('hide');
    if($(this).attr('child') == 'true') {
        getCategoryTree(parseInt(level)+1, value);
        $('.goodsCategory_'+(parseInt(level)+1)+' ul li').addClass('hide');
        $('.goodsCategory_'+(parseInt(level)+1)+' ul li[pid="'+value+'"]').removeClass('hide');
        $('.goodsCategory_'+level).removeClass('hide');
        $('.goodsCategory_'+(parseInt(level)+1)).removeClass('hide');
    }else {
        $('.category-wrap,.goods-category-mask').addClass('hide');
    }
    $('.goodsCategory_'+level+' ul li').removeClass('selected');
    $('.goodsCategory_'+(parseInt(level)+1) + ' ul li').removeClass('selected');
    $('.goodsCategory_'+(parseInt(level)+2) + ' ul li').removeClass('selected');
    $(this).addClass('selected');
    categoryBottom();
    setSelectCaregory();
});

//设置选中分类
function setSelectCaregory() {
    var text = '';
    var level_text_1 = '';
    var level_text_2 = '';
    var level_text_3 = '';
    var select_id = '';
    $('.goodsCategory ul li.selected').each(function(i, e) {
        var level = $(e).attr('data-level');
        if(level == 1) {
            level_text_1 = $(e).find('span').text() + '>';
            select_id += $(e).attr('data-value') +',';
        }
        if(level == 2) {
            level_text_2 = $(e).find('span').text() + '>';
            select_id += $(e).attr('data-value') +',';
        }
        if(level == 3) {
            level_text_3 = $(e).find('span').text();
            select_id += $(e).attr('data-value') +',';
        }
    });
    $('.select-category').val(level_text_1+level_text_2+level_text_3);
    select_id = select_id.substring(0,select_id.length-1);
    $('#select_category_id').val(select_id);
    var category_arr = select_id.split(',');
    $('input[name="category_id"]').val(category_arr.pop());
}

$("body").on('focus', '.select-category', function() {
    $('.category-wrap, .goods-category-mask').removeClass('hide');
    var select_id =  $('#select_category_id').val();
    var category_arr = select_id.split(',');

    $.each(category_arr, function(i, e) {
        var level = parseInt(i)+1;
        $('.goodsCategory_'+level).removeClass('hide');
        $('.goodsCategory_'+level+' ul li[data-value="'+e+'"]').addClass('selected');
    });
    categoryBottom();
});

$("body").on('keyup', '.select-category', function() {
	if($(this).val().length==0) {
		$('#select_category_id').val("");
		$('input[name="category_id"]').val("");
	}
});

function categoryBottom() {
    var num = $('.goodsCategory.hide').length;
    $('.selectGoodsCategory').css('width', 185*(3-num)+'px');
}

$('body').on('click', '.confirm-select', function () {
    setSelectCaregory();
    $('.category-wrap,.goods-category-mask').addClass('hide');
});
$('body').on('click', '.goods-category-mask', function () {
    $('.category-wrap,.goods-category-mask').addClass('hide');
});
$('body').on('click', '.cancel-select', function () {
    $('.category-wrap, .goods-category-mask').addClass('hide');
	$(".select-category").val("");
});
</script>
					</div>
				</div>
			</div>

			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">商品品牌：</label>
					<div class="layui-input-inline">
						<select name="goods_brand" lay-search="">
							<option value="">全部</option>
							<?php foreach($goods_brand as $v): ?>
							<option value="<?php echo htmlentities($v['brand_id']); ?>"><?php echo htmlentities($v['brand_name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

			</div>

			<input type="hidden" name="goods_state" />
			<input type="hidden" name="verify_state" />

			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit id="" lay-filter="search">筛选</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	</div>
</div>
<div class="layui-tab ns-table-tab" lay-filter="fenxiao_goods_tab">
	<div class="layui-tab-content">
		<table id="fenxiao_list" lay-filter="fenxiao_list"></table>
	</div>
</div>

<!-- 商品 -->
<script type="text/html" id="goods_info">
	<div class="ns-table-tuwen-box">
		<div class="ns-img-box">
			<img layer-src src="{{ns.img(d.goods_image.split(',')[0])}}"/>
		</div>
		<div class="ns-font-box">
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.goods_name}}">{{d.goods_name}}</a>
		</div>
	</div>
</script>

<!-- 状态 -->
<script type="text/html" id="status">
	{{# if(d.status == 0){ }}
		<span style="color: red;">待审核</span>
	{{# }else if(d.status == 1){ }}
		<span style="color: green;">审核通过</span>
	{{# }else if(d.status == 2){ }}
		<span style="color: gray;">审核拒绝</span>
	{{# }else if(d.status == -1){ }}
	<span style="color: gray;">冻结</span>
	{{# } }}
</script>

<!-- 工具栏操作 -->
<script type="text/html" id="action">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="detail">查看</a>
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


<script>
	layui.use(['form', 'laydate'], function() {
		var table,
			form = layui.form,
			laydate = layui.laydate;
		form.render();

		//渲染时间
		laydate.render({
			elem: '#start_time',
			type: 'datetime'
		});

		laydate.render({
			elem: '#end_time',
			type: 'datetime'
		});

		table = new Table({
			elem: '#fenxiao_list',
			url: ns.url("fenxiao://admin/goods/lists"),
			cols: [
				[{
					title: '商品名称',
					unresize: 'false',
                    templet: '#goods_info',
					width:'20%'
				}, {
					field: 'site_name',
					title: '店铺名称',
					unresize: 'false',
					width:'15%'
				}, {
					field: 'price',
					title: '价格',
					unresize: 'false',
					align: 'right',
					width:'10%',
					templet: function(data) {
						return '￥'+data.price;
					}
				}, {
					unresize: 'false',
					width:'5%'
				}, {
					field: 'goods_stock',
					title: '库存',
					unresize: 'false',
					width:'10%'
				},{
					field: 'sale_num',
					title: '销量',
					unresize: 'false',
					width:'10%'
				}, {
                    title: '是否参与',
                    unresize: 'false',
                    width:'10%',
                    templet: function(data) {
                        if(data.is_fenxiao == 0){
							return '不参与';
						}else{
                            return '参与';
						}
                    }
                }, {
					title: '分销规则',
					unresize: 'false',
					width:'10%',
					templet: function(data) {
						if(data.fenxiao_type == 1){
							return '默认规则';
						}else if(data.fenxiao_type == 2){
							return '单独设置';
						}
					}
				}, {
					title: '操作',
					toolbar: '#action',
					unresize: 'false',
					width:'10%'
				}]
			]
		});

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

		/**
		 * 监听工具栏操作
		 */
		table.tool(function(obj) {
			var data = obj.data,
			event = obj.event;
			switch (event) {
				case 'detail': //查看
					location.href = ns.url('fenxiao://admin/goods/detail', {'goods_id': data.goods_id});
					break;
			}
		});
	});

	function clickAdd() {
		location.href = ns.url("admin/shop/addShop");
	}
</script>

</body>
</html>