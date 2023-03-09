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

use app\model\goods\GoodsCategory as GoodsCategoryModel;
use app\model\goods\GoodsBrand as GoodsBrandModel;
use app\model\goods\GoodsAttribute as GoodsAttributeModel;
use app\model\goods\VirtualGoods as VirtualGoodsModel;
use app\model\goods\GoodsShopCategory as GoodsShopCategoryModel;
use addon\supply\model\Supplier as SupplierModel;
use \app\model\goods\Goods as GoodsModel;
use app\model\catecont\cateContens as cateContensModel;
/**
 * 虚拟商品
 * Class Virtualgoods
 * @package app\shop\controller
 */
class Virtualgoods extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }


    /**
     * 添加商品
     * @return mixed
     */
    public function addGoods()
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

                'virtual_indate' => input("virtual_indate", ''),//有效期
                "wj_off"      =>input("wj_off", ""),//是否开启问卷调查
            ];
            
            

            $virtual_goods_model = new VirtualGoodsModel();
            $res = $virtual_goods_model->addGoods($data);
            if (input("wj_off", "") == 1) {
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
            }
                        
            
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

            return $this->fetch("virtualgoods/add_goods");
        }
    }

    /**
     * 编辑商品
     * @return mixed
     */
    public function editGoods()
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
                'wj_off' => input("wj_off", ''),//供应商id,
            ];
            
            $res = $virtual_goods_model->editGoods($data);
            
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

            $goods_sku_list = $virtual_goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], "sku_id,sku_name,sku_no,sku_spec_format,price,market_price,cost_price,stock,virtual_indate,sku_image,sku_images,goods_spec_format,spec_name,stock_alarm,is_default,is_lease,cash_pledge", '');
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
            
            if ($goods_sku_list[0]['is_lease'] == 1) {
                
                return $this->fetch("goods/edit_zy_goods");
            }else{
                return $this->fetch("virtualgoods/edit_goods");
            }
            
        }
    }

}