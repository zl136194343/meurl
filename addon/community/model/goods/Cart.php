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

namespace addon\community\model\goods;


use app\model\BaseModel;

/**
 * 购物车
 */
class Cart extends BaseModel
{

    /**
     * 添加购物车
     * @param $data
     * @return array
     */
    public function addCart($data)
    {
        $condition = [
            ['sku_id', '=', $data['sku_id']],
            ['member_id', '=', $data['member_id']],
            ['cl_id','=',$data['cl_id']]
        ];

        $cart_info = model("commander_goods_cart")->getInfo($condition, 'cart_id, num');
        if (!empty($cart_info)) {
            $res = model("commander_goods_cart")->update(['num' => $cart_info['num'] + $data['num']],
                [['cart_id', '=', $cart_info['cart_id']]]);
        } else {
            $res = model("commander_goods_cart")->add($data);
        }
        return $this->success($res);
    }

    /**
     * 更新购物车商品数量
     * @param $data
     * @return array
     */
    public function editCart($data)
    {
        $res = model("commander_goods_cart")->update(['num' => $data['num']],
            [['cart_id', '=', $data['cart_id']], ['member_id', '=', $data['member_id']], ['cl_id', '=', $data['cl_id']]]);
        return $this->success($res);
    }

    /**
     * 删除购物车商品项(可以多项)
     * @param $data
     * @return array
     */
    public function deleteCart($data)
    {
        $res = model("commander_goods_cart")->delete([['cart_id', 'in', explode(',', $data['cart_id'])],
            ['member_id', '=', $data['member_id']]]);
        return $this->success($res);
    }

    /**
     * 清空购物车
     * @param $data
     * @return array
     */
    public function clearCart($data)
    {
        $res = model("commander_goods_cart")->delete([['member_id', '=', $data['member_id']],['cl_id', '=', $data['cl_id']]]);
        return $this->success($res);
    }

    /**
     * 获取会员购物车
     * @param $member_id
     * @param $site_id
     * @return array
     */
    public function getCart($member_id, $site_id)
    {
        $field = 'ngc.cart_id, ngc.cl_id, ngc.member_id, ngc.sku_id, ngc.num,
          ngs.sku_name,ngs.sku_no, ngs.sku_spec_format,ngs.price,ngs.market_price,ngs.discount_price,
          ngs.promotion_type, ngs.start_time, ngs.end_time, ngs.stock,ngs.sku_image, ngs.sku_images,
           ngs.goods_state, ngs.goods_stock_alarm, ngs.is_virtual, ngs.goods_name,ngs.virtual_indate,
            ngs.is_free_shipping, ngs.shipping_template, ngs.unit, ngs.introduction,ngs.sku_spec_format,
             ngs.keywords, ngs.max_buy, ngs.min_buy';
        $join  = [
            ['community_goods_sku ngs', 'ngc.sku_id = ngs.sku_id', 'inner'],
        ];
        $condition = [['ngc.member_id', '=', $member_id], ['ngc.cl_id', '=', $site_id], ['ngs.is_delete', '=', 0]];
        $list = model("commander_goods_cart")->getList($condition, $field, 'ngc.cart_id desc', 'ngc', $join);
        return $this->success($list);
    }

    /**
     * 获取购物车数量
     * @param $member_id
     * @return array
     */
    public function getCartCount($member_id)
    {
        $list = model("commander_goods_cart")->getCount([['member_id', '=', $member_id]]);
        return $this->success($list);
    }

    public function getCartList($condition = [], $field = 'cart_id,site_id,member_id,sku_id,num', $order = 'cart_id desc')
    {
        $join = [
            ['community_goods_sku gs', 'gc.sku_id = gs.sku_id', 'left']
        ];

        $list = model("commander_goods_cart")->getList($condition, $field, $order,'gc',$join);
        return $this->success($list);
    }


    /**
     * 获取购物车数量
     * @param $member_id
     * @param $sku_id
     * @param string $activity_type
     * @return int
     */
    public function getCartGoodsCount($member_id, $sku_id, $activity_type='')
    {
        $condition = [
            ['member_id', '=', $member_id],
            ['sku_id', '=', $sku_id],
            ['activity_type', '=', $activity_type],
        ];
        return model("commander_goods_cart")->getCount($condition);
    }
    

}