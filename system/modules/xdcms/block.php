<?php
class block extends Checklogin{

	public function init(){
		template('block_list','admin');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'block where `id`='.$id);
		assign('rs',$rs);
		template('block_edit','admin');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$title=safe_html($_POST['title']);
		$tag=safe_html($_POST['tag']);
		$content=$_POST['content'];
		
		if(empty($title)||empty($tag)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		
		if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,15}$/',$tag)){ 
			showmsg(C('numbers_and_letters'),'-1');
		}
		
		$this->mysql->db_update('block',"`title`='".$title."',`tag`='".$tag."',`content`='".$content."'",'`id`='.$id);
		showmsg(C('update_success'),'index.php?m=xdcms&c=block');
	}
	
	public function add(){
		template('block_add','admin');
	}
	
	public function addsave(){
		$title=safe_html($_POST['title']);
		$tag=safe_html($_POST['tag']);
		$content=$_POST['content'];

		if(empty($title)||empty($tag)){
			showmsg(C('material_not_complete'),'-1');
		}
		
		if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,15}$/',$tag)){ 
			showmsg(C('numbers_and_letters'),'-1');
		}
		
		$user_num=$this->mysql->num_rows("select * from ".DB_PRE."block where `tag`='$tag'");//判断标签是否存在
		if($user_num>0){
			showmsg(C('catdir_exist'),'-1');
		}
		
		$this->mysql->db_insert('block',"`title`='".$title."',`tag`='".$tag."',`content`='".$content."'");
		showmsg(C('add_success'),'index.php?m=xdcms&c=block');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('block','`id`='.$id);
		showmsg(C('delete_success'),'-1');
	}
}

?>