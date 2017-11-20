<?php 
//中文
class categorytree extends Checklogin{
	
	function __construct(){
		parent::check_admin();
		$this->ob_tree=base::load_class("catetree");
	}
	
	public function init(){
		$this->ob_tree->tree(1);
		template('update_url','admin');
	}
	
	public function category_tree(){
		$this->ob_tree->tree(1);
		template('update_category','admin');
	}
	
	public function show_tree(){
		$this->ob_tree->tree(1);
		template('update_show','admin');
	}
}
?>