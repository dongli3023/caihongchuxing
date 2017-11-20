<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 22:13:39
         compiled from "D:\wamp\www\guoxun\system/templates/admin/email.html" */ ?>
<?php /*%%SmartyHeaderCode:2809655896993bf9e52-05949035%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85ff26f81b09fb814caef568ed1b5d044e246f04' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/email.html',
      1 => 1425347762,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2809655896993bf9e52-05949035',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">网站邮件发送配置</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=xdcms&c=setting&f=save" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=setting">基本设置</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=setting&f=cache">更新缓存</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <td align="right">邮件发送方式：</td>
    <td colspan="3">
<input name="mailobject" type=radio class="checkbox" value="1" checked>
通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)</td>
  </tr>
  <tr>
    <td align="right">SMTP 服务器：</td>
    <td colspan="3"><input type="text" name="mailserver" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('email')->value['mailserver'];?>
">
    设置 SMTP 服务器的地址</td>
  </tr>
  <tr>
    <td align="right">SMTP 端口：</td>
    <td colspan="3"><input type="text" name="mailport" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('email')->value['mailport'];?>
">
    设置 SMTP 服务器的端口，默认为 25</td>
  </tr>
  <tr>
    <td align="right">SMTP 身份验证密码:</td>
    <td colspan="3"><input type="password" name="password" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('email')->value['password'];?>
"></td>
  </tr>
  <tr>
    <td align="right">发信人邮件地址:</td>
    <td colspan="3"><input type="text" name="mailadd" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('email')->value['mailadd'];?>
">
    如果需要验证, 必须为本服务器的邮件地址。</td>
  </tr>
  <tr>
    <td align="right">SMTP 身份验证用户名:</td>
    <td colspan="3"><input type="text" name="username" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('email')->value['username'];?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="确认保存" class="submit" /><input name="tag" type="hidden" id="tag" value="email" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
