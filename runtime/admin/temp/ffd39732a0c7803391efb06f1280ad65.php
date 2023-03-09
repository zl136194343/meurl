<?php /*a:2:{s:66:"/www/wwwroot/www.hunqin.com/app/admin/view/member/edit_member.html";i:1614515914;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($website['title']) && ($website['title'] !== '')?$website['title']:"婚业汇联管理系统")); ?></title>
	<meta name="keywords" content="<?php echo htmlentities((isset($website['keywords']) && ($website['keywords'] !== '')?$website['keywords']:'婚业汇联管理系统')); ?>">
	<meta name="description" content="<?php echo htmlentities((isset($website['desc']) && ($website['desc'] !== '')?$website['desc']:'描述')); ?>}">
	<link rel="icon" type="image/x-icon" href="https://xyhl.chnssl.com/public/static/img/bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/loading/msgbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/common.css" />
	<script src="https://xyhl.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://xyhl.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#4685FD';
		window.ns_url = {
			baseUrl: "https://xyhl.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://xyhl.chnssl.com/app/admin/view/public/img/"
		};

	</script>
	<script src="https://xyhl.chnssl.com/public/static/js/common.js"></script>
	<script src="https://xyhl.chnssl.com/app/admin/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://xyhl.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		@media only screen and (max-width: 1130px) {
			.layui-nav .layui-nav-item a {
				margin-left: 25px;
			}
		}
		@media only screen and (max-width: 1030px) {
			.layui-nav .layui-nav-item a {
				margin-left: 10px;
			}
		}
	</style>
	
<style>
	.flex{display: flex;flex-wrap: wrap;}
	.flex .layui-form-item{width:50%}
	.ns-form-row{margin: 20px auto;}
	.layui-tab-brief li{border-bottom: 3px solid #FFFFFF;}
	.layui-tab-brief li.layui-this{border-bottom: 3px solid #ff6a00;}
	.panel-content { padding-left: 15px; box-sizing: border-box; }
	.ns-custom-panel .custom-panel-title .panel-content { width: calc(100% - 190px); }
	.ns-account-value, .ns-split { line-height: 34px; }
	.ns-custom-panel .custom-panel-from { display: flex; }
	.ns-custom-panel .custom-panel-from .layui-form-label{
		text-align: center;
	}
	.ns-custom-panel .custom-panel-from>div{
		text-align: center;
	}
	.ns-custom-panel .custom-panel-from .layui-form-item>div>span{
		margin-right: 10px;
	}
	.ns-custom-panel .custom-panel-from .layui-form-item>div>button{
		width: 20px;
		height: 20px;
		text-align: center;
		padding: 0;
		line-height: 20px;
		border:0;
		color:#FF6A00 ;
	}
	.layui-input-block + .layui-word-aux {
		display: block;
		margin-left: 100px;
	}
	.ns-admin-account {
		display: flex;
		align-items: center;
		position: relative;
		padding: 15px;
		box-sizing: border-box;
	}

	.ns-admin-detail p {
		display: inline-block;
		width: 300px;
		line-height: 30px;
	}
</style>

</head>
<body>

<div class="ns-logo">
	<div class="logo-box">
		<!--<img src="https://xyhl.chnssl.com/app/admin/view/public/img/logo.png">-->
	</div>
	<span>婚业汇联管理系统</span>
	<!--<span>服务电话：400-886-7993</span>-->
</div>

<div class="layui-layout layui-layout-admin">
	
	<div class="layui-header">
		<!-- 一级菜单 -->
		<ul class="layui-nav layui-layout-left">
			<?php $second_menu = []; foreach($menu as $menu_k => $menu_v): ?>
			<li class="layui-nav-item <?php if($menu_v['selected']): ?> layui-this<?php endif; ?>">
				<a href="<?php echo htmlentities($menu_v['url']); ?>"><?php echo htmlentities($menu_v['title']); ?></a>
			</li>
			<?php if($menu_v['selected']): 
				$second_menu = $menu_v['child_list'];
				 ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<ul class="layui-nav layui-layout-right">
			<li class="layui-nav-item">
				<a href="javascript:;">
					<div class="ns-img-box">
						<img src="https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
					</div>
					<?php echo htmlentities($user_info['username']); ?>
				</a>
				<dl class="layui-nav-child">
					<dd class="ns-reset-pass" onclick="resetPassword();">
						<a href="javascript:;">修改密码</a>
					</dd>
					<dd>
						<a onclick="clearCache()" href="javascript:;">清除缓存</a>
					</dd>
					<dd>
						<a href="<?php echo addon_url('admin/login/logout'); ?>" class="login-out">退出登录</a>
					</dd>
				</dl>
			</li>
		</ul>
	</div>
	

	<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
	<div class="layui-side">
		<div class="layui-side-scroll">
			<span class="ns-side-title"><?php echo htmlentities($crumbs[0]['title']); ?></span>
			<!-- 二三级菜单-->
			<ul class="layui-nav layui-nav-tree"  lay-filter="test">
				<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
				<li class="layui-nav-item <?php if($menu_second_v['selected']): ?> layui-nav-itemed <?php endif; if(!$menu_second_v['child_list'] && $menu_second_v['selected']): ?> layui-this<?php endif; ?>">
					<a class="layui-menu-tips" href="<?php if(!$menu_second_v['child_list']): ?> <?php echo htmlentities($menu_second_v['url']); else: ?>javascript:;<?php endif; ?>"><?php echo htmlentities($menu_second_v['title']); ?></a>
					<?php if(!(empty($menu_second_v['child_list']) || (($menu_second_v['child_list'] instanceof \think\Collection || $menu_second_v['child_list'] instanceof \think\Paginator ) && $menu_second_v['child_list']->isEmpty()))): ?>
					<dl class="layui-nav-child">
						<?php foreach($menu_second_v["child_list"] as $menu_third_k => $menu_third_v): ?>
						<dd class="<?php if($menu_third_v['selected']): ?> layui-this<?php endif; ?>">
							<a href="<?php echo htmlentities($menu_third_v['url']); ?>"><?php echo htmlentities($menu_third_v['title']); ?></a>
						</dd>
						<?php endforeach; ?>
					</dl>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<div class="layui-body<?php if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?> child_no_exit<?php endif; ?>">
		<!-- 面包屑 -->
		
		<?php if(count($second_menu) > 0): ?>
		<div class="ns-crumbs<?php if(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty())): ?> child_no_exit<?php endif; ?>">
		<span class="layui-breadcrumb" lay-separator="-">
			<?php foreach($crumbs as $crumbs_k => $crumbs_v): if(count($crumbs) == ($crumbs_k + 1)): ?>
			<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
			<?php else: ?>
			<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
			<?php endif; ?>
			<?php endforeach; ?>
		</span>
		</div>
		<?php endif; ?>
		
		<div class="ns-body-content <?php if(count($second_menu) < 1): ?> crumbs_no_exit<?php endif; ?>">
			<div class="ns-body">
				<!-- 四级导航 -->
				<?php if(isset($forth_menu) && !empty($forth_menu)): ?>
				<div class="fourstage-nav layui-tab layui-tab-brief" lay-filter="edit_user_tab">
					<ul class="layui-tab-title">
						<?php if(is_array($forth_menu) || $forth_menu instanceof \think\Collection || $forth_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $forth_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
						<li class="<?php echo $menu['selected']==1 ? 'layui-this'  :  ''; ?>" lay-id="basic_info"><a href="<?php echo htmlentities($menu['parse_url']); ?>"><?php echo htmlentities($menu['title']); ?></a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				
<div class="fourstage-nav layui-tab layui-tab-brief" lay-filter="edit_user_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="basic_info">基本信息</li>
	</ul>
</div>
<div class="layui-form ns-form flex">
	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>用户名：</label>
		<div class="layui-input-block">
			<p class="ns-input-text ns-len-mid"><?php echo htmlentities($member_info['data']['username']); ?></p>
		</div>
		<div class="ns-word-aux">用于登录，不可编辑</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span class="required">*</span>昵称：</label>
		<div class="layui-input-block">
			<input name="nickname" type="text" lay-verify="required" value="<?php echo htmlentities($member_info['data']['nickname']); ?>" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">会员名称</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">手机号：</label>
		<div class="layui-input-block">
			<input name="mobile" type="text" lay-verify="mobile" value="<?php echo htmlentities($member_info['data']['mobile']); ?>" class="layui-input ns-len-long">
		</div>
		<div class="ns-word-aux">已进行手机号验证，请填写正确的手机号</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">状态：</label>
		<div class="layui-input-block">
			<input type="checkbox" name="status" value="1" lay-skin="switch" <?php if($member_info['data']['status'] == 1): ?> checked <?php endif; ?> >
		</div>
		<div class="ns-word-aux">当状态处于关闭时，该会员则不能登录。</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label img-upload-lable ns-short-label">头像：</label>
		<div class="layui-input-inline">
			<div class="upload-img-block square">
				<div class="upload-img-box <?php if($member_info['data']['headimg']): ?>hover<?php endif; ?>">
				<div class="ns-upload-default" id="headImg">
					<?php if($member_info['data']['headimg']): ?>
					<div id="preview_headImg" class="preview_img">
						<img layer-src src="<?php echo img($member_info['data']['headimg']); ?>" class="img_prev"/>
					</div>
					<?php else: ?>
					<div class="upload">
						<img src="https://xyhl.chnssl.com/app/admin/view/public/img/upload_img.png" />
						<p>点击上传</p>
					</div>
					<?php endif; ?>
				</div>
				<div class="operation">
					<div >
						<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
						<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
					</div>

					<div class="replace_img js-replace">点击替换</div>
				</div>
				<input type="hidden" name="headimg" value="<?php echo htmlentities($member_info['data']['headimg']); ?>" />
			</div>
			<!-- <p id="headImg" class=" <?php if($member_info['data']['headimg']): ?> replace <?php else: ?> no-replace<?php endif; ?>">替换</p>

            <i class="del <?php if($member_info['data']['headimg']): ?>show<?php endif; ?>">x</i> -->
		</div>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label"><span class="required">*</span>会员等级：</label>
	<div class="layui-input-inline ns-len-mid">
		<select class="member_level" name="member_level" lay-verify="required" lay-filter="member_level">
			<option value="">请选择</option>
			<?php if(is_array($member_level_list) || $member_level_list instanceof \think\Collection || $member_level_list instanceof \think\Paginator): $i = 0; $__LIST__ = $member_level_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member_level): $mod = ($i % 2 );++$i;?>
			<option value="<?php echo htmlentities($member_level['level_id']); ?>" <?php echo $member_info['data']['member_level']==$member_level['level_id'] ? 'selected'  :  ''; ?>><?php echo htmlentities($member_level['level_name']); ?></option>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">性别：</label>
	<div class="layui-input-inline">
		<input type="radio" name="sex" value="0" title="未知" <?php echo $member_info['data']['sex']==0 ? 'checked'  :  ''; ?>>
		<input type="radio" name="sex" value="1" title="男" <?php echo $member_info['data']['sex']==1 ? 'checked'  :  ''; ?>>
		<input type="radio" name="sex" value="2" title="女" <?php echo $member_info['data']['sex']==2 ? 'checked'  :  ''; ?>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">生日：</label>
	<div class="layui-input-inline">
		<input name="birthday" type="text" id="laydate" value="" class="layui-input ns-len-mid">
	</div>
</div>

<div class="ns-form-row">
	<button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
	<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
</div>

<!-- 隐藏域 -->
<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['data']['member_id']); ?>" />
<input type="hidden" class="birthday" value="<?php echo htmlentities($member_info['data']['birthday']); ?>" />
</div>
<div class="fourstage-nav layui-tab layui-tab-brief" lay-filter="edit_user_tab">
	<ul class="layui-tab-title">
		<li class="layui-this" lay-id="basic_info">账户明细</li>
		<li lay-id="basic_info">订单管理</li>
		<li lay-id="basic_info">会员地址</li>
		<li lay-id="basic_info">收藏记录</li>
		<li lay-id="basic_info">浏览记录</li>
	</ul>
	<div class="layui-tab-content">
		<div class="layui-tab-item layui-show">
			<!-- <iframe src="<?php echo url('admin/member/accountdetail',array('member_id'=>$member_info['data']['member_id'])); ?>" style="width:100%;height:100vh;border:0"></iframe> -->
			<div class="ns-custom-panel">
				<div class="ns-form">
					<div class="layui-card-body ns-item-block-parent ns-admin-account">
						<div class="ns-item-pic">
							<?php if(!(empty($member_info['headimg']) || (($member_info['headimg'] instanceof \think\Collection || $member_info['headimg'] instanceof \think\Paginator ) && $member_info['headimg']->isEmpty()))): ?>
							<img src="<?php echo img($member_info['headimg']); ?>" alt="">
							<?php else: ?>
							<img src="https://xyhl.chnssl.com/app/admin/view/public/img/default_headimg.png" alt="">
							<?php endif; ?>
						</div>
						<div class="ns-admin-detail">
							<p><strong>用户名：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['data']['username']); ?></span></p>
							<p><strong>昵称：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['data']['nickname']); ?></span></p>
							<p><strong>真实姓名：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['data']['realname']); ?></span></p>
							<!-- <br> -->
							<p><strong>手机号：</strong><span class="ns-text-color-dark-gray"><?php echo htmlentities($member_info['data']['mobile']); ?></span></p>
							<p><strong>注册时间：</strong><span class="ns-text-color-dark-gray ns-end-time"><?php echo time_to_date($member_info['data']['reg_time']); ?></span></p>
						</div>
					</div>
				</div>

				<div class="custom-panel-from ns-form">
					<div class="layui-form" lay-filter="pointForm">
						<div class="layui-form-item">
							<label class="layui-form-label">积分</label>
							<div>
								<span class="ns-len-short ns-account-value" id="member_point"><?php echo htmlentities($member_info['data']['point']); ?></span>
								<button class="layui-btn layui-btn-primary layui-icon" onclick="savePoint(this)" data-num="<?php echo htmlentities($member_info['data']['point']); ?>">&#xe642;</button>
							</div>
						</div>
					</div>

					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">余额（不可提现）</label>
							<div>
								<span class="ns-len-short ns-account-value" id="member_balance"><?php echo htmlentities($member_info['data']['balance']); ?></span>
								<button class="layui-btn layui-btn-primary layui-icon" onclick="saveBalance(this)" data-num="<?php echo htmlentities($member_info['data']['balance']); ?>">&#xe642;</button>
							</div>
						</div>
					</div>

					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">余额（可提现）</label>
							<div>
								<span class="ns-len-short ns-account-value" id="member_balance_money"><?php echo htmlentities($member_info['data']['balance_money']); ?></span>
								<button class="layui-btn layui-btn-primary layui-icon" onclick="saveBalanceMoney(this)" data-num="<?php echo htmlentities($member_info['data']['balance_money']); ?>">&#xe642;</button>
							</div>
						</div>
					</div>

					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">成长值</label>
							<div>
								<span class="ns-len-short ns-account-value" id="member_growth"><?php echo htmlentities($member_info['data']['growth']); ?></span>
								<button class="layui-btn layui-btn-primary layui-icon" onclick="saveGrowth(this)" data-num="<?php echo htmlentities($member_info['data']['growth']); ?>">&#xe642;</button>
							</div>
						</div>
					</div>
				</div>

				<div class="ns-screen layui-collapse" lay-filter="selection_panel">
					<div class="layui-colla-item">
						<h2 class="layui-colla-title"></h2>
						<form class="layui-colla-content layui-form layui-show">
							<div class="layui-form-item">
								<div class="layui-inline">
									<label class="layui-form-label">账户类型：</label>
									<div class="layui-input-inline">
										<select name="account_type" lay-filter="account_type">
											<option value="">请选择</option>
											<?php foreach($account_type_arr as $account_type_arr_k => $account_type_arr_v): ?>
											<option value="<?php echo htmlentities($account_type_arr_k); ?>"><?php echo htmlentities($account_type_arr_v); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="layui-inline">
									<label class="layui-form-label">来源类型：</label>
									<div class="layui-input-inline">
										<select name="from_type" class="from_type">
											<option value="">请选择</option>
										</select>
									</div>
								</div>
								<div class="layui-inline">
									<label class="layui-form-label">发生时间：</label>
									<div class="layui-input-inline">
										<input type="text" class="layui-input" name="start_date" id="start_date" placeholder="开始时间" autocomplete="off" readonly>
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline ns-split">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
									<div class="layui-input-inline ns-len-mid">
										<input type="text" class="layui-input" name="end_date" id="end_date" placeholder="结束时间" autocomplete="off" readonly>
									</div>
								</div>
							</div>
							<!-- <div class="layui-form-item">
								<div class="layui-inline">
								<label class="layui-form-label">发生时间：</label>
								<div class="layui-input-inline">
									<input type="text" class="layui-input" name="start_date" id="start_date" placeholder="开始时间" autocomplete="off" readonly>
								</div>
								<div class="layui-input-inline ns-split">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
								<div class="layui-input-inline ns-len-mid">
									<input type="text" class="layui-input" name="end_date" id="end_date" placeholder="结束时间" autocomplete="off" readonly>
								</div>
								</div>
							</div> -->

							<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['data']['member_id']); ?>" id="member_id"/>

							<div class="ns-form-row" style="margin:0 !important;text-align: center;">
								<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
								<button type="reset" class="layui-btn layui-btn-primary">重置</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<table id="member_account" lay-filter="member_account"></table>
		</div>
		<div class="layui-tab-item">
			<iframe src="<?php echo url('admin/member/order',array('member_id'=>$member_info['data']['member_id'])); ?>" style="width:100%;height:100vh;border:0"></iframe>
		</div>
		<div class="layui-tab-item">
			<iframe src="<?php echo url('admin/member/addressdetail',array('member_id'=>$member_info['data']['member_id'])); ?>" style="width:100%;height:100vh;border:0"></iframe>
		</div>
		<div class="layui-tab-item">
			<iframe src="<?php echo url('admin/goods/membergoodscollect',array('member_id'=>$member_info['data']['member_id'])); ?>" style="width:100%;height:100vh;border:0"></iframe>
		</div>
		<div class="layui-tab-item">
			<iframe src="<?php echo url('admin/goods/membergoodsbrowse',array('member_id'=>$member_info['data']['member_id'])); ?>" style="width:100%;height:100vh;border:0"></iframe>
		</div>
	</div>
</div>


			</div>

			<!-- 版权信息 -->
			<!--<div class="ns-footer">
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://xyhl.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
			</div>-->
		</div>
	</div>
</div>

<!-- 重置密码弹框html -->
<div class="layui-form" id="reset_pass" style="display: none;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>原密码</label>
        <div class="layui-input-block">
            <input type="password" id="old_pass" name="old_pass" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
            <span class="required"></span>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>新密码</label>
        <div class="layui-input-block">
            <input type="password" id="new_pass" name="new_pass" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
            <span class="required"></span>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>确认新密码</label>
        <div class="layui-input-block">
            <input type="password" id="repeat_pass" name="repeat_pass" required class="layui-input ns-len-mid" maxlength="18" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly',true);">
            <span class="required"></span>
        </div>
    </div>

    <div class="ns-form-row">
        <button class="layui-btn ns-bg-color" onclick="repass()">确定</button>
        <button class="layui-btn layui-btn-primary" onclick="closePass()">返回</button>
    </div>
</div>
<script type="text/javascript">
	layui.use('element',function () {
		var element = layui.element;
		element.render('breadcrumb');
	});
	function clearCache () {
		$.ajax({
			type: 'post',
			url: ns.url("admin/Login/clearCache"),
			dataType: 'JSON',
			success: function(res) {
				layer.msg(res.message);
				location.reload();
			}
		})
	}

    /**
     * 重置密码
     */
	var index;
    function resetPassword() {
        index = layer.open({
            type:1,
            content:$('#reset_pass'),
            offset: 'auto',
            area: ['650px']
        });

		setTimeout(function() {
			$(".ns-reset-pass").removeClass('layui-this');
		}, 1000);
    }

	// $(".ns-reset-pass").on('click', function() {
	// 	$(this).removeClass('layui-this');
	// })

    var repeat_flag = false;
    function repass(){
        var old_pass = $("#old_pass").val();
        var new_pass = $("#new_pass").val();
        var repeat_pass = $("#repeat_pass").val();

        if (old_pass == '') {
            $("#old_pass").focus();
            layer.msg("原密码不能为空");
            return;
        }

        if (new_pass == '') {
            $("#new_pass").focus();
            layer.msg("密码不能为空");
            return;
        } else if ($("#new_pass").val().length < 6) {
            $("#new_pass").focus();
            layer.msg("密码不能少于6位数");
            return;
        }
        if (repeat_pass == '') {
            $("#repeat_pass").focus();
            layer.msg("密码不能为空");
            return;
        } else if ($("#repeat_pass").val().length < 6) {
            $("#repeat_pass").focus();
            layer.msg("密码不能少于6位数");
            return;
        }
        if (new_pass != repeat_pass) {
            $("#repeat_pass").focus();
            layer.msg("两次密码输入不一样，请重新输入");
            return;
        }

        if(repeat_flag)return;
        repeat_flag = true;

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: ns.url("admin/login/modifypassword"),
            data: {"old_pass": old_pass,"new_pass": new_pass},
            success: function(res) {
                layer.msg(res.message);
                repeat_flag = false;

                if (res.code == 0) {
                    layer.close(index);
                    location.reload();
                }
            }
        });
    }

    function closePass() {
        layer.close(index);
	}

	/**
	 * 打开相册
	 */
	function openAlbum(callback, imgNum) {
		layui.use(['layer'], function () {
			//iframe层-父子操作
			layer.open({
				type: 2,
				title: '图片管理',
				area: ['825px', '675px'],
				fixed: false, //不固定
				btn: ['保存', '返回'],
				content: ns.url("admin/album/album?imgNum=" + imgNum),
				yes: function (index, layero) {
					var iframeWin = window[layero.find('iframe')[0]['name']];//得到iframe页的窗口对象，执行iframe页的方法：

					iframeWin.getCheckItem(function (obj) {
						if (typeof callback == "string") {
							try {
								eval(callback + '(obj)');
								layer.close(index);
							} catch (e) {
								console.error('回调函数' + callback + '未定义');
							}
						} else if (typeof callback == "function") {
							callback(obj);
							layer.close(index);
						}

					});
				}
			});
		});
	}

	layui.use('element', function() {
		var element = layui.element;
		element.init();
	});
