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

namespace app\shop\controller;

use addon\supply\model\Supplier as SupplierModel;
use app\model\express\ExpressTemplate as ExpressTemplateModel;
use app\model\goods\Goods as GoodsModel;
use app\model\goods\GoodsAttribute as GoodsAttributeModel;
use app\model\goods\GoodsBrand as GoodsBrandModel;
use app\model\goods\GoodsBrowse;
use app\model\goods\GoodsCategory as GoodsCategoryModel;
use app\model\goods\GoodsCollect;
use app\model\goods\GoodsEvaluate as GoodsEvaluateModel;
use app\model\goods\GoodsExport;
use app\model\goods\GoodsImport;
use app\model\goods\GoodsShopCategory;
use app\model\goods\GoodsShopCategory as GoodsShopCategoryModel;
use app\model\catecont\cateContens as cateContensModel;
use app\model\goods\VirtualGoods as VirtualGoodsModel;
/**
 * 实物商品
 * Class Goods
 * @package app\shop\controller
 */
class Goods extends BaseShop
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

            $condition = [ [ 'is_delete', '=', 0 ], [ 'site_id', '=', $this->site_id ] ];

            if (!empty($search_text)) {
                $condition[] = [ 'goods_name', 'like', '%' . $search_text . '%' ];
            }

            if ($goods_class !== "") {
                if ($goods_class == 3) {
                    /*$condition[] = [ 'goods_class', '=', 2 ];*/
                    $condition[] = [ 'is_lease', '=', 1 ];
                }else{
                    $condition[] = [ 'goods_class', '=', $goods_class ];
                }
                
            }

            // 上架状态
            if ($goods_state !== '') {
                $condition[] = [ 'goods_state', '=', $goods_state ];
            }
            //参与活动
            if (!empty($promotion_type)) {
                $condition[] = [ 'promotion_addon', 'like', "%{$promotion_type}%" ];
            }
            // 审核状态
            if ($verify_state !== '') {
                $condition[] = [ 'verify_state', '=', $verify_state ];
            }
            if (!empty($start_sale)) $condition[] = [ 'sale_num', '>=', $start_sale ];
            if (!empty($end_sale)) $condition[] = [ 'sale_num', '<=', $end_sale ];
            if (!empty($start_price)) $condition[] = [ 'price', '>=', $start_price ];
            if (!empty($end_price)) $condition[] = [ 'price', '<=', $end_price ];
            if (!empty($goods_shop_category_ids)) $condition[] = [ 'goods_shop_category_ids', 'like', [ $goods_shop_category_ids, '%' . $goods_shop_category_ids . ',%', '%' . $goods_shop_category_ids, '%,' . $goods_shop_category_ids . ',%' ], 'or' ];
           /*dump($condition);die;*/
            $res = $goods_model->getGoodsPageList($condition, $page_index, $page_size, $order_by);
            
            if (!empty($res[ 'data' ][ 'list' ])) {
                $goods_promotion_type = event('GoodsPromotionType');
                foreach ($res[ 'data' ][ 'list' ] as $k => $v) {
                    if (!empty($v[ 'promotion_addon' ])) {
                        $v[ 'promotion_addon' ] = json_decode($v[ 'promotion_addon' ], true);
                        foreach ($v[ 'promotion_addon' ] as $ck => $cv) {
                            foreach ($goods_promotion_type as $gk => $gv) {
                                if ($gv[ 'type' ] == $ck) {
                                    $res[ 'data' ][ 'list' ][ $k ][ 'promotion_addon_list' ][] = $gv;
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
                    $total = $goods_model->getGoodsTotalCount([ [ 'verify_state', '=', $k ], [ 'is_delete', '=', 0 ], [ 'site_id', "=", $this->site_id ] ]);
                    $total = $total[ 'data' ];
                    $arr[] = [
                        'state' => $k,
                        'value' => $v,
                        'count' => $total
                    ];
                }
            }
            $verify_state = $arr;
            $this->assign("verify_state", $verify_state);

            //获取店内分类
            $goods_shop_category_model = new GoodsShopCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryTree([ [ 'site_id', "=", $this->site_id ] ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];

            $this->assign("goods_shop_category_list", $goods_shop_category_list);
            //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([ [ 'site_id', "=", $this->site_id ] ], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list[ 'data' ];
            $this->assign("express_template_list", $express_template_list);

            $goods_category_model = new GoodsCategoryModel();
            $category_list = $goods_category_model->getCategoryTree()[ 'data' ] ?? [];
            $this->assign('category_list', $category_list);
            // 营销活动
            $goods_promotion_type = event('GoodsPromotionType');
            $this->assign('promotion_type', $goods_promotion_type);
            return $this->fetch("goods/lists");
        }
    }

    /**
     * 刷新审核状态商品数量
     */
    public function refreshVerifyStateCount()
    {
        if (request()->isAjax()) {
            $goods_model = new GoodsModel();
            $verify_state = $goods_model->getVerifyState();
            $arr = [];
            foreach ($verify_state as $k => $v) {
                // 过滤已审核状态
                if ($k != 1) {
                    $total = $goods_model->getGoodsTotalCount([ [ 'verify_state', '=', $k ], [ 'is_delete', '=', 0 ], [ 'site_id', "=", $this->site_id ] ]);
                    $total = $total[ 'data' ];
                    $arr[] = [
                        'state' => $k,
                        'value' => $v,
                        'count' => $total
                    ];
                }
            }
            $verify_state = $arr;
            return $verify_state;
        }
    }

    /**
     * 添加商品
     * @return mixed
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

                'website_id' => $this->website_id,//城市分站id
                'site_name' => $this->shop_info[ 'site_name' ],//店铺名
                'brand_id' => input("brand_id", 0),//品牌id
                'brand_name' => input("brand_name", ''),//品牌名称
                'goods_shop_category_ids' => input("goods_shop_category_ids", ""),// 店内分类id,逗号隔开,//供应商id
                'supplier_id' => input("supplier_id", 0),//供应商id
                "wj_off"      =>input("wj_off", ""),//是否开启问卷调查
                'is_sale' => input("is_sale", 0),//是否展示销售额
            ];
            
            $goods_model = new GoodsModel();
            $res = $goods_model->addGoods($data);
        /*if (input("wj_off", "") == 1) {
                $li=[
                'catename'=>input('catename'),
                //'keywords'=>input('keywords'),
                'desc'=>input('desc'),
                // 'gmt'=>input('gmt'),
                // 'title1'=>input('title1'),
                // 'type'=>input('type') ? input('type') : 0,
                'username'=>session('username'),
                'time'=>time(),
                'good_id' => $res['data']
            ];
            $cate_id = model('cate')->add($li);
            //获取问卷调查
            
            $data1['title']  =input('title');
            $data1['type']   =input('type');
            $data1['answer1']=input('answer1');
            $data1['answer2']=input('answer2');
            $data1['answer3']=input('answer3');
            $data1['answer4']=input('answer4');
            $data1['answer5']=input('answer5');
            $data1['answer6']=input('answer6');
            $s = 0;

            foreach ($data1['title'] as $k =>$val){
                if ($val == ""){

                    continue;
                }

                $list[$s]['title'] = $val;

                $list[$s]['type'] = $data1['type'][$k];
                $list[$s]['answer1'] = $data1['answer1'][$k];
                $list[$s]['answer2'] = $data1['answer2'][$k];
                $list[$s]['answer3'] = $data1['answer3'][$k];
                $list[$s]['answer4'] = $data1['answer4'][$k];
                $list[$s]['answer5'] = $data1['answer5'][$k];
                $list[$s]['answer6'] = $data1['answer6'][$k];
                $list[$s]['cate']   =$cate_id;
                $list[$s]['number']   =$k+1;
                $list[$s]['time']   =time();

                $s++;

            }

            $cate = model('cate_contens')->addList($list);
            }*/
            

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
            $goods_shop_category_model = new GoodsShopCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryTree([ [ 'site_id', "=", $this->site_id ] ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);

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

            $is_install_supply = addon_is_exit("supply");
            if ($is_install_supply) {
                $supplier_model = new SupplierModel();
                $supplier_list = $supplier_model->getSupplierPageList([], 1, PAGE_LIST_ROWS, 'supplier_id DESC');
                $supplier_list = $supplier_list[ 'data' ][ 'list' ];
                $this->assign("supplier_list", $supplier_list);
            }
            $this->assign("is_install_supply", $is_install_supply);

            return $this->fetch("goods/add_goods");
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
                'site_id' => $this->site_id,
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
                'website_id' => $this->website_id,//城市分站id
                'site_name' => $this->shop_info[ 'site_name' ],//店铺名
                'brand_id' => input("brand_id", 0),//品牌id
                'brand_name' => input("brand_name", ''),//品牌名称
                'goods_shop_category_ids' => input("goods_shop_category_ids", ""),// 店内分类id,逗号隔开,//供应商id
                'supplier_id' => input("supplier_id", 0),//供应商id,
                'wj_off' => input("wj_off", ''),//供应商id,
                'is_sale' => input("is_sale", 0),//是否展示销售额
            ];
            
            $res = $goods_model->editGoods($data);
            
            //判断是否启用问卷调查
            if (input("wj_off",'' ) == 1){
                //启用
                $cate_data = model('cate')->getInfo([['good_id','=',input("goods_id",'' )]]);
                $li=[
                    'catename'=>input('catename'),
                    //'keywords'=>input('keywords'),
                    'desc'=>input('desc'),
                    // 'gmt'=>input('gmt'),
                    // 'title1'=>input('title1'),
                    // 'type'=>input('type') ? input('type') : 0,
                    'username'=>session('username'),
                    'time'=>time(),
                    'good_id' => $res['data']
                ];
                if (empty($cate_data)) {
                    //说明之前没有添加数据,新赠对应数据
                    
                $cate_id = model('cate')->add($li);
                }else{
                    //说明之前有添加数据
                model('cate')->update($li,[['good_id','=',input("goods_id",'' )]]);
                
                }
                
                $ca = model('cate')->getValue([['good_id','=',input("goods_id",'' )]],'id');
                //获取问卷调查
                
                $as = model('cate_contens')->delete([['cate','=',$ca]]);
                
                $data1['title']  =input('title');
                $data1['type']   =input('type');
                $data1['answer1']=input('answer1');
                $data1['answer2']=input('answer2');
                $data1['answer3']=input('answer3');
                $data1['answer4']=input('answer4');
                $data1['answer5']=input('answer5');
                $data1['answer6']=input('answer6');
                
                foreach ($data1['title'] as $k =>$val){
                    if ($val == ""){

                        continue;
                    }

                    $list[$k]['title'] = $val;

                    $list[$k]['type'] = $data1['type'][$k];
                    $list[$k]['answer1'] = $data1['answer1'][$k];
                    $list[$k]['answer2'] = $data1['answer2'][$k];
                    $list[$k]['answer3'] = $data1['answer3'][$k];
                    $list[$k]['answer4'] = $data1['answer4'][$k];
                    $list[$k]['answer5'] = $data1['answer5'][$k];
                    $list[$k]['answer6'] = $data1['answer6'][$k];
                    $list[$k]['cate']   =$ca;
                    $list[$k]['number']   =$k+1;
                    $list[$k]['time']   =time();
                }
                 model('cate_contens')->addList($list);
            }

            return $res;
        } else {

            $goods_id = input("goods_id", 0);
            $goods_info = $goods_model->editGetGoodsInfo([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ]);
            $goods_info = $goods_info[ 'data' ];

            $goods_sku_list = $goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], "sku_id,sku_name,sku_no,sku_spec_format,price,market_price,cost_price,stock,weight,volume,sku_image,sku_images,goods_spec_format,spec_name,stock_alarm,is_default", '');
            $goods_sku_list = $goods_sku_list[ 'data' ];
            $goods_info[ 'sku_list' ] = $goods_sku_list;
            $this->assign("goods_info", $goods_info);
            
            if ($goods_info['wj_off'] == 1){
                //调查问卷开启查出对应数据
                $data = $cateContens->getJoinlist($goods_id);
                $li = model('cate')->getInfo([['good_id','=',$goods_id]]);
                $da['cate'] = $li;
                $da['num'] = count($data);
                $this->assign("data", $da);
                $this->assign("da", $data);
            }


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
            $goods_shop_category_model = new GoodsShopCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryTree([ [ 'site_id', "=", $this->site_id ] ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);
                
                 
            $is_install_supply = addon_is_exit("supply");
            if ($is_install_supply) {
                $supplier_model = new SupplierModel();
                $supplier_list = $supplier_model->getSupplierPageList([], 1, PAGE_LIST_ROWS, 'supplier_id DESC');
                $supplier_list = $supplier_list[ 'data' ][ 'list' ];
                $this->assign("supplier_list", $supplier_list);
            }
            $this->assign("is_install_supply", $is_install_supply);
           
            return $this->fetch("goods/edit_goods");
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
     * 商品回收站
     */
    public function recycle()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_keys = input('search_keys', "");
            $condition = [ [ 'is_delete', '=', 1 ], [ 'site_id', "=", $this->site_id ] ];
            if (!empty($search_keys)) {
                $condition[] = [ 'goods_name', 'like', '%' . $search_keys . '%' ];
            }
            $goods_model = new GoodsModel();
            $res = $goods_model->getGoodsPageList($condition, $page_index, $page_size);
            return $res;
        } else {
            return $this->fetch("goods/recycle");
        }
    }

    /**
     * 商品回收站商品删除
     */
    public function deleteRecycleGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->deleteRecycleGoods($goods_ids, $this->site_id);
            return $res;
        }
    }

    /**
     * 商品回收站商品恢复
     */
    public function recoveryRecycle()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyIsDelete($goods_ids, 0, $this->site_id);
            return $res;
        }

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
     * 编辑商品库存
     * @return multitype:number unknown
     */
    public function editGoodsStock()
    {
        if (request()->isAjax()) {
            $sku_list = input("sku_list", '');
            $model = new GoodsModel;
            $res = $model->editGoodsStock($sku_list);
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
     * 获取商品规格列表
     * @return \multitype
     */
    public function getSpecList()
    {
        if (request()->isAjax()) {

            $attr_id = input("attr_id", "");//排除已存在的规格项
            $search_text = input("search_text", "");
            $condition = [ [ 'is_spec', '=', 1 ], [ 'site_id', 'in', ( "0,$this->site_id" ) ] ];
            if (!empty($attr_id)) {
                $condition[] = [ 'attr_id', 'not in', $attr_id ];
            }
            if (!empty($search_text)) {
                $condition[] = [ 'attr_name', 'like', '%' . $search_text . '%' ];
            }
            $goods_attr_model = new GoodsAttributeModel();
            $spec_list = $goods_attr_model->getSpecList($condition, 'attr_id,attr_name,attr_class_name', 'attr_id desc', 50);
            return $spec_list;
        }
    }

    public function getSupplierPageList()
    {
        if (request()->isAjax()) {
            $is_install_supply = addon_is_exit("supply");
            if ($is_install_supply) {
                $supplier_model = new SupplierModel();
                $page_index = input('page_index', 1);
                $page_size = input('page_size', PAGE_LIST_ROWS);
                $search_text = input('search_text', '');

                $condition = [];
                if (!empty($search_text)) {
                    $condition[] = [ 'title|desc|keywords|supplier_phone', 'LIKE', "%{$search_text}%" ];
                }
                $res = $supplier_model->getSupplierPageList($condition, $page_index, $page_size, 'supplier_id desc', 'supplier_id,title');
                return $res;
            }
        }
    }

    /**
     * 获取商品规格值列表
     * @return \multitype
     */
    public function getSpecValueList()
    {
        if (request()->isAjax()) {

            $attr_id = input("attr_id", 0);
            $search_text = input("search_text", "");
            $condition = [];
            if (!empty($attr_id)) {
                $condition[] = [ 'attr_id', '=', $attr_id ];
            }
            if (!empty($search_text)) {
                $condition[] = [ 'attr_value_name', 'like', '%' . $search_text . '%' ];
            }

            $goods_attr_model = new GoodsAttributeModel();
            $spec_list = $goods_attr_model->getSpecValueList($condition, 'attr_value_id,attr_value_name');
            return $spec_list;
        }
    }

    /**
     * 获取商品属性列表
     * @return \multitype
     */
    public function getAttributeList()
    {

        if (request()->isAjax()) {
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attribute_list = $goods_attr_model->getAttributeList([ [ 'attr_class_id', '=', $attr_class_id ], [ 'is_spec', '=', 0 ], [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], 'attr_id,attr_name,attr_class_id,attr_class_name,attr_type,attr_value_format');
            if (!empty($attribute_list[ 'data' ])) {
                foreach ($attribute_list[ 'data' ] as $k => $v) {
                    if (!empty($v[ 'attr_value_format' ])) {
                        $attribute_list[ 'data' ][ $k ][ 'attr_value_format' ] = json_decode($v[ 'attr_value_format' ], true);
                    }
                }
            }

            return $attribute_list;
        }
    }

    /**
     * 获取SKU商品列表
     * @return \multitype
     */
    public function getGoodsSkuList()
    {
        if (request()->isAjax()) {
            $goods_id = input("goods_id", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], 'sku_id,sku_name,price,market_price,cost_price,stock,weight,volume,sku_no,sale_num,sku_image,spec_name,goods_id');
            return $res;
        }
    }

    /**
     * 获取违规下架原因
     * @return \multitype
     */
    public function getVerifyStateRemark()
    {
        if (request()->isAjax()) {
            $goods_id = input("goods_id", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->getGoodsInfo([ [ 'goods_id', '=', $goods_id ], [ 'verify_state', 'in', [ -2, 10 ] ], [ 'site_id', '=', $this->site_id ] ], 'verify_state_remark');
            return $res;
        }
    }

    /***********************************************************商品评价**************************************************/

    /**
     * 商品评价
     */
    public function evaluate()
    {
        $goods_evaluate = new GoodsEvaluateModel();

        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $explain_type = input('explain_type', ''); //1好评2中评3差评
            $is_show = input('is_show', ''); //1显示 0隐藏
            $search_text = input('search_text', ''); //搜索值
            $search_type = input('search_type', ''); //搜索类型
            $start_time = input('start_time', '');
            $end_time = input('end_time', '');

            $is_image = input('is_image', 0);//是否有图  1 有图  2 仅文字
            $is_reply = input('is_reply', 0);//是否回复  1 已回复  2 未回复
            $condition = [
                [ "site_id", "=", $this->site_id ]
            ];
            $condition[] = [ 'is_audit', '=', 1 ];
            //评分类型
            if ($explain_type != "") {
                $condition[] = [ "explain_type", "=", $explain_type ];
            }
            if ($is_show != "") {
                $condition[] = [ "is_show", "=", $is_show ];
            }
            //评论内容
            if ($is_image > 0) {
                if ($is_image == 1) {
                    $condition[] = [ "images", "<>", '' ];
                } else if ($is_image == 2) {
                    $condition[] = [ "images", "=", '' ];
                }

            }
            //全部回复
            if ($is_reply > 0) {
                if ($is_reply == 1) {
                    $condition[] = [ "explain_first", "<>", '' ];
                } else if ($is_reply == 2) {
                    $condition[] = [ "explain_first", "=", '' ];
                }
            }

            if (!empty($search_text)) {
                if (!empty($search_type)) {
                    $condition[] = [ $search_type, 'like', '%' . $search_text . '%' ];
                } else {
                    $condition[] = [ 'sku_name', 'like', '%' . $search_text . '%' ];
                }
            }
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = [ "create_time", ">=", date_to_time($start_time) ];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = [ "create_time", "<=", date_to_time($end_time) ];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = [ 'create_time', 'between', [ date_to_time($start_time), date_to_time($end_time) ] ];
            }
            $list = $goods_evaluate->getEvaluatePageList($condition, $page_index, $page_size, "create_time desc");
            return $list;
        } else {
            return $this->fetch("goods/evaluate");
        }

    }

    /**
     * 商品评价删除
     */
    public function deleteEvaluate()
    {

        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_id = input("evaluate_id", 0);
            return $goods_evaluate->deleteEvaluate($evaluate_id);
        }
    }

    /**
     * 商品推广
     * return
     */
    public function goodsUrl()
    {
        $goods_id = input('goods_id', '');
        $goods_model = new GoodsModel();
        $goods_sku_info = $goods_model->getGoodsSkuInfo([ [ 'goods_id', '=', $goods_id ] ], 'sku_id,goods_name');
        $goods_sku_info = $goods_sku_info[ 'data' ];
        $res = $goods_model->qrcode($goods_sku_info[ 'sku_id' ], $goods_sku_info[ 'goods_name' ]);
        return $res;
    }

    /**
     * 商品预览
     * return
     */
    public function goodsPreview()
    {
        $goods_id = input('goods_id', '');
        $goods_model = new GoodsModel();
        $goods_sku_info = $goods_model->getGoodsSkuInfo([ [ 'goods_id', '=', $goods_id ] ], 'sku_id,goods_name');
        $goods_sku_info = $goods_sku_info[ 'data' ];
        $res = $goods_model->qrcode($goods_sku_info[ 'sku_id' ], $goods_sku_info[ 'goods_name' ]);
        return $res;
    }

    /**
     * 商品评价回复
     */
    public function evaluateApply()
    {
        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_id = input("evaluate_id", 0);
            $explain = input("explain", 0);
            $is_first_explain = input("is_first_explain", 0);// 是否第一次回复
            $data = [
                'evaluate_id' => $evaluate_id
            ];
            if ($is_first_explain == 0) {
                $data[ 'explain_first' ] = $explain;
            } elseif ($is_first_explain == 1) {
                $data[ 'again_explain' ] = $explain;
            }

            return $goods_evaluate->evaluateApply($data);
        }
    }

    /**
     * 商品评价回复
     */
    public function deleteContent()
    {
        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_id = input("evaluate_id", 0);
            $is_first_explain = input("is_first", 0);// 0 第一次回复，1 追评回复
            $data = [];
            if ($is_first_explain == 0) {
                $data[ 'explain_first' ] = '';
            } elseif ($is_first_explain == 1) {
                $data[ 'again_explain' ] = '';
            }
            $condition = [
                [ 'evaluate_id', '=', $evaluate_id ],
                [ 'site_id', '=', $this->site_id ],
            ];

            return $goods_evaluate->editEvaluate($data, $condition);
        }
    }

    /**
     * 订单导出记录
     * @return mixed
     */
    public function export()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $start_time = input("start_time", '');
            $end_time = input("end_time", '');
            $condition = array (
                [ 'site_id', '=', $this->site_id ]
            );
            //对时间判断
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = [ "create_time", ">=", date_to_time($start_time) ];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = [ "create_time", "<=", date_to_time($end_time) ];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = [ 'create_time', 'between', [ date_to_time($start_time), date_to_time($end_time) ] ];
            }

            $export_model = new GoodsExport();
            $result = $export_model->getExportPageList($condition, $page_index, $page_size, 'create_time desc', '*');
            return $result;
        } else {
            return $this->fetch("goods/export");

        }
    }

    /**
     * 删除订单导出记录
     */
    public function deleteExport()
    {

        if (request()->isAjax()) {
            $export_ids = input('export_ids', '');

            $export_model = new GoodsExport();
            $condition = array (
                [ 'site_id', '=', $this->site_id ],
                [ 'export_id', 'in', (string) $export_ids ]
            );
            $result = $export_model->deleteExport($condition);
            return $result;
        }
    }

    /**
     * 导出商品操作
     */
    public function exportGoods()
    {
        $export_model = new GoodsExport();

        $search_text = input('search_text', "");
        $goods_state = input('goods_state', "");
        $verify_state = input('verify_state', "");
        $start_sale = input('start_sale', 0);
        $end_sale = input('end_sale', 0);
        $start_price = input('start_price', 0);
        $end_price = input('end_price', 0);
        $goods_shop_category_ids = input('goods_shop_category_ids', '');
        $goods_class = input('goods_class', "");

        $condition = [ [ 'gs.is_delete', '=', 0 ], [ 'gs.site_id', '=', $this->site_id ] ];

        //条件数组的陈诉
        $condition_desc = [];
        if (!empty($search_text)) {
            $condition[] = [ 'gs.goods_name', 'like', '%' . $search_text . '%' ];
        }
        $condition_desc[] = [ 'name' => '商品名称', 'value' => $search_text ];
        $goods_class_value = '';
        if ($goods_class !== "") {
            $condition[] = [ 'gs.goods_class', '=', $goods_class ];
            $goods_class_array = [ '1' => '实物商品', '2' => '虚拟商品3', '3' => '卡券商品' ];
            $goods_class_value = $goods_class_array[ $goods_class ];
        }
        $condition_desc[] = [ 'name' => '商品类型', 'value' => $goods_class_value ];

        // 上架状态
        $goods_state_value = '';
        if ($goods_state !== '') {
            $condition[] = [ 'gs.goods_state', '=', $goods_state ];
            $goods_state_array = [ 1 => '正常', 0 => '下架' ];
            $goods_state_value = $goods_state_array[ $goods_state ];
        }
        $condition_desc[] = [ 'name' => '商品状态', 'value' => $goods_state_value ];

        // 审核状态
        $verify_state_value = '';
        if ($verify_state !== '') {
            $condition[] = [ 'gs.verify_state', '=', $verify_state ];
            $verify_state_array = [ 1 => '已审核', 0 => '待审核', 10 => '违规下架', -1 => '审核中', -2 => '审核失败' ];
            $verify_state_value = $verify_state_array[ $verify_state ];
        }
        $condition_desc[] = [ 'name' => '审核状态', 'value' => $verify_state_value ];

        if (!empty($start_sale)) {
            $condition[] = [ 'gs.sale_num', '>=', $start_sale ];
            $condition_desc[] = [ 'name' => '销量', 'value' => "≥" . $start_sale ];
        }
        if (!empty($end_sale)) {
            $condition[] = [ 'gs.sale_num', '<=', $end_sale ];
            $condition_desc[] = [ 'name' => '销量', 'value' => "≤" . $start_sale ];
        }
        if (!empty($start_price)) {
            $condition[] = [ 'gs.price', '>=', $start_price ];
            $condition_desc[] = [ 'name' => '价格', 'value' => "≥" . $start_price ];
        }
        if (!empty($end_price)) {
            $condition[] = [ 'gs.price', '<=', $end_price ];
            $condition_desc[] = [ 'name' => '价格', 'value' => "≤" . $end_price ];
        }
        if (!empty($goods_shop_category_ids)) {
            $condition[] = [ 'gs.goods_shop_category_ids', 'like', [ $goods_shop_category_ids, '%' . $goods_shop_category_ids . ',%', '%' . $goods_shop_category_ids, '%,' . $goods_shop_category_ids . ',%' ], 'or' ];

            $goods_shop_category_model = new GoodsShopCategory();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryList([ [ 'site_id', '=', $this->site_id ], [ 'category_id', 'in', $goods_shop_category_ids ] ])[ 'data' ] ?? [];
            $goods_shop_category_ids = array_column($goods_shop_category_list, 'category_name');
            $condition_desc[] = [ 'name' => '店内分类', 'value' => implode(',', $goods_shop_category_ids) ];
        }

        $result = $export_model->exportData($condition, $condition_desc, $this->site_id);
        return $result;
//        $this->redirect(addon_url('shop/goods/export'));

    }

    /**
     * 导入商品数据
     */
    public function import()
    {
        $import_model = new GoodsImport();
        if (request()->isAjax()) {
            $file = request()->file('csv');
            if (empty($file)) {
                return $import_model->error();
            }

            $tmp_name = $file->getPathname();//获取上传缓存文件
            $csv_list = readCsv($tmp_name);
            if (empty($csv_list)) {
                return $import_model->error();
            }

            $first_list = $csv_list[ 0 ];
            //分析第一列数据
            foreach ($first_list as $k => $v) {
                $$k = $v;
            }
            $table_head = $csv_list[ 1 ];
            $table_line = $csv_list[ 0 ];
            unset($csv_list[ 0 ]);
            unset($csv_list[ 1 ]);
            $last_list = $csv_list;
            $list = [];
            foreach ($last_list as $last_k => $last_v) {
                $item_list = [];
                foreach ($last_v as $item_k => $item_v) {
                    $item_list[ $$item_k ] = trim($item_v);
                }
                $list[] = $item_list;
            }

            $result = $import_model->importGoods($list, $table_head, $table_line, $this->site_id);
            return $result;
        } else {
            return $this->fetch("goods/import");
        }
    }

    /**
     * 导出错误数据
     */
    public function exportError()
    {
        $import_model = new GoodsImport();
        $key = input('key', '');
        $import_model->exportError($key);
    }

    /**
     * 商品批量配置
     */
    public function batchGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input('goods_ids', '');//选择的商品数量
            $type = input('type', '');
            $condition = array (
                [ 'site_id', '=', $this->site_id ],
                [ 'goods_id', 'in', $goods_ids ],
            );

            $goods_model = new GoodsModel();
            switch ( $type ) {
                case 'category':
                    $category = input('category', 0);//分类
                    $result = $goods_model->modifyCategory($category, $condition);
                    break;
                case 'shop_category':
                    $shop_category = input('shop_category', '');//店内分类
                    $result = $goods_model->modifyShopCategory($shop_category, $condition);
                    break;
                case 'limit':
                    $max_buy = input('max_buy', 0);//限购数量
                    $min_buy = input('min_buy', 0);//起售数量
                    $result = $goods_model->modifyGoodsLimit($max_buy, $min_buy, $condition);
                    break;
                case 'shipping':
                    $is_free_shipping = input('is_free_shipping', 0);//是否免邮
                    $shipping_template = input('shipping_template', 0);//运费模板
                    $result = $goods_model->modifyGoodsShipping($is_free_shipping, $shipping_template, $condition);
                    break;
            }
            return $result;
        }
    }

    /**
     * 商品复制
     * @return array
     */
    public function copyGoods()
    {
        if (request()->isAjax()) {
            $goods_id = input('goods_id', 0);
            $goods_model = new GoodsModel();
            $result = $goods_model->copyGoods([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ]);
            return $result;
        }
    }

    /**
     * 会员商品收藏
     */
    public function memberGoodsCollect()
    {
        $goods_collect_model = new GoodsCollect();
        $member_id = input('member_id', 0);
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $condition = [];
            $condition[] = [ 'gc.site_id', '=', $this->site_id ];
            $condition[] = [ 'gc.member_id', '=', $member_id ];
            $order = 'gc.create_time desc';
            $field = 'gc.collect_id, gc.member_id, gc.goods_id, gc.sku_id,gc.sku_name, gc.sku_price, gc.sku_image,g.goods_name,g.is_free_shipping,sku.promotion_type,sku.discount_price,g.sale_num,g.price,g.market_price,g.is_virtual,sku.*';
            return $goods_collect_model->getCollectPageList($condition, $page, $page_size, $order, $field);
        } else {
            $this->forthMenu([ 'member_id' => $member_id ]);
            $this->assign('member_id', $member_id);
            return $this->fetch('goods/member_goods_collect');
        }
    }

    /**
     * 会员浏览记录
     */
    public function memberGoodsBrowse()
    {
        $member_id = input('member_id', 0);
        $goods_browse_model = new GoodsBrowse();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search = input('search', '');
            $condition = [];
            $condition[] = [ 'gb.site_id', '=', $this->site_id ];
            $condition[] = [ 'gb.member_id', '=', $member_id ];
            if (!empty($search))
                $condition[] = [ 'gs.sku_name', 'like', '%' . $search . '%' ];

            $order = 'browse_time desc';
            $field = 'gb.*,gs.sku_name,gs.sku_image,gs.price,gs.goods_state,gs.stock,gs.click_num';
            $alias = 'gb';
            $join = [
                [ 'goods_sku gs', 'gs.sku_id = gb.sku_id', 'left' ]
            ];
            return $goods_browse_model->getBrowsePageList($condition, $page, $page_size, $order, $field, $alias, $join);
        } else {
            $this->forthMenu([ 'member_id' => $member_id ]);
            $this->assign('member_id', $member_id);
            return $this->fetch('goods/member_goods_browse');
        }
    }

    /**
     * 商品浏览记录
     */
    public function goodsBrowse()
    {
        $goods_id = input('goods_id', 0);
        $goods_browse_model = new GoodsBrowse();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search = input('search', '');
            $condition = [];
            $condition[] = [ 'gb.site_id', '=', $this->site_id ];
            if ($goods_id > 0) {
                $condition[] = [ 'gb.goods_id', '=', $goods_id ];
            }
            if (!empty($search))
                $condition[] = [ 'gs.sku_name', 'like', '%' . $search . '%' ];

            $order = 'browse_time desc';
            $field = 'gb.*,gs.sku_name,gs.sku_image,gs.price,gs.goods_state,gs.stock,gs.click_num,m.nickname,m.headimg';
            $alias = 'gb';
            $join = [
                [ 'goods_sku gs', 'gs.sku_id = gb.sku_id', 'left' ],
                [ 'member m', 'm.member_id = gb.member_id', 'left' ]
            ];
            return $goods_browse_model->getBrowsePageList($condition, $page, $page_size, $order, $field, $alias, $join);
        } else {
            $this->assign('goods_id', $goods_id);
            return $this->fetch('goods/goods_browse');
        }
    }


    public function test()
    {
        dump(event("AddYanshiData", [ 'site_id' => 1 ]));
    }
    
    
        /**
     * 添加商品
     * @return mixed
     */
    public function addzyGoods()
    {
        if (request()->isAjax()) {
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

                'website_id' => $this->website_id,//城市分站id
                'site_name' => $this->shop_info[ 'site_name' ],//店铺名
                'brand_id' => input("brand_id", 0),//品牌id
                'brand_name' => input("brand_name", ''),//品牌名称
                'goods_shop_category_ids' => input("goods_shop_category_ids", ""),// 店内分类id,逗号隔开,//供应商id
                'supplier_id' => input("supplier_id", 0),//供应商id,
                'is_lease'=>1,
                'virtual_indate' => input("virtual_indate", ''),//有效期
                'cash_pledge'=> input("cash_pledge", ''),//押金
            ];
            
            
            
            $virtual_goods_model = new VirtualGoodsModel();
            $res = $virtual_goods_model->addGoods($data,2);
            
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
            $goods_shop_category_model = new GoodsShopCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryTree([ [ 'site_id', '=', $this->site_id ] ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);

            //获取商品类型
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_list = $goods_attr_model->getAttrClassList([ [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            $is_install_supply = addon_is_exit("supply");
            if ($is_install_supply) {
                $supplier_model = new SupplierModel();
                $supplier_list = $supplier_model->getSupplierPageList([], 1, PAGE_LIST_ROWS, 'supplier_id DESC');
                $supplier_list = $supplier_list[ 'data' ][ 'list' ];
                $this->assign("supplier_list", $supplier_list);
            }
            $this->assign("is_install_supply", $is_install_supply);

            return $this->fetch("goods/add_zy_goods");
        }
    }

    /**
     * 编辑商品
     * @return mixed
     */
    public function editzyGoods()
    {
        $virtual_goods_model = new VirtualGoodsModel();
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
                'site_id' => $this->site_id,
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
                'website_id' => $this->website_id,//城市分站id
                'site_name' => $this->shop_info[ 'site_name' ],//店铺名
                'brand_id' => input("brand_id", 0),//品牌id
                'brand_name' => input("brand_name", ''),//品牌名称
                'goods_shop_category_ids' => input("goods_shop_category_ids", ""),// 店内分类id,逗号隔开,//供应商id
                'supplier_id' => input("supplier_id", 0),//供应商id

                'virtual_indate' => input("virtual_indate", ''),//有效期
                'cash_pledge'=> input("cash_pledge", ''),//押金
            ];
            
            $res = $virtual_goods_model->editGoods($data,2);
            
           if (input("wj_off",'' ) == 1){
                //启用
                $cate_data = model('cate')->getInfo([['good_id','=',input("goods_id",'' )]]);
                $li=[
                    'catename'=>input('catename'),
                    //'keywords'=>input('keywords'),
                    'desc'=>input('desc'),
                    // 'gmt'=>input('gmt'),
                    // 'title1'=>input('title1'),
                    // 'type'=>input('type') ? input('type') : 0,
                    'username'=>session('username'),
                    'time'=>time(),
                    'good_id' => $res['data']
                ];
                if (empty($cate_data)) {
                    //说明之前没有添加数据,新赠对应数据
                    
                $cate_id = model('cate')->add($li);
                }else{
                    //说明之前有添加数据
                model('cate')->update($li,[['good_id','=',input("goods_id",'' )]]);
                
                }
                
                $ca = model('cate')->getValue([['good_id','=',input("goods_id",'' )]],'id');
                //获取问卷调查
                
                $as = model('cate_contens')->delete([['cate','=',$ca]]);
                
                $data1['title']  =input('title');
                $data1['type']   =input('type');
                $data1['answer1']=input('answer1');
                $data1['answer2']=input('answer2');
                $data1['answer3']=input('answer3');
                $data1['answer4']=input('answer4');
                $data1['answer5']=input('answer5');
                $data1['answer6']=input('answer6');
                
                foreach ($data1['title'] as $k =>$val){
                    if ($val == ""){

                        continue;
                    }

                    $list[$k]['title'] = $val;

                    $list[$k]['type'] = $data1['type'][$k];
                    $list[$k]['answer1'] = $data1['answer1'][$k];
                    $list[$k]['answer2'] = $data1['answer2'][$k];
                    $list[$k]['answer3'] = $data1['answer3'][$k];
                    $list[$k]['answer4'] = $data1['answer4'][$k];
                    $list[$k]['answer5'] = $data1['answer5'][$k];
                    $list[$k]['answer6'] = $data1['answer6'][$k];
                    $list[$k]['cate']   =$ca;
                    $list[$k]['number']   =$k+1;
                    $list[$k]['time']   =time();
                }
                 model('cate_contens')->addList($list);
            }
            
            return $res;
        } else {

            $goods_model = new GoodsModel();
            $goods_id = input("goods_id", 0);
            $goods_info = $goods_model->editGetGoodsInfo([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ]);
            $goods_info = $goods_info[ 'data' ];

            $goods_sku_list = $virtual_goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], "sku_id,sku_name,sku_no,sku_spec_format,price,market_price,cost_price,stock,virtual_indate,sku_image,sku_images,goods_spec_format,spec_name,stock_alarm,is_default", '');
            $goods_sku_list = $goods_sku_list[ 'data' ];
            $goods_info[ 'sku_list' ] = $goods_sku_list;
            $this->assign("goods_info", $goods_info);
            if ($goods_info['wj_off'] == 1){
                //调查问卷开启查出对应数据
                $data = $cateContens->getJoinlist($goods_id);
                $li = model('cate')->getInfo([['good_id','=',$goods_id]]);
                $da['cate'] = $li;
                $da['num'] = count($data);
                
                $this->assign("data", $da);
                $this->assign("da", $data);
            }
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
            $goods_shop_category_model = new GoodsShopCategoryModel();
            $goods_shop_category_list = $goods_shop_category_model->getShopCategoryTree([ [ 'site_id', '=', $this->site_id ] ], 'category_id,category_name,pid,level');
            $goods_shop_category_list = $goods_shop_category_list[ 'data' ];
            $this->assign("goods_shop_category_list", $goods_shop_category_list);

            //获取商品类型
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_list = $goods_attr_model->getAttrClassList([ [ 'site_id', 'in', ( "0,$this->site_id" ) ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            $is_install_supply = addon_is_exit("supply");
            if ($is_install_supply) {
                $supplier_model = new SupplierModel();
                $supplier_list = $supplier_model->getSupplierPageList([], 1, PAGE_LIST_ROWS, 'supplier_id desc', 'supplier_id,title,supplier_site_id');
                $supplier_list = $supplier_list[ 'data' ][ 'list' ];
                $this->assign("supplier_list", $supplier_list);
            }
            $this->assign("is_install_supply", $is_install_supply);
            
            return $this->fetch("virtualgoods/edit_goods");
        }
    }
    
    
    
    
}
