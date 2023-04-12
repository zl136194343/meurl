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

namespace app\model\web;


use think\facade\Cache;
use app\model\BaseModel;
/**
 * 帮助中心管理
 * @author Administrator
 *
 */
class Wuliao extends BaseModel
{
        public function getCategoryTree($condition = [], $field = 'id,group_name,pid,level,sort', $order = 'sort asc', $limit = null)
    {
        {
            //获取对应的分类
            $data = json_encode([$condition, $field, $order, $limit]);
            $cache = Cache::get("wuliao_getCategoryTree_" . $data);
            if (!empty($cache)) {
                return $this->success($cache);
            }

            $list = model('wuliao_group')->getList($condition, $field, $order, '', '', '', $limit);

            $goods_category_list = [];

            //遍历一级商品分类
            foreach ($list as $k => $v) {
                if ($v['level'] == 1) {
                    $goods_category_list[] = $v;
                    unset($list[$k]);
                }
            }
            $list = array_values($list);

            array_multisort(array_column($goods_category_list, 'sort'), SORT_ASC, $goods_category_list);
            //遍历二级商品分类
            foreach ($list as $k => $v) {
                foreach ($goods_category_list as $ck => $cv) {
                    if ($v['level'] == 2 && $cv['id'] == $v['pid']) {
                        $goods_category_list[$ck]['child_list'][] = $v;
                        unset($list[$k]);
                    }
                }
            }
            $list = array_values($list);

            //遍历三级商品分类
            foreach ($list as $k => $v) {
                foreach ($goods_category_list as $ck => $cv) {

                    if (!empty($cv['child_list'])) {
                        foreach ($cv['child_list'] as $third_k => $third_v) {

                            if ($v['level'] == 3 && $third_v['id'] == $v['pid']) {
                                $goods_category_list[$ck]['child_list'][$third_k]['child_list'][] = $v;
                                unset($list[$k]);
                            }
                        }
                    }
                }
            }

            //整体排序
            foreach ($goods_category_list as $goods_category_k => $goods_category_v) {
                $item_child_list = $goods_category_v['child_list'] ?? [];
                if (!empty($item_child_list)) {
                    array_multisort(array_column($item_child_list, 'sort'), SORT_ASC, $item_child_list);
                    //第三级
                    foreach ($item_child_list as $k => $v) {
                        $item_temp_child_list = $v['child_list'] ?? [];
                        if (!empty($item_temp_child_list)) {
                            array_multisort(array_column($item_temp_child_list, 'sort'), SORT_ASC, $item_temp_child_list);
                            $item_child_list[$k]['child_list'] = $item_temp_child_list;
                        }
                    }
                    $goods_category_list[$goods_category_k]['child_list'] = $item_child_list;
                }

            }
            Cache::tag("wuliao_category")->set("wuliao_category_getCategoryTree_" . $data, $goods_category_list);

            return $this->success($goods_category_list);
        }
    }
    
        public function getCategoryInfo($condition, $field = '*')
    {
        $check_condition = array_column($condition, 2, 0);
        
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        /*if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }*/

        $data = json_encode([ $condition, $field ]);
        $cache = Cache::get("wuliao_category_getCategoryInfo_" . $site_id . "_" . $data);
        
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('wuliao_group')->getInfo($condition, $field);
        
        Cache::tag("wuliao_category_" . $site_id)->set("wuliao_category_getCategoryInfo_" . $site_id . "_" . $data, $res);
        return $this->success($res);
    }
    
    public function getCategoryList($condition = [], $field = 'id,group_name,pid,level', $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
       /* if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }*/

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("wuliao_category_getCategoryList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('wuliao_group')->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($list as &$v){
            $v['child_count'] = model('wuliao_group')->getCount([['pid','=',$v['id']]]);
        }

        Cache::tag("wuliao_category_" . $site_id)->set("wuliao_category_getCategoryList_" . $site_id . "_" . $data, $list);

        return $this->success($list);
    }
}
