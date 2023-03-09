<?php


namespace app\admin\controller;

use app\model\dtgl\Company as CompanyModel;
class Company extends BaseAdmin
{
    /**
     * 公司列表
     */
    public function lists()
    {
        $goods_category_model = new CompanyModel();
        $list = $goods_category_model->getCategoryTree();

        $list = $list[ 'data' ];

        $this->assign("list", $list);

        return $this->fetch('dtgl/company/lists');
    }
    /**
     * 职位列表
     */
    public function position()
    {
        if (request()->isAjax()){

            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);

            $search_text = input('search_text', "");

            $condition = [];
            //评分类型

            if (!empty($search_text)) {
                $condition[] = [ 'position_name', 'like', '%' . $search_text . '%' ];
            }

            $list = model('company_position')->pageList($condition,'','id desc',$page_index,$page_size);

           /* $list = model('company_position')->getList();*/


            return success(0,'获取成功',$list);
        } else{
            return $this->fetch('dtgl/company/position');
        }



    }

    /**
     * 删除对应的职位
     */
    public function delete()
    {
        if (request()->isAjax()) {
            $id = input('id', '');
            $where = [['id','=',$id]];
            $res = model("company_position")->delete($where);
            $this->addLog("删除职位id:" . $id);
            return success(0,'删除成功',$res);
        }
    }

}