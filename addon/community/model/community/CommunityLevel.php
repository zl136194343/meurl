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

use addon\community\model\community\Leader as LeaderModel;

/**
 * 团长
 */
class CommunityLevel extends BaseModel
{
    /**
     * 添加会员等级
     *
     * @param array $data
     */
    public function addCommunityLevel($data)
    {
        $res = model('community_level')->add($data);

        return $this->success($res);
    }

    /**
     * 修改团长等级
     * @param array $data
     * @param array $condition
     * @return array
     */
    public function editCommunityLevel(array $data, array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;
        $level_id        = $check_condition['level_id'] ?? 0;

        $info = $this->getCommunityLevelInfo($condition, 'level_name')['data'];
        if (empty($info)) {
            return $this->error('', '等级不存在');
        }

        $res = model('community_level')->update($data, $condition);
        if (isset($data['level_name']) && $data['level_name'] !== $info['level_name']) {
            $leader_model = new LeaderModel();
            $leader_model->updateLeader(['level_name' => $data['level_name']], [
                ['level_id', '=', $level_id]
            ]);
        }
        return $this->success($res);
    }

    /**
     * 删除团长等级
     * @param array $condition
     * @return array
     */
    public function deleteCommunityLevel(array $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = $check_condition['site_id'] ?? 0;
        $level_id        = $check_condition['level_id'] ?? 0;


        $info = $this->getCommunityLevelInfo($condition, 'level_name')['data'];
        if (empty($info)) {
            return $this->error('', '等级不存在');
        }

        // 检测是否有团长关联
        $leader_model = new LeaderModel();
        $leader_info = $leader_model->getLeaderInfo([['level_id', '=', $level_id]], 'name')['data'];
        if (!empty($leader_info)) {
            return $this->error('', '团长【' . $leader_info['name'] . '】已绑定该等级, 请解绑后再删除');
        }

        $res = model('community_level')->delete($condition);

        return $this->success($res);
    }

    /**
     * 获取会员等级信息
     *
     * @param array $condition
     * @param string $field
     */
    public function getCommunityLevelInfo($condition = [], $field = '*')
    {

        $info = model('community_level')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取团长等级列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getCommunityLevelList($condition = [], $field = '*', $order = 'sort asc, level_id asc', $limit = null)
    {
        $list = model('community_level')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }


    /**
     * 获取团长等级分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getCommunityLevelPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc, level_id asc', $field = '*')
    {
        $list = model('community_level')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }
}