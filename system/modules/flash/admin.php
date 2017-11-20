<?php
class admin extends Checklogin{

	public function init(){
		template('flash_list','admin/flash');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('flash','`is_lock`='.$lockid,'`id`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'flash where `id`='.$id);
		assign('rs',$rs);
		template('flash_edit','admin/flash');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$title=safe_html($_POST['title']);
		$typeid=intval($_POST['typeid']);
		$sort=intval($_POST['sort']);
		$url=$_POST['url'];
		$thumb=safe_html($_POST['thumb']);
		if(empty($title)||empty($id)||empty($thumb)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('flash',"`title`='".$title."',`sort`='".$sort."',`typeid`='".$typeid."',`url`='".$url."',`thumb`='".$thumb."'",'`id`='.$id);
		$this->creat_xml($typeid);
		showmsg(C('update_success'),'index.php?m=flash&c=admin');
	}
	
	public function add(){
		template('flash_add','admin/flash');
	}
	
	public function addsave(){
		$title=safe_html($_POST['title']);
		$url=$_POST['url'];
		$typeid=intval($_POST['typeid']);
		$sort=intval($_POST['sort']);
		$thumb=safe_html($_POST['thumb']);
		if(empty($title)||empty($thumb)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('flash',"`title`='".$title."',`sort`='".$sort."',`typeid`='".$typeid."',`url`='".$url."',`thumb`='".$thumb."',`inputtime`='".datetime()."',`is_lock`=0");
		$this->creat_xml($typeid);
		showmsg(C('add_success'),'index.php?m=flash&c=admin');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one("select * from ".DB_PRE."flash where `id`=".$id);
		if(file_exists($rs['thumb'])){   //删除缩略图
			unlink($rs['thumb']);
		}
		$typeid=$rs['typeid'];
		unset($rs);
		$this->mysql->db_delete('flash','`id`='.$id);
		$this->creat_xml($typeid);
		showmsg(C('delete_success'),'-1');
	}

	public function list_type(){
		template('flash_type_list','admin/flash');
	}
	
	public function add_type(){
		template('flash_type_add','admin/flash');
	}
	
	public function add_type_save(){
		$name=safe_html($_POST['name']);
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_insert('flash_type',"`name`='".$name."'");
		showmsg(C('add_success'),'index.php?m=flash&c=admin&f=list_type');
	}
	
	public function edit_type(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'flash_type where `id`='.$id);
		assign('rs',$rs);
		template('flash_type_edit','admin/flash');
	}
	
	public function edit_type_save(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$name=safe_html($_POST['name']);
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		$this->mysql->db_update('flash_type',"`name`='".$name."'",'`id`='.$id);
		showmsg(C('update_success'),'index.php?m=flash&c=admin&f=list_type');
	}
	
	public function delete_type(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('flash_type','`id`='.$id);
		showmsg(C('delete_success'),'-1');
	}
	
	public function creat_xml($typeid){
		$content="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		$content.="<data>\n";
		$content.="<config>\n";
		$content.="<roundCorner>0</roundCorner>\n";
		$content.="<autoPlayTime>5</autoPlayTime>\n";
		$content.="<isHeightQuality>false</isHeightQuality>\n";
		$content.="<blendMode>normal</blendMode>\n";
		$content.="<transDuration>1</transDuration>\n";
		$content.="<windowOpen>_self</windowOpen>\n";
		$content.="<btnSetMargin>auto 5 5 auto</btnSetMargin>\n";
		$content.="<btnDistance>20</btnDistance>\n";
		$content.="<btnAlpha>.7</btnAlpha>\n";
		$content.="<btnTextColor>0x000000</btnTextColor>\n";
		$content.="<btnDefaultColor>0xffffff</btnDefaultColor>\n";
		$content.="<btnHoverColor>0x2374c2</btnHoverColor>\n";
		$content.="<btnFocusColor>0xffcc00</btnFocusColor>\n";
		$content.="<changImageMode>click</changImageMode>\n";
		$content.="<isShowBtn>true</isShowBtn>\n";
		$content.="<isShowTitle>true</isShowTitle>\n";
		$content.="<scaleMode>noBorder</scaleMode>\n";
		$content.="<transform>top</transform>\n";
		$content.="<isShowAbout>false</isShowAbout>\n";
		$content.="<titleFont>微软雅黑</titleFont>\n";
		$content.="</config>\n";
		$content.="<channel>\n";
		$query=$this->mysql->query("select * from ".DB_PRE."flash where typeid=".$typeid);
		while ($rs=$this->mysql->fetch_rows($query)){
			$content.="<item>\n";
			$content.="<link>".$rs["url"]."</link>\n";
			$content.="<image>".$rs["thumb"]."</image>\n";
			$content.="</item>\n";
		}
		$content.="</channel>\n";
		$content.="</data>";
		$file="uploadfile/flash".$typeid.".xml";
		creat_inc($file,$content);
	}
}

?>