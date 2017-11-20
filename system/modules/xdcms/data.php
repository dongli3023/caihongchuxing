<?php
//中文
class data extends Checklogin{

	function init(){
		$array=$this->mysql->show_table();
		foreach($array as $value){
			$query=$this->mysql->query("SHOW TABLE STATUS LIKE '".$value."'");
			$table[]=$this->mysql->fetch_rows($query);
			assign('table',$table);
		}
		template('data_list','admin');
	}
	
	public function backup(){
		if(empty($_POST["id"])){
			showmsg(C('error'),'-1');
		}
		
		$tablenames = $_POST["id"];
		$folder="xdcms_cms_".date('YmdHis',time());
		$path=DATA_PATH.'backup/'.$folder."/";
		if (!file_exists($path)) {
			@mkdir($path);
		}
		for($i = 0; $i < count($tablenames); $i++){
			$fp=$path.$tablenames[$i].".sql";
			$this->Backupdate($tablenames[$i], $fp);
		}

		showmsg(C('success'),'-1');
	}
	
	public function repair(){
		$table = $_GET["table"];
		$query=$this->mysql->query("REPAIR TABLE `$table`");
		$rs=$this->mysql->fetch_rows($query);
		if ($rs['Msg_text']=='OK'){
			showmsg(C('success'),'-1');
		}else{
			showmsg(C('error'),'-1');
		}
	}
	
	public function data_file(){
		$backupDir = DATA_PATH.'backup/';
		$dirArray[]=NULL;  
		if (false != ($handle = opendir ( $backupDir ))) {  
			$i=0;  
			while ( false !== ($file = readdir ( $handle )) ) {  
				if ($file != "." && $file != ".."&&!strpos($file,".")) {  
					$dirArray[$i]=$file;  
					$i++;  
				}  
			}  
			closedir ( $handle );  
		}  

		assign('files',$dirArray);
		template('data_file','admin');
	}
	
	public function rebackup(){
		$path = trim($_GET["file"]);
		$dir = DATA_PATH.'backup/'.$path;
		if (false != ($handle = opendir ( $dir ))) {  
			while ( false !== ($file = readdir ( $handle )) ) {   
				if ($file != "." && $file != ".."&&strpos($file,".")) {  
					$this->insert_data($dir."/".$file);    
				}  
			}  
			closedir ( $handle );  
		}  
		showmsg(C('success'),'-1');
	}
	
	private function insert_data($sqlfile){
		$sql = file_get_contents($sqlfile);
		$ret = array();
		$num = 0;
		$queriesarray = explode(";\n", trim($sql));
		unset($sql);
		foreach($queriesarray as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			$queries = array_filter($queries);
			foreach($queries as $query) {
				$str1 = substr($query, 0, 1);
				if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
			}
			$num++;
		}
		$sqls=$ret;
		if(is_array($sqls)){
			foreach($sqls as $sql) {
				if(trim($sql) != '') $rs=$this->mysql->query($sql);
			}
		} else {
			$rs=$this->mysql->query($sql);
		}
	}
	
	public function delete(){
		$file=trim($_GET["file"]);
		$dir=DATA_PATH.'backup/'.$file;
		if(is_dir($dir)){
			//删除文件夹中的文件
			if (false != ($handle = opendir ( $dir ))) {  
				while ( false !== ($file = readdir ( $handle )) ) {   
					if ($file != "." && $file != ".."&&strpos($file,".")) {  
						@unlink($dir."/".$file);    
					}  
				}  
				closedir ( $handle );  
			}  
		
			@rmdir($dir);//删除目录
		}
		showmsg(C('success'),'-1');
	}

	
	private function writeFileData($handle, $data){
		$fp=fopen($handle,'w');
		@fwrite($fp,$data);
		fclose($fp);
	}

	private function Backupdate($tablename, $fp){
		global $db;
		$tableDump="";
		if(isset($fp)){
  			$sql = $this->mysql->query("SHOW CREATE TABLE `$tablename`");
    		$createTable = $this->mysql->fetch_rows($sql);
			$tableDump .= "DROP TABLE IF EXISTS `$tablename`;\n" . $createTable['Create Table'] . ";\n\n";
			$getRows = $this->mysql->query("SELECT * FROM `$tablename`");
			$fieldCount = $this->mysql->num_fields($getRows);
			$rowCount = 0;
			
			while ($row = $this->mysql->fetch_rows($getRows)){
                $tableDump .= "INSERT INTO `$tablename` VALUES(";
                $fieldcounter = -1;
                $firstfield = 1;
                while (++$fieldcounter < $fieldCount){
                	if (!$firstfield){
                    	$tableDump .= ', ';
                    }else{
                        $firstfield = 0;
					}

                    if (!isset($row["$fieldcounter"])){
						$tableDump .= 'NULL';
					}elseif ($row["$fieldcounter"] != ''){
                    	$tableDump .= '\'' . addslashes($row["$fieldcounter"]) . '\'';
                    }else{
                        $tableDump .= '\'\'';
                    }
                }
				$tableDump .= ");\n";
                $rowCount++;
			}
			$this->writeFileData($fp, "$tableDump");
		}
	}
}
?>