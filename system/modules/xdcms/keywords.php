<?php
//中文
class keywords extends Checklogin{

	public function init(){
		template('keywords_list','admin');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'keywords where `id`='.$id);
		assign('rs',$rs);
		template('keywords_edit','admin');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$title=safe_html($_POST['title']);
		$url=$_POST['url'];
		if(empty($title)||empty($url)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('keywords',"`title`='".$title."',`url`='".$url."'",'`id`='.$id);
		$this->keywords_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function add(){
		template('keywords_add','admin');
	}
	
	public function addsave(){
		$title=safe_html($_POST['title']);
		$url=$_POST['url'];
		if(empty($title)||empty($url)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('keywords',"`title`='".$title."',`url`='".$url."'");
		$this->keywords_cache();
		showmsg(C('add_success'),'index.php?m=xdcms&c=keywords');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('keywords','`id`='.$id);
		$this->keywords_cache();
		showmsg(C('delete_success'),'-1');
	}
	
	public function cache(){
		$this->keywords_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function keywords_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."keywords order by id asc");
		$s="<?php\n\$_keywords=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_keywords.php';
		creat_inc($file,$s);
	}
}

?>