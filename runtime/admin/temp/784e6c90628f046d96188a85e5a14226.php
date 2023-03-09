<?php /*a:1:{s:50:"./addon/seckill/component/view/seckill/design.html";i:1614519816;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-seckill">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ backgroundColor : nc.backgroundColor, margin: nc.marginTop + 'px 15px 0' }">
			<div class="marketing-wrap">
				<img v-if="nc.bgSelect == 'red'" src="<?php echo htmlentities($resource_path); ?>/seckill/img/red.png" />
				<img v-if="nc.bgSelect == 'blue'" src="<?php echo htmlentities($resource_path); ?>/seckill/img/blue.png" />
				<img v-if="nc.bgSelect == 'yellow'" src="<?php echo htmlentities($resource_path); ?>/seckill/img/yellow.png" />
				<img v-if="nc.bgSelect == 'violet'" src="<?php echo htmlentities($resource_path); ?>/seckill/img/violet.png" />
				
				<div class="seckill-list-preview marketing-box" v-bind:class="'text-title-'+ nc.style" v-if="nc.style == 1">
					
					<template v-if="nc.lazyLoad">
						<seckill-top-content></seckill-top-content>
					</template>
					
					<div class="seckill-time-list">
						<ul>
							<li class="selected">
								<p>12:00</p>
								<p>抢购中</p>
							</li>
							<li>
								<p>14:00</p>
								<p>敬请期待</p>
							</li>
							<li>
								<p>16:00</p>
								<p>敬请期待</p>
							</li>
							<li>
								<p>18:00</p>
								<p>敬请期待</p>
							</li>
							<li>
								<p>20:00</p>
								<p>敬请期待</p>
							</li>
						</ul>
					</div>
					
					<div class="list-wrap" v-if="nc.style==1">
						<div class="item">
							<div class="img-wrap">
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
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
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
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
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<div class="content">
								<div class="content-desc">商品名称</div>
								<div class="content-price">
									¥<span>99.00</span>
								</div>
								<div class="content-num">￥139.00</div>
							</div>
						</div>
						<!-- <div class="item">
							<div class="img-wrap">
								<img src="https://xyhl.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
							</div>
							<p class="good-name ns-line-hiding" v-show="nc.isShowGoodsName == 1">商品名称</p>
							<p class="good-desc ns-line-hiding" v-show="nc.isShowGoodsDesc == 1">商品描述</p>
							<span class="old-price" v-show="nc.isShowGoodsPrimary == 1">￥1200.00</span>
							<span class="new-price ns-red-color" v-show="nc.isShowGoodsPrice == 1">￥998.00</span>
							<span class="good-stock" v-show="nc.isShowGoodsStock == 1">仅剩1件</span>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<template v-if="nc.lazyLoad">
			<seckill-style></seckill-style>
			<seckill-color></seckill-color>
			<seckill-change-type></seckill-change-type>
		</template>
		
		<!-- <color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color> -->
		<!-- <slide v-bind:data="{ field : 'paddingLeftRight', label : '左右边距' }"></slide> -->
		
		<!-- <h3>显示内容</h3>
		<template v-if="nc.lazyLoad">
			<seckill-content></seckill-content>
		</template> -->
		
		<div class="template-edit-title">
			<h3>顶部标题设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<template v-if="nc.lazyLoad">
				<seckill-top-list></seckill-top-list>
			</template>
		</div>
		
		<div class="template-edit-title">
			<h3>其他设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		</div>
		

		<!-- 弹框 -->
		<div class="seckill-list-style">
			<div class="style-list-seckill layui-form">
				<div class="style-list-con-seckill">
					<div class="style-li-seckill" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/seckill/img/seckill_style_1.png" />
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
			var seckillResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<js src="<?php echo htmlentities($resource_path); ?>/seckill/js/design.js"></js>
		<css src="<?php echo htmlentities($resource_path); ?>/seckill/css/design.css"></css>

	</template>
	
</nc-component>