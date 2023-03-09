<?php


namespace app\model\community;
use app\model\BaseModel;
use app\model\member\Member;
class CommanderApply extends BaseModel
{
    /**
     * 获取团长申请分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getFenxiaoApplyPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('Commander_apply')->pageList($condition, $field, $order, $page, $page_size);

        return $this->success($list);
    }

    /**
     * 判断分销商名称是否存在
     * @param $fenxiao_name
     */
    public function existFenxiaoName($fenxiao_name)
    {
        $res = model('commander_apply')->getCount([ [ 'commander_name', '=', $fenxiao_name ] ]);
        if ($res > 0) {
            return $this->error('', '该团长已存在');
        }
        return $this->success();
    }
    /**
     * 申请成为分销商
     * @param $member_id
     * @param $fenxiao_name
     * @param $mobile
     * @return array
     */
    public function applyFenxiao($member_id, $fenxiao_name = '', $mobile = '')
    {
        //判断该用户是否已经申请
        $apply_info = model('commander_apply')->getInfo([ [ 'member_id', '=', $member_id ] ], 'apply_id,status');
        if (!empty($apply_info) && $apply_info[ 'status' ] != -1) {
            return $this->error('', '已经申请过，请不要重复申请');
        }

        //获取用户信息
        $member_model = new Member();
        $member_field = 'source_member,nickname,headimg,reg_time,order_money,order_complete_money,order_num,order_complete_num';
        $member_info = $member_model->getMemberInfo([ [ 'member_id', '=', $member_id ] ], $member_field);

        if (empty($fenxiao_name)) $fenxiao_name = $member_info[ 'data' ][ 'nickname' ];

        // 成为团长需要审核
            $apply_data = [
                'commander_name' => $fenxiao_name,
                'parent' => $member_info[ 'data' ][ 'fenxiao_id' ],
                'member_id' => $member_id,
                'mobile' => $mobile,
                'nickname' => $member_info[ 'data' ][ 'nickname' ],
                'headimg' => $member_info[ 'data' ][ 'headimg' ],
                'order_complete_money' => $member_info[ 'data' ][ 'order_complete_money' ],
                'order_complete_num' => $member_info[ 'data' ][ 'order_complete_num' ],
                'reg_time' => $member_info[ 'data' ][ 'reg_time' ],
                'create_time' => time(),
                'status' => 1
            ];
            if (!empty($apply_info)) {
                $res = model('commander_apply')->update($apply_data, [ [ 'member_id', '=', $member_id ] ]);
            } else {
                $res = model('commander_apply')->add($apply_data);
            }
            return $this->success($res);
    }

    /**
     * 审核通过
     * @param $fenxiao_id
     * @return array
     */
    public function pass($apply_id)
    {
        $info = model('Commander_apply')->getInfo([ [ 'apply_id', '=', $apply_id ] ]);
        if ($info[ 'status' ] == 2) {
            return $this->success();
        }

        model('Commander_apply')->startTrans();
        try {
            $data = [
                'status' => 2,
                'update_time' => time(),
            ];
            $res = model('Commander_apply')->update($data, [ [ 'apply_id', '=', $apply_id ] ]);

            $fenxiao_data = [
                'commander_name' => $info[ 'commander_name' ],
                'mobile' => $info[ 'mobile' ],
                'member_id' => $info[ 'member_id' ],
            ];

            $fenxiao_model = new commander();
            $result = $fenxiao_model->addCommander($fenxiao_data);
            //修改用户对应状态
            $fenxiao_model->getCommanderDetailInfo();

            model('member')->update(['is_commander'=>1,'commander_id'=>$result['data']],[['member_id','=',$info[ 'member_id' ]]]);
            if ($result[ 'code' ] != 0) {
                model('Commander_apply')->rollback();
                return $result;
            }

            model('Commander_apply')->commit();

            return $this->success($res);
        } catch (\Exception $e) {
            model('Commander_apply')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 审核不通过
     * @param $fenxiao_id
     * @return array
     */
    public function refuse($apply_id)
    {
        $data = [
            'status' => -1,
            'update_time' => time()
        ];

        $res = model('commander_apply')->update($data, [ [ 'apply_id', '=', $apply_id ] ]);
        return $this->success($res);
    }

}