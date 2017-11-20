<?php /* Smarty version Smarty-3.0.8, created on 2015-06-23 22:13:40
         compiled from "D:\wamp\www\guoxun\system/templates/admin/upload.html" */ ?>
<?php /*%%SmartyHeaderCode:2738555896994cd7b36-88824226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6350cca624d4403d3306c5f8fe91676550f6251e' => 
    array (
      0 => 'D:\\wamp\\www\\guoxun\\system/templates/admin/upload.html',
      1 => 1425347763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2738555896994cd7b36-88824226',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("admin/header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1 class="xdcms_search_title">文件上传配置</h1>
<div class="line"></div>
<form name="addform" action="index.php?m=xdcms&c=setting&f=save" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xdcms_add_table">
  <tr>
    <th colspan="7" class="title"><div class="title_nav_1"><a href="index.php?m=xdcms&c=setting">基本设置</a></div><span>|</span><div class="title_nav_2"><a href="index.php?m=xdcms&c=setting&f=cache">更新缓存</a></div><span>|</span><div class="title_nav_3"><a href="javascript:location.reload()">刷新页面</a></div></th>
  </tr>
  <tr>
    <td align="right">开启上传文件：</td>
    <td colspan="3"><input name="isopen" type=radio class="checkbox" value="1" <?php if ($_smarty_tpl->getVariable('upload')->value['isopen']==1){?>checked="checked"<?php }?>> 是 <input name="isopen" type=radio class="checkbox" value="0" <?php if ($_smarty_tpl->getVariable('upload')->value['isopen']==0){?>checked="checked"<?php }?>> 
    否</td>
  </tr>
  <tr>
    <td align="right">图片上传大小限制：</td>
    <td colspan="3"><input type="text" name="imagesize" class="txt" size="10" value="<?php echo $_smarty_tpl->getVariable('upload')->value['imagesize'];?>
"> KB</td>
  </tr>
  <tr>
    <td align="right">图片上传格式限制：</td>
    <td colspan="3"><input type="text" name="imageallowed" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('upload')->value['imageallowed'];?>
"> <span>注：请以英文逗号","间隔</span></td>
  </tr>
  <tr>
    <td align="right">文件上传大小限制：</td>
    <td colspan="3"><input type="text" name="filesize" class="txt" size="10" value="<?php echo $_smarty_tpl->getVariable('upload')->value['filesize'];?>
"> KB</td>
  </tr>
  <tr>
    <td align="right">文件上传格式限制：</td>
    <td colspan="3"><input type="text" name="fileallowed" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('upload')->value['fileallowed'];?>
"> <span>注：请以英文逗号","间隔</span></td>
  </tr>
<!--  <tr>
    <td align="right">文件保存目录:</td>
    <td colspan="3"><input type="text" name="folder" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('upload')->value['folder'];?>
"></td>
  </tr>-->  
  <tr>
    <th colspan="4" style="padding-left:5px;">水印设置</th>
  </tr>
  <tr>
    <td align="right">水印类型：</td>
    <td colspan="3"><input name="watermark" type=radio class="checkbox" value="1" <?php if ($_smarty_tpl->getVariable('upload')->value['watermark']==1){?>checked="checked"<?php }?>> 图片水印 <input name="watermark" type=radio class="checkbox" value="2" <?php if ($_smarty_tpl->getVariable('upload')->value['watermark']==2){?>checked="checked"<?php }?>> 文字水印 <input name="watermark" type=radio class="checkbox" value="100" <?php if ($_smarty_tpl->getVariable('upload')->value['watermark']==100){?>checked="checked"<?php }?>> 关闭水印</td>
  </tr>
  <tr>
    <td align="right">水印位置:</td>
    <td colspan="3">
      <select name="pos" id="pos">
        <option value="0" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==0){?>selected="selected"<?php }?>>随机</option>
        <option value="1" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==1){?>selected="selected"<?php }?>>顶端居左</option>
        <option value="2" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==2){?>selected="selected"<?php }?>>顶端居中</option>
        <option value="3" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==3){?>selected="selected"<?php }?>>顶端居右</option>
        <option value="4" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==4){?>selected="selected"<?php }?>>中部居左</option>
        <option value="5" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==5){?>selected="selected"<?php }?>>中部居中</option>
        <option value="6" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==6){?>selected="selected"<?php }?>>中部居右</option>
        <option value="7" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==7){?>selected="selected"<?php }?>>底端居左</option>
        <option value="8" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==8){?>selected="selected"<?php }?>>底端居中</option>
        <option value="9" <?php if ($_smarty_tpl->getVariable('upload')->value['pos']==9){?>selected="selected"<?php }?>>底端居右</option>
      </select></td>
  </tr>
  <tr>
    <td align="right">水印字体大小:</td>
    <td colspan="3">
      <select name="font" id="font">
        <option value="1" <?php if ($_smarty_tpl->getVariable('upload')->value['font']==1){?>selected="selected"<?php }?>>一号</option>
        <option value="2" <?php if ($_smarty_tpl->getVariable('upload')->value['font']==2){?>selected="selected"<?php }?>>二号</option>
        <option value="3" <?php if ($_smarty_tpl->getVariable('upload')->value['font']==3){?>selected="selected"<?php }?>>三号</option>
        <option value="4" <?php if ($_smarty_tpl->getVariable('upload')->value['font']==4){?>selected="selected"<?php }?>>四号</option>
        <option value="5" <?php if ($_smarty_tpl->getVariable('upload')->value['font']==5){?>selected="selected"<?php }?>>五号</option>
      </select></td>
  </tr>
  <tr>
    <td align="right">水印图片最小宽度:</td>
    <td colspan="3"><input type="text" name="width" class="txt" size="10" value="<?php echo $_smarty_tpl->getVariable('upload')->value['width'];?>
"> PX <span>注：小于此宽度则不添加水印</span></td>
  </tr>
  <tr>
    <td align="right">水印字体颜色:</td>
    <td colspan="3"><input type="text" name="color" class="txt" size="10" value="<?php echo $_smarty_tpl->getVariable('upload')->value['color'];?>
"></td>
  </tr>
  <tr>
    <td align="right">水印文字:</td>
    <td colspan="3"><input type="text" name="text" class="txt" size="20" value="<?php echo $_smarty_tpl->getVariable('upload')->value['text'];?>
"></td>
  </tr>
  <tr>
    <td align="right">水印图片:</td>
    <td colspan="3"><input type="text" name="image" class="txt" size="30" value="<?php echo $_smarty_tpl->getVariable('upload')->value['image'];?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="确认保存" class="submit" /><input name="tag" type="hidden" id="tag" value="upload" /></td>
  </tr>
</table>
</form>
<div class="xdcms_bottom"></div>
</body>
</html>
