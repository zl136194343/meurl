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
use app\model\community\Leader as LeaderModel;
use app\model\delivery\Clerk as ClerkModel;
use app\model\goods\Goods as GoodsModel;
use app\model\goods\GoodsCategory as GoodsCategoryModel;
use addon\community\model\order\CommunityOrder as CommunityOrderModel;
use addon\community\model\order\Config as ConfigModel;
use app\model\system\Cron;
use think\facade\Cache;

/**
 * 配送单
 * Class Order
 * @package app\model\delivery
 */
class Order extends BaseModel
{
    /**
     * 配送单状态 --- 待配送
     */
    const WAIT_DELIVERY = 0;

    /**
     * 配送单状态 --- 配送中
     */
    const IN_RECEIVE = 1;

    /**
     * 配送单状态 --- 已送达
     */
    const COMPLETED = 2;

    /**
     * 表名称
     */
    const TABLE_NAME = 'community_delivery';

    /**
     * 获取状态
     * @param null|int $status
     * @return array
     */
    public static function getStatus($status = null, $type = 'status')
    {
        $data   = array(
            array(
                'status'        => self::WAIT_DELIVERY,
                'name'          => '待配送',
                'color'         => 'red',
                'const'         => 'WAIT_DELIVERY',
                'action'        => [
                    [
                        'action' => 'delivery',
                        'name'   => '开始配送',
                        'color'  => ''
                    ],
                ],
                'clerk_action'  => [
                    [
                        'action' => 'delivery',
                        'name'   => '开始配送',
                        'color'  => ''
                    ]
                ],
                'leader_action' => []
            ),
            array(
                'status'        => self::IN_RECEIVE,
                'name'          => '配送中',
                'color'         => '#caab16',
                'const'         => 'IN_RECEIVE',
                'action'        => [
                    [
                        'action' => 'complete',
                        'name'   => '确认收货',
                        'color'  => ''
                    ]
                ],
                'clerk_action'  => [],
                'leader_action' => [
                    [
                        'action' => 'complete',
                        'name'   => '确认收货',
                        'color'  => ''
                    ]
                ]
            ),
            array(
                'status'        => self::COMPLETED,
                'name'          => '已送达',
                'color'         => 'green',
                'const'         => 'COMPLETED',
                'action'        => [
                    [
                        'action' => 'delete',
                        'name'   => '删除',
                        'color'  => ''
                    ]
                ],
                'clerk_action'  => [],
                'leader_action' => [],
            )
        );
        $result = [];
        if (is_null($status)) {
            $result = $data;
        } else {
            foreach ($data as $val) {
                if ($status == $val[$type]) {
                    $result = $val;
                    break;
                }
            }
        }
        return $result;
    }

