<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:21:27
         compiled from "D:\wamp\www\system/templates/admin/category_add.html" */ ?>
<?php /*%%SmartyHeaderCode:323155282d417eb26a3-38413120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8304c9a4ad291fd58369d5e3a3524a46ec8518f' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/category_add.html',
      1 => 1365651454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '323155282d417eb26a3-38413120',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_loop')) include 'D:\wamp\www\system\Smarty\plugins\block.loop.php';
?><?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">栏目管理</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=xdcms&c=category&f=add_save" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=category">管理首页</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=category&f=add">添加栏目</a></div><span>|</span><div class="title_nav_3"><a href="index.php?m=xdcms&c=category&f=cache">更新缓存</a></div></th>
  </tr>
  <tr>
    <td width="14%" align="right">上级栏目:</td>
    <td width="86%" colspan="3"><label>
      <select name="parentid" id="parentid">
        <option value="<?php echo $_smarty_tpl->getVariable('parentid')->value;?>
"><?php if ($_smarty_tpl->getVariable('parentname')->value==''){?>无(作为一级栏目)<?php }else{ ?><?php echo $_smarty_tpl->getVariable('parentname')->value;?>
<?php }?></option>
        <?php echo $_smarty_tpl->getVariable('categorylist')->value;?>

      </select>
    </label></td>
  </tr>
  <tr>
    <td align="right">栏目名称:</td>
    <td colspan="3"><input type="text" name="catname" class="txt" size="30" id="catname"></td>
  </tr>
  <tr>
    <td align="right">栏目目录:</td>
    <td colspan="3"><input type="text" name="catdir" class="txt" size="15" id="catdir"> 注:必须为字母或字母+数字</td>
  </tr>
  <tr>
    <td align="right">栏目图片:</td>
    <td colspan="3"><input type="text" name="thumb" id="thumb" class="txt" size="30"> <a href="#" onclick="javascript:ShowIframe(400,115,'上传缩略图！','system/function/upload.inc.php?filename=thumb')">上 传</a></td>
  </tr>
  <tr>
    <td align="right">内容模型:</td>
    <td colspan="3"><select name="model" id="model" onChange="get_model(this.value)">
    <option value="">请选择模型</option>
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('model')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['model_table'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['model_name'];?>
</option>
    <?php }} ?>
      </select></td>
  </tr>
  <tr>
    <td align="right">语言:</td>
    <td colspan="3"><select name="lang" id="lang">
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</option>
    <?php }} ?>
      </select></td>
  </tr>
  
  <tr>
    <th colspan="4" style="padding-left:5px;">更多选项[<a href="###" onclick="openShutManager(this,'box4',false,'关闭','展开')" >展开</a>]</th>
  </tr>
  </table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="box4" style="display:none" class="xdcms_add_table xdcms_cate_add_table">
  <tr>
    <td width="14%" align="right">列表页每页数据条数:</td>
    <td width="86%" colspan="3"><input type="text" name="pagesize" class="txt" size="6" id="pagesize" value="20"> 注：设置该栏目列表页每页所显示的数据条数</td>
  </tr>
  <tr>
    <td align="right">外部链接:</td>
    <td colspan="3">
      <select name="is_link" id="is_link" onChange="islink(this.value)" class="fl">
        <option value="0">否</option>
        <option value="1">是</option>
      </select> <div id="text_show" style="display:none;">链接地址：<input type="text" name="url" class="txt" size="20" id="url"> * 请填写完整路径，如：http://www.iszzz.com</div></td>
  </tr>
  <tr>
    <td align="right">栏目排序:</td>
    <td colspan="3"><input type="text" name="sort" class="txt" size="6" id="sort" value="0"></td>
  </tr>
  <tr>
    <td align="right">是否导航显示:</td>
    <td colspan="3">
      <input name="is_show" type="radio" id="is_show" value="1" checked="checked" class="checkbox" />
      是 
      <input name="is_show" type="radio" id="is_show" value="0" class="checkbox" />
      否</td>
  </tr>
  
  <tr>
    <td align="right">是否新窗口打开:</td>
    <td colspan="3">
      <input name="is_target" type="radio" id="is_target" value="1" class="checkbox" />
      是 
      <input name="is_target" type="radio" id="is_target" value="0" checked="checked" class="checkbox" />
      否</td>
  </tr>
  <tr>
    <td align="right">栏目静态设置:</td>
    <td colspan="3">
      <input name="is_html" type="radio" id="is_html" value="0" <?php if ($_smarty_tpl->getVariable('url_arr')->value[0]==0){?>checked="checked"<?php }?> class="checkbox" onClick="get_url(this.value)" />
      动态
      <input name="is_html" type="radio" id="is_html" value="1" <?php if ($_smarty_tpl->getVariable('url_arr')->value[0]==1){?>checked="checked"<?php }?> class="checkbox" onClick="get_url(this.value)" />
      静态
      <input name="is_html" type="radio" id="is_html" value="2" <?php if ($_smarty_tpl->getVariable('url_arr')->value[0]==2){?>checked="checked"<?php }?> class="checkbox" onClick="get_url(this.value)" />
      伪静态       </td>
  </tr>
  <tr>
    <td align="right">栏目页模板:</td>
    <td colspan="3">
      <select name="template_cate">
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('template_cate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
        <?php }} ?>
      </select> 注：选择与模型名称相对应的模板，如新闻(news)则选择category_news.html</td>
  </tr>
  <tr>
    <td align="right">列表页模板:</td>
    <td colspan="3">
      <select name="template_list">
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('template_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
        <?php }} ?>
      </select> 注：选择与模型名称相对应的模板，如新闻(news)则选择list_news.html</td>
  </tr>
  <tr>
    <td align="right">内容页模板:</td>
    <td colspan="3">
      <select name="template_show">
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('template_show')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
        <?php }} ?>
      </select> 注：选择如新闻(news)则选择show_news.html</td>
  </tr>
  <tr>
    <td align="right">列表页url规则_<?php echo $_smarty_tpl->getVariable('url_arr')->value[1];?>
:</td>
    <td colspan="3">
      <select name="url_list">
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('url_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" <?php if ($_smarty_tpl->getVariable('url_arr')->value[1]==$_smarty_tpl->tpl_vars['value']->value['id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value['urldemo'];?>
</option>
        <?php }} ?>
      </select></td>
  </tr>
  <tr>
    <td align="right">内容页url规则:</td>
    <td colspan="3">
      <select name="url_show">
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('url_show')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" <?php if ($_smarty_tpl->getVariable('url_arr')->value[2]==$_smarty_tpl->tpl_vars['value']->value['id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value['urldemo'];?>
</option>
        <?php }} ?>
      </select></td>
  </tr>
  <tr>
    <td align="right">SEO标题:</td>
    <td colspan="3"><input type="text" name="seo_title" class="txt" size="30"></td>
  </tr>
  <tr>
    <td align="right">SEO关键字:</td>
    <td colspan="3"><input type="text" name="seo_key" class="txt" size="45"></td>
  </tr>
  <tr>
    <td align="right">SEO描述:</td>
    <td colspan="3"><textarea name="seo_des" cols="45" rows="5"></textarea></td>
  </tr>  
  <tr>
    <th colspan="4" style="padding-left:5px;">权限设置 <b>[注：如不限制请留空]</b></th>
  </tr>
  <tr>
    <td align="right">前台访问:</td>
    <td colspan="3"><input name="power[member_0]" type="checkbox" value="1" />游客 <?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"member_group")); $_block_repeat=true; smarty_block_loop(array('module'=>"member_group"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<input name="power[member_<?php echo $_smarty_tpl->getVariable('r')->value['groupid'];?>
]" type="checkbox" value="1" /><?php echo $_smarty_tpl->getVariable('r')->value['name'];?>
 <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"member_group"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
  </tr>
  <tr>
    <td align="right">后台管理:</td>
    <td colspan="3"><?php $_smarty_tpl->smarty->_tag_stack[] = array('loop', array('module'=>"admin_group")); $_block_repeat=true; smarty_block_loop(array('module'=>"admin_group"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<input name="power[admin_<?php echo $_smarty_tpl->getVariable('r')->value['groupid'];?>
]" type="checkbox" value="1" /><?php echo $_smarty_tpl->getVariable('r')->value['name'];?>
 <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_loop(array('module'=>"admin_group"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
  </tr>
  </table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="xdcms_add_table xdcms_cate_add_table" >
  <tr>
    <td align="right" width="14%">&nbsp;</td>
    <td><input type="submit" name="submit" value="确认添加" class="submit" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
