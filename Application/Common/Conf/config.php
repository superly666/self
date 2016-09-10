<?php
return array(
	//'配置项'=>'配置值'

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'db_dou',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',         // 数据库编码默认采用utf8
    
    //用户组的数据
    'RBAC_ROLES'            =>  array(
                            1 => '高层管理',
                            2 => '中层领导',
                            3 => '普通职员' 
                                ),
    //用户组的权限
    'RBAC_ROLES_AUTHS'      =>  array(
                            1 => array('*/*'),  //全部权限
                            2 => array('article/*','doc/*','product/*','index/*'),  //文章，幻灯片，商品，首页所有权限
                            3 => array('article/*','doc/show','product/*','index/*'), //文章，商品，首页所有权限，幻灯片只读权限
                            ),
);