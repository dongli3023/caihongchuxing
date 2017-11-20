<?php
class admin extends Checklogin{

	public function init(){
		template('qq_list','admin/qq');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('qq','`is_lock`='.$lockid,'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'qq where `id`='.$id);
		assign('rs',$rs);
		template('qq_edit','admin/qq');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$title=safe_html($_POST['title']);
		$qq=safe_html($_POST['qq']);
		if(empty($title)||empty($qq)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('qq',"`title`='".$title."',`qq`='".$qq."'",'`id`='.$id);
		showmsg(C('update_success'),'index.php?m=qq&c=admin');
	}
	
	public function add(){
		template('qq_add','admin/qq');
	}
	
	public function addsave(){
		$title=safe_html($_POST['title']);
		$qq=safe_html($_POST['qq']);
		if(empty($title)||empty($qq)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('qq',"`title`='".$title."',`qq`='".$qq."',`inputtime`='".datetime()."',`is_lock`=0");
		showmsg(C('add_success'),'index.php?m=qq&c=admin');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('qq','`id`='.$id);
		showmsg(C('delete_success'),'-1');
	}
}

?>