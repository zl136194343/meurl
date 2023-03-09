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
namespace addon\community\model\community;

use app\model\BaseModel;

/**
 * 团长流水
 */
class CommunityAccount extends BaseModel
{
    public $type = [
        'withdraw' => '提现',
        'order'    => '订单结算',
    ];

    /**
     * 添加账户流水
     * @param $cl_id
     * @param $cl_name
     * @param string $type
     * @param $money
     * @param $relate_id
     * @param $site_id
     * @return array
     */
    public function addAccount($cl_id, $cl_name, $type = 'order', $money, $relate_id, $site_id)
    {
        $account_no = date('YmdHi') . rand(1000, 9999);
        $data       = [
            'cl_id'   => $cl_id,
            'cl_name' => $cl_name,
            'account_no'   => $account_no,
            'money'        => $money,
            'type'         => $type,
            'type_name'    => $this->type[$type],
            'relate_id'    => $relate_id,
            'create_time'  => time(),
            'site_id'  => $site_id,
        ];

        $res = model('community_account')->add($data);
        model('community_leader')->setInc([['cl_id', '=', $cl_id]], 'account', $money);

        return $this->success($res);
    }

    /**
     * 获取团长账户流水信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getCommunityAccountInfo($condition = [], $field = '*')
    {
        $list = model('community_account')->getInfo($condition, $field);
        return $this->success($list);

    }

    /**
     * 获取团长账户流水分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getCommunityAccountPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = '*')
    {
        $list = model('community_account')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 获取团长帐户流水总和
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getCommunityAccountSum($condition, $field = 'money')
    {
        $res = model('community_account')->getSum($condition, $field);
        return $this->success($res);
    }

    /**
     * 添加团长账户流水（不扣账户）
     * @param $cl_id
     * @param $cl_name
     * @param string $type
     * @param $money
     * @param $relate_id
     * @param $site_id
     * @return array
     */
    public function addAccountLog($cl_id, $cl_name, $type = 'order', $money, $relate_id, $site_id)
    {
        $account_no = date('YmdHi') . rand(1000, 9999);
        $data       = array(
            'cl_id'   => $cl_id,
            'cl_name' => $cl_name,
            'account_no'   => $account_no,
            'money'        => $money,
            'type'         => $type,
            'type_name'    => $this->type[$type],
            'relate_id'    => $relate_id,
            'create_time'  => time(),
            'site_id'  => $site_id,
        );
        $res = model('community_account')->add($data);
        return $this->success($res);
    }
}