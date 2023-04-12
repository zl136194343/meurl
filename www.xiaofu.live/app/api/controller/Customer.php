<?php

namespace app\api\controller;
use app\model\system\Config as ConfigModel;
use \think\facade\Db;

class Customer extends BaseApi
{
    /**
     * 添加信息
     */
    public function getType()
    {
        $data = model('customer_type')->getList();
        
        return $this->response($this->success( $data));
    }
    //接收客户管理表单
     public function getadds()
    {
        
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $name = input('name','');
        if (empty($name)) {
            return $this->response($this->error( '','客户姓名必须填写'));
        }

        
        $data = [
            'name'=>input('name',''),
            'identity'=>input('identity',''),
            'mobile'=>input('mobile',''),
            'wedding_date'=>strtotime(input('wedding_date','')),
            'site'=>input('site',''),
            'personnel'=>input('personnel',''),
            'services_available'=>input('services_available',''),
            'earnest'=>input('earnest',''),
            'balance_payment'=>input('balance_payment',''),
            'create_time'=>time(),
            'member_id'=>$token['data']['member_id'],
            'imgs'=>input('chentImgList',''),
            "careful"=>input('careful',''),
            "personnel_id"=>input('personnel_id','')
            ];
            
            $data['personnel'] = json_decode($data['personnel'],true);
            $ids = array_column($data['personnel'],'id');
            $data['personnel_id'] = implode(',',$ids);
            $names = array_column($data['personnel'],'name');
            $data['personnel'] = implode(',',$names);
            
        
        $re = model('customer')->add($data);
        
        return $this->response($this->success('添加成功'));
    }
    
