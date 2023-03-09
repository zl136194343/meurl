<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\community\model\delivery;

use app\model\BaseModel;
use addon\community\model\delivery\Order as DeliveryOrderModel;
use app\model\community\Goods as GoodsModel;
use app\model\community\GoodsCategory as GoodsCategoryModel;
use app\model\order\OrderCommon as OrderCommonModel;
use extend\excel\Export as ExcelExport;

/**
 * 导出
 * Class Export
 * @package app\model\delivery
 */
class Export extends BaseModel
{
    /**
     * 状态 -- 待执行
     */
    const WAIT_EXEC = 0;

    /**
     * 状态 -- 执行中
     */
    const IN_EXEC = 1;

    /**
     * 状态 -- 已执行
     */
    const COMPLETED = 2;

    /**
     * 状态 -- 执行失败
     */
    const EXEC_FAIL = 3;


    /**
     * 导出主体类型 -- 商品出库单
     */
    const EXPORT_GOODS_GATHER = 'goods_gather';

    /**
     * 导出主体类型 -- 团长对货单
     */
    const EXPORT_LEADER_INVOICE = 'leader_invoice';


    /**
     * 表名称
     */
    const TABLE_NAME = 'community_delivery_export';


    /**
     * 获取状态
     * @param null|int $status
     * @return array
     */
    public static function getStatus($status = null)
    {
        $data   = array(
            array(
                'status' => self::WAIT_EXEC,
                'name'   => '待执行',
                'color'  => 'red',
                'const'  => 'WAIT_EXEC'
            ),
            array(
                'status' => self::IN_EXEC,
                'name'   => '执行中',
                'color'  => '#caab16',
                'const'  => 'IN_EXEC'
            ),
            array(
                'status' => self::COMPLETED,
                'name'   => '已完成',
                'color'  => 'green',
                'const'  => 'COMPLETED'
            ),
            array(
                'status' => self::EXEC_FAIL,
                'name'   => '已失败',
                'color'  => 'red',
                'const'  => 'EXEC_FAIL'
            ),
        );
        $result = [];
        if (is_null($status)) {
            $result = $data;
        } else {
            foreach ($data as $val) {
                if ($status == $val['status']) {
                    $result = $val;
                    break;
                }
            }
        }
        return $result;
    }

    /**
     * 获取类型
     * @param null $type
     * @return array
     */
    public static function getType($type = null)
    {
        $data   = array(
            array(
                'type'  => self::EXPORT_GOODS_GATHER,
                'name'  => '商品出库单',
                'const' => 'EXPORT_GOODS_GATHER'
            ),
            array(
                'type'  => self::EXPORT_LEADER_INVOICE,
                'name'  => '团长对货单',
                'const' => 'EXPORT_LEADER_INVOICE'
            )
        );
        $result = [];
        if (is_null($type)) {
            $result = $data;
        } else {
            foreach ($data as $val) {
                if ($type == $val['type']) {
                    $result = $val;
                    break;
                }
            }
        }
        return $result;
    }


    /**
     * 添加导出记录
     * @param array $params
     * @return array
     */
    public function addExport(array $params)
    {
        $site_id = $params['site_id'] ?? 0;
        $type    = $params['type'] ?? '';

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if (empty($type)) {
            return $this->error('', '导出主体类型错误');
        }

        if (empty($this->getType($type))) {
            return $this->error('', '导出主体类型错误');
        }

        $res = model(self::TABLE_NAME)->add([
            'site_id'        => $site_id,
            'type'           => $type,
            'name'           => $params['name'],
            'condition'      => $params['condition'],
            'condition_desc' => $params['condition_desc'],
            'status'         => self::WAIT_EXEC,
            'create_time'    => time(),
        ]);
        return $this->success($res);
    }

    /**
     * 执行开始
     * @param $export_id
     * @param $site_id
     * @return array
     */
    private function execStart($export_id, $site_id)
    {
        $res = model(self::TABLE_NAME)->update([
            'status'          => self::IN_EXEC,
            'exec_start_time' => time(),
        ], [['export_id', '=', $export_id], ['site_id', '=', $site_id], ['status', '=', self::WAIT_EXEC]]);
        return $this->success($res);
    }

