<?php
class index extends db{	

	private $dir;
	
	function __construct(){
		parent::__construct();
		$language=isset($_GET['l'])?(int)$_GET['l']:1;
		$lang_arr=get_lang($language);
		
		if(!empty($lang_arr['dir'])){
			$this->dir=$lang_arr['dir']."/";
		}
		assign('lang',$lang_arr);
		assign('menu',get_menu(0,1,$language));
	}
	
	public function init(){ 
		$this->member_info();
		template($this->dir."member/index");
	}
	
	public function register(){
		$member_user=Cookie::_getcookie('member_user');
		$member_userid=Cookie::_getcookie('member_userid');
		if(!empty($member_user)||!empty($member_userid)){
			showmsg(C("not_register"),"index.php?m=member");
		}
		$input=base::load_class('input');
		
		//加载注册字段
		$field=base::load_cache("cache_field_member","_field");
		$fields="";
		if(is_array($field)){
			foreach($field as $value){
				if($value['is_register']==1){
					$fields.="<tr>\n";
					$fields.="<td align=\"right\">".$value['name']."：</td>\n";
					$fields.="<td>".$input->$value['formtype']($value['field'],'',$value['width'],$value['height'],$value['initial'])." ".$value['explain']."</td>\n";
					$fields.="</tr>\n";
				}
			}
		}
		
		assign("fields",$fields);
		template($this->dir."member/register");
	}
	
	public function register_save(){
		$username=safe_html($_POST['username']);
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$fields=$_POST['fields'];
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
		$password=md5(md5($password));
		
		$user_num=$this->mysql->num_rows("select * from ".DB_PRE."member where `username`='$username'");//判断会员是否存在
		if($user_num>0){
			showmsg(C('member_exist'),'-1');
		}
		$ip=safe_replace(safe_html(getip()));
		$this->mysql->db_insert('member',"`username`='".$username."',`password`='".$password."',`creat_time`='".datetime()."',`last_ip`='".$ip."',`is_lock`='0',`logins`='0',`groupid`='1'");//插入主要字段——用户名、密码
		$last_id=$this->mysql->insert_id();
		
		//插入附属字段
		$field_sql='';
		foreach($fields as $k=>$v){
			$f_value=$v;
			if(is_array($v)){
				$f_value=implode(',',$v);
			}
			$field_sql.=",`{$k}`='{$f_value}'";
		}
		$field_sql=substr($field_sql,1);
		$field_sql="update ".DB_PRE."member set {$field_sql} where userid={$last_id}";
		$query=$this->mysql->query($field_sql);
		
		showmsg(C('register_success'),'index.php?m=member&f=register');
	}
	
	public function login(){
		template($this->dir."member/login");
	}
	
	public function login_save(){
		$username = safe_html($_POST['username']);
		$password = safe_html($_POST['password']);
		
		if(empty($username)||empty($password)){
			showmsg(C('user_pass_empty'),'-1');
		}
		
		$sql="select * from ".DB_PRE."member where `username`='$username'";
		if($this->mysql->num_rows($sql)==0){
			showmsg(C('member_not_exist'),'-1');
		}
		
		$password=md5(md5($password));
		$rs=$this->mysql->get_one($sql);
		if($password!=$rs['password']){
			showmsg(C('password_error'),'-1');
		}
		
		if($rs['is_lock']==1){
			showmsg(C('user_lock'),'-1');
		}
		
		$logins=$rs["logins"]+1;
		$ip=safe_replace(safe_html(getip()));
		$this->mysql->db_update("member","`last_ip`='".$ip."',`last_time`=".datetime().",`logins`=".$logins,"`username`='$username'");
		
		Cookie::_setcookie(array('name'=>'member_user','value'=>$username));
		Cookie::_setcookie(array('name'=>'member_userid','value'=>$rs['userid']));
		Cookie::_setcookie(array('name'=>'member_groupid','value'=>$rs['groupid']));
		unset($rs);
		showmsg(C("login_success"),"index.php?m=member");
	}
	
	public function edit(){
		$member_user=Cookie::_getcookie('member_user');
		$userid=intval(Cookie::_getcookie('member_userid'));
		if(empty($member_user)||empty($userid)){
			showmsg(C("admin_not_exist"),"index.php?m=member&f=login");
		}
		$info=$this->mysql->get_one("select * from ".DB_PRE."member where `userid`=$userid");
		
		$input=base::load_class('input');
		$field=base::load_cache("cache_field_member","_field");
		$fields="";
		foreach($field as $value){
			$fields.="<tr>\n";
			$fields.="<td align=\"right\">".$value['name']."：</td>\n";
			$fields.="<td>".$input->$value['formtype']($value['field'],$info[$value['field']],$value['width'],$value['height'],$value['initial'])." ".$value['explain']."</td>\n";
			$fields.="</tr>\n";
		}
		
		assign('member',$info);
		assign("fields",$fields);
		template($this->dir."member/edit");
	}
	
	public function edit_save(){
		$this->member_info();
		$userid=intval(Cookie::_getcookie('member_userid'));
		$fields=$_POST['fields'];
		//修改资料
		$field_sql='';
		foreach($fields as $k=>$v){
			$f_value=$v;
			if(is_array($v)){
				$f_value=implode(',',$v);
			}
			$field_sql.=",`{$k}`='".safe_html($f_value)."'";
		}
		$field_sql=substr($field_sql,1);
		$field_sql="update ".DB_PRE."member set {$field_sql} where userid={$userid}";
		$query=$this->mysql->query($field_sql);
		
		showmsg(C('update_success'),'index.php?m=member&f=edit');
	}
	
	public function password(){
		$this->member_info();
		template($this->dir."member/password");
	}
	
	public function password_save(){
		$this->member_info();
		$userid=intval(Cookie::_getcookie('member_userid'));
		$oldpassword=$_POST['oldpassword'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		if(empty($oldpassword)||empty($password2)||empty($password)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(!strlength($password,5)){
			showmsg(C('password').C('str_len_error').'5','-1');
		}
		if($password!=$password2){
			showmsg(C('password_different'),'-1');
		}
		
		//判断旧密码是否正确
		$oldpassword=md5(md5($oldpassword));
		$rs=$this->mysql->get_one("select * from ".DB_PRE."member where `userid`='$userid'");
		if($oldpassword!=$rs['password']){
			showmsg(C('oldpassword_error'),'-1');
		}
		
		//更新密码
		$password=md5(md5($password));
		$sql="update ".DB_PRE."member set password='{$password}' where userid='{$userid}'";
		$this->mysql->query($sql);
		
		showmsg(C('update_success'),'-1');
		
	}
	
	public function logout(){
		Cookie::_delcookie(array('name'=>'member_user'));
		Cookie::_delcookie(array('name'=>'member_userid'));
		Cookie::_delcookie(array('name'=>'member_groupid'));
		showmsg(C("login_out_success"),"index.php?m=member&f=login");
	}
	
	//判断会员是否登录并获取会员信息
	private function member_info(){
		$user=safe_html(Cookie::_getcookie('member_user'));
		$userid=intval(Cookie::_getcookie('member_userid'));
		if(empty($user)||empty($userid)){
			showmsg(C("admin_not_exist"),"index.php?m=member&f=login");
		}
		$info=$this->mysql->get_one("select * from ".DB_PRE."member where `userid`=$userid");
		
		assign('member',$info);
	}
}
?>