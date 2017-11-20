function checksignup()
{
	if ( document.form.username.value == '' )
	{
		window.alert('请输入用户名!');
		document.form.username.focus();
	}
	else if
	( document.form.password.value == '' ) {
		window.alert('请输入登陆密码!!');
		document.form.password.focus();
	}
	else if ( document.form.verifycode.value == '' )
	{
		window.alert('请输入网页上显示的四位数验证码!!');
		document.form.verifycode.focus();
	}
   else
   {
	return true;
	}
	return false;
}