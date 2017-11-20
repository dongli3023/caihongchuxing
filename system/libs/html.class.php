<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * 静态页生成类
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/ 
class html{
	function __construct(){
		$this->contents=base::_auto_load(MOD_PATH."content/index.php","index");
		$this->mysql=$this->contents->mysql;
	}
	
	public function creat_index($lang,$dir){
		ob_start();
		$this->contents->init($lang);
		if(!empty($dir)){
			if (!file_exists($dir)) {
				mkdir($dir);
			}
			$url=$dir."/index.html";
		}else{
			$url="index.html";
		}
		creat_html($url);
	}
	
	public function creat_list($catid,$_page,$url,$lang){
		ob_start();
		$this->contents->lists($catid,$_page,$lang);
		creat_html($url);
	}
	
	public function creat_show($catid,$contentid,$url,$lang){
		ob_start();
		$this->contents->show($catid,$contentid,$lang);
		creat_html($url);
	}
}
?>