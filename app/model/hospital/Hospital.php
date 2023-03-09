<?php
namespace app\model\hospital;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;
use think\facade\Db;
/**
 * Created by PhpStorm.
 * User: roysc
 * Date: 2022/5/30
 * Time: 11:07
 */
class Hospital extends BaseModel
{
    public function getList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*', $alias = '', $join = '', $group = null)
    {
        $re = model('hospital')->pageList($condition, $field, $order, $page, $page_size, $alias, $join, $group);

        return $this->success($re);
    }
    public function addCon($data){
        $res =  Db::name('hospital')->save($data);
        /* dump($res);die;
         $res = model("consulting")->add($data);*/
        if ($res){
            return $this->success($res);
        }else{
            return $this->error('', '添加失败');
        }
    }
    public  function uploadStatus($condition ,$data){

        $res = model('hospital')->update( $condition,$data);

        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        return $this->success($res);
    }
    public function getCosInfo($condition, $field = '*')
    {
        $res = model('hospital')->getInfo($condition, $field);
        return $this->success($res);
    }
    public function deleteHos($con_id){
        $res = model('hospital')->delete([ [ 'hospital_id', '=', $con_id ] ]);
        if ($res){
            return $this->success($res);
        }else{
            return $this->error('','删除失败');
        }
    }
}