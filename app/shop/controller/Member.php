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

namespace app\shop\controller;


use app\model\shop\ShopMember;
use app\model\order\OrderCommon;

/**
 * 店铺会员
 * @package app\shop\controller
 */
class Member extends BaseShop
{
    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     * 会员概况
     */
    public function index()
    {
        $member = new ShopMember();

        // 累计会员数
        $total_count = $member->getMemberCount([ [ 'nsm.site_id', '=', $this->site_id ] ]);
        // 今日新增数
        $newadd_count = $member->getMemberCount([ [ 'nsm.site_id', '=', $this->site_id ], [ 'nsm.create_time', 'between', [ date_to_time(date('Y-m-d 00:00:00')), time() ] ] ]);
        // 累计关注数
        $subscribe_count = $member->getMemberCount([ [ 'nsm.site_id', '=', $this->site_id ], [ 'nsm.is_subscribe', '=', 1 ] ]);
        // 已购会员数
        $buyed_count = $member->getPurchasedMemberCount($this->site_id);

        $this->assign('data', [
            'total_count' => $total_count[ 'data' ],
            'newadd_count' => $newadd_count[ 'data' ],
            'subscribe_count' => $subscribe_count[ 'data' ],
            'buyed_count' => $buyed_count[ 'data' ]
        ]);

        return $this->fetch("member/index");
    }

    /**
     * 获取区域会员数量
     */
    public function areaCount()
    {
        if (request()->isAjax()) {
            $member = new ShopMember();
            $handle = input('handle', false);
            $res = $member->getMemberCountByArea($this->site_id, $handle);
            return $res;
        }
    }

    /**
     * 店铺会员列表
     */
    public function lists()
    {
        $member = new ShopMember();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $search_text_type = input('search_text_type', 'nickname');
            $start_date = input('start_date', '');
            $end_date = input('end_date', '');

            $condition = [
                [ 'nsm.site_id', '=', $this->site_id ]
            ];
            $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
            // 关注时间
            if ($start_date != '' && $end_date != '') {
                $condition[] = [ 'nsm.subscribe_time', 'between', [ strtotime($start_date), strtotime($end_date) ] ];
            } else if ($start_date != '' && $end_date == '') {
                $condition[] = [ 'nsm.subscribe_time', '>=', strtotime($start_date) ];
            } else if ($start_date == '' && $end_date != '') {
                $condition[] = [ 'nsm.subscribe_time', '<=', strtotime($end_date) ];
            }
            $list = $member->getShopMemberPageList($condition, $page_index, $page_size, 'nsm.subscribe_time desc');
            return $list;
        } else {
            return $this->fetch("member/lists");
        }
    }

    /**
     * 会员详情
     */
    public function detail()
    {
        $member_id = input('member_id', 0);


        $member = new ShopMember();
        $condition = [
            [ 'nsm.member_id', '=', $member_id ],
            [ 'nsm.site_id', '=', $this->site_id ],
            [ 'nm.is_delete', '=', 0 ]
        ];
        $join = [
            [
                'member nm',
                'nsm.member_id = nm.member_id',
                'inner'
            ],
        ];
        $field = 'nm.member_id, nm.source_member, nm.username, nm.nickname, nm.mobile, nm.email, nm.headimg, nm.status, nsm.subscribe_time, nsm.site_id, nsm.is_subscribe';
        $info = $member->getMemberInfo($condition, $field, 'nsm', $join);
        if ($info[ 'code' ] < 0) $this->error($info[ 'message' ]);
        $this->assign('info', $info[ 'data' ]);
        return $this->fetch("member/detail");
    }

    /**
     * 获取会员订单列表
     */
    public function orderList()
    {
        if (request()->isAjax()) {
            $member_id = input('member_id', 0);
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);

            $condition = [
                [ 'member_id', '=', $member_id ],
                [ 'site_id', '=', $this->site_id ]
            ];

            $field = 'order_id,order_no,order_name,order_money,pay_money,balance_money,order_type_name,order_status_name,create_time';
            $order = new OrderCommon();
            $list = $order->getMemberOrderPageList($condition, $page_index, $page_size, 'order_id desc', $field);
            return $list;
        }
    }
    
    public function operational()
    {
        if (request()->isAjax()) {
            $member_id = input('member_id', 0);
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);
            $mobile = input('search_text','');
            //查出对应的member_id
            $member = model('shop')->getInfo([[ 'site_id', '=', $this->site_id ]],'member_id');
            
             $condition = [
                
                [ 'counterpart_id', '=', $member['member_id'] ]
            ];
            if (!empty($mobile)) {
                $condition[] = ['moblile','=',$mobile];
            }
             $list = model('customer_operational')->PageList($condition,'','',$page_index,$page_size);

            return success(0,'操作成功',$list);
        }

        return $this->fetch("member/operational");
    }
    
    public function operationalAdd()
    {
        if (request()->isAjax()) {
            $member_id = input('member_id', 0);
            $name = input('weixin_settlement_bank_account_name', 1);
            $mobile = input('search_text', '');
            $is_type = input('is_type', 0);
            
           $res = model('customer_operational')->getInfo([['member_id','=',$member_id],['counterpart_id','=',$this->site_id]],'name');
           
           if (!empty($res)) {
               return error(-10001,'请勿重复添加');
           }
          $member = model('user')->getInfo([[ 'site_id', '=', $this->site_id ]],'member_id');
            $data = [
                    'member_id'=>$member_id,
                    'moblile'=>$mobile,
                    'name'=>$name,
                    'is_type'=>$is_type,
                    'counterpart_id'=>$member['member_id'],
                ];
            $re = model('customer_operational')->add($data);    
           return success();
        }
        /*$list = model('customer_operational')->PageList([['site_id','=',$this->site_id]]);
        $this->assign('list', $list);*/
        return $this->fetch("member/operational_add");
    }
    
    
    
