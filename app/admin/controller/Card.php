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

namespace app\admin\controller;

use addon\fenxiao\model\Fenxiao;

use app\model\dtgl\Card as CardModel;

use phpoffice\phpexcel\Classes\PHPExcel;
use phpoffice\phpexcel\Classes\PHPExcel\Writer\Excel2007;
use think\facade\Config;
use think\facade\Db;

/**
 * 名片 控制器
 */
class Card extends BaseAdmin
{
    /**
     * 会员列表
     */
    public function lists()
    {

        //判断分销是否存在

        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $card = new CardModel();
            $list = $card->getMemberPageList();
            return $list;
        } else {

            return $this->fetch('dtgl/card/lists');
        }
    }

    /**
     * 名片是否是推荐状态
     */
    public function modifyStatus()
    {
        if (request()->isAjax()) {
            $id = input('id', 0);
            $status = input('status', 0);
            $card = new CardModel();
            $condition = [['id','=',$id]];
            $list = $card->modifyCardStatus($status,$condition);
            return $list;
        }
    }
}