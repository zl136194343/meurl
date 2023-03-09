var laytpl, form, layerIndex;
var categoryFullName = [];//组装名称
var file = "";//图片路径

$(function () {
	
	//编辑时赋值组装名称
	if ($("input[name='category_full_name']").length > 0) {
		categoryFullName = $("input[name='category_full_name']").val().split("/").slice(0, $("input[name='category_full_name']").val().split("/").length - 1);
	}
	
	if ($("input[name='image']").length > 0) {
		file = $("input[name='image']").val();
	}

	layui.use(['form', 'upload', 'laytpl'], function () {
		var upload = layui.upload,
			repeat_flag = false;//防重复标识
		laytpl = layui.laytpl;
		form = layui.form;
		
		/**
		 * 表单验证
		 */
		form.verify({
			commission_rate: function (value) {
				var reg = /^\d{0,2}(.?\d{0,2})$/;
				if (value.length > 0) {
					if (isNaN(value)) {
						return '佣金比率输入错误';
					}
					if (!reg.test(value) || value < 0 || value > 100) {
						return '佣金比率范围:0~100%';
					}
				}
			},
			num: function (value) {
				if (value == '') {
					return;
				}
				if (value % 1 != 0) {
					return '排序数值必须为整数';
				}
				if (value < 0) {
					return '排序数值必须为大于0';
				}
			}
		});

		// 普通图片上传
		var imgUpload_upload = new Upload({
			elem: '#imgUpload'
		});

		// 普通图片上传
		var imgUploadAdv_upload = new Upload({
			elem: '#imgUploadAdv'
		});
		
		form.on('submit(save)', function (data) {
            
		/*	categoryFullName.push(data.field.category_name);
			data.field.category_full_name = categoryFullName.join("/");
			data.field.attr_class_name = $("select[name='attr_class_id'] option:checked").text();
			*/
			if (repeat_flag) return false;
			repeat_flag = true;
			
			//图片删除
/*			if(!data.field.image) imgUpload_upload.delete();
			if(!data.field.image_adv) imgUploadAdv_upload.delete();*/
			
			var url = ns.url("admin/config/addCategory");
			if (data.field.id) {
				//编辑
				url = ns.url("admin/config/editCategory");
			}
			$.ajax({
				url: url,
				data: data.field,
				dataType: 'json',
				type: 'post',
				success: function (data) {
					layer.msg(data.message);
					if (data.code == 0) {
						location.href = ns.url("admin/config/customer");
					} else {
						repeat_flag = false;
					}
				}
			});
			return false;
		});
		
	});
	
});




function back() {
	location.href = ns.url("admin/config/customer")
}