<?php
class category extends Checklogin{
	
	function __construct(){
		parent::check_admin();
		$this->ob_tree=base::load_class("catetree");
		$this->mysql=$this->ob_tree->mysql;
	}
	
	function init(){
		$this->ob_tree->tree(0);
		template('category_list','admin');
	}
	
	public function add(){
		$parentid=isset($_GET['p'])?intval($_GET['p']):0;
		$config=base::load_cache("cache_set_config","_config");
		$model_arr=base::load_cache('cache_model','_model');
		$lang_arr=base::load_cache('cache_language','_language');
		$urlrule=base::load_cache("cache_urlrule","_urlrule");
		$url_list=get_array($urlrule,"class","list");
		$url_show=get_array($urlrule,"class","show");
		$lang=get_lang($_COOKIE['lang']);
		if(!empty($lang['dir'])){
			$tem_dir=TP_PATH.TP_FOLDER.'/'.$lang['dir'].'/';
		}
		$this->ob_tree->tree(1);
		
		//根据系统总设置，默认是否静态设置
		if($config['createhtml']==1){
			$url_arr=array(1,3,4);
		}elseif($config['createhtml']==2){
			$url_arr=array(2,5,6);
		}else{
			$url_arr=array(0,1,2);
		}
		
		assign("url_arr",$url_arr);
		assign("model",$model_arr);
		assign("lang",$lang_arr);
		assign("parentid",$parentid);
		assign("parentname",catname($parentid));
		assign("template_cate",get_tem_file("cate",$tem_dir));
		assign("template_list",get_tem_file("list",$tem_dir));
		assign("template_show",get_tem_file("show",$tem_dir));
		assign("url_list",$url_list);
		assign("url_show",$url_show);
		template('category_add','admin');
	}
	