/*    public function operedit()
    {
        $id = input('id','');
        if (empty($id)) {
           return error(0,'参数错误');
        }
        model('customer_operational')->delete([['id','=',$id]]);
        return success();
    }*/
    
    public function operdel()
    {
        $id = input('id','');
        if (empty($id)) {
           return error(0,'参数错误');
        }
        model('customer_operational')->delete([['id','=',$id]]);
        return success('','删除成功');
    }
    
    public function customerlist()
    {
        if (request()->isAjax()) {
            
            $site_id = $this->site_id ;
            $member = model('shop')->getInfo([['site_id','=',$site_id]],'member_id');
            $member_id = $member['member_id'];
           
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);
            $mobile = input('search_text','');
             
            $condition[] = ['member_id','=',$member_id];
            $mobile = input('search_text','');
            if (!empty($mobile)) {
                $condition[] = [ 'mobile', '=', $mobile ] ;
            }
             
             $list = model('customer')->PageList($condition,'','',$page_index,$page_size);
            
            return success(0,'操作成功',$list);
        }
        return $this->fetch("member/customerlist");
    }
    
    public function tixingAdd()
    {
        if (request()->isAjax()) {
            $goodsAttrFormat = input('goodsAttrFormat', 0);
           
            foreach($goodsAttrFormat as &$a){
                $a['attr_value_name'] = strtotime($a['attr_value_name']);
                $a['attr_name'] = implode(',',json_decode($goodsAttrFormat[0]['attr_name'],true));
                $a['customer_id'] = $a['id'];
                $a['attr_id'] = json_decode($goodsAttrFormat[0]['attr_id'],true);
                
                  unset($a['id']);
                  
                 $res = model('customer_ts')->add($a);
                
            }
            
           return success();
        }
        /*$list = model('customer_operational')->PageList([['site_id','=',$this->site_id]]);
        $this->assign('list', $list);*/
        $id = input('id','');
        if (!empty($id)) {
            $list = model('customer')->getInfo([['id','=',$id]]);
            
            $zhixing = explode(',',$list['personnel_id']);
            $r = [];
            $men = model('member')->getInfo([['mobile','=',$list['mobile']]],'member_id,nickname');
            foreach($zhixing as $v){
               $r[] = model('customer_operational')->getInfo([['id','=',$v]],'name,member_id');
            }
            
            $zhixing =$r;
            $zhixing[] = ['name'=>$men['nickname'],'member_id'=>$men['member_id']];
            
           
            $this->assign('brand_list',$zhixing);
            $this->assign('id',$id);
        }
        return $this->fetch("member/tixing_add");
    }
    public function tixingList()
    {
        if (request()->isAjax()) {
            $id = input('id', 0);
            
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);
            /*$mobile = input('search_text','');*/
             $condition = [
                
                [ 'customer_id', '=', $id ]
            ];
            /*if (!empty($mobile)) {
                $condition[] = ['moblile','=',$mobile];
            }*/
            
             $list = model('customer_ts')->PageList($condition,'','',$page_index,$page_size);
            
            return success(0,'操作成功',$list);
        }
        /*$list = model('customer_operational')->PageList([['site_id','=',$this->site_id]]);
        $this->assign('list', $list);*/
         $id = input('id', 0);
         $this->assign('id',$id);
        return $this->fetch("member/tixing_list");
    }
    
   public function tixingEdit()
    {
        if (request()->isAjax()) {
            $goodsAttrFormat = input('goodsAttrFormat', 0);
           
            foreach($goodsAttrFormat as &$a){
                
                $a['attr_value_name'] = strtotime($a['attr_value_name']);
                $a['attr_name'] = implode(',',json_decode($goodsAttrFormat[0]['attr_name'],true));
                
                $a['attr_id'] = json_decode($goodsAttrFormat[0]['attr_id'],true);
                
                
                /*$a['attr_value_name'] = strtotime($a['attr_value_name']);*/
              
                
                  
                 $res = model('customer_ts')->update($a,[['id','=',$a['id']]]);
                
            }
           return success();
        }
        /*$list = model('customer_operational')->PageList([['site_id','=',$this->site_id]]);
        $this->assign('list', $list);*/
        $id = input('id','');
        if (!empty($id)) {
            $ts = model('customer_ts')->getInfo([['id','=',$id]]);
            
            $list = model('customer')->getInfo([['id','=',$ts['customer_id']]]);
            $zhixing = explode(',',$list['personnel_id']);
            $r = [];
            $men = model('member')->getInfo([['mobile','=',$list['mobile']]],'member_id,nickname');
            foreach($zhixing as $v){
               $r[] = model('customer_operational')->getInfo([['id','=',$v]],'name,member_id');
            }
            
            $zhixing =$r;
            $zhixing[] = ['name'=>$men['nickname'],'member_id'=>$men['member_id']];
             
            $ts['attr_id'] = explode(',', $ts['attr_id'] );
            
            $this->assign('brand_list',$zhixing);
            $this->assign('ts',$ts);
           
          /*  $this->assign('id',$id);*/
        }
        return $this->fetch("member/tixing_edit");
    }
    
}