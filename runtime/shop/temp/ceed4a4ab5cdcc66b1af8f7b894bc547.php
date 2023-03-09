<?php /*a:1:{s:42:"./app/component/view/shop_info/design.html";i:1614516084;}*/ ?>
<nc-component v-bind:data="data[index]" class="shop-info">

	<!-- 预览 -->
	<template slot="preview">
		<div class="shop_base_info">
			<div class="img-wrap">
				<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png"/>
			</div>
			<div class="info-wrap">
				<h4 class="name" v-bind:style="{ color : nc.color }">店铺名称</h4>
				<p class="score">综合评分：5&nbsp;&nbsp;粉丝数：996</p>
			</div>

			<div class="operation ns-bg-color">关注</div>
		</div>
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<color v-bind:data="{ field : 'color' }"></color>
	</template>

	<!-- 资源 -->
	<template slot="resource">

		<css src="<?php echo htmlentities($resource_path); ?>/shop_info/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/shop_info/js/design.js"></js>

	</template>

</nc-component>