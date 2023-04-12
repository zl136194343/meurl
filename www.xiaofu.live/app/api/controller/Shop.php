<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\api\controller;

use app\model\shop\Poster;
use app\model\shop\Shop as ShopModel;
use app\model\web\WebSite;
use app\model\member\Member;
use app\model\shop\Message;
class Shop extends BaseApi
{

    /**
     * 基础信息
     */
    public function info()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $site_id = isset($this->params[ 'site_id' ]) ? $this->params[ 'site_id' ] : 0;
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $shop = new ShopModel();
        $field = 'site_id,expire_time,site_name,website_id,is_own,level_name,category_name,shop_status,start_time,logo,avatar,banner,
		seo_description,qq,ww,telephone,shop_desccredit,shop_servicecredit,shop_deliverycredit,workingtime,shop_baozh,shop_baozhopen,shop_baozhrmb,
		shop_qtian,shop_zhping,shop_erxiaoshi,shop_tuihuo,shop_shiyong,shop_shiti,shop_xiaoxie,shop_free_time,shop_sales,shop_adv,work_week,address,full_address,longitude,latitude,sub_num,mobile,group_name,is_rzqds,appraise_name,likes,wxchat';
        $info = $shop->getShopInfo([ [ 'site_id', '=', $site_id ] ], $field);
        $statis = model('shop_collect')->getInfo([['site_id','=',$site_id],['member_id','=',$this->member_id],['status','=',1],['type','=',0]]);

        if (empty($statis)){
            $info['data']['is_collect'] = 0;
        }else{
            $info['data']['is_collect'] = 1;
        }

        $bangding = model('shop_collect')->getInfo([['site_id','=',$site_id],['member_id','=',$this->member_id],['status','=',1],['type','=',1]]);
        if (empty($bangding)){
            $info['data']['bangding'] = 0;
        }else{
            $info['data']['bangding'] = 1;
        }
        $info['data']['getCount'] = model('shop_collect')->getCount([['site_id','=',$site_id],['status','=',1]]);
        $info['data']['shop_member_count'] = model('shop_member')->getCount([['site_id','=',$site_id],['is_subscribe','=',1]]);
        $shop_member = model('shop_member')->getInfo([['site_id','=',$site_id],['member_id','=',$this->member_id],['is_subscribe','=',1]]);
        if (empty($shop_member)){
            $info['data']['is_shop_member'] = 0;
        }else{
            $info['data']['is_shop_member'] = 1;
        }

        $info['data']['loglist'] = model('shop_member_log')->getList([['site_id','=',$site_id]],"*",'create_time desc','','','',5);
        $infos = model('member')->getInfo([['member_id','=',$this->member_id]],'member_id,nickname,headimg');
        $ress = model('shop_member_log')->getInfo([['member_id','=',$this->member_id],['site_id','=',$site_id]]);

        if (empty($ress)){
            model('shop_member_log')->add(['site_id'=>$site_id,'member_id'=>$this->member_id,'member_name'=>$infos['nickname'],'member_img'=>$infos['headimg'],'create_time'=>time()]);
        }else{
            model('shop_member_log')->update(['create_time'=>time()],[['id','=',$ress['id']]]);
        }

