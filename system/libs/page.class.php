<?php
/**
 * $Author: 91736 $
 * ============================================================================
 * page分页类
 * 网站地址: http://www.91736.com
 * 更多PHP开发请登录：http://bbs.91736.com
 * ============================================================================
*/
class pages {
	private $num; //总条数
	private $perpage = 20; //每页显示条数
	private $urlrule0; //url规则,默认的动态访问方式
	private $urlrule; //url规则
	private $page = 1; //当前页码
	private $pages; //总页数
	private $anotherPage; //在默认分页后面添加是显示下拉分页还是显示输入跳转框
	private $currentNum; //当前显示第几条到第几条记录,如:1-20
	private $strcount; //分页前统计,如: 总计：47条 每页显示11条
	private $strbefore; //分页代码父节点样式开始
	private $strafter; //分页代码父节点样式结束
	private $isStatic; //是否为静态分页
	private $indexname; //静态分页第一页文件名
	

	function __construct($num,$perpage,$pagevar,$page,$urlrule ='',$mkdir=''){
		$url = 'http://'.$_SERVER ["HTTP_HOST"].$_SERVER ["PHP_SELF"];
		$aqs = $_SERVER ["QUERY_STRING"]; //网址查询参数
		
		$this->num = $num;
		$this->perpage = $perpage;
		$this->page = $page;
		$this->pages = ceil ( $num / $perpage );
		$iCount = ($page * $perpage) > $num ? $num : $page * $perpage;
		$this->currentNum = ($page - 1) * $perpage + 1 . '-' . $iCount;
		$this->strcount = "<div class=\"pages\"><span class=\"pagecount\">总计:{$this->num}条 每页{$this->perpage}条</span> 当前第:{$this->page}页";
		$this->strcount_en = "<div class=\"pages\"><span class=\"pagecount\">Count:{$this->page}/{$this->num}";
		$this->strbefore = ' ';
		$this->strafter = '</div>';
		$this->urlrule0 = !empty ( $aqs ) ? (preg_match ( '/' . $pagevar . '=/i', $aqs ) ? $url . '?' . preg_replace ( '/' . $pagevar . '=(\d+)/i', "$pagevar=", $aqs ) : $url . '?' . $aqs . '&' . $pagevar . '=') : $url . '?' . $pagevar . '=';
		
		if (! empty ( $urlrule )){//静态分页样式
			
			$this->isStatic = true;
			$this->urlrule = str_replace ( '[page]', "%d", $urlrule );
			$this->indexname = str_replace ( array("[page].html","[page]"), array("index.html","1"), $urlrule );
			
			global $isMakeHtml, $mkdir;
			if ($isMakeHtml){				
				$pageto = $page + 1;
				if ($pageto <= $this->pages){
					makelist ( $this->urlrule0 . $pageto, sprintf ( $this->urlrule, $pageto ), $mkdir );
				}			
			}
		}else{
			$this->urlrule = $this->urlrule0;
		}
	}
	
	//生成分页链接URL
	private function setUrl($cur_page) {
		$cur_page = $cur_page == 0 ? 1 : ($cur_page >= $this->pages ? $this->pages : $cur_page);
		$pageHref = '';
		
		if ($this->isStatic) {
			if ($cur_page == 1)
				$pageHref = $this->indexname;
			else
				$pageHref = sprintf ( $this->urlrule, $cur_page );
		} else
			$pageHref = $this->urlrule . $cur_page;
		return $pageHref;
	}
	
	//生成分页样式 显示模式
	public function show($mode = 1) {
		$showmode = 'show_mode' . $mode;
		
		if (method_exists ( $this, $showmode ))
			return $this->$showmode ();
		else
			return $this->show_mode1 ();
	}
	
	//有首页上一页下一页尾页的显示模式
	private function show_mode1() {
		if ($this->num > $this->perpage) {
			switch ($this->page) {
				case 1 :
					$firstpage = '首页';
					$prepage = '上一页';
					$nextpage = '<a href="' . $this->setUrl ( $this->page + 1 ) . '">下一页</a>';
					$lastpage = '<a href="' . $this->setUrl ( $this->pages ) . '">尾页</a>';
					break;
				case $this->pages :
					$firstpage = '<a href="' . $this->setUrl ( 1 ) . '">首页</a>';
					$prepage = '<a href="' . $this->setUrl ( $this->page - 1 ) . '">上一页</a>';
					$nextpage = '下一页';
					$lastpage = '尾页';
					break;
				default :
					$firstpage = '<a href="' . $this->setUrl ( 1 ) . '">首页</a>';
					$prepage = '<a href="' . $this->setUrl ( $this->page - 1 ) . '">上一页</a>';
					$nextpage = '<a href="' . $this->setUrl ( $this->page + 1 ) . '">下一页</a>';
					$lastpage = '<a href="' . $this->setUrl ( $this->pages ) . '">尾页</a>';
					break;
			}
			$content = $this->strcount . $this->strbefore . " $firstpage $prepage $nextpage $lastpage " . $this->anotherPage . " " . $this->strafter;
		} else {
			$content="{$this->strcount} {$this->strbefore} 首页 上一页 下一页 尾页 {$this->strafter}";
		}
		return $content;
	}
	
