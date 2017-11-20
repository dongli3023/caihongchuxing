<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:23:01
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/xdcms/footer.html" */ ?>
<?php /*%%SmartyHeaderCode:699559fbd305852793-28646732%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fce88bf6d444061db8c3a15881b8978ac26001f' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/xdcms/footer.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '699559fbd305852793-28646732',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\block.loop.php';
?><!-- 页尾 -->
<div id="foot">
<?php echo $_smarty_tpl->getVariable('lang')->value['copyright'];?>
 
<br> 
<div>友情链接：<?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"link")); $_block_repeat=true; smarty_block_loop(array('module'=>"link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
</a> <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
</div>
<!-- 页尾 END -->