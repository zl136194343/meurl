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

namespace addon\community\shop\controller;

use addon\community\model\community\CommunityAccount;
use addon\community\model\community\Config as CommunityConfig;
use addon\community\model\community\CommunityLevel;
use addon\community\model\community\Leader;
use addon\community\model\delivery\Clerk as ClerkModel;
use addon\community\model\delivery\Line as LineModel;
use app\model\system\Address as AddressModel;
use app\model\web\Config as ConfigModel;
use app\model\member\Member as MemberModel;
use app\admin\controller\BaseAdmin;

use addon\community\model\community\Withdraw;
/**
 * 团长管理 控制器
 */

class Community extends BaseAdmin
{
    public $site_id = 0;
    /******************************* 团长 start ******************************************/
    /**
     * 团长列表
     */
    public function lists()
    {
        $field_list = [
            'select' => [
                'community' => '自提点',
                'name'      => '团长名称',
                'mobile'    => '团长手机',
                'wechat'    => '团长微信',
            ],
            'time'   => [
                'audit_time' => '成为团长',
                'apply_time' => '申请时间',
            ]
        ];
        $status_arr = [Leader::STATUS_NORMAL, Leader::STATUS_FREEZE];
        $condition  = [];

        if (request()->isAjax()) {

            $page_index         = input('page', 1);
            $page_size          = input('page_size', PAGE_LIST_ROWS);
            $select_field_type  = input('select_field_type', '');
            $select_field_value = input('select_field_value', '');
            $time_field_type    = input('time_field_type', '');
            $start_date         = input('start_date', '');
            $end_date           = input('end_date', '');
            $level_id           = input('level_id', '');
            $rest_status        = input('rest_status', '');
            $line_id            = input('line_id', '');
            $clerk_id           = input('clerk_id', '');
            $status             = input('status', '');
            $order_field        = input('order_field', '');
            $order_type         = input('order_type', '');

            if (!empty($select_field_value) && array_key_exists($select_field_type, $field_list['select'])) {
                $condition[] = [$select_field_type, 'like', '%' . $select_field_value . '%'];
            }
            if (array_key_exists($time_field_type, $field_list['time'])) {
                if (!empty($start_date) && !empty($end_date)) {
                    $condition[] = [$time_field_type, 'between', [date_to_time($start_date), date_to_time($end_date)]];
                } elseif (!empty($start_date) && empty($end_date)) {
                    $condition[] = [$time_field_type, '>=', date_to_time($start_date)];
                } elseif (empty($start_date) && !empty($end_date)) {
                    $condition[] = [$time_field_type, '<=', date_to_time($end_date)];
                }
            }
            if ($rest_status !== '') {
                $condition[] = ['rest_status', '=', $rest_status];
            }
            if (!empty($level_id)) {
                $condition[] = ['level_id', '=', $level_id];
            }
            if (!empty($line_id)) {
                $condition[] = ['line_id', '=', $line_id];
            }
            if (!empty($clerk_id)) {
                $condition[] = ['clerk_id', '=', $clerk_id];
            }
            if (!empty($status) && in_array($status, $status_arr)) {
                $condition[] = ['status', '=', $status];
            } else {
                $condition[] = ['status', 'in', implode(',', $status_arr)];
            }

            // 排序, 后面要跟主键排序, 防止要排序的值都一样, 会有混乱效果(经验)
            $order_by = '';
            if (!empty($order_field) && !empty($order_type)) {
                $order_by = $order_field . ' ' . $order_type . ', ';
            }
            $order_by .= 'cl_id desc';

            $leader_model = new Leader();
            $member_model = new MemberModel();

            $list = $leader_model->getLeaderPageList($condition, $page_index, $page_size, $order_by);

            foreach ($list['data']['list'] as $key => $val) {

                $list['data']['list'][$key]['team_sum'] = $member_model->getMemberCount([['member_id', '=', $val['member_id']]])['data'];
            }

            return $list;
        } else {
            $leader_level_model = new CommunityLevel();
            $line_model         = new LineModel();
            $clerk_model        = new ClerkModel();

            $this->assign([
                // 筛选字段
                'field_list'       => $field_list,
                // 状态数据
                'status_data'      => Leader::getStatus($status_arr),
                // 休息状态数据
                'rest_status_data' => Leader::getRestStatus(),
                // 团长等级数据
                'level_list'       => $leader_level_model->getCommunityLevelList($condition, 'level_id, level_name, commission_rate')['data'],
                // 配送路线数据
                'line_list'        => $line_model->getLineList($condition, 'line_id, line_name')['data'],
                // 配送员
                'clerk_list'       => $clerk_model->getClerkList($condition, 'clerk_id, clerk_name')['data'],
            ]);

            return $this->fetch('community/leader/lists');
        }
    }

