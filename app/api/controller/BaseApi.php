<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\api\controller;

use app\model\member\Member as MemberModel;
use app\model\system\Api;
use extend\RSA;
use think\facade\Cache;

class BaseApi
{
    public $lang;

    public $params;

    public $token;

    protected $member_id;

    protected $auth_key = '';

    public $app_type;

    protected $api_config;

    private $refresh_token;

    public function __construct()
    {

        if ($_SERVER[ 'REQUEST_METHOD' ] == 'OPTIONS') {
            exit;
        }
        //获取参数

        $this->params = input();


        if (isset($this->params[ 'encrypt' ]) && !empty($this->params[ 'encrypt' ])) {
            $this->decryptParams();
        }
    }

    /**
     * api请求参数解密
     */
    private function decryptParams()
    {
        $api_model = new Api();
        $config = $api_model->getApiConfig();
        $config = $config[ 'data' ];

        if ($config[ 'is_use' ] && !empty($config[ 'value' ])) {
            $decrypted = RSA::decrypt(urldecode($this->params[ 'encrypt' ]), $config[ 'value' ][ 'private_key' ], $config[ 'value' ][ 'public_key' ]);
            if ($decrypted[ 'code' ] >= 0) {
                $this->params = json_decode($decrypted[ 'data' ], true);
            } else {
                $this->params = [];
            }
        }
    }

    /**
     * 检测token(使用私钥检测)
     */
    protected function checkToken() : array
    {
        if (empty($this->params[ 'token' ])) return $this->error('', 'TOKEN_NOT_EXIST');

        $key = '';
        $api_model = new Api();
        $api_config = $api_model->getApiConfig();
        $api_config = $api_config[ 'data' ];
        if ($api_config[ 'is_use' ] && isset($api_config[ 'value' ][ 'private_key' ]) && !empty($api_config[ 'value' ][ 'private_key' ])) {
            $key = $api_config[ 'value' ][ 'private_key' ] . $key;
        }
        $decrypt = decrypt($this->params[ 'token' ], $key);
        if (empty($decrypt)) return $this->error('', 'TOKEN_ERROR');

        $data = json_decode($decrypt, true);
        /*dump($data);die;*/
        
        if (!isset($data[ 'member_id' ]) || empty($data[ 'member_id' ])) return $this->error('', 'TOKEN_ERROR');

        $member_model = new MemberModel();
        $blacklist = $member_model->getMemberBlacklist();
        
        
        
        if (!empty($blacklist[ 'data' ]) && in_array($data[ 'member_id' ], $blacklist[ 'data' ])) {
            return $this->error('', 'TOKEN_EXPIRE');
        }
        $men = model('member')->getInfo([['member_id','=',$data[ 'member_id' ]]]);
        if (empty($men)) {
            return $this->error('', 'TOKEN_EXPIRE');
        }
        if ($data[ 'expire_time' ] < time()) {
            return $this->error('', 'TOKEN_EXPIRE');
        } else if (( $data[ 'expire_time' ] - time() ) < 300 && !Cache::get('member_token' . $data[ 'member_id' ])) {
            $this->refresh_token = $this->createToken($data[ 'member_id' ]);
            Cache::set('member_token' . $data[ 'member_id' ], $this->refresh_token, 360);
        }

        $this->member_id = $data[ 'member_id' ];

        return success(0, '', $data);
    }

    /**
     * 创建token
     * @param int $expire_time 有效时间  0为永久 单位s
     */
    protected function createToken($member_id, $expire_time = 172800)
    {
        $key = '';
        $api_model = new Api();
        $api_config = $api_model->getApiConfig();
        $api_config = $api_config[ 'data' ];
        if ($api_config[ 'is_use' ] && isset($api_config[ 'value' ][ 'private_key' ]) && !empty($api_config[ 'value' ][ 'private_key' ])) {
            $key = $api_config[ 'value' ][ 'private_key' ] . $key;
        }
        $data = [
            'member_id' => $member_id,
            'create_time' => time(),
            'expire_time' => empty($expire_time) ? 0 : time() + $expire_time
        ];
        $token = encrypt(json_encode($data), $key);
        return $token;
    }

