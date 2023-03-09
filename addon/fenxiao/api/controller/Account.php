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

namespace addon\fenxiao\api\controller;

use addon\fenxiao\model\FenxiaoAccount;
use addon\fenxiao\model\Fenxiao as FenxiaoModel;
use app\api\controller\BaseApi;


/**
 * 分销商流水
 */
class Account extends BaseApi
{

    /**
     * 分销商流水分页
     * @return false|string
     */
    /*public function page2()
    {

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $page = isset($this->params['page']) ? $this->params['page'] : 1;
        $page_size = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;

        $model = new FenxiaoModel();
        $fenxiao_info = $model->getFenxiaoInfo([['member_id', '=', $this->member_id]], 'fenxiao_id');
        $fenxiao_info = $fenxiao_info['data'];
        $start_time = input('time','');
        if (!empty($fenxiao_info['fenxiao_id'])) {
            $condition = [
                ['fenxiao_id', '=', $fenxiao_info['fenxiao_id']]
            ];
            if (!empty($start_time) && $start_time == 1) {
                $condition[] = [ "create_time", "between", [strtotime(date('Ymd',time())),strtotime(date('Ymd',time()))+86400]];
            } elseif (!empty($start_time) && $start_time == 2) {
                //本周
                $condition[] = [ "create_time", "between", [mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")),mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))]] ;
            } elseif (!empty($start_time) && $start_time == 3) {
                
                $condition[] = [ "create_time", "between", [mktime(0,0,0,date('m'),1,date('y')),mktime(23,59,59,date('m'),date('t'),date('y'))]] ;
            } 
            $account_model = new FenxiaoAccount();
            $list = $account_model->getFenxiaoAccountPageList($condition, $page, $page_size);
            return $this->response($list);
        }
        return $this->response($this->error('', 'FENXIAO_NOT_EXIST'));
    }*/
    
    public function page()
    {

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $page = isset($this->params['page']) ? $this->params['page'] : 1;
        $page_size = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;

        $model = new FenxiaoModel();
        $fenxiao_info = $model->getFenxiaoInfo([['member_id', '=', $this->member_id??32]], 'fenxiao_id');
        
        $fenxiao_info = $fenxiao_info['data'];
       
        $start_time = input('time','')??0;
        $is_pingtai = input('is_pingtai',0);
         $time= [];
        if (!empty($fenxiao_info['fenxiao_id'])) {
            $condition = [
                ['fenxiao_id', '=', $fenxiao_info['fenxiao_id']]
            ];
           
            if (!empty($start_time) && $start_time == 1) {
                $condition[] = [ "create_time", "between", [strtotime(date('Ymd',time())),strtotime(date('Ymd',time()))+86400]];
                $time[] = [ "create_time", "between", [strtotime(date('Ymd',time())),strtotime(date('Ymd',time()))+86400]];
            } elseif (!empty($start_time) && $start_time == 2) {
                //本周
                $condition[] = [ "create_time", "between", [mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")),mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))]] ;
                $time[] = [ "create_time", "between", [mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")),mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))]] ;
            } elseif (!empty($start_time) && $start_time == 3) {
                
                $condition[] = [ "create_time", "between", [mktime(0,0,0,date('m'),1,date('y')),mktime(23,59,59,date('m'),date('t'),date('y'))]] ;
                $time[] = [ "create_time", "between", [mktime(0,0,0,date('m'),1,date('y')),mktime(23,59,59,date('m'),date('t'),date('y'))]] ;
            } 
            
            
            $account_model = new FenxiaoAccount();
            $list = $account_model->getFenxiaoAccountPageList($condition, $page, $page_size);
            
            $income = model('fenxiao_account')->getList($condition,'sum(money) as money');
            
            if($is_pingtai == 1){
                //平台分销员
                $one_time = $time;
                $one_time[] = ['one_fenxiao_id', '=', $fenxiao_info['fenxiao_id']];
                $market = model('fenxiao_order')->getList($one_time,'sum(price*num) as money');
                
                //查出对应的zifenxiao

/*                  $id = array_column($fenxiao,'fenxiao_id');
               $ids = implode(',',$id);*/
                $two_time = $time;
                $two_time[] = ['two_fenxiao_id', '=', $fenxiao_info['fenxiao_id']];
                $marketT = model('fenxiao_order')->getList($two_time,'sum(price*num) as money');
                
                $sell = $market[0]['money'] + $marketT[0]['money'];
               
                
            }else{
                $two_time = $time;
                $two_time[] = ['two_fenxiao_id', '=', $fenxiao_info['fenxiao_id']];
                $market = model('fenxiao_order')->getList($two_time,'sum(real_goods_money) as money');
                $sell =  $market[0]['money'];
                
            }
            $list['data']['money'] = $income[0]['money'];
            
            $list['data']['sell'] = $sell;
            return $this->response($list);
        }
        return $this->response($this->error('', 'FENXIAO_NOT_EXIST'));
    }

}