<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\api\controller;

use app\Controller;
use app\model\shop\ShopSettlement;
use think\facade\Db;
use Carbon\Carbon;

class Index extends Controller
{

    public function index()
    {
        $params = input();
        if (!isset($params[ 'method' ])) {
            echo json_encode(error('', 'PARAMETER_ERROR'));
            exit();
        }

        $method_array = explode('.', $params[ 'method' ]);
        if ($method_array[ 0 ] == 'System') {
            $class_name = 'app\\api\\controller\\' . $method_array[ 1 ];
            if (!class_exists($class_name)) {
                echo json_encode(error('', 'PARAMETER_ERROR'));
                exit();
            }
            $api_model = new $class_name($params);
        } else {

            $class_name = "addon\\{$method_array[0]}\\api\\controller\\" . $method_array[ 1 ];
            if (!class_exists($class_name)) {
                echo json_encode(error('', 'PARAMETER_ERROR'));
                exit();
            }
            $api_model = new $class_name($params);
        }
        $function = $method_array[ 2 ];
        $data = $api_model->$function($params);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function cron()
    {
        $result = Db::table("gxfc_cron")->select()->toArray();

        foreach ($result as $k=>$v){
            $result[$k]['execute_time'] = date("Y-m-d H:i:s",$v['execute_time']);
            $result[$k]['create_time'] = date("Y-m-d H:i:s",$v['create_time']);
        }
        return json_encode([
            'code' => 0,
            'data' => $result
        ]);
    }


    public function withdraw()
    {
        $model = new ShopSettlement();
        $time = Carbon::today()->timestamp;

        $res = $model->shopSettlement($time);

        return json_encode($res);
    }


}