<?php
// +----------------------------------------------------------------------
// | 零云 [ 简单 高效 卓越 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lingyun.net All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------

/**
 * 开发模式数据库配置文件
 */
//$_SERVER[ENV_PRE.'DEV_MODE']  = 'true';
//$_SERVER[ENV_PRE.'DB_TYPE']   = 'mysql';
//$_SERVER[ENV_PRE.'DB_HOST']   = '127.0.0.1';
//$_SERVER[ENV_PRE.'DB_NAME']   = 'lingyun';
//$_SERVER[ENV_PRE.'DB_USER']   = 'root';
//$_SERVER[ENV_PRE.'DB_PWD']    = '';
//$_SERVER[ENV_PRE.'DB_PORT']   = '3306';
//$_SERVER[ENV_PRE.'DB_PREFIX'] = 'ly_';
//$_SERVER[ENV_PRE.'APP_DEBUG'] = 'false';

// 兼容Coding.net的动态Pages
if ($_ENV['MYSQL_HOST']) {
	$_SERVER[ENV_PRE.'DEV_MODE'] = 'true';
	$_SERVER[ENV_PRE.'DB_HOST']  = $_ENV['MYSQL_HOST'];
	$_SERVER[ENV_PRE.'DB_NAME']  = $_ENV['MYSQL_DBNAME'];
	$_SERVER[ENV_PRE.'DB_USER']  = $_ENV['MYSQL_USERNAME'];
	$_SERVER[ENV_PRE.'DB_PWD']   = $_ENV['MYSQL_PASSWORD'];
	$_SERVER[ENV_PRE.'DB_PORT']  = $_ENV['MYSQL_PORT'];
}
