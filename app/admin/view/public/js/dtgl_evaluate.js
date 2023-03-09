Evaluate = function(limit, limits) {
	var limit = limit || 0;
	var limits = limits || [];
	var _this = this;
	_this.listCount = 0;
	_this.page = 1;
	_this.limit = !limit ? 10 : limit;
	_this.limits = limits;
};

// var n = 1;
Evaluate.prototype.getList = function(d) {
	var _this = d._this,
		page = _this.page,
		limit = _this.limit;
	explain_type = d.explain_type == null ? '' : d.explain_type,
		search_type = d.search_type == null ? '' : d.search_type,
		search_text = d.search_text == null ? '' : d.search_text;

	$.ajax({
		url: ns.url("admin/dtgl/comment"),
		data: {
			"page": page,
			"limit": limit,
			"explain_type": explain_type,
			"search_type": search_type,
			"search_text": search_text,
		},
		type: "POST",
		dataType: "JSON",
		async: false,
		success: function (res) {
			_this.listCount = res.data.count;
			$(".ns-evaluate-table").find("tbody").empty();
			var d = res.data.list;

			if (d.length == 0) {
				var htmls = '<tr><td colspan="4" align="center">无数据</td></tr>';
				$(".ns-evaluate-table").find("tbody").append(htmls);
			}

			for (var i = 0;i<d.length ;i++) {
				var html = '';
				html += '<tr>' +
					'<input class="evaluate_id" type="hidden" value=' + d[i].id + ' />' +
					'<td colspan="4">' +
					'<div class="ns-evaluate-title">' +
					'<input type="checkbox" name="evaluate" value=' + d[i].id + ' lay-skin="primary" lay-filter="evaluate" ' + ($("input[name='check_all']").is(":checked") ? "checked" : "") + ' />' +
					'<p>评论时间：' + ns.time_to_date(d[i].create_time) + '</p>' +
					'<p>用户姓名：' + d[i].member_name + '</p>'

				html +=			'</div>' +
					'</td>' +
					'</tr>';

				html += '<tr id="eva_'+ i +'">';
				html += '<td>';
				html += '<div class="ns-evaluate">'+
					'<span class="again-evaluate required">[用户评论]</span>'
				if(d[i].pid != 0){
					html+= '<p>回复'+d[i].p_member_name+ ' : ' + d[i].content +'</p>'
				}else{
					html +='<p>' + d[i].content + '</p>'
				}

				html +='</div>';


				html += '</td>';
				html += '<td>' +
					'<div class="ns-table-tuwen-box">' +
					'<div class="ns-font-box">' +
					'<p>动态标题：' + d[i].zp_title + '</p>' +
					'</div>' +
					'</div>' +
					'</td>';
				var audit = "已审核";
				var audit_action = '';
				if(d[i].is_status == 0){
					audit = "未审核";
					audit_action = '<a class="default layui-btn" onclick="audit(this,1)">通过</a>';
					audit_action += '<a class="default layui-btn" onclick="audit(this,-1)">拒绝</a>';
				}else if(d[i].is_status == 1){
					audit = "审核通过";
				}else if(d[i].is_status == -1){
					audit = "审核拒绝";
				}

				html += '<td>' + audit + '</td>';
				html += '<td><div class="ns-table-btn">';
				html += audit_action;
				if(d[i].is_status == 1) {
					html += '<a class="default layui-btn" lay-event="del" onclick="delEvaluate(this)">删除</a>'
				}

				html +=	'</div></td>';
				html += '</tr>';
				$(".ns-evaluate-table").find("tbody").append(html);
			}

			layui.use(['form', 'layer', 'laypage'],function(){
				var form = layui.form,
					layer = layui.layer,
					laypage = layui.laypage;
				form.render();

				layer.photos({
					photos: '.ns-img-box',
					anim: 5
				});

				// laypage.render({
				// 	elem: 'laypage',
				// 	count: d.length
				// })
			});
		}
	});
};

