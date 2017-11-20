<?php
class content extends Checklogin{

	public function init(){
		$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
		$form=base::load_cache("cache_form","_form");
		$array=get_array($form,'id',$formid,0);
		assign('form',$array[0]);
		template('content_list','admin/form');
	}
	
	public function show(){
		$id=isset($_GET['id'])?intval($_GET['id']):0;
		$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
		$form=formtable($formid);
		$rs=$this->mysql->get_one("select * from ".DB_PRE.$form." where `id`=".$id);
		
		$field=base::load_cache("cache_form_".$form,"_field");
		$fields="";
		foreach($field as $value){
			$fields.="<tr>\n";
			$fields.="<td align=\"right\">".$value['name']."：</td>\n";
			$fields.="<td colspan=\"3\">".$rs[$value['field']]."</td>\n";
			$fields.="</tr>\n";
		}
		
		assign("rs",$rs);
		assign("fields",$fields);
		assign("formid",$formid);
		template('content_show','admin/form');
	}
	
	public function delete(){
		if(isset($_POST['id'])){
			$formid=isset($_POST['formid'])?intval($_POST['formid']):0;
			foreach($_POST['id'] as $id){
				$this->del_data($id,$formid);
			}
		}elseif(isset($_GET['id'])){
			$id=$_GET['id'];
			$formid=isset($_GET['formid'])?intval($_GET['formid']):0;
			$this->del_data($id,$formid);
		}else{
			showmsg(C('error'),'-1');
		}
		showmsg(C('delete_success'),'-1');
	}
	
	//处理数据删除函数
	private function del_data($id,$formid){
		$form=formtable($formid);
		$this->mysql->db_delete($form,'`id`='.$id);
	}
}
?>