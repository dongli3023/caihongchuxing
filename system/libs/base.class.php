<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * 静态类及统一构造函数
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/
class base{
	/*
	*读取文件
	*return array  $file--缓存文件 $arr-返回数组名
	*/
	public static function load_file($file,$arr){
		if(file_exists($file)){
			include($file);
		}
		return $$arr;
	}
	
	//读取cache_sys里缓存文件
	public static function load_cache($file,$arr){
		return self::load_file(CACHE_SYS_PATH.$file.'.php',$arr);
	}
	
	/*
	*读取类文件
	*return object  $file--类文件名称 $name-类名
	*/
	public static function _auto_load($file,$name){
		if(file_exists($file)){
			include($file);
			$object=new $name();
			return $object;
		}
	}
	
	//读取libs里类文件
	public static function load_class($name){
		return self::_auto_load(LIB_PATH.$name.'.class.php',$name);
	}

}


//统一构造函数----------前台页面继承
class db{
	function __construct(){
		$this->mysql=base::load_class('mysql');
	}
	
	function __call($classname, $arguments){
		echo "Calling object method $classname";
	}
	
	public function check_lang($lang=''){
		//判断站点
		if(!empty($lang)){
			$language=intval($lang);
		}else{
			$language=isset($_GET['l'])?(int)$_GET['l']:1;
		}
		$lang_arr=get_lang($language);
		
		//加载语言包
		assign('lang',$lang_arr);
		assign('menu',get_menu(0,1,$language));
		
		//判断版本目录
		if(!empty($lang_arr['dir'])){
			$dir=$lang_arr['dir']."/";
		}
		return $dir;
	}
}


//继承db类，并重载及访问原构造函数，增加访问权限的判断-----------后台页面继承
class Checklogin extends db{

	function __construct(){
		parent::__construct();
		$this->check_admin();
	}

	public function check_admin(){
		//判断是否已登录
		if(empty($_SESSION['admin'])||empty($_SESSION['admin_id'])||empty($_SESSION['groupid'])){
			showmsg(C("admin_not_exist"),"index.php?m=xdcms&c=login");
		}
		
		//判断管理权限
		$menu=base::load_cache("cache_menu","_menu");
		$url=ltrim($_SERVER['REQUEST_URI'],"/");  //获取当前路径
		$row=get_array($menu,"url","{$url}",1);

		if(!empty($row[0]['groupid'])){
			$group=explode(",",$row[0]['groupid']);
			$groupid=$_SESSION['groupid'];
			if(!in_array($groupid,$group)){
				showmsg(C("admin_not_purview"),"-1");
			}
		}
	}
}
?>