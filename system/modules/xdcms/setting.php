<?php
class setting extends Checklogin{
	
	function __construct(){
		parent::check_admin();
		$this->cache=base::load_class("cache");
		$this->mysql=$this->cache->mysql;
	} 
	
	public function init(){
		$config_arr=base::load_cache('cache_set_config','_config');
		assign("cfg",$config_arr);
		assign("template",get_tem_dir());
		template("setting","admin");
	}
	
	public function save(){
		$config_arr=base::load_cache('cache_set_config','_config');
		$tag=safe_html($_POST["tag"]);
		$apply=safe_html($_POST["apply"]);
		unset($_POST['submit'],$_POST['tag']);
		if($tag=='config'){
			$info['is_modify']=1;
		}
		$info['is_modify']=0;
		foreach($_POST as $k=>$v){
			if(is_array($v)){
				$info[$k]=safe_html($v[0]);
			}else{
				$info[$k]=safe_html($v);
			}
		}
		
		$infonum=$this->mysql->db_num("config","`config_tag`='$tag'");
		if($infonum==0){
			$sql="insert into ".DB_PRE."config (config_array,config_tag) values ('".addslashes(var_export($info,true))."','".$tag."')";
		}else{
			$sql="update ".DB_PRE."config set `config_array`='".addslashes(var_export($info,true))."' where `config_tag`='".$tag."'";
		}
		$this->mysql->query($sql);
		if(!empty($info)){
			$s="<?php\n\$_{$tag}=".var_export($info,true).";\n?>";
		}
		$file=CACHE_SYS_PATH.'cache_set_'.$tag.'.php';
		creat_inc($file,$s);
		if($tag=='config'){
			//判断url是否以/结尾
			$urlnum=strlen($info['siteurl'])-1;
			if(substr($info['siteurl'],$urlnum,1)!="/"){
				showmsg(C("update_url_error"),"-1");
			}//end
			
			$cms=SYS_PATH.'xdcms.inc.php';   //生成xdcms配置文件
			$cmsurl="<?php\n define('CMS_URL','".$info['siteurl']."');\n define('TP_FOLDER','".$info['template']."');\n define('TP_CACHE',".$info['caching'].");\n?>";
			creat_inc($cms,$cmsurl);
			
			if($info['createhtml'] != $config_arr['createhtml']){    //更新所有栏目的html配置
				$category=base::load_cache("cache_category","_category");
				$updateurl=base::load_class("url");
				if($info['createhtml']==1){
					$url_arr=array(1,3,4);
				}elseif($info['createhtml']==2){
					$url_arr=array(2,5,6);
				}else{
					$url_arr=array(0,1,2);
				}
				foreach($category as $value){
					if($value['is_link']==0){   //外部链接不更新
						$url=$updateurl->caturl($value['catid'],$value['catdir'],$url_arr[0],1,0,$url_arr[1]);
						$this->mysql->db_update("category","`url`='{$url}',`is_html`={$url_arr[0]},`url_list`={$url_arr[1]},`url_show`={$url_arr[2]}","`catid`={$value['catid']}");
					}
				}
				$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."category order by sort asc,catid asc");  //更新栏目缓存
				$s="<?php\n\$_category=".var_export($rs,true).";\n?>";
				$file=CACHE_SYS_PATH.'cache_category.php';
				$gourl="index.php?m=xdcms&c=categorytree";
				creat_inc($file,$s);
			}else{
				$gourl="-1";
			}
		}else{
			$gourl="-1";
		}
		showmsg(C("success"),$gourl);
		unset($sql);
	}
	
	public function contact(){
		template("contact","admin");
	}
	
	public function email(){
		$email_arr=base::load_cache('cache_set_email','_email');
		assign("email",$email_arr);
		template("email","admin");
	}
	
	public function upload(){
		$upload_arr=base::load_cache('cache_set_upload','_upload');
		assign("upload",$upload_arr);
		template("upload","admin");
	}
	
	public function cache(){
		$this->cache->setting_cache();
		showmsg(C("update_cache_success"),"-1");
	}
}
?>