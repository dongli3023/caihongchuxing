<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:23:58
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/admin/update_url.html" */ ?>
<?php /*%%SmartyHeaderCode:2307959fbd33ed05991-95621629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e99800559b59d000918dd39517cae0ff09ef1ac' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/admin/update_url.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2307959fbd33ed05991-95621629',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">URL生成管理</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=xdcms&c=creathtml&f=update_url" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=categorytree">更新URL</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <td width="20%" align="right">选择栏目范围:<br>(可多选)</td>
    <td style="padding-top:5px;padding-bottom:5px;"><select name="category[]" size="15" multiple="multiple" id="category[]" style="width:160px;">
        <?php echo $_smarty_tpl->getVariable('categorylist')->value;?>

    </select></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input type="submit" name="submit" value="确认更新" class="submit" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
