<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 21:33:06
         compiled from "D:\wamp\www\guoxun\system/templates/admin/single_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:1043755896012be31e9-70558292%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7e27b10a74c3b927bc8811609a7636a6296c699' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/single_edit.html',
      1 => 1425347763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1043755896012be31e9-70558292',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\wamp\www\guoxun\system\Smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<script charset="utf-8" src="admin/editor/kindeditor.js"></script>
<script charset="utf-8" src="admin/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="admin/editor/plugins/code/prettify.js"></script>
<h1 class="xdcms_search_title"><?php echo $_smarty_tpl->getVariable('catname')->value;?>
</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=xdcms&c=content&f=edit_save" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="2" class="title"><div class="title_nav_1"><?php echo $_smarty_tpl->getVariable('catname')->value;?>
</div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <td width="15%" align="right">栏目名称：</td>
    <td><?php echo $_smarty_tpl->getVariable('catname')->value;?>
</td>
  </tr>
  <tr>
    <td align="right">标题：</td>
    <td><input type="text" name="title" class="txt" size="45" id="title" value="<?php echo $_smarty_tpl->getVariable('rs')->value['title'];?>
"></td>
  </tr>
  <tr>
    <td align="right">缩略图：</td>
    <td><input type="text" name="thumb" id="thumb" class="txt" size="25" value="<?php echo $_smarty_tpl->getVariable('rs')->value['thumb'];?>
"> <a href="#" onclick="javascript:ShowIframe(400,115,'上传缩略图！','system/function/upload.inc.php?filename=thumb')">上 传</a></td>
  </tr>
  <?php echo $_smarty_tpl->getVariable('fields')->value;?>

  <tr>
    <td align="right">更新时间：</td>
    <td><input type="text" name="updatetime" class="txt" size="20" id="updatetime" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S');?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="hidden" name="inputtime" id="inputtime" value="<?php echo $_smarty_tpl->getVariable('rs')->value['inputtime'];?>
" />
      <input type="hidden" name="url" id="url" value="<?php echo $_smarty_tpl->getVariable('rs')->value['url'];?>
" /><input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->getVariable('rs')->value['id'];?>
" /><input type="hidden" name="catid" id="catid" value="<?php echo $_smarty_tpl->getVariable('catid')->value;?>
" /><input type="submit" name="submit" value="确认保存" class="submit" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
