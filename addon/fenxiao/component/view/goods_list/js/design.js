// 顶部内容组件
var fenxiaoTopConHtml = '<div class="goods-head">';
	fenxiaoTopConHtml +=	'<div class="title-wrap">';
	fenxiaoTopConHtml +=		'<div class="left-icon" v-if="list.imageUrl"><img v-bind:src="$parent.$parent.changeImgUrl(list.imageUrl)" /></div>';
	fenxiaoTopConHtml +=		'<span class="name" v-bind:style="{color: data.titleTextColor}">{{list.title}}</span>';
	fenxiaoTopConHtml +=	'</div>';
	fenxiaoTopConHtml +=	'<div class="more" v-if="listMore.title">';
	fenxiaoTopConHtml +=		'<span v-bind:style="{color: data.moreTextColor}">{{listMore.title}}</span>';
	fenxiaoTopConHtml +=		'<div class="right-icon" v-if="listMore.imageUrl"><img v-bind:src="$parent.$parent.changeImgUrl(listMore.imageUrl)" /></div>';
	fenxiaoTopConHtml +=		'<i class="iconfont iconyoujiantou" v-else v-bind:style="{color: data.moreTextColor}"></i>';
	fenxiaoTopConHtml +=	'</div>';
	fenxiaoTopConHtml +='</div>';

