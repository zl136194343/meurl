<?php

namespace addon\community\api\controller;

use addon\community\model\delivery\Clerk as ClerkModel;
use app\model\member\Member as MemberModel;
use addon\community\model\delivery\Line as LineModel;
use addon\community\model\delivery\Order as DeliveryOrderModel;

/**
 * 社区团购配送
 * Class Communitydelivery
 * @package app\api\controller
 */
class Communitydelivery extends BaseApi
{
    /**
     * 验证配送员
     * @return array
     */
    private function verifyClerk()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $token;

        $member_model = new MemberModel();
        $member_info  = $member_model->getMemberInfo([['member_id', '=', $this->member_id]], 'delivery_clerk_id')['data'];
        if (empty($member_info['delivery_clerk_id'])) {
            return $this->error('', '当前账号不是配送员');
        }

        return $this->success(['clerk_id' => $member_info['delivery_clerk_id']]);
    }

    /**
     * 会员绑定配送员
     * @return false|string
     */
    public function bindClerk()
    {
        // 检测会员登录
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $clerk_id = $this->params['clerk_id'] ?? 0;
        if (empty($clerk_id)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $clerk_model = new ClerkModel();
        $res         = $clerk_model->bindClerk($this->site_id, $clerk_id, $this->member_id);
        return $this->response($res);
    }

    /**
     * 获取配送员列表
     * @return false|string
     */
    public function clerkList()
    {
        $page           = $this->params['page'] ?? 1;
        $page_size      = $this->params['page_size'] ?? PAGE_LIST_ROWS;
        $clerk_name     = $this->params['clerk_name'] ?? '';
        $clerk_mobile   = $this->params['clerk_mobile'] ?? '';
        $is_bind_member = $this->params['is_bind_member'] ?? '';

        $condition = [
            ['site_id', '=', $this->site_id]
        ];
        if (!empty($clerk_name)) {
            $condition[] = ['clerk_name', 'like', '%' . $clerk_name . '%'];
        }
        if (!empty($clerk_mobile)) {
            $condition[] = ['clerk_mobile', '=', $clerk_mobile];
        }
        // 是否已绑定会员
        if ($is_bind_member !== '') {
            if ($is_bind_member == 0) {
                // 未绑定会员
                $condition[] = ['member_id', '=', 0];
            } elseif ($is_bind_member == 1) {
                // 已绑定会员
                $condition[] = ['member_id', '>', 0];
            }
        }

        $field = 'clerk_id, member_id, clerk_name, clerk_mobile, clerk_headimg, clerk_remark';

        $clerk_model = new ClerkModel();
        $res         = $clerk_model->getClerkPageList($condition, $page, $page_size, 'clerk_id desc', $field);
        return $this->response($res);
    }

    /**
     * 配送员信息
     * @return false|string
     */
    public function clerkInfo()
    {
        // 检测会员登录
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $clerk_model = new ClerkModel();
        $res         = $clerk_model->getClerkInfo([['site_id', '=', $this->site_id], ['member_id', '=', $this->member_id]]);
        return $this->response($res);
    }

    /**
     * 路线列表
     * @return false|string
     */
    public function lineList()
    {
        // 验证
        $res = $this->verifyClerk();
        if ($res['code'] < 0) return $this->response($res);

        $clerk_id  = $res['data']['clerk_id'];
        $page      = $this->params['page'] ?? 1;
        $page_size = $this->params['page_size'] ?? PAGE_LIST_ROWS;
        $line_name = $this->params['line_name'] ?? '';

        $condition = [
            ['site_id', '=', $this->site_id],
            ['clerk_id', '=', $clerk_id]
        ];
        if (!empty($line_name)) {
            $condition[] = ['line_name', 'like', '%' . $line_name . '%'];
        }

        $field = 'line_name, line_remark';

        $line_model = new LineModel();
        $res        = $line_model->getLinePageList($condition, $page, $page_size, 'line_id desc', $field);
        return $this->response($res);
    }

    /**
     * 路线详情
     * @return false|string
     */
    public function lineDetail()
    {
        // 验证
        $res = $this->verifyClerk();
        if ($res['code'] < 0) return $this->response($res);

        $clerk_id = $res['data']['clerk_id'];
        $line_id  = $this->params['line_id'] ?? 0;

        if (empty($line_id)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $condition = [
            ['site_id', '=', $this->site_id],
            ['clerk_id', '=', $clerk_id],
            ['line_id', '=', $line_id],
        ];

        $line_model = new LineModel();
        $res        = $line_model->getLineInfo($condition);
        return $this->response($res);
    }

    /**
     * 配送单状态
     * @return false|string
     */
    public function orderStatus()
    {
        $res = DeliveryOrderModel::getStatus();
        return $this->response($this->success($res));
    }

    /**
     * 配送单列表
     * @return false|string
     */
    public function orderList()
    {
        $role_type        = $this->params['role_type'] ?? '';
        $page             = $this->params['page'] ?? 1;
        $page_size        = $this->params['page_size'] ?? PAGE_LIST_ROWS;
        $delivery_status  = $this->params['delivery_status'] ?? '';
        $delivery_no      = $this->params['delivery_no'] ?? '';
        $line_name        = $this->params['line_name'] ?? '';
        $leader_name      = $this->params['leader_name'] ?? '';
        $leader_mobile    = $this->params['leader_mobile'] ?? '';
        $leader_community = $this->params['leader_community'] ?? '';

        $condition = [['site_id', '=', $this->site_id], ['is_delete', '=', 0]];

        if ($role_type === 'clerk') {
            // 配送员

            $res = $this->verifyClerk();
            if ($res['code'] < 0) return $this->response($res);

            $condition[] = ['clerk_id', '=', $res['data']['clerk_id']];
            $condition[] = ['clerk_is_delete', '=', 0];

        } elseif ($role_type === 'leader') {
            // 团长

            $token = $this->checkToken();
            if ($token['code'] < 0) return $this->response($token);

            $condition[] = ['leader_member_id', '=', $this->member_id];
            $condition[] = ['leader_is_delete', '=', 0];
        } else {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        if ($delivery_status !== '') {
            $condition[] = ['delivery_status', '=', $delivery_status];
        }
        if (!empty($delivery_no)) {
            $condition[] = ['delivery_no', 'like', '%' . $delivery_no . '%'];
        }
        if (!empty($line_name)) {
            $condition[] = ['line_name', 'like', '%' . $line_name . '%'];
        }
        if (!empty($leader_name)) {
            $condition[] = ['leader_name', 'like', '%' . $leader_name . '%'];
        }
        if (!empty($leader_mobile)) {
            $condition[] = ['leader_mobile', 'like', '%' . $leader_mobile . '%'];
        }
        if (!empty($leader_community)) {
            $condition[] = ['leader_community', 'like', '%' . $leader_community . '%'];
        }

        $delivery_order_model = new DeliveryOrderModel();
        $res                  = $delivery_order_model->getOrderPageList($condition, $page, $page_size);
        return $this->response($res);
    }

    /**
     * 配送单详情
     * @return false|string
     */
    public function orderInfo()
    {
        $delivery_id = $this->params['delivery_id'] ?? 0;
        $role_type   = $this->params['role_type'] ?? '';

        if (empty($delivery_id)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $condition = [['site_id', '=', $this->site_id], ['delivery_id', '=', $delivery_id], ['is_delete', '=', 0]];

        if ($role_type === 'clerk') {
            // 配送员

            $res = $this->verifyClerk();
            if ($res['code'] < 0) return $this->response($res);

            $condition[] = ['clerk_id', '=', $res['data']['clerk_id']];
            $condition[] = ['clerk_is_delete', '=', 0];

        } elseif ($role_type === 'leader') {
            // 团长

            $token = $this->checkToken();
            if ($token['code'] < 0) return $this->response($token);

            $condition[] = ['leader_member_id', '=', $this->member_id];
            $condition[] = ['leader_is_delete', '=', 0];
        } else {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $delivery_order_model = new DeliveryOrderModel();
        $res                  = $delivery_order_model->getOrderInfo($condition);
        return $this->response($res);
    }

    /**
     * 配送单商品清单
     * @return false|string
     */
    public function goodsGather()
    {
        $delivery_id = $this->params['delivery_id'] ?? 0;
        $role_type   = $this->params['role_type'] ?? '';

        if (empty($delivery_id)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }
        $condition = [['site_id', '=', $this->site_id], ['delivery_id', '=', $delivery_id], ['is_delete', '=', 0]];

        if ($role_type === 'clerk') {
            // 配送员

            $res = $this->verifyClerk();
            if ($res['code'] < 0) return $this->response($res);

            $condition[] = ['clerk_id', '=', $res['data']['clerk_id']];
            $condition[] = ['clerk_is_delete', '=', 0];

        } elseif ($role_type === 'leader') {
            // 团长

            $token = $this->checkToken();
            if ($token['code'] < 0) return $this->response($token);

            $condition[] = ['leader_member_id', '=', $this->member_id];
            $condition[] = ['leader_is_delete', '=', 0];
        } else {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $delivery_order_model = new DeliveryOrderModel();
        $res                  = $delivery_order_model->getGoodsGather($condition);
        return $this->response($res);
    }

    /**
     * 配送单配送
     * @return false|string
     */
    public function orderDelivery()
    {
        $delivery_ids = $this->params['delivery_ids'] ?? '';
        if (empty($delivery_ids)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        // 验证
        $res = $this->verifyClerk();
        if ($res['code'] < 0) return $this->response($res);
        $clerk_id = $res['data']['clerk_id'];

        $condition            = [
            ['site_id', '=', $this->site_id],
            ['clerk_id', '=', $clerk_id],
            ['delivery_id', 'in', (string)$delivery_ids],
            ['is_delete', '=', 0],
            ['clerk_is_delete', '=', 0]
        ];
        $delivery_order_model = new DeliveryOrderModel();
        $res                  = $delivery_order_model->orderDelivery($condition);
        return $this->response($res);
    }

    /**
     * 配送单送达
     * @return false|string
     */
    public function orderComplete()
    {
        $delivery_ids = $this->params['delivery_ids'] ?? '';
        if (empty($delivery_ids)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $condition            = [
            ['site_id', '=', $this->site_id],
            ['leader_member_id', '=', $this->member_id],
            ['delivery_id', 'in', (string)$delivery_ids],
            ['is_delete', '=', 0],
            ['leader_is_delete', '=', 0]
        ];
        $delivery_order_model = new DeliveryOrderModel();
        $res                  = $delivery_order_model->orderComplete($condition);
        return $this->response($res);
    }

    /**
     * 删除配送单
     * @return false|string
     */
    public function deleteOrder()
    {
        $role_type   = $this->params['role_type'] ?? '';
        $delivery_id = $this->params['delivery_id'] ?? 0;
        if (empty($delivery_id)) {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $condition = [['site_id', '=', $this->site_id], ['delivery_id', '=', $delivery_id], ['is_delete', '=', 0]];

        if ($role_type === 'clerk') {
            // 配送员

            $res = $this->verifyClerk();
            if ($res['code'] < 0) return $this->response($res);

            $condition[] = ['clerk_id', '=', $res['data']['clerk_id']];
            $condition[] = ['clerk_is_delete', '=', 0];

        } elseif ($role_type === 'leader') {
            // 团长

            $token = $this->checkToken();
            if ($token['code'] < 0) return $this->response($token);

            $condition[] = ['leader_member_id', '=', $this->member_id];
            $condition[] = ['leader_is_delete', '=', 0];
        } else {
            return $this->response($this->error('', 'PARAMETER_ERROR'));
        }

        $delivery_order_model = new DeliveryOrderModel();
        $res                  = $delivery_order_model->deleteOrder($role_type, $condition);
        return $this->response($res);
    }
}