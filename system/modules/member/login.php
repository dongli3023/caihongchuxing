<?php
class login extends db{	
	
	public function init(){ 
		$member_user=Cookie::_getcookie('member_user');
		$member_userid=Cookie::_getcookie('member_userid');
		if(empty($member_user)||empty($member_userid)){
            echo "document.write(\"<form id='login' name='login' method='post' action='index.php?m=member&f=login_save'>\");";
			echo "document.write(\"<dl>\");";
			echo "document.write(\"<dd>用户名：<input type='text' name='username' id='username' class='login_input' /></dd>\");";
            echo "document.write(\"<dd>密&nbsp;&nbsp;码：<input type='password' name='password' id='password' class='login_input' /></dd>\");";
			echo "document.write(\"<dd class=p10><input type='submit' name='button' id='button' value=' 登录 ' class='submit' />&nbsp;&nbsp;<a href='index.php?m=member&f=register'>马上注册会员</a></dd>\");";
			echo "document.write(\"</dl>\");";
            echo "document.write(\"</form>\");";
		}else{
			echo "document.write(\"<div class=login_text>您好,".$member_user.",欢迎您回来!<br><a href=index.php?m=member>马上进入会员中心</a><br><a href=index.php?m=member&f=logout>退出会员登录</a></div>\")";
		}
	}
	
	public function login_text(){
		$member_user=Cookie::_getcookie('member_user');
		$member_userid=Cookie::_getcookie('member_userid');
		if(empty($member_user)||empty($member_userid)){
			echo "document.write(\"<a href='index.php?m=member&f=register'>注册会员</a> | <a href='index.php?m=member&f=login'>会员登录</a>\");";
		}else{
			echo "document.write(\"您好,".$member_user.",欢迎您! <a href=index.php?m=member>进入会员中心</a> | <a href=index.php?m=member&f=logout>退出登录</a>\")";
		}
	}
	
	public function login_en_text(){
		$member_user=Cookie::_getcookie('member_user');
		$member_userid=Cookie::_getcookie('member_userid');
		if(empty($member_user)||empty($member_userid)){
			echo "document.write(\"<a href='index.php?m=member&f=register&l=2'>Register</a> | <a href='index.php?m=member&f=login&l=2'>Login</a>\");";
		}else{
			echo "document.write(\"Hello,".$member_user.",Welcome! <a href=index.php?m=member&l=2>Member Center</a> | <a href=index.php?m=member&f=logout>Exit</a>\")";
		}
	}
}
?>