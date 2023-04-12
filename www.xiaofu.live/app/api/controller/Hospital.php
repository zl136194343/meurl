<?php
/**
 * Created by PhpStorm.
 * User: roysc
 * Date: 2022/5/30
 * Time: 14:53
 */

namespace app\api\controller;

use app\model\hospital\Hospital as HospitalModel;
class Hospital extends  BaseApi
{
    /*public function getHospitalInfo()
    {
        $id =  $this->params['hospital_id'];
        $con = new HospitalModel();
        $res = $con->getConInfo([['id','=',$id]]);


        return $this->response($res);
    }*/
    public function getHospitalList()
    {

        $Hospital = new HospitalModel();

        $page = $this->params[ 'page' ] ?? 1;
        $page_size = $this->params[ 'page_size' ] ?? PAGE_LIST_ROWS;
        $res = $Hospital->getList([],$page,$page_size);
        return $this->response($res);
    }
}