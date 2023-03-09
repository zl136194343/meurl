<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\event;

use app\Controller;
use app\model\system\DiyTemplate;
use app\model\web\DiyView as DiyViewModel;

/**
 * 自定义页面创建（根据内置模板）
 */
class DiyViewCreate extends Controller
{
    // 行为扩展的执行入口必须是run
    public function handle($data)
    {
        $diy_view = new DiyViewModel();
        $div_template = new DiyTemplate();

        // 获取系统模板数据
        $diy_view_info = $div_template->getTemplateInfo([ [ 'id', '=', $data[ 'template_id' ] ] ]);
        if (empty($diy_view_info[ 'data' ])) return error(-1, '未获取到模板数据');
        $diy_view_info = $diy_view_info[ 'data' ];

        // 自定义模板组件集合
        $condition = [
            [ 'support_diy_view', 'like', [ $diy_view_info[ 'type' ], '%' . $diy_view_info[ 'type' ] . ',%', '%' . $diy_view_info[ 'type' ], '%,' . $diy_view_info[ 'type' ] . ',%', 'DIY_VIEW_INDEX', '' ], 'or' ]
        ];
        $utils = $diy_view->getDiyViewUtilList($condition);

        // 推广码
        $qrcode_info = [];

        $diy_view_utils = array ();
        if (!empty($utils[ 'data' ])) {

            // 先遍历，组件分类
            foreach ($utils[ 'data' ] as $k => $v) {
                $value = array ();
                $value[ 'type' ] = $v[ 'type' ];
                $value[ 'type_name' ] = $diy_view->getTypeName($v[ 'type' ]);
                $value[ 'list' ] = [];
                if (!in_array($value, $diy_view_utils)) {
                    array_push($diy_view_utils, $value);
                }
            }

            // 遍历每一个组件，将其添加到对应的分类中
            foreach ($utils[ 'data' ] as $k => $v) {
                foreach ($diy_view_utils as $diy_k => $diy_v) {
                    if ($diy_v[ 'type' ] == $v[ 'type' ]) {
                        array_push($diy_view_utils[ $diy_k ][ 'list' ], $v);
                    }
                }
            }
        }

        $this->assign("extend_base", 'app/' . $data[ 'app_module' ] . '/view/base.html');
        $this->assign("time", time());
        $this->assign("name", $diy_view_info[ 'type' ]);
        $this->assign("qrcode_info", $qrcode_info);
        $this->assign('diy_view_utils', $diy_view_utils);
        $this->assign("diy_view_info", $diy_view_info);

        $request_url = $data[ 'app_module' ] . '/diy/create';

        $this->assign("app_module", $data[ 'app_module' ]);
        $this->assign("request_url", $request_url);

        $replace = [];
        $template = dirname(realpath(__DIR__)) . '/admin/view/diy/edit.html';
        return $this->fetch($template, [], $replace);

    }

}