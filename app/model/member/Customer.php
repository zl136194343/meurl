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

namespace app\model\member;

use app\model\BaseModel;
use app\model\message\Email;
use app\model\message\Sms;
use app\model\system\Address;
use app\model\system\Stat;
use app\model\upload\Upload;
use think\facade\Db;
use think\facade\cache;
use addon\weapp\model\Weapp as WeappModel;
use addon\wechat\model\Message as WechatMessage;
use addon\wechat\admin\controller\Fans;
use addon\wechat\model\Wechat as WechatModel;
use addon\wechat\model\Fans as FansModel;
/**
 * 会员管理
 */
class Customer extends BaseModel
{
    public function shopCustomer($time)
    {
        //获取需要推送的用户
      
         $message_model = new WeappModel();
         $wechat = new WechatMessage();
         /*$data = model('customer_ts')->getList([['wedding_date','=',$time],['wedding_date','<',$time+86400+86400],['is_push','=',1],['is_status','=',0]]);*/
         /*$time = $time - (8*3600);*/
        $data = model('customer_ts')->getList([['attr_value_name','=',$time],['is_type','=',0]]);
        /*$this->syncWechatFans(0);
        $this->syncWechatFans(1);*/
         /*if(empty($data)){
             
              return $this->success();
         }*/
         
        /* $res = $this->curl_post('https://xyhl.chnssl.com/wechat/admin/fans/syncWechatFans',['page'=>1]);*/
        //刷新会员列表
                /*$this->syncWechatFans(0);
                $this->syncWechatFans(1);*/
         $wechat_model = new WechatMessage();
         
        foreach($data as $d){
            //发消息.
            $customer = model('customer')->getInfo([['id','=',$d['customer_id']]]);
             
            $attr_id = explode(',',$d['attr_id']);
            $error_desc = '';
             $services_available = model('customer_type')->getInfo([['id','=',$customer['services_available']]],'type_name');
             
            foreach($attr_id as $key => $ad){
                $memberList = model('member')->getInfo([['member_id','=',$ad]],'weapp_openid,member_id,wx_openid,wx_unionid');
               
                $data["openid"] = $memberList['wx_openid'];
               
                if(empty($data["openid"])){
                         
                         $ds = model('wechat_fans')->getInfo([['unionid','=',$memberList['wx_unionid']]],'openid');
                         $data["openid"] = $ds['openid'];
                          
                     }
                    
                if(empty($data["openid"])){
                   
                    $names = model('customer_operational')->getInfo([['member_id','=',$ad],['counterpart_id','=',$customer['member_id']]],'name');
                    /*dump($customer['member_id']);die;*/
                    if ($error_desc == '') {
                    
                         
                        $error_desc = $names['name'];
                        
                    }else{
                        $error_desc = $error_desc.','.$names['name'];
                    }
                    // dump($error_desc);
                    continue; 
               }
                    // $data["template_data"] = [
                    //     'keyword1' => $d['name'],
                    //     /*'keyword2' => str_sub($order_info['name']),*/
                    //     'keyword2' => $d['mobile'],
                    //     'keyword3' => $services_available['type_name'],
                    //     'keyword4' => time_to_date($d['wedding_date']),
                    // ];
                    
                    $data["template_data"] = [
                        'keyword1' => '待处理',
                        /*'keyword2' => str_sub($order_info['name']),*/
                        'keyword2' => $services_available['type_name'] .'-' .$customer['site'],
                        'keyword3' => time_to_date($customer['wedding_date']),
                        'keyword4' => $customer['personnel'],
                    ];
                    
                    
                    $data["page"] = $this->handleUrl(2, $customer['id'],$customer['services_available'],$d['id'],$ad);      
                    /*$data["page"] = $this->handleUrl(2, 40);*/
                    $data['message_info']['wechat_is_open'] = 1;
                    
                   
                    $data['message_info']['wechat_json'] = json_encode([
                            "template_id_short"=>"OPENTM417749055",
                            "template_id"=>"kD3S8sAOSXFoxH5QtLLOAept1dPRbQcp7k3ydIwd6-Q",
                            "headtext"=>$d['attr_title'],"bottomtext"=>$d['reamk'],"headtextcolor"=>"","bottomtextcolor"=>"","content"=>"\u9884\u7ea6\u72b6\u6001{{keyword1.DATA}}\u9884\u7ea6\u9879\u76ee{{keyword2.DATA}}\u9884\u7ea6\u65f6\u95f4{{keyword3.DATA}}\u88ab\u670d\u52a1\u4eba\u5458{{keyword4.DATA}}"
                   
                  ]);
                    
                    $res = $wechat_model->sendMessage($data);
                    //
                    if ($res['code'] == 0) {
                           //推送成功 将对应的人员加入查阅表
                           
                          $attr_name = explode(',',$d['attr_name']);
                          
                           model('customer_tscy')->add(['ts_id'=>$d['id'],'member_id'=>$ad,'ts_name'=>$attr_name[$key]]);
                        }
            }
            
                   
                           if (!empty($error_desc)) {
                              model('customer_ts')->update(['is_type'=>1,'error_desc'=>$error_desc],[['id','=',$d['id']]]);
                           }else{
                              model('customer_ts')->update(['is_type'=>1],[['id','=',$d['id']]]);
                           }
                      
             
                /*$list = $message_model ->lidsList();
                $lists = [
                    'site_id'=>0,
                    'open_id'=>$memberList['wx_openid'],
                    'template_id'=>'kD3S8sAOSXFoxH5QtLLOAept1dPRbQcp7k3ydIwd6-Q',
                    'url'=>$memberList['wx_openid'],
                    'open_id'=>$memberList['wx_openid'],
                    'open_id'=>$memberList['wx_openid'],
                    ];*/
                /*$wechat->send($lists);*/
                
                
               
                
                        
               /*$re = $message_model->getSendmsg($list['MEMBER_KH'],['thing5'=>["value"=> $d['name']],'phone_number6'=>["value"=> $d['mobile']],'thing7'=>["value"=> $services_available['type_name']],'time4'=>["value"=> date('Y年m月d日',$d['wedding_date'])]],$memberList['member_id']);*/
               //取出对应的执行人员
                
            //   $open = explode(',',$d['personnel_id']);
                
            //   foreach($open as $a ){
            //             $where = [
            //                 ['a.id','=',$a],
            //                 ];
            //                 $join = [
            //             [
            //                 'member m',
            //                 'm.member_id = a.member_id',
            //                 'left'
            //             ]
            //         ];
                    
            //          $membList = model('customer_operational')->getInfo($where,'m.weapp_openid,m.member_id,m.wx_openid,m.wx_unionid','a',$join);
                    
            //          $data["template_data"] = [
            //             'keyword1' => '待处理',
            //             /*'keyword2' => str_sub($order_info['name']),*/
            //             'keyword2' => $services_available['type_name'] .'-' .$d['site'],
            //             'keyword3' => time_to_date($d['wedding_date']),
            //             'keyword4' => $d['name'],
            //         ];
            //          $data["openid"] = $membList['wx_openid'];
            //          if(empty($data["openid"])){
                         
            //              $ds = model('wechat_fans')->getInfo([['unionid','=',$membList['wx_unionid']]],'openid');
            //              $data["openid"] = $ds['openid'];
            //          }
                     
            //          $res = $wechat_model->sendMessage($data);
            //         /**/
            //   }
        }
      
        return $this->success();
    }
    
