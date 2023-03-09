<?php /*a:2:{s:62:"/www/wwwroot/www.hunqin.com/app/admin/view/config/sysmadd.html";i:1670823968;s:52:"/www/wwwroot/www.hunqin.com/app/admin/view/base.html";i:1666314447;}*/ ?>
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
	
<link rel="stylesheet" href="https://xyhl.chnssl.com/public/static/ext/video/video.css">
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/ext/searchable_select/searchable_select.css" />
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/common.css" />
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/public/static/css/main.css" />
<link rel="stylesheet" type="text/css" href="https://xyhl.chnssl.com/app/shop/view/public/css/goods_edit.css" />

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
				
<div class="layui-form">
	<div class="ns-tab layui-tab layui-tab-brief" lay-filter="goods_tab">
		<div class="layui-tab-content">

			<!-- 基础设置 -->
			<div class="layui-tab-item layui-show">

				<!-- 商品类型 -->
				<div class="layui-card ns-card-common">
					<div class="layui-card-header">
						<span class="ns-card-title">使用说明</span>
					</div>

					<div class="layui-card-body">
					    <div class="layui-form-item">
                    		<label class="layui-form-label"><span class="required">*</span>详细分类名：</label>
                    		<div class="layui-input-inline">
                    			<input type="text" name="title" lay-verify="name" value="" placeholder="请输入对应详细分类名" autocomplete="off" class="layui-input ns-len-long">
                    		</div>
                    	</div>
						<div class="layui-form-item">
							<label class="layui-form-label">说明视频：</label>
							<!--<div class="layui-input-block">
								<div class="video-thumb">
									<video id="goods_video" class="video-js vjs-big-play-centered" controls="" poster="https://xyhl.chnssl.com/app/shop/view/public/img/goods_video_preview.png" preload="auto"></video>
									<video id="temp_goods_video" class="video-js vjs-big-play-centered" controls="" poster="https://xyhl.chnssl.com/app/shop/view/public/img/goods_video_preview.png" preload="auto"></video>
									<span class="delete-video hide" onclick="deleteVideo()"></span>
								</div>
								<div id="videoUpload" title="商品视频" style="position: absolute;left: 0;width: 250px;height: 90px;opacity: 0;cursor: pointer;z-index:10;"></div>
							</div>-->
							<div>
 
                            <div class="layui-upload" align="left">
                                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                                    <legend>请选择您要上传的文件</legend>
                                </fieldset>
                         
                                <div class="layui-upload-list">
                                    <table class="layui-table">
                                        <thead>
                                        <!--<div class="layui-form-item">
                                            <div>
                                                <label class="layui-form-label"> 文件名：</label>
                                                <div class="layui-inline">
                                                    <input class="layui-input" name="name" id="name" autocomplete="off"
                                                           placeholder="请输入文件名">
                                                </div>                 
                         
                                                描述：
                                                <div class="layui-inline">
                                                    <input class="layui-input" name="description" id="description" autocomplete="off"
                                                           placeholder="请输入描述">
                                                </div>
                                            </div>
                                        </div>-->
                         <!--<input class="layui-input" type="hidden" name="video_url" value="">-->
                                        <tr style="margin-left: 50px">
                                            <th>文件名</th>
                                            <th>大小</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="demoList"></tbody>
                                    </table>
                         
                                </div>
                                <div align="center">
                                    <button type="button" class="layui-btn layui-btn-normal" id="testList">选择文件</button>
                                    <button type="button" class="layui-btn" id="testAction">开始上传</button>
                                </div>
                            </div>
                        </div>

						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">权重：</label>
							<div class="layui-input-block">
								<input type="hidden" id="video_url" name="video_url" placeholder="在此输入外链视频地址" autocomplete="off" class="layui-input ns-len-long" value="">
								<input type="text" name="sort" placeholder="权重" autocomplete="off" class="layui-input ns-len-long">
							</div>
						</div>
				</div>
			</div>
			<!--	问卷调查-->
	</div>

	<div class="fixed-btn">
		<button class="layui-btn layui-btn-primary ns-border-color ns-text-color js-prev" lay-submit="" lay-filter="prev">上一步</button>
		<button class="layui-btn ns-bg-color js-save" lay-submit="" lay-filter="save">保存</button>
		<button class="layui-btn layui-btn-primary ns-border-color ns-text-color js-next" lay-submit="" lay-filter="next">下一步</button>
	</div>
</div></div>

<!--选择商品分类-->


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



<script src="https://xyhl.chnssl.com/public/static/ext/drag-arrange.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/video/videojs-ie8.min.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/video/video.min.js"></script>
<script src="https://xyhl.chnssl.com/public/static/ext/searchable_select/searchable_select.js"></script>
<script src="https://xyhl.chnssl.com/app/admin/view/public/js/sysm.js"></script>

