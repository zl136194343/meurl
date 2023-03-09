<?php
/**
 * Created by PhpStorm.
 * User: roysc
 * Date: 2022/5/30
 * Time: 11:00
 */

namespace app\admin\controller;
use app\model\hospital\Hospital as HospitalModel;
use app\model\upload\Upload as UploadModel;

class Hospital extends BaseAdmin
{
    public function lists()
    {
        //获取咨询信息
        $hospital = new HospitalModel();
        if (request()->isAjax()) {

            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $title = input('hospital_name', '');
            $condition = [];
            if ($title) {
                $condition[] = [ 'hospital_name', 'like', '%' . $title . '%' ];
            }



            $shop_list = $hospital->getList($condition,$page,'','hospital_id asc');

            return $shop_list;
        }



        return $this->fetch('hospital/lists');
    }

    public function addCon(){
        if (request()->isAjax()) {
            if (input('hospital_name','') == "") return $this->error('','请填写院系名称');
            if (input('hospital_img','','htmlentities') == "") return $this->error('','请上传院系头像');
            $data = [
                'hospital_name'=>input('hospital_name',''),
                'hospital_img'=>input('hospital_img','','htmlentities'),
                'create_time'=>time(),
                'modify_time'=>time(),
            ];

            $hospital = new HospitalModel();
            return $hospital->addCon($data);
        }

        return $this->fetch('hospital/add_con');
    }

    public function editHos(){
        $hospital = new HospitalModel();
        if (request()->isAjax()) {

            $data = [
                'hospital_name'=>input('hospital_name',''),

                'modify_time'=>time(),
            ];
            if(input('hospital_img','')){
                $data['hospital_img'] = input('hospital_img','','htmlentities');
            }
            return $hospital->uploadStatus($data,[['hospital_id','=',input('hospital_id','')]]);
        }
        $id = input('hospital_id','');
        $res = $hospital->getCosInfo([['hospital_id','=',$id]]);


        $this->assign('verify_state',$res);

        return $this->fetch('hospital/edit');
    }
    public function deleteHos()
    {
        if (request()->isAjax()) {
            $con_id = input('hospital_id', ''); // 分类id
            $hospital = new HospitalModel();
            
            $res = $hospital->deleteHos($con_id);
            $this->addLog("删除院系id:" . $con_id);
            return $res;
        }
    }
}