<?php
class install extends Checklogin{

	public function init(){
		$this->mysql->query("CREATE TABLE IF NOT EXISTS `".DB_PRE."qq` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `title` char(20) NOT NULL,
  `qq` char(20) NOT NULL,
  `is_lock` tinyint(1) unsigned NOT NULL default '0',
  `inputtime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");

		$this->mysql->db_insert("menu","`parentid`=4,`title`='客服QQ管理',`url`='###',`sort`=0,`is_show`=1");
		$pid=$this->mysql->insert_id();
		$this->mysql->db_insert("menu","`parentid`=".$pid.",`title`='添加客服',`url`='index.php?m=qq&c=admin&f=add',`sort`=0,`is_show`=1");
		$this->mysql->db_insert("menu","`parentid`=".$pid.",`title`='管理客服',`url`='index.php?m=qq&c=admin',`sort`=0,`is_show`=1");

		$text="ok";
		$file=MOD_PATH."qq/install_ok.txt";
		creat_inc($file,$text);
		showmsg(C('success_update_cache'),'-1');
	}
	
	public function uninstall(){
		$this->mysql->del_table("qq");  //删除数据表
		$this->mysql->db_delete("menu","`title`='客服QQ管理'");
		$this->mysql->db_delete("menu","`title`='添加客服'");
		$this->mysql->db_delete("menu","`title`='管理客服'");
		
		$ok=MOD_PATH."qq/install_ok.txt";
		if(file_exists($ok)){   //删除install_ok
			unlink($ok);
		}
		showmsg(C('success_update_cache'),'-1');
	}

}

?>