<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:46:03
         compiled from "D:\wamp\www\system/templates/admin/template_list.html" */ ?>
<?php /*%%SmartyHeaderCode:219895282d9db122560-06533671%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00ef159b322bfc04b65baee8c878ef57f385c708' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/template_list.html',
      1 => 1346036760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219895282d9db122560-06533671',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">模板管理</h1>
<div class="line"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=template">管理首页</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=template&f=calls">调用说明</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <th width="8%" class="tc">编号</th>
    <th>模板名称</th>
    <th width="10%">操作</th>
  </tr>
<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('template_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
<tr <?php if ($_smarty_tpl->tpl_vars['key']->value%2!=0){?>class="bf"<?php }?>> 
    <td class="tc"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</td>
    <td><a href="index.php?m=xdcms&c=template&f=edit&file=<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
">编辑</a></td>
</tr>
<?php }} ?>
</table>
<div class="xdcms_bottom"></div>
</body>
</html>
