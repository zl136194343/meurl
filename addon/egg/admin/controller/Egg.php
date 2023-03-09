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

namespace addon\egg\admin\controller;

use app\model\games\Games;
use app\model\member\MemberLevel;
use app\admin\controller\BaseAdmin;

/**
 * 砸金蛋控制器
 */
class Egg extends BaseAdmin
{
    //游戏类型
    private $game_type = 'egg';
    private $game_type_name = '砸金蛋';
    private $game_url = '/promotionpages/game/smash_eggs/smash_eggs';

    /*
     *  砸金蛋活动列表
     */
    public function lists()
    {
        //获取续签信息
        if (request()->isAjax()) {

            $model = new Games();

            $condition = [
                [ 'site_id', '=', $this->site_id ],
                [ 'game_type', '=', $this->game_type ]
            ];

            $status = input('status', '');//砸金蛋状态
            if ($status) {
                $condition[] = [ 'status', '=', $status ];
            }
            //游戏活动名称
            $game_name = input('game_name', '');
            if ($game_name) {
                $condition[] = [ 'game_name', 'like', '%' . $game_name . '%' ];
            }

            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $list = $model->getGamesPageList($condition, $page, $page_size, 'game_id desc');
            return $list;
        } else {
            return $this->fetch("egg/lists");
        }
    }

    /**
     * 添加活动
     */
    public function add()
    {
        if (request()->isAjax()) {
            //获取商品信息
            $game_data = [
                'site_id' => $this->site_id,
                'game_name' => input('game_name', ''),
                'game_type' => $this->game_type,
                'game_type_name' => $this->game_type_name,
                'level_id' => input('level_id', ''),
                'level_name' => input('level_name', ''),
                'points' => input('points', ''),
                'start_time' => strtotime(input('start_time', '')),
                'end_time' => strtotime(input('end_time', '')),
                'remark' => input('remark', ''),
                'winning_rate' => input('winning_rate', ''),
                'no_winning_desc' => input('no_winning_desc', ''),
                'is_show_winner' => input('is_show_winner', ''),
                'join_type' => input('join_type', ''),
                'join_frequency' => input('join_frequency', '')
            ];

            $award_json = input('award_json', '');

            $model = new Games();
            return $model->addGames($game_data, $award_json);
        } else {
            //会员等级
            $member_level_model = new MemberLevel();
            $member_level_list = $member_level_model->getMemberLevelList([], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            return $this->fetch("egg/add");
        }
    }

    /**
     * 编辑活动
     */
    public function edit()
    {
        $model = new Games();
        $game_id = input('game_id');
        if (request()->isAjax()) {
            $game_data = [
                'game_id' => $game_id,
                'site_id' => $this->site_id,
                'game_name' => input('game_name', ''),
                'level_id' => input('level_id', ''),
                'level_name' => input('level_name', ''),
                'points' => input('points', ''),
                'start_time' => strtotime(input('start_time', '')),
                'end_time' => strtotime(input('end_time', '')),
                'remark' => input('remark', ''),
                'winning_rate' => input('winning_rate', ''),
                'no_winning_desc' => input('no_winning_desc', ''),
                'is_show_winner' => input('is_show_winner', ''),
                'join_type' => input('join_type', ''),
                'join_frequency' => input('join_frequency', '')
            ];

            $award_json = input('award_json', '');
            $delete_award_ids = input('delete_award_ids', '');
            return $model->editGames([ [ 'site_id', '=', $this->site_id ], [ 'game_id', '=', $game_id ] ], $game_data, $award_json, $delete_award_ids);
        } else {
            //会员等级
            $member_level_model = new MemberLevel();
            $member_level_list = $member_level_model->getMemberLevelList([], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //获取游戏详情
            $info = $model->getGamesDetail($this->site_id, $game_id);
            $this->assign('info', $info[ 'data' ]);
            return $this->fetch("egg/edit");
        }
    }

    /*
     *  砸金蛋详情
     */
    public function detail()
    {
        $egg_model = new Games();

        $game_id = input('game_id', '');
        //获取砸金蛋信息
        $info = $egg_model->getGamesDetail($this->site_id, $game_id);
        $this->assign('info', $info[ 'data' ]);
        return $this->fetch("egg/detail");
    }

    /*
     *  删除砸金蛋活动
     */
    public function delete()
    {
        $game_id = input('game_id', '');
        $site_id = $this->site_id;

        $egg_model = new Games();
        return $egg_model->deleteGames($site_id, $game_id);
    }

    /*
     *  结束砸金蛋活动
     */
    public function finish()
    {
        $game_id = input('game_id', '');
        $site_id = $this->site_id;

        $egg_model = new Games();
        return $egg_model->finishGames($site_id, $game_id);
    }

    /**
     * 游戏推广
     * return
     */
    public function gameUrl()
    {
        $game_id = input('game_id', '');
        $model = new Games();
        $game_info_data = $model->getGamesInfo([ [ 'game_id', '=', $game_id ] ], 'game_id,game_name');
        $game_info = $game_info_data[ 'data' ];
        $res = $model->qrcode($game_info[ 'game_id' ], $game_info[ 'game_name' ], $this->game_url, $this->site_id);
        return $res;
    }
}