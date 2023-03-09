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

namespace app\shop\controller;

use app\model\shop\Shop as ShopModel;
use app\model\shop\ShopAccount;
use app\model\shop\ShopDeposit;
use app\model\system\Address as AddressModel;
use app\model\order\OrderCommon;
use app\model\web\Config as ConfigModel;
use app\model\system\Config as ConfigSystemModel;

/**
 * 店铺
 * Class Shop
 * @package app\shop\controller
 */
class Shop extends BaseShop
{


    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 店铺设置
     * @return mixed
     */
    public function config()
    {
        $shop_model = new ShopModel();
        $condition = array(
            ["site_id", "=", $this->site_id]
        );
        if (request()->isAjax()) {
            $logo = input("logo", '');//店铺logo
            $avatar = input("avatar", '');//店铺头像（大图）
            $banner = input("banner", '');//店铺条幅
            $seo_keywords = input("seo_keywords", '');//店铺关键字
            $seo_description = input("seo_description", '');//店铺简介
            $conceal = input("conceal", '');//是否隐藏  
            $data = array(
                "logo" => $logo,
                "avatar" => $avatar,
                "banner" => $banner,
                "seo_keywords" => $seo_keywords,
                "seo_description" => $seo_description,
                'conceal'=>$conceal
//				'shop_status' => 1
            );
            $res = $shop_model->editShop($data, $condition);
            return $res;
        } else {
            $shop_info_result = $shop_model->getShopInfo($condition);
            $shop_info = $shop_info_result["data"];
            $this->assign("shop_info", $shop_info);
            return $this->fetch("shop/config");
        }

    }

    /**
     * 联系方式
     * @return mixed
     */
    public function contact()
    {
        $shop_model = new ShopModel();
        $condition = array(
            ["site_id", "=", $this->site_id]
        );
        if (request()->isAjax()) {
            $province = input("province", 0);//省级地址
            $province_name = input("province_name", '');//省级地址
            $city = input("city");//市级地址
            $city_name = input("city_name", '');//市级地址
            $district = input("district", 0);//县级地址
            $district_name = input("district_name", '');//县级地址
            $community = input("community", 0);//乡镇地址
            $community_name = input("community_name", '');//乡镇地址
            $address = input("address", 0);//详细地址
            $full_address = input("full_address", 0);//完整地址
            $longitude = input("longitude", '');//经度
            $latitude = input("latitude", '');//纬度

            $qq = input("qq", '');//qq号
            $ww = input("ww", '');//阿里旺旺
            $email = input("email", '');//邮箱
            $telephone = input("telephone", '');//联系电话
            $name = input("name", '');//联系人姓名
            $mobile = input("mobile", '');//联系人手机号

            $work_week = input("work_week", '');//工作日  例如 : 1,2,3,4,5,6,7
            $start_time = input("start_time", 0);//开始时间
            $end_time = input("end_time", 0);//结束时间
            $data = array(
                "province" => $province,
                "province_name" => $province_name,
                "city" => $city,
                "city_name" => $city_name,
                "district" => $district,
                "district_name" => $district_name,
                "community" => $community,
                "community_name" => $community_name,
                "address" => $address,
                "full_address" => $full_address,
                "longitude" => $longitude,
                "latitude" => $latitude,
                "qq" => $qq,
                "ww" => $ww,
                "email" => $email,
                "telephone" => $telephone,
                "work_week" => $work_week,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "name" => $name,
                "mobile" => $mobile
            );
            $res = $shop_model->editShop($data, $condition);
            return $res;
        } else {
            $shop_info_result = $shop_model->getShopInfo($condition);
            $shop_info = $shop_info_result["data"];
            $this->assign("info", $shop_info);

            //查询省级数据列表
            $address_model = new AddressModel();
            $list = $address_model->getAreaList([["pid", "=", 0], ["level", "=", 1]]);
            $this->assign("province_list", $list["data"]);

            //获取地址key配置
            $config_model = new ConfigModel();
            $config = $config_model->getMapConfig();
            $this->assign('map_key', $config['data']['value']);
            return $this->fetch("shop/contact");
        }

    }

