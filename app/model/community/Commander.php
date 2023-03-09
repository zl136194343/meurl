<?php


namespace app\model\community;
use app\model\BaseModel;

class Commander extends BaseModel
{

    public $fenxiao_status_zh = [
        1 => '正常',
        -1 => '冻结',
    ];
    public function getFenxiaoPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '')
    {
        $condition[] = [ 'f.is_delete', '=', 0 ];
        $field = 'f.*,m.nickname';
        $alias = 'f';
        $join = [
            [
                'member m',
                'm.member_id = f.member_id',
                'left'
            ]
        ];
        $list = model('commander')->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        return $this->success($list);
    }



    /**
     * 添加团长
     * @param $data
     * @return mixed
     */
    public function addCommander($data)
    {
        $fenxiao_info = model('commander')->getInfo(
            [
                [ 'member_id', '=', $data[ 'member_id' ] ],
                [ 'is_delete', '=', 0 ]
            ],
            'commander_id'
        );
        if (!empty($fenxiao_info)) return $this->error('', '当前分销商已申请');

        $data[ 'fenxiao_no' ] = date('YmdHi') . rand(1000, 9999);
        $data[ 'create_time' ] = time();
        $data[ 'audit_time' ] = time();

        model('commander')->startTrans();
        try {

            $res = model('commander')->add($data);
            model('commander')->commit();
            return $this->success($res);
        } catch (\Exception $e) {
            model('fenxiao')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 获取团长详细信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getCommanderDetailInfo($condition = [])
    {
        $condition[] = [ 'f.is_delete', '=', 0 ];
        $field = 'f.*,nm.nickname,nm.headimg';
        $alias = 'f';
        $join = [
            [
                'member nm',
                'nm.member_id = f.member_id',
                'inner'
            ]
        ];
        $res = model('Commander')->getInfo($condition, $field, $alias, $join);
        return $this->success($res);
    }


    /**
     * 冻结
     * @param $fenxiao_id
     * @return array
     */
    public function frozen($fenxiao_id)
    {
        $data = [
            'status' => -1,
            'lock_time' => time()
        ];

        $res = model('Commander')->update($data, [ [ 'commander_id', '=', $fenxiao_id ] ]);
        return $this->success($res);
    }

    /**
     * 解冻
     * @param $fenxiao_id
     * @return array
     */
    public function unfrozen($fenxiao_id)
    {
        $data = [
            'status' => 1,
            'lock_time' => time(),
        ];
        $res = model('Commander')->update($data, [ [ 'commander_id', '=', $fenxiao_id ] ]);
        return $this->success($res);
    }


}