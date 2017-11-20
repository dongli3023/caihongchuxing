<?php /* Smarty version Smarty-3.0.8, created on 2013-11-13 09:28:05
         compiled from "D:\wamp\www\system/templates/admin/setting.html" */ ?>
<?php /*%%SmartyHeaderCode:195385282d5a55d76d9-27012172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35117854309ef44a1ce7d65246e0ba60964cc8cb' => 
    array (
      0 => 'D:\\wamp\\www\\system/templates/admin/setting.html',
      1 => 1358492056,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195385282d5a55d76d9-27012172',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">网站基本信息配置</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=xdcms&c=setting&f=save" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=setting">基本设置</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=setting&f=cache">更新缓存</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <td align="right">网站地址：</td>
    <td colspan="3"><input type="text" name="siteurl" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('cfg')->value['siteurl'];?>
">
    如http://www.xdcms.cn/ <font color="#FF0000">（注:必须带"/"）</font></td>
  </tr>
  <tr>
    <td align="right">默认模板：</td>
    <td colspan="3"><select name="template" id="template">
    	<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('template')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->getVariable('cfg')->value['template']==$_smarty_tpl->tpl_vars['value']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
        <?php }} ?>
            </select></td>
  </tr>
  <tr>
    <td align="right">开启模板缓存：</td>
    <td colspan="3">
      <input type="radio" name="caching" id="caching" value="true" <?php if ($_smarty_tpl->getVariable('cfg')->value['caching']=='true'){?>checked="checked"<?php }?> class="checkbox"/>
      是 
      <input name="caching" type="radio" id="caching" value="false" <?php if ($_smarty_tpl->getVariable('cfg')->value['caching']=='false'){?>checked="checked"<?php }?> class="checkbox" />
      否</td>
  </tr>
  <tr>
    <td align="right">全站是否静态优化：</td>
    <td colspan="3"><input name="createhtml" type=radio class="checkbox" value="0" <?php if ($_smarty_tpl->getVariable('cfg')->value['createhtml']==0){?>checked<?php }?>> 
          不启用模拟静态及生成
<br>
            <input name="createhtml" type=radio class="checkbox"   value="1" <?php if ($_smarty_tpl->getVariable('cfg')->value['createhtml']==1){?>checked<?php }?>>
开启生成HTML静态页面<br>
<input name="createhtml" type=radio class="checkbox"   value="2" <?php if ($_smarty_tpl->getVariable('cfg')->value['createhtml']==2){?>checked<?php }?>>
开启模拟静态化</span></td>
  </tr>
  <tr>
    <td align="right">Cookie密钥：</td>
    <td colspan="3"><input type="text" name="cookie" class="txt" size="10" value="<?php echo $_smarty_tpl->getVariable('cfg')->value['cookie'];?>
"></td>
  </tr>
  <tr>
    <td align="right">网站LOGO地址：</td>
    <td colspan="3"><input type="text" name="logourl" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('cfg')->value['logourl'];?>
"> <a href="#" onclick="javascript:ShowIframe(400,115,'上传缩略图！','system/function/upload.inc.php?filename=logourl')">上 传</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="确认保存" class="submit" /><input name="tag" type="hidden" id="tag" value="config" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
