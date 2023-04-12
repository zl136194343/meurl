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

namespace app\admin\controller;

use app\model\catecont\cateContens as cateContensModel;
use app\model\consulting\Config as Config;
use app\model\upload\Upload as UploadModel;
use app\model\goods\GoodsAttribute as GoodsAttributeModel;
use app\model\community\CommunityGoods as GoodsModel;
use app\model\community\CommanderWithdraw as CommanderWithdrawModel;
use app\model\goods\GoodsBrand as GoodsBrandModel;
use app\model\goods\Config as GoodsConfigModel;

use app\model\goods\GoodsBrowse as GoodsBrowseModel;
use app\model\community\GoodsCategory as GoodsCategoryModel;

use app\model\goods\GoodsCollect;
use app\model\goods\GoodsEvaluate;
use app\model\express\ExpressTemplate as ExpressTemplateModel;

/**
 * 社区管理 控制器
 */
class Community extends BaseAdmin
{

    /**
     * 社区商品列表
     */
    public function lists()
    {

        $goods_model = new GoodsModel();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', "");
            $goods_state = input('goods_state', "");
            $verify_state = input('verify_state', "");
            $start_sale = input('start_sale', 0);
            $end_sale = input('end_sale', 0);
            $start_price = input('start_price', 0);
            $end_price = input('end_price', 0);
            $goods_shop_category_ids = input('goods_shop_category_ids', '');
            $goods_class = input('goods_class', "");
            $order = input('order', 'create_time');
            $sort = input('sort', 'desc');
            $promotion_type = input('promotion_type', "");
            $order_by = $order . ' ' . $sort;

            $condition = [['is_delete', '=', 0], ['site_id', '=', $this->site_id]];

            if (!empty($search_text)) {
                $condition[] = ['goods_name', 'like', '%' . $search_text . '%'];
            }

            if ($goods_class !== "") {
                $condition[] = ['goods_class', '=', $goods_class];
            }

            // 上架状态
            if ($goods_state !== '') {
                $condition[] = ['goods_state', '=', $goods_state];
            }
            //参与活动
            if (!empty($promotion_type)) {
                $condition[] = ['promotion_addon', 'like', "%{$promotion_type}%"];
            }
            // 审核状态
            if ($verify_state !== '') {
                $condition[] = ['verify_state', '=', $verify_state];
            }
            if (!empty($start_sale)) $condition[] = ['sale_num', '>=', $start_sale];
            if (!empty($end_sale)) $condition[] = ['sale_num', '<=', $end_sale];
            if (!empty($start_price)) $condition[] = ['price', '>=', $start_price];
            if (!empty($end_price)) $condition[] = ['price', '<=', $end_price];
            if (!empty($goods_shop_category_ids)) $condition[] = ['goods_shop_category_ids', 'like', [$goods_shop_category_ids, '%' . $goods_shop_category_ids . ',%', '%' . $goods_shop_category_ids, '%,' . $goods_shop_category_ids . ',%'], 'or'];
            $res = $goods_model->getGoodsPageList($condition, $page_index, $page_size, $order_by);

            if (!empty($res['data']['list'])) {
                $goods_promotion_type = event('GoodsPromotionType');
                foreach ($res['data']['list'] as $k => $v) {
                    if (!empty($v['promotion_addon'])) {
                        $v['promotion_addon'] = json_decode($v['promotion_addon'], true);
                        foreach ($v['promotion_addon'] as $ck => $cv) {
                            foreach ($goods_promotion_type as $gk => $gv) {
                                if ($gv['type'] == $ck) {
                                    $res['data']['list'][$k]['promotion_addon_list'][] = $gv;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            return $res;
        } else {
            $page = input('page', 1);
            $verify_state = $goods_model->getVerifyState();
            $arr = [];

            foreach ($verify_state as $k => $v) {
                // 过滤已审核状态
                if ($k != 1) {
                    $total = $goods_model->getGoodsTotalCount([['verify_state', '=', $k], ['is_delete', '=', 0], ['site_id', "=", $this->site_id]]);
                    $total = $total['data'];
                    $arr[] = [
                        'state' => $k,
                        'value' => $v,
                        'count' => $total
                    ];
                }
            }
            $verify_state = $arr;
            $this->assign("verify_state", $verify_state);

            $condition = [
                [ 'pid', '=', 0 ]
            ];
            //获取店内分类
            $goods_shop_category_model = new GoodsCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            $goods_shop_category_list = $goods_shop_category_list['data'];

            $this->assign("goods_shop_category_list", $goods_shop_category_list);
            //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([['site_id', "=", $this->site_id]], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list['data'];
            $this->assign("express_template_list", $express_template_list);

            $goods_category_model = new GoodsCategoryModel();
            $category_list = $goods_category_model->getCategoryTree()['data'] ?? [];
            $this->assign('category_list', $category_list);
            // 营销活动
            $goods_promotion_type = event('GoodsPromotionType');
            $this->assign('promotion_type', $goods_promotion_type);

            return $this->fetch("community/goods/lists");
        }
    }
    /**
     * 添加社区商品
     */
    public function addGoods()
    {
        if (request()->isPost()) {

            $category_array = input("category_id", 0);// 分类id
            $category_json = json_encode($category_array);//分类字符串
            $category_id = ',' . implode(',', $category_array) . ',';

            $data = [
                'goods_name' => input("goods_name", ""),// 商品名称,
                'goods_attr_class' => input("goods_attr_class", ""),// 商品类型id,
                'goods_attr_name' => input("goods_attr_name", ""),// 商品类型名称,
                'site_id' => $this->site_id,
                'category_id' => $category_id,
                'category_array' => $category_array,//商品分类数组
                'category_json' => $category_json,
                'goods_image' => input("goods_image", ""),// 商品主图路径
                'goods_content' => input("goods_content", ""),// 商品详情
                'goods_state' => input("goods_state", ""),// 商品状态（1.正常0下架）
                'price' => input("price", 0),// 商品价格（取第一个sku）
                'market_price' => input("market_price", 0),// 市场价格（取第一个sku）
                'cost_price' => input("cost_price", 0),// 成本价（取第一个sku）
                'sku_no' => input("sku_no", ""),// 商品sku编码
                'weight' => input("weight", ""),// 重量
                'volume' => input("volume", ""),// 体积
                'goods_stock' => input("goods_stock", 0),// 商品库存（总和）
                'goods_stock_alarm' => input("goods_stock_alarm", 0),// 库存预警
                'is_free_shipping' => input("is_free_shipping", 1),// 是否免邮
                'shipping_template' => input("shipping_template", 0),// 指定运费模板
                'goods_spec_format' => input("goods_spec_format", ""),// 商品规格格式
                'goods_attr_format' => input("goods_attr_format", ""),// 商品属性格式
                'introduction' => input("introduction", ""),// 促销语
                'keywords' => input("keywords", ""),// 关键词
                'unit' => input("unit", ""),// 单位
                'sort' => input("sort", 0),// 排序,
                'video_url' => input("video_url", ""),// 视频
                'goods_sku_data' => input("goods_sku_data", ""),// SKU商品数据
                'label_id' => input("label_id", ''),// 商品分组id
                'max_buy' => input("max_buy", 0),// 限购
                'min_buy' => input("min_buy", 0),// 起售
                'timer_on' => strtotime(input('timer_on', 0)),//定时上架
                'timer_off' => strtotime(input('timer_off', 0)),//定时下架

                'website_id' => 0,//城市分站id
                'site_name' => '',//店铺名
                'brand_id' => input("brand_id", 0),//品牌id
                'brand_name' => input("brand_name", ''),//品牌名称
                'goods_shop_category_ids' => input("goods_shop_category_ids", ""),// 店内分类id,逗号隔开,//供应商id
                'supplier_id' => input("supplier_id", 0),//供应商id
                "wj_off"      =>input("wj_off", ""),//是否开启问卷调查
            ];

            $goods_model = new GoodsModel();
            $res = $goods_model->addGoods($data);

            return $res;
        } else {

            //获取一级商品分类
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', 0 ]
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            $goods_category_list = $goods_category_list[ 'data' ];
            $this->assign("goods_category_list", $goods_category_list);

            //获取品牌
            $goods_brand_model = new GoodsBrandModel();

            $brand_list = $goods_brand_model->getBrandList([ [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], "brand_id, brand_name");
            $brand_list = $brand_list[ 'data' ];
            $this->assign("brand_list", $brand_list);

            //获取店内分类

            $goods_shop_category_model = new GoodsCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getCategoryList([ ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);

           /* //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([ [ 'site_id', "=", $this->site_id ] ], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list[ 'data' ];*/
            $this->assign("express_template_list", []);

            //获取商品类型
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_list = $goods_attr_model->getAttrClassList([ [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);


            $this->assign("is_install_supply", []);

            return $this->fetch("community/goods/add_goods");
        }
    }

    /**
     * 编辑商品
     * @return mixed
     */
    public function editGoods()
    {
        $goods_model = new GoodsModel();
        $cateContens = new cateContensModel();
        if (request()->isAjax()) {

            $category_array = input("category_id", 0);// 分类id
            $category_json = json_encode($category_array);//分类字符串
            $category_id = ',' . implode(',', $category_array) . ',';

            $data = [
                'goods_id' => input("goods_id", 0),// 商品id
                'goods_name' => input("goods_name", ""),// 商品名称,
                'goods_attr_class' => input("goods_attr_class", ""),// 商品类型id,
                'goods_attr_name' => input("goods_attr_name", ""),// 商品类型名称,
                'site_id' => 0,
                'category_id' => $category_id,
                'category_json' => $category_json,
                'goods_image' => input("goods_image", ""),// 商品主图路径
                'goods_content' => input("goods_content", ""),// 商品详情
                'goods_state' => input("goods_state", ""),// 商品状态（1.正常0下架）
                'price' => input("price", 0),// 商品价格（取第一个sku）
                'market_price' => input("market_price", 0),// 市场价格（取第一个sku）
                'cost_price' => input("cost_price", 0),// 成本价（取第一个sku）
                'sku_no' => input("sku_no", ""),// 商品sku编码
                'weight' => input("weight", ""),// 重量
                'volume' => input("volume", ""),// 体积
                'goods_stock' => input("goods_stock", 0),// 商品库存（总和）
                'goods_stock_alarm' => input("goods_stock_alarm", 0),// 库存预警
                'is_free_shipping' => input("is_free_shipping", 1),// 是否免邮
                'shipping_template' => input("shipping_template", 0),// 指定运费模板
                'goods_spec_format' => input("goods_spec_format", ""),// 商品规格格式
                'goods_attr_format' => input("goods_attr_format", ""),// 商品属性格式
                'introduction' => input("introduction", ""),// 促销语
                'keywords' => input("keywords", ""),// 关键词
                'unit' => input("unit", ""),// 单位
                'sort' => input("sort", 0),// 排序,
                'video_url' => input("video_url", ""),// 视频
                'goods_sku_data' => input("goods_sku_data", ""),// SKU商品数据
                'label_id' => input("label_id", ''),// 商品分组id
                'max_buy' => input("max_buy", 0),// 限购
                'min_buy' => input("min_buy", 0),// 起售
                'timer_on' => strtotime(input('timer_on', 0)),//定时上架
                'timer_off' => strtotime(input('timer_off', 0)),//定时下架
                'spec_type_status' => input('spec_type_status', 0),

                'category_array' => $category_array,
                'website_id' => 0,//城市分站id
                'site_name' => '',//店铺名
                'brand_id' => input("brand_id", 0),//品牌id
                'brand_name' => input("brand_name", ''),//品牌名称
                'goods_shop_category_ids' => input("goods_shop_category_ids", ""),// 店内分类id,逗号隔开,//供应商id
                'supplier_id' => input("supplier_id", 0),//供应商id,
                'wj_off' => input("wj_off", ''),//供应商id,
            ];

            $res = $goods_model->editGoods($data);
            return $res;
        } else {
            $goods_id = input("goods_id", 0);
            $goods_info = $goods_model->editGetGoodsInfo([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ]);
            $goods_info = $goods_info[ 'data' ];

            $goods_sku_list = $goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], "sku_id,sku_name,sku_no,sku_spec_format,price,market_price,cost_price,stock,weight,volume,sku_image,sku_images,goods_spec_format,spec_name,stock_alarm,is_default", '');
            $goods_sku_list = $goods_sku_list[ 'data' ];
            $goods_info[ 'sku_list' ] = $goods_sku_list;
            $this->assign("goods_info", $goods_info);



            //获取一级商品分类
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', 0 ],
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            $goods_category_list = $goods_category_list[ 'data' ];
            $this->assign("goods_category_list", $goods_category_list);

            //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([ [ 'site_id', "=", $this->site_id ] ], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list[ 'data' ];
            $this->assign("express_template_list", $express_template_list);

            //获取商品类型
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_list = $goods_attr_model->getAttrClassList([ [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            //获取品牌
            $goods_brand_model = new GoodsBrandModel();
            $brand_list = $goods_brand_model->getBrandList([ [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], "brand_id, brand_name");
            $brand_list = $brand_list[ 'data' ];
            $this->assign("brand_list", $brand_list);

            //获取店内分类
            $goods_shop_category_model = new GoodsCategoryModel();

            $goods_shop_category_list = $goods_shop_category_model->getCategoryTree([], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);

           /* $is_install_supply = addon_is_exit("supply");
            if ($is_install_supply) {
                $supplier_model = new SupplierModel();
                $supplier_list = $supplier_model->getSupplierPageList([], 1, PAGE_LIST_ROWS, 'supplier_id DESC');
                $supplier_list = $supplier_list[ 'data' ][ 'list' ];
                $this->assign("supplier_list", $supplier_list);
            }*/
           /* $this->assign("is_install_supply", $is_install_supply);*/

            return $this->fetch("community/goods/edit_goods");
        }
    }

    /**
     * @return 社区分类
     */
    public function cateGroup()
    {
        $goods_category_model = new GoodsCategoryModel();
        $list = $goods_category_model->getCategoryTree();
        $list = $list[ 'data' ];
        $this->assign("list", $list);
        return $this->fetch('community/goodscategory/lists');
    }
    /**
     * 添加社区分类
     */
    public function addCategory()
    {
        $goods_category_model = new GoodsCategoryModel();
        if (request()->isAjax()) {

            $category_name = input('category_name', ''); // 分类名称
            $short_name = input('short_name', ''); // 简称
            $pid = input('pid', 0); //默认添加的商品分类为顶级
            $level = input('level', 1); // 层级
            $is_show = 0; // 是否显示
//            $sort = input('sort', ''); // 排序
            $image = input('image', ''); // 分类图片
            $image_adv = input('image_adv', ''); // 分类广告图片
            $keywords = input('keywords', ''); // 分类页面关键字
            $description = input('description', ''); // 分类介绍
            $attr_class_id = input('attr_class_id', ''); // 关联商品类型id
            $attr_class_name = input('attr_class_name', ''); // 关联商品类型名称
            $commission_rate = input('commission_rate', ''); // 佣金比率%
            $category_id_1 = input('category_id_1', 0); // 一级分类id
            $category_id_2 = input('category_id_2', 0); // 二级分类id
            $category_full_name = input('category_full_name', '');; // 组装名称

            $data = [
                'category_name' => $category_name,
                'short_name' => $short_name,
                'pid' => $pid,
                'level' => $level,
                'is_show' => input('is_show', ''),
//                'sort' => $sort,
                'image' => $image,
                'image_adv' => $image_adv,
                'keywords' => $keywords,
                'description' => $description,
                'attr_class_id' => $attr_class_id,
                'attr_class_name' => $attr_class_name,
                'commission_rate' => $commission_rate,
                'category_id_1' => $category_id_1,
                'category_id_2' => $category_id_2,
                'category_full_name' => $category_full_name
            ];
            $res = $goods_category_model->addCategory($data);
            $this->addLog("添加商品分类:" . $category_name);
            if (!empty($res[ 'data' ])) {

                //修改category_id_
                $update_data = [
                    'category_id' => $res[ 'data' ],
                    'category_id_' . $level => $res[ 'data' ]
                ];
                $goods_category_model->editCategory($update_data);
            }
            return $res;
        } else {

            $goods_attribute_model = new GoodsAttributeModel();

            // 商品类型列表
            $attr_class_list = $goods_attribute_model->getAttrClassList([], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            return $this->fetch('community/goodscategory/add_category');
        }
    }
    
    
        /**
     * 商品分类编辑
     */
    public function editCategory()
    {
        $goods_category_model = new GoodsCategoryModel();
        if (request()->isAjax()) {
            $category_id = input('category_id', '');// 分类id
            $category_name = input('category_name', '');// 分类名称
            $short_name = input('short_name', '');// 简称
            $pid = input('pid', 0);//默认添加的商品分类为顶级
            $level = input('level', 1);// 层级
            $is_show = input('is_show', '');// 是否显示
//            $sort = input('sort', '');// 排序
            $image = input('image', '');// 分类图片
            $keywords = input('keywords', '');// 分类页面关键字
            $description = input('description', '');// 分类介绍
            $category_id_1 = input('category_id_1', 0);// 一级分类id
            $category_id_2 = input('category_id_2', 0);// 二级分类id
            $category_full_name = input('category_full_name', '');;// 组装名称
            $data = [
                'site_id' => $this->site_id,
                'category_id' => $category_id,
                'category_name' => $category_name,
                'short_name' => $short_name,
                'pid' => $pid,
                'level' => $level,
                'is_show' => $is_show,
//                'sort' => $sort,
                'image' => $image,
                'keywords' => $keywords,
                'description' => $description,
                'category_id_1' => $category_id_1,
                'category_id_2' => $category_id_2,
                'category_full_name' => $category_full_name
            ];
            $res = $goods_category_model->editShopCategory($data);
            return $res;
        } else {

            $category_id = input('category_id', '');// 分类id

            if (empty($category_id)) {
                $this->error("缺少参数category_id");
            }

            $goods_category_info = $goods_category_model->getShopCategoryInfo([ [ 'category_id', '=', $category_id ] ]);
            $goods_category_info = $goods_category_info[ 'data' ];
            $this->assign("goods_category_info", $goods_category_info);

            //父级
            $goods_category_parent_info = $goods_category_model->getShopCategoryInfo([ [ 'category_id', '=', $goods_category_info[ 'pid' ] ] ], 'category_name');
            $goods_category_parent_info = $goods_category_parent_info[ 'data' ];
            $this->assign("goods_category_parent_info", $goods_category_parent_info);

            $goods_attribute_model = new GoodsAttributeModel();

            // 商品类型列表
            $attr_class_list = $goods_attribute_model->getAttrClassList([], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            return $this->fetch('community/goodscategory/edit_category');
        }
    }

    /**
     * 商品分类删除
     */
    public function deleteCategory()
    {
        if (request()->isAjax()) {
            $category_id = input('category_id', '');// 分类id
            $goods_category_model = new GoodsShopCategoryModel();
            $res = $goods_category_model->deleteShopCategory($category_id);
            return $res;
        }
    }

    /**
     * 获取商品分类列表
     * @return \multitype
     */
    public function getCategoryList()
    {
        if (request()->isAjax()) {
            $category_id = input("category_id", 0);
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', $category_id ]
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            return $goods_category_list;
        }
    }

    /**
     * 获取商品分类
     * @return \multitype
     */
    public function getCategoryByParent()
    {
        $pid = input('pid', 0);// 上级id
        $level = input('level', 0);// 层级
        $goods_category_model = new GoodscategoryModel();
        if (!empty($level)) {
            $condition[] = [ 'level', '=', $level ];
        }
        if (!empty($pid)) {
            $condition[] = [ 'pid', '=', $pid ];
        }
        $list = $goods_category_list = $goods_category_model->getCategoryByParent($condition, 'category_id,category_name,pid,level,category_id_1,category_id_2,category_id_3');
        return $list;
    }

    /**
     * 商品下架
     */
    public function offGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_state = input("goods_state", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyGoodsState($goods_ids, $goods_state, $this->site_id);
            return $res;
        }

    }

    /**
     * 商品上架
     */
    public function onGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_state = input("goods_state", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyGoodsState($goods_ids, $goods_state, $this->site_id);
            return $res;
        }
    }

    /**
     * 删除商品
     */
    public function deleteGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyIsDelete($goods_ids, 1, $this->site_id);
            return $res;
        }

    }

    /**
     * 转账设置
     * @return mixed
     */
    public function withdrawConfig()
    {
        $account_model = new GoodsModel();
        if (request()->isAjax()) {
            $config_json = input('config_json', '');
            $data = $config_json ? json_decode($config_json, true) : [];
            if (!array_key_exists('id_experience', $data)) {
                $data[ 'id_experience' ] = 0;
            }

            return $account_model->setShopWithdrawConfig($data);
        } else {
            $config_info = $account_model->getShopWithdrawConfig();
            $this->assign('config_info', $config_info[ 'data' ]);

          /*  //店铺等级
            $shop_group_model = new ShopGroupModel();
            $shop_group = $shop_group_model->getGroupList([ [ 'is_own', '=', 0 ] ], '*');
            $this->assign('group_list', $shop_group[ 'data' ]);*/

            return $this->fetch("community/shop_account/withdraw_config");
        }
    }

    /**
     * 提现
     */
    public function withdrawlist()
    {
        $model = new CommanderWithdrawModel();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $condition = [];

            $withdraw_no = input('withdraw_no');//提现流水
            if (!empty($withdraw_no)) {
                $condition[] = [ 'withdraw_no', 'like', '%' . $withdraw_no . '%' ];
            }
            $fenxiao_name = input('fenxiao_name', '');//分销商店铺名
            if (!empty($fenxiao_name)) {
                $condition[] = [ 'commander_name', 'like', '%' . $fenxiao_name . '%' ];
            }
            $level_id = input('level_id');//分销商等级id
            if (!empty($level_id)) {
                $condition[] = [ 'level_id', '=', $level_id ];
            }
            $withdraw_type = input('withdraw_type');//提现类型
            if (!empty($withdraw_type)) {
                $condition[] = [ 'withdraw_type', '=', $withdraw_type ];
            }
            $status = input('status');//提现类型
            if (!empty($status)) {
                $condition[] = [ 'status', '=', $status ];
            }

            $start_time = input('start_time', '');
            $end_time = input('end_time', '');
            if ($start_time && $end_time) {
                $condition[] = [ 'create_time', 'between', [ strtotime($start_time), strtotime($end_time) ] ];
            } elseif (!$start_time && $end_time) {
                $condition[] = [ 'create_time', '<=', strtotime($end_time) ];
            } elseif ($start_time && !$end_time) {
                $condition[] = [ 'create_time', '>=', strtotime($start_time) ];
            }

            $order = 'id desc';
            $list = $model->getCommanderWithdrawPageList($condition, $page, $page_size, $order);
            return $list;

        } else {
            return $this->fetch('community/withdraw/lists');
        }

    }


    /**
     * 审核通过
     */
    public function withdrawPass()
    {
        $ids = input('id');

        $model = new CommanderWithdrawModel();

        return $model->withdrawPass($ids);
    }

    /**
     * 审核拒绝
     */
    public function withdrawRefuse()
    {
        $id = input('id');

        $model = new CommanderWithdrawModel();

        return $model->withdrawRefuse($id);
    }
    
    
}

