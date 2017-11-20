<?php
 /**
 * $Author: 91736 $
 * ============================================================================
 * 91736开发loop调用数据
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/
function smarty_block_loop($params,$content,$template,&$repeat){
	global $smarty;
	$mysql=new mysql();
	//分解变量
	extract( $params );
	if(!isset($return))
		$return = 'r'; //返回的变量数组名
	if(!isset($sql)&&!isset($catid)&&!isset($module))
		return '';
	//获取显示数据条数
	if(isset($rows)){
		$rows=(int)$rows;
	}elseif(isset($catid)){
		$cate=get_category($catid);
		$rows=$cate['pagesize'];
	}else{
		$rows=20;
	}
	$limits=isset($limits)?(int)$limits:0;
	!isset($where)&&$where='';
	
	$more=isset($more)?(int)$more:0; //是否查询附表,默认为0不查询
	$pagestyle=isset($pagestyle)?(int)$pagestyle:'2';
	$commend=isset($commend)?(int)$commend:'-1'; //是否查询推荐内容
	$iscommend =$commend=='-1'?'':(empty($more)?"commend=".$commend:"c.commend=".$commend);
	
	if(isset($module)){//调用模块
		$order=isset($order)?' order by '.$order:''; //排序
	}else{
		$module = ''; 
		$order=isset($order)?' order by '.$order:' order by c.sort desc,c.id desc'; //排序
	}
	if (isset ( $sql )) //$order与$sql不能同用
		$order = '';
	$thumb=isset($thumb)?(int)$thumb:0;
	$hasThumb =$thumb==1?(empty($more)?"thumb!=''":"c.thumb!=''"):($thumb==2?(empty($more)? " thumb=='' " : " c.thumb==''"):'');
	$showchild=isset($showchild)?(bool)$showchild:true; //是否搜索子栏目,默认搜索
	if(!isset($urlrule))
		$urlrule = ''; //url规则

	if(isset($pages)){ //是否分页
		$pagestr = $pages;
		global $$pages; //传递分页变量,如:page=2中的page
		$page=$$pages;
		$page=(int)$page==0?1:(int)$page;
		$page_num = ($page - 1) * $rows;
	}
	if(isset($catid)){
		$channel=modelname($catid);
		$fields = $fields ? $fields : '*';
		$table = $table ? $table : DB_PRE . $channel; //主表
		$catid = $catid ? $catid : 0;
	}
	
	#在对象$smarty上注册一个数组以供block使用  
	if (! isset ( $smarty->blocksdata ))
		$smarty->blocksdata = array ();
	
		#获得一个本区块的专属数据存储空间  
	$dataindex = md5 ( __FUNCTION__ . md5 ( serialize ( $params ) ) );
	$dataindex = substr ( $dataindex, 0, 16 );
	#将使用$smarty->blocksdata[$dataindex]来存储  
	#填充数据
	if (! $smarty->blocksdata [$dataindex]) {
		#主要数据填充区  
		if($module!=""){
			$table=DB_PRE.$module;
			$sql="select * from $table";
		}elseif($catid>0){
			if($more==1){
				$cate=catname($catid);
				$othertable = get_content_table($channel);//获取附表
				$othertable=DB_PRE.$othertable; 
				
				$childid=ltrim(get_all_catids($catid),",");
				if(empty($childid)){
					$sql = "select $fields from $table c left join $othertable  o on c.id=o.id where c.catid=$catid";
				}else{
					$sql = "select $fields from $table c left join $othertable  o on c.id=o.id where c.catid in ($childid)";
				}
			}else{
				if($showchild){
					$childid=ltrim(get_all_catids($catid),",");
					if(empty($childid))
						$sql="select $fields from $table c where c.catid = $catid";
					else
						$sql="select $fields from $table c where c.catid in ($childid)";
				}else
					$sql="select $fields from $table c where c.catid = $catid";
			}
		} elseif ($catid == 0 && empty ( $sql ) && empty($module))
			return;
		if (! empty ( $where ))
			$where = strpos ( $sql, ' where ' ) ? ' and ' . $where : ' where ' . $where;
		if (! empty ( $iscommend ))
			$where = strpos ( $sql, ' where ' ) ? $where . ' and ' . $iscommend : ' where ' . $iscommend;
		if (! empty ( $hasThumb ))
			//与where同用
			$where = strpos ( $sql, ' where ' ) ? $where . ' and ' . $hasThumb : ' where ' . $hasThumb;
		$sql .= $where;
		//是否分页
		if (isset ( $pages )) {
			include_once (LIB_PATH.'page.class.php');
			
			if(!empty($catid) && empty($urlrule)){           //如果没有在loop中自定义url规则，则在这生成url规则
				$cate=get_category($catid);
				$urlid=$cate['url_list'];
				$urlrule=base::load_cache("cache_urlrule","_urlrule");
				$url_array=get_array($urlrule,"id",$urlid);
				$urlrule=$url_array[0]['url'];
				$urlhtml=$url_array[0]['ishtml'];
			}
			
			if(!empty($catid)){  //如果有栏目ID，生成替换规则
				$cate=get_category($catid);
				$catdir=$cate['catdir'];
				$parameters=array("[categorydir]","[catdir]","[catid]","[languagedir]","[languageid]");
				
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
				$lang=get_lang($cate['lang']);
				//得到参数值
				$value=array($dir,$catdir,$catid,$lang['dir'],$cate['lang']);
				
				//生成最后的urlrule
				$urlrule=ltrim(str_replace("//","/",str_replace($parameters,$value,$urlrule)),"/");
			}
			
			$total_num = $mysql->num_rows ( $sql );
			$total_page = ceil ( $total_num / $rows );
			$total_page = (! $total_page) ? 1 : $total_page;
//			$page="3";
			$pagesset = new pages ( $total_num, $rows, $pagestr, $page, $urlrule );
			
			$pagesstr = $pagesset->show ($pagestyle);
			$smarty->assign ( $pagestr . 's', $pagesstr );
			
			//页数大于总页数自动跳转到尾页
			if ($page > $total_page && $total_page > 0) {
				if(!empty($aqs))
					@header ( 'location:' . $url . '?' . preg_replace ( '/page=(\d+)/i', "page={$total_page}", $aqs ) );
			}
			$rs = $mysql->fetch_asc ( $sql . $order . ' limit ' . $page_num . ',' . $rows );
		} else
			$rs = $mysql->fetch_asc ( $sql . $order . ' limit '.$limits.',' . $rows );
		
		//添加数组索引
		for($i = 0; $i < count ( $rs ); $i ++) {
			
			$rs [$i] ['_index'] = $i;
			$rs [$i] ['iteration'] = $i + 1;
			$rs [$i] ['first'] = $i === 0;
			$rs [$i] ['last'] = $i === count ( $rs ) - 1;
			
			if (isset ( $rs [$i] ['url'] )) {
				$rs [$i] ['url'] = strpos ( $rs [$i] ['url'], 'http://' )!==false ? $rs [$i] ['url'] : CMS_URL . $rs [$i] ['url'];
			}
		}
		
		$smarty->blocksdata [$dataindex] = $rs;
	
		#填充区完成  
	#************************************************************************  
	}
	#如果没有数据，直接返回null,不必再执行了  
	if (! $smarty->blocksdata [$dataindex]) {
		$repeat = false;
		return '';
	}
	#取一条数据出栈，并把它指派给$return，重复执行开关置位1     
	if (list ( $key, $item ) = each ( $smarty->blocksdata [$dataindex] )) {
		$smarty->assign ( $return, $item );
		$repeat = true;
	}
	#如果已经到达最后，重置数组指针，重复执行开关置位0  
	if (! $item) {
		reset ( $smarty->blocksdata [$dataindex] );
		$repeat = false;
	}

	#打印内容  
	print $content;
}
?>