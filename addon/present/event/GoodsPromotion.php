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

namespace addon\present\event;

use addon\present\model\Present;
use app\model\goods\Goods as GoodsModel;

/**
 * 商品营销活动信息
 */
class GoodsPromotion
{

    /**
     * 商品营销活动信息
     * @param $param
     * @return array
     */
    public function handle($param)
    {
        if (empty($param['goods_id'])) return [];
        $goods_model = new GoodsModel();
        $goods_info  = $goods_model->getGoodsInfo([['goods_id', '=', $param['goods_id']]], 'promotion_addon');
        $goods_info  = $goods_info['data'];
        if (!empty($goods_info['promotion_addon'])) {
            $promotion_addon = json_decode($goods_info['promotion_addon'], true);
            if (!empty($promotion_addon['present'])) {
                $present_model  = new Present();
                $condition    = [
                    ['pg.sku_id', '=', $param['sku_id']],
                ];
                $goods_detail = $present_model->getPresentGoodsDetail($condition);
                $goods_detail = $goods_detail['data'];
                if (!empty($goods_detail)) {
                    $goods_detail['promotion_type'] = 'present';
                    $goods_detail['promotion_name'] = '赠品活动';
                    return $goods_detail;
                }
            }
        }
        return [];
    }
}













