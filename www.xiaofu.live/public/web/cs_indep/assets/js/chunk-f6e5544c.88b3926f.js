(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-f6e5544c"],{"02b7":function(t,a,e){"use strict";var i=e("49ae"),n=e.n(i);n.a},"49ae":function(t,a,e){},"643a":function(t,a,e){"use strict";e.d(a,"b",(function(){return n})),e.d(a,"a",(function(){return s}));var i=e("751a");function n(t){return Object(i["a"])({url:"/api/notice/page",data:t})}function s(t){return Object(i["a"])({url:"/api/notice/info",data:t})}},"6db2":function(t,a,e){"use strict";e.r(a);var i=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"notice-wrap"},[e("el-breadcrumb",{staticClass:"path",attrs:{separator:"/"}},[e("el-breadcrumb-item",{staticClass:"path-home",attrs:{to:{path:"/"}}},[e("i",{staticClass:"n el-icon-s-home"}),t._v(" 首页 ")]),e("el-breadcrumb-item",{attrs:{to:{path:"/cms/notice"}}},[t._v("公告列表")]),e("el-breadcrumb-item",{staticClass:"path-help"},[t._v("公告详情")])],1),e("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticClass:"notice-detil"},[e("div",{staticClass:"notice-info"},[e("div",{staticClass:"title"},[t._v(t._s(t.info.title))]),e("div",{staticClass:"time"},[t._v(t._s(t.$util.timeStampTurnTime(t.info.create_time)))])]),e("div",{staticClass:"content",domProps:{innerHTML:t._s(t.info.content)}})])],1)},n=[],s=(e("ac1f"),e("5319"),e("643a")),c={name:"notice_detail",components:{},data:function(){return{info:{},loading:!0}},created:function(){this.id=this.$route.path.replace("/cms/notice-",""),this.getDetail()},watch:{$route:function(t){this.id=t.params.pathMatch,this.getDetail()}},methods:{getDetail:function(){var t=this;Object(s["a"])({id:this.id}).then((function(a){a.data?(t.info=a.data,t.loading=!1):t.$router.push({path:"/notice"})})).catch((function(a){t.loading=!1,t.$message.error(a.message)}))}}},o=c,r=(e("02b7"),e("2877")),l=Object(r["a"])(o,i,n,!1,null,"38d2b2e2",null);a["default"]=l.exports}}]);
//# sourceMappingURL=chunk-f6e5544c.88b3926f.js.map