</script>


<script>
	var birthday = $(".birthday").val();
	$("input[name=birthday]").attr("value", ns.time_to_date(birthday, "YYYY-MM-DD"));

	layui.use(['form', 'laydate'], function() {
		var form = layui.form,
				laydate = layui.laydate,
				repeat_flag = false; //防重复标识
		form.render();

		laydate.render({
			elem: '#laydate'
		});

		/**
		 * 表单验证
		 */
		form.verify({
			isemail: function(value) {
				var reg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
				if (value == '') {
					return;
				}
				if (!reg.test(value)) {
					return '请输入正确的邮箱!';
				}
			}
		});

		var headImg_upload = new Upload({
			elem: '#headImg'
		});

		form.on('submit(save)', function(data) {

			data.field.member_level_name = $(".member_level").find("option[value=" + data.field.member_level + "]").text();

			if (data.field.status == undefined) {
				data.field.status = 0;
			}

			// 删除图片
			if(!data.field.headimg) headImg_upload.delete();

			if(repeat_flag) return false;
			repeat_flag = true;

			$.ajax({
				url: ns.url("admin/member/editMember"),
				data: data.field,
				dataType: 'JSON', //服务器返回json格式数据
				type: 'POST', //HTTP请求类型
				success: function(res) {
					repeat_flag = false;
					if (res.code == 0) {
						layer.confirm('编辑成功', {
							title:'操作提示',
							btn: ['返回列表', '继续操作'],
							yes: function(){
								location.href = ns.url("admin/member/memberList")
							},
							btn2: function() {
								location.reload();
							}
						});
					}else{
						layer.msg(res.message);
					}
				}
			});
		});

	});

	function back() {
		location.href = ns.url("admin/member/memberList");
	}
