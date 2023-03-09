<?php /*a:1:{s:70:"/www/wwwroot/ls.chnssl.com/app/admin/view/commonutil/goods_select.html";i:1614518646;}*/ ?>

<style>
	.selector-goods .contraction{display: inline-block;margin-right: 5px;}
	.selector-goods .contraction span{cursor: pointer;display: inline-block;width: 17px;height: 17px;text-align: center;line-height: 14px;/* border: 1px solid #e9e9e9;*/user-select: none;/* background: #fff;*/}
	.selector-goods .sku-list{display: none;border-bottom: 1px solid #e6e6e6;}
	.selector-goods .sku-list td:nth-of-type(2){display: flex;align-items: center;}
	.selector-goods .sku-list td{border-bottom: 0;padding: 5px 15px !important;}
	.selector-goods .ns-screen .layui-colla-content{padding-left: 15px;}
	.selector-goods{display: flex;border-bottom: 1px solid #f2f2f2;}
	.selector-goods .select-goods-left{width: 135px;height: 485px;margin-right: 20px;padding-right: 10px;border-right: 1px solid #f2f2f2;box-sizing: border-box;overflow-y: auto;}
	/* 滚动条整体部分*/.selector-goods .select-goods-left::-webkit-scrollbar{width:5px;background-color:#d0cdc7;}
	/* scroll轨道背景*/.selector-goods .select-goods-left::-webkit-scrollbar-track{-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);border-radius: 50%;background-color:#d0cdc7;}
	/* 滚动条中能上下移动的小块*/.selector-goods .select-goods-left::-webkit-scrollbar-thumb{border-radius: 10px;-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);background-color:#a09d9d;}
	.selector-goods .select-goods-left dl{height: auto;overflow: hidden;}
	.selector-goods .select-goods-left dt,.selector-goods .select-goods-left dd{position: relative;height: 32px;font-size: 12px;line-height: 32px;cursor: pointer;}
	.selector-goods .select-goods-left dt{padding-left: 13px;}
	.selector-goods .select-goods-left dd{padding-left: 20px;}
	.selector-goods .select-goods-left dt:after{content: '';position: absolute;border: 4px solid transparent;border-right-color: #333;border-bottom-color: #333;left: 0;top: 50%;transform: translateY(-50%);transition: all .3s;}
	.selector-goods .select-goods-left dl.fold{height: 32px;}
	.selector-goods .select-goods-left .fold dt:after{transform:translateY(-50%) rotate(-45deg);}
	.selector-goods .select-goods-left .active{background-color: #f7f7f7;}
	.selector-goods .select-goods-left .ns-text-color{background-color: transparent;}
	.selector-goods .select-goods-right{flex: 1;}
	.selector-goods .select-goods-right .layui-table-body{height: 425px;}
	.selector-goods .select-goods-right .ns-single-filter-box{padding: 0;}
	.selector-goods .select-goods-right .ns-single-filter-box .layui-form{margin: inherit;}
	.selector-goods .select-goods-right .ns-single-filter-box .layui-form div{margin: 0;}

	.selector-goods .select-goods-classification{border: 0;}
	.selector-goods .select-goods-classification .layui-colla-title{height: 32px;background-color: #fff;border: 0;line-height: 32px;font-size: 12px;padding-left: 15px; }
	.selector-goods .select-goods-classification .layui-colla-title i{font-size: 0;}
	.selector-goods .select-goods-classification .layui-colla-title.arrow.active:after{transform: rotate(0) translateY(-50%);}
	.selector-goods .select-goods-classification .layui-colla-title.arrow:after{content: '';border: 4px solid #333;position: absolute;border-top-color: transparent !important;border-left-color: transparent !important;left: 3px;top: 50%;transition: all .3s;transform: rotate(-45deg) translateY(-50%);}
	.selector-goods .select-goods-classification .layui-colla-content{padding: 0;font-size: 12px;border-top: 0;}
	.selector-goods .select-goods-classification .layui-colla-item{border: 0;font-size: 12px;}
	.selector-goods .select-goods-classification .classification-item{cursor: pointer;border: 0;font-size: 12px;}
	.selector-goods .select-goods-classification .select-goods-classification .classification-item{padding-left: 26px;}
	.selector-goods .select-goods-classification .select-goods-classification .classification-item.arrow:after{left: 15px;}
	.selector-goods .select-goods-classification .select-goods-classification .layui-colla-content.classification-item{padding-left: 38px;}
	.selector-goods .select-goods-classification .classification-item:hover{background-color: #f7f7f7;}
	.selector-goods .layui-form{padding: 0;}
	.selector-goods .ns-single-filter-box{margin-top: 0;}
	.shop-select-wrap .ns-single-filter-box{margin-bottom: 10px;}
</style>

<div class="selector-goods <?php echo htmlentities($post); ?>-select-wrap">
	<div class="select-goods-left">
		<?php if($promotion): ?>
		<dl class="marketing-campaign">
			<dt>商品</dt>
			<?php if($promotion == "all"): ?>
			<dd class="ns-text-color" data-type="">全部商品</dd>
			<?php endif; foreach($promotion_type as $k => $v): if($promotion == $v['type']): ?>
			<dd class="<?php if($promotion == $v['type']): ?>ns-text-color<?php endif; ?>" data-type="<?php echo htmlentities($v['type']); ?>"><?php echo htmlentities($v['name']); ?></dd>
			<?php endif; ?>
			<?php endforeach; ?>
		</dl>
		<?php endif; if(!$promotion): ?>
		<div class="select-goods-classification one-category layui-collapse">
			<div class="layui-colla-item">
				<h2 class="layui-colla-title classification-item ns-text-color" data-category_id="">全部分类</h2>
			</div>
			<?php foreach($category_list as $category_one_item): ?>
			<div class="layui-colla-item">
				<h2 class="layui-colla-title layui-one-colla-title classification-item <?php if(!(empty($category_one_item['children']) || (($category_one_item['children'] instanceof \think\Collection || $category_one_item['children'] instanceof \think\Paginator ) && $category_one_item['children']->isEmpty()))): ?>arrow<?php endif; ?>"
				data-category_id="<?php echo htmlentities($category_one_item['category_id']); ?>"><?php echo htmlentities($category_one_item['title']); ?></h2>
				<?php if(!(empty($category_one_item['children']) || (($category_one_item['children'] instanceof \think\Collection || $category_one_item['children'] instanceof \think\Paginator ) && $category_one_item['children']->isEmpty()))): foreach($category_one_item['children'] as $category_two_item): ?>
				<div class="layui-colla-content layui-one-colla-content">
					<div class="select-goods-classification two-category layui-collapse">
						<div class="layui-colla-item">
							<h2 class="layui-colla-title layui-two-colla-title classification-item <?php if(!(empty($category_two_item['children']) || (($category_two_item['children'] instanceof \think\Collection || $category_two_item['children'] instanceof \think\Paginator ) && $category_two_item['children']->isEmpty()))): ?>arrow<?php endif; ?>"
							data-category_id="<?php echo htmlentities($category_two_item['category_id']); ?>"><?php echo htmlentities($category_two_item['title']); ?></h2>
							<?php if(!(empty($category_two_item['children']) || (($category_two_item['children'] instanceof \think\Collection || $category_two_item['children'] instanceof \think\Paginator ) && $category_two_item['children']->isEmpty()))): foreach($category_two_item['children'] as $category_three_item): ?>
							<div class="layui-colla-content classification-item" data-category_id="<?php echo htmlentities($category_three_item['category_id']); ?>"><?php echo htmlentities($category_three_item['title']); ?></div>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>

	<div class="select-goods-right">
		<!-- 筛选面板 -->
		<div class="ns-single-filter-box">
			<div class="layui-form">
				<div class="layui-input-inline">
					<input type="text" name="goods_name" placeholder="请输入<?php if($promotion == 'pintuan'): ?>活动名称<?php else: ?>商品名称<?php endif; ?>" autocomplete="off"
						   class="layui-input">
					<button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>
						<i class="layui-icon">&#xe615;</i>
					</button>
				</div>
			</div>
		</div>

		<!-- 列表 -->
		<table id="goods_list" lay-filter="goods_list"></table>
	</div>
</div>

<script type="text/html" id="checkbox">
	{{# if('<?php echo htmlentities($promotion); ?>'  == "pintuan"){ }}
	<div class="layui-hide">{{ d.goods_name = d.pintuan_name }}</div>
	{{# } }}
	<input type="checkbox" data-goods-id="{{d.goods_id}}" name="goods_checkbox" lay-skin="primary" lay-filter="goods_checkbox">
	<input type="hidden" data-goods-id="{{d.goods_id}}" name="goods_json" value='{{JSON.stringify(d)}}'/>
	<input type="hidden" data-goods-id="{{d.goods_id}}" name="goods_sku_list_json" value='{{ JSON.stringify(d.sku_list) }}' />
</script>

<!-- 商品信息 -->
<script type="text/html" id="goods_info">
	<div class="ns-table-title">
		{{# if(mode == "sku"){ }}
		<div class="contraction" data-goods-id="{{d.goods_id}}" data-open="0">
			<span>+</span>
		</div>
		{{# } }}

		<div class="ns-title-pic" id="goods_img_{{d.goods_id}}">
			<img layer-src src="{{ns.img(d.goods_image.split(',')[0], 'small')}}"/>
		</div>
		<div class="ns-title-content">
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.goods_name}}">{{d.goods_name}}</a>
			{{# if('<?php echo htmlentities($promotion); ?>' != 'pintuan' && '<?php echo htmlentities($promotion); ?>' != 'groupbuy' && '<?php echo htmlentities($promotion); ?>' != 'fenxiao'){ }}
			<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" >￥{{d.price}}</a>
			{{# } }}
		</div>
	</div>
</script>

<!-- SKU商品列表 -->
<script type="text/html" id="skuList">
	{{# for(var i=0;i<d.list.length;i++){ }}
	<tr class="sku-list js-sku-list-{{d.list[i].goods_id}}" id="sku_img_{{d.list[i].goods_id}}">
		<td></td>
		<td>
			<input type="checkbox" data-goods-id="{{d.list[i].goods_id}}" data-sku-id="{{d.list[i].sku_id}}" name="goods_sku_checkbox" lay-skin="primary" lay-filter="goods_sku_checkbox">
			<input type="hidden" data-sku-id="{{d.list[i].sku_id}}" value='{{ JSON.stringify(d.list[i]) }}' name="goods_sku_json" />
			<div class="ns-table-title">
				<div class="ns-title-pic" id="sku_img_{{d.sku_id}}">
					<img layer-src src="{{ns.img(d.list[i].sku_image, 'small')}}"/>
				</div>
				<div class="ns-title-content">
					<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.list[i].sku_name}}" lay-event="preview">{{d.list[i].sku_name}}</a>
					<a href="javascript:;" class="ns-multi-line-hiding ns-text-color" >￥{{d.list[i].price}}</a>
				</div>
			</div>
		</td>
		<td>{{d.list[i].stock}}</td>
		<td>{{d.list[i].goods_class_name}}</td>
	</tr>
	{{# } }}
</script>

<script>
	var goodsDataGather = [];
	var select_id = "<?php echo htmlentities($select_id); ?>", //选中商品id
			select_list = [], //选中商品所有数据res
			mode = "<?php echo htmlentities($mode); ?>", //商品类型
			max_num = "<?php echo htmlentities($max_num); ?>", //最大商品数量
			min_num = "<?php echo htmlentities($min_num); ?>", //最小商品数量
			disabled = "<?php echo htmlentities($disabled); ?>", //不可选中
			goodsCols = [], //数据源
			filterData = {
				promotion_type: '',
				label_id: '',
				goods_name: ''
			}, //筛选数据
			post = '<?php echo htmlentities($post); ?>',
			goodsIdArr = [],
			skuIdAll = [],

			//------新代码
			table, form, laytpl, element,
			selected_id_arr = select_id.length ? select_id.split(',') : [], //已选中的商品id
			//设置项
			setItem = {
				mode: "<?php echo htmlentities($mode); ?>", //商品类型
				max_num: "<?php echo htmlentities($max_num); ?>", //最大商品数量
				min_num: "<?php echo htmlentities($min_num); ?>", //最小商品数量
				disabled: "<?php echo htmlentities($disabled); ?>", //不可选中
				promotion: "<?php echo htmlentities($promotion); ?>", // 营销标识
			};


	if (setItem.mode == 'spu') {
		goodsIdArr = selected_id_arr;
	} else {
		skuIdAll = selected_id_arr;
	}

	if (!setItem.promotion || setItem.promotion == 'all' || setItem.promotion == 'module') {
		goodsCols = [
			[{
				unresize: 'false',
				width: '8%',
				templet: '#checkbox'
			},
				{
					title: '商品',
					unresize: 'false',
					width: '62%',
					templet: '#goods_info'
				},
				{
					field: 'goods_stock',
					title: '库存',
					unresize: 'false',
					width: '15%'
				},
				{
					field: 'goods_class_name',
					title: '商品类型',
					unresize: 'false',
					width: '15%'
				}
			]
		];
	} else if (setItem.promotion == "pintuan") {
		goodsCols = [
			[{
				unresize: 'false',
				width: '8%',
				templet: '#checkbox'
			},
				{
					field: 'pintuan_name',
					title: '拼团活动',
					unresize: 'false',
					width: '20%',
				}, {
				title: '拼团商品',
				unresize: 'false',
				width: '33%',
				templet: '#goods_info'
			}, {
				field: 'pintuan_num',
				title: '参团人数',
				unresize: 'false',
				width: '13%'
			}, {
				field: 'group_num',
				title: '开团团队',
				unresize: 'false',
				width: '13%'
			}, {
				field: 'order_num',
				title: '购买人数',
				unresize: 'false',
				width: '13%'
			}
			]
		];
	} else if (setItem.promotion == "groupbuy") {
		goodsCols = [
			[{
				unresize: 'false',
				width: '8%',
				templet: '#checkbox'
			}, {
				title: '团购商品',
				unresize: 'false',
				width: '47%',
				templet: '#goods_info'
			}, {
				field: 'price',
				title: '商品原价',
				unresize: 'false',
				width: '15%',
				templet: function(data) {
					return '￥' + data.price;
				}
			}, {
				field: 'groupbuy_price',
				title: '团购价格',
				unresize: 'false',
				width: '15%',
				templet: function(data) {
					return '￥' + data.groupbuy_price;
				}
			}, {
				field: 'buy_num',
				title: '起购量',
				unresize: 'false',
				width: '15%'
			}]
		]
	} else if (setItem.promotion == "fenxiao") {
		goodsCols = [
			[{
				unresize: 'false',
				width: '8%',
				templet: '#checkbox'
			},
				{
					title: '商品名称',
					unresize: 'false',
					width: '47%',
					templet: '#goods_info'
				},
				{
					field: 'price',
					title: '价格',
					unresize: 'false',
					width: '15%'
				},
				{
					field: 'goods_stock',
					title: '库存',
					unresize: 'false',
					width: '15%'
				},
				{
					field: 'sale_num',
					title: '销量',
					unresize: 'false',
					width: '15%'
				},
			]
		]
	} else if (setItem.promotion == "bargain") {
		goodsCols = [
			[{
				unresize: 'false',
				width: '8%',
				templet: '#checkbox'
			},
				{
					title: '商品名称',
					unresize: 'false',
					width: '47%',
					templet: '#goods_info'
				},
				{
					field: 'price',
					title: '价格',
					unresize: 'false',
					width: '15%'
				},
				{
					field: 'stock',
					title: '库存',
					unresize: 'false',
					width: '15%'
				}
			]
		]
	}else if (setItem.promotion == "wholesale") {
		goodsCols = [
			[{
				unresize: 'false',
				width: '8%',
				templet: '#checkbox'
			},
				{
					title: '商品名称',
					unresize: 'false',
					width: '47%',
					templet: '#goods_info'
				},
				{
					field: 'price',
					title: '价格',
					unresize: 'false',
					width: '15%'
				},
				{
					field: 'goods_stock',
					title: '库存',
					unresize: 'false',
					width: '15%'
				}
			]
		]
	}

	$(function() {
		layui.use(['form', 'laytpl', 'element'], function() {
			form = layui.form;
			laytpl = layui.laytpl;
			element = layui.element;
			table = new Table({
				elem: '#goods_list',
				height: 360,
				width: 805,
				url: '<?php echo addon_url("admin/commonutil/goodslist"); ?>',
				where: {
					is_virtual: "<?php echo htmlentities($is_virtual); ?>",
					promotion: setItem.promotion,
					'post': post
				},
				cols: goodsCols,
				callback: function(res) {
					goodsDataGather = res.data;
					if (setItem.mode == "sku") {
						//存储这sku的具体id
						$("input[name='goods_checkbox'][data-goods-id]").each(function() {
							var goods_id = $(this).attr("data-goods-id");
							var tr = $(this).parent().parent().parent();
							var data = getGoodsSkuData(goods_id);
							laytpl(data.sku_list).render(data, function(html) {
								tr.after(html);
								form.render();
								layer.photos({
									photos: '.img-wrap',
									anim: 5
								});
							});
						});
					}

					// 更新商品复选框状态
					if (setItem.mode == 'spu') {
						for (var i = 0; i < goodsIdArr.length; i++) {
							var selected_goods = $("input[name='goods_checkbox'][data-goods-id='" + goodsIdArr[i] + "']");
							if (selected_goods.length) {
								$("input[name='goods_checkbox'][data-goods-id='" + goodsIdArr[i] + "']").prop("checked", true);
								if (setItem.disabled == 1) {
									$("input[name='goods_checkbox'][data-goods-id='" + goodsIdArr[i] + "']").attr("disabled", "disabled");
								}
							}
						}
					}
					if (setItem.mode == 'sku') {
						for (var i = 0; i < skuIdAll.length; i++) {
							var selected_goods_sku = $("input[name='goods_sku_checkbox'][data-sku-id='" + skuIdAll[i] + "']");
							$("input[name='goods_sku_checkbox'][data-sku-id='" + skuIdAll[i] + "']").prop("checked", true);
							if (selected_goods_sku.length) {
								for (var k = 0; k < select_list.length; k++){
									if(select_list[k].goods_id == selected_goods_sku.attr("data-goods-id"))break;
									if(k == select_list.length-1){
										var obj = {selected_sku_list:[]};
										obj.goods_id = selected_goods_sku.attr("data-goods-id");
										select_list.push(obj);
									}
								}
								if(!select_list.length){
									var obj = {selected_sku_list:[]};
									obj.goods_id = selected_goods_sku.attr("data-goods-id");
									select_list.push(obj);
								}
								$("input[name='goods_checkbox'][data-goods-id='" + selected_goods_sku.attr("data-goods-id") + "']").prop("checked", true);
								if (setItem.disabled == 1) {
									$("input[name='goods_sku_checkbox'][data-sku-id='" + skuIdAll[i] + "']").attr("disabled", "disabled");
									$("input[name='goods_checkbox'][data-goods-id='" + selected_goods_sku.attr("data-goods-id") + "']").attr("disabled", "disabled");
								}
							}
						}
					}
					form.render();
				}
			});


			//修改一级分类箭头切换
			$(".selector-goods .one-category .layui-one-colla-title").click(function () {
				$(".selector-goods .layui-one-colla-title").removeClass("active");
				$(".selector-goods .layui-one-colla-content").removeClass("layui-show");
				$(this).addClass("active");
				if($(this).hasClass('arrow')){
					$(this).parent(".layui-colla-item").find(".layui-one-colla-content").addClass("layui-show");
				}

			});

			//修改二级分类箭头切换
			$(".selector-goods .two-category .layui-two-colla-title").click(function (e) {
				$(".selector-goods .select-goods-classification .select-goods-classification .layui-two-colla-title").removeClass("active");
				$(".selector-goods .two-category .layui-colla-content").removeClass("layui-show");
				$(this).addClass("active");
				if($(this).hasClass('arrow')){
					$(this).parent(".layui-colla-item").find(".layui-colla-content").addClass("layui-show");
				}
			});

			/**
			 * 监听搜索
			 */
			form.on('submit(search)', function(data) {
				filterData.goods_name = data.field.goods_name;
				table.reload({
					page: {
						curr: 1
					},
					where: filterData
				});
				return false;
			});


			// 勾选商品
			form.on('checkbox(goods_checkbox)', function(data) {
				var goods_id = $(data.elem).attr("data-goods-id"),
					json = {};

				$("input[name='goods_sku_checkbox'][data-goods-id='" + goods_id + "']").prop("checked", data.elem.checked);
				form.render();

				var spuLen = $("input[name='goods_checkbox'][data-goods-id=" + goods_id + "]:checked").length;
				if (spuLen) {
					var index = $(this).parents("tr").attr('data-index');
					json = goodsDataGather[index];
					// json = JSON.parse($("input[name='goods_json'][data-goods-id=" + goods_id + "]").val());
					json.selected_sku_list = $("input[name='goods_sku_list_json'][data-goods-id=" + goods_id + "]").val() == "undefined" ? [] : json.sku_list;
					delete json.LAY_INDEX;
					delete json.LAY_TABLE_INDEX;
					delete json.create_time;
					select_list.push(json);

					goodsIdArr.push(goods_id);
				} else {
					select_list.remove(goods_id);
					goodsIdArr.remove(goods_id);
				}


				if (setItem.mode == "spu") return false;
				var skuLen = $("input[name='goods_sku_checkbox'][data-goods-id=" + goods_id + "]").length;
				if (!skuLen) {
					skuIdAll = [];
				}
				for (var i = 0; i < skuLen; i++) {
					var skuId = $("input[name='goods_sku_checkbox'][data-goods-id=" + goods_id + "]").eq(i).attr("data-sku-id");
					if (spuLen)
						skuIdAll.push(skuId);
					else {
						skuIdAll.remove(skuId);
					}
				}
			});


			// 勾选商品SKU
			form.on('checkbox(goods_sku_checkbox)', function(data) {

				var goods_id = $(data.elem).attr("data-goods-id"),
					sku_id = $(data.elem).attr("data-sku-id"),
					json = {};

				if ($("input[name='goods_sku_checkbox'][data-goods-id='" + goods_id + "']:checked").length) {

					if (!$("input[name='goods_checkbox'][data-goods-id='" + goods_id + "']:checked").length) {
						goodsIdArr.push(goods_id);

						json = JSON.parse($("input[name='goods_json'][data-goods-id=" + goods_id + "]").val());
						delete json.LAY_INDEX;
						delete json.LAY_TABLE_INDEX;
						delete json.create_time;
						json.selected_sku_list = [];
						select_list.push(json);
					}

					$("input[name='goods_checkbox'][data-goods-id='" + goods_id + "']").prop("checked", true);
				} else {
					$("input[name='goods_checkbox'][data-goods-id='" + goods_id + "']").prop("checked", false);
					goodsIdArr.remove(goods_id);
					select_list.remove(goods_id);
				}

				if (!select_list.length) {
					skuIdAll = [];
				}
				for (var i = 0; i < select_list.length; i++) {
					if (select_list[i].goods_id == goods_id) {
						// var skuLen = $("input[name='goods_sku_checkbox'][data-sku-id="+ sku_id +"]:checked").length;
						if (data.elem.checked) {
							skuIdAll.push(sku_id);
							var skuVal = $("input[name='goods_sku_json'][data-sku-id=" + sku_id + "]").val()
							select_list[i].selected_sku_list.push(JSON.parse(skuVal));
						} else {
							skuIdAll.remove(sku_id);
							select_list[i].selected_sku_list.remove(sku_id);
						}
						break;
					}
				}
				form.render();
			});
		});

		//商品信息展开
		$('body').off("click",".contraction"); //移除click
		$("body").on("click", ".contraction", function(e) {
			e.stopPropagation();
			var goods_id = $(this).attr("data-goods-id");
			var open = $(this).attr("data-open");
			if (open == 1) {
				$(this).children("span").text("+");
				$(".js-sku-list-" + goods_id).hide();
			} else {
				$(this).children("span").text("-");
				$(".js-sku-list-" + goods_id).show();
			}
			$(this).attr("data-open", (open == 0 ? 1 : 0));
		});

	});

	function getGoodsSkuData(goods_id) {
		var list = JSON.parse($("input[name='goods_sku_list_json'][data-goods-id='" + goods_id + "']").val());
		var sku_list = $("#skuList").html();
		var checked = $("input[name='goods_checkbox'][data-goods-id='" + goods_id + "']:checked").length ? true : false;
		var data = {
			checked: checked,
			sku_list: sku_list,
			list: list
		};
		return data;
	}


	function selectGoods(callback) {
		var res = select_list;
		var num = 0;
		if (mode == "spu") {
			num = goodsIdArr.length;
			if (setItem.promotion) {
				res = goodsIdArr;
			}
		} else if (mode == "sku") {
			num = skuIdAll.length;
			if (setItem.promotion) {
				res = skuIdAll;
			}
		}

		if (max_num && max_num > 0 && num > max_num) {
			layer.msg("所选商品数量不能超过" + max_num + '件');
			return;
		}

		if (min_num && min_num > 0 && num < min_num) {
			layer.msg("所选商品数量最少不能少于" + min_num + '件');
			return;
		}
		callback(res);

	}

	Array.prototype.indexOf = function(val) {
		for (var i = 0; i < this.length; i++) {
			if(this[i].goods_id == parseInt(val)) {
				return i;
			} else if (this[i].sku_id) {
				if (this[i].sku_id == parseInt(val)) return i;
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


	function removeDuplicates(arr) {
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
	};


	$(".selector-goods .select-goods-left dd").hover(function() {
		$(this).addClass("active");
	}, function() {
		$(this).removeClass("active");
	});

	$("body").on("click", ".select-goods-left .marketing-campaign dd", function() {
		$(this).addClass("ns-text-color").siblings().removeClass("ns-text-color");
		filterData.promotion_type = $(this).attr("data-type");
		table.reload({
			page: {
				curr: 1
			},
			where: filterData
		});
	});

	$("body").on("click", ".select-goods-left .commodity-group dd", function() {
		$(this).addClass("ns-text-color").siblings().removeClass("ns-text-color");
		filterData.label_id = $(this).attr("data-group-id");
		table.reload({
			page: {
				curr: 1
			},
			where: filterData
		});
	});



	$("body").on("click", ".select-goods-left dl", function() {
		if ($(this).hasClass("fold")) {
			$(this).removeClass("fold");
		} else {
			$(this).addClass("fold");
		}
	});

	$("body").on("click", ".select-goods-left dd", function(event) {
		$(this).parents("dl").removeClass("fold");
		$(this).parents("dl").siblings().addClass("fold");
		event.stopPropagation();
	});

	//分类切换
	$("body").on("click", ".classification-item", function(event) {
		var categoryId = $(this).attr("data-category_id");
		$(".classification-item").removeClass("ns-text-color ns-border-after-color");
		$(this).addClass("ns-text-color ns-border-after-color");
		table.reload({
			page: {
				curr: 1
			},
			where: {
				category_id: categoryId
			},
		});
		event.stopPropagation();
	});
</script>
