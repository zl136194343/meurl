<?php /*a:1:{s:39:"./app/component/view/search/design.html";i:1614516082;}*/ ?>
<nc-component v-bind:data="data[index]" class="top-search" :style="{backgroundColor: nc.backgroundColor}">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{background: nc.backgroundColor}">
			<div class="top-search-form">
				<input name="d_elem" type="hidden" value="" ref="d_elem" />
				<div class="logo" v-if="nc.searchType == 2" :style="{backgroundImage:'url('+changeImgUrl(nc.searchImg)+')'}">
				</div>
				<div class="coordinate" v-if="nc.searchType == 3" :style="{backgroundImage:'url('+changeImgUrl(nc.searchImg)+')'}">
					<span class="iconfont iconzuobiao"></span>全国
				</div>
				<div class="top-search-box" v-bind:class="{'border-circle': nc.borderType == 2}" v-bind:style="{background: nc.bgColor, textAlign: nc.textAlign}">
					<span class="top-search-intro" v-bind:style="{color: nc.textColor?nc.textColor:'rgba(0,0,0,0)'}">{{ nc.title }}</span>
					<span class="top-search-icon"><i class="iconfont iconsousuo" v-bind:style="{color: nc.textColor?nc.textColor:'rgba(0,0,0,0)'}"></i></span>
				</div>
			</div>
		</div>
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<div class="layui-form-item">
			<label class="layui-form-label sm">文本名</label>
			<div class="layui-input-block">
				<input type="text" v-model="nc.title" v-bind:id="'title_'+index" placeholder="请输入搜索内容" class="layui-input">
			</div>
		</div>
		<template v-if="nc.lazyLoad">
			<!-- <top-search></top-search> -->
			<search-type></search-type>
			<!-- <search-style></search-style> -->
		</template>
		<div class="search_h3">
			<h3 class="ns-margin-left">搜索样式</h3>
			<span class="layui-nav-more"></span>
		</div>
		<div class="line"></div>
		<color class="ns-margin-top" v-bind:data="{ 'defaultcolor': '#999999' }"></color>
		<color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>
		<color v-bind:data="{ field : 'bgColor', 'label' : '框体颜色' }"></color>

		<template v-if="nc.lazyLoad">
			<!-- <top-search></top-search> -->
			<goods-search></goods-search>
			<search-border></search-border>
		</template>
	
	</template>
	
	<!-- 资源 -->
	<template slot="resource">

		<js>
			var searchResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/search/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/search/js/design.js"></js>
		
	</template>

</nc-component>