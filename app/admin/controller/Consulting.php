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

use app\model\consulting\Config as Config;
use app\model\upload\Upload as UploadModel;

/**
 * 咨询管理 控制器
 */
class Consulting extends BaseAdmin
{

    /**
     * 咨询列表
     */
    public function lists()
    {
        //获取咨询信息
        $consulting = new Config();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            /*$title = input('title', '');*/
            $stustas = input('stustas', '');
            $condition = [];
            /*if ($title) {
                $condition[] = [ 'title', 'like', '%' . $title . '%' ];
            }*/
            if ($stustas != '') {
                $condition[] = [ 'status', '=', $stustas ];
            }
           
            $shop_list = $consulting->getList($condition,$page,'','sort desc');
            return $shop_list;
        }


        $verify_state = $consulting->getList([],1,'','id asc');

        $this->assign('verify_state', $verify_state['data']);

        return $this->fetch('consulting/lists');
    }
    public function addCon(){
        if (request()->isAjax()) {
          /*  if (input('title','') == "") return $this->error('','请填写标题');
            if (input('content','') == "") return $this->error('','请填写内容');*/
            //填写秀米链接
            $data = [
                'title'=>input('title',''),
                'content'=>input('goods_content',''),
                'status'=>input('stustas',''),
                'create_time'=>time(),
                'modify_time'=>time(),
                'cover_img'=>input('logo',''),
            ];
            
            preg_match_all('/<img .*?src=[\"|\']+(.*?)[\"|\']+.*?>/',$data['content'],$match);
            $mimes=array(
                'image/bmp'=>'bmp',
                'image/gif'=>'gif',
                'image/jpeg'=>'jpg',
                'image/jpg'=>'jpg',
                'image/png'=>'png',
                'image/x-icon'=>'ico'
            );
            $flie_name = "upload/common/images/" . date("Ymd");
            $this->setDir($flie_name);

            foreach($match[1] as $m){

                if(($headers=get_headers($m, 1))!==false){
                    // 获取响应的类型
                    $type=$headers['Content-Type'];
                }
                $extension=$mimes[$type];

                $add = time()+mt_rand(111,999999);

                $li = file_get_contents($m);
                file_put_contents($flie_name. '/'.$add.'.'.$extension,$li);
                $data['content']= str_replace($m,'https://'.$_SERVER['HTTP_HOST'].'/'.$flie_name. '/'.$add.'.'.$extension,$data['content']);
            }
        
            $consulting = new Config();
            return $consulting->addCon($data);
        }

        return $this->fetch('consulting/add_con');
    }

    private function setDir($file_dir)
    {
        if(!file_exists($file_dir))
        {
            mkdir($file_dir,0777,TRUE);
        }
        // 文件名，这里只是演示，实际项目中请使用自己的唯一文件名生成方法
        return true;
    }
    public function upload()
    {
        $upload_model = new UploadModel();
        $thumb_type = input("thumb", "");
        $name = input("name", "");
        $param = array (
            "thumb_type" => "",
            "name" => "file"
        );
        $result = $upload_model->setPath("common/images/" . date("Ymd") . '/')->image($param);
        if($result['code'] =='10069'){
            $re['code'] = 0;
            $re['msg'] =$result['message'] ;
            $re['data']['src'] ='https://'.$_SERVER['HTTP_HOST'].'/'.$result['data']['pic_path'] ;

        }

        return $re;
    }
    public function uploadStatus()
    {
        $consulting = new Config();
        if (request()->isAjax()) {

            $data = [
                'status'=>input('stustas',''),
                'modify_time'=>time(),
            ];
            if (input('title','') ){
                $data["title"] = input('title','');
            }
            if (input('content','') ){
                $data["content"] = input('content','');
            }
            $data["cover_img"] = input('logo','');
            
            $consulting = new Config();

            preg_match_all('/<img .*?src=[\"|\']+(.*?)[\"|\']+.*?>/',$data['content'],$match);
            $mimes=array(
                'image/bmp'=>'bmp',
                'image/gif'=>'gif',
                'image/jpeg'=>'jpg',
                'image/jpg'=>'jpg',
                'image/png'=>'png',
                'image/x-icon'=>'ico'
            );
            $flie_name = "upload/common/images/" . date("Ymd");
            $this->setDir($flie_name);

            foreach($match[1] as $m){

                if(stripos($m,$_SERVER['HTTP_HOST'])){

                    continue;
                }
                if(($headers=get_headers($m, 1))!==false){
                    // 获取响应的类型
                    $type=$headers['Content-Type'];
                }
                $extension=$mimes[$type];

                $add = time()+mt_rand(111,999999);

                $li = file_get_contents($m);
                file_put_contents($flie_name. '/'.$add.'.'.$extension,$li);
                $data['content']= str_replace($m,'https://'.$_SERVER['HTTP_HOST'].'/'.$flie_name. '/'.$add.'.'.$extension,$data['content']);
            }
            
            return $consulting->uploadStatus($data,[['id','=',input('id','')]]);
        }
        $id = input('con_id','');
        $res = $consulting->getConInfo([['id','=',$id]]);
        
        $res['data']['content'] = html_entity_decode($res['data']['content']);
        
        $this->assign('verify_state',$res);

        return $this->fetch('consulting/edit');
    }
    public function deleteCon()
    {
        if (request()->isAjax()) {
            $con_id = input('con_id', ''); // 分类id
            $con_model = new Config();
            $res = $con_model->deleteCon($con_id);
            $this->addLog("删除咨询id:" . $con_id);
            return $res;
        }
    }
    public function xiumiUeDialogV5()
    {
        return $this->fetch('consulting/xiumi-ue-dialog-v5');
    }
    public function v5()
    {
        return $this->fetch('consulting/v5');
    }
    public function modifySort(){
        if (request()->isAjax()) {
            $con_id = input('goods_id', ''); // 分类id
            $con_model = new Config();
            
            $res = model('consulting')->setFieldValue([['id','=',$con_id]],'sort',input('sort', ''));
            $this->addLog("改了商品id为:" . $con_id.'的权重');
            if ($res) {
                return ['code'=>0,'message'=>'修改成功'];
            }
            return $this->error();
           
        }
    }

}