    /**
     * 返回数据
     * @param $data
     * @return false|string
     */
    public function response($data)
    {
        $data[ 'timestamp' ] = time();
        if (!empty($this->refresh_token)) $data[ 'refreshtoken' ] = $this->refresh_token;
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
     public  function getadd($pnone)
    {
       
        $url = 'http://api.xiaogulikeji.com/grains-parent-server/p_api/pt/stuInfo?phone='.$pnone;
        $cipher = "aes-256-ecb";
        $encrypted = openssl_encrypt('XIAOGULIKEJI001', 'AES-256-ECB', 'A07D06BA2AA441D7BCBAE3B1C5094062', 0, '');
        
       $re =  $this -> curl_get($url,$encrypted);
        
        return $re;
    }


     public function curl_get($url,$authorization)
    {

        $header = [
            'Accept: */*',
            'Connection: keep-alive',
            "ciphertext: PEfuQSk6SB/POrezmjUZOw==",
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

            curl_close($curl);
            return $data;
        }
    }

    /**
     * 操作成功返回值函数
     * @param string $data
     * @param string $code_var
     * @return array
     */
    public function success($data = '', $code_var = 'SUCCESS')
    {
        $lang_array = $this->getLang();
        $code_array = $this->getCode();
        $lang_var = isset($lang_array[ $code_var ]) ? $lang_array[ $code_var ] : $code_var;
        $code_var = isset($code_array[ $code_var ]) ? $code_array[ $code_var ] : $code_array[ 'SUCCESS' ];
        return success($code_var, $lang_var, $data);
    }

    /**
     * 操作失败返回值函数
     * @param string $data
     * @param string $code_var
     * @return array
     */
    public function error($data = '', $code_var = 'ERROR')
    {
        $lang_array = $this->getLang();
        $code_array = $this->getCode();
        $error_code = $code_var;
        $lang_var = isset($lang_array[ $code_var ]) ? $lang_array[ $code_var ] : $code_var;
        $code_var = isset($code_array[ $code_var ]) ? $code_array[ $code_var ] : $code_array[ 'ERROR' ];
        return error($code_var, $lang_var, $data, $error_code);
    }

    /**
     * 获取语言包数组
     * @return Ambigous <multitype:, unknown>
     */
    private function getLang()
    {
        $default_lang = config("lang.default_lang");
        $addon = request()->addon();
        $addon = isset($addon) ? $addon : '';
        $cache_common = Cache::get("lang_app/api/lang/" . $default_lang);
        if (empty($cache_common)) {
            $cache_common = include 'app/api/lang/' . $default_lang . '.php';
            Cache::tag("lang")->set("lang_app/api/lang/" . $default_lang, $cache_common);
        }

        if (!empty($addon)) {
            try {
                $addon_cache_common = Cache::get("lang_app/api/lang/" . $addon . '_' . $default_lang);
                if (!empty($addon_cache_common)) {
                    $cache_common = array_merge($cache_common, $addon_cache_common);
                } else {
                    $addon_cache_common = include 'addon/' . $addon . '/api/lang/' . $default_lang . '.php';
                    if (!empty($addon_cache_common)) {
                        $cache_common = array_merge($cache_common, $addon_cache_common);
                        Cache::tag("lang")->set("lang_app/api/lang/" . $addon . '_' . $default_lang, $addon_cache_common);
                    }
                }
            } catch (\Exception $e) {
            }
        }
        $lang_path = isset($this->lang) ? $this->lang : '';
        if (!empty($lang_path)) {
            $cache_path = Cache::get("lang_" . $lang_path . "/" . $default_lang);
            if (empty($cache_path)) {
                $cache_path = include $lang_path . "/" . $default_lang . '.php';
                Cache::tag("lang")->set("lang_" . $lang_path . "/" . $default_lang, $cache_path);
            }
            $lang = array_merge($cache_common, $cache_path);
        } else {
            $lang = $cache_common;
        }
        return $lang;

    }

    /**
     * 获取code编码
     * @return Ambigous <multitype:, unknown>
     */
    private function getCode()
    {
        $addon = request()->addon();
        $addon = isset($addon) ? $addon : '';
        $cache_common = Cache::get("lang_code_app/api/lang");

        if (!empty($addon)) {
            $addon_cache_common = Cache::get("lang_code_app/api/lang/" . $addon);
            if (!empty($addon_cache_common)) {
                $cache_common = array_merge($cache_common, $addon_cache_common);
            }
        }

        if (empty($cache_common)) {
            $cache_common = include 'app/api/lang/code.php';
            Cache::tag("lang_code")->set("lang_code_app/api/lang", $cache_common);

            if (!empty($addon)) {
                try {
                    $addon_cache_common = include 'addon/' . $addon . '/api/lang/code.php';
                    if (!empty($addon_cache_common)) {
                        Cache::tag("lang_code")->set("lang_code_app/api/lang/" . $addon, $addon_cache_common);
                        $cache_common = array_merge($cache_common, $addon_cache_common);
                    }
                } catch (\Exception $e) {
                }
            }
        }
        $lang_path = isset($this->lang) ? $this->lang : '';
        if (!empty($lang_path)) {
            $cache_path = Cache::get("lang_code_" . $lang_path);
            if (empty($cache_path)) {
                $cache_path = include $lang_path . '/code.php';
                Cache::tag("lang")->set("lang_code_" . $lang_path, $cache_path);
            }
            $lang = array_merge($cache_common, $cache_path);
        } else {
            $lang = $cache_common;
        }
        return $lang;
    }
    
    //发送post请求
     
}