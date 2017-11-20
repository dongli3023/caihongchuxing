<?php /* Smarty version Smarty-3.0.8, created on 2017-11-03 10:25:00
         compiled from "D:\phpStudy\WWW\xdcms\system/templates/xdcms/category_job.html" */ ?>
<?php /*%%SmartyHeaderCode:1397459fbd37cce6595-40090885%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51017ab21922f2dc69fd6623c903959016869c4f' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\xdcms\\system/templates/xdcms/category_job.html',
      1 => 1509675510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1397459fbd37cce6595-40090885',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_get_block')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\function.get_block.php';
if (!is_callable('smarty_block_loop')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\block.loop.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\phpStudy\WWW\xdcms\system\Smarty\plugins\modifier.date_format.php';
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
        <div class="body3_r2">
        <!-- 文本 -->
<?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'rows'=>1,'order'=>'catid asc')); $_block_repeat=true; smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'rows'=>1,'order'=>'catid asc'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>$_smarty_tpl->getVariable('r')->value['catid'],'more'=>1,'pages'=>'page','rows'=>3)); $_block_repeat=true; smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('r')->value['catid'],'more'=>1,'pages'=>'page','rows'=>3), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" class="t10">
              <tr>
                <td width="36%" bgcolor="#FFFFFF"><b>招聘职位：</b><?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
</td>
                <td width="14%" align="center" bgcolor="#FFFFFF"><a href="index.php?m=form&c=lists&formid=8"><font color="#ff0000">应聘此职位</font></a></td>
                <td width="50%" bgcolor="#FFFFFF"><b>发布时间：</b><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('r')->value['inputtime'],'%Y-%m-%d');?>
</td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#FFFFFF"><b>招聘类别：</b><?php echo $_smarty_tpl->getVariable('r')->value['type'];?>
</td>
                <td bgcolor="#FFFFFF"><b>经验要求：</b><?php echo $_smarty_tpl->getVariable('r')->value['experience'];?>
或以上</td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#FFFFFF"><b>学历要求：</b><?php echo $_smarty_tpl->getVariable('r')->value['degree'];?>
或以上</td>
                <td bgcolor="#FFFFFF"><b>性别要求：</b><?php echo $_smarty_tpl->getVariable('r')->value['sex'];?>
</td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#FFFFFF"><b>招聘人数：</b><?php echo $_smarty_tpl->getVariable('r')->value['numbers'];?>
人</td>
                <td bgcolor="#FFFFFF"><b>月薪待遇：</b><?php echo $_smarty_tpl->getVariable('r')->value['wage'];?>
</td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#FFFFFF"><b>职位描述：</b><?php echo $_smarty_tpl->getVariable('r')->value['content'];?>
</td>
              </tr>
            </table>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('r')->value['catid'],'more'=>1,'pages'=>'page','rows'=>3), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>$_smarty_tpl->getVariable('cat')->value['catid'],'rows'=>1,'order'=>'catid asc'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

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
