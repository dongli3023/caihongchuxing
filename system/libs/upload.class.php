<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * upload上传类
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/
class upload
{
	var $upload_form_field = 'FILE_UPLOAD';
	var $out_file_name    = '';
	var $out_file_dir     = './';
	var $out_save_dir     = '../../';
	var $max_file_size    = 0;
	var $make_script_safe = 1;
	var $force_data_ext   = '';
	var $allowed_file_ext = array();
	var $image_ext        = array( 'gif', 'jpeg', 'jpg', 'jpe', 'png' );
	var $image_check      = 1;
	var $file_extension   = '';
	var $real_file_extension = '';
	var $error_no         = 0;
	var $is_image         = 0;
	var $original_file_name = "";
	var $parsed_file_name = "";
	var $saved_upload_name = "";
	var $upload_folder    = "";
	var $save_array       = "";
	var $watermark        = "";
	var $watermark_pos    = "";
	var $watermark_font   = "";
	var $watermark_color  = "";
	var $watermark_text   = "";
	var $watermark_image  = "";
	var $watermark_width  = "";
	var $upload_type      = "";
	
	function __construct($size,$folder){
		$this->max_file_size  = $size;
		$this->upload_folder  = $folder;
	}
	
	public function upload_process(){
		$num=count($_FILES[ $this->upload_form_field ]['name']);
		for($key=0;$key<$num;$key++){
			$this->_clean_paths();
			//创建存储路径
			$save_path=$this->out_save_dir."uploadfile/".$this->upload_folder."/";
			if (!file_exists($save_path)) {
				mkdir($save_path);
			}
			$ymd = date("Ymd");
			$save_path .= $ymd;
			if (!file_exists($save_path)) {
				mkdir($save_path);
			}
			$this->out_file_dir = $save_path;
	
			//开始获取上传的文件
			if ( ! function_exists( 'getimagesize' ) ){
				$this->image_check = 0;
			}
	
			$FILE_NAME = isset($_FILES[ $this->upload_form_field ]['name'][$key]) ? $_FILES[ $this->upload_form_field ]['name'][$key] : '';
			$FILE_SIZE = isset($_FILES[ $this->upload_form_field ]['size'][$key]) ? $_FILES[ $this->upload_form_field ]['size'][$key] : '';
			$FILE_TYPE = isset($_FILES[ $this->upload_form_field ]['type'][$key]) ? $_FILES[ $this->upload_form_field ]['type'][$key] : '';
			$FILE_TYPE = preg_replace( "/^(.+?);.*$/", "\\1", $FILE_TYPE );
			
			//判断错误类型
			if ( !isset($_FILES[ $this->upload_form_field ]['name'][$key])
			or $_FILES[ $this->upload_form_field ]['name'][$key] == ""
			or !$_FILES[ $this->upload_form_field ]['name'][$key]
			or !$_FILES[ $this->upload_form_field ]['size'][$key]
			or ($_FILES[ $this->upload_form_field ]['name'][$key] == "none") )
			{
				$this->error_no = 1;
				return;
			}
			
			if( !is_uploaded_file($_FILES[ $this->upload_form_field ]['tmp_name'][$key]) ){
				$this->error_no = 1;
				return;
			}
	
			if ( ! is_array( $this->allowed_file_ext ) or ! count( $this->allowed_file_ext ) ){
				$this->error_no = 2;
				return;
			}
	
			$this->file_extension = $this->_get_file_extension($FILE_NAME );
			
			if ( ! $this->file_extension ){
				$this->error_no = 2;
				return;
			}
			
			$this->real_file_extension = $this->file_extension;
			
			if ( ! in_array( $this->file_extension, $this->allowed_file_ext ) ){
				$this->error_no = 2;
				return;
			}
			
			if ( ( $this->max_file_size ) and ( $FILE_SIZE > $this->max_file_size ) ){
				$this->error_no = 3;
				return;
			}
			
			//文件改名
			$this->sj = date("Ymdhis");
			$this->namenn =$this->sj.substr($_FILES[ $this->upload_form_field ]['name'][$key],strrpos($_FILES[ $this->upload_form_field ]['name'][$key],".")); 
			$FILE_NAME = preg_replace( "/[^\w\.]/", "_", strtolower($this->namenn)); // strtolower() 大小写转换
		
			$this->original_file_name = $FILE_NAME;
	
			if ( $this->out_file_name ){
				$this->parsed_file_name = $this->out_file_name;
			}
			else{
				$this->parsed_file_name = str_replace( '.'.$this->file_extension, "", $FILE_NAME );
			}
	
			$renamed = 0;
			
			if ( $this->make_script_safe ){
				if ( preg_match( "/\.(cgi|pl|js|asp|php|html|htm|jsp|jar)(\.|$)/i", $FILE_NAME ) ){
					$FILE_TYPE                 = 'text/plain';
					$this->file_extension      = 'txt';
					$this->parsed_file_name	   = preg_replace( "/\.(cgi|pl|js|asp|php|html|htm|jsp|jar)(\.|$)/i", "$2", $this->parsed_file_name );
					
					$renamed = 1;
				}
			}
	
			if ( is_array( $this->image_ext ) and count( $this->image_ext ) ){
				if ( in_array( $this->file_extension, $this->image_ext ) ){
					$this->is_image = 1;
				}
			}
			
			if ( $this->force_data_ext and ! $this->is_image ){
				$this->file_extension = str_replace( ".", "", $this->force_data_ext ); 
			}
			
			$this->parsed_file_name .= $key.'.'.$this->file_extension;
	
			$this->saved_upload_name = $this->out_file_dir.'/'.$this->parsed_file_name;
			$this->save_array .= $this->out_file_dir.'/'.$this->parsed_file_name.",";
			if($this->out_save_dir=="../../"){
				$this->saved_upload_name1 =$this->replace_url($this->out_file_dir).'/'.$this->parsed_file_name;
			}
			if ( ! @move_uploaded_file( $_FILES[ $this->upload_form_field ]['tmp_name'][$key], $this->saved_upload_name) ){
				$this->error_no = 4;
				return;
			}
			else{
				@chmod( $this->saved_upload_name, 0777 );
			}
			
			if( !$renamed ){
				$this->check_xss_infile();
				
				if( $this->error_no ){
					return;
				}
			}
	
			if ( $this->is_image ){
				if ( $this->image_check ){
					$img_attributes = @getimagesize( $this->saved_upload_name );
					
					if ( ! is_array( $img_attributes ) or ! count( $img_attributes ) ){
						@unlink( $this->saved_upload_name );
						$this->error_no = 5;
						return;
					}
					else if ( ! $img_attributes[2] ){
						@unlink( $this->saved_upload_name );
						$this->error_no = 5;
						return;
					}
					else if ( $img_attributes[2] == 1 AND ( $this->file_extension == 'jpg' OR $this->file_extension == 'jpeg' ) ){
						@unlink( $this->saved_upload_name );
						$this->error_no = 5;
						return;
					}
				}
			}
			
			if( filesize($this->saved_upload_name) != $_FILES[ $this->upload_form_field ]['size'][$key] ){
				@unlink( $this->saved_upload_name );
				$this->error_no = 1;
				return;
			}
			
			//加水印
			if($this->upload_type!=1){
				if($this->watermark==1){
					$this->imageWaterMark($this->saved_upload_name,$this->watermark_pos,$this->out_save_dir.$this->watermark_image);
				}elseif($this->watermark==2){
					$this->imageWaterMark($this->saved_upload_name,$this->watermark_pos,"",$this->watermark_text,$this->watermark_font,$this->watermark_color);
				}
			}
		}
	}
	
