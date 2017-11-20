<?php
class template extends Checklogin{

	public function init(){
		assign("template_list",get_tem_file(""));
		template('template_list','admin');
	}
	
	public function edit(){
		$filename=$_GET['file'];
		
		//判断是否允许编辑模板，请在cache_set_config.php修改is_modify的值
		$config_arr=base::load_cache('cache_set_config','_config');
		if($config_arr['is_modify']==1){
			showmsg(C('no_modify_template'),'-1');
		}
		
		//判断非html页面不能打开
		$suffix=get_suffix($filename);
		if($suffix!='html'){
			showmsg(C('error'),'-1');
		}
		
		$file=TP_PATH.TP_FOLDER."/".$filename;
		if(!$fp=@fopen($file,'r+')){
			showmsg(C('open_template_error'),'-1');
		}
		flock($fp,LOCK_EX);
		$str=@fread($fp,filesize($file));
		flock($fp,LOCK_UN);
		fclose($fp);
		assign('filename',$filename);
		assign('content',$str);
		template('template_edit','admin');
	}
	
	public function edit_save(){
		$file = $_POST['file'];
		$content=stripslashes($_POST['content']);
		
		//判断不能保存非html页面
		$suffix=get_suffix($file);
		if($suffix!='html'){
			showmsg(C('error'),'-1');
		}
		
		$file=TP_PATH.TP_FOLDER."/".$file;
		//判断文件是否存在
		if(!file_exists($file)){
			showmsg(C('file_not_exist'),'-1');
		}
		if(!$fp=@fopen($file,'w+')){
			showmsg(C('open_template_error'),'-1');
		}
		flock($fp,LOCK_EX);
		fwrite($fp,$content);
		flock($fp,LOCK_UN);
		fclose($fp);
		showmsg(C('update_success'),'-1');
	}
	
	public function calls(){
		template('template_calls','admin');
	}
}

?>