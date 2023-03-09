<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */


namespace addon\wechatpay\event;

use addon\wechatpay\model\Pay;
class PayTransfer
{
    public function handle(array $params){
        
        if ($params['transfer_type'] == 'wechatpay'||$params['transfer_type'] == 'bank') {
            $is_weapp = $params['is_weapp'] ?? 0;
            
            $pay = new Pay($is_weapp);
            
            $res = $pay->transfer($params);
            	
            if ($res['code'] !== 0) {
                
                return $res;
            }
            
            //判断转账订单是否转    账成功+
            sleep(2);
            /*$rez = $pay->batches($res);
            
            if ($rez['transfer_detail_list'][0]['detail_status'] == 'SUCCESS') {
                return $res;
            }else if ($rez['transfer_detail_list'][0]['detail_status'] == 'FAIL') {
                return ['code'=>10001,'message'=>'转账失败'];
            }else{
                return ['code'=>10003,'message'=>'转账中'];
            }*/
            /*var_dump($res);die;*/
            $rez = $pay->batchesTwo($res);
            $data = $this->addtype();
            if($rez['detail_status']  == 'FAIL'){
                return ['code'=>10001,'message'=>$data[$rez['fail_reason'] ]];
            }else{
                return $res;
            }
            
            
            return $res;
        }
    }
    public function addtype()
    {
        return $data =[
            'ACCOUNT_FROZEN'=>'账户冻结',
            "REAL_NAME_CHECK_FAIL"=>"用户未实名",
            'NAME_NOT_CORRECT'=>'用户姓名校验失败',
            'OPENID_INVALID'=>'Openid校验失败',
            'TRANSFER_QUOTA_EXCEED'=>'超过用户单笔收款额度',
            'DAY_RECEIVED_QUOTA_EXCEED'=>'超过用户单日收款额度',
            'MONTH_RECEIVED_QUOTA_EXCEED'=>'超过用户单月收款额度',
            'DAY_RECEIVED_COUNT_EXCEED'=>'超过用户单日收款次数',
            'PRODUCT_AUTH_CHECK_FAIL'=>'产品权限校验失败',
            'OVERDUE_CLOSE'=>'转账关闭',
            'ID_CARD_NOT_CORRECT'=>'用户身份证校验失败',
            'ACCOUNT_NOT_EXIST'=>'用户账户不存在',
            'TRANSFER_RISK'=>'转账存在风险',
            'REALNAME_ACCOUNT_RECEIVED_QUOTA_EXCEED'=>'用户账户收款受限，请引导用户在微信支付查看详情',
            'RECEIVE_ACCOUNT_NOT_PERMMIT'=>'未配置该用户为转账收款人',
            'PAYER_ACCOUNT_ABNORMAL'=>'商户账户付款受限，可前往商户平台-违约记录获取解除功能限制指引',
            'PAYEE_ACCOUNT_ABNORMAL'=>'用户账户收款异常，请引导用户完善其在微信支付的身份信息以继续收款'
            ];
    }
}