<?php
 /**
 * $Author: 91736 $
 * ============================================================================
 * 91736开发get_block调用碎片
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/
function smarty_function_get_block($params,&$smarty){
	$mysql=new mysql();
	extract($params);
	
	if(!isset($tag))
		return "";
		
	$rs=$mysql->get_one("select * from `".DB_PRE."block` where `tag`='{$tag}'");

	print $rs['content'];
}
?>