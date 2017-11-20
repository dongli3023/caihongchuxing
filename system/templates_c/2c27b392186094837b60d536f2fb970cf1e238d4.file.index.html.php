<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:18:45
         compiled from "D:\wamp\www\system/templates/xdcms/index.html" */ ?>
<?php /*%%SmartyHeaderCode:229825282d3753ef809-36178435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c27b392186094837b60d536f2fb970cf1e238d4' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/xdcms/index.html',
      1 => 1379342019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229825282d3753ef809-36178435',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
if (!is_callable('smarty_modifier_truncate_cn')) include 'D:\wamp\www\system\Smarty\plugins\modifier.truncate_cn.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\wamp\www\system\Smarty\plugins\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->getVariable('lang')->value['seo_title'];?>
</title>
<meta name="Keywords" content="<?php echo $_smarty_tpl->getVariable('lang')->value['seo_key'];?>
" />
<meta name="Description" content="<?php echo $_smarty_tpl->getVariable('lang')->value['seo_des'];?>
" />
<link href="<?php echo $_smarty_tpl->getVariable('css_path')->value;?>
css.css" type=text/css rel=stylesheet>
</head>

<body>
<?php $_template = new Smarty_Internal_Template("xdcms/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <!-- banner -->
    <div id="banner">
    <object id="bcastr4" data="uploadfile/flash.swf?xml=uploadfile/flash1.xml" type="application/x-shockwave-flash" width="944" height="369">
        <param name="movie" value="uploadfile/flash.swf?xml=uploadfile/flash1.xml" />
        <param name="wmode" value="transparent" />
    </object>
    </div>
    <!-- banner END -->
    <div id="body1">
        <!-- 公司简介 -->
        <div class="box1">
			<div class="tit1"><h1>企业简介<font>About Company</font></h1></div>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>8,'more'=>1,'rows'=>1)); $_block_repeat=true; smarty_block_loop(array('catid'=>8,'more'=>1,'rows'=>1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="box1_L">
               	<div class="box1_t"><img src="<?php echo thumb($_smarty_tpl->getVariable('r')->value['thumb'],211,144);?>
" width="211" height="144" /></div>
			</div>
            <div class="box1_R"><div class="box1_z"><?php echo smarty_modifier_truncate_cn(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->getVariable('r')->value['content']),170);?>
&nbsp; &nbsp;<a href="<?php echo caturl(8);?>
" style="color:#F00">详细>>></a></div></div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>8,'more'=>1,'rows'=>1), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <div class="Cle">&nbsp;</div>
        </div>
		<!-- 公司简介 END -->
		
		<!-- 公司新闻 -->
        <div class="box2">        
                <div class="tit2"><h1>企业动态<font>Company News</font></h1></div>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>10,'rows'=>5)); $_block_repeat=true; smarty_block_loop(array('catid'=>10,'rows'=>5), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li>
                	<div class="box2_L">
                    	<div class="box2_LL"><a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
" title="<?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
"><?php echo smarty_modifier_truncate_cn($_smarty_tpl->getVariable('r')->value['title'],15);?>
</a></div>
                    </div>
                    <div class="box2_R"><div><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('r')->value['inputtime'],'%Y/%m/%d');?>
</div></div>
                </li> 
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>10,'rows'=>5), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
         
               <div class="Cle">&nbsp;</div>
        </div>
		<!-- 公司新闻 END -->
        <div class="Cle">&nbsp;</div>
	</div>
    <div id="">&nbsp;</div>
    <div id="body1">
    <!-- 产品 -->
    <div class="box3">
    	<div class="tit3"><h1>产品展示<font>Show Products</font></h1></div>
        	<div class="box3_L2">
            <!--swf02-->
            <DIV id=demo style="OVERFLOW: hidden; WIDTH: 530px; HEIGHT: 174px">
            <TABLE cellPadding=0 align=left border=0 cellspace="0">
            <TBODY>
            	<TR>
                	<TD id=demo1 vAlign=top>
                    <TABLE cellSpacing=0 cellPadding=4 width=1566 border=0 id="tupian">
                    <TBODY>
                    <TR>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>3,'rows'=>10)); $_block_repeat=true; smarty_block_loop(array('catid'=>3,'rows'=>10), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <TD align=middle><a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
" title="<?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
"/><img alt="<?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
" src="<?php echo thumb($_smarty_tpl->getVariable('r')->value['thumb'],191,126);?>
"></A></TD>
                        <td width="10">&nbsp;</td>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>3,'rows'=>10), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </TR>
                    </TBODY>
                    </TABLE>
                    </TD>
            		<TD id=demo2 vAlign=top></TD>
            	</TR>
            </TBODY>
            </TABLE>
            </DIV>
            <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('js_path')->value;?>
product.js"></script>
            <!--//swf02-->
			</div>
            <div class="Cle">&nbsp;</div>
		</div>
	<!-- 产品 END -->
	
	<!-- 行业新闻 -->
        <div class="box2">
               <div class="tit4"><h1>行业新闻<font>Industry News</font></h1></div>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('catid'=>11,'rows'=>5)); $_block_repeat=true; smarty_block_loop(array('catid'=>11,'rows'=>5), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li>
                	<div class="box2_L">
                    	<div class="box2_LL"><a href="<?php echo $_smarty_tpl->getVariable('r')->value['url'];?>
" title="<?php echo $_smarty_tpl->getVariable('r')->value['title'];?>
"><?php echo smarty_modifier_truncate_cn($_smarty_tpl->getVariable('r')->value['title'],15);?>
</a></div>
                    </div>
                    <div class="box2_R"><div><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('r')->value['inputtime'],'%Y/%m/%d');?>
</div></div>
                </li> 
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('catid'=>11,'rows'=>5), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
  
               <div class="Cle">&nbsp;</div>
        </div>
		<!-- 行业新闻 END -->
        <div class="Cle">&nbsp;</div>       
  </div>
<?php $_template = new Smarty_Internal_Template("xdcms/footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
</body>
</html>