<script>
	function insRow()
	{

		n = parseFloat(num.innerHTML)+1;
		num.innerHTML= n;
		 s=n-1;
		var x=document.getElementById('myTable').insertRow(-1)
		var y=x.insertCell(0)
		var z=x.insertCell(1)
		y.innerHTML='<p style="text-align: right;"> 问题 ' + n + '&nbsp; <a href="#del" class="delwt"> <p   style="text-align: right;">-删除问题</p></a> </p>'
		z.innerHTML='<p>问题标题</p><input class="common-text" name="title[]" size="50" value="" type="text">                                        <p>问题类型：<input name="type[' + s + ']" value="0" type="radio" checked="" style="display:inline-block" class="xuanzhe"/>  单选题  <input name="type[' + s + ']" value="2" type="radio" style="display:inline-block" class="tiankong" /> 填空题</p>                                        <div class="ipt_div"><p>选项1：<input class="common-text" name="answer1[]" size="50" value="" type="text"></p>                                        <p>选项2：<input class="common-text" name="answer2[]" size="50" value="" type="text"></p>                                        <p>选项3：<input class="common-text" name="answer3[]" size="50" value="" type="text"></p>                                        <p>选项4：<input class="common-text" name="answer4[]" size="50" value="" type="text"></p>                                        <p>选项5：<input class="common-text" name="answer5[]" size="50" value="" type="text"></p>                                        <p>选项6：<input class="common-text" name="answer6[]" size="50" value="" type="text"></p></div>'
	}

	function tiankong() {
		$(this).parent().parent().find('.ipt_div').css('display','none');
	}
	function xuanzhe() {
		$(this).parent().parent().find('.ipt_div').css('display','inline-block');
	}
	$(function () {
		$('body').on("click",'.xuanzhe',function () {
			$(this).parent().parent().find('.ipt_div').css('display','inline-block');
		})
		$('body').on("click",'.tiankong',function () {
			$(this).parent().parent().find('.ipt_div').css('display','none');
		})
		$('body').on("click",'.delwt',function () {
			$(this).parents('tr').remove();
			num.innerHTML = parseFloat(num.innerHTML) -1;
		})

	})

</script>
<script type="text/javascript" charset="utf-8">
    layui.use('upload', function () {
        var $ = layui.jquery
            , upload = layui.upload;
 
        //多文件列表
        var demoListView = $('#demoList')
            , uploadListIns = upload.render({
            elem: '#testList'
            , url: ns.url("shop/upload/video")
            , accept: 'file'
            , multiple: true
            , auto: false
            , size: 51200
            , bindAction: '#testAction'
            , before: function () {
                /*return false;
                console.log("add->" + id + "-" + r);
                alert("ft->" + fileTypeId);
                layer.msg("请选择文件类型！", {icon: 1, time: 1000});
                if (fileTypeId == null && fileTypeId == '' && fileTypeId == "") {
                }*/
                /*this.data = {
                    "name": $("#name").val(),
                   
                };*/
            }
 
 
            , choose: function (obj) {
                var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
                //读取本地文件
                obj.preview(function (index, file) {
                    var tr = $(['<tr id="upload-' + index + '">'
                        , '<td>' + file.name + '</td>'
                        , '<td>' + (file.size / 1014).toFixed(1) + 'kb</td>'
                        , '<td>等待上传</td>'
                        , '<td>'
                        , '<button class="layui-btn layui-btn-mini demo-reload layui-hide">重传</button>'
                        , '<button class="layui-btn layui-btn-mini layui-btn-danger demo-delete">删除</button>'
                        , '</td>'
                        , '</tr>'].join(''));
 
                    //单个重传
                    tr.find('.demo-reload').on('click', function () {
                        obj.upload(index, file);
                    });
 
                    //删除
                    tr.find('.demo-delete').on('click', function () {
                        delete files[index]; //删除对应的文件
                        tr.remove();
                        uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
                    });
 
                    demoListView.append(tr);
                });
            }
            , done: function (res, index, upload) {
                /*debugger;*/
                if (res.code == 10070) { //上传成功
                    var tr = demoListView.find('tr#upload-' + index)
                        , tds = tr.children();
                    tds.eq(2).html('<span style="color#5FB878;">上传成功</span>');
                    tds.eq(3).html(''); //清空操作
                    let videos = $('#video_url').val();
                    if (videos == "") {
                        $('#video_url').val(res.data.path);
                    }else{
                        videos+=','+res.data.path;
                        $('#video_url').val(videos)
                    }
                    return delete this.files[index]; //删除文件队列已经上传成功的文件
                } else if (res.code == 2) {
                    layer.msg("请选择文件类型！", {icon: 5, time: 1000});
                }
                this.error(index, upload);
            }
            , error: function (index) {
                /*debugger;*/
                var tr = demoListView.find('tr#upload-' + index)
                    , tds = tr.children();
                tds.eq(2).html('<span style="color#FF5722;">上传失败1</span>');
                tds.eq(3).find('.demo-reload').removeClass('layui-hide'); //显示重传
            }
        });
    });
</script>

</body>
</html>