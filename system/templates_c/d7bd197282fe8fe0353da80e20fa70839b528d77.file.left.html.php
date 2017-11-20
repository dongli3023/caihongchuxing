<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:19:02
         compiled from "D:\wamp\www\system/templates/xdcms/left.html" */ ?>
<?php /*%%SmartyHeaderCode:319355282d3861525c8-98660469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7bd197282fe8fe0353da80e20fa70839b528d77' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/left.html',
      1 => 1346036626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '319355282d3861525c8-98660469',
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