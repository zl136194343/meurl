/**
 * 商品搜索·组件
 */
var productSearchHtml = '<div>';

	productSearchHtml += '<div class="layui-form-item" >';
		productSearchHtml += '<label class="layui-form-label sm">左侧图片</label>';
		productSearchHtml += '<div class="layui-input-block">';
			productSearchHtml += '<img-upload v-bind:data="{ data : $parent.data, field : \'left_img_url\' }"></img-upload>';
		productSearchHtml += '</div>';
		productSearchHtml += '<p class="hint">建议尺寸：30 x 30 像素</p>';
	productSearchHtml += '</div>';

	productSearchHtml += '<nc-link v-bind:data="{ field : $parent.data.left_link }"></nc-link>';
	
	productSearchHtml += '<div class="layui-form-item" >';
		productSearchHtml += '<label class="layui-form-label sm">右侧图片</label>';
		productSearchHtml += '<div class="layui-input-block">';
			productSearchHtml += '<img-upload v-bind:data="{ data : $parent.data, field : \'right_img_url\' }"></img-upload>';
		productSearchHtml += '</div>';
		productSearchHtml += '<p class="hint">建议尺寸：30 x 30 像素</p>';

	productSearchHtml += '</div>';

	productSearchHtml += '<nc-link v-bind:data="{ field : $parent.data.right_link }"></nc-link>';
	
	productSearchHtml += '</div>';

Vue.component("top-search",{

	template : productSearchHtml,
	data : function(){
		return {
			data : this.$parent.data
		};
	}
});

var searchHtml = '<div class="layui-form-item">';
	searchHtml +=	 '<label class="layui-form-label sm">{{data.label}}</label>';
	searchHtml +=	 '<div class="layui-input-block">';
	searchHtml +=		 '<template v-for="(item,index) in list" v-bind:k="index">';
	searchHtml +=			 '<div v-on:click="parent[data.field]=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (parent[data.field]==item.value) }"><i class="layui-anim layui-icon">&#xe643;</i><div>{{item.label}}</div></div>';
	searchHtml +=		 '</template>';
	searchHtml +=	 '</div>';
	searchHtml += '</div>';

Vue.component("goods-search", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "textAlign",
					label: "文本位置"
				};
			}
		}
	},
	data: function () {
		return {
			list: [
				{label: "居左", value: "left"},
				{label: "居中", value: "center"},
			],
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "文本位置";
		if (this.data.field == undefined) this.data.field = "textAlign";
		
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "文本位置";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: searchHtml
});


var borderHtml = '<div class="layui-form-item">';
	borderHtml +=	 '<label class="layui-form-label sm">{{data.label}}</label>';
	borderHtml +=	 '<div class="layui-input-block">';
	borderHtml +=		 '<template v-for="(item,index) in list" v-bind:k="index">';
	borderHtml +=			 '<div v-on:click="parent[data.field]=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (parent[data.field]==item.value) }"><i class="layui-anim layui-icon">&#xe643;</i><div>{{item.label}}</div></div>';
	borderHtml +=		 '</template>';
	borderHtml +=	 '</div>';
	borderHtml += '</div>';

Vue.component("search-border", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "borderType",
					label: "框体样式"
				};
			}
		}
	},
	data: function () {
		return {
			list: [
				{label: "方形", value: 1},
				{label: "圆形", value: 2},
			],
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "框体样式";
		if (this.data.field == undefined) this.data.field = "borderType";
		
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "框体样式";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: borderHtml
});

var typeHtml = '<div class="layui-form-item">';
typeHtml +=	 	'<label class="layui-form-label sm">{{data.label}}</label>';
typeHtml +=	 	'<div class="layui-input-block">';
typeHtml +=			 '<template v-for="(item,index) in list" v-bind:k="index">';
typeHtml +=				 '<div v-on:click="parent[data.field]=item.value" v-if="parent[data.field]==item.value"><div>{{item.label}}</div></div>';
typeHtml +=			 '</template>';
typeHtml +=	 	'</div>';
typeHtml +=		'<div class="search_type">';
typeHtml +=			 '<template v-for="(item,index) in list" v-bind:k="index">';
typeHtml +=		 		'<div class="search_type_left" v-on:click="parent[data.field]=item.value,parent.searchStyle=1" :class="{\'active\':parent[data.field]==item.value}">';
typeHtml +=		 			'<img :src="item.icon_img_active" v-if="parent[data.field]==item.value"/>';
typeHtml +=		 			'<img :src="item.icon_img" v-else />';
typeHtml +=		 		'</div>';
typeHtml +=			 '</template>';
typeHtml +=			 '</div>';
typeHtml +=		 '<div class="search_logo" v-if="parent[data.field] == 2">';
typeHtml +=		 	'<div><img-upload v-bind:data="{ data : parent, field : \'searchImg\' }" v-bind:isShow="!1"></img-upload></div>';
typeHtml +=		 	'<div class="desc" >';
typeHtml +=		 		'<div class="tip" >最多可添加一张图片</div>';
typeHtml +=		 		'<div class="spec">85px*30px</div>';
typeHtml +=	 		'</div>';
typeHtml +=	 	'</div>';

typeHtml += '</div>';


Vue.component("search-type", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "searchType",
					label: "选择模板"
				};
			}
		}
	},
	data: function () {
		var url = post== 'shop'?'':'_admin';
		return {
			list: [
				{
					label: "样式1",
					value: 1,
					icon_img:searchResourcePath + "/search/img/search1.png",
					icon_img_active:searchResourcePath + "/search/img/search1_hover"+url+".png",
				},
				{
					label: "样式2",
					value: 2,
					icon_img:searchResourcePath + "/search/img/search2.png",
					icon_img_active:searchResourcePath + "/search/img/search2_hover"+url+".png",
				},
			],
			parent: this.$parent.data,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "选择模板";
		if (this.data.field == undefined) this.data.field = "searchType";
		if(!this.parent.searchType){
			this.parent.searchType = 1
		}
		var self = this;
		setTimeout(function () {
			layui.use(['form'], function() {
				self.form = layui.form;
				self.form.render();
			});
		},10);
	},
	watch: {
		data: function (val, oldVal) {
			if (val.field == undefined) val.field = oldVal.field;
			if (val.label == undefined) val.label = "选择模板";
		},
	},
	methods: {
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
	},
	template: typeHtml
});