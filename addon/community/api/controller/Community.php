<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 * @author : niuteam
 */

namespace addon\community\api\controller;

use addon\community\model\community\CommunityAccount;
use addon\community\model\community\Config as CommunityConfig;
use addon\community\model\community\CommunityLevel;
use addon\community\model\community\Leader;
use app\model\member\Member as MemberModel;
use addon\community\model\order\Order;
use addon\community\model\community\Poster;
use addon\community\model\order\OrderCommon as OrderCommonModel;
use addon\community\model\order\OrderRefund as OrderRefundModel;

/**
 * 团长管理
 * @author Administrator
 *
 */
class Community extends BaseApi
{
    public $site_id = 0;
    /**
     * 团长申请
     */
    public function apply()
    
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
       
        $leader_model = new Leader();
        $leader_info  = $leader_model->getLeaderInfo(['member_id' => $token['data']['member_id']], '*');
        if (!empty($leader_info['data'])) {
            if ($leader_info['data']['status'] == 0) {
                return $this->response($this->error("", "当前有正在审核中的信息不可重复提交!"));
            } elseif ($leader_info['data']['status'] == 1 || $leader_info['data']['status'] == 3) {
                return $this->response($this->error("", "您已经是社区团长!"));
            }
        }

        $data = array(
            'member_id'     => $this->member_id??30,
            
            'name'          => isset($this->params['name']) ? $this->params['name'] : '',
            'mobile'        => isset($this->params['mobile']) ? $this->params['mobile'] : '',
            'community'     => isset($this->params['community']) ? $this->params['community'] : '',
            'community_img' => isset($this->params['community_img']) ? $this->params['community_img'] : '',
            'wechat'        => isset($this->params['wechat']) ? $this->params['wechat'] : '',
            'province_id'   => isset($this->params['province_id']) ? $this->params['province_id'] : '',
            'city_id'       => isset($this->params['city_id']) ? $this->params['city_id'] : '',
            'district_id'   => isset($this->params['district_id']) ? $this->params['district_id'] : '',
            'address'       => isset($this->params['address']) ? $this->params['address'] : '',
            'full_address'  => isset($this->params['full_address']) ? $this->params['full_address'] : '',
            'longitude'     => isset($this->params['longitude']) ? $this->params['longitude'] : '',
            'latitude'      => isset($this->params['latitude']) ? $this->params['latitude'] : '',
            'location'      => isset($this->params['location']) ? $this->params['location'] : '',
        );
       
        $leader_model = new Leader();
        $res          = $leader_model->applyLeader($data);
         
