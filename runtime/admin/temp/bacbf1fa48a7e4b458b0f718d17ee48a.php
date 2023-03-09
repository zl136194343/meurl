<?php /*a:2:{s:60:"/www/wwwroot/www.hunqin.com/app/admin/view/member/order.html";i:1614515914;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
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
    <div class="layui-form" lay-filter="trade_search">
        <div class="layui-input-inline ns-len-mid">
            <input type="text" id="search_text" name="search_text" placeholder="订单编号" autocomplete="off" class="layui-input ">
		    <button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
		        <i class="layui-icon">&#xe615;</i>
		    </button>
        </div>
    </div>
</div>

<table id="trade_list" lay-filter="trade_list"></table>

<!-- 工具栏操作 -->
<script type="text/html" id="action">
    <div class="ns-table-btn">
        <a class="layui-btn" lay-event="detail">详情</a>
    </div>
</script>


<script>
    layui.use(['form'], function() {
        var table,
            form = layui.form;

        table = new Table({
            elem: '#trade_list',
            url: ns.url("admin/order/tradelist"),
            where : {member_id:"<?php echo htmlentities($member_id); ?>"},
            cols: [
                [{
                    field: 'order_no',
                    title: '订单编号',
                    width:170,
                    unresize: 'false'
                },{
                    field: 'site_name',
                    title: '店铺名称',
                    unresize: 'false'
                }, {
                    field: 'order_name',
                    title: '商品信息',
                    unresize: 'false'
                }, {
                    field: 'order_money',
                    title: '订单金额',
                    unresize: 'false'
                }, {
                    field: 'pay_money',
                    title: '实际支付金额',
                    unresize: 'false'
                }, {
                    field: 'balance_money',
                    title: '使用余额',
                    unresize: 'false'
                }, {
                    field: 'order_type_name',
                    title: '订单类型',
                    unresize: 'false'
                },{
                    field: 'order_status_name',
                    title: '订单状态',
                    unresize: 'false'
                },{
                    field: 'create_time',
                    title: '下单时间',
                    width:200,
                    templet: function(data) {
                        return ns.time_to_date(data.create_time)
                    }
                }, {
                    title: '操作',
                    width: '10%',
                    unresize: 'false',
                    toolbar: '#action'
                }]
            ]
        });

        /**
         * 监听工具栏操作
         */
        table.tool(function(obj) {
            var data = obj.data;
            switch (obj.event) {
                case 'detail': //详情
                    var url = "admin/order/detail";
                    window.open(ns.url(url,{order_id:data.order_id}));
                    break;
            }
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
    })
</script>

</body>
</html>