	public function add_save(){
		$config=base::load_cache("cache_set_config","_config");
		$catname=safe_html($_POST['catname']);
		$encatname=safe_html($_POST['encatname']);
		$description=safe_html($_POST['description']);
		$catdir=$_POST['catdir'];
		$thumb=safe_html($_POST['thumb']);
		$is_link=intval($_POST['is_link']);
		$url=$_POST['url'];
		$model=safe_html($_POST['model']);
		$sort=intval($_POST['sort']);
		$is_show=intval($_POST['is_show']);
		$parentid=intval($_POST['parentid']);
		$is_target=intval($_POST['is_target']);
		$is_html=intval($_POST['is_html']);
		$template_cate=safe_html($_POST['template_cate']);
		$template_list=safe_html($_POST['template_list']);
		$template_show=safe_html($_POST['template_show']);
		$seo_title=safe_html($_POST['seo_title']);
		$seo_key=safe_html($_POST['seo_key']);
		$seo_des=safe_html($_POST['seo_des']);
		$url_list=intval($_POST['url_list']);
		$url_show=intval($_POST['url_show']);
		$modelid=modelid($model);
		$power=addslashes(var_export($_POST['power'],true));
		$lang=isset($_POST['lang'])?intval($_POST['lang']):1;
		$pagesize=intval($_POST['pagesize']);
		
		if(empty($catname)||empty($catdir)||empty($model)||empty($pagesize)){
			showmsg(C('material_not_complete'),'-1');
		}
		
		if(!check_str($catdir,'/^[a-z0-9][a-z0-9]*$/')){
			showmsg(C('catdir').C('numbers_and_letters'),'-1');
		}
		
		if($is_html==1){
			if($config['createhtml']!=1){
				showmsg(C('config_html_error'),'index.php?m=xdcms&c=setting');
			}
		}
		
		$nums=$this->mysql->db_num("category","catdir='".$catdir."'");
		if($nums>0){
			showmsg(C('catdir_exist'),'-1');
		}
		
		$sql="insert into ".DB_PRE."category (catname,encatname,description,catdir,thumb,is_link,url,model,modelid,sort,is_show,is_target,is_html,template_cate,template_list,parentid,template_show,seo_title,seo_key,seo_des,power,lang,url_list,url_show,pagesize) values ('".$catname."','".$encatname."','".$description."','".$catdir."','".$thumb."','".$is_link."','".$url."','".$model."','".$modelid."','".$sort."','".$is_show."','".$is_target."','".$is_html."','".$template_cate."','".$template_list."','".$parentid."','".$template_show."','".$seo_title."','".$seo_key."','".$seo_des."','".$power."','".$lang."','".$url_list."','".$url_show."','".$pagesize."')";
		$this->mysql->query($sql);
		$catid=$this->mysql->insert_id();
		
		if($is_link==0){//生成url
			$ob_url=base::load_class("url");
			$url=$ob_url->caturl($catid,$catdir,$is_html,0,$lang,$url_list);
			$this->mysql->db_update("category","`url`='".$url."'","`catid`=".$catid);
		}
		
		$this->category_cache();
		showmsg(C('add_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$model_arr=base::load_cache('cache_model','_model');
		$category=base::load_cache('cache_category','_category');
		$lang_arr=base::load_cache('cache_language','_language');
		$urlrule=base::load_cache("cache_urlrule","_urlrule");
		$url_list=get_array($urlrule,"class","list");
		$url_show=get_array($urlrule,"class","show");
		$lang=get_lang($_COOKIE['lang']);
		if(!empty($lang['dir'])){
			$tem_dir=TP_PATH.TP_FOLDER.'/'.$lang['dir'].'/';
		}
		$array=get_category($id);
		$this->ob_tree->tree(1);
		assign("model",$model_arr);
		assign("rs",$array);
		assign("lang",$lang_arr);
		assign("catname",catname($array['parentid']));
		assign("template_cate",get_tem_file("cate",$tem_dir));
		assign("template_list",get_tem_file("list",$tem_dir));
		assign("template_show",get_tem_file("show",$tem_dir));
		assign("url_list",$url_list);
		assign("url_show",$url_show);
		
		template('category_edit','admin');
	}
	
	public function edit_save(){
		$config=base::load_cache("cache_set_config","_config");
		$catid=intval($_POST['catid']);
		$catname=safe_html($_POST['catname']);
		$encatname=safe_html($_POST['encatname']);
		$description=safe_html($_POST['description']);
		$catdir=$_POST['catdir'];
		$thumb=safe_html($_POST['thumb']);
		$is_link=intval($_POST['is_link']);
		$url=$_POST['url'];
		$sort=intval($_POST['sort']);
		$is_show=intval($_POST['is_show']);
		$parentid=intval($_POST['parentid']);
		$is_target=intval($_POST['is_target']);
		$is_html=intval($_POST['is_html']);
		$template_cate=safe_html($_POST['template_cate']);
		$template_list=safe_html($_POST['template_list']);
		$template_show=safe_html($_POST['template_show']);
		$seo_title=safe_html($_POST['seo_title']);
		$seo_key=safe_html($_POST['seo_key']);
		$seo_des=safe_html($_POST['seo_des']);
		$url_list=intval($_POST['url_list']);
		$url_show=intval($_POST['url_show']);
		$model=safe_html($_POST['model']);
		$modelid=modelid($model);
		$power=addslashes(var_export($_POST['power'],true));
		$lang=isset($_POST['lang'])?intval($_POST['lang']):1;
		$pagesize=intval($_POST['pagesize']);
		
		if(empty($catname)||empty($catdir)||empty($catid)||empty($pagesize)){
			showmsg(C('material_not_complete'),'-1');
		}
		
		if(!check_str($catdir,'/^[a-z0-9][a-z0-9]*$/')){
			showmsg(C('catdir').C('numbers_and_letters'),'-1');
		}
		
		if($is_html==1){
			if($config['createhtml']!=1){
				showmsg(C('config_html_error'),'index.php?m=xdcms&c=setting');
			}
		}
		
		$nums=$this->mysql->db_num("category","catdir='".$catdir."' and catid!=".$catid);
		if($nums>0){
			showmsg(C('catdir_exist'),'-1');
		}
		
		//判断栏目是否有数据，否则不予更改模型
		$rs=$this->mysql->get_one("select catid,model from ".DB_PRE."category where `catid`=".$catid);
		if($rs['model']!=$model){
			$catnum=$this->mysql->db_num($rs['model'],"catid=".$catid);
			if($catnum>0){
				showmsg(C('category_have_data'),'-1');
			}
		}
		
		if($is_link==0){   //生成url
			$ob_url=base::load_class("url");
			$url=$ob_url->caturl($catid,$catdir,$is_html,0,$lang,$url_list);
		}
		
		$this->mysql->db_update("category","`catname`='".$catname."',`encatname`='".$encatname."',`description`='".$description."',`catdir`='".$catdir."',`thumb`='".$thumb."',`is_link`='".$is_link."',`url`='".$url."',`sort`='".$sort."',`is_show`='".$is_show."',`is_target`='".$is_target."',`is_html`='".$is_html."',`parentid`='".$parentid."',`template_cate`='".$template_cate."',`template_list`='".$template_list."',`template_show`='".$template_show."',`seo_title`='".$seo_title."',`seo_key`='".$seo_key."',`seo_des`='".$seo_des."',`power`='".$power."',`lang`='".$lang."',`model`='".$model."',`modelid`='".$modelid."',`url_list`='".$url_list."',`url_show`='".$url_show."',`pagesize`='".$pagesize."'","`catid`=".$catid);
		$this->category_cache();
		showmsg(C('update_success'),'index.php?m=xdcms&c=category');
	}
	
	public function sort_save(){
		$catid=$_POST['catid'];
		foreach($catid as $val){
			$sort=$_POST["sort{$val}"];
			if(is_numeric($sort)){
				$this->mysql->db_update("category","`sort`='".$sort."'","`catid`=".$val);
			}
		}
		$this->category_cache();
		showmsg(C('update_success'),'index.php?m=xdcms&c=category');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$model=modelname($id);
		$num=$this->mysql->db_num($model,"`catid`=".$id);
		if($num>0){
			showmsg(C('clear_data'),'-1');
		}
		unset($num);
		
		$num=$this->mysql->db_num("category","`parentid`=".$id);
		if($num>0){
			showmsg(C('delete_next_category'),'-1');
		}
		unset($num);
		
		$this->mysql->db_delete("category","`catid`=".$id);
		$this->category_cache();
		showmsg(C('delete_success'),'-1');
	}
	
	public function clear_data(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$num=$this->mysql->db_num("category","`parentid`=".$id);
		if($num>0){
			showmsg(C('clear_next_category'),'-1');
		}
		$rs=$this->mysql->get_one("select catid,model from ".DB_PRE."category where `catid`=".$id);
		$model=$rs['model'];
		$model_content=get_content_table($model);
		unset($rs);
		$query=$this->mysql->query("select catid,id from ".DB_PRE.$model." where `catid`=".$id);
		while($rs=$this->mysql->fetch_rows($query)){
			$this->mysql->db_delete($model_content,"`id`=".$rs['id']);
		}
		$this->mysql->db_delete($model,"`catid`=".$id);
		showmsg(C('success'),'-1');
	}
	
	public function cache(){
		$this->category_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function category_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."category order by sort asc,catid asc");
		$s="<?php\n\$_category=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_category.php';
		creat_inc($file,$s);
		
		//生成栏目权限缓存
		$query=$this->mysql->query("select catid,power from ".DB_PRE."category");
		while($rs=$this->mysql->fetch_rows($query)){
			if(!empty($rs['power'])){
				$s="<?php\n\$_power=".html_decode($rs['power']).";\n?>";
				$file=CACHE_SYS_PATH.'cache_category_power_'.$rs['catid'].'.php';
				creat_inc($file,$s);
			}
		}
	}
}

?>