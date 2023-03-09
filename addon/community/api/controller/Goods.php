<?php

namespace addon\community\api\controller;

use app\model\community\CommunityGoods as GoodsModel;
use app\model\system\Poster;
use app\model\goods\Config as GoodsConfigModel;
use app\model\web\Config as ConfigModel;
use app\model\member\Member as MemberModel;
use addon\community\model\goods\GoodsService ;
class Goods extends BaseApi
{

    /**
     * 修改商品点击量
     * @return string
     */
    public function modifyclicks()
    {
        $sku_id = isset($this->params[ 'sku_id' ]) ? $this->params[ 'sku_id' ] : 0;

        if (empty($sku_id)) {
            return $this->response($this->error('', 'REQUEST_SKU_ID'));
        }

        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $goods_model = new GoodsModel();
        $res = $goods_model->modifyClick($sku_id, $this->site_id);
        return $this->response($res);
    }

    /**
     * 获取商品海报
     */
    public function poster()
    {
        if (!empty($qrcode_param)) return $this->response($this->error('', '缺少必须参数qrcode_param'));

        $promotion_type = 'null';
        $qrcode_param = json_decode($this->params[ 'qrcode_param' ], true);
        $qrcode_param[ 'source_member' ] = $qrcode_param[ 'source_member' ] ?? 0;
        $poster = new Poster();
        $res = $poster->goods($this->params[ 'app_type' ], $this->params[ 'page' ], $qrcode_param, $promotion_type, $this->site_id);
        return $this->response($res);
    }

    /**
     * 售后保障
     * @return false|string
     */
    public function aftersale()
    {
        $goods_config_model = new GoodsConfigModel();
        $res = $goods_config_model->getAfterSaleConfig($this->site_id);
        return $this->response($res);
    }

    /**
     * 获取热门搜索关键词
     */
    public function hotSearchWords()
    {
        $config_model = new ConfigModel();
        $info = $config_model->getHotSearchWords($this->site_id, $this->app_module);
        return $this->response($this->success($info[ 'data' ][ 'value' ]));
    }

    /**
     * 获取默认搜索关键词
     */
    public function defaultSearchWords()
    {
        $config_model = new ConfigModel();
        $info = $config_model->getDefaultSearchWords($this->site_id, $this->app_module);
        return $this->response($this->success($info[ 'data' ][ 'value' ]));
    }
    
    /**
     * 团长获取商品
     */
     public function goodsLanderList()
    {
        
       /* $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);*/
        //获取当前用户绑定的商户
        
        $page = input('page', 1);
        $page_size = input('page_size', '');
        $categroup_id = input('categroup_id',"");
        $cl_id = input('cl_id',"");
        
        //用团长id去查询对应的数据
        $condition =[ 
            ['g.goods_state','=',1],
            
        ];
        if(empty($cl_id) || $cl_id == 'undefined'){
            return $this->response($this->error("", "团长id不能为空"));
        }
        if (!empty($categroup_id)) {
          $condition[] = ['g.category_id', 'like', '%,' . $categroup_id . ',%' ];
        }
        
        $field = 'g.*,gs.sale_num as goods_num';
        $alias = 'g';
        $join = [
                [ 'community_goods_sku gs', 'gs.goods_id = g.goods_id', 'inner' ],
             ];
        $data = model('community_goods')->pageList($condition, $field, '', $page, $page_size, $alias, $join);
        
        //查出当前团长的分佣比例
        $file = 'lv.commission_rate';
        $alias = 'l';
        $join = [
                [ 'community_level lv', 'lv.level_id = l.level_id', 'inner' ],
             ];
         $re = model('community_leader')->getInfo([['l.cl_id','=',$cl_id]],$file,$alias, $join);
         //查询团长已经添加的数据
         $list = model('community_add')->getList([['leader_id','=',$cl_id],['categroup_id','=',$categroup_id]],'goods_id');
            
         foreach ($data['list'] as $k=>&$v){
             foreach ($list as $l) {
                if ($v['goods_id'] == $l['goods_id']) {
                    unset($data['list'][$k]);
                    continue;
                }
             }
             $v['commission_money'] = $v['price'] * $re['commission_rate'] /100;
         }

      
        return $this->response($this->success($data));
    }
    
    /**
     * 接收团长选定的商品
     */
      public function receiveGoods()
    {
        /*$token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);*/
        //获取当前用户绑定的商户
        $cl_id = input('cl_id', 0);
        $data = json_decode(input('data',''),true);
        
        
        
        foreach($data as $v){
            $categroup_id = json_decode($v['category_json'],true)[0];
            //查出当前团长的分佣比例

             $data = [
                    'leader_id'=>$cl_id,
                    'goods_id'=>$v['goods_id'],
                    'categroup_id'=>$categroup_id
                 ];
             //查询团长已经添加的数据
             $list = model('community_add')->add($data);
            }
        
        return $this->response($this->success([$list]));
    }
    
