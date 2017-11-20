<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:20:35
         compiled from "D:\wamp\www\system/templates/admin/language_list.html" */ ?>
<?php /*%%SmartyHeaderCode:133565282d3e3280398-93204045%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a904a695cb09aa8417934a4050738c41857c51f3' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/language_list.html',
      1 => 1348198584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133565282d3e3280398-93204045',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">版本管理</h1>
<div class="line"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=language">管理首页</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=language&f=cache">更新缓存</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <th width="8%" class="tc">编号</th>
    <th width="35%">名称</th>
    <th>目录</th>
    <th width="10%">操作</th>
  </tr>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"language",'pages'=>"page")); $_block_repeat=true; smarty_block_loop(array('module'=>"language",'pages'=>"page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<tr <?php if ($_smarty_tpl->getVariable('r')->value['_index']%2==0){?>class="bf"<?php }?>> 
    <td class="tc"><?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
</td>
    <td>&nbsp;<?php echo $_smarty_tpl->getVariable('r')->value['dir'];?>
</td>
    <td><a href="index.php?m=xdcms&c=language&f=edit&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">编辑</a> | <a href="###" onclick="confirm('真的要删除此版本吗?','index.php?m=xdcms&c=language&f=delete&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
')">删除</a></td>
</tr>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"language",'pages'=>"page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

 <tr class="bf">
    <td colspan="6" class="tc"><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</td>
 </tr>
</table>
<div class="xdcms_bottom"></div>
</body>
</html>
