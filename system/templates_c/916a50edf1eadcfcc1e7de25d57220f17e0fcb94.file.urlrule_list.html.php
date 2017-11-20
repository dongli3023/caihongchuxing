<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:24:30
         compiled from "D:\wamp\www\system/templates/admin/urlrule_list.html" */ ?>
<?php /*%%SmartyHeaderCode:269685282d4cea95a21-50532113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '916a50edf1eadcfcc1e7de25d57220f17e0fcb94' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/urlrule_list.html',
      1 => 1365409898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269685282d4cea95a21-50532113',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">URL规则管理</h1>
<div class="line"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=urlrule">管理首页</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=urlrule&f=add">添加规则</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <th width="5%" class="tc">编号</th>
    <th width="6%" class="tc">分类</th>
    <th width="31%">示例</th>
    <th width="40%">URL规则</th>
    <th width="6%" class="tc">是否静态</th>
    <th width="12%" class="tc">操作</th>
  </tr>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"urlrule",'order'=>"id desc",'pages'=>"page")); $_block_repeat=true; smarty_block_loop(array('module'=>"urlrule",'order'=>"id desc",'pages'=>"page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<tr <?php if ($_smarty_tpl->getVariable('r')->value['_index']%2==0){?>class="bf"<?php }?>> 
    <td class="tc"><?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
</td>
    <td class="tc"><?php echo $_smarty_tpl->getVariable('r')->value['class'];?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['urldemo'];?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
</td>
    <td class="tc"><?php if ($_smarty_tpl->getVariable('r')->value['ishtml']==1){?><font color='#FF0000'>√</font><?php }else{ ?>×<?php }?></td>
    <td class="tc"><a href="index.php?m=xdcms&c=urlrule&f=edit&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">编辑</a> | <?php if ($_smarty_tpl->getVariable('r')->value['is_fixed']==1){?><font color='#FF0000'>删除</font><?php }else{ ?><a href="###" onclick="confirm('真的要删除此规则吗?','index.php?m=xdcms&c=urlrule&f=delete&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
')">删除</a><?php }?></td>
</tr>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"urlrule",'order'=>"id desc",'pages'=>"page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

 <tr class="bf">
    <td colspan="6" class="tc"><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</td>
 </tr>
</table>
<div class="xdcms_bottom"></div>
</body>
</html>
