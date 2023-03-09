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
use think\facade\Cache;
use addon\community\model\delivery\Clerk as ClerkModel;
use addon\community\model\community\Leader as LeaderModel;

/**
 * 配送路线
 * Class Line
 * @package app\model\delivery
 */
class Line extends BaseModel
{
    /**
     * 缓冲标签名称
     */
    const CACHE_TAG_NAME = 'delivery_line';

    /**
     * 表名称
     */
    const TABLE_NAME = 'delivery_line';

    /**
     * 添加路线
     * @param array $params
     * @return array
     */
    public function addLine(array $params)
    {
        $site_id  = $params['site_id'] ?? 0;
        $clerk_id = $params['clerk_id'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        // 检测配送员是否存在
        $clerk_model = new ClerkModel();
        $clerk_info  = $clerk_model->getClerkInfo([['site_id', '=', $site_id], ['clerk_id', '=', $clerk_id]], 'clerk_name')['data'];
        if (empty($clerk_info)) {
            return $this->error('', '配送员不存在');
        }

        $res = model(self::TABLE_NAME)->add([
            'site_id'     => $site_id,
            'clerk_id'    => $clerk_id,
            'clerk_name'  => $clerk_info['clerk_name'],
            'line_name'   => $params['line_name'],
            'line_remark' => $params['line_remark'],
            'create_time' => time(),
        ]);
        Cache::tag(self::CACHE_TAG_NAME)->clear();

        return $this->success($res);
    }

    /**
     * 编辑路线
     * @param array $params
     * @param array $condition
     * @return array
     */
    public function editLine(array $params, array $condition)
    {
        $check_condition  = array_column($condition, 2, 0);
        $site_id          = $check_condition['site_id'] ?? 0;
        $line_id          = $check_condition['line_id'] ?? 0;
        $clerk_id         = $params['clerk_id'] ?? 0;

        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if (empty($line_id)) {
            return $this->error('', 'PARAMETER_ERROR');
        }

        // 检测路线是否存在
        $info = $this->getLineInfo($condition, 'line_id')['data'];
        if (empty($info)) {
            return $this->error('', '路线不存在');
        }

        // 检测配送员是否存在
        $clerk_model = new ClerkModel();
        $clerk_info  = $clerk_model->getClerkInfo([['site_id', '=', $site_id], ['clerk_id', '=', $clerk_id]], 'clerk_name')['data'];
        if (empty($clerk_info)) {
            return $this->error('', '配送员不存在');
        }

        model(self::TABLE_NAME)->startTrans();
        try {
            $res = model(self::TABLE_NAME)->update([
                'clerk_id'    => $clerk_id,
                'clerk_name'  => $clerk_info['clerk_name'],
                'line_name'   => $params['line_name'],
                'line_remark' => $params['line_remark'],
                'update_time' => time(),
            ], $condition);

            // 修改后同步关联数据 -- 团长
            $leader_model = new LeaderModel();
            $leader_model->updateLeader([
                'line_id'    => $line_id,
                'line_name'  => $params['line_name'],
                'clerk_id'   => $clerk_id,
                'clerk_name' => $clerk_info['clerk_name'],
            ], [['site_id', '=', $site_id], ['line_id', '=', $line_id]]);

            Cache::tag(self::CACHE_TAG_NAME)->clear();

            model(self::TABLE_NAME)->commit();

            return $this->success($res);

        } catch (\Exception $e) {
            model(self::TABLE_NAME)->rollback();

            return $this->error('', '操作异常：' . $e->getMessage());
        }
    }

    /**
     * 修改路线信息
     * @param $data
     * @param $condition
     * @return array
     */
    public function updateLine($data, $condition)
    {
        $res = model(self::TABLE_NAME)->update($data, $condition);
        Cache::tag(self::CACHE_TAG_NAME)->clear();
        return $this->success($res);
    }

    /**
     * 删除路线
     * @param $site_id
     * @param $line_id
     * @return array
     */
    public function deleteLine($site_id, $line_id)
    {
        if (empty($site_id)) {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $condition = [['site_id', '=', $site_id], ['line_id', '=', $line_id]];

        // 检测路线是否存在
        $info = $this->getLineInfo($condition, 'line_id')['data'];
        if (empty($info)) {
            return $this->error('', '路线不存在');
        }

        // 检测是否可删除
        $leader_model = new LeaderModel();
        $leader_info = $leader_model->getLeaderInfo($condition, 'name')['data'];
        if (!empty($leader_info)) {
            return $this->error('', '团长【' . $leader_info['name'] . '】已绑定该路线, 请解绑后再删除');
        }

        $res = model(self::TABLE_NAME)->delete($condition);

        Cache::tag(self::CACHE_TAG_NAME)->clear();

        return $this->success($res);
    }

    /**
     * 获取路线信息
     * @param $condition
     * @param bool $field
     * @return array
     */
    public function getLineInfo($condition, $field = true)
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
     * 获取路线分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param bool $field
     * @param string $alias
     * @param array $join
     * @return array
     */
    public function getLinePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'line_id desc', $field = true, $alias = '', $join = [])
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
     * 获取路线列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getLineList($condition = [], $field = 'line_id, site_id, clerk_id, clerk_name, line_name', $order = 'line_id desc', $limit = null)
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
     * 获取路线数量
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getLineCount($condition, $field = 'line_id')
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
}