       public function messageBuyerReceive($data)
    {
        $order_id = $data["order_id"];
        $order_info = model("order")->getInfo([ [ "order_id", "=", $order_id ] ], "order_no,order_name,site_id,order_type,name,full_address,sign_time");

       /* $var_parse = array(
            "orderno" => $order_info["order_no"]//订单编号
        );
*/
        $shop_accept_message_model = new ShopAcceptMessage();
        /*$result = $shop_accept_message_model->getShopAcceptMessageList([['sam.site_id','=',$order_info['site_id']]]);
        $list = $result['data'];*/
        $wechat_model = new WechatMessage();
            foreach ($list as $v) {

                /*$message_data = $data;
                $message_data["var_parse"] = $var_parse;*/
                if($v['wx_openid'] != ''){
                    $data["openid"] = $v['wx_openid'];

                    $data["template_data"] = [
                        'keyword1' => $order_info['full_address'],
                        'keyword2' => str_sub($order_info['name']),
                        'keyword3' => $order_info['order_no'],
                        'keyword4' => $order_info['order_name'],
                        'keyword5' => time_to_date($order_info['sign_time']),
                    ];
                    $data["page"] = $this->handleUrl($order_info['order_type'], $order_id);
                    $wechat_model->sendMessage($data);
                }
            }

    }
    
