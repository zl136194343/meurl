(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["otherpages-verification-list-list"],{"27a9":function(t,i,e){"use strict";e.r(i);var a=e("32db"),n=e("8312");for(var s in n)"default"!==s&&function(t){e.d(i,t,(function(){return n[t]}))}(s);e("595d");var o,r=e("f0c5"),f=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"472ff7e2",null,!1,a["a"],o);i["default"]=f.exports},"32db":function(t,i,e){"use strict";e.d(i,"b",(function(){return n})),e.d(i,"c",(function(){return s})),e.d(i,"a",(function(){return a}));var a={nsEmpty:e("77de").default,loadingCover:e("1d00").default},n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",{staticClass:"verify-container",attrs:{"data-theme":t.themeStyle}},[e("v-uni-view",{staticClass:"type-wrap"},t._l(t.typeList,(function(i,a){return e("v-uni-view",{key:a,staticClass:"uni-tab-item",attrs:{id:i.pickup,"data-current":a},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.ontabtap.apply(void 0,arguments)}}},[e("v-uni-text",{staticClass:"uni-tab-item-title",class:t.type==a?"uni-tab-item-title-active color-base-text color-base-border":""},[t._v(t._s(i.name))])],1)})),1),e("v-uni-swiper",{staticClass:"swiper-box",staticStyle:{flex:"1"},attrs:{current:t.type,duration:200},on:{change:function(i){arguments[0]=i=t.$handleEvent(i),t.ontabchange.apply(void 0,arguments)}}},t._l(t.typeList,(function(i,a){return e("v-uni-swiper-item",{key:a,staticClass:"swiper-item"},[void 0!=t.verifyList[a]&&t.verifyList[a].list.length>0?[e("v-uni-scroll-view",{staticClass:"verify-list",attrs:{"scroll-y":"true"},on:{scrolltolower:function(i){arguments[0]=i=t.$handleEvent(i),t.scrolltolower.apply(void 0,arguments)}}},t._l(t.verifyList[a].list,(function(i,n){return e("v-uni-view",{key:n,staticClass:"item"},[e("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toDetail(i.verify_code)}}},[e("v-uni-view",{staticClass:"header"},[e("v-uni-view",{staticClass:"color-tip font-size-goods-tag"},[t._v("核销码："+t._s(i.verify_code))]),e("v-uni-view",{staticClass:"color-tip align-right font-size-goods-tag"},[t._v("核销员："+t._s(i.verifier_name))])],1),e("v-uni-view",{staticClass:"xian"}),e("v-uni-view",{staticClass:"body"},t._l(i.item_array,(function(s,o){return e("v-uni-view",{key:o,staticClass:"content-item"},[e("v-uni-view",{staticClass:"img-wrap"},[e("v-uni-image",{attrs:{src:t.$util.img(s.img),mode:"aspectFill"},on:{error:function(i){arguments[0]=i=t.$handleEvent(i),t.imgError(a,n,o)}}})],1),e("v-uni-view",{staticClass:"info-wrap"},[e("v-uni-view",{staticClass:"name-wrap"},[e("v-uni-view",{staticClass:"goods-name font-size-tag"},[t._v(t._s(s.name))]),e("v-uni-view",{staticClass:"font-size-goods-tag color-tip"},[t._v("核销时间："+t._s(t.$util.timeStampTurnTime(i.verify_time)))])],1),e("v-uni-view",{staticClass:"money-wrap"},[e("v-uni-view",{staticClass:"align-right color-tip font-size-goods-tag"},[e("v-uni-text",{staticClass:"iconfont iconclose font-size-goods-tag"}),t._v(t._s(s.num))],1)],1)],1),e("v-uni-view",{staticClass:"money-wrap"},[e("v-uni-view",[e("v-uni-text",{staticClass:"color-base-text font-size-goods-tag"},[t._v(t._s(t.$lang("common.currencySymbol")))]),e("v-uni-text",{staticClass:"font-size-base color-base-text"},[t._v(t._s(t._f("abs")(s.price)))])],1)],1)],1)})),1)],1)],1)})),1)]:[e("ns-empty",{attrs:{isIndex:!1,text:"暂无核销记录!"}})]],2)})),1),e("loading-cover",{ref:"loadingCover"})],1)},s=[]},"33fd":function(t,i,e){var a=e("3adb");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("40d3c8e4",a,!0,{sourceMap:!1,shadowMode:!1})},"3adb":function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n * 建议使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n */.verify-container[data-v-472ff7e2]{width:100vw;height:100vh}.align-right[data-v-472ff7e2]{text-align:right}.type-wrap[data-v-472ff7e2]{display:-webkit-box;display:-webkit-flex;display:flex;background-color:#fff;height:%?90?%}.type-wrap > uni-view[data-v-472ff7e2]{-webkit-box-flex:1;-webkit-flex:1;flex:1;text-align:center}.type-wrap > uni-view uni-text[data-v-472ff7e2]{line-height:%?86?%;border-bottom:%?4?% solid #fff;display:inline-block;font-size:%?30?%}.swiper-box[data-v-472ff7e2]{width:100%;height:calc(100vh - %?100?%)}.swiper-box .swiper-item[data-v-472ff7e2]{width:100%;height:100%}.swiper-box .swiper-item .verify-list[data-v-472ff7e2]{width:100%;height:100%}.verify-list .item[data-v-472ff7e2]{margin:%?24?%;-webkit-border-radius:%?10?%;border-radius:%?10?%;background:#fff;position:relative;padding:%?30?%}.verify-list .item .header[data-v-472ff7e2]{display:-webkit-box;display:-webkit-flex;display:flex;padding-bottom:%?30?%}.verify-list .item .header uni-view[data-v-472ff7e2]{line-height:1;-webkit-box-flex:1;-webkit-flex:1;flex:1;max-width:50%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.verify-list .item .xian[data-v-472ff7e2]{width:100%;border:.5px solid #eee}.verify-list .item .body .content-item[data-v-472ff7e2]{display:-webkit-box;display:-webkit-flex;display:flex;padding-top:%?24?%}.verify-list .item .body .content-item .img-wrap[data-v-472ff7e2]{width:%?120?%;height:%?120?%;-webkit-border-radius:%?10?%;border-radius:%?10?%;overflow:hidden}.verify-list .item .body .content-item .img-wrap uni-image[data-v-472ff7e2]{width:100%;height:100%}.verify-list .item .body .content-item .info-wrap[data-v-472ff7e2]{-webkit-box-flex:1;-webkit-flex:1;flex:1;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;width:100%;padding-right:%?23?%}.verify-list .item .body .content-item .info-wrap .name-wrap[data-v-472ff7e2]{-webkit-box-flex:1;-webkit-flex:1;flex:1;padding-left:%?23?%}.verify-list .item .body .content-item .info-wrap .name-wrap .goods-name[data-v-472ff7e2]{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;line-height:1.5;color:#000;font-size:%?28?%}.verify-list .item .body .content-item .info-wrap .money-wrap[data-v-472ff7e2]{margin-top:%?20?%;padding:0 %?23?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;width:100%;-webkit-box-align:center;-webkit-align-items:center;align-items:center}.verify-list .item .body .content-item .info-wrap .money-wrap > uni-view[data-v-472ff7e2]{line-height:1}.verify-list .item .body .content-item .info-wrap .money-wrap .unit[data-v-472ff7e2]{font-weight:400;font-size:%?24?%;margin-right:%?2?%}.verify-list .item .body .content-item .info-wrap .money-wrap .iconfont[data-v-472ff7e2]{line-height:1}.verify-list .item .body .content-item .money-wrap[data-v-472ff7e2]{font-weight:700}',""]),t.exports=i},"4ebb":function(t,i,e){"use strict";var a=e("4ea4");e("4160"),e("b680"),e("b64b"),e("acd8"),e("159b"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var n=a(e("7382")),s={data:function(){return{scrollInto:"",type:0,typeList:[],verifyList:[],isShow:!1}},mixins:[n.default],onShow:function(){this.$langConfig.refresh(),this.getVerifyType()},methods:{toDetail:function(t){this.$util.redirectTo("/otherpages/verification/detail/detail",{code:t})},ontabtap:function(t){var i=t.target.dataset.current||t.currentTarget.dataset.current;this.switchTab(i),this.isShow=!1},switchTab:function(t){this.type!==t&&(this.type=t,this.scrollInto=this.typeList[t].type)},ontabchange:function(t){var i=t.target.current||t.detail.current;this.switchTab(i)},getVerifyType:function(){var t=this;this.$api.sendRequest({url:"/api/verify/getVerifyType",success:function(i){i.code>=0&&(t.typeList=[],t.verifyList=[],Object.keys(i.data).forEach((function(e){t.typeList.push({type:e,name:i.data[e].name}),t.verifyList.push({page:1,totalPage:1,list:[],isLoading:!1}),t.getVerifyList(e,1,t.typeList.length-1)}))),t.$refs.loadingCover&&t.$refs.loadingCover.hide()},fail:function(i){t.$refs.loadingCover&&t.$refs.loadingCover.hide()}})},getVerifyList:function(t,i,e){var a=this;this.verifyList[e].isLoading||1!=i&&i>this.verifyList[e].totalPage||(this.verifyList[e].isLoading=!0,this.verifyList[e].loadingType="loading",this.$api.sendRequest({url:"/api/verify/lists",data:{verify_type:t,page:i},success:function(t){a.verifyList[e].page=i,1==i&&(a.verifyList[e].list=[],uni.stopPullDownRefresh()),t.data.list.length&&t.data.list.forEach((function(t){a.verifyList[e].list.push(t)})),a.verifyList[e].totalPage=t.data.page_count,a.verifyList[e].isLoading=!1,a.verifyList[e].loadingType=i==a.verifyList[e].totalPage?"nomore":"more",a.$refs.loadingCover&&a.$refs.loadingCover.hide(),a.isShow=!0}}))},scrolltolower:function(){var t=this.type;this.getVerifyList(this.typeList[t].type,this.verifyList[t].page+1,t)},onPullDownRefresh:function(){var t=this.type;this.getVerifyList(this.typeList[t].type,1,t)},imgError:function(t,i,e){this.verifyList[t].list[i].item_array[e].img=this.$util.getDefaultImage().default_goods_img,this.$forceUpdate()}},filters:{abs:function(t){return Math.abs(parseFloat(t)).toFixed(2)}}};i.default=s},"595d":function(t,i,e){"use strict";var a=e("33fd"),n=e.n(a);n.a},8312:function(t,i,e){"use strict";e.r(i);var a=e("4ebb"),n=e.n(a);for(var s in a)"default"!==s&&function(t){e.d(i,t,(function(){return a[t]}))}(s);i["default"]=n.a}}]);