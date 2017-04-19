<?php
/**
 *　                  oooooooooooo
 *
 *                  ooooooooooooooooo
 *                       o
 *                      o
 *                     o        o
 *                    oooooooooooo
 *
 *         ～～         ～～         　　～～
 *       ~~　　　　　~~　　　　　　　　~~
 * ~~～~~～~~　　　~~~～~~～~~～　　　~~~～~~～~~～
 * ·······              ~~XYHCMS~~            ·······
 * ·······  闲看庭前花开花落 漫随天外云卷云舒 ·······
 * ·············     www.xyhcms.com     ·············
 * ··················································
 * ··················································
 *
 * 公共验证控制器CommonController
 * @Author: gosea <gosea199@gmail.com>
 * @Date:   2014-06-21 10:00:00
 * @Last Modified by:   gosea
 * @Last Modified time: 2016-06-21 12:32:38
 */

namespace Manage\Controller;

use Think\Controller;

class CommonController extends Controller
{

    //_initialize自动运行方法，在每个方法前，系统会首先运动这个方法
    public function _initialize()
    {

        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->redirect(MODULE_NAME . '/Login/index');
        }
        C(get_cfg_value()); //添加配置

        $noAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));

        //是否开启验证 且 需要验证控制器或方法
        if (C('USER_AUTH_ON') && !$noAuth) {

            //单方文件(非分组)，MODULE_NAME不需要，留空，即RBAC::AccessDecision()
            \Org\Util\Rbac::AccessDecision(MODULE_NAME) || $this->error('没有权限'); //如果没有权限则返回error

        }

    }
}