    //接收客户表单list
     public function getlist()
    {
        
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $page = $this->params[ 'page' ] ?? 1;
        $page_size = $this->params[ 'page_size' ] ?? PAGE_LIST_ROWS;
        $condition = [];
        $type = input('type')?input('type'):'all';
        $order = input('order')?input('order'):'create_time';
        $sort = input('sort')?input('sort'):'desc';
        /*$overtime = input('overtime')?input('overtime'):0;*/
       /* $sort = input('sort')??'desc';*/
        $executing = input('executing_state');
        if(empty($executing)  && $executing == ''){
            $executing = 'all';
        }
        
        $name = input('name')?input('name'):'';
        $member  = model('member')->getInfo([['member_id','=',$this->member_id??2365]],'member_level,expiration_time');
        $time = input('time')?input('time'):0;
        

/*        if($member['member_level'] == 1){
             $uid = model('user')->getInfo([['member_id','=',$this->member_id]],'uid');
             $audit_time = model('shop_apply')->getInfo([['uid','=',$uid['uid']]],'audit_time');
             if((time()-$audit_time) > (7*86400)){
                return $this->response($this->error([],'免费体验已到期,请购买后使用'));
             }
        }else{
            if(time()>$member['expiration_time']){
                return $this->response($this->error([],'会员已到期,请前往续费'));
             }
        }*/
        
       
        //获取当前用户会员等级
        
        
        if($type != 'all'){
          $condition[] = [ 'services_available', '=', $type ];
        }
        $sort = $this->params[ 'sort' ] ?? "desc"; //升序、降序
        
        /*if (!empty($overtime)) {
            $condition[] = [ 'wedding_date', '<', time() ];
        }*/
        if (!empty($time)) {
            $timestamp = strtotime( $time );
           
            $start_time = strtotime(date( 'Y-m-1 00:00:00', $timestamp ));
            $mdays = date( 't', $timestamp );
            $end_time = strtotime(date( 'Y-m-' . $mdays . ' 23:59:59', $timestamp ));
            $condition[] = [ 'wedding_date', '>=', $start_time ];
            $condition[] = [ 'wedding_date', '<=', $end_time ];
        }
        
        if (!empty($name)) {
            $condition[] = [ 'name|mobile', 'like', "%".$name.'%' ];
            /*$condition[] = [ 'mobile', 'like', "%".$name.'%' ];*/
        }
        
        if ($executing != 'all') {
            if($executing == 1){
                //未执行
                $condition[] = [ 'wedding_date', '>', time() ];
            }else{
                 //已执行
                $condition[] = [ 'wedding_date', '<', time() ];
            }
            
        }
        
        
        
        $condition[] = ['member_id','=',$token['data']['member_id']?? 2365] ;
        $order_by = $order . ' ' . $sort;
        
        $list = model('customer')->pageList($condition,'*',$order_by,$page,$page_size);
       
        foreach ($list['list'] as &$l){
            $l['type_name'] = model('customer_type')->getInfo([['id','=',$l['services_available']]]);
            
            $l['total_days'] = (strtotime(date("Y-m-d",$l['wedding_date'])) - strtotime(date("Y-m-d",$l['create_time'])))/86400;
            if ($l['total_days'] < 0) {
               $l['total_days'] = 0;
            }
            if (time() > $l['wedding_date']) {
                
                $l['pass_time'] = (strtotime(date("Y-m-d",$l['wedding_date']))-strtotime(date("Y-m-d",$l['create_time'])))/86400;
                
            }else{
                 $l['pass_time'] = (strtotime(date("Y-m-d",time())) - strtotime(date("Y-m-d",$l['create_time'])))/86400;
            }
            if ($l['pass_time'] < 0) {
               $l['pass_time'] = 0;
            }
           
            $l['remaining_days'] = (strtotime(date("Y-m-d",$l['wedding_date']))-strtotime(date("Y-m-d",time())))/86400;
            if ($l['remaining_days'] < 0) {
                $l['remaining_days'] = 0;
            }
            if (!empty($l['imgs'])) {
                $l['img_list'] = explode(',',$l['imgs']);
            }else{
                $l['img_list'] = [];
            }
            
            
            
            $l['personnel'] = model('customer_operational')->getList([['id','in',$l['personnel_id']]]);
            
        }
        
        return $this->response($this->success($list));
    }
       //接收客户表单list
     public function getlist2()
    {
        
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $page = $this->params[ 'page' ] ?? 1;
        $page_size = $this->params[ 'page_size' ] ?? PAGE_LIST_ROWS;
        $condition = [];
        $type = input('type')?input('type'):'all';
        $order = input('order')?input('order'):'create_time';
        $sort = input('sort')?input('sort'):'desc';
        /*$overtime = input('overtime')?input('overtime'):0;*/
       /* $sort = input('sort')??'desc';*/
        $executing = input('executing_state');
        if(empty($executing)  && $executing == ''){
            $executing = 'all';
        }
        
        $name = input('name')?input('name'):'';
        $member  = model('member')->getInfo([['member_id','=',$this->member_id??2365]],'member_level,expiration_time');
        $time = input('time')?input('time'):0;
        

/*        if($member['member_level'] == 1){
             $uid = model('user')->getInfo([['member_id','=',$this->member_id]],'uid');
             $audit_time = model('shop_apply')->getInfo([['uid','=',$uid['uid']]],'audit_time');
             if((time()-$audit_time) > (7*86400)){
                return $this->response($this->error([],'免费体验已到期,请购买后使用'));
             }
        }else{
            if(time()>$member['expiration_time']){
                return $this->response($this->error([],'会员已到期,请前往续费'));
             }
        }*/
        
       
        //获取当前用户会员等级
        
        
        if($type != 'all'){
          $condition[] = [ 'services_available', '=', $type ];
        }
        $sort = $this->params[ 'sort' ] ?? "desc"; //升序、降序
        
        /*if (!empty($overtime)) {
            $condition[] = [ 'wedding_date', '<', time() ];
        }*/
        if (!empty($time)) {
            $timestamp = strtotime( $time );
           
            $start_time = strtotime(date( 'Y-m-1 00:00:00', $timestamp ));
            $mdays = date( 't', $timestamp );
            $end_time = strtotime(date( 'Y-m-' . $mdays . ' 23:59:59', $timestamp ));
            $condition[] = [ 'wedding_date', '>=', $start_time ];
            $condition[] = [ 'wedding_date', '<=', $end_time ];
        }
        
        if (!empty($name)) {
            $condition[] = [ 'name|mobile', 'like', "%".$name.'%' ];
            /*$condition[] = [ 'mobile', 'like', "%".$name.'%' ];*/
        }
        
        if ($executing != 'all') {
            if($executing == 1){
                //未执行
                $condition[] = [ 'wedding_date', '>', time() ];
            }else{
                 //已执行
                $condition[] = [ 'wedding_date', '<', time() ];
            }
            
        }
        
        
        
        $condition[] = ['member_id','=',$token['data']['member_id']?? 2365] ;
        $order_by = $order . ' ' . $sort;
        
        $list = model('customer')->pageList($condition,'*',$order_by,$page,$page_size);
       
        foreach ($list['list'] as &$l){
            $l['type_name'] = model('customer_type')->getInfo([['id','=',$l['services_available']]]);
            
            $l['total_days'] = (strtotime(date("Y-m-d",$l['wedding_date'])) - strtotime(date("Y-m-d",$l['create_time'])))/86400;
            if ($l['total_days'] < 0) {
               $l['total_days'] = 0;
            }
            if (time() > $l['wedding_date']) {
                
                $l['pass_time'] = (strtotime(date("Y-m-d",$l['wedding_date']))-strtotime(date("Y-m-d",$l['create_time'])))/86400;
                
            }else{
                 $l['pass_time'] = (strtotime(date("Y-m-d",time())) - strtotime(date("Y-m-d",$l['create_time'])))/86400;
            }
            if ($l['pass_time'] < 0) {
               $l['pass_time'] = 0;
            }
           
            $l['remaining_days'] = (strtotime(date("Y-m-d",$l['wedding_date']))-strtotime(date("Y-m-d",time())))/86400;
            if ($l['remaining_days'] < 0) {
                $l['remaining_days'] = 0;
            }
            if (!empty($l['imgs'])) {
                $l['img_list'] = explode(',',$l['imgs']);
            }else{
                $l['img_list'] = [];
            }
            
            
            
            $l['personnel'] = model('customer_operational')->getList([['id','in',$l['personnel_id']]]);
            
        }
        
        return $this->response($this->success($list));
    }
    
