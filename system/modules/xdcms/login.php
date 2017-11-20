<?php
class login extends db{
	
	public function init(){
		deldir(CMS_PATH."install");//删除安装目录
		
		if(!empty($_SESSION['admin']) && !empty($_SESSION['admin_id']) && !empty($_SESSION['groupid'])){
			showmsg(C('admin_exist'),'index.php?m=xdcms&c=index');
		}
		template('login','admin');
	}
	
	public function check(){
		
		$username = safe_html($_POST['username']);
		$password = safe_html($_POST['password']);
		$verifycode = safe_html($_POST['verifycode']);

		if(empty($username)||empty($password)){
			showmsg(C('user_pass_empty'),'-1');
		}
		
		if($verifycode!=$_SESSION['code']){
			showmsg(C('verifycode_error'),'-1');
		}
		
		$sql="select * from ".DB_PRE."admin where `username`='$username'";
		if($this->mysql->num_rows($sql)==0){
			showmsg(C('user_not_exist'),'-1');
		}
		
		$rs=$this->mysql->get_one($sql);
		$password=password($password,$rs['encrypt']);
		if($password!=$rs['password']){
			showmsg(C('password_error'),'-1');
		}
		
		if($rs['is_lock']==1){
			showmsg(C('user_lock'),'-1');
		}
		
		$logins=$rs["logins"]+1;
		$ip=safe_replace(safe_html(getip()));
		$this->mysql->db_update("admin","`last_ip`='".$ip."',`last_time`=".datetime().",`logins`=".$logins,"`username`='$username'");
		
		$_SESSION['admin']=$rs['username'];
		$_SESSION['admin_id']=$rs['id'];
		$_SESSION['groupid']=$rs['groupid'];
		unset($rs);
		showmsg(C("login_success"),"index.php?m=xdcms&c=index");
	}
	
	public function out(){
		$_SESSION['admin']="";
		$_SESSION['admin_id']="";
		$_SESSION['groupid']="";
		showmsg(C("login_out_success"),"index.php?m=xdcms&c=login");
	}
}

?>