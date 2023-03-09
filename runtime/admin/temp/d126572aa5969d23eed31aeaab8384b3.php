<?php /*a:2:{s:66:"/www/wwwroot/www.hunqin.com/app/admin/view/member/member_list.html";i:1614515914;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
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
	.ns-reason-box{display: none;width: 350px;box-sizing: border-box;padding: 20px;border: 1px solid #aaa;border-radius: 5px;background-color: #FFF;position: absolute;top: 50px;z-index: 999;color: #666;line-height: 30px;left: 0px;font-weight: normal;}
	.ns-balance-box {text-align: left; left: unset; right: -270px;}
	.ns-reason-box:before, .ns-reason-box:after{content: "";border: solid transparent;height: 0;position: absolute;width: 0;}
	.ns-reason-box:before{border-width: 12px;border-bottom-color: #aaa;top: -12px;left: 43px;border-top: none;}
	.ns-reason-growth:before{left: 56px;}
	.ns-reason-box:after{border-width: 10px;border-bottom-color: #FFF;top: -20px;left: 45px;}
	.ns-reason-growth:after{left: 58px;}
	.ns-reason-box p{white-space: normal;line-height: 1.5;}
	.layui-table-header{overflow: inherit;}
	.layui-table-header .layui-table-cell{overflow: inherit;}
	.ns-prompt .iconfont{font-size: 16px;color: rgba(0,0,0,0.7);cursor: pointer;font-weight: 500;margin-left: 3px;}
	.ns-prompt-block.balance {justify-content: flex-end;}
	.layui-form-item .layui-form-checkbox[lay-skin=primary] {margin-top: 0;}
	.blacklist{background: #333;color: #fff;line-height: 1;padding: 3px 6px;border-radius: 3px;font-size: 12px;}
	.layui-table-cell{text-align: center;}
	.ns-prompt-box{margin:auto;}
	.ns-table-tuwen-box .ns-img-box img{
		width:100%;
		max-width: auto;
	}
	.layui_input_block{margin-left: 110px!important;}
</style>
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/member.css" />
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/admin/view/public/css/member_coupon.css" />


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
				
<div class="layui-collapse ns-tips">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title">操作提示</h2>
		<ul class="layui-colla-content layui-show">
			<li>会员由平台端进行统一管理，平台可以针对会员进行添加，编辑，锁定，调整账户等操作。</li>
			<li>账户类型有用户名、手机、邮箱三种类型，筛选时可以选择其中一种类型并输入对应的内容进行筛选。</li>
			<li>点击收起按钮可以将搜索面板隐收起，变成高级搜索按钮。</li>
		</ul>
	</div>
</div>

<!-- 添加会员 -->
<div class="ns-single-filter-box">
	<button type="button" class="layui-btn ns-bg-color" onclick="window.location.href='<?php echo addon_url("admin/member/addMember"); ?>'">添加会员</button>
</div>

<div class="ns-screen layui-collapse" lay-filter="selection_panel">
	<div class="layui-colla-item">
		<h2 class="layui-colla-title"></h2>
		<form class="layui-colla-content layui-form layui-show">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">账号</label>
					<div class="layui-input-inline">
						<select name="search_text_type">
							<option value="username">用户名</option>
							<option value="nickname">昵称</option>
							<option value="mobile">手机号</option>
						</select>
					</div>
					<div class="layui-input-inline">
						<input type="text" name="search_text" placeholder="用户名/昵称/手机号" autocomplete="off" class="layui-input ">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">成交次数</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_order_complete_num" id="start_order_complete_num" autocomplete="off">
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" name="end_order_complete_num" id="end_order_complete_num" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">注册时间</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="reg_start_date" id="reg_start_date" placeholder="请输入开始时间" autocomplete="off" readonly>
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" name="reg_end_date" id="reg_end_date" placeholder="请输入结束时间" autocomplete="off" readonly>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">上次访问时间</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="last_login_time_start" id="last_login_time_start" placeholder="请输入开始时间" autocomplete="off" readonly>
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" name="last_login_time_end" id="last_login_time_end" placeholder="请输入结束时间" autocomplete="off" readonly>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">消费金额</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_order_complete_money" id="start_order_complete_money" autocomplete="off">
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" name="end_order_complete_money" id="end_order_complete_money" autocomplete="off">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">积分</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_point" id="start_point" autocomplete="off">
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="end_point" id="end_point" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">余额</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_balance" id="start_balance" autocomplete="off">
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" name="end_balance" id="end_balance" autocomplete="off">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">成长值</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="start_growth" id="start_growth" autocomplete="off">
					</div>
					<div class="layui-input-inline ns-split">-</div>
					<div class="layui-input-inline end-time">
						<input type="text" class="layui-input" name="end_growth" id="end_growth" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">会员等级</label>
					<div class="layui-input-inline">
						<select name="level_id">
							<option value="">请选择</option>
							<?php foreach($member_level_list as $member_level_list_k=> $member_level_list_v): ?>
							<option value="<?php echo htmlentities($member_level_list_v['level_id']); ?>"><?php echo htmlentities($member_level_list_v['level_name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">会员标签</label>
					<div class="layui-input-inline">
						<select name="label_id">
							<option value="">请选择</option>
							<?php foreach($member_label_list as $member_label_list_k=> $member_label_list_v): ?>
							<option value="<?php echo htmlentities($member_label_list_v['label_id']); ?>"><?php echo htmlentities($member_label_list_v['label_name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">来源渠道：</label>
					<div class="layui-input-inline">
						<select name="login_type">
							<option value="">全部</option>
							<?php foreach($order_from_list as $order_from_k => $order_from_v): ?>
							<option value="<?php echo htmlentities($order_from_k); ?>"><?php echo htmlentities($order_from_v['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">黑名单</label>
					<div class="layui-input-inline">
						<select name="status">
							<option value="">请选择</option>
							<option value="0">是</option>
							<option value="1">否</option>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">会员群体</label>
					<div class="layui-input-inline">
						<select name="cluster_id">
							<option value="">请选择</option>
							<?php foreach($member_cluster_list as $member_cluster_list_k=> $member_cluster_list_v): ?>
							<option value="<?php echo htmlentities($member_cluster_list_v['cluster_id']); ?>" <?php if($member_cluster_list_v['cluster_id'] == $cluster_id): ?>selected<?php endif; ?>><?php echo htmlentities($member_cluster_list_v['cluster_name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="ns-form-row">
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="search">筛选</button>
				<button class="layui-btn ns-bg-color" lay-submit lay-filter="export">批量导出</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	</div>
</div>

<table id="member_list" lay-filter="member_list"></table>

<!-- 用户信息 -->
<script type="text/html" id="userdetail">
	<div class='ns-table-tuwen-box'>
		<div class='ns-img-box'>
            {{# if (d.headimg != ""){ }}
                <img layer-src src="{{ns.img(d.headimg)}}">
            {{# } else { }}
                <img layer-src src="<?php echo img($default_img['default_headimg']); ?>">
            {{# } }}
		</div>
		<div class='ns-font-box'>
			<p class="layui-elip">{{d.nickname}}</p>
			{{# if (d.status == 0){ }}
			<div>
				<span class="blacklist">黑名单</span>
			</div>
			{{# } }}
		</div>
	</div>
</script>

<!-- 会员标签 -->
<script id="member_label" type="text/html">
	{{# if (d.member_label_name != null) { }}
		{{# var arr = d.member_label_name.substring(0,d.member_label_name.length-1).split(",") }}
		<div id="member_label_dl">
		{{# for (var index in arr) { }}
			{{'<span>' + arr[index] + '</span>'}}
		{{# } }}
		</div>
	{{# } }}
</script>

<!-- 状态 -->
<script type="text/html" id="status">
	{{ d.status == 1 ? '正常' : '锁定' }}
</script>

<!-- 工具栏操作 -->
<script type="text/html" id="action">
	<div class="ns-table-btn">
		<a class="layui-btn" lay-event="info">详情</a>
		<a class="layui-btn" lay-event="more">更多</a>
		<div class="more-operation">
			<?php if($is_exit_fenxiao == 1): ?>
			<a class="operation" lay-event="change">上级分销商变更</a>
			<?php endif; ?>
			<a class="operation" lay-event="set_label">设置标签</a>
			<a class="operation" lay-event="reset_pass">重置密码</a>
			<a class="operation" lay-event="recive_coupon">发放优惠券</a>
			{{# if(d.status == 1){ }}
			<a class="operation" lay-event="blacklist">黑名单</a>
			{{# }else{ }}
			<a class="operation" lay-event="remove_blacklist">移除黑名单</a>
			{{# } }}
<!--			<a class="operation" lay-event="delete">删除</a>-->
		</div>
	</div>
</script>

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


<script type='text/javascript' src='https://xyhl.chnssl.com/app/admin/view/public/js/coupon_list.js'></script>

<script type="text/javascript">
	var table, form, laytpl, laydate, 
		repeat_flag = false, 
		currentDate = new Date(), 
		minDate = "",
		layer_pass,
		layer_label;
		
	layui.use(['form', 'laytpl', 'laydate'], function() {
		form = layui.form;
		laytpl = layui.laytpl;
		laydate = layui.laydate;
		currentDate.setDate(currentDate.getDate() - 7);
		form.render();

		//注册开始时间
		laydate.render({
			elem: '#reg_start_date',
			type: 'datetime'
		});

		//注册结束时间
		laydate.render({
			elem: '#reg_end_date',
			type: 'datetime'
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

        //积分
       /* $("body").on("mousemove",".ns-point",function() {
            $("body").find(".ns-point-box").show().stop(false, true);
        });
        $("body").on("mouseout",".ns-point",function() {
            $("body").find(".ns-point-box").hide().stop(false, true);
        }); */

        //余额
        /* $("body").on("mousemove",".ns-balance",function() {
            $("body").find(".ns-balance-box").show().stop(false, true);
        });
        $("body").on("mouseout",".ns-balance",function() {
            $("body").find(".ns-balance-box").hide().stop(false, true);
        }); */

        //成长值
       /* $("body").on("mousemove",".ns-growth",function() {
            $("body").find(".ns-growth-box").show().stop(false, true);
        });
        $("body").on("mouseout",".ns-growth",function() {
            $("body").find(".ns-growth-box").hide().stop(false, true);
        }); */

		table = new Table({
			elem: '#member_list',
			url: ns.url("admin/member/memberList"),
			where:{"cluster_id" : "<?php echo htmlentities($cluster_id); ?>"},
			cols: [
				[
					{
						width: "3%",
						type: 'checkbox',
						unresize: 'false'
					}, {
						field: 'userdetail',
						title: '账户',
						width: '10%',
						unresize: 'false',
						templet: '#userdetail'
					}, {
						field: 'member_level_name',
						title: '会员等级',
						width: '10%',
						unresize: 'false'
					}, {
						field: 'parent_fenxiao_name',
						title: '上级分销商',
						width: '10%',
						unresize: 'false',
						hide: <?php echo htmlentities($is_exit_fenxiao); ?> ? false : true
					}, {
						field: 'point',
						title: '<?php if(!empty($point)): ?>' +
								'<div class="ns-prompt-block">' +
									'<div style="margin:auto;">'+
									'积分' +
									'<span class="ns-prompt">' +
										'<i class="iconfont iconwenhao1 required ns-point"></i>'+
										'<div class="ns-point-box ns-reason-box ns-prompt-box" >' +
											'<div class="ns-prompt-con">' +
												'<?php foreach($point as $k=>$v): ?>' +
												'<p><?php echo htmlentities($k+1); ?>、<?php echo htmlentities($v); ?></p>' +
												'<?php endforeach; ?>' +
											'</div>' +
										'</div>' +
									'</span>' +
								'</div>'+
								'</div>' +
								'<?php else: ?> ' +
								'积分' +
								'<?php endif; ?>',
						width: '10%',
						unresize: 'false',
						align: 'center',
						templet: function (data) {
							return parseInt(data.point);
						}
					}, {
						field: 'balance',
						title: '<?php if(!empty($balance)): ?>'+
								'<div class="ns-prompt-block balance">'+
									'<div style="margin:auto;">'+
									'余额'+
									'<span class="ns-prompt">' +
										'<i class="iconfont iconwenhao1 required ns-balance"></i>' +
										'<div class="ns-balance-box ns-reason-box ns-prompt-box">' +
											'<div class="ns-prompt-con">' +
												'<?php foreach($balance as $k=>$v): ?>' +
												'<p><?php echo htmlentities($k+1); ?>、<?php echo htmlentities($v); ?></p>' +
												'<?php endforeach; ?>' +
											'</div>' +
										'</div>' +
									'</span>' +
									'</div>'+
								'</div>' +
								'<?php else: ?> ' +
								'余额' +
								'<?php endif; ?>',
						width: '10%',
						unresize: 'false',
						align: 'center',
						templet: function(data) {
							return '<span style="color: red">￥'+(parseFloat(data.balance)+parseFloat(data.balance_money)).toFixed(2) +'</span>';
						}
					}, {
						field: 'growth',
						title: '<?php if(!empty($growth)): ?>'+
								'<div class="ns-prompt-block">'+
									'<div style="margin:auto;">'+
									'成长值'+
									'<span class="ns-prompt">' +
										'<i class="iconfont iconwenhao1 required ns-growth"></i>' +
										'<div class="ns-growth-box ns-reason-box ns-reason-growth ns-prompt-box">' +
											'<div class="ns-prompt-con">' +
												'<?php foreach($growth as $k=>$v): ?>' +
												'<p><?php echo htmlentities($k+1); ?>、<?php echo htmlentities($v); ?></p>' +
												'<?php endforeach; ?>' +
											'</div>' +
										'</div>' +
									'</span>' +
									'</div>'+
								'</div>' +
								'<?php else: ?> ' +
								'成长值' +
								'<?php endif; ?>',
						width: '10%',
						unresize: 'false',
						align: 'center'
					}, {
						field: 'member_label',
						title: '标签',
						width: '10%',
						unresize: 'false',
						templet: '#member_label'
					}, {
						field: 'reg-login',
						title: '注册时间',
						width: '20%',
						unresize: 'false',
						templet: function (data) {
							return ns.time_to_date(data.reg_time);
						}
					}, {
						title: '操作',
						width: '7%',
						unresize: 'false',
						toolbar: '#action'
					}
				]
			],
			toolbar: "#toolbarOperation",
			bottomToolbar: "#batchOperation"
		});
		
		/**
		 * 监听工具栏操作
		 */
		 table.tool(function(obj) {
			var data = obj.data;
			switch (obj.event) {
				case 'info': //编辑
					location.href = ns.url("admin/member/editMember?member_id=" + data.member_id);
					break;
				case 'delete': //删除
					delMember(data.member_id);
					break;
				case 'reset_pass': //重置密码
					resetPassword(data);
					break;
				case 'set_label': //设置标签
					settingLabels({member_id: data.member_id, label: data.member_label});
					break;
				case 'more': //更多
					$('.more-operation').css('display', 'none');
					$(obj.tr).find('.more-operation').css('display', 'block');
					break;
                case 'change':
                    var url = ns.url("fenxiao://admin/fenxiao/change", {member_id: data.member_id});
                    //iframe层-父子操作
                    var layerIndex = layer.open({
                        title: "变更上级分销商",
                        type: 2,
                        area: ['1200px', '800px'],
                        // btn: '保存',
                        content: url,
                        end: function () {
                            location.reload();
                        }
                    });
                    break;

				case 'recive_coupon': //发放优惠券
					selectCoupon(data);
					break;
				case 'blacklist': // 黑名单
					addBlacklist(data.member_id);
					break;
				case 'remove_blacklist': // 移除黑名单
					removeBlacklist(data.member_id);
					break;

			}
		});

		$(document).click(function(event) {
			if ($(event.target).attr('lay-event') != 'more' && $('.more-operation').not(':hidden').length) {
				$('.more-operation').css('display', 'none');
			}
		});

		/**
		 * 批量操作
		 */
		table.toolbar(function(obj) {

			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}

			switch (obj.event) {
				case "del":
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].member_id);
					delMember(id_array.toString());
					break;
				case "setlabel":
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].member_id);
					settingLabels({member_id: id_array.toString()});
					break;
			}
		});
		table.bottomToolbar(function(obj) {
			
			if (obj.data.length < 1) {
				layer.msg('请选择要操作的数据');
				return;
			}

			switch (obj.event) {
				case "del":
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].member_id);
					delMember(id_array.toString());
					break;
				case "setlabel":
					var id_array = new Array();
					for (i in obj.data) id_array.push(obj.data[i].member_id);
					settingLabels({member_id: id_array.toString()});
					break;
			}
		});

		/**
		 * 删除
		 */
		function delMember(member_ids) {

			if (repeat_flag) return false;
			repeat_flag = true;
			
			layer.confirm('删除该会员，同时会删除相关账户，请谨慎操作！', function() {
				$.ajax({
					url: ns.url("admin/member/deleteMember"),
					data: {member_ids: member_ids},
					dataType: 'JSON',
					type: 'POST',
					success: function(res) {
						layer.msg(res.message);
						repeat_flag = false;

						if (res.code == 0) {
							table.reload();
						}
					}
				});
			}, function () {
				layer.close();
				repeat_flag = false;
			});
		}

		/**
		 * 重置密码
		 */
		function resetPassword(data) {
			laytpl($("#pass_change").html()).render(data, function(html) {
				layer_pass = layer.open({
					title: '重置密码',
					skin: 'layer-tips-class',
					type: 1,
					area: ['550px'],
					content: html,
				});
			});
		}
		
		form.on('submit(repass)', function(data) {
			
			if (repeat_flag) return false;
			repeat_flag = true;
			
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/modifyPassword"),
				data: data.field,
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;

					if (res.code == 0) {
						layer.closeAll('page');
					}
				}
			});
		});

		/**
		 * 设置标签
		 */
		function settingLabels(data) {

			laytpl($("#label_change").html()).render(data, function(html) {
				layer_label = layer.open({
					title: '设置标签',
					skin: 'layer-tips-class',
					type: 1,
					area: ['450px'],
					content: html,
					success: function(){
						if (data.label) {
							var label = data.label.split(',');
							label.forEach(function (i) {
								$('#reset_label [name="label_id'+ i +'"]').prop('checked', true);
								form.render();
							})

						}
					}
				});
			});

			form.render();
		}
		
		form.on('submit(setlabel)', function(obj) {
			if (repeat_flag) return false;
			repeat_flag = true;
			var field = obj.field;
			var arr_id = [];
			for (var prop in field) {
				if (prop == 'member_ids') {
					continue;
				}
				arr_id.push(field[prop]);
			}
			$.ajax({
				type: "POST",
				url: ns.url("admin/member/modifyLabel"),
				data: {
					'member_ids': field.member_ids,
					'label_ids': arr_id.toString()
				},
				dataType: 'JSON',
				success: function(res) {
					layer.msg(res.message);
					repeat_flag = false;
					if (res.code == 0) {
						table.reload();
						layer.closeAll('page');
					}
				}
			});
		});

		/**
		 * 搜索功能
		 */
		form.on('submit(search)', function(data) {
			table.reload({
				page: {
					curr: 1
				},
				where: data.field
			});
			return false;
		});

        /**
         *  导出
         */
        form.on('submit(export)', function(data) {
            location.href = ns.url("admin/member/exportMember",data.field);
            return false;
        });

		$(".search-form").click(function() {
			$(".layui-form-search").show();
			$(this).hide();
		});

		$(".form-hide-btn").click(function() {
			$(".layui-form-search").hide();
			$(".search-form").show();
		});

		/**
		 * 表单验证
		 */
		form.verify({
			repass: function(value) {
				if (value != $(".new_pass").val()) {
					return "输入错误,两次密码不一致!";
				}
			}
		});

		/**
		 * 发放优惠券
		 */
		function selectCoupon(data) {
			laytpl($("#recive_coupon").html()).render(data, function(html) {
				layer_coupon = layer.open({
					title: '选择优惠券',
					skin: 'layer-tips-class',
					type: 1,
					area: ['700px', '542px'],
					content: html,
				});
				renderCoupon("", data.member_id);
			});
		}

		/**
		 * 加入黑名单
		 * @param member_ids
		 */
		function addBlacklist(member_ids) {
			layer.confirm('加入黑名单后用户将强制退出无法登录，您确认要将用户加入黑名单吗？', function() {
				$.ajax({
					url: ns.url("admin/member/modifyStatus"),
					data: {member_ids:member_ids},
					dataType: 'JSON',
					type: 'POST',
					success: function(res) {
						layer.msg(res.message);
						if (res.code == 0) {
							table.reload();
						}
					}
				});
			}, function () {
				layer.close();
			});
		}

		/**
		 * 移除黑名单
		 * @param member_ids
		 */
		function removeBlacklist(member_ids) {
			layer.confirm('确定要移除黑名单？', function() {
				$.ajax({
					url: ns.url("admin/member/modifyStatus"),
					data: {
						member_ids: member_ids,
						status: 1
					},
					dataType: 'JSON',
					type: 'POST',
					success: function(res) {
						layer.msg(res.message);
						if (res.code == 0) {
							table.reload();
						}
					}
				});
			}, function () {
				layer.close();
			});
		}
	});
	
	function closePass() {
		layer.close(layer_pass);
	}
	
	function closeLabel() {
		layer.close(layer_label);
	}
