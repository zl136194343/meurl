(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["otherpages-member-coupon-coupon"],{"217d":function(t,e,i){var o=i("b2d4");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var a=i("4f06").default;a("b756f34e",o,!0,{sourceMap:!1,shadowMode:!1})},"3abd":function(t,e,i){"use strict";var o=i("217d"),a=i.n(o);a.a},9759:function(t,e,i){"use strict";var o=i("4ea4");i("99af"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=o(i("7382")),n={data:function(){return{couponType:1,type:"",state:1,list:[],isIphoneX:!1,showEmpty:!1,emptyBtn:{text:"去领取",url:"/otherpages/goods/coupon/coupon"},text:"您还没有优惠券哦"}},mixins:[a.default],onLoad:function(t){this.isIphoneX=this.$util.uniappIsIPhoneX()},onShow:function(){var t=this;this.$langConfig.refresh(),this.$store.dispatch("getAddonIsexit").then((function(e){if(e.coupon){if(!uni.getStorageSync("token")){var i=getCurrentPages(),o=i[i.length-1].options,a=i[i.length-1].route;o.back=a,t.$util.redirectTo("/pages/login/login/login",o)}t.$refs.mescroll&&t.$refs.mescroll.refresh(!1)}else t.$util.showToast({title:"优惠券未开启",mask:!0}),setTimeout((function(){t.$util.redirectTo("/pages/member/index/index",{},"redirectTo")}),1e3)}))},methods:{changeType:function(t){this.list=[],this.couponType=t,this.$refs.mescroll.refresh(!1)},changeState:function(t){this.list=[],this.state=t,this.$refs.mescroll.refresh(!1),1==this.state?this.text="您还没有优惠券哦":2==this.state?this.text="您还没有使用过优惠券哦":this.text="您还没有过期优惠券哦"},getMemberCounponList:function(t){var e=this;this.showEmpty=!1;var i=1==this.couponType?"/coupon/api/coupon/memberpage":"/platformcoupon/api/platformcoupon/memberpage";this.$api.sendRequest({url:i,data:{page:t.num,page_size:t.size,state:this.state,is_own:this.type},success:function(i){e.showEmpty=!0;var o=[],a=i.message;0==i.code&&i.data?o=i.data.list:e.$util.showToast({title:a}),t.endSuccess(o.length),1==t.num&&(e.list=[]),e.list=e.list.concat(o),e.$refs.loadingCover&&e.$refs.loadingCover.hide()},fail:function(i){t.endErr(),e.$refs.loadingCover&&e.$refs.loadingCover.hide()}})},toGoodsList:function(t){1==this.state&&(1==this.couponType?1!=t.goods_type?this.$util.redirectTo("/otherpages/shop/list/list",{couponId:t.coupon_type_id,site_id:t.site_id,coupon:t.coupon_type_id}):this.$util.redirectTo("/otherpages/shop/list/list",{site_id:t.site_id,coupon:t.coupon_type_id}):1!=t.use_scenario?this.$util.redirectTo("/pages/goods/list/list",{platformcouponTypeId:t.platformcoupon_type_id,coupon:t.coupon_type_id}):this.$util.redirectTo("/pages/goods/list/list",{coupon:t.coupon_type_id}))}}};e.default=n},b2d4:function(t,e,i){var o=i("24fb");e=o(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n * 建议使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n */.cf-container[data-v-decb32f0]{background:#fff;overflow:hidden;border-bottom:%?2?% solid;padding:%?10?% 0}.tab[data-v-decb32f0]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.tab > uni-view[data-v-decb32f0]{text-align:center;width:40%}.tab > uni-view uni-text[data-v-decb32f0]{display:inline-block;line-height:%?66?%}.tab .active[data-v-decb32f0]{border-bottom:%?4?% solid}.tabs-box[data-v-decb32f0]{overflow:hidden}.status-tab[data-v-decb32f0]{border:%?2?% solid;margin:%?20?% auto 0;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;width:%?600?%;-webkit-border-radius:%?100?%;border-radius:%?100?%;overflow:hidden;height:%?62?%}.status-tab uni-view[data-v-decb32f0]{width:%?200?%;text-align:center;color:#838383;line-height:%?80?%;height:%?80?%}.status-tab uni-view.active[data-v-decb32f0]{color:#fff;border:%?2?% solid}.status-tab uni-view[data-v-decb32f0]:not(:last-of-type){border-right:%?2?% solid}.active[data-v-decb32f0]{border-bottom:%?4?% solid}.coupon-listone[data-v-decb32f0]{margin:0 %?30?%}.coupon-listone .item[data-v-decb32f0]{display:-webkit-box;display:-webkit-flex;display:flex;background-color:#fff2f0;background-size:100% 100%;-webkit-border-radius:%?20?%;border-radius:%?20?%;-webkit-box-align:stretch;-webkit-align-items:stretch;align-items:stretch;margin-top:%?20?%;overflow:hidden}.coupon-listone .item .item-base[data-v-decb32f0]{position:relative;width:%?197?%;min-width:%?197?%;text-align:center;background-image:-webkit-gradient(linear,left bottom,right top,from(#fc6831),to(#ff4544));background-image:-webkit-linear-gradient(left bottom,#fc6831,#ff4544);background-image:linear-gradient(to right top,#fc6831,#ff4544);background-repeat:no-repeat;background-size:100% 100%;padding:%?38?% %?10?% %?38?% %?18?%}.coupon-listone .item .item-base > uni-view[data-v-decb32f0]{width:calc(100%);height:auto;position:relative;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.coupon-listone .item .item-base .use_price[data-v-decb32f0]{font-size:%?60?%;line-height:1;color:#fff}.coupon-listone .item .item-base .use_price uni-text[data-v-decb32f0]{font-size:%?32?%}.coupon-listone .item .item-base .use_price.disabled[data-v-decb32f0]{color:#909399}.coupon-listone .item .item-base .use_condition[data-v-decb32f0]{color:#fff;margin-top:%?20?%}.coupon-listone .item .item-base .use_condition.margin_top_none[data-v-decb32f0]{margin-top:0}.coupon-listone .item .item-base .use_condition.disabled[data-v-decb32f0]{color:#909399}.coupon-listone .item .item-base[data-v-decb32f0]::after{position:absolute;content:"";background-color:#f8f8f8;left:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);height:%?30?%;width:%?15?%;-webkit-border-radius:0 15px 15px 0;border-radius:0 15px 15px 0}.coupon-listone .item .item-btn[data-v-decb32f0]{position:relative;width:%?160?%;min-width:%?160?%;-webkit-align-self:center;align-self:center}.coupon-listone .item .item-btn uni-view[data-v-decb32f0]{width:%?100?%;height:%?50?%;-webkit-border-radius:%?50?%;border-radius:%?50?%;line-height:%?50?%;margin:auto;text-align:center;background-image:-webkit-gradient(linear,left top,right top,from(#fc6831),to(#ff4544));background-image:-webkit-linear-gradient(left,#fc6831,#ff4544);background-image:linear-gradient(90deg,#fc6831,#ff4544);color:#fff;font-size:%?24?%}.coupon-listone .item .item-btn uni-view.disabled[data-v-decb32f0]{background:#eee!important;color:#909399!important}.coupon-listone .item .item-btn[data-v-decb32f0]::after{position:absolute;content:"";background-color:#f8f8f8;right:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);height:%?30?%;width:%?15?%;-webkit-border-radius:%?30?% 0 0 %?30?%;border-radius:%?30?% 0 0 %?30?%}.coupon-listone .item .item-info[data-v-decb32f0]{-webkit-box-flex:1;-webkit-flex:1;flex:1;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;margin-left:%?20?%;overflow:hidden;background-repeat-x:no-repeat;background-repeat-y:repeat}.coupon-listone .item .item-info .use_time[data-v-decb32f0]{padding:%?20?% 0;border-top:1px dashed #ccc;font-size:%?20?%;color:#909399}.coupon-listone .item .item-info .use_title[data-v-decb32f0]{font-size:%?28?%;font-weight:500;padding:%?20?% 0}.coupon-listone .item .item-info .use_title .title[data-v-decb32f0]{overflow:hidden;white-space:nowrap;text-overflow:ellipsis}.coupon-listone .item .item-info .use_title .max_price[data-v-decb32f0]{font-weight:400;font-size:%?24?%}',""]),t.exports=e},b901:function(t,e,i){"use strict";i.r(e);var o=i("e47f"),a=i("cef6");for(var n in a)"default"!==n&&function(t){i.d(e,t,(function(){return a[t]}))}(n);i("3abd");var s,c=i("f0c5"),r=Object(c["a"])(a["default"],o["b"],o["c"],!1,null,"decb32f0",null,!1,o["a"],s);e["default"]=r.exports},cef6:function(t,e,i){"use strict";i.r(e);var o=i("9759"),a=i.n(o);for(var n in o)"default"!==n&&function(t){i.d(e,t,(function(){return o[t]}))}(n);e["default"]=a.a},e47f:function(t,e,i){"use strict";i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return n})),i.d(e,"a",(function(){return o}));var o={nsEmpty:i("77de").default,loadingCover:i("1d00").default},a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.addonIsExit.coupon?i("v-uni-view",{class:t.isIphoneX?"iphone-x":"",attrs:{"data-theme":t.themeStyle}},[i("v-uni-view",{staticClass:"cf-container color-line-border"},[i("v-uni-view",{staticClass:"tab"},[i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.changeType(1)}}},[i("v-uni-text",{class:1==t.couponType?"color-base-text active color-base-border-bottom":""},[t._v("店铺优惠劵")])],1),i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.changeType(2)}}},[i("v-uni-text",{class:2==t.couponType?"color-base-text active color-base-border-bottom":""},[t._v("平台优惠劵")])],1)],1)],1),i("v-uni-view",{staticClass:"tabs-box"},[i("v-uni-view",{staticClass:"status-tab color-base-border"},[i("v-uni-view",{staticClass:"color-base-border",class:1==t.state?"active color-base-bg ":"color-base-text",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.changeState(1)}}},[t._v("未使用")]),i("v-uni-view",{staticClass:"color-base-border",class:2==t.state?"active color-base-bg color-base-border":"color-base-text",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.changeState(2)}}},[t._v("已使用")]),i("v-uni-view",{staticClass:"color-base-border",class:3==t.state?"active color-base-bg":"color-base-text",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.changeState(3)}}},[t._v("已过期")])],1)],1),i("mescroll-uni",{ref:"mescroll",attrs:{top:"180"},on:{getData:function(e){arguments[0]=e=t.$handleEvent(e),t.getMemberCounponList.apply(void 0,arguments)}}},[i("template",{attrs:{slot:"list"},slot:"list"},[i("v-uni-view",{staticClass:"coupon-listone"},t._l(t.list,(function(e,o){return i("v-uni-view",{key:o,staticClass:"item",style:{backgroundColor:1==e.state?"#FFF2F0":"#F2F2F2"},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.toGoodsList(e)}}},[i("v-uni-view",{staticClass:"item-base",style:{backgroundImage:"url("+t.$util.img(1==e.state?"/upload/uniapp/coupon/bg_lingqu.png":"/upload/uniapp/coupon/bg_lingqu_gary.png")+")"}},[i("v-uni-view",["reward"!=e.type&&e.discount?"discount"==e.type?i("v-uni-view",{staticClass:"use_price",class:{disabled:1!=e.state}},[t._v(t._s(parseFloat(e.discount))),i("v-uni-text",[t._v("折")])],1):t._e():i("v-uni-view",{staticClass:"use_price ",class:{disabled:1!=e.state}},[i("v-uni-text",[t._v("￥")]),t._v(t._s(parseInt(e.money)))],1),e.at_least>0?i("v-uni-view",{staticClass:"use_condition font-size-tag",class:{disabled:1!=e.state}},[t._v("满"+t._s(e.at_least)+"元可用")]):i("v-uni-view",{staticClass:"use_condition font-size-tag",class:{disabled:1!=e.state}},[t._v("无门槛优惠券")]),1==t.couponType?[1==e.goods_type?i("v-uni-view",{staticClass:"use_condition font-size-tag margin_top_none",class:{disabled:1!=e.state}},[t._v("全场商品")]):i("v-uni-view",{staticClass:"use_condition font-size-tag margin_top_none",class:{disabled:1!=e.state}},[t._v("指定商品")])]:t._e(),2==t.couponType?[1==e.use_scenario?i("v-uni-view",{staticClass:"use_condition font-size-tag margin_top_none",class:{disabled:1!=e.state}},[t._v("全场店铺")]):i("v-uni-view",{staticClass:"use_condition font-size-tag margin_top_none",class:{disabled:1!=e.state}},[t._v("指定店铺")])]:t._e()],2)],1),i("v-uni-view",{staticClass:"item-info"},[i("v-uni-view",{staticClass:"use_title"},[i("v-uni-view",{staticClass:"title"},[t._v(t._s(1==t.couponType?e.coupon_name:e.platformcoupon_name))]),1==t.couponType&&e.site_name?i("v-uni-view",{staticClass:"title font-size-tag color-disabled"},[t._v(t._s(e.site_name))]):t._e(),e.discount_limit&&"0.00"!=e.discount_limit?i("v-uni-view",{staticClass:"max_price"},[t._v("(最大优惠"+t._s(e.discount_limit)+"元)")]):t._e()],1),e.validity_type?i("v-uni-view",{staticClass:"use_time"},[t._v("有效期：领取之日起"+t._s(e.fixed_term)+"日内有效")]):i("v-uni-view",{staticClass:"use_time"},[t._v("有效期："+t._s(t.$util.timeStampTurnTime(e.end_time)))])],1),i("v-uni-view",{staticClass:"item-btn"},[1==e.state?i("v-uni-view",{staticClass:"tag"},[t._v("去使用")]):t._e(),2==e.state?i("v-uni-view",{staticClass:"tag disabled"},[t._v("已使用")]):t._e(),3==e.state?i("v-uni-view",{staticClass:"tag disabled"},[t._v("已过期")]):t._e()],1)],1)})),1),!t.list.length&&t.showEmpty?i("v-uni-view",{staticClass:"margin-top cart-empty",attrs:{fixed:!1}},[i("ns-empty",{attrs:{isIndex:!1,text:"暂无优惠券"}})],1):t._e()],1)],2),i("loading-cover",{ref:"loadingCover"})],1):t._e()},n=[]}}]);