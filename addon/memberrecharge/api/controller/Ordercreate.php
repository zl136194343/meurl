<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace addon\memberrecharge\api\controller;

use app\api\controller\BaseApi;
use addon\memberrecharge\model\MemberrechargeOrderCreate as OrderCreateModel;
use app\model\member\MemberAccount;

/**
 * 订单创建
 * @author Administrator
 *
 */
class Ordercreate extends BaseApi
{
    /**
     * 创建订单
     * @return string
     */
    public function create()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $order_create = new OrderCreateModel();
        $data = [
            'recharge_id' => isset($this->params['recharge_id']) ? $this->params['recharge_id'] : '',//套餐id
            'member_id' => $this->member_id??2035,
            'order_from' => $this->params['app_type'],
            'order_from_name' => $this->params['app_type_name'],
            'face_value' => !empty($this->params['face_value'])?$this->params['face_value']:'',
            'type' =>!empty($this->params['type'])?$this->params['type']:1,//1购买  2续费
            'level' => !empty($this->params['level'])?$this->params['level']:'',
        ];
        $member_account = new MemberAccount();
        if (empty($data['recharge_id'])) {
            //说明是其他
            //判断当前用户等级
            $member_level = model('member')->getInfo([['member_id','=',$this->member_id??2035]],'member_level,expiration_time,start_time');
            /*$member_level['member_level'] = 2;*/
            if($member_level['member_level'] > 1){
                //说明已经购买过会员  进行判断当前是购买会员还是进行续费
                if ($data['type'] == 1) {
                    //说明是购买
                    //$times = strtotime("+1 year") - (30 * 3600);
                    if ($member_level['member_level'] == 2 && $data['level'] == 3  && $member_level['start_time'] + 30*86400 > time()) {
                        // 因为是购买并已经有等级的情况下 只能是购买二级会员   减去之前的会员费用
                        $data['face_value'] = 198 - 19.8;
                    }else{
                        $data['face_value'] = 198;
                    }
                }else{
                    //进行续费
                    
                    /*model('member')->update(['growth'=>0],[['member_id','=',$this->member_id]]);*/
                     if ($data['level'] == 2 ) {
                         
                        // 续费白银级会员   
                        $data['face_value'] = 19.8;
                    }else{
                        //续费黄金级会员
                        $data['face_value'] = 198 ;
                    }
                }
            }else{
                if ($data['level'] == 2 ) {
                        // 购买一级会员
                         $data['face_value'] = 19.8;
                    }else{
                        //购买二级会员
                        $data['face_value'] = 198;
                    }
            }
            
           
            $res = $order_create->create2($data);
            $res['num'] = $data['face_value'] ;
            return $this->response($res);
            /*return $this->response($this->error('', '缺少必填参数商品数据'));*/
        }
        $res = $order_create->create($data);
        return $this->response($res);
    }

}