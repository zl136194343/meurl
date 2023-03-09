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

namespace addon\store\store\controller;

use addon\store\model\StoreGoods as StoreGoodsModel;
use addon\store\model\StoreGoodsSku as StoreGoodsSkuModel;
use app\model\goods\Goods as GoodsModel;
use app\model\goods\GoodsCategory as GoodsCategoryModel;
use app\model\goods\GoodsShopCategory as GoodsShopCategoryModel;

/**
 * 实物商品
 * Class Goods
 * @package app\shop\controller
 */
class Goods extends BaseStore
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     * 商品列表
     * @return mixed
     */
    public function index()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', "");
            $start_sale = input('start_sale', 0);
            $end_sale = input('end_sale', 0);
            $goods_shop_category_ids = input('goods_shop_category_ids', '');
            $goods_class = input('goods_class', "");
            $condition = [
                [ 'is_delete', '=', 0 ],
                [ 'site_id', '=', $this->site_id ],
                [ 'verify_state', '=', 1 ] ];
            if (!empty($search_text)) {
                $condition[] = [ 'g.goods_name', 'like', '%' . $search_text . '%' ];
            }

            if ($goods_class !== "") {
                $condition[] = [ 'g.goods_class', '=', $goods_class ];
            }

            if (!empty($start_sale)) $condition[] = [ 'sg.store_sale_num', '>=', $start_sale ];
            if (!empty($end_sale)) $condition[] = [ 'sg.store_sale_num', '<=', $end_sale ];
            if (!empty($goods_shop_category_ids)) $condition[] = [ 'g.goods_shop_category_ids', 'like', [ $goods_shop_category_ids, '%' . $goods_shop_category_ids . ',%', '%' . $goods_shop_category_ids, '%,' . $goods_shop_category_ids . ',%' ], 'or' ];
            $store_goods_model = new StoreGoodsModel();
            $res = $store_goods_model->getGoodsPageList($condition, $page_index, $page_size, $this->store_id);
            return $res;
        } else {
            //获取店内分类
            $goods_shop_category_model = new GoodsShopCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryTree([ [ 'site_id', "=", $this->site_id ] ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);
            return $this->fetch("goods/lists", [], $this->replace);
        }
    }

    /**
     * 更新门店的库存
     */
    public function saveStock()
    {
        $stocks = input('stock', []);
        $sku_ids = input('sku_id', []);
        $goods_ids = input('goods_id', []);
        $store_goods_sku_array = [];
        foreach ($stocks as $key => $stock) {
            $store_goods_sku_array[] = [
                'store_stock' => $stock,
                'store_id' => $this->store_id,
                'sku_id' => $sku_ids[ $key ],
                'goods_id' => $goods_ids[ $key ]
            ];
        }
        $store_goods_sku_model = new StoreGoodsSkuModel();
        $res = $store_goods_sku_model->editStock($store_goods_sku_array);

        return $res;
    }


    /**
     * 获取SKU商品列表
     * @return \multitype
     */
    public function getGoodsSkuList()
    {
        if (request()->isAjax()) {
            $goods_id = input("goods_id", 0);
            $store_goods_sku_model = new StoreGoodsSkuModel();
            $res = $store_goods_sku_model->getGoodsSkuList([ [ 'gs.goods_id', '=', $goods_id ], [ 'gs.site_id', '=', $this->site_id ] ], $this->store_id);
            return $res;
        }
    }

    public function goodsSelect()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $goods_name = input('goods_name', '');
            $goods_id = input('goods_id', 0);
            $is_virtual = input('is_virtual', '');// 是否虚拟类商品（0实物1.虚拟）
            $min_price = input('min_price', 0);
            $max_price = input('max_price', 0);
            $goods_class = input('goods_class', "");// 商品类型，实物、虚拟
            $category_id = input('category_id', "");// 商品分类id
            $promotion = input('promotion', '');//营销活动标识：pintuan、groupbuy、fenxiao、bargain
            $promotion_type = input('promotion_type', "");

            if (!empty($promotion) && addon_is_exit($promotion)) {
                $pintuan_name = input('pintuan_name', '');//拼团活动
                $goods_list = event('GoodsListPromotion', [ 'page' => $page, 'page_size' => $page_size, 'site_id' => $this->site_id, 'promotion' => $promotion, 'pintuan_name' => $pintuan_name, 'goods_name' => $goods_name ], true);
            } else {
                $condition = [
                    [ 'is_delete', '=', 0 ],
                    [ 'goods_state', '=', 1 ],
                    ['verify_state', '=', 1],
                    [ 'site_id', '=', $this->site_id ]
                ];

                if (!empty($goods_name)) {
                    $condition[] = [ 'goods_name', 'like', '%' . $goods_name . '%' ];
                }
                if ($is_virtual !== "") {
                    $condition[] = [ 'is_virtual', '=', $is_virtual ];
                }
                if (!empty($goods_id)) {
                    $condition[] = [ 'goods_id', '=', $goods_id ];
                }
                if (!empty($category_id)) {
                    $condition[] = [ 'category_id', 'like', [ $category_id, '%' . $category_id . ',%', '%' . $category_id, '%,' . $category_id . ',%' ], 'or' ];
                }

                if (!empty($promotion_type)) {
                    $condition[] = [ 'promotion_addon', 'like', "%{$promotion_type}%" ];
                }


                if ($goods_class !== "") {
                    $condition[] = [ 'goods_class', '=', $goods_class ];
                }

                if ($min_price != "" && $max_price != "") {
                    $condition[] = [ 'price', 'between', [ $min_price, $max_price ] ];
                } elseif ($min_price != "") {
                    $condition[] = [ 'price', '<=', $min_price ];
                } elseif ($max_price != "") {
                    $condition[] = [ 'price', '>=', $max_price ];
                }

                $order = 'create_time desc';
                $goods_model = new GoodsModel();
                $field = 'goods_id,goods_name,goods_class_name,goods_image,price,goods_stock,create_time,is_virtual';
                $goods_list = $goods_model->getGoodsPageList($condition, $page, $page_size, $order, $field);

                $store_goods_model = new StoreGoodsModel();
                $store_goods_sku_model = new StoreGoodsSkuModel();

                if (!empty($goods_list[ 'data' ][ 'list' ])) {
                    foreach ($goods_list[ 'data' ][ 'list' ] as $k => $v) {

                        $goods_sku_list = $store_goods_sku_model->getGoodsSkuList([ [ 'gs.goods_id', '=', $v[ 'goods_id' ] ], [ 'gs.site_id', '=', $this->site_id ] ], $this->store_id);
                        $goods_sku_list = $goods_sku_list[ 'data' ];
                        $goods_list[ 'data' ][ 'list' ][ $k ][ 'sku_list' ] = $goods_sku_list;

                        //获取门店库存
                        $store_goods_info_result = $store_goods_model->getStoreGoodsInfo([ [ 'store_id', '=', $this->store_id ], [ 'goods_id', '=', $v[ 'goods_id' ] ] ], 'store_goods_stock');
                        $store_goods_info = $store_goods_info_result[ 'data' ];
                        $goods_list[ 'data' ][ 'list' ][ $k ][ 'goods_stock' ] = empty($store_goods_info) ? 0 : $store_goods_info[ 'store_goods_stock' ];
                    }

                }
            }
            return $goods_list;
        } else {

            //已经选择的商品sku数据
            $select_id = input('select_id', '');
            $mode = input('mode', 'spu');
            $max_num = input('max_num', 0);
            $min_num = input('min_num', 0);
            $is_virtual = input('is_virtual', '');
            $disabled = input('disabled', 0);
            $promotion = input('promotion', '');//营销活动标识：pintuan、groupbuy、seckill、fenxiao

            $this->assign('select_id', $select_id);
            $this->assign('mode', $mode);
            $this->assign('max_num', $max_num);
            $this->assign('min_num', $min_num);
            $this->assign('is_virtual', $is_virtual);
            $this->assign('disabled', $disabled);
            $this->assign('promotion', $promotion);

            // 营销活动
            $goods_promotion_type = event('GoodsPromotionType');
            $this->assign('promotion_type', $goods_promotion_type);

            $goods_category_model = new GoodsCategoryModel();

            $field = 'category_id,category_name as title';
            $condition = [
                [ 'pid', '=', 0 ],
                [ 'level', '=', 1 ],
            ];
            $list = $goods_category_list = $goods_category_model->getCategoryByParent($condition, $field);
            $list = $list[ 'data' ];
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    $two_list = $goods_category_list = $goods_category_model->getCategoryByParent(
                        [
                            [ 'pid', '=', $v[ 'category_id' ] ],
                            [ 'level', '=', 2 ],
                        ],
                        $field
                    );

                    $two_list = $two_list[ 'data' ];
                    if (!empty($two_list)) {

                        foreach ($two_list as $two_k => $two_v) {
                            $three_list = $goods_category_list = $goods_category_model->getCategoryByParent(
                                [
                                    [ 'pid', '=', $two_v[ 'category_id' ] ],
                                    [ 'level', '=', 3 ],
                                ],
                                $field
                            );
                            $two_list[ $two_k ][ 'children' ] = $three_list[ 'data' ];
                        }
                    }

                    $list[ $k ][ 'children' ] = $two_list;
                }
            }

            $this->assign("category_list", $list);
            return $this->fetch("goods/goods_select", [], $this->replace);
        }
    }
}