</script>
<!-- 发放优惠券弹框 -->
<script type="text/html" id="recive_coupon">
	<div class="recive-coupon">
		<div class="coupon-modal">
			<div class="coupon-list all-coupon">
				<div class="title ns-bg-color-gray">可选优惠券</div>
				<div class="box"></div>
			</div>
			<button class="add">添加</button>
			<div class="coupon-list selected-coupon">
				<div class="title ns-bg-color-gray">已选优惠券</div>
				<div class="box"></div>
			</div>
		</div>
		<div class="modal-operation">
			<button class="layui-btn ns-bg-color save-btn">确定</button>
			<button class="layui-btn layui-btn-primary" onclick="back()">返回</button>
		</div>
	</div>
</script>

<!-- 重置密码弹框html -->
<script type="text/html" id="pass_change">
	<div class="layui-form" id="reset_pass" lay-filter="form">

		<div class="layui-form-item">
			<label class="layui-form-label mid"><span class="required">*</span>新密码：</label>
			<div class="layui-input-block">
				<input type="password" name="password" lay-verify="required" class="layui-input ns-len-mid new_pass" maxlength="18">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label mid"><span class="required">*</span>确认新密码：</label>
			<div class="layui-input-block">
				<input type="password" name="password" lay-verify="repass|required" class="layui-input ns-len-mid" maxlength="18">
			</div>
			<div class="ns-word-aux mid">请再一次输入密码，两次输入密码须一致</div>
		</div>
		
		<div class="ns-form-row mid">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="repass">确定</button>
			<button class="layui-btn layui-btn-primary" onclick="closePass()">返回</button>
		</div>

		<input class="reset-pass-id" type="hidden" name="member_ids" value="{{d.member_id}}"/>
	</div>
