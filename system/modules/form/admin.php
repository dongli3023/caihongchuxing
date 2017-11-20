<?php
class admin extends Checklogin{

	public function init(){
		template('form_list','admin/form');
	}
	
	public function form_add(){
		template('form_add','admin/form');
	}
	
	public function form_add_save(){
		$formname=safe_html($_POST['formname']);
		$formtable=$_POST['formtable'];
		$is_lock=$_POST['is_lock'];
		$is_email=$_POST['is_email'];
		$is_code=$_POST['is_code'];
		$is_fixed=$_POST['is_fixed'];
		if(empty($formname)||empty($formtable)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(!check_str($formtable,'/^[a-z0-9][a-z0-9]*$/')){
			showmsg(C('table').C('numbers_and_letters'),'-1');
		}
		$tables=$this->mysql->show_table();
		if(in_array(DB_PRE.$formtable,$tables)){
			showmsg(C('table_exist'),'-1');
		}
		$this->mysql->db_insert('form',"`form_name`='".$formname."',`form_table`='".$formtable."',`is_lock`=".$is_lock.",`is_email`=".$is_email.",`is_code`=".$is_code.",`is_fixed`=".$is_fixed);
		$field="`id` int(8) not null auto_increment,`title` char(80) character SET utf8 COLLATE utf8_general_ci not null,`inputtime` int(10) not null default '0',primary key (`id`)";
		$this->mysql->create_table($formtable,$field);
		$this->form_cache();
		showmsg(C('add_success'),'-1');
	}
	
	public function form_edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'form where `id`='.$id);
		assign('rs',$rs);
		template('form_edit','admin/form');
		unset($rs);
	}
	
	public function form_edit_save(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$formname=safe_html($_POST['formname']);
		$is_lock=$_POST['is_lock'];
		$is_email=$_POST['is_email'];
		$is_code=$_POST['is_code'];
		$is_fixed=isset($_POST['is_fixed'])?intval($_POST['is_fixed']):1;
		if(empty($formname)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update("form","`form_name`='".$formname."',`is_lock`=".$is_lock.",`is_fixed`=".$is_fixed.",`is_code`=".$is_code.",`is_email`=".$is_email."","`id`=".$id);
		$this->form_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('form','`is_lock`='.$lockid,'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function form_delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		
		$form=formtable($id);
		$this->mysql->db_delete('form','`id`='.$id);
		$this->mysql->db_delete('form_field','`formid`='.$id);
		$this->mysql->del_table($form);
		$this->form_cache();
		
		$cacheurl=CACHE_SYS_PATH.'cache_form_'.$form.'.php';   //删除字段缓存
		if(file_exists($cacheurl)){
			unlink($cacheurl);
		}
		
		showmsg(C('delete_success'),'-1');
	}
	
	public function field(){
		$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
		$model=formtable($formid);
		$field_arr=base::load_cache('cache_form_'.$model,'_field');
		assign("formid",$formid);
		assign("fields",$field_arr);
		template('field_list','admin/form');
	}
	
	public function field_add(){
		$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
		$fields_arr=base::load_file(FUN_PATH.'fields.inc.php','_fields');
		assign("formid",$formid);
		assign("fields",$fields_arr);
		template('field_add','admin/form');
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
		$formid=$_POST['formid'];
		$is_fixed=$_POST['is_fixed'];
		$form=formtable($formid);
		
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

		$table_field=$this->mysql->fetch_field("select * from ".DB_PRE.$form);//获取数据表的字段
		if(in_array($field,$table_field)){
			showmsg(C('field_exist'),'-1');
		}
		
		$this->mysql->db_insert('form_field',"`name`='".$name."',`field`='".$field."',`formtype`='".$formtype."',`width`='".$width."',`height`='".$height."',`sort`='".$sort."',`explain`='".$explain."',`initial`='".$initial."',`formid`=".$formid.",`is_fixed`=".$is_fixed);
		if($formtype=="checkbox"||$formtype=="editor"||$formtype=="textarea"){
			$field="`".$field."` TEXT";
		}else{
			$field="`".$field."` CHAR(80)";
		}
		$this->mysql->add_field($form,$field);
		$this->field_cache($form);
		unset($rs);
		showmsg(C('add_success'),'-1');
	}
	
	public function field_edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'form_field where `fieldid`='.$id);
		assign('rs',$rs);
		unset($rs);
		$fields_arr=base::load_file(FUN_PATH.'fields.inc.php','_fields');
		assign("fields",$fields_arr);
		template('field_edit','admin/form');
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
		$formid=$_POST['formid'];
		$fieldid=$_POST['fieldid'];
		$is_fixed=$_POST['is_fixed'];
		$form=formtable($formid);
		
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
		
		$this->mysql->db_update('form_field',"`name`='".$name."',`formtype`='".$formtype."',`width`='".$width."',`height`='".$height."',`sort`='".$sort."',`explain`='".$explain."',`initial`='".$initial."',`is_fixed`=".$is_fixed,"`fieldid`=".$fieldid);
		$this->field_cache($form);
		unset($rs);
		showmsg(C('update_success'),'-1');
	}
	
	public function field_delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
		$form=formtable($formid);
		$rs=$this->mysql->get_one("select fieldid,field from ".DB_PRE."form_field where `fieldid`=".$id);
		$fieldname=$rs['field'];
		$this->mysql->del_field($form,$fieldname);
		$this->mysql->db_delete('form_field','`fieldid`='.$id);
		$this->field_cache($form);
		showmsg(C('delete_success'),'-1');
	}
	
	public function form_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."form");
		$s="<?php\n\$_form=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_form.php';
		creat_inc($file,$s);
	}
	
	public function cache(){
		$this->form_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function field_cache($form){
		$array=$this->mysql->get_one("select id,form_table from ".DB_PRE."form where `form_table`='".$form."'");
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."form_field where formid='".$array['id']."' order by sort asc,fieldid asc");
		$s="<?php\n\$_field=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_form_'.$form.'.php';
		creat_inc($file,$s);
	}
	
	public function update_field_cache(){
		$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
		$form=formtable($formid);
		$this->field_cache($form);
		showmsg(C('update_success'),'-1');
	}

}

?>