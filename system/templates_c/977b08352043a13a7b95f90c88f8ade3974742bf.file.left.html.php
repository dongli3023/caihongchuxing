<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:22:59
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/admin/left.html" */ ?>
<?php /*%%SmartyHeaderCode:1094259fbd303489b94-41288637%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '977b08352043a13a7b95f90c88f8ade3974742bf' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/admin/left.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1094259fbd303489b94-41288637',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统--后台管理</title>
<link href="admin/css/left.css" rel="stylesheet" type="text/css" />
<script src="admin/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="admin/js/MenuTree.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$('#menu').menuTree();
	});
</script>
</head>

<body>
<div class="top"></div>
<div id="menu" class="menuTree">
<?php echo $_smarty_tpl->getVariable('menu')->value;?>

</div>
</body>
</html>
