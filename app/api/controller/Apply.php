<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 */

namespace app\api\controller;

use addon\shopwithdraw\model\Config as ShopWithdrawConfig;
use app\Controller;
use app\model\shop\Config as ConfigModel;
use app\model\shop\ShopAccount as ShopaccountModel;
use app\model\shop\ShopApply;
use app\model\shop\ShopApply as ShopApplyModel;
use app\model\shop\ShopCategory as ShopCategoryModel;
use app\model\shop\ShopGroup as ShopGroupModel;
use app\model\system\Address as AddressModel;
use app\model\system\Promotion as PromotionModel;
use app\model\system\User as userModel;
use app\model\web\WebSite as WebsiteModel;
use think\facade\Cache;
use app\model\web\Config as WebConfigModel;
use think\facade\Session;
use think\captcha\facade\Captcha as ThinkCaptcha;
/**
 * 店铺申请
 * @package app\shop\controller
 */
class Apply extends BaseApi
{

    protected $app_module = "api";

    /*
     *  申请入驻首页
     * */
    public function index()
    {
//        $this->assign("menu_info", [ 'title' => "店铺申请" ]);
//        $this->assign("shop_info", [ 'site_name' => "店铺端" ]);
        //用户信息
        
         $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
       
        $user_model = new UserModel();
        if (empty($uid)) {
           
            $user_info = [];
        }else{
            
            $user_info = model('user')->getInfo([['member_id','=',$this->member_id]]);
        }
/*        

        $user_model = new UserModel();
        $user_info = $user_model->userInfo($this->app_module);*/
        
        $data['data']['user_info'] = $user_info;

        //$this->assign('user_info', $user_info);
        //店铺等级
        $shop_group_model = new ShopGroupModel();
        $shop_group = $shop_group_model->getGroupList([ [ 'is_own', '=', 0 ] ], '*', 'fee asc');
//        $this->assign('shop_group', $shop_group);
        $data['data']['shop_group'] = $shop_group['data'];
        //店铺主营行业
        $shop_category_model = new ShopCategoryModel();
        $shop_category = $shop_category_model->getCategoryList('', '*', 'sort asc', '');
//        $this->assign('shop_category', $shop_category);
        $data['data']['shop_category'] = $shop_category['data'];

        //入驻协议
        $config_model = new ConfigModel();
        $shop_apply_agreement = $config_model->getShopApplyAgreement();
//        $this->assign('shop_apply_agreement', $shop_apply_agreement);
        $data['data']['shop_apply_agreement'] = $shop_apply_agreement['data'];

        //查询省级数据列表
        $address_model = new AddressModel();
        $list = $address_model->getAreaList([ [ "pid", "=", 0 ], [ "level", "=", 1 ] ]);
//        $this->assign("province_list", $list[ "data" ]);
        $data['data']['province_list'] = $list[ "data" ];

        //获取申请完整信息
        $shop_apply_model = new ShopApplyModel();

        $condition[] = [ 'uid', '=', $uid ];
        $shop_apply_info = $shop_apply_model->getApplyDetail($condition);
        if ($shop_apply_info[ 'data' ] == null) {//未填写申请信息
            //第一步
            $procedure = 1;
        } else {//已填写申请信息
            //判断审核状态
            if ($shop_apply_info[ 'data' ][ 'apply_state' ] == 1) {
                $procedure = 2;//审核中
            } elseif ($shop_apply_info[ 'data' ][ 'apply_state' ] == 2) {
                if ($shop_apply_info[ 'data' ][ 'paying_money_certificate' ] != '') {
                    $procedure = 3;//财务凭据审核中
                } else {
                    $procedure = 6;//财务凭据提交中
                }
            } elseif ($shop_apply_info[ 'data' ][ 'apply_state' ] == 3) {
                $procedure = 5;//入驻成功
            } elseif ($shop_apply_info[ 'data' ][ 'apply_state' ] == -2) {
                    $procedure = 7;//财务审核失败
            } else {
                $procedure = 4;//审核失败
            }
        }

        $data['data']['shop_apply_info'] = $shop_apply_info[ "data" ];

        $data['data']['procedure'] = $procedure;

//        $this->assign('procedure', $procedure);
//        $this->assign('shop_apply_info', $shop_apply_info[ "data" ]);

        //收款信息
        $receivable_config = $config_model->getSystemBankAccount();
        $data['data']['receivable_config'] = $receivable_config;
//        $this->assign('receivable_config', $receivable_config);

        //平台配置信息
        $website_model = new WebsiteModel();
        $website_info = $website_model->getWebSite([ [ 'site_id', '=', 0 ] ], 'web_phone');
//        $this->assign('website_info', $website_info[ 'data' ]);
        $data['data']['website_info'] = $website_info[ 'data' ];

        //快捷入驻
        $account_model = new ShopaccountModel();
        $config_info = $account_model->getShopWithdrawConfig();
        if (empty($config_info[ 'data' ])) {
            $id_experience = 0;
        } else {
            $id_experience = $config_info[ 'data' ][ 'value' ][ 'id_experience' ];
        }
//        $this->assign('id_experience', $id_experience);
        $data['data']['id_experience'] = $id_experience;
        $promotion_model = new PromotionModel();
        //插件
        $promotions = $promotion_model->getPromotions();
        $promotions = $promotions[ 'shop' ];
        //店铺等级
        $shop_group = $shop_group_model->getGroupList([ [ 'is_own', '=', 0 ] ], '*', 'fee asc');
        $shop_group = $shop_group[ 'data' ];

        foreach ($shop_group as $k => $v) {
            $addon_array = !empty($v[ 'addon_array' ]) ? explode(',', $v[ 'addon_array' ]) : [];

            foreach ($promotions as $key => &$promotion) {
                if (!empty($promotion[ 'is_developing' ])) {
                    unset($promotions[ $key ]);
                    continue;
                }
                $promotion[ 'is_checked' ] = 0;
                if (in_array($promotion[ 'name' ], $addon_array)) {
                    $promotion[ 'is_checked' ] = 1;
                }
                $shop_group[ $k ][ 'promotion' ][] = $promotion;
            }
            array_multisort(array_column($shop_group[ $k ][ 'promotion' ], 'is_checked'), SORT_DESC, $shop_group[ $k ][ 'promotion' ]);
        }
//        $this->assign('group_info', $shop_group);
        $data['data']['group_info'] = $shop_group;

        //城市分站
        $is_city_addon = addon_is_exit('city');
//        $this->assign('is_city', $is_city_addon);
        $data['data']['is_city'] = $is_city_addon;

        if ($is_city_addon == 1) {//存在
            //获取城市分站信息
            $city = $website_model->getWebsiteList([ [ 'site_id ', '>=', 0 ], [ 'status', '=', 1 ] ], 'site_id,site_area_id,site_area_name');
//            $this->assign('web_city', $city[ 'data' ]);
            $data['data']['web_city'] = $city[ 'data' ];

        } else {//不存在
            $data['data']['web_city'] = [];
//            $this->assign('web_city', []);
        }
//        $this->assign("support_transfer_type", $this->getTransferType());
        $data['data']['support_transfer_type'] = $this->getTransferType();

        return $this->response($data);
    }

