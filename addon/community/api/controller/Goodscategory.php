<?php

namespace addon\community\api\controller;

use app\model\community\GoodsCategory as GoodsCategoryModel;
use app\model\community\GoodsAttribute as GoodsAttributeModel;

/**
 * 商品分类
 * Class Goodscategory
 * @package app\api\controller
 */
class Goodscategory extends BaseApi
{

    /**
     * 树状结构信息
     */
    public function tree()
    {
        $level = isset($this->params[ 'level' ]) ? $this->params[ 'level' ] : 3;// 分类等级 1 2 3
        $template = isset($this->params[ 'template' ]) ? $this->params[ 'template' ] : 2;// 模板 1：无图，2：有图，3：有商品
       
        $goods_category_model = new GoodsCategoryModel();
        $condition = [
            [ 'is_show', '=', 1 ],
            [ 'level', '<=', $level ],
        ];
        $cl_id = input('cl_id','');
        $field = "category_id,category_name,short_name,pid,level,image,category_id_1,category_id_2,category_id_3,image_adv";
        $order = "sort asc,category_id desc";
        $list = $goods_category_model->getCategoryTree($condition, $field, $order);
        
        
        $arr = model('community_add')->getList([['leader_id','=',$cl_id]],'count(goods_id) as count,categroup_id','','','','categroup_id');
        
         foreach ($list['data'] as $k=>&$v){
             
             foreach ($arr as $l) {
                if ($v['category_id'] == $l['categroup_id'] && $v['count'] == $l['count']) {
                   unset($list['data'][$k]);
                    continue;
                }
             }
             
         }

        return $this->response($list);
    }
    
    /**
     * 根据商品分类查询关联商品类型，查询关联品牌、属性
     * @return string
     */
    
    public function relevanceinfo()
    {
        $category_id = isset($this->params[ 'category_id' ]) ? $this->params[ 'category_id' ] : 0; //分类id

        if (empty($category_id)) {
            return $this->response($this->error('', 'REQUEST_CATEGORY_ID'));
        }
        $goods_category_model = new GoodsCategoryModel();
        $category_info = $goods_category_model->getCategoryInfo([ [ 'category_id', '=', $category_id ] ], 'attr_class_id');
        
        $category_info = $category_info[ 'data' ];
        
        $goods_attribute_model = new GoodsAttributeModel();

        //商品类型关联品牌
        $brand_list = $goods_attribute_model->getAttrClassBrandList([ [ 'ngacb.attr_class_id', '=', $category_info[ 'attr_class_id' ] ] ]);
        $brand_list = $brand_list[ 'data' ];
        $brand_initial_list = [];
        foreach ($brand_list as $item) {
            if (!in_array($item[ 'brand_initial' ], $brand_initial_list) && !empty($item[ 'brand_initial' ])) {
                $brand_initial_list[] = $item[ 'brand_initial' ];
            }
        }

        //商品类型关联属性
        $attribute_list = $goods_attribute_model->getAttributeList([ [ 'attr_class_id', '=', $category_info[ 'attr_class_id' ] ], [ 'is_query', '=', 1 ] ], 'attr_id,attr_name,attr_class_id,sort,is_query,is_spec,attr_value_list,attr_value_list,attr_type,site_id,attr_value_format');
        $attribute_list = $attribute_list[ 'data' ];
        if (!empty($attribute_list)) {
            foreach ($attribute_list as $k => $v) {
                $attribute_list[ $k ][ 'child' ] = json_decode($attribute_list[ $k ][ 'attr_value_format' ], true);
            }
        }

        $res = [
            'brand_list' => $brand_list,
            'attribute_list' => $attribute_list,
            'brand_initial_list' => $brand_initial_list
        ];
        return $this->response($this->success($res));
    }

    public function info()
    {
        $category_id = $this->params['category_id'] ?? 0;
        $goods_category_model = new GoodsCategoryModel();
        $data = $goods_category_model->getCategoryInfo([ ['category_id', '=', $category_id]]);
        if (!empty($data['data'])) {
            $child_list = $goods_category_model->getCategoryList([ ['pid', '=', $category_id], ['is_show', '=', 1 ]], 'category_id,category_name,short_name,pid,level,is_show,sort,image,attr_class_id,attr_class_name,category_id_1,category_id_2,category_id_3,commission_rate,image_adv', 'sort asc,category_id desc');
            $data['data']['child_list'] = $child_list['data'];
        }
        return $this->response($data);
    }
    public function getSelecttree()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
           $cl_id = model('member')->getInfo([['member_id','=',$this->member_id]],'cl_id,self_cl_id');
           if (!empty($cl_id['self_cl_id'])) {
               $id = $cl_id['self_cl_id'];
           }
           if(empty($cl_id['self_cl_id'])&&!empty($cl_id['cl_id'])){
                $id = $cl_id['cl_id'];
           }
            if(empty($cl_id['self_cl_id'])&&empty($cl_id['cl_id'])){
                return  $this->response($this->error('请先绑定团长'));
           }
           
        $li = model('community_add')->getList([['leader_id','=',$id]],'categroup_id');
         $ids = array_column($li,'categroup_id') ;
        $li = model('community_goods_category')->getList([['category_id','in',$ids]],'category_id,category_name');
            return $this->response($this->success($li));
    }

}