        return $this->response($res);
    }
     /**
     * 修改团长地址
     */
    public function updateLeader()
    {
        $data = [
                    'address'     => isset($this->params['address']) ? $this->params['address'] : '',
                ];
                if(empty($data['address'])){
                    return $this->response($this->error('参数异常'));
                }
                
            $cl_id = input('cl_id','');
            $re = model('community_leader')->update($data,[['cl_id','=',$cl_id]]);
            return $this->response($this->success($re));
    }
    
   

    /**
     * 团长等级
     */
    public function levelList()
    {
        $level_model = new CommunityLevel();
        $level_id = input('level_id','');
        $list        = $level_model->getCommunityLevelList(['level_id' => $level_id]);
        return $this->response($list);
    }

    /**
     * 团长信息
     */
    public function getLeaderInfo()
    {

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $leader_model = new Leader();
        $info         = $leader_model->getLeaderInfo([['member_id', '=', $this->member_id??30]]);
        //获取当前团长用户头像
        $headimg = model('member')->getInfo([['self_cl_id','=',$info['data']['cl_id']]],'headimg');
        $info['data']['apply_time'] = date('Y-m-d H:i:s',$info['data']['apply_time']);
        $info['data']['audit_time'] = date('Y-m-d H:i:s',$info['data']['audit_time']);
        $info['data']['headimg'] = $headimg['headimg'];
        
        $info['data']['commission_amount'] = $info['data']['commission_total'] + $info['data']['account_withdraw'] ;
        
        return $this->response($info);
    }

    /**
     * 团长详细信息
     */
    public function getLeaderDetail()
    {

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        
        
        $leader_model = new Leader();
        $info         = $leader_model->getLeaderInfo([['member_id', '=', $this->member_id]]);
       
        if (empty($info['data'])){
            $data ['status_info']= [
                'status' => -1,
                'name'=>'还未申请团长',
                
                ];
            
            return $this->response($this->success($data));
        } 
        $token['data']['member_id'] = 30;
        $member_model                           = new MemberModel();
        $member_info                            = $member_model->getMemberInfo([['member_id', '=', $token['data']['member_id']]], 'balance_withdraw_apply, balance_withdraw,balance,balance_money');
        $info['data']['balance_withdraw_apply'] = $member_info['data']['balance_withdraw_apply'];
        $info['data']['balance_withdraw']       = $member_info['data']['balance_withdraw'];
        $info['data']['balance']                = $member_info['data']['balance'];
        $info['data']['balance_money']          = $member_info['data']['balance_money'];
        $headimg = model('member')->getInfo([['self_cl_id','=',$info['data']['cl_id']]],'headimg');
        $info['data']['apply_time'] = date('Y-m-d H:i:s',$info['data']['apply_time']);
        $info['data']['audit_time'] = date('Y-m-d H:i:s',$info['data']['audit_time']);
        $info['data']['headimg'] = $headimg['headimg'];
        
        $info['data']['commission_amount'] = $info['data']['commission_total'] + $info['data']['account_withdraw'] ;
        
        //总订单
        $order_model = new Order();
        //粉丝数
        $info['data']['team_count'] = $member_model->getMemberCount([['cl_id', '=', $info['data']['cl_id']]]);
        
        //今日
        $today_start_time                = strtotime(date('Y-m-d 00:00:00', time()));
        $today_end_time                  = time();
        $info['data']['day_order_count'] = $order_model->getOrderCount([
            ['cl_id', '=', $info['data']['cl_id']],
            ['order_status', '<>', -1],
            ['create_time', 'between', [$today_start_time, $today_end_time]]
        ])['data'];
        
        //售后
        $info['data']['refund_order_count'] = $order_model->getRefundOrderCount([
            ['o.cl_id', '=', $info['data']['cl_id']],
            ['og.refund_status', 'not in', '0,3']
        ])['data'];

        $config_model = new CommunityConfig();
        $li = $config_model->getConfig($this->site_id)['data'];
        $info['data']['config_desc'] = $li['value'];
       
        return $this->response($info);
    }

    /**
     * 设置休息
     */
    public function setRestStatus()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $rest_status = $this->params['rest_status'] ?? '';

        $leader_model = new Leader();
        $res          = $leader_model->setLeaderRest(0, $this->member_id??15, $rest_status, 'member_id');
        return $this->response($res);
    }


    /**
     * 团长基础配置
     * @return false|string
     */
    public function config()
    {
        $config_model = new CommunityConfig();
        $res          = $config_model->getConfig($this->site_id??0);
        return $this->response($res);
    }

    /**
     * 团长注册协议配置
     * @return false|string
     */
    public function settledAgreement()
    {
        $config_model = new CommunityConfig();
        $res          = $config_model->getSettledAgreement($this->site_id??0);
        
        return $this->response($res);
    }

    /**
     * 列表信息
     */
    public function leaderPage()
    {

        $latitude  = isset($this->params['latitude']) ? $this->params['latitude'] : null; // 纬度
        $longitude = isset($this->params['longitude']) ? $this->params['longitude'] : null; // 经度

        $community_config   = new CommunityConfig();
        $community_distance = $config = $community_config->getConfig(0)['data']['value']['community_distance'];

        $leader_model = new Leader();
        $condition    = [
            ['status', '=', 1],
            ['rest_status', '=', 0],
        ];

        $latlng      = array(
            'lat' => $latitude,
            'lng' => $longitude,
        );
        $field       = '*';
        $list_result = $leader_model->getLocationLeaderList($condition, $field, $latlng, $community_distance);

        $list = $list_result['data'];

        if (!empty($longitude) && !empty($latitude) && !empty($list)) {
            foreach ($list as $k => &$item) {
                if ($item['longitude'] && $item['latitude']) {
                    $distance             = getDistance((float)$item['longitude'], (float)$item['latitude'], (float)$longitude, (float)$latitude);
                   
                    $list[$k]['distance'] = $distance / 1000;
                } else {
                    $list[$k]['distance'] = 0;
                }
                $headimg = model('member')->getInfo([['self_cl_id','=','cl_id']],'headimg');
                // 按距离就近排序
                array_multisort(array_column($list, 'distance'), SORT_ASC, $list);
                $item['headimg'] = $headimg['headimg'] ;
            }
            
             
        }
       
        $default_cl_id = 0;
        if (!empty($list)) {

            $token = $this->checkToken();
            if (!$token['code'] < 0) {
                $member_model  = new MemberModel();
                $default_cl_id = $member_model->getMemberInfo(['member_id' => $token['data']['member_id']], 'cl_id')['cl_id'];
            }
        }
        return $this->response($this->success(['list' => $list, 'cl_id' => $default_cl_id]));
    }

    /*
     * 配置信息
     */
    public function account()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        if (request()->isPost()) {
            $page      = input('page', 0);
            $size      = input('size', 0);
            $community = model('community_leader')->getInfo([['member_id', '=', $this->member_id]], 'cl_id');
            $model     = new CommunityAccount();
            $condition = [['cl_id', '=', $community['cl_id']], ['site_id', '=', $this->site_id]];
            $result    = $model->getCommunityAccountPageList($condition, $page, $size, 'create_time desc', '*');
            return $this->response($result);
        }
    }

    /**
     * 团长海报
     * @return \app\api\controller\false|string
     */
    public function poster()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $qrcode_param['source_member'] = $token['data']['member_id'];

        $poster = new Poster();
        $res    = $poster->recommendQc($this->params['app_type'], $this->params['page'], $token['data']['member_id'], $this->site_id);

        return $this->response($res);
    }

    /**
     * 设置会员的默认社区
     */
    public function updateMemberCommunity()
    {

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $cl_id         = isset($this->params['cl_id']) ? $this->params['cl_id'] : 0; // 社区id
        $source_member = isset($this->params['source_member']) ? $this->params['source_member'] : 0; // 社区id

        if (!empty($source_member) && $cl_id == 0) {
            $leader_model = new Leader();
            $cl_id        = $leader_model->getLeaderInfo([['member_id', '=', $source_member], ['status', '=', 1]], 'cl_id');
            $cl_id        = !empty($cl_id) ? $cl_id['data']['cl_id'] : 0;
        }
        $member_model = new MemberModel();
        $res          = $member_model->editMember(['cl_id' => $cl_id], [['member_id', '=', $token['data']['member_id']]]);
        $res['data']  = array('cl_id' => $cl_id);
        return $this->response($res);
    }

    /**
     * 获取会员所属社区
     */
    public function getMemberCommunity()
    {

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        /*$token['data']['member_id'] = 1;*/
        $latitude  = isset($this->params['latitude']) ? $this->params['latitude'] : null; // 纬度
        $longitude = isset($this->params['longitude']) ? $this->params['longitude'] : null; // 经度
        
        $member_model = new MemberModel();
        $cl_id        = $member_model->getMemberInfo([['member_id', '=', $token['data']['member_id']]], 'cl_id');
       
        if (empty($cl_id['data']['cl_id'])) {
            return $this->response($this->error("", "当前会员无绑定团长!"));
        } else {

            $leader_model = new Leader();
            $leader_info  = $leader_model->getLeaderInfo(['cl_id' => $cl_id['data']['cl_id']], '*');
            
            //粉丝数
            $leader_info['data']['team_count'] = $member_model->getMemberCount([['cl_id', '=', $leader_info['data']['cl_id']]]);
            

            $distance                        = getDistance((float)$leader_info['data']['longitude'], (float)$leader_info['data']['latitude'], (float)$longitude, (float)$latitude);
            $leader_info['data']['distance'] = $distance / 1000;
            
            $goods_num = model('commander_order')->getList([['cl_id','=',$cl_id['data']['cl_id']]],'sum(goods_num) as goods_num','','','','member_id');
            
            
            $file = 'o.member_id,m.headimg';
                $alias = 'o';
                $join = [
                [ 'member m', 'm.member_id = o.member_id', 'inner' ]];
                 
            
            $li = model('commander_order')->getList([['o.cl_id','=',$cl_id['data']['cl_id']]],$file,'',$alias,$join,'member_id');
            $num = count($li);
            /*$num = model('commander_order')->getList([['cl_id','=',$cl_id['data']['cl_id']]],'count(member_id) as num,sum(goods_num) as goods_num','','','','member_id');*/
            $add = model('commander_order')->getFirstData([['cl_id','=',$cl_id['data']['cl_id']]],'member_id,create_time','create_time  desc');
            
             //多久前
             
             $time = $this->timeFormat($add['create_time']);
             
             $img = model('member')->getInfo([['member_id','=',$add['member_id']]],'headimg');
            $leader_info['data']['num'] = $num;
            if (empty($goods_num)) {
               $leader_info['data']['goods_num'] =0;
            }else{
                $leader_info['data']['goods_num'] = $goods_num[0]['goods_num'];
            }
            
            $leader_info['data']['time'] = $time;
            $leader_info['data']['mem_list'] = array_slice($li,0,10);
            $leader_info['data']['headimg'] = $cl_id        = model('member')->getInfo([['self_cl_id', '=',$cl_id['data']['cl_id'] ]], 'headimg')['headimg'];
            $leader_info['data']['new_headimg'] = $img['headimg'];
            
            return $this->response($leader_info);
        }
    }
    
        /**
     * 获取当前团长下的所有订单列表信息
     */
    public function orderLists()
    {
        /*$token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);*/
        $order_common_model = new OrderCommonModel();
        $condition = array (
            [ "a.cl_id", "=", input('cl_id','')],
        );
        $order_status = isset($this->params[ 'order_status' ]) ? $this->params[ 'order_status' ] : 'all';
        
        $start_time = input("start_time", '');
        $end_time = input("end_time", '');
        $mobile = input('mobile','');
        switch ( $order_status ) {
            case "waitpay"://待付款
                $condition[] = [ "a.order_status", "=", 0 ];
                break;
            case "waitsend"://待发货
                $condition[] = [ "a.order_status", "=", 1 ];
                break;
            case "waitrate"://待提货
                $condition[] = [ "a.order_status", "=", 2 ];
                break;
            case "waitconfirm"://待收货
                $condition[] = [ "a.order_status", "=", 3 ];
                break;
            case "waitalready"://订单已提货
                $condition[] = [ "a.order_status", "=", 4 ];
                break;
            case "waitclose"://订单已关闭
                $condition[] = [ "a.order_status", "=",-1 ];
                break;
            case "waitclearing"://订单已结算
                $condition[] = [ "a.order_status", "=",-1 ];
                break;
           /* case "waitrate"://待评价
                $condition[] = [ "order_status", "in", [ 4, 10 ] ];
                $condition[] = [ "is_evaluate", "=", 1 ];
                break;
            case "waitrate"://待提货
                $condition[] = [ "order_status", "=", 2 ];*/
               
               /* break;*/
        }
            
           if (!empty($start_time) && empty($end_time)) {
                $condition[] = [ "a.create_time", ">=", date_to_time($start_time) ];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = [ "a.create_time", "<=", date_to_time($end_time) ];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = [ 'a.create_time', 'between', [ date_to_time($start_time), date_to_time($end_time) ] ];
            }
            
            if (!empty($mobile)){
                 $condition[] = [ "a.mobile", "=", $mobile ];
            }
//		if (c !== "all") {
//			$condition[] = [ "order_status", "=", $order_status ];
//		}
        $page_index = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        $res = $order_common_model->getOrderPageList($condition, $page_index, $page_size, "create_time desc");
        $lisr = [];
        foreach ($res['data']['list'] as $k=> &$v){
            $id = model('verify')->getInfo([['verify_code','=',$v['delivery_code']]],'id');
            $v['member_info'] = model('member')->getInfo([['member_id','=',$v['member_id']]]);
            $v['virtual_code'] = $id['id'];
        }
        return $this->response($res);
    }
    
    
    