    /**
     * 执行完成
     * @param $export_id
     * @param $site_id
     * @return array
     */
    private function execComplete($export_id, $site_id, $path)
    {
        $res = model(self::TABLE_NAME)->update([
            'status'        => self::COMPLETED,
            'exec_end_time' => time(),
            'result'        => $path,
        ], [['export_id', '=', $export_id], ['site_id', '=', $site_id], ['status', '=', self::IN_EXEC]]);
        return $this->success($res);
    }

    /**
     * 执行失败
     * @param $export_id
     * @param $site_id
     * @param $fail_reason
     * @return array
     */
    private function execFail($export_id, $site_id, $fail_reason)
    {
        $res = model(self::TABLE_NAME)->update([
            'status' => self::EXEC_FAIL,
            'result' => $fail_reason,
        ], [['export_id', '=', $export_id], ['site_id', '=', $site_id], ['status', '=', self::IN_EXEC]]);
        return $this->success($res);
    }

    /**
     * 重执
     * @param $export_id
     * @param $site_id
     * @return array
     */
    public function resetExport($export_id, $site_id)
    {
        $condition = [
            ['export_id', '=', $export_id],
            ['site_id', '=', $site_id]
        ];

        $info = $this->getExportInfo($condition, 'status, result')['data'];
        if (empty($info)) {
            return $this->error('', '导出记录不存在');
        } elseif (!in_array($info['status'], [self::WAIT_EXEC, self::COMPLETED, self::EXEC_FAIL])) {
            return $this->error('', '不符合重执要求');
        }

        // 删除文件
        if ($info['status'] === self::COMPLETED) {
            @unlink($info['result']);
        }

        $res = model(self::TABLE_NAME)->update([
            'status'          => self::WAIT_EXEC,
            'result'          => '',
            'exec_start_time' => 0,
            'exec_end_time'   => 0,
        ], $condition);
        return $this->success($res);
    }

    /**
     * 删除导出记录
     * @param array $condition
     * @return array
     */
    public function deleteExport(array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = $this->getExportList($condition, 'status, result')['data'];
        if (empty($data)) {
            $this->success();
        } else {
            foreach ($data as $val) {

                // 删除文件
                if ($val['status'] === self::COMPLETED) {
                    @unlink($val['result']);
                }
            }
        }
        $res = model(self::TABLE_NAME)->delete($condition);
        return $this->success($res);
    }

    /**
     * 获取导出记录信息
     * @param $condition
     * @param bool $field
     * @return array
     */
    public function getExportInfo($condition, $field = true)
    {
        $res = model(self::TABLE_NAME)->getInfo($condition, $field);
        $res = $this->handleData($res);
        return $this->success($res);
    }

