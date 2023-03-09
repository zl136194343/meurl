var floatBtnListHtml = '<div class="float-btn-list">';
		floatBtnListHtml += '<p class="hint" style="font-size: 12px; margin: 5px 0 8px;">建议上传正方形图片，大小建议为33px * 33px</p>';
		floatBtnListHtml += '<ul>';
			floatBtnListHtml += '<li v-for="(item,index) in list" v-bind:key="index">';
				floatBtnListHtml += '<img-upload v-bind:data="{data : item}" :currIndex = "index"></img-upload>';
				floatBtnListHtml += '<div class="content-block">';
					floatBtnListHtml += '<nc-link v-bind:data="{field: $parent.data.list[index].link}"></nc-link>';
				floatBtnListHtml += '</div>';
				floatBtnListHtml += '<i class="del" v-on:click="list.splice(index,1)" data-disabled="1">x</i>';
				floatBtnListHtml += '<div class="error-msg"></div>';
			floatBtnListHtml += '</li>';
		floatBtnListHtml += '</ul>';
		floatBtnListHtml += '<div class="add-item ns-text-color" v-if="showAddItem" v-on:click="list.push({ imageUrl : \'\', title : \'\', link : {} })">';
			floatBtnListHtml += '<i>+</i>';
			floatBtnListHtml += '<span>添加一个浮动按钮</span>';
		floatBtnListHtml += '</div>';
		// floatBtnListHtml += '<div class="add-item ns-text-color" v-if="showAddItem &&  ($parent.data.bottomPosition== 3 || $parent.data.bottomPosition == 4)" v-on:click="list.splice(0,0,{ imageUrl : \'\', title : \'\', link : {} })">';
		// 	floatBtnListHtml += '<i>+</i>';
		// 	floatBtnListHtml += '<span>添加一个浮动按钮</span>';
		// floatBtnListHtml += '</div>';
	floatBtnListHtml += '</div>';

Vue.component("float-btn-list",{
	data: function () {
		return {
			list: this.$parent.data.list,
			maxTip : 3,//最大上传数量提示
			showAddItem : true,
			systemInfo:{
				top:0,
				left:0,
				right:0,
				bottom:0,
				width:0
			},
			screenWidth:0
		};
	},
	created : function(){
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		this.getElementPosition(this.$parent);
		// window.addEventListener('resize', onResize);
		window.onresize = () => {
		    return (() => {
		        window.screenWidth = document.body.clientWidth;
		        this.screenWidth = window.screenWidth;
		    })();
		};
		this.changeShowAddItem();//获取默认值
	},
	watch : {
		list : function(){
			this.changeShowAddItem();
		},
		screenWidth(val){
		        // 为了避免频繁触发resize函数导致页面卡顿，使用定时器
			this.getElementPosition(this.$parent)
		}
	},
	
	methods: {
		verify: function () {
			var res = {code: true, message: ""};
			if (this.list.length > 0) {
				for (var i = 0; i < this.list.length; i++) {
					if (this.$parent.data.list[i].imageUrl == "") {
						res.code = false;
						res.message = "请添加图片";
						break;
					}
				}
			} else {
				res.code = false;
				res.message = "请添加一个浮动按钮";
			}
			return res;
		},
		//改变添加浮动按钮
		changeShowAddItem() {
			if (this.list.length >= this.maxTip) this.showAddItem = false;
			else this.showAddItem = true;
		},
		getElementPosition(e) {
			var box = document.querySelector("#diyView").getBoundingClientRect();
			var box1 = document.querySelector(".layui-form").getBoundingClientRect();
			if (this.$parent.data.bottomPosition == 2) {
				this.$parent.data.baseBtnBottom = Math.abs(box.top);
				var temp = Math.abs(box.top) + parseInt(this.$parent.data.btnBottom);
				$(".draggable-element .float-btn").css({
					left: box1.left + 45,
					top: temp,
					'margin-right': '15px',
					'z-index': 999,
					height: '40px'
				});
			} else if (this.$parent.data.bottomPosition == 3) {
				this.$parent.data.baseBtnBottom = 100;
				var temp = 100 + parseInt(this.$parent.data.btnBottom);
				$(".draggable-element .float-btn").css({
					left: box1.left - box.left + 5,
					top: 'auto',
					bottom: temp,
					'z-index': 999
				});
			} else if (this.$parent.data.bottomPosition == 1) {

				this.$parent.data.baseBtnBottom = Math.abs(box.top);
				var temp = Math.abs(box.top) + parseInt(this.$parent.data.btnBottom);
				$(".draggable-element .float-btn").css({
					left: box1.left - box.left + 5,
					top: temp,
					'z-index': 999,
					height: '40px'
				});

			} else {
				this.$parent.data.baseBtnBottom = 100;
				var temp = 100 + parseInt(this.$parent.data.btnBottom);
				$(".draggable-element .float-btn").css({
					left: box1.left + 45,
					top: 'auto',
					bottom: temp,
					'margin-right': '15px',
					'z-index': 999
				});
			}
			$(".draggable-element .float-btn .edit-attribute").css({
				position: 'fixed',
				right: '30px',
				top: Math.abs(box.top),
			})
		}
	},
	template: floatBtnListHtml
});

