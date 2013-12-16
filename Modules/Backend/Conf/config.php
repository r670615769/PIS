<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * APP private config file, the file copy from ThinkPHP convention config.
 */
defined('THINK_PATH') or exit();
return  array(
    /* Auth config */
    'AUTH_CONFIG' => array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'usergroup', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'user_usergroup', //用户组明细表
        'AUTH_RULE' => 'permission', //权限规则表
        'AUTH_USER' => 'user',//用户信息表
        'AUTH_LOGIN_GATEWAY' => __APP__.'/Public/login',
        'AUTH_LOGOUT_GATEWAY' => __APP__.'/Public/logout',
        'NOT_AUTH_MODEL' => array('Public'),
        'NOT_AUTH_ACTION' => array()
    )

);