(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-646143fa"],{"068f":function(t,e,i){},1008:function(t,e,i){},"1da1":function(t,e,i){"use strict";i.d(e,"a",(function(){return n}));i("d3b7");function r(t,e,i,r,n,a,s){try{var o=t[a](s),c=o.value}catch(l){return void i(l)}o.done?e(c):Promise.resolve(c).then(r,n)}function n(t){return function(){var e=this,i=arguments;return new Promise((function(n,a){var s=t.apply(e,i);function o(t){r(s,n,a,o,c,"next",t)}function c(t){r(s,n,a,o,c,"throw",t)}o(void 0)}))}}},"2f84":function(t,e,i){"use strict";i.d(e,"c",(function(){return n})),i.d(e,"a",(function(){return a})),i.d(e,"b",(function(){return s}));var r=i("751a");function n(t){return Object(r["a"])({url:"/api/goodscollect/iscollect",data:t,forceLogin:!0})}function a(t){return Object(r["a"])({url:"/api/goodscollect/add",data:t,forceLogin:!0})}function s(t){return Object(r["a"])({url:"/api/goodscollect/delete",data:t,forceLogin:!0})}},"43fc":function(t,e,i){"use strict";i.r(e);var r=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticClass:"goods-list"},[t.keyword?i("div",{staticClass:"search_bread"},[i("span",[t._v("搜索结果：")]),i("span",{staticClass:"keyword"},[t._v("'"+t._s(t.keyword)+"'")])]):!t.keyword&&t.catewords?i("div",{staticClass:"search_bread"},[i("span",[t._v("搜索结果:：")]),i("span",{staticClass:"keyword"},[t._v("'"+t._s(t.catewords)+"'")])]):t._e(),t.catewords?i("div",{staticClass:"attr_filter"},[t.choosedBrand?i("el-tag",{attrs:{type:"info",closable:"",effect:"plain"},on:{close:t.colseBrand}},[t.choosedBrand?i("span",{staticClass:"title"},[t._v("品牌：")]):t._e(),t._v(" "+t._s(t.choosedBrand.brand_name)+" ")]):t._e(),t._l(t.attributeList,(function(e){return i("span",{key:e.attr_id},[e.selectedValue?i("el-tag",{attrs:{type:"info",closable:"",effect:"plain"},on:{close:function(i){return t.colseAttr(e)}}},[e.attr_name?i("span",{staticClass:"title"},[t._v(t._s(e.attr_name)+"：")]):t._e(),t._v(" "+t._s(e.selectedValue)+" ")]):t._e()],1)}))],2):t._e(),[t.brandList.length||t.attributeList.length?i("div",{staticClass:"category"},[i("div",{staticClass:"brand"},[i("div",{staticClass:"table_head"},[t._v("品牌：")]),i("div",{staticClass:"table_body"},[i("div",{staticClass:"initial"},[i("span",{attrs:{type:"info",effect:"plain",hit:""},on:{mouseover:function(e){return t.handleChangeInitial("")}}},[t._v("所有品牌")]),t._l(t.brandInitialList,(function(e){return i("span",{key:e,attrs:{type:"info",effect:"plain",hit:""},on:{mouseover:function(i){return t.handleChangeInitial(e)}}},[t._v(t._s((e||"").toUpperCase()))])}))],2),i("div",{staticClass:"content"},t._l(t.brandList,(function(e){return i("el-card",{directives:[{name:"show",rawName:"v-show",value:""===t.currentInitial||e.brand_initial===t.currentInitial,expression:"currentInitial === '' || item.brand_initial === currentInitial"}],key:e.id,staticClass:"brand-item",attrs:{"body-style":"padding: 0;height: 100%;",shadow:"hover"}},[i("el-image",{attrs:{src:t.$img(e.image_url||t.defaultGoodsImage),alt:e.brand_name,title:e.brand_name,fit:"contain"},on:{click:function(i){return t.onChooseBrand(e)}}})],1)})),1)])]),t._l(t.attributeList,(function(e){return i("div",{key:"attr"+e.attr_id,staticClass:"brand"},[i("div",{staticClass:"table_head"},[t._v(t._s(e.attr_name)+"：")]),i("div",{staticClass:"table_body"},[i("div",{staticClass:"content"},t._l(e.child,(function(r){return i("span",{key:r.attr_value_id},[e.isMuiltSelect?i("el-checkbox",{attrs:{label:r.attr_value_name,checked:r.selected},on:{change:function(i){return t.setAttrSelectedMuilt(e,r)}}}):i("el-link",{attrs:{underline:!1},on:{click:function(i){return t.setAttrSelected(e,r)}}},[t._v(t._s(r.attr_value_name))])],1)})),0)]),i("div",{staticClass:"table_op"},[i("el-button",{attrs:{size:"small",icon:"el-icon-circle-plus-outline"},on:{click:function(i){return t.setMuiltChoose(e)}}},[t._v("多选")])],1)])}))],2):t._e()],i("div",{staticClass:"list-wrap"},[t.cargoList.length?i("div",{staticClass:"goods-recommended"},[i("goods-recommend",{attrs:{"page-size":t.cargoList.length<5?2:5}})],1):t._e(),i("div",{staticClass:"list-right"},[i("div",[i("div",{staticClass:"sort"},[i("div",{staticClass:"item",on:{click:function(e){return t.changeSort("")}}},[i("div",{staticClass:"item-name"},[t._v("综合")])]),i("div",{staticClass:"item",on:{click:function(e){return t.changeSort("sale_num")}}},[i("div",{staticClass:"item-name"},[t._v("销量")]),"sale_num"===t.filters.order&&"desc"===t.filters.sort?i("i",{staticClass:"el-icon-arrow-down el-icon--down"}):i("i",{staticClass:"el-icon-arrow-up el-icon--up"})]),i("div",{staticClass:"item",on:{click:function(e){return t.changeSort("discount_price")}}},[i("div",{staticClass:"item-name"},[t._v("价格")]),"discount_price"===t.filters.order&&"desc"===t.filters.sort?i("i",{staticClass:"el-icon-arrow-down el-icon--down"}):i("i",{staticClass:"el-icon-arrow-up el-icon--up"})]),i("div",{staticClass:"item-other"},[i("el-checkbox",{attrs:{label:"包邮"},model:{value:t.is_free_shipping,callback:function(e){t.is_free_shipping=e},expression:"is_free_shipping"}})],1),i("div",{staticClass:"item-other"},[i("el-checkbox",{attrs:{label:"自营"},model:{value:t.is_own,callback:function(e){t.is_own=e},expression:"is_own"}})],1),i("div",{staticClass:"input-wrap"},[i("div",{staticClass:"price_range"},[i("el-input",{attrs:{placeholder:"最低价格",size:"small"},model:{value:t.filters.min_price,callback:function(e){t.$set(t.filters,"min_price",e)},expression:"filters.min_price"}}),i("span",[t._v("—")]),i("el-input",{attrs:{placeholder:"最高价格",size:"small"},model:{value:t.filters.max_price,callback:function(e){t.$set(t.filters,"max_price",e)},expression:"filters.max_price"}})],1),i("el-button",{attrs:{plain:"",size:"mini"},on:{click:t.handlePriceRange}},[t._v("确定")])],1)])]),t.cargoList.length?i("div",{staticClass:"cargo-list"},[i("div",{staticClass:"goods-info"},t._l(t.cargoList,(function(e,r){return i("div",{key:e.goods_id,staticClass:"item",on:{click:function(i){return t.$router.pushToTab({path:"/sku-"+e.sku_id})}}},[i("img",{staticClass:"img-wrap",attrs:{src:t.$img(e.sku_image,{size:"mid"})},on:{error:function(e){return t.imageError(r)}}}),i("div",{staticClass:"price-wrap"},[i("div",{staticClass:"price"},[i("p",[t._v("￥")]),t._v(" "+t._s(e.discount_price)+" ")]),i("div",{staticClass:"market-price"},[t._v("￥"+t._s(e.market_price))])]),i("div",{staticClass:"goods-name"},[t._v(t._s(e.goods_name))]),i("div",{staticClass:"sale-num"},[i("p",[t._v(t._s(e.sale_num||0))]),t._v("人付款 ")]),i("div",{staticClass:"shop_name"},[t._v(t._s(e.site_name))]),i("div",{staticClass:"saling"},[1==e.is_free_shipping?i("div",{staticClass:"free-shipping"},[t._v("包邮")]):t._e(),1==e.is_own?i("div",{staticClass:"is_own"},[t._v("自营")]):t._e(),1==e.promotion_type?i("div",{staticClass:"promotion-type"},[t._v("限时折扣")]):t._e()])])})),0),i("div",{staticClass:"pager"},[i("el-pagination",{attrs:{background:"","pager-count":5,total:t.total,"prev-text":"上一页","next-text":"下一页","current-page":t.currentPage,"page-size":t.pageSize,"hide-on-single-page":""},on:{"update:currentPage":function(e){t.currentPage=e},"update:current-page":function(e){t.currentPage=e},"update:pageSize":function(e){t.pageSize=e},"update:page-size":function(e){t.pageSize=e},"size-change":t.handlePageSizeChange,"current-change":t.handleCurrentPageChange}})],1)]):i("div",{staticClass:"empty"},[i("div",{staticClass:"ns-text-align"},[t._v("没有找到您想要的商品。换个条件试试吧")])])])])],2)},n=[],a=i("f423"),s=i("a63f"),o=(i("4160"),i("c975"),i("a434"),i("d3b7"),i("ac1f"),i("25f0"),i("1276"),i("159b"),i("96cf"),i("1da1")),c=i("5530"),l=i("a2a9"),u=i("2f62"),d=i("8894"),f=i("2f84"),h={data:function(){return{cargoList:[],shopList:[],brandList:[],attributeList:[],brandInitialList:[],currentInitial:"",choosedBrand:"",hasChoosedAttrs:!1,total:0,keyword:"",catewords:"",currentPage:1,pageSize:12,is_free_shipping:0,is_own:"",filters:{site_id:0,category_id:0,category_level:0,brand_id:0,min_price:"",max_price:"",order:"",sort:"desc",platform_coupon_type:0},loading:!0,whetherCollection:0}},created:function(){this.keyword=this.$route.query.keyword||"",this.filters.category_id=this.$route.query.category_id||"",this.filters.category_level=this.$route.query.level||"",this.filters.brand_id=this.$route.query.brand_id||"",this.filters.platform_coupon_type=this.$route.query.platform_coupon_type||0,this.getGoodsList(),this.filters.category_id&&(this.getRelevanceinfo(),this.categorySearch())},computed:Object(c["a"])({},Object(u["b"])(["defaultGoodsImage"])),methods:{categorySearch:function(){var t=this;Object(d["a"])({category_id:this.filters.category_id}).then((function(e){0==e.code&&e.data&&(t.catewords=e.data.category_full_name)})).catch((function(t){}))},addToCart:function(t){var e=this;this.$store.dispatch("cart/add_to_cart",t).then((function(t){var i=t.data;i>0&&e.$message({message:"加入购物车成功",type:"success"})})).catch((function(t){return t}))},isCollect:function(t){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function i(){return regeneratorRuntime.wrap((function(i){while(1)switch(i.prev=i.next){case 0:return i.next=2,Object(f["c"])({goods_id:t.goods_id}).then((function(i){e.whetherCollection=i.data,0==e.whetherCollection?t.isCollection=!1:t.isCollection=!0})).catch((function(t){return t}));case 2:case"end":return i.stop()}}),i)})))()},editCollection:function(t){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function i(){var r,n,a,s,o,c;return regeneratorRuntime.wrap((function(i){while(1)switch(i.prev=i.next){case 0:return i.next=2,e.isCollect(t);case 2:if(r=t.goods_id,n=t.sku_id,a=t.site_id,s=t.sku_name,o=t.sku_price,c=t.sku_image,0!=e.whetherCollection){i.next=8;break}return i.next=6,Object(f["a"])({goods_id:r,sku_id:n,site_id:a,sku_name:s,sku_price:o,sku_image:c}).then((function(i){e.$message({message:"收藏成功",type:"success"}),t.isCollection=!0})).catch((function(t){return t}));case 6:i.next=10;break;case 8:return i.next=10,Object(f["b"])({goods_id:r}).then((function(i){i.data>0&&(e.$message({message:"取消收藏成功",type:"success"}),t.isCollection=!1)})).catch((function(t){return t}));case 10:case"end":return i.stop()}}),i)})))()},getGoodsList:function(){var t=this,e=[];this.attributeList&&this.attributeList.forEach((function(t){t.child&&t.child.forEach((function(i){i.selected&&e.push({attr_id:t.attr_id,attr_value_id:i.attr_value_id})}))}));var i=Object(c["a"])({page:this.currentPage,page_size:this.pageSize,site_id:this.filters.siteId,keyword:this.keyword,attr:e.length>0?JSON.stringify(e):""},this.filters);Object(l["h"])(i||{}).then((function(e){var i=e.data,r=i.count,n=(i.page_count,i.list);t.total=r,t.cargoList=n,t.loading=!1})).catch((function(e){t.loading=!1}))},getRelevanceinfo:function(){var t=this,e={category_id:this.filters.category_id,category_level:this.filters.category_level};Object(d["b"])(e).then((function(e){var i=e.data,r=i.brand_list,n=i.attribute_list,a=i.brand_initial_list;t.brandList=r,t.attributeList=n,t.brandInitialList=a})).catch((function(t){return t}))},onChooseBrand:function(t){this.choosedBrand=t,this.filters.brand_id=t.id,this.getGoodsList()},setMuiltChoose:function(t){this.$set(t,"isMuiltSelect",!t.isMuiltSelect),this.getGoodsList()},setAttrSelected:function(t,e){var i=this;t.child&&t.child.forEach((function(t){i.$set(t,"selected",!1)})),this.$set(e,"selected",!0),this.$set(t,"selectedValue",e.attr_value_name),this.getGoodsList()},setAttrSelectedMuilt:function(t,e){this.$set(e,"selected",!e.selected);var i=[];if(e.selected){var r=t.selectedValue||"";i=r.split(","),""==i[0]&&i.pop(0),-1==i.indexOf(e.attr_value_name)&&i.push(e.attr_value_name)}else{var n=t.selectedValue||"";i=n.split(","),""==i[0]&&i.pop(0),-1!==i.indexOf(e.attr_value_name)&&i.splice(i.indexOf(e.attr_value_name),1)}this.$set(t,"selectedValue",i.toString()),this.getGoodsList()},colseBrand:function(){this.choosedBrand="",this.filters.brand_id="",this.getGoodsList()},colseAttr:function(t){t.selectedValue="",t.child.forEach((function(t){t.selected=!1})),t.isMuiltSelect=!1,this.getGoodsList()},handlePageSizeChange:function(t){this.pageSize=t,this.getGoodsList()},handleCurrentPageChange:function(t){this.currentPage=t,this.getGoodsList()},handlePriceRange:function(){this.getGoodsList()},handleChangeInitial:function(t){this.currentInitial=t},changeSort:function(t){this.filters.order===t?this.$set(this.filters,"sort","desc"===this.filters.sort?"asc":"desc"):(this.$set(this.filters,"order",t),this.$set(this.filters,"sort","desc")),this.getGoodsList()}},watch:{is_free_shipping:function(t){this.filters.is_free_shipping=t?1:"",this.getGoodsList()},is_own:function(t){this.filters.is_own=t?1:"",this.getGoodsList()},$route:function(t){void 0==t.query.category_id&&(this.catewords="",this.currentPage=1,this.keyword=t.query.keyword,this.filters.category_id=t.query.category_id||"",this.filters.category_level=t.query.level||"",this.filters.brand_id=t.query.brand_id||"",this.getGoodsList())}}},p={name:"list",components:{BreadCrumbs:a["a"],GoodsRecommend:s["a"]},data:function(){return{}},mixins:[h],created:function(){},methods:{}},g=p,v=(i("74d6"),i("2877")),_=Object(v["a"])(g,r,n,!1,null,"719d76c4",null);e["default"]=_.exports},"74d6":function(t,e,i){"use strict";var r=i("fe33"),n=i.n(r);n.a},"81b4":function(t,e,i){"use strict";var r=i("1008"),n=i.n(r);n.a},"96cf":function(t,e){!function(e){"use strict";var i,r=Object.prototype,n=r.hasOwnProperty,a="function"===typeof Symbol?Symbol:{},s=a.iterator||"@@iterator",o=a.asyncIterator||"@@asyncIterator",c=a.toStringTag||"@@toStringTag",l="object"===typeof t,u=e.regeneratorRuntime;if(u)l&&(t.exports=u);else{u=e.regeneratorRuntime=l?t.exports:{},u.wrap=b;var d="suspendedStart",f="suspendedYield",h="executing",p="completed",g={},v={};v[s]=function(){return this};var _=Object.getPrototypeOf,m=_&&_(_($([])));m&&m!==r&&n.call(m,s)&&(v=m);var y=E.prototype=C.prototype=Object.create(v);x.prototype=y.constructor=E,E.constructor=x,E[c]=x.displayName="GeneratorFunction",u.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===x||"GeneratorFunction"===(e.displayName||e.name))},u.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,E):(t.__proto__=E,c in t||(t[c]="GeneratorFunction")),t.prototype=Object.create(y),t},u.awrap=function(t){return{__await:t}},L(k.prototype),k.prototype[o]=function(){return this},u.AsyncIterator=k,u.async=function(t,e,i,r){var n=new k(b(t,e,i,r));return u.isGeneratorFunction(e)?n:n.next().then((function(t){return t.done?t.value:n.next()}))},L(y),y[c]="Generator",y[s]=function(){return this},y.toString=function(){return"[object Generator]"},u.keys=function(t){var e=[];for(var i in t)e.push(i);return e.reverse(),function i(){while(e.length){var r=e.pop();if(r in t)return i.value=r,i.done=!1,i}return i.done=!0,i}},u.values=$,A.prototype={constructor:A,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=i,this.done=!1,this.delegate=null,this.method="next",this.arg=i,this.tryEntries.forEach(N),!t)for(var e in this)"t"===e.charAt(0)&&n.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=i)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function r(r,n){return o.type="throw",o.arg=t,e.next=r,n&&(e.method="next",e.arg=i),!!n}for(var a=this.tryEntries.length-1;a>=0;--a){var s=this.tryEntries[a],o=s.completion;if("root"===s.tryLoc)return r("end");if(s.tryLoc<=this.prev){var c=n.call(s,"catchLoc"),l=n.call(s,"finallyLoc");if(c&&l){if(this.prev<s.catchLoc)return r(s.catchLoc,!0);if(this.prev<s.finallyLoc)return r(s.finallyLoc)}else if(c){if(this.prev<s.catchLoc)return r(s.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<s.finallyLoc)return r(s.finallyLoc)}}}},abrupt:function(t,e){for(var i=this.tryEntries.length-1;i>=0;--i){var r=this.tryEntries[i];if(r.tryLoc<=this.prev&&n.call(r,"finallyLoc")&&this.prev<r.finallyLoc){var a=r;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var s=a?a.completion:{};return s.type=t,s.arg=e,a?(this.method="next",this.next=a.finallyLoc,g):this.complete(s)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),g},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var i=this.tryEntries[e];if(i.finallyLoc===t)return this.complete(i.completion,i.afterLoc),N(i),g}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var i=this.tryEntries[e];if(i.tryLoc===t){var r=i.completion;if("throw"===r.type){var n=r.arg;N(i)}return n}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:$(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=i),g}}}function b(t,e,i,r){var n=e&&e.prototype instanceof C?e:C,a=Object.create(n.prototype),s=new A(r||[]);return a._invoke=I(t,i,s),a}function w(t,e,i){try{return{type:"normal",arg:t.call(e,i)}}catch(r){return{type:"throw",arg:r}}}function C(){}function x(){}function E(){}function L(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function k(t){function e(i,r,a,s){var o=w(t[i],t,r);if("throw"!==o.type){var c=o.arg,l=c.value;return l&&"object"===typeof l&&n.call(l,"__await")?Promise.resolve(l.__await).then((function(t){e("next",t,a,s)}),(function(t){e("throw",t,a,s)})):Promise.resolve(l).then((function(t){c.value=t,a(c)}),s)}s(o.arg)}var i;function r(t,r){function n(){return new Promise((function(i,n){e(t,r,i,n)}))}return i=i?i.then(n,n):n()}this._invoke=r}function I(t,e,i){var r=d;return function(n,a){if(r===h)throw new Error("Generator is already running");if(r===p){if("throw"===n)throw a;return P()}i.method=n,i.arg=a;while(1){var s=i.delegate;if(s){var o=O(s,i);if(o){if(o===g)continue;return o}}if("next"===i.method)i.sent=i._sent=i.arg;else if("throw"===i.method){if(r===d)throw r=p,i.arg;i.dispatchException(i.arg)}else"return"===i.method&&i.abrupt("return",i.arg);r=h;var c=w(t,e,i);if("normal"===c.type){if(r=i.done?p:f,c.arg===g)continue;return{value:c.arg,done:i.done}}"throw"===c.type&&(r=p,i.method="throw",i.arg=c.arg)}}}function O(t,e){var r=t.iterator[e.method];if(r===i){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=i,O(t,e),"throw"===e.method))return g;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return g}var n=w(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,g;var a=n.arg;return a?a.done?(e[t.resultName]=a.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=i),e.delegate=null,g):a:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,g)}function S(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function N(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function A(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(S,this),this.reset(!0)}function $(t){if(t){var e=t[s];if(e)return e.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var r=-1,a=function e(){while(++r<t.length)if(n.call(t,r))return e.value=t[r],e.done=!1,e;return e.value=i,e.done=!0,e};return a.next=a}}return{next:P}}function P(){return{value:i,done:!0}}}(function(){return this}()||Function("return this")())},a63f:function(t,e,i){"use strict";var r=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticClass:"goods-recommend"},[i("h4",[t._v("商品精选")]),t.list.length?i("ul",t._l(t.list,(function(e,r){return i("li",{key:r,on:{click:function(i){return t.$router.pushToTab({path:"/sku-"+e.sku_id})}}},[i("div",{staticClass:"img-wrap"},[i("img",{attrs:{src:t.$img(e["sku_image"],{size:"mid"})},on:{error:function(e){return t.imageError(r)}}})]),i("div",{staticClass:"price"},[t._v("￥"+t._s(e.discount_price))]),i("p",{staticClass:"sku-name"},[t._v(t._s(e.goods_name))]),i("div",{staticClass:"info-wrap"})])})),0):t._e()])},n=[],a=(i("a9e3"),i("5530")),s=i("2f62"),o=i("a2a9"),c={name:"goods_recommend",props:{page:{type:[Number,String],default:1},pageSize:{type:[Number,String],default:5}},data:function(){return{loading:!0,list:[]}},created:function(){this.getGoodsRecommend()},computed:Object(a["a"])({},Object(s["b"])(["defaultGoodsImage"])),methods:{getGoodsRecommend:function(){var t=this;Object(o["e"])({page:this.page,page_size:this.pageSize}).then((function(e){0==e.code&&(t.list=e.data.list),t.loading=!1})).catch((function(e){t.loading=!1}))},imageError:function(t){this.list[t].sku_image=this.defaultGoodsImage}}},l=c,u=(i("81b4"),i("2877")),d=Object(u["a"])(l,r,n,!1,null,"5d577949",null);e["a"]=d.exports},a9e3:function(t,e,i){"use strict";var r=i("83ab"),n=i("da84"),a=i("94ca"),s=i("6eeb"),o=i("5135"),c=i("c6b6"),l=i("7156"),u=i("c04e"),d=i("d039"),f=i("7c73"),h=i("241c").f,p=i("06cf").f,g=i("9bf2").f,v=i("58a8").trim,_="Number",m=n[_],y=m.prototype,b=c(f(y))==_,w=function(t){var e,i,r,n,a,s,o,c,l=u(t,!1);if("string"==typeof l&&l.length>2)if(l=v(l),e=l.charCodeAt(0),43===e||45===e){if(i=l.charCodeAt(2),88===i||120===i)return NaN}else if(48===e){switch(l.charCodeAt(1)){case 66:case 98:r=2,n=49;break;case 79:case 111:r=8,n=55;break;default:return+l}for(a=l.slice(2),s=a.length,o=0;o<s;o++)if(c=a.charCodeAt(o),c<48||c>n)return NaN;return parseInt(a,r)}return+l};if(a(_,!m(" 0o1")||!m("0b1")||m("+0x1"))){for(var C,x=function(t){var e=arguments.length<1?0:t,i=this;return i instanceof x&&(b?d((function(){y.valueOf.call(i)})):c(i)!=_)?l(new m(w(e)),i,x):w(e)},E=r?h(m):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger".split(","),L=0;E.length>L;L++)o(m,C=E[L])&&!o(x,C)&&g(x,C,p(m,C));x.prototype=y,y.constructor=x,s(n,_,x)}},df8f:function(t,e,i){"use strict";var r=i("068f"),n=i.n(r);n.a},f423:function(t,e,i){"use strict";var r=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("el-breadcrumb",{staticClass:"app-breadcrumb",attrs:{separator:"/"}},[i("transition-group",{attrs:{name:"breadcrumb"}},[t._l(t.levelList,(function(e,r){return i("el-breadcrumb-item",{key:e.path},[0==r?i("span",[i("i",{staticClass:"el-icon-s-home"})]):t._e(),"noRedirect"===e.redirect||r==t.levelList.length-1?i("span",{staticClass:"no-redirect"},[t._v(t._s(e.meta.title))]):i("a",{on:{click:function(i){return i.preventDefault(),t.handleLink(e)}}},[t._v(t._s(e.meta.title))])])})),t.hasExtItem?i("el-breadcrumb-item",{key:"ext_item"},[t._t("ext_item")],2):t._e()],2)],1)},n=[];i("99af"),i("4de4"),i("b0c0"),i("498a");function a(t){var e=[],i=0;while(i<t.length){var r=t[i];if("*"!==r&&"+"!==r&&"?"!==r)if("\\"!==r)if("{"!==r)if("}"!==r)if(":"!==r)if("("!==r)e.push({type:"CHAR",index:i,value:t[i++]});else{var n=1,a="";o=i+1;if("?"===t[o])throw new TypeError('Pattern cannot start with "?" at '+o);while(o<t.length)if("\\"!==t[o]){if(")"===t[o]){if(n--,0===n){o++;break}}else if("("===t[o]&&(n++,"?"!==t[o+1]))throw new TypeError("Capturing groups are not allowed at "+o);a+=t[o++]}else a+=t[o++]+t[o++];if(n)throw new TypeError("Unbalanced pattern at "+i);if(!a)throw new TypeError("Missing pattern at "+i);e.push({type:"PATTERN",index:i,value:a}),i=o}else{var s="",o=i+1;while(o<t.length){var c=t.charCodeAt(o);if(!(c>=48&&c<=57||c>=65&&c<=90||c>=97&&c<=122||95===c))break;s+=t[o++]}if(!s)throw new TypeError("Missing parameter name at "+i);e.push({type:"NAME",index:i,value:s}),i=o}else e.push({type:"CLOSE",index:i,value:t[i++]});else e.push({type:"OPEN",index:i,value:t[i++]});else e.push({type:"ESCAPED_CHAR",index:i++,value:t[i++]});else e.push({type:"MODIFIER",index:i,value:t[i++]})}return e.push({type:"END",index:i,value:""}),e}function s(t,e){void 0===e&&(e={});var i=a(t),r=e.prefixes,n=void 0===r?"./":r,s="[^"+l(e.delimiter||"/#?")+"]+?",o=[],c=0,u=0,d="",f=function(t){if(u<i.length&&i[u].type===t)return i[u++].value},h=function(t){var e=f(t);if(void 0!==e)return e;var r=i[u],n=r.type,a=r.index;throw new TypeError("Unexpected "+n+" at "+a+", expected "+t)},p=function(){var t,e="";while(t=f("CHAR")||f("ESCAPED_CHAR"))e+=t;return e};while(u<i.length){var g=f("CHAR"),v=f("NAME"),_=f("PATTERN");if(v||_){var m=g||"";-1===n.indexOf(m)&&(d+=m,m=""),d&&(o.push(d),d=""),o.push({name:v||c++,prefix:m,suffix:"",pattern:_||s,modifier:f("MODIFIER")||""})}else{var y=g||f("ESCAPED_CHAR");if(y)d+=y;else{d&&(o.push(d),d="");var b=f("OPEN");if(b){m=p();var w=f("NAME")||"",C=f("PATTERN")||"",x=p();h("CLOSE"),o.push({name:w||(C?c++:""),pattern:w&&!C?s:C,prefix:m,suffix:x,modifier:f("MODIFIER")||""})}else h("END")}}}return o}function o(t,e){return c(s(t,e),e)}function c(t,e){void 0===e&&(e={});var i=u(e),r=e.encode,n=void 0===r?function(t){return t}:r,a=e.validate,s=void 0===a||a,o=t.map((function(t){if("object"===typeof t)return new RegExp("^(?:"+t.pattern+")$",i)}));return function(e){for(var i="",r=0;r<t.length;r++){var a=t[r];if("string"!==typeof a){var c=e?e[a.name]:void 0,l="?"===a.modifier||"*"===a.modifier,u="*"===a.modifier||"+"===a.modifier;if(Array.isArray(c)){if(!u)throw new TypeError('Expected "'+a.name+'" to not repeat, but got an array');if(0===c.length){if(l)continue;throw new TypeError('Expected "'+a.name+'" to not be empty')}for(var d=0;d<c.length;d++){var f=n(c[d],a);if(s&&!o[r].test(f))throw new TypeError('Expected all "'+a.name+'" to match "'+a.pattern+'", but got "'+f+'"');i+=a.prefix+f+a.suffix}}else if("string"!==typeof c&&"number"!==typeof c){if(!l){var h=u?"an array":"a string";throw new TypeError('Expected "'+a.name+'" to be '+h)}}else{f=n(String(c),a);if(s&&!o[r].test(f))throw new TypeError('Expected "'+a.name+'" to match "'+a.pattern+'", but got "'+f+'"');i+=a.prefix+f+a.suffix}}else i+=a}return i}}function l(t){return t.replace(/([.+*?=^!:${}()[\]|/\\])/g,"\\$1")}function u(t){return t&&t.sensitive?"":"i"}var d={props:{hasExtItem:!1},data:function(){return{levelList:null}},watch:{$route:function(){this.getBreadcrumb()}},created:function(){this.getBreadcrumb()},methods:{getBreadcrumb:function(){var t=this.$route.matched.filter((function(t){return t.meta&&t.meta.title})),e=t[0];this.isHome(e)||(t=[{path:"/index",meta:{title:"首页"}}].concat(t)),this.levelList=t.filter((function(t){return t.meta&&t.meta.title&&!1!==t.meta.breadcrumb}))},isHome:function(t){var e=t&&t.name;return!!e&&e.trim().toLocaleLowerCase()==="index".toLocaleLowerCase()},pathCompile:function(t){var e=this.$route.params,i=o(t);return i(e)},handleLink:function(t){var e=t.redirect,i=t.path;e?this.$router.push(e):this.$router.push(this.pathCompile(i))}}},f=d,h=(i("df8f"),i("2877")),p=Object(h["a"])(f,r,n,!1,null,"692967a6",null);e["a"]=p.exports},fe33:function(t,e,i){}}]);
//# sourceMappingURL=chunk-646143fa.9c1c3dd0.js.map