<?php
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
define('IN_CMS','true');
require dirname(__FILE__).'/xdcms.inc.php';

//系统目录
define('SYS_DIR','system');
define('TP_DIR','templates');
define('CMS_PATH',substr(dirname(__FILE__),0,-strlen(SYS_DIR)));
define('SYS_PATH',CMS_PATH.SYS_DIR."/");
define('DATA_PATH',CMS_PATH.'data/');
define('LIB_PATH',SYS_PATH.'libs/');
define('MOD_PATH',SYS_PATH.'modules/');
define('FUN_PATH',SYS_PATH.'function/');
define('TP_PATH',SYS_PATH.TP_DIR."/");

//缓存目录
define('CACHE_PATH',CMS_PATH.'cache/');
define('CACHE_TP_PATH',CACHE_PATH.'cache_template/');
define('CACHE_SYS_PATH',CACHE_PATH.'cache_sys/');
//附件目录
define('UPLOAD_PATH', CMS_PATH.'uploadfile/'); //附件保存物理路径

//Smarty配置
include_once(SYS_PATH."Smarty/Smarty.class.php"); //包含smarty类文件
$smarty = new Smarty(); //建立smarty实例对象$smarty
$smarty->caching=TP_CACHE; //是否使用缓存
$smarty->template_dir = TP_PATH; //设置模板目录
$smarty->compile_dir = SYS_PATH."templates_c"; //设置编译目录
$smarty->cache_dir = CACHE_TP_PATH; //缓存文件夹
$smarty->cache_lifetime = 300;  //缓存时间
$smarty->left_delimiter = "{";
$smarty->right_delimiter = "}";

include(DATA_PATH."config.inc.php");
include(FUN_PATH."fun.inc.php");
?>