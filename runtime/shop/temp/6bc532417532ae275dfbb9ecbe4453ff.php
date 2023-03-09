<?php /*a:1:{s:50:"./addon/pintuan/component/view/pintuan/design.html";i:1614519888;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-pintuan">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ backgroundColor : nc.backgroundColor, margin: nc.marginTop + 'px 15px 0' }">
			<div class="marketing-wrap">
				<img v-if="nc.bgSelect == 'red'" src="<?php echo htmlentities($resource_path); ?>/pintuan/img/red.png" />
				<img v-if="nc.bgSelect == 'blue'" src="<?php echo htmlentities($resource_path); ?>/pintuan/img/blue.png" />
				<img v-if="nc.bgSelect == 'yellow'" src="<?php echo htmlentities($resource_path); ?>/pintuan/img/yellow.png" />
				<img v-if="nc.bgSelect == 'violet'" src="<?php echo htmlentities($resource_path); ?>/pintuan/img/violet.png" />
				
				<div class="marketing-box">
					<template v-if="nc.lazyLoad">
						<pintuan-top-content></pintuan-top-content>
					</template>
					
					<div class="list-wrap">
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-num">2人团</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
							</div>
						</div>
						
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-num">2人团</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
							</div>
						</div>
						
						<div class="item">
							<div class="img-wrap">
								<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-num">2人团</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- <template v-if="nc.lazyLoad">
				<pintuan-top-content></pintuan-top-content>
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
			<pintuan-list></pintuan-list>
			<pintuan-style></pintuan-style>
		</template>
		
		<!-- <color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color> -->
		<template v-if="nc.lazyLoad">
			<pintuan-color></pintuan-color>
			<change-type></change-type>
		</template>
		
		<div class="template-edit-title">
			<h3>顶部标题设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<template v-if="nc.lazyLoad">
			<pintuan-top-list></pintuan-top-list>
		</template>
		
		<div class="template-edit-title">
			<h3>其他设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<template v-if="nc.lazyLoad">
			<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		</template>

		<!-- 弹框 -->
		<div class="pintuan-list-style">
			<div class="style-list-pintuan layui-form">
				<div class="style-list-con-pintuan">
					<div class="style-li-pintuan" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/pintuan/img/pintuan_style_1.png" />
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
			var pintuanResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/pintuan/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/pintuan/js/design.js"></js>

	</template>

</nc-component>