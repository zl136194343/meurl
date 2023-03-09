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
class Dtgl extends BaseModel
{

    /**
     * 添加商品分类
     * @param $data
     * @return \multitype
     */
    public function addCategory($data)
    {
        $category_id = model('dtgl_fenlei')->add($data);
        /*model('dtgl_fenlei')->update([ 'category_id_' . $data[ 'level' ] => $category_id ], [ [ 'category_id', '=', $category_id ] ]);*/
        Cache::tag("dtgl_fenlei")->clear();
        return $this->success($category_id);
    }

    /**
     * 修改商品分类
     * @param $data
     * @return \multitype
     */
    public function editCategory($data)
    {
        model('dtgl_fenlei')->startTrans();
        try {

            //获取该分类信息
            $info = model('dtgl_fenlei')->getInfo([ [ 'id', '=', $data[ 'id' ] ] ]);
//            if ($data[ 'is_show' ] == 0) {
//
//                switch ( $info[ 'level' ] ) {
//                    case 1:
//                        model('dtgl_fenlei')->update([ 'is_show' => 0 ], [ [ 'category_id_1', '=', $info[ 'category_id_1' ] ] ]);
//                        break;
//
//                    case 2:
//                        model('dtgl_fenlei')->update([ 'is_show' => 0 ], [ [ 'category_id_2', '=', $info[ 'category_id_2' ] ] ]);
//                        break;
//                }
//            } else {
//                switch ( $info[ 'level' ] ) {
//                    case 2:
//                        model('dtgl_fenlei')->update([ 'is_show' => 1 ], [ [ 'category_id', '=', $info[ 'category_id_1' ] ] ]);
//                        break;
//                    case 3:
//                        model('dtgl_fenlei')->update([ 'is_show' => 1 ], [ [ 'category_id', 'in', [ $info[ 'category_id_1' ], $info[ 'category_id_2' ] ] ] ]);
//                        break;
//                }
//            }


            //修改受影响的商品分佣比率

            $res = model('dtgl_fenlei')->update($data, [ [ 'id', '=', $data[ 'id' ] ] ]);
            Cache::tag("dtgl_fenlei")->clear();

            model('dtgl_fenlei')->commit();
            return $this->success($res);

        } catch (\Exception $e) {

            model('dtgl_fenlei')->rollback();
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

/*        $dtgl_fenlei_info = $this->getCategoryInfo([
            [ 'category_id', '=', $category_id ]
        ], "level");
        $dtgl_fenlei_info = $dtgl_fenlei_info[ 'data' ];
        $field = "category_id_" . $dtgl_fenlei_info[ 'level' ];*/
        $res = model('dtgl_fenlei')->delete([ [ 'id', '=', $category_id ] ]);

        Cache::tag("dtgl_fenlei")->clear();
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
//        $cache = Cache::get("dtgl_fenlei_getCategoryInfo_" . $data);
//        if (!empty($cache)) {
//            return $this->success($cache);
//        }
        $res = model('dtgl_fenlei')->getInfo($condition, $field);
//        Cache::tag("dtgl_fenlei")->set("dtgl_fenlei_getCategoryInfo_" . $data, $res);
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
        $list = model('dtgl_fenlei')->getList($condition, $field, $order, '', '', '', $limit);
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
    public function getCategoryTree($condition = [], $field = 'id,name,img,sort', $order = 'sort asc', $limit = null)
    {
        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("dtgl_fenlei_getCategoryTree_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('dtgl_fenlei')->getList($condition, $field, $order, '', '', '', $limit);

        Cache::tag("dtgl_fenlei")->set("dtgl_fenlei_getCategoryTree_" . $data, $list);

        return $this->success($list);
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
        $cache = Cache::get("dtgl_fenlei_getCategoryPageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('dtgl_fenlei')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("dtgl_fenlei")->set("dtgl_fenlei_getCategoryPageList_" . $data, $list);
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
        $cache = Cache::get("dtgl_fenlei_getCategoryByParent_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('dtgl_fenlei')->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($list as $k => $v) {
            $child_count = model('dtgl_fenlei')->getCount([ 'pid' => $v[ 'category_id' ] ]);
            $list[ $k ][ 'child_count' ] = $child_count;
        }

        Cache::tag("dtgl_fenlei")->set("dtgl_fenlei_getCategoryByParent_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 修改排序
     * @param int $sort
     * @param int $category_id
     */
    public function modifyGoodsCategorySort($sort, $category_id)
    {
        $res = model('dtgl_fenlei')->update([ 'sort' => $sort ], [ [ 'id', '=', $category_id ] ]);
        Cache::tag("dtgl_fenlei")->clear();
        return $this->success($res);
    }


    public function getDtglPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = '*', $alias = '', $join = '', $group = null)
    {
        $list = model('dtgl')->pageList($condition, $field, $order, $page, $page_size, $alias, $join, $group);
        return $this->success($list);
    }
}