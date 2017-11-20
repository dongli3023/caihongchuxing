<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:19:14
         compiled from "D:\wamp\www\system/templates/xdcms/form_list.html" */ ?>
<?php /*%%SmartyHeaderCode:31295282d392cec092-91556229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43af00731dbf8214e0c0d6dea119b80ab8e05bd6' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/form_list.html',
      1 => 1348196112,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31295282d392cec092-91556229',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_get_block')) include 'D:\wamp\www\system\Smarty\plugins\function.get_block.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->getVariable('form')->value['form_name'];?>
</title>
<base href="<?php echo $_smarty_tpl->getVariable('config')->value['siteurl'];?>
">
<link href="<?php echo $_smarty_tpl->getVariable('css_path')->value;?>
css.css" type=text/css rel=stylesheet>
</head>

<body>
<?php $_template = new Smarty_Internal_Template("xdcms/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
  <div id="banner1"><?php echo smarty_function_get_block(array('tag'=>'banner'),$_smarty_tpl);?>
</div>
  <div id="body3">
    <!-- 二级导航 -->
    <div id="body3_l">
        <div class="body3_l1"><?php echo $_smarty_tpl->getVariable('form')->value['form_name'];?>
</div>
        <div class="body3_l2">
            <ul>
                <li><div class="body3_l2_t">&nbsp;<a href="index.php?m=form&c=lists&formid=<?php echo $_smarty_tpl->getVariable('form')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('form')->value['form_name'];?>
</a></div></li>
            </ul> 
        </div>
    </div>
    <!-- 二级导航 END  -->
    <div id="body3_r">
      <div class="body3_r1">
        <p><a href="/">首页</a>&nbsp;&raquo;&nbsp;<?php echo $_smarty_tpl->getVariable('form')->value['form_name'];?>
</p><?php echo $_smarty_tpl->getVariable('form')->value['form_name'];?>
</div>
        <div class="body3_r2">
        <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <form name="addform" action="index.php?m=form&c=lists&f=add_save&formid=<?php echo $_smarty_tpl->getVariable('form')->value['id'];?>
" method="post">
          <tr>
            <td width="21%" align="right">标题：</td>
            <td width="79%"><label>
              <input name="fields[title]" type="text" id="fields[title]" size="35" />
            </label></td>
          </tr>
          <?php echo $_smarty_tpl->getVariable('fields')->value;?>

          <tr>
            <td>&nbsp;</td>
            <td>
            <input type="submit" name="submit" value=" 提 交 " /></td>
          </tr>
          </form>
        </table>
        </div>
    </div>
    <div class="Cle"></div>
  </div>
<?php $_template = new Smarty_Internal_Template("xdcms/footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
</body>
</html>
