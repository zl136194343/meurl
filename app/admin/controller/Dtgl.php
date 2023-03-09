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

/*use app\model\dtgl\GoodsAttribute as GoodsAttributeModel;*/
use app\model\dtgl\Dtgl as DtglModel;

/**
 * 商品分类管理 控制器
 */
class Dtgl extends BaseAdmin
{


    /**
     * 商品列表1
     */
    public function lists()
    {
        $goods_category_model = new DtglModel();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', "");
            $search_text_type = input('search_text_type', "goods_name");


            $condition = [ ];
            if (!empty($search_text)) {
                $condition[] = [ $search_text_type, 'like', '%' . $search_text . '%' ];
            }
            $res = $goods_category_model->getDtglPageList($condition, $page_index, $page_size, 'sort desc,id desc');
           /* if (!empty($res[ 'data' ][ 'list' ])) {
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
            }*/
            return $res;
        } else {

            return $this->fetch('dtgl/dtgl/lists');
        }
    }
    /**
     * 商品分类列表
     */
    public function fllists()
    {
        $goods_category_model = new DtglModel();
        $list = $goods_category_model->getCategoryTree();
        
        $list = $list[ 'data' ];
        
        $this->assign("list", $list);
        return $this->fetch('dtgl/category/lists');
    }

    /**
     * 商品分类添加
     */
    public function addCategory()
    {
        $goods_category_model = new DtglModel();
        if (request()->isAjax()) {
            $name = input('name','');
            $img = input('img','');
            $sort = input('sort','');
            $data = [
                    'name'=>$name,
                    'img'=>$img,
                    'sort'=>$sort,
                ];
            $res = $goods_category_model->addCategory($data);
            $this->addLog("添加动态分类:" . $name);
            /*if (!empty($res[ 'data' ])) {

                //修改category_id_
                $update_data = [
                    'category_id' => $res[ 'data' ],
                    'category_id_' . $level => $res[ 'data' ]
                ];
                $goods_category_model->editCategory($update_data);
            }*/
            return $res;
        } else {

            /*$goods_attribute_model = new GoodsAttributeModel();

            // 商品类型列表
            $attr_class_list = $goods_attribute_model->getAttrClassList([], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);*/

            return $this->fetch('dtgl/category/add_category');
        }
    }

    /**
     * 商品分类编辑
     */
    public function editCategory()
    {
        $goods_category_model = new DtglModel();
        if (request()->isAjax()) {
            $category_id = input('category_id', '');// 分类id
            $name = input('name','');
            $img = input('img','');
            $sort = input('sort','');
            $data = [
                'id'=>$category_id,
                'name'=>$name,
                'img'=>$img,
                'sort'=>$sort,
            ];
            $this->addLog("编辑商品分类:" . $name);


            $res = $goods_category_model->editCategory($data);

            return $res;

        } else {

            $category_id = input('category_id', '');// 分类id

            if (empty($category_id)) {
                $this->error("缺少参数category_id");
            }

            $goods_category_info = $goods_category_model->getCategoryInfo([ [ 'id', '=', $category_id ] ]);
            $this->assign("goods_category_info", $goods_category_info[ 'data' ]);
            //父级
            
            /*$goods_category_parent_info = $goods_category_model->getCategoryInfo([ [ 'category_id', '=', $goods_category_info[ 'data' ][ 'pid' ] ] ], 'category_name');
            $this->assign("goods_category_parent_info", $goods_category_parent_info[ 'data' ]);
            $goods_attribute_model = new GoodsAttributeModel();

            // 商品类型列表
            $attr_class_list = $goods_attribute_model->getAttrClassList([], 'class_id,class_name');
            $this->assign("attr_class_list", $attr_class_list[ 'data' ]);*/

            return $this->fetch('dtgl/category/edit_category');
        }
    }

    /**
     * 商品分类删除
     */
    public function deleteCategory()
    {
        if (request()->isAjax()) {
            $category_id = input('category_id', ''); // 分类id
            $goods_category_model = new DtglModel();
            $res = $goods_category_model->deleteCategory($category_id);
            $this->addLog("删除商品分类id:" . $category_id);
            return $res;
        }
    }

    /**
     * 评论管理
     */
    public function comment()

    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);

            $search_text = input('search_text', "");

            $condition = [];
            //评分类型

            if (!empty($search_text)) {
                $condition[] = [ 'zp_title|member_name', 'like', '%' . $search_text . '%' ];
            }

            $list = model('dtgl_pinglun')->pageList($condition,'','id desc',$page_index,$page_size);

            return success(0,'获取成功',$list);
        } else {
            return $this->fetch('dtgl/dtgl/evaluate_list');
        }
    }

    /**
     * 修改评论审核状态
     */
    public function modifyAuditEvaluate()
    {
        if (request()->isAjax()) {
            /*$goods_evaluate = new GoodsEvaluate();*/
            $evaluate_ids = input("evaluate_ids", '');
            $is_audit = input('is_audit', 0);
            $data = [
                'is_status' => $is_audit
            ];
            $condition = [
                [ 'id', 'in', $evaluate_ids ],
                [ 'is_status', '=', 0 ],
            ];

            $res = model("dtgl_pinglun")->update($data, $condition);
            return success(0,'设置成功',$res);
        }
    }
    /**
     * 评论删除
     */
    public function deleteEvaluate()
    {
        if (request()->isAjax()) {
            $id = input('id', '');
            $where = [['id','=',$id]];
            $res = model("dtgl_pinglun")->delete($where);
            $this->addLog("删除用户评价id:" . $id);
            return success(0,'删除成功',$res);
        }
    }


    /**
     * 获取商品分类列表
     * @return \multitype
     */
    public function getCategoryList()
    {
        $pid = input('pid', 0); // 上级id
        $level = input('level', 0); // 层级
        $goods_category_model = new GoodsCategoryModel();
        if (!empty($level)) {
            $condition = [
                [ 'level', '=', $level ]
            ];
        } else {
            $condition = [
                [ 'pid', '=', $pid ]
            ];
        }
        $list = $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,pid,level,category_id_1,category_id_2,category_id_3', 'sort asc,category_id desc');
        return $list;
    }

    /**
     * 获取商品分类信息
     * @return \multitype
     */
    public function getCategoryInfo()
    {
        $category_id = input('category_id', ''); // 分类id
        $goods_category_model = new GoodsCategoryModel();
        $condition = [
            [ 'category_id', '=', $category_id ]
        ];
        $res = $goods_category_model->getCategoryInfo($condition, 'category_name');
        
        return $res;
    }


    /**
     * 获取商品分类
     * @return \multitype
     */
    public function getCategoryByParent()
    {
        $pid = input('pid', 0); // 上级id
        $level = input('level', 0); // 层级
        $type = input('type', ''); // 层级
        $goods_category_model = new GoodsCategoryModel();
        if (!empty($level)) {
            $condition[] = [ 'level', '=', $level ];
        }
        if (!empty($pid)) {
            $condition[] = [ 'pid', '=', $pid ];
        }
        if (!empty($type)) {
            $condition[] = [ 'is_jifen', '=', 1 ];
        }else{
            $condition[] = [ 'is_jifen', '=', 0 ];
        }
        
        $list = $goods_category_list = $goods_category_model->getCategoryByParent($condition, 'category_id,category_name,pid,level,category_id_1,category_id_2,category_id_3');
        return $list;
    }

    /**
     * 修改商品分类排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {
            $sort = input('sort', 0);
            $category_id = input('category_id', 0);
            $category_sort_array = input('category_sort_array', '');
            $goods_category_model = new DtglModel();
            if (!empty($category_sort_array)) {
                $category_sort_array = json_decode($category_sort_array, true);
                foreach ($category_sort_array as $k => $v) {
                    $res = $goods_category_model->modifyGoodsCategorySort($v[ 'sort' ], $v[ 'category_id' ]);
                }
            } else {
                $res = $goods_category_model->modifyGoodsCategorySort($sort, $category_id);
            }
            return $res;
        }
    }

    /**
     * 获取商品分类 及 店内分类
     * @return array
     */
    public function getCategoryByDiyView()
    {
        if(request()->isAjax()){

            //平台端商品分类
            $goods_category_model = new GoodscategoryModel();
            $condition = [
                ['pid', '=', 0]
            ];
            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name    ');
            $goods_category_list = $goods_category_list['data'];

            return success(0,'',['goods_category_list' => $goods_category_list,'shop_goods_category_list' => []]);
        }
    }
}
