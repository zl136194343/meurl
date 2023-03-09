<?php /*a:1:{s:42:"./app/component/view/float_btn/design.html";i:1614518450;}*/ ?>
<nc-component v-bind:data="data[index]" class="float-btn right_bottom" data-disabled="1" v-if="nc.bottomPosition == 1 || nc.bottomPosition == 2" :style="{top:(parseInt(nc.baseBtnBottom)+parseInt(nc.btnBottom))+'px !important'}">
	
	<!-- 预览 -->
	<template slot="preview" >
		<div class="mask" data-disabled="1">
		<div class="float-btn-box" data-disabled="1">
<!--			v-bind:style="{ backgroundColor : nc.backgroundColor }"-->
			<a v-for="(item, index) in nc.list" href="javascript:;" class="float-btn-item" data-disabled="1">
				<div class="img-box" data-disabled="1">
					<img v-bind:src="changeImgUrl(item.imageUrl)" alt="" data-disabled="1">
				</div>
<!--				<span v-bind:style="{color: nc.textColor}">{{item.title}}</span>-->
			</a>
		</div>
		</div>

	</template>
	
	<!-- 编辑 -->
	<template slot="edit">
<!--		<color v-bind:data="{ field : 'textColor', 'label' : '文字颜色' }"></color>-->
<!--		<color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>-->
		<template v-if="nc.lazyLoad">
			<float-btn-list ref="float_btn"></float-btn-list>
			<btn-position></btn-position>
		    <slide v-bind:data="{ field : 'btnBottom', label : '上下偏移' }"></slide>
		</template>
	</template>
	
	<!-- 资源 -->
	<template slot="resource">
		<js>
			var floatBtnResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/float_btn/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/float_btn/js/design.js"></js>
	</template>

</nc-component>
<nc-component v-bind:data="data[index]" class="float-btn right_bottom" data-disabled="1" v-else-if="nc.bottomPosition == 3 || nc.bottomPosition == 4" :style="{bottom:(parseInt(nc.baseBtnBottom)  + parseInt(nc.btnBottom))+'px !important'}">
	
	<!-- 预览 -->
	<template slot="preview" >
		<div class="mask" data-disabled="1">
		<div class="float-btn-box" data-disabled="1">
<!--			v-bind:style="{ backgroundColor : nc.backgroundColor }"-->
			<a v-for="(item, index) in nc.list" href="javascript:;" class="float-btn-item" data-disabled="1">
				<div class="img-box" data-disabled="1">
					<img v-bind:src="changeImgUrl(item.imageUrl)" alt="" data-disabled="1">
				</div>
<!--				<span v-bind:style="{color: nc.textColor}">{{item.title}}</span>-->
			</a>
		</div>
		</div>

	</template>
	
	<!-- 编辑 -->
	<template slot="edit">
<!--		<color v-bind:data="{ field : 'textColor', 'label' : '文字颜色' }"></color>-->
<!--		<color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>-->
		<template v-if="nc.lazyLoad">
			<float-btn-list ref="float_btn"></float-btn-list>
			<btn-position></btn-position>
		    <slide v-bind:data="{ field : 'btnBottom', label : '上下偏移' }"></slide>
		</template>
	</template>
	
	<!-- 资源 -->
	<template slot="resource">

		<js>
			var floatBtnResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/float_btn/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/float_btn/js/design.js"></js>
	</template>

</nc-component>