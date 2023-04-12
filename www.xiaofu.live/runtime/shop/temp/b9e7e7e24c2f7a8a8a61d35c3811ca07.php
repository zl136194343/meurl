<?php /*a:1:{s:52:"./addon/groupbuy/component/view/groupbuy/design.html";i:1614519986;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-groupbuy">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ margin: nc.marginTop + 'px 15px 0' }">
			<div class="marketing-wrap">
				<img v-if="nc.bgSelect == 'red'" src="<?php echo htmlentities($resource_path); ?>/groupbuy/img/red.png" />
				<img v-if="nc.bgSelect == 'blue'" src="<?php echo htmlentities($resource_path); ?>/groupbuy/img/blue.png" />
				<img v-if="nc.bgSelect == 'yellow'" src="<?php echo htmlentities($resource_path); ?>/groupbuy/img/yellow.png" />
				<img v-if="nc.bgSelect == 'violet'" src="<?php echo htmlentities($resource_path); ?>/groupbuy/img/violet.png" />
				
				<div class="marketing-box">
					<template v-if="nc.lazyLoad">
						<groupbuy-top-content></groupbuy-top-content>
					</template>
					
					<div class="list-wrap">
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
								<div class="content-num">￥139.00</div>
							</div>
						</div>
						
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
								<div class="content-num">￥139.00</div>
							</div>
						</div>
						
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
								<div class="content-num">￥139.00</div>
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
			<groupbuy-list></groupbuy-list>
			<groupbuy-style></groupbuy-style>
		</template>
		
		<!-- <color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color> -->
		<template v-if="nc.lazyLoad">
			<groupbuy-color></groupbuy-color>
			<groupbuy-change-type></groupbuy-change-type>
		</template>
		
		<div class="template-edit-title">
			<h3>顶部标题设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<template v-if="nc.lazyLoad">
				<groupbuy-top-list></groupbuy-top-list>
			</template>
		</div>
		
		<div class="template-edit-title">
			<h3>其他设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		</div>
		
		<!-- 商品列表风格弹框 -->
		<div class="groupbuy-list-style">
			<div class="style-list-groupbuy layui-form">
				<div class="style-list-con-groupbuy">
					<div class="style-li-groupbuy" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/groupbuy/img/style1.png" />
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
			var groupBuyResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/groupbuy/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/groupbuy/js/design.js"></js>
		
	</template>
	
</nc-component>