    /**
     * 获取团长选定的商品
     */
     public function goodsList()
    {
        
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        
        /*$token['data']['member_id'] = 1;*/
        
        //获取当前用户绑定的商户
        
        $page = input('page', 1);
        $page_size = input('page_size', '');
        $categroup_id = input('categroup_id',"");
        
       
        $member_model  = new MemberModel();
        $default_cl_id = $member_model->getMemberInfo([['member_id', '=' ,$token['data']['member_id']]], 'cl_id')['data']['cl_id'];
        if (empty($default_cl_id)) {
             return $this->response($this->error('', '请先选择团长'));
        }
      
        //判断当前团上状态
        $status = model('community_leader')->getInfo([['cl_id','=',$default_cl_id]],'status,rest_status');
       
        if ($status['status'] !== 1) {
            return $this->response($this->error('', '此团长账号状态异常'));
        }
         if ($status['rest_status'] === 1) {
            return $this->response($this->error('', '此团长账号休息中'));
        }
        //用团长id去查询对应的数据
        $condition =[ 
            ['g.goods_state','=',1],
            ['ca.leader_id','=',$default_cl_id],
            
        ];
            if (!empty($categroup_id)) {
          $condition[] =['ca.categroup_id','=',$categroup_id];
        }
            $join = [
                [ 'community_add ca', 'ca.goods_id = g.goods_id', 'inner' ],
                [ 'community_goods_sku gs', 'gs.goods_id = g.goods_id', 'inner' ],
             ];
        
         $field = 'g.*,gs.goods_id,gs.sku_id,gs.goods_name,gs.sku_name,gs.sku_spec_format,gs.price,gs.market_price,gs.discount_price,gs.promotion_type,gs.start_time,gs.end_time,gs.stock,gs.click_num,(gs.sale_num ) as sale_num,gs.collect_num,gs.sku_image,gs.sku_images,gs.goods_id,gs.site_id,gs.goods_content,gs.goods_state,gs.is_free_shipping,gs.goods_spec_format,gs.goods_attr_format,gs.introduction,gs.unit,gs.video_url,g.evaluate,gs.is_virtual,gs.max_buy,gs.min_buy';
        $alias = 'g';

        $data = model('community_goods')->pageList($condition, $field, 'gs.sku_id', $page, $page_size, $alias, $join);
        return $this->response($this->success($data));
    }
    
    
    /**
     * 团长自己获取自己选定的商品
     */
     public function leadergoodsList()
    {
        
       /* $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        */
        
        
        //获取当前用户绑定的商户
        
        $page = input('page', 1);
        $page_size = input('page_size', '');
        $categroup_id = input('categroup_id',"");
        $cl_id = isset($this->params['cl_id']) ? $this->params['cl_id'] : 0;
        if (empty($cl_id)) {
            return $this->response($this->error('', 'REQUEST_CLID'));
        }
        //判断当前团上状态
/*        $status = model('community_leader')->getInfo([['cl_id','=',$default_cl_id]],'status,rest_status');
       
        if ($status['status'] !== 1) {
            return $this->response($this->error('', '此团长账号状态异常'));
        }
         if ($status['rest_status'] === 1) {
            return $this->response($this->error('', '此团长账号休息中'));
        }*/
        //用团长id去查询对应的数据
        $condition =[ 
            ['g.goods_state','=',1],
            ['ca.leader_id','=',$cl_id],
            
        ];
            if (!empty($categroup_id)) {
                  $condition[] =['ca.categroup_id','=',$categroup_id];
            }
            $join = [
                [ 'community_add ca', 'ca.goods_id = g.goods_id', 'inner' ],
             ];
        
        $field = 'g.*';
        $alias = 'g';
        $data = model('community_goods')->pageList($condition, $field, '', $page, $page_size, $alias, $join);
        
        $file1 = 'lv.commission_rate';
        $alias1 = 'l';
        $join1 = [
                [ 'community_level lv', 'lv.level_id = l.level_id', 'inner' ],
             ];
        $re = model('community_leader')->getInfo([['l.cl_id','=',$cl_id]],$file1,$alias1, $join1);
         foreach ($data['list'] as $k=>&$v){
             $v['commission_money'] = $v['price'] * $re['commission_rate'] /100;
         }
        return $this->response($this->success($data));
    }
    
     /**
     * 详情信息
     */
    public function detail()
    {
        $sku_id = isset($this->params[ 'sku_id' ]) ? $this->params[ 'sku_id' ] : 0;
        if (empty($sku_id)) {
            return $this->response($this->error('', 'REQUEST_SKU_ID'));
        }
       
        $res = [];

        $goods = new GoodsModel();
        $goods_sku_detail = $goods->getGoodsSkuDetail($sku_id, 0);
        $goods_sku_detail = $goods_sku_detail[ 'data' ];
        $res[ 'goods_sku_detail' ] = $goods_sku_detail;

        if (empty($goods_sku_detail)) return $this->response($this->error($res));

        $res[ 'goods_sku_detail' ][ 'purchased_num' ] = 0; // 该商品已购数量

        $token = $this->checkToken();
        if ($token[ 'code' ] >= 0) {
            // 是否参与会员等级折扣
            
            if ($goods_sku_detail[ 'max_buy' ] > 0) $res[ 'goods_sku_detail' ][ 'purchased_num' ] = $goods->getGoodsPurchasedNum($goods_sku_detail[ 'goods_id' ], $this->member_id);
        }

        // 商品服务
        /*$goods_service = new GoodsService();
        $goods_service_list = $goods_service->getServiceList([ [ 'site_id', '=', $this->site_id ], [ 'id', 'in', $res[ 'goods_sku_detail' ][ 'goods_service_ids' ] ] ], 'service_name,desc');
        $res[ 'goods_sku_detail' ][ 'goods_service' ] = $goods_service_list[ 'data' ];*/


        // 查询当前商品参与的营销活动信息
        $goods_promotion = event('GoodsPromotion', [ 'goods_id' => $goods_sku_detail[ 'goods_id' ], 'sku_id' => $goods_sku_detail[ 'sku_id' ] ]);
        $res[ 'goods_sku_detail' ][ 'goods_promotion' ] = $goods_promotion;
       
        $cl_id = model('member')->getInfo([['member_id','=',$this->member_id??30]],'cl_id')['cl_id'];
        
        $res ['leader_info'] = model('community_leader')->getInfo([['cl_id','=',$cl_id]]);
        return $this->response($this->success($res));
    }
    

    
}