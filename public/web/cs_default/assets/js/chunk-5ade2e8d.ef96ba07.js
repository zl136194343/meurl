(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5ade2e8d"],{"121f":function(e,t,i){"use strict";i.d(t,"a",(function(){return n})),i.d(t,"d",(function(){return r})),i.d(t,"c",(function(){return s})),i.d(t,"b",(function(){return c})),i.d(t,"e",(function(){return o}));var a=i("751a");function n(e){return Object(a["a"])({url:"/api/verify/checkisverifier",data:e,forceLogin:!0})}function r(e){return Object(a["a"])({url:"/api/verify/verifyInfo",data:e,forceLogin:!0})}function s(e){return Object(a["a"])({url:"/api/verify/verify",data:e,forceLogin:!0})}function c(e){return Object(a["a"])({url:"/api/verify/getVerifyType",data:e})}function o(e){return Object(a["a"])({url:"/api/verify/lists",data:e,forceLogin:!0})}},"49d1":function(e,t,i){},"85d2":function(e,t,i){"use strict";i.r(t);var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"box"},[i("div",{directives:[{name:"show",rawName:"v-show",value:e.yes,expression:"yes"}],staticClass:"null-page"}),i("el-card",{staticClass:"box-card order-list"},[i("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[i("span",[e._v("核销记录")])]),i("div",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}]},[i("el-tabs",{on:{"tab-click":e.handleClick},model:{value:e.orderType,callback:function(t){e.orderType=t},expression:"orderType"}},e._l(e.typeList,(function(e,t){return i("el-tab-pane",{key:t,attrs:{label:e.name,name:e.type}})})),1),i("div",[i("nav",[i("li",[e._v("商品信息")]),i("li",[e._v("单价")]),i("li",[e._v("数量")])]),e.verifyList.length>0?i("div",{staticClass:"list"},e._l(e.verifyList,(function(t,a){return i("div",{key:a,staticClass:"item"},[i("div",{staticClass:"head"},[i("span",{staticClass:"create-time"},[e._v(e._s(e.$util.timeStampTurnTime(t.create_time)))]),i("router-link",{attrs:{to:"/shop-"+t.site_id,target:"_blank"}},[e._v(e._s(t.site_name))]),i("span",{staticClass:"order-type"},[e._v(e._s(t.order_type_name))]),i("span",{staticClass:"order-type"},[e._v("核销员："+e._s(t.verifier_name))])],1),e._l(t.item_array,(function(n,r){return i("ul",{key:r},[i("li",[i("div",{staticClass:"img-wrap",on:{click:function(i){return e.toVerifyDetail(t.verify_code)}}},[i("img",{attrs:{src:e.$img(n.img)},on:{error:function(t){return e.imageError(a,r)}}})]),i("div",{staticClass:"info-wrap"},[i("h5",{on:{click:function(i){return e.toVerifyDetail(t.verify_code)}}},[e._v(e._s(n.name))])])]),i("li",[i("span",[e._v("￥"+e._s(n.price))])]),i("li",[i("span",[e._v(e._s(n.num))])])])}))],2)})),0):e.loading||0!=e.verifyList.length?e._e():i("div",{staticClass:"empty-wrap"},[e._v("暂无相关订单")])])],1),i("div",{staticClass:"pager"},[i("el-pagination",{attrs:{background:"","pager-count":5,total:e.total,"prev-text":"上一页","next-text":"下一页","current-page":e.currentPage,"page-size":e.pageSize,"hide-on-single-page":""},on:{"update:currentPage":function(t){e.currentPage=t},"update:current-page":function(t){e.currentPage=t},"update:pageSize":function(t){e.pageSize=t},"update:page-size":function(t){e.pageSize=t},"size-change":e.handlePageSizeChange,"current-change":e.handleCurrentPageChange}})],1)])],1)},n=[],r=(i("4160"),i("b0c0"),i("b64b"),i("159b"),i("5530")),s=i("2f62"),c=i("121f"),o={name:"verification_list",components:{},data:function(){return{orderType:"",loading:!0,typeList:[],verifyList:[],currentPage:1,pageSize:10,total:0,yes:!0}},created:function(){this.getVerifyType()},computed:Object(r["a"])({},Object(s["b"])(["defaultGoodsImage"])),mounted:function(){var e=this;setTimeout((function(){e.yes=!1}),300)},methods:{handlePageSizeChange:function(e){this.pageSize=e,this.refresh()},handleCurrentPageChange:function(e){this.currentPage=e,this.refresh()},refresh:function(){this.loading=!0,this.getVerifyType()},handleClick:function(e,t){this.refresh()},getVerifyType:function(){var e=this;Object(c["b"])().then((function(t){if(t.code>=0){if(e.typeList=[],e.verifyList=[],Object.keys(t.data).forEach((function(i){e.typeList.push({type:i,name:t.data[i].name})})),0==e.orderType)for(var i=0;i<e.typeList.length;i++)0==i&&(e.orderType=e.typeList[i].type);e.getVerifyList(e.orderType)}})).catch((function(e){}))},getVerifyList:function(e){var t=this;Object(c["e"])({verify_type:e,page:this.currentPage,page_size:this.pageSize}).then((function(e){t.verifyList=e.data.list,t.total=e.data.count,t.loading=!1})).catch((function(e){t.$message.error(e.message),t.loading=!1}))},imageError:function(e,t){this.verifyList[e].item_array[t].img=this.defaultGoodsImage},toVerifyDetail:function(e){this.$router.push({path:"/member/verification_detail",query:{code:e}})}}},u=o,f=(i("cc6f"),i("2877")),l=Object(f["a"])(u,a,n,!1,null,"67e85395",null);t["default"]=l.exports},cc6f:function(e,t,i){"use strict";var a=i("49d1"),n=i.n(a);n.a}}]);
//# sourceMappingURL=chunk-5ade2e8d.ef96ba07.js.map