</script>

<!-- 设置标签弹框html -->
<script type="text/html" id="label_change">
	<div class="layui-form member-form" id="reset_label" lay-filter="form">
		<div class="layui-form-item">
			<label class="layui-form-label sm">标签：</label>
			<div class="layui-input-block layui_input_block">
				<?php foreach($member_label_list as $member_label_list_k => $member_label_list_v): ?>
				<input type="checkbox" name="label_id<?php echo htmlentities($member_label_list_v['label_id']); ?>" value="<?php echo htmlentities($member_label_list_v['label_id']); ?>" title="<?php echo htmlentities($member_label_list_v['label_name']); ?>" lay-skin="primary">
				<?php endforeach; ?>
			</div>
		</div>
		
		<div class="ns-form-row sm">
			<button class="layui-btn ns-bg-color" lay-submit lay-filter="setlabel">确定</button>
			<button class="layui-btn layui-btn-primary" onclick="closeLabel()">返回</button>
		</div>
		
		<input class="reset-label-id" type="hidden" name="member_ids" value="{{d.member_id}}" />
	</div>
</script>

<script type="text/html" id="toolbarOperation">
	<button class="layui-btn layui-btn-primary" lay-event="setlabel">设置标签</button>
</script>
<script type="text/html" id="batchOperation">
	<button class="layui-btn layui-btn-primary" lay-event="setlabel">设置标签</button>
</script>


</body>
</html>