    /**
     * 店铺装修
     * @return mixed
     */
    public function decoration()
    {
        return $this->fetch("shop/decoration");
    }

    /**
     * 账户信息
     * @return mixed
     */
    public function account()
    {
        $shop_model = new ShopModel();
        $shop_account_model = new ShopAccount();
        //获取商家转账设置
        $shop_withdraw_config = $shop_account_model->getShopWithdrawConfig();

        $condition = array(
            ["site_id", "=", $this->site_id]
        );
        $shop_info_result = $shop_model->getShopInfo($condition, 'account, account_withdraw, shop_baozhrmb');
        $shop_info = $shop_info_result["data"];

        //获取店家结算账户信息
        $shop_cert_result = $shop_model->getShopCert($condition, 'bank_type, settlement_bank_account_name, settlement_bank_account_number, settlement_bank_name, settlement_bank_address');

        $this->assign("account", $shop_info['account']);//账户余额
        $this->assign("account_withdraw", $shop_info['account_withdraw']); //已提现
        $this->assign('order_calc', 0);//待结算
        $this->assign('shop_deposit', $shop_info['shop_baozhrmb']);//保证金
        $this->assign('shop_withdraw_config', $shop_withdraw_config['data']['value']);//商家转账设置
        $this->assign('shop_cert_info', $shop_cert_result['data']);//店家结算账户信息
        return $this->fetch("shop/account");
    }

    /**
     * 认证信息
     */
    public function cert()
    {
        $shop_model = new ShopModel();
        $condition = array(
            ["site_id", "=", $this->site_id]
        );
        $cert_info_result = $shop_model->getShopCert($condition);
        $cert_info = $cert_info_result["data"];
        $this->assign("cert_info", $cert_info);
        return $this->fetch("shop/cert");
    }


    /**
     * 获取待结算列表
     */
    public function getOrderCalc()
    {
        if (request()->isAjax()) {
            $order = new OrderCommon();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $is_refund = input("is_refund", '');
            $condition = array(
                ['site_id', "=", $this->site_id],
                ['is_settlement', "=", 0],
                ['order_status', "not in", '0,-1'],
            );

            if ($is_refund !== '') {
                $condition[] = ['refund_status', '=', $is_refund];
            }
            $order_no = input('order_no', '');
            if ($order_no) {
                $condition[] = ['order_no', 'like', '%' . $order_no . '%'];
            }

            $list = $order->getOrderPageList($condition, $page, $page_size, 'create_time desc', $field = 'order_id,order_no,order_type_name,order_status_name,order_money,shop_money,platform_money,is_settlement,create_time,order_type');
            return $list;
        }
    }


