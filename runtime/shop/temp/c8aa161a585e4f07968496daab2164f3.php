<?php /*a:1:{s:54:"./addon/wholesale/component/view/wholesale/design.html";i:1614519344;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-wholesale">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ backgroundColor : nc.backgroundColor, margin: nc.marginTop + 'px 15px 0' }">
			<div class="marketing-wrap">
				<img v-if="nc.bgSelect == 'red'" src="<?php echo htmlentities($resource_path); ?>/wholesale/img/red.png" />
				<img v-if="nc.bgSelect == 'blue'" src="<?php echo htmlentities($resource_path); ?>/wholesale/img/blue.png" />
				<img v-if="nc.bgSelect == 'yellow'" src="<?php echo htmlentities($resource_path); ?>/wholesale/img/yellow.png" />
				<img v-if="nc.bgSelect == 'violet'" src="<?php echo htmlentities($resource_path); ?>/wholesale/img/violet.png" />
				
				<div class="marketing-box">
					<template v-if="nc.lazyLoad">
						<wholesale-top-content></wholesale-top-content>
					</template>
					
					<div class="list-wrap">
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-num">已售5件</div>
								<div class="content-price">
									批发价¥<span>99.00</span>
								</div>
							</div>
						</div>
						
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-num">已售5件</div>
								<div class="content-price">
									批发价¥<span>99.00</span>
								</div>
							</div>
						</div>
						
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-num">已售15件</div>
								<div class="content-price">
									批发价¥<span>99.00</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- <template v-if="nc.lazyLoad">
				<wholesale-top-content></wholesale-top-content>
			</template>
			
			<div class="list-wrap">
				<div class="item">
					<div class="img-wrap">
						<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
					</div>
					<div class="content">
						<div class="content-desc">商品名称</div>
						<div class="order-num">
							<span class="ns-red-color">2人团</span>
							<span class="ns-red-color">已成团3件</span>
						</div>
						<div class="content-operation">
							<div class="price">
								<span>¥3000.00</span>
								<span class="ns-red-color">¥2500.00</span>
							</div>
							<button>去拼团</button>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="img-wrap">
						<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
					</div>
					<div class="content">
						<div class="content-desc">商品名称</div>
						<div class="order-num">
							<span class="ns-red-color">2人团</span>
							<span class="ns-red-color">已成团3件</span>
						</div>
						<div class="content-operation">
							<div class="price">
								<span>¥3000.00</span>
								<span class="ns-red-color">¥2500.00</span>
							</div>
							<button>去拼团</button>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="img-wrap">
						<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
					</div>
					<div class="content">
						<div class="content-desc">商品名称</div>
						<div class="order-num">
							<span class="ns-red-color">2人团</span>
							<span class="ns-red-color">已成团3件</span>
						</div>
						<div class="content-operation">
							<div class="price">
								<span>¥3000.00</span>
								<span class="ns-red-color">¥2500.00</span>
							</div>
							<button>去拼团</button>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<template v-if="nc.lazyLoad">
			<wholesale-list></wholesale-list>
			<wholesale-style></wholesale-style>
		</template>
		
		<!-- <color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color> -->
		<template v-if="nc.lazyLoad">
			<wholesale-color></wholesale-color>
			<change-type></change-type>
		</template>
		
		<div class="template-edit-title">
			<h3>顶部标题设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<template v-if="nc.lazyLoad">
			<wholesale-top-list></wholesale-top-list>
		</template>
		
		<div class="template-edit-title">
			<h3>其他设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<template v-if="nc.lazyLoad">
			<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		</template>

		<!-- 弹框 -->
		<div class="wholesale-list-style">
			<div class="style-list-wholesale layui-form">
				<div class="style-list-con-wholesale">
					<div class="style-li-wholesale" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/wholesale/img/wholesale_style_1.png" />
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
			var wholesaleResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/wholesale/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/wholesale/js/design.js"></js>

	</template>

</nc-component>