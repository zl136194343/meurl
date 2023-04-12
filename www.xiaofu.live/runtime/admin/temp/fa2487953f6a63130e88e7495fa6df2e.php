<?php /*a:1:{s:37:"./app/component/view/text/design.html";i:1671499736;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-title" v-bind:style="{ backgroundColor : nc.backgroundColor }">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{textAlign: nc.alignStyle, backgroundColor : nc.backgroundColor, margin : nc.marginTop + 'px 15px 0'}">
			<!-- 图一 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-if="nc.style == 1">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px' }">{{ nc.title }}</span>
					<span class="line-left" v-bind:style="{ background: nc.textColor }"></span>
					<span class="line-right" v-bind:style="{ background: nc.textColor }"></span>
				</div>
			</div>
			<!-- 图二 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 2">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px' }">{{ nc.title }}</span>
				</div>
				<div v-bind:class="'text-title-con'+ nc.style">
					<span class="inner-line" v-bind:style="{ background: nc.textColor }"></span>
					<span class="line-triangle" v-bind:style="{ borderColor: nc.textColor }"></span>
				</div>
			</div>
			<!-- 图三 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 3">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px' }">{{ nc.title }}</span>
				</div>
				<div v-bind:class="'text-title-con'+ nc.style">
					<span class="inner-line" v-bind:style="{ background: nc.textColor }"></span>
					<span class="line-short" v-bind:style="{ background: nc.textColor }"></span>
				</div>
			</div>
			<!-- 图四 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 4">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px' }">{{ nc.title }}</span>
				</div>
				<div class="text-title-line">
					<span class="line-left" v-bind:style="{ background: nc.textColor }"></span>
					<span class="line-center" v-bind:style="{ borderColor: nc.textColor }"></span>
					<span class="line-right" v-bind:style="{ background: nc.textColor }"></span>
				</div>
			</div>
			<!-- 图五 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 5">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-block" v-bind:style="{ borderColor: nc.textColor }">
						<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px', borderColor: nc.textColor }">{{ nc.title }}</span>
						<span class="line-left" v-bind:style="{ background: nc.textColor }"></span>
						<span class="line-right" v-bind:style="{ background: nc.textColor }"></span>
					</span>
				</div>
			</div>
			<!-- 图六 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 6">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-outer" v-bind:style="{ borderColor: nc.textColor }">
						<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px', borderColor: nc.textColor, background: '#fff' }">{{ nc.title }}</span>
						<span class="text-title-con-2" v-bind:style="{ borderColor: nc.textColor }"></span>
					</span>
				</div>
			</div>
			<!-- 图七 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 7">
				<div class="text-title-box" v-show="nc.title">
					<span class="text-title-outer" v-bind:style="{ borderColor: nc.textColor }">
						<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : '#fff', paddingBottom: 3+'px', borderColor: nc.textColor, background: nc.textColor }">{{ nc.title }}</span>
						<span class="text-title-con-2" v-bind:style="{ borderColor: nc.textColor }"></span>
					</span>
				</div>
			</div>
			<!-- 图八 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 8" >
				<div class="text-title-box" v-show="nc.title" v-bind:style="{ textAlign: 'left'}">
					<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px' }">{{ nc.title }}</span>
					<span class="line-left" v-bind:style="{ height: nc.fontSize + 2 + 'px', background: nc.textColor}"></span>
				</div>
			</div>
			<!-- 图九 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 9" >
				<div class="text-title-box" v-show="nc.title">
					<div class="left"></div>
					<div class="center">
						<div><img src="<?php echo htmlentities($resource_path); ?>/text/img/style9-1.png" /></div>
						<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px', fontWeight: nc.fontWeight }">{{ nc.title }}</span>
						<div><img src="<?php echo htmlentities($resource_path); ?>/text/img/style9-2.png" /></div>
					</div>
					<div v-show="nc.isShowMore == 1" class="more" v-bind:style="{ color: nc.btnColor }">{{nc.moreText}} <i class="iconfont iconyoujiantou"></i></div>
				</div>
				<div class="text-subTitle-box" v-show="nc.subTitle">
					<p v-show="nc.subTitle" v-bind:style="{ fontSize : nc.fontSizeSub + 'px', color: nc.colorSub }">{{ nc.subTitle }}</p>
				</div>
			</div>
			
			<!-- 图十 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 10" >
				<div class="text-title-box" v-show="nc.title">
					<div class="left"></div>
					<div class="center">
						<div><img src="<?php echo htmlentities($resource_path); ?>/text/img/style10-1.png" /></div>
						<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px', fontWeight: nc.fontWeight }">{{ nc.title }}</span>
						<div><img src="<?php echo htmlentities($resource_path); ?>/text/img/style10-2.png" /></div>
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style10-3.png" />
					</div>
					<div v-show="nc.isShowMore == 1" class="more" v-bind:style="{ color: nc.btnColor }">{{nc.moreText}} <i class="iconfont iconyoujiantou"></i></div>
				</div>
				<div class="text-subTitle-box" v-show="nc.subTitle">
					<p v-show="nc.subTitle" v-bind:style="{ fontSize : nc.fontSizeSub + 'px', color: nc.colorSub }">{{ nc.subTitle }}</p>
				</div>
			</div>
			
			<!-- 图十一 -->
			<div class="text-title" v-bind:class="'text-title-'+ nc.style" v-else-if="nc.style == 11" >
				<div class="text-title-box" v-show="nc.title">
					<div class="left">
						<span class="text-title-con" v-bind:style="{ fontSize : nc.fontSize + 'px', color : nc.textColor, paddingBottom: 3+'px', fontWeight: nc.fontWeight }">{{ nc.title }}</span>
						<div class="text-subTitle-box" v-show="nc.subTitle">
							<p v-show="nc.subTitle" v-bind:style="{ fontSize : nc.fontSizeSub + 'px', color: nc.colorSub }">{{ nc.subTitle }}</p>
						</div>
					</div>
					<div v-show="nc.isShowMore == 1" class="more" v-bind:style="{ color: nc.textColor }"><span>{{nc.moreText}}</span> <i class="iconfont iconyoujiantou"></i></div>
					<img class="left-img" src="<?php echo htmlentities($resource_path); ?>/text/img/style11-1.png" />
					<img class="right-img" src="<?php echo htmlentities($resource_path); ?>/text/img/style11-2.png" />
				</div>
			</div>
		</div>
		<!-- <h2 v-show="nc.title" v-bind:style="{ textAlign :nc.textAlign, fontSize : nc.fontSize + 'px' ,color:nc.textColor,paddingTop:nc.padding+'px',paddingBottom:nc.padding+'px'}">{{ nc.title }}</h2>
		<p  v-show="nc.subTitle" v-bind:style="{ textAlign :nc.textAlign, fontSize : nc.fontSize-4 + 'px' }">{{ nc.subTitle }}</p> -->
		
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<template v-if="nc.lazyLoad">
			<text-style></text-style>
		</template>

		<!-- <h3 class="template-title">文本名</h3>
		<div class="layui-form-item ns-padding-left">
			<input type="text" v-model="nc.title" v-bind:id="'title_'+index" placeholder="请输入文本" class="layui-input">
		</div> -->
		<div class="layui-form-item">
			<label class="layui-form-label sm">文本名称</label>
			<div class="layui-input-block">
				<input type="text" v-model="nc.title" v-bind:id="'title_'+index" placeholder="请输入文本" class="layui-input">
			</div>
		</div>
		<nc-link v-bind:data="{ field : nc.link }"></nc-link>

		<div class="template-edit-title">
			<h3>文字显示样式</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<!-- <font-size v-bind:data="{ value : nc.fontSize }"></font-size> -->
			<!-- <slide v-bind:data="{ field : 'fontSize', label : '文字大小', max: 30, min: 12 }"></slide> -->
			<!-- <text-align></text-align> -->
			<template v-if="nc.lazyLoad">
				<text-font-size v-bind:data="{ field : 'fontSize', label : '文字大小', max: 16 }"></text-font-size>
				<color v-bind:data="{ field : 'textColor', 'label' : '文本颜色', 'defaultcolor': '#333333' }"></color>
				<font-weight v-show="nc.sub == 1"></font-weight>
				<!-- <text-align-style></text-align-style> -->
			</template>
		</div>
		<div v-show="nc.sub == 1">
			<div class="template-edit-title">
				<h3>副标题</h3>
				<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
			</div>

			<div class="template-edit-wrap">
				<div class="layui-form-item">
					<label class="layui-form-label sm">标题文字</label>
					<div class="layui-input-block">
						<input type="text" v-model="nc.subTitle" v-bind:id="'subTitle_'+index" placeholder="请输入标题文字" class="layui-input">
					</div>
				</div>
				<!-- <font-size v-bind:data="{ field : 'fontSizeSub', 'label' : '文字大小' }"></font-size> -->
				<template v-if="nc.lazyLoad">
					<text-font-size v-bind:data="{ field : 'fontSizeSub', label : '文字大小', max: 14 }"></text-font-size>
				</template>
				<!-- <slide v-bind:data="{ field : 'fontSize', label : '文字大小', max: 30, min: 12 }"></slide> -->
				<color v-bind:data="{ field : 'colorSub', 'label' : '文字颜色', 'defaultcolor': '#999' }"></color>
			</div>
		</div>

		<!-- “更多”按钮设置 -->
		<div v-show="nc.sub == 1">
			<div class="template-edit-title">
				<h3>“更多”按钮设置</h3>
				<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
			</div>

			<div class="template-edit-wrap">
				<template v-if="nc.lazyLoad">
					<text-more-btn></text-more-btn>
				</template>
				<div class="layui-form-item">
					<label class="layui-form-label sm">按钮文字</label>
					<div class="layui-input-block">
						<input type="text" v-model="nc.moreText" v-bind:id="'moreText'+index" placeholder="查看更多 >" class="layui-input">
					</div>
				</div>
				<color v-bind:data="{ field : 'btnColor', 'label' : '文字颜色', 'defaultcolor': '#999' }"></color>
				<nc-link v-bind:data="{ field : nc.moreLink }"></nc-link>
			</div>
		</div>

		<div class="template-edit-title">
			<h3>其他设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>

		<div class="template-edit-wrap">
			<color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>
			<!-- <template v-if="nc.lazyLoad">
				<page-html></page-html>
			</template> -->
		</div>
		<template v-if="nc.lazyLoad">
			<text-empty></text-empty>
		</template>

		
		<div class="style-list-box">
			<div class="style-list layui-form">
				<div class="style-list-con">
					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style1.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 2}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style2.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 3}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style3.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 4}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style4.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 5}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style5.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 6}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style6.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 7}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style7.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 8}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style8.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 9}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="1" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style9.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 10}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="1" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style10.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 11}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="1" />
						<img src="<?php echo htmlentities($resource_path); ?>/text/img/style11.png" />
					</div>
				</div>

				<input type="hidden" name="style">
				<input type="hidden" name="sub" />
			</div>
		</div>
		</div>
	</template>
	
	<!-- 资源 -->
	<template slot="resource">
		<js>
			var textResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>

		<css src="<?php echo htmlentities($resource_path); ?>/text/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/text/js/design.js"></js>
		
	</template>
	
</nc-component>