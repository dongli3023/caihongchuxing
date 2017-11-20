<?php
class menu extends Checklogin{
	
	function init(){
		template('menu_list','admin');
	}
	
	function lists(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		assign("menu",$this->tree($id,0));
		template('menu_son_list','admin');
	}
	
	public function add(){
		$parentid=isset($_GET['p'])?intval($_GET['p']):0;
		assign("parentid",$parentid);
		assign("menu",$this->tree(0,0));
		template('menu_add','admin');
	}
	
	public function add_save(){
		$title=$_POST['title'];
		$sort=intval($_POST['sort']);
		$is_show=$_POST['is_show'];
		$groupid=$_POST['groupid'];
		$url=$_POST['url'];
		$parentid=isset($_POST['parentid'])?intval($_POST['parentid']):0;
		
		if(empty($title)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(is_array($groupid)){
			$group_str=implode(',',$groupid);
		}
		
		$sql="insert into ".DB_PRE."menu (title,url,parentid,sort,is_show,groupid) values ('".$title."','".$url."','".$parentid."','".$sort."','".$is_show."','".$group_str."')";
		$this->mysql->query($sql);
		$this->menu_cache();
		showmsg(C('add_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one("select * from ".DB_PRE."menu where `menuid`=".$id);
		assign("rs",$rs);
		assign("menu",$this->tree(0,0));
		template('menu_edit','admin');
	}
	
	public function edit_save(){
		$menuid=intval($_POST['menuid']);
		$title=$_POST['title'];
		$sort=intval($_POST['sort']);
		$is_show=$_POST['is_show'];
		$groupid=$_POST['groupid'];
		$url=$_POST['url'];
		$parentid=isset($_POST['parentid'])?intval($_POST['parentid']):0;
		
		if(empty($menuid)||empty($title)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(is_array($groupid)){
			$group_str=implode(',',$groupid);
		}
		
		$this->mysql->db_update("menu","`title`='".$title."',`url`='".$url."',`sort`='".$sort."',`is_show`='".$is_show."',`groupid`='".$group_str."',`parentid`='".$parentid."'","`menuid`=".$menuid);
		$this->menu_cache();
		showmsg(C('update_success'),'index.php?m=xdcms&c=menu');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->delete_son($id);
		$this->menu_cache();
		showmsg(C('delete_success'),'-1');
	}
	
	private function delete_son($id){
		$query=$this->mysql->query("select * from ".DB_PRE."menu where `parentid`=".$id);
		while($rs=$this->mysql->fetch_rows($query)){
			$this->delete_son($rs['menuid']);
		}
		$this->mysql->db_delete("menu","`menuid`=".$id);
	}
	
	public function cache(){
		$this->menu_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function menu_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."menu order by sort asc,menuid asc");
		$s="<?php\n\$_menu=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_menu.php';
		creat_inc($file,$s);
	}
	
	private function tree($parentid,$level){
		$query=$this->mysql->query("select * from ".DB_PRE."menu where `parentid`=".$parentid." and menuid!=3 order by sort asc,menuid asc");
		while($rs=$this->mysql->fetch_rows($query)){
			if ($level>=1){
				$prefix = str_pad("|",$level+1,'-',STR_PAD_RIGHT);
			}else{
				$prefix = "";
			}
			$trees[] = array('title'=>$prefix.$rs["title"],'parentid' => $rs["parentid"],'menuid' => $rs["menuid"],'sort' => $rs["sort"]);
			
			$sort = $this->tree($rs["menuid"], $level+1);  //如果有子类即循环
			if(is_array($sort)){
				foreach($sort as $v){
					$trees[] = array('title'=>$v["title"],'parentid' => $v["parentid"],'menuid' => $v["menuid"],'sort' => $v["sort"]);
				}
			}
		}
		
		return $trees;
		
	}
	
	public function sort_save(){
		$menuid=$_POST['menuid'];
		foreach($menuid as $val){
			$sort=$_POST["sort{$val}"];
			if(is_numeric($sort)){
				$this->mysql->db_update("menu","`sort`='".$sort."'","`menuid`=".$val);
			}
		}
		$this->menu_cache();
		showmsg(C('update_success'),'index.php?m=xdcms&c=menu');
	}
}

?>