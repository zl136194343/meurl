<?php /*a:2:{s:58:"/www/wwwroot/www.hunqin.com/app/shop/view/album/album.html";i:1614516186;s:51:"/www/wwwroot/www.hunqin.com/app/shop/view/base.html";i:1654828558;}*/ ?>
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
	
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/shop/view/public/css/album_manager.css" />

</head>

<body>


<div id="album">

	<!-- 搜索框 -->
	<div class="ns-single-filter-box">
		<button class="layui-btn ns-bg-color" onclick="uploadImg()">上传图片</button>

		<div class="layui-form">
			<div class="layui-input-inline">
				<input type="text" name="search_keys" placeholder="请输入图片名称" autocomplete="off" class="layui-input album-img-sreach">
				<button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
					<i class="layui-icon">&#xe615;</i>
				</button>
			</div>
		</div>
	</div>

	<div class="album-box">
		<ul class="album-list">
			<?php foreach($album_list as $album_list_k=> $album_list_v): ?>
			<li class="<?php if($album_list_k == 0): ?>active <?php endif; ?>" data-album-id="<?php echo htmlentities($album_list_v['album_id']); ?>">
				<span><?php echo htmlentities($album_list_v['album_name']); ?></span>
				<span><?php echo htmlentities($album_list_v['num']); ?></span>
			</li>
			<?php endforeach; ?>
		</ul>

		<div class="album-content">
			<ul class="album-img">
			</ul>
			<div id="paged" class="page"></div>
		</div>
	</div>
</div>

<!-- 多图上传 -->
<script type="text/html" id="multuple_html">
	<div class="layui-form multuple-list-box">
        <div class="layui-form-item">
            <label class="layui-form-label sm">本地图片</label>
            <ul class="layui-input-block multuple-list">
                <li class="multuple-list-img" id="ImgUpload">
                    <span class="ns-bg-color">+</span>
                    <span class="ns-text-color-black">点击添加图片</span>
                </li>
            </ul>
        </div>
        <div class="ns-form-row sm">
            <button class="layui-btn layui-btn-disabled" disabled="disabled" id="chooseListAction">提交</button>
            <button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
        </div>
    </div>
</script>


