<?php /*a:2:{s:67:"/www/wwwroot/ls.chnssl.com/addon/store/store/view/store/config.html";i:1614519696;s:32:"addon/store/store/view/base.html";i:1654843035;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($store_info['store_name']) && ($store_info['store_name'] !== '')?$store_info['store_name']:"小谷粒门店端")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/addon/store/store/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/addon/store/store/view/public/img/",
			site_id:"<?php echo isset($store_id) ? htmlentities($store_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		.img_size{width:100%;height:100%;}
	</style>
	
<style>
    #container{ width: 650px; height: 500px; }
    .empty-address{ display: none; }
    .address-content {display: inline-block;vertical-align: top;}
    .ns-form {margin-top: 0;}
</style>

</head>

<body>

	<div class="layui-layout layui-layout-admin">
		
		<div class="layui-side ns-second-nav">
			<div class="layui-side-scroll">
				<div class="ns-logo">
					<div class="logo-box" id="logo">
						<?php if(!empty($store_info['store_image'])): ?>
						<img layer-src src="<?php echo img($store_info['store_image']); ?>" class="img_size"/>
						<?php else: ?>
						<img layer-src src="<?php echo img($default_img['default_store_img']); ?>" class="img_size"/>
						<?php endif; ?>
					</div>
					<p class="store-name"><?php echo htmlentities($store_info['store_name']); ?></p>
				</div>
				<!--一级菜单 -->
				<ul class="layui-nav layui-nav-tree">
					<?php foreach($menu as $menu_k => $menu_v): ?>
					<li class="layui-nav-item layui-nav-itemed <?php if($menu_v['selected']): ?>layui-this<?php endif; ?>">
						<a href="<?php echo htmlentities($menu_v['url']); ?>" class="layui-menu-tips">
							<div class="stair-menu">
								<img src="https://ls.chnssl.com/<?php echo htmlentities($menu_v['icon']); ?>" alt="">
							</div>
							<span><?php echo htmlentities($menu_v['title']); ?></span>
						</a>
					</li>
					<?php if($menu_v['selected']): 
					$second_menu = $menu_v["child_list"];
					 ?>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		
		<!-- 面包屑 -->
		
		<div class="ns-crumbs<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?> submenu-existence<?php endif; ?>">
			<span class="layui-breadcrumb" lay-separator="-">
				<?php foreach($crumbs as $crumbs_k => $crumbs_v): if($crumbs_k == count($crumbs) - 1): ?>
					<a><cite><?php echo htmlentities($crumbs_v['title']); ?></cite></a>
					<?php else: ?>
					<a href="<?php echo htmlentities($crumbs_v['url']); ?>"><?php echo htmlentities($crumbs_v['title']); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</span>
			
			<div class="layui-header ns-user">
				<!-- 账号 -->
				<ul class="layui-nav">
					<li class="layui-nav-item">
						<div class="ns-img-box" id="logo_bot">
							<?php if(!empty($store_info['store_image'])): ?>
							<img layer-src src="<?php echo img($store_info['store_image']); ?>" class="img_size"/>
							<?php else: ?>
							<img layer-src src="<?php echo img($default_img['default_store_img']); ?>" class="img_size"/>
							<?php endif; ?>
						</div>
						
						<a href="javascript:;"><?php echo htmlentities($user_info['username']); ?></a>
						<dl class="layui-nav-child">
							<!-- <dd class="ns-reset-pass" onclick="resetPassword();">
								<a href="javascript:;">修改密码</a>
							</dd> -->
							<dd>
								<a href="<?php echo addon_url('store://store/login/logout'); ?>" class="login-out">退出登录</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
		

		<div class="ns-body layui-body <?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>exist<?php endif; ?>">
			<!-- 四级菜单 -->
			
			<?php if(!(empty($second_menu) || (($second_menu instanceof \think\Collection || $second_menu instanceof \think\Paginator ) && $second_menu->isEmpty()))): ?>
			<div class="layui-header">
				<ul class="layui-nav layui-layout-left">
					<?php foreach($second_menu as $menu_second_k => $menu_second_v): ?>
					<li class="layui-nav-item">
						<a href="<?php echo htmlentities($menu_second_v['url']); ?>" class="layui-menu-tips <?php if($menu_second_v['selected']): ?>layui-this<?php endif; ?>">
							<span><?php echo htmlentities($menu_second_v['title']); ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			

			<!-- 内容 -->
			<div class="ns-body-content">
				
<div class="layui-form ns-form" lay-filter="storeform">
    <div class="layui-form-item">
        <label class="layui-form-label fxq"><span class="required">*</span>门店名称：</label>
        <div class="layui-input-block">
            <input type="text" name="store_name" autocomplete="off" lay-verify="store_name" value="<?php echo htmlentities($info['store_name']); ?>" class="layui-input ns-len-long">
        </div>
        <div class="ns-word-aux">门店的名称（招牌）</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label img-upload-lable">门店图片：</label>
        <div class="layui-input-block">
            <div class="upload-img-block img-upload">
				
				<div class="upload-img-box <?php if(!(empty($info['store_image']) || (($info['store_image'] instanceof \think\Collection || $info['store_image'] instanceof \think\Paginator ) && $info['store_image']->isEmpty()))): ?>hover<?php endif; ?>">
					<div class="ns-upload-default" id="storeUpload">
						<?php if($info['store_image']): ?>
						<div id="preview_storeUpload" class="preview_img">
							<img layer-src src="<?php echo img($info['store_image']); ?>" class="img_prev"/>
						</div>
						<?php else: ?>
						<div class="upload">
							<img src="https://ls.chnssl.com/addon/store/store/view/public/img/upload_img.png"/>
							<p>点击上传</p>
						</div>
						<?php endif; ?>
					</div>
					<div class="operation">
						<div>
							<i title="图片预览" class="iconfont iconreview js-preview" style="margin-right: 20px;"></i>
							<i title="删除图片" class="layui-icon layui-icon-delete js-delete"></i>
						</div>
						<div class="replace_img js-replace">点击替换</div>
					</div>
					<input type="hidden" name="store_image" value="<?php echo htmlentities($info['store_image']); ?>">
				</div>
            </div>
        </div>
        <div class="ns-word-aux">
            <p>门店图片在PC及移动端对应页面及列表作为门店标志出现。</p>
            <p>建议图片尺寸：100 * 100像素，图片格式：jpg、png、jpeg。</p>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">门店电话：</label>
        <div class="layui-input-block">
            <input type="text" name="telphone" autocomplete="off" class="layui-input  ns-len-long" value="<?php echo htmlentities($info['telphone']); ?>">
        </div>
        <div class="ns-word-aux">请输入正确的电话号码或者手机号</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">营业状态：</label>
        <div class="layui-input-block">
            <input type="checkbox" name="status" value="1" <?php if($info['status'] == 1): ?> checked <?php endif; ?> lay-skin="switch">
        </div>
        <div class="ns-word-aux">是否开启营业，关闭即停业</div>
    </div>
	
	<div class="layui-form-item">
	    <label class="layui-form-label">是否启用自提：</label>
	    <div class="layui-input-block">
	        <input type="checkbox" value="1" name="is_pickup" lay-skin="switch" <?php if(!empty($info) && $info['is_pickup']==1): ?>checked<?php endif; ?>>
	    </div>
		<div class="ns-word-aux">开启自提后，用户可在购买商品时选择到店自提，可到最近的门店自提</div>
	</div>

    <!--自提点地址-->
    <div class="layui-form-item">
        <label class="layui-form-label"><span class="required">*</span>门店地址：</label>
        <div class="layui-input-inline ns-len-mid area-select">
            <select name="province_id" lay-filter="province_id" lay-verify="province_id">
                <option value="">请选择省份</option>
                <?php foreach($province_list as $k => $v): ?>
                <option value="<?php echo htmlentities($v['id']); ?>" <?php if($info['province_id'] == $v['id']): ?> selected <?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="layui-input-inline ns-len-mid area-select">
            <select name="city_id"  lay-filter="city_id" lay-verify="city_id">
                <option value="">请选择城市</option>
            </select>
        </div>

        <div class="layui-input-inline ns-len-mid area-select">
            <select name="district_id"  lay-filter="district_id" lay-verify="district_id">
                <option value="">请选择区/县</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <input type="text" name="address"  placeholder="请填写门店的具体地址。" value="<?php echo htmlentities($info['address']); ?>" lay-verify="required" autocomplete="off" class="layui-input ns-len-long address-content">
            <input type = "hidden" name="longitude" lay-verify="required" class="layui-input" value="<?php echo htmlentities($info['longitude']); ?>"/>
            <input type = "hidden" name="latitude" lay-verify="required" class="layui-input" value="<?php echo htmlentities($info['latitude']); ?>"/>
            <button class='layui-btn-primary layui-btn' onclick="refreshFrom();">查找地址</button>
        </div>
        <div class="ns-word-aux">点击查找地址可在地图上显示输入的地理位置</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">地图定位：</label>
        <div class="layui-input-block ns-special-length">
            <div id="container" class="selffetch-map"></div>
        </div>
        <div class="ns-word-aux empty-address">请选择地理位置！在地图上点击得到的地理位置会自动填入到对应的输入框中</div>
    </div>

    <div class="layui-form-item layui-hide">
        <label class="layui-form-label">是否启用外卖配送：</label>
        <div class="layui-input-block">
            <input type="checkbox"  value="1"  name="is_o2o" lay-skin="switch" <?php if(!empty($info) && $info['is_o2o']==1): ?>checked<?php endif; ?>>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">营业时间：</label>
        <div class="layui-input-block">
            <input type="text" name="open_date" value="<?php echo htmlentities($info['open_date']); ?>" class="layui-input ns-len-long">

        </div>
        <div class="ns-word-aux ">例：上午9:00-12:00，下午2:00-6:00</div>
    </div>

    <div class="ns-form-row">
        <button class="layui-btn ns-bg-color" lay-submit lay-filter="save">保存</button>
    </div>

</div>

			</div>

			<!--<div class="ns-footer">
				
				<a class="ns-footer-img" href="#"><img src="<?php if(!empty($copyright['logo'])): ?> <?php echo img($copyright['logo']); else: ?>https://ls.chnssl.com/public/static/img/copyright_logo.png<?php endif; ?>" /></a>
				
			</div>-->
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
				url: ns.url("shop/login/modifypassword"),
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
		
	</script>


<script type="text/javascript" src="<?php echo get_http_type(); ?>://webapi.amap.com/maps?v=1.4.6&amp;key=<?php if(empty($map_key['gaode_map_key'])): ?>2df5711d4e2fd9ecd1622b5a53fc6b1d<?php else: ?><?php echo htmlentities($map_key['gaode_map_key']); ?><?php endif; ?>"></script>
<script type="text/javascript" src="https://ls.chnssl.com/app/shop/view/public/js/address.js"></script>
<script type="text/javascript" src="https://ls.chnssl.com/public/static/js/map_address.js"></script>
<script>
    var form, repeat_flag, map_class, upload;

    layui.use(['form','upload'], function() {
        form = layui.form;
        upload = layui.upload;
        repeat_flag = false;//防重复标识

        form.render();

        var initdata = {province_id : '<?php echo htmlentities($info['province_id']); ?>', city_id : '<?php echo htmlentities($info['city_id']); ?>', district_id : '<?php echo htmlentities($info['district_id']); ?>'};
        initAddress(initdata, "storeform");

        if('<?php echo htmlentities($info['latitude']); ?>' == "" || '<?php echo htmlentities($info['longitude']); ?>' == ""){
            var latlng = {lat:'',lng:''};
        }else{
            var latlng = {lat:'<?php echo htmlentities($info['latitude']); ?>',lng:'<?php echo htmlentities($info['longitude']); ?>'};
        }

        //地图展示
        map_class = new mapClass("container",latlng);
        form.render();

        /**
         * 验证码
         */
        form.verify({
            required : function(value, item){
                var msg = $(item).attr("placeholder") != undefined ? $(item).attr("placeholder") : '';
                if(value == '') return msg;
            },
            province_id : function(value, item){
                if(value == ''){
                    return '请选择省份';
                }
            },
            city_id : function(value, item){
                if(value == ''){
                    return '请选择城市';
                }
            },
            district_id : function(value, item){
                if(value == ''){
                    return '请选择区/县';
                }
            },
            tel : function(value, item) {
                var tel = /^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/; //固定电话
                var phone = /^1[345678]\d{9}$/; //手机
                if (value != '') {
                    if (!(tel.test(value)) && !(phone.test(value))) {
                        return '请输入正确的电话号码或手机号！';
                    }
                }
            },
            store_name : function (value,item) {
                if(value == ""){
                    return '请输入门店名称';
                }
            }
        });

        // 门店logo
        var storeUpload_upload = new Upload({
            elem: '#storeUpload',
			url: ns.url("shop/upload/image"),
        });

        /**
         * 监听提交
         */
        form.on('submit(save)', function(data){

            if( data.field.longitude == "" || data.field.latitude == ""){
                layer.msg('请确认地理位置!');
                $(".empty-address").show();
                return;
            }else{
                $(".empty-address").hide();
            }

            var full_address  = [];
            full_address.push($("select[name=province_id] option:selected").text());
            full_address.push($("select[name=city_id] option:selected").text());
            full_address.push($("select[name=district_id] option:selected").text());

            data.field.full_address = full_address.toString();

            if(repeat_flag) return;
            repeat_flag = true;
			
			//删除图片
			if(!data.field.store_image) storeUpload_upload.delete();
			
            $.ajax({
                type : "POST",
                dataType: 'JSON',
                url : ns.url("store://store/store/config"),
                async : true,
                data : data.field,
                success : function(res) {
                    repeat_flag = false;

                    if (res.code == 0) {
                        layer.msg('操作成功');
                        location.reload();
                    } else {
                        layer.msg(res.message);
                    }
                }
            })
        });
    });

    function back() {
        location.href = ns.url("shop/store/lists");
    }


    /**
     * 重新渲染表单
     */
    function refreshFrom(){
        form.render();
        orderAddressChange();//改变地址
        map_class.mapChange();
    }

    //动态改变订单地址赋值
    function orderAddressChange(){
        map_class.address.province = $("select[name=province_id]").val();
        map_class.address.province_name = $("select[name=province_id] option:selected").text();
        map_class.address.city = $("select[name=city_id]").val();
        map_class.address.city_name = $("select[name=city_id] option:selected").text();
        map_class.address.district = $("select[name=district_id]").val();
        map_class.address.district_name = $("select[name=district_id] option:selected").text();
        map_class.address.address = $("input[name=address]").val()
    }

    /**
     * 地址下拉框（主要用于坐标记录）
     */
    function selectCallBack(){
        $("input[name=longitude]").val(map_class.address.longitude);//坐标
        $("input[name=latitude]").val(map_class.address.latitude);//坐标
    }

    //地图点击回调事件
    function mapChangeCallBack(){
        $("input[name=address]").val(map_class.address.address);//详细地址
        $("input[name=longitude]").val(map_class.address.longitude);//坐标
        $("input[name=latitude]").val(map_class.address.latitude);//坐标
        $.ajax({
            type : "POST",
            dataType: 'JSON',
            url : ns.url("shop/address/getGeographicId"),
            async : true,
            data : {
                "address" : map_class.address.area
            },
            success : function(data) {
                map_class.address.province = data.province_id;
                map_class.address.city = data.city_id;
                map_class.address.district = data.district_id;
                map_class.address.township = data.subdistrict_id;
                map_class.map_change = false;
                form.val("storeform", {
                    "province_id": data.province_id
                });
                $("select[name=province_id]").change();
                form.val("storeform", {
                    "city_id": data.city_id
                });
                $("select[name=city_id]").change();
                form.val("storeform", {
                    "district_id": data.district_id
                });
                refreshFrom();//重新渲染form
                map_class.map_change = true;
            }
        });
    }

</script>

</body>

</html>