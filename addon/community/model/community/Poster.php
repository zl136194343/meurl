<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\community\model\community;

use app\model\BaseModel;
use extend\Poster as PosterExtend;

/**
 * 海报生成类
 */
class Poster extends BaseModel
{
    /**
     * 海报
     */
    public function recommendQc($app_type, $page, $member_id, $site_id)
    {
        try {
            $qrcode_info = $this->getQrcode($app_type, $page, $member_id, $site_id);
            if ($qrcode_info['code'] < 0) return $qrcode_info;

            $member_info = $this->getMemberInfo($member_id);
            if (empty($member_info)) return $this->error('未获取到会员信息');

            $leader = new Leader();
            $leader_info = $leader->getLeaderInfo(['member_id' => $member_id], 'name,community_img')['data'];

            $poster = new PosterExtend(740, 1250);
            $option = [
                [
                    'action' => 'imageCopy', // 背景图
                    'data'   => [
                        'upload/poster/bg/community.png',
                        0,
                        0,
                        740,
                        1250
                    ]
                ],
                [
                    'action' => 'imageCopy', // 写入二维码
                    'data'   => [
                        $qrcode_info['data']['path'],
                        505,
                        980,
                        205,
                        205
                    ]
                ],
                [
                    'action' => 'imageCircularCopy', // 写入团长头像
                    'data'   => [
                        !empty($leader_info['community_img']) ? $leader_info['community_img'] : 'upload/uniapp/default_headimg.png',
                        82,
                        852,
                        112,
                        112
                    ]
                ],
                [
                    'action' => 'imageText', // 团长名称
                    'data'   => [
                        $leader_info['name'],
                        22,
                        [255, 129, 61],
                        40,
                        1030,
                        440,
                        1,
                        true
                    ]
                ],
//                [
//                    'action' => 'imageText', // 写入分享语
//                    'data'   => [
//                        '我的社区你的家，快来获取所需商品',
//                        18,
//                        [141, 141, 141],
//                        40,
//                        1070,
//                        440,
//                        1
//                    ]
//                ]
            ];
            $option_res = $poster->create($option);
            if (is_array($option_res)) return $option_res;

            $res = $option_res->jpeg('upload/poster/recommend', 'recommend' . $member_id . '_' . $app_type);
            return $res;
        } catch (\Exception $e) {
            return $this->error($e->getMessage() . $e->getFile() . $e->getLine());
        }
    }

    /**
     * 获取用户信息
     * @param unknown $member_id
     */
    private function getMemberInfo($member_id)
    {
        $info = model('member')->getInfo(['member_id' => $member_id], 'nickname,headimg');
        return $info;
    }

    /**
     * 获取二维码
     * @param unknown $app_type 请求类型
     * @param unknown $page uniapp页面路径
     * @param unknown $qrcode_param 推荐人
     * @param string $promotion_type 活动类型 null为无活动
     */
    private function getQrcode($app_type, $page, $member_id, $site_id)
    {
        $res = event('Qrcode', [
            'site_id'     => $site_id,
            'app_type'    => $app_type,
            'type'        => 'get',
            'data'        => ['source_member' => $member_id],
            'page'        => $page,
            'qrcode_path' => 'upload/qrcode/recommend',
            'qrcode_name' => 'recommend' . '_' . $member_id . '_' . $site_id,
        ], true);
        return $res;
    }
}