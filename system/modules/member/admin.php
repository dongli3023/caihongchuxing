<?php
class admin extends Checklogin{

	public function init(){
		template('list','admin/member');
	}
	
	public function lock(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$lockid=isset($_GET['lockid'])?intval($_GET['lockid']):0;
		$this->mysql->db_update('member','`is_lock`='.$lockid,'`userid`='.$id);
		showmsg(C('update_success'),'-1');
	}
	
	public function edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'member where `userid`='.$id);

		$input=base::load_class('input');
		//加载会员组
		$member_group=base::load_cache("cache_member_group","_member_group");
		$group="";
		if(is_array($member_group)){
			foreach($member_group as $val){
				$group.="<option value=\"".$val['groupid']."\"";
				if($rs['groupid']==$val['groupid']){
					$group.="  selected=\"selected\"";
				}
				$group.=">".$val['name']."</option>";
			}
		}
		
		//加载会员字段
		$field=base::load_cache("cache_field_member","_field");
		$fields="";
		if(is_array($field)){
			foreach($field as $value){
				$fields.="<tr>\n";
				$fields.="<td align=\"right\">".$value['name']."：</td>\n";
				$fields.="<td colspan=\"3\">".$input->$value['formtype']($value['field'],$rs[$value['field']],$value['width'],$value['height'],$value['initial'])." ".$value['explain']."</td>\n";
				$fields.="</tr>\n";
			}
		}
		
		assign('rs',$rs);
		assign("group",$group);
		assign("fields",$fields);
		template('edit','admin/member');
	}
	
	public function editsave(){
		$id=isset($_POST['id'])?intval($_POST['id']):0;
		$groupid=intval($_POST['groupid']);
		$password=$_POST['password'];
		$fields=$_POST['fields'];
		
		//如果密码不为空则修改密码
		if(!empty($password)){
			$password=md5(md5($password));
			$this->mysql->db_update('member',"`password`='".$password."'",'`userid`='.$id);
		}
		
		//更新会员组
		$this->mysql->db_update('member',"`groupid`='".$groupid."'",'`userid`='.$id);
		
		//修改资料
		$field_sql='';
		foreach($fields as $k=>$v){
			$f_value=$v;
			if(is_array($v)){
				$f_value=implode(',',$v);
			}
			$field_sql.=",`{$k}`='{$f_value}'";
		}
		$field_sql=substr($field_sql,1);
		$field_sql="update ".DB_PRE."member set {$field_sql} where userid={$id}";
		$query=$this->mysql->query($field_sql);
		showmsg(C('update_success'),'-1');
	}
	
	public function delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$this->mysql->db_delete('member','`userid`='.$id);
		showmsg(C('delete_success'),'-1');
	}
	
	public function field(){
		$field_arr=base::load_cache('cache_field_member','_field');
		assign("fields",$field_arr);
		template('field_list','admin/member');
	}
	
	public function field_add(){
		$fields_arr=base::load_file(FUN_PATH.'fields.inc.php','_fields');
		assign("fields",$fields_arr);
		template('field_add','admin/member');
	}
	
	public function field_add_save(){
		$name=safe_html($_POST['name']);
		$field=$_POST['field'];
		$formtype=$_POST['formtype'];
		$width=$_POST['width'];
		$width=isset($width)?(int)$width:0;
		$height=$_POST['height'];
		$height=isset($height)?(int)$height:0;
		$sort=$_POST['sort'];
		$explain=safe_html($_POST['explain']);
		$initial=$_POST['initial'];
		$is_fixed=$_POST['is_fixed'];
		$is_register=$_POST['is_register'];
		
		if(empty($name)||empty($field)){
			showmsg(C('material_not_complete'),'-1');
		}
		if(!check_str($field,'/^[a-z0-9][a-z0-9]*$/')){
			showmsg(C('field').C('numbers_and_letters'),'-1');
		}
		if($width!=''&&!is_num($width)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if($height!=''&&!is_num($height)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if(!is_num($sort)){
			showmsg(C('sort_numbers'),'-1');
		}

		$table_field=$this->mysql->fetch_field("select * from ".DB_PRE."member");//获取数据表的字段
		if(in_array($field,$table_field)){
			showmsg(C('field_exist'),'-1');
		}
		
		$this->mysql->db_insert('member_field',"`name`='".$name."',`field`='".$field."',`formtype`='".$formtype."',`width`='".$width."',`height`='".$height."',`sort`='".$sort."',`explain`='".$explain."',`initial`='".$initial."',`is_fixed`=".$is_fixed.",`is_register`=".$is_register);
		if($formtype=="checkbox"||$formtype=="editor"||$formtype=="textarea"){
			$field="`".$field."` TEXT";
		}else{
			$field="`".$field."` CHAR(80)";
		}
		$this->mysql->add_field("member",$field);
		$this->field_cache();
		unset($rs);
		showmsg(C('add_success'),'-1');
	}
	
	public function field_edit(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one('select * from '.DB_PRE.'member_field where `fieldid`='.$id);
		assign('rs',$rs);
		unset($rs);
		$fields_arr=base::load_file(FUN_PATH.'fields.inc.php','_fields');
		assign("fields",$fields_arr);
		template('field_edit','admin/member');
	}
	
	public function field_edit_save(){
		$name=safe_html($_POST['name']);
		$formtype=$_POST['formtype'];
		$width=$_POST['width'];
		$width=isset($width)?(int)$width:0;
		$height=$_POST['height'];
		$height=isset($height)?(int)$height:0;
		$sort=$_POST['sort'];
		$explain=safe_html($_POST['explain']);
		$initial=$_POST['initial'];
		$fieldid=$_POST['fieldid'];
		$is_fixed=$_POST['is_fixed'];
		$is_register=$_POST['is_register'];
		
		if(empty($name)){
			showmsg(C('material_not_complete'),'-1');
		}
		if($width!=''&&!is_num($width)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if($height!=''&&!is_num($height)){
			showmsg(C('width_height_numbers'),'-1');
		}
		if(!is_num($sort)){
			showmsg(C('sort_numbers'),'-1');
		}
		
		$this->mysql->db_update('member_field',"`name`='".$name."',`formtype`='".$formtype."',`width`='".$width."',`height`='".$height."',`sort`='".$sort."',`explain`='".$explain."',`initial`='".$initial."',`is_fixed`=".$is_fixed.",`is_register`=".$is_register,"`fieldid`=".$fieldid);
		$this->field_cache();
		unset($rs);
		showmsg(C('update_success'),'-1');
	}
	
	public function field_delete(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$rs=$this->mysql->get_one("select fieldid,field from ".DB_PRE."member_field where `fieldid`=".$id);
		$fieldname=$rs['field'];
		$this->mysql->del_field("member",$fieldname);
		$this->mysql->db_delete('member_field','`fieldid`='.$id);
		$this->field_cache();
		showmsg(C('delete_success'),'-1');
	}
	
	public function update_field_cache(){
		$this->field_cache();
		showmsg(C('update_success'),'-1');
	}
	
	public function field_cache(){
		$rs=$this->mysql->fetch_asc("select * from ".DB_PRE."member_field order by sort asc,fieldid asc");
		$s="<?php\n\$_field=".var_export($rs,true).";\n?>";
		$file=CACHE_SYS_PATH.'cache_field_member.php';
		creat_inc($file,$s);
	}
}

?>