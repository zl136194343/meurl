<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */

namespace addon\community\api\controller;

use addon\community\model\verify\Verifier;
use addon\community\model\verify\Verify as VerifyModel;

/**
 * 核销管理
 * @author Administrator
 *
 */
class Verify extends BaseApi
{

    /**
     * 核销列表
     */
    public function lists()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $page_index = $this->params['page'] ?? 1;
        $page_size  = $this->params['page_size'] ?? PAGE_LIST_ROWS;
        $verify_type  = $this->params['verify_type'] ?? 'all';

        $condition = [];
        if($verify_type == 'community'){
            $community = model('community_leader')->getInfo([['member_id', '=', $this->member_id]], 'cl_id');
            $count = model('community_leader')->getCount([['cl_id', '=', $community['cl_id']]]);
            if($count == 0) return $this->response($this->error('', '团长不存在'));
            $condition[] = ['cl_id', '=', $community['cl_id']];
        }else{
            // 若不是团长，判断是否门店核销员
            $verifier_model = new Verifier();
            $condition      = [
                ['member_id', '=', $this->member_id],
                ['site_id', '=', $this->site_id]
            ];
            $res            = $verifier_model->checkIsVerifier($condition);
            if ($res["code"] != 0) return $this->response($res);
            $condition[]    = ['verifier_id', '=', $res['data']['verifier_id']];
        }

        if ($verify_type != 'all') {
            $condition[] = ['verify_type', '=', $verify_type];
        }
        $verify_model = new VerifyModel();
        $res        = $verify_model->getVerifyPageList($condition, $page_index, $page_size, "verify_time desc");
        return $this->response($res);
    }

    /**
     *获取核销类型
     */
    public function getVerifyType()
    {
        $verify_model = new VerifyModel();
        $res          = $verify_model->getVerifyType();
        return $this->response($this->success($res));
    }

    /**
     * 验证核销员身份
     */
    public function checkIsVerifier()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $verifier_model = new Verifier();
        $condition      = array(
            ["member_id", "=", $this->member_id],
            ["site_id", "=", $this->site_id]
        );
        $res            = $verifier_model->checkIsVerifier($condition);
        return $this->response($res);
    }

    /**
     * 核销验证信息
     */
    public function verifyInfo()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $verify_code  = isset($this->params['verify_code']) ? $this->params['verify_code'] : '';
        $verify_model = new VerifyModel();
        $res          = $verify_model->checkMemberVerify($this->member_id, $verify_code);
        if ($res["code"] != 0)
            return $this->response($res);

        return $this->response($this->success($res["data"]["verify"]));
    }
    
    /**
     * 核销列表
     * @return string
     */
    public function verifyList()
    {
        /*$token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);*/
        $cl_id = input('cl_id',"");
        $mobile = input('mobile',"");
         
        if (empty($cl_id) || empty($mobile)) {
             
            return $this->response($this->error("", "手机号不能为空"));
        }
        $member_id = model('member')->getInfo([['mobile','=',$mobile]],'member_id');
       $res = model('commander_order')->getList([['member_id','=',$member_id['member_id']],['cl_id','=',$cl_id],['order_status','in','2,3']]);
    foreach ($res as $k => &$v) {
                $order_goods_list = model("commander_order_goods")->getList([
                    'order_id' => $v['order_id']
                ]);
                $res[$k]['commander_order_goods'] = $order_goods_list;
                $action = empty($v["order_status_action"]) ? [] : json_decode($v["order_status_action"], true);
                $member_action = $action["member_action"] ?? [];
                $verify_code = model('verify')->getInfo([['verify_code','=',$v['delivery_code']]],'id');
                $v['virtual_code'] = $verify_code['id'];
                $res[$k]['action'] = $member_action;
                $v['create_time'] = $v['create_time']?date('Y-m-d H:i:s', $v['create_time']):"";
                 $v['pay_time'] = $v['pay_time']?date('Y-m-d H:i:s', $v['pay_time']):"";
                  $v['delivery_time'] = $v['delivery_time']?date('Y-m-d H:i:s', $v['delivery_time']):"";
                   $v['sign_time'] = $v['sign_time']?date('Y-m-d H:i:s', $v['sign_time']):"";
                    $v['finish_time'] = $v['finish_time']?date('Y-m-d H:i:s', $v['finish_time']):"";
                    $v['close_time'] = $v['close_time']?date('Y-m-d H:i:s', $v['close_time']):"";
            }
        return $this->response($this->success($res));
    }
    

    /**
     * 核销
     * @return string
     */
    public function verify()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cl_id = input('cl_id',"");
         $order_id = input('order_id',"");
         
        if (empty($order_id)) {
             
            return $this->response($this->error("", "参数异常"));
        }
       
        $verify_code  = model('commander_order')->getInfo([['order_id','=',$order_id]],'cl_id,verify_code,mobile');
        
        $verify_model = new VerifyModel();
        $res          = $verify_model->checkMemberVerify($verify_code['cl_id'], $verify_code['verify_code'],$verify_code['mobile']);
      
        if ($res["code"] != 0)
            return $this->response($res);

        $res = $verify_model->verify($res["data"]["verifier"], $res["data"]["verify"]['verify_code']);

        return $this->response($res);
    }

}