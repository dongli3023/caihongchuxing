<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * url生成类
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/ 
class url{
	/*
	 *生成栏目Url
	 *catid栏目ID  catdir栏目目录  ishtml是否生成静态   check_parent_html是否判断父类html
	 */
	public function caturl($catid,$catdir,$ishtml,$check_parent_html='0',$language='0',$urlid){
		$config=base::load_cache("cache_set_config","_config");
		$html=$config['createhtml'];
		
		//生成url
		$urlrule=base::load_cache("cache_urlrule","_urlrule");
		$url_array=get_array($urlrule,"id",$urlid);
		$urlrule=$url_array[0]['url'];
		$urlhtml=$url_array[0]['ishtml'];
		
		//判断是否生成静态
		if($ishtml==1 && $urlhtml!=1){
			showmsg(C('url_error'),'-1');
		}elseif($ishtml==0 && $urlhtml==1){
			showmsg(C('url_error'),'-1');
		}
		
		$cate_arr=get_category($catid);
		if($language==0){
			$language=$cate_arr['lang'];
		}
		
		//替换参数
		$parameters=array("[categorydir]","[catdir]","[catid]","[page].html","[page]","[languageid]","[languagedir]");
		
		//取出父类目录
		$parent=is_parent($catid);
		if(!empty($parent)){
			$array=array_reverse(explode(",",ltrim($parent,",")));   //把数据倒序
			$dir="";
			foreach($array as $v){
				$category=get_category($v);
				$dir.=$category['catdir']."/";
			}
			$dir=rtrim($dir,"/");
		}
			
		//取得语言目录
		$lang=get_lang($language);
		if(!empty($lang['dir'])){
			$lang_dir=$lang['dir'].'/';
			if (!file_exists($lang_dir)) {
				mkdir($lang_dir);
			}
		}else{
			$lang_dir="";
		}
		
		//得到参数值
		$value=array($dir,$catdir,$catid,'index.html','1',$language,$lang_dir);
		
		
		//得到url
		$url=str_replace($parameters,$value,$urlrule);
		
		//判断是否要生成目录
		if($html==1 && $ishtml==1){
			
			//判断父类是否已设置生成html
			if(!empty($parent) && $check_parent_html==0){
				$last_id=array_pop(explode(",",ltrim($parent,",")));  //取出数组最后一个成员                   
				$cathtml=get_category($last_id);
				if($cathtml['is_html']==0){    
					showmsg(C('parent_not_html'),'-1');
				}
			}
			//end
			
			//根据url生成栏目目录
			if($urlhtml==1){
				$dir_array=explode("/",$url);  //把url转化为数组
				$extension=stristr($url,".html");
				if(!empty($extension)){
					array_pop($dir_array);
				}
				
				$dirurl=CMS_PATH;
				foreach($dir_array as $v){
					$dirurl.=$v."/";
					if (!file_exists($dirurl)) {
						@mkdir($dirurl);
					}
				}
			}
		}
		
		//生成最后的url
		$url=ltrim(str_replace("//","/",str_replace("index.html","",$url)),"/");
		
		return $url;
	}
	
	//生成文章Url
	public function conurl($catid,$contentid,$ishtml,$inputtime){
		$config=base::load_cache("cache_set_config","_config");
		$html=$config['createhtml'];
		
		$cat_arr=get_category($catid);
		$catdir=$cat_arr['catdir'];//当前栏目目录
		$urlid=$cat_arr['url_show'];

		//生成url
		$urlrule=base::load_cache("cache_urlrule","_urlrule");
		$url_array=get_array($urlrule,"id",$urlid);
		$urlrule=$url_array[0]['url'];
		$urlhtml=$url_array[0]['ishtml'];
		//判断是否生成静态
		if($ishtml==1 && $urlhtml!=1){
			showmsg(C('url_error'),'-1');
		}elseif($ishtml==0 && $urlhtml==1){
			showmsg(C('url_error'),'-1');
		}
		//替换参数
		$parameters=array("[categorydir]","[catdir]","[year]","[month]","[day]","[catid]","[id]","[languageid]","[languagedir]");
		
		//取出父类目录
		$parent=is_parent($catid);
		if(!empty($parent)){
			$array=array_reverse(explode(",",ltrim($parent,",")));   //把数据倒序
			$dir="";
			foreach($array as $v){
				$category=get_category($v);
				$dir.=$category['catdir']."/";
			}
			$dir=rtrim($dir,"/");
		}else{
			$dir="";
		}
		
		$year=date("Y",$inputtime);
		$month=date("n",$inputtime);
		$day=date("j",$inputtime);
			
		//取得语言目录
		$lang=get_lang($cat_arr['lang']);
		if(!empty($lang['dir'])){
			$lang_dir=$lang['dir'].'/';
			if (!file_exists($lang_dir)) {
				mkdir($lang_dir);
			}
		}else{
			$lang_dir="";
		}
		
		//得到参数值
		$value=array($dir,$catdir,$year,$month,$day,$catid,$contentid,$cat_arr['lang'],$lang_dir);
		
		//得到url
		$url=str_replace($parameters,$value,$urlrule);
		
		//判断是否要生成目录
		if($html==1 && $ishtml==1){
			//根据url生成栏目目录
			if($urlhtml==1){
				$dir_array=explode("/",$url);  //把url转化为数组
				$extension=stristr($url,".html");
				if(!empty($extension)){
					array_pop($dir_array);
				}
				
				$dirurl=CMS_PATH;
				if(is_array($dir_array)){
					foreach($dir_array as $v){
						$dirurl.=$v."/";
						if (!file_exists($dirurl)) {
							@mkdir($dirurl);
						}
					}
				}
			}
		}
		
		//生成最后的url
		$url=ltrim(str_replace("//","/",str_replace("index.html","",$url)),'/');
		
		return $url;
	}
}
?>