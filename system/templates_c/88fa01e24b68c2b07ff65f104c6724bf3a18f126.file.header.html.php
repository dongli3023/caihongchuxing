<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:18:45
         compiled from "D:\wamp\www\system/templates/xdcms/header.html" */ ?>
<?php /*%%SmartyHeaderCode:157515282d375820d11-50225324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88fa01e24b68c2b07ff65f104c6724bf3a18f126' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/header.html',
      1 => 1356618502,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157515282d375820d11-50225324',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
?><?php $_template = new Smarty_Internal_Template("xdcms/qq.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div id="shell"> 
	<!-- 页头 -->
	<div id="header">
    	<h1><a href="/" title="<?php echo $_smarty_tpl->getVariable('config')->value['title'];?>
"><img src="<?php echo $_smarty_tpl->getVariable('config')->value['logourl'];?>
" /></a></h1>
        <div id="h_r"><script src="index.php?m=member&c=login&f=login_text"></script> | <a href="/index.php?l=2">English</a></div>
	</div>
	<!-- 页头 END -->

	<!-- 导航 -->
	<div id="nav1">
  		<div id="nav_l">
    		<div id="menu">
                <ul id="nav">
                    <li class="jquery_out"></li>
                    <li class="mainlevel"><a href="/" >首　页</a></li>
                    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                    <li class="mainlevel" id="mainlevel_0<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['value']->value['url'];?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value['is_target']==1){?>target="_blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value['catname'];?>
</a>
                    <ul id="sub_0<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('sql'=>"select * from ".($_smarty_tpl->getVariable('pre')->value)."category where parentid=".($_smarty_tpl->tpl_vars['value']->value['catid']))); $_block_repeat=true; smarty_block_loop(array('sql'=>"select * from ".($_smarty_tpl->getVariable('pre')->value)."category where parentid=".($_smarty_tpl->tpl_vars['value']->value['catid'])), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li><a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
" <?php if ($_smarty_tpl->getVariable('r')->value['is_target']==1){?>target="_blank"<?php }?>><?php echo $_smarty_tpl->getVariable('r')->value['catname'];?>
</a></li>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('sql'=>"select * from ".($_smarty_tpl->getVariable('pre')->value)."category where parentid=".($_smarty_tpl->tpl_vars['value']->value['catid'])), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </ul>
                    </li>
                    <?php }} ?>
                    <div class="clear"></div>
                </ul>
			</div>
		</div>
        <div id="nav_r">
            <form id="form1" name="form1" method="get" action="index.php">
                <input type="text" name="key" id="key" class="key" />
                <input type="image" src="<?php echo $_smarty_tpl->getVariable('image_path')->value;?>
search_submit.gif" class="search_submit" />
                <input name="f" type="hidden" id="f" value="search" />
                <input name="l" type="hidden" id="l" value="1" />
                <input name="catid" type="hidden" id="catid" value="2" />
            </form>
        </div>
		<div class="cle">&nbsp;</div>
	</div>
	<!-- 导航 END  -->