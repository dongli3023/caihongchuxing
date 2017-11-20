<?php
class update_cache extends Checklogin{
	
	function __construct(){
		parent::check_admin();
		$this->cache=base::load_class("cache");
		$this->mysql=$this->cache->mysql;
	} 
	
	public function init(){
		$this->cache->setting_cache();
		$this->cache->category_cache();
		$this->cache->model_cache();
		$this->cache->keywords_cache();
		$this->cache->menu_cache();
		
		$model=base::load_cache("cache_model","_model");   //加载模型缓存，更新模型的字段缓存
		foreach ($model as $value){
			$this->cache->field_cache($value['model_table']);
		}
		
		global $smarty;          //清除模板缓存
		$smarty->clearAllCache();
		
		//缓存更新完成
		showmsg(C('update_cache_success'),'-1');
	}
}
?>