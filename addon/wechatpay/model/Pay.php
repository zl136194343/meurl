<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace addon\wechatpay\model;

use app\model\member\Member;
use app\model\upload\Upload;
use EasyWeChat\Factory;
use app\model\system\Pay as PayCommon;
use app\model\BaseModel;
use addon\weapp\model\Config as WeappConfig;
use addon\wechat\model\Config as WechatConfig;
use app\model\system\Pay as PayModel;

/**
 * 微信支付配置
 */
class Pay extends BaseModel
{
    private $app;//微信模型
    private $is_weapp = 0;
    private $config = [];
    private $mch_key_v3;
    private $aesKey;
    private $wxMerchantId = '1630049547';//商户号
    private $wxMerchantApiCertificate  = './cert/apiclient_cert.pem';       //商户证书
    private $wxMerchantApiPrivateKey   = './cert/apiclient_key.pem';
    private $wxApiSerialNo = '42B36F84430B48A5224207E1A20D3D628DA53BD9';                //商户API证书序列号mch_key_v3
    private $wxApiV3Key = '8WEo6eduktcNu2DTY8IYyZvmT86jkgeL';
    const KEY_LENGTH_BYTE = 32;
    const AUTH_TAG_LENGTH_BYTE = 16;
    public function __construct($is_weapp = 0)
    {
        $this->is_weapp = $is_weapp;
        //微信支付配置
        $config_model = new Config();
        $config_result = $config_model->getPayConfig();
        $config = $config_result["data"];
        if(!empty($config)){
            $config_info = $config["value"] ?? [];
        }else{
            $config_info = [];
        }
        $app_id = "";
        if($is_weapp == 0){
            $wechat_config_model = new WechatConfig();
            $wechat_config_result = $wechat_config_model->getWechatConfig();
            $wechat_config = $wechat_config_result["data"];
            $app_id = $wechat_config["value"]["appid"] ?? '';
        }else{
            $weapp_config_model = new WeappConfig();
            $weapp_config_result = $weapp_config_model->getWeappConfig();
            $weapp_config = $weapp_config_result["data"];
            $app_id = $weapp_config["value"]["appid"] ?? '';
        }

        $this->config = [
            'app_id' => $app_id,        //应用id
            'mch_id' => $config_info["mch_id"] ?? '',       //商户号
            'key'   => $config_info["pay_signkey"] ?? '',          // API 密钥
            // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
            'cert_path' => $config_info["apiclient_cert"] ?? '', // apiclient_cert.pem XXX: 绝对路径！！！！
            'key_path' => $config_info["apiclient_key"] ?? '',   // apiclient_key.pem XXX: 绝对路径！！！！
            'notify_url' => '',// 你也可以在下单时单独设置来想覆盖它
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
            /**
             * 日志配置
             *
             * level: 日志级别, 可选为：debug/info/notice/warning/error/critical/alert/emergency
             * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
             * file：日志文件位置(绝对路径!!!)，要求可写权限
             */
            'log' => [
                'level'      => 'debug',
                'permission' => 0777,
                'file'       => 'runtime/log/wechat/easywechat.logs',
            ],
            'sandbox' => false, // 设置为 false 或注释则关闭沙箱模式
        ];

//        $this->app = Factory::officialAccount($config);
//        $response = $this->app->server->serve();
        // 将响应输出
//        $response->send();exit; // Laravel 里请使用：return $response;
    }

