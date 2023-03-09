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

namespace app\model\dtgl;

use think\facade\Cache;
use app\model\BaseModel;
use think\facade\Db;

/**
 * 商品分类
 */
class Company extends BaseModel
{

    /**
     * 添加商品分类
     * @param $data
     * @return \multitype
     */
    public function addCategory($data)
    {
        $category_id = model('company')->add($data);
        /*model('company')->update([ 'category_id_' . $data[ 'level' ] => $category_id ], [ [ 'category_id', '=', $category_id ] ]);*/
        Cache::tag("company")->clear();
        return $this->success($category_id);
    }

    /**
     * 修改商品分类
     * @param $data
     * @return \multitype
     */
    public function editCategory($data)
    {
        model('company')->startTrans();
        try {

            //获取该分类信息
            $info = model('company')->getInfo([ [ 'id', '=', $data[ 'id' ] ] ]);
//            if ($data[ 'is_show' ] == 0) {
//
//                switch ( $info[ 'level' ] ) {
//                    case 1:
//                        model('company')->update([ 'is_show' => 0 ], [ [ 'category_id_1', '=', $info[ 'category_id_1' ] ] ]);
//                        break;
//
//                    case 2:
//                        model('company')->update([ 'is_show' => 0 ], [ [ 'category_id_2', '=', $info[ 'category_id_2' ] ] ]);
//                        break;
//                }
//            } else {
//                switch ( $info[ 'level' ] ) {
//                    case 2:
//                        model('company')->update([ 'is_show' => 1 ], [ [ 'category_id', '=', $info[ 'category_id_1' ] ] ]);
//                        break;
//                    case 3:
//                        model('company')->update([ 'is_show' => 1 ], [ [ 'category_id', 'in', [ $info[ 'category_id_1' ], $info[ 'category_id_2' ] ] ] ]);
//                        break;
//                }
//            }


            //修改受影响的商品分佣比率

            $res = model('company')->update($data, [ [ 'id', '=', $data[ 'id' ] ] ]);
            Cache::tag("company")->clear();

            model('company')->commit();
            return $this->success($res);

        } catch (\Exception $e) {

            model('company')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 删除分类
     * @param $category_id
     * @return \multitype
     */
    public function deleteCategory($category_id)
    {

        //判断该分类下是否存在动态
        /*$goods_info = model('goods')->getInfo([ [ 'category_id', 'like', '%,' . $category_id . ',%' ] ]);
        if (!empty($goods_info)) {
            return $this->error('', '该分类下存在动态，暂不能删除');
        }*/

/*        $company_info = $this->getCategoryInfo([
            [ 'category_id', '=', $category_id ]
        ], "level");
        $company_info = $company_info[ 'data' ];
        $field = "category_id_" . $company_info[ 'level' ];*/
        $res = model('company')->delete([ [ 'id', '=', $category_id ] ]);

        Cache::tag("company")->clear();
        return $this->success($res);

    }

    /**
     * 获取商品分类信息
     * @param array $condition
     * @param string $field
     */
    public function getCategoryInfo($condition, $field = 'id,name,img,sort')
    {

//        $data = json_encode([ $condition, $field ]);
//        $cache = Cache::get("company_getCategoryInfo_" . $data);
//        if (!empty($cache)) {
//            return $this->success($cache);
//        }
        $res = model('company')->getInfo($condition, $field);
//        Cache::tag("company")->set("company_getCategoryInfo_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取商品分类列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getCategoryList($condition = [], $field = 'id,name,img,sort', $order = 'sort asc', $limit = null)
    {
        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("dtgl_category_getCategoryList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('company')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("dtgl_category")->set("dtgl_category_getCategoryList_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品分类树结构
     * @param int $level 查询等级
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getCategoryTree($condition = [], $field = 'id,is_show,name,image,sort,pid,full_address,level', $order = 'sort asc', $limit = null)
    {
        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("company_getCategoryTree_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('company')->getList($condition, $field, $order, '', '', '', $limit);

        $goods_category_list = [];

        //遍历一级商品分类
        foreach ($list as $k => $v) {
            if ($v[ 'level' ] == 1) {
                $goods_category_list[] = $v;
                unset($list[ $k ]);
            }
        }
        $list = array_values($list);

        array_multisort(array_column($goods_category_list, 'sort'), SORT_ASC, $goods_category_list);
        //遍历二级商品分类
        foreach ($list as $k => $v) {
            foreach ($goods_category_list as $ck => $cv) {
                if ($v[ 'level' ] == 2 && $cv[ 'id' ] == $v[ 'pid' ]) {
                    $goods_category_list[ $ck ][ 'child_list' ][] = $v;
                    unset($list[ $k ]);
                }
            }
        }
        $list = array_values($list);

        //遍历三级商品分类
        foreach ($list as $k => $v) {
            foreach ($goods_category_list as $ck => $cv) {

                if (!empty($cv[ 'child_list' ])) {
                    foreach ($cv[ 'child_list' ] as $third_k => $third_v) {

                        if ($v[ 'level' ] == 3 && $third_v[ 'id' ] == $v[ 'pid' ]) {
                            $goods_category_list[ $ck ][ 'child_list' ][ $third_k ][ 'child_list' ][] = $v;
                            unset($list[ $k ]);
                        }
                    }
                }
            }
        }

        //整体排序
        foreach ($goods_category_list as $goods_category_k => $goods_category_v) {
            $item_child_list = $goods_category_v[ 'child_list' ] ?? [];
            if (!empty($item_child_list)) {
                array_multisort(array_column($item_child_list, 'sort'), SORT_ASC, $item_child_list);
                //第三级
                foreach ($item_child_list as $k => $v) {
                    $item_temp_child_list = $v[ 'child_list' ] ?? [];
                    if (!empty($item_temp_child_list)) {
                        array_multisort(array_column($item_temp_child_list, 'sort'), SORT_ASC, $item_temp_child_list);
                        $item_child_list[ $k ][ 'child_list' ] = $item_temp_child_list;
                    }
                }
                $goods_category_list[ $goods_category_k ][ 'child_list' ] = $item_child_list;
            }

        }
        Cache::tag("goods_category")->set("goods_category_getCategoryTree_" . $data, $goods_category_list);

        return $this->success($goods_category_list);
    }

    /**
     * 获取商品分类分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getCategoryPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc', $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,category_id_1,category_id_2,category_id_3,category_full_name,commission_rate')
    {
        $data = json_encode([ $condition, $field, $order, $page, $page_size ]);
        $cache = Cache::get("company_getCategoryPageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('company')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("company")->set("company_getCategoryPageList_" . $data, $list);
        return $this->success($list);
    }

    /**
     * 获取商品分类列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getCategoryByParent($condition = [], $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,attr_class_id,attr_class_name,category_id_1,category_id_2,category_id_3,commission_rate', $order = 'sort asc', $limit = null)
    {
        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("company_getCategoryByParent_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('company')->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($list as $k => $v) {
            $child_count = model('company')->getCount([ 'pid' => $v[ 'category_id' ] ]);
            $list[ $k ][ 'child_count' ] = $child_count;
        }

        Cache::tag("company")->set("company_getCategoryByParent_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 修改排序
     * @param int $sort
     * @param int $category_id
     */
    public function modifyGoodsCategorySort($sort, $category_id)
    {
        $res = model('company')->update([ 'sort' => $sort ], [ [ 'id', '=', $category_id ] ]);
        Cache::tag("company")->clear();
        return $this->success($res);
    }


    public function getDtglPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = '*', $alias = '', $join = '', $group = null)
    {
        $list = model('dtgl')->pageList($condition, $field, $order, $page, $page_size, $alias, $join, $group);
        return $this->success($list);
    }
}