    //获取客户表单信息
    public function getbyInfo()
    {
        
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $id =input('id','') ;
        if (empty($id)) {
           return $this->response($this->error( '','参数错误'));
        }
        
        $condition = [['id','=',$id]];
        
        

        $list = model('customer')->getInfo($condition);
        $list['personnel'] = explode(',',$list['personnel']);
        $list['type_name'] = model('customer_type')->getInfo([['id','=',$list['services_available']]]);
        
         $l = [];
        foreach($list['personnel'] as$k => $li){
            $l[$k] = ['name'=>$li];
        }
        if ($list['imgs'] != '') {
            $list['img_list'] = explode(',',$list['imgs']);
        }else{
            $list['img_list'] = [];
        }
        
        $list['personnel'] = $l;
        return $this->response($this->success($list));
    }
    
    //接收客户表单修改信息
    public function getEdit()
    {
        
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
         
        $name = input('name','');
        $identity = input('identity','');
        $mobile = input('mobile','');
        $wedding_date = input('wedding_date','');
        $site = input('site','');
        $personnel = input('personnel','');
        $services_available = input('services_available','');
        $earnest = input('earnest','');
        $balance_payment = input('balance_payment','');
         $id = input('id','');
         $imgs = input('chentImgList','');
         $personnel_id = input('personnel_id','');
        /* $data =  [];*/
         $data = model('customer')->getInfo([['id','=',$id]]);
         $careful = input('careful','');
        if (!empty($name)) {
            $data['name'] = $name;
        }
        if (!empty($personnel_id)) {
            $data['personnel_id'] = $personnel_id;
        }
        if (!empty($identity)) {
            $data['identity'] = $identity;
        }
        if (!empty($mobile)) {
            $data['mobile'] = $mobile;
        }
        if (!empty($wedding_date)) {
            $data['wedding_date'] = strtotime($wedding_date);
        }
        if (!empty($site)) {
            $data['site'] = $site;
        }
        
        if (!empty($personnel)) {
            $data['personnel'] = json_decode($personnel,true);
            $ids = array_column($data['personnel'],'id');
            $data['personnel_id'] = implode(',',$ids);
            $names = array_column($data['personnel'],'name');
            $data['personnel'] = implode(',',$names);
        }
       
        if (!empty($services_available)) {
            $data['services_available'] = $services_available;
        }
        if (!empty($earnest)) {
            $data['earnest'] = $earnest;
        }
        if (!empty($balance_payment)) {
            $data['balance_payment'] = $balance_payment;
        }
        /*if (!empty($imgs)) {
           
        }*/
       /* if (!empty($careful)) {
            
        }*/
        $data['imgs'] = $imgs;
        $data['careful'] = $careful;
/*        $data = [
            'name'=>input('name',''),
            'identity'=>input('identity',''),
            'mobile'=>input('mobile',''),
            'wedding_date'=>input('wedding_date',''),
            'site'=>input('site ',''),
            'personnel'=>input('personnel',''),
            'services_available'=>input('services_available',''),
            'earnest'=>input('earnest',''),
            'balance_payment'=>input('balance_payment',''),
            'create_time'=>time(),
            'member_id'=>$token['data']['member_id']
            ];*/
       
        $re = model('customer')->update($data,[['id','=',$id]]);
        /*unset($data['id']);
        model('customer')->add($data);*/
        return $this->response($this->success('修改成功'));
    }
     //删除客户表单信息
    public function kfdelete()
    {
        
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $id =input('id','') ;
        if (empty($id)) {
           return $this->response($this->error( '','参数错误'));
        }
        $condition = [['id','=',$id],['member_id','=',$this->member_id??241]];
        $list = model('customer')->delete($condition);
        if ($list == 0) {
           return $this->response($this->error());
        }
        return $this->response($this->success($list));
    }
    
