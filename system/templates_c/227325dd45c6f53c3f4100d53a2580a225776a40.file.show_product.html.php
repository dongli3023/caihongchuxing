<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:25:48
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/xdcms/show_product.html" */ ?>
<?php /*%%SmartyHeaderCode:1382859fbd3ac689711-16822201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '227325dd45c6f53c3f4100d53a2580a225776a40' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/xdcms/show_product.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1382859fbd3ac689711-16822201',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_get_block')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\function.get_block.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->getVariable('rs')->value['title'];?>
</title>
<meta name="Keywords" content="<?php echo $_smarty_tpl->getVariable('rs')->value['keywords'];?>
" />
<meta name="Description" content="<?php echo $_smarty_tpl->getVariable('rs')->value['description'];?>
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
        <div class="product_show">
        	<div class="body3_r3"><?php echo $_smarty_tpl->getVariable('rs')->value['title'];?>
</div>
            <div class="body3_r5">
            	<div class="p_img_big">
                <div id="tbody">
                    <div id="mainbody">
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = unserialize($_smarty_tpl->getVariable('rs')->value['moreimage']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                    <?php if ($_smarty_tpl->tpl_vars['k']->value==0){?>
                      <img src="<?php echo thumb($_smarty_tpl->tpl_vars['v']->value,640,400);?>
" width="640" height="400" id="mainphoto" rel="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" />
                    <?php }?>
                    <?php }} ?>
                    </div>
                    <img src="<?php echo $_smarty_tpl->getVariable('image_path')->value;?>
goleft.gif" width="11" height="56" id="goleft" />
                    <img src="<?php echo $_smarty_tpl->getVariable('image_path')->value;?>
goright.gif" width="11" height="56" id="goright" />
                    <div id="photos">
                      <div id="showArea">
                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = unserialize($_smarty_tpl->getVariable('rs')->value['moreimage']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                        <img src="<?php echo thumb($_smarty_tpl->tpl_vars['v']->value,80,52);?>
" width="80" height="52" rel="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" />
                        <?php }} ?>
                      </div>
                    </div>
                </div>
                </div>
                <div class="p_content">
                
                <!-- 详细内容 -->
                <?php echo $_smarty_tpl->getVariable('rs')->value['content'];?>

                <!-- 详细内容 END-->
                </div>
		</div>
        </div>
    </div>
    <div class="Cle"></div>
  </div>
<?php $_template = new Smarty_Internal_Template("xdcms/footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
</body>
</html>
<SCRIPT type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('js_path')->value;?>
slide.js"></SCRIPT>