<!-- 图片展示 -->
<script type="text/html" id="albumList">
	{{# layui.each(d.list,function(index,item){ }}
    <li data-pic-id="{{item.pic_id}}" data-json_data='{{JSON.stringify(item)}}' class="media-list-item">
        <div class="ns-bg-color-gray">
            <img src="{{ ns.img(item.pic_path) }}" alt="{{item.pic_name}}">
            {{#  if( getActiveArrayIndex(item.pic_id) != "-1"){ }}
            <div class="image-box-active ns-border-color"><i class="active-index">{{ getActiveArrayIndex(item.pic_id) }}</i></div>
            {{#  } }}
        </div>
        <span>{{item.pic_name}}</span>
    </li>
    {{# }) }}
    {{#  if(d.list.length === 0){ }}
    <div class="empty-data">暂无数据</div>
    {{#  } }}
</script>

<script>
	var form, laytpl, laypage, upload,
		limit = 12,
		active_array = [],
		album_id = $(".album-list li.active").attr("data-album-id");

	layui.use(['form', 'laytpl', 'laypage', 'upload'], function() {
		form = layui.form;
		laytpl = layui.laytpl;
		laypage = layui.laypage;
		upload = layui.upload;
		
		form.render();
		//初始化数据
		init();

		//监听搜索事件
		form.on('submit(search)', function() {
			albumImgList(1, limit);
		});

		//分组切换
		$(".album-list li").click(function() {
			$(this).addClass("active").siblings().removeClass("active");
			album_id = $(".album-list li.active").attr("data-album-id");
			albumImgList(1, limit);
		});

	});

	/**
	 * 图片加载
	 * @param page
	 * @param limit
	 */
	function albumImgList(page, limit) {
		$.ajax({
			url: ns.url("shop/Album/Album"),
			type: "POST",
			dataType: "JSON",
			async: false,
			data: {
				album_id:album_id,
				limit:limit,
				page:page,
				pic_name: $(".album-img-sreach").val()
			},
			success: function(res) {

				laytpl($("#albumList").html()).render(res.data, function(data) {
					$(".album-img").html(data);
				});

				if (res.data.count > 0) {
					laypage.render({
						elem: 'paged',
						count: res.data.count,
						limit,
						curr: page,
						jump: function(obj, first) {
							if (!first) {
								albumImgList(obj.curr, obj.limit);
							}
						}
					})
				}
			}
		})
	}
	
	/**
	 * 选择个体
	 */
	function checkItem() {
		$("#album").unbind('click').on("click", ".media-list-item", function() {
			var json_data = $(this).data("json_data");
			json_data.id = parseInt(json_data.pic_id);

			if ($(this).find(".image-box-active").length > 0) {
				var active_index = getDelateActiveArrayIndex(json_data.id);
				sortActiveArrayIndex(active_index);
				$(this).find(".image-box-active").remove();
			} else {
				json_data.index = active_array.length + 1;
				if (json_data.index > imgNum) {
					layer.msg("您已超出最大的图片限额");
					return;
				}
				active_array.push(json_data);
				var active_html = '<div class="image-box-active ns-border-color"><i class="active-index">' + active_array.length +
					'</i></div>';
				$(this).find("div").append(active_html);
			}
			// if(active_array.length > count && count > 0){
			//     $('#callback_btn').addClass('btn-disabled').addClass('layui-btn-disabled');
			//     $('#callback_btn').attr("disabled","disabled");
			// }else{
			//     $('#callback_btn').removeClass('btn-disabled').removeClass('layui-btn-disabled');
			//     $('#callback_btn').removeAttr("disabled");
			// }
		});
	}


	//获取选择图片信息
	function getCheckItem(callback) {
		if (typeof callback == "function") callback(active_array);
	}

	//获取选中
	function getActiveArrayIndex(id) {
		var delete_index = -1;
		$.each(active_array, function(i, item) {
			if (item.pic_id == id) {
				delete_index = item.index;
				return false;
			}
		});
		return delete_index;
	}

	//删除选中
	function getDelateActiveArrayIndex(id) {
		var delete_index;
		$.each(active_array, function(i, item) {
			if (item.id == id) {
				delete_index = item.index;
				active_array.splice(i, 1);
				return false;
			}
		});
		return delete_index;
	}

	//重新排序
	function sortActiveArrayIndex(index) {
		$.each(active_array, function(i, item) {
			var item_index = item.index;
			if (item_index > index) {
				active_array[i]["index"] = item_index - 1;
				if ($("#album").find(".media-list-item[data-pic-id = '" + item["id"] + "']").length > 0) {
					$("#album").find(".media-list-item[data-pic-id = '" + item["id"] + "']").find(".image-box-active i ").text(item[
						"index"]);
				}
			}
		})
	}

	/**
	 * 初始化数据
	 */
	function init() {
		albumImgList(1, limit); //分组图像
		checkItem(); //选择个体
	}

	/**
	 * 多图上传
	 */
	function uploadImg() {

		laytpl($("#multuple_html").html()).render({}, function(html) {
			var album_id = $(".album-list li.active").attr("data-album-id");
			layer_one = layer.open({
				type: 1,
				area: ['580px', '430px'],
				title: '本地上传',
				content: html,
				cancel: function() {
					$("#chooseListAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
				},
				success: function(res) {

					//上传图片
					upload.render({
						elem: '#ImgUpload',
						url: ns.url("shop/upload/album"),
						data: {
							album_id:album_id
						},
						multiple: true,
						auto: false,
						bindAction: '#chooseListAction',
						choose: function(obj) {
							//将每次选择的文件追加到文件队列
							var files = this.files = obj.pushFile();

							//预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
							obj.preview(function(index, file, result) {

								//追加预览图片
								var html = '';
								html += '<li class="multuple-list-img nc-upload-wrap" index="' + index + '">';
								html += '<img src="' + result + '" alt="' + file.name + '">';
								html += '<span class="upload-close-modal"  id="upload_img_' + index + '">×</span>';
								html += '<div class="upload-image-curtain">50%</div>';
								html += '</li>';
								$(".multuple-list").prepend(html);

								//删除预览图片
								$("#upload_img_" + index).bind("click", function() {
									delete files[index];
									// delete picture_arr[index];//删除所选队列
									$(this).parent('.nc-upload-wrap').remove();
									// uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选

									//禁止点击
									if ($(".multuple-list li").length <= 1) {
										$("#chooseListAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
									}
								});

								//禁止点击
								if ($(".multuple-list li").length > 1) {
									$("#chooseListAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr("disabled");
								}
							});
						},
						done: function(res, index) {
							// picture_arr.push(res.data);

							var image_box = $(".nc-upload-wrap[index='" + index + "']").parent().find(".upload-image-curtain");
							image_box.text("50%");
							image_box.show();

							if (res.code >= 0) {
								setTimeout(function() {
									image_box.text("100%");
								}, 500);
								setTimeout(function() {
									albumImgList(1, limit);
									layer.close(layer_one);
								}, 1000);
								return delete this.files[index]; //删除文件队列已经上传成功的文件
							} else {
								setTimeout(function() {
									image_box.text("上传失败");
								}, 500);
								laytpl.msg(res.message); //删除文件队列已经上传成功的文件
							}
						}
						,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
							$("#chooseListAction").removeClass("ns-bg-color").addClass("layui-btn-disabled").attr("disabled", "disabled");
						}
						,allDone: function(obj){
							$("#chooseListAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr("disabled");
						},error: function(index, upload){
							$("#chooseListAction").addClass("ns-bg-color").removeClass("layui-btn-disabled").removeAttr("disabled");
						}
					});

				}
			})
		});

	}

	var search = window.location.search,
		imgNum = parseInt(getSearchString('imgNum', search));

	function getSearchString(key, Url) {
		var str = Url;
		str = str.substring(1, str.length); // 获取URL中?之后的字符（去掉第一位的问号）
		// 以&分隔字符串，获得类似name=xiaoli这样的元素数组
		var arr = str.split("&");
		var obj = new Object();
		// 将每一个数组元素以=分隔并赋给obj对象
		for (var i = 0; i < arr.length; i++) {
			var tmp_arr = arr[i].split("=");
			obj[decodeURIComponent(tmp_arr[0])] = decodeURIComponent(tmp_arr[1]);
		}
		return obj[key];
	}
</script>



</body>

</html>