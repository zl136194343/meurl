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

namespace app\api\controller;

use app\model\order\CommunityOrder;
use app\model\verify\Verifier;
use app\model\verify\Verify as VerifyModel;

/**
 * 核销管理
 * @author Administrator
 *
 */
class Test extends BaseApi
{
    public function verify()
    {
        $model = new CommunityOrder();
        $res = $model->settlement(21);
        return json($res);
    }
    {
}