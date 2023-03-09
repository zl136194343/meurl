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

use addon\fenxiao\model\Fenxiao as FenxiaoModel;
use addon\fenxiao\model\FenxiaoLevel;
use addon\fenxiao\model\FenxiaoOrder;
use addon\fenxiao\model\FenxiaoApply;
use addon\fenxiao\model\Poster;
use app\api\controller\BaseApi;
use app\model\member\Member;
use Carbon\Carbon;

use think\facade\Db;
/**
 * 分销相关信息
 */
class Fenxiao extends BaseApi
{
    /**
     * 获取分销商信息
     */
    public function detail()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $condition = [
            [ 'f.member_id', '=', $this->member_id??2362 ]
        ];

        $model = new FenxiaoModel();
        $info = $model->getFenxiaoDetailInfo($condition);

        if (empty($info[ 'data' ])) {
            $res = $model->autoBecomeFenxiao($this->member_id);
            if (isset($res[ 'code' ]) && $res[ 'code' ] >= 0) {
                $info = $model->getFenxiaoDetailInfo($condition);
            }
        } else {
            $member = new Member();
            $info[ 'data' ][ 'one_child_num' ] = $member->getMemberCount([ [ 'fenxiao_id', '=', $info[ 'data' ][ 'fenxiao_id' ] ], [ 'is_fenxiao', '=', 0 ] ])[ 'data' ];

            $condition_result = $model->geFenxiaoLastLevel($this->member_id);
            $info[ 'data' ][ 'condition' ] = $condition_result[ 'data' ];
        }

        $fenxiao_order_model = new FenxiaoOrder();

        // 今日收入
        $compare_today = Carbon::today()->timestamp;
        $compare_tomorrow = Carbon::tomorrow()->timestamp;

        $commission = 0;
        $one_commission = $fenxiao_order_model->getFenxiaoOrderInfo([ [ 'one_fenxiao_id', '=', $info[ 'data' ][ 'fenxiao_id' ] ], [ 'create_time', 'between', [ $compare_today, $compare_tomorrow ] ], [ 'is_settlement', '=', 1 ] ], 'sum(one_commission) as commission');
        $two_commission = $fenxiao_order_model->getFenxiaoOrderInfo([ [ 'two_fenxiao_id', '=', $info[ 'data' ][ 'fenxiao_id' ] ], [ 'create_time', 'between', [ $compare_today, $compare_tomorrow ] ], [ 'is_settlement', '=', 1 ] ], 'sum(two_commission) as commission');
        $three_commission = $fenxiao_order_model->getFenxiaoOrderInfo([ [ 'three_fenxiao_id', '=', $info[ 'data' ][ 'fenxiao_id' ] ], [ 'create_time', 'between', [ $compare_today, $compare_tomorrow ] ], [ 'is_settlement', '=', 1 ] ], 'sum(three_commission) as commission');

        if (!empty($one_commission[ 'data' ][ 'commission' ])) $commission += $one_commission[ 'data' ][ 'commission' ];
        if (!empty($two_commission[ 'data' ][ 'commission' ])) $commission += $two_commission[ 'data' ][ 'commission' ];
        if (!empty($three_commission[ 'data' ][ 'commission' ])) $commission += $three_commission[ 'data' ][ 'commission' ];

        $info[ 'data' ][ 'today_commission' ] = $commission;
        // 总销售额
        $fenxiao_order_info = $fenxiao_order_model->getFenxiaoOrderInfo([ [ 'one_fenxiao_id|two_fenxiao_id|three_fenxiao_id', '=', $info[ 'data' ][ 'fenxiao_id' ] ] ?? 0 ], 'sum(real_goods_money) as real_goods_money');

        $fenxiao_order_info = $fenxiao_order_info[ 'data' ];
        if (empty($fenxiao_order_info[ 'real_goods_money' ])) {
            $fenxiao_order_info[ 'real_goods_money' ] = 0;
        }
        $info[ 'data' ][ 'today_order_money' ] = $fenxiao_order_info[ 'real_goods_money' ];

