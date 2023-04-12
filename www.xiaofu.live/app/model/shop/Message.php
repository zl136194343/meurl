<?php

namespace app\model\shop;
use app\model\BaseModel;
class Message extends BaseModel
{
    public function getMessageInfo($condition, $field)
    {
        $res = model('shop')->getInfo($condition, $field);
        return $this->success($res);
    }
    public function pageMessageList($condition, $field,$page,$page_size)
    {
        $res = model('shop_message')->pageList($condition, $field,'id desc',$page,$page_size);
        return $this->success($res);
    }
    public function addMessage($data)
    {
        $res = model('shop_message')->add($data);
        return $this->success($res);
    }
}