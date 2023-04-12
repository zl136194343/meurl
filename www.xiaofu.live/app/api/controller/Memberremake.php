<?php


namespace app\api\controller;

use addon\fenxiao\api\controller\Level;

class Memberremake extends BaseApi
{
     /**
     *添加备注
     */
     public function setRemake()
     {
         $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $memberids = input('memberid',0);
         $remark = input('remark','');
        $data = [
            'member_id'=>$this->card_id,
            'bzr_member_id'=>$memberids,
            'remark'=>$remark,
            'create_time'=>time()
            ];
        $re = model('member_remark')->getInfo([['member_id','=',$this->card_id],['bzr_member_id','=',$memberids]]);
        if (empty($re)) {
           $re = model('member_remark')->add($data);
        }else{
             $re = model('member_remark')->update($data,[['member_id','=',$this->card_id],['bzr_member_id','=',$memberids]]);
        }
        return $this->response($this->success($re));
     }
}