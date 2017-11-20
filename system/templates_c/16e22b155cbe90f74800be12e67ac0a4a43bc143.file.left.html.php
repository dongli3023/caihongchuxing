<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:23:18
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/xdcms/left.html" */ ?>
<?php /*%%SmartyHeaderCode:3129059fbd316a0be19-17770612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16e22b155cbe90f74800be12e67ac0a4a43bc143' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/xdcms/left.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3129059fbd316a0be19-17770612',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- 二级导航 -->
<div id="body3_l">
    <div class="body3_l1"><?php echo $_smarty_tpl->getVariable('left_title')->value;?>
</div>
    <div class="body3_l2">
        <ul>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('left_menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
            <li><div class="body3_l2_t">&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['value']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['catname'];?>
</a></div></li>
        <?php }} ?>
        </ul> 
    </div>
</div>
<!-- 二级导航 END  -->