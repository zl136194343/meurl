<?php /*a:1:{s:50:"./addon/bargain/component/view/bargain/design.html";i:1614520246;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-bargain" v-bind:style="{ backgroundColor : nc.backgroundColor }">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ margin: nc.marginTop + 'px 15px 0' }">
			<div class="marketing-wrap">
				<img v-if="nc.bgSelect == 'red'" src="<?php echo htmlentities($resource_path); ?>/bargain/img/red.png" />
				<img v-if="nc.bgSelect == 'blue'" src="<?php echo htmlentities($resource_path); ?>/bargain/img/blue.png" />
				<img v-if="nc.bgSelect == 'yellow'" src="<?php echo htmlentities($resource_path); ?>/bargain/img/yellow.png" />
				<img v-if="nc.bgSelect == 'violet'" src="<?php echo htmlentities($resource_path); ?>/bargain/img/violet.png" />
			
				<div class="marketing-box">
					<template v-if="nc.lazyLoad">
						<bargain-top-content></bargain-top-content>
					</template>
			
					<div class="list-wrap">
						<div class="item">
							<div class="img-wrap">
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									<div class="price">
										￥<span>3000.00</span>
										<!-- <span>底价：<span class="ns-red-color">¥2500.00</span></span> -->
									</div>
									<div class="content-num">已砍299件</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="img-wrap">
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									<div class="price">
										￥<span>3000.00</span>
										<!-- <span>底价：<span class="ns-red-color">¥2500.00</span></span> -->
									</div>
									<div class="content-num">已砍299件</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="img-wrap">
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									<div class="price">
										￥<span>3000.00</span>
										<!-- <span>底价：<span class="ns-red-color">¥2500.00</span></span> -->
									</div>
									<div class="content-num">已砍299件</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<!-- 编辑 -->
	<template slot="edit">
			<template v-if="nc.lazyLoad">
				<bargain-list></bargain-list>
				<bargain-style></bargain-style>
			</template>
			
			<template v-if="nc.lazyLoad">
				<bargin-color></bargin-color>
				<bargain-change-type></bargain-change-type>
			</template>
			
			<div class="template-edit-title">
				<h3>顶部标题设置</h3>
				<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
			</div>
			<div class="template-edit-wrap">
				<template v-if="nc.lazyLoad">
					<bargain-top-list></bargain-top-list>
				</template>
			</div>
			
			<div class="template-edit-title">
				<h3>其他设置</h3>
				<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
			</div>
			<div class="template-edit-wrap">
				<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
			</div>
			
			<!-- <color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>
			<slide v-bind:data="{ field : 'padding', label : '上下边距' }"></slide> -->
			
			<!-- <h3>顶部标题设置</h3>
			<template v-if="nc.lazyLoad">
				<bargain-top-list></bargain-top-list>
			</template> -->

			<!-- 弹框 -->
			<div class="bargain-list-style">
				<div class="style-list-bargain layui-form">
					<div class="style-list-con-bargain">
						<div class="style-li-bargain" v-bind:class="{'selected ns-border-color': nc.style == 1}">
							<img src="<?php echo htmlentities($resource_path); ?>/bargain/img/bargain_style_1.png" />
							<span class="layui-hide">风格一</span>
						</div>
					</div>
					
					<input type="hidden" name="style">
					<input type="hidden" name="style_name" />
				</div>
			</div>
	</template>

	<!-- 资源 -->
	<template slot="resource">
		<js>
			var bargainResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/bargain/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/bargain/js/design.js"></js>

	</template>

</nc-component>