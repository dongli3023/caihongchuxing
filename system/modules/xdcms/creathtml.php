<?php
class creathtml extends Checklogin{
	
	public $is_html;
	
	function __construct(){
		parent::check_admin();
		$this->html=base::load_class("html");
		$this->ob_url=base::load_class("url");
		$this->mysql=$this->html->mysql;
		$config=base::load_cache("cache_set_config","_config");
		$this->is_html=$config['createhtml'];
	}
	
	public function init(){
		template('main','admin');
	}
	
	//生成首页
	public function update_index(){
		if($this->is_html==1){
			$language=base::load_cache("cache_language","_language");
			foreach($language as $v){
				$this->html->creat_index($v['id'],$v['dir']);
			}
			showmsg(C('update_success'),'-1');
		}else{
			showmsg(C('config_html_error'),'index.php?m=xdcms&c=setting');
		}
	}
	
	//更新栏目页
	public function category_html(){
		//取得提交的栏目
		if(isset($_POST['category'])){
			$_SESSION["category_array"]=="";
			$category=$_POST['category'];
		}else{
			$category=$_SESSION["category_array"];
		}
		if(empty($category)){
			showmsg(C('error'),'-1');
		}
		
		foreach ($category as $value){
			$child=get_catids($value);
			if(empty($child)){          //如果没有子栏目
				$this->categoryinfo($category,$value);
			}else{
				$child_arr=explode(",",$child);
				$this->categoryinfo($category,$value,$child);
			}
		}
		showmsg(C('update_success'),'index.php?m=xdcms&c=categorytree&f=category_tree');
	}
	
	//更新内容页
	public function show_html(){
		
		//取得提交的栏目
		if(isset($_POST['category'])){
			$_SESSION["category_array"]=="";
			$category=$_POST['category'];
		}else{
			$category=$_SESSION["category_array"];
		}
		
		//生成栏目URL目录
		if(isset($_POST['category'])){
			foreach ($category as $value){
				$this->update_con_url($value);
			}
		}
		
		//处理提交的栏目生成静态
		if(!empty($category)){
			$catid=$category[0];
			$model=modelname($catid);
			$cate=get_category($catid);
			$this->category_array($category,$catid);
			showmsg("[".$cate['catname']."]内容开始生成...",'3',0,60000);
			if($this->is_html==1 && $cate['is_html']==1){
				$query=$this->mysql->query("select id,url from ".DB_PRE.$model." where `catid`=".$catid);
				while ($rs=$this->mysql->fetch_rows($query)){
					if(substr($rs['url'],0,7)!="http://"){   //判断url是否为外链,如不是则更新html
						$show[]=$rs['id'];
					}
				}
				$_SESSION["show_array"]=$show;
				$this->show_html_location($catid);
			}else{
				header_location("index.php?m=xdcms&c=creathtml&f=show_html");
			}
		}
		
		showmsg(C('update_success'),'index.php?m=xdcms&c=categorytree&f=show_tree');
	}
	
	//更新URL
	public function update_url(){
		//取得提交的栏目
		if(isset($_POST['category'])){
			$category=$_POST['category'];
		}else{
			showmsg(C('error'),'-1');
		}
		
		foreach ($category as $value){
			$this->update_con_url($value);
		}
		
		showmsg(C('update_success'),'-1');
	}
	
	//根据栏目ID更新栏目下所有内容url
	private function update_con_url($catid){       
		$cate=get_category($catid);
		$model=modelname($catid);
		$this->ob_url->caturl($catid,$cate['catdir'],$cate['is_html'],0,0,$cate['url_list']);
		$query=$this->mysql->query("select id,url,inputtime from ".DB_PRE.$model." where `catid`=".$catid);
		while ($rs=$this->mysql->fetch_rows($query)){
			if(substr($rs['url'],0,7)!="http://"){   //判断url是否为外链,如不是则更新url
				$url=$this->ob_url->conurl($catid,$rs['id'],$cate['is_html'],$rs['inputtime']);
				$this->mysql->db_update($model,"`url`='".$url."'","`id`=".$rs['id']);
			}
		}
	}
	
