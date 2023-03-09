<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace addon\pointexchange\model;

use addon\gift\model\Gift;
use addon\platformcoupon\model\Platformcoupon;
use app\model\BaseModel;

/**
 * 积分兑换
 */
class Exchange extends BaseModel
{
    public $type = [
        1 => [
            'name' => 'gift',
            'title' => '兑换礼品',
        ],
        2 => [
            'name' => 'coupon',
            'title' => '兑换优惠券',
        ],
        3 => [
            'name' => 'balance',
            'title' => '兑换红包',
        ],
    ];

    /**
     * 添加积分兑换
     * @param array $data
     */
    public function addExchange($data)
    {

        if ($data[ 'type' ] == 1) {
            $exist = model('promotion_exchange')->getInfo([ [ 'type_id', '=', $data[ 'gift_id' ] ] ], 'id');
            if (!empty($exist)) {
                return $this->error('', '该礼品已存在，请不要重复添加');
            }
            $gift = new Gift();
            $gift_info = $gift->getGiftInfo([ [ 'gift_id', '=', $data[ 'gift_id' ] ] ], 'gift_id, gift_name, gift_image, gift_stock, gift_body, gift_body, gift_price,category_id');

            $save_data = [
                'type' => $data[ 'type' ],
                'type_id' => $data[ 'gift_id' ],
                'name' => $gift_info[ 'data' ][ 'gift_name' ],
                'image' => $gift_info[ 'data' ][ 'gift_image' ],
                'stock' => $gift_info[ 'data' ][ 'gift_stock' ],
                'point' => $data[ 'point' ],
                'state' => $data[ 'state' ],
                'type_name' => $data[ 'type_name' ],
                'market_price' => $gift_info[ 'data' ][ 'gift_price' ],
                'content' => $gift_info[ 'data' ][ 'gift_body' ],
                'create_time' => time(),
                'pay_type' => $data[ 'pay_type' ] ?? 0,
                'price' => $data[ 'price' ],
                'category_id'=>$data['category_id']
            ];

                
                /*$gift_model = new Gift();
                $array = [
                    'gift_id'   =>  $info['goods_id'],
                    'gift_name' => $info[ 'goods_name' ],
                    'gift_keywords' => $info[ 'keywords' ],
                    'gift_desc' => $info[ 'goods_class_name' ],
                    'gift_body' => $info[ 'goods_content' ],
                    'gift_price' => $data[ 'price' ],
                    'gift_image' => $info[ 'goods_image' ],
                    'gift_stock' => $info[ 'goods_stock' ],
                    'gift_state' => $data[ 'state' ],
                    'gift_no' => $gift_model->getGiftNo(),
                ];
//            $this->addLog("添加礼品:" . $array[ 'gift_name' ]);
                $gift_model->addGift($array);*/
        } elseif ($data[ 'type' ] == 2) {

            $exist = model('promotion_exchange')->getInfo([ [ 'type_id', '=', $data[ 'coupon_type_id' ] ] ], 'id');
            if (!empty($exist)) {
                return $this->error('', '该优惠券已存在，请不要重复添加');
            }
            $coupon = new Platformcoupon();
            $coupon_type_info = $coupon->getPlatformCouponTypeInfo([ [ 'platformcoupon_type_id', '=', $data[ 'coupon_type_id' ] ] ], 'platformcoupon_type_id,platformcoupon_name,money,count,image,status');
            $save_data = [
                'type' => $data[ 'type' ],
                'type_id' => $coupon_type_info[ 'data' ][ 'platformcoupon_type_id' ],
                'name' => $coupon_type_info[ 'data' ][ 'platformcoupon_name' ],
                'image' => $coupon_type_info[ 'data' ][ 'image' ],
                'stock' => $coupon_type_info[ 'data' ][ 'count' ],
                'point' => $data[ 'point' ],
                'state' => $data[ 'state' ],
                'type_name' => $data[ 'type_name' ],
                'market_price' => $coupon_type_info[ 'data' ][ 'money' ],
                'content' => $data[ 'content' ],
                'create_time' => time()
            ];
        } elseif ($data[ 'type' ] == 3) {
            $save_data = [
                'type' => $data[ 'type' ],
                'name' => $data[ 'name' ],
                'image' => $data[ 'image' ],
                'stock' => $data[ 'stock' ],
                'point' => $data[ 'point' ],
                'state' => $data[ 'state' ],
                'type_name' => $data[ 'type_name' ],
                'market_price' => $data[ 'balance' ],
                'balance' => $data[ 'balance' ],
                'content' => $data[ 'content' ],
                'create_time' => time()
            ];
        }
        $res = model("promotion_exchange")->add($save_data);
        return $this->success($res);
    }

