<?php
namespace app\model\catecont;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;
use think\facade\Db;


/**
 * Created by PhpStorm.
 * User: roysc
 * Date: 2022/6/1
 * Time: 10:28
 */
class cateContens extends BaseModel
{
    public function getJoinlist($id)
    {
       $data =  Db::name('cate_contens')->field('c.*')->alias('c')->join('cate ct','ct.id = c.cate','left')->where('ct.good_id',$id)->select()->toArray();
        return $data;
    }
}