	//有首页上一页下一页尾页数字的显示模式
	private function show_mode2() {
		
		if ($this->num > $this->perpage) {
			
			switch ($this->page) {
				case 1 :
					$firstpage = '首页';
					$prepage = '上一页';
					$nextpage = '<a href="' . $this->setUrl ( $this->page + 1 ) . '">下一页</a>';
					$lastpage = '<a href="' . $this->setUrl ( $this->pages ) . '">尾页</a>';
					break;
				case $this->pages :
					$firstpage = '<a href="' . $this->setUrl ( 1 ) . '">首页</a>';
					$prepage = '<a href="' . $this->setUrl ( $this->page - 1 ) . '">上一页</a>';
					$nextpage = '下一页';
					$lastpage = '尾页';
					break;
				
				default :
					$firstpage = '<a href="' . $this->setUrl ( 1 ) . '">首页</a>';
					$prepage = '<a href="' . $this->setUrl ( $this->page - 1 ) . '">上一页</a>';
					$nextpage = '<a href="' . $this->setUrl ( $this->page + 1 ) . '">下一页</a>';
					$lastpage = '<a href="' . $this->setUrl ( $this->pages ) . '">尾页</a>';
					break;
			}
			$pagebar = '';
			$init = 1;
			$page_len = 10; //这里是设置显示多少个数字分页的数字
			$max_p = $this->pages;
			$pages = $this->pages;
			
			$page_len = $page_len % 2 == 0 ? $page_len : $page_len + 1; //页码个数
			
			$pageoffset = $page_len % 2 == 0 ? $page_len / 2 : ($page_len - 1) / 2; //页码个数左右偏移量
			$pageoffset_l = $page_len % 2 == 0 ? $pageoffset - 1 : $pageoffset;
			$pageoffset_r = $pageoffset;
			$page = $this->page;
			
			if ($pages > $page_len) {
				//如果当前页小于等于左偏移
				if ($page <= $pageoffset) {
					$init = 1;
					$max_p = $page_len;
				} else { //如果当前页大于左偏移
					//如果当前页码右偏移超出最大分页数
					if ($page + $pageoffset_r >= $pages + 1) {
						$init = $pages + 1 - 10;
					} else {
						//左右偏移都存在时的计算
						$init = $page - $pageoffset_l;
						$max_p = $page + $pageoffset_r;
					}
				}
			}
			for($i = $init; $i <= $max_p; $i ++) {
				$pageStyle = $i == $this->page ? "class=\"current\"" : '';
				if (empty ( $pageStyle ))
					$pagebar .= "<a href=\"" . $this->setUrl ( $i ) . "\" $pageStyle>$i</a>&nbsp;";
				else
					$pagebar .= "<span $pageStyle><u>$i</u></span> ";
			}
			
			$content = $this->strcount . $this->strbefore . " $firstpage $prepage $pagebar $nextpage $lastpage " . $this->anotherPage . " " . $this->strafter;
		} else {
			$content="{$this->strcount} {$this->strbefore} 首页 上一页 下一页 尾页 {$this->strafter}";
		}
		return $content;
	}
	
	//有Home Previous Next End数字的显示模式
	private function show_mode3() {
		
		if ($this->num > $this->perpage) {
			
			switch ($this->page) {
				case 1 :
					$firstpage = 'Home';
					$prepage = 'Previous';
					$nextpage = '<a href="' . $this->setUrl ( $this->page + 1 ) . '">Next</a>';
					$lastpage = '<a href="' . $this->setUrl ( $this->pages ) . '">End</a>';
					break;
				case $this->pages :
					$firstpage = '<a href="' . $this->setUrl ( 1 ) . '">Home</a>';
					$prepage = '<a href="' . $this->setUrl ( $this->page - 1 ) . '">Previous</a>';
					$nextpage = 'Next';
					$lastpage = 'End';
					break;
				
				default :
					$firstpage = '<a href="' . $this->setUrl ( 1 ) . '">Home</a>';
					$prepage = '<a href="' . $this->setUrl ( $this->page - 1 ) . '">Previous</a>';
					$nextpage = '<a href="' . $this->setUrl ( $this->page + 1 ) . '">Next</a>';
					$lastpage = '<a href="' . $this->setUrl ( $this->pages ) . '">End</a>';
					break;
			}
			$pagebar = '';
			$init = 1;
			$page_len = 10; //这里是设置显示多少个数字分页的数字
			$max_p = $this->pages;
			$pages = $this->pages;
			
			$page_len = $page_len % 2 == 0 ? $page_len : $page_len + 1; //页码个数
			
			$pageoffset = $page_len % 2 == 0 ? $page_len / 2 : ($page_len - 1) / 2; //页码个数左右偏移量
			$pageoffset_l = $page_len % 2 == 0 ? $pageoffset - 1 : $pageoffset;
			$pageoffset_r = $pageoffset;
			$page = $this->page;
			
			if ($pages > $page_len) {
				//如果当前页小于等于左偏移
				if ($page <= $pageoffset) {
					$init = 1;
					$max_p = $page_len;
				} else { //如果当前页大于左偏移
					//如果当前页码右偏移超出最大分页数
					if ($page + $pageoffset_r >= $pages + 1) {
						$init = $pages + 1 - 10;
					} else {
						//左右偏移都存在时的计算
						$init = $page - $pageoffset_l;
						$max_p = $page + $pageoffset_r;
					}
				}
			}
			for($i = $init; $i <= $max_p; $i ++) {
				$pageStyle = $i == $this->page ? "class=\"current\"" : '';
				if (empty ( $pageStyle ))
					$pagebar .= "<a href=\"" . $this->setUrl ( $i ) . "\" $pageStyle>$i</a>&nbsp;";
				else
					$pagebar .= "<span $pageStyle><u>$i</u></span> ";
			}
			
			$content = $this->strcount_en . $this->strbefore . " $firstpage $prepage $pagebar $nextpage $lastpage " . $this->anotherPage . " " . $this->strafter;
		} else {
			$content="{$this->strcount_en} {$this->strbefore} Home Previous Next End {$this->strafter}";
		}
		return $content;
	}
}
?>