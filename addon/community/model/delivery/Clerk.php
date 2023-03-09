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
use addon\community\model\community\Leader as LeaderModel;
use addon\community\model\delivery\Line as LineModel;
use app\model\member\Member as MemberModel;
use think\facade\Cache;

/**
 * 配送员
 * Class Clerk
 * @package app\model\delivery
 */
class Clerk extends BaseModel
{
    /**
     * 缓冲标签名称
     */
    const CACHE_TAG_NAME = 'delivery_clerk';

    /**
     * 表名称
     */
    const TABLE_NAME = 'delivery_clerk';


    /**
     * 添加配送员
     * @param array $params
     * @return array
     */
    public function addClerk(array $params)
    {
        $site_id   = $params['site_id'] ?? 0;
        $member_id = $params['member_id'] ?? 0;
        $username  = '';

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $member_model = new MemberModel();
        if (!empty($member_id)) {

            // 检测会员是否存在
            $member_info = $member_model->getMemberInfo([
                ['site_id', '=', $site_id],
                ['member_id', '=', $member_id],
            ], 'username')['data'];
            if (empty($member_info)) {
                return $this->error('', 'MEMBER_NOT_EXIST');
            }

            $username = $member_info['username'];

            // 检测会员是否绑定
            if ($this->memberIsBind($site_id, $member_id)['data']) {
                return $this->error('', '当前会员已被绑定');
            }
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            $res = model(self::TABLE_NAME)->add([
                'site_id'       => $site_id,
                'member_id'     => $member_id,
                'username'      => $username,
                'clerk_name'    => $params['clerk_name'],
                'clerk_mobile'  => $params['clerk_mobile'],
                'clerk_headimg' => $params['clerk_headimg'],
                'clerk_remark'  => $params['clerk_remark'],
                'create_time'   => time(),
            ]);

            // 会员表记录绑定的配送员
            if (!empty($member_id)) {
                $member_model->editMember([
                    'delivery_clerk_id'   => $res,
                    'delivery_clerk_name' => $params['clerk_name']
                ], [['member_id', '=', $member_id]]);
            }

            Cache::tag(self::CACHE_TAG_NAME)->clear();

            model(self::TABLE_NAME)->commit();

            return $this->success($res);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 编辑配送员
     * @param array $params
     * @param array $condition
     * @return array
     */
    public function editClerk(array $params, array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;
        $clerk_id        = $check_condition['clerk_id'] ?? 0;
        $member_id       = $params['member_id'] ?? 0;
        $username        = '';

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if (empty($clerk_id)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        // 检测配送员是否存在
        $info = $this->getClerkInfo($condition, 'member_id, username, clerk_name')['data'];
        if (empty($info)) {
            return $this->error('', '配送员不存在');
        }

        $member_model = new MemberModel();

        // 检测是否可绑定会员
        if (!empty($info['member_id'])) {

            // 已绑定的会员不允许修改
            if ($info['member_id'] != $member_id) {
                return $this->error('', '已绑定的会员不允许修改');
            }

            $username = $info['username'];
        } else {

            if (!empty($member_id)) {

                // 检测会员是否存在
                $member_info = $member_model->getMemberInfo([
                    ['site_id', '=', $site_id],
                    ['member_id', '=', $member_id],
                ], 'username')['data'];
                if (empty($member_info)) {
                    return $this->error('', 'MEMBER_NOT_EXIST');
                }

                $username = $member_info['username'];

                // 检测会员是否绑定
                if ($this->memberIsBind($site_id, $member_id, $clerk_id)['data']) {
                    return $this->error('', '当前会员已被绑定');
                }
            }
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            $res = model(self::TABLE_NAME)->update([
                'member_id'     => $member_id,
                'username'      => $username,
                'clerk_name'    => $params['clerk_name'],
                'clerk_mobile'  => $params['clerk_mobile'],
                'clerk_headimg' => $params['clerk_headimg'],
                'clerk_remark'  => $params['clerk_remark'],
                'update_time'   => time(),
            ], $condition);

            // 会员表记录绑定的配送员
            if (!empty($member_id)) {
                $member_model->editMember([
                    'delivery_clerk_id'   => $clerk_id,
                    'delivery_clerk_name' => $params['clerk_name']
                ], [['member_id', '=', $member_id]]);
            }

            // 修改后同步关联数据
            if ($params['clerk_name'] !== $info['clerk_name']) {

                // 路线
                $line_model = new LineModel();
                $line_model->updateLine(['clerk_name' => $params['clerk_name']], [['site_id', '=', $site_id], ['clerk_id', '=', $clerk_id]]);

                // 团长
                $leader_model = new LeaderModel();
                $leader_model->updateLeader(['clerk_name' => $params['clerk_name']], [['site_id', '=', $site_id], ['clerk_id', '=', $clerk_id]]);
            }

            Cache::tag(self::CACHE_TAG_NAME)->clear();

            model(self::TABLE_NAME)->commit();

            return $this->success($res);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 会员绑定配送员
     * @param $site_id
     * @param $clerk_id
     * @param $member_id
     * @return array
     */
    public function bindClerk($site_id, $clerk_id, $member_id)
    {
        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if (empty($member_id)) {
            return $this->error('', 'MEMBER_NOT_EXIST');
        }

        // 检测配送员是否存在
        $condition = [['site_id', '=', $site_id], ['clerk_id', '=', $clerk_id]];
        $info      = $this->getClerkInfo($condition, 'member_id, clerk_name')['data'];
        if (empty($info)) {
            return $this->error('', '配送员不存在');
        }

        // 检测配送员是否已绑定会员
        if (!empty($info['member_id'])) {
            if ($info['member_id'] == $member_id) {
                return $this->success();
            } else {
                return $this->error('', '当前配送员已绑定其他会员账号');
            }
        }

        // 检测会员是否存在
        $member_model = new MemberModel();
        $member_info  = $member_model->getMemberInfo([
            ['site_id', '=', $site_id],
            ['member_id', '=', $member_id],
        ], 'username')['data'];
        if (empty($member_info)) {
            return $this->error('', 'MEMBER_NOT_EXIST');
        }

        // 检测会员是否绑定
        if ($this->memberIsBind($site_id, $member_id)['data']) {
            return $this->error('', '当前会员已绑定配送员');
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            model(self::TABLE_NAME)->update([
                'member_id' => $member_id,
                'username'  => $member_info['username'],
            ], $condition);

            // 会员表记录绑定的配送员
            $member_model->editMember([
                'delivery_clerk_id'   => $clerk_id,
                'delivery_clerk_name' => $info['clerk_name']
            ], [['member_id', '=', $member_id]]);

            Cache::tag(self::CACHE_TAG_NAME)->clear();

            model(self::TABLE_NAME)->commit();

            return $this->success();
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 删除配送员
     * @param $site_id
     * @param $clerk_id
     * @return array
     */
    public function deleteClerk($site_id, $clerk_id)
    {
        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $condition = [['site_id', '=', $site_id], ['clerk_id', '=', $clerk_id]];

        // 检测配送员是否存在
        $info = $this->getClerkInfo($condition, 'member_id')['data'];
        if (empty($info)) {
            return $this->error('', '配送员不存在');
        }

        // 检测是否可删除
        $line_model = new LineModel();
        $line_info  = $line_model->getLineInfo($condition, 'line_name')['data'];
        if (!empty($line_info)) {
            return $this->error('', '配送路线【' . $line_info['line_name'] . '】已绑定该配送员, 请解绑后再删除');
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            $res = model(self::TABLE_NAME)->delete($condition);

            // 会员表记录绑定的配送员
            if (!empty($info['member_id'])) {
                $member_model = new MemberModel();
                $member_model->editMember([
                    'delivery_clerk_id'   => 0,
                    'delivery_clerk_name' => ''
                ], [['member_id', '=', $info['member_id']]]);
            }

            Cache::tag(self::CACHE_TAG_NAME)->clear();

            model(self::TABLE_NAME)->commit();

            return $this->success($res);
        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();
            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 获取配送员信息
     * @param $condition
     * @param bool $field
     * @return array
     */
    public function getClerkInfo($condition, $field = true)
    {
        $params     = json_encode(func_get_args());
        $cache_name = self::CACHE_TAG_NAME . '_' . __FUNCTION__ . '_' . $params;

        $res = Cache::get($cache_name);
        if (empty($res)) {
            $res = model(self::TABLE_NAME)->getInfo($condition, $field);
            Cache::tag(self::CACHE_TAG_NAME)->set($cache_name, $res);
        }
        return $this->success($res);
    }

    /**
     * 获取配送员分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param bool $field
     * @param string $alias
     * @param array $join
     * @return array
     */
    public function getClerkPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'clerk_id desc', $field = true, $alias = '', $join = [])
    {
        $params     = json_encode(func_get_args());
        $cache_name = self::CACHE_TAG_NAME . '_' . __FUNCTION__ . '_' . $params;

        $res = Cache::get($cache_name);
        if (empty($res)) {

            $res = model(self::TABLE_NAME)->pageList($condition, $field, $order, $page, $page_size, $alias, $join);

            Cache::tag(self::CACHE_TAG_NAME)->set($cache_name, $res);
        }

        return $this->success($res);
    }

    /**
     * 获取配送员列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getClerkList($condition = [], $field = 'clerk_id, site_id, clerk_name, clerk_mobile, clerk_headimg, member_id, username', $order = 'clerk_id desc', $limit = null)
    {
        $params     = json_encode(func_get_args());
        $cache_name = self::CACHE_TAG_NAME . '_' . __FUNCTION__ . '_' . $params;

        $res = Cache::get($cache_name);
        if (empty($res)) {

            $res = model(self::TABLE_NAME)->getList($condition, $field, $order, '', '', '', $limit);

            Cache::tag(self::CACHE_TAG_NAME)->set($cache_name, $res);
        }

        return $this->success($res);
    }

    /**
     * 获取配送员数量
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getClerkCount($condition, $field = 'clerk_id')
    {
        $params     = json_encode(func_get_args());
        $cache_name = self::CACHE_TAG_NAME . '_' . __FUNCTION__ . '_' . $params;

        $res = Cache::get($cache_name);
        if (empty($res)) {

            $res = model(self::TABLE_NAME)->getCount($condition, $field);

            Cache::tag(self::CACHE_TAG_NAME)->set($cache_name, $res);
        }

        return $this->success($res);
    }

    /**
     * 会员是否已绑定
     * @param $site_id
     * @param $member_id
     * @param int $clerk_id
     * @return array
     */
    public function memberIsBind($site_id, $member_id, $clerk_id = 0)
    {
        $params     = json_encode(func_get_args());
        $cache_name = self::CACHE_TAG_NAME . '_' . __FUNCTION__ . '_' . $params;

        $res = Cache::get($cache_name);
        if (empty($res)) {
            $condition = [
                ['site_id', '=', $site_id],
                ['member_id', '=', $member_id],
            ];
            if ($clerk_id) {
                $condition[] = ['clerk_id', '<>', $clerk_id];
            }

            $info = $this->getClerkInfo($condition, 'clerk_id')['data'];
            $res  = !empty($info) ? $info['clerk_id'] : 0;

            Cache::tag(self::CACHE_TAG_NAME)->set($cache_name, $res);
        }
        return $this->success($res);
    }
}