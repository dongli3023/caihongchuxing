<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 22:26:25
         compiled from "D:\wamp\www\guoxun\system/templates/admin/flash/flash_add.html" */ ?>
<?php /*%%SmartyHeaderCode:659455896c9166ec68-29984980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b1fac6f9c35a7da5698a3dde7b291746470766a' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/flash/flash_add.html',
      1 => 1435069583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '659455896c9166ec68-29984980',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\guoxun\system\Smarty\plugins\block.loop.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">幻灯片管理</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=flash&c=admin&f=addsave" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=flash&c=admin">管理首页</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=flash&c=admin&f=add">添加幻灯</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=flash&c=admin&f=add_type">添加分类</a></div><span>|</span><div class="title_nav_3"><a href="index.php?m=flash&c=admin&f=list_type">管理分类</a></div></th>
  </tr>
  <tr>
    <td width="24%" align="right">排序：</td>
    <td width="76%" colspan="3"><input type="text" name="sort" class="txt" size="3"></td>
  </tr>
  <tr>
    <td width="24%" align="right">名称：</td>
    <td width="76%" colspan="3"><input type="text" name="title" class="txt" size="30"></td>
  </tr>
  <tr>
    <td width="24%" align="right">分类：</td>
    <td width="76%" colspan="3">
      <select name="typeid" id="typeid">
      <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"flash_type")); $_block_repeat=true; smarty_block_loop(array('module'=>"flash_type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <option value="<?php echo $_smarty_tpl->getVariable('r')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('r')->value['name'];?>
</option>
      <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"flash_type"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                  </select></td>
  </tr>
  <tr>
    <td align="right">链接地址：</td>
    <td colspan="3"><input type="text" name="url" class="txt" size="30"></td>
  </tr>
  <tr>
    <td align="right">图片：</td>
    <td colspan="3"><input type="text" name="thumb" id="thumb" class="txt" size="30"> <a href="#" onclick="javascript:ShowIframe(400,115,'上传幻灯片！','system/function/upload.inc.php?filename=thumb')">上 传</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="确认保存" class="submit" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
