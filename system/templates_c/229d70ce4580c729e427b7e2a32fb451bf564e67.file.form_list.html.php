<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:22:41
         compiled from "D:\wamp\www\system/templates/admin/form/form_list.html" */ ?>
<?php /*%%SmartyHeaderCode:202135282d461bd4942-74925730%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '229d70ce4580c729e427b7e2a32fb451bf564e67' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/form/form_list.html',
      1 => 1346036466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202135282d461bd4942-74925730',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">自定义表单管理</h1>
<div class="line"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=form&c=admin">管理首页</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=form&c=admin&f=form_add">添加表单</a></div><span>|</span><div class="title_nav_3"><a href="index.php?m=form&c=admin&f=cache">更新缓存</a></div></th>
  </tr>
  <tr>
    <th width="5%" class="tc">编号</th>
    <th>表单名称</th>
    <th width="20%">数据表</th>
    <th width="11%">状态</th>
    <th width="30%">操作</th>
  </tr>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"form",'order'=>"id desc",'pages'=>"page")); $_block_repeat=true; smarty_block_loop(array('module'=>"form",'order'=>"id desc",'pages'=>"page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<tr <?php if ($_smarty_tpl->getVariable('r')->value['_index']%2==0){?>class="bf"<?php }?>> 
    <td class="tc"><?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['form_name'];?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('pre')->value;?>
<?php echo $_smarty_tpl->getVariable('r')->value['form_table'];?>
</td>
    <td><?php if ($_smarty_tpl->getVariable('r')->value['is_lock']==0){?><a href="index.php?m=form&c=admin&f=lock&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
&lockid=1"><font color='#FF0000'>已锁定</font></a><?php }else{ ?><a href="index.php?m=form&c=admin&f=lock&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
&lockid=0">正常</a><?php }?></td>
    <td><a href="/index.php?m=form&c=lists&formid=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
" target="_blank">查看</a> | <a href="index.php?m=form&c=content&formid=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">内容管理</a> | <a href="index.php?m=form&c=admin&f=field&formid=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">管理字段</a> | <a href="index.php?m=form&c=admin&f=form_edit&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">编辑</a> | <?php if ($_smarty_tpl->getVariable('r')->value['is_fixed']==0){?><a href="###" onclick="confirm('真的要删除此表单吗?','index.php?m=form&c=admin&f=form_delete&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
')">删除</a><?php }else{ ?><font color='#FF0000'>删除</font><?php }?></td>
</tr>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"form",'order'=>"id desc",'pages'=>"page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

 <tr class="bf">
    <td colspan="6" class="tc"><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</td>
 </tr>
</table>
<div class="xdcms_bottom"></div>
</body>
</html>
