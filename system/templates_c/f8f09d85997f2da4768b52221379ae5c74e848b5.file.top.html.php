<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 21:31:23
         compiled from "D:\wamp\www\guoxun\system/templates/admin/top.html" */ ?>
<?php /*%%SmartyHeaderCode:3104555895fab508214-29316109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8f09d85997f2da4768b52221379ae5c74e848b5' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/top.html',
      1 => 1425347763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3104555895fab508214-29316109',
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
<link rel="stylesheet" type="text/css" href="admin/css/top.css">
</head>

<body>
<div class="main header">
	<div class="logo"></div>
    <h5><a href="javascript:void(0)">使用帮助</a><a href="javascript:void(0)">关于</a></h5>
    <ul>
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('top_menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <li <?php if ($_smarty_tpl->tpl_vars['k']->value==0){?>class="on"<?php }else{?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('array_count')->value-1;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['k']->value==$_tmp1){?>class="end"<?php }}?>><a onClick="parent.left.location='<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>
';" href="index.php?m=xdcms&c=index&f=main" target="main"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
    <?php }} ?>
    </ul>
</div>
<div class="manage"><span>语言选择：<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('language')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
?><a href="/index.php?m=xdcms&c=index&l=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" target="_parent"><?php if ($_smarty_tpl->tpl_vars['v']->value['title']==$_smarty_tpl->getVariable('lang_title')->value){?><font color="#ff0000"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</font><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
<?php }?></a>|<?php }} ?></span>当前版本：<?php echo $_smarty_tpl->getVariable('lang_title')->value;?>
 </div>
<div class="position">
	<a href="index.php?m=xdcms&c=setting" target="main">系统设置</a>
    <a href="/" target="_blank">首页</a>
    <a href="index.php?m=xdcms&c=login&f=out" target="_parent">退出</a>
    <h5>后台内容管理</h5>
</div>
</body>
</html>
