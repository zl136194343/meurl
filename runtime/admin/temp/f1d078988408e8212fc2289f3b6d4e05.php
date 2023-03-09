<?php /*a:1:{s:62:"./addon/platformcoupon/component/view/admin_coupon/design.html";i:1614519868;}*/ ?>
<nc-component v-bind:data="data[index]"  class="coupon-wrap" v-bind:style="{backgroundColor: nc.backgroundColor}">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ backgroundColor : nc.backgroundColor, margin: nc.marginTop + 'px 15px 0' }">
			<div class="coupon-preview">
				<div class="coupon-box coupon-box-1" v-if="nc.style == 1">
					<div class="coupon-box-list">
						<div class="coupon">
							<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style1-bg.png">
							<div class="coupon-intro">
								<p class="coupon-price">￥<span>500</span></p>
								<p class="coupon-desc">满3000可用</p>
							</div>
							<div class="coupon-btn">立即领取</div>
						</div>

						<div class="coupon">
							<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style1-bg.png">
							<div class="coupon-intro">
								<p class="coupon-price">￥<span>500</span></p>
								<p class="coupon-desc">满3000可用</p>
							</div>
							<div class="coupon-btn">立即领取</div>
						</div>

						<div class="coupon">
							<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style1-bg.png">
							<div class="coupon-intro">
								<p class="coupon-price">￥<span>500</span></p>
								<p class="coupon-desc">满3000可用</p>
							</div>
							<div class="coupon-btn">立即领取</div>
						</div>
					</div>
				</div>

				<div class="coupon-box" v-else-if="nc.style == 2">
					<div class="coupon">
						<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/coupon_bg.png">
						<div class="coupon-intro">
							<p class="coupon-price ns-red-color">￥<span>500.00</span></p>
							<p class="coupon-desc ns-red-color">满3000元可用</p>
						</div>
						<div class="coupon-btn ns-red-color">领取</div>
					</div>

					<div class="coupon">
						<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/coupon_bg.png">
						<div class="coupon-intro">
							<p class="coupon-price ns-red-color">￥<span>500.00</span></p>
							<p class="coupon-desc ns-red-color">满3000元可用</p>
						</div>
						<div class="coupon-btn ns-red-color">领取</div>
					</div>
				</div>

				<div class="coupon-box" v-bind:class="'coupon-box-'+ nc.style" v-if="nc.style == 3">
					<div class="coupon-block">
						<div class="coupon">
							<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style3-bg-2.png">
							<div class="coupon-intro">
								<p class="coupon-price ns-red-color">￥<span>500.00</span></p>
								<p class="coupon-desc ns-red-color">满3000元可用</p>
								<p class="coupon-info">指定商品可用</p>
							</div>
							<div class="coupon-btn">立即抢</div>
						</div>

						<div class="coupon">
							<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style3-bg-2.png">
							<div class="coupon-intro">
								<p class="coupon-price ns-red-color">￥<span>500.00</span></p>
								<p class="coupon-desc ns-red-color">满3000元可用</p>
								<p class="coupon-info">指定商品可用</p>
							</div>
							<div class="coupon-btn">立即抢</div>
						</div>

						<div class="coupon">
							<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style3-bg-2.png">
							<div class="coupon-intro">
								<p class="coupon-price ns-red-color">￥<span>500.00</span></p>
								<p class="coupon-desc ns-red-color">满3000元可用</p>
								<p class="coupon-info">指定商品可用</p>
							</div>
							<div class="coupon-btn">立即抢</div>
						</div>
					</div>
				</div>
			</div>
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<template v-if="nc.lazyLoad">
			<coupon-style></coupon-style>
			<coupon-list></coupon-list>
		</template>
		<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		<div class="coupon-list-style">
			<div class="style-list-coupon layui-form">
				<div class="style-list-con-coupon">
					<div class="style-li-coupon" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style1.png" />
						<span class="layui-hide">风格一</span>
					</div>

					<div class="style-li-coupon" v-bind:class="{'selected ns-border-color': nc.style == 2}">
						<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style2.png" />
						<span class="layui-hide">风格二</span>
					</div>

					<div class="style-li-coupon" v-bind:class="{'selected ns-border-color': nc.style == 3}">
						<img src="<?php echo htmlentities($resource_path); ?>/admin_coupon/img/style3.png" />
						<span class="layui-hide">风格三</span>
					</div>
				</div>

				<input type="hidden" name="style">
				<input type="hidden" name="style_name">
			</div>
		</div>

	</template>

	<!-- 资源 -->
	<template slot="resource">
		<js>
			var couponResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/admin_coupon/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/admin_coupon/js/design.js"></js>

	</template>

</nc-component>