    public function syncWechatFans($page_index)
    {
        
        
        $page_size = PAGE_LIST_ROWS;
        $wechat_model = new WechatModel();
        
        if ($page_index == 0) {
            //建立连接，同时获取所有用户openid  拉去粉丝信息列表(一次拉取调用最多拉取10000个关注者的OpenID，可以通过多次拉取的方式来满足需求。)
            $openid_list = [];
            $is_continue = true;
            $next_openid = null;
            do {
                $item_result = $wechat_model->user($next_openid);

                if ($item_result["code"] < 0)
                    return $item_result;

                if (empty($item_result['data']['data'])) {
                    return success(0, '公众号暂无粉丝');
                }

                $next_openid = $item_result["data"]["next_openid"];
                $openid_item = $item_result["data"]['data']["openid"];
                if (empty($openid_item)) {
                    $is_continue = false;
                } else {
                    $is_continue = false;
                    foreach ($openid_item as $k => $v) {
                        $openid_list[] = $v;
                    }
                }
            } while ($is_continue);

            //将粉丝列表存入session
            session('wechat_openid_list', $openid_list);
            $total = count($openid_list);
            if ($total % $page_size == 0) {
                $page_count = $total / $page_size;
            } else {
                $page_count = (int)($total / $page_size) + 1;
            }
            $data = array(
                'total' => $total,
                'page_count' => $page_count,
            );
            return success(0, '', $data);

        } else {
            //对应页数更新用户粉丝信息
            
            $openid_list = session('wechat_openid_list');
            if (empty($openid_list)) {
                return error();
            }

            $start = ($page_index - 1) * $page_size;
            $page_fans_openid_list = array_slice($openid_list, $start, $page_size);

            if (empty($page_fans_openid_list)) {
                return error();
            }

            $fans_model = new FansModel();

            $result = $wechat_model->selectUser($page_fans_openid_list);
            if ($result['data'] && $result['data']['user_info_list']) {
                foreach ($result['data']['user_info_list'] as $k => $v) {
                    $nickname_decode = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $v['nickname']);
                    $nickname = preg_replace_callback('/./u',
                        function (array $match) {
                            return strlen($match[0]) >= 4 ? '' : $match[0];
                        },
                        $v['nickname']);
                    $add_data = [
                        'nickname' => $nickname,
                        'nickname_decode' => $nickname_decode,
                        'headimgurl' => $v['headimgurl'],
                        'sex' => $v['sex'],
                        'language' => $v['language'],
                        'country' => $v['country'],
                        'province' => $v['province'],
                        'city' => $v['city'],
                        'openid' => $v['openid'],
                        'unionid' => $v['unionid'] ?? '',
                        'groupid' => '',
                        'is_subscribe' => 1,
                        'remark' => $v['remark'],
                        'subscribe_time' => $v['subscribe_time'] ?? 0,
                        'subscribe_scene' => $v['subscribe_scene'] ?? 0,
                        'unsubscribe_time' => $v['unsubscribe_time'] ?? 0,
                        'update_date' => time()
                    ];
                    $info = $fans_model->getFansInfo(['openid' => $v['openid']], 'openid');
                    if (!empty($info['data'])) {
                        $fans_model->editFans($add_data, [['openid', '=', $v['openid']]]);
                    } else {
                        $fans_model->addFans($add_data);
                    }
                }
            }

            return $result;
        }
    }
    
    
    private function handleUrl($order_type, $order_id,$services_available,$ts_id,$member_id){
        switch ($order_type) {
            case 2:
               /* return 'pages/order/detail_pickup/detail_pickup?order_id=' . $order_id;
                break;*/
                return 'subpkg/chent/chent?isShow=1&edit=1&services_available='.$services_available.'&id='.$order_id.'&lianjie=1&ts_id='.$ts_id.'&member_id='.$member_id;
                break;
            case 3:
                return 'pages/order/detail_local_delivery/detail_local_delivery?order_id=' . $order_id;
                break;
            case 4:
                return 'pages/order/detail_virtual/detail_virtual?order_id=' . $order_id;
                break;
            default:
                return 'pages/order/detail/detail?order_id=' . $order_id;
                break;
        }
    }
    
    public  function curl_post( $url, $postdata ) {

        $header = array(
            'Accept: application/json',
        );
        
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 超时设置
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

        // 设置请求头
         
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE );

        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        
        //执行命令
       
        $data = curl_exec($curl);
        // 显示错误信息
        if (curl_error($curl)) {
            
            print "Error: " . curl_error($curl);
        } else {
            // 打印返回的内容
          
            curl_close($curl);
            return $data;
        }
    }
    
    
}


