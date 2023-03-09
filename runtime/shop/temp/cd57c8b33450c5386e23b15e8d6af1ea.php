<?php /*a:1:{s:46:"./addon/notes/component/view/notes/design.html";i:1614520492;}*/ ?>
<nc-component v-bind:data="data[index]" class="component-notes">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ backgroundColor : nc.backgroundColor, margin: (nc.marginTop + 'px 15px 0')  }">
			<div class="notes-list-preview" v-bind:class="'text-title-'+ nc.style">
				<template v-if="nc.lazyLoad">
					<notes-top-content></notes-top-content>
				</template>
				
				<div class="list-wrap" v-if="nc.style==1">
					<div class="item">
						<div class="item-con">
							<p class="notes-title ns-multi-line-hiding">这里显示笔记标题最多显示2行</p>
							<div class="notes-highlights-list" v-show="nc.notesLabel == 1">
								<span class="ns-bg-color">亮点</span>
							</div>
							<div class="notes-intro">
								<span class="notes-label ns-text-color">#掌柜说#</span>
								<p>笔记内容介绍</p>
							</div>
						</div>
						<div class="img-wrap">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/default_img.png" />
						</div>
						<div class="item-con">
							<div class="notes-info">
								<div class="notes-num"><span v-show="nc.uploadTime == 1">2020-01-01</span></div>
								<div class="notes-num"><span v-show="nc.readNum == 1">阅读 1000</span></div>
								<!-- <div class="notes-num"><span v-show="nc.thumbsUpNum == 1"><img src="<?php echo htmlentities($resource_path); ?>/notes/img/thumbs_up.png" /><span>1000</span></span></div> -->
							</div>
						</div>
					</div>
					<div class="item">
						<div class="item-con">
							<p class="notes-title ns-multi-line-hiding">这里显示笔记标题最多显示2行</p>
							<div class="notes-highlights-list" v-show="nc.notesLabel == 1">
								<span class="ns-bg-color">亮点</span>
							</div>
							<div class="notes-intro">
								<span class="notes-label ns-text-color">#掌柜说#</span>
								<p>笔记内容介绍</p>
							</div>
						</div>
						<div class="img-wrap img-wrap-boxs">
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/default_img.png" />
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/default_img.png" />
							<img src="https://ls.chnssl.com/public/static/ext/diyview/img/default_img.png" />
						</div>
						<div class="item-con">
							<div class="notes-info">
								<div class="notes-num"><span v-show="nc.uploadTime == 1">2020-01-01</span></div>
								<div class="notes-num"><span v-show="nc.readNum == 1">阅读 1000</span></div>
								<!-- <div class="notes-num"><span v-show="nc.thumbsUpNum == 1"><img src="<?php echo htmlentities($resource_path); ?>/notes/img/thumbs_up.png" /><span>1000</span></span></div> -->
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
			<notes-style></notes-style>
		</template>
		
		<div class="template-edit-title">
			<h3>顶部标题设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<template v-if="nc.lazyLoad">
				<notes-top-list></notes-top-list>
			</template>
		</div>
		
		
		<div class="template-edit-title">
			<h3>显示内容</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<template v-if="nc.lazyLoad">
				<notes-content></notes-content>
			</template>
		</div>
		
		<!-- <h3>底部查看更多</h3>
		<template v-if="nc.lazyLoad">
			<notes-more></notes-more>
		</template> -->
		
		<div class="template-edit-title">
			<h3>其他设置</h3>
			<i class="layui-icon layui-icon-down" onclick="closeBox(this)"></i>
		</div>
		<div class="template-edit-wrap">
			<color v-bind:data="{ field : 'backgroundColor', 'label' : '背景颜色' }"></color>
			<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
		</div>

		<!-- 弹框 -->
		<div class="notes-list-style">
			<div class="style-list-notes layui-form">
				<div class="style-list-con-notes">
					<div class="style-li-notes" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<img src="<?php echo htmlentities($resource_path); ?>/notes/img/notes_style_1.png" />
						<span class="layui-hide">风格一</span>
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
			var notesResourcePath = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<js src="<?php echo htmlentities($resource_path); ?>/notes/js/design.js"></js>
		<css src="<?php echo htmlentities($resource_path); ?>/notes/css/design.css"></css>

	</template>
	
</nc-component>