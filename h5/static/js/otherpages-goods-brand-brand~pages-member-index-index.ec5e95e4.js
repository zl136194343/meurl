(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["otherpages-goods-brand-brand~pages-member-index-index"],{"0d24":function(e,t,i){"use strict";var r;i.d(t,"b",(function(){return n})),i.d(t,"c",(function(){return a})),i.d(t,"a",(function(){return r}));var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return e.text?i("v-uni-text",{staticClass:"uni-badge",class:e.inverted?"uni-badge-"+e.type+" uni-badge--"+e.size+" uni-badge-inverted":"uni-badge-"+e.type+" uni-badge--"+e.size,on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.onClick()}}},[e._v(e._s(e.text))]):e._e()},a=[]},"1f0c":function(e,t,i){var r=i("a617");"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var n=i("4f06").default;n("1dce6098",r,!0,{sourceMap:!1,shadowMode:!1})},3416:function(e,t,i){"use strict";i.r(t);var r=i("e56b"),n=i("efdd");for(var a in n)"default"!==a&&function(e){i.d(t,e,(function(){return n[e]}))}(a);i("f9e3");var o,d=i("f0c5"),u=Object(d["a"])(n["default"],r["b"],r["c"],!1,null,"a4e754f8",null,!1,r["a"],o);t["default"]=u.exports},4670:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r={name:"UniBadge",props:{type:{type:String,default:"default"},inverted:{type:Boolean,default:!1},text:{type:String,default:""},size:{type:String,default:"normal"}},methods:{onClick:function(){this.$emit("click")}}};t.default=r},5694:function(e,t,i){"use strict";var r=i("4ea4");i("a9e3"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r(i("f413")),a={name:"UniGridItem",components:{uniBadge:n.default},props:{marker:{type:String,default:""},hor:{type:Number,default:0},ver:{type:Number,default:0},type:{type:String,default:""},text:{type:String,default:""},size:{type:String,default:"normal"},inverted:{type:Boolean,default:!1},src:{type:String,default:""},imgWidth:{type:Number,default:30}},inject:["grid"],data:function(){return{column:0,showBorder:!0,square:!0,highlight:!0,left:0,top:0,index:0,openNum:2,width:0,borderColor:"#e5e5e5"}},created:function(){this.column=this.grid.column,this.showBorder=this.grid.showBorder,this.square=this.grid.square,this.highlight=this.grid.highlight,this.top=0===this.hor?this.grid.hor:this.hor,this.left=0===this.ver?this.grid.ver:this.ver,this.borderColor=this.grid.borderColor,this.index=this.grid.index++},mounted:function(){var e=this;this.grid._getSize((function(t){e.width=t}))},methods:{_onClick:function(){this.grid.change({detail:{index:this.index}})}}};t.default=a},8206:function(e,t,i){"use strict";i.d(t,"b",(function(){return n})),i.d(t,"c",(function(){return a})),i.d(t,"a",(function(){return r}));var r={uniBadge:i("f413").default},n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return e.width?i("v-uni-view",{staticClass:"uni-grid-item",style:{width:e.width}},[i("v-uni-view",{staticClass:"uni-grid-item__box",class:{border:e.showBorder,"uni-grid-item__box-square":e.square,"border-top":e.showBorder&&e.index<e.column,"uni-highlight":e.highlight},style:{"border-color":e.borderColor},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e._onClick.apply(void 0,arguments)}}},["dot"===e.marker?i("v-uni-view",{staticClass:"uni-grid-item__box-dot",style:{left:e.top+"px",top:e.left+"px"}}):e._e(),"badge"===e.marker?i("v-uni-view",{staticClass:"uni-grid-item__box-badge",style:{left:e.top+"px",top:e.left+"px"}},[i("uni-badge",{attrs:{text:e.text,type:e.type,size:e.size,inverted:e.inverted}})],1):e._e(),"image"===e.marker?i("v-uni-view",{staticClass:"uni-grid-item__box-image",style:{left:e.top+"px",top:e.left+"px"}},[i("v-uni-image",{staticClass:"box-image",style:{width:e.imgWidth+"px"},attrs:{src:e.src,mode:"widthFix"}})],1):e._e(),i("v-uni-view",{staticClass:"uni-grid-item__box-item"},[e._t("default")],2)],1)],1):e._e()},a=[]},8880:function(e,t,i){"use strict";i("a9e3"),i("d3b7"),i("e25e"),i("ac1f"),i("25f0"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r={name:"UniGrid",props:{column:{type:Number,default:3},showBorder:{type:Boolean,default:!0},borderColor:{type:String,default:"#e5e5e5"},hor:{type:Number,default:0},ver:{type:Number,default:0},square:{type:Boolean,default:!0},highlight:{type:Boolean,default:!0}},provide:function(){return{grid:this}},data:function(){var e="Uni_".concat(Math.ceil(1e6*Math.random()).toString(36));return{index:0,elId:e}},created:function(){this.index=0,this.childrens=[],this.pIndex=this.pIndex?this.pIndex++:0},methods:{change:function(e){this.$emit("change",e)},_getSize:function(e){var t=this;uni.createSelectorQuery().in(this).select("#".concat(this.elId)).boundingClientRect().exec((function(i){if(i[0]){var r=parseInt(i[0].width/t.column)-1+"px";"function"===typeof e&&e(r)}else setTimeout(t._getSize(e))}))}}};t.default=r},9283:function(e,t,i){"use strict";i.r(t);var r=i("8206"),n=i("bea2");for(var a in n)"default"!==a&&function(e){i.d(t,e,(function(){return n[e]}))}(a);i("dca2");var o,d=i("f0c5"),u=Object(d["a"])(n["default"],r["b"],r["c"],!1,null,"298657fa",null,!1,r["a"],o);t["default"]=u.exports},a617:function(e,t,i){var r=i("24fb");t=r(!1),t.push([e.i,".uni-grid-item[data-v-298657fa]{-webkit-box-sizing:border-box;box-sizing:border-box}.uni-grid-item__box[data-v-298657fa]{position:relative;width:100%}.uni-grid-item__box-item[data-v-298657fa]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;width:100%;height:100%;font-size:%?32?%;color:#666;padding:%?20?% 0;-webkit-box-sizing:border-box;box-sizing:border-box}.uni-grid-item__box-item .image[data-v-298657fa]{width:%?50?%;height:%?50?%}.uni-grid-item__box-item .text[data-v-298657fa]{font-size:%?26?%;margin-top:%?10?%}.uni-grid-item__box.uni-grid-item__box-square[data-v-298657fa]{height:0;padding-top:100%}.uni-grid-item__box.uni-grid-item__box-square .uni-grid-item__box-item[data-v-298657fa]{position:absolute;top:0}.uni-grid-item__box.border[data-v-298657fa]{position:relative;-webkit-box-sizing:border-box;box-sizing:border-box;border-bottom:1px #e5e5e5 solid;border-right:1px #e5e5e5 solid}.uni-grid-item__box.border-top[data-v-298657fa]{border-top:1px #e5e5e5 solid}.uni-grid-item__box.uni-highlight[data-v-298657fa]:active{background-color:#eee}.uni-grid-item__box-badge[data-v-298657fa],\r\n.uni-grid-item__box-dot[data-v-298657fa],\r\n.uni-grid-item__box-image[data-v-298657fa]{position:absolute;top:0;right:0;left:0;bottom:0;margin:auto;z-index:10}.uni-grid-item__box-dot[data-v-298657fa]{width:%?20?%;height:%?20?%;background:#ff5a5f;-webkit-border-radius:50%;border-radius:50%}.uni-grid-item__box-badge[data-v-298657fa]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center;width:0;height:0}.uni-grid-item__box-image[data-v-298657fa]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center;width:%?100?%;height:%?100?%;overflow:hidden}.uni-grid-item__box-image .box-image[data-v-298657fa]{width:%?90?%}",""]),e.exports=t},bea2:function(e,t,i){"use strict";i.r(t);var r=i("5694"),n=i.n(r);for(var a in r)"default"!==a&&function(e){i.d(t,e,(function(){return r[e]}))}(a);t["default"]=n.a},c1f7:function(e,t,i){"use strict";var r=i("f390"),n=i.n(r);n.a},d957:function(e,t,i){var r=i("24fb");t=r(!1),t.push([e.i,".uni-grid[data-v-a4e754f8]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-sizing:border-box;box-sizing:border-box;border-left:1px #e5e5e5 solid}",""]),e.exports=t},dca2:function(e,t,i){"use strict";var r=i("1f0c"),n=i.n(r);n.a},e56b:function(e,t,i){"use strict";var r;i.d(t,"b",(function(){return n})),i.d(t,"c",(function(){return a})),i.d(t,"a",(function(){return r}));var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("v-uni-view",[i("v-uni-view",{staticClass:"uni-grid",class:{border:e.showBorder},style:{"border-left":e.showBorder?"1px "+e.borderColor+" solid":"none"},attrs:{id:e.elId}},[e._t("default")],2)],1)},a=[]},ed03:function(e,t,i){var r=i("d957");"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var n=i("4f06").default;n("1d1f8b14",r,!0,{sourceMap:!1,shadowMode:!1})},efdd:function(e,t,i){"use strict";i.r(t);var r=i("8880"),n=i.n(r);for(var a in r)"default"!==a&&function(e){i.d(t,e,(function(){return r[e]}))}(a);t["default"]=n.a},f1c0:function(e,t,i){var r=i("24fb");t=r(!1),t.push([e.i,".uni-badge[data-v-7be0e207]{font-family:Helvetica Neue,Helvetica,sans-serif;-webkit-box-sizing:border-box;box-sizing:border-box;font-size:12px;line-height:1;display:inline-block;padding:3px 6px;color:#333;-webkit-border-radius:100px;border-radius:100px;background-color:#e5e5e5}.uni-badge.uni-badge-inverted[data-v-7be0e207]{padding:0 5px 0 0;color:#999;background-color:transparent}.uni-badge-primary[data-v-7be0e207]{color:#fff;background-color:#007aff}.uni-badge-primary.uni-badge-inverted[data-v-7be0e207]{color:#007aff;background-color:transparent}.uni-badge-success[data-v-7be0e207]{color:#fff;background-color:#4cd964}.uni-badge-success.uni-badge-inverted[data-v-7be0e207]{color:#4cd964;background-color:transparent}.uni-badge-warning[data-v-7be0e207]{color:#fff;background-color:#f0ad4e}.uni-badge-warning.uni-badge-inverted[data-v-7be0e207]{color:#f0ad4e;background-color:transparent}.uni-badge-error[data-v-7be0e207]{color:#fff;background-color:#dd524d}.uni-badge-error.uni-badge-inverted[data-v-7be0e207]{color:#dd524d;background-color:transparent}.uni-badge--small[data-v-7be0e207]{-webkit-transform:scale(.8);transform:scale(.8);-webkit-transform-origin:center center;transform-origin:center center}",""]),e.exports=t},f390:function(e,t,i){var r=i("f1c0");"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var n=i("4f06").default;n("027df4f6",r,!0,{sourceMap:!1,shadowMode:!1})},f413:function(e,t,i){"use strict";i.r(t);var r=i("0d24"),n=i("fe89");for(var a in n)"default"!==a&&function(e){i.d(t,e,(function(){return n[e]}))}(a);i("c1f7");var o,d=i("f0c5"),u=Object(d["a"])(n["default"],r["b"],r["c"],!1,null,"7be0e207",null,!1,r["a"],o);t["default"]=u.exports},f9e3:function(e,t,i){"use strict";var r=i("ed03"),n=i.n(r);n.a},fe89:function(e,t,i){"use strict";i.r(t);var r=i("4670"),n=i.n(r);for(var a in r)"default"!==a&&function(e){i.d(t,e,(function(){return r[e]}))}(a);t["default"]=n.a}}]);