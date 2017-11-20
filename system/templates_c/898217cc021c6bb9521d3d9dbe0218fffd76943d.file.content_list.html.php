<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 21:37:54
         compiled from "D:\wamp\www\guoxun\system/templates/admin/content_list.html" */ ?>
<?php /*%%SmartyHeaderCode:2579355896132ce8ee2-55801253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '898217cc021c6bb9521d3d9dbe0218fffd76943d' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/content_list.html',
      1 => 1435066670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2579355896132ce8ee2-55801253',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\guoxun\system\Smarty\plugins\block.loop.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\wamp\www\guoxun\system\Smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title"><div id="open_search"></div>搜索</h1>
<div class="line"></div>
<div id="XDcms_search">
<form name="form1" action="index.php?m=xdcms&c=content&f=search" method="post">
	<dl>
    	<dd>请输入关键词：</dd>
        <dd><input name="key" type="text" class="key" /></dd>
        <dd><input name="submit" type="submit" value="马上搜索" class="submit ml20" /><input name="catid" type="hidden" value="<?php echo $_smarty_tpl->getVariable('catid')->value;?>
" /></dd>
    </dl>
</form>
</div>
<form name="form"  id="form" action="" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_table">
  <tr>
    <th colspan="8" class="title"><div class="title_nav_1"><?php echo $_smarty_tpl->getVariable('catname')->value;?>
</div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=content&f=add&catid=<?php echo $_smarty_tpl->getVariable('catid')->value;?>
">发布内容</a></div><span>|</span><div class="title_nav_3"><a href="index.php?m=xdcms&c=transfer&catid=<?php echo $_smarty_tpl->getVariable('catid')->value;?>
">数据转移</a></div></th>
  </tr>
  <tr>
    <th width="7%" class="tc"><input name="checkSelect" type="checkbox" class="checkbox" onClick="javascript: checkAll(this)" value="checkbox"></th>
    <th width="5%">排序</th>
    <th width="5%">编号</th>
    <th>标题</th>
    <th width="8%" class="tc">是否推荐</th>
    <th width="8%" class="tc">点击量</th>
    <th width="10%">发布时间</th>
    <th width="11%" class="tc">操作</th>
  </tr>
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>$_smarty_tpl->getVariable('catid')->value,'pages'=>"page",'urlrule'=>"index.php?m=xdcms&c=content&catid=[catid]&page=[page]",'rows'=>"20")); $_block_repeat=true; smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('catid')->value,'pages'=>"page",'urlrule'=>"index.php?m=xdcms&c=content&catid=[catid]&page=[page]",'rows'=>"20"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

  <tr <?php if ($_smarty_tpl->getVariable('r')->value['_index']%2==0){?>class="bf"<?php }?>>
    <td class="tc"><input type="checkbox" name="contentid[]" value="<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
" class="checkbox" /><input type="hidden" name="id[]" id="id[]" value="<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
" /></td>
    <td><input type="text" name="sort<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
" id="sort<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
" value="<?php echo $_smarty_tpl->getVariable('r')->value['sort'];?>
" size="4" /></td>
    <td><?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
</td>
    <td align="left" <?php if ($_smarty_tpl->getVariable('r')->value['style']!=''){?>class="<?php echo $_smarty_tpl->getVariable('r')->value['style'];?>
"<?php }?>> &nbsp;<?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
</td>
    <td class="tc"><?php echo $_smarty_tpl->getVariable('r')->value['commend'];?>
</td>
    <td class="tc"><?php echo $_smarty_tpl->getVariable('r')->value['hits'];?>
</td>
    <td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('r')->value['inputtime'],'%Y-%m-%d');?>
</td>
    <td><a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
" target="_blank">查看</a> | <a href="index.php?m=xdcms&c=content&f=edit&catid=<?php echo $_smarty_tpl->getVariable('r')->value['catid'];?>
&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
">编辑</a> | <a href="#" onclick="confirm('真的要删除此信息吗?','index.php?m=xdcms&c=content&f=delete&catid=<?php echo $_smarty_tpl->getVariable('r')->value['catid'];?>
&id=<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
')">删除</a></td>
  </tr>
  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('catid')->value,'pages'=>"page",'urlrule'=>"index.php?m=xdcms&c=content&catid=[catid]&page=[page]",'rows'=>"20"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

  <tr>
	<td colspan="8"><input type="hidden" name="catid" id="catid" value="<?php echo $_smarty_tpl->getVariable('catid')->value;?>
" /><input name="submit" type="submit" class="submit ml20" value="批量删除" onclick="form.action='index.php?m=xdcms&c=content&f=delete';" /><input name="submit" type="submit" class="button ml20" value="排序" onclick="form.action='index.php?m=xdcms&c=content&f=sort_save';" /><input name="submit2" type="submit" class="submit ml20" value="批量移动" onclick="form.action='index.php?m=xdcms&c=transfer&f=transfer_content';" /></td>
  </tr>
 <tr class="bf">
    <td colspan="8" class="tc"><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</td></tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
