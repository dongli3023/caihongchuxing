<?php
class install extends Checklogin{

	public function init(){
		//表单表
		$this->mysql->query("CREATE TABLE IF NOT EXISTS `".DB_PRE."form` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `form_name` char(20) NOT NULL,
  `form_table` char(20) NOT NULL,
  `is_lock` tinyint(1) unsigned NOT NULL default '0',
  `is_fixed` tinyint(1) unsigned NOT NULL default '0',
  `is_email` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		
		//表单字段表
		$this->mysql->query("CREATE TABLE IF NOT EXISTS `".DB_PRE."form_field` (
  `fieldid` mediumint(8) unsigned NOT NULL auto_increment,
  `formid` tinyint(3) unsigned NOT NULL default '0',
  `field` char(20) NOT NULL,
  `name` char(20) NOT NULL,
  `formtype` char(20) NOT NULL,
  `width` tinyint(4) NOT NULL default '0',
  `height` tinyint(4) NOT NULL default '0',
  `initial` text,
  `explain` char(20) default NULL,
  `sort` mediumint(8) unsigned NOT NULL default '0',
  `is_fixed` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`fieldid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		
		$this->mysql->db_insert("menu","`parentid`=4,`title`='自定义表单管理',`url`='###',`sort`=0,`is_show`=1");
		$pid=$this->mysql->insert_id();
		$this->mysql->db_insert("menu","`parentid`=".$pid.",`title`='管理表单',`url`='index.php?m=form&c=form',`sort`=0,`is_show`=1");
		
		$text="ok";
		$file=MOD_PATH."form/install_ok.txt";
		creat_inc($file,$text);
		showmsg(C('success_update_cache'),'-1');
	}
	
	public function uninstall(){
		$query=$this->mysql->query("select * from ".DB_PRE."form");
		while($rs=$this->mysql->fetch_rows($query)){  //列出所有的自定义表单
			$this->mysql->del_table($rs['form_table']);
			$cache_field=CACHE_SYS_PATH."cache_form_".$rs['form_table'].".php";
			if(file_exists($cache_field)){
				unlink($cache_field);
			}
		}
		$this->mysql->del_table("form");  //删除数据表
		$this->mysql->del_table("form_field");
		
		$this->mysql->db_delete("menu","`title`='自定义表单管理'");
		$this->mysql->db_delete("menu","`title`='管理表单'");
		
		$ok=MOD_PATH."form/install_ok.txt";
		$cache_form=CACHE_SYS_PATH."cache_form.php";
		if(file_exists($ok)){   //删除install_ok
			unlink($ok);
		}
		if(file_exists($cache_form)){
			unlink($cache_form);
		}
		showmsg(C('success_update_cache'),'-1');
	}

}

?>