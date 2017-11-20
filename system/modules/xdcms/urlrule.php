<?php
class urlrule extends Checklogin{

	public function init(){
		template('urlrule_list','admin');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'urlrule where `id`='.$id);
		assign('rs',$rs);
		template('urlrule_edit','admin');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$class=safe_html($_POST['class']);
		$ishtml=intval($_POST['ishtml']);
		$is_fixed=$_POST['is_fixed'];
		$urldemo=$_POST['urldemo'];
		$url=$_POST['url'];
		if(empty($class)||empty($url)||empty($id)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('urlrule',"`class`='".$class."',`ishtml`='".$ishtml."',`is_fixed`='".$is_fixed."',`urldemo`='".$urldemo."',`url`='".$url."'",'`id`='.$id);
		$this->urlrule_cache();
		showmsg(C('update_success'),'index.php?m=xdcms&c=urlrule');
	}
	
	public function add(){
		template('urlrule_add','admin');
	}
	
	public function addsave(){
		$class=safe_html($_POST['class']);
		$ishtml=intval($_POST['ishtml']);
		$is_fixed=$_POST['is_fixed'];
		$urldemo=$_POST['urldemo'];
		$url=$_POST['url'];
		if(empty($class)||empty($url)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('urlrule',"`class`='".$class."',`ishtml`='".$ishtml."',`is_fixed`='".$is_fixed."',`urldemo`='".$urldemo."',`url`='".$url."'");
		$this->urlrule_cache();
		showmsg(C('add_success'),'index.php?m=xdcms&c=urlrule');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('urlrule','`id`='.$id);
		$this->urlrule_cache();
		showmsg(C('delete_success'),'-1');
	}
	
	public function cache(){
		$this->urlrule_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function urlrule_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."urlrule order by id asc");
		$s="<?php\n\$_urlrule=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_urlrule.php';
		creat_inc($file,$s);
	}
}

?>