(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["otherpages-diy-diy-diy"],{"071c":function(t,e,i){"use strict";i.r(e);var a=i("585f"),o=i("7429");for(var n in o)"default"!==n&&function(t){i.d(e,t,(function(){return o[t]}))}(n);i("39ff"),i("ca31");var r,s=i("f0c5"),c=Object(s["a"])(o["default"],a["b"],a["c"],!1,null,"fba46c24",null,!1,a["a"],r);e["default"]=c.exports},"39ff":function(t,e,i){"use strict";var a=i("debe"),o=i.n(a);o.a},"585f":function(t,e,i){"use strict";i.d(e,"b",(function(){return o})),i.d(e,"c",(function(){return n})),i.d(e,"a",(function(){return a}));var a={diyIndexPage:i("ed44").default,diyGroup:i("6611").default,nsCopyright:i("058f").default,uniPopup:i("a492").default,diyBottomNav:i("6855").default,loadingCover:i("1d00").default},o=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"page_img",style:{backgroundColor:t.bgColor,backgroundImage:t.bgImg,minHeight:"calc(100vh - 55px)"},attrs:{"data-theme":t.themeStyle}},[t.topIndexValue?i("diy-index-page",{ref:"indexPage",attrs:{value:t.topIndexValue,minHeight:t.minHeight,scrollHeight:t.scrollHeight,scrollTopHeight:t.scrollTopHeight,bgUrl:t.bgUrl}},[t.diyData.value?i("diy-group",{attrs:{diyData:t.diyData,name:t.name,siteId:t.siteId,height:t.scrollTopHeight}}):t._e(),i("v-uni-view",{staticClass:"padding-bottom"},[i("ns-copyright")],1)],1):i("v-uni-scroll-view",{style:{height:"calc(100vh - headerHeight - 55px)"},attrs:{"scroll-y":"true","show-scrollbar":"false"}},[i("v-uni-view",{staticClass:"bg-index",style:t.backgroundUrl},[t.diyData.value?i("diy-group",{attrs:{diyData:t.diyData,name:t.name,siteId:t.siteId,city:t.city}}):t._e(),i("v-uni-view",{staticClass:"padding-bottom"},[i("ns-copyright")],1)],1)],1),[i("v-uni-view",{on:{touchmove:function(e){e.preventDefault(),e.stopPropagation(),arguments[0]=e=t.$handleEvent(e)}}},[i("uni-popup",{ref:"uniPopupWindow",staticClass:"wap-floating",attrs:{type:"center",maskClick:!1}},[i("v-uni-view",{staticClass:"image-wrap"},[i("v-uni-image",{style:{height:480*t.diyData.global.popWindow.imgHeight/t.diyData.global.popWindow.imgWidth+"rpx"},attrs:{src:t.$util.img(t.diyData.global.popWindow.imageUrl)},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.redirectTo(t.diyData.global.popWindow.link)}}})],1),i("v-uni-text",{staticClass:"iconfont iconroundclose",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closePopupWindow.apply(void 0,arguments)}}})],1)],1)],i("v-uni-view",{staticClass:"PopWindow",on:{touchmove:function(e){e.preventDefault(),e.stopPropagation(),arguments[0]=e=t.$handleEvent(e)}}},[i("uni-popup",{ref:"uniPopupClose",staticClass:"wap-floating",attrs:{type:"center",maskClick:!1}},[i("v-uni-view",{staticClass:"popup-box"},[i("v-uni-view",{staticClass:"close_title margin-top"},[t._v("站点关闭")]),i("v-uni-view",{staticClass:"close_content"},[i("v-uni-scroll-view",{staticClass:"close_content_box",attrs:{"scroll-y":"true"}},[t._v(t._s(t.webSiteInfo.close_reason))])],1)],1)],1)],1),i("v-uni-view",{staticClass:"tabBar-fill"}),t.openBottomNav?[i("diy-bottom-nav")]:t._e(),i("uni-popup",{ref:"collectPopupWindow",staticClass:"wap-floating wap-floating-collect",attrs:{type:"top"}},[t.showTip?i("v-uni-view",{staticClass:"collectPopupWindow",style:{marginTop:t.collectTop+t.statusBarHeight+"px"}},[i("v-uni-image",{attrs:{src:t.$util.img("/upload/uniapp/collect2.png"),mode:"aspectFit"}}),i("v-uni-text",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closeCollectPopupWindow.apply(void 0,arguments)}}},[t._v("我知道了")])],1):t._e()],1),i("loading-cover",{ref:"loadingCover"})],2)},n=[]},"6d18":function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n * 建议使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n */.collectPopupWindow[data-v-fba46c24]{position:relative;height:%?113?%;width:%?510?%;margin-left:calc(100% - %?530?%)}.collectPopupWindow uni-image[data-v-fba46c24]{width:100%;height:100%}.collectPopupWindow uni-text[data-v-fba46c24]{color:#ff4544!important;font-size:%?24?%!important;position:absolute;top:%?48?%;right:%?25?%}.zhezhao[data-v-fba46c24]{width:100vw;height:100vh;background-color:transparent}uni-image[data-v-fba46c24]{max-width:100%!important;max-height:100%!important}.diy-wrap[data-v-fba46c24]{height:calc(100vh - 44px)}.page_img[data-v-fba46c24]{background-size:contain!important;background-repeat:no-repeat!important}.bg-index[data-v-fba46c24]{width:100%;height:100%;padding:0 %?30?%;-webkit-box-sizing:border-box;box-sizing:border-box}.wap-floating .image-wrap[data-v-fba46c24]{width:%?480?%}.wap-floating .image-wrap uni-image[data-v-fba46c24]{width:100%;-webkit-border-radius:%?40?%;border-radius:%?40?%}.wap-floating uni-text[data-v-fba46c24]{display:block;font-size:%?60?%;color:#fff;text-align:center}.wap-floating-collect .uni-popup__mask[data-v-fba46c24]{background:transparent}[data-v-fba46c24]::-webkit-scrollbar{width:0;height:0;color:transparent}.popup-box[data-v-fba46c24]{width:%?450?%;background:#fff;-webkit-border-radius:%?10?%;border-radius:%?10?%;overflow:hidden}.popup-box .close_title[data-v-fba46c24]{width:100%;text-align:center;height:%?70?%;line-height:%?70?%;font-size:%?28?%}.popup-box .close_content[data-v-fba46c24]{width:100%;max-height:%?500?%;padding:%?20?%;-webkit-box-sizing:border-box;box-sizing:border-box}.popup-box .close_content_box[data-v-fba46c24]{width:100%;max-height:%?460?%;line-height:1.3}.noStore-text[data-v-fba46c24]{color:#000!important}.isStore-top[data-v-fba46c24]{margin-bottom:%?10?%}.tabBar-fill[data-v-fba46c24]{height:calc(constant(safe-area-inset-bottom) + 56px);height:calc(env(safe-area-inset-bottom) + 56px)}.keep-on-record[data-v-fba46c24]{text-align:center;padding-bottom:%?20?%}.keep-on-record uni-image[data-v-fba46c24]{width:%?150?%;height:%?60?%}[data-v-fba46c24] ::-webkit-scrollbar{width:0;height:0;background-color:transparent;display:none}',""]),t.exports=e},7429:function(t,e,i){"use strict";i.r(e);var a=i("b964"),o=i.n(a);for(var n in a)"default"!==n&&function(t){i.d(e,t,(function(){return a[t]}))}(n);e["default"]=o.a},"7f43":function(t,e,i){var a=i("8129");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=i("4f06").default;o("1a6536ab",a,!0,{sourceMap:!1,shadowMode:!1})},8129:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,".wap-floating[data-v-fba46c24] .uni-popup__wrapper.uni-custom .uni-popup__wrapper-box{background:none!important}\r\n\r\n/* .noStore-bg /deep/ .search-box {\r\n\tbackground: #ffffff;\r\n}\r\n\r\n.noStore-bg /deep/ .single-graph {\r\n\tbackground: #ffffff;\r\n} */[data-v-fba46c24] .placeholder{height:0}",""]),t.exports=e},b964:function(t,e,i){"use strict";var a=i("4ea4");i("4160"),i("c975"),i("ac1f"),i("5319"),i("1276"),i("159b"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("96cf");var o=a(i("1da1")),n=a(i("a492")),r=a(i("6855")),s=a(i("fb2d")),c=a(i("ed44")),l=a(i("6611")),u=a(i("bf95")),d=i("2d6c"),p=a(i("7382")),g=a(i("058f")),f=uni.getSystemInfoSync(),h={components:{uniPopup:n.default,diyBottomNav:r.default,nsNavbar:u.default,diyIndexPage:c.default,diyGroup:l.default,nsCopyRight:g.default},data:function(){return{diyData:{global:{title:"",popWindow:{imageUrl:"",count:-1,link:{}}}},navTitle:"",webSiteInfo:null,memberId:0,name:"",city:"",siteId:0,isIphoneX:!1,pageHeight:"0",headerHeight:"0",bottomHeight:"0",topIndexValue:null,statusBarHeight:f.statusBarHeight,collectTop:44,showTip:!1,mpCollect:!1}},mixins:[p.default],computed:{top:function(){var t=0;return t=this.isIphoneX?180:140,t=90,t},bgColor:function(){var t="";return this.diyData&&this.diyData.global&&(t=this.diyData.global.bgColor),t},bgImg:function(){var t="";return this.diyData&&this.diyData.global&&(t=this.diyData.global.topNavbg?"url("+this.$util.img(this.diyData.global.bgUrl)+")":this.diyData.global.bgColor),t},bgUrl:function(){var t="";return this.diyData&&this.diyData.global&&(t=this.diyData.global.topNavbg?"transparent":this.diyData.global.bgUrl),t},bgNav:function(){return this.diyData.global.topNavColor?{background:this.diyData.global.topNavColor}:{background:"#ffffff"}},backgroundUrl:function(){var t=this.bgUrl?"background:url("+this.$util.img(this.bgUrl)+") no-repeat 0 0/100%":"";return t},scrollHeight:function(){return void 0!=this.pageHeight&&void 0!=this.headerHeight&&void 0!=this.bottomHeight?"calc("+this.pageHeight+"px - "+this.headerHeight+" - "+this.bottomHeight+")":"100vh"},scrollTopHeight:function(){return void 0!=this.pageHeight&&void 0!=this.headerHeight&&void 0!=this.bottomHeight?"calc("+this.pageHeight+"px - "+this.headerHeight+" - "+this.bottomHeight+" - 80rpx)":"100vh"},textNavColor:function(){return this.diyData.global.textNavColor?this.diyData.global.textNavColor:"#ffffff"},openBottomNav:function(){var t=!1;return this.diyData&&this.diyData.global&&(t=this.diyData.global.openBottomNav),t},minHeight:function(){return void 0!=this.pageHeight&&void 0!=this.headerHeight&&void 0!=this.bottomHeight?"calc(100vh - "+this.headerHeight+" - "+this.bottomHeight+" - 80rpx)":"100vh"},globalS:function(){return this.diyData.global}},onPullDownRefresh:function(){var t=this;return(0,o.default)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.getDiyInfo();case 2:case"end":return e.stop()}}),e)})))()},onLoad:function(t){if(uni.hideTabBar(),this.name=t.name||"",this.siteId=t.site_id||0,this.isIphoneX=this.$util.uniappIsIPhoneX(),this.name){if(t.source_member&&uni.setStorageSync("source_member",t.source_member),t.scene){var e=decodeURIComponent(t.scene);e=e.split("&"),e.length&&e.forEach((function(t){-1!=t.indexOf("source_member")&&uni.setStorageSync("source_member",t.split("-")[1])}))}}else this.$util.redirectTo("/pages/index/index/index",{},"reLaunch")},onHide:function(){this.$store.commit("setDiySeckillInterval",null)},onShow:function(){var t=this;return(0,o.default)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.refresh();case 2:t.getHeight(),t.$store.commit("setDiySeckillInterval",1);case 4:case"end":return e.stop()}}),e)})))()},onPageScroll:function(t){this.$refs.topNav&&(t.scrollTop>=20?this.$refs.topNav.navTopBg():this.$refs.topNav.unSetnavTopBg())},methods:{refresh:function(){var t=this;return(0,o.default)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.$langConfig.refresh(),uni.getStorageSync("token")&&t.getMemberId(),t.$store.dispatch("defaultImg"),t.$store.dispatch("getThemeStyle"),t.getWebSitefo(),uni.getStorageSync("city")?t.city=uni.getStorageSync("city").title:(uni.setStorageSync("city",{id:0,title:"全国"}),t.city="全国",t.getLocation()),e.next=8,t.getDiyInfo();case 8:case"end":return e.stop()}}),e)})))()},getHeight:function(){var t=this;uni.getSystemInfo({success:function(e){t.pageHeight=e.screenHeight}}),this.$nextTick((function(){var e=uni.createSelectorQuery().in(t);e.select(".page-bottom").boundingClientRect((function(e){t.bottomHeight="55px"})).exec()}))},getDiyInfo:function(){var t=this;return(0,o.default)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:t.$api.sendRequest({url:"/api/diyview/info",data:{name:t.name,site_id:t.siteId},async:!0,success:function(e){if(0!=e.code||!e.data)return t.$refs.loadingCover&&t.$refs.loadingCover.hide(),void(t.diyData={});var i=e.data;if(i.value=i.value.replace(/\@/g,"'"),i.value){t.diyData=JSON.parse(i.value),t.$langConfig.title(t.diyData.global.title),t.navTitle=t.diyData.global.title,t.mpCollect=t.diyData.global.mpCollect,t.diyData.global.popWindow&&t.diyData.global.popWindow.imageUrl&&setTimeout((function(){if(1==t.diyData.global.popWindow.count){var e=uni.getStorageSync("diy_popwindow_count");(t.$refs.uniPopupWindow&&""==e||t.$refs.uniPopupWindow&&1==e)&&(t.$refs.uniPopupWindow.open(),uni.setStorageSync("diy_popwindow_count",1))}else 0==t.diyData.global.popWindow.count&&(t.$refs.uniPopupWindow.open(),uni.setStorageSync("diy_popwindow_count",0))}),500);for(var a=0;a<t.diyData.value.length;a++)"TopCategory"==t.diyData.value[a].controller&&(t.topIndexValue=t.diyData.value[a])}uni.stopPullDownRefresh(),t.$refs.loadingCover&&t.$refs.loadingCover.hide()},fail:function(e){uni.stopPullDownRefresh(),t.$refs.loadingCover&&t.$refs.loadingCover.hide()}});case 1:case"end":return e.stop()}}),e)})))()},closePopupWindow:function(){this.$refs.uniPopupWindow.close(),uni.setStorageSync("diy_popwindow_count",-1)},closeCollectPopupWindow:function(){this.$refs.collectPopupWindow.close(),uni.setStorageSync("isCollect",!0)},redirectTo:function(t){this.$util.diyRedirectTo(t)},getMemberId:function(){var t=this;this.$api.sendRequest({url:"/api/member/id",success:function(e){e.code>=0&&(t.memberId=e.data)}})},getWebSitefo:function(){var t=this;this.webSiteInfo=uni.getStorageSync("web_site_info"),this.webSiteInfo&&(this.webSiteInfo=JSON.parse(this.webSiteInfo)),this.$api.sendRequest({url:"/api/website/info",success:function(e){var i=e.data;if(i){if(t.webSiteInfo=i,t.webSiteInfo.wap_status)return;t.$refs.uniPopupClose.open(),uni.setStorageSync("web_site_info",JSON.stringify(t.webSiteInfo))}}})},getLocation:function(){var t=this,e=new s.default({key:this.$config.mpKey});uni.getLocation({type:"gcj02",success:function(i){e.reverseGeocoder({location:{latitude:i.latitude,longitude:i.longitude},success:function(e){t.$api.sendRequest({url:"/api/address/citybyname",data:{city:e.result.address_component.city},success:function(e){e.data&&(t.city=e.data.title,uni.setStorageSync("city",e.data))}})},fail:function(t){}})}})}},onShareAppMessage:function(t){var e="";this.webSiteInfo&&(e=this.webSiteInfo.title);var i="/otherpages/diy/diy/diy?name="+this.name;return this.memberId&&(i+="&source_member="+this.memberId),{title:e,path:i,success:function(t){},fail:function(t){}}},onReady:function(){var t=this;this.$util.isWeiXin()&&this.$api.sendRequest({url:"/wechat/api/wechat/share",data:{url:window.location.href},success:function(e){if(0==e.code){var i=new d.Weixin;i.init(e.data.jssdk_config);var a=e.data.share_config,o=t.$config.h5Domain+"/otherpages/diy/diy/diy?name="+t.name;t.memberId&&(o+="&source_member="+t.memberId),i.setShareData({title:a.shop_param_1+a.site_name,desc:a.shop_param_2+"\r\n"+a.shop_param_3+"\r\n收藏热度：★★★★★",link:o,imgUrl:t.$util.img(a.site_logo)})}}})}};e.default=h},ca31:function(t,e,i){"use strict";var a=i("7f43"),o=i.n(a);o.a},debe:function(t,e,i){var a=i("6d18");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=i("4f06").default;o("19762a42",a,!0,{sourceMap:!1,shadowMode:!1})}}]);