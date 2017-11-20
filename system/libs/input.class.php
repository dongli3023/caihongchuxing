<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * 表单字段类
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/
class input{
	
	//单行文本
	public function text($f_name,$f_value,$f_width){
		if($f_width==0) $f_width=25;
		$str="<input name=fields[{$f_name}] id=\"{$f_name}\" size=\"{$f_width}\" value=\"{$f_value}\" class=\"txt\" />";
		return $str;
	}
	
	//多行文本	
	public function textarea($f_name,$f_value='',$f_width,$f_height,$f_option){
		if($f_width==0) $f_width=45;
		if($f_height==0) $f_height=4;
		$str="<textarea name=\"fields[{$f_name}]\" id=\"{$f_name}\" cols=\"{$f_width}\" rows=\"{$f_height}\" class=\"textarea\">{$f_value}</textarea>";
		return $str;
	}
	
	//编辑器	
	/*
	public function editor($f_name,$f_value='',$f_width,$f_height,$f_option){
$str="<script>KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[id=\"{$f_name}\"]', {
				cssPath : '../plugins/code/prettify.css',
				uploadJson : 'admin/upload_json.php',
				fileManagerJson : 'admin/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
	prettyPrint();
});</script><textarea name=\"fields[{$f_name}]\" id=\"{$f_name}\" style=\"width:700px;height:300px;\">".html_decode($f_value)."</textarea>";
		return $str;
	}
	*/
	
	public function editor($f_name,$f_value='',$f_width,$f_height,$f_option){
	
	//echo $f_name;
	$str="<script>var ue = UE.getEditor('{$f_name}');</script><textarea name=\"fields[{$f_name}]\" id=\"{$f_name}\" style=\"width:700px;height:300px;\">".html_decode($f_value)."</textarea>";
		return $str;
	}
	
	//图片上传	
	public function image($f_name,$f_value,$f_width,$f_height,$f_option){
		$str="<input type=\"text\" name=\"fields[{$f_name}]\" id=\"fields[{$f_name}]\" class=\"txt\" size=\"25\" value=\"".html_decode($f_value)."\"> <a href=\"#\" onclick=\"javascript:ShowIframe('400','115','上传图片','system/function/upload.inc.php?filename=fields[{$f_name}]')\">上 传</a>";
		return $str;
	}
	
	//多图上传
	public function moreimage($f_name,$f_value,$f_width,$f_height,$f_option){
		$str = "";
		$str .= "<script>
		var attachfiles=1;
		function delrows()
		{
			//删除附件中的行
			if(attachfiles>1)
			{
				attachfiles--;
				attfile.deleteRow();
			}
		}
		  function addrows()
		{
			//给附件添加行
			attachfiles++;
			var mynewrow=attfile.insertRow();
			col1=mynewrow.insertCell(0);
			col2=mynewrow.insertCell(1);
			col3=mynewrow.insertCell(2);
		
			if(attachfiles<=20){
				col1.innerHTML=\"<td></td>\";
				col2.innerHTML=\"<td colspan=3><input type=file name=morefile[] size=35></td>\";
			}
			if(attachfiles>20)
			{        alert(\"最多只能上传20个图片！\"); }
		}";
		$str .= "</script>";
		$str .= "<table id=\"attfile\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		if(!empty($f_value)){
			$value_arr=unserialize($f_value);
			if(is_array($value_arr)&&!empty($value_arr)){
				foreach($value_arr as $v){
					$str .= "<tr>
						<td colspan=4><input type=\"text\" name=\"fields[{$f_name}][]\" size=\"45\" value=\"".html_decode($v)."\"></td>
					  </tr>";
				}
			}
		}
		$str .= "<tr>
            <td><input type=\"hidden\" name=\"uploadtype\" id=\"uploadtype\" value=\"{$f_name}\" /></td>
            <td align=\"left\"><input type=\"file\" name=\"morefile[]\" size=\"35\"></td>
            <td align=\"left\">&nbsp;&nbsp;[<a href=\"javascript:delrows();\">删除</a>] [<a href=\"javascript:addrows();\">继续增加</a>]</td>
          </tr>";
        $str .= "</table>";
		return $str;
	}
	
	//附件上传	
	public function files($f_name,$f_value,$f_width,$f_height,$f_option){
		$str="<input type=\"text\" name=\"fields[{$f_name}]\" id=\"fields[{$f_name}]\" class=\"txt\" size=\"25\" value=\"".html_decode($f_value)."\"> <a href=\"#\" onclick=\"javascript:ShowIframe('400','115','上传文件!','system/function/upload.inc.php?type=1&filename=fields[{$f_name}]')\">上 传</a>";
		return $str;
	}
	
	//下拉列表	
	public function option($f_name,$f_value='',$f_width,$f_height,$f_option){
		if(!empty($f_option)){
			$value=preg_split('/,/',$f_option);
		
			$str="<select id=\"{$f_name}\" name=\"fields[{$f_name}]\">";
			foreach($value as $key=>$val){
				$ck='';
				if($f_value==$val){$ck="selected=\"selected\"";}
				$str.="<option value=\"{$val}\" {$ck}>{$val}</option>";
			}
			$str.="</select>";
		}
		return $str;
	}
	
	//单选	
	public function radio($f_name,$f_value='',$f_width,$f_height,$f_option){
		$str='';
		if(!empty($f_option)){
			$value=preg_split('/,/',$f_option);
			foreach($value as $key=>$val){
				$ck="";
				if($key==0){$ck="checked=\"checked\"";}
				if($f_value==$val){$ck="checked=\"checked\"";}
				$str.="<input type=\"radio\" value=\"{$val}\" name=\"fields[{$f_name}]\" {$ck}/> {$val} ";
			}
		}
		return $str;
	}
	
	//多选	
	public function checkbox($f_name,$f_value='',$f_width,$f_height,$f_option){
		if(!empty($f_option)){
			$value=preg_split('/,/',$f_option);
			$e=preg_split('/,/',$f_value);
			foreach($value as $key=>$val){
				$ck="";
				if(in_array($val,$e)){$ck="checked=\"checked\"";}
				$str.="<input type=\"checkbox\" value=\"{$val}\" name=\"fields[{$f_name}][]\" {$ck}/> {$val} ";
			}
		}
		return $str;
	}
}
?>