    /**
     * 入驻申请
     */
    public function leaderApplyList()
    {
        $field_list = [
            'community' => '自提点',
            'name'      => '团长名称',
            'mobile'    => '团长手机',
            'wechat'    => '团长微信',
        ];
        $status_arr = [Leader::STATUS_AUDIT_WAIT, Leader::STATUS_AUDIT_REFUSE];
        $condition  = [];

        if (request()->isAjax()) {
            $page_index         = input('page', 1);
            $page_size          = input('page_size', PAGE_LIST_ROWS);
            $select_field_type  = input('select_field_type', '');
            $select_field_value = input('select_field_value', '');
            $start_date         = input('start_date', '');
            $end_date           = input('end_date', '');
            $status             = input('status', '');

            if (!empty($select_field_value) && array_key_exists($select_field_type, $field_list)) {
                $condition[] = [$select_field_type, 'like', '%' . $select_field_value . '%'];
            }
            if (!empty($start_date) && !empty($end_date)) {
                $condition[] = ['apply_time', 'between', [date_to_time($start_date), date_to_time($end_date)]];
            } elseif (!empty($start_date) && empty($end_date)) {
                $condition[] = ['apply_time', '>=', date_to_time($start_date)];
            } elseif (empty($start_date) && !empty($end_date)) {
                $condition[] = ['apply_time', '<=', date_to_time($end_date)];
            }
            if ($status !== '' && in_array($status, $status_arr)) {
                $condition[] = ['status', '=', $status];
            } else {
                $condition[] = ['status', 'in', implode(',', $status_arr)];
            }

            $leader_model = new Leader();
            $member_model = new MemberModel();

            $list = $leader_model->getLeaderPageList($condition, $page_index, $page_size);
            foreach ($list['data']['list'] as $key => $val) {

                $list['data']['list'][$key]['member_info'] = $member_model->getMemberInfo([['member_id', '=', $val['member_id']]], 'nickname, headimg')['data'];
            }
            return $list;
        } else {
            $leader_level_model = new CommunityLevel();

            $this->assign([
                // 筛选字段
                'field_list'  => $field_list,
                // 状态数据
                'status_data' => Leader::getStatus($status_arr),
                // 团长等级数据
                'level_list'  => $leader_level_model->getCommunityLevelList($condition, 'level_id, level_name, commission_rate')['data']
            ]);
            return $this->fetch('community/leader/apply_lists');
        }
    }