    /**
     * 编辑积分兑换
     * @param array $data
     */
    public function editExchange($data)
    {
        if ($data[ 'type' ] == 1) {
            $gift = new Gift();
            $gift_info = $gift->getGiftInfo([ [ 'gift_id', '=', $data[ 'gift_id' ] ] ], 'gift_id, gift_name,gift_image,gift_stock,gift_body, gift_body, gift_price');

            $save_data = [
                'type' => $data[ 'type' ],
                'type_id' => $data[ 'gift_id' ],
                'name' => $gift_info[ 'data' ][ 'gift_name' ],
                'image' => $gift_info[ 'data' ][ 'gift_image' ],
                'stock' => $gift_info[ 'data' ][ 'gift_stock' ],
                'point' => $data[ 'point' ],
                'state' => $data[ 'state' ],
                'market_price' => $gift_info[ 'data' ][ 'gift_price' ],
                'content' => $gift_info[ 'data' ][ 'gift_body' ],
                'pay_type' => $data[ 'pay_type' ] ?? 0,
                'price' => $data[ 'price' ]
            ];
        } elseif ($data[ 'type' ] == 2) {

            $coupon = new Platformcoupon();
            $coupon_type_info = $coupon->getPlatformCouponTypeInfo([ [ 'platformcoupon_type_id', '=', $data[ 'coupon_type_id' ] ] ], 'platformcoupon_type_id,platformcoupon_name,money,count,image,status');

            $save_data = [
                'type' => $data[ 'type' ],
                'type_id' => $coupon_type_info[ 'data' ][ 'platformcoupon_type_id' ],
                'name' => $coupon_type_info[ 'data' ][ 'platformcoupon_name' ],
                'image' => $coupon_type_info[ 'data' ][ 'image' ],
                'stock' => $coupon_type_info[ 'data' ][ 'count' ],
                'point' => $data[ 'point' ],
                'state' => $data[ 'state' ],
                'market_price' => $coupon_type_info[ 'data' ][ 'money' ],
                'content' => $data[ 'content' ]
            ];
        } elseif ($data[ 'type' ] == 3) {
            $save_data = [
                'type' => $data[ 'type' ],
                'name' => $data[ 'name' ],
                'image' => $data[ 'image' ],
                'stock' => $data[ 'stock' ],
                'point' => $data[ 'point' ],
                'state' => $data[ 'state' ],
                'market_price' => $data[ 'balance' ],
                'balance' => $data[ 'balance' ],
                'content' => $data[ 'content' ]
            ];
        }
        $res = model("promotion_exchange")->update($save_data, [ [ 'id', '=', $data[ 'id' ] ] ]);
        return $this->success($res);
    }

    /**
     * 删除积分兑换
     * @param string $ids
     */
    public function deleteExchange($ids)
    {
        $res = model("promotion_exchange")->delete([ [ 'id', 'in', $ids ] ]);
        return $this->success($res);
    }

    /**
     * 获取积分兑换信息
     * @param int $id
     */
    public function getExchangeInfo($id, $field = '*')
    {
        $info = model("promotion_exchange")->getInfo([ [ 'id', '=', $id ] ], $field);
        return $this->success($info);
    }

    /**
     * 获取积分兑换商品详情
     * @param $id
     * @return array
     */
    public function getExchangeGoodsDetail($id)
    {
        $info = model("promotion_exchange")->getInfo([ [ 'id', '=', $id ] ], 'id,type,type_name,type_id,name,image,stock,point,market_price,price,delivery_price,balance,state,content,sales_volume');
        // 兑换类型，1：礼品，2：优惠券，3：红包
        switch ( $info[ 'type' ] ) {
            case 1:
                //礼品
                $gift = new Gift();
                $gift_info = $gift->getGiftInfo([ [ 'gift_id', '=', $info[ 'type_id' ] ] ], 'gift_id, gift_name,gift_desc');
                $gift_info = $gift_info[ 'data' ];
                if (!empty($gift_info)) {
                    $info = array_merge($info, $gift_info);
                }
                break;
            case 2:
                //优惠券

                $coupon = new Platformcoupon();
                $coupon_type_info = $coupon->getPlatformCouponTypeInfo([ [ 'platformcoupon_type_id', '=', $info[ 'type_id' ] ] ], 'platformcoupon_type_id,platformcoupon_name,money,count,status,lead_count,max_fetch,at_least,end_time,validity_type,fixed_term');

                $coupon_type_info = $coupon_type_info[ 'data' ];
                if (!empty($coupon_type_info)) {
                    $info = array_merge($info, $coupon_type_info);
                }
                break;
            case 3:
                //余额红包
                break;
        }
        return $this->success($info);
    }

    /**
     * 获取积分兑换列表
     * @param unknown $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return multitype:string
     */
    public function getExchangeList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('promotion_exchange')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取积分兑换列表
     * @param unknown $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getExchangePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = '*', $alias = '', $join = [])
    {
        $list = model('promotion_exchange')->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        return $this->success($list);
    }


    /**
     * 增加库存
     * @param $param
     */
    public function incStock($param)
    {
        $condition = array (
            [ "id", "=", $param[ "id" ] ]
        );
        $num = $param[ "num" ];
        $info = model("promotion_exchange")->getInfo($condition, "stock, name");
        if (empty($info))
            return $this->error(-1, "");

        //编辑sku库存
        $result = model("promotion_exchange")->setInc($condition, "stock", $num);

        return $this->success($result);
    }

    /**
     * 减少库存
     * @param $param
     */
    public function decStock($param)
    {
        $condition = array (
            [ "id", "=", $param[ "id" ] ]
        );
        $num = $param[ "num" ];

        $info = model("promotion_exchange")->getInfo($condition, "stock, name");
        if (empty($info))
            return $this->error();

        if ($info[ "stock" ] < 0)
            return $this->error('', $info[ "name" ] . "库存不足!");

        //编辑sku库存
        $result = model("promotion_exchange")->setDec($condition, "stock", $num);
        if ($result === false)
            return $this->error();


        return $this->success($result);
    }
}