<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 21:52:40
         compiled from "D:\wamp\www\guoxun\system/templates/admin/content_add.html" */ ?>
<?php /*%%SmartyHeaderCode:8276558964a8dcd305-40272786%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd87a0a4e6538c07453f8a3e8b8c49de5e6896cc9' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/content_add.html',
      1 => 1435067551,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8276558964a8dcd305-40272786',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\wamp\www\guoxun\system\Smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<script charset="utf-8" src="admin/editor/kindeditor.js"></script>
<script charset="utf-8" src="admin/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="admin/editor/plugins/code/prettify.js"></script>

<script type="text/javascript" src="admin/My97DatePicker/WdatePicker.js"></script>
<h1 class="xdcms_search_title"><div id="open_search"></div>搜索</h1>
<div class="line"></div>
<div id="XDcms_search">
<form name="form1" action="index.php?m=xdcms&c=content&f=search" method="post">
	<dl>
    	<dd>请输入关键词：</dd>
        <dd><input name="key" type="text" class="key" /></dd>
        <dd><input name="submit" type="submit" value="马上搜索" class="submit ml20" /><input name="catid" type="hidden" value="<?php echo $_smarty_tpl->getVariable('catid')->value;?>
" /></dd>
    </dl>
</form>
</div>
<form name="addform" action="index.php?m=xdcms&c=content&f=add_save" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="2" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=content&catid=<?php echo $_smarty_tpl->getVariable('catid')->value;?>
"><?php echo $_smarty_tpl->getVariable('catname')->value;?>
</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=content&f=add&catid=<?php echo $_smarty_tpl->getVariable('catid')->value;?>
">发布内容</a></div><span>|</span><div class="title_nav_3"><a href="index.php?m=xdcms&c=transfer&catid=<?php echo $_smarty_tpl->getVariable('catid')->value;?>
">数据转移</a></div></th>
  </tr>
  <tr>
    <td width="15%" align="right">栏目名称：</td>
    <td><?php echo $_smarty_tpl->getVariable('catname')->value;?>
</td>
  </tr>
  <tr>
    <td align="right">标题：</td>
    <td><input type="text" name="title" class="txt" size="45" id="title">
      <select name="title_color" id="title_color" class="selects">
        <option value="">颜色</option>
        <option value="c1" class="bg1"></option>
        <option value="c2" class="bg2"></option>
        <option value="c3" class="bg3"></option>
        <option value="c4" class="bg4"></option>
        <option value="c5" class="bg5"></option>
        <option value="c6" class="bg6"></option>
        <option value="c7" class="bg7"></option>
        <option value="c8" class="bg8"></option>
        <option value="c9" class="bg9"></option>
      </select>
      <input name="title_weight" type="checkbox" id="title_weight" value="tb" />加粗</td>
  </tr>
  <tr>
    <td align="right">是否推荐：</td>
    <td><input name="commend" type="radio" id="commend" value="1"/> 是 <input name="commend" type="radio" id="commend" value="0" checked="checked" /> 否</td>
  </tr>
  <tr>
    <td align="right">作者：</td>
    <td><input type="text" name="username" class="txt" size="10" id="username" value="<?php echo $_smarty_tpl->getVariable('adminuser')->value;?>
"></td>
  </tr>
  <tr>
    <td align="right">缩略图：</td>
    <td><input type="text" name="thumb" id="thumb" class="txt" size="25" value=""> <a href="#" onclick="javascript:ShowIframe(400,115,'上传缩略图！','system/function/upload.inc.php?filename=thumb')">上 传</a></td>
  </tr>
  <tr>
    <td align="right">关键词：</td>
    <td><input type="text" name="keywords" class="txt" size="40" id="keywords"> <span>注：关键词之间请用英文逗号","间隔</span></td>
  </tr>
  <tr>
    <td align="right">摘要：</td>
    <td><textarea name="description" id="description" cols="50" rows="4" class="textarea"></textarea></td>
  </tr>
  <?php echo $_smarty_tpl->getVariable('fields')->value;?>

  <tr>
    <td align="right">发布时间：</td>
    <td><input type="text" name="updatetime" class="txt" size="20" id="updatetime" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S');?>
"></td>
  </tr>
  
  <tr>
    <td align="right">显示时间：</td>
    <td><input type="text" name="showtime" class="txt" size="20" onClick="WdatePicker()" id="d11" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S');?>
"></td>
   
  </tr>
  <tr>
    <td align="right">外部链接：</td>
    <td><input type="text" name="url" class="txt" size="30" id="url" value=""> *不做外部链接请留空</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="hidden" name="catid" id="catid" value="<?php echo $_smarty_tpl->getVariable('catid')->value;?>
" />
      <input type="submit" name="submit" value="确认保存" class="submit" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