    /**
     * 生成支付
     * @param $param
     */
    public function pay($param){

        ///绑定商户数据
        $pay_model = new PayModel();
        $pay_model->bindMchPay($param["out_trade_no"], ["app_id" => $this->config["app_id"]]);

        $this->app = Factory::payment($this->config);
        $openid = "";
        //获取用户的open_id
        $member_model = new Member();
        switch ($param["trade_type"]){
            case 'JSAPI' :
                if( $this->is_weapp == 1){
                    $member_info_result = $member_model->getMemberInfo([["member_id", "=", $param["member_id"]]], "weapp_openid");
                    $member_info = $member_info_result["data"];
                    $openid = $member_info["weapp_openid"];
                }else{
                    $member_info_result = $member_model->getMemberInfo([["member_id", "=", $param["member_id"]]], "wx_openid");
                    $member_info = $member_info_result["data"];
                    $openid = $member_info["wx_openid"];
                }
                break;
            case 'NATIVE' :
                break;
            case 'MWEB' :
                break;
            case 'APP' :
                break;
        }
        $data = array(
            'body' => str_sub($param["pay_body"], 15),
            'out_trade_no' => $param["out_trade_no"],
            'total_fee' => $param["pay_money"] * 100,
//            'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            'notify_url' => $param["notify_url"], // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => $param["trade_type"], // 请对应换成你的支付方式对应的值类型
            'openid' => $openid,
        );
        $result = $this->app->order->unify($data);
        //调用支付失败
        if($result["return_code"] == 'FAIL'){
            return $this->error([], $result["return_msg"]);
        }
        if($result["result_code"] == 'FAIL'){
            return $this->error([], $result["err_code_des"]);
        }

        switch ($param["trade_type"]){
            case 'JSAPI' ://微信支付 或小程序支付
                if( $this->is_weapp == 0){
                    $jssdk = $this->app->jssdk;
                    $config = $jssdk->sdkConfig($result['prepay_id'], false);
                    $return = array(
                        "type" => "jsapi",
                        "data" => $config
                    );
                }else{
                    $jssdk = $this->app->jssdk;
                    $config = $jssdk->bridgeConfig($result['prepay_id'], false);
                    $return = array(
                        "type" => "jsapi",
                        "data" => $config
                    );
                }
                break;
            case 'APPLET' ://微信支付 或小程序支付
                $jssdk = $this->app->jssdk;
                $config = $jssdk->bridgeConfig($result['prepay_id'], false);
                $return = array(
                    "type" => "jsapi",
                    "data" => $config
                );
                break;
            case 'NATIVE' :
                $code_url = $result['code_url'];
                $upload_model = new Upload();
                $qrcode_result = $upload_model->qrcode($code_url);
                $qrcode = $qrcode_result['data'] ?? '';
                $return = array(
                    "type" => "qrcode",
                    "qrcode" => $qrcode
                );
                break;
            case 'MWEB' ://H5支付
                $mweb_url = $result['mweb_url'];
                $return = array(
                    "type" => "url",
                    "url" => $mweb_url
                );
                break;
            case 'APP' :
                $jssdk = $this->app->jssdk;
                $config = $jssdk->appConfig($result['prepay_id']);
                $return = array(
                    "type" => "app",
                    "data" => $config
                );
                break;
        }
        return $this->success($return);
    }
    
    /**
     * 支付异步通知
     * @param $param
     * @return mixed
     */
    public function payNotify(){
        $this->app = Factory::payment($this->config);
        $response = $this->app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单

            $pay_common = new PayCommon();
            if (!empty($pay_info)) {
                // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                if ($message['result_code'] === 'SUCCESS') {// 用户是否支付成功
                    //定义支付失败
                    $pay_common->onlinePay($message['out_trade_no'], "wechatpay", $message["transaction_id"], "wechatpay");
                } elseif ($message['result_code'] === 'FAIL') {// 用户支付失败
                    //定义支付失败(更新订单支付失败)

                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }
            return true; // 返回处理完成
        });
        $response->send();
