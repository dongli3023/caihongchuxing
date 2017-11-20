<?php
//中文
class language extends Checklogin{

	public function init(){
		template('language_list','admin');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'language where `id`='.$id);
		assign('rs',$rs);
		template('language_edit','admin');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$title=safe_html($_POST['title']);
		$sitename=safe_html($_POST['sitename']);
		$dir=safe_html($_POST['dir']);
		$seo_title=safe_html($_POST['seo_title']);
		$seo_key=safe_html($_POST['seo_key']);
		$seo_des=safe_html($_POST['seo_des']);
		$copyright=$_POST['copyright'];
		if(empty($title)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('language',"`title`='".$title."',`sitename`='".$sitename."',`dir`='".$dir."',`seo_title`='".$seo_title."',`seo_key`='".$seo_key."',`seo_des`='".$seo_des."',`copyright`='".$copyright."'",'`id`='.$id);
		$this->language_cache();
		showmsg(C('update_success'),'index.php?m=xdcms&c=language');
	}
	
	public function add(){
		template('language_add','admin');
	}
	
	public function addsave(){
		$title=safe_html($_POST['title']);
		$sitename=safe_html($_POST['sitename']);
		$dir=safe_html($_POST['dir']);
		$seo_title=safe_html($_POST['seo_title']);
		$seo_key=safe_html($_POST['seo_key']);
		$seo_des=safe_html($_POST['seo_des']);
		$copyright=$_POST['copyright'];
		if(empty($title)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('language',"`title`='".$title."',`sitename`='".$sitename."',`dir`='".$dir."',`seo_title`='".$seo_title."',`seo_key`='".$seo_key."',`seo_des`='".$seo_des."',`copyright`='".$copyright."'");
		$this->language_cache();
		showmsg(C('add_success'),'index.php?m=xdcms&c=language');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('language','`id`='.$id);
		$this->language_cache();
		showmsg(C('delete_success'),'-1');
	}
	
	public function cache(){
		$this->language_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function language_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."language order by id asc");
		$s="<?php\n\$_language=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_language.php';
		creat_inc($file,$s);
	}
}

?>