        return $this->response($info);
    }
    
    

    /**
     * 获取推荐人分销商信息
     */
    public function sourceInfo()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $member = new Member();
        $member_info = $member->getMemberInfo([ [ 'member_id', '=', $this->member_id ] ], 'fenxiao_id');
        $fenxiao_id = $member_info[ 'data' ][ 'fenxiao_id' ] ?? 0;

        if (empty($fenxiao_id)) {
            return $this->response($this->error('', 'REQUEST_SOURCE_MEMBER'));
        }
        $condition = [
            [ 'fenxiao_id', '=', $fenxiao_id ]
        ];

        $model = new FenxiaoModel();
        $info = $model->getFenxiaoInfo($condition, 'fenxiao_name');

        return $this->response($info);
    }
    /**
     *获取分销邀请人  佣金   以及佣金记录
     */
    public function getFenxiaoSelct()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $condition = [
            [ 'member_id', '=', $this->member_id??241 ]
        ];

        $model = new FenxiaoModel();
        $info = model('Fenxiao')->getInfo($condition);
        
        $data['account'] = $info['account'];
        //我的邀请人
        $list = model('member')->getList([['source_member','=',$this->member_id??241]]);
        $data['list'] = $list;
        //我的佣金记录
        $fenxiao_account = model('fenxiao_account')->getList([['fenxiao_id','=',$info['fenxiao_id']]]);
        $data['fenxiao_account'] = $fenxiao_account;
         return $this->response($this->success($data));
    }

    /**
     * 分销海报
     * @return \app\api\controller\false|string
     */
    public function poster()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        file_put_contents('tesdts.txt',json_encode(input()));
        $qrcode_param = isset($this->params[ 'qrcode_param' ]) ? $this->params[ 'qrcode_param' ] : '';//二维码
        if (empty($qrcode_param)) {
            return $this->response($this->error('', 'REQUEST_QRCODE_PARAM'));
        }

        $qrcode_param = json_decode($qrcode_param, true);
        $qrcode_param[ 'source_member' ] = $this->member_id;

        $poster = new Poster();
        $res = $poster->distribution($this->params[ 'app_type' ], $this->params[ 'page' ], $qrcode_param);

        return $this->response($res);
    }

    /**
     * 分销商等级信息
     */
    public function level()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $level = $this->params[ 'level' ] ?? 0;

        $condition = [
            [ 'level_id', '=', $level ]
        ];
        $model = new FenxiaoLevel();
        $info = $model->getLevelInfo($condition);

        return $this->response($info);
    }

    /**
     * 分销商我的团队
     */
    public function team()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $page = $this->params[ 'page' ] ?? 1;
        $page_size = $this->params[ 'page_size' ] ?? PAGE_LIST_ROWS;
        $level = $this->params[ 'level' ] ?? 1;

        $model = new FenxiaoModel();
        $fenxiao_info = $model->getFenxiaoInfo([ [ 'member_id', '=', $this->member_id ] ], 'fenxiao_id');
        if (empty($fenxiao_info[ 'data' ])) return $this->response($this->error('', 'MEMBER_NOT_IS_FENXIAO'));

        $list = $model->getFenxiaoTeam($level, $fenxiao_info[ 'data' ][ 'fenxiao_id' ], $page, $page_size);

        return $this->response($list);
    }

    /**
     * 查询我的团队的数量
     */
    public function teamNum()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $model = new FenxiaoModel();
        $fenxiao_info = $model->getFenxiaoInfo([ [ 'member_id', '=', $this->member_id ] ], 'fenxiao_id');
        if (empty($fenxiao_info[ 'data' ])) return $this->response($this->error('', 'MEMBER_NOT_IS_FENXIAO'));

        $data = $model->getFenxiaoTeamNum($fenxiao_info[ 'data' ][ 'fenxiao_id' ]);
        return $this->response($data);
    }
    /**
     * 设置下级子分销的佣金比列
     */
    public function setTwoRate(){
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $model = new FenxiaoModel();
        $fenxiao_info = $model->getFenxiaoInfo([ [ 'member_id', '=', $this->member_id ] ], 'fenxiao_id');
        if (empty($fenxiao_info[ 'data' ])) return $this->response($this->error('', 'MEMBER_NOT_IS_FENXIAO'));
        $two_rate = input('two_rate','');
       
         if (empty($two_rate)) return $this->response($this->error('', '参数异常'));
         
         $data = model('fenxiao')->update(['two_rate'=>$two_rate],[['fenxiao_id','=',$fenxiao_info[ 'data' ][ 'fenxiao_id' ]]]);
         
         return $this->response($this->success($data));
    }
    
     /**
     *  解除绑定关系
     */
    public function remove()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $model = new FenxiaoModel();
        $fenxiao_info = $model->getFenxiaoInfo([ [ 'member_id', '=', $this->member_id] ], 'fenxiao_id,parent,account');
        if (empty($fenxiao_info[ 'data' ])) return $this->response($this->error('', 'MEMBER_NOT_IS_FENXIAO'));
        $member_id = input('member_id','');
        if(empty($member_id)){
            //说明是下级解除关系
           
            model('fenxiao')->delete([['fenxiao_id','=',$fenxiao_info['data']['fenxiao_id']]]);
            model('member')->update(['is_fenxiao'=>0,'fenxiao_id'=>0],[['member_id','=',$this->member_id]]);
        }else{
            //说明是上级解除关系
             $list = $model->getFenxiaoInfo([ [ 'member_id', '=', $member_id ] ], 'fenxiao_id,account');
             
             if ($list[ 'data' ]['account']!=0.00) {
                 return $this->response($this->error('', '当前分销商有佣金未提现,不能解除'));
             }
             
             $count = model('fenxiao_order')->getlist([['one_fenxiao_id','=',$list['data']['fenxiao_id']],['is_settlement','=',0]],'count(fenxiao_order_id) as count')[0]['count'];
             
             if ($count > 0) {
                 return $this->response($this->error('', '当前分销商有佣金未结算,不能解除'));
             }
             model('fenxiao')->delete([['member_id','=',$member_id],['parent','=',$fenxiao_info['data']['fenxiao_id']]]);
             model('member')->update(['is_fenxiao'=>0,'fenxiao_id'=>0],[['member_id','=',$member_id]]);
        }
        return $this->response($this->success());
        
    }
}