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

namespace addon\weapp\api\controller;
use app\model\member\Withdraw;
use app\api\controller\BaseApi;
use addon\weapp\model\Weapp as WeappModel;

class Weapp extends BaseApi
{
	/**
	 * 获取openid
	 */
	public function authCodeToOpenid()
	{
		$weapp_model = new WeappModel();
		
		$res = $weapp_model->authCodeToOpenid($this->params);
		return $this->response($res);
	}
	public function messagetmplids()
    {
        $toke = $this->checkToken();
        $this->params['member_id'] = $toke['data']['member_id']??241;
//        $this->params['transfer_type'] = "wechatpay";
        $member_apply_model = new Withdraw();
        $res = $member_apply_model->apply($this->params);
//        Log::info($res);
       
        return $this->response($res);
    }
    
    public function messagetmplidsList()
    {
        $toke = $this->checkToken();
       /* $this->params['member_id'] = $toke['data']['member_id'];
//        $this->params['transfer_type'] = "wechatpay";
        $member_apply_model = new Withdraw();
        $res = $member_apply_model->apply($this->params);*/
        $keyword = input('keyword');
        $list = $this->lidsList();
            
        $res[] = $list[$keyword];
//        Log::info($res);
        
        return $this->response($this->success($res));
    }
    
     public function lidsList()
     {
         return $list = [
             'ORDER_ZF'=>'4WAb_sLQqiBE-EahtOrTaMJZsFJtA2Us7IWmkr4dJog',
             'MEMBER_KH'=>'i7DFGcMwmYo8eRo5Yccy1Ozi1uFjeVjqRQONC0O63U0',
             'MEMBER_TX'=>'pMBsQH3hQ_oPHcBDLdruALQ8Air6FxKzKTGJjoVm8TI',
             'MEMBER_TK'=>'_yiO2TN2cvt5CIZ9Kv6-mTxhWOJW8OuCCBGjd6wveH0',
/*             'ORDER_ZF'=>'',
             'ORDER_ZF'=>'',
             'ORDER_ZF'=>'',*/
             ];
     }
     public function lidsLists()
     {
         return $list = [
             '4WAb_sLQqiBE-EahtOrTaMJZsFJtA2Us7IWmkr4dJog'=>['character_string1'=>'','date2'=>'','amount3'=>'','thing4'=>'','number8'=>''],
             'i7DFGcMwmYo8eRo5Yccy1Ozi1uFjeVjqRQONC0O63U0'=>['thing5'=>'','phone_number6'=>'','thing7'=>'','time4'=>''],
             'pMBsQH3hQ_oPHcBDLdruALQ8Air6FxKzKTGJjoVm8TI'=>['phrase1'=>'','amount2'=>'','time3'=>'','thing4'=>''],
             '_yiO2TN2cvt5CIZ9Kv6-mTxhWOJW8OuCCBGjd6wveH0'=>['character_string1'=>'','amount2'=>'','time3'=>'','thing4'=>'','thing5'=>''],
/*             'ORDER_ZF'=>'',
             'ORDER_ZF'=>'',
             'ORDER_ZF'=>'',*/
             ];
     }
     
     
     public function getSendmsg($data)
     {
         $getToken = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx9b03987feb09ad7d&secret=d00f3cfc757492801619535535f366e7");
    	//json解析返回数据
    		
    	$getToken = json_decode($getToken);
        
    	//拿到access_token
    	$token = $getToken ->{'access_token'};

    	// 获取请求路径
    	//sprintf=php方法
    	/*$url = sprintf("https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
			"wx9b03987feb09ad7d","d00f3cfc757492801619535535f366e7","前端的code");*/
    	//发送请求拿取openid
    	//curl_get为自行封装的php中get请求
    	$wxRet['openid'] = 'oqyYV47NrCDACAogsLYyhtU2kKCw';

    	//推送消息url
    	$msgUrl = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token='.$token;
            
        //订阅消息的模板消息
       /*$msgObj = ["phrase"=>["value"=> 99.9],'phrase2'=>["value"=> '已到账']];*/
        $msgObj = $data;
	    //请求的data数据
	    $msgData = [
    		'access_token'=> $token,
    		'touser'=> $wxRet['openid'],
    		'template_id'=> 'iCCxQ_PnMaSH3-i-IJdGsUdj9rYfU6zX-VmZ1Ip3DCE',
    		'data'=> $msgObj
	    ];
	        
    	//curl_post自定封装post请求
    	$res = $this->curl_post($msgUrl,json_encode($msgData));
    	$r = json_decode($res,true);
    	if ($r['errcode'] == 0) {
    	    return $this->success();
    	}
    	return $res;
     }
     
/*$url="http://localhost/header_server.php";
$body = array("mobile"=>"13899999999", "username"=>"Nick");
$header = array("Content-Type:multipart/x-www-form-urlencoded", "token:test", "client:h5");
$result = curlPost($url, $body, 5, $header, 'json');
var_dump($result);*/


/**
 * 传入数组进行HTTP POST请求
 */
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
}