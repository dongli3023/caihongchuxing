<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:24:58
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/xdcms/category_product.html" */ ?>
<?php /*%%SmartyHeaderCode:2500959fbd37a99a992-87835539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30ac31772d1c88c45cb779fb01f5484b8e48c57c' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/xdcms/category_product.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2500959fbd37a99a992-87835539',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_get_block')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\function.get_block.php';
if (!is_callable('smarty_block_loop')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\block.loop.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($_smarty_tpl->getVariable('cat')->value['seo_title']==''){?><?php echo $_smarty_tpl->getVariable('cat')->value['catname'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('cat')->value['seo_title'];?>
<?php }?></title>
<meta name="Keywords" content="<?php echo $_smarty_tpl->getVariable('cat')->value['seo_key'];?>
" />
<meta name="Description" content="<?php echo $_smarty_tpl->getVariable('cat')->value['seo_des'];?>
" />
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
	<?php $_template = new Smarty_Internal_Template("xdcms/left.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <div id="body3_r">
      <div class="body3_r1">
        <p><a href="/">首页</a> > <?php echo get_guide($_smarty_tpl->getVariable('cat')->value['catid']);?>
</p><?php echo $_smarty_tpl->getVariable('cat')->value['catname'];?>
</div>
        <div id="right_a2">
        <!-- 文本 -->
        	<ul class="product_list">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'pages'=>'page')); $_block_repeat=true; smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'pages'=>'page'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            	<li><a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
"><img src="<?php echo thumb($_smarty_tpl->getVariable('r')->value['thumb'],135,210);?>
" height="135" width="210" /><h3><?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
</h3></a></li>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'pages'=>'page'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </ul>
            <div class="Cle"></div>
            <div id='page'><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</div>
        <!-- 文本 END  -->
        </div>
    </div>
    <div class="Cle"></div>
  </div>
<?php $_template = new Smarty_Internal_Template("xdcms/footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
</body>
</html>
