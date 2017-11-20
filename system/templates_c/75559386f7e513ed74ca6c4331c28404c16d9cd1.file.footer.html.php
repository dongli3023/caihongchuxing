<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 22:43:55
         compiled from "D:\wamp\www\guoxun\system/templates/xdcms/footer.html" */ ?>
<?php /*%%SmartyHeaderCode:11669558970ab4f9064-16698053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75559386f7e513ed74ca6c4331c28404c16d9cd1' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/xdcms/footer.html',
      1 => 1435070599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11669558970ab4f9064-16698053',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\guoxun\system\Smarty\plugins\block.loop.php';
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