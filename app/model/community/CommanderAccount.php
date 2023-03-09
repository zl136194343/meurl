<?php


namespace app\model\community;

use app\model\BaseModel;
class CommanderAccount extends BaseModel
{
    public $type = [
        'withdraw' => '提现',
        'commander_order' => '团长订单结算',
    ];

    /**
     * 添加账户流水
     * @param $fenxiao_id
     * @param $fenxiao_name
     * @param string $type
     * @param $money
     * @param $relate_id
     * @return array
     */
    public function addAccount($fenxiao_id, $fenxiao_name,  $money,$type = 'order', $relate_id,$tag)
    {
        $account_no = date('YmdHi') . rand(1000, 9999);
        $data = array (
            'commander_id' => $fenxiao_id,
            'account_no' => $account_no,
            'account_data' => $money,
            'type' => $type,
            'type_name' => $this->type[ $type ],
            'relate_id' => $relate_id,
            'remark'=>$tag,
            'create_time' => time(),
        );

        $res = model('commander_account')->add($data);
        model('ommunity_leader')->setInc([ [ 'cl_id', '=', $fenxiao_id ] ], 'commission_total', $money);
        
        return $this->success($res);
    }


    /**
     * 获取分销商账户流水分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getFenxiaoAccountPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = '*')
    {
        $list = model('commander_account')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 添加账户流水-不变更金额
     * @param $fenxiao_id
     * @param $fenxiao_name
     * @param string $type
     * @param $money
     * @param $relate_id
     * @return array
     */
    public function addAccountLog($fenxiao_id, $fenxiao_name, $type, $money, $relate_id)
    {
        $account_no = date('YmdHi') . rand(1000, 9999);
        
        $data = array (
            'commander_id' => $fenxiao_id,
            'account_no' => $account_no,
            'account_data' => $money,
            'type' => $type,
            'type_name' => $this->type[ $type ],
            'relate_id' => $relate_id,
            'create_time' => time(),
        );

        $res = model('commander_account')->add($data);
        return $this->success($res);
    }
}