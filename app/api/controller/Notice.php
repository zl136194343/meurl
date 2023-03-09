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

use app\model\web\Notice as NoticeModel;

/**
 *
 * @author Administrator
 *
 */
class Notice extends BaseApi
{

    /**
     * 基础信息
     */
    public function info()
    {
        $id = isset($this->params[ 'id' ]) ? $this->params[ 'id' ] : 0;
        if (empty($id)) {
            return $this->response($this->error('', 'REQUEST_ID'));
        }
        $notice = new NoticeModel();
        $info = $notice->getNoticeInfo([ [ 'id', '=', $id ] ]);
        return $this->response($info);
    }

    public function page()
    {
        $page = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        $receiving_type = isset($this->params[ 'receiving_type' ]) ? $this->params[ 'receiving_type' ] : 'mobile';
        $notice = new NoticeModel();
        $list = $notice->getNoticePageList([ [ 'receiving_type', 'like', '%' . $receiving_type . '%' ] ], $page, $page_size);
        return $this->response($list);
    }

    /**
     * 公告列表
     * @return false|string
     */
    public function lists()
    {
        $id_arr = isset($this->params[ 'id_arr' ]) ? $this->params[ 'id_arr' ] : '';//id数组
        $notice = new NoticeModel();
        $condition = [
            [ 'receiving_type', 'like', '%mobile%' ],
        ];
        if (!empty($id_arr)) {
            $condition[] = [ 'id', 'in', $id_arr ];
        }
        $list = $notice->getNoticeList($condition);
        return $this->response($list);
    }

}