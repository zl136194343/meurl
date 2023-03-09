<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2022/5/26
 * Time: 15:18
 */

namespace app\api\controller;

use app\model\consulting\Config as conModel;
class Consulting extends  BaseApi
{
    public function conInfo()
    {
        $id =  $this->params['con_id'];
        $re = $this->checkToken();
            if ($re['code']< 0){

        }else{
                //查看当前用户是否已经点赞
                $is_click = Model('consulting_click')->getInfo([['member_id','=',$this->member_id],['con_id','=',$id]]);

                if ($is_click){
                    //用户已经点过赞
                    $res['data']['is_status'] = 1;
                }else{
                    $res['data']['is_status'] = 0;
                }
            }

        $type =  $this->params['type']??"";
        file_put_contents('test.txt',$type);
        $con = new conModel();
        $res = $con->getConInfo([['id','=',$id],['status','=',0]]);

        if ($res&&!empty($type)){

            //查看成功,添加点击数
            $con->setWatch([['id','=',$id]],'watch');
            $res = $con->getConInfo([['id','=',$id],['status','=',0]]);
        }
        


        
        return $this->response($res);
    }
    public function likes()
    {
        $re = $this->checkToken();
        if ($re['code']< 0){
            return $this->response($re);
        }
        
        $id =  $this->params['con_id'];
        $con = new conModel();
        if ($id){
            //点赞数
            $da = Model('consulting_click')->getInfo(['member_id'=>$this->member_id,'con_id'=>$id]);
            
            if (empty($da)){
                //说明之前没有点赞
                $re =  $con->setWatch([['id','=',$id]],'likes');
                //将对应的数据加入点赞表中
                if ($re){
                    $da = Model('consulting_click')->add(['member_id'=>$this->member_id,'con_id'=>$id]);
                    return $this->response(['code'=>0,'message'=>'点赞成功','data'=>0]);
                }
            }{
                //之前已经点赞过了,取消点赞
                return $this->response(['code'=>0,'message'=>'取消点赞','data'=>0]);
            }

        }
    }
    

    
}