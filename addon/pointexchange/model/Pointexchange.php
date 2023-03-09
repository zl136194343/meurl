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

namespace addon\pointexchange\model;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;
use think\facade\Cache;

/**
 * 会员消费
 */
class Pointexchange extends BaseModel
{
    /**
     * 会员消费设置
     * array $data
     */
    public function setConfig($data, $condition)
    {
        $website_count = model('promotion_exchange_banner')->getCount($condition);
        if ($website_count == 0) {
            $data['create_time'] = time();
            $res = model('promotion_exchange_banner')->add($data);
        } else {
            $data['modify_time'] = time();
            $res = model('promotion_exchange_banner')->update($data, $condition);
        }
        return $this->success($res);
    }

    /**
     * 会员消费设置
     */
    public function getConfig($condition)
    {
        $res = model('promotion_exchange_banner')->getInfo($condition,"banner1,banner2,banner3,banner4,banner5");
        return $this->success($res);
    }

}