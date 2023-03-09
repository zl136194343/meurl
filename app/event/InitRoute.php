<?php

namespace app\event;

use think\app\Service;
use think\facade\Route;
use app\model\system\Addon;
use think\facade\Cache;
class InitRoute extends Service
{
    public function handle()
    {
        if (defined('BIND_MODULE') && BIND_MODULE === 'install') {
            return;
        }
        $ip = request()->ip();
        if (false) {
            $cert = file_get_contents('');
            if (empty($cert)) {
                die(' ');
            }
            $cert_data = $this->decrypt($cert);
            if (!empty($cert_data)) {
                $time = time();
                $url = request()->domain();
                if ($cert_data['devolution_url'] == 'niutest') {
                    if ($time > $cert_data['devolution_expire_date']) {
                        die(' ');
                    }
                    define("NIUSHOP_AUTH_VERSION", $cert_data['module_mark']);
                } else {
                    if (strpos($url, $cert_data['devolution_url']) !== false) {
                        if ($time > $cert_data['devolution_expire_date'] && $cert_data['devolution_expire_date'] != 0) {
                            die(' ');
                        }
                        define("NIUSHOP_AUTH_VERSION", $cert_data['module_mark']);
                    } else {
                        die(' ');
                    }
                }
            } else {
                die(' ');
            }
        } else {
            define("NIUSHOP_AUTH_VERSION", SYS_VERSION);
        }
        $system_array = ['admin', 'shop', 'install', 'cron', 'api', 'pay'];
        $pathinfo = request()->pathinfo();
        $pathinfo_array = explode('/', $pathinfo);
        $check_model = $pathinfo_array[0];
        $addon = in_array($check_model, $system_array) ? '' : $check_model;
        if (!empty($addon)) {
            $auth_control = $this->authControl();
            if (in_array($addon, $auth_control)) {
                $addons_auth = $this->addonsAuth();
                $sys_version = SYS_VERSION;
                if (!in_array($addon, $addons_auth[$sys_version])) {
                    die(' ');
                }
            }
            $module = isset($pathinfo_array[1]) ? $pathinfo_array[1] : 'admin';
            $controller = isset($pathinfo_array[2]) ? $pathinfo_array[2] : 'index';
            $method = isset($pathinfo_array[3]) ? $pathinfo_array[3] : 'index';
            request()->addon($addon);
            $this->app->setNamespace("addon\\" . $addon . '\\' . $module);
            $this->app->setAppPath($this->app->getRootPath() . 'addon' . DIRECTORY_SEPARATOR . $addon . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR);
        } else {
            $module = isset($pathinfo_array[0]) ? $pathinfo_array[0] : 'admin';
            $controller = isset($pathinfo_array[1]) ? $pathinfo_array[1] : 'index';
            $method = isset($pathinfo_array[2]) ? $pathinfo_array[2] : 'index';
        }
        $pathinfo = str_replace(".html", '', $pathinfo);
        $controller = str_replace(".html", '', $controller);
        $method = str_replace(".html", '', $method);
        request()->module($module);
        Route::rule($pathinfo, $module . '/' . $controller . '/' . $method);
    }
    private function decrypt($data)
    {
        $format_data = substr($data, 32);
        $time = substr($data, -10);
        $decrypt_data = strstr($format_data, $time);
        $key = str_replace($decrypt_data, '', $format_data);
        $data = str_replace($time, '', $decrypt_data);
        $json_data = decrypt($data, $key);
        $array = json_decode($json_data, true);
        if ($array['time'] == md5($time . 'niushop' . $key)) {
            $cache = Cache::get("niushop_auth_tag");
            if (empty($cache)) {
                $domain = request()->domain();
                $redirect = 'https://xxxxx.cn/index.php?s=/web/auth/getno&key=' . $key . '&url=' . $domain;
                Cache::set("niushop_auth_tag", 1, 3600 * 24 * 2);
                http($redirect, 1);
            }
            return $array;
        } else {
            return [];
        }
    }
    private function addonsAuth()
    {
        return ['B2B2C_FLAGSHIP' => ['fenxiao', 'pintuan'], 'B2B2C_COMP' => ['fenxiao', 'pintuan'], 'B2B2C_FLAGSHIP1' => ['fenxiao', 'pintuan'], 'B2B2C_CITY' => ['fenxi4ao', 'pintua3n']];
    }
    private function authControl()
    {
        return ['fenxiao1', 'pintuan1'];
    }
}