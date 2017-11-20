<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:29:15
         compiled from "D:\wamp\www\system/templates/xdcms/member/register.html" */ ?>
<?php /*%%SmartyHeaderCode:110435282d5eba18f94-47942335%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6434fee8eaad72988e637455a85a7aea285a21cc' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/member/register.html',
      1 => 1346037152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110435282d5eba18f94-47942335',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_get_block')) include 'D:\wamp\www\system\Smarty\plugins\function.get_block.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
<base href="<?php echo $_smarty_tpl->getVariable('config')->value['siteurl'];?>
">
<link href="<?php echo $_smarty_tpl->getVariable('css_path')->value;?>
css.css" type=text/css rel=stylesheet>
</head>

<body>
<?php $_template = new Smarty_Internal_Template("xdcms/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
  <div id="banner1"><?php echo smarty_function_get_block(array('tag'=>'banner'),$_smarty_tpl);?>
</div>
  <div id="body3">
<?php $_template = new Smarty_Internal_Template("xdcms/member/left.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <div id="body3_r">
      <div class="body3_r1">
        <p><a href="/">首页</a>&nbsp;&raquo;&nbsp;会员注册</p>会员注册</div>
        <div class="body3_r2">
        <!-- 文本 -->
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <form name="addform" action="index.php?m=member&f=register_save" method="post">
          <tr>
            <td width="21%" align="right">用户名：</td>
            <td width="79%"><input name="username" type="text" id="username" size="20" class="key" /> <font color=#ff0000>*</font></td>
          </tr>
          <tr>
            <td width="21%" align="right">密码：</td>
            <td width="79%"><input name="password" type="password" id="password" size="21" class="key" /> <font color=#ff0000>*</font></td>
          </tr>
          <tr>
            <td width="21%" align="right">确认密码：</td>
            <td width="79%"><input name="password2" type="password" id="password2" size="21" class="key" /> <font color=#ff0000>*</font></td>
          </tr>
          <?php echo $_smarty_tpl->getVariable('fields')->value;?>

          <tr>
            <td>&nbsp;</td>
            <td>
            <input type="submit" name="submit" value=" 注 册 " /></td>
          </tr>
          </form>
        </table>
        <!-- 文本 END  -->
        </div>
    </div>
    <div class="Cle"></div>
  </div>
<?php $_template = new Smarty_Internal_Template("xdcms/footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
</body>
</html>
