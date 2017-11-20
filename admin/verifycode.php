<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/

require "../system/libs/code.class.php";
$code=new code(60,22);
$code->image();
for($i=1;$i<=4;$i++){
	$checkcode.=$code->checkcode[$i];
}
session_start();
$_SESSION['code']=$checkcode;
?>
