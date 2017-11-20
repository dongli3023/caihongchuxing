<?php
 /**
 * $Author: 91736 $
 * ============================================================================
 * 91736����loop��������
 * ��վ��ַ: http://www.91736.com
 * ����PHP�������¼��http://bbs.91736.com
 * ============================================================================
*/
function smarty_block_loop($params,$content,$template,&$repeat){
	global $smarty;
	$mysql=new mysql();
	//�ֽ����
	extract( $params );
	if(!isset($return))
		$return = 'r'; //���صı���������
	if(!isset($sql)&&!isset($catid)&&!isset($module))
		return '';
	//��ȡ��ʾ��������
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
	
	$more=isset($more)?(int)$more:0; //�Ƿ��ѯ����,Ĭ��Ϊ0����ѯ
	$pagestyle=isset($pagestyle)?(int)$pagestyle:'2';
	$commend=isset($commend)?(int)$commend:'-1'; //�Ƿ��ѯ�Ƽ�����
	$iscommend =$commend=='-1'?'':(empty($more)?"commend=".$commend:"c.commend=".$commend);
	
	if(isset($module)){//����ģ��
		$order=isset($order)?' order by '.$order:''; //����
	}else{
		$module = ''; 
		$order=isset($order)?' order by '.$order:' order by c.sort desc,c.id desc'; //����
	}
	if (isset ( $sql )) //$order��$sql����ͬ��
		$order = '';
	$thumb=isset($thumb)?(int)$thumb:0;
	$hasThumb =$thumb==1?(empty($more)?"thumb!=''":"c.thumb!=''"):($thumb==2?(empty($more)? " thumb=='' " : " c.thumb==''"):'');
	$showchild=isset($showchild)?(bool)$showchild:true; //�Ƿ���������Ŀ,Ĭ������
	if(!isset($urlrule))
		$urlrule = ''; //url����

	if(isset($pages)){ //�Ƿ��ҳ
		$pagestr = $pages;
		global $$pages; //���ݷ�ҳ����,��:page=2�е�page
		$page=$$pages;
		$page=(int)$page==0?1:(int)$page;
		$page_num = ($page - 1) * $rows;
	}
	if(isset($catid)){
		$channel=modelname($catid);
		$fields = $fields ? $fields : '*';
		$table = $table ? $table : DB_PRE . $channel; //����
		$catid = $catid ? $catid : 0;
	}
	
	#�ڶ���$smarty��ע��һ�������Թ�blockʹ��  
	if (! isset ( $smarty->blocksdata ))
		$smarty->blocksdata = array ();
	
		#���һ���������ר�����ݴ洢�ռ�  
	$dataindex = md5 ( __FUNCTION__ . md5 ( serialize ( $params ) ) );
	$dataindex = substr ( $dataindex, 0, 16 );
	#��ʹ��$smarty->blocksdata[$dataindex]���洢  
	#�������
	if (! $smarty->blocksdata [$dataindex]) {
		#��Ҫ���������  
		if($module!=""){
			$table=DB_PRE.$module;
			$sql="select * from $table";
		}elseif($catid>0){
			if($more==1){
				$cate=catname($catid);
				$othertable = get_content_table($channel);//��ȡ����
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
			//��whereͬ��
			$where = strpos ( $sql, ' where ' ) ? $where . ' and ' . $hasThumb : ' where ' . $hasThumb;
		$sql .= $where;
		//�Ƿ��ҳ
		if (isset ( $pages )) {
			include_once (LIB_PATH.'page.class.php');
			
			if(!empty($catid) && empty($urlrule)){           //���û����loop���Զ���url��������������url����
				$cate=get_category($catid);
				$urlid=$cate['url_list'];
				$urlrule=base::load_cache("cache_urlrule","_urlrule");
				$url_array=get_array($urlrule,"id",$urlid);
				$urlrule=$url_array[0]['url'];
				$urlhtml=$url_array[0]['ishtml'];
			}
			
			if(!empty($catid)){  //�������ĿID�������滻����
				$cate=get_category($catid);
				$catdir=$cate['catdir'];
				$parameters=array("[categorydir]","[catdir]","[catid]","[languagedir]","[languageid]");
				
				//ȡ������Ŀ¼
				$parent=is_parent($catid);
				if(!empty($parent)){
					$array=array_reverse(explode(",",ltrim($parent,",")));   //�����ݵ���
					$dir="";
					foreach($array as $v){
						$category=get_category($v);
						$dir.=$category['catdir']."/";
					}
					$dir=rtrim($dir,"/");
				}
				$lang=get_lang($cate['lang']);
				//�õ�����ֵ
				$value=array($dir,$catdir,$catid,$lang['dir'],$cate['lang']);
				
				//��������urlrule
				$urlrule=ltrim(str_replace("//","/",str_replace($parameters,$value,$urlrule)),"/");
			}
			
			$total_num = $mysql->num_rows ( $sql );
			$total_page = ceil ( $total_num / $rows );
			$total_page = (! $total_page) ? 1 : $total_page;
//			$page="3";
			$pagesset = new pages ( $total_num, $rows, $pagestr, $page, $urlrule );
			
			$pagesstr = $pagesset->show ($pagestyle);
			$smarty->assign ( $pagestr . 's', $pagesstr );
			
			//ҳ��������ҳ���Զ���ת��βҳ
			if ($page > $total_page && $total_page > 0) {
				if(!empty($aqs))
					@header ( 'location:' . $url . '?' . preg_replace ( '/page=(\d+)/i', "page={$total_page}", $aqs ) );
			}
			$rs = $mysql->fetch_asc ( $sql . $order . ' limit ' . $page_num . ',' . $rows );
		} else
			$rs = $mysql->fetch_asc ( $sql . $order . ' limit '.$limits.',' . $rows );
		
		//�����������
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
	
		#��������  
	#************************************************************************  
	}
	#���û�����ݣ�ֱ�ӷ���null,������ִ����  
	if (! $smarty->blocksdata [$dataindex]) {
		$repeat = false;
		return '';
	}
	#ȡһ�����ݳ�ջ��������ָ�ɸ�$return���ظ�ִ�п�����λ1     
	if (list ( $key, $item ) = each ( $smarty->blocksdata [$dataindex] )) {
		$smarty->assign ( $return, $item );
		$repeat = true;
	}
	#����Ѿ����������������ָ�룬�ظ�ִ�п�����λ0  
	if (! $item) {
		reset ( $smarty->blocksdata [$dataindex] );
		$repeat = false;
	}

	#��ӡ����  
	print $content;
}
?>