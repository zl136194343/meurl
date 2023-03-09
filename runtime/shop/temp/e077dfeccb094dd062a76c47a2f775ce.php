<?php /*a:2:{s:57:"/www/wwwroot/ls.chnssl.com/app/shop/view/apply/index.html";i:1661742392;s:50:"/www/wwwroot/ls.chnssl.com/app/shop/view/base.html";i:1660100996;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title><?php echo htmlentities((isset($menu_info['title']) && ($menu_info['title'] !== '')?$menu_info['title']:"")); ?> - <?php echo htmlentities((isset($shop_info['site_name']) && ($shop_info['site_name'] !== '')?$shop_info['site_name']:"")); ?></title>
	<meta name="keywords" content="$shop_info['seo_keywords']}">
	<meta name="description" content="$shop_info['seo_description']}">
	<link rel="icon" type="image/x-icon" href="https://ls.chnssl.com/public/static/img/shop_bitbug_favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/public/static/ext/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="https://ls.chnssl.com/app/shop/view/public/css/common.css" />
	<script src="https://ls.chnssl.com/public/static/js/jquery-3.1.1.js"></script>
	<script src="https://ls.chnssl.com/public/static/ext/layui/layui.js"></script>
	<script src="https://ls.chnssl.com/public/static/js/jquery.cookie.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script>
		layui.use(['layer', 'upload', 'element'], function() {});
		var nsColor = '#FF6A00';
		window.ns_url = {
			baseUrl: "https://ls.chnssl.com/",
			route: ['<?php echo request()->module(); ?>', '<?php echo request()->controller(); ?>', '<?php echo request()->action(); ?>'],
			IMGPATH:"https://ls.chnssl.com/app/shop/view/public/img/",
			site_id:"<?php echo isset($site_id) ? htmlentities($site_id) : 0; ?>"
		};
	</script>
	<script src="https://ls.chnssl.com/public/static/js/common.js"></script>
	<script src="https://ls.chnssl.com/app/shop/view/public/js/common.js"></script>
	<style>
		.ns-calendar{background: url("https://ls.chnssl.com/public/static/img/ns_calendar.png") no-repeat center / 16px 16px;}
		.layui-logo{height: 100%;display: flex;align-items: center;}
		.layui-logo a{display: flex;justify-content: center;align-items: center;width: 200px;height: 50px;}
		.layui-logo a img{max-height: 100%;max-width: 100%;}
		.goods-preview .qrcode-wrap {max-width: 130px;  overflow: hidden;}
		.goods-preview .qrcode-wrap input {top: 300px;position: absolute;}
		@media only screen and (max-width: 1340px) {
			.layui-nav .layui-nav-item a {
				padding: 0 15px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 1200px) {
			.layui-nav .layui-nav-item a {
				padding: 0 10px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 920px) {
			.layui-nav .layui-nav-item a {
				padding: 0 5px;
			}
			.layui-nav.ns-head-account .layui-nav-item a{
				padding: 0 20px;
			}
		}
		@media only screen and (max-width: 1090px) {
			.ns-shop-ewm {
				display: none;
			}
		}
		.copy_link{cursor:pointer;}
		.goods-preview{position: relative;}
		.pic_big{display:none;width:220px !important;height:220px !important;margin:auto;position: absolute;left:0;top:0;z-index:100;}
		.pic_ori:hover .pic_big{display:block;}
	</style>
	
<link rel="stylesheet" href="https://ls.chnssl.com/app/shop/view/public/css/apply_index.css">

</head>

<body>

<div class="layui-layout layui-layout-admin" lay-filter="applyCheck">
    <div class="apply-header">
        <div class="apply-header-box">
            <span class="apply-header-title">欢迎您，您可以申请入驻了！</span>
            <span class="phone">联系电话：<?php echo htmlentities($website_info['web_phone']); ?> </span>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;" class="layui-elip"><?php echo htmlentities($user_info["username"]); ?></a>
                    <dl class="layui-nav-child">
                        <dd><a href="<?php echo url('shop/login/login'); ?>">退出登录</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <div class="apply-body">
        <!-- 开店方式 -->
        <?php if($procedure == 1): ?>
        <div class="shop-empty">
            <h2  class="empty-title">选择您要创建店铺的方式</h2>
            <ul class="empty-content">
                <?php if($id_experience == 1): ?>
                <li>
                    <div class="empty-img-box">
                        <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/quickly_shop.png" alt="">
                    </div>
                    <span class="empty-content-title">快速开店</span>
                    <span class="empty-content-desc">一键开店，抢先体验</span>
                    <button class="ns-bg-color layui-btn open-experience">立即开店</button>
                </li>
                <?php endif; ?>
                <li>
                    <div class="empty-img-box">
                        <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/apply_shop.png" alt="">
                    </div>
                    <span class="empty-content-title">申请开店</span>
                    <span class="empty-content-desc">入驻加盟，合作共赢</span>
                    <button class="ns-bg-color layui-btn apply-shop">立即开店</button>
                </li>
            </ul>
        </div>
        <?php endif; ?>

        <!-- 入驻协议 -->
        <div class="settlement-agreement layui-form layui-hide">
            <h2>签订入驻协议</h2>
            <h2><?php echo htmlentities($shop_apply_agreement["data"]["title"]); ?></h2>
            <div class="agreement-content">
                <?php echo html_entity_decode($shop_apply_agreement["data"]["content"]); ?>
            </div>
            <div class="agreement-foot" style="margin-top: 40px;">
                <input type="checkbox" title="我已阅读并同意以上协议" lay-skin="primary" class="ns-text-color" lay-filter="apply_info">
                <div class="apply-btn-box">
                    <button class="ns-bg-color layui-btn apply-info">下一步，填写申请信息</button>
                </div>
            </div>
        </div>

        <!-- 开店套餐 -->
        <div class="store-level-box layui-hide">
            <h2 class="apply-h2-title">选择开店套餐</h2>
            <ul class="store-level">
                <?php foreach($group_info as $shop_group_key => $shop_group_val): ?>
                <li data-group_id ="<?php echo htmlentities($shop_group_val['group_id']); ?>" data-group_fee="<?php echo htmlentities($shop_group_val['fee']); ?>">
                    <h2 class="group_name"><?php echo htmlentities($shop_group_val["group_name"]); ?></h2>
                    <span class="remark"><?php echo htmlentities($shop_group_val["remark"]); ?></span>
                    <ul class="store-level-sublevel">
                        <?php foreach($shop_group_val["promotion"] as $promotion_key => $promotion_val): ?>
                        <li>
                            <?php if($promotion_val['is_checked'] == 1): ?><span class="ns-text-color">√</span><?php else: ?><span class="ns-red-color">×</span><?php endif; ?>
                            <span class="<?php if($promotion_val['is_checked'] != 1): ?> is-checked<?php endif; ?>"><?php echo htmlentities($promotion_val['title']); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <button class="layui-btn layui-btn-primary ns-border-color ns-text-color">￥ <?php echo htmlentities($shop_group_val['fee']); ?>/年</button>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="apply-btn-box">
                <button class="ns-bg-color layui-btn store_level-step">上一步</button>
                <button class="ns-bg-color layui-btn store_level-lower" lay-submit lay-filter="store_level">下一步</button>
            </div>
        </div>

        <!-- 类型选择 -->
        <div class="application-type layui-hide layui-form">
            <h2>填写公司认证信息</h2>
            <div class="cert-type">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="required">*</span>申请类型：</label>
                    <div class="layui-input-inline ns-len-long">
                        <input type="radio" name="cert_type" lay-filter="application_type" value="2" title="公司" checked>
                        <input type="radio" name="cert_type" lay-filter="application_type" value="1" title="个人">
                    </div>
                </div>
            </div>
        </div>

        <!-- 公司认证信息 -->
        <div class="layui-form company-authentication-info layui-hide" lay-filter="update_address">
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>公司名称：</label>
                <div class="layui-input-inline">
                    <input name="company_name" type="text" value="<?php echo htmlentities($shop_apply_info['company_name']); ?>" placeholder="请输入公司名称" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>联系地址：</label>
                <div class="layui-input-inline area-select ns-len-short">
                    <select name="province_id" lay-filter="province_id" lay-verify="province_id">
                        <option value="">请选择省份</option>
                        <?php foreach($province_list as $k => $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="layui-input-inline area-select ns-len-short">
                    <select name="city_id" lay-filter="city_id" lay-verify="city_id">
                        <option value="">请选择城市</option>
                    </select>
                </div>

                <div class="layui-input-inline area-select ns-len-short">
                    <select name="district_id" lay-filter="district_id" lay-verify="district_id">
                        <option value="">请选择区/县</option>
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>公司地址：</label>
                <div class="layui-input-inline">
                    <input name="company_address" type="text" value="<?php echo htmlentities($shop_apply_info['company_address']); ?>" placeholder="请输入详细地址" maxlength="10" autocomplete="off" lay-verify="address" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>统一社会信用码：</label>
                <div class="layui-input-inline">
                    <input name="business_licence_number" type="text" value="<?php echo htmlentities($shop_apply_info['business_licence_number']); ?>" placeholder="请输入统一社会信用码" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable"><span class="required">*</span>营业执照电子版：</label>
                <div class="layui-input-block img-upload">
                    <div class="upload-img-block">
                        <div class="upload-img-box <?php if(!(empty($shop_apply_info['business_licence_number_electronic']) || (($shop_apply_info['business_licence_number_electronic'] instanceof \think\Collection || $shop_apply_info['business_licence_number_electronic'] instanceof \think\Paginator ) && $shop_apply_info['business_licence_number_electronic']->isEmpty()))): ?>hover<?php endif; ?>">
                        <div class="ns-upload-default" id="businessLicense">
                            <?php if(!(empty($shop_apply_info['business_licence_number_electronic']) || (($shop_apply_info['business_licence_number_electronic'] instanceof \think\Collection || $shop_apply_info['business_licence_number_electronic'] instanceof \think\Paginator ) && $shop_apply_info['business_licence_number_electronic']->isEmpty()))): ?>
                            <div id="preview_businessLicense" class="preview_img">
                                <img layer-src src="<?php echo img($shop_apply_info['business_licence_number_electronic']); ?>" class="img_prev"/>
                            </div>
                            <?php else: ?>
                            <div class="upload">
                                <img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
                        <input type="hidden" name="business_licence_number_electronic" value="<?php echo htmlentities($shop_apply_info['business_licence_number_electronic']); ?>" lay-verify="required"/>
                    </div>
                </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">法定经营范围：</label>
                <div class="layui-input-inline" style="margin-top: 15px;">
                    <textarea name="business_sphere" type="text" placeholder="请输入法定经营范围" class="layui-textarea ns-len-long"><?php echo htmlentities($shop_apply_info['business_sphere']); ?></textarea>
                </div>
            </div>

            <!-- <div class="layui-form-item">
                <label class="layui-form-label">纳税人识别号：</label>
                <div class="layui-input-inline">
                    <input name="taxpayer_id" value="<?php echo htmlentities($shop_apply_info['taxpayer_id']); ?>" type="text" placeholder="请输入识别号" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">税务登记证号：</label>
                <div class="layui-input-inline">
                    <input name="tax_registration_certificate" value="<?php echo htmlentities($shop_apply_info['tax_registration_certificate']); ?>" type="text" placeholder="请输入税务登记证号" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable">税务登记证电子版：</label>
                <div class="layui-input-block img-upload">
                    <input type="hidden" class="layui-input" name="tax_registration_certificate_electronic" value="<?php echo htmlentities($shop_apply_info['tax_registration_certificate_electronic']); ?>"/>
                    <div class="upload-img-block" data-upload data-id="taxation" data-name="tax_registration_certificate_electronic">
                        <div class="upload-img-box" id="taxation">
                            <?php if(empty($shop_apply_info['contacts_card_electronic_2']) || (($shop_apply_info['contacts_card_electronic_2'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_2'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_2']->isEmpty())): ?>
                            <div class="ns-upload-default">
                                <img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" />
                                <p>点击上传</p>
                            </div>
                            <?php else: ?>
                            <img src="<?php echo img($shop_apply_info['tax_registration_certificate_electronic']); ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="ns-word-aux">注意：若公司三证合一，请上传营业执照。</div>
            </div> -->

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>法人姓名：</label>
                <div class="layui-input-inline">
                    <input name="contacts_name" type="text" value="<?php echo htmlentities($shop_apply_info['contacts_name']); ?>" placeholder="请输入法人姓名" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>法人手机：</label>
                <div class="layui-input-inline">
                    <input name="contacts_mobile" type="number" value="<?php echo htmlentities($shop_apply_info['contacts_mobile']); ?>" min="0" placeholder="请输入手机号" lay-verify="required|telphone" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>法人身份证：</label>
                <div class="layui-input-inline">
                    <input name="contacts_card_no" type="text" value="<?php echo htmlentities($shop_apply_info['contacts_card_no']); ?>" placeholder="请输入身份证号" lay-verify="required|card" class="layui-input ns-len-long">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable"><span class="required">*</span>法人身份证正面：</label>
                <div class="layui-input-block img-upload">
                    <div class="upload-img-block">
                        <div class="upload-img-box <?php if(!(empty($shop_apply_info['contacts_card_electronic_2']) || (($shop_apply_info['contacts_card_electronic_2'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_2'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_2']->isEmpty()))): ?>hover<?php endif; ?>" >
							<div class="ns-upload-default" id="companyPositiveContactsID">
								<?php if(!(empty($shop_apply_info['contacts_card_electronic_2']) || (($shop_apply_info['contacts_card_electronic_2'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_2'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_2']->isEmpty()))): ?>
								<div id="preview_companyPositiveContactsID" class="preview_img">
									<img layer-src src="<?php echo img($shop_apply_info['contacts_card_electronic_2']); ?>" class="img_prev"/>
								</div>
								<?php else: ?>
								<div class="upload">
									<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
							<input type="hidden" name="contacts_card_electronic_2" value="<?php echo htmlentities($shop_apply_info['contacts_card_electronic_2']); ?>" lay-verify="required"/>
						</div>
					</div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable"><span class="required">*</span>法人身份证反面：</label>
                <div class="layui-input-block img-upload" style="margin-top: 15px;">
                    <div class="upload-img-block">
                        <div class="upload-img-box <?php if(!(empty($shop_apply_info['contacts_card_electronic_3']) || (($shop_apply_info['contacts_card_electronic_3'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_3'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_3']->isEmpty()))): ?>hover<?php endif; ?>">
                        <div class="ns-upload-default" id="companyBackContactsID">
                            <?php if(!(empty($shop_apply_info['contacts_card_electronic_3']) || (($shop_apply_info['contacts_card_electronic_3'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_3'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_3']->isEmpty()))): ?>
                            <div id="preview_companyBackContactsID" class="preview_img">
                                <img layer-src src="<?php echo img($shop_apply_info['contacts_card_electronic_3']); ?>" class="img_prev"/>
                            </div>
                            <?php else: ?>
                            <div class="upload">
                                <img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
                        <input type="hidden" name="contacts_card_electronic_3" value="<?php echo htmlentities($shop_apply_info['contacts_card_electronic_3']); ?>" lay-verify="required"/>
                    </div>
                </div>
                </div>
            </div>

            <div class="apply-btn-box">
                <button class="ns-bg-color layui-btn authentication-info-step">上一步</button>
                <button class="ns-bg-color layui-btn authentication-info-lower" lay-submit lay-filter="authentication_info">下一步</button>
            </div>

        </div>

        <!-- 个人认证信息 -->
        <div class="personal-authentication-info layui-hide layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>联系人姓名：</label>
                <div class="layui-input-inline">
                    <input name="contacts_name" type="text" value="<?php echo htmlentities($shop_apply_info['contacts_name']); ?>" placeholder="请输入联系人姓名" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>联系人手机：</label>
                <div class="layui-input-inline">
                    <input name="contacts_mobile" type="number" value="<?php echo htmlentities($shop_apply_info['contacts_mobile']); ?>" min="0" placeholder="请输入联系人手机号" lay-verify="required|telphone" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>身份证号：</label>
                <div class="layui-input-inline">
                    <input name="contacts_card_no" type="text" value="<?php echo htmlentities($shop_apply_info['contacts_card_no']); ?>" placeholder="请输入身份证号" lay-verify="required|card" class="layui-input ns-len-long">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable"><span class="required">*</span>身份证正面：</label>
                <div class="layui-input-block img-upload">
                    <div class="upload-img-block">
                        <div class="upload-img-box <?php if(!(empty($shop_apply_info['contacts_card_electronic_2']) || (($shop_apply_info['contacts_card_electronic_2'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_2'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_2']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="positiveContactsID">
								<?php if(!(empty($shop_apply_info['contacts_card_electronic_2']) || (($shop_apply_info['contacts_card_electronic_2'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_2'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_2']->isEmpty()))): ?>
								<div id="preview_positiveContactsID" class="preview_img">
									<img layer-src src="<?php echo img($shop_apply_info['contacts_card_electronic_2']); ?>" class="img_prev"/>
								</div>
								<?php else: ?>
								<div class="upload">
									<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
							<input type="hidden" name="contacts_card_electronic_2" value="<?php echo htmlentities($shop_apply_info['contacts_card_electronic_2']); ?>" lay-verify="required"/>
						</div>
					</div>
				</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable"><span class="required">*</span>身份证反面：</label>
                <div class="layui-input-block img-upload" style="margin-top: 15px;">
                    <div class="upload-img-block">
                        <div class="upload-img-box <?php if(!(empty($shop_apply_info['contacts_card_electronic_3']) || (($shop_apply_info['contacts_card_electronic_3'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_3'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_3']->isEmpty()))): ?>hover<?php endif; ?>">
							<div class="ns-upload-default" id="backContactsID">
								<?php if(!(empty($shop_apply_info['contacts_card_electronic_3']) || (($shop_apply_info['contacts_card_electronic_3'] instanceof \think\Collection || $shop_apply_info['contacts_card_electronic_3'] instanceof \think\Paginator ) && $shop_apply_info['contacts_card_electronic_3']->isEmpty()))): ?>
								<div id="preview_backContactsID" class="preview_img">
									<img layer-src src="<?php echo img($shop_apply_info['contacts_card_electronic_3']); ?>" class="img_prev"/>
								</div>
								<?php else: ?>
								<div class="upload">
									<img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
							<input type="hidden" name="contacts_card_electronic_3" value="<?php echo htmlentities($shop_apply_info['contacts_card_electronic_3']); ?>" lay-verify="required"/>
						</div>
					</div>
				</div>
			</div>
            <div class="apply-btn-box">
                <button class="ns-bg-color layui-btn authentication-info-step">上一步</button>
                <button class="ns-bg-color layui-btn authentication-info-lower" lay-submit lay-filter="authentication_info">下一步</button>
            </div>
        </div>

        <!-- 银行结算信息 -->
        <div class="application-info-bank layui-hide layui-form" >
            <h2 class="apply-h2-title">填写银行结算信息</h2>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>银行开户名：</label>
                <div class="layui-input-inline">
                    <input name="bank_account_name" value="<?php echo htmlentities($shop_apply_info['bank_account_name']); ?>" type="text" placeholder="请输入银行开户名" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>开户银行账号：</label>
                <div class="layui-input-inline">
                    <input name="bank_account_number" value="<?php echo htmlentities($shop_apply_info['bank_account_number']); ?>" type="number" min="0" placeholder="请输入开户银行账号" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>开户银行支行名称：</label>
                <div class="layui-input-inline">
                    <input name="bank_name" value="<?php echo htmlentities($shop_apply_info['bank_name']); ?>" type="text" placeholder="请输入开户银行支行名称" lay-verify="required" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">开户银行所在地：</label>
                <div class="layui-input-inline">
                    <input name="bank_address" value="<?php echo htmlentities($shop_apply_info['bank_address']); ?>" type="text" placeholder="请输入开户银行所在地" class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">支行联行号：</label>
                <div class="layui-input-inline">
                    <input name="bank_code" value="<?php echo htmlentities($shop_apply_info['bank_code']); ?>" type="number" min="0" placeholder="请输入支行联行号"  class="layui-input ns-len-long">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">结算类型：</label>
                <div class="layui-input-inline">
                    <?php if(in_array("bank", $support_transfer_type)): ?>
                    <input type="radio" name="bank_type" lay-filter="bankType" value="1" title="银行卡">
                    <?php endif; if(in_array("alipay", $support_transfer_type)): ?>
                    <input type="radio" name="bank_type" lay-filter="bankType" value="2" title="支付宝">
                    <?php endif; if(in_array("wechatpay", $support_transfer_type)): ?>
                    <input type="radio" name="bank_type" lay-filter="bankType" value="3" title="微信">
                    <?php endif; ?>
                </div>
            </div>
            <div class="ns-bank-type-1 layui-hide">
                <div class="layui-form-item">
                    <label class="layui-form-label type_1_settlement_bank_account_name"><span class="required">*</span>用户真实姓名：</label>
                    <div class="layui-input-inline">
                        <input name="zifu_settlement_bank_account_name" value="<?php echo htmlentities($shop_apply_info['settlement_bank_account_name']); ?>" type="text" placeholder="请输入用户真实姓名" class="layui-input ns-len-long">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label type_1_settlement_bank_account_number"><span class="required">*</span>支付宝账号：</label>
                    <div class="layui-input-inline">
                        <input name="zifu_settlement_bank_account_number" value="<?php echo htmlentities($shop_apply_info['settlement_bank_account_number']); ?>" type="text" min="0" placeholder="请输入支付宝账号" class="layui-input ns-len-long">
                    </div>
                </div>
            </div>
            <div class="ns-bank-type-2">
                <div class="layui-form-item">
                    <label class="layui-form-label type_2_settlement_bank_account_name"><span class="required">*</span>结算开户名：</label>
                    <div class="layui-input-inline">
                        <input name="settlement_bank_account_name" type="text" value="<?php echo htmlentities($shop_apply_info['settlement_bank_account_name']); ?>" placeholder="请输入结算开户名" lay-verify="required" class="layui-input ns-len-long">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label type_2_settlement_bank_account_number"><span class="required">*</span>结算银行账号：</label>
                    <div class="layui-input-inline">
                        <input name="settlement_bank_account_number" value="<?php echo htmlentities($shop_apply_info['settlement_bank_account_number']); ?>" type="number" min="0" placeholder="请输入结算银行账号" lay-verify="required" class="layui-input ns-len-long">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label type_2_settlement_bank_name"><span class="required">*</span>结算开户银行支行名称：</label>
                    <div class="layui-input-inline">
                        <input name="settlement_bank_name" type="text" value="<?php echo htmlentities($shop_apply_info['settlement_bank_name']); ?>" placeholder="请输入结算开户银行支行名称" lay-verify="required" class="layui-input ns-len-long">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label type_2_settlement_bank_address"><span class="required">*</span>结算开户银行所在地：</label>
                    <div class="layui-input-inline">
                        <input name="settlement_bank_address" type="text" value="<?php echo htmlentities($shop_apply_info['settlement_bank_address']); ?>" placeholder="请输入结算开户银行所在地" lay-verify="required" class="layui-input ns-len-long">
                    </div>
                </div>
            </div>

            <div class="ns-bank-type-3 layui-hide">
                <div class="layui-form-item">
                    <label class="layui-form-label type_3_settlement_bank_account_name"><span class="required">*</span>微信绑定：</label>
                    <div class="layui-input-block shop-bind">
                        <div class="ns-img-box" id="shopBindQrcode">
                            <image layer-src src="<?php echo addon_url('shop/apply/shopBindQrcode'); ?>"/>
                            <div class="img-load layui-hide">点击重新加载</div>
                        </div>
                    </div>
                    <div class="ns-word-aux">请扫描二维码与微信绑定</div>
                </div>

                <div class="layui-form-item weixin-nickname">
                    <label class="layui-form-label">微信昵称：</label>
                    <div class="layui-input-inline">
                        <input type="text"  disabled class="layui-input ns-dis-input ns-len-long" name="weixin_settlement_bank_address" value="">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label type_3_settlement_bank_account_name"><span class="required">*</span>用户真实姓名：</label>
                    <div class="layui-input-inline">
                        <input name="weixin_settlement_bank_account_name" value="" type="text" placeholder="请输入用户真实姓名" class="layui-input ns-len-long">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label type_3_settlement_bank_account_number"><span class="required">*</span>微信账号：</label>
                    <div class="layui-input-inline">
                        <input name="weixin_settlement_bank_name" value="" type="text" placeholder="请输入微信账号" class="layui-input ns-len-long">
                    </div>
                </div>

                <!-- 微信openid -->
                <input name="weixin_settlement_bank_account_number" value="" type="hidden" class="layui-input">
            </div>
            <div class="apply-btn-box">
                <button class="ns-bg-color layui-btn application-info-bank-step">上一步</button>
                <button class="ns-bg-color layui-btn application-info-bank-lower" lay-submit lay-filter="application_info_bank">下一步</button>
            </div>
        </div>

        <!-- 店铺信息 -->
        <div class="application-info layui-hide layui-form" >
            <h2 class="apply-h2-title">填写店铺信息</h2>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>店铺名称：</label>
                <div class="layui-input-block">
                    <input name="shop_name" value="<?php echo htmlentities($shop_apply_info['shop_name']); ?>" type="text" placeholder="请输入店铺名称" maxlength="10" lay-verify="required" class="layui-input ns-len-long">
                </div>
                <div class="ns-word-aux" style="color: #ff0000">注意：店铺名称注册后不可修改。</div>
            </div>

            <?php if($is_city == 1): ?>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>城市分站：</label>
                <div class="layui-input-block ns-len-mid">
                    <select name="website_id" lay-verify="required" lay-search="">
                        <option value="" >请选择城市分站</option>
                        <?php foreach($web_city as $key => $val): ?>
                        <option value="<?php echo htmlentities($val['site_id']); ?>" <?php if($val['site_id'] == $shop_apply_info['website_id']): ?> selected <?php endif; ?>><?php echo htmlentities($val['site_area_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="ns-word-aux" style="color: #ff0000">注意：城市分站注册后不可修改。</div>
            </div>
            <?php endif; ?>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>开店套餐：</label>
                <div class="layui-input-inline">
                    <input type="text" disabled class="layui-input ns-dis-input ns-len-long" name="group_name" value="<?php echo htmlentities($shop_apply_info['group_name']); ?>">
                </div>
            </div>
            <!-- 开店套餐id隐藏域 -->
            <input type="hidden" class="layui-input" name="group_id">

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>主营行业：</label>
                <div class="layui-input-block ns-len-mid">
                    <select name="category_id" lay-verify="required" lay-search="" lay-filter="category_id">
                        <option value="">请选择主营行业</option>
                        <?php foreach($shop_category['data'] as $shop_category_key => $shop_category_val): ?>
                        <option value="<?php echo htmlentities($shop_category_val['category_id']); ?>" <?php if($shop_category_val['category_id'] == $shop_apply_info['category_id']): ?> selected <?php endif; ?> data-baozheng="<?php echo htmlentities($shop_category_val['baozheng_money']); ?>"><?php echo htmlentities($shop_category_val['category_name']); ?> (保证金：<?php echo htmlentities($shop_category_val['baozheng_money']); ?> )</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="ns-word-aux" style="color: #ff0000">注意：请根据您所经营的内容认真选择店铺主营行业吗，注册后商家不可自行修改。</div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>入驻时长：</label>
                <div class="layui-input-inline">
                    <select name="apply_year" lay-verify="required" lay-search="" lay-filter="apply_year">
                        <option value="">请选择入驻时长</option>
                        <?php $__FOR_START_872162361__=1;$__FOR_END_872162361__=5;for($i=$__FOR_START_872162361__;$i < $__FOR_END_872162361__;$i+=1){ ?>
                        <option value="<?php echo htmlentities($i); ?>" <?php if($i == $shop_apply_info['apply_year']): ?> selected<?php endif; ?>><?php echo htmlentities($i); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="layui-word-aux">年</div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>保证金：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text color-red cash-deposit"><?php if(empty($shop_apply_info['paying_deposit']) || (($shop_apply_info['paying_deposit'] instanceof \think\Collection || $shop_apply_info['paying_deposit'] instanceof \think\Paginator ) && $shop_apply_info['paying_deposit']->isEmpty())): ?>0.00<?php else: ?><?php echo htmlentities($shop_apply_info['paying_deposit']); ?><?php endif; ?> 元</p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>服务费：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text color-red service"></p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>总计：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text color-red store-ccharges"><?php if(empty($shop_apply_info['paying_amount']) || (($shop_apply_info['paying_amount'] instanceof \think\Collection || $shop_apply_info['paying_amount'] instanceof \think\Paginator ) && $shop_apply_info['paying_amount']->isEmpty())): ?>0.00<?php else: ?><?php echo htmlentities($shop_apply_info['paying_amount']); ?><?php endif; ?> 元</p>
                </div>
                <div class="ns-word-aux">说明：店铺费用 = 服务费 * 入驻年限 + 保证金</div>
            </div>

            <div class="apply-btn-box">
                <button class="ns-bg-color layui-btn application-info-step">上一步</button>
                <button class="ns-bg-color layui-btn application-info-lower" lay-submit lay-filter="application_info">提交，审核资质信息</button>
            </div>
        </div>

        <!-- 审核页面 -->
        <div class="audit-status <?php if($procedure == 1): ?> layui-hide <?php endif; ?>">

            <?php if($procedure == 5): ?>
            <h2 class="apply-h2-title">开店成功</h2>
            <div class="shop-succeey">
                <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/apply_succeed.png" alt="">
                <p>恭喜您开店成功，快点击进入店铺，进行体验吧！</p>
                <div class="apply-btn-box">
                    <button class="ns-bg-color layui-btn" onclick="shopSuccess()">进入店铺</button>
                </div>
            </div>
            <?php else: ?>
            <h2 class="apply-h2-title">提交平台审核</h2>
            <div class="status">
                <?php if($procedure == 2): ?>
                <div class="status-pic">
                    <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/under_review.png" alt="">
                </div>
                <span>信息审核中，请稍等 ~</span>
                <?php elseif($procedure == 6): ?>
                <div class="status-pic">
                    <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/in_audit.png" alt="">
                </div>
                <button class="ns-bg-color layui-btn audit-success">审核通过，填写支付凭证</button>
                <?php elseif($procedure == 3): ?>
                <div class="status-pic">
                    <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/under_review.png" alt="">
                </div>
                <span>支付凭证审核中，请稍等 ~</span>
                <?php elseif($procedure == 4): ?>
                <div class="status-pic">
                    <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/audit_failure.png" alt="">
                </div>
                <span>审核失败，<span class="error-reason"><a href="#" class="ns-text-color">点击查看原因</a></span></span>
                <div class="apply-btn-box">
                    <button class="ns-bg-color layui-btn rewrite">重新填写</button>
                </div>
                <?php elseif($procedure == 7): ?>
                <div class="status-pic">
                    <img src="https://ls.chnssl.com/app/shop/view/public/img/apply/audit_failure.png" alt="">
                </div>
                <span>财务审核失败，<span class="error-reason"><a href="#" class="ns-text-color">点击查看原因</a></span></span>
                <div class="apply-btn-box">
                    <button class="ns-bg-color layui-btn resubmit">重新提交</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- 店铺信息 -->
            <table class="layui-table">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                <tr>
                    <th colspan="4">店铺信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="right">店铺名称：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['shop_name']); ?></td>
                </tr>
                <?php if($is_city == 1): ?>
                <tr>
                    <td align="right">城市分站：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['site_area_name']); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td align="right">主营行业：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['category_name']); ?></td>
                </tr>
                <tr>
                    <td align="right">开店套餐：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['group_name']); ?></td>
                </tr>
                <tr>
                    <td align="right">入驻时长：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['apply_year']); ?>年</td>
                </tr>
                </tbody>
            </table>

            <!-- 公司及联系人信息 -->
            <table class="layui-table">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                <tr>
                    <th colspan="4"><?php if($shop_apply_info['cert_type'] == 2): ?>公司信息<?php else: ?>联系人信息<?php endif; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if($shop_apply_info['cert_type'] == 2): ?>
                <tr>
                    <td align="right">公司名称：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['company_name']); ?></td>
                </tr>
                <tr>
                    <td align="right">公司所在地：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['company_full_address']); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td align="right"><?php if($shop_apply_info['cert_type'] == 2): ?>法人姓名<?php else: ?>联系人姓名<?php endif; ?>：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['contacts_name']); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php if($shop_apply_info['cert_type'] == 2): ?>法人手机号<?php else: ?>联系人手机号<?php endif; ?>：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['contacts_mobile']); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php if($shop_apply_info['cert_type'] == 2): ?>法人身份证号<?php else: ?>联系人身份证号<?php endif; ?>：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['contacts_card_no']); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php if($shop_apply_info['cert_type'] == 2): ?>法人身份证正面<?php else: ?>联系人身份证正面<?php endif; ?>：</td>
                    <td>
                        <div class="ns-img-box" id="id_card_front"><img layer-src src="<?php echo img($shop_apply_info['contacts_card_electronic_2']); ?>" alt=""></div>
                    </td>
                    <td align="right"><?php if($shop_apply_info['cert_type'] == 2): ?>法人身份证反面<?php else: ?>联系人身份证反面<?php endif; ?>：</td>
                    <td>
                        <div class="ns-img-box" id="id_card_back"><img layer-src src="<?php echo img($shop_apply_info['contacts_card_electronic_3']); ?>" alt=""></div>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- 营业执照信息 -->
            <?php if($shop_apply_info['cert_type'] == 2): ?>
            <table class="layui-table">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                <tr>
                    <th colspan="4">营业执照信息</th>
                </tr>
                </thead>
                <tbody>
                <!-- <?php if(!(empty($shop_apply_info['tax_registration_certificate']) || (($shop_apply_info['tax_registration_certificate'] instanceof \think\Collection || $shop_apply_info['tax_registration_certificate'] instanceof \think\Paginator ) && $shop_apply_info['tax_registration_certificate']->isEmpty()))): ?>
                <tr>
                    <td align="right">税务登记证号：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['tax_registration_certificate']); ?></td>
                </tr>
                <?php endif; ?> -->
                <!-- <?php if(!(empty($shop_apply_info['taxpayer_id']) || (($shop_apply_info['taxpayer_id'] instanceof \think\Collection || $shop_apply_info['taxpayer_id'] instanceof \think\Paginator ) && $shop_apply_info['taxpayer_id']->isEmpty()))): ?>
                <tr>
                    <td align="right">纳税人识别号：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['taxpayer_id']); ?></td>
                </tr>
                <?php endif; ?> -->
                <tr>
                    <td align="right">统一社会信用码：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['business_licence_number']); ?></td>
                </tr>
                <?php if(!(empty($shop_apply_info['business_sphere']) || (($shop_apply_info['business_sphere'] instanceof \think\Collection || $shop_apply_info['business_sphere'] instanceof \think\Paginator ) && $shop_apply_info['business_sphere']->isEmpty()))): ?>
                <tr>
                    <td align="right">法定经营范围：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['business_sphere']); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td align="right">营业执照电子版：</td>
                    <td colspan="3">
                        <div class="ns-img-box" id="business_license"><img layer-src src="<?php echo img($shop_apply_info['business_licence_number_electronic']); ?>" alt=""></div>
                    </td>
                    <!-- <td align="right">税务登记证号电子版：</td>
                    <td>
                        <div class="ns-img-box"><img layer-src src="<?php echo img($shop_apply_info['tax_registration_certificate_electronic']); ?>" alt=""></div>
                    </td> -->
                </tr>
                </tbody>
            </table>
            <?php endif; ?>

            <!--<table class="layui-table">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                <tr>
                    <th colspan="4">银行信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="right">银行开户名：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['bank_account_name']); ?></td>
                </tr>
                <tr>
                    <td align="right">开户银行账号：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['bank_account_number']); ?></td>
                </tr>
                <tr>
                    <td align="right">开户银行支行名称：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['bank_name']); ?></td>
                </tr>
                <?php if(!(empty($shop_apply_info['bank_address']) || (($shop_apply_info['bank_address'] instanceof \think\Collection || $shop_apply_info['bank_address'] instanceof \think\Paginator ) && $shop_apply_info['bank_address']->isEmpty()))): ?>
                <tr>
                    <td align="right">开户银行支行所在地：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['bank_address']); ?></td>
                </tr>
                <?php endif; if(!(empty($shop_apply_info['bank_code']) || (($shop_apply_info['bank_code'] instanceof \think\Collection || $shop_apply_info['bank_code'] instanceof \think\Paginator ) && $shop_apply_info['bank_code']->isEmpty()))): ?>
                <tr>
                    <td align="right">支行联行号：</td>
                    <td colspan="3"><?php echo htmlentities($shop_apply_info['bank_code']); ?></td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>-->

           <!-- <table class="layui-table">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                <tr>
                    <th colspan="4">结算账户信息</th>
                </tr>
                </thead>
                <tbody>
                    <?php if($shop_apply_info['bank_type'] == 2): ?>
                    <tr>
                        <td align="right">用户真实姓名：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_account_name']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">支付宝账号：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_account_number']); ?></td>
                    </tr>
                    <?php elseif($shop_apply_info['bank_type'] == 1): ?>
                    <tr>
                        <td align="right">结算银行开户名：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_account_name']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">结算公司银行账号：</td>
                        <td  colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_account_number']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">结算开户银行支行名称：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_name']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">结算开户银行所在地：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_address']); ?></td>
                    </tr>
                    <?php elseif($shop_apply_info['bank_type'] == 3): ?>
                    <tr>
                        <td align="right">用户真实姓名：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_account_name']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">微信昵称：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_address']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">微信账号：</td>
                        <td colspan="3"><?php echo htmlentities($shop_apply_info['settlement_bank_name']); ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>-->
            <?php endif; ?>
        </div>

        <!-- 提交支付凭证 -->
        <div class="payment-voucher layui-hide layui-form">
            <h2 class="apply-h2-title">填写支付信息</h2>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>店铺名称：</label>
                <div class="layui-input-inline">
                    <input type="text" disabled class="layui-input ns-dis-input ns-len-long" value="<?php echo htmlentities($shop_apply_info['shop_name']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>开店套餐：</label>
                <div class="layui-input-inline">
                    <input type="text" disabled class="layui-input ns-dis-input ns-len-long" value="<?php echo htmlentities($shop_apply_info['group_name']); ?>">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>主营行业：</label>
                <div class="layui-input-inline">
                    <input type="text" disabled class="layui-input ns-dis-input ns-len-long" value="<?php echo htmlentities($shop_apply_info['category_name']); ?>">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>入驻时长：</label>
                <div class="layui-input-inline">
                    <input type="text" disabled class="layui-input ns-dis-input ns-len-long" value="<?php echo htmlentities($shop_apply_info['apply_year']); ?>">
                </div>
                <div class="layui-word-aux">年</div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>保证金：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text color-red payment-cash-deposit"><?php echo htmlentities($shop_apply_info['paying_deposit']); ?> 元</p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>服务费：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text color-red payment-service"><?php echo htmlentities($shop_apply_info['paying_apply']); ?> 元</p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="required">*</span>总计：</label>
                <div class="layui-input-block">
                    <p class="ns-input-text color-red payment-store-ccharges"><?php echo htmlentities($shop_apply_info['paying_amount']); ?> 元</p>
                </div>
                <div class="ns-word-aux">
                    说明： 店铺费用 = 服务费 * 入驻年限 + 保证金；
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label img-upload-lable">付款凭证：</label>
                <div class="layui-input-block img-upload" style="margin-top: 15px;">
                    <div class="upload-img-block">
                        <div class="upload-img-box <?php if(!(empty($shop_apply_info['paying_money_certificate']) || (($shop_apply_info['paying_money_certificate'] instanceof \think\Collection || $shop_apply_info['paying_money_certificate'] instanceof \think\Paginator ) && $shop_apply_info['paying_money_certificate']->isEmpty()))): ?>hover<?php endif; ?>">
                        <div class="ns-upload-default" id="voucher">
                            <?php if(!(empty($shop_apply_info['paying_money_certificate']) || (($shop_apply_info['paying_money_certificate'] instanceof \think\Collection || $shop_apply_info['paying_money_certificate'] instanceof \think\Paginator ) && $shop_apply_info['paying_money_certificate']->isEmpty()))): ?>
                            <div id="preview_voucher" class="preview_img">
                                <img layer-src src="<?php echo img($shop_apply_info['paying_money_certificate']); ?>" class="img_prev"/>
                            </div>
                            <?php else: ?>
                            <div class="upload">
                                <img src="https://ls.chnssl.com/app/shop/view/public/img/upload_img.png" data-id="logoUpload"/>
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
                        <input type="hidden" name="paying_money_certificate" value="<?php echo htmlentities($shop_apply_info['paying_money_certificate']); ?>" />
                    </div>
                </div>
            </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">付款凭证说明：</label>
                <div class="layui-input-inline">
                    <textarea name="paying_money_certificate_explain" class="layui-textarea ns-len-long" placeholder="请输入付款凭证说明"><?php echo htmlentities($shop_apply_info['paying_money_certificate_explain']); ?></textarea>
                </div>
            </div>
            <!-- 结算信息 -->
            <!--<table class="layui-table billing-info">
                <colgroup>
                    <col width="20%">
                    <col width="30%">
                    <col width="20%">
                    <col width="30%">
                </colgroup>
                <thead>
                <tr>
                    <th colspan="4">收款账户</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="right">银行开户名：</td>
                    <td><?php echo htmlentities($receivable_config['data']['value']['bank_account_name']); ?></td>
                    <td align="right">银行账户：</td>
                    <td><?php echo htmlentities($receivable_config['data']['value']['bank_account_no']); ?></td>
                </tr>
                <tr>
                    <td align="right">开户名称：</td>
                    <td><?php echo htmlentities($receivable_config['data']['value']['bank_name']); ?></td>
                    <td align="right">开户所在地：</td>
                    <td><?php echo htmlentities($receivable_config['data']['value']['bank_address']); ?></td>
                </tr>
                </tbody>
            </table>-->
            <div class="apply-btn-box">
                <button class="ns-bg-color layui-btn" lay-submit lay-filter="payment-voucher-complete">点击提交</button>
            </div>

        </div>

    </div>
</div>


<script type="text/javascript" src="https://ls.chnssl.com/app/shop/view/public/js/address.js"></script>
<script type="text/javascript">
    var form,upload,groupId,
        agreementConsent = false,
        cert_type = 2,
        authentication_info = "",
        application_info_bank = "",
        typePayment = 1,
        form_data = "";

    $(function(){
        layui.use("form",function () {
            form = layui.form;
			form.render();
            $(".apply-process ul li:after").after("").css("background-color","#f38421 !important");

            <?php if(in_array("bank", $support_transfer_type)): ?>
                if (!$("input[name='bank_type']:checked").length){
                    typePayment = 1;
                    $("input[name='bank_type']").eq(0).prop("checked",true);
                }
            <?php endif; if(in_array("alipay", $support_transfer_type)): ?>
                if (!$("input[name='bank_type']:checked").length){
                    typePayment = 2;
                    $("input[name='bank_type']").eq(0).prop("checked",true);
                }
            <?php endif; if(in_array("wechatpay", $support_transfer_type)): ?>
                if (!$("input[name='bank_type']:checked").length){
                    typePayment = 3;
                    $("input[name='bank_type']").eq(0).prop("checked",true);
                }
            <?php endif; ?>
            form.render();
            payType(typePayment);

            /**
             * 申请入驻
             * */
            $("body").on("click",".apply-shop",function () {
                $(".shop-empty").addClass("layui-hide");
                $(".settlement-agreement").removeClass("layui-hide");
            });

            /**
             * 签订入驻协议
             * */
            //监听是否同意协议
            form.on('checkbox(apply_info)', function(data){
                agreementConsent = data.elem.checked;
            });

            $("body").on("click",".apply-info",function () {
                if(agreementConsent){
                    //申请协议隐藏
                    $(".settlement-agreement").addClass("layui-hide");
                    //开店套餐显示
                    $(".store-level-box").removeClass("layui-hide");
                }else{
                    layer.msg("请先同意协议");
                }
            });

            /**
             * 开店套餐
             */
            var storeLevelIndex;
            $(".store-level > li").hover(
                function () {
                    $(this).addClass("ns-border-color-hover");
                },
                function () {
                    $(this).removeClass("ns-border-color-hover");
                }
            );

            $("body").on("click",'.store-level > li',function () {
                storeLevelIndex = $(this).index();
                $(this).addClass("ns-border-click").siblings().removeClass('ns-border-click');
            });

            //开店套餐上一步
            $(".store_level-step").click(function () {
                $(".settlement-agreement").removeClass("layui-hide");
                $(".store-level-box").addClass("layui-hide");
            });

            //开店套餐下一步
            form.on('submit(store_level)', function(data){
                if(!storeLevelIndex && storeLevelIndex!= 0 ){
                    layer.msg("请选择开店套餐");
                    return false;
                }

                //获取开店套餐id和名称
                groupId = $(".store-level > li").eq(storeLevelIndex).attr("data-group_id");
                groupFee = $(".store-level > li").eq(storeLevelIndex).attr("data-group_fee");
                groupName = $(".store-level > li").eq(storeLevelIndex).find(".group_name").text();

                $(".service").text(groupFee + "元");
                $("input[name='group_name']").val(groupName);
                $("input[name='group_id']").val(groupId);

                paymentAmount();

                $(".store-level-box").addClass("layui-hide");
                $(".application-type").removeClass("layui-hide");
                !cert_type || cert_type == 2 ? $(".company-authentication-info").removeClass("layui-hide") : $(".personal-authentication-info").removeClass("layui-hide");
            });

            /**
             * 申请类型
             * */
            form.on('radio(application_type)', function(data){
                cert_type = data.value;

                //公司/个人资质信息显示
                if(cert_type == 2){
                    $(".application-type h2").text("填写公司认证信息");
                    $(".company-authentication-info").removeClass("layui-hide");
                    $(".personal-authentication-info").addClass("layui-hide");
                }else if(cert_type == 1){
                    $(".application-type h2").text("填写个人认证信息");
                    $(".company-authentication-info").addClass("layui-hide");
                    $(".personal-authentication-info").removeClass("layui-hide");
                }

            });

            /**
             * 填写个人/公司资质信息
             * */
            //上一步
            $("body").on("click",".authentication-info-step",function () {

                //将公司/个人资质信息隐藏
                $(".company-authentication-info").addClass("layui-hide");
                $(".personal-authentication-info").addClass("layui-hide");
                //申请类型隐藏
                $(".application-type").addClass("layui-hide");

                //开店套餐
                $(".store-level-box").removeClass("layui-hide");

            });

            //下一步
            form.on('submit(authentication_info)', function(data){
                authentication_info = data.field;

                //银行结算信息显示
                $(".application-info-bank").removeClass("layui-hide");

                //申请类型隐藏
                $(".application-type").addClass("layui-hide");

                //个人/公司资质信息隐藏
                if(parseInt(cert_type) == 2){
                    $(".company-authentication-info").addClass("layui-hide");
                }else{
                    $(".personal-authentication-info").addClass("layui-hide");
                }
            });

            /**
             * 银行结算
             * */
            // 上一步
            $("body").on("click",".application-info-bank-step",function () {
                //结算信息隐藏
                $(".application-info-bank").addClass("layui-hide");

                //申请类型显示
                $(".application-type").removeClass("layui-hide");
                //个人/公司资质信显示
                cert_type == 2 ? $(".company-authentication-info").removeClass("layui-hide") : $(".personal-authentication-info").removeClass("layui-hide");
            });

            //下一步
            form.on('submit(application_info_bank)', function(data){
                if (typePayment == 2){
                    data.field.settlement_bank_account_name = data.field.zifu_settlement_bank_account_name;
                    data.field.settlement_bank_account_number = data.field.zifu_settlement_bank_account_number;
                }

                if (typePayment == 3){
                    if (!data.field.weixin_settlement_bank_account_number){
                        layer.msg("请先与微信进行绑定");
                        return false;
                    }
                    data.field.settlement_bank_account_name = data.field.weixin_settlement_bank_account_name; //用户真实姓名
                    data.field.settlement_bank_account_number = data.field.weixin_settlement_bank_account_number; //openid
                    data.field.settlement_bank_address = data.field.weixin_settlement_bank_address; //微信昵称
                    data.field.settlement_bank_name = data.field.weixin_settlement_bank_name; // 微信账号
                }
                application_info_bank = data.field;
                //银行结算信息隐藏
                $(".application-info-bank").addClass("layui-hide");

                //店铺信息显示
                $(".application-info").removeClass("layui-hide");

            });

            function payType(data){
                //银行卡
                if(data == 1){
                    $(".ns-bank-type-1").addClass("layui-hide");
                    $(".ns-bank-type-3").addClass("layui-hide");
                    $(".ns-bank-type-2").removeClass("layui-hide");
                    $(".type_1_settlement_bank_account_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_1_settlement_bank_account_number").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_3_settlement_bank_account_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_3_settlement_bank_account_number").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_account_name").next().find(".layui-input").attr("lay-verify","required");
                    $(".type_2_settlement_bank_account_number").next().find(".layui-input").attr("lay-verify","required");
                    $(".type_2_settlement_bank_name").next().find(".layui-input").attr("lay-verify","required");
                    $(".type_2_settlement_bank_address").next().find(".layui-input").attr("lay-verify","required");
                }
                //支付宝
                if(data == 2){
                    $(".ns-bank-type-1").removeClass("layui-hide");
                    $(".ns-bank-type-2").addClass("layui-hide");
                    $(".ns-bank-type-3").addClass("layui-hide");
                    $(".type_2_settlement_bank_account_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_account_number").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_address").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_3_settlement_bank_account_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_3_settlement_bank_account_number").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_1_settlement_bank_account_name").next().find(".layui-input").attr("lay-verify","required");
                    $(".type_1_settlement_bank_account_number").next().find(".layui-input").attr("lay-verify","required");
                }
                //微信
                if(data == 3) {
                    $(".ns-bank-type-1").addClass("layui-hide");
                    $(".ns-bank-type-2").addClass("layui-hide");
                    $(".ns-bank-type-3").removeClass("layui-hide");
                    $(".type_2_settlement_bank_account_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_account_number").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_2_settlement_bank_address").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_1_settlement_bank_account_name").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_1_settlement_bank_account_number").next().find(".layui-input").removeAttr("lay-verify");
                    $(".type_3_settlement_bank_account_name").next().find(".layui-input").attr("lay-verify", "required");
                    $(".type_3_settlement_bank_account_number").next().find(".layui-input").attr("lay-verify", "required");

                    var intervalId;
                    

                    function shopBind() {
                        intervalId = window.setInterval(
                            function () {
                                $.ajax({
                                    async: 'false',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    url: ns.url("shop/apply//checkShopBind"),
                                    success: function (res) {

                                        if (res.code == -10001 && res.data.is_expire == 1){
                                            $(".ns-bank-type-3 .img-load").removeClass("layui-hide");
                                            clearInterval(intervalId);
                                            return false;
                                        }

                                        if (res.code >= 0){
                                            $(".ns-bank-type-3 .img-load").removeClass("layui-hide");
                                            $(".ns-bank-type-3 .img-load").html('恭喜您绑定成功！<p class="ns-text-color">重新绑定</p>');
                                            $("input[name='weixin_settlement_bank_account_number']").val(res.data.openid);
                                            $(".weixin-nickname input").val(res.data.userinfo.nickName);
                                            $(".weixin-nickname").attr("data-state", res.code);
                                            $(".weixin-nickname").removeClass("layui-hide");
                                            clearInterval(intervalId);
                                            return false;
                                        }
                                    }
                                });
                            }, 500
                        );
                    }

                    $('body').on("click",".ns-bank-type-3 .img-load",function () {
                        if(parseInt($(".weixin-nickname").attr("data-state")) >= 0){
                            $(".weixin-nickname").addClass("layui-hide");
                        }
                        $(".ns-bank-type-3 img").attr('src',"<?php echo addon_url('shop/apply/shopBindQrcode'); ?>?time="+ Math.random());
                        $(".ns-bank-type-3 .img-load").addClass("layui-hide");
                        
                    });
                }
            }

            //支付类型 显示隐藏
            form.on('radio(bankType)', function(data){
                typePayment = data.value;
                payType(typePayment);
            });

            /**
             * 店铺信息
             * */
            // 上一步
            $("body").on("click",".application-info-step",function () {
                //银行结算信息显示
                $(".application-info-bank").removeClass("layui-hide");

                //店铺信息隐藏
                $(".application-info").addClass("layui-hide");
            });

            /* 计算缴费金额 */
            function paymentAmount (){
                var categoryId = $(".application-info select[name=category_id] option:selected").val(),
                    applyYear = $(".application-info select[name=apply_year] option:selected").val();
                if(categoryId && groupId && applyYear) {
                    $.ajax({
                        url: ns.url("shop/apply/getApplyMoney"),
                        data: {
                            "apply_year": applyYear,
                            "category_id": categoryId,
                            "group_id": groupId
                        },
                        dataType: 'JSON',
                        type: 'POST',
                        success : function(data) {
                            $(".store-ccharges").text( data.data.paying_amount + ' 元');
                        }
                    })
                }
            }

            form.on('select(category_id)', function(data){
                $(".cash-deposit").text($(data.elem).find("option:selected").attr("data-baozheng"));
                paymentAmount();
            });

            form.on('select(apply_year)', function(data){
                paymentAmount();
            });

            // 最后保存信息
            form.on('submit(application_info)', function(data){
                var categoryName = $(".application-info select[name=category_id] option:selected").text();
                data.field.category_name =categoryName.substr(0, categoryName.indexOf("("));

                //获取地址
                var provinceId = $("select[name=province_id] option:selected").text(),
                    cityId = $("select[name=city_id] option:selected").text(),
                    districtId = $("select[name=district_id] option:selected").text(),
                    companyAddress = $("input[name=company_address]").val();

                data.field.company_full_address = provinceId + cityId + districtId + companyAddress;

                data.field.cert_type = cert_type;
                form_data = $.extend(authentication_info,application_info_bank,data.field);
				
				//删除图片
				if(!form_data.business_licence_number_electronic) businessLicense_upload.delete();
				if(form_data.cert_type == 2){
					if(!form_data.contacts_card_electronic_2) companyPositiveContactsID_upload.delete();
					if(!form_data.contacts_card_electronic_3) companyBackContactsID_upload.delete();
				}
				if(form_data.cert_type == 1){
					if(!form_data.contacts_card_electronic_2) positiveContactsID_upload.delete();
					if(!form_data.contacts_card_electronic_3) backContactsID_upload.delete();
				}
				if(!form_data.paying_money_certificate) voucher_upload.delete();
				
                $.ajax({
                    url: ns.url("shop/apply/apply"),
                    dataType: 'JSON',
                    type: 'POST',
                    data: form_data,
                    success : function(data) {
                        if(data.code == 0){
                            //店铺信息隐藏
                            $(".application-info").addClass("layui-hide");
                            location.reload();
                        }
                    }
                })
            });

            /* 审核失败 */
            $("body").on("click",".rewrite",function () {
                var type = "<?php echo htmlentities($shop_apply_info['cert_type']); ?>";
                if(parseInt(type) == 2){

                    var province_id = "<?php echo htmlentities($shop_apply_info['company_province_id']); ?>",
                        city_id = "<?php echo htmlentities($shop_apply_info['company_city_id']); ?>",
                        district_id = "<?php echo htmlentities($shop_apply_info['company_district_id']); ?>",
                        initdata = {province_id, city_id, district_id};
                    initAddress(initdata, "update_address");
                }

                $(".audit-status").addClass("layui-hide");
                $(".settlement-agreement").removeClass("layui-hide");
                $(".apply-process ul li:nth-child(2) span.point").removeClass("ns-bg-color");
                $(".apply-process ul li:nth-child(3) span.content").removeClass("ns-bg-color");
                $(".apply-process ul li:nth-child(3) span.title").removeClass("ns-text-color");

                //子流程
                $(".agreement").removeClass("layui-hide");
                $(".submit-platform").addClass("layui-hide");
                $(".submit-platform dd:nth-child(2)").addClass("apply-side-selected ns-bg-color");
                $(".submit-platform dd:nth-child(6)").removeClass("apply-side-selected ns-bg-color");
            });

            /* 财务审核失败 */
            $("body").on("click",".resubmit",function () {
                $(".audit-status").addClass("layui-hide");
                $(".payment-voucher").removeClass("layui-hide");
            });

            /* 审核成功过 */
            $("body").on("click",".audit-success",function () {
                $(".audit-status").addClass("layui-hide");
                $(".payment-voucher").removeClass("layui-hide");

                //主流程
                $(".apply-process ul li:nth-child(3) span.point").addClass("ns-bg-color");
                $(".apply-process ul li:nth-child(4) span.content").addClass("ns-bg-color");
                $(".apply-process ul li:nth-child(4) span.title").addClass("ns-text-color");

                //子流程
                $(".submit-platform").addClass("layui-hide");
                $(".payFee").removeClass("layui-hide");
            });

            //解析地址
            getAdder(1,140100);
            function getAdder(level,pid){
                $.ajax({
                    type : "POST",
                    dataType: 'JSON',
                    url : ns.url("shop/address/getAreaList"),
                    data : {level,pid},
                    async : false,
                    success : function(res) {
                        console.log(res)
                    }
                });
            }

            /* 支付凭证 */
            form.on('submit(payment-voucher-complete)', function(data){
                data.field.paying_money_certificate_explain = data.field.paying_money_certificate_explain.replace(/\r\n/g,"");
                data.field.paying_money_certificate_explain = data.field.paying_money_certificate_explain.replace(/\s/g,"");

                $.ajax({
                    url: ns.url("shop/apply/editApply"),
                    dataType: 'JSON',
                    type: 'POST',
                    data: data.field,
                    success : function(data) {
                        if(data.code == 0){
                            location.reload();
                        }
                    }
                })
            });

            form.on('select(payment_group_id)', function(data){
                $(".payment-service").text($(data.elem).find("option:selected").attr("data-fee"));
                paymentVoucher();
            });
            form.on('select(payment_category_id)', function(data){
                $(".payment-cash-deposit").text($(data.elem).find("option:selected").attr("data-baozheng"));
                paymentVoucher();
            });
            form.on('select(payment_apply_year)', function(data){
                paymentVoucher();
            });

            paymentVoucher();

            /* 支付凭证 - 缴费金额 */
            function paymentVoucher (){
                var categoryId = $(".payment-voucher select[name=category_id] option:selected").val(),
                    groupId = $(".payment-voucher select[name=group_id] option:selected").val(),
                    applyYear = $(".payment-voucher select[name=apply_year] option:selected").val();

                if(categoryId && groupId && applyYear) {
                    $.ajax({
                        url: ns.url("shop/apply/getApplyMoney"),
                        data: {
                            "apply_year": applyYear,
                            "category_id": categoryId,
                            "group_id": groupId
                        },
                        dataType: 'JSON',
                        type: 'POST',
                        success : function(data) {
                            $(".payment-voucher .payment-store-ccharges").text( data.data.paying_amount + " 元");
                        }
                    })
                }
            }

            //表单验证
            form.verify({
                province_id : function(value, item){
                    if(value == ''){
                        return '省份不能为空';
                    }
                },
                city_id : function(value, item){
                    if(value == ''){
                        return '城市不能为空';
                    }
                },
                district_id : function(value, item){
                    if(value == ''){
                        return '区/县不能为空';
                    }
                },
                address: function(value) {
                    if (value == '') {
                        return '请输入详细地址';
                    }
                },
                telphone: function(value) {
                    var mobile = /^1[3456789]\d{9}$/;
                    var flag = mobile.test(value);
                    if(!flag){
                        return '请输入正确的手机号';
                    }
                },
                card: function(value) {
                    var reg = /(^\d{15}$)|(^\d{17}(\d|[Xx])$)/;
                    if(!reg.test(value)) {
                        return '请输入正确的身份证号';
                    }
                }
            });

            /* 快速入驻*/
            $(".open-experience").click(function () {
                location.href = ns.url("shop/apply/experienceApply");
            });
        });
    });

    $("body").on("click", ".error-reason", function(){
        layer.open({
            type: 0,
            title: '拒绝原因',
            btn: [],
            content: '<?php echo htmlentities($shop_apply_info["apply_message"]); ?>'
        });
    });

    // 营业执照电子版上传
    var businessLicense_upload = new Upload({
        elem: '#businessLicense'
    });
    // 法人身份证正面
    var companyPositiveContactsID_upload = new Upload({
        elem: '#companyPositiveContactsID'
    });
    // 法人身份证反面
    var companyBackContactsID_upload = new Upload({
        elem: '#companyBackContactsID'
    });
    // 申请人身份证正面
    var positiveContactsID_upload = new Upload({
        elem: '#positiveContactsID'
    });
    // 申请人身份证反面
    var backContactsID_upload = new Upload({
        elem: '#backContactsID'
    });
    // 支付凭证
    var voucher_upload = new Upload({
        elem: '#voucher'
    });

    function shopSuccess(){
        var userInfo = "<?php echo htmlentities($user_info['username']); ?>";
        
        if (!userInfo){
            location.href = ns.url("shop/login/login");
            return false;
        }
        
        $.ajax({
            url: ns.url("shop/apply/simulatedLogin"),
            data: {"username": userInfo},
            dataType: 'JSON',
            type: 'POST',
            success : function(data) {
                
                data.code >= 0 ? location.href = ns.url("shop/index/index") : layer.msg(data.message) ;
            }
        });
    }

    //判断店铺名称是否已存在
    $('input[name=shop_name]').on('blur',function() {
        var shop_name = $('input[name=shop_name]').val();

        $.ajax({
            url: ns.url("shop/apply/shopNameExist"),
            data: {
                "shop_name": shop_name,
            },
            dataType: 'JSON',
            type: 'POST',
            success : function(data) {
                if(data != null){
                    layer.msg('该店铺名已存在');
                    $('input[name=shop_name]').focus();
                    return false;
                }
            }
        })

    });
</script>

</body>

</html>