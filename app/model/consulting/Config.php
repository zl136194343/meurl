<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2022/5/24
 * Time: 15:56
 */
namespace app\model\consulting;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;
use think\facade\Db;
class Config extends BaseModel{

    public function getList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*', $alias = '', $join = '', $group = null)
    {

        $list = model('consulting')->pageList($condition, $field, $order, $page, $page_size, $alias, $join, $group);
        return $this->success($list);
    }
    public function addCon($data){
       $res =  Db::name('consulting')->save($data);
       /* dump($res);die;
        $res = model("consulting")->add($data);*/
        if ($res){
            return $this->success($res);
        }else{
            return $this->error('', '添加失败');
        }
    }
    public  function uploadStatus($condition ,$data){
         
        $res = model('consulting')->update( $condition,$data);

        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        return $this->success($res);
    }
    public function getConInfo($condition, $field = '*')
    {
        $res = model('consulting')->getInfo($condition, $field);
        return $this->success($res);
    }
    public function setWatch($condition,$str)
    {
        $res = model('consulting')->setInc($condition, $str);
        return $this->success($res);
    }
    public function deleteCon($con_id){
        $res = model('consulting')->delete([ [ 'id', '=', $con_id ] ]);
        if ($res){
            return $this->success($res);
        }else{
            return $this->error('','删除失败');
        }
    }
}