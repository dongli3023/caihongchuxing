<?php
class model extends Checklogin{
	
	function __construct(){
		parent::check_admin();
		$this->cache=base::load_class("cache");
		$this->mysql=$this->cache->mysql;
	} 

	public function init(){
		template('model_list','admin');
	}
	
	public function model_add(){
		template('model_add','admin');
	}
	
	public function model_add_save(){
		$modelname=safe_html($_POST['modelname']);
		$modeltable=$_POST['modeltable'];
		$modeltable_content=get_content_table($modeltable);
		$is_lock=$_POST['is_lock'];
		$is_fixed=$_POST['is_fixed'];
		if(empty($modelname)||empty($modeltable)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(!check_str($modeltable,'/^[a-z0-9][a-z0-9]*$/')){
			showmsg(C('table').C('numbers_and_letters'),'-1');
		}
		$tables=$this->mysql->show_table();
		if(in_array(DB_PRE.$modeltable,$tables)){
			showmsg(C('table_exist'),'-1');
		}
		if(in_array(DB_PRE.$modeltable_content,$tables)){
			showmsg(C('table_exist'),'-1');
		}
		$this->mysql->db_insert('model',"`model_name`='".$modelname."',`model_table`='".$modeltable."',`is_lock`=".$is_lock.",`is_fixed`=".$is_fixed);
		$field="`id` int(8) unsigned NOT NULL AUTO_INCREMENT,`catid` tinyint(5) unsigned NOT NULL DEFAULT '0',`title` char(80) NOT NULL,`thumb` char(100) NOT NULL,`keywords` char(40) NOT NULL,`description` char(255) NOT NULL,`commend` tinyint(1) unsigned NOT NULL DEFAULT '0',`url` char(100) NOT NULL,`userid` mediumint(8) unsigned NOT NULL DEFAULT '0',`username` char(20) NOT NULL,`inputtime` int(10) unsigned NOT NULL DEFAULT '0',`updatetime` int(10) unsigned NOT NULL DEFAULT '0',`hits` int(8) unsigned NOT NULL DEFAULT '0',`sort` int(8) unsigned NOT NULL DEFAULT '0',`style` char(20) default NULL,PRIMARY KEY (`id`)";
		$field_content="id int(8) not null,PRIMARY KEY (`id`)";
		$this->mysql->create_table($modeltable,$field);
		$this->mysql->create_table($modeltable_content,$field_content);
		$this->cache->model_cache();
		showmsg(C('add_success'),'-1');
	}
	
	public function model_edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'model where `id`='.$id);
		assign('rs',$rs);
		template('model_edit','admin');
		unset($rs);
	}
	
	public function model_edit_save(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$modelname=safe_html($_POST['modelname']);
		$is_lock=$_POST['is_lock'];
		$is_fixed=isset($_POST['is_fixed'])?intval($_POST['is_fixed']):1;
		if(empty($modelname)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update("model","`model_name`='".$modelname."',`is_lock`=".$is_lock.",`is_fixed`=".$is_fixed."","`id`=".$id);
		$this->cache->model_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('model','`is_lock`='.$lockid,'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function model_delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		
		$num=$this->mysql->db_num("category","`modelid`=".$id);   //判断模型下是否有栏目
		if($num>0){
			showmsg(C('delete_next_category'),'-1');
		}
		
		$model=modeltable($id);
		$model_content=get_content_table($model);
		$this->mysql->db_delete('model','`id`='.$id);
		$this->mysql->db_delete('model_field','`modelid`='.$id);
		$this->mysql->del_table($model);
		$this->mysql->del_table($model_content);
		$this->cache->model_cache();
		
		$cacheurl=CACHE_SYS_PATH.'cache_field_'.$model.'.php';   //删除字段缓存
		if(file_exists($cacheurl)){
			unlink($cacheurl);
		}
		
		showmsg(C('delete_success'),'-1');
	}
	
	public function field(){
		$modelid=isset($_GET['modelid'])?intval($_GET['modelid']):0;
		$model=modeltable($modelid);
		$field_arr=base::load_cache('cache_field_'.$model,'_field');
		assign("modelid",$modelid);
		assign("fields",$field_arr);
		template('field_list','admin');
	}
	
	public function field_add(){
		$modelid=isset($_GET['modelid'])?intval($_GET['modelid']):0;
		$fields_arr=base::load_file(FUN_PATH.'fields.inc.php','_fields');
		assign("modelid",$modelid);
		assign("fields",$fields_arr);
		template('field_add','admin');
	}
	
	public function field_add_save(){
		$name=safe_html($_POST['name']);
		$field=$_POST['field'];
		$formtype=$_POST['formtype'];
		$width=$_POST['width'];
		$width=isset($width)?(int)$width:0;
		$height=$_POST['height'];
		$height=isset($height)?(int)$height:0;
		$sort=$_POST['sort'];
		$explain=safe_html($_POST['explain']);
		$initial=$_POST['initial'];
		$modelid=$_POST['modelid'];
		$is_fixed=$_POST['is_fixed'];
		$model=modeltable($modelid);
		$model_content=get_content_table($model);
		
		if(empty($name)||empty($field)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(!check_str($field,'/^[a-z0-9][a-z0-9]*$/')){
			showmsg(C('field').C('numbers_and_letters'),'-1');
		}
		if($width!=''&&!is_num($width)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if($height!=''&&!is_num($height)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if(!is_num($sort)){
			showmsg(C('sort_numbers'),'-1');
		}

		$table_field=$this->mysql->fetch_field("select * from ".DB_PRE.$model_content);//获取数据表的字段
		if(in_array($field,$table_field)){
			showmsg(C('field_exist'),'-1');
		}
		
		$this->mysql->db_insert('model_field',"`name`='".$name."',`field`='".$field."',`formtype`='".$formtype."',`width`='".$width."',`height`='".$height."',`sort`='".$sort."',`explain`='".$explain."',`initial`='".$initial."',`modelid`=".$modelid.",`is_fixed`=".$is_fixed);
		if($formtype=="checkbox"||$formtype=="editor"||$formtype=="textarea"||$formtype=="moreimage"){
			$field="`".$field."` TEXT";
		}else{
			$field="`".$field."` CHAR(80)";
		}
		$this->mysql->add_field($model_content,$field);
		$this->cache->field_cache($model);
		unset($rs);
		showmsg(C('add_success'),'-1');
	}
	
	public function field_edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'model_field where `fieldid`='.$id);
		assign('rs',$rs);
		unset($rs);
		$fields_arr=base::load_file(FUN_PATH.'fields.inc.php','_fields');
		assign("fields",$fields_arr);
		template('field_edit','admin');
	}
	
	public function field_edit_save(){
		$name=safe_html($_POST['name']);
		$formtype=$_POST['formtype'];
		$width=$_POST['width'];
		$width=isset($width)?(int)$width:0;
		$height=$_POST['height'];
		$height=isset($height)?(int)$height:0;
		$sort=$_POST['sort'];
		$explain=safe_html($_POST['explain']);
		$initial=$_POST['initial'];
		$modelid=$_POST['modelid'];
		$fieldid=$_POST['fieldid'];
		$is_fixed=$_POST['is_fixed'];
		$model=modeltable($modelid);
		
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		if($width!=''&&!is_num($width)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if($height!=''&&!is_num($height)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if(!is_num($sort)){
			showmsg(C('sort_numbers'),'-1');
		}
		
		$this->mysql->db_update('model_field',"`name`='".$name."',`formtype`='".$formtype."',`width`='".$width."',`height`='".$height."',`sort`='".$sort."',`explain`='".$explain."',`initial`='".$initial."',`is_fixed`=".$is_fixed,"`fieldid`=".$fieldid);
		$this->cache->field_cache($model);
		unset($rs);
		showmsg(C('update_success'),'-1');
	}
	
	public function field_delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$modelid=isset($_GET['modelid'])?intval($_GET['modelid']):0;
		$model=modeltable($modelid);
		$model_content=get_content_table($model);
		$rs=$this->mysql->get_one("select fieldid,field from ".DB_PRE."model_field where `fieldid`=".$id);
		$fieldname=$rs['field'];
		$this->mysql->del_field($model_content,$fieldname);
		$this->mysql->db_delete('model_field','`fieldid`='.$id);
		$this->cache->field_cache($model);
		showmsg(C('delete_success'),'-1');
	}
	
	public function cache(){
		$this->cache->model_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function update_field_cache(){
		$modelid=isset($_GET['modelid'])?intval($_GET['modelid']):0;
		$model=modeltable($modelid);
		$this->cache->field_cache($model);
		showmsg(C('update_success'),'-1');
	}

}

?>