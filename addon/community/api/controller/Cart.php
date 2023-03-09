<?php

namespace addon\community\api\controller;

use addon\discount\model\Discount;
use addon\seckill\model\Seckill;
use addon\seckill\model\Seckill as SeckillModel;
use addon\community\model\goods\Cart as CartModel;
use app\model\community\CommunityGoods as Goods;

class Cart extends BaseApi
{
    /**
     * 添加信息
     */
    public function add()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $sku_id = isset($this->params['sku_id']) ? $this->params['sku_id'] : 0;
        $num = isset($this->params['num']) ? $this->params['num'] : 0;
        $cl_id = isset($this->params['cl_id']) ? $this->params['cl_id'] : 0;
        $activity_type = $this->params['activity_type'] ?? '';
        $activity_id = $this->params['activity_id'] ?? 0;

        if (empty($sku_id)) return $this->response($this->error('', 'REQUEST_SKU_ID'));
        if (empty($num))  return $this->response($this->error('', 'REQUEST_NUM'));
        if (empty($cl_id))return $this->response($this->error('', 'REQUEST_CLID'));

        $cart = new CartModel();
        switch ($activity_type){
            case 'seckill':
                $count = $cart->getCartGoodsCount($this->member_id, $sku_id, 'seckill');
                // 验证是否秒杀活动商品
                $seckill = model('promotion_seckill_goods')->getInfo([['sku_id', '=', $sku_id],['status', '=', 1]], 'max_buy');
                if (empty($seckill)) {
                    return $this->response($this->error('', '秒杀商品不存在'));
                }
                if ($seckill['max_buy'] > 0 && $seckill['max_buy'] < $count+$num) {
                    return $this->response($this->error('', '已达购买上限'));
                }
                break;
        }

        $data = [
            'cl_id' => $cl_id,
            'member_id' => $token['data']['member_id'],
            'sku_id' => $sku_id,
            'num' => $num,
            'activity_type' => $activity_type,
            'activity_id' => $activity_id,
        ];

        $res = $cart->addCart($data);
        return $this->response($res);
    }

    /**
     * 编辑信息
     */
    public function edit()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $cart_id = isset($this->params['cart_id']) ? $this->params['cart_id'] : 0;
        $cl_id = isset($this->params['cl_id']) ? $this->params['cl_id'] : 0;
        $num = isset($this->params['num']) ? $this->params['num'] : 0;
        if (empty($cart_id)) {
            return $this->response($this->error('', 'REQUEST_CART_ID'));
        }
        if (empty($num)) {
            return $this->response($this->error('', 'REQUEST_NUM'));
        }
        if (empty($cl_id)) {
            return $this->response($this->error('', 'REQUEST_CLID'));
        }

        // todo 检测是否符合活动标准

        $cart = new CartModel();
        $data = [
            'cart_id' => $cart_id,
            'member_id' => $token['data']['member_id']??30,
            'cl_id' =>$cl_id,
            'num' => $num
        ];
        $res = $cart->editCart($data);
        return $this->response($res);
    }

    /**
     * 删除信息
     */
    public function delete()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $cart_id = isset($this->params['cart_id']) ? $this->params['cart_id'] : 0;
        if (empty($cart_id)) {
            return $this->response($this->error('', 'REQUEST_CART_ID'));
        }
        $cart = new CartModel();
        $data = [
            'cart_id' => $cart_id,
            'member_id' => $token['data']['member_id']
        ];
        $res = $cart->deleteCart($data);
        return $this->response($res);
    }

    /**
     * 清空购物车
     */
    public function clear()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cl_id = isset($this->params['cl_id']) ? $this->params['cl_id'] : 0;
        if (empty($cl_id)) {
            return $this->response($this->error('', 'REQUEST_CLID'));
        }
        $cart = new CartModel();
        $data = [
            'member_id' => $token['data']['member_id'],
            'cl_id'     =>$cl_id
        ];
        $res = $cart->clearCart($data);
        return $this->response($res);
    }

    /**
     * 商品购物车列表
     */
    public function goodsLists()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cl_id = isset($this->params['cl_id']) ? $this->params['cl_id'] : 0;
        if (empty($cl_id)) {
            return $this->response($this->error('', 'REQUEST_CLID'));
        }
        $cart = new CartModel();
        $list = $cart->getCart($token['data']['member_id']??1, $cl_id);

        $goods = new Goods();
        if (!empty($list['data'])) {
            foreach ($list['data'] as $k => $v) {
                // 是否参与会员等级折扣
                $goods_member_price = $goods->getGoodsPrice($v['sku_id'], $this->member_id);
                $goods_member_price = $goods_member_price['data'];
                if (!empty($goods_member_price['member_price'])) {
                    $list['data'][$k]['member_price'] = $goods_member_price['price'];
                }
                // 失效状态
                $list['data'][$k]['is_invalid'] = 0;
                // 判断商品失效
                if($v['goods_state'] != 1 || ($v['min_buy']>0 && $v['min_buy']>$v['stock'])) $list['data'][$k]['is_invalid'] = 1;
            }
        }
        return $this->response($list);
    }

    /**
     * 获取购物车数量
     * @return string
     */
    public function count()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cart = new CartModel();
