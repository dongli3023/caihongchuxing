<?php
session_start();
if(empty($_SESSION['admin'])){
	echo'not administrator';
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>上传文件</title> 
<link href="../../admin/css/upload.css" type=text/css rel=stylesheet>
</head> 
<body> 
<?php
require_once('../libs/upload.class.php');
require_once('../../cache/cache_sys/cache_set_upload.php');
$filename = $_GET["filename"];

if($_upload['isopen']!=1){
	print "<center>文件上传已关闭</center>"; 
	exit();
}

//判断上传是文件还是图片
$type=isset($_GET['type'])?(int)$_GET['type']:0;
if($type==1){
	$size=$_upload['filesize']*1000;
	$folder='file';
	$allowed=explode(",",$_upload['fileallowed']);
}else{
	$size=$_upload['imagesize']*1000;
	$folder='image';
	$allowed=explode(",",$_upload['imageallowed']);
}
$watermark=$_upload['watermark'];
$pos=$_upload['pos'];
$font=$_upload['font'];
$color=$_upload['color'];
$text=$_upload['text'];
$image=$_upload['image'];
$width=$_upload['width'];

//开始上传
if (isset($_GET["action"])){
	$goback = " <a href=javascript:history.back(-1)>返 回</a>";
	$upload = new upload($size,$folder);
    $upload->allowed_file_ext = $allowed;
	$upload->watermark=$watermark;
	$upload->watermark_pos=$pos;
	$upload->watermark_font=$font;
	$upload->watermark_color=$color;
	$upload->watermark_text=$text;
	$upload->watermark_image=$image;
	$upload->watermark_width=$width;
	$upload->upload_type=$type;
    $upload->upload_process();
    if ( $upload->error_no ){
        switch( $upload->error_no ){
            case 1:
                print "<center>没有文件被上传".$goback."</center>"; 
				exit();
            case 2:
            case 5:
                 print "<center>不支持此文件格式".$goback."</center>"; 
				 exit();
            case 3:
                 print "<center>文件超过上传大小".$goback."</center>"; 
				 exit();
            case 4:
                 print "<center>上传目录设置错误".$goback."</center>"; 
				 exit();
        }
     }
	echo("<script>window.top.main.document.getElementById('{$filename}').value='{$upload->saved_upload_name1}'</script>");
	echo("<center>上传成功</center>");
	exit;
}
?>
<table width="100%" border="0" align="center">
 <form id="form1" name="upload" enctype="multipart/form-data" method="post" action="?action=upload&type=<?php echo $type?>&filename=<?php echo $filename?>">  
 <tr>
    <td align="center">请选择文件：
      <input type="file" name="FILE_UPLOAD[]" class="input"/></td>
  </tr>
  <tr>
    <td align="center" class="p10"><input type="submit" name="Submit" value="确认上传" class="submit"/></td>
  </tr></form> 
</table>

</body> 
</html> 
