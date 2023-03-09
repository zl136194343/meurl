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

namespace app\admin\controller;

use addon\fenxiao\model\Fenxiao;
use app\model\member\Config as ConfigModel;
use app\model\member\Member as MemberModel;
use app\model\member\MemberAccount as MemberAccountModel;
use app\model\member\MemberAddress as MemberAddressModel;
use app\model\member\MemberCluster as MemberClusterModel;
use app\model\member\MemberLabel as MemberLabelModel;
use app\model\member\MemberLevel as MemberLevelModel;
use phpoffice\phpexcel\Classes\PHPExcel;
use phpoffice\phpexcel\Classes\PHPExcel\Writer\Excel2007;
use think\facade\Config;
use think\facade\Db;

/**
 * 会员管理 控制器
 */
class Member extends BaseAdmin
{

    /**
     * 会员概况
     */
    public function index()
    {
        $member_model = new MemberModel();

        // 累计会员数
        $total_count = $member_model->getMemberCount([]);
        // 今日新增数
        $newadd_count = $member_model->getMemberCount([ [ 'reg_time', 'between', [ date_to_time(date('Y-m-d 00:00:00')), time() ] ] ]);
        // 付款会员数
        $buyed_count = $member_model->getMemberCount([ [ 'order_money', '>', 0 ] ]);

        $this->assign('data', [
            'total_count' => $total_count[ 'data' ],
            'newadd_count' => $newadd_count[ 'data' ],
            'buyed_count' => $buyed_count[ 'data' ]
        ]);

        return $this->fetch("member/index");
    }

