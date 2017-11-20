<?php
class admin extends Checklogin{

	function init(){
		template('admin_list','admin');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('admin','`is_lock`='.$lockid,'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'admin where `id`='.$id);
		
		assign('rs',$rs);
		template('admin_edit','admin');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$groupid=$_POST['groupid'];
		if(!empty($password)){
			if(!strlength($password,5)){
				showmsg(C('password').C('str_len_error').'5','-1');
			}
			if($password!=$password2){
				showmsg(C('password_different'),'-1');
			}
			$pwd=password($password);
			$this->mysql->db_update('admin',"`password`='".$pwd['password']."',`encrypt`='".$pwd['encrypt']."',`groupid`='".$groupid."'",'`id`='.$id);
		}else{
			$this->mysql->db_update('admin',"`groupid`='".$groupid."'",'`id`='.$id);
		}

		showmsg(C('update_success'),'-1');
	}
	
	public function add(){
		template('admin_add','admin');
	}
	
	public function addsave(){
		$username=safe_html($_POST['username']);
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$groupid=$_POST['groupid'];
		if(empty($username)||empty($password2)||empty($password)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(!strlength($username,5)){
			showmsg(C('username').C('str_len_error').'5','-1');
		}
		if(!strlength($password,5)){
			showmsg(C('password').C('str_len_error').'5','-1');
		}
		if($password!=$password2){
			showmsg(C('password_different'),'-1');
		}
		$pwd=password($password);
		$ip=safe_replace(safe_html(getip()));
		$this->mysql->db_insert('admin',"`username`='".$username."',`password`='".$pwd['password']."',`encrypt`='".$pwd['encrypt']."',`creat_time`='".datetime()."',`last_ip`='".$ip."',`groupid`='".$groupid."'");
		
		showmsg(C('add_success'),'index.php?m=xdcms&c=admin');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		
		$this->mysql->db_delete('admin','`id`='.$id);
		showmsg(C('delete_success'),'-1');
	}
	
	//管理组管理
	function admin_group(){
		template('admin_group_list','admin');
	}
	
	public function admin_group_add(){
		template('admin_group_add','admin');
	}
	
	public function admin_group_add_save(){
		$name=safe_html($_POST['name']);
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}

		$this->mysql->db_insert('admin_group',"`name`='".$name."'");
		
		showmsg(C('add_success'),'index.php?m=xdcms&c=admin&f=admin_group');
	}
	
	public function admin_group_edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'admin_group where `groupid`='.$id);
		assign('rs',$rs);
		template('admin_group_edit','admin');
	}
	
	public function admin_group_edit_save(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$name=$_POST['name'];
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('admin_group',"`name`='".$name."'",'`groupid`='.$id);
		
		showmsg(C('update_success'),'index.php?m=xdcms&c=admin&f=admin_group');
	}
	
	public function admin_group_delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		
		$this->mysql->db_delete('admin_group','`groupid`='.$id);
		showmsg(C('delete_success'),'-1');
	}
}

?>