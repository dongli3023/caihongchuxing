<?php
class module extends Checklogin{
	
	public function init(){
		$dir=dir_list(MOD_PATH,"xdcms");
		$id=0;
		foreach($dir as $value){
			$url=MOD_PATH.$value."/config.inc.php";
			if(file_exists($url)){
				$id++;
				
				//判断是否已安装
				if(file_exists(MOD_PATH.$value."/install_ok.txt")){
					$install="<a href='index.php?m=".$value."&c=install&f=uninstall'>卸载</a>";
				}else{
					$install="<a href='index.php?m=".$value."&c=install'><font color=#ff0000>安装</font></a>";
				}
				
				$_config=base::load_file($url,"_config");
				if(is_array($_config)){
					$config[]=array('id'=>$id,'name'=>$_config['name'],'folder'=>$_config['folder'],'author'=>$_config['author'],'url'=>$_config['url'],'time'=>$_config['time'],'install'=>$install);
				}
			}
		}
		assign("config",$config);
		template("module_list","admin");
	}

}
?>