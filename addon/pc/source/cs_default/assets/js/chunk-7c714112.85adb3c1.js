(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-7c714112"],{"485e":function(t,e,s){},"81a6":function(t,e,s){"use strict";var i=s("485e"),a=s.n(i);a.a},b978:function(t,e,s){"use strict";s.d(e,"f",(function(){return a})),s.d(e,"a",(function(){return o})),s.d(e,"e",(function(){return n})),s.d(e,"b",(function(){return r})),s.d(e,"c",(function(){return l})),s.d(e,"d",(function(){return c}));var i=s("751a");function a(t){return Object(i["a"])({url:"/groupbuy/api/ordercreate/payment",data:t,forceLogin:!0})}function o(t){return Object(i["a"])({url:"/groupbuy/api/ordercreate/calculate",data:t,forceLogin:!0})}function n(t){return Object(i["a"])({url:"/groupbuy/api/ordercreate/create",data:t,forceLogin:!0})}function r(t){return Object(i["a"])({url:"/groupbuy/api/goods/page",data:t,forceLogin:!0})}function l(t){return Object(i["a"])({url:"/groupbuy/api/goods/detail",data:t,forceLogin:!0})}function c(t){return Object(i["a"])({url:"/groupbuy/api/goods/info",data:t,forceLogin:!0})}},ee3a:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"goods-detail"},[i("div",{staticClass:"preview-wrap"},[""!=t.goodsSkuDetail.video_url?i("div",{staticClass:"video-player-wrap",class:{show:"video"==t.switchMedia}},[""!=t.goodsSkuDetail.video_url?i("video-player",{ref:"videoPlayer",attrs:{playsinline:!0,options:t.playerOptions},on:{play:function(e){return t.onPlayerPlay(e)},pause:function(e){return t.onPlayerPause(e)},ended:function(e){return t.onPlayerEnded(e)},waiting:function(e){return t.onPlayerWaiting(e)},playing:function(e){return t.onPlayerPlaying(e)},loadeddata:function(e){return t.onPlayerLoadeddata(e)},timeupdate:function(e){return t.onPlayerTimeupdate(e)},canplay:function(e){return t.onPlayerCanplay(e)},canplaythrough:function(e){return t.onPlayerCanplaythrough(e)},statechanged:function(e){return t.playerStateChanged(e)},ready:t.playerReadied}}):t._e(),""!=t.goodsSkuDetail.video_url?i("div",{staticClass:"media-mode"},[i("span",{class:{"ns-bg-color":"video"==t.switchMedia},on:{click:function(e){t.switchMedia="video"}}},[t._v("视频")]),i("span",{class:{"ns-bg-color":"img"==t.switchMedia},on:{click:function(e){t.switchMedia="img"}}},[t._v("图片")])]):t._e()],1):t._e(),i("div",{staticClass:"magnifier-wrap"},[i("pic-zoom",{ref:"PicZoom",attrs:{url:t.$img(t.picZoomUrl),scale:2}})],1),i("div",{staticClass:"spec-items"},[i("span",{staticClass:"left-btn iconfont iconarrow-left-copy",class:{move:t.moveThumbLeft},on:{click:function(e){return t.changeThumbImg("prev")}}}),i("span",{staticClass:"right-btn iconfont iconarrow-right",class:{move:t.moveThumbRight},on:{click:function(e){return t.changeThumbImg("next")}}}),i("ul",{style:{left:30+t.thumbPosition+"px"}},t._l(t.goodsSkuDetail.sku_images,(function(e,s){return i("li",{key:s,class:{selected:t.picZoomUrl==e},on:{mousemove:function(s){t.picZoomUrl=e}}},[i("img",{attrs:{src:t.$img(e,{size:"small"})},on:{error:function(e){return t.imageErrorSpec(s)}}})])})),0)]),i("div",{staticClass:"share-collect"},[i("div",{on:{click:t.editCollection}},[i("i",{staticClass:"iconfont",class:1==t.whetherCollection?"iconlikefill ns-text-color":"iconlike"}),i("span",{staticClass:"focus-text",attrs:{"data-collects":"0"}},[t._v("关注商品（"+t._s(t.goodsSkuDetail.collect_num)+"）")])]),i("div",{on:{click:t.service_link}},[i("i",{staticClass:"iconfont iconzhanghao"}),i("span",{attrs:{"data-collects":"0"}},[t._v("联系客服")])])])]),i("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticClass:"basic-info-wrap"},[i("h1",[t._v(t._s(t.goodsSkuDetail.sku_name))]),t.goodsSkuDetail.introduction?i("p",{staticClass:"desc ns-text-color"},[t._v(t._s(t.goodsSkuDetail.introduction))]):t._e(),t.groupbuyTimeMachine.currentTime?i("div",{staticClass:"discount-banner ns-bg-color"},[t._m(0),i("div",{staticClass:"surplus-time"},[i("span",[t._v(t._s(t.groupbuyText))]),i("count-down",{staticClass:"count-down",attrs:{currentTime:t.groupbuyTimeMachine.currentTime,startTime:t.groupbuyTimeMachine.startTime,endTime:t.groupbuyTimeMachine.endTime,dayTxt:"天",hourTxt:"小时",minutesTxt:"分钟",secondsTxt:"秒"},on:{start_callback:function(e){return t.countDownS_cb()},end_callback:function(e){return t.countDownE_cb()}}})],1)]):t._e(),i("div",{staticClass:"item-block"},[i("div",{staticClass:"promotion-price"},[i("dl",{staticClass:"item-line"},[i("dt",{staticClass:"ns-text-color-gray"},[t._v("团购价")]),i("dd",[i("em",{staticClass:"yuan ns-text-color"},[t._v("¥")]),i("span",{staticClass:"price ns-text-color"},[t._v(t._s(t.goodsSkuDetail.groupbuy_price))])])]),i("dl",{staticClass:"item-line"},[i("dt",{staticClass:"ns-text-color-gray"},[t._v("原价")]),i("dd",[i("em",{staticClass:"market-yuan"},[t._v("¥")]),i("span",{staticClass:"market-price"},[t._v(t._s(t.goodsSkuDetail.price))])])]),i("div",{staticClass:"statistical"},[i("ul",[i("li",[i("p",[t._v("累计评价")]),i("span",[t._v(t._s(t.goodsSkuDetail.evaluate))])]),i("li",[i("p",[t._v("累计销量")]),i("span",[t._v(t._s(t.goodsSkuDetail.sale_num)+t._s(t.goodsSkuDetail.unit))])])])]),0==t.goodsSkuDetail.is_virtual?i("dl",{staticClass:"item-line"},[i("dt",[t._v("运费")]),i("dd",[t.goodsSkuDetail.is_free_shipping?i("i",{staticClass:"i-activity-flag ns-text-color ns-border-color"},[t._v("快递免邮")]):i("i",{staticClass:"i-activity-flag ns-text-color ns-border-color"},[t._v("快递不免邮")])])]):t._e()])]),0==t.goodsSkuDetail.is_virtual?i("dl",{staticClass:"item-line delivery"},[i("dt",[t._v("配送至")]),i("dd",[i("div",{staticClass:"region-selected ns-border-color-gray"},[i("span",[t.selectedAddress["level_1"]?[t._l(t.selectedAddress,(function(e){return[t._v(" "+t._s(e.name)+" ")]}))]:[t._v(" 请选择配送地址 ")]],2),i("i",{staticClass:"el-icon-arrow-down"})]),i("div",{staticClass:"region-list ns-border-color-gray",class:{hide:t.hideRegion}},[i("ul",{staticClass:"nav-tabs"},[i("li",{class:{active:"province"==t.currTabAddres},on:{click:function(e){t.currTabAddres="province"}}},[i("div",[i("span",[t._v(t._s(t.selectedAddress["level_1"]?t.selectedAddress["level_1"].name:"请选择省"))]),i("i",{staticClass:"el-icon-arrow-down"})])]),i("li",{class:{active:"city"==t.currTabAddres},on:{click:function(e){t.currTabAddres="city"}}},[i("div",[i("span",[t._v(t._s(t.selectedAddress["level_2"]?t.selectedAddress["level_2"].name:"请选择市"))]),i("i",{staticClass:"el-icon-arrow-down"})])]),i("li",{class:{active:"district"==t.currTabAddres},on:{click:function(e){t.currTabAddres="district"}}},[i("div",[i("span",[t._v(t._s(t.selectedAddress["level_3"]?t.selectedAddress["level_3"].name:"请选择区/县"))]),i("i",{staticClass:"el-icon-arrow-down"})])])]),i("div",{staticClass:"tab-content"},[i("div",{staticClass:"tab-pane",class:{active:"province"==t.currTabAddres}},[i("ul",{staticClass:"province"},t._l(t.provinceArr,(function(e,s){return i("li",{key:s,class:{selected:t.selectedAddress["level_"+e.level]&&t.selectedAddress["level_"+e.level].id==e.id}},[i("span",{on:{click:function(s){return t.getAddress("city",e)}}},[t._v(t._s(e.name))])])})),0)]),i("div",{staticClass:"tab-pane",class:{active:"city"==t.currTabAddres}},[i("ul",{staticClass:"city"},t._l(t.cityArr,(function(e,s){return i("li",{key:s,class:{selected:t.selectedAddress["level_"+e.level]&&t.selectedAddress["level_"+e.level].id==e.id}},[i("span",{on:{click:function(s){return t.getAddress("district",e)}}},[t._v(t._s(e.name))])])})),0)]),i("div",{staticClass:"tab-pane",class:{active:"district"==t.currTabAddres}},[i("ul",{staticClass:"district"},t._l(t.districtArr,(function(e,s){return i("li",{key:s,class:{selected:t.selectedAddress["level_"+e.level]&&t.selectedAddress["level_"+e.level].id==e.id}},[i("span",{on:{click:function(s){return t.getAddress("community",e)}}},[t._v(t._s(e.name))])])})),0)])])])])]):t._e(),i("dl",{staticClass:"item-line service"},[i("dt",[t._v("服务")]),i("dd",[i("span",[t._v(" 由 "),i("router-link",{staticClass:"ns-text-color",attrs:{to:"/shop-"+t.shopInfo.site_id}},[t._v(t._s(t.shopInfo.site_name))]),t._v(" 发货并提供售后服务 ")],1)])]),i("hr",{staticClass:"divider"}),t.goodsSkuDetail.goods_spec_format?i("div",{staticClass:"sku-list"},t._l(t.goodsSkuDetail.goods_spec_format,(function(e,s){return i("dl",{key:s,staticClass:"item-line"},[i("dt",[t._v(t._s(e.spec_name))]),i("dd",[i("ul",t._l(e.value,(function(e,s){return i("li",{key:s},[i("div",{class:{"selected ns-border-color":e["selected"]||t.skuId==e.sku_id,disabled:e["disabled"]||!e["selected"]&&t.specDisabled},on:{click:function(s){return t.changeSpec(e.sku_id,e.spec_id)}}},[e.image?i("img",{attrs:{src:t.$img(e.image,{size:"small"})}}):t._e(),i("span",[t._v(t._s(e.spec_value_name))]),i("i",{staticClass:"iconfont iconduigou1 ns-text-color"})])])})),0)])])})),0):t._e(),i("div",{staticClass:"buy-number"},[i("dl",{staticClass:"item-line"},[i("dt",[t._v("数量")]),i("dd",[i("div",{staticClass:"num-wrap"},[i("el-input",{attrs:{placeholder:"0"},on:{input:function(e){return t.keyInput(!1)},blur:t.blur},model:{value:t.number,callback:function(e){t.number=e},expression:"number"}}),i("div",{staticClass:"operation"},[i("span",{staticClass:"increase el-icon-caret-top",on:{click:function(e){return t.changeNum("+")}}}),i("span",{staticClass:"decrease el-icon-caret-bottom",on:{click:function(e){return t.changeNum("-")}}})])],1),i("span",{staticClass:"unit"},[t._v(t._s(t.goodsSkuDetail.unit))]),i("span",{staticClass:"inventory"},[t._v("库存"+t._s(t.goodsSkuDetail.stock)+t._s(t.goodsSkuDetail.unit))]),t.limitNumber>0?i("em",[t._v("("+t._s(t.limitNumber)+t._s(t.goodsSkuDetail.unit)+"起购)")]):t._e()])])]),i("dl",{staticClass:"item-line buy-btn"},[i("dt"),i("dd",[1==t.goodsSkuDetail.goods_state&&1==t.goodsSkuDetail.verify_state?[i("el-button",{attrs:{type:"primary",plain:""},on:{click:t.buyNow}},[t._v("立即抢购")])]:[i("el-button",{attrs:{type:"info",plain:"",disabled:""}},[t._v("该商品已下架")])],i("div",{staticClass:"go-phone",attrs:{href:"javascript:;"}},[i("img",{attrs:{src:s("5d2e")}}),i("div",{staticClass:"qrcode-wrap"},[i("img",{attrs:{src:t.qrcode,alt:"二维码图片"}})])])],2)]),i("dl",{directives:[{name:"show",rawName:"v-show",value:1==t.shopInfo.shop_baozh||1==t.shopInfo.shop_qtian||1==t.shopInfo.shop_zhping||1==t.shopInfo.shop_erxiaoshi||1==t.shopInfo.shop_tuihuo||1==t.shopInfo.shop_shiyong||1==t.shopInfo.shop_shiti||1==t.shopInfo.shop_xiaoxie,expression:"\n\t\t\t\tshopInfo.shop_baozh == 1 ||\n\t\t\t\t\tshopInfo.shop_qtian == 1 ||\n\t\t\t\t\tshopInfo.shop_zhping == 1 ||\n\t\t\t\t\tshopInfo.shop_erxiaoshi == 1 ||\n\t\t\t\t\tshopInfo.shop_tuihuo == 1 ||\n\t\t\t\t\tshopInfo.shop_shiyong == 1 ||\n\t\t\t\t\tshopInfo.shop_shiti == 1 ||\n\t\t\t\t\tshopInfo.shop_xiaoxie == 1\n\t\t\t"}],staticClass:"item-line merchant-service"},[i("dt",[t._v("商家服务")]),i("div",[1==t.shopInfo.shop_baozh?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"保证服务"}},[t._v("保证服务")])]):t._e(),1==t.shopInfo.shop_qtian?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"满足7天无理由退换货申请的前提下，包邮商品需要买家承担退货邮费，非包邮商品需要买家承担发货和退货邮费"}},[t._v("7天退换")])]):t._e(),1==t.shopInfo.shop_zhping?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"商品支持正品保障服务"}},[t._v("正品保障")])]):t._e(),1==t.shopInfo.shop_erxiaoshi?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"付款后2小时内发货"}},[t._v("两小时发货")])]):t._e(),1==t.shopInfo.shop_tuihuo?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"退货承诺"}},[t._v("退货承诺")])]):t._e(),1==t.shopInfo.shop_shiyong?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"试用中心"}},[t._v("试用中心")])]):t._e(),1==t.shopInfo.shop_shiti?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"实体验证"}},[t._v("实体验证")])]):t._e(),1==t.shopInfo.shop_xiaoxie?i("dd",{staticClass:"service-li"},[i("i",{staticClass:"el-icon-success"}),i("span",{staticClass:"ns-text-color-gray",attrs:{title:"如有商品质量问题、描述不符或未收到货等，您有权申请退款或退货，来回邮费由卖家承担"}},[t._v("消协保证")])]):t._e()])])]),i("div",{staticClass:"shop-wrap"},[i("div",{staticClass:"head-wrap"},[i("div",{staticClass:"img-wrap"},[i("img",{staticClass:"img-responsive center-block",attrs:{src:t.shopInfo.avatar?t.$img(t.shopInfo.avatar):t.$img(t.defaultShopImage),alt:t.shopInfo.site_name},on:{error:function(e){t.shopInfo.avatar=t.defaultShopImage}}})]),i("h5",[i("span",{staticClass:"site-name"},[t._v(t._s(t.shopInfo.site_name))]),1==t.shopInfo.is_own?i("el-tag",{staticClass:"tag",attrs:{size:"small"}},[t._v("自营")]):t._e()],1)]),i("div",{staticClass:"info-wrap"},[i("dl",[i("dt",{staticClass:"site-score"},[t._v("店铺评分")]),i("dd",[i("el-rate",{attrs:{disabled:""},model:{value:t.score,callback:function(e){t.score=e},expression:"score"}})],1),i("dt",[t._v("商品描述：")]),i("dd",[i("span",[t._v(t._s(t.shopInfo.shop_desccredit))]),t._v(" 分 ")]),i("dt",[t._v("卖家服务：")]),i("dd",[i("span",[t._v(t._s(t.shopInfo.shop_servicecredit))]),t._v(" 分 ")]),i("dt",[t._v("发货速度：")]),i("dd",[i("span",[t._v(t._s(t.shopInfo.shop_deliverycredit))]),t._v(" 分 ")])])]),t.shopInfo.telephone?i("div",{staticClass:"info-wrap"},[i("dl",[i("dt",[t._v("联系电话：")]),i("dd",[t._v(t._s(t.shopInfo.telephone))])])]):t._e(),i("div",{staticClass:"operation"},[i("el-button",{staticClass:"btn btn-default",attrs:{size:"medium"},on:{click:function(e){return t.$router.pushToTab("/shop-"+t.shopInfo.site_id)}}},[t._v("进店逛逛")]),t.hasFollow?i("el-button",{attrs:{size:"medium"},on:{click:t.follow}},[t._v("取消关注")]):i("el-button",{attrs:{size:"medium"},on:{click:t.follow}},[t._v("关注店铺")])],1)]),i("div",{staticClass:"detail-wrap"},[i("div",{staticClass:"goods-recommended"},[i("goods-recommend")],1),i("el-tabs",{staticClass:"goods-tab",attrs:{type:"card"},on:{"tab-click":t.tabChange},model:{value:t.tabName,callback:function(e){t.tabName=e},expression:"tabName"}},[i("el-tab-pane",{attrs:{label:"商品详情",name:"detail"}},[i("div",{domProps:{innerHTML:t._s(t.goodsSkuDetail.goods_content)}})]),i("el-tab-pane",{attrs:{label:"商品属性",name:"attr"}},[i("ul",{staticClass:"attr-list"},[t.goodsSkuDetail.goods_attr_format&&t.goodsSkuDetail.goods_attr_format.length>0?t._l(t.goodsSkuDetail.goods_attr_format,(function(e,s){return i("li",{key:s},[t._v(t._s(e.attr_name)+"："+t._s(e.attr_value_name))])})):t._e()],2)]),i("el-tab-pane",{staticClass:"evaluate",attrs:{label:t.goodsSkuDetail.evaluate?"商品评价("+t.goodsSkuDetail.evaluate+")":"商品评价",name:"evaluate"}},[t.goodsEvaluateList.length?[i("nav",[i("li",{staticClass:"selected"},[t._v("全部评价")])]),i("ul",{staticClass:"list"},t._l(t.goodsEvaluateList,(function(e,s){return i("li",{key:s},[i("div",{staticClass:"member-info"},[i("img",{staticClass:"avatar",attrs:{src:t.$img(e.member_headimg)},on:{error:function(e){return t.imageErrorEvaluate(s)}}}),i("span",[t._v(t._s(e.member_name))])]),i("div",{staticClass:"info-wrap"},[i("el-rate",{attrs:{disabled:""},model:{value:e.star,callback:function(s){t.$set(e,"star",s)},expression:"item.star"}}),i("p",{staticClass:"content"},[t._v(t._s(e.content))]),e.images?i("div",{staticClass:"img-list"},t._l(e.images,(function(s,a){return i("el-image",{key:a,attrs:{src:t.$img(s),"preview-src-list":e.imagesFormat}})})),1):t._e(),i("div",{staticClass:"sku-info"},[i("span",[t._v(t._s(e.sku_name))]),i("span",{staticClass:"create-time"},[t._v(t._s(t.$util.timeStampTurnTime(e.create_time)))])]),""!=e.explain_first?i("div",{staticClass:"evaluation-reply"},[t._v("店家回复："+t._s(e.explain_first))]):t._e(),""!=e.again_content?[i("div",{staticClass:"review-evaluation"},[i("span",[t._v("追加评价")]),i("span",{staticClass:"review-time"},[t._v(t._s(t.$util.timeStampTurnTime(e.again_time)))])]),i("p",{staticClass:"content"},[t._v(t._s(e.again_content))]),i("div",{staticClass:"img-list"},t._l(e.again_images,(function(s,a){return i("el-image",{key:a,attrs:{src:t.$img(s),"preview-src-list":e.againImagesFormat}})})),1),""!=e.again_explain?i("div",{staticClass:"evaluation-reply"},[t._v("店家回复："+t._s(e.again_explain))]):t._e()]:t._e()],2)])})),0),i("div",{staticClass:"pager"},[i("el-pagination",{attrs:{background:"","pager-count":5,total:t.total,"prev-text":"上一页","next-text":"下一页","current-page":t.currentPage,"page-size":t.pageSize,"hide-on-single-page":""},on:{"update:currentPage":function(e){t.currentPage=e},"update:current-page":function(e){t.currentPage=e},"update:pageSize":function(e){t.pageSize=e},"update:page-size":function(e){t.pageSize=e},"size-change":t.handlePageSizeChange,"current-change":t.handleCurrentPageChange}})],1)]:i("div",{staticClass:"empty"},[t._v("该商品暂无评价哦")])],2)],1)],1),i("servicerMessage",{ref:"servicerMessage",staticClass:"kefu",attrs:{shop:{shop_id:t.shopInfo.site_id,logo:t.shopInfo.logo,shop_name:t.shopInfo.site_name}}})],1)},a=[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"activity-name"},[s("i",{staticClass:"discount-icon iconfont iconicon_naozhong"}),s("span",[t._v("团购")])])}],o=s("86bd"),n=(s("99af"),s("a9e3"),s("b680"),s("ac1f"),s("5319"),s("1276"),s("5530")),r=s("a2a9"),l=s("b978"),c=s("2f84"),d=s("0091"),u=s("2f62"),g=s("0dec"),p=s.n(g),_=s("e692"),m=s("2f94"),h=s("37cb"),v={data:function(){return{id:0,skuId:0,loading:!0,picZoomUrl:"",thumbPosition:0,moveThumbLeft:!1,moveThumbRight:!1,goodsSkuDetail:{video_url:""},groupbuyText:"距离结束仅剩",groupbuyTimeMachine:{currentTime:0,startTime:0,endTime:0},qrcode:"",specDisabled:!1,specBtnRepeat:!1,btnSwitch:!1,shopInfo:{},whetherCollection:0,score:0,currentPage:1,pageSize:10,total:0,goodsEvaluateList:[],service:null,number:1,limitNumber:0,tabName:"detail",playerOptions:{playbackRates:[.5,1,1.5,2,3],autoplay:!1,muted:!1,loop:!1,preload:"auto",language:"zh-CN",aspectRatio:"16:9",fluid:!0,sources:[{type:"video/mp4",src:""}],poster:"",notSupportedMessage:"此视频暂无法播放，请稍后再试",controlBar:{timeDivider:!0,durationDisplay:!0,remainingTimeDisplay:!0,fullscreenToggle:!0}},switchMedia:"img",hasFollow:!1,provinceArr:{},cityArr:{},districtArr:{},currTabAddres:"province",hideRegion:!1,selectedAddress:{},serverType:"disable",serverThird:""}},components:{CountDown:p.a},created:function(){var t=this;this.id=this.$route.path.replace("/promotion/groupbuy-",""),this.addonIsExit&&1!=this.addonIsExit.groupbuy?this.$message({message:"团购插件未安装",type:"warning",duration:2e3,onClose:function(){t.$route.push("/")}}):this.getGoodsSkuDetail(),this.shopServiceOpen()},computed:Object(n["a"])({},Object(u["b"])(["token","defaultHeadImage","defaultShopImage","addonIsExit","locationRegion"])),watch:{$route:function(t){var e=this;this.id=t.params.pathMatch,this.addonIsExit&&1!=this.addonIsExit.groupbuy?this.$message({message:"团购插件未安装",type:"warning",duration:2e3,onClose:function(){e.$route.push("/")}}):this.getGoodsSkuDetail()},addonIsExit:function(){var t=this;1!=this.addonIsExit.groupbuy&&this.$message({message:"团购插件未安装",type:"warning",duration:2e3,onClose:function(){t.$route.push("/")}})}},methods:{shopServiceOpen:function(){var t=this;Object(h["g"])().then((function(e){0==e.code&&("third"==e.data.type?(t.serverType=e.data.type,t.serverThird=e.data.third):"system"==e.data.type&&(t.serverType=e.data.type,t.serverThird=""))}))},tabChange:function(t,e){},bundlingChange:function(t,e){},getGoodsSkuDetail:function(){var t=this;Object(l["c"])({groupbuy_id:this.id}).then((function(e){var s=e.data;if(null!=s.goods_sku_detail){t.goodsSkuDetail=s.goods_sku_detail,t.shopInfo=s.shop_info;var i=(Number(t.shopInfo.shop_desccredit)+Number(t.shopInfo.shop_servicecredit)+Number(t.shopInfo.shop_deliverycredit))/3;if(t.score=Number(i.toFixed(1)),t.skuId=t.goodsSkuDetail.sku_id,t.number=t.goodsSkuDetail.buy_num,t.limitNumber=t.goodsSkuDetail.buy_num,t.goodsSkuDetail.end_time-e.timestamp>0?t.groupbuyTimeMachine={currentTime:e.timestamp,startTime:e.timestamp,endTime:t.goodsSkuDetail.end_time}:t.$message({message:"活动已结束",type:"warning",duration:2e3,onClose:function(){t.$router.push("/sku-"+t.goodsSkuDetail.sku_id)}}),t.goodsSkuDetail.sku_images?t.goodsSkuDetail.sku_images=t.goodsSkuDetail.sku_images.split(","):t.goodsSkuDetail.sku_images=[],t.goodsSkuDetail.goods_spec_format&&t.goodsSkuDetail.goods_image&&(t.goodsSkuDetail.goods_image=t.goodsSkuDetail.goods_image.split(","),t.goodsSkuDetail.sku_images=t.goodsSkuDetail.sku_images.concat(t.goodsSkuDetail.goods_image)),t.goodsSkuDetail.video_url&&(t.switchMedia="video",t.playerOptions.poster=img(t.goodsSkuDetail.sku_images[0]),t.playerOptions.sources[0].src=img(t.goodsSkuDetail.video_url)),t.picZoomUrl=t.goodsSkuDetail.sku_images[0],t.goodsSkuDetail.unit=t.goodsSkuDetail.unit||"件",t.goodsSkuDetail.sku_spec_format&&(t.goodsSkuDetail.sku_spec_format=JSON.parse(t.goodsSkuDetail.sku_spec_format)),t.goodsSkuDetail.goods_attr_format){var a=JSON.parse(t.goodsSkuDetail.goods_attr_format);t.goodsSkuDetail.goods_attr_format=t.$util.unique(a,"attr_id");for(var o=0;o<t.goodsSkuDetail.goods_attr_format.length;o++)for(var n=0;n<a.length;n++)t.goodsSkuDetail.goods_attr_format[o].attr_id==a[n].attr_id&&t.goodsSkuDetail.goods_attr_format[o].attr_value_id!=a[n].attr_value_id&&(t.goodsSkuDetail.goods_attr_format[o].attr_value_name+="、"+a[n].attr_value_name)}t.goodsSkuDetail.goods_spec_format&&(t.goodsSkuDetail.goods_spec_format=JSON.parse(t.goodsSkuDetail.goods_spec_format)),window.document.title="".concat(t.goodsSkuDetail.sku_name," - ").concat(window.document.title),t.loading=!1}else t.$router.push("/")})).then((function(e){""!=t.token&&(t.getWhetherCollection(),t.isFollow()),t.modifyGoodsInfo(),t.getGoodsEvaluate(),t.getGoodsQrcode(),t.getAddress("province",null,!0),t.locationRegion||t.$store.commit("app/SET_LOCATION_REGION",{level_1:{id:11e4,pid:0,name:"北京市",shortname:"北京",longitude:"116.40529",latitude:"39.904987",level:1,sort:1,status:1,default_data:1},level_2:{id:110100,pid:11e4,name:"北京市",shortname:"北京",longitude:"116.40529",latitude:"39.904987",level:2,sort:1,status:1,default_data:1},level_3:{id:110101,pid:110100,name:"东城区",shortname:"东城",longitude:"116.418755",latitude:"39.917545",level:3,sort:3,status:1,default_data:1}}),t.selectedAddress=t.locationRegion,t.provinceId=t.selectedAddress.level_1.id,t.getAddress("city",null,!0,(function(){t.cityId=t.selectedAddress.level_2.id,t.cityId&&t.getAddress("district",null,!0)}))})).catch((function(e){t.loading=!1,t.$router.push("/")}))},service_link:function(){this.token?"third"==this.serverType?window.open(this.serverThird,"_blank"):"system"==this.serverType&&this.$refs.servicerMessage.show():this.$message({message:"您还未登录",type:"warning"})},changeThumbImg:function(t){if(!(this.goodsSkuDetail.sku_images.length<4)){var e=this.goodsSkuDetail.sku_images.length%4,s=88;if(0==e)e=this.goodsSkuDetail.sku_images.length-4;else if(0!=e&&1!=e&&e<2)return;"prev"==t?0!=this.thumbPosition&&Math.round(this.thumbPosition,2)!=s&&(this.thumbPosition+=s):"next"==t&&Math.round(this.thumbPosition,2)!=-Math.round(s*e,2)&&(this.thumbPosition-=s)}},getWhetherCollection:function(){var t=this;Object(c["c"])({goods_id:this.goodsSkuDetail.goods_id}).then((function(e){t.whetherCollection=e.data}))},editCollection:function(){var t=this;0==this.whetherCollection?Object(c["a"])({sku_id:this.skuId}).then((function(e){var s=e.data;s>0&&(t.whetherCollection=1,t.goodsSkuDetail.collect_num++)})):Object(c["b"])({goods_id:this.goodsSkuDetail.goods_id}).then((function(e){var s=e.data;s>0&&(t.whetherCollection=0,t.goodsSkuDetail.collect_num--)}))},getAftersale:function(){var t=this;Object(r["b"])({}).then((function(e){if(0==e.code&&e.data){e.data.content;e.data.content&&(t.service=e.data.content)}}))},modifyGoodsInfo:function(){Object(r["j"])({sku_id:this.skuId,site_id:this.goodsSkuDetail.site_id}),Object(r["a"])({sku_id:this.skuId})},getGoodsQrcode:function(){var t=this;Object(r["d"])({sku_id:this.skuId}).then((function(e){var s=e.data;s.path.h5.img&&(t.qrcode=img(s.path.h5.img))}))},getGoodsEvaluate:function(){var t=this;Object(d["a"])({page:this.currentPage,page_size:this.pageSize,goods_id:this.goodsSkuDetail.goods_id}).then((function(e){var s=[];e.message;0==e.code&&e.data&&(s=e.data.list,t.total=e.data.count);for(var i=0;i<s.length;i++){if(1==s[i].explain_type?s[i].star=5:2==s[i].explain_type?s[i].star=3:3==s[i].explain_type&&(s[i].star=1),s[i].images){s[i].images=s[i].images.split(","),s[i].imagesFormat=[];for(var a=0;a<s[i].images.length;a++)s[i].imagesFormat.push(img(s[i].images[a]))}if(s[i].again_images){s[i].again_images=s[i].again_images.split(","),s[i].againImagesFormat=[];for(var o=0;o<s[i].again_images.length;o++)s[i].againImagesFormat.push(img(s[i].again_images[o]))}1==s[i].is_anonymous&&(s[i].member_name=s[i].member_name.replace(s[i].member_name.substring(1,s[i].member_name.length-1),"***"))}t.goodsEvaluateList=s}))},imageErrorEvaluate:function(t){this.goodsEvaluateList[t].member_headimg=this.defaultHeadImage},handlePageSizeChange:function(t){this.pageSize=t,this.getGoodsEvaluate()},handleCurrentPageChange:function(t){this.currentPage=t,this.getGoodsEvaluate()},changeSpec:function(t,e){var s=this;if(!this.specDisabled){this.specBtnRepeat=!1,this.skuId=t;for(var i=0;i<this.goodsSkuDetail.goods_spec_format.length;i++)for(var a=this.goodsSkuDetail.goods_spec_format[i],o=0;o<a.value.length;o++)e==this.goodsSkuDetail.goods_spec_format[i].value[o].spec_id&&(this.goodsSkuDetail.goods_spec_format[i].value[o].selected=!1);Object(l["d"])({sku_id:this.skuId,groupbuy_id:this.goodsSkuDetail.groupbuy_id}).then((function(t){console.log(t,"goodsSkuInfo");var e=t.data;null!=e?(""!=e.sku_images?(e.sku_images=e.sku_images.split(","),s.picZoomUrl=e.sku_images[0]):e.sku_images=s.goodsSkuDetail.sku_images,e.unit="件",s.playerOptions.poster=img(e.sku_images[0]),e.sku_spec_format&&(e.sku_spec_format=JSON.parse(e.sku_spec_format)),e.goods_spec_format&&(e.goods_spec_format=JSON.parse(e.goods_spec_format)),s.keyInput(!0),e.end_time-t.timestamp>0?s.groupbuyTimeMachine={currentTime:t.timestamp,startTime:t.timestamp,endTime:e.end_time}:s.$message({message:"活动已结束",type:"warning",duration:2e3,onClose:function(){s.$router.push("/sku-"+s.goodsSkuDetail.sku_id)}}),s.specBtnRepeat=!1,Object.assign(s.goodsSkuDetail,e)):s.$router.push("/")}))}},changeNum:function(t){if(0!=this.goodsSkuDetail.stock){var e=this.goodsSkuDetail.stock,s=this.goodsSkuDetail.buy_num;if(e=(this.goodsSkuDetail.buy_num,this.goodsSkuDetail.stock,this.goodsSkuDetail.stock),"+"==t){if(!(this.number<e))return;this.number++}else if("-"==t){if(!(this.number>s))return;this.number-=1}}},blur:function(){var t=this,e=parseInt(this.number);this.number=0,setTimeout((function(){t.number=e}),0)},keyInput:function(t,e){var s=this;setTimeout((function(){s.goodsSkuDetail.stock;0!=s.goodsSkuDetail.stock?(t&&0==s.number.length&&(s.number=1),t&&(s.number<=0||isNaN(s.number))&&(s.number=1),s.number<s.goodsSkuDetail.buy_num&&(s.number=s.goodsSkuDetail.buy_num),t&&(s.number=parseInt(s.number)),e&&e()):s.number=0}),0)},onPlayerPlay:function(t){},onPlayerPause:function(t){},onPlayerEnded:function(t){},onPlayerWaiting:function(t){},onPlayerPlaying:function(t){},onPlayerLoadeddata:function(t){},onPlayerTimeupdate:function(t){},onPlayerCanplay:function(t){},onPlayerCanplaythrough:function(t){},playerStateChanged:function(t){},playerReadied:function(t){},buyNow:function(){var t=this;this.keyInput(!0,(function(){if(0!=t.goodsSkuDetail.stock)if(0!=t.number.length&&0!=t.number){var e={groupbuy_id:t.goodsSkuDetail.groupbuy_id,sku_id:t.skuId,num:t.number};t.$store.dispatch("order/setGroupbuyOrderCreateData",e),t.$router.push({path:"/promotion/groupbuy_payment"})}else t.$message({message:"购买数量不能为0",type:"warning"});else t.$message({message:"商品已售罄",type:"warning"})}))},countDownS_cb:function(){},countDownE_cb:function(){var t=this;this.groupbuyText="活动已结束",this.$message({message:"团购活动已结束",type:"warning",duration:2e3,onClose:function(){t.$router.push("/sku-"+t.goodsSkuDetail.sku_id)}})},isFollow:function(){var t=this;Object(_["c"])({site_id:this.goodsSkuDetail.site_id}).then((function(e){0==e.code&&(t.hasFollow=e.data)}))},follow:function(){var t=this;this.hasFollow?Object(_["b"])({site_id:this.goodsSkuDetail.site_id}).then((function(e){0==e.code&&e.data&&(t.hasFollow=!t.hasFollow,t.$message({message:"取消成功",type:"success"}))})):Object(_["a"])({site_id:this.goodsSkuDetail.site_id}).then((function(e){0==e.code&&e.data&&(t.hasFollow=!t.hasFollow,t.$message({message:"关注成功",type:"success"}))}))},imageErrorSpec:function(t){this.goodsSkuDetail.sku_images[t]=this.defaultGoodsImage,this.picZoomUrl=this.defaultGoodsImage},getAddress:function(t,e,s,i){var a=this,o=0;switch(t){case"province":o=0;break;case"city":e&&(this.provinceId=e.id),o=this.provinceId,this.cityArr={},this.districtArr={};break;case"district":e&&(this.cityId=e.id),o=this.cityId,this.districtArr={};break}if(e){if(e.level<=2)for(var n=e.level,r=n;r<=3;r++)delete this.selectedAddress["level_"+r];this.selectedAddress["level_"+e.level]=e}if(s||this.$store.commit("app/SET_LOCATION_REGION",this.selectedAddress),this.$forceUpdate(),"community"==t)return this.hideRegion=!0,void setTimeout((function(){a.hideRegion=!1}),10);Object(m["a"])({pid:o}).then((function(e){e.code;var s=e.data;if(s){switch(t){case"province":a.provinceArr=s;break;case"city":a.cityArr=s;break;case"district":a.districtArr=s;break}a.currTabAddres=t,i&&i()}})).catch((function(t){}))}}},f=s("a63f"),k=s("628a"),b={name:"groupbuy_detail",components:{PicZoom:o["a"],GoodsRecommend:f["a"],servicerMessage:k["a"]},mixins:[v]},y=b,C=(s("81a6"),s("2877")),S=Object(C["a"])(y,i,a,!1,null,null,null);e["default"]=S.exports}}]);
//# sourceMappingURL=chunk-7c714112.85adb3c1.js.map