    /**
     * 创建团购配送单
     * @param array $params
     * @return array
     */
    public function createOrder(array $params)
    {
        $site_id     = $params['site_id'] ?? 0;
        $site_name   = $params['site_name'] ?? '';
        $order_id    = $params['order_id'] ?? 0;
        $cl_id       = $params['cl_id'] ?? 0;
        $arrive_time = $params['arrive_time'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if (empty($order_id) || empty($cl_id) || empty($arrive_time)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        $data         = [
            'site_name'     => $site_name,
            'clerk_mobile'  => '',
            'clerk_headimg' => '',
        ];
        $leader_model = new LeaderModel();
        $clerk_model  = new ClerkModel();

        // 团长信息
        $leader_info = $leader_model->getLeaderInfo([
            ['site_id', '=', $site_id],
            ['cl_id', '=', $cl_id],
        ], 'member_id, name, mobile, full_address, address, community, community_img, line_id, line_name, clerk_id, clerk_name')['data'];
        if (empty($leader_info)) {
            return $this->error('', '团长不存在');
        }
        $data = array_merge($data, [
            'leader_name'          => $leader_info['name'],
            'leader_mobile'        => $leader_info['mobile'],
            'leader_full_address'  => $leader_info['full_address'],
            'leader_address'       => $leader_info['address'],
            'leader_community'     => $leader_info['community'],
            'leader_community_img' => $leader_info['community_img'],
            'line_id'              => $leader_info['line_id'],
            'line_name'            => $leader_info['line_name'],
            'clerk_id'             => $leader_info['clerk_id'],
            'clerk_name'           => $leader_info['clerk_name'],
        ]);

        // 配送员信息
        $clerk_info = $clerk_model->getClerkInfo([['clerk_id', '=', $leader_info['clerk_id']]], 'clerk_mobile, clerk_headimg')['data'];
        if (!empty($clerk_info)) {
            $data = array_merge($data, [
                'clerk_mobile'  => $clerk_info['clerk_mobile'],
                'clerk_headimg' => $clerk_info['clerk_headimg'],
            ]);
        }

        // 获取订单项商品数量(忽略已退款的)
        $goods_num = model('order_goods')->getSum([
            ['order_id', '=', $order_id],
            ['refund_status', '=', 0],
        ], 'num');

        // 根据团长和预计自提时间匹配现有待配送的配送单
        $info = $this->getOrderInfo([
            ['site_id', '=', $site_id],
            ['cl_id', '=', $cl_id],
            ['delivery_status', '=', self::WAIT_DELIVERY],
            ['arrive_time', '=', $arrive_time]
        ], 'delivery_id, delivery_no, order_num, goods_num')['data'];

        model(self::TABLE_NAME)->startTrans();
        try {
            if (empty($info)) {
                // 为空则新建配送单

                $delivery_no = $this->createOrderNo($site_id);
                $delivery_id = model(self::TABLE_NAME)->add(array_merge($data, [
                    'cl_id'            => $cl_id,
                    'leader_member_id' => $leader_info['member_id'],
                    'site_id'          => $site_id,
                    'delivery_no'      => $delivery_no,
                    'delivery_status'  => self::WAIT_DELIVERY,
                    'order_num'        => 1,
                    'goods_num'        => $goods_num,
                    'arrive_time'      => $arrive_time,
                    'create_time'      => time(),
                ]));
            } else {
                // 否则则累加更新配送单相应数据

                $delivery_no = $info['delivery_no'];
                $delivery_id = $info['delivery_id'];

                model(self::TABLE_NAME)->update(array_merge($data, [
                    'order_num'   => $info['order_num'] + 1,
                    'goods_num'   => $info['goods_num'] + $goods_num,
                    'update_time' => time(),
                ]), [['delivery_id', '=', $delivery_id]]);
            }

            $return_data = [
                'site_id'     => $site_id,
                'delivery_id' => $delivery_id,
                'delivery_no' => $delivery_no,
                'order_id'    => $order_id,
                'cl_id'       => $cl_id,
                'arrive_time' => $arrive_time,
            ];

            event('CreateCommunityDeliveryOrder', $return_data);

            model(self::TABLE_NAME)->commit();

            return $this->success($return_data);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 生成配送单
     * @param array $params
     * @return array
     */
    public function createCommunityDeliveryOrder(array $params)
    {
        $site_id   = $params['site_id'] ?? 0;
        $order_ids = $params['order_ids'] ?? '';

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        // 订单数据
        $condition = [
            ['order_type', '=', 5],
            ['order_status', '=', CommunityOrderModel::ORDER_PAY],
            ['site_id', '=', $site_id],
            ['delivery_id', '=', 0],
            ['cl_id', '>', 0],
        ];
        if (!empty($order_ids)) {
            $condition[] = ['order_id', 'in', (string)$order_ids];
        }

        $community_order_model = new CommunityOrderModel();
        $order_data            = $community_order_model->getOrderList($condition, 'order_id, site_name, cl_id, arrive_time')['data'];
        if (empty($order_data)) {
            return $this->error('', '订单不符合生成配送单的条件');
        }

        $data = [];
        foreach ($order_data as $key => $val) {
            $res = $this->createOrder(array_merge($val, [
                'site_id' => $site_id,
            ]));
            if ($res['code'] === 0) {
                $data[] = $res['data'];
            }
        }
        return $this->success($data);
    }

    /**
     * 增加生成配送单事件
     * @param $site_id
     * @param int $execute_time
     * @return array
     */
    public function addAutoCreateCommunityDeliveryOrderCron($site_id, $execute_time = 0)
    {
        $event = 'CronAutoCreateCommunityDeliveryOrder';
        if (!$execute_time) {
            $execute_time = time();
        }

        $cron_model = new Cron();
        $cron_model->deleteCron([['event', '=', $event], ['relate_id', '=', $site_id]]);
        return $cron_model->addCron(2, 1, '自动生成配送单', $event, $execute_time, $site_id, 1);
    }

    /**
     * 重置自动生成配送单任务时间
     * @param $site_id
     * @return array
     */
    public function resetCreateCommunityDeliveryOrderCronExecuteTime($site_id)
    {
        $config_model = new ConfigModel();
        $trade_config = $config_model->getTradeConfig($site_id)['data']['value'];

        // 发货的下单时间点
        $book_time = $trade_config['book_time'];
        // 发货的下单当天时间点
        $time = mktime(date('H', $book_time), date('i', $book_time), date('s', $book_time), date('m'), date('d'), date('Y'));
        // 执行延迟的分钟数
        $delay_minute = 0;
        // 执行时间
        $exec_time = 0;

        if ($book_time > 0) {
            switch ($trade_config['delivery_type']) {
                // 当日达
                case 1:
                    $exec_time = $time + ($delay_minute * 60);
                    break;
                // 次日达
                case 2:
                    $exec_time = mktime(0, $delay_minute, 0, date('m', $time), date('d', $time) + 1, date('Y', $time));
                    break;
                // 隔日达
                case 3:
                    $exec_time = mktime(0, $delay_minute, 0, date('m', $time), date('d', $time) + 2, date('Y', $time));
                    break;
            }

            if ($exec_time) {
                $condition = [['event', '=', 'CronAutoCreateCommunityDeliveryOrder'], ['relate_id', '=', $site_id]];

                $cron_model = new Cron();
                $cron_info  = $cron_model->getCronInfo($condition, 'execute_time')['data'];
                if (empty($cron_info)) {
                    return $this->addAutoCreateCommunityDeliveryOrderCron($site_id, $exec_time);
                } else {
                    return $cron_model->resetCronExecuteTime($condition, $exec_time);
                }
            }
        }

        return $this->success();
    }

    /**
     * 生成配送单编号
     * @param $site_id
     * @return string
     */
    public function createOrderNo($site_id)
    {
        $time_str   = date('YmdHi');
        $cache_name = 'delivery_' . __FUNCTION__ . '_' . $site_id . '_' . $time_str;
        $max_no     = Cache::get($cache_name);
        if (!isset($max_no) || empty($max_no)) {
            $max_no = 1;
        } else {
            $max_no = $max_no + 1;
        }
        $order_no = $time_str . $site_id . sprintf('%03d', $max_no);
        Cache::set($cache_name, $max_no);
        return $order_no;
    }

    /**
     * 配送单配送
     * @param array $condition
     * @return array
     */
    public function orderDelivery(array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;
        $clerk_id        = $check_condition['clerk_id'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        // 重组条件
        $condition = array_merge($condition, [
            ['delivery_status', '=', self::WAIT_DELIVERY]
        ]);
        if (empty($clerk_id)) {
            $condition[] = [['clerk_id', '>', 0]];
        }

        $res = model(self::TABLE_NAME)->update([
            'delivery_status' => self::IN_RECEIVE,
            'delivery_time'   => time(),
        ], $condition);

        return $this->success($res);
    }

    /**
     * 配送单送达
     * @param array $condition
     * @return array
     */
    public function orderComplete(array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        // 重组条件
        $condition = array_merge($condition, [
            ['delivery_status', '=', self::IN_RECEIVE]
        ]);

        // 查询需要送达的配送单
        $data = $this->getOrderList($condition, 'delivery_id')['data'];
        if (empty($data)) {
            return $this->success();
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            model(self::TABLE_NAME)->update([
                'delivery_status' => self::COMPLETED,
                'complete_time'   => time(),
            ], $condition);

            // 执行送达完成后的事件
            event('CommunityDeliveryOrderComplete', ['delivery_data' => $data, 'site_id' => $site_id]);

            model(self::TABLE_NAME)->commit();

            return $this->success([]);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 更新配送单基础信息 -- 只针对待配送的
     * @param $site_id
     * @param $delivery_ids
     * @return array
     */
    public function updateOrder($site_id, $delivery_ids)
    {
        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $condition = [['site_id', '=', $site_id], ['delivery_status', '=', self::WAIT_DELIVERY], ['is_delete', '=', 0]];
        if (!empty($delivery_ids)) {
            $condition[] = [['delivery_id', 'in', (string)$delivery_ids]];
        }

        // 配送单数据
        $data = $this->getOrderList($condition, 'delivery_id, cl_id')['data'];

        $leader_model = new LeaderModel();
        $clerk_model  = new ClerkModel();

        model(self::TABLE_NAME)->startTrans();
        try {
            foreach ($data as $key => $val) {

                $item_data = [
                    'clerk_mobile'  => '',
                    'clerk_headimg' => '',
                ];

                // 团长信息
                $leader_info = $leader_model->getLeaderInfo([
                    ['site_id', '=', $site_id],
                    ['cl_id', '=', $val['cl_id']],
                ], 'member_id, name, mobile, full_address, address, community, community_img, line_id, line_name, clerk_id, clerk_name')['data'];
                if (empty($leader_info)) continue;

                $item_data = array_merge($item_data, [
                    'leader_name'          => $leader_info['name'],
                    'leader_mobile'        => $leader_info['mobile'],
                    'leader_full_address'  => $leader_info['full_address'],
                    'leader_address'       => $leader_info['address'],
                    'leader_community'     => $leader_info['community'],
                    'leader_community_img' => $leader_info['community_img'],
                    'line_id'              => $leader_info['line_id'],
                    'line_name'            => $leader_info['line_name'],
                    'clerk_id'             => $leader_info['clerk_id'],
                    'clerk_name'           => $leader_info['clerk_name'],
                ]);

                // 配送员信息
                $clerk_info = $clerk_model->getClerkInfo([['clerk_id', '=', $leader_info['clerk_id']]], 'clerk_mobile, clerk_headimg')['data'];
                if (!empty($clerk_info)) {
                    $item_data = array_merge($item_data, [
                        'clerk_mobile'  => $clerk_info['clerk_mobile'],
                        'clerk_headimg' => $clerk_info['clerk_headimg'],
                    ]);
                }

                model(self::TABLE_NAME)->update(array_merge($item_data, [
                    'update_time' => time(),
                ]), [['delivery_id', '=', $val['delivery_id']]]);
            }
            model(self::TABLE_NAME)->commit();
            return $this->success();
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 删除配送单
     * @param $role_type
     * @param array $condition
     * @return array
     */
    public function deleteOrder($role_type, array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        // 只能删除已完成的配送单, 后续其他状态若需要删除时, 需要重新考虑
        $condition = array_merge($condition, [['delivery_status', '=', self::COMPLETED]]);
        $data      = [];

        switch ($role_type) {
            // 商家
            case 'site':
                $data = ['is_delete' => 1];
                break;
            // 配送员
            case 'clerk':
                $data = ['clerk_is_delete' => 1];
                break;
            // 团长
            case 'leader':
                $data = ['leader_is_delete' => 1];
                break;
        }
        if (empty($data)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        $res = model(self::TABLE_NAME)->update($data, $condition);
        return $this->success($res);
    }

    /**
     * 获取配送单信息
     * @param $condition
     * @param bool $field
     * @return array
     */
    public function getOrderInfo(array $condition, $field = true)
    {
        $res = model(self::TABLE_NAME)->getInfo($condition, $field);
        $res = $this->handleData($res);
        return $this->success($res);
    }

    /**
     * 获取配送单列表
     * @param array $condition
     * @param mixed $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getOrderList(array $condition = [], $field = true, $order = 'delivery_id desc', $limit = null)
    {
        $res = model(self::TABLE_NAME)->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($res as $key => $val) {
            $res[$key] = $this->handleData($val);
        }
        return $this->success($res);
    }

    /**
     * 获取配送单分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param bool $field
     * @param string $alias
     * @param array $join
     * @return array
     */
    public function getOrderPageList(array $condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'delivery_id desc', $field = true, $alias = '', $join = [])
    {
        $res = model(self::TABLE_NAME)->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        foreach ($res['list'] as $key => $val) {
            $res['list'][$key] = $this->handleData($val);
        }
        return $this->success($res);
    }

    /**
     * 获取配送单数量
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getOrderCount($condition, $field = 'delivery_id')
    {
        $res = model(self::TABLE_NAME)->getCount($condition, $field);
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
            if (isset($info['delivery_status'])) {
                $info['delivery_status_info'] = self::getStatus($info['delivery_status']);
            }
        }
        return $info;
    }

    /**
     * 获取商品汇总
     * @param array $condition
     * @return array
     */
    public function getGoodsGather(array $condition)
    {
        // 数据整理
        $data = [];
        // 配送单数据
        $info = $this->getOrderInfo($condition, 'delivery_id, site_id, site_name, delivery_no')['data'];

        if (!empty($info)) {
            $site_id = $info['site_id'];

            $community_order_model = new CommunityOrderModel();
            $goods_category_model  = new GoodsCategoryModel();
            $goods_model           = new GoodsModel();

            // 配送单关联的订单数据
            $order_data = $community_order_model->getOrderList([
                ['delivery_id', '=', $info['delivery_id']],
                ['site_id', '=', $site_id],
            ], 'order_id')['data'];

            // 分类缓冲数据
            $goods_category_data = [];

            foreach ($order_data as $order_info) {

                // 查询订单项 (忽略已退款的)
                $order_goods_data = $community_order_model->getOrderGoodsList([
                    ['order_id', '=', $order_info['order_id']],
                    ['refund_status', '=', 0],
                    ['site_id', '=', $site_id],
                ], 'goods_id, sku_id, sku_name, num, goods_money, sku_image')['data'];

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

        $temp_data = [];
        foreach ($data as $val) $temp_data[] = $val;
        $data = $temp_data;
        return $this->success([
            'data' => $data,
            'info' => $info
        ]);
    }

    /**
     * 获取团长对货单
     * @param array $condition
     * @return array
     */
    public function getLeaderInvoice(array $condition)
    {
        // 数据整理
        $data = [];
        // 配送单数据
        $info = $this->getOrderInfo($condition, 'delivery_id, site_id, site_name, delivery_no, cl_id, leader_name, leader_mobile, leader_community, leader_full_address, leader_address, clerk_name, clerk_mobile, line_name')['data'];

        if (!empty($info)) {
            $site_id = $info['site_id'];
            $data    = [
                // 团长信息
                'leader_info'  => $info,
                // 商品汇总
                'goods_gather' => [],
                // 客户明细
                'order_goods'  => []
            ];
            // 分类缓冲数据
            $goods_category_data = [];

            $community_order_model = new CommunityOrderModel();
            $goods_category_model  = new GoodsCategoryModel();
            $goods_model           = new GoodsModel();

            // 配送单关联的订单数据
            $order_data = $community_order_model->getOrderList([
                ['delivery_id', '=', $info['delivery_id']],
                ['site_id', '=', $site_id],
            ], 'order_id, order_no, name, mobile')['data'];

            foreach ($order_data as $order_info) {

                // 查询订单项 (忽略已退款的)
                $order_goods_data = $community_order_model->getOrderGoodsList([
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
                    if (!isset($data['goods_gather'][$order_goods_info['sku_id']])) {
                        $data['goods_gather'][$order_goods_info['sku_id']] = array_merge($order_goods_info, [
                            'category_name_1' => $goods_category_data[$order_goods_info['goods_id']],
                            'serial'          => count($data['goods_gather']) + 1
                        ]);
                    } else {
                        $data['goods_gather'][$order_goods_info['sku_id']] = array_merge($data['goods_gather'][$order_goods_info['sku_id']], [
                            'num'         => $data['goods_gather'][$order_goods_info['sku_id']]['num'] + $order_goods_info['num'],
                            'goods_money' => $data['goods_gather'][$order_goods_info['sku_id']]['goods_money'] + $order_goods_info['goods_money'],
                        ]);
                    }

                    // 客户明细数据整理
                    $data['order_goods'][] = array_merge($order_goods_info, [
                        'serial'                   => count($data['order_goods']) + 1,
                        'order_no'                 => $order_info['order_no'],
                        'delivery_no'              => $info['delivery_no'],
                        'receiver_name_and_mobile' => $order_info['name'] . ' ' . $order_info['mobile'],
                        'category_name_1'          => $goods_category_data[$order_goods_info['goods_id']]
                    ]);
                }
            }
        }
        return $this->success([
            'data' => $data,
            'info' => $info
        ]);
    }
}