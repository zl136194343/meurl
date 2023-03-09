<?php /*a:2:{s:74:"/www/wwwroot/www.hunqin.com/app/admin/view/goods/member_goods_collect.html";i:1614518650;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
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
	

</head>
<body>


<!-- 搜索框 -->
<div class="ns-single-filter-box">

    <div class="layui-form">
        <div class="layui-input-inline">
            <input type="text" name="search" placeholder="请输入商品名称" class="layui-input" autocomplete="off">
            <button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
                <i class="layui-icon">&#xe615;</i>
            </button>
        </div>
    </div>
</div>

<table id="good_list" lay-filter="good_list"></table>

<!-- 商品 -->
<script type="text/html" id="goodIntro">
    <div class="ns-table-title">
        <div class="ns-title-pic">
            {{#  if(d.sku_image){  }}
            <img layer-src src="{{ns.img(d.sku_image.split(',')[0],'small')}}"/>
            {{#  }  }}
        </div>
        <div class="ns-title-content">
            <a href="javascript:;" class="ns-multi-line-hiding ns-text-color">{{d.sku_name}}</a>
        </div>
    </div>
</script>


<script>
    var  form, table, laytpl;

    layui.use(['form', 'laytpl'], function() {
        form = layui.form;
        laytpl = layui.laytpl;
        form.render();

        table = new Table({
            elem: '#good_list',
            url: '<?php echo addon_url("admin/goods/membergoodscollect"); ?>',
            async : false,
            where: {'member_id': "<?php echo htmlentities($member_id); ?>"},
            parseData: function(res) {
                return {
                    "code": res.code,
                    "msg": res.message,
                    "count": res.data.count,
                    "data": res.data.list,
                };
            },
            cols: [
                [{
                    title: '商品',
                    unresize: 'false',
                    width: '30%',
                    templet: '#goodIntro'
                }, {
                    field: 'price',
                    title: '商品价格',
                    unresize: 'false',
                    width: '10%',
                    align: 'left',
                    templet: function(data) {
                        return '￥<span class="goods-price">'+ data.price +'</span>'
                    }
                }, {
                    title: '商品状态',
                    unresize: 'false',
                    width: '10%',
                    align: 'left',
                    templet: function(data) {
                        return data.goods_state == 1 ? '正常' : '下架';
                    }
                },{
                    title: '收藏量',
                    unresize: 'false',
                    width: '10%',
                    align: 'left',
                    templet: function(data) {
                        return data.collect_num;
                    }
                }, {
                    title: '收藏时间',
                    unresize: 'false',
                    width: '20%',
                    align: 'left',
                    templet: function(data){
                        return ns.time_to_date(data.create_time);
                    }
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
        });
    });
</script>

</body>
</html>