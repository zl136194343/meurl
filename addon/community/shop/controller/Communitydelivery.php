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

namespace addon\community\shop\controller;

use addon\community\model\delivery\Clerk as ClerkModel;
use addon\community\model\delivery\Line as LineModel;
use addon\community\model\delivery\Order as DeliveryOrderModel;
use addon\community\model\delivery\Export as DeliveryExportModel;
use app\model\member\Member as MemberModel;
use addon\community\model\order\CommunityOrder as CommunityOrderModel;

/**
 * 社区团购 配送
 * Class Communitydelivery
 * @package app\shop\controller
 */
class Communitydelivery extends BaseShop
{

    /******************************* 配送单 start ******************************************/

    /**
     * 配送单列表
     */
    public function orderList()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size  = input('page_size', PAGE_LIST_ROWS);

            $condition = $this->commonOrderCondition()['condition'];

            $delivery_order_model = new DeliveryOrderModel();
            $res                  = $delivery_order_model->getOrderPageList($condition, $page_index, $page_size);
            return $res;
        } else {
            $this->assign([
                'field_list'  => $this->commonOrderCondition()['field_list'],
                'status_data' => DeliveryOrderModel::getStatus()
            ]);
            return $this->fetch('community_delivery/order/lists');
        }
    }

    /**
     * 配送单公共条件
     * @return array
     */
    private function commonOrderCondition()
    {
        $field_list = [
            'select' => [
                'delivery_no'      => '配送单号',
                'leader_community' => '自提点',
                'leader_name'      => '团长名称',
                'leader_mobile'    => '团长手机',
                'line_name'        => '路线名称',
                'clerk_name'       => '配送员名称',
                'clerk_mobile'     => '配送员手机',
            ],
            'time'   => [
                'create_time'   => '创建时间',
                'arrive_time'   => '预计自提',
                'delivery_time' => '配送时间',
                'complete_time' => '送达时间',
            ]
        ];

        $delivery_id        = input('delivery_id', '');
        $delivery_status    = input('delivery_status', '');
        $select_field_type  = input('select_field_type', '');
        $select_field_value = input('select_field_value', '');
        $time_field_type    = input('time_field_type', '');
        $start_date         = input('start_date', '');
        $end_date           = input('end_date', '');

        $condition      = [['site_id', '=', $this->site_id], ['is_delete', '=', 0]];
        $condition_desc = [];

        if (!empty($delivery_id)) {
            $condition[] = ['delivery_id', '=', $delivery_id];
        }
        if ($delivery_status !== '') {
            $condition[] = ['delivery_status', '=', $delivery_status];
        }
        $condition_desc[] = ['name' => '配送单状态', 'value' => ($delivery_status === '' ? '全部' : DeliveryOrderModel::getStatus($delivery_status)['name'])];

        if (!empty($select_field_value) && array_key_exists($select_field_type, $field_list['select'])) {
            $condition[]      = [$select_field_type, 'like', '%' . $select_field_value . '%'];
            $condition_desc[] = ['name' => $field_list['select'][$select_field_type], 'value' => $select_field_value];
        }
        if (array_key_exists($time_field_type, $field_list['time'])) {
            if (!empty($start_date) && !empty($end_date)) {
                $condition[] = [$time_field_type, 'between', [date_to_time($start_date), date_to_time($end_date)]];
            } elseif (!empty($start_date) && empty($end_date)) {
                $condition[] = [$time_field_type, '>=', date_to_time($start_date)];
            } elseif (empty($start_date) && !empty($end_date)) {
                $condition[] = [$time_field_type, '<=', date_to_time($end_date)];
            }

            $condition_desc[] = ['name' => '时间类型', 'value' => $field_list['time'][$time_field_type]];
            $condition_desc[] = ['name' => '开始时间', 'value' => $start_date];
            $condition_desc[] = ['name' => '结束时间', 'value' => $end_date];
        }

        return [
            'condition'      => $condition,
            'condition_desc' => $condition_desc,
            'field_list'     => $field_list,
        ];
    }

    /**
     * 配送单配送
     */
    public function orderDelivery()
    {
        if (request()->isAjax()) {
            $delivery_ids = input('delivery_ids', '');

            $condition = [['site_id', '=', $this->site_id], ['is_delete', '=', 0]];
            if (!empty($delivery_ids)) {
                $condition[] = ['delivery_id', 'in', (string)$delivery_ids];
            }

            $delivery_order_model = new DeliveryOrderModel();
            return $delivery_order_model->orderDelivery($condition);
        }
    }

    /**
     * 配送单送达
     */
    public function orderComplete()
    {
        if (request()->isAjax()) {
            $delivery_ids = input('delivery_ids', '');

            $condition = [['site_id', '=', $this->site_id], ['is_delete', '=', 0]];
            if (!empty($delivery_ids)) {
                $condition[] = ['delivery_id', 'in', (string)$delivery_ids];
            }

            $delivery_order_model = new DeliveryOrderModel();
            return $delivery_order_model->orderComplete($condition);
        }
    }

    /**
     * 删除配送单
     */
    public function deleteOrder()
    {
        if (request()->isAjax()) {
            $delivery_ids = input('delivery_ids', '');

            $condition = [['site_id', '=', $this->site_id], ['is_delete', '=', 0]];
            if (!empty($delivery_ids)) {
                $condition[] = ['delivery_id', 'in', (string)$delivery_ids];
            }

            $delivery_order_model = new DeliveryOrderModel();
            return $delivery_order_model->deleteOrder('site', $condition);
        }
    }

    /**
     * 更新配送单基础信息
     */
    public function updateOrder()
    {
        if (request()->isAjax()) {
            $delivery_order_model = new DeliveryOrderModel();
            return $delivery_order_model->updateOrder($this->site_id, input('delivery_ids', ''));
        }
    }

    /**
     * 配送单信息
     */
    public function orderInfo()
    {
        if (request()->isAjax()) {
            $delivery_order_model = new DeliveryOrderModel();
            return $delivery_order_model->getOrderInfo([
                ['site_id', '=', $this->site_id],
                ['delivery_id', '=', input('delivery_id', 0)],
                ['is_delete', '=', 0]
            ]);
        }
    }

    /**
     * 配送单详情
     */
    public function orderDetail()
    {
        $delivery_id = input('delivery_id', 0);

        $delivery_order_model = new DeliveryOrderModel();
        $delivery_detail      = $delivery_order_model->getOrderInfo([['site_id', '=', $this->site_id], ['delivery_id', '=', $delivery_id]])['data'];
        if (empty($delivery_detail)) {
            $this->error('配送单不存在');
        }
        $this->assign([
            'delivery_detail' => $delivery_detail
        ]);
        return $this->fetch('community_delivery/order/detail');
    }

    /**
     * 商品汇总
     */
    public function goodsGather()
    {
        if (request()->isAjax()) {
            $delivery_order_model = new DeliveryOrderModel();
            return $delivery_order_model->getGoodsGather([
                ['site_id', '=', $this->site_id],
                ['delivery_id', '=', input('delivery_id', 0)],
                ['is_delete', '=', 0]
            ]);
        }
    }

    /**
     * 相关订单
     */
    public function relevanceOrder()
    {
        if (request()->isAjax()) {
            $page_index  = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $delivery_id = input('delivery_id', 0);
            $order_field = input('order_field', '');
            $field_value = input('field_value', '');

            $condition = [['site_id', '=', $this->site_id], ['delivery_id', '=', $delivery_id]];

            if (!empty($field_value)) {
                $condition[] = [$order_field, 'like', '%' . $field_value . '%'];
            }

            $field = true;

            $community_order_model = new CommunityOrderModel();
            return $community_order_model->getOrderPageList($condition, $page_index, $page_size, 'order_id desc', $field);
        }
    }

    /******************************* 配送单 end ******************************************/


    /******************************* 配送单导出 start ******************************************/

    /**
     * 导出列表
     */
    public function exportList()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size  = input('page_size', PAGE_LIST_ROWS);
            $type       = input('type', '');
            $name       = input('name', '');
            $status     = input('status', '');

            $condition = [['site_id', '=', $this->site_id]];
            if (!empty($type)) {
                $condition[] = ['type', '=', $type];
            }
            if (!empty($name)) {
                $condition[] = ['name', 'like', '%' . $name . '%'];
            }
            if ($status !== '') {
                $condition[] = ['status', '=', $status];
            }

            $delivery_export_model = new DeliveryExportModel();
            $res                   = $delivery_export_model->getExportPageList($condition, $page_index, $page_size);
            return $res;
        } else {
            $this->assign([
                'status_data' => DeliveryExportModel::getStatus(),
                'type_data'   => DeliveryExportModel::getType(),
            ]);
            return $this->fetch('community_delivery/export/lists');
        }
    }

    /**
     * 添加导出记录
     */
    public function addExport()
    {
        if (request()->isAjax()) {
            $condition = $this->commonOrderCondition();

            $delivery_export_model = new DeliveryExportModel();
            return $delivery_export_model->addExport([
                'site_id'        => $this->site_id,
                'type'           => input('export_type', ''),
                'name'           => input('export_name', ''),
                'condition'      => json_encode($condition['condition']),
                'condition_desc' => json_encode($condition['condition_desc']),
            ]);
        }
    }

    /**
     * 配送单导出
     */
    public function exportOrder()
    {
        if (request()->isAjax()) {
            $delivery_export_model = new DeliveryExportModel();
            return $delivery_export_model->execExport(input('export_id', 0), $this->site_id);
        }
    }

    /**
     * 删除导出记录
     */
    public function deleteExport()
    {
        if (request()->isAjax()) {
            $delivery_export_model = new DeliveryExportModel();
            return $delivery_export_model->deleteExport([
                ['site_id', '=', $this->site_id],
                ['export_id', 'in', input('export_ids', '')],
            ]);
        }
    }

    /**
     * 重执
     */
    public function resetExport()
    {
        if (request()->isAjax()) {
            $delivery_export_model = new DeliveryExportModel();
            return $delivery_export_model->resetExport(input('export_id', 0), $this->site_id);
        }
    }

    /******************************* 配送单导出 end ******************************************/


    /******************************* 路线 start ******************************************/

    public function lineList()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size  = input('page_size', PAGE_LIST_ROWS);
            $clerk_name = input('clerk_name', '');
            $line_name  = input('line_name', '');

            $condition = [['site_id', '=', $this->site_id]];
            if (!empty($clerk_name)) {
                $condition[] = ['clerk_name', 'like', '%' . $clerk_name . '%'];
            }
            if (!empty($line_name)) {
                $condition[] = ['line_name', 'like', '%' . $line_name . '%'];
            }

            $line_model = new LineModel();
            $res        = $line_model->getLinePageList($condition, $page_index, $page_size);
            return $res;
        } else {
            return $this->fetch('community_delivery/line/lists');
        }
    }

    /**
     * 添加路线
     */
    public function addLine()
    {
        if (request()->isAjax()) {
            $line_model = new LineModel();
            return $line_model->addLine([
                'site_id'     => $this->site_id,
                'clerk_id'    => input('clerk_id', 0),
                'line_name'   => input('line_name', ''),
                'line_remark' => input('line_remark', '')
            ]);
        } else {
            return $this->fetch('community_delivery/line/add');
        }
    }

    /**
     * 修改路线
     */
    public function editLine()
    {
        $line_model = new LineModel();
        if (request()->isAjax()) {
            return $line_model->editLine([
                'clerk_id'    => input('clerk_id', 0),
                'line_name'   => input('line_name', ''),
                'line_remark' => input('line_remark', '')
            ], [
                ['site_id', '=', $this->site_id],
                ['line_id', '=', input('line_id', 0)],
            ]);
        } else {
            $line_id = input('line_id', 0);

            $line_info = $line_model->getLineInfo([['line_id', '=', $line_id], ['site_id', '=', $this->site_id]])['data'];
            if (empty($line_info)) {
                $this->error('数据不存在');
            }

            $this->assign([
                'line_info' => $line_info
            ]);
            return $this->fetch('community_delivery/line/edit');
        }
    }

    /**
     * 删除路线
     */
    public function deleteLine()
    {
        if (request()->isAjax()) {
            $line_model = new LineModel();
            return $line_model->deleteLine($this->site_id, input('line_id', 0));
        }
    }

    /**
     * 选择配送员
     */
    public function chooseLine()
    {
        $this->assign([
            'chooseCallback' => input('chooseCallback', '')
        ]);
        return $this->fetch('community_delivery/line/choose');
    }

    /******************************* 路线 end ******************************************/


    /******************************* 配送员 start ******************************************/

    /**
     * 配送员列表
     */
    public function clerkList()
    {
        if (request()->isAjax()) {
            $page_index   = input('page', 1);
            $page_size    = input('page_size', PAGE_LIST_ROWS);
            $clerk_name   = input('clerk_name', '');
            $clerk_mobile = input('clerk_mobile', '');
            $username     = input('username', '');

            $condition = [['site_id', '=', $this->site_id]];
            if (!empty($clerk_name)) {
                $condition[] = ['clerk_name', 'like', '%' . $clerk_name . '%'];
            }
            if (!empty($clerk_mobile)) {
                $condition[] = ['clerk_mobile', 'like', '%' . $clerk_mobile . '%'];
            }
            if (!empty($username)) {
                $condition[] = ['username', 'like', '%' . $username . '%'];
            }

            $clerk_model = new ClerkModel();
            $res         = $clerk_model->getClerkPageList($condition, $page_index, $page_size);
            return $res;
        } else {
            return $this->fetch('community_delivery/clerk/lists');
        }
    }

    /**
     * 添加配送员
     */
    public function addClerk()
    {
        if (request()->isAjax()) {
            $clerk_model = new ClerkModel();
            return $clerk_model->addClerk([
                'site_id'       => $this->site_id,
                'member_id'     => input('member_id', 0),
                'clerk_name'    => input('clerk_name', ''),
                'clerk_mobile'  => input('clerk_mobile', ''),
                'clerk_headimg' => input('clerk_headimg', ''),
                'clerk_remark'  => input('clerk_remark', ''),
            ]);
        } else {
            return $this->fetch('community_delivery/clerk/add');
        }
    }

    /**
     * 编辑配送员
     */
    public function editClerk()
    {
        $clerk_model = new ClerkModel();
        if (request()->isAjax()) {
            return $clerk_model->editClerk([
                'member_id'     => input('member_id', 0),
                'clerk_name'    => input('clerk_name', ''),
                'clerk_mobile'  => input('clerk_mobile', ''),
                'clerk_headimg' => input('clerk_headimg', ''),
                'clerk_remark'  => input('clerk_remark', ''),
            ], [
                ['site_id', '=', $this->site_id],
                ['clerk_id', '=', input('clerk_id', 0)],
            ]);
        } else {
            $clerk_id = input('clerk_id', 0);

            $clerk_info = $clerk_model->getClerkInfo([['clerk_id', '=', $clerk_id], ['site_id', '=', $this->site_id]])['data'];
            if (empty($clerk_info)) {
                $this->error('数据不存在');
            }

            $this->assign([
                'clerk_info' => $clerk_info
            ]);
            return $this->fetch('community_delivery/clerk/edit');
        }
    }

    /**
     * 删除配送员
     */
    public function deleteClerk()
    {
        if (request()->isAjax()) {
            $clerk_model = new ClerkModel();
            return $clerk_model->deleteClerk($this->site_id, input('clerk_id', 0));
        }
    }

    /**
     * 选择配送员
     */
    public function chooseClerk()
    {
        $this->assign([
            'chooseCallback' => input('chooseCallback', '')
        ]);
        return $this->fetch('community_delivery/clerk/choose');
    }


    /**
     * 选择会员
     */
    public function chooseMember()
    {
        $field_list = [
            'username' => '用户名',
            'nickname' => '昵称',
            'mobile'   => '手机',
        ];

        if (request()->isAjax()) {
            $page_index   = input('page', 1);
            $page_size    = input('page_size', PAGE_LIST_ROWS);
            $member_field = input('member_field', '');
            $field_value  = input('field_value', '');

            $condition = [['site_id', '=', $this->site_id]];

            if (!empty($field_value) && array_key_exists($member_field, $field_list)) {
                $condition[] = [$member_field, 'like', '%' . $field_value . '%'];
            }

            $field = 'member_id, username, nickname, headimg, mobile';

            $member_model = new MemberModel();
            $clerk_model  = new ClerkModel();

            $res = $member_model->getMemberPageList($condition, $page_index, $page_size, 'member_id desc', $field);
            foreach ($res['data']['list'] as $key => $val) {

                $clerk_info = $clerk_model->getClerkInfo([['member_id', '=', $val['member_id']]], 'clerk_id, clerk_name')['data'];

                $res['data']['list'][$key]['clerk_info'] = $clerk_info ?: null;
            }
            return $res;
        } else {
            $this->assign([
                'chooseCallback' => input('chooseCallback', ''),
                'field_list'     => $field_list,
            ]);
            return $this->fetch('community_delivery/clerk/member');
        }
    }

    /******************************* 配送员 end ******************************************/
}