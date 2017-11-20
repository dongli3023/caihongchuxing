<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:29:23
         compiled from "D:\wamp\www\system/templates/xdcms/en/category_single.html" */ ?>
<?php /*%%SmartyHeaderCode:143685282d5f3a3e616-81618410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf4484a3d153f03d34c5ada5787a4b959b57cf3a' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/en/category_single.html',
      1 => 1348211306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143685282d5f3a3e616-81618410',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_get_block')) include 'D:\wamp\www\system\Smarty\plugins\function.get_block.php';
if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
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
<?php $_template = new Smarty_Internal_Template("xdcms/en/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
  <div id="banner1"><?php echo smarty_function_get_block(array('tag'=>'banner'),$_smarty_tpl);?>
</div>
  <div id="body3">
	<?php $_template = new Smarty_Internal_Template("xdcms/left.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <div id="body3_r">
      <div class="body3_r1">
        <p><a href="/index.php?l=2">Home</a> > <?php echo get_guide($_smarty_tpl->getVariable('cat')->value['catid']);?>
</p><?php echo $_smarty_tpl->getVariable('cat')->value['catname'];?>
</div>
        <div class="body3_r2">
        <!-- 文本 -->
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'more'=>1,'rows'=>1)); $_block_repeat=true; smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'more'=>1,'rows'=>1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php echo html_decode($_smarty_tpl->getVariable('r')->value['content']);?>

        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'more'=>1,'rows'=>1), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <!-- 文本 END  -->
        </div>
    </div>
    <div class="Cle"></div>
  </div>
<?php $_template = new Smarty_Internal_Template("xdcms/en/footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
</body>
</html>