    /**
     * 获取导出记录列表
     * @param array $condition
     * @param mixed $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getExportList($condition = [], $field = true, $order = 'export_id desc', $limit = null)
    {
        $res = model(self::TABLE_NAME)->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($res as $key => $val) {
            $res[$key] = $this->handleData($val);
        }
        return $this->success($res);
    }

    /**
     * 获取导出记录分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param bool $field
     * @param string $alias
     * @param array $join
     * @return array
     */
    public function getExportPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'export_id desc', $field = true, $alias = '', $join = [])
    {
        $res = model(self::TABLE_NAME)->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        foreach ($res['list'] as $key => $val) {
            $res['list'][$key] = $this->handleData($val);
        }
        return $this->success($res);
    }

    /**
     * 处理数据
     * @param $info
     * @return mixed
     */
    private function handleData($info)
    {
        if (!empty($info)) {
            if (isset($info['status'])) {
                $info['status_info'] = self::getStatus($info['status']);
            }
            if (isset($info['type'])) {
                $info['type_info'] = self::getType($info['type']);
            }
            if (isset($info['condition'])) {
                $info['condition'] = !empty($info['condition']) ? json_decode($info['condition'], true) : [];
            }
            if (isset($info['condition_desc'])) {
                $info['condition_desc'] = !empty($info['condition_desc']) ? json_decode($info['condition_desc'], true) : [];
            }
        }
        return $info;
    }

    /**
     * 执行导出
     * @param $export_id
     * @param $site_id
     * @return array
     */
    public function execExport($export_id, $site_id)
    {
        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $info = $this->getExportInfo([['export_id', '=', $export_id], ['site_id', '=', $site_id]])['data'];
        if (empty($info)) {
            return $this->error('', '导出记录不存在');
        }

        if ($info['status'] !== self::WAIT_EXEC) {
            return $this->error('', '必须为' . self::getStatus(self::WAIT_EXEC)['name'] . '状态');
        }

        // 执行开始
        $this->execStart($export_id, $site_id);

        if ($info['type'] === self::EXPORT_GOODS_GATHER) {
            $res = $this->exportGoodsGather($info['condition'], $site_id, $info['name']);
        } elseif ($info['type'] === self::EXPORT_LEADER_INVOICE) {
            $res = $this->exportLeaderInvoice($info['condition'], $site_id, $info['name']);
        } else {
            return $this->error('', '导出主体类型错误');
        }

        // 执行结果
        if ($res['code'] === 0) {
            $this->execComplete($export_id, $site_id, $res['data']['path']);
        } else {
            $this->execFail($export_id, $site_id, $res['message']);
        }

        return $res;
    }

    /**
     * 商品汇总出库单
     * @param array $condition
     * @param $site_id
     * @param $file_name
     * @return array
     */
    private function exportGoodsGather(array $condition, $site_id, $file_name)
    {
        // 数据整理
        $data = [];
        // 分类数据
        $goods_category_data = [];

        $delivery_order_model = new DeliveryOrderModel();
        $order_common_model   = new OrderCommonModel();
        $goods_category_model = new GoodsCategoryModel();
        $goods_model          = new GoodsModel();

        // 配送单数据
        $delivery_order_data = $delivery_order_model->getOrderList($condition, 'delivery_id')['data'];
        foreach ($delivery_order_data as $key => $val) {

            // 配送单关联的订单数据
            $order_data = $order_common_model->getOrderList([
                ['delivery_id', '=', $val['delivery_id']],
                ['site_id', '=', $site_id],
            ], 'order_id')['data'];

            foreach ($order_data as $order_info) {

                // 查询订单项 (忽略已退款的)
                $order_goods_data = $order_common_model->getOrderGoodsList([
                    ['order_id', '=', $order_info['order_id']],
                    ['refund_status', '=', 0],
                    ['site_id', '=', $site_id],
                ], 'goods_id, sku_id, sku_name, num, goods_money')['data'];

                foreach ($order_goods_data as $order_goods_key => $order_goods_info) {

                    // 查找商品分类
                    if (!isset($goods_category_data[$order_goods_info['goods_id']])) {
                        $category_name = '';
                        $goods_info    = $goods_model->getGoodsInfo([
                            ['goods_id', '=', $order_goods_info['goods_id']],
                            ['site_id', '=', $site_id],
                        ], 'category_id')['data'];
                        if (!empty($goods_info) && !empty($goods_info['category_id'])) {
                            $category_id = trim($goods_info['category_id'], ',');

                            if (!empty($category_id)) {
                                $category_id_1 = explode(',', $category_id)[0];

                                $category_info = $goods_category_model->getCategoryInfo([
                                    ['category_id', '=', $category_id_1],
                                    ['site_id', '=', $site_id],
                                ], 'category_name')['data'];
                                $category_name = !empty($category_info) ? $category_info['category_name'] : '';
                            }
                        }
                        $goods_category_data[$order_goods_info['goods_id']] = $category_name;
                    }

                    // 商品汇总数据整理
                    if (!isset($data[$order_goods_info['sku_id']])) {
                        $data[$order_goods_info['sku_id']] = array_merge($order_goods_info, [
                            'category_name_1' => $goods_category_data[$order_goods_info['goods_id']],
                            'serial'          => count($data) + 1
                        ]);
                    } else {
                        $data[$order_goods_info['sku_id']] = array_merge($data[$order_goods_info['sku_id']], [
                            'num'         => $data[$order_goods_info['sku_id']]['num'] + $order_goods_info['num'],
                            'goods_money' => $data[$order_goods_info['sku_id']]['goods_money'] + $order_goods_info['goods_money'],
                        ]);
                    }
                }
            }
        }

        $ds   = DIRECTORY_SEPARATOR;
        $path = __UPLOAD__ . $ds . $site_id . $ds . 'delivery_order_export' . $ds . $file_name;
        try {
            $excel_export = new ExcelExport();
            $res          = $excel_export->saveFile($path, [
                'head_title'  => [
                    'value' => '商品汇总'
                ],
                'cell_header' => [
                    array(
                        'field' => 'serial',
                        'name'  => '序号',
                        'width' => 8,
                    ),
                    array(
                        'field'   => 'sku_name',
                        'name'    => '商品',
                        'width'   => 70,
                    ),
                    array(
                        'field'   => 'category_name_1',
                        'name'    => '一级分类',
                        'width'   => 20,
                    ),
                    array(
                        'field' => 'num',
                        'name'  => '数量',
                        'width' => 12,
                    ),
                    array(
                        'field' => 'goods_money',
                        'name'  => '总价',
                        'width' => 12,
                    ),
                ],
                'data'        => $data,
            ]);
            return $this->success([
                'path' => $res
            ]);
        } catch (\Exception $e) {
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 团长对货单
     * @param array $condition
     * @param $site_id
     * @param $file_name
     * @return array
     */
    private function exportLeaderInvoice(array $condition, $site_id, $file_name)
    {
        // 数据整理
        $data = [];
        // 分类缓冲数据
        $goods_category_data = [];

        $delivery_order_model = new DeliveryOrderModel();
        $order_common_model   = new OrderCommonModel();
        $goods_category_model = new GoodsCategoryModel();
        $goods_model          = new GoodsModel();

        // 配送单数据
        $delivery_order_field = 'delivery_id, delivery_no, cl_id, leader_name, leader_mobile, leader_community, leader_full_address, leader_address, clerk_name, clerk_mobile, line_name';
        $delivery_order_data  = $delivery_order_model->getOrderList($condition, $delivery_order_field)['data'];

        foreach ($delivery_order_data as $key => $val) {

            // 按团长分配
            if (!isset($data[$val['cl_id']])) {

                $data[$val['cl_id']] = [
                    // 团长信息
                    'leader_info'  => array_merge($val, ['leader_full_address' => $val['leader_full_address'] . $val['leader_address']]),
                    // 商品汇总
                    'goods_gather' => [],
                    // 客户明细
                    'order_goods'  => []
                ];
            }

            // 配送单关联的订单数据
            $order_data = $order_common_model->getOrderList([
                ['delivery_id', '=', $val['delivery_id']],
                ['site_id', '=', $site_id],
            ], 'order_id, order_no, name, mobile')['data'];

            foreach ($order_data as $order_info) {

                // 查询订单项 (忽略已退款的)
                $order_goods_data = $order_common_model->getOrderGoodsList([
                    ['order_id', '=', $order_info['order_id']],
                    ['refund_status', '=', 0],
                    ['site_id', '=', $site_id],
                ], 'goods_id, sku_id, sku_name, num, goods_money')['data'];

                foreach ($order_goods_data as $order_goods_key => $order_goods_info) {

                    // 查找商品分类
                    if (!isset($goods_category_data[$order_goods_info['goods_id']])) {
                        $category_name = '';
                        $goods_info    = $goods_model->getGoodsInfo([
                            ['goods_id', '=', $order_goods_info['goods_id']],
                            ['site_id', '=', $site_id],
                        ], 'category_id')['data'];
                        if (!empty($goods_info) && !empty($goods_info['category_id'])) {
                            $category_id = trim($goods_info['category_id'], ',');

                            if (!empty($category_id)) {
                                $category_id_1 = explode(',', $category_id)[0];

                                $category_info = $goods_category_model->getCategoryInfo([
                                    ['category_id', '=', $category_id_1],
                                    ['site_id', '=', $site_id],
                                ], 'category_name')['data'];
                                $category_name = !empty($category_info) ? $category_info['category_name'] : '';
                            }
                        }
                        $goods_category_data[$order_goods_info['goods_id']] = $category_name;
                    }

                    // 商品汇总数据整理
                    $goods_gather = $data[$val['cl_id']]['goods_gather'];
                    if (!isset($goods_gather[$order_goods_info['sku_id']])) {
                        $goods_gather[$order_goods_info['sku_id']] = array_merge($order_goods_info, [
                            'category_name_1' => $goods_category_data[$order_goods_info['goods_id']],
                            'serial'          => count($goods_gather) + 1
                        ]);
                    } else {
                        $goods_gather[$order_goods_info['sku_id']] = array_merge($goods_gather[$order_goods_info['sku_id']], [
                            'num'         => $goods_gather[$order_goods_info['sku_id']]['num'] + $order_goods_info['num'],
                            'goods_money' => $goods_gather[$order_goods_info['sku_id']]['goods_money'] + $order_goods_info['goods_money'],
                        ]);
                    }
                    $data[$val['cl_id']]['goods_gather'] = $goods_gather;

                    // 客户明细数据整理
                    $data[$val['cl_id']]['order_goods'][] = array_merge($order_goods_info, [
                        'serial'                   => count($data[$val['cl_id']]['order_goods']) + 1,
                        'order_no'                 => ' ' . $order_info['order_no'],
                        'delivery_no'              => ' ' . $val['delivery_no'],
                        'receiver_name_and_mobile' => $order_info['name'] . ' ' . $order_info['mobile'],
                        'category_name_1'          => $goods_category_data[$order_goods_info['goods_id']]
                    ]);
                }
            }
        }

        $export_data = [];
        foreach ($data as $key => $val) {
            $export_data[] = array(
                array(
                    'head_title'  => [
                        'value' => '团长信息'
                    ],
                    'cell_header' => array(
                        array(
                            'field' => 'leader_name',
                            'name'  => '团长名称',
                        ),
                        array(
                            'field' => 'leader_mobile',
                            'name'  => '团长手机'
                        ),
                        array(
                            'field'   => 'leader_community',
                            'name'    => '自提点',
                            'colspan' => 2,
                        ),
                        array(
                            'field'   => 'leader_full_address',
                            'name'    => '详细地址',
                            'colspan' => 3,
                        ),
                        array(
                            'field' => 'line_name',
                            'name'  => '路线名称'
                        ),
                        array(
                            'field' => 'clerk_name',
                            'name'  => '配送员名称'
                        ),
                        array(
                            'field' => 'clerk_mobile',
                            'name'  => '配送员手机'
                        ),
                    ),
                    'data'        => [$val['leader_info']],
                ),
                array(
                    'head_title'  => [
                        'value' => '商品汇总'
                    ],
                    'cell_header' => array(
                        array(
                            'field' => 'serial',
                            'name'  => '序号',
                        ),
                        array(
                            'field'   => 'sku_name',
                            'name'    => '商品',
                            'colspan' => 6,
                        ),
                        array(
                            'field'   => 'category_name_1',
                            'name'    => '一级分类',
                        ),
                        array(
                            'field' => 'num',
                            'name'  => '数量',
                        ),
                        array(
                            'field' => 'goods_money',
                            'name'  => '总价',
                        ),
                    ),
                    'data'        => $val['goods_gather'],
                ),
                array(
                    'head_title'  => [
                        'value' => '客户明细'
                    ],
                    'cell_header' => array(
                        array(
                            'field' => 'serial',
                            'name'  => '序号',
                        ),
                        array(
                            'field' => 'order_no',
                            'name'  => '订单编号',
                        ),
                        array(
                            'field' => 'delivery_no',
                            'name'  => '配送单编号',
                        ),
                        array(
                            'field' => 'receiver_name_and_mobile',
                            'name'  => '收货人名称/手机号',
                        ),
                        array(
                            'field' => 'sku_name',
                            'name'  => '商品',
                            'colspan' => 3,
                        ),
                        array(
                            'field' => 'category_name_1',
                            'name'  => '一级分类',
                        ),
                        array(
                            'field' => 'num',
                            'name'  => '数量',
                        ),
                        array(
                            'field' => 'goods_money',
                            'name'  => '商品总价',
                        ),
                    ),
                    'data'        => $val['order_goods'],
                )
            );
        }

        $ds   = DIRECTORY_SEPARATOR;
        $path = __UPLOAD__ . $ds . $site_id . $ds . 'delivery_order_export' . $ds . $file_name;

        try {
            $excel_export = new ExcelExport();
            $res          = $excel_export->saveFile($path, $export_data);
            return $this->success([
                'path' => $res
            ]);
        } catch (\Exception $e) {
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }
}