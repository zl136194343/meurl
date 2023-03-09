<?php /*a:1:{s:53:"./addon/fenxiao/component/view/goods_list/design.html";i:1614520044;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-fenxiao-goods" v-bind:style="{ backgroundColor : nc.backgroundColor }">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ padding: (nc.padding + 'px 0') }">
			<template v-if="nc.lazyLoad">
				<fenxiao-top-content></fenxiao-top-content>
			</template>

			<div class="fenxiao-goods-list" v-bind:class="'fenxiao-goods-list-'+ nc.style" v-if="nc.style == 1">
				<div class="list-wrap">
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<div class="font-wrap">
							<p class="ns-multi-line-hiding">商品名称</p>
							<div class="price-wrap">
								<p class="fenxiao-price"><span>佣</span>￥10.00</p>
								<p>￥998.00</p>
							</div>
							<div class="follow-wrap">已关注</div>
						</div>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<div class="font-wrap">
							<p class="ns-multi-line-hiding">商品名称</p>
							<div class="price-wrap">
								<p class="fenxiao-price"><span>佣</span>￥10.00</p>
								<p>￥998.00</p>
							</div>
							<div class="follow-wrap">关注</div>
						</div>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<div class="font-wrap">
							<p class="ns-multi-line-hiding">商品名称</p>
							<div class="price-wrap">
								<p class="fenxiao-price"><span>佣</span>￥10.00</p>
								<p>￥998.00</p>
							</div>
							<div class="follow-wrap">关注</div>
						</div>
					</div>
				</div>
			</div>

			<div class="fenxiao-goods-list" v-bind:class="'fenxiao-goods-list-'+ nc.style" v-if="nc.style == 2">
				<div class="list-wrap">
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<p class="good-name">商品名称</p>
						<p class="fenxiao-price"><span>佣</span>￥10.00</p>
						<p>￥998.00</p>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<p class="good-name">商品名称</p>
						<p class="fenxiao-price"><span>佣</span>￥10.00</p>
						<p>￥998.00</p>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<p class="good-name">商品名称</p>
						<p class="fenxiao-price"><span>佣</span>￥10.00</p>
						<p>￥998.00</p>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<p class="good-name">商品名称</p>
						<p class="fenxiao-price"><span>佣</span>￥10.00</p>
						<p>￥998.00</p>
					</div>
				</div>
			</div>

			<div class="fenxiao-goods-list" v-bind:class="'fenxiao-goods-list-'+ nc.style" v-if="nc.style == 3">
				<div class="list-wrap">
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<div class="font-wrap">
							<p class="ns-multi-line-hiding">商品名称</p>
							<div class="price-wrap">
								<p class="fenxiao-price"><span class="iconfont iconfenxiang4"></span><span>赚</span><span>￥10.00</span></p>
								<p>￥998.00</p>
								<p class="line-price">￥299.00</p>
							</div>
							<div class="follow-wrap">已关注</div>
						</div>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<div class="font-wrap">
							<p class="ns-multi-line-hiding">商品名称</p>
							<div class="price-wrap">
								<p class="fenxiao-price">
									<span class="iconfont iconfenxiang4"></span>
									<span>赚</span>￥10.00
								</p>
								<p>￥998.00</p>
								<p class="line-price">￥299.00</p>
							</div>
							<div class="follow-wrap">关注</div>
						</div>
					</div>
					<div class="item">
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/crack_figure.png" />
						</div>
						<div class="font-wrap">
							<p class="ns-multi-line-hiding">商品名称</p>
							<div class="price-wrap">
								<p class="fenxiao-price">
									<span class="iconfont iconfenxiang4"></span>
									<span>赚</span>￥10.00
								</p>
								<p class="line-price">￥299.00</p>
							</div>
							<div class="follow-wrap">关注</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<!-- 编辑 -->
	<template slot="edit">
		<template v-if="nc.lazyLoad">
			<fenxiao-style></fenxiao-style>
			<fenxiao-goods-list></fenxiao-goods-list>
		</template>

		<div class="template-edit-title"><h3>顶部标题设置</h3></div>
		<template v-if="nc.lazyLoad">
			<fenxiao-top-list></fenxiao-top-list>
		</template>

		<div class="template-edit-title"><h3>其他设置</h3></div>
		<color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>
		<slide v-bind:data="{ field : 'padding', label : '页面间距' }"></slide>

		<!-- 商品列表风格弹框 -->
		<div class="fenxiao-list-style">
			<div class="style-list-fenxiao layui-form">
				<div class="style-list-con-fenxiao">
					<div class="style-li-fenxiao" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/goods_list/img/style1.png" />
					</div>

					<div class="style-li-fenxiao" v-bind:class="{'selected ns-border-color': nc.style == 2}">
						<img src="<?php echo htmlentities($resource_path); ?>/goods_list/img/style2.png" />
					</div>

					<div class="style-li-fenxiao" v-bind:class="{'selected ns-border-color': nc.style == 3}">
						<img src="<?php echo htmlentities($resource_path); ?>/goods_list/img/style3.png" />
					</div>
				</div>
				<input type="hidden" name="style">
			</div>
		</div>

		<!-- 商品分类选择弹框 -->
		<div class="goods-category-layer">
			<?php if(!(empty($goods_category_list) || (($goods_category_list instanceof \think\Collection || $goods_category_list instanceof \think\Paginator ) && $goods_category_list->isEmpty()))): ?>
			<div class="category-head">分类名称</div>
			<div class="category-wrap">
				<?php if(is_array($goods_category_list) || $goods_category_list instanceof \think\Collection || $goods_category_list instanceof \think\Paginator): if( count($goods_category_list)==0 ) : echo "" ;else: foreach($goods_category_list as $key=>$vo): ?>
				<div class="category-item" data-id="<?php echo htmlentities($vo['category_id']); ?>"><?php echo htmlentities($vo['category_name']); ?></div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</template>

	<!-- 资源 -->
	<template slot="resource">
		<js>
			var fenxiaoResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/goods_list/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/goods_list/js/design.js"></js>

	</template>

</nc-component>