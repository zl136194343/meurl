(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-property-withdraw-detail"],{"219d":function(i,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var s={data:function(){return{id:0,base_info:{}}},onLoad:function(i){i.id?(this.id=i.id,this.getBaseInfo()):this.$util.goBack("/pages/property/withdraw/list")},onShow:function(){this.$util.checkToken("/pages/property/withdraw/detail?id="+this.id)},methods:{getBaseInfo:function(){var i=this;this.$api.sendRequest({url:"/shopapi/shopwithdraw/detail",data:{id:this.id},success:function(t){t.code>=0?i.base_info=t.data:i.$util.showToast({title:t.message}),i.$refs.loadingCover&&i.$refs.loadingCover.hide()}})},previewMedia:function(){var i=[this.base_info.paying_money_certificate];uni.previewImage({current:0,urls:i})}}};t.default=s},29667:function(i,t,a){"use strict";var s=a("b3d1"),e=a.n(s);e.a},"87a4":function(i,t,a){"use strict";a.r(t);var s=a("219d"),e=a.n(s);for(var n in s)"default"!==n&&function(i){a.d(t,i,(function(){return s[i]}))}(n);t["default"]=e.a},"89ab":function(i,t,a){"use strict";a.r(t);var s=a("eea2"),e=a("87a4");for(var n in e)"default"!==n&&function(i){a.d(t,i,(function(){return e[i]}))}(n);a("29667");var v,d=a("f0c5"),l=Object(d["a"])(e["default"],s["b"],s["c"],!1,null,"4272019c",null,!1,s["a"],v);t["default"]=l.exports},b3d1:function(i,t,a){var s=a("bad5");"string"===typeof s&&(s=[[i.i,s,""]]),s.locals&&(i.exports=s.locals);var e=a("4f06").default;e("e3b9c242",s,!0,{sourceMap:!1,shadowMode:!1})},bad5:function(i,t,a){var s=a("24fb");t=s(!1),t.push([i.i,'@charset "UTF-8";\r\n/**\r\n * 你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n * 建议使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n */.uni-line-hide[data-v-4272019c]{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}.uni-using-hide[data-v-4272019c]{overflow:hidden;width:100%;text-overflow:ellipsis;white-space:nowrap}.prevent-head-roll[data-v-4272019c]{position:fixed;left:0;right:0;z-index:998}uni-page-body[data-v-4272019c]{overflow:hidden}.withdrawal[data-v-4272019c]{padding:%?20?% 0;border-radius:%?10?%;overflow:hidden;margin:0 %?30?%}.withdrawal .dl[data-v-4272019c]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;padding:%?30?%;border-bottom:1px solid #eee;background-color:#fff}.withdrawal .dl[data-v-4272019c]:last-child{border-bottom:0!important}.withdrawal .dl .dt[data-v-4272019c]{min-width:%?200?%}.withdrawal .dl .dd[data-v-4272019c]{-webkit-box-flex:1;-webkit-flex:1;flex:1;text-align:right;word-break:break-all}.withdrawal .dl .dd .img[data-v-4272019c]{height:%?80?%;width:%?80?%}',""]),i.exports=t},eea2:function(i,t,a){"use strict";a.d(t,"b",(function(){return e})),a.d(t,"c",(function(){return n})),a.d(t,"a",(function(){return s}));var s={loadingCover:a("8f54").default},e=function(){var i=this,t=i.$createElement,a=i._self._c||t;return a("v-uni-view",{staticClass:"withdrawal iphone-safe-area"},[a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("店铺名称")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.site_name))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("联系人")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.name))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("联系电话")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.mobile))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("账户类型")]),a("v-uni-view",{staticClass:"dd"},[1==i.base_info.bank_type?[i._v("银行")]:3==i.base_info.bank_type?[i._v("微信")]:[i._v("支付宝")]],2)],1),1==i.base_info.bank_type?[a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("账户名称")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_name))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("提现账号")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_account_number))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("开户名")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_account_name))])],1)]:i._e(),3==i.base_info.bank_type?[a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("微信昵称")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_address))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("微信号")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_name))])],1)]:[a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("支付宝用户名")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_account_name))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("支付宝账号")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.settlement_bank_account_number))])],1)],a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("提现金额")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.money)+"元")])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("状态")]),a("v-uni-view",{staticClass:"dd"},[0==i.base_info.status?[i._v("待审核")]:1==i.base_info.status?[i._v("待转账")]:2==i.base_info.status?[i._v("已转账")]:-1==i.base_info.status?[i._v("已拒绝")]:i._e()],2)],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("申请时间")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.$util.timeStampTurnTime(i.base_info.apply_time)))])],1),2==i.base_info.status?[a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("转账时间")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.$util.timeStampTurnTime(i.base_info.payment_time)))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("转账凭证")]),a("v-uni-view",{staticClass:"dd"},[a("v-uni-image",{staticClass:"img",attrs:{src:i.$util.img(i.base_info.paying_money_certificate)},on:{click:function(t){arguments[0]=t=i.$handleEvent(t),i.previewMedia()}}})],1)],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("转账凭证说明")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.paying_money_certificate_explain?i.base_info.paying_money_certificate_explain:"暂无"))])],1)]:i._e(),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("是否结算周期")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(0==i.base_info.is_period?"否":"是"))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("结算周期名称")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.period_name))])],1),a("v-uni-view",{staticClass:"dl"},[a("v-uni-view",{staticClass:"dt"},[i._v("备注")]),a("v-uni-view",{staticClass:"dd"},[i._v(i._s(i.base_info.memo))])],1),a("loading-cover",{ref:"loadingCover"})],2)},n=[]}}]);