        model('shop')->setInc([['site_id','=',$site_id]],'likes',1);
        return $this->response($info);
    }

    public function setCollect(){
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $type = isset($this->params[ 'type' ]) ? $this->params[ 'type' ] : 0;
        $site_id = isset($this->params[ 'site_id' ]) ? $this->params[ 'site_id' ] : 0;
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $statis = model('shop_collect')->getInfo([['site_id','=',$site_id],['member_id','=',$this->member_id??2407],['type','=',$type]]);

        if (empty($statis)){
            $re = model('shop_collect')->add(['site_id'=>$site_id,'member_id'=>$this->member_id??2407,'status'=>1,'type'=>$type]);
        }else{

            if ($statis['status'] == 1){
                $re = model('shop_collect')->setFieldValue([['site_id','=',$site_id],['member_id','=',$this->member_id??2407],['type','=',$type]],'status',0);

            }else{
                $re =    model('shop_collect')->update(['status'=>1],[['site_id','=',$site_id],['member_id','=',$this->member_id??2407],['type','=',$type]]);
            }
        }
        return $this->response($this->success($re));
    }

    public function page()
    {
        $page = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        $keyword = isset($this->params[ 'keyword' ]) ? $this->params[ 'keyword' ] : '';//关键词
        $order = isset($this->params[ 'order' ]) ? $this->params[ 'order' ] : "site_id";//排序（综合、销量、信用 // shop_sales）
        $sort = isset($this->params[ 'sort' ]) ? $this->params[ 'sort' ] : "desc";//升序、降序
        $web_city = isset($this->params[ 'web_city' ]) ? $this->params[ 'web_city' ] : "";
        $lat = isset($this->params[ 'lat' ]) ? $this->params[ 'lat' ] : ""; // 纬度
        $lng = isset($this->params[ 'lng' ]) ? $this->params[ 'lng' ] : ""; // 经度
        $category_id = isset($this->params[ 'category_id' ]) ? $this->params[ 'category_id' ] : ""; // 分类id

        $shop = new ShopModel();
        $condition = [
            [ 'shop_status', '=', 1 ],
            [ 'cert_id', '<>', 0 ],
            ['conceal','=',0]
        ];

        if (!empty($keyword)) {
            $condition[] = [ 'site_name', 'like', '%' . $keyword . '%' ];
        }
        if (!empty($category_id)){
            $condition[] = [ 'category_id', '=', $category_id ];
        }
       

        // 非法参数进行过滤
        if ($sort != "desc" && $sort != "asc") {
            $sort = "";
        }
        

        // 非法参数进行过滤
        if ($order != '') {
            if ($order != "shop_sales" && $order != "shop_desccredit") {
                $order = 'site_id';
            }
            $order_by = $order . ' ' . $sort;
        } else {
            $order_by = 'is_recommend desc,sort desc,site_id desc';
        }

        // 查询是否存在城市分站
        if (addon_is_exit('city') && !empty($web_city)) {
            $website_model = new WebSite();
            $website_info = $website_model->getWebSite([ [ 'site_area_id', '=', $web_city ] ], 'site_id');
            if (!empty($website_info[ 'data' ])) {
                $order_by = "INSTR('{$website_info['data']['site_id']}', website_id) desc," . $order_by;
            }
        }
        $list = $shop->getShopPageList($condition, $page, $page_size, $order_by, 'site_id,site_name,category_name,category_id,group_name,logo,avatar,banner,seo_description,shop_desccredit,shop_servicecredit,shop_deliverycredit,shop_sales,sub_num,is_own,longitude,latitude,telephone,address,full_address');

        if (!empty($list[ 'data' ][ 'list' ])) {
            foreach ($list[ 'data' ][ 'list' ] as $k => $item) {
                if ($item[ 'longitude' ] && $item[ 'latitude' ] && $lng && $lat) {
                    $list[ 'data' ][ 'list' ][ $k ][ 'distance' ] = round(getDistance((float) $item[ 'longitude' ], (float) $item[ 'latitude' ], (float) $lng, (float) $lat));
                } else {
                    $list[ 'data' ][ 'list' ][ $k ][ 'distance' ] = 0;
                }
            }
        }

        return $this->response($list);
    }

    /**
     * 是否显示店铺相关功能，用于审核小程序
     */
    public function isShow()
    {
        $shop = new ShopModel();
        $res = $shop->getDevelopment();// 0 隐藏，1 显示
        return $this->response($this->success($res));
    }

    /**
     * 获取商品海报
     */
    public function poster()
    {
        if (!empty($qrcode_param)) return $this->response($this->error('', '缺少必须参数qrcode_param'));

        $qrcode_param = json_decode($this->params[ 'qrcode_param' ], true);
        $qrcode_param[ 'source_member' ] = $qrcode_param[ 'source_member' ] ?? 0;
        $poster = new Poster();
        $res = $poster->shop($this->params[ 'app_type' ], $this->params[ 'page' ], $qrcode_param);
        return $this->response($res);
    }
    /**
     *
     * 新晋企业
     */
    public function xjqy()
    {
        //获取最新入驻平台的20家企业


        $re = model('shop')->getList([],'*','site_id desc','','','',20);
        return $this->response($this->success($re));
    }
    /**
     *
     * 行业黄页
     */
    public function hyhy()
    {
        //获取最新入驻平台的20家企业
        $type = input('type');
        $page = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        if ($type == 1){
            $re = model('shop')->pageList([['category_id','in','1,2,3,4,5']],'*','',$page,$page_size);
        }else{
            $join = [['goods g','g.site_id = a.site_id']];
            $re = model('shop')->pageList([['a.category_id','in','1,2,3,4,5']],'*','',$page,$page_size);
        }

        return $this->response($this->success($re));
    }

    /**
     * @return void
     * 渠道商
     */
    public function channel()
    {
//        $token = $this->checkToken();
//        if ($token[ 'code' ] < 0) return $this->response($token);
        $order = $this->params[ 'order' ] ?? "create_time"; //排序（综合、销量、价格）
        $name = input('name','');
        $group_id = input('group_id','');
        $shopcategory_id = input('shopcategory_id','');
        $locality = input('locality','');//本地
        $latitude  = isset($this->params['latitude']) ? $this->params['latitude'] : null; // 纬度
        $longitude = isset($this->params['longitude']) ? $this->params['longitude'] : null; // 经度
        $condition = [];
        if ($order == 'evaluate'){
            $order = '(s.shop_desccredit+s.shop_servicecredit+s.shop_deliverycredit) desc';
        }else if($order == 'distance'){
            $order = 'distance desc';
        }
        if (empty($group_id) && empty($shopcategory_id)){
            $condition[] = ['s.group_id','in','1,2,3,4,5'];
        }else if (!empty($group_id) && empty($shopcategory_id)){
            $condition[] = ['s.group_id','=',$group_id];
        }else if (empty($group_id) && !empty($shopcategory_id)){
            $condition[] = ['s.category_id','=',$shopcategory_id];
        }else if (!empty($group_id) && !empty($shopcategory_id)){
            $condition[] = ['s.category_id','=',$shopcategory_id];
        }
        if (!empty($name)){
            $condition[] = ['s.site_name','like','%'.$name.'%'];
        }
        $condition[] = ['s.shop_status','=',1];

//            $condition[] = ['s.shop_status','=',1];

        if(!empty($locality)){
            $condition[] = ['s.city_name','=',$locality];
        }
//            if ($order == 'evaluate'){
//                $order = '(s.shop_desccredit+s.shop_servicecredit+s.shop_deliverycredit) desc';
//            }
        $field = 's.*,'.$this->get_distance_sql($latitude,$longitude);

        $data =  model('shop')->rawPageList($condition,$field,$order,$page,$page_size,'s','','','',1);
    }

    public function message()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $site_id = input('site_id',0);
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $content = input('content',0);
        $Member = new Member();
        $info = $Member->getMemberInfo([['member_id','=',$this->member_id]],'member_id,headimg,nickname');

        $Message = new Message();
        $data = [
            'member_id'=>$this->member_id,
            'member_name'=>$info['data']['nickname'],
            'member_img'=>$info['data']['headimg'],
            'site_id' => $site_id,
            'content'=>$content,
            'create_time'=>time()
        ];
        $res = $Message ->addMessage($data);
        return $this->response($res);
    }
    public function getMessageList()
    {
        $page = isset($this->params[ 'page' ]) ? $this->params[ 'page' ] : 1;
        $page_size = isset($this->params[ 'page_size' ]) ? $this->params[ 'page_size' ] : PAGE_LIST_ROWS;
        $site_id = input('site_id',0);
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $Message = new Message();
        $res = $Message ->pageMessageList([['site_id','=',$site_id]],'*',$page,$page_size);
        return $this->response($res);
    }
}