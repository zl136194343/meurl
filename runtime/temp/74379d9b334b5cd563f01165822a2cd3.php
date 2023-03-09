<?php /*a:2:{s:72:"/www/wwwroot/www.hunqin.com/addon/fenxiao/admin/view/fenxiao/change.html";i:1614520060;s:24:"app/admin/view/base.html";i:1666314447;}*/ ?>
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
	.ns-screen {
		margin-top: 15px;
	}
</style>

</head>
<body>

<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				
				<div class="layui-inline">
					<label class="layui-form-label">分销商名称：</label>
					<div class="layui-input-inline">
						<input type="text" id="fenxiao_name" name="fenxiao_name" placeholder="请输入分销商店铺名" class="layui-input">
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">上级分销商：</label>
					<div class="layui-input-inline">
						<input type="text" name="parent_name" placeholder="请输入上级分销商" class="layui-input">
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">分销等级：</label>
					<div class="layui-input-inline">
						<select name="level_id" lay-filter="level_id">
							<option value="">全部</option>
							<?php if(is_array($level_list) || $level_list instanceof \think\Collection || $level_list instanceof \think\Paginator): $i = 0; $__LIST__ = $level_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo htmlentities($level['level_id']); ?>"><?php echo htmlentities($level['level_name']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">分销商状态：</label>
					<div class="layui-input-inline">
						<select name="status" lay-filter="status">
							<option value="">全部</option>
							<option value="1">正常</option>
							<option value="-1">已冻结</option>
						</select>
					</div>
				</div>
				
				<div class="layui-inline">
					<label class="layui-form-label">添加时间：</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_time"  id="start_time" autocomplete="off" placeholder="开始时间" readonly>
						<i class="ns-calendar"></i>
					</div>
					<div class="layui-form-mid">-</div>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="end_time" id="end_time" autocomplete="off" placeholder="结束时间" readonly>
						<i class="ns-calendar"></i>
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

<table id="fenxiao_list" lay-filter="fenxiao_list"></table>

<input type="hidden" value="" id="param" />

<!-- 状态 -->
<script type="text/html" id="status">
	{{# if(d.status == 1){ }}
	<span style="color: green;">正常</span>
	{{# }else if(d.status == -1){ }}
	<span style="color: gray;">冻结</span>
	{{# } }}
</script>

<!-- 工具栏操作 -->
<script type="text/html" id="operation">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="confirm">变更</a>
	</div>
</script>


<script>
	var repeat_flag = false;
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
			url: ns.url("fenxiao://admin/fenxiao/change"),
			where:{
                member_id : "<?php echo htmlentities($member_id); ?>"
			},
			cols: [
				[{
					field: 'fenxiao_name',
					title: '分销商名称',
					unresize: 'false',
					width: '15%'
				}, {
					field: 'parent_name',
					title: '上级分销商',
					unresize: 'false',
					width: '15%',
					templet: function(data) {
						if(data.parent_name){
							return data.parent_name;
						}else{
							return '无';
						}
					}
				}, {
					field: 'level_name',
					title: '分销等级',
					unresize: 'false',
					width: '10%'
				}, {
					field: 'status',
					title: '当前状态',
					templet: '#status',
					unresize: 'false',
					width: '10%'
				}, {
					field: 'create_time',
					title: '添加时间',
					unresize: 'false',
					width: '15%',
					templet: function(data) {
						return ns.time_to_date(data.create_time);
					}
				}, {
					title: '操作',
					toolbar: '#operation',
					unresize: 'false',
					width: '10%'
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

				case 'confirm': //确认更改上下级关系
					layer.confirm('确定要将该分销商变更为上级分销商吗?', function () {
						if (repeat_flag) return;
						repeat_flag = true;
						
						$.ajax({
							url: ns.url("fenxiao://admin/fenxiao/confirmChange"),
							data: {
							    parent:data.fenxiao_id,
								member_id:"<?php echo htmlentities($member_id); ?>"
							},
							dataType: 'JSON',
							type: 'POST',
							async: false,
							success: function(res) {
								layer.msg(res.message);
								repeat_flag = false;
								if (res.code == 0) {
								    $("#param").val(1);
                                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                    parent.layer.close(index); //再执行关闭
								}
							}
						});
					});
					break;
			}
		});
	});

	function fun(callback) {
        var param = $("#param").val();
        callback(param);
    }
</script>

</body>
</html>