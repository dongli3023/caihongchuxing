<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:22:52
         compiled from "D:\wamp\www\system/templates/admin/form/content_list.html" */ ?>
<?php /*%%SmartyHeaderCode:158085282d46d010dd6-68091750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31209cd96f53b834047dd766cae102e7ccfa2c96' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/form/content_list.html',
      1 => 1346036310,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158085282d46d010dd6-68091750',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\wamp\www\system\Smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">内容管理</h1>
<div class="line"></div>
<form name="form" action="index.php?m=form&c=content&f=delete" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_table">
  <tr>
    <th colspan="6" class="title"><div class="title_nav_1"><a href="index.php?m=form&c=content&formid=<?php echo $_smarty_tpl->getVariable('form')->value['id'];?>
">管理首页</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <th width="6%" class="tc"><input name="checkSelect" type="checkbox" class="checkbox" onClick="javascript: checkAll(this)" value="checkbox"></th>
    <th width="9%">ID</th>
    <th width="41%">标题</th>
    <th width="17%">发布时间</th>
    <th width="11%">操作</th>
  </tr>
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>($_smarty_tpl->getVariable('form')->value['form_table']),'order'=>"id desc",'pages'=>"page")); $_block_repeat=true; smarty_block_loop(array('module'=>($_smarty_tpl->getVariable('form')->value['form_table']),'order'=>"id desc",'pages'=>"page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

  <tr <?php if ($_smarty_tpl->getVariable('r')->value['_index']%2==0){?>class="bf"<?php }?>>
    <td class="tc"><input type="checkbox" name="id[]" value="<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
" class="checkbox" /></td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
</td>
    <td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('r')->value['inputtime'],'%Y-%m-%d');?>
</td>
    <td><a href="index.php?m=form&c=content&f=show&formid=<?php echo $_smarty_tpl->getVariable('form')->value['id'];?>
&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">详细</a> | <a href="###" onclick="confirm('真的要删除此内容吗?','index.php?m=form&c=content&f=delete&formid=<?php echo $_smarty_tpl->getVariable('form')->value['id'];?>
&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
')">删除</a></td>
</tr>
  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>($_smarty_tpl->getVariable('form')->value['form_table']),'order'=>"id desc",'pages'=>"page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<tr>
	<td class="tc"><input name="formid" type="hidden" id="formid" value="<?php echo $_smarty_tpl->getVariable('form')->value['id'];?>
" /><input name="submit" type="submit" class="button" value="删除" /></td>
    <td colspan="4">&nbsp;</td>
  </tr>
 <tr class="bf">
    <td colspan="6" class="tc"><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</td></tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
