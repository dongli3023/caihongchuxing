<?php
class install extends Checklogin{

	public function init(){
		//会员组表
		$this->mysql->query("CREATE TABLE IF NOT EXISTS `".DB_PRE."member_group` (
  `groupid` tinyint(4) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");
		$this->mysql->query("INSERT INTO `c_member_group` (`groupid`, `name`) VALUES(1, '普通会员');");
		
		//会员字段表
		$this->mysql->query("CREATE TABLE IF NOT EXISTS `".DB_PRE."member_field` (
  `fieldid` mediumint(8) unsigned NOT NULL auto_increment,
  `field` char(20) NOT NULL,
  `name` char(20) NOT NULL,
  `formtype` char(20) NOT NULL,
  `width` tinyint(4) NOT NULL default '0',
  `height` tinyint(4) NOT NULL default '0',
  `initial` text,
  `explain` char(20) default NULL,
  `sort` mediumint(8) unsigned NOT NULL default '0',
  `is_fixed` tinyint(1) unsigned NOT NULL default '0',
  `is_register` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`fieldid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
		
		//会员表
		$this->mysql->query("CREATE TABLE IF NOT EXISTS `".DB_PRE."member` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `groupid` tinyint(4) unsigned NOT NULL default '1',
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_time` int(10) NOT NULL default '0',
  `creat_time` int(10) NOT NULL,
  `is_lock` smallint(2) NOT NULL default '0',
  `last_ip` varchar(50) NOT NULL,
  `logins` int(10) NOT NULL default '0',
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		
		$this->mysql->db_insert("menu","`parentid`=4,`title`='会员管理',`url`='###',`sort`=0,`is_show`=1");
		$pid=$this->mysql->insert_id();
		$this->mysql->db_insert("menu","`parentid`=".$pid.",`title`='会员列表',`url`='index.php?m=member&c=admin',`sort`=0,`is_show`=1");
		$this->mysql->db_insert("menu","`parentid`=".$pid.",`title`='模型配置',`url`='index.php?m=member&c=admin&f=field',`sort`=0,`is_show`=1");
		$this->mysql->db_insert("menu","`parentid`=".$pid.",`title`='会员组管理',`url`='index.php?m=member&c=group',`sort`=0,`is_show`=1");
		
		$text="ok";
		$file=MOD_PATH."member/install_ok.txt";
		creat_inc($file,$text);
		showmsg(C('success_update_cache'),'-1');
	}
	
	public function uninstall(){
		$this->mysql->del_table("member");  //删除数据表
		$this->mysql->del_table("member_field");
		$this->mysql->del_table("member_group");
		$this->mysql->db_delete("menu","`title`='会员管理'");
		$this->mysql->db_delete("menu","`title`='会员列表'");
		$this->mysql->db_delete("menu","`title`='模型配置'");
		$this->mysql->db_delete("menu","`title`='会员组管理'");
		
		$ok=MOD_PATH."member/install_ok.txt";
		$cache_field=CACHE_SYS_PATH."cache_field_member.php";
		$cache_group=CACHE_SYS_PATH."cache_member_group.php";
		if(file_exists($ok)){   //删除install_ok
			unlink($ok);
		}
		if(file_exists($cache_field)){
			unlink($cache_field);
		}
		if(file_exists($cache_group)){
			unlink($cache_group);
		}
		showmsg(C('success_update_cache'),'-1');
	}

}

?>