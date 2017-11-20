<?php
class index extends db{	
	
	public function init($lang=''){
		$dir=$this->check_lang($lang);
		template($dir."index");
	}
	
	public function lists($catid='',$_page='',$lang=''){
		$dir=$this->check_lang($lang);
		global $page;
		if(empty($catid)){
			$catid=intval(safe_html($_GET['catid']));
		}
		
		if(empty($_page)){
			$page=isset($_GET['page'])?(int)$_GET['page']:0;
			$page=$page==0?1:$page;
		}else{
			$page=$_page;
		}
		
		$array=get_category($catid);
		$catids=ltrim(get_all_catids($catid),",");   //判断是否有子类
		if(empty($catids)){
			$name=str_replace('.html','',$array['template_list']);   //如果没有小类取出列表页模板名称
		}else{
			$child=explode(",",$catids); 
			assign('child',$child);
			$name=str_replace('.html','',$array['template_cate']);   //如果有小类取出栏目页模板名称
		}
		
		$this->left($catid);

		template($dir.$name);
	}
	
	public function show($catid='',$contentid='',$lang=''){
		$dir=$this->check_lang($lang);
		if(empty($catid)){
			$catid=intval(safe_html($_GET['catid']));
		}
		if(empty($contentid)){
			$contentid=intval(safe_html($_GET['id']));
		}
		
		$array=get_category($catid);
		$name=str_replace('.html','',$array['template_show']);
		$model=modelname($catid);
		$model_content=get_content_table($model);
		$sql="select * from ".DB_PRE.$model." as c,".DB_PRE.$model_content." as b where c.id=b.id and c.id=".$contentid;
		$rs_content=$this->mysql->get_one($sql);

		$this->left($catid);
		foreach($rs_content as $k=>$v){
			if($k=='content'){
				$rs[$k]=addlink(html_decode($v));
			}else{
				$rs[$k]=html_decode($v);
			}
		}
		
		//关键词
		if(!empty($rs['keywords'])){
			$keywords_array=explode(",",$rs['keywords']);
			if(is_array($keywords_array)){
				foreach($keywords_array as $v){
					$keywords .="<a href=\"index.php?f=search&catid=".$catid."&key=".urlencode($v)."\">".$v."</a> ";
				}
				assign('keywords',$keywords);
			}
		}
		//end
		
		//上一页 下一页
		$previous_rs=$this->mysql->get_one("select * from ".DB_PRE.$model." where `catid`='".$catid."' and `id` < ".$contentid." order by id desc");
		$next_rs=$this->mysql->get_one("select * from ".DB_PRE.$model." where `catid`='".$catid."' and `id` > ".$contentid." order by id asc");
		if($previous_rs){
			$previous="<a href=\"".$previous_rs['url']."\">".$previous_rs['title']."</a>";
		}else{
			$previous="没有了";
		}
		if($next_rs){
			$next="<a href=\"".$next_rs['url']."\">".$next_rs['title']."</a>";
		}else{
			$next="没有了";
		}
		assign('previous',$previous);
		assign('next',$next);
		//end
		
		assign('rs',$rs);
		template($dir.$name);
	}
	
	public function left($catid=''){
		$array=get_category($catid);
		//取出左侧最高级栏目
		$parent=is_parent($catid);
		if(!empty($parent)){
			$last_id=array_pop(explode(",",ltrim($parent,",")));  //栏目ID
			$left_title=catname($last_id);   //栏目名称
			$parentid=$last_id;   //赋值给父类ID
		}else{
			$left_title=$array['catname'];
			$parentid=$catid;
		}
		//end
		
		//判断栏目权限
		if(empty($_COOKIE['member_groupid'])){
			$groupid=0;
		}else{
			$groupid=intval($_COOKIE['member_groupid']);
		}
		if(get_power("member",$groupid,$catid)!=100){
			if(get_power("member",$groupid,$catid)==0){
				showmsg(C('admin_not_purview'),'-1');
			}
		}
		//end
		
		assign('cat',$array);  //加载栏目数组
		assign('left_title',$left_title);
		assign('left_menu',get_sort($parentid,0));
	}
	
	public function hits(){
		$id=intval(safe_html($_GET['id']));
		$catid=intval(safe_html($_GET['catid']));
		$model=modelname($catid);
		$rs=$this->mysql->get_one("select * from ".DB_PRE.$model." where id=".$id);
		$count_hits=$rs['hits']+1;
		$this->mysql->db_update($model,"hits=".$count_hits,"id=".$id);
		echo "document.write(\"".$count_hits."\")";
	}
	
	public function search(){ 
		$dir=$this->check_lang();
		$catid=intval(safe_html($_GET['catid']));
		$key=safe_replace(safe_html($_GET['key']));
		$model=modelname($catid);
		if(empty($key)){
			showmsg(C('error'),'-1');
		}
		$array=get_category($catid);
		
		$this->left($catid);
		
		//搜索条件
		$where="where url != '' ";
		if($catid){
			$categoryid=$catid.get_all_catids($catid);
			$where .= " and catid in(".$categoryid.")";
		}
		if($key){
			$where .= " and (title like '%".$key."%' or keywords like '%".$key."%' or description like '%".$key."%')";
		}
		assign("where",$where);
		//end
		
		assign("key",$key);
		assign("model",$model);
		assign('cat',$array);  //加载栏目数组
		template($dir."search");
	}
}
?>