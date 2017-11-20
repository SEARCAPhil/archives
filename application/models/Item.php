<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_items($id,$page=1){
		$this->page=(int) $page;
		$limit=$this->page<2?0:( integer)($this->page-1)*20;
		$query = "SELECT * FROM item where cat_id=? LIMIT ?,20";
		$count_sql="SELECT count(*) as total from item where cat_id=?";
		$stmt=$this->db->query($query,array($id,$limit));
		$stmt2=$this->db->query($count_sql,array($id));
		
		$count=$stmt2->result()[0]->total;
		$no_pages=1;
		if($count>=20){
				$pages=ceil($count/20);
				$no_pages=$pages;
				
		}else{
				$no_pages=1;

		}

	

		#check if page request is < the actual page
		$current_page=$this->page<=$no_pages?$this->page:$no_pages;

		return array('total'=>$count,'pages'=>$no_pages,'current_page'=>$current_page,'data'=>$stmt->result());
	}

	public function get_item_category($id){
		$this->id=(int) $id;
		$query = "SELECT * FROM item LEFT JOIN category on category.id=item.cat_id where item.id=? LIMIT 0,20";
		$stmt=$this->db->query($query,array($this->id));
		return $stmt->result();
	}

	public function get_item_details($id){
		$query = "SELECT item.*,category.category,category.is_private,account_profile.profile_name FROM item LEFT JOIN category on item.cat_id=category.id LEFT JOIN account_profile on account_profile.id=item.encoded_by_id where item.id=? LIMIT 0,20";
		$stmt=$this->db->query($query,array($id));
		return $stmt->result();
	}

	public function set_item($item=array(),$encoded_by_id){

		$this->cat_id=isset($item['series'])?htmlentities(htmlspecialchars($item['series'])):'';
		$this->date_range=isset($item['date_range'])?htmlentities(htmlspecialchars($item['date_range'])):'';
		$this->language=isset($item['language'])?htmlentities(htmlspecialchars($item['language'])):'';
		$this->location=isset($item['location'])?htmlentities(htmlspecialchars($item['location'])):'';
		$this->shelf_cabinet_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['shelf'])):'';
		$this->tier_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['tier'])):'';
		$this->box_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['box'])):'';
		$this->folder_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['folder'])):'';
		$this->record_number=isset($item['record'])?htmlentities(htmlspecialchars($item['record'])):'';
		$this->material=isset($item['printable'])?htmlentities(htmlspecialchars($item['printable'])):'';
		$this->access_condition=isset($item['access'])?htmlentities(htmlspecialchars($item['access'])):'';
		$this->physical_condition=isset($item['physical'])?htmlentities(htmlspecialchars($item['physical'])):'';
		$this->quantity=isset($item['quantity'])?htmlentities(htmlspecialchars($item['quantity'])):'';
		$this->record_group=isset($item['record_group'])?htmlentities(htmlspecialchars($item['record_group'])):'';
		$this->document_title=isset($item['title'])?trim($item['title']):'';
		$this->creator=isset($item['creator'])?htmlentities(htmlspecialchars($item['creator'])):'';
		$this->place=isset($item['place'])?htmlentities(htmlspecialchars($item['place'])):'';
		$this->publisher=isset($item['publisher'])?htmlentities(htmlspecialchars($item['publisher'])):'';
		$this->source_title=isset($item['source'])?htmlentities(htmlspecialchars($item['source'])):'';
		$this->collation=isset($item['collation'])?htmlentities(htmlspecialchars($item['collation'])):'';
		$this->content_description=isset($item['content_description'])?trim($item['content_description']):'';
		$this->notes=isset($item['notes'])?htmlentities(htmlspecialchars($item['notes'])):'';
		$this->keywords=isset($item['keywords'])?htmlentities(htmlspecialchars($item['keywords'])):'';
		$this->provenance=isset($item['provenance'])?htmlentities(htmlspecialchars($item['provenance'])):'';
		$this->remarks=isset($item['remarks'])?htmlentities(htmlspecialchars($item['remarks'])):'';
		$this->date_modified=date('Y/m/d');
		$this->encoded_by_id=isset($encoded_by_id)?htmlentities(htmlspecialchars($encoded_by_id)):'';


		$query="INSERT INTO item(cat_id,date_range,language,location,shelf_cabinet_number,tier_number,box_number,folder_number,record_number,material,access_condition,physical_condition,quantity,record_group,document_title,creator,place,publisher,source_title,collation,content_description,notes,keywords,provenance,remarks,encoded_by_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt=$this->db->query($query,array($this->cat_id,$this->date_range,$this->language,$this->location,$this->shelf_cabinet_number,$this->tier_number,$this->box_number,$this->folder_number,$this->record_number,$this->material,$this->access_condition,$this->physical_condition,$this->quantity,$this->record_group,$this->document_title,$this->creator,$this->place,$this->publisher,$this->source_title,$this->collation,$this->content_description,$this->notes,$this->keywords,$this->provenance,$this->remarks,$this->encoded_by_id));
		
		return $this->db->insert_id();
	}



	public function update_item($item=array()){

		$this->id=isset($item['id'])?htmlentities(htmlspecialchars($item['id'])):'';
		$this->date_range=isset($item['date_range'])?htmlentities(htmlspecialchars($item['date_range'])):'';
		$this->language=isset($item['language'])?htmlentities(htmlspecialchars($item['language'])):'';
		$this->location=isset($item['location'])?htmlentities(htmlspecialchars($item['location'])):'';
		$this->shelf_cabinet_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['shelf'])):'';
		$this->tier_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['tier'])):'';
		$this->box_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['box'])):'';
		$this->folder_number=isset($item['shelf'])?htmlentities(htmlspecialchars($item['folder'])):'';
		$this->record_number=isset($item['record'])?htmlentities(htmlspecialchars($item['record'])):'';
		$this->material=isset($item['printable'])?htmlentities(htmlspecialchars($item['printable'])):'';
		$this->access_condition=isset($item['access'])?htmlentities(htmlspecialchars($item['access'])):'';
		$this->physical_condition=isset($item['physical'])?htmlentities(htmlspecialchars($item['physical'])):'';
		$this->quantity=isset($item['quantity'])?htmlentities(htmlspecialchars($item['quantity'])):'';
		$this->record_group=isset($item['record_group'])?htmlentities(htmlspecialchars($item['record_group'])):'';
		$this->document_title=isset($item['title'])?htmlentities(htmlspecialchars($item['title'])):'';
		$this->creator=isset($item['creator'])?htmlentities(htmlspecialchars($item['creator'])):'';
		$this->place=isset($item['place'])?htmlentities(htmlspecialchars($item['place'])):'';
		$this->publisher=isset($item['publisher'])?htmlentities(htmlspecialchars($item['publisher'])):'';
		$this->source_title=isset($item['source'])?htmlentities(htmlspecialchars($item['source'])):'';
		$this->collation=isset($item['collation'])?htmlentities(htmlspecialchars($item['collation'])):'';
		$this->content_description=isset($item['content_description'])?htmlentities(htmlspecialchars($item['content_description'])):'';
		$this->notes=isset($item['notes'])?htmlentities(htmlspecialchars($item['notes'])):'';
		$this->keywords=isset($item['keywords'])?htmlentities(htmlspecialchars($item['keywords'])):'';
		$this->provenance=isset($item['provenance'])?htmlentities(htmlspecialchars($item['provenance'])):'';
		$this->remarks=isset($item['remarks'])?htmlentities(htmlspecialchars($item['remarks'])):'';
		$this->cat_id=isset($item['series'])?htmlentities(htmlspecialchars($item['series'])):'';
		$this->date_of_input=date('Y/m/d');


		$query="UPDATE item set date_range=?,language=?,location=?,shelf_cabinet_number=?,tier_number=?,box_number=?,folder_number=?,record_number=?,material=?,access_condition=?,physical_condition=?,quantity=?,record_group=?,document_title=?,creator=?,place=?,publisher=?,source_title=?,collation=?,content_description=?,notes=?,keywords=?,provenance=?,remarks=?,date_of_input=? ,cat_id=? where id=?";
		$stmt=$this->db->query($query,array($this->date_range,$this->language,$this->location,$this->shelf_cabinet_number,$this->tier_number,$this->box_number,$this->folder_number,$this->record_number,$this->material,$this->access_condition,$this->physical_condition,$this->quantity,$this->record_group,$this->document_title,$this->creator,$this->place,$this->publisher,$this->source_title,$this->collation,$this->content_description,$this->notes,$this->keywords,$this->provenance,$this->remarks,$this->date_of_input,$this->cat_id,$this->id));
		
		return $this->db->affected_rows();
	}


	public function remove($id){
		$this->db->trans_start();
		$query = "DELETE FROM item where id=?";
		$stmt=$this->db->query($query,array($id));

		$this->db->trans_complete();

		if ($this->db->trans_status() !== FALSE)
		{
		        return $this->db->affected_rows();
		}

		return 0;
		
	}


	public function search($role_id,$param,$page=1){
		$this->page=(int) $page;
		$limit=$this->page<2?0:( integer)($this->page-1)*20;
		$query = "SELECT item.*,role_category_inclusion.read_privilege FROM role_category_inclusion LEFT JOIN item on role_category_inclusion.category_id=item.cat_id where role_category_inclusion.role_id=? and role_category_inclusion.read_privilege=1 and (document_title LIKE ? or content_description LIKE ? or publisher LIKE ? or creator LIKE ? or date_range LIKE ? or language LIKE ? or location LIKE ? or shelf_cabinet_number LIKE ? or tier_number LIKE ? or box_number LIKE ? or folder_number LIKE ? or record_number LIKE ? or material LIKE ? or access_condition LIKE ? or physical_condition LIKE ? or quantity LIKE ? or record_group LIKE ? or place LIKE ? or source_title LIKE ? or collation LIKE ? or datez LIKE ? or notes LIKE ? or keywords LIKE ? or provenance LIKE ? or encoded_by LIKE ? or date_of_input LIKE ?  or remarks LIKE ?  or original_file_name LIKE ?) LIMIT ?,20";
		$stmt=$this->db->query($query,array($role_id,'%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%',$limit));

		$query2 = "SELECT count(item.cat_id) as total FROM role_category_inclusion LEFT JOIN item on role_category_inclusion.category_id=item.cat_id where role_category_inclusion.role_id=? and role_category_inclusion.read_privilege=1 and (document_title LIKE ? or content_description LIKE ? or publisher LIKE ? or creator LIKE ? or date_range LIKE ? or language LIKE ? or location LIKE ? or shelf_cabinet_number LIKE ? or tier_number LIKE ? or box_number LIKE ? or folder_number LIKE ? or record_number LIKE ? or material LIKE ? or access_condition LIKE ? or physical_condition LIKE ? or quantity LIKE ? or record_group LIKE ? or place LIKE ? or source_title LIKE ? or collation LIKE ? or datez LIKE ? or notes LIKE ? or keywords LIKE ? or provenance LIKE ? or encoded_by LIKE ? or date_of_input LIKE ?  or remarks LIKE ?  or original_file_name LIKE ?)";
		$stmt2=$this->db->query($query2,array($role_id,'%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%', '%'.$param.'%'));


		
		$count=isset($stmt2->result()[0]->total)?$stmt2->result()[0]->total:0;
		$no_pages=1;
		if($count>=20){
				$pages=ceil($count/20);
				$no_pages=$pages;
				
		}else{
				$no_pages=1;

		}

		#check for 0 value
		if($no_pages<1) $no_pages=1;

		#check if page request is < the actual page
		$current_page=$this->page<=$no_pages||$this->page>0?$this->page:$no_pages;

		#check for 0 value
		if($current_page<1) $current_page=1;

		return array('total'=>$count,'pages'=>$no_pages,'current_page'=>$current_page,'data'=>$stmt->result());
	
	}




	public function search_advance($role_id,$param,$page=1){
		$this->page=(int) $page;
		$limit=$this->page<2?0:( integer)($this->page-1)*20;

		$sql_fileds='';
		$sql_param=array();
		$sql_logic='or';
		$sql_operator='LIKE';

		array_push($sql_param, $role_id);


		//count number of params in foreach
		$param_counter=0;

		foreach ($param as $key => $value) {

			if(strlen(trim(htmlentities(htmlspecialchars($value))))<1) unset($param[$key]);
		}

		//remove page
		
		if(isset($param['page'])) unset($param['page']);

		//assign and unset logic

		if(@$param['logic']=='and'||@$param['logic']=='or'||@$param['logic']=='not'){
			$sql_logic=strip_tags(htmlentities(htmlspecialchars(utf8_encode(@$param['logic']))));
		}

		if(isset($param['logic'])) unset($param['logic']);



		foreach ($param as $key => $value) {

			$param_counter++;



			${$key}=trim(strip_tags(htmlentities(htmlspecialchars($value))));


			$__{$key}=explode('|',trim($value));

			//filter empty
			$__{$key}=array_filter($__{$key});


			if($sql_logic=='not'){
				$sql_logic='and';
				$sql_operator='NOT LIKE';
			}


			if(count($__{$key})>0){
				$sql_fileds.='(';
					for($x=0; $x<count($__{$key});$x++){
						

						$sql_fileds.=' item.'.$key.' '.$sql_operator.' ?';

						#equivalent bind param
						array_push($sql_param,'%'.trim($__{$key}[$x]).'%');

						if(count($__{$key})-1>$x){
							 $sql_fileds.=' '.$sql_logic;
						}
					}
				$sql_fileds.=')';
			}


			//add OR for multiple params
			if($param_counter<count($param)) $sql_fileds.=' '.$sql_logic.' ';

			

		}


		//with limit param
		$sql_param_with_limit=$sql_param;
		array_push($sql_param_with_limit,$limit);

		if(!empty($sql_fileds)){
			$query = "SELECT item.*,role_category_inclusion.read_privilege FROM role_category_inclusion LEFT JOIN item on role_category_inclusion.category_id=item.cat_id where role_category_inclusion.role_id=? and role_category_inclusion.read_privilege=1 and (".$sql_fileds.") LIMIT ?,20";
			
			$stmt=$this->db->query($query,$sql_param_with_limit);


			$query2 = "SELECT count(*) as total,role_category_inclusion.read_privilege FROM role_category_inclusion LEFT JOIN item on role_category_inclusion.category_id=item.cat_id where role_category_inclusion.role_id=? and role_category_inclusion.read_privilege=1 and (".$sql_fileds.")";
			
			$stmt2=$this->db->query($query2,$sql_param);
		}



		if(isset($stmt2)) {
			$count=isset($stmt2->result()[0]->total)?$stmt2->result()[0]->total:0;
		}else{
			$count=0;
		}
		
		
		$no_pages=1;
		if($count>=20){
				$pages=ceil($count/20);
				$no_pages=$pages;
				
		}else{
				$no_pages=1;

		}

		#check for 0 value
		if($no_pages<1) $no_pages=1;

		#check if page request is < the actual page
		$current_page=$this->page<=$no_pages||$this->page>0?$this->page:$no_pages;

		#check for 0 value
		if($current_page<1) $current_page=1;

		$res=array();
		if(isset($stmt)) $res=$stmt->result();

		return array('total'=>$count,'pages'=>$no_pages,'current_page'=>$current_page,'data'=>@$res);
	
	}

	
}
