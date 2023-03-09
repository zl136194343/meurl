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

namespace addon\community\model\system;

use extend\api\HttpClient;
use think\facade\Cache;
use app\model\BaseModel;

/**
 * 地区表
 */
class Address extends BaseModel
{
    /**
     * 获取地区列表
     * @param unknown $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return multitype:string mixed
     */
    public function getAreaList($condition = [], $field = '*', $order = '', $limit = null)
    {

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("area_getAreaList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $area_list = model("area")->getList($condition, $field, $order, $limit);
        Cache::tag("area")->set("area_getAreaList_" . $data, $area_list);
        return $this->success($area_list);
    }

    /**
     * 获取地区详情
     */
    public function getAreaInfo($circle)
    {

        $cache = Cache::get("area_getAreaInfo_" . $circle);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model("area")->getInfo([ [ 'id', '=', $circle ] ]);
        Cache::tag("area")->set("area_getAreaInfo_" . $circle, $info);
        return $this->success($info);

    }

    /**
     * 获取省市子项
     */
    public function getAreas($circle = 0)
    {

        $cache = Cache::get("area_getAreas_" . $circle);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model("area")->getList([ [ 'pid', '=', $circle ] ]);
        Cache::tag("area")->set("area_getAreas_" . $circle, $list);
        return $this->success($list);
    }

    /**
     * 获取整理后的地址
     */
    public function getAddressTree($level = 4)
    {
        $condition = [ [ 'level', '<=', $level ] ];
        $json_condition = json_encode($condition);
        $cache = Cache::get("area_getAddressTree" . $json_condition);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $area_list = $this->getAreaList($condition, "id, pid, name, level", "id asc")[ 'data' ];
        //组装数据
        $refer_list = [];
        foreach ($area_list as $key => $val) {
            $refer_list[ $val[ 'level' ] ][ $val[ 'pid' ] ][ 'child_list' ][ $val[ 'id' ] ] = $area_list[ $key ];
            if (isset($refer_list[ $val[ 'level' ] ][ $val[ 'pid' ] ][ 'child_num' ])) {
                $refer_list[ $val[ 'level' ] ][ $val[ 'pid' ] ][ 'child_num' ] += 1;
            } else {
                $refer_list[ $val[ 'level' ] ][ $val[ 'pid' ] ][ 'child_num' ] = 1;
            }
        }
        Cache::tag("area")->set("area_getAddressTree" . $json_condition, $refer_list);
        return $this->success($refer_list);
    }

    /**
     * 获取地址
     * @param array $condition
     * @param string $field
     * @return multitype:number unknown
     */
    public function getAreasInfo(array $condition, string $field = '*')
    {
        $info = model("area")->getInfo($condition, $field);
        if ($info) return $this->success($info);
        return $this->error();
    }

    /**
     * 通过坐标查询地址(逆地址解析（坐标位置描述）)
     */
    public function getAddressByLatlng($post_data)
    {
        $post_url = 'https://apis.map.qq.com/ws/geocoder/v1/';
        $config_model = new \app\model\web\Config();
        $config_result = $config_model->getMapConfig()[ 'data' ] ?? [];
        $config = $config_result[ 'value' ] ?? [];
        $tencent_map_key = $config[ 'tencent_map_key' ] ?? '';
        $post_data = array (
            'location' => $post_data[ 'latlng' ],
            'key' => $tencent_map_key,
            'get_poi' => 0,//是否返回周边POI列表：1.返回；0不返回(默认)
        );
        $httpClient = new HttpClient();
        $res = $httpClient->post($post_url, $post_data);
        $res = json_decode($res, true);
        if ($res[ 'status' ] == 0) {
            $return_array = $res[ 'result' ][ 'address_component' ] ?? [];
            $return_data = array (
                'province' => $return_array[ 'province' ] ?? '',
                'city' => $return_array[ 'city' ] ?? '',
                'district' => $return_array[ 'district' ] ?? '',
                'address' => $return_array[ 'street_number' ] ?? ''
            );
            return $this->success($return_data);
        } else {
            return $this->error([], $res[ 'message' ]);
        }
    }

    /**
     * 通过地址查询坐标
     */
    public function getLatlngByAddress($post_data)
    {
        $post_url = 'https://apis.map.qq.com/ws/geocoder/v1/';
        $config_model = new \app\model\web\Config();
        $config_result = $config_model->getMapConfig()[ 'data' ] ?? [];
        $config = $config_result[ 'value' ] ?? [];
        $tencent_map_key = $config[ 'tencent_map_key' ] ?? '';

        $post_data = array (
            'address' => $post_data['address'],
            'key' => $tencent_map_key,
        );
        $httpClient = new HttpClient();
        $res = $httpClient->post($post_url, $post_data);
        $res = json_decode($res, true);
        if ($res[ 'status' ] == 0) {
            $return_array = $res[ 'result' ][ 'location' ] ?? [];
            $return_data = array (
                'longitude' => $return_array[ 'lng' ] ?? '',
                'latitude' => $return_array[ 'lat' ] ?? '',
            );
            return $this->success($return_data);
        } else {
            return $this->error([], $res[ 'message' ]);
        }
    }
    
     public function getAddTree($level)
    {

        $condition = [ [ 'level', '<=', $level ] ];
        $json_condition = json_encode($condition);
        /*$cache = Cache::get("goods_category_getCategoryTree__" . $json_condition);
        if (!empty($cache)) {
            return $this->success($cache);
        }*/
        
        $area_list = $this->getAreaList($condition, "id, pid, name, level", "id asc")[ 'data' ];
         
        $refer_list = [];
      
        //遍历一级商品分类
        foreach ($area_list as $k => $v) {
            if ($v[ 'level' ] == 1) {
                $v[ 'level' ] = 'province';
                $v['parent_id'] = $v['pid'];
                $refer_list[] = $v;
                unset($area_list[ $k ]);
            }
        }
        
        $area_list = array_values($area_list);

        //遍历二级商品分类
        foreach ($area_list as $k => $v) {
            
            foreach ($refer_list as $ck => $cv) {
               
                if ($v[ 'level' ] == 2 && $cv[ 'id' ] == $v[ 'pid' ]) {
                    $v['level'] = 'city';
                     $v['parent_id'] = $v['pid'];
                    $refer_list[ $ck ][ 'list' ][] = $v;
                    unset($area_list[ $k ]);
                }
            }
        }
       
        $list = array_values($area_list);
 
        //遍历三级商品分类
        foreach ($area_list as $k => $v) {
         
            foreach ($refer_list as $ck => $cv) {
 
                if (!empty($cv[ 'list' ])) {
                    foreach ($cv[ 'list' ] as $third_k => $third_v) {

                        if ($v[ 'level' ] == 3 && $third_v[ 'id' ] == $v[ 'pid' ]) {
                           $v['level'] = 'district';
                            $v['parent_id'] = $v['pid'];
                            $refer_list[ $ck ][ 'list' ][ $third_k ][ 'list' ][] = $v;
                            unset($area_list[ $k ]);
                        }
                    }
                }
            }
        }
       
        Cache::tag("goods_category_" )->set("goods_category_getCategoryTree_"  . "_" . $json_condition, $refer_list);
        
        return $this->success(['list'=>$refer_list]);
    }

}
