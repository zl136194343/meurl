<?php /*a:1:{s:43:"./app/component/view/shop_store/design.html";i:1614516088;}*/ ?>
<nc-component v-bind:data="data[index]" class="shop-store">

	<!-- 预览 -->
	<template slot="preview">
		<div>
			<div class="img-wrap">
				<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png">
			</div>
			
			<div class="info-wrap">
				<h4>门店名称</h4>
				<img src="<?php echo htmlentities($resource_path); ?>/shop_store/img/phone.png" class="phone">
				<p>
					<img src="<?php echo htmlentities($resource_path); ?>/shop_store/img/address.png">
					<span class="ns-text-color-gray">门店地址</span>
				</p>
				<span class="open-time ns-text-color-gray">营业时间：7:00-23:00</span>
			</div>
		</div>
		<div>
			<div class="img-wrap">
				<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png">
			</div>
			
			<div class="info-wrap">
				<h4>门店名称</h4>
				<img src="<?php echo htmlentities($resource_path); ?>/shop_store/img/phone.png" class="phone">
				<p>
					<img src="<?php echo htmlentities($resource_path); ?>/shop_store/img/address.png">
					<span class="ns-text-color-gray">门店地址</span>
				</p>
				<span class="open-time ns-text-color-gray">营业时间：7:00-23:00</span>
			</div>
		</div>
		<div>
			<div class="img-wrap">
				<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png">
			</div>
			
			<div class="info-wrap">
				<h4>门店名称</h4>
				<img src="<?php echo htmlentities($resource_path); ?>/shop_store/img/phone.png" class="phone">
				<p>
					<img src="<?php echo htmlentities($resource_path); ?>/shop_store/img/address.png">
					<span class="ns-text-color-gray">门店地址</span>
				</p>
				<span class="open-time ns-text-color-gray">营业时间：7:00-23:00</span>
			</div>
		</div>
		

	</template>

	<!-- 编辑 -->
	<template slot="edit">
		
		<!--<template v-if="nc.lazyLoad">-->
			<!--<shop-store-empty></shop-store-empty>-->
		<!--</template>-->
	
	</template>
	
	<!-- 资源 -->
	<template slot="resource">

		<css src="<?php echo htmlentities($resource_path); ?>/shop_store/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/shop_store/js/design.js"></js>
		
	</template>

</nc-component>