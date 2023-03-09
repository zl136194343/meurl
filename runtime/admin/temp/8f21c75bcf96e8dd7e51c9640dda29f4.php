<?php /*a:1:{s:39:"./app/component/view/notice/design.html";i:1614516074;}*/ ?>
<nc-component v-bind:data="data[index]" v-bind:style="{ backgroundColor : nc.backgroundColor}" class="notice">

	<!-- 预览 -->
	<template slot="preview">
		<div class="preview-box" v-bind:style="{ backgroundColor : nc.backgroundColor, margin : nc.marginTop + 'px 15px 0' }">
			<!-- 图一 -->
			<div class="notice-box" v-bind:class="'notice-box-'+ nc.style" v-if="nc.style == 1">
				<div class="notice-con" v-for="(item, index) in nc.list" v-if="index < 1">
					<div class="notice-con-icon" v-if="index == 0"><img src="<?php echo htmlentities($resource_path); ?>/notice/img/ns-notice.png" /></div>
					<div class="notice-con-split"></div>
					<span class="notice-con-font" v-bind:style="{color: nc.textColor?nc.textColor:'rgba(0,0,0,0)'}">{{ item.title }}</span>
				</div>
			</div>

			<!-- 图二 -->
			<div class="notice-box" v-bind:class="'notice-box-'+ nc.style" v-if="nc.style == 2">
				<div class="notice-con" v-show="nc.title">
					<div class="notice-con-icon"><img src="<?php echo htmlentities($resource_path); ?>/notice/img/laba.png" /></div>
					<span class="notice-con-font" v-bind:style="">{{ nc.title }}</span>
				</div>
			</div>
			
			<!-- 图三 -->
			<div class="notice-box" v-bind:class="'notice-box-'+ nc.style" v-if="nc.style == 3">
				<div class="notice-con" v-show="nc.title">
					<div class="notice-con-icon">公告</div>
					<span class="notice-con-font" v-bind:style="">{{ nc.title }}</span>
				</div>
			</div>
		</div>
	</template>
	<!-- <template slot="preview" >
		
		<template v-if="nc.lazyLoad">
			<notice></notice>
		</template>
		
	</template> -->

	<!-- 编辑 -->
	<template slot="edit">
		<template v-if="nc.lazyLoad">
			<notice-style></notice-style>
			<notice-con></notice-con>
			<notice-edit></notice-edit>
		</template>
		<color v-show="nc.sources == 'diy'" v-bind:data="{ defaultcolor: '#333333' }"></color>
		<div class="template-edit-title">
			<h3>其他设置</h3>
		</div>
		<div class="template-edit-wrap">
			<!-- 所选风格字体大小、颜色可编辑 -->
			<!-- <font-size v-bind:data="{ value : nc.fontSize }" v-show="nc.isEdit == 2"></font-size> -->
			<color v-bind:data="{ field : 'backgroundColor', label : '背景颜色' }"></color>
			<slide v-bind:data="{ field : 'marginTop', label : '页面间距' }"></slide>
			<!-- <slide v-bind:data="{ field : 'paddingLeftRight', label : '左右边距' }"></slide> -->
		</div>
		<div class="style-list-box">
			<div class="style-list layui-form">
				<div class="style-list-con">
					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 1}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="1" />
						<span class="layui-hide">风格一</span>
						<img src="<?php echo htmlentities($resource_path); ?>/notice/img/style1.png" />
					</div>

					<!-- <div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 2}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/notice/img/style2.png" />
					</div>

					<div class="style-li" v-bind:class="{'selected ns-border-color': nc.style == 3}">
						<input type="hidden" v-bind:class="'style-li-'+ nc.style" value="0" />
						<img src="<?php echo htmlentities($resource_path); ?>/notice/img/style3.png" />
					</div> -->
				</div>

				<input type="hidden" name="style">
				<input type="hidden" name="isEdit">
				<input type="hidden" name="style_name" />
			</div>
		</div>
		<!-- 网站公告弹框 -->
		<div class="notice-list">
			<table class="layui-table" id="notice_list"></table>
			<div class="layui-form layui-border-box layui-table-view">
				<div class="layui-table-box">
					<div class="layui-table-header">
						<table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line" lay-size="lg">
							<thead>
								<tr>
									<th data-field="0" data-key="2-0-0" data-unresize="true" class=" layui-table-col-special">
										<div class="layui-table-cell laytable-cell-2-0-0">
											<span>公告标题</span>
										</div>
									</th>
									<th data-field="1" data-key="2-0-1" data-unresize="true" class=" layui-table-col-special">
										<div class="layui-table-cell laytable-cell-2-0-1">
											<span>创建时间</span>
										</div>
									</th>
									<th data-field="2" data-key="2-0-2" data-unresize="true" class=" layui-table-col-special">
										<div class="layui-table-cell laytable-cell-2-0-2">
											<span>操作</span>
										</div>
									</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="layui-table-body layui-table-main">
						<table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line" lay-size="lg">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</template>
	
	<!-- 资源 -->
	<template slot="resource">

		<js>
			var RESOURCEPATH = "<?php echo htmlentities($resource_path); ?>";
		</js>
		<css src="<?php echo htmlentities($resource_path); ?>/notice/css/design.css"></css>
		<js src="<?php echo htmlentities($resource_path); ?>/notice/js/design.js"></js>
		
	</template>

</nc-component>