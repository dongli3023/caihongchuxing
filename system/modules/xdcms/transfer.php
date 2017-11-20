<?php 
class transfer extends Checklogin{
	
	function __construct(){
		parent::check_admin();
		$this->ob_tree=base::load_class("catetree");
		$this->mysql=$this->ob_tree->mysql;
		$catid=$_GET['catid'];
		assign('catid',$catid);
	}
	
	public function init(){
		$this->ob_tree->tree(1);
		template('transfer_category','admin');
	}
	
	//栏目数据转移
	public function transfer_save(){
		$fromcate=$_POST['fromcate'];
		$tocate=$_POST['tocate'];
		
		if($fromcate == $tocate){ //判断提交的是否属于同一栏目
			showmsg(C('category_same'),'-1');
		}
		
		if(empty($fromcate) || empty($tocate)){ //判断是否提交有ID
			showmsg(C('material_not_complete'),'-1');
		}
		
		$from_son=get_catids($fromcate); //获取下属分类，判断是否有子栏目，如果有子栏目则不予转移数据
		$to_son=get_catids($tocate);
		if(!empty($from_son) || !empty($to_son)){
			showmsg(C('category_error'),'-1');
		}
		
		$from_table=modelname($fromcate);//获取模型表名，如果不是同一模型，不予转移数据
		$to_table=modelname($tocate);
		if($from_table != $to_table){
			showmsg(C('model_error'),'-1');
		}
		
		$this->mysql->db_update($from_table,"`catid`='".$tocate."'","`catid`=".$fromcate);
		
		showmsg(C('config_success_url'),'index.php?m=xdcms&c=categorytree');
	}
	
	public function transfer_content(){
		if(isset($_POST['contentid'])){
			$id=$_POST['contentid'];
			$catid=intval($_POST['catid']);
			$id=implode(",",$id);
			assign('id',$id);
			$this->ob_tree->tree(1);
		}else{
			showmsg(C('error'),'-1');
		}
		assign('catid',$catid);
		template('transfer_content','admin');
	}
	
	//内容数据转移
	public function transfer_content_save(){
		$tocate=$_POST['tocate'];
		$id=$_POST['id'];
		$catid=intval($_POST['catid']);
		
		if(empty($id) || empty($tocate)){ //判断是否提交有ID
			showmsg(C('material_not_complete'),'-1');
		}
		
		$to_son=get_catids($tocate); //获取下属分类，判断是否有子栏目，如果有子栏目则不予转移数据
		if(!empty($to_son)){
			showmsg(C('category_error'),'-1');
		}
		
		$id=explode(",",$id);
		$model=modelname($catid);
		$tomodel=modelname($tocate);
		foreach($id as $id){
			$rs=$this->mysql->get_one("select * from ".DB_PRE.$model." where `id`=".$id);
			if(($tocate != $catid) && ($tomodel == $model)){
				$this->mysql->db_update($model,"`catid`='".$tocate."'","`id`=".$id);
			}
		}
		showmsg(C('config_success_url'),'index.php?m=xdcms&c=categorytree');
	}
}
?>