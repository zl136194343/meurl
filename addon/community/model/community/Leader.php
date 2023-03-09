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

namespace addon\community\model\community;

use app\model\BaseModel;
use app\model\member\Member as MemberModel;
use app\model\system\Stat;
use addon\community\model\community\CommunityLevel as CommunityLevelModel;
use think\facade\Db;

/**
 * 团长
 */
class Leader extends BaseModel
{

    /**
     * 表名称
     */
    const TABLE_NAME = 'community_leader';

    /**
     * 状态 -- 待审核
     */
    const STATUS_AUDIT_WAIT = 0;

    /**
     * 状态 -- 正常
     */
    const STATUS_NORMAL = 1;

    /**
     * 状态 -- 已拒绝
     */
    const STATUS_AUDIT_REFUSE = 2;

    /**
     * 状态 -- 冻结中
     */
    const STATUS_FREEZE = 3;

    /**
     * 休息状态 -- 正常
     */
    const REST_NORMAL = 0;

    /**
     * 休息状态 -- 休息中
     */
    const RESTING = 1;

    /**
     * 获取状态
     * @param mixed $status
     * @param string $type
     * @return array
     */
    public static function getStatus($status = null, $type = 'status')
    {
        $data   = array(
            array(
                'status' => self::STATUS_AUDIT_WAIT,
                'name'   => '待审核',
                'color'  => '#caab16',
                'const'  => 'STATUS_AUDIT_WAIT',
            ),
            array(
                'status' => self::STATUS_NORMAL,
                'name'   => '正常',
                'color'  => 'green',
                'const'  => 'STATUS_NORMAL',
            ),
            array(
                'status' => self::STATUS_AUDIT_REFUSE,
                'name'   => '已拒绝',
                'color'  => 'red',
                'const'  => 'STATUS_AUDIT_REFUSE',
            ),
            array(
                'status' => self::STATUS_FREEZE,
                'name'   => '冻结中',
                'color'  => 'red',
                'const'  => 'STATUS_FREEZE',
            ),
        );
        $result = [];
        if (is_null($status)) {
            $result = $data;
        } else {
            if (is_array($status)) {

                foreach ($data as $val) {

                    if (in_array($val[$type], $status)) {
                        $result[] = $val;
                    }
                }
            } else {
                foreach ($data as $val) {
                    if ($status == $val[$type]) {
                        $result = $val;
                        break;
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 获取状态
     * @param mixed $status
     * @param string $type
     * @return array
     */
    public static function getRestStatus($status = null, $type = 'status')
    {
        $data   = array(
            array(
                'status' => self::REST_NORMAL,
                'name'   => '正常',
                'color'  => 'green',
                'const'  => 'REST_NORMAL',
            ),
            array(
                'status' => self::RESTING,
                'name'   => '休息中',
                'color'  => 'red',
                'const'  => 'RESTING',
            ),
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
     * 添加团长
     * @param array $data
     * @return array
     */
    public function addLeader(array $data)
    {
        $site_id   = $data['site_id'] ?? 0;
        $member_id = $data['member_id'] ?? 0;

        

        $condition = [['member_id', '=', $member_id]];

        // 检测会员是否存在
        $member_model = new MemberModel();
        $member_info  = $member_model->getMemberInfo($condition, 'username')['data'];

        if (empty($member_info)) {
            return $this->error('', 'MEMBER_NOT_EXIST');
        }

        // 检测绑定的会员是否有申请团长
        $info = $this->getLeaderInfo($condition, 'status')['data'];
        if (!empty($info)) {
            if (in_array($info['status'], [self::STATUS_AUDIT_WAIT, self::STATUS_AUDIT_REFUSE])) {
                return $this->error('', '当前会员有正在申请的团长信息，不可重复提交');
            }
            return $this->error('', '当前会员已是团长');
        }

        // 检测团长等级是否存在
        $level_model = new CommunityLevelModel();
        $level_info  = $level_model->getCommunityLevelInfo([['site_id', '=', $site_id], ['level_id', '=', $data['level_id']]], 'level_name')['data'];
        if (empty($level_info)) {
            return $this->error('', '团长等级不存在');
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            $data = array_merge($data, [
                'level_name'  => $level_info['level_name'],
                'status'      => self::STATUS_NORMAL,
                'rest_status' => self::REST_NORMAL,
                'apply_time'  => time(),
                'audit_time'  => time(),
            ]);

            // 添加团长信息
            $cl_id = model(self::TABLE_NAME)->add($data);

            $this->auditPassSuccess($site_id, $member_id, $cl_id, $data['name']);

            model(self::TABLE_NAME)->commit();
            return $this->success($cl_id);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 编辑团长
     * @param array $params
     * @param array $condition
     * @return array
     */
    public function editLeader(array $params, array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;
        $cl_id           = $check_condition['cl_id'] ?? 0;


        if (empty($cl_id)) {
            return $this->error('', 'MEMBER_NOT_EXIST');
        }

        $condition = [['site_id', '=', $site_id], ['cl_id', '=', $cl_id]];

        // 检测团长是否存在
        $info = $this->getLeaderInfo($condition, 'status, name, member_id')['data'];
        if (empty($info)) {
            return $this->error('', '团长不存在');
        }

        // 基础信息
        $data = [
            'name'          => $params['name'],
            'mobile'        => $params['mobile'],
            'community'     => $params['community'],
            'community_img' => $params['community_img'],
            'wechat'        => $params['wechat'],
            'province_id'   => $params['province_id'],
            'city_id'       => $params['city_id'],
            'district_id'   => $params['district_id'],
            'address'       => $params['address'],
            'full_address'  => $params['full_address'],
            'longitude'     => $params['longitude'],
            'latitude'      => $params['latitude'],
            'remarks'       => $params['remarks'],
        ];

        // 如果团长已审核通过
        if (in_array($info['status'], [self::STATUS_NORMAL, self::STATUS_FREEZE])) {

            // 团长等级
            if (isset($params['level_id'])) {
                $level_model = new CommunityLevelModel();
                $level_info  = $level_model->getCommunityLevelInfo([['site_id', '=', $site_id], ['level_id', '=', $params['level_id']]], 'level_name')['data'];
                if (empty($level_info)) {
                    return $this->error('', '团长等级不存在');
                }
                $data = array_merge($data, [
                    'level_id'   => $params['level_id'],
                    'level_name' => $level_info['level_name'],
                ]);
            }

            // 路线&配送员
            if (isset($params['line_id'])) {
                if (empty($params['line_id']) || empty($params['line_name']) || empty($params['clerk_id']) || empty($params['clerk_name'])) {
                    return $this->error('', 'PARAMETER_ERROR');
                }
                $data = array_merge($data, [
                    'line_id'    => $params['line_id'],
                    'line_name'  => $params['line_name'],
                    'clerk_id'   => $params['clerk_id'],
                    'clerk_name' => $params['clerk_name'],
                ]);
            }
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            // 编辑团长信息
            $res = model(self::TABLE_NAME)->update($data, $condition);

            if ($info['name'] !== $data['name'] && in_array($info['status'], [self::STATUS_NORMAL, self::STATUS_FREEZE])) {
                // 会员表关联团长信息
                model('member')->update(['self_leader_name' => $data['name']], [
                    ['member_id', '=', $info['member_id']],
                    ['self_cl_id', '=', $cl_id],
                ]);
            }

            model(self::TABLE_NAME)->commit();
            return $this->success($res);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 申请团长
     * @param array $data
     * @return array
     */
    public function applyLeader(array $data)
    {
        $member_id = $data['member_id'] ?? 0;
       


        if (empty($member_id)) {
            return $this->error('', 'MEMBER_NOT_EXIST');
        }

        $condition = [ ['member_id', '=', $member_id]];

        // 检测会员是否存在
        $member_model = new MemberModel();
        $member_info  = $member_model->getMemberInfo($condition, 'username')['data'];
        if (empty($member_info)) {
            return $this->error('', 'MEMBER_NOT_EXIST');
        }

        // 检测当前会员是否符合申请
        $info     = $this->getLeaderInfo($condition, 'cl_id, status')['data'];
        
        $is_apply = false;
        $cl_id    = 0;
        if (!empty($info)) {
            if ($info['status'] == self::STATUS_AUDIT_REFUSE) {
                $is_apply = true;
            }
            $cl_id = $info['cl_id'];
        } else {
            $is_apply = true;
        }
        if (!$is_apply) return $this->error('', '当前账号已申请, 请勿重复提交');

        model(self::TABLE_NAME)->startTrans();
        try {
            $data = array_merge($data, [
                'status'        => self::STATUS_AUDIT_WAIT,
                'apply_time'    => time(),
                'audit_time'    => 0,
                'refuse_reason' => '',
            ]);

            if ($cl_id > 0) {
                // 修改申请信息
                model(self::TABLE_NAME)->update($data, [['cl_id', '=', $cl_id]]);
            } else {
                // 添加申请信息
                $cl_id = model(self::TABLE_NAME)->add($data);
            }

            model(self::TABLE_NAME)->commit();
            return $this->success($cl_id);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * 审核通过
     * @param array $params
     * @return array
     */
    public function auditPass(array $params)
    {
        
        $cl_ids     = $params['cl_ids'] ?? '';
        $level_id   = $params['level_id'] ?? 0;
        $line_id    = $params['line_id'] ?? 0;
        $line_name  = $params['line_name'] ?? '';
        $clerk_id   = $params['clerk_id'] ?? '';
        $clerk_name = $params['clerk_name'] ?? '';

        
        if (empty($cl_ids) || empty($level_id) ) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        // 检测团长等级是否存在
        $level_model = new CommunityLevelModel();
        $level_info  = $level_model->getCommunityLevelInfo([['level_id', '=', $level_id]], 'level_name')['data'];
        
        if (empty($level_info)) {
            return $this->error('', '团长等级不存在');
        }
        
        $condition = [
          
            ['cl_id', 'in', (string)$cl_ids],
            ['status', '=', self::STATUS_AUDIT_WAIT],
        ];

        $data = $this->getLeaderList($condition, 'cl_id, name, member_id')['data'];
       
        if (empty($data)) {
            $this->error('', '没有' . self::getStatus(self::STATUS_AUDIT_WAIT)['name'] . '状态的申请团长');
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            model(self::TABLE_NAME)->update([
                'level_id'   => $level_id,
                'level_name' => $level_info['level_name'],
                'line_id'    => $line_id,
                'line_name'  => $line_name,
                'clerk_id'   => $clerk_id,
                'clerk_name' => $clerk_name,
                'status'     => self::STATUS_NORMAL,
                'audit_time' => time()
            ], $condition);

            foreach ($data as $key => $val) {
                $this->auditPassSuccess(0, $val['member_id'], $val['cl_id'], $val['name']);
            }
            model(self::TABLE_NAME)->commit();
            return $this->success();
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 审核通过成功
     * @param $site_id
     * @param $member_id
     * @param $cl_id
     * @param $name
     * @return array
     */
    private function auditPassSuccess($site_id, $member_id, $cl_id, $name)
    {
        // 会员表关联团长信息
        model('member')->update([
            'self_cl_id'       => $cl_id,
            'self_leader_name' => $name
        ], [['member_id', '=', $member_id]]);

        // 添加统计
/*        $stat = new Stat();
        $stat->addShopStat(['leader_count' => 1, 'site_id' => $site_id]);*/

        return $this->success();
    }

    /**
     * 审核拒绝
     * @param $site_id
     * @param $cl_id
     * @param $refuse_reason
     * @return array
     */
    public function auditRefuse($site_id, $cl_id, $refuse_reason)
    {

        if (empty($cl_id) || empty($refuse_reason)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        $condition = [
            ['site_id', '=', $site_id],
            ['cl_id', '=', $cl_id],
            ['status', '=', self::STATUS_AUDIT_WAIT],
        ];

        $info = $this->getLeaderInfo($condition, 'cl_id')['data'];
        if (empty($info)) {
            $this->error('', '没有' . self::getStatus(self::STATUS_AUDIT_WAIT)['name'] . '状态的申请团长');
        }

        model(self::TABLE_NAME)->update([
            'status'        => self::STATUS_AUDIT_REFUSE,
            'audit_time'    => time(),
            'refuse_reason' => $refuse_reason,
        ], $condition);
        return $this->success();
    }

    /**
     * 冻结团长账号
     * @param $site_id
     * @param $cl_ids
     * @return array
     */
    public function freezeLeader($site_id, $cl_ids)
    {

        if (empty($cl_ids)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        model(self::TABLE_NAME)->update(['status' => self::STATUS_FREEZE], [
            ['site_id', '=', $site_id],
            ['cl_id', 'in', (string)$cl_ids],
            ['status', '=', self::STATUS_NORMAL],
        ]);
        return $this->success();
    }

    /**
     * 恢复团长账号
     * @param $site_id
     * @param $cl_ids
     * @return array
     */
    public function recoverLeader($site_id, $cl_ids)
    {

        if (empty($cl_ids)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        model(self::TABLE_NAME)->update(['status' => self::STATUS_NORMAL], [
            ['site_id', '=', $site_id],
            ['cl_id', 'in', (string)$cl_ids],
            ['status', '=', self::STATUS_FREEZE],
        ]);
        return $this->success();
    }

    /**
     * 绑定团长路线
     * @param array $params
     * @return array
     */
    public function bindLeaderLine(array $params)
    {
        $site_id    = $params['site_id'] ?? 0;
        $cl_ids     = $params['cl_ids'] ?? '';
        $line_id    = $params['line_id'] ?? 0;
        $line_name  = $params['line_name'] ?? '';
        $clerk_id   = $params['clerk_id'] ?? '';
        $clerk_name = $params['clerk_name'] ?? '';


        if (empty($cl_ids) || empty($line_id) || empty($line_name) || empty($clerk_id) || empty($clerk_name)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        model(self::TABLE_NAME)->update([
            'line_id'    => $line_id,
            'line_name'  => $line_name,
            'clerk_id'   => $clerk_id,
            'clerk_name' => $clerk_name,
        ], [
            ['site_id', '=', $site_id],
            ['cl_id', 'in', (string)$cl_ids],
            ['status', 'in', self::STATUS_NORMAL . ',' . self::STATUS_FREEZE],
        ]);
        return $this->success();
    }

    /**
     * 设置团长休息
     * @param int $site_id
     * @param string $ids
     * @param int $rest_status
     * @param string $field_type
     * @return array
     */
    public function setLeaderRest($site_id, $ids, $rest_status = 0, $field_type = 'cl_id')
    {
        
        if (empty($ids) || is_null($rest_status)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        if (empty(self::getRestStatus($rest_status))) {
            return $this->error('', 'PARAMETER_ERROR');
        }
       
        $condition = [
            ['status', 'in', self::STATUS_NORMAL . ',' . self::STATUS_FREEZE],
        ];
        if (in_array($field_type, ['cl_id', 'member_id'])) {
            $condition[] = [$field_type, 'in', (string)$ids];
        } else {
            return $this->error('', 'PARAMETER_ERROR');
        }

        model(self::TABLE_NAME)->update(['rest_status' => $rest_status], $condition);
        return $this->success();
    }

    /**
     * 修改团长信息
     * @param $data
     * @param $condition
     * @return array
     */
    public function updateLeader($data, $condition)
    {
        $res = model(self::TABLE_NAME)->update($data, $condition);
        return $this->success($res);
    }


    /**
     * 获取团长分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param bool $field
     * @param string $alias
     * @param array $join
     * @return array
     */
    public function getLeaderPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'cl_id desc', $field = true, $alias = '', $join = [])
    {
        $res = model(self::TABLE_NAME)->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        foreach ($res['list'] as $key => $val) {
            $res['list'][$key] = $this->handleData($val);
        }
        return $this->success($res);
    }

    /**
     * 获取团长列表
     * @param $condition
     * @param bool $field
     * @param string $order
     * @param string $alias
     * @param array $join
     * @param string $group
     * @param null $limit
     * @return array
     */
    public function getLeaderList($condition, $field = true, $order = 'cl_id desc', $alias = '', $join = [], $group = '', $limit = null)
    {
        $res = model(self::TABLE_NAME)->getList($condition, $field, $order, $alias, $join, $group, $limit);
        foreach ($res as $key => $val) {
            $res[$key] = $this->handleData($val);
        }
        return $this->success($res);
    }

    /**
     * 获取团长信息
     * @param $condition
     * @param bool $field
     * @return array
     */
    public function getLeaderInfo($condition, $field = true)
    {
         
        $res = model(self::TABLE_NAME)->getInfo($condition, $field);
        
         
        $res = $this->handleData($res);
        return $this->success($res);
    }


    /**
     * 查询社区  带有距离
     * @param $condition
     * @param $lnglat
     */
    public function getLocationLeaderList($condition, $field, $lnglat, $comunity_distance = 1000)
    {

        $order = '';
        if ($lnglat['lat'] !== null && $lnglat['lng'] !== null) {
            $field       .= ' , ROUND(st_distance ( point ( ' . $lnglat['lng'] . ', ' . $lnglat['lat'] . ' ), point ( longitude, latitude ) ) * 111195 / 1000, 2) as distance ';
            $condition[] = ['', 'exp', Db::raw(' FORMAT(st_distance ( point ( ' . $lnglat['lng'] . ', ' . $lnglat['lat'] . ' ), point ( longitude, latitude ) ) * 111195 / 1000, 2) < ' . $comunity_distance)];
            $order       = 'distance asc';
        }
        $list = model(self::TABLE_NAME)->getList($condition, $field, $order);
        return $this->success($list);
    }

    /**
     * 查询列表  带有距离
     * @param $condition
     * @param $field
     * @param $lnglat
     * @return array
     */
    public function getLocationList($condition, $field, $lnglat)
    {
        $order = '';
        if ($lnglat['lat'] !== null && $lnglat['lng'] !== null) {
            $field       .= ' , ROUND(st_distance ( point ( ' . $lnglat['lng'] . ', ' . $lnglat['lat'] . ' ), point ( longitude, latitude ) ) * 111195 / 1000, 2) as distance ';
            $condition[] = ['', 'exp', Db::raw(' FORMAT(st_distance ( point ( ' . $lnglat['lng'] . ', ' . $lnglat['lat'] . ' ), point ( longitude, latitude ) ) * 111195 / 1000, 2) < 10000')];
            $order       = 'distance asc';
        }
        $list = model(self::TABLE_NAME)->getList($condition, $field, $order);
        return $this->success($list);
    }

    /**
     * 获取团长数量
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getLeaderCount($condition = [], $field = 'cl_id')
    {
        $res = model(self::TABLE_NAME)->getCount($condition, $field);
        return $this->success($res);
    }

    /**
     * 获取团长总和
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getLeaderSum($condition = [], $field = 'commission_total')
    {
        $res = model(self::TABLE_NAME)->getSum($condition, $field);
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
            if (isset($info['rest_status'])) {
                $info['rest_status_info'] = self::getRestStatus($info['rest_status']);
            }
        }
        return $info;
    }
}