</script>
<script>
	var date = <?php echo htmlentities($member_info['data']['reg_time']); ?>;
	$(".reg-time").text(ns.time_to_date(date, "YYYY-MM-DD"));
	$("#member_point").text(parseInt("<?php echo htmlentities($member_info['data']['point']); ?>"));

	var form,
			table,
			laydate,
			laytpl,
	repeat_flag = false, //防重复标识
			currentDate = new Date(),
			minDate = "";

	currentDate.setDate(currentDate.getDate() - 7);

	layui.use(['form', 'laydate', 'laytpl'], function() {
		form = layui.form;
		laydate = layui.laydate;
		laytpl = layui.laytpl;
		form.render();

		//开始时间
		laydate.render({
			elem: '#start_date',
			type: 'datetime'
		});

		//结束时间
		laydate.render({
			elem: '#end_date',
			type: 'datetime'
		});

		//根据账户类型获取来源类型
		form.on('select(account_type)', function (data) {

			$.ajax({
				type: "POST",
				url: ns.url("admin/member/getfromtype"),
				data: {type:data.value},
				dataType: 'JSON',
				success: function(res) {

					var html = '<option value="">请选择</option>';
					$.each(res,function(k,v){
						html += '<option value="'+k+'">'+v.type_name+'</option>';
					});

					$('.from_type').html(html);
					form.render();
				}
			});
		});

		/**
		 * 重新渲染结束时间
		 * */
		function reRender() {
			$("#reg_end_date").remove();
			$(".end-time").html('<input type="text" class="layui-input" name="reg_end_date" id="reg_end_date" placeholder="请输入结束时间">');
			laydate.render({
				elem: '#reg_end_date',
				min: minDate
			});
		}

		table = new Table({
			elem: '#member_account',
			url: ns.url("admin/member/accountDetail"),
			where:{
				member_id : $("#member_id").val(),
			},
			cols: [
				[{
					field: 'account_type_name',
					title: '账户类型',
					width: '15%',
					unresize: 'false'
				}, {
					title: '数据金额',
					width: '15%',
					unresize: 'false',
					templet: function (d) {
						return d.account_type = "point" ? parseInt(d.account_data) : d.account_data;
					}
				}, {
					field: 'type_name',
					title: '发生方式',
					width: '15%',
					unresize: 'false'
				}, {
					field: 'remark',
					title: '备注',
					width: '35%',
					unresize: 'false'
				}, {
					field: 'create_time',
					title: '发生时间',
					width: '20%',
					unresize: 'false',
					templet: function(data) {
						return ns.time_to_date(data.create_time);
					}
				}]
			]
		});

		/**
		 * 表单验证
		 */
		form.verify({
			num: function(value) {
				var arrMen = value.split(".");
				var val = 0;
				if (arrMen.length == 2) {
					val = arrMen[1];
				}

				if (value == "") {
					return false;
				}
				if (val.length > 2) {
					return '保留小数点后两位'
				}
			}
		});

		form.on('submit(search)', function(data) {
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
			return false;
		});

		form.on('submit(savePoint)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var point = <?php echo htmlentities($member_info['data']['point']); ?>;
			if (data.field.adjust_num == 0) {
				layer.msg('调整数值不能为0');
				repeat_flag = false;
				return ;
			}
			if (point*1 + data.field.adjust_num*1 < 0) {
				layer.msg('积分不可以为负数');
				repeat_flag = false;
				return ;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustPoint"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;

					if (res.code == 0) {
						$("#member_point").html(res.data.point);
						$("#member_point").next().attr('data-num', res.data.point);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});

		form.on('submit(saveBalance)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var balance = <?php echo htmlentities($member_info['data']['balance']); ?>;
			if (data.field.adjust_num == 0) {
				layer.msg('调整数值不能为0');
				repeat_flag = false;
				return ;
			}
			if (balance*1 + data.field.adjust_num*1 < 0) {
				layer.msg('当前余额（不可提现）不可以为负数');
				repeat_flag = false;
				return ;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustBalance"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;

					if (res.code == 0) {
						$("#member_balance").html(res.data.balance);
						$("#member_balance").next().attr('data-num', res.data.balance);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});

		form.on('submit(saveBalanceMoney)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var balance = <?php echo htmlentities($member_info['data']['balance_money']); ?>;
			if (data.field.adjust_num == 0) {
				layer.msg('调整数值不能为0');
				repeat_flag = false;
				return ;
			}
			if (balance*1 + data.field.adjust_num*1 < 0) {
				layer.msg('余额(可提现)不可以为负数');
				repeat_flag = false;
				return ;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustBalanceMoney"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;

					if (res.code == 0) {
						$("#member_balance_money").html(res.data.balance_money);
						$("#member_balance_money").next().attr('data-num', res.data.balance_money);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});

		form.on('submit(saveGrowth)', function(data) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var growth = <?php echo htmlentities($member_info['data']['growth']); ?>;
			if (data.field.adjust_num == 0) {
				layer.msg('调整数值不能为0');
				repeat_flag = false;
				return ;
			}
			if (growth*1 + data.field.adjust_num*1 < 0) {
				layer.msg('成长值不可以为负数');
				repeat_flag = false;
				return;
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/adjustGrowth"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;

					if (res.code == 0) {
						$("#member_growth").html(res.data.growth);
						$("#member_growth").next().attr('data-num', res.data.growth);
						layer.closeAll('page');
						table.reload();
					}
				}
			});
		});
	});

	function savePoint(e) {
		var point = $(e).attr('data-num');
		var data = {
			point : point
		};
		laytpl($("#point").html()).render(data, function(html) {
			layer.open({
				title: '调整积分',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});


		$(".integral-bounced .amount input").on("input propertychange",function(val){
			var newIntegral = parseInt($(this).val());
			$(this).val(newIntegral);
			var currIntegral = parseInt($(".integral-bounced .ns-account-value").text());

			if (newIntegral + currIntegral < 0){
				layer.msg("调整数额与当前值积分数相加不能小于0");
				$(this).val(-currIntegral);
				return false;
			}

		})
	}

	function saveBalance(e) {
		var balance = $(e).attr('data-num');
		var data = {
			balance : balance
		};
		laytpl($("#balance").html()).render(data, function(html) {
			layer.open({
				title: '调整余额（不可提现）',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}

	function saveBalanceMoney(e) {
		var balance_money = $(e).attr('data-num');
		var data = {
			balance_money : balance_money
		};
		laytpl($("#balance_money").html()).render(data, function(html) {
			layer.open({
				title: '调整余额（可提现）',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}

	function saveGrowth(e) {
		var growth = $(e).attr('data-num');
		var data = {
			growth : growth
		};
		laytpl($("#growth").html()).render(data, function(html) {
			layer.open({
				title: '调整成长值',
				skin: 'layer-tips-class',
				type: 1,
				area: ['800px'],
				content: html
			});
		});
	}
</script>
<!-- 积分弹框html -->
<script type="text/html" id="point">
	<div class="layui-form integral-bounced">
		<div class="layui-form-item">
			<label class="layui-form-label">当前积分：</label>
			<div class="layui-input-block ns-account-value">{{ parseInt(d.point) }}</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block amount">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前积分数相加不能小于0</span>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>

		<div class="ns-form-row" style="margin-left: 200px;">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="savePoint">确定</button>
		</div>

		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['data']['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.point }}" />
	</div>
</script>

<!-- 余额弹框html -->
<script type="text/html" id="balance">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前余额（不可提现）：</label>
			<div class="layui-input-block ns-account-value">{{ d.balance }}</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前不可提现余额相加不能小于0</span>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>

		<div class="ns-form-row" style="margin-left: 200px;">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="saveBalance">确定</button>
		</div>

		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['data']['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.balance }}" />
	</div>
</script>

<!-- 余额（可提现）弹框html -->
<script type="text/html" id="balance_money">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前余额（可提现）：</label>
			<div class="layui-input-block ns-account-value">{{ d.balance_money }}</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前可提现余额相加不能小于0</span>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>

		<div class="ns-form-row" style="margin-left: 200px;">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="saveBalanceMoney">确定</button>
		</div>

		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['data']['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.balance_money }}" />
	</div>
</script>

<!-- 成长值弹框html -->
<script type="text/html" id="growth">
	<div class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">当前成长值：</label>
			<div class="layui-input-block ns-account-value">{{ d.growth }}</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">调整数额：</label>
			<div class="layui-input-block">
				<input type="number" value="0" placeholder="请输入调整数额" name="adjust_num" lay-verify="num" class="layui-input ns-len-short">
			</div>
			<span class="ns-word-aux">调整数额与当前成长值相加不能小于0</span>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block ns-len-long">
				<textarea class="layui-textarea" name="remark" placeholder="请输入备注"></textarea>
			</div>
		</div>

		<div class="ns-form-row" style="margin-left: 200px;">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="saveGrowth">确定</button>
		</div>

		<input type="hidden" name="member_id" value="<?php echo htmlentities($member_info['data']['member_id']); ?>" />
		<input type="hidden" name="point" value="{{ d.growth }}" />
	</div>
</script>

</body>
</html>