/*    public  function adddd()
    {
        $order             = new OrderCommonModel();
        var_dump($order->order_status[2]);die;
    }*/
    /**
     * 利润概况
     */
        public function general()
    {
        $cl_id = input('cl_id','');
        
        $page_index = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        
        $list = model('commander_order')->pageList([['cl_id','=',$cl_id]],' FROM_UNIXTIME(create_time,"%Y%m%d") as time,count(*)as num,sum(order_money) as order_money,sum(commission) as commission','create_time desc',$page_index,$page_size,'','','FROM_UNIXTIME(create_time,"%Y%m%d")');
        $data = [];
        foreach ($list['list'] as $kl => $v) {
                $add = model('commander_order')->getList([['cl_id','=',$cl_id],['order_status','=',10],['create_time','between',[strtotime($v['time']),strtotime($v['time']+1)]]],'sum(commission) as commis');
               
                $data[$kl] = $v;
                $data[$kl]['commis'] = $add[0]['commis'];
        }
       
        return $this->response($this->success($data));
    }
    /**
     * 利润明细
     */
     public function subsidiarity()
     {

         $cl_id = input('cl_id','');
         $start_time = input('start_time','');
         $page_index = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
         if (empty($cl_id)) {
             return $this->response($this->error("", "团长id不能为空!"));
         }
         
         $condition[] = [ "cl_id", "=", $cl_id ];
            if (!empty($start_time) && $start_time == 1) {
                $condition[] = [ "create_time", "between", [strtotime(date('Ymd',time())),strtotime(date('Ymd',time()))+86400]];
            } elseif (!empty($start_time) && $start_time == 2) {
                
                $condition[] = [ "create_time", "between", [mktime(0,0,0,date('m'),1,date('y')),mktime(23,59,59,date('m'),date('t'),date('y'))]] ;
            } 
            
           
            $list = model('commander_order')->pageList($condition,'create_time,order_money,name,order_status','create_time desc',$page_index,$page_size);
            
            $commission = model('commander_order')->getList($condition,'sum(commission) as commission');
            $condition[] = ['order_status','=',4];
            $commis = model('commander_order')->getList($condition,'sum(commission) as commis');
            
           $list['commis'] = $commis[0]['commis'];
          
            $list['commission'] = $commission[0]['commission'];
            
            return $this->response($this->success($list));
     }
     
     
    public function timeFormat($timeInt,$format='Y-m-d H:i:s'){

            if(empty($timeInt)||!is_numeric($timeInt)||!$timeInt){
            
            return '';
            
            }

            $d=time()-$timeInt;
            
            if($d<0){
            
                return '';
                
                }else{
                
                if($d<60){
                
                return $d.'秒前';
                
                }else{
            
                    if($d<3600){
                    
                    return floor($d/60).'分钟前';
                    
                    }else{
                            
                            if($d<86400){
                            
                            return floor($d/3600).'小时前';
                            
                            }else{
                                    return '1天前';
                                   
            
                            }
            
                        }
            
                    }
            
                 }
            
            }
    
    
    /***
     * 
     * 团长删除对应商品
     */
    public function goodsDelete()
    {
        $cl_id = input('cl_id','');
        $goods_id = input('goods_id','');
        if(empty($cl_id) || empty($goods_id)){
            return $this->response($this->error("", "参数异常!"));
        }
        model('community_add')->delete([['leader_id','=',$cl_id],['goods_id','=',$goods_id]]);
        return $this->response($this->success('删除成功'));
    }
    
}
