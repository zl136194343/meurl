<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace addon\weapp\model;

use app\model\BaseModel;
use EasyWeChat\Factory;
use think\facade\cache;

/**
 * 微信小程序配置
 */
class Weapp extends BaseModel
{
    private $app;//微信模型

    public function __construct()
    {
        //微信支付配置
        $config_model = new Config();
        $config_result = $config_model->getWeappConfig();
        $config = $config_result["data"];
        if (!empty($config)) {
            $config_info = $config["value"];
        }

        $config = [
            'app_id' => $config_info["appid"] ?? '',
            'secret' => $config_info["appsecret"] ?? '',

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'permission' => 0777,
                'file'       => 'runtime/log/wechat/easywechat.logs',
            ],
        ];
        $this->app = Factory::miniProgram($config);
    }

    /**
     * 根据 jsCode 获取用户 session 信息
     * @param $param
     * @return array
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function authCodeToOpenid($param)
    {
        //正常返回的JSON数据包
        //{"openid": "OPENID", "session_key": "SESSIONKEY", "unionid": "UNIONID"}
        //错误时返回JSON数据包(示例为Code无效)
        //{"errcode": 40029, "errmsg": "invalid code"}
        $result = $this->app->auth->session($param['code']);
        if (isset($result['errcode'])) {
            return $this->error('', $result['errmsg']);
        } else {
            Cache::set('weapp_' . $result['openid'], $result);
            return $this->success($result);
        }
    }

    /**
     * 生成二维码
     * @param $param
     * @return multitype|array
     */
    public function createQrcode($param)
    {
        try {
            $checkpath_result = $this->checkPath($param['qrcode_path']);
            
            if ($checkpath_result["code"] != 0) return $checkpath_result;
            
            // scene:场景值最大32个可见字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~
            $scene = '';
            
            if (!empty($param['data'])) {
                foreach ($param['data'] as $key => $value) {
                    if ($scene == '') $scene .= $key . '-' . $value;
                    else $scene .= '&' . $key . '-' . $value;
                }
            }
            /*dump($param['page']);die;*/
            $response = $this->app->app_code->getUnlimit($scene, [
                'page' => substr($param['page'], 1),
                'width' => isset($param['width']) ? $param['width'] : 120
            ]);
        /*dump($response);die;*/
            if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
                $filename = $param['qrcode_path'] . '/';
                $filename .= $response->saveAs($param['qrcode_path'], $param['qrcode_name'] . '_' . $param['app_type'] . '.png');
                return $this->success(['path' => $filename]);
            } else {
                if (isset($response['errcode']) && $response['errcode'] > 0) {
                    return $this->error('', $response['errmsg']);
                }
            }
            return $this->error();
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage());
        }
    }
    
    /**
     * 校验目录是否可写
     * @param unknown $path
     * @return multitype:number unknown |multitype:unknown
     */
    private function checkPath($path)
    {
        if (is_dir($path) || mkdir($path, intval('0755', 8), true)) {
            return $this->success();
        }
        return $this->error('', "directory {$path} creation failed");
    }
    /*************************************************************  数据统计与分析 start **************************************************************/
    /**
     * 访问日趋势
     * @param $from  格式 20170313
     * @param $to 格式 20170313
     */
    public function dailyVisitTrend($from, $to)
    {
        try {
            $result = $this->app->data_cube->dailyVisitTrend($from, $to);
            if (isset($result['errcode']) && $result['errcode'] != 0) {
                return $this->error([], $result["errmsg"]);
            }
            return $this->success($result["list"]);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * 访问周趋势
     * @param $from
     * @param $to
     * @return array|\multitype
     */
    public function weeklyVisitTrend($from, $to)
    {
        try {
            $result = $this->app->data_cube->weeklyVisitTrend($from, $to);
            if (isset($result['errcode']) && $result['errcode'] != 0) {
                return $this->error([], $result["errmsg"]);
            }
            return $this->success($result["list"]);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * 访问月趋势
     * @param $from
     * @param $to
     * @return array|\multitype
     */
    public function monthlyVisitTrend($from, $to)
    {
        try {
            $result = $this->app->data_cube->monthlyVisitTrend($from, $to);
            if (isset($result['errcode']) && $result['errcode'] != 0) {
                return $this->error([], $result["errmsg"]);
            }
            return $this->success($result["list"]);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * 访问分布
     * @param $from
     * @param $to
     */
    public function visitDistribution($from, $to)
    {
        try {
            $result = $this->app->data_cube->visitDistribution($from, $to);
            if (isset($result['errcode']) && $result['errcode'] != 0) {
                return $this->error($result, $result["errmsg"]);
            }
            return $this->success($result["list"]);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * 访问页面
     * @param $from
     * @param $to
     */
    public function visitPage($from, $to)
    {
        try {
            $result = $this->app->data_cube->visitPage($from, $to);
            if (isset($result['errcode']) && $result['errcode'] != 0) {
                return $this->error([], $result["errmsg"]);
            }
            return $this->success($result["list"]);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }
    /*************************************************************  数据统计与分析 end **************************************************************/

    /**
     * 消息解密
     * @param array $param
     * @return array
     */
    public function decryptData($param = [])
    {
        try {
            $cache = Cache::get('weapp_' . $param['weapp_openid']);
            
            $session_key = $cache['session_key'] ?? $param;

            $result = $this->app->encryptor->decryptData($session_key, $param['iv'], $param['encryptedData']);

            if (isset($result['errcode']) && $result['errcode'] != 0) {
                return $this->error([], $result["errmsg"]);
            }
           
            return $this->success($result);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }
    
    public function getSendmsg($str,$data,$member)
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
    	$open_id = model('member')->getInfo([['member_id','=',$member]],'weapp_openid');
    	$wxRet['openid'] = $open_id['weapp_openid'];
        
    	//推送消息url
    	$msgUrl = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token='.$token;
            
        //订阅消息的模板消息
       /*$msgObj = ["phrase"=>["value"=> 99.9],'phrase2'=>["value"=> '已到账']];*/
        $msgObj = $data;
	    //请求的data数据
	    $msgData = [
    		'access_token'=> $token,
    		'touser'=> $wxRet['openid'],
    		'template_id'=> $str,
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
    
}