    /**
     * 获取账户流水
     */
    public function getShopAccount()
    {
        if (request()->isAjax()) {
            $account_model = new ShopAccount();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $order = input("order", "create_time desc");
            $condition[] = ['site_id', "=", $this->site_id];

            $start_time = input('start_time', '');
            $end_time = input('end_time', '');
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = ["create_time", ">=", date_to_time($start_time)];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = ["create_time", "<=", date_to_time($end_time)];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = ["create_time", "between", [date_to_time($start_time), date_to_time($end_time)]];
            }
            $type_name = input('type_name', '');
            if ($type_name) {
                $condition[] = ['type_name', '=', $type_name];
            }

            $list = $account_model->getAccountPageList($condition, $page, $page_size, $order);
            return $list;
        }
    }

    /**
     * 获取保证金记录
     */
    public function getShopDeposit()
    {
        if (request()->isAjax()) {
            $shop_deposit_model = new ShopDeposit();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $order = input("order", "id desc");
            $search_text = input("search_text", "");

            $condition = array(
                ['site_id', "=", $this->site_id],
            );
            if (!empty($search_text)) {
                $condition[] = ['pay_no|pay_account_name', 'like', '%' . $search_text . '%'];
            }
            $list = $shop_deposit_model->getShopDepositPageList($condition, $page, $page_size, $order);
            return $list;
        }
    }

    /**
     * 续签信息
     * @return mixed
     */
    public function reopen()
    {
        return $this->fetch("shop/reopen");
    }

    /**
     * 店铺推广
     * return
     */
    public function shopUrl()
    {
        //获取商品sku_id
        $shop_model = new ShopModel();
        $res = $shop_model->qrcode($this->site_id);
        // dump($res);exit;
        return $res;
    }
    
    /**
     * 店铺推广
     * return
     */
    public function shoptUrl()
    {
        //获取商品sku_id
        $shop_model = new ShopModel();
        $res = $shop_model->getqrcode($this->site_id);
        
        return $res;
    }
    
        public function getAccessToken(){
        $config = new ConfigSystemModel();
        $res = $config->getConfig([ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'admin' ], [ 'config_key', '=', 'WEAPP_CONFIG' ] ]);

        $appid = $res['data']['value']['appid'];
        $secret =$res['data']['value']['appsecret'];
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;

        $res = json_decode($this->curl_get($url));
        
         $access_token = @$res->access_token;
         
        return $access_token;
 }

 public function curl_get($url){

       $header = array(
           'Accept: application/json',
        );
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 超时设置,以秒为单位
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //执行命令
        $data = curl_exec($curl);

        // 显示错误信息
        if (curl_error($curl)) {
            print "Error: " . curl_error($curl);
        } else {
            
        // 打印返回的内容
        curl_close($curl);
        return $data;
    }
}

public function getXcxCode(){

    //获取access token
    //判断当前用户是否已经有对应二维码

        $shop_watch = model('shop')->getValue([['site_id', '=', $this->site_id]], 'shop_watch');
        if ($shop_watch) {
            //有对应二维码 直接返回二维码
            return $shop_watch;
        }
    $ACCESS_TOKEN = $this->getAccessToken();

    //创建二维码
    $qcode ="https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=".$ACCESS_TOKEN;
    
    $param = json_encode(array("path"=>"otherpages/shop/index/index?site_id=".$this->site_id,"width"=> 150));
    $result = $this->curl_post( $qcode, $param);
    
    $time = time()+mt_rand(999,99999);

    $flie_name = "upload/common/images/" . date("Ymd") ;
            $path = $flie_name.'/'.$time . '.' . 'png';
        $this -> setDir($flie_name);
    file_put_contents($path, $result);
    //将二维码地址存入数据库中
        $shop_watch = model('shop')->setFieldValue([['site_id', '=', $this->site_id]], 'shop_watch', $path);

  

    
    
    
    $base64_image ="data:image/jpeg;base64,".base64_encode( $result );

    $data = [
            'code' => 0,
            'msg'  =>'二维码获取成功',
            'data' =>'<image src='.$base64_image.'></image>'
        ];
        return json($data);
  

    }
    public function setDir($file_dir)
    {
        if(!file_exists($file_dir))
        {
            mkdir($file_dir,0777,TRUE);
        }
        // 文件名，这里只是演示，实际项目中请使用自己的唯一文件名生成方法
        return true;
    }
    
    public  function curl_post( $url, $postdata ) {

        $header = array(
            'Accept: application/json',
        );

        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 超时设置
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE );

        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        //执行命令
        $data = curl_exec($curl);

        // 显示错误信息
        if (curl_error($curl)) {
            print "Error: " . curl_error($curl);
        } else {
            // 打印返回的内容
          
            curl_close($curl);
            return $data;
        }
    }
        public function getCode()
    {
        //获取二维码
        $shop_watch = model('shop')->getValue([['site_id', '=', $this->site_id]], 'shop_watch');
        $this->assign("shop_watch", $shop_watch);
        return $this->fetch("shop/getCode");
    }

}