(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-goods-album"],{"04a7":function(t,e,i){var a=i("674c");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("97ff9cea",a,!0,{sourceMap:!1,shadowMode:!1})},"0c87":function(t,e,i){"use strict";var a=i("4ea4");i("99af"),i("4160"),i("c975"),i("a434"),i("d3b7"),i("ac1f"),i("25f0"),i("1276"),i("159b"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("96cf");var n=a(i("1da1")),r={data:function(){return{albumList:[],albumId:0,picList:[],mescroll:null,number:9,selectedImg:[],index:0}},onLoad:function(t){if(this.number=t.number||9,this.$util.checkToken("/pages/goods/album?number="+this.number)){var e=uni.getStorageSync("selectedAlbumImgTemp")?JSON.parse(uni.getStorageSync("selectedAlbumImgTemp")):null;e&&(e.list&&(this.selectedImg=e.list.split(",")),this.index=e.index)}},onShow:function(){var t=this;return(0,n.default)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.getAlbumList();case 2:case"end":return e.stop()}}),e)})))()},methods:{getAlbumList:function(){var t=this;return(0,n.default)(regeneratorRuntime.mark((function e(){var i;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.$api.sendRequest({url:"/shopapi/album/lists",async:!1,success:function(t){}});case 2:i=e.sent,i.data&&(t.albumList=i.data,t.albumList.length>0&&(t.albumId=t.albumList[0].album_id),t.mescroll&&t.mescroll.resetUpScroll());case 4:case"end":return e.stop()}}),e)})))()},getData:function(t){var e=this;this.mescroll=t,0!=this.albumId&&this.$api.sendRequest({url:"/shopapi/album/picList",data:{page_size:t.size,page:t.num,album_id:this.albumId},success:function(i){var a=[],n=i.message;0==i.code&&i.data?a=i.data.list:e.$util.showToast({title:n}),t.endSuccess(a.length),1==t.num&&(e.picList=[]),e.picList=e.picList.concat(a),e.$refs.loadingCover&&e.$refs.loadingCover.hide()}})},changeAlbum:function(t){this.albumId=t,this.mescroll&&this.mescroll.resetUpScroll()},photograph:function(){var t=this;this.$util.upload({number:this.number,path:"album",sourceType:["camera"],album_id:this.albumId},(function(e){t.mescroll&&t.mescroll.resetUpScroll()}))},checkImg:function(t,e){var i=this.selectedImg.indexOf(t);if(-1==i){if(this.selectedImg.length+1>this.number)return;this.selectedImg.push(t)}else this.selectedImg.splice(i,1)},isSelected:function(t){return this.selectedImg.indexOf(t)>-1},getImgIndex:function(t){var e=this.selectedImg.indexOf(t);return e>-1?e+1:""},previewImg:function(t){var e=this,i=this.selectedImg.indexOf(t),a=[];i>-1?this.selectedImg.forEach((function(t){a.push(e.$util.img(t))})):a=[this.$util.img(t)],uni.previewImage({current:0,urls:a})},imgError:function(t){},save:function(){var t={list:this.selectedImg.toString(),index:this.index};uni.setStorageSync("selectedAlbumImg",JSON.stringify(t)),uni.navigateBack({delta:1})}}};e.default=r},"3ecb":function(t,e,i){"use strict";var a=i("04a7"),n=i.n(a);n.a},"674c":function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,".pic-wrap[data-v-97958712] .mescroll-uni-fixed{top:auto;bottom:auto;left:auto;right:auto;bottom:%?100?%; /* !important*/width:75%}",""]),t.exports=e},9754:function(t,e,i){"use strict";i.r(e);var a=i("0c87"),n=i.n(a);for(var r in a)"default"!==r&&function(t){i.d(e,t,(function(){return a[t]}))}(r);e["default"]=n.a},"9b94":function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return r})),i.d(e,"a",(function(){return a}));var a={loadingCover:i("8f54").default},n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("v-uni-view",{staticClass:"album-wrap"},[i("v-uni-scroll-view",{staticClass:"group-wrap",attrs:{"scroll-y":"true"}},t._l(t.albumList,(function(e,a){return i("v-uni-view",{key:a,staticClass:"item",class:{selected:e.album_id==t.albumId},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.changeAlbum(e.album_id)}}},[i("v-uni-text",{class:{"color-base-border":e.album_id==t.albumId}},[t._v(t._s(e.album_name))])],1)})),1),i("v-uni-view",{staticClass:"pic-wrap"},[i("mescroll-uni",{ref:"mescroll",attrs:{size:"30"},on:{getData:function(e){arguments[0]=e=t.$handleEvent(e),t.getData.apply(void 0,arguments)}}},[i("template",{attrs:{slot:"list"},slot:"list"},[i("v-uni-view",{staticClass:"list-wrap"},[i("v-uni-view",{staticClass:"item-wrap upload",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.photograph()}}},[i("v-uni-text",{staticClass:"iconfont iconxiangji"}),i("v-uni-text",{staticClass:"txt"},[t._v("拍摄照片")])],1),t._l(t.picList,(function(e,a){return i("v-uni-view",{key:a,staticClass:"item-wrap",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.previewImg(e.pic_path)}}},[i("v-uni-image",{attrs:{src:t.$util.img(e.pic_path,{size:"mid"}),mode:"scaleToFill"},on:{error:function(e){arguments[0]=e=t.$handleEvent(e),t.imgError(a)}}}),i("v-uni-view",{staticClass:"circle",class:{"selected color-base-bg":t.isSelected(e.pic_path)},on:{click:function(i){i.stopPropagation(),arguments[0]=i=t.$handleEvent(i),t.checkImg(e.pic_path,a)}}},[t._v(t._s(t.getImgIndex(e.pic_path)))]),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isSelected(e.pic_path),expression:"isSelected(item.pic_path)"}],staticClass:"mask-layer"})],1)}))],2)],1)],2)],1)],1),i("v-uni-view",{staticClass:"footer-wrap"},[i("v-uni-button",{attrs:{type:"primary",disabled:t.selectedImg.length==t.number,size:"mini"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.save()}}},[t._v("确定"+t._s(t.selectedImg.length?"（"+t.selectedImg.length+"）":""))])],1),i("loading-cover",{ref:"loadingCover"})],1)},r=[]},"9dff":function(t,e,i){"use strict";i.r(e);var a=i("9b94"),n=i("9754");for(var r in n)"default"!==r&&function(t){i.d(e,t,(function(){return n[t]}))}(r);i("cd2f"),i("3ecb");var s,o=i("f0c5"),l=Object(o["a"])(n["default"],a["b"],a["c"],!1,null,"97958712",null,!1,a["a"],s);e["default"]=l.exports},b50a:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n * 建议使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n */.uni-line-hide[data-v-97958712]{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}.uni-using-hide[data-v-97958712]{overflow:hidden;width:100%;text-overflow:ellipsis;white-space:nowrap}.prevent-head-roll[data-v-97958712]{position:fixed;left:0;right:0;z-index:998}uni-page-body[data-v-97958712]{overflow:hidden}.album-wrap[data-v-97958712]{display:-webkit-box;display:-webkit-flex;display:flex}.album-wrap .group-wrap[data-v-97958712]{width:25%;height:93vh;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.album-wrap .group-wrap .item[data-v-97958712]{padding:%?20?% %?20?% %?20?% 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.album-wrap .group-wrap .item uni-text[data-v-97958712]{padding:0 %?20?%;border-left:%?4?% solid transparent}.album-wrap .group-wrap .item.selected[data-v-97958712]{background-color:#fff}.album-wrap .pic-wrap[data-v-97958712]{-webkit-box-flex:1;-webkit-flex:1;flex:1}.album-wrap .pic-wrap .list-wrap[data-v-97958712]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;align-items:center;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.album-wrap .pic-wrap .list-wrap .item-wrap[data-v-97958712]{position:relative;width:32.5%;height:%?170?%;margin-right:%?4?%;margin-bottom:%?4?%;line-height:normal;text-align:center}.album-wrap .pic-wrap .list-wrap .item-wrap uni-image[data-v-97958712]{width:%?170?%;height:%?170?%}.album-wrap .pic-wrap .list-wrap .item-wrap .mask-layer[data-v-97958712]{background-color:rgba(0,0,0,.4);position:absolute;z-index:10;top:0;left:0;right:0;bottom:0}.album-wrap .pic-wrap .list-wrap .item-wrap .circle[data-v-97958712]{border:%?2?% solid #fff;position:absolute;z-index:20;border-radius:50%;width:%?40?%;height:%?40?%;background-color:rgba(0,0,0,.2);top:%?10?%;right:%?10?%;text-align:center;line-height:%?40?%;color:#fff}.album-wrap .pic-wrap .list-wrap .item-wrap .circle.selected[data-v-97958712]{border-color:transparent}.album-wrap .pic-wrap .list-wrap .item-wrap.upload[data-v-97958712]{background-color:#f2f2f2;color:#909399;line-height:inherit}.album-wrap .pic-wrap .list-wrap .item-wrap.upload .iconfont[data-v-97958712]{font-size:%?60?%;display:block;text-align:center}.album-wrap .pic-wrap .list-wrap .item-wrap.upload .txt[data-v-97958712]{display:block;text-align:center;font-size:%?24?%}.footer-wrap[data-v-97958712]{position:fixed;bottom:0;right:0;padding:%?20?% %?30?% 0;z-index:10;background-color:#fff;width:100%;text-align:right;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}',""]),t.exports=e},cd2f:function(t,e,i){"use strict";var a=i("fa30"),n=i.n(a);n.a},fa30:function(t,e,i){var a=i("b50a");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("42956564",a,!0,{sourceMap:!1,shadowMode:!1})}}]);