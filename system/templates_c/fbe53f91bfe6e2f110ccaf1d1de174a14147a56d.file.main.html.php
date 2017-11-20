<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:43:37
         compiled from "D:\wamp\www\system/templates/admin/main.html" */ ?>
<?php /*%%SmartyHeaderCode:298345282d949bacb69-72322089%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbe53f91bfe6e2f110ccaf1d1de174a14147a56d' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/main.html',
      1 => 1384307014,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298345282d949bacb69-72322089',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\wamp\www\system\Smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div class="xdcms_copy">
	<div class="weather"></div>
    <h5><?php echo $_smarty_tpl->getVariable('adminuser')->value;?>
 您好,欢迎使用网站管理系统</h5>
</div>
<div class="xdcms_index_log">服务器所在时间：<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('server')->value["time"],'%Y-%m-%d %H:%M:%S');?>
</div>
<ul class="quick">
	<li><a href="index.php?m=xdcms&c=creathtml&f=update_index"><img src="admin/images/quick_1.gif" /><br />生成首页</a></li>
    <li><a href="index.php?m=xdcms&c=language"><img src="admin/images/quick_2.gif" /><br />SEO设置</a></li>
    <li><a href="index.php?m=xdcms&c=category"><img src="admin/images/quick_3.gif" /><br />栏目管理</a></li>
    <li><a href="index.php?m=xdcms&c=setting"><img src="admin/images/quick_4.gif" /><br />网站设置</a></li>
    <li><a href="index.php?m=xdcms&c=data"><img src="admin/images/quick_5.gif" /><br />数据备份</a></li>
    <li><a href="index.php?m=xdcms&c=update_cache"><img src="admin/images/quick_6.gif" /><br />更新缓存</a></li>
</ul>
<div class="xdcms_manage_sumbit"><a href="index.php?m=xdcms&c=index&f=left&id=3" target="left">进入网站内容管理</a></div>
<div class="xdcms_manage_sumbit"><a href="http://www.iszzz.com/thread-300-1-1.html" target="_blank">学习管理视频教程</a></div>
<div class="clear"></div>
<ul class="xdcms_about">
</ul>
<div class="xdcms_data">
    <dl style="padding-top:20px;">
    	<dd>PHP程序版本：<?php echo $_smarty_tpl->getVariable('server')->value["version"];?>
</dd>
        <dd>Mysql版本：<?php echo $_smarty_tpl->getVariable('server')->value["mysql_version"];?>
</dd>
        <dd>最大上传限制：<?php echo $_smarty_tpl->getVariable('server')->value["upload"];?>
</dd>
    </dl>
</div>
<script src="<?php echo $_smarty_tpl->getVariable('notice')->value;?>
"></script>
</body>
</html>