    //修改是否是否进行推送
    public function setPush()
    {
         $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
         $id =input('id','') ;
         $status = input('status');
         $re = model('customer')->update(['is_push'=>$status],[['id','=',$id],['member_id','=',$this->member_id]]);
         return $this->response($this->success($re));
    }
    
    public function getoperational()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        //获取当前用户对应商户下的所添加的执行人员
        /*$site = model('user')->getInfo([['member_id','=',$this->member_id??252],['app_module','=','shop']],'site_id');*/
        /*dump($site);die;*/
        /*$site_id = model('shop_apply')->getInfo([['uid','=',$site['uid']]],'site_id');*/
        $list = model('customer_operational')->getList([['counterpart_id','=',$this->member_id??2365]]);
        if (empty($list)) {
            return $this->response($this->error([],'请先添加执行人员'));
        }
        return $this->response($this->success($list));
    }
    
    public function getCongif()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $member_id = $this->member_id??2075;
        
        if(is_file('test'.$member_id.'.txt')){
            $data = file_get_contents('test'.$member_id.'.txt');
            $data = json_decode($data,true);
        }else{
            $data = [];
        }
        
        $type = input('type');
        $re  = [
                'type'=>$type,
                'time'=>date('Y-m-d H:i:s',time())
            ];
        $data[] = $re;
        
        file_put_contents('test'.$member_id.'.txt',json_encode($data));
    }
    
    //获取设置的浏览商品链接
    public function getResign()
    {
         $token = $this->checkToken();
         if ($token[ 'code' ] < 0) return $this->response($token);
         $config = new ConfigModel();
             $res = $config->getConfig([ [ 'site_id', '=', 0 ], [ 'app_module', '=', 'admin' ], [ 'config_key', '=', 'GOODS_MEMBERSIGNIN_CONFIG' ] ]);
             $src = 'pages/order/goodsdetail/goodsdetail?sku_id='.$res['data']['value']['goods_id'];
             return $this->response($this->success(['src'=>$src]));
    }
    //小程序端推送人
    public function gettxs()
    {
         $token = $this->checkToken();
         if ($token[ 'code' ] < 0) return $this->response($token);
             $id = input('id', '');//项目id
            //  $attr_value_name = input('attr_title', '');//推送标题
             $list = model('customer')->getInfo([['id','=',$id]]);
            
             $zhixing = explode(',',$list['personnel_id']);
              
                $r = [];
             $men = model('member')->getInfo([['mobile','=',$list['mobile']]],'member_id,nickname');
            
                foreach($zhixing as $v){
                    $s= model('customer_operational')->getInfo([['id','=',$v]],'name,member_id');
                   if(!empty($s)){
                       $r[] = $s;
                   }
                }
                 if(!empty($s)){
                        $zhixing =$r;
                   }else{
                        $zhixing =[];
                   }
               
                if (!empty($men)) {
                     
                    $zhixing[] = ['name'=>$list['name'],'member_id'=>$men['member_id']];
                }
                
                /*$customer_id = input('customer_id', '');*/
             return $this->response($this->success($zhixing));
    }
    
    //小程序端新增客户提醒
    public function gettixing()
    {
         $token = $this->checkToken();
         if ($token[ 'code' ] < 0) return $this->response($token);
             $data['attr_name'] = input('attr_name', '');//推行人姓名
             $data['attr_value_name'] = strtotime(input('attr_value_name', ''));//推送时间
             $data['attr_title'] = input('attr_title', '');//推送标题
             $data['reamk'] = input('reamk', '');//推送备注
             $data['attr_id'] = input('attr_id', '');//推送备注
             $data['customer_id'] = input('customer_id', '');
             
            $data['attr_name'] = json_decode($data['attr_name'],true);
            $ids = array_column($data['attr_name'],'member_id');
            $data['attr_id'] = implode(',',$ids);
            $names = array_column($data['attr_name'],'name');
            $data['attr_name'] = implode(',',$names);
            
/*            $ids = array_column($data['personnel'],'id');*/

             $res = model('customer_ts')->add($data);
             return $this->response($this->success());
    }
    
    //小程序端获取对应提醒列表
    public function gettixinglist()
    {
         $token = $this->checkToken();
         if ($token[ 'code' ] < 0) return $this->response($token);
             
             $id = input('id', '');
            
            
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);
            /*$mobile = input('search_text','');*/
             $condition = [
                
                [ 'customer_id', '=', $id ]
            ];
            /*if (!empty($mobile)) {
                $condition[] = ['moblile','=',$mobile];
            }*/
            
             $customer = model('customer')->getInfo([ ['id','=',$id]]);
             $member_id = model('member')->getInfo([ ['mobile','=',$customer['mobile']]],'member_id');
             $list = model('customer_ts')->PageList($condition,'','',$page_index,$page_size);
             /*dump($list);die;*/
             
             foreach ($list['list'] as &$l) {
                $join = [ ['customer_operational c','a.member_id = c.member_id','left']];
                $attr_id = explode(',',$l['attr_id']);
                 $key = array_search($member_id['member_id'], $attr_id);
                 
                if ($key !== false)
                array_splice($attr_id, $key, 1);
                $l['name'] = model('member')->getList([['a.member_id','in',$attr_id],['c.counterpart_id','=',$this->member_id??2387]],'a.member_id,c.name','','a',$join);
               
                
                
                    if ($key !== false) {
                        $l['name'][] = ['name'=>$customer['name'],'member_id'=>$member_id['member_id']];
                   
                }

                if($l['is_type'] == 1){
                    $tx_cy = model('customer_tscy')->getList([['ts_id','=',$l['id']],['is_type','=',1]],'ts_name');
                    
                    if (!empty($tx_cy)) {
                        $name = array_column($tx_cy,'ts_name');
                        
                        $name = implode(',',$name);
                        $l['ycy'] = $name;
                    }else{
                         $l['ycy'] = '';
                    }
                    
                }else{
                    $l['ycy'] ='';
                }
                
                
            }
            
             return $this->response($this->success($list));
    }
    
     public function gettixinginfo()
    {
         $token = $this->checkToken();
         if ($token[ 'code' ] < 0) return $this->response($token);
             
             $ts_id = input('ts_id', '');

             $list = model('customer_ts')->getInfo([['id','=',$ts_id]]);
            
            return $this->response($this->success($list));
    }
    public function gettixingedit()
    {
         $token = $this->checkToken();
         if ($token[ 'code' ] < 0) return $this->response($token);
             
             $ts_id = input('id', '');
             $attr_name= input('attr_name', '');//推行人姓名
            $attr_value_name= input('attr_value_name', '');//推送时间
            $attr_title= input('attr_title', '');//推送标题
             $reamk= input('reamk', '');//推送备注
             $attr_id = input('attr_id', '');//推送id
             $customer_id= input('customer_id', '');
             $data = [];
             if (!empty($attr_name)) {
                $data['attr_name'] = json_decode($attr_name,true);
                $ids = array_column($data['attr_name'],'member_id');
                $data['attr_id'] = implode(',',$ids);
                $names = array_column($data['attr_name'],'name');
                $data['attr_name'] = implode(',',$names);
             }
             if (!empty($attr_value_name)) {
                 $data['attr_value_name'] = strtotime($attr_value_name);
             }
             if (!empty($attr_title)) {
                 $data['attr_title'] = $attr_title;
             }
             if (!empty($reamk)) {
                 $data['reamk'] = $reamk;
             }
             if (!empty($attr_id)) {
                 $data['attr_id'] = $attr_id;
             }
             
 
             $list = model('customer_ts')->update($data,[['id','=',$ts_id]]);
             
            return $this->response($this->success($list));
    }
    //执行人列表
    public function getoperationallist()
    {
//         $token = $this->checkToken();
//         if ($token[ 'code' ] < 0) return $this->response($token);
            $page_index = input('page', 1);
            $page_size = input('limit', PAGE_LIST_ROWS);
            $mobile = input('mobile', '');
            $site_id = input('site_id', '');
            $condition = [
                
                [ 'site_id', '=', $site_id??1 ]
            ];
             $list = model('customer_operational')->PageList($condition,'','',$page_index,$page_size);
             return $this->response($this->success($list));
    }
    
    //新增执行人
    public function operationalAdd()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $member_id = input('member_id', 0);
        $name = input('member_name', 1);
        $mobile = input('moblile', '');
        $is_type = input('is_type', 0);
       $res = model('customer_operational')->getInfo([['member_id','=',$member_id],['counterpart_id','=',$this->member_id]],'name');
       
       if (!empty($res)) {
           return $this->response($this->error('请勿重复添加'));
       }
      /*$member = model('shop')->getInfo([[ 'site_id', '=', $this->site_id ]],'member_id');*/
        $data = [
                'member_id'=>$member_id,
                'moblile'=>$mobile,
                'name'=>$name,
                'is_type'=>$is_type,
                'counterpart_id'=>$this->member_id,
            ];
        $re = model('customer_operational')->add($data);    
       return $this->response($this->success());
    }
    
    //搜索执行人
    public function operationalsearch()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $mobile = input('search_text', '');
        $page_index = input('page', 1);
        $page_size = input('limit', PAGE_LIST_ROWS);
        /*$is_type = input('is_type', 0);*/
        $condition =[['mobile|nickname','like','%'.$mobile.'%']];
        $res = model('member')->PageList($condition,'member_id,nickname,mobile,headimg','',$page_index,$page_size);
       return $this->response($this->success($res));
    }
    public function operdel()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $id = input('id','');
         
        if (empty($id)) {
            return $this->response($this->error('参数错误'));
        }
         $sql = "FIND_IN_SET('{$id}',personnel_id)";
            $sql = rtrim($sql, 'OR ');
            $map = [['', 'EXP', Db::raw($sql)]];
            $res = Db::name('customer')->where('member_id',$this->member_id??2387)->where($map)->find();
         /*$res = model('customer')->getInfo([['personnel_id','=',$id]]);*/
        
         if (!empty($res)) {
             return $this->response($this->error('该执行人已被选中,不能删除'));
         }
        model('customer_operational')->delete([['id','=',$id]]);
       return $this->response($this->success());
    }
    
    /**
     * 获取执行人员对应的添加人员
     * */
    public function gettjList()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        //获取执行人员对应的所有的商家
        $join = [['member m','a.counterpart_id = m.member_id','left']];
        $res = model('customer_operational')->getList([['a.member_id','=',$this->member_id??2385]],'a.counterpart_id,a.id,m.nickname','','a',$join);
        
      
       return $this->response($this->success($res));
    } 
    
    
    /**
     *
     * 获取执行人员对应的客户列表
     **/
      public function getzxList()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        //获取执行人员对应的所有的商家
        $counterpart_id = input('counterpart_id','');
        $id = input('id','');
        /*$res = model('customer_operational')->getList([['member_id','=',$this->member_id??2385]],'counterpart_id,id');*/
        $page_index = input('page', 1);
        $page_size = input('limit', PAGE_LIST_ROWS);
        //将对应的商家 以及拥有这个执行的人的客户列表筛选出来
        $da = [];
        
      /*  foreach ($res as $r) {*/
            /*$condition = [['member_id','=',$r['counterpart_id']],['personnel_id','like',$r['id'].',%']];
            $rex1 = model('customer')->getList($condition);
            $rex2 = model('customer')->getList([['member_id','=',$r['counterpart_id']],['personnel_id','like','%,'.$r['id'].',%']]);
            $rex3 = model('customer')->getList([['member_id','=',$r['counterpart_id']],['personnel_id','like','%,'.$r['id']]]);*/
      /*  $order = input('order')?input('order'):'create_time';
        $sort = input('sort')?input('sort'):'desc';*/
        /*$overtime = input('overtime')?input('overtime'):0;*/
       /* $sort = input('sort')??'desc';*/
       $executing = input('executing_state');
        if(empty($executing)  && $executing == ''){
            $executing = 'all';
        }
        
        $name = input('name')?input('name'):'';
        $time = input('time')?input('time'):0;    
       if (!empty($time)) {
            $timestamp = strtotime( $time );
           
            $start_time = strtotime(date( 'Y-m-1 00:00:00', $timestamp ));
            $mdays = date( 't', $timestamp );
            $end_time = strtotime(date( 'Y-m-' . $mdays . ' 23:59:59', $timestamp ));
            $condition[] = [ 'wedding_date', '>=', $start_time ];
            $condition[] = [ 'wedding_date', '<=', $end_time ];
        }
        
        if (!empty($name)) {
            $condition[] = [ 'name|mobile', 'like', "%".$name.'%' ];
            /*$condition[] = [ 'mobile', 'like', "%".$name.'%' ];*/
        }
        
        if ($executing != 'all') {
            if($executing == 1){
                //未执行
                $condition[] = [ 'wedding_date', '>', time() ];
            }else{
                 //已执行
                $condition[] = [ 'wedding_date', '<', time() ];
            }
            
        }    
        $condition[] = [ 'member_id', '=', $counterpart_id];
            $sql = "FIND_IN_SET('{$id}',personnel_id)";
            $sql = rtrim($sql, 'OR ');
            $map = [['', 'EXP', Db::raw($sql)]];
            
            $rex= Db::name('customer')->where($condition)->where($map)->limit($page_size)->page($page_index)->select()->toArray();
              
            foreach ($rex as &$r){
                $r['type_name'] = model('customer_type')->getInfo([['id','=',$r['services_available']]],'type_name')['type_name'];
            }
       /* }*/
      
       return $this->response($this->success($rex));
    }
    

    
     /**
     *
     * 已查阅
     **/
    public function getSetxy()
    {
        $ts_id = input('ts_id','');
        $member_id = input('member_id','');
        $res = model('customer_tscy')->getInfo([['member_id','=',$member_id],['ts_id','=',$ts_id]]);
        if ($res['is_type'] == 0) {
            //说明是第一次
            model('customer_tscy')->update(['is_type'=>1,'create_time'=>time()],[['member_id','=',$member_id],['ts_id','=',$ts_id]]);
        }
        return $this->response($this->success());
    }
    public function agre()
    {
        $timestamp = time() ;
           
            $start_time = strtotime(date( 'Y-m-1 00:00:00', $timestamp ));
            $mdays = date( 't', $timestamp );
            $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', $timestamp );
        dump($end_time);die;
    }
}