Evaluate.prototype.pageInit = function (d) {
	var _this = d._this;
	layui.use(['laypage', 'form'], function () {
		var laypage = layui.laypage,
			form = layui.form;
		if ($(".ns-evaluate-table tbody tr td").eq(0).text() != "无数据") {
			laypage.render({
				elem: 'laypage',
				count: _this.listCount,
				limit: _this.limit,
				limits: _this.limits,
				prev: '<i class="layui-icon layui-icon-left"></i>',
				next: '<i class="layui-icon layui-icon-right"></i>',
				layout: ['count','limit','prev', 'page', 'next'],
				jump: function (obj, first) {
					_this.limit = obj.limit;

					if (!first) {
						_this.page = obj.curr;
						_this.getList({
							_this: _this,
							"explain_type": d.explain_type,
							"search_text": d.search_text,
							"search_type": d.search_type
						});

						$("input[lay-filter='selectAllTop']").prop("checked", false);
						$("input[lay-filter='selectAllBot']").prop("checked", false);
						form.render();
						selectAll();
					}
				}
			});
		}
	});
};

var form,laypage;
var evaluate = new Evaluate(6, [2, 4, 6,8,10]);
evaluate.getList({
	"_this": evaluate,
});
evaluate.pageInit({
	"_this": evaluate
});
layui.use(['form', 'laypage', 'layer'], function() {
	form = layui.form;
	laypage = layui.laypage;

	/**
	 * 删除
	 */
	$(".ns-del-eval .layui-btn").click(function () {
		var id;
		$(".ns-evaluate-check .layui-form-checkbox").each(function(i) {
			if ($(this).hasClass("layui-form-checked")) {
				id = $(this).siblings(".evaluate_id").val();
			}
		});

		$.ajax({
			url: ns.url("admin/dtgl/deleteEvaluate"),
			data: {
				"id": id
			},
			type: "POST",
			dataType: "JSON",
			success: function (res) {
				evaluate.getList({
					"_this": evaluate
				});
				location.reload();
			},
		});
	});

	selectAll();

	form.on('checkbox(selectAllTop)', function(data) {
		if (data.elem.checked) {
			$("tr .ns-evaluate-check input:checkbox").each(function() {
				$(this).prop("checked",true);
				$(".ns-del-eval input:checkbox").prop("checked",true);
			});
		} else {
			$("tr .ns-evaluate-check input:checkbox").each(function() {
				$(this).prop("checked",false);
				$(".ns-del-eval input:checkbox").prop("checked",false);
			});
		}
		form.render();
	});

	form.on('checkbox(selectAllBot)', function(data) {
		if (data.elem.checked) {
			$("tr .ns-evaluate-check input:checkbox").each(function() {
				$(this).prop("checked",true);
				$("th.ns-check-box input:checkbox").prop("checked",true);
			});
		} else {
			$("tr .ns-evaluate-check input:checkbox").each(function() {
				$(this).prop("checked",false);
				$("th.ns-check-box input:checkbox").prop("checked",false);
			});
		}
		form.render();
	});

	/**
	 * 搜索
	 */
	form.on('submit(search)', function(data) {
		$(".ns-evaluate-table tbody").empty();
		var evaluate = new Evaluate(6, [2, 4, 6]);

		evaluate.getList({
			"_this": evaluate,
			"search_type": data.field.search_type,
			"search_text": data.field.search_text,
			"explain_type": data.field.explain_type,
		});
		evaluate.pageInit({
			"_this": evaluate,
			"search_type": data.field.search_type,
			"search_text": data.field.search_text,
			"explain_type": data.field.explain_type,
		});
		return false;
	});

});

// 点击全选
function selectAll() {
	/**
	 * 监听每一行的复选框
	 */
	var len = $("tbody .ns-evaluate-check").length;

	for (var i=0; i<len; i++) {
		var num = $(".evaluate_id").eq(i).val();

		form.on('checkbox(select'+num+')', function(data) {
			if($("tbody .ns-evaluate-check input:checked").length == len){
				$("input[lay-filter='selectAllTop']").prop("checked",true);
				$("input[lay-filter='selectAllBot']").prop("checked",true);
			}else{
				$("input[lay-filter='selectAllTop']").prop("checked", false);
				$("input[lay-filter='selectAllBot']").prop("checked", false);
			}

			form.render();
		});
	}
}

function delEvaluate(e) {
	/**
	 * 监听事件
	 */
	var id = $(e).parents("tr").prev().find(".evaluate_id").val();
	layer.confirm('确定要删除吗?', function() {
		$.ajax({
			url: ns.url("admin/dtgl/deleteEvaluate"),
			data: {
				"id": id
			},
			type: "POST",
			dataType: "JSON",
			success: function (res) {
				layer.msg(res.message);

				if (res.code == 0) {
					evaluate.getList({
						"_this": evaluate
					});
					location.reload();
				}
			}
		});
	}, function () {
		layer.close();
	});
}