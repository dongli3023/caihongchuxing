<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 21:31:14
         compiled from "D:\wamp\www\guoxun\system/templates/admin/login.html" */ ?>
<?php /*%%SmartyHeaderCode:769555895fa2d5a921-62405966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8859ed634f73f4c28a5c21804b8833938f38b6c5' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/login.html',
      1 => 1425347763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '769555895fa2d5a921-62405966',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统--管理登陆</title>
<link href="admin/css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="admin/js/check.js"></script>
</head>

<body>
<form  name="form" method="post"  action="index.php?m=xdcms&c=login&f=check" onSubmit="return checksignup()">
<div class="login">
    <ul>
    	<li><input type="text" name="username" id="username" class="txt" /></li>
        <li><input type="password" name="password" id="password" class="txt" /></li>
        <li><input type="text" name="verifycode" id="verifycode" class="txt w96" /><img src="admin/verifycode.php" border="0" alt="验证码,看不清楚?请点击刷新验证码" onClick="this.src=this.src+'?'+Math.random();" class="codeimage"/></li>
        <li><input type="submit" name="button" id="button" value="" class="submit" /></li>
    </ul>
</div>
</form>
</body>
</html>