//         return $response;
    }
    
    /**
     * 关闭支付
     * @param $param
     */
    public function close($param){

        $pay_info = $param;
        $mch_info = [];
        if(!empty($pay_info['mch_info'])){
            $mch_info = json_decode($pay_info['mch_info'], true);
        }
        $this->config["app_id"] = $mch_info["app_id"] ?? '';//替换为商户自己的appid
        $this->app = Factory::payment($this->config);
        $result = $this->app->order->close($param["out_trade_no"]);
        //调用支付失败
        if($result["return_code"] == 'FAIL'){
            return $this->error([], $result["return_msg"]);
        }
        if($result["result_code"] == 'FAIL'){
            return $this->error([], $result["err_code_des"]);
        }

        return $this->success();
    }

    /**
     * 微信原路退款
     * @param $param
     */
    public function refund($param){
        $pay_info = $param["pay_info"];
        $mch_info = [];
        if(!empty($pay_info['mch_info'])){
            $mch_info = json_decode($pay_info['mch_info'], true);
        }
        $this->config["app_id"] = $mch_info["app_id"] ?? '';//替换为商户自己的appid
        $this->app = Factory::payment($this->config);
        $refund_no = $param["refund_no"];
        $total_fee = round($pay_info["pay_money"] * 100);
        $refund_fee = round($param["refund_fee"] * 100);
        $desc_data = array();

//        $desc_data["refund_desc"] = $param["refund_reason"];// 商家退款原因 暂时不考虑
        if(!empty($pay_info["trade_no"])){
            //根据微信订单号退款
            // 参数分别为：微信订单号、商户退款单号、订单金额、退款金额、其他参数
            $result = $this->app->refund->byTransactionId($pay_info["trade_no"], $refund_no, $total_fee, $refund_fee, $desc_data);
        }else{
            $result = $this->app->refund->byOutTradeNumber($pay_info["out_trade_no"], $refund_no, $total_fee, $refund_fee, $desc_data);
        }
        //调用支付失败
        if($result["return_code"] == 'FAIL'){
            return $this->error([], $result["return_msg"]);
        }
        if($result["result_code"] == 'FAIL'){
            return $this->error([], $result["err_code_des"]);
        }

        return $this->success();

    }
    
    /**
     * 微信转账到零钱
     * @param array $param
     */
    public function transfer2(array $param){

//        halt($param);
        try {
            $config_model = new Config();
            $config_result = $config_model->getPayConfig();
            if ($config_result['code'] < 0) return $config_result;
            $config = $config_result['data']['value'];
            if (empty($config)) return $this->error([], '平台未配置微信支付');
            if (!$config['transfer_status'])
                return $this->error([], '平台未启用微信转账');
            $time = time();
            $this->app = Factory::payment($this->config);
            $data = [
                'partner_trade_no' => $param['out_trade_no'], // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
                'openid' => $param['account_number'],
//                'check_name' => 'FORCE_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
                'check_name' => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
                're_user_name' => $param['real_name'], // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
                'amount' => $param['amount'] * 100, // 转账金额
                'desc' => $param['desc'] ?? ''
            ];

//            $data = [
//                    "out_batch_no" => $param['out_trade_no'] , //商家批次单号,商户系统内部的商家批次单号，要求此参数只能由数字、大小写字母组成，在商户系统内部唯一 示例值：plfk2020042013
//                    "batch_name"   => date("Y年m月d日",$time)."转账给".$param['real_name'].$param["amount"]."元", // 批次名称
//                    "batch_remark" => date("Y年m月d日",$time)."转账给".$param['real_name'].$param["amount"]."元", //批次备注
//                    "total_amount" => intval($param['amount'] * 100), // 转账金额
//                    "total_num"    => 1, //转账总笔数
//                    "transfer_detail_list"  => [
//                        'out_detail_no' => $param['out_trade_no'],
//                        'transfer_amount'  => intval($param['amount'] * 100),
//                        'transfer_remark'  => date("Y年m月d日",$time)."转账给".$param['real_name'].$param["amount"]."元",
//                        'openid'           => 'o0HST5S72KUJUWqycH69cwee4dfg' ,
//                        'user_name'        => $param['real_name'],
//                    ]
//            ];
//            halt($data);
            $res = $this->app->transfer->toBalance($data);
//            $res = $this->app->transfer->toAccount($data);
//            halt($res);
            if ($res['return_code'] == 'SUCCESS') {
                if ($res['result_code'] == 'SUCCESS') {
                    return $this->success([
                        'out_trade_no' => $res['partner_trade_no'], // 商户交易号
                        'payment_no' => $res['payment_no'], // 微信付款单号
                        'payment_time' => $res['payment_time'] // 付款成功时间
                    ]);
                } else {
                    return $this->error([], $res['err_code_des']);
                }
            } else {
                return $this->error([], $res['return_msg']);
            }
        } catch (\Exception $e) {

            return $this->error([], $e->getMessage());
        }
    }


    /**
     * 微信转账到零钱
     * @param array $param
     */
    public function transfer(array $param){
        try {
            
            $config_model = new Config();
            $config_result = $config_model->getPayConfig();

            if ($config_result['code'] < 0) return $config_result;
            $config = $config_result['data']['value'];
            if (empty($config)) return $this->error([], '平台未配置微信支付');
            if (!$config['transfer_status'])
                return $this->error([], '平台未启用微信转账');
        
            $this->app = Factory::payment($this->config);

            $url = 'https://api.mch.weixin.qq.com/v3/transfer/batches';
            $auh_url = "https://api.mch.weixin.qq.com/v3/certificates";
            
            #获取authorization
            /*$this->wxMerchantId = '1622396388';//商户号
            $this->wxMerchantApiCertificate  = './cert/apiclient_cert.pem';       //商户证书
            $this->wxMerchantApiPrivateKey   = './cert/apiclient_key.pem';        //商户私钥
            $this->wxApiSerialNo = '42B36F84430B48A5224207E1A20D3D628DA53BD9';                //商户API证书序列号mch_key_v3
            $this->wxApiV3Key = '38mRczVnLKlTjLeduDyvI8sKx42xCw2d';*/                                                           //微信API v3密钥
            $this->aesKey = $this->wxApiV3Key;
            $Wechatpay_Serial = $this->wx_ciphertext($this->wxMerchantId,$this->wxMerchantApiPrivateKey,$this->wxApiSerialNo);
           
            if ($param['amount'] < 1 || $param['amount'] > 500) {
                return $this->error([], '单笔实际转账金额区间1.00元 - 500.00元');
            }
            

            $data = [
                'out_detail_no' => $param['out_trade_no'], // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
                'openid' => $param['account_number'],
                'transfer_amount' =>intval($param['amount'] * 100), // 转账金额
                'transfer_remark' => $param['desc'] ?? ''
            ];
            
            if ($data['transfer_amount'] >= 2000 ) {
                if (empty($param['real_name'])) {
                    return $this->error([],'当前用户尚未填写真实姓名,不支持在线转账');
                }
                $data['user_name'] = $this->getEncrypt($param['real_name'],$Wechatpay_Serial['dl']); // 如果 check_name
            }

            $da = [
                'appid'=>$this->appid,
                'out_batch_no'=>$param['out_trade_no'],
                'batch_name'=>'婚业汇联',
                'batch_remark'=>$param['desc'] ?? '',
                'total_amount' =>intval($param['amount'] * 100),
                'total_num' =>1,
            ];


            $da['transfer_detail_list'][] =$data;
            $da = json_encode($da);

////            dump($wxApiSerialNo);die;
            $authorization =$this-> RequestSign("POST", $url, $da, $this->wxMerchantId, $this->wxMerchantApiPrivateKey, $this->wxApiSerialNo);

            $res = $this ->curl_post($url,$da,$authorization,$Wechatpay_Serial['serial_no']);
            $res = json_decode($res,true);
             
            try{
                if(!empty($res['out_batch_no'])){
                    //转账成功.修改当前状态
                    
                    return $this->success([
                        'out_trade_no' => $res['out_batch_no'], // 商户交易号
                        'payment_no' => $res['batch_id'], // 微信付款单号
                        'payment_time' => $res['create_time'] // 付款成功时间
                    ]);
                }else{
                    
                    return $this->error([], $res['message']);
                }
            }catch (\Exception $e){
               
                return $this->error([], $res['message']);
            }
            //对接微信新接口
        } catch (\Exception $e) {

            return $this->error([], $e->getMessage());
        }
    }
    public function RequestSign($method = "POST", $url = "", $request = "", $wxMerchantId, $certKey, $wxApiSerialNo)
    {
        #截取获取当前请求地址【去除域名】
        $url_parts = parse_url($url);

        $path = ($url_parts['path'] . (!empty($url_parts['query']) ? "?${url_parts['query']}" : ""));
        #获取当前时间戳
        $timeStamp = time();
        #生成一个随机字符串
        $nonceStr = $this->getNonceStr();
        #构造签名串
        $requestSign = sprintf("%s\n%s\n%s\n%s\n%s\n", $method, $path, $timeStamp, $nonceStr, $request);
        #计算计算签名值




        $sign = $this->calculateSignatureValue($requestSign, $certKey);
        /*dump($certKey);
        dump($sign);die;*/
        #设置HTTP头获取Authorization
        $token = $this->createToken($wxMerchantId, $nonceStr, $timeStamp, $wxApiSerialNo, $sign);
        #返回
        return $token;
    }
    
    public function batches($batches){
        $url = 'https://api.mch.weixin.qq.com/v3/transfer/batches/batch-id/'.$batches['data']['payment_no'].'?need_query_detail=true&detail_status=ALL';
        
        $authorization =$this-> RequestSign("GET", $url, '',  $this->wxMerchantId,  $this->wxMerchantApiPrivateKey,  $this->wxApiSerialNo);
       
        $data =  $this ->curl_get($url,$authorization);
        $data = json_decode($data,true);
        return $data;
    }
    
    public function batchesTwo($batches){
        $url = 'https://api.mch.weixin.qq.com/v3/transfer/batches/out-batch-no/'.$batches['data']['out_trade_no'].'/details/out-detail-no/'.$batches['data']['out_trade_no'];
        /*$url = 'https://api.mch.weixin.qq.com/v3/transfer/batches/batch-id/'.$batches['payment_no'].'?need_query_detail=是&offset=1';*/
        $authorization =$this-> RequestSign("GET", $url, '',  $this->wxMerchantId,  $this->wxMerchantApiPrivateKey,  $this->wxApiSerialNo);

        $data =  $this ->curl_get($url,$authorization);
        return json_decode($data,true);
    }
    
    /**
     * 计算签名值
     * @param $requestSign
     * @param $certKey
     * @return string
     * 使用商户私钥对待签名串进行SHA256 with RSA签名，并对签名结果进行Base64编码得到签名值
     */
    public function calculateSignatureValue($requestSign, $certKey)
    {



        $certKey = file_get_contents($certKey);

        openssl_sign($requestSign, $raw_sign, $certKey, 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);
        return $sign;
    }
    /**
     * 获取token
     * @param $merchant_id
     * @param $nonce
     * @param $timestamp
     * @param $serial_no
     * @param $sign
     * @return string
     */
    public function createToken($merchant_id, $nonce, $timestamp, $serial_no, $sign)
    {
        $schema = 'WECHATPAY2-SHA256-RSA2048';
        $token = sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
            $merchant_id, $nonce, $timestamp, $serial_no, $sign);
        return $token;
    }
    /**
     * 产生随机字符串，不长于32位
     * @param int $length
     * @return string
     */
    public function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public function curl_post($url, $postdata,$authorization,$Wechatpay_Serial)
    {

        $header = [
            'Content-Type: application/json',
            'Wechatpay-Serial: '.$Wechatpay_Serial,
            'Accept: application/json',
            'Content-Length: ' . strlen($postdata),
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
            'Authorization: '."WECHATPAY2-SHA256-RSA2048 ".$authorization
        ];

        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 超时设置
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        // 超时设置，以毫秒为单位
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, 5000);

        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

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
            return $data;
            curl_close($curl);
        }
    }

    public function getEncrypt($str,$Wechatpay_Serial) {
        //$str是待加密字符串

        /*$public_key = $this->url_safe_decode($public_key);*/

        $public_key = openssl_pkey_get_public($Wechatpay_Serial);

        $encrypted = '';


        if (openssl_public_encrypt($str, $encrypted, $public_key, OPENSSL_PKCS1_OAEP_PADDING)) {
            //base64编码

            $sign = base64_encode($encrypted);

        } else {
            throw new Exception('encrypt failed');
        }
        return $sign;
    }




    public function curl_get($url,$authorization)
    {

        $header = [
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
            'Authorization: '."WECHATPAY2-SHA256-RSA2048 ".$authorization
        ];
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
            return $data;
            curl_close($curl);
        }
    }

    public function wx_ciphertext($wxMerchantId,$wxMerchantApiPrivateKey,$wxApiSerialNo){

        $url='https://api.mch.weixin.qq.com/v3/certificates';

        $certificates = $this->RequestSign('GET',$url,'',$wxMerchantId, $wxMerchantApiPrivateKey, $wxApiSerialNo);

        $data =  $this ->curl_get($url,$certificates);
        $certificates = json_decode($data,true);
        // foreach ($certificates['data'] as $key => $value) {
        //     if($value['serial_no']==$this->serial_no){
        //         $associatedData=$value['encrypt_certificate']['associated_data'];
        //         $nonceStr=$value['encrypt_certificate']['nonce'];
        //         $ciphertext=$value['encrypt_certificate']['ciphertext'];
        //         break;
        //     }
        // }
        
        $data = $certificates['data'][0]['encrypt_certificate'];
        $list['serial_no'] = $certificates['data'][0]['serial_no'];




   /*     $str = "-----BEGIN PUBLIC KEY-----\n" .$data['encrypt_certificate']['ciphertext'] . "\n-----END PUBLIC KEY-----";
        file_put_contents('./pingtai.pem',$str);*/
      /*  return $data;*/
        $associatedData=$data['associated_data'];

        $nonceStr=$data['nonce'];
        $ciphertext=$data['ciphertext'];



       $dl = $this->decryptToString($associatedData, $nonceStr, $ciphertext);  //获取平台证书。复制到文本里改为pem后缀
        $list['dl'] = $dl;

        return $list;
    }
    public function decryptToString($associatedData, $nonceStr, $ciphertext)
    {
        $ciphertext = \base64_decode($ciphertext);


        if (strlen($ciphertext) <= self::AUTH_TAG_LENGTH_BYTE) {

            return false;
        }

        // ext-sodium (default installed on >= PHP 7.2)
        if (function_exists('\sodium_crypto_aead_aes256gcm_is_available') && \sodium_crypto_aead_aes256gcm_is_available()) {
            return \sodium_crypto_aead_aes256gcm_decrypt($ciphertext, $associatedData, $nonceStr, $this->aesKey);
        }

        // ext-libsodium (need install libsodium-php 1.x via pecl)
        if (function_exists('\Sodium\crypto_aead_aes256gcm_is_available') && \Sodium\crypto_aead_aes256gcm_is_available()) {
            return \Sodium\crypto_aead_aes256gcm_decrypt($ciphertext, $associatedData, $nonceStr, $this->aesKey);
        }

        // openssl (PHP >= 7.1 support AEAD)
        if (PHP_VERSION_ID >= 70100 && in_array('aes-256-gcm', \openssl_get_cipher_methods())) {
            $ctext = substr($ciphertext, 0, -self::AUTH_TAG_LENGTH_BYTE);
            $authTag = substr($ciphertext, -self::AUTH_TAG_LENGTH_BYTE);

            return \openssl_decrypt($ctext, 'aes-256-gcm', $this->aesKey, \OPENSSL_RAW_DATA, $nonceStr,$authTag, $associatedData);

        }

        throw new \RuntimeException('AEAD_AES_256_GCM需要PHP 7.1以上或者安装libsodium-php');
    }
}