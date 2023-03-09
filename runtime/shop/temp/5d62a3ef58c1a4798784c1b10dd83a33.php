<?php /*a:1:{s:49:"./addon/live/component/view/live_info/design.html";i:1614519966;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-live-info">
	
	<!-- 预览 -->
	<template slot="preview">

		<div class="live-wrap" v-bind:style="{margin: (nc.marginTop + 'px 15px 0')}">
			<div class="banner-wrap">
				<img src="<?php echo htmlentities($resource_path); ?>/live_info/img/live_default_banner.png">
				<div class="shade"></div>
				<div class="wrap">
					<div class="room-name">
						<span class="status-name"><img src="<?php echo htmlentities($resource_path); ?>/live_info/img/live_default_icon.png"/>直播中</span>	
						双十一活动，限时秒杀！
					</div>
				</div>
			</div>
			<div class="room-info" v-if="nc.isShowAnchorInfo || nc.isShowLiveGood">
				<template v-if="nc.isShowAnchorInfo">
					<img src="<?php echo htmlentities($resource_path); ?>/live_info/img/default_headimg.png" class="anchor-img">
					<span class="anchor-name">主播：主播昵称</span>
				</template>
				<template v-if="nc.isShowAnchorInfo && nc.isShowLiveGood">
					<span class="separate">|</span>
				</template>
				<template v-if="nc.isShowLiveGood">
					<span class="goods-text">直播商品：1</span>
				</template>
			</div>
		</div>

	</template>
	
	<!-- 编辑 -->
	<template slot="edit">
		<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		<!-- <div class="template-edit-title"><h3>显示内容</h3> <i onclick="closeBox(this)" class="layui-icon layui-icon-down"></i></div>
		<template v-if="nc.lazyLoad">
			<live-show-content></live-show-content>
		</template> -->
	</template>
	
	<!-- 资源 -->
	<template slot="resource">
		
		<css src="<?php echo htmlentities($resource_path); ?>/live_info/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/live_info/js/design.js"></js>
		
	</template>

</nc-component>