var searchHtml = '<div class="layui-form-item flex">';
	searchHtml += 	 '<div class="flex_left">';
	searchHtml +=	 	 '<label class="layui-form-label sm">{{data.label}}</label>';
	searchHtml += 		 '<template v-for="(item,index) in list" v-bind:k="index">';
	searchHtml += 		 	'<div v-if="parent[data.field]==item.value">{{item.label}}</div>';
	searchHtml += 		 '</template>';
	searchHtml += 	 '</div>';
	searchHtml +=	 '<div class="layui-input-block flex_fill">';
	searchHtml +=	 	'<div class="flex_choose">';
	searchHtml +=		 	'<template v-for="(item,index) in list" v-bind:k="index">';
	// searchHtml +=				 '<div v-on:click="parent[data.field]=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (parent[data.field]==item.value) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>{{item.label}}</div></div>';
	searchHtml +=		 		'<div v-on:click="parent[data.field]=item.value" :class="{\'active\':parent[data.field]==item.value}">';
	searchHtml +=		 			'<img :src="item.icon_img_active" v-if="parent[data.field]==item.value"/>';
	searchHtml +=		 			'<img :src="item.icon_img" v-else />';
	searchHtml +=		 		'</div>';
	searchHtml +=		 	'</template>';
	searchHtml +=	 	'</div>';
	searchHtml +=	 '</div>';
	searchHtml += '</div>';
