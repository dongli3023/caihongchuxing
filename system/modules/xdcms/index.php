<?php
//中文
class index extends Checklogin{
	
	public function init(){
		$lang=isset($_GET['l'])?intval($_GET['l']):1;
		setcookie('lang',$lang);
		assign("lang",$lang);
		template("index","admin");
	}
	
	public function top(){
		$menu=base::load_cache("cache_menu","_menu");
		$language=base::load_cache("cache_language","_language");
		$array=get_array($menu,'parentid',0,0);
		$lang=get_lang($_COOKIE['lang']);
		assign("lang_title",$lang['title']);
		assign("top_menu",$array);
		assign("language",$language);
		assign("array_count",count($array));
		template('top','admin');
	}
	
	public function left(){
		$id=isset($_GET['id'])?intval($_GET['id']):1;
		if($id==3){
			$menu=$this->get_admin_category(0,0);
		}else{
			$menu=$this->get_admin_menu($id,0);
		}
		assign("menu",$menu.left_bottom_menu());
		template("left","admin");
	}
	
	public function main(){
		$server["software"]=$_SERVER['SERVER_SOFTWARE'];
		$server["root"]=$_SERVER['DOCUMENT_ROOT'];
		$server["upload"]=get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件";
		$server["execution"]=get_cfg_var("max_execution_time");
		$server["time"]=datetime();
		$server["version"]=PHP_VERSION;
		$server["mysql_version"]=$this->mysql->server_info();
		$server["cms_version"]=cmsversion();
		
		assign("notice",notice());
		assign("server",$server);
		template("main","admin");
	}
	
	public function edit(){
		template('password','admin');
	}
	
	public function editsave(){
		$id=$_SESSION['admin_id'];
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
		
		$rs=$this->mysql->get_one("select * from ".DB_PRE."admin where `id`=".$id);
		$oldpassword=password($oldpassword,$rs['encrypt']);
		if($rs['password']!=$oldpassword){
			showmsg(C('password_error'),'-1');
		}
		
		$pwd=password($password);
		$this->mysql->db_update('admin',"`password`='".$pwd['password']."',`encrypt`='".$pwd['encrypt']."'",'`id`='.$id);
		unset($_SESSION['admin']);
		unset($_SESSION['admin_id']);
		showmsg(C('update_success'),'index.php?m=xdcms&c=login');
	}

	//从数据库读取下属频道
	private function get_admin_menu($id,$level) {
		$menu=base::load_cache("cache_menu","_menu");
		$row=get_array($menu,'parentid',$id,1);
		$groupid=$_SESSION['groupid'];
		if(is_array($row)){
			$admin_menu .="<ul>\n";
			foreach($row as $value){
				$group_str=strstr($value['groupid'],$groupid);
				if(empty($value['groupid']) || $group_str!=''){
					$array=$this->get_admin_menu($value["menuid"], $level+1);
					$admin_menu .="<li ";
					if(!empty($array)){
						$admin_menu .="class=\"parent\"";
					}else{
						$admin_menu .="class=\"child\"";
					}
					$admin_menu .=">";
					$admin_menu .="<a href=\"".$value["url"]."\"";
					if(empty($array)){
						$admin_menu .="target=\"main\"";
					}
					$admin_menu .=">".$value["title"]."</a>";
					
					$son = $this->get_admin_menu($value["menuid"], $level+1);  //如果有子类即循环
					if(!empty($son)){
						$admin_menu .=$son;
					}
					$admin_menu .="</li>\n";
				}
			} 
			$admin_menu .="</ul>\n";
		}
		return $admin_menu;
	}
	
	//从数据库读取栏目
	private function get_admin_category($id,$level) {
		$category=base::load_cache("cache_category","_category");
		$row=get_array($category,'parentid',$id,0);
		$lang=isset($_COOKIE['lang'])?intval($_COOKIE['lang']):1;
		if(is_array($row)){
			$admin_category .="<ul>\n";
			foreach($row as $value){
				if($value['is_link']==0 && $value['lang']==$lang){
					$son=$this->get_admin_category($value["catid"], $level+1);
					if(!empty($son)){
						$admin_category .="<li class=\"parent\">";
					}else{
						$admin_category .="<li class=\"child\">";
					}
					$admin_category .="<a href=\"index.php?m=xdcms&c=content&catid=".$value["catid"]."\" target=\"main\">".$value["catname"]."</a>";
					
					//如果有子类即循环
					if(!empty($son)){
						$admin_category .=$son;
					}
					$admin_category .="</li>\n";
				}
				
			} 
			$admin_category .="</ul>\n";
		}
		return $admin_category;
	}
}

?>