//        $list = $cart->getCartCount($token['data']['member_id']);
        $cl_id = input('cl_id','');
        $condition = [
            ['gc.member_id', '=', $token['data']['member_id']],
            ['gc.cl_id', '=', $cl_id],
            ['gs.goods_state', '=', 1],
            ['gs.is_delete', '=', 0 ]
        ];
        $list = $cart->getCartList($condition, 'gc.num');
        $list = $list['data'];
        $count = 0;
        foreach ($list as $k => $v) {
            $count += $v['num'];
        }
        return $this->response($this->success($count));
    }

    /**
     * 购物车关联列表
     * @return false|string
     */
    public function lists()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cart = new CartModel();
        $condition = [
            ['gc.member_id', '=', $token['data']['member_id']],
            ['gc.site_id', '=', $this->site_id]
        ];
        $list = $cart->getCartList($condition, 'gc.cart_id,gc.sku_id,gc.num,gs.goods_id,gc.activity_type,gc.activity_id');
        return $this->response($list);
    }

    /**
     * 商品购物车列表
     */
    public function totalPrice()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cart = new CartModel();
        $list = $cart->getCart($token['data']['member_id'], $this->site_id);

        $price = 0;
        $goods = new Goods();
        if (!empty($list['data'])) {
            foreach ($list['data'] as $k => $v) {
                // 是否参与会员等级折扣
                $goods_member_price = $goods->getGoodsPrice($v['sku_id'], $this->member_id);
                $goods_member_price = $goods_member_price['data'];
                if (!empty($goods_member_price['member_price'])) {
                    $list['data'][$k]['member_price'] = $goods_member_price['price'];
                }
                // 失效状态
                $list['data'][$k]['is_invalid'] = 0;
                // 判断商品失效
                if($v['goods_state'] != 1 || ($v['min_buy']>0 && $v['min_buy']>$v['stock'])) $list['data'][$k]['is_invalid'] = 1;
                // 根据活动类型获取价格
                switch ($v['activity_type']){
                    case 'seckill':
                        // 秒杀
                        $model = new Seckill();
                        $seckill = $model->getSeckillGoodsDetail([['sg.sku_id', '=', $v['sku_id']]], 'sg.seckill_id,sg.seckill_price,sg.max_buy');
                        $info = $model->getSeckillInfo($seckill['data']['seckill_id']);
                        // 判断是否在秒杀时段范围
                        $condition = [
                            ['id', 'in', $info['data']['seckill_time_id']],
                            ['seckill_start_time', '<', time()-strtotime(date('Y-m-d'))],
                            ['seckill_end_time', '>', time()-strtotime(date('Y-m-d'))],
                        ];
                        $seckill_time = model('promotion_seckill_time')->getFirstData($condition, 'seckill_start_time,seckill_end_time');
                        if(!empty($seckill_time)){// 计算倒计时
                            $list['data'][$k]['surplus_time'] = $seckill_time['seckill_end_time'] - (time()-strtotime(date('Y-m-d')));
                        }else{
                            // 失效
                            $list['data'][$k]['is_invalid'] = 1;
                        }
                        if($list['data'][$k]['is_invalid'] == 0) $price += round($seckill['data']['seckill_price'] * $v['num'], 2);
                        break;
                    default:
                        if($list['data'][$k]['is_invalid'] == 0) {
                            $temp = isset($list['data'][$k]['member_price'])&&$list['data'][$k]['member_price']<$v['data']['discount_price']?$list['data'][$k]['member_price']:$v['discount_price'];
                            $price += $temp * $v['num'];
                        }
                        break;
                }
                $price = round($price, 2);
            }
        }
        return $this->response($this->success(compact('price')));
    }

    /**
     * 商品购物车列表
     * @return false|string
     */
    public function cartIds()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $cart = new CartModel();
        $list = $cart->getCart($token['data']['member_id'], $this->site_id);
        $cart_ids = [];
        if (!empty($list['data'])) {
            foreach ($list['data'] as $k => $v) {
                // 失效状态
                $list['data'][$k]['is_invalid'] = 0;
                // 判断商品失效
                if($v['goods_state'] != 1 || ($v['min_buy']>0 && $v['min_buy']>$v['stock'])) $list['data'][$k]['is_invalid'] = 1;
                // 根据活动类型获取价格
                switch ($v['activity_type']){
                    case 'seckill':
                        // 秒杀
                        $model = new Seckill();
                        $seckill = $model->getSeckillGoodsDetail([['sg.sku_id', '=', $v['sku_id']]], 'sg.seckill_id,sg.seckill_price,sg.max_buy');
                        $info = $model->getSeckillInfo($seckill['data']['seckill_id']);
                        // 判断是否在秒杀时段范围
                        $condition = [
                            ['id', 'in', $info['data']['seckill_time_id']],
                            ['seckill_start_time', '<', time()-strtotime(date('Y-m-d'))],
                            ['seckill_end_time', '>', time()-strtotime(date('Y-m-d'))],
                        ];
                        $seckill_time = model('promotion_seckill_time')->getFirstData($condition, 'seckill_start_time,seckill_end_time');
                        if(!empty($seckill_time)){
                            // 计算倒计时
                            $list['data'][$k]['surplus_time'] = $seckill_time['seckill_end_time'] - (time()-strtotime(date('Y-m-d')));
                        }else{
                            // 失效
                            $list['data'][$k]['is_invalid'] = 1;
                        }
                        if($list['data'][$k]['is_invalid'] == 0)  array_push($cart_ids, $v['cart_id']);
                        break;
                    default:
                        if($list['data'][$k]['is_invalid'] == 0)  array_push($cart_ids, $v['cart_id']);
                        break;
                }
            }
        }
        $cart_ids = implode(',', $cart_ids);
        return $this->response($this->success(compact('cart_ids')));
    }
}
