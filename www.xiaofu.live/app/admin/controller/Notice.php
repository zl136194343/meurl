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

use app\model\web\Notice as NoticeModel;

/**
 * 网站公告
 */
class Notice extends BaseAdmin
{

    /**
     * 公告管理
     * @return \think\mixed
     */
    public function index()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $limit = input('page_size', PAGE_LIST_ROWS);
            $condition = [];

            $receiving_type = input('type', '');
            if ($receiving_type) {
                $condition[] = [ 'type', '=',  $receiving_type  ];
            }
            /*$notice = new NoticeModel();*/

            $list = model('notice_gg')->pageList($condition,'','id desc',$page,$limit);
            return success(0,'',$list);
        }

        $is_addon_city = addon_is_exit('city');
        $this->assign('is_addon_city', $is_addon_city);
        return $this->fetch('notice/index');
    }

    /**
     * 公告管理
     * @return \think\mixed
     */
    public function noticeSelect()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $limit = input('page_size', PAGE_LIST_ROWS);
            $condition = [];
            $notice = new NoticeModel();
            $list = $notice->getNoticePageList($condition, $page, $limit);
            return $list;
        } else {
            $select_id = input('select_id', '');
            $this->assign('select_id', $select_id);

            return $this->fetch("notice/notice_select");
        }
    }

    /**
     * 公告add
     */
    public function addNotice()
    {

        if (request()->isAjax()) {
            $data = [
                'type' => input('type', ''),
                'content' => input('content', ''),
                'create_time'=>time(),
                'title'=>input('title', ''),
            ];



            /*$notice = new NoticeModel();
            $this->addLog("发布公告:" . $data[ 'title' ]);
            $res = $notice->addNotice($data);*/
            $res = model('notice_gg')->add($data);
            return $res;
        } else {

            $is_addon_city = addon_is_exit('city');
            $this->assign('is_addon_city', $is_addon_city);
            return $this->fetch('notice/add_notice');
        }
    }

    /**
     * 公告编辑
     */
    public function editNotice()
    {

        $notice = new NoticeModel();
        if (request()->isAjax()) {
            $id = input('id', 0);
            $data = [
                'type' => input('type', ''),
                'content' => input('content', ''),
                'update_time'=>time(),
                'title'=>input('title', ''),
            ];

            $res = model('notice_gg')->update($data,[ [ 'id', '=', $id ] ]);

//            $res = $notice->editNotice($data, [ [ 'id', '=', $id ] ]);
            return success(0,$res);
        } else {
            $id = input('id', 0);
            $info = model('notice_gg')->getInfo([ [ 'id', '=', $id ] ]);
            $this->assign('info', $info);

            $is_addon_city = addon_is_exit('city');
            $this->assign('is_addon_city', $is_addon_city);
            echo $this->fetch('notice/edit_notice');
        }
    }

    /**
     * 公告删除
     * @return string[]|mixed[]
     */
    public function deleteNotice()
    {
        if (request()->isAjax()) {
            $id = input('id', '');
            $res = model('notice_gg')->delete([ [ 'id', '=', $id ] ]);
            /*$notice = new NoticeModel();
            $res = $notice->deleteNotice([ [ 'id', 'in', $id ] ]);*/
            return $res;
        }
    }

    /**
     * 公告置顶
     */
    public function modifyNoticeTop()
    {
        $id = input('id', '');
        $notice = new NoticeModel();
        $res = $notice->editNotice([ 'is_top' => 1 ], [ [ 'id', '=', $id ] ]);
        return $res;
    }

}