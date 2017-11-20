<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:18:45
         compiled from "D:\wamp\www\system/templates/xdcms/footer.html" */ ?>
<?php /*%%SmartyHeaderCode:22695282d375e03b55-74598789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f59884f07ce2e13d4a22348f80ed59d95811b54f' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/footer.html',
      1 => 1358481824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22695282d375e03b55-74598789',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
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