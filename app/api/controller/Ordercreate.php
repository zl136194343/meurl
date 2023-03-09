<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\api\controller;

use app\model\order\OrderCreate as OrderCreateModel;

/**
 * 订单创建
 * @author Administrator
 *
 */
class Ordercreate extends BaseApi
{
    /**
     * 创建订单
     */
    public function create()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        
        $order_create = new OrderCreateModel();
        
        $member = model('member')->getInfo([['member_id','=',$this->member_id]]);
        if($member['member_level'] <3){
            return $this->response($this->error('', '当前会员等级不支持购买商品,请提升会员等级'));
        }
        if($member['expiration_time'] <time()){
            return $this->response($this->error('', '会员已过期,请前往购买'));
        }
        /*file_put_contents('tests.txt',json_encode($this->params));*/
        $data = [
            'cart_ids' => isset($this->params[ 'cart_ids' ]) ? $this->params[ 'cart_ids' ] : '',
            'sku_id' => isset($this->params[ 'sku_id' ]) ? $this->params[ 'sku_id' ] : '',
            'num' => isset($this->params[ 'num' ]) ? $this->params[ 'num' ] : '',
            'member_id' => $this->member_id??30,
            'is_balance' => isset($this->params[ 'is_balance' ]) ? $this->params[ 'is_balance' ] : 0,//是否使用余额
            'order_from' => $this->params[ 'app_type' ]??'weapp',
            'order_from_name' => $this->params[ 'app_type_name' ]??'微信小程序',
            'pay_password' => isset($this->params[ 'pay_password' ]) ? $this->params[ 'pay_password' ] : '',//支付密码
            'buyer_message' => isset($this->params[ "buyer_message" ]) && !empty($this->params[ "buyer_message" ]) ? json_decode($this->params[ "buyer_message" ], true) : [],
            'delivery' => isset($this->params[ "delivery" ]) && !empty($this->params[ "delivery" ]) ? json_decode($this->params[ "delivery" ], true) : [],
            'coupon' => isset($this->params[ "coupon" ]) && !empty($this->params[ "coupon" ]) ? json_decode($this->params[ "coupon" ], true) : [],
            'member_address' => isset($this->params[ "member_address" ]) && !empty($this->params[ "member_address" ]) ? json_decode($this->params[ "member_address" ], true) : [],

            'platform_coupon_id' => $this->params[ "platform_coupon_id" ] ?? 0,

            'latitude' => $this->params[ "latitude" ] ?? null,
            'longitude' => $this->params[ "longitude" ] ?? null,
            'source_member' => $this->params[ "source_member" ] ?? 0,
            'invoice' => isset($this->params[ "invoice" ]) && !empty($this->params[ "invoice" ]) ? json_decode($this->params[ "invoice" ], true) : [],

        ];
        if (empty($data[ 'cart_ids' ]) && empty($data[ 'sku_id' ])) {
            return $this->response($this->error('', '缺少必填参数商品数据'));
        }
        
        
        $res = $order_create->create($data);
        return $this->response($res);
    }

    /**
     * 计算信息
     */
    public function calculate()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $order_create = new OrderCreateModel();
        $data = [
            'cart_ids' => isset($this->params[ 'cart_ids' ]) ? $this->params[ 'cart_ids' ] : '',
            'sku_id' => isset($this->params[ 'sku_id' ]) ? $this->params[ 'sku_id' ] : '',
            'num' => isset($this->params[ 'num' ]) ? $this->params[ 'num' ] : '',
            'member_id' => $this->member_id,
            'is_balance' => isset($this->params[ 'is_balance' ]) ? $this->params[ 'is_balance' ] : 0,//是否使用余额
            'order_from' => $this->params[ 'app_type' ],
            'order_from_name' => $this->params[ 'app_type_name' ],
            'delivery' => isset($this->params[ "delivery" ]) && !empty($this->params[ "delivery" ]) ? json_decode($this->params[ "delivery" ], true) : [],
            'coupon' => isset($this->params[ "coupon" ]) && !empty($this->params[ "coupon" ]) ? json_decode($this->params[ "coupon" ], true) : [],
            'member_address' => isset($this->params[ "member_address" ]) && !empty($this->params[ "member_address" ]) ? json_decode($this->params[ "member_address" ], true) : [],

            'platform_coupon_id' => $this->params[ "platform_coupon_id" ] ?? 0,
            'latitude' => $this->params[ "latitude" ] ?? null,
            'longitude' => $this->params[ "longitude" ] ?? null,

            'invoice' => isset($this->params[ "invoice" ]) && !empty($this->params[ "invoice" ]) ? json_decode($this->params[ "invoice" ], true) : [],
        ];
        if (empty($data[ 'cart_ids' ]) && empty($data[ 'sku_id' ])) {
            return $this->response($this->error('', '缺少必填参数商品数据'));
        }
        $res = $order_create->calculate($data);
        return $this->response($this->success($res));

    }

    /**
     * 待支付订单 数据初始化
     * @return string
     */
    public function payment()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $order_create = new OrderCreateModel();
        
        $data = [
            'cart_ids' => isset($this->params[ 'cart_ids' ]) ? $this->params[ 'cart_ids' ] : '',
            'sku_id' => isset($this->params[ 'sku_id' ]) ? $this->params[ 'sku_id' ] : '',
            'num' => isset($this->params[ 'num' ]) ? $this->params[ 'num' ] : '',
            'member_id' => $this->member_id??241,
            'is_balance' => isset($this->params[ 'is_balance' ]) ? $this->params[ 'is_balance' ] : 0,//是否使用余额
            'order_from' => $this->params[ 'app_type' ]??'weapp',
            'order_from_name' => $this->params[ 'app_type_name' ]??'微信小程序',

            'latitude' => $this->params[ "latitude" ] ?? null,
            'longitude' => $this->params[ "longitude" ] ?? null,

        ];
        
        if (empty($data[ 'cart_ids' ]) && empty($data[ 'sku_id' ])) {
            return $this->response($this->error('', '缺少必填参数商品数据'));
        }
        $res = $order_create->orderPayment($data);
        
        return $this->response($this->success($res));
    }

}