Vue.component("btn-position", {
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
				{
					label: "居左", 
					value: "left",
					icon_img:floatBtnResourcePath + "/search/img/text_left.png",
					icon_img_active:floatBtnResourcePath + "/search/img/text_left_hover"+post == 'shop'?'':'_admin'+".png"
				},
				{
					label: "居右", 
					value: "center",
					icon_img:floatBtnResourcePath + "/search/img/text_right.png",
					icon_img_active:floatBtnResourcePath + "/search/img/text_right_hover"+post == 'shop'?'':'_admin'+".png"
				},
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

/**
 * 按钮位置
 */
var btnPosition = '<div class="layui-form-item ns-icon-radio">';
	btnPosition += '<label class="layui-form-label sm">{{data.label}}</label>';
	btnPosition +=	 '<div class="layui-input-block">';
	btnPosition += 		 '<template v-for="(item,index) in list" v-bind:k="index">';
	btnPosition += 		 	'<span :class="[parent[data.field] == item.value ? \'\' : \'layui-hide\']">{{item.label}}</span>';
	btnPosition += 		 '</template>';
	btnPosition +=	 	'<ul class="ns-icon">';
	btnPosition +=		 	'<template v-for="(item,index) in list" v-bind:k="index">';
	// searchHtml +=				 '<div v-on:click="parent[data.field]=item.value" v-bind:class="{ \'layui-unselect layui-form-radio\' : true,\'layui-form-radioed\' : (parent[data.field]==item.value) }"><i class="layui-anim layui-icon">&#xe63f;</i><div>{{item.label}}</div></div>';
	btnPosition +=		 		'<li v-on:click="clickFun(item.value)" :class="{\'ns-text-color ns-border-color ns-bg-color-diaphaneity\':parent[data.field] == item.value}">';
	btnPosition +=		 			'<img :src="item.icon_img_active" v-if="parent[data.field] == item.value"/>';
	btnPosition +=		 			'<img :src="item.icon_img" v-else />';
	btnPosition +=		 		'</li>';
	btnPosition +=		 	'</template>';
	btnPosition +=	 	'</ul>';
	btnPosition +=	 '</div>';
	btnPosition += '</div>';
Vue.component("btn-position", {
	props: {
		data: {
			type: Object,
			default: function () {
				return {
					field: "bottomPosition",
					label: "按钮位置"
				};
			}
		}
	},
	data: function () {
		var url = post == 'shop'?'':'_admin';
		return {
			list: [
				{
					label: "左上", 
					value: "1",
					icon_img:floatBtnResourcePath + "/float_btn/img/left_top.png",
					icon_img_active:floatBtnResourcePath + "/float_btn/img/left_top_hover"+url+".png"
				},
				{
					label: "右上", 
					value: "2",
					icon_img:floatBtnResourcePath + "/float_btn/img/right_top.png",
					icon_img_active:floatBtnResourcePath + "/float_btn/img/right_top_hover"+url+".png"
				},
				{
					label: "左下", 
					value: "3",
					icon_img:floatBtnResourcePath + "/float_btn/img/left_bottom.png",
					icon_img_active:floatBtnResourcePath + "/float_btn/img/left_bottom_hover"+url+".png"
				},
				{
					label: "右下", 
					value: "4",
					icon_img:floatBtnResourcePath + "/float_btn/img/right_bottom.png",
					icon_img_active:floatBtnResourcePath + "/float_btn/img/right_bottom_hover"+url+".png"
				},
			],
			isReverse:true,
			parent: this.$parent.data,
			imglist:this.$parent.data.list,
			bottomPos:1,
		};
	},
	created: function () {
		if(!this.$parent.data.verify) this.$parent.data.verify = [];
		this.$parent.data.verify.push(this.verify);//加载验证方法
		if (this.data.label == undefined) this.data.label = "按钮位置";
		if (this.data.field == undefined) this.data.field = "bottomPosition";
		if(this.data.value == undefined){this.data.value = 1}
		if(this.parent[this.data.field] == undefined){this.parent[this.data.field] = 1}
		this.bottomPos = this.parent.bottomPosition;
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
			if (val.label == undefined) val.label = "按钮位置";
		},
		imglist:function(val, oldVal){
			var height = val.length > 1 ? ((val.length - 1) * 50) + 40 :40;
			$(".draggable-element .float-btn").css({
				height:height
			});
			$(".float-btn .float-btn-box").css({
				height:height
			})
		},
		bottomPos:function(val, oldVal){
			if((oldVal == 3 || oldVal == 4) &&  (val == 1 || val == 2) || (oldVal == 1 || oldVal == 2) &&  (val == 3 || val == 4)){
				this.imglist = this.imglist.reverse()
			}
		}
	},
	methods: {
		clickFun:function(val){
			this.bottomPos = val;
			this.parent[this.data.field] = val;
			this.getElementPosition(this.parent)
		},
		verify : function () {
			var res = { code : true, message : "" };
			return res;
		},
		getElementPosition(e){
			var box = document.querySelector("#diyView").getBoundingClientRect();
			var box1 = document.querySelector(".layui-form").getBoundingClientRect();
			if(this.parent.bottomPosition == 2){
				this.parent.baseBtnBottom = box.top;
				var temp = parseInt(box.top) + parseInt(this.parent.btnBottom);
				$(".draggable-element .float-btn").css({
					left:box1.left + 45,
					top:temp,
					// 'margin-right':'15px'
				});
				
			}
			else if(this.parent.bottomPosition == 3){
				this.parent.baseBtnBottom = 100
				var temp = 100 + parseInt(this.parent.btnBottom);
				$(".draggable-element .float-btn").css({
					left:box1.left - box.left + 5,
					top:'auto',
					bottom:temp,
					'z-index':999
				});
			}else if(this.parent.bottomPosition == 1){
				this.parent.baseBtnBottom = box.top;
				var temp = parseInt(box.top) + parseInt(this.parent.btnBottom);
				$(".draggable-element .float-btn").css({
					left:box1.left - box.left + 5,
					top:temp
					
				});
			}else{
				this.parent.baseBtnBottom = 100;
				var temp = 100 + parseInt(this.parent.btnBottom);
				$(".draggable-element .float-btn").css({
					left:box1.left + 45,
					top:'auto',
					bottom:temp,
					'margin-right':'15px',
					'z-index':999
				});
			}
			// }
			$(".draggable-element .float-btn .edit-attribute").css({
				position: 'fixed',
				right:'30px',
				top:Math.abs(box.top),
				
			})
		}
	},
	template: btnPosition
});