    /**
     * 添加团长
     */
    public function addLeader()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            return $leader_model->addLeader([
                'site_id'       => 0,
                'member_id'     => input('member_id', 0),
                'level_id'      => input('level_id', 0),
                'name'          => input('name', ''),
                'mobile'        => input('mobile', ''),
                'community'     => input('community', ''),
                'community_img' => input('community_img', ''),
                'wechat'        => input('wechat', ''),
                'line_id'       => input('line_id', 0),
                'line_name'     => input('line_name', ''),
                'clerk_id'      => input('clerk_id', 0),
                'clerk_name'    => input('clerk_name', ''),
                'province_id'   => input("province_id", 0),
                'city_id'       => input("city_id", 0),
                'district_id'   => input("district_id", 0),
                'address'       => input("address", ''),
                'full_address'  => input("full_address", ''),
                'longitude'     => input("longitude", 0),
                'latitude'      => input("latitude", 0),
                'remarks'       => input("remarks", ''),
            ]);
        } else {
            //团长等级
            $leader_level_model = new CommunityLevel();
            $level_list         = $leader_level_model->getCommunityLevelList([['site_id', '=', 0]], 'level_id, level_name, commission_rate');
            $this->assign('community_level', $level_list['data']);

            //查询省级数据列表
            $address_model = new AddressModel();
            $list          = $address_model->getAreaList([["pid", "=", 0], ["level", "=", 1]]);
            $this->assign("province_list", $list["data"]);
            $this->assign("http_type", get_http_type());

            //默认的会员头像
            $upload_config_model  = new ConfigModel();
            $upload_config_result = $upload_config_model->getDefaultImg(0, $this->app_module);
            $upload_config_result = $upload_config_result['data']['value'];
            $this->assign("default_headimg", $upload_config_result['default_headimg']);
            return $this->fetch('community/leader/add');
        }
    }

    /**
     * 编辑团长
     */
    public function editLeader()
    {
        $leader_model = new Leader();
        if (request()->isAjax()) {
            return $leader_model->editLeader([
                'level_id'      => input('level_id', 0),
                'name'          => input('name', ''),
                'mobile'        => input('mobile', ''),
                'community'     => input('community', ''),
                'community_img' => input('community_img', ''),
                'wechat'        => input('wechat', ''),
                'province_id'   => input("province_id", 0),
                'city_id'       => input("city_id", 0),
                'district_id'   => input("district_id", 0),
                'address'       => input("address", ''),
                'full_address'  => input("full_address", ''),
                'longitude'     => input("longitude", 0),
                'latitude'      => input("latitude", 0),
                'remarks'       => input("remarks", ''),
            ], [['site_id', '=', 0], ['cl_id', '=', input('cl_id', 0)]]);
        } else {

            //团长等级
            $leader_level_model = new CommunityLevel();
            $level_list         = $leader_level_model->getCommunityLevelList([['site_id', '=', 0]], 'level_id, level_name, commission_rate');
            $this->assign('community_level', $level_list['data']);

            //查询省级数据列表
            $address_model = new AddressModel();
            $list          = $address_model->getAreaList([["pid", "=", 0], ["level", "=", 1]]);
            $this->assign("province_list", $list["data"]);
            $this->assign("http_type", get_http_type());

            $cl_id = input('cl_id', 0);
            //团长信息
            $leader_info = $leader_model->getLeaderInfo(['cl_id' => $cl_id], '*');
            $this->assign('leader_info', $leader_info['data']);

            $member_model = new MemberModel();
            $condition[]  = ['member_id', '=', $leader_info['data']['member_id']];
            $member_info  = $member_model->getMemberInfo($condition, 'headimg,username,mobile,member_id');
            $this->assign('member_info', $member_info['data']);

            //默认的会员头像
            $upload_config_model  = new ConfigModel();
            $upload_config_result = $upload_config_model->getDefaultImg($this->site_id, $this->app_module);
            $upload_config_result = $upload_config_result['data']['value'];
            $this->assign("default_headimg", $upload_config_result['default_headimg']);

            //团长详情四级菜单
            $this->forthMenu(['cl_id' => $cl_id]);

            return $this->fetch('community/leader/edit');
        }
    }

    /**
     * 团长审核通过
     */
    public function auditPass()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            
            return $leader_model->auditPass([
                'cl_ids'     => input('cl_ids', ''),
                'level_id'   => input('level_id', 0),
                'line_id'    => input('line_id', 0),
                'line_name'  => input('line_name', ''),
                'clerk_id'   => input('clerk_id', 0),
                'clerk_name' => input('clerk_name', ''),
            ]);
        }
    }

    /**
     * 团长审核拒绝
     */
    public function auditRefuse()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            return $leader_model->auditRefuse($this->site_id, input('cl_id', 0), input('refuse_reason', ''));
        }
    }

    /**
     * 冻结团长账号
     */
    public function freezeLeader()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            return $leader_model->freezeLeader($this->site_id, input('cl_ids', ''));
        }
    }

    /**
     * 恢复团长账号
     */
    public function recoverLeader()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            return $leader_model->recoverLeader($this->site_id, input('cl_ids', ''));
        }
    }

    /**
     * 绑定团长路线
     */
    public function bindLeaderLine()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            return $leader_model->bindLeaderLine([
                'site_id'    => $this->site_id,
                'cl_ids'     => input('cl_ids', ''),
                'line_id'    => input('line_id', 0),
                'line_name'  => input('line_name', ''),
                'clerk_id'   => input('clerk_id', 0),
                'clerk_name' => input('clerk_name', ''),
            ]);
        }
    }

    /**
     * 设置团长休息
     */
    public function setLeaderRest()
    {
        if (request()->isAjax()) {
            $leader_model = new Leader();
            return $leader_model->setLeaderRest($this->site_id, input('cl_ids', ''), input('rest_status', ''));
        }
    }


    /******************************* 团长 end ******************************************/

    /**
     * 团长等级列表
     */
    public function levelList()
    {
        $model = new CommunityLevel();
        $field = '*';
        if (request()->isAjax()) {

            $page      = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $list      = $model->getCommunityLevelPageList([['site_id', '=', $this->site_id]], $page, $page_size, 'sort asc,create_time asc', $field);
            return $list;

        } else {

            return $this->fetch('community/level_list');
        }

    }

    /**
     * 添加团长等级
     */
    public function addLevel()
    {
        if (request()->isAjax()) {

            $data  = [
                'site_id'          => $this->site_id,
                'level_name'       => input('level_name', ''),
                'commission_money' => input('commission_money', 0.00),
                'commission_rate'  => input('commission_rate', 0.00),
                'sort'             => input('sort', 0),
                'create_time'      => time(),
                'update_time'      => time()
            ];
            $model = new CommunityLevel();
            $res   = $model->addCommunityLevel($data);
            return $res;
        } else {

            return $this->fetch('community/add_level');
        }

    }

    /**
     * 编辑团长等级
     */
    public function editLevel()
    {
        $model = new CommunityLevel();
        if (request()->isAjax()) {
            return $model->editCommunityLevel([
                'level_name'       => input('level_name', ''),
                'commission_money' => input('commission_money', 0.00),
                'commission_rate'  => input('commission_rate', 0.00),
                'sort'             => input('sort', 0),
                'update_time'      => time()
            ], [
                ['level_id', '=', input('level_id', 0)],
                ['site_id', '=', $this->site_id],
            ]);
        } else {

            $level_id = input('level_id', 0);
            $model    = new CommunityLevel();
            $info     = $model->getCommunityLevelInfo(['level_id' => $level_id]);
            $this->assign('info', $info['data']);
            return $this->fetch('community/edit_level');
        }

    }

    /**
     * 删除团长等级
     */
    public function deleteLevel()
    {
        $model    = new CommunityLevel();
        $level_id = input('level_id', 0);
        $res      = $model->deleteCommunityLevel(['level_id' => $level_id, 'site_id' => $this->site_id]);
        return $res;
    }

    /**
     * 团长设置
     */
    public function config()
    {
        $config_model = new CommunityConfig();
        if (request()->isAjax()) {
            $config_model->setConfig([
                // 团长佣金类型 1: 比例, 2: 金额 (暂时按照比例分佣, 后续扩展)
                'commission_type'    => 1,
                // 社区距离限制
                'community_distance' => input('community_distance', 0),
                'community_mongey' => input('community_mongey', 0),
                'community_charge' => input('community_charge', 0),
                // 允许团长申请
                'is_allow_apply'     => input('is_allow_apply', 0)
            ], $this->site_id);
            
            $res= [
                'withdraw' => input('community_mongey', 0),//最低提现额度
                'withdraw_rate' => input('community_charge', 0),//佣金提现手续费
                'min_no_fee' => 0,//最低免手续费区间
                'max_no_fee' => 0,//最高免手续费区间
                'withdraw_status' => 1,//提现审核
                'withdraw_type' => 0,//提现方式
            ];
            
           $res = $config_model ->setFenxiaoWithdrawConfig($res);
        return $res;
        } else {
            $info = $config_model->getConfig($this->site_id)['data'];
            $this->assign([
                'info' => $info
            ]);
            return $this->fetch('community/leader/config');
        }
    }

    /**
     * 入驻协议
     */
    public function agreementConfig()
    {
        $config_model = new CommunityConfig();
        if (request()->isAjax()) {
            return $config_model->setSettledAgreement([
                // 协议标题
                'title'   => input('title', ''),
                // 协议内容
                'content' => input('content', '')
            ], $this->site_id);
        } else {
            $info = $config_model->getSettledAgreement($this->site_id)['data'];
            $this->assign([
                'info' => $info
            ]);
            return $this->fetch('community/leader/agreement');
        }
    }

    /**
     * 导出团长信息
     */
    public function exportLeader()
    {

        $search_text_type = input('search_text_type', 'community');//可以传username mobile email

        $search_text = input('search_text', '');
        $level_id    = input('level_id', 0);
        $status      = input('status', 0);
        $condition   = [];
        if (!empty($search_text)) {
            $condition[] = ['c.' . $search_text_type, 'like', "%" . $search_text . "%"];
        }
        if (!empty($level_id)) {
            $condition[] = ['c.level_id', '=', $level_id];
        }
        if (!empty($status)) {
            $condition[] = ['c.status', '=', $status];
        }

        $order = 'apply_time desc';
        $field = 'c.*,m.username, m.username, m.nickname, m.headimg, cl.level_name';
        $alias = 'c';
        $join  = [
            [
                'community_level cl',
                'cl.level_id = c.level_id',
                'left'
            ],
            [
                'member m',
                'm.member_id = c.member_id',
                'left'
            ]
        ];

        $leader_model = new Leader();
        $list         = $leader_model->getLeaderPageList($condition, 1, 0, $order, $field, $alias, $join);

        // 实例化excel
        $phpExcel = new \PHPExcel();

        $phpExcel->getProperties()->setTitle("团长信息");
        $phpExcel->getProperties()->setSubject("团长信息");
        // 对单元格设置居中效果
        $phpExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setCellValue('A1', '会员账号');//可以指定位置
        $phpExcel->getActiveSheet()->setCellValue('B1', '会员昵称');
        $phpExcel->getActiveSheet()->setCellValue('C1', '团长名称');
        $phpExcel->getActiveSheet()->setCellValue('D1', '团长等级');
        $phpExcel->getActiveSheet()->setCellValue('E1', '手机号');
        $phpExcel->getActiveSheet()->setCellValue('F1', '社区名称');
        $phpExcel->getActiveSheet()->setCellValue('G1', '佣金');
        $phpExcel->getActiveSheet()->setCellValue('H1', '提货地址');
        $phpExcel->getActiveSheet()->setCellValue('I1', '申请时间');
        $phpExcel->getActiveSheet()->setCellValue('J1', '审核时间');
        $phpExcel->getActiveSheet()->setCellValue('K1', '是否休息');
        $phpExcel->getActiveSheet()->setCellValue('L1', '状态');
        $phpExcel->getActiveSheet()->setCellValue('M1', '微信');

        //循环添加数据（根据自己的逻辑）
        foreach ($list['data']['list'] as $k => $v) {

            $i = $k + 2;
            $phpExcel->getActiveSheet()->setCellValue('A' . $i, $v['username']);
            $phpExcel->getActiveSheet()->setCellValue('B' . $i, $v['nickname']);
            $phpExcel->getActiveSheet()->setCellValue('C' . $i, $v['name']);
            $phpExcel->getActiveSheet()->setCellValue('D' . $i, $v['level_name']);
            $phpExcel->getActiveSheet()->setCellValue('E' . $i, $v['mobile']);
            $phpExcel->getActiveSheet()->setCellValue('F' . $i, $v['community']);
            $phpExcel->getActiveSheet()->setCellValue('G' . $i, $v['commission_total']);
            $phpExcel->getActiveSheet()->setCellValue('H' . $i, $v['full_address']);
            $phpExcel->getActiveSheet()->setCellValue('I' . $i, date('Y-m-d', $v['apply_time']));
            $phpExcel->getActiveSheet()->setCellValue('J' . $i, date('Y-m-d', $v['audit_time']));
            $phpExcel->getActiveSheet()->setCellValue('K' . $i, ($v['rest_status'] == 1 ? '是' : '否'));
            if ($v['status'] == 0) {
                $phpExcel->getActiveSheet()->setCellValue('L' . $i, '待审核');
            } else if ($v['status'] == 1) {
                $phpExcel->getActiveSheet()->setCellValue('L' . $i, '已通过');
            } else if ($v['status'] == 2) {
                $phpExcel->getActiveSheet()->setCellValue('L' . $i, '已拒绝');
            } else if ($v['status'] == 3) {
                $phpExcel->getActiveSheet()->setCellValue('L' . $i, '已冻结');
            }
            $phpExcel->getActiveSheet()->setCellValue('M' . $i, $v['wechat']);
        }

        // 重命名工作sheet
        $phpExcel->getActiveSheet()->setTitle('团长信息');
        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);
        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $file      = date('Y年m月d日-团长信息表', time()) . '.xlsx';
        $objWriter->save($file);

        header("Content-type:application/octet-stream");

        $filename = basename($file);
        header("Content-Disposition:attachment;filename = " . $filename);
        header("Accept-ranges:bytes");
        header("Accept-length:" . filesize($file));
        readfile($file);
        unlink($file);
        exit;
    }

    /**
     * 团长账单
     */
    public function accountList()
    {

        if (request()->isAjax()) {
            $page      = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $cl_id = input('cl_id', 0);

            $condition[] = ['cl_id', '=', $cl_id];

            $community_account = new CommunityAccount();
            $list              = $community_account->getCommunityAccountPageList($condition, $page, $page_size);
            return $list;
        }

        //团长详情四级菜单
        $cl_id = input('cl_id', 0);
        $this->forthMenu(['cl_id' => $cl_id]);
        return $this->fetch('community/account_list');
    }

    /**
     * 订单管理
     */
    public function order()
    {
        $cl_id = input("cl_id", 0);//团长id
        $this->assign('cl_id', $cl_id);
        //会员详情四级菜单
        $this->forthMenu(['cl_id' => $cl_id]);
        return $this->fetch('community/order');

    }

    /**
     * 订单管理
     */
    public function index()
    {
        return $this->fetch('community/index');

    }
    
        /**
     * 分销等级列表
     */
    public function withdrawlist()
    {
        $model = new Withdraw();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $condition = [];

            $withdraw_no = input('withdraw_no');//提现流水
            if (!empty($withdraw_no)) {
                $condition[] = [ 'withdraw_no', 'like', '%' . $withdraw_no . '%' ];
            }
            $fenxiao_name = input('name', '');//分销商店铺名
            if (!empty($fenxiao_name)) {
                $condition[] = [ 'name', 'like', '%' . $fenxiao_name . '%' ];
            }
            $level_id = input('level_id');//分销商等级id
            if (!empty($level_id)) {
                $condition[] = [ 'level_id', '=', $level_id ];
            }
            $withdraw_type = input('withdraw_type');//提现类型
            if (!empty($withdraw_type)) {
                $condition[] = [ 'withdraw_type', '=', $withdraw_type ];
            }
            $status = input('status');//提现类型
            if (!empty($status)) {
                $condition[] = [ 'status', '=', $status ];
            }

            $start_time = input('start_time', '');
            $end_time = input('end_time', '');
            if ($start_time && $end_time) {
                $condition[] = [ 'create_time', 'between', [ strtotime($start_time), strtotime($end_time) ] ];
            } elseif (!$start_time && $end_time) {
                $condition[] = [ 'create_time', '<=', strtotime($end_time) ];
            } elseif ($start_time && !$end_time) {
                $condition[] = [ 'create_time', '>=', strtotime($start_time) ];
            }

            $order = 'id desc';
            $list = $model->getFenxiaoWithdrawPageList($condition, $page, $page_size, $order);
            return $list;

        } else {

            //团长等级
            $level_model = new CommunityLevel();
            $level = $level_model->getCommunityLevelList([ ], 'level_id,level_name');
            $this->assign('level', $level[ 'data' ]);

            return $this->fetch('community/withdraw/lists');
        }

    }

    /**
     * 审核通过
     */
    public function withdrawPass()
    {
        $ids = input('id');

        $model = new Withdraw();

        return $model->withdrawPass($ids);
    }

    /**
     * 审核拒绝
     */
    public function withdrawRefuse()
    {
        $id = input('id');
        $verify_state_remark = input('verify_state_remark','');
       
        $model = new Withdraw();

        return $model->withdrawRefuse($id,$verify_state_remark);
    }


}