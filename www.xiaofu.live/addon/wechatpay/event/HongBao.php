<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */


namespace addon\wechatpay\event;

use addon\wechatpay\model\Pay as PayModel;

class HongBao
{
 
    private $sslPath;//API安全证书地址
    public function __construct(){
        $this->sslPath=dirname(__FILE__).DIRECTORY_SEPARATOR.'ssl'.DIRECTORY_SEPARATOR;
    }
 
    //支付
    public function pay($url,$obj){
        //创建随机字符串
        $obj['nonce_str'] = $this->createNoncestr();
        //创建签名
        $string = $this->createSign($obj,false);
        $stringSignTemp = $string."&key=$this->key";//key为商户平台设置的密钥key
        $sign = strtoupper(md5($stringSignTemp));
        $obj['sign'] = $sign;
        $postXml = $this->arrayToXml($obj);
        $responseXml = $this->curlPostSsl($url,$postXml);
        return $responseXml;
    }
 
    //发红包
    public function send(Request $request){
 
            $money=1;//金额：分
 
            $data = array();
            $data['wxappid'] = $this->appId;//公众号appid
            $data['mch_id'] = $this->mchId;//商户号
            $data['mch_billno'] = $this->mchId.date('YmdHis').rand(1000,9999);//商户订单号 28位
            $data['client_ip'] = $request->ip();//本机ip
            $data['re_openid'] ="oXzBg6teHK4GgSKMc10TYdZXz85A";//接受人
            $data['total_amount'] = $money;//收红包的用户的金额，精确到分
            $data['min_value'] = $money;//最小金额
            $data['max_value'] = $money;//最大金额
            $data['total_num'] = 1;//发送数量
            $data['nick_name'] = $this->sendName;//红包商户名称
            $data['send_name'] = $this->sendName;//红包派发者名称
            $data['wishing'] = "恭喜";//欢迎语
            $data['act_name'] = "新年红包活动";//活动名称
            $data['remark'] = "新年红包活动";//备注
            $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";//发红包api
            $res = $this->pay($url,$data);
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
            $val = json_decode(json_encode($postObj),true);
            var_dump($val);
    }
 
    //生成签名,参数：生成签名的参数和是否编码
    public function createSign($arr,$urlencode){
        $buff = "";
        ksort($arr); //对传进来的数组参数里面的内容按照字母顺序排序，a在前面，z在最后（字典序）
        foreach ($arr as $k=>$v) {
            if(null!=$v && "null" != $v && "sign" != $k){
                //签名不要转码
                if ($urlencode){
                    $v = urlencode($v);
                }
                $buff.=$k."=".$v."&";
            }
        }
        if (strlen($buff)>0) {
            $reqPar = substr($buff,0,strlen($buff)-1); //去掉末尾符号“&”
        }
        return $reqPar;
    }
 
 
    //生成随机字符串，默认32位
    public function createNoncestr($length=32){
        //创建随机字符
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for($i=0;$i<$length;$i++){
            $str.=substr($chars, mt_rand(0,strlen($chars)-1),1);
        }
        return $str;
    }
 
    //数组转xml
    public function arrayToXml($arr){
        $xml="<xml>";
        foreach($arr as $k=>$v){
            $xml.="<".$k.">".$v."</".$k.">";
        }
        $xml.="</xml>";
        return $xml;
    }
 
    //post请求网站，需要证书
    public function curlPostSsl($url, $vars, $second=30,$aHeader=array()){
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        //商户号API安全证书： cert 与 key 分别属于两个.pem文件
        //请确保您的libcurl版本是否支持双向认证，版本高于7.20.1
        curl_setopt($ch,CURLOPT_SSLCERT,$this->sslPath.'apiclient_cert.pem');
        curl_setopt($ch,CURLOPT_SSLKEY,$this->sslPath.'apiclient_key.pem');
 
        if( count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
 
    }
 
 
 
 
 
 
}