    /**
     * 会员列表
     */
    public function memberList()
    {
        $member_cluster_model = new MemberClusterModel();
        //判断分销是否存在
        $is_exit_fenxiao = addon_is_exit('fenxiao');
        $cluster_id = input('cluster_id', '');//获取会员群体
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $search_text_type = input('search_text_type', 'username');//可以传username mobile email
            $level_id = input('level_id', 0);
            $label_id = input('label_id', 0);
            $reg_start_date = input('reg_start_date', '');
            $reg_end_date = input('reg_end_date', '');
            $status = input('status', '');
            $cluster_id = input('cluster_id', '');//获取会员群体
            $last_login_time_start = input('last_login_time_start', '');//上次登录时间
            $last_login_time_end = input('last_login_time_end', '');
            $start_order_complete_num = input('start_order_complete_num', '');//成交次数
            $end_order_complete_num = input('end_order_complete_num', '');
            $start_order_complete_money = input('start_order_complete_money', '');//消费金额
            $end_order_complete_money = input('end_order_complete_money', '');
            $start_point = input('start_point', '');//积分
            $end_point = input('end_point', '');
            $start_balance = input('start_balance', '');//余额
            $end_balance = input('end_balance', '');
            $start_growth = input('start_growth', '');//成长值
            $end_growth = input('end_growth', '');
            $login_type = input('login_type', '');//来源渠道

            $condition = [];
            //下拉选择
            $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
            //会员等级
            if ($level_id != 0) {
                $condition[] = [ 'member_level', '=', $level_id ];
            }
            //会员标签
            if ($label_id != 0) {
                //raw方法变为public类型 需要实例化以后调用
                $condition[] = [ "", 'exp', Db::raw("FIND_IN_SET({$label_id}, member_label)") ];
            }
            //注册时间
            if ($reg_start_date != '' && $reg_end_date != '') {
                $condition[] = [ 'reg_time', 'between', [ strtotime($reg_start_date), strtotime($reg_end_date) ] ];
            } else if ($reg_start_date != '' && $reg_end_date == '') {
                $condition[] = [ 'reg_time', '>=', strtotime($reg_start_date) ];
            } else if ($reg_start_date == '' && $reg_end_date != '') {
                $condition[] = [ 'reg_time', '<=', strtotime($reg_end_date) ];
            }
            //会员状态
            if ($status != '') {
                $condition[] = [ 'status', '=', $status ];
            }

            //会员群体
            if ($cluster_id != '') {
                //获取会员群体的member_id值
                $member_cluster_info = $member_cluster_model->getMemberClusterInfo([ "cluster_id" => $cluster_id ], 'member_ids');
                if (!empty($member_cluster_info[ 'data' ][ 'member_ids' ])) {
                    $condition[] = [ 'member_id', 'in', $member_cluster_info[ 'data' ][ 'member_ids' ] ];
                }
            }
            //上次访问时间
            if ($last_login_time_start != '' && $last_login_time_end != '') {
                $condition[] = [ 'last_login_time', 'between', [ strtotime($last_login_time_start), strtotime($last_login_time_end) ] ];
            } else if ($last_login_time_start != '' && $last_login_time_end == '') {
                $condition[] = [ 'last_login_time', '>=', strtotime($last_login_time_start) ];
            } else if ($last_login_time_start == '' && $last_login_time_end != '') {
                $condition[] = [ 'last_login_time', '<=', strtotime($last_login_time_end) ];
            }
            //成交次数
            if ($start_order_complete_num != '' && $end_order_complete_num != '') {
                $condition[] = [ 'order_complete_num', 'between', [ $start_order_complete_num, $end_order_complete_num ] ];
            } else if ($start_order_complete_num != '' && $end_order_complete_num == '') {
                $condition[] = [ 'order_complete_num', '>=', $start_order_complete_num ];
            } else if ($start_order_complete_num == '' && $end_order_complete_num != '') {
                $condition[] = [ 'order_complete_num', '<=', $end_order_complete_num ];
            }
            //消费金额
            if ($start_order_complete_money != '' && $end_order_complete_money != '') {
                $condition[] = [ 'order_complete_money', 'between', [ $start_order_complete_money, $end_order_complete_money ] ];
            } else if ($start_order_complete_money != '' && $end_order_complete_money == '') {
                $condition[] = [ 'order_complete_money', '>=', $start_order_complete_money ];
            } else if ($start_order_complete_money == '' && $end_order_complete_money != '') {
                $condition[] = [ 'order_complete_money', '<=', $end_order_complete_money ];
            }
            //积分
            if ($start_point != '' && $end_point != '') {
                $condition[] = [ 'point', 'between', [ $start_point, $end_point ] ];
            } else if ($start_point != '' && $end_point == '') {
                $condition[] = [ 'point', '>=', $start_point ];
            } else if ($start_point == '' && $end_point != '') {
                $condition[] = [ 'point', '<=', $end_point ];
            }
            //余额
            if ($start_balance != '' && $end_balance != '') {
                $condition[] = [ 'balance', 'between', [ $start_balance, $end_balance ] ];
            } else if ($start_balance != '' && $end_balance == '') {
                $condition[] = [ 'balance', '>=', $start_balance ];
            } else if ($start_balance == '' && $end_balance != '') {
                $condition[] = [ 'balance', '<=', $end_balance ];
            }
            //成长值
            if ($start_growth != '' && $end_growth != '') {
                $condition[] = [ 'growth', 'between', [ $start_growth, $end_growth ] ];
            } else if ($start_growth != '' && $end_growth == '') {
                $condition[] = [ 'growth', '>=', $start_growth ];
            } else if ($start_growth == '' && $end_growth != '') {
                $condition[] = [ 'growth', '<=', $end_growth ];
            }
            //来源渠道
            if ($login_type != '') {
                $condition[] = [ 'login_type', '=', $login_type ];
            }

            $order = 'reg_time desc';
            $field = 'member_id, fenxiao_id, is_fenxiao, username, mobile, email, status, headimg, member_level, member_level_name, member_label, member_label_name, qq, qq_openid, wx_openid, wx_unionid, ali_openid, baidu_openid, toutiao_openid, douyin_openid, login_ip, login_type, login_time, last_login_ip, last_login_type, last_login_time, login_num, nickname, realname, sex, location, birthday, reg_time, point, balance, balance_money, growth, account5';

            $member_model = new MemberModel();
            $result = $member_model->getMemberPageList($condition, $page, $page_size, $order, $field);

            if ($is_exit_fenxiao == 1) {
                $list = $result[ 'data' ][ 'list' ];
                if (!empty($list)) {

                    $fenxiao_model = new Fenxiao();
                    foreach ($list as $k => $v) {

                        if ($v[ 'is_fenxiao' ] == 1) {
                            $parent_fenxiao_name = $fenxiao_model->getParentFenxiaoName($v[ 'fenxiao_id' ], 2);
                        } else {
                            $parent_fenxiao_name = $fenxiao_model->getParentFenxiaoName($v[ 'fenxiao_id' ], 1);
                        }
                        $list[ $k ][ 'parent_fenxiao_name' ] = $parent_fenxiao_name;
                    }
                }

                $result[ 'data' ][ 'list' ] = $list;
            }
            return $result;
        } else {
            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //会员标签
            $member_label_model = new MemberLabelModel();
            $member_label_list = $member_label_model->getMemberLabelList([], 'label_id, label_name', 'sort asc');
            $this->assign('member_label_list', $member_label_list[ 'data' ]);

            /*奖励规则*/
            //积分
            $point = event('MemberAccountRule', [ 'account' => 'point' ]);
            $this->assign('point', $point);
            //余额
            $balance = event('MemberAccountRule', [ 'account' => 'balance' ]);
            $this->assign('balance', $balance);
            //成长值
            $growth = event('MemberAccountRule', [ 'account' => 'growth' ]);
            $this->assign('growth', $growth);

            //会员群体
            $member_cluster_list = $member_cluster_model->getMemberClusterList([], 'cluster_id, cluster_name', 'create_time desc');
            $this->assign('member_cluster_list', $member_cluster_list[ 'data' ]);
            $this->assign('cluster_id', $cluster_id);

            //订单来源 (支持端口)
            $order_from = Config::get("app_type");
            $this->assign('order_from_list', $order_from);

            $this->assign('is_exit_fenxiao', $is_exit_fenxiao);
            return $this->fetch('member/member_list');
        }
    }

    /**
     * 获取区域会员数量
     */
    public function areaCount()
    {
        if (request()->isAjax()) {
            $member = new MemberModel();
            $handle = input('handle', false);
            $res = $member->getMemberCountByArea($handle);
            return $res;
        }
    }

    /**
     * 会员添加
     */
    public function addMember()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('username', ''),
                'mobile' => input('mobile', ''),
                'email' => input('email', ''),
                'password' => data_md5(input('password', '')),
                'status' => input('status', 1),
                'headimg' => input('headimg', ''),
                'member_level' => input('member_level', ''),
                'member_level_name' => input('member_level_name', ''),
                'nickname' => input('nickname', ''),
                'sex' => input('sex', 0),
                'birthday' => input('birthday', '') ? strtotime(input('birthday', '')) : 0,
                'realname' => input('realname', ''),
                'reg_time' => time(),
            ];

            $member_model = new MemberModel();
            $this->addLog("添加会员" . $data[ 'username' ] . $data[ 'mobile' ]);
            return $member_model->addMember($data);
        } else {
            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            return $this->fetch('member/add_member');
        }
    }

    /**
     * 会员编辑
     */
    public function editMember()
    {
        $member_model = new MemberModel();
        if (request()->isAjax()) {
            $data = [
                'mobile' => input('mobile', ''),
                'email' => input('email', ''),
                'status' => input('status', 1),
                'headimg' => input('headimg', ''),
                'member_level' => input('member_level', ''),
                'member_level_name' => input('member_level_name', ''),
                'nickname' => input('nickname', ''),
                'sex' => input('sex', 0),
                'birthday' => input('birthday', '') ? strtotime(input('birthday', '')) : 0,
            ];
            
            if ($data['member_level'] > 1) {
                $data['start_time'] = time();
                $data['expiration_time'] = time() + (86400*365*10);
            }

            $member_id = input('member_id', 0);
            $this->addLog("编辑会员:id" . $member_id, $data);
            return $member_model->editMember($data, [ [ 'member_id', '=', $member_id ] ]);
        } else {

            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //会员信息
            $member_id = input('member_id', 0);
            $member_info = $member_model->getMemberInfo([ [ 'member_id', '=', $member_id ] ]);
            $this->assign('member_info', $member_info);

            //账户类型和来源类型
            $member_account_model = new MemberAccountModel();
            $account_type_arr = $member_account_model->getAccountType();
            $this->assign('account_type_arr', $account_type_arr);


            //会员详情四级菜单
            //$this->forthMenu([ 'member_id' => $member_id ]);

            return $this->fetch('member/edit_member');
        }
    }

    /**
     * 会员删除
     */
    public function deleteMember()
    {
        $member_ids = input('member_ids', '');
        $member_model = new MemberModel();
        $this->addLog("删除会员:id" . $member_ids);
        return $member_model->deleteMember([ [ 'member_id', 'in', $member_ids ] ]);
    }

    /**
     * 修改会员标签
     */
    public function modifyLabel()
    {
        $member_ids = input('member_ids', '');
        $label_ids = input('label_ids', '');
        $member_model = new MemberModel();
        return $member_model->modifyMemberLabel($label_ids, [ [ 'member_id', 'in', $member_ids ] ]);
    }

    /**
     * 修改会员状态
     */
    public function modifyStatus()
    {
        $member_ids = input('member_ids', '');
        $status = input('status', 0);
        $member_model = new MemberModel();
        return $member_model->modifyMemberStatus($status, [ [ 'member_id', 'in', $member_ids ] ]);
    }

    /**
     * 修改会员密码
     */
    public function modifyPassword()
    {
        $member_ids = input('member_ids', '');
        $password = input('password', '123456');
        $member_model = new MemberModel();
        return $member_model->resetMemberPassword($password, [ [ 'member_id', 'in', $member_ids ] ]);
    }

    /**
     * 账户详情
     */
    public function accountDetail()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $account_type = input('account_type', '');
            $from_type = input('from_type', '');
            $start_date = input('start_date', '');
            $end_date = input('end_date', '');
            $member_id = input('member_id', 0);

            $condition = [];
            $condition[] = [ 'member_id', '=', $member_id ];
            //账户类型
            if ($account_type != '') {
                $condition[] = [ 'account_type', '=', $account_type ];
            }
            //来源类型
            if ($from_type != '') {
                $condition[] = [ 'from_type', '=', $from_type ];
            }
            //发生时间
            if ($start_date != '' && $end_date != '') {
                $condition[] = [ 'create_time', 'between', [ strtotime($start_date), strtotime($end_date) ] ];
            } else if ($start_date != '' && $end_date == '') {
                $condition[] = [ 'create_time', '>=', strtotime($start_date) ];
            } else if ($start_date == '' && $end_date != '') {
                $condition[] = [ 'create_time', '<=', strtotime($end_date) ];
            }

            $member_account_model = new MemberAccountModel();
            $res = $member_account_model->getMemberAccountPageList($condition, $page, $page_size);
            $account_type_arr = $member_account_model->getAccountType();
            foreach ($res[ 'data' ][ 'list' ] as $key => $val) {
                $res[ 'data' ][ 'list' ][ $key ][ 'account_type_name' ] = $account_type_arr[ $val[ 'account_type' ] ];
            }
            return $res;

        } else {
            $member_id = input('member_id', 0);

            //会员信息
            $member_model = new MemberModel();
            $member_info = $member_model->getMemberDetail($member_id);
            $this->assign('member_info', $member_info[ 'data' ]);

            //账户类型和来源类型
            $member_account_model = new MemberAccountModel();
            $account_type_arr = $member_account_model->getAccountType();
//			$from_type_arr = $member_account_model->getFromType();
            $this->assign('account_type_arr', $account_type_arr);
//			$this->assign('from_type_arr', $from_type_arr['point']);

            //会员详情四级菜单
            $this->forthMenu([ 'member_id' => $member_id ]);

            return $this->fetch('member/account_detail');
        }
    }

    /**
     * 余额调整（不可提现）
     */
    public function adjustBalance()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员余额调整id:" . $member_id . "金额" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($member_id, 'balance', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 余额调整（可提现）
     */
    public function adjustBalanceMoney()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员余额调整id:" . $member_id . "金额" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($member_id, 'balance_money', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 积分调整
     */
    public function adjustPoint()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员积分调整id:" . $member_id . "数量" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($member_id, 'point', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 成长值调整
     */
    public function adjustGrowth()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员成长值调整id:" . $member_id . "数量" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($member_id, 'growth', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 注册协议
     */
    public function regAgreement()
    {
        if (request()->isAjax()) {
            //设置注册协议
            $title = input('title', '');
            $content = input('content', '');
            $config_model = new ConfigModel();
            return $config_model->setRegisterDocument($title, $content);
        } else {
            //获取注册协议
            $config_model = new ConfigModel();
            $document_info = $config_model->getRegisterDocument();
            $this->assign('document_info', $document_info);

            return $this->fetch('member/reg_agreement');
        }
    }

    /**
     * 注册设置
     */
    public function regConfig()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            //设置注册设置
            $data = array (

                'login' => input('login', ''),
                'register' => input('register', ''),
                'pwd_len' => input('pwd_len', 6),
                'pwd_complexity' => input('pwd_complexity', 'number,letter,upper_case,symbol'),
                'third_party' => input('third_party', 0),
                'bind_mobile' => input('bind_mobile', 0),
            );
            return $config_model->setRegisterConfig($data);
        } else {
            //获取注册设置
            $config_info = $config_model->getRegisterConfig();
            $value = $config_info[ 'data' ][ 'value' ];
            if (!empty($value)) {
                $value[ 'pwd_complexity_arr' ] = explode(',', $value[ 'pwd_complexity' ]);
                $value[ 'login' ] = explode(',', $value[ 'login' ]);
                $value[ 'register' ] = explode(',', $value[ 'register' ]);
            }

            $this->assign('value', $value);
            return $this->fetch('member/reg_config');
        }
    }

    /**
     * 搜索会员
     * 不是菜单 不入权限
     */
    public function searchMember()
    {
        $search_text = input('search_text', '');
        $member_model = new MemberModel();
        $member_info = $member_model->getMemberInfo([ [ 'username|mobile', '=', $search_text ] ]);
        return $member_info;
    }

    /**
     * 导出会员信息
     */
    public function exportMember()
    {
        //获取会员信息
        $search_text = input('search_text', '');
        $search_text_type = input('search_text_type', 'username');//可以传username mobile email
        $level_id = input('level_id', 0);
        $label_id = input('label_id', 0);
        $reg_start_date = input('reg_start_date', '');
        $reg_end_date = input('reg_end_date', '');
        $status = input('status', '');

        $condition = [];
        //下拉选择
        $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
        //会员等级
        if ($level_id != 0) {
            $condition[] = [ 'member_level', '=', $level_id ];
        }
        //会员标签
        if ($label_id != 0) {
            //raw方法变为public类型 需要实例化以后调用
            $condition[] = [ "", 'exp', Db::raw("FIND_IN_SET({$label_id}, member_label)") ];
        }
        //注册时间
        if ($reg_start_date != '' && $reg_end_date != '') {
            $condition[] = [ 'reg_time', 'between', [ strtotime($reg_start_date), strtotime($reg_end_date) ] ];
        } else if ($reg_start_date != '' && $reg_end_date == '') {
            $condition[] = [ 'reg_time', '>=', strtotime($reg_start_date) ];
        } else if ($reg_start_date == '' && $reg_end_date != '') {
            $condition[] = [ 'reg_time', '<=', strtotime($reg_end_date) ];
        }
        //会员状态
        if ($status != '') {
            $condition[] = [ 'status', '=', $status ];
        }

        $order = 'reg_time desc';
        $field = 'username,nickname,realname,mobile,sex,birthday,email,member_level_name,member_label_name,
        qq,location,balance,balance_money,point,growth,reg_time,last_login_ip,last_login_time';

        $member_model = new MemberModel();
        $list = $member_model->getMemberList($condition, $field, $order);

        // 实例化excel
        $phpExcel = new \PHPExcel();

        $phpExcel->getProperties()->setTitle("会员信息");
        $phpExcel->getProperties()->setSubject("会员信息");
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
        $phpExcel->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setCellValue('A1', '会员账号');//可以指定位置
        $phpExcel->getActiveSheet()->setCellValue('B1', '会员昵称');
        $phpExcel->getActiveSheet()->setCellValue('C1', '真实姓名');
        $phpExcel->getActiveSheet()->setCellValue('D1', '手机号');
        $phpExcel->getActiveSheet()->setCellValue('E1', '性别');
        $phpExcel->getActiveSheet()->setCellValue('F1', '生日');
        $phpExcel->getActiveSheet()->setCellValue('G1', '邮箱');
        $phpExcel->getActiveSheet()->setCellValue('H1', '会员等级');
        $phpExcel->getActiveSheet()->setCellValue('I1', '会员标签');
        $phpExcel->getActiveSheet()->setCellValue('J1', 'qq');
        $phpExcel->getActiveSheet()->setCellValue('K1', '地址');
        $phpExcel->getActiveSheet()->setCellValue('L1', '余额');
        $phpExcel->getActiveSheet()->setCellValue('M1', '积分');
        $phpExcel->getActiveSheet()->setCellValue('N1', '成长值');
        $phpExcel->getActiveSheet()->setCellValue('O1', '上次登录时间');
        $phpExcel->getActiveSheet()->setCellValue('P1', '上次登录ip');
        $phpExcel->getActiveSheet()->setCellValue('Q1', '注册时间');
        //循环添加数据（根据自己的逻辑）
        $sex = [ '保密', '男', '女' ];
        foreach ($list[ 'data' ] as $k => $v) {
            $i = $k + 2;
            $phpExcel->getActiveSheet()->setCellValue('A' . $i, $v[ 'username' ]);
            $phpExcel->getActiveSheet()->setCellValue('B' . $i, $v[ 'nickname' ]. "\t");
            $phpExcel->getActiveSheet()->setCellValue('C' . $i, $v[ 'realname' ]);
            $phpExcel->getActiveSheet()->setCellValue('D' . $i, $v[ 'mobile' ] . "\t");
            $phpExcel->getActiveSheet()->setCellValue('E' . $i, $sex[ $v[ 'sex' ] ]);
            if(!empty($v[ 'birthday' ])){
                $phpExcel->getActiveSheet()->setCellValue('F' . $i, date('Y-m-d', $v[ 'birthday' ]));
            }else{
                $phpExcel->getActiveSheet()->setCellValue('F' . $i);
            }
            $phpExcel->getActiveSheet()->setCellValue('G' . $i, $v[ 'email' ]);
            $phpExcel->getActiveSheet()->setCellValue('H' . $i, $v[ 'member_level_name' ]);
            $phpExcel->getActiveSheet()->setCellValue('I' . $i, $v[ 'member_label_name' ]);
            $phpExcel->getActiveSheet()->setCellValue('J' . $i, $v[ 'qq' ]);
            $phpExcel->getActiveSheet()->setCellValue('K' . $i, $v[ 'location' ]);
            $phpExcel->getActiveSheet()->setCellValue('L' . $i, $v[ 'balance' ] + $v[ 'balance_money' ]);
            $phpExcel->getActiveSheet()->setCellValue('M' . $i, $v[ 'point' ]);
            $phpExcel->getActiveSheet()->setCellValue('N' . $i, $v[ 'growth' ]);
            $phpExcel->getActiveSheet()->setCellValue('O' . $i, date('Y-m-d H:i:s', $v[ 'last_login_time' ]));
            $phpExcel->getActiveSheet()->setCellValue('P' . $i, $v[ 'last_login_ip' ]);
            $phpExcel->getActiveSheet()->setCellValue('Q' . $i, date('Y-m-d H:i:s', $v[ 'reg_time' ]));
        }

//        // 重命名工作sheet
//        $phpExcel->getActiveSheet()->setTitle('会员信息');
//        // 对文件进行保存
//        $filename = date('Y年m月d日-会员信息表',time()).'.xlsx';
//        header('Content-Type: application/vnd.ms-excel');
//        header("Content-Disposition: attachment;filename=\"$filename\"");
//        header('Cache-Control: max-age=0');
//        // 通过工厂类实例化excel5,本来我想使用 excel2007,但是本地测试没有问题,到线上就出错,报错链接找不到
//        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
//        $objWriter->save('php://output'); //文件通过浏览器下载

        // 重命名工作sheet
        $phpExcel->getActiveSheet()->setTitle('会员信息');
        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);
        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $file = date('Y年m月d日-会员信息表', time()) . '.xlsx';
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
     * 订单管理
     */
    public function order()
    {
        $member_id = input("member_id", 0);//会员id
        $this->assign('member_id', $member_id);
        //会员详情四级菜单
        $this->forthMenu([ 'member_id' => $member_id ]);
        return $this->fetch('member/order');

    }

    /**
     * 会员地址
     */
    public function addressDetail()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $member_id = input('member_id', 0);

            $condition = [];
            $condition[] = [ 'member_id', '=', $member_id ];

            //会员地址
            $member_address_model = new MemberAddressModel();
            $res = $member_address_model->getMemberAddressPageList($condition, $page, $page_size);
            return $res;

        } else {
            $member_id = input('member_id', 0);
            $this->assign('member_id', $member_id);

            //会员详情四级菜单
            $this->forthMenu([ 'member_id' => $member_id ]);

            return $this->fetch('member/address_detail');
        }
    }

    /**
     * 根据账户类型获取来源类型
     * @return array
     */
    public function getFromType()
    {
        $type = input('type', '');
        $model = new MemberAccountModel();
        $res = $model->getFromType();

        return $res[ $type ];
    }


    /**
     * 黑名单
     * @return mixed
     */
    public function blacklist()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $search_text_type = input('search_text_type', 'username');//可以传username mobile email

            $condition[] = [ 'status', '=', 0 ];
            //下拉选择
            $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
            $order = 'reg_time desc';
            $field = '*';

            $member_model = new MemberModel();
            $result = $member_model->getMemberPageList($condition, $page, $page_size, $order, $field);
            return $result;
        }
        return $this->fetch('member/blacklist');
    }
    
    
    public function feedback()
    {
        //
        if (request()->isAjax()) {
        $page = input('page', 1);
        $page_size = input('page_size', PAGE_LIST_ROWS);
        $list  = model('feedback')->pageList([],'','id desc',$page, $page_size);
        //$page = $list['list']->render();
       
        return success('','',$list);
        }else{
            
            return  $this->fetch('member/feedback');
        }
         
        
    }
    public function editfeedback()
    {
        //
       
        $page = input('id');
        if (empty($page)) {
            return error('','缺少必要参数');
        }
        $list  = model('feedback')->getInfo([['id','=',$page]]);
        
        //$page = $list['list']->render();
       $list['img_str'] = explode(',',$list['img_str']);
      
       $this->assign('list', $list);
       return  $this->fetch('member/editfeedback');
        
    }
    
    public function deletefeedbock()
    {
        $page = input('level_ids', '');
        
        if (empty($page)) {
            return error('','缺少必要参数');
        }
        model('feedback')->delete([['id','=',$page] ]);
        return success('','删除成功');
    }
}