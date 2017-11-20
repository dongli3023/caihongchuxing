<?php
class group extends Checklogin{

	public function init(){
		template('group_list','admin/member');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'member_group where `groupid`='.$id);
		assign('rs',$rs);
		template('group_edit','admin/member');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$name=safe_html($_POST['name']);
		if(empty($name)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('member_group',"`name`='".$name."'",'`groupid`='.$id);
		$this->group_cache();
		showmsg(C('update_success'),'index.php?m=member&c=group');
	}
	
	public function add(){
		template('group_add','admin/member');
	}
	
	public function addsave(){
		$name=safe_html($_POST['name']);
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('member_group',"`name`='".$name."'");
		$this->group_cache();
		showmsg(C('add_success'),'index.php?m=member&c=group');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('member_group','`groupid`='.$id);
		showmsg(C('delete_success'),'-1');
	}
	
	public function cache(){
		$this->group_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function group_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."member_group order by groupid asc");
		$s="<?php\n\$_member_group=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_member_group.php';
		creat_inc($file,$s);
	}
}

?>