    /**
     *   申请入驻生产接受注册信息
     */
   public function register()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $config_model = new WebConfigModel();
        $config_info = $config_model->getCaptchaConfig();
        $config = $config_info[ 'data' ][ 'value' ];

        if (request()->isPost()) {

            $data[ 'username' ] = trim(input("username", ''));//账户
            $data[ 'password' ] = trim(input("password", ''));//密码

            /*if ($config[ "shop_login" ] == 1) {
                $captcha_result = $this->checkCaptcha();
                //验证码
                if ($captcha_result[ "code" ] != 0) {
                    return $captcha_result;
                }
            }*/

            $user_model = new UserModel();
            $data[ 'app_module' ] = 'shop';
            $data[ 'site_id' ] = 0;
            $data[ 'is_admin' ] = 1;
            $data[ 'member_id' ] = $this->member_id;

            $result = $user_model->addUser($data);
            
            if ($result[ 'code' ] == 0) {
                
                $res = $user_model->login($data[ 'username' ], $data[ 'password' ], 'shop');
                
                if ($result[ 'code' ] >= 0) {
                    
                    $token = $this->createToken($result[ 'data' ][ 'member_id' ]);
                    
                }
                if ($result[ 'data' ]['type'] == 1) {

                    return json_encode(['code'=>1,'msg'=>'账号已注册,登陆成功','data'=>['uid'=>$result['data']['uid']]]);
                } else {

                    return json_encode(['code'=>0,'msg'=>'帐户注册成功','data'=>['uid'=>$result['data']['uid']]]);
                }

            } else {
                return $result;
            }

        }

    }

    /**
     * @return mixed验证码
     */
    public function captcha()
    {
        $captcha_data = ThinkCaptcha::create(null, true);
        $captcha_id = md5(uniqid(null, true));
        // 验证码10分钟有效
        Cache::set($captcha_id, $captcha_data[ 'code' ], 600);
        return success(0, '', [ 'id' => $captcha_id, 'img' => $captcha_data[ 'img' ] ]);
    }

    /**
     * 验证码验证
     */
    public function checkCaptcha()
    {
        $captcha = input('captcha', '');
        $captcha_id = input('captcha_id', '3f6b567e35dadc436bbeb6dd54b782c1');
        if (empty($captcha)) return error(-1, '请输入验证码');

        $captcha_data = Cache::pull($captcha_id);
        if (empty($captcha_data)) return error('', '验证码已失效');

        if ($captcha != $captcha_data) return error(-1, '验证码错误');

        return success();
    }
    /**
     * 获取分类
     * @param $apply_data
     * @param $cert_data
     * @return array
     */
    public function getCategory()
    {
        //获取所有的店铺分类
        $category = new ShopCategoryModel();
        $data = $category->getCategoryList([],'category_name,category_id');
        return $this->response($data);
    }

    /*
     *  申请入驻
     * */
    public function apply()
    {
        //用户信息
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $uid = request()->param('uid');
        
        $user_model = new UserModel();
       $user_info = model('user')->getInfo([['uid','=',$uid]]);
        
        //申请信息
        $apply_data = [
            'site_id' => input('site_id', 0),
            'website_id' => input('website_id', 0),//分站id
            'uid' => $user_info[ 'uid' ],//用户ID
            'username' => '测试',//账户
            'shop_name' => input("shop_name", ''),//申请店铺名称
            'apply_state' => 1,//审核状态（待审核）
            'apply_year' => input("apply_year", 5),//入驻年长
            'category_name' => input("category_name", ''),//店铺分类名称
            'category_id' => input("category_id", ''),//店铺分类id
            'group_name' => input("group_name", '旗舰店铺'),//开店套餐名称
            'group_id' => input("group_id", 1)// 开店套餐ID
        ];
        

        //认证信息


        /*if ($cert_type == 1) {//个人

        } else {//公司
            $cert_data = [
                'cert_type' => $cert_type,
                'company_name' => input("company_name", ''),//公司名称
                'company_province_id' => input("province_id", ''),//公司所在省
                'company_city_id' => input("city_id", ''),//公司所在市
                'company_district_id' => input("district_id", ''),//公司所在区/县
                'company_address' => input("company_address", ''),//公司地址
                'company_full_address' => input("company_full_address", ''),//公司完整地址
                'business_licence_number' => input("business_licence_number", ''),//统一社会信用码
                'business_licence_number_electronic' => input("business_licence_number_electronic", ''),//营业执照电子版
                'business_sphere' => input("business_sphere", ''),//法定经营范围
                'taxpayer_id' => input("taxpayer_id", ''),//纳税人识别号
                'tax_registration_certificate' => input("tax_registration_certificate", ''),//税务登记证号
                'tax_registration_certificate_electronic' => input("tax_registration_certificate_electronic", ''),//税务登记证号电子版
                'contacts_name' => input("contacts_name", ''),//联系人姓名
                'contacts_mobile' => input("contacts_mobile", ''),//联系人手机
                'contacts_card_no' => input("contacts_card_no", ''),//联系人身份证
                'contacts_card_electronic_1' => input("contacts_card_electronic_1", ''),//申请人手持身份证电子版
                'contacts_card_electronic_2' => input("contacts_card_electronic_2", ''),//申请人身份证正面
                'contacts_card_electronic_3' => input("contacts_card_electronic_3", ''),//申请人身份证反面
                'bank_account_name' => input("bank_account_name", ''),//银行开户名
                'bank_account_number' => input("bank_account_number", ''),//公司银行账号
                'bank_name' => input("bank_name", ''),//联系人姓名
                'bank_address' => input("bank_address", ''),//开户银行所在地
                'bank_code' => input("bank_code", ''),//支行联行号
                'bank_type' => input("bank_type", ''),//结算账户类型
                'settlement_bank_account_name' => input('settlement_bank_account_name', ''),
                'settlement_bank_account_number' => input('settlement_bank_account_number', ''),
                'settlement_bank_name' => input("settlement_bank_name", ''),//结算开户银行支行名称
                'settlement_bank_address' => input("settlement_bank_address", '')//结算开户银行所在地
            ];
        }*/

        $cert_data = [
            'cert_type' => 1,
            'contacts_name' => input("contacts_name", ''),//联系人姓名
            'contacts_mobile' => input("contacts_mobile", ''),//联系人手机
            'contacts_card_no' => input("contacts_card_no", ''),//联系人身份证
            'contacts_card_electronic_1' => input("contacts_card_electronic_1", ''),//申请人手持身份证电子版
            'contacts_card_electronic_2' => input("contacts_card_electronic_2", ''),//申请人身份证正面
            'contacts_card_electronic_3' => input("contacts_card_electronic_3", ''),//申请人身份证反面
            'bank_account_name' => input("bank_account_name", ''),//银行开户名
            'bank_account_number' => input("bank_account_number", ''),//公司银行账号
            'bank_name' => input("bank_name", ''),//联系人姓名
            'bank_address' => input("bank_address", ''),//开户银行所在地
            'bank_code' => input("bank_code", ''),//支行联行号
            'bank_type' => input("bank_type", ''),//结算账户类型
            'settlement_bank_account_name' => input('settlement_bank_account_name', ''),
            'settlement_bank_account_number' => input('settlement_bank_account_number', ''),
            'settlement_bank_name' => input("settlement_bank_name", ''),//结算开户银行支行名称
            'settlement_bank_address' => input("settlement_bank_address", '')//结算开户银行所在地
        ];
        $model = new ShopApplyModel();
        $result = $model->apply($apply_data, $cert_data);
        return $this->response($result);
    }
    
    public function  getCategroup()
    {
        $shop_category_model = new ShopCategoryModel();
        $shop_category = $shop_category_model->getCategoryList('', '*', 'sort asc', '');
        return $this->response($shop_category);
    }

    /**
     * 判断结算类型
     */
    public function getTransferType()
    {

        $support_type = [];
        if (addon_is_exit("shopwithdraw")) {
            $config_model = new ShopWithdrawConfig();
            $config_result = $config_model->getConfig();
            $config = $config_result[ "data" ];
            if ($config[ "is_use" ]) {
                $support_type = explode(",", $config[ 'value' ][ "transfer_type" ]);
            } else {
                $support_type = [ "alipay", "bank" ];
            }
        } else {
            $support_type = [ "alipay", "bank" ];
        }
        return $support_type;
    }


    /**
     * 判断店铺名称是否存在
     */
    public function shopNameExist()
    {
        $shop_name = input('shop_name', '');

        $model = new ShopApplyModel();
        $condition = [ [ 'shop_name', '=', $shop_name ] ];
        $res = $model->getApplyInfo($condition, 'apply_id');
        return $res[ 'data' ];
    }

    /*
     * 获取申请金额
     * */
    public function getApplyMoney()
    {
        $apply_year = input("apply_year", '');//入驻年长
        $category_id = input("category_id", '');//店铺分类id
        $group_id = input("group_id", '');//店铺等级ID

        $model = new ShopApplyModel();
        $result = $model->getApplyMoney($apply_year, $group_id, $category_id);
        return $result;
    }

    /*
     *   提交支付凭证
     **/
    public function editApply()
    {
        if (request()->isAjax()) {
            //用户信息
            $user_model = new UserModel();
            $user_info = $user_model->userInfo($this->app_module);
            //申请信息
            $apply_data = [
                'paying_money_certificate' => input("paying_money_certificate", ''),// 付款凭证
                'paying_money_certificate_explain' => input("paying_money_certificate_explain", ''),// 付款凭证说明
                'apply_state' => 2
            ];

            $model = new ShopApplyModel();
            $condition[] = [ 'uid', '=', $user_info[ 'uid' ] ];
            $result = $model->editApply($apply_data, $condition);
            return $result;
        }
    }

    /**
     * 体验入驻
     */
    public function experienceApply()
    {
        //用户信息
        $user_model = new UserModel();
        $user_info = $user_model->userInfo($this->app_module);
        $this->assign('userInfo', $user_info);
        $this->assign("menu_info", [ 'title' => "店铺申请" ]);
        $this->assign("shop_info", [ 'site_name' => "店铺端" ]);

        //店铺主营行业
        $shop_category_model = new ShopCategoryModel();
        $shop_category = $shop_category_model->getCategoryList('', '*', 'sort asc', '');
        $this->assign('shop_category', $shop_category);

        //入驻协议
        $config_model = new ConfigModel();
        $shop_apply_agreement = $config_model->getShopApplyAgreement();
        $this->assign('shop_apply_agreement', $shop_apply_agreement);

        //平台配置信息
        $website_model = new WebsiteModel();
        $website_info = $website_model->getWebSite([ [ 'site_id', '=', 0 ] ], 'web_phone');
        $this->assign('website_info', $website_info[ 'data' ]);

        //判断入驻状态
        $user_model = new UserModel();
        $status = $user_model->getUserInfo([ [ 'uid', '=', $user_info[ 'uid' ] ] ], 'site_id');
        $this->assign('status', $status);

        if (request()->isAjax()) {
            $shop_data = [
                'site_name' => input('site_name', ''),    //店铺名称
                'category_id' => input('category_id', ''),      //主营行业id
                'category_name' => input('category_name', ''),  //主营行业名称
                'website_id' => input('website_id', 0),
            ];
            $model = new ShopApply();
            $res = $model->experienceApply($shop_data, $user_info);
            return $res;
        }

        //城市分站
        $is_city_addon = addon_is_exit('city');
        $this->assign('is_city', $is_city_addon);
        if ($is_city_addon == 1) {//存在
            //获取城市分站信息
            $city = $website_model->getWebsiteList([ [ 'site_id ', '>=', 0 ], [ 'status', '=', 1 ] ], 'site_id,site_area_id,site_area_name');
            $this->assign('web_city', $city[ 'data' ]);
        } else {//不存在
            $this->assign('web_city', []);
        }

        return $this->fetch('apply/experience_apply');
    }

    /**
     *  模拟登陆
     */
    public function simulatedLogin()
    {
        if (request()->isAjax()) {
            $username = input('username', '');
            $user_model = new UserModel;
            $result = $user_model->simulatedLogin($username, $this->app_module);
            return $result;
        }
    }

    /**
     * 店铺绑定openid 二维码
     */
    public function shopBindQrcode()
    {
        $key = 'bing_shop_openid_' . md5(uniqid(null, true));
        $url = addon_url("wechat://api/auth/shopBindOpenid", [ "key" => $key ]);
        Session::set("bing_shop_openid", $key);
        Cache::tag("bing_shop_openid")->set($key, [], 600);
        return \extend\QRcode::png($url, false, '', 4, 1);
    }

    /**
     * 验证店铺绑定情况(成功返回openid)
     */
    public function checkShopBind()
    {
        $key = Session::get("bing_shop_openid");
        $data = Cache::get($key);
        $shop_apply_model = new ShopApplyModel();
        if (!isset($data)) {
            return $shop_apply_model->error([ "is_expire" => 1 ], "二维码已过期");
        }

        if (empty($data)) {
            return $shop_apply_model->error([ "is_expire" => 0 ], "二维码还没有被扫描");
        }

        return $shop_apply_model->success($data);
    }
}