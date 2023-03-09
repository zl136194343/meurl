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
namespace addon\cards\event;

/**
 * 活动展示
 */
class ShowPromotion
{

    /**
     * 活动展示
     * @return array
     */
	public function handle()
	{
        $data = [
            'admin' => [
                [
                    //插件名称
                    'name' => 'cards',
                    //店铺端展示分类  shop:营销活动   member:互动营销
                    'show_type' => 'member',
                    //展示主题
                    'title' => '刮刮乐',
                    //展示介绍
                    'description' => '刮刮乐活动',
                    //展示图标
                    'icon' => 'addon/cards/icon.png',
                    //跳转链接
                    'url' => 'cards://admin/cards/lists',
                ]
            ],
            'shop' => [
                [
                    //插件名称
                    'name' => 'cards',
                    //店铺端展示分类  shop:营销活动   member:互动营销
                    'show_type' => 'member',
                    //展示主题
                    'title' => '刮刮乐',
                    //展示介绍
                    'description' => '刮刮乐活动',
                    //展示图标
                    'icon' => 'addon/cards/icon.png',
                    //跳转链接
                    'url' => 'cards://shop/cards/lists',
                ]
            ]

        ];
	    return $data;
	}
}