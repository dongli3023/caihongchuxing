<?php
class admin extends Checklogin{

	public function init(){
		template('link_list','admin/link');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('link','`is_lock`='.$lockid,'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'link where `id`='.$id);
		assign('rs',$rs);
		template('link_edit','admin/link');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$title=safe_html($_POST['title']);
		$typeid=intval($_POST['typeid']);
		$url=safe_html($_POST['url']);
		if(empty($title)||empty($url)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('link',"`title`='".$title."',`typeid`='".$typeid."',`url`='".$url."'",'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function add(){
		template('link_add','admin/link');
	}
	
	public function addsave(){
		$title=safe_html($_POST['title']);
		$url=safe_html($_POST['url']);
		$typeid=intval($_POST['typeid']);
		if(empty($title)||empty($url)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('link',"`title`='".$title."',`typeid`='".$typeid."',`url`='".$url."',`inputtime`='".datetime()."',`is_lock`=0");
		
		showmsg(C('add_success'),'index.php?m=link&c=admin');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('link','`id`='.$id);
		showmsg(C('delete_success'),'-1');
	}
	
	public function list_type(){
		template('link_type_list','admin/link');
	}
	
	public function add_type(){
		template('link_type_add','admin/link');
	}
	
	public function add_type_save(){
		$name=safe_html($_POST['name']);
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('link_type',"`name`='".$name."'");
		showmsg(C('add_success'),'index.php?m=link&c=admin&f=list_type');
	}
	
	public function edit_type(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'link_type where `id`='.$id);
		assign('rs',$rs);
		template('link_type_edit','admin/link');
	}
	
	public function edit_type_save(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$name=safe_html($_POST['name']);
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('link_type',"`name`='".$name."'",'`id`='.$id);
		showmsg(C('update_success'),'index.php?m=link&c=admin&f=list_type');
	}
	
	public function delete_type(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('link_type','`id`='.$id);
		showmsg(C('delete_success'),'-1');
	}
	
}

?>