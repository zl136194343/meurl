<?php /*a:2:{s:67:"/www/wwwroot/ls.chnssl.com/app/admin/view/notice/notice_select.html";i:1614518652;s:24:"app/admin/view/base.html";i:1661854360;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"赞有情")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'赞有情')); ?>">
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
	
<style>
	.notice-list {
		padding: 0 20px;
	}
</style>

</head>
<body>

<div class="notice-list">
	<table id="notice_list" lay-filter="notice_list"></table>
</div>


<script type="text/html" id="checkbox">
	{{# if($.inArray(d.id.toString(), selected_id_arr) != -1){ }}
	<input type="checkbox" data-notice-id="{{d.id}}" name="notice_checkbox" lay-skin="primary" lay-filter="notice_checkbox" checked>
	{{# }else{ }}
	<input type="checkbox" data-notice-id="{{d.id}}" name="notice_checkbox" lay-skin="primary" lay-filter="notice_checkbox">
	{{# } }}
	<input type="hidden" data-notice-id="{{d.id}}" name="notice_json" value='{{ JSON.stringify(d) }}' />
</script>

<script>
	var table, form, laytpl,
		select_id = "<?php echo htmlentities($select_id); ?>", //选中商品id
		selected_id_arr = select_id.length ? select_id.split(',') : [],
		select_list = [], //选中商品所有数据
		goodsIdArr = selected_id_arr;
	
	$(function () {
		layui.use(['form', 'laytpl'], function () {
			form = layui.form;
			laytpl = layui.laytpl;

			table = new Table({
				elem: '#notice_list',
				url: ns.url("admin/notice/index"),
				cols: [
					[
						{
							unresize: 'false',
							width: '10%',
							templet: '#checkbox'
						}, {
							width: '55%',
							title: '公告标题',
							unresize: 'false',
							templet: function(data) {
								var html = data.is_top ? '<span class="required">[ 置顶 ] </span>' : '';
								html += data.title;
								return html;
							}
						}, {
							width: '35%',
							title: '创建时间',
							unresize: 'false',
							templet: function(data) {
								return ns.time_to_date(data.create_time);
							}
						}
					]
				],
				callback : function () {
					// 更新商品复选框状态
					for (var i=0;i<goodsIdArr.length;i++) {
						var selected_notices = $("input[name='notice_checkbox'][data-notice-id='" + goodsIdArr[i] + "']");
						
						if (selected_notices.length) {
							$("input[name='notice_checkbox'][data-notice-id='" + goodsIdArr[i] + "']").prop("checked", true);
						}
					}
					
					form.render();
					initData();
				}

			});

			// 勾选商品
			form.on('checkbox(notice_checkbox)', function(data) {
				var notice_id = $(data.elem).attr("data-notice-id"), json = {};
				form.render();
				
				var noticeLen = $("input[name='notice_checkbox'][data-notice-id="+ notice_id +"]:checked").length;
				if (noticeLen){
					json = JSON.parse($("input[name='notice_json'][data-notice-id="+ notice_id +"]").val());
					delete json.LAY_INDEX;
					delete json.LAY_TABLE_INDEX;
					delete json.create_time;
					select_list.push(json);
					goodsIdArr.push(notice_id);
				} else{
					select_list.remove(notice_id);
					goodsIdArr.remove(notice_id);
				}
			});

			//初始化数据
			function initData(){
				var noticeLen = $("input[name='notice_checkbox'][data-notice-id]:checked").length;
				
				for (var i = 0; i < noticeLen; i++){
					var noticeId = $("input[name='notice_checkbox'][data-notice-id]:checked").eq(i).attr("data-notice-id");
					var ident = false;
					for (var k = 0; k < select_list.length; k++){
						if(select_list[k].id == noticeId){
							ident = true;
							break;
						}
					}

					if (ident) return;
					json = JSON.parse($("input[name='notice_json'][data-notice-id="+ noticeId +"]").val());
					delete json.LAY_INDEX;
					delete json.LAY_TABLE_INDEX;
					delete json.create_time;
					
					select_list.push(json);
				}
			}
		});
	});

	function selectGoods(callback) {
		var res = select_list;
		callback(res);
	}

	Array.prototype.indexOf = function(val) {
		for (var i = 0; i < this.length; i++) {
			if (this[i].id){
				if (this[i].id == parseInt(val)) return i;
			} else {
				if (this[i] == val) return i;
			}
		}
		return -1;
	};

	Array.prototype.remove = function(val) {
		var index = this.indexOf(val);
		if (index > -1) {
			this.splice(index, 1);
		}
	};

	select_list.__proto__ = Array.prototype;

	function removeDuplicates(arr){
		if (!Array.isArray(arr)) {
			console.log('type error!');
			return
		}
		var array = [];
		for (var i = 0; i < arr.length; i++) {
			if (array.indexOf(arr[i]) === -1) {
				array.push(arr[i])
			}
		}
		return array;
	}
</script>

</body>
</html>