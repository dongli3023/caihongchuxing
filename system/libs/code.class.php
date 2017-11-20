<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * code验证码类
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/

class code{
	private $width,$height;
	public $checkcode;
	var $img;
	function __construct($width,$height){
		$this->width=$width;
		$this->height=$height;
		$this->checkcode="";
		$this->img="";
	}
	
	public function image(){
		$this->create_code();
		$this->create_img();
		header("Content-type:image/png");
		imagepng($this->img);
	}
	
	private function create_code(){
		for($i=1;$i<=4;$i++){
			$this->checkcode[$i]=dechex(rand(1,15));
		}
	}
	
	private function create_img(){
		$this->img=@imagecreate($this->width,$this->height);
		$bg = imagecolorallocate($this->img,148,200,233);
		$str_bg = imagecolorallocate($this->img,255,255,255);
		for($i=0;$i<200;$i++){
			$pxcolor = imagecolorallocate($this->img, rand(0,255), rand(0,255), rand(0,255));
			imagesetpixel($this->img,rand(2,$this->width),rand(2,$this->height),$pxcolor);
		}
		for($n=1;$n<=4;$n++){
			$str_color = imagecolorallocate ($this->img, rand(0,255), rand(0,128), rand(0,255));  
			//if($n){$x=20*($n-1)}
			$x=($this->width/4)-5;
			$y=$this->height-12;
			imagestring($this->img,5,rand($x*($n-1)+5,$x*$n),rand(3,$y),$this->checkcode[$n],$str_color);
		}
	}
	
	function return_code(){
		return $this->checkcode;
	}
}
?>
