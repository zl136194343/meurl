<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace addon\servicer\event;

/**
 * 应用安装
 */
class UnInstall
{
    /**
     * 执行安装
     */
    public function handle()
    {
        // try{
        //     execute_sql('addon/manjian/data/install.sql');
        //     return success();
        // }catch (\Exception $e)
        // {
        //     return error('', $e->getMessage());
        // }

        return success();
    }
}
