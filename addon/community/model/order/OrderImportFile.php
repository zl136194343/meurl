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

namespace addon\community\model\order;


use app\model\BaseModel;

class OrderImportFile extends BaseModel
{

    /**
     * 详情
     * @param array $condition
     * @param string $filed
     * @return array
     */
    public function getOrderImportFileInfo($condition = [],$filed = '*')
    {
        $info = model('commander_order_import_file')->getInfo($condition,$filed);
        return $this->success($info);
    }

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function deleteOrderImportFile($id,$site_id)
    {
        model('commander_order_import_file')->startTrans();
        try {
            model('commander_order_import_file')->delete([['id', '=', $id],['site_id','=',$site_id]]);
            model('order_import_file_log')->delete([['file_id', '=', $id]]);

            model('commander_order_import_file')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('commander_order_import_file')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取导入文件列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getOrderImportFilePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'id desc', $field = '*')
    {
        $list = model('commander_order_import_file')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }


    /**
     * 获取导入文件列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getOrderImportFilePageLogList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'id desc', $field = '*', $alias = '', $join = '')
    {
        $list = model('commander_order_import_file_log')->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        return $this->success($list);
    }


}