	//接收URL传递过来的分页生成栏目
	public function cate_html(){
		$catid=intval(safe_html($_GET['catid']));
		$ipage=intval(safe_html($_GET['ipage']));
		$countpage=intval(safe_html($_GET['countpage']));
		$cate=get_category($catid);
		$this->html->creat_list($catid,$ipage,$cate["url"].$ipage.".html",$cate['lang']);
		
		showmsg("[".$cate['catname']."]第".$ipage."页生成完成",'3',0,60000);
		
		if($ipage < $countpage){
			$ipage++;
			$this->category_html_location($catid,$ipage,$countpage,$cate['lang']);
			exit;
		}
		if(empty($_SESSION["category_array"])){
			$_SESSION["category_array"]="";
			header_location("index.php?m=xdcms&c=categorytree&f=category_tree");
		}else{
			header_location("index.php?m=xdcms&c=creathtml&f=category_html");
		}
	}
	
	//更新栏目页，计算总页数，分页传递处理
	private function categoryinfo($category,$catid,$child=''){
		$cate=get_category($catid);
		$this->ob_url->caturl($catid,$cate['catdir'],$cate['is_html'],0,0,$cate['url_list']);
		$this->update_category_html($catid,0);
		if($this->is_html==1 && $cate['is_html']==1){
			$model=modelname($catid);
			if(empty($child)){
				$nums=$this->mysql->db_num($model,"`catid`=".$catid);
			}else{
				$nums=$this->mysql->db_num($model,"`catid` in(".$child.")");
			}
			$total=ceil($nums/$cate['pagesize']);
			$this->category_array($category,$catid);
			$this->category_html_location($catid,1,$total,$cate['lang']);
		}
	}
	
	//根据栏目ID更新栏目首页html
	private function update_category_html($catid,$parent){    
		$cate=get_category($catid);
		$this->ob_url->caturl($catid,$cate['catdir'],$cate['is_html'],0,0,$cate['url_list']);
		if($this->is_html==1 && $cate['is_html']==1 && $cate['is_link']==0){
			$this->html->creat_list($catid,1,$cate["url"]."index.html",$cate['lang']);
		}
		if($parent==1&&!empty($_SESSION["category_array"])){
			header_location("index.php?m=xdcms&c=creathtml&f=category_html");
		}
	}
	
	//接收URL传递过来的内容页生成栏目
	public function show_url_html(){      
		$catid=isset($_GET['catid'])?intval($_GET['catid']):0; 
		$this->showinfo($catid);
	}
	
	//处理内容页每页生成
	private function showinfo($catid){
		$show=isset($_SESSION["show_array"])?$_SESSION["show_array"]:"";
		if(!empty($show)){
			$cate=get_category($catid);
			$model=modelname($catid);
			$id=$show[0];
			$rs_content=$this->mysql->get_one("select url from ".DB_PRE.$model." where `id`=".$id);
			$this->show_array($show,$id);
			$this->html->creat_show($catid,$id,$rs_content['url'],$cate['lang']);
			showmsg("[".$cate['catname']."]内容ID：".$id."生成完成",'3',0,60000);
			$this->show_html_location($catid);
		}else{
			header_location("index.php?m=xdcms&c=creathtml&f=show_html");
		}
	}
	
	//处理提交的栏目数组
	private function category_array($array,$catid){
		$array=array_element($array,$catid);
		$_SESSION["category_array"]=$array;
	}
	
	//栏目分页跳转
	private function category_html_location($catid,$ipage,$countpage,$lang){
		header_location("index.php?m=xdcms&c=creathtml&f=cate_html&l=".$lang."&catid=".$catid."&ipage=".$ipage."&countpage=".$countpage);
	}
	
	//处理提交的内容数组
	private function show_array($array,$id){
		$array=array_element($array,$id);
		$_SESSION["show_array"]=$array;
	}
	
	//内容页生成跳转
	private function show_html_location($catid){
		header_location("index.php?m=xdcms&c=creathtml&f=show_url_html&catid=".$catid);
	}
}

?>