	private function replace_url($str){
		$str = str_replace( "../", "",$str);
		return $str;  
	}

	private function check_xss_infile(){
		$fh = fopen( $this->saved_upload_name, 'rb' );
		$file_check = fread( $fh, 512 );
		fclose( $fh );
		if( !$file_check ){
			@unlink( $this->saved_upload_name );
			$this->error_no = 5;
			return;
		}
		else if( preg_match( "#<script|<html|<head|<title|<body|<pre|<table|<a\s+href|<img|<plaintext#si", $file_check ) ){
			@unlink( $this->saved_upload_name );
			$this->error_no = 5;
			return;
		}
	}
	
	//图片水印
	private function imageWaterMark($groundImage,$waterPos=0,$waterImage="",$waterText="",$textFont=5,$textColor="#FF0000"){
		$isWaterImage = FALSE;
		$formatMsg = "暂不支持该文件格式,请用图片处理软件将图片转换为GIF、JPG、PNG格式.";
		//读取水印文件
		if(!empty($waterImage) && file_exists($waterImage)){
			$isWaterImage = TRUE;
			$water_info = getimagesize($waterImage);
			$water_w = $water_info[0];//取得水印图片的宽
			$water_h = $water_info[1];//取得水印图片的高
			switch($water_info[2]){
				case 1:$water_im = imagecreatefromgif($waterImage);break;
				case 2:$water_im = imagecreatefromjpeg($waterImage);break;
				case 3:$water_im = imagecreatefrompng($waterImage);break;
				default:die($formatMsg);
			}
		}
		//读取背景图片
		if(!empty($groundImage) && file_exists($groundImage)){
			$ground_info = getimagesize($groundImage);
			$ground_w = $ground_info[0];//取得背景图片的宽
			$ground_h = $ground_info[1];//取得背景图片的高
			switch($ground_info[2]){
				case 1:$ground_im = imagecreatefromgif($groundImage);break;
				case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
				case 3:$ground_im = imagecreatefrompng($groundImage);break;
				default:die($formatMsg);
			}
		}else{
			die("需要加水印的图片不存在!");
		}
		//水印位置
		if($isWaterImage){
			$w = $water_w;
			$h = $water_h;
			$label = "图片的";
		}else{
			$temp = imagettfbbox(ceil($textFont*5.5),0,$this->out_save_dir."data/font/elephant.ttf",$waterText);
			$w = $temp[2] - $temp[6];
			$h = $temp[3] - $temp[7];
			unset($temp);
			$label = "文字区域";
		}
		if( ($ground_w<$w) || ($ground_h<$h) ){
			return;
		}
		switch($waterPos){
			case 0://随机
				$posX = rand(0,($ground_w - $w));
				$posY = rand(0,($ground_h - $h));
				break;
			case 1://1为顶端居左
				$posX = 0;
				$posY = 0;
				break;
			case 2://2为顶端居中
				$posX = ($ground_w - $w) / 2;
				$posY = 0;
				break;
			case 3://3为顶端居右
				$posX = $ground_w - $w;
				$posY = 0;
				break;
			case 4://4为中部居左
				$posX = 0;
				$posY = ($ground_h - $h) / 2;
				break;
			case 5://5为中部居中
				$posX = ($ground_w - $w) / 2;
				$posY = ($ground_h - $h) / 2;
				break;
			case 6://6为中部居右
				$posX = $ground_w - $w;
				$posY = ($ground_h - $h) / 2;
				break;
			case 7://7为底端居左
				$posX = 0;
				$posY = $ground_h - $h;
				break;
			case 8://8为底端居中
				$posX = ($ground_w - $w) / 2;
				$posY = $ground_h - $h;
				break;
			case 9://9为底端居右
				$posX = $ground_w - $w;
				$posY = $ground_h - $h;
				break;
			default://随机
				$posX = rand(0,($ground_w - $w));
				$posY = rand(0,($ground_h - $h));
				break;
		}
		//设定图像的混色模式
		imagealphablending($ground_im, true);
		if($ground_w > $this->watermark_width){
			if($isWaterImage){
				imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷贝水印到目标文件
			}else{
				if( !empty($textColor) && (strlen($textColor)==7) ){
					$R = hexdec(substr($textColor,1,2));
					$G = hexdec(substr($textColor,3,2));
					$B = hexdec(substr($textColor,5));
				}else{
					die("水印文字颜色格式不正确!");
				}
				imagestring ( $ground_im, $textFont, $posX, $posY, $waterText, imagecolorallocate($ground_im, $R, $G, $B));
			}
		}
		//生成水印后的图片
		@unlink($groundImage);
		switch($ground_info[2]){
			case 1:imagegif($ground_im,$groundImage);break;
			case 2:imagejpeg($ground_im,$groundImage);break;
			case 3:imagepng($ground_im,$groundImage);break;
			default:die($errorMsg);
		}
		//释放内存
		if(isset($water_info)) unset($water_info);
		if(isset($water_im)) imagedestroy($water_im);
		unset($ground_info);
		imagedestroy($ground_im);
	}
	
	function _get_file_extension($file){
		return strtolower( str_replace( ".", "", substr( $file, strrpos( $file, '.' ) ) ) );
	}
	
	function _clean_paths(){
		$this->out_file_dir = preg_replace( "#/$#", "", $this->out_file_dir );
	}
}
?>