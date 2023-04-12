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

use app\model\dtgl\Card as CardModel;

use app\model\member\MemberLabel as MemberLabelModel;
use phpoffice\phpexcel\Classes\PHPExcel;
use phpoffice\phpexcel\Classes\PHPExcel\Writer\Excel2007;
use think\facade\Config;
use think\facade\Db;

/**
 * 名片 控制器
 */
class Card extends BaseAdmin
{
    /**
     * 会员列表
     */
    public function lists()
    {

        //判断分销是否存在

        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $card = new CardModel();
            $list = $card->getMemberPageList([],$page,$page_size);
            return $list;
        } else {

            return $this->fetch('dtgl/card/lists');
        }
    }

    /**
     * 后台名片设置
     */
    public function modifyStatus()
    {
        if (request()->isAjax()) {
            $id = input('id', 0);
            $status = input('status', 0);
            $card = new CardModel();
            $condition = [['id','=',$id]];
            $list = $card->modifyCardStatus($status,$condition);
            return $list;
        }
    }
    /**
     * 印象标签列表
     */
    public function biaoqian()
    {
        if(request()->isAjax()){
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');

            $condition = [];
            $condition[] = ['label_name', 'like', "%". $search_text ."%"];
            $order = 'sort asc,create_time desc';
            $field = '*';

            $member_label_model = new MemberLabelModel();
            $list = $member_label_model->getMemberLabelPageList($condition, $page, $page_size, $order, $field);
            return $list;
        }else{
            return $this->fetch('dtgl/memberlabel/label_list');
        }
    }

    /**
     * 印象标签添加
     */
    public function addLabel()
    {
        if(request()->isAjax()){
            $data = [
                'label_name' => input('label_name', ''),
                'remark' => input('remark', ''),
                'sort' => input('sort', 0),
                'create_time' => time(),
            ];

            $member_label_model = new MemberLabelModel();
            return $member_label_model->addMemberLabel($data);
        }else{
            return $this->fetch('dtgl/memberlabel/add_label');
        }
    }

    /**
     * 印象标签修改
     */
    public function editLabel()
    {
        if(request()->isAjax()){
            $data = [
                'label_name' => input('label_name', ''),
                'remark' => input('remark', ''),
                'sort' => input('sort', 0),
                'modify_time' => time(),
            ];
            $label_id = input('label_id', 0);

            $member_label_model = new MemberLabelModel();
            return $member_label_model->editMemberLabel($data, [['label_id', '=', $label_id]]);
        }else{

            $label_id = input('label_id', 0);
            $member_label_model = new MemberLabelModel();
            $label_info = $member_label_model->getMemberLabelInfo([['label_id', '=', $label_id]]);
            $this->assign('label_info', $label_info);

            return $this->fetch('dtgl/memberlabel/edit_label');
        }
    }

    /**
     * 印象标签删除
     */
    public function deleteLabel()
    {
        $label_ids = input('label_ids', '');
        $member_label_model = new MemberLabelModel();
        return $member_label_model->deleteMemberLabel([['label_id', 'in', $label_ids]]);
    }

    /**
     * 印象标签排序
     */
    public function modifySort()
    {
        $sort = input('sort', 0);
        $label_id = input('label_id', 0);
        $member_label_model = new MemberLabelModel();
        return $member_label_model->modifyMemberLabelSort($sort, $label_id);
    }
    /**
     * 标题列表
     */
    public function titleList()
    {
        if(request()->isAjax()){
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');

            $condition = [];
            $condition[] = ['title', 'like', "%". $search_text ."%"];
            $order = 'sort asc,create_time desc';
            $field = '*';

            $list = model('card_title')->pageList($condition,$field,$order,$page,$page_size);
            return success(0,'',$list);
        }else{
            return $this->fetch('dtgl/title/label_list');
        }
    }


    /**
     * 印象标签添加
     */
    public function addTitle()
    {
        if(request()->isAjax()){
            $data = [
                'title' => input('label_name', ''),
                'remark' => input('remark', ''),
                'sort' => input('sort', 0),
                'create_time' => time(),
            ];

            model('card_title')->add($data);
            return success(0,'成功');
        }else{
            return $this->fetch('dtgl/title/add_label');
        }
    }

    /**
     * 印象标签修改
     */
    public function editTitle()
    {
        if(request()->isAjax()){
            $data = [
                'label_name' => input('label_name', ''),
                'remark' => input('remark', ''),
                'sort' => input('sort', 0),
                'modify_time' => time(),
            ];
            $label_id = input('label_id', 0);
            model('card_title')->update($data,[['id','=',$label_id]]);
            $member_label_model = new MemberLabelModel();
            return success(0,'成功');
        }else{

            $label_id = input('label_id', 0);
            $data = model('card_title')->getInfo([['id','=',$label_id]]);

            $label_info['data'] = $data;
            $this->assign('label_info', $label_info);

            return $this->fetch('dtgl/title/edit_label');
        }
    }

    /**
     * 印象标签删除
     */
    public function deleteTitle()
    {
        $label_ids = input('label_ids', '');
        model('card_title')->delete([['id', 'in', $label_ids]]);
        return success(0,'删除成功');
    }

    /**
     * 印象标签排序
     */
    public function modifySortTitle()
    {
        $sort = input('sort', 0);
        $label_id = input('label_id', 0);
        model('card_title')->setFieldValue([['id','=',$label_id]],'sort',$sort);

        return success(0,'修改成功');
    }

}