Vue.component("fenxiao-top-content", {
	data: function () {
		return {
			data: this.$parent.data,
			list: this.$parent.data.list,
			listMore: this.$parent.data.listMore
		}
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: fenxiaoTopConHtml
});


/**
 * 空的验证组件，后续如果增加业务，则更改组件
 */
var fenxiaoListHtml = '<div class="goods-list-edit layui-form">';

		fenxiaoListHtml += '<div class="layui-form-item">';
			fenxiaoListHtml += '<label class="layui-form-label sm">数据来源</label>';
			fenxiaoListHtml += '<div class="layui-input-block">';
				fenxiaoListHtml += '<div class="source-selected">';
					fenxiaoListHtml += '<div class="source">{{ sourcesText }}</div>';
					fenxiaoListHtml += '<template v-for="(item,index) in goodsSources" v-bind:k="index">';
						// fenxiaoListHtml += '<div v-on:click="data.sources=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (data.sources==item.value) }"><i class="layui-anim layui-icon">&#xe643;</i><div>{{item.text}}1111</div></div>';
						fenxiaoListHtml += '<span class="source-item" :title="item.text" v-on:click="data.sources=item.value" v-bind:class="[(data.sources == item.value) ?  \'ns-text-color ns-border-color ns-bg-color-diaphaneity\' : \'\' ]"><img v-bind:src="item.selectedIcon" v-if="data.sources == item.value"><img v-bind:src="item.icon" v-else/></span>';
					fenxiaoListHtml += '</template>';
				fenxiaoListHtml += '</div>';
			fenxiaoListHtml += '</div>';
		fenxiaoListHtml += '</div>';

		fenxiaoListHtml += '<div class="layui-form-item" v-if="data.sources == \'category\'">';
			fenxiaoListHtml += '<label class="layui-form-label sm">商品分类</label>';
			fenxiaoListHtml += '<div class="layui-input-block align-right">';
				fenxiaoListHtml += '<a href="#" class="ns-input-text ns-text-color" @click="selectCategory">{{ categoryName }}<i class="iconfont iconyoujiantou"></i></a>';
			fenxiaoListHtml += '</div>';
		fenxiaoListHtml += '</div>';

		fenxiaoListHtml += '<div class="layui-form-item" v-if="data.sources == \'diy\'">';
			fenxiaoListHtml += '<label class="layui-form-label sm">手动选择</label>';
			fenxiaoListHtml += '<div class="layui-input-block align-right">';
				fenxiaoListHtml += '<a href="#" class="ns-input-text ns-text-color" v-on:click="addGoods">请选择<i class="iconfont iconyoujiantou"></i></a>';
			fenxiaoListHtml += '</div>';
		fenxiaoListHtml += '</div>';

		fenxiaoListHtml += '<slide v-bind:data="{ field : \'goodsCount\', label: \'商品数量\', max: 20}" v-if="data.sources != \'diy\'"></slide>';

		// fenxiaoListHtml += '<p class="hint">商品数量选择 0 时，前台会自动上拉加载更多</p>';

	fenxiaoListHtml += '</div>';

var select_goods_list = []; //配合商品选择器使用
Vue.component("fenxiao-goods-list", {
	template: fenxiaoListHtml,
	data: function () {
		var url = post == 'shop'?'':'_admin';
		return {
			data: this.$parent.data,
			goodsSources: [
				{
					text: "默认",
					value: "default",
					icon: fenxiaoResourcePath + "/goods_list/img/default_icon.png",
					selectedIcon: fenxiaoResourcePath + "/goods_list/img/default_selected_icon"+url+".png"
				},
				{
					text: "商品分类",
					value: "category",
					icon: fenxiaoResourcePath + "/goods_list/img/category_icon.png",
					selectedIcon: fenxiaoResourcePath + "/goods_list/img/category_selected_icon"+url+".png"
				},
				{
					text : "手动选择",
					value : "diy",
					icon: fenxiaoResourcePath + "/goods_list/img/diy_icon.png",
					selectedIcon: fenxiaoResourcePath + "/goods_list/img/diy_selected_icon"+url+".png"
				}
			],
			categoryName:'请选择',
			categoryList: [],
			isLoad: false,
			isShow: false,
			selectIndex: 0,//当前选中的下标
			goodsCount: [6, 12, 18, 24, 30],
		}
	},
	created:function() {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	computed:{
		sourcesText(){
			var sourcesText = '',
				_this = this;
			this.goodsSources.forEach(function(v){
				if (_this.data.sources == v.value) sourcesText = v.text;
			});
			return sourcesText;
		}
	},
	methods: {
		shopNum: function () {
			if (this.$parent.data.goodsCount > 50) {
				layer.msg("商品数量最多为50");
				this.$parent.data.goodsCount = 50;
			}
			if (this.$parent.data.goodsCount.length > 0 && this.$parent.data.goodsCount < 1) {
				layer.msg("商品数量不能小于0");
				this.$parent.data.goodsCount = 1;
			}
		},
		selectCategory() {
			var self = this;
			layer.open({
				type: 1,
				title: '选择分类',
				area: ['630px', '430px'],
				btn: ['确定', '返回'],
				content: $(".draggable-element[data-index='" + self.data.index + "'] .edit-attribute .goods-category-layer").html(),
				success: function (layero, index) {
					$("body").on("click", ".layui-layer-content .category-wrap .category-item", function () {
						$(this).addClass("selected ns-border-color").siblings().removeClass("selected ns-border-color");
					});
					$(".layui-layer-content .category-wrap .category-item[data-id='" + self.data.categoryId + "']").click();
				},
				yes: function (index, layero) {
					self.categoryName = $(".layui-layer-content .category-wrap .category-item.selected").text();
					self.data.categoryName = $(".layui-layer-content .category-wrap .category-item.selected").text();
					self.data.categoryId = $(".layui-layer-content .category-wrap .category-item.selected").attr('data-id');
					layer.closeAll();
				}
			});
		},
		verify: function () {
			var res = {code: true, message: ""};
			if (this.$parent.data.goodsCount.length === 0) {
				res.code = false;
				res.message = "请输入商品数量";
			}
			if (this.$parent.data.goodsCount < 0) {
				res.code = false;
				res.message = "商品数量不能小于0";
			}
			if (this.$parent.data.goodsCount > 50) {
				res.message = "商品数量最多为50";
			}
			return res;
		},
		addGoods: function () {
			var self = this;
			goodsSelect(function (res) {

				// if (!res.length) return false;
				// self.$parent.data.goodsId = [];
				// for (var i = 0; i < res.length; i++) {
				// 	self.$parent.data.goodsId.push(res[i]);
				// }
				self.$parent.data.goodsId = res;

			}, self.$parent.data.goodsId, {mode: "spu", promotion: "fenxiao", disabled: 0, post: post});
		},
	}
});

var fenxiaoStyleHtml = '<div class="layui-form-item">';
		fenxiaoStyleHtml += '<label class="layui-form-label sm">模板样式</label>';
		fenxiaoStyleHtml += '<div class="layui-input-block">';
			fenxiaoStyleHtml += '<div class="ns-input-text ns-text-color selected-style" v-on:click="selectGoodsStyle">风格{{ data.style }}<i class="iconfont iconyoujiantou"></i></div>';
		fenxiaoStyleHtml += '</div>';
	fenxiaoStyleHtml += '</div>';

Vue.component("fenxiao-style", {
	template: fenxiaoStyleHtml,
	data: function() {
		return {
			data: this.$parent.data,
		}
	},
	created:function() {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	methods: {
		verify: function () {
			var res = { code: true, message: "" };
			return res;
		},
		selectGoodsStyle: function() {
			var self = this;
			layer.open({
				type: 1,
				title: '风格选择',
				area:['930px','630px'],
				btn: ['确定', '返回'],
				content: $(".draggable-element[data-index='" + self.data.index + "'] .edit-attribute .fenxiao-list-style").html(),
				success: function(layero, index) {
					$(".layui-layer-content input[name='style']").val(self.data.style);
					$("body").on("click", ".layui-layer-content .style-list-con-fenxiao .style-li-fenxiao", function () {
						$(this).addClass("selected ns-border-color").siblings().removeClass("selected ns-border-color");
						$(".layui-layer-content input[name='style']").val($(this).index() + 1);
					});
				},
				yes: function (index, layero) {
					self.data.style = $(".layui-layer-content input[name='style']").val();
					layer.closeAll()
				}
			});
		},
	}
})

// 插件顶部标题
var fenxiaoTopHtml = '<ul class="fenxiao-addon-title">';
		fenxiaoTopHtml += '<li>';

			fenxiaoTopHtml += '<div class="layui-form-item">';
				fenxiaoTopHtml += '<label class="layui-form-label sm">左侧图标</label>';
				fenxiaoTopHtml += '<div class="layui-input-block">';
					fenxiaoTopHtml += '<img-upload v-bind:data="{ data : list }"></img-upload>';
				fenxiaoTopHtml += '</div>';
			fenxiaoTopHtml += '</div>';

			// fenxiaoTopHtml += '<img-upload v-bind:data="{ data : list }"></img-upload>';
			fenxiaoTopHtml += '<div class="content-block">';
				fenxiaoTopHtml += '<div class="layui-form-item">';
					fenxiaoTopHtml += '<label class="layui-form-label sm">标题</label>';
					fenxiaoTopHtml += '<div class="layui-input-block">';
						fenxiaoTopHtml += '<input type="text" name=\'title\' v-model="list.title" class="layui-input" />';
					fenxiaoTopHtml += '</div>';
				fenxiaoTopHtml += '</div>';
			fenxiaoTopHtml += '</div>';

			fenxiaoTopHtml += '<color v-bind:data="{ field : \'titleTextColor\', label : \'标题颜色\', defaultcolor: \'#000\' }"></color>';
		fenxiaoTopHtml += '</li>';

		fenxiaoTopHtml += '<li>';
			// fenxiaoTopHtml += '<div class="layui-form-item">';
			// 	fenxiaoTopHtml += '<label class="layui-form-label sm">右侧图标</label>';
			// 	fenxiaoTopHtml += '<div class="layui-input-block">';
			// 		fenxiaoTopHtml += '<img-upload v-bind:data="{ data : listMore }"></img-upload>';
			// 	fenxiaoTopHtml += '</div>';
			// fenxiaoTopHtml += '</div>';

			fenxiaoTopHtml += '<div class="content-block">';
				fenxiaoTopHtml += '<div class="layui-form-item">';
					fenxiaoTopHtml += '<label class="layui-form-label sm">文本内容</label>';
					fenxiaoTopHtml += '<div class="layui-input-block">';
						fenxiaoTopHtml += '<input type="text" name=\'title\' v-model="listMore.title" class="layui-input" />';
					fenxiaoTopHtml += '</div>';
				fenxiaoTopHtml += '</div>';
				fenxiaoTopHtml += '<color v-bind:data="{ field : \'moreTextColor\', defaultcolor: \'#858585\' }"></color>';

				// fenxiaoTopHtml += '<nc-link v-bind:data="{ field : $parent.data.list[index].link }"></nc-link>';

			fenxiaoTopHtml += '</div>';
		fenxiaoTopHtml += '</li>';
	fenxiaoTopHtml += '</ul>';

Vue.component("fenxiao-top-list",{
	template : fenxiaoTopHtml,
	data : function(){
		return {
            data : this.$parent.data,
			list : this.$parent.data.list,
			listMore: this.$parent.data.listMore
		};
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
	},
	watch : {

	},
	methods : {
		verify:function () {
			var res = { code : true, message : "" };
			var _self = this;
			$(".draggable-element[data-index='" + this.data.index + "'] .graphic-navigation .graphic-nav-list>ul>li").each(function(index){

				if(_self.selectedTemplate == "imageNavigation"){
					$(this).find("input[name='title']").removeAttr("style");//清空输入框的样式
					//检测是否有未上传的图片
					if(_self.list[index].imageUrl == ""){
						res.code = false;
						res.message = "请选择一张图片";
						$(this).find(".error-msg").text("请选择一张图片").show();
						return res;
					}else{
						$(this).find(".error-msg").text("").hide();
					}
				}else{
					if(_self.list[index].title == ""){
						res.code = false;
						res.message = "请输入标题";
						$(this).find("input[name='title']").attr("style","border-color:red !important;").focus();
						$(this).find(".error-msg").text("请输入标题").show();
						return res;
					}else{
						$(this).find("input[name='title']").removeAttr("style");
						$(this).find(".error-msg").text("").hide();
					}
				}
			});
			return res;
		}
	}
});