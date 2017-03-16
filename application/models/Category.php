<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->hierarchy=array();
	}


	/////////////////////////////////////////////////////////////////////*
	// Parent categories
	// Categories without parent_id
	//
	//////////////////////////////////////////////////////////////////////*/


	public function get_parent_categories($role_id=NULL){

		/*----------------------------------------------------------
		* Filter whitelisted categories
		*
		*-----------------------------------------------------------
		*/

		$included_category_array=(self::get_included_parent_categories($role_id));

		$included_list=array(0);

		#itirate objects and store to list
		for($x=0;$x<count($included_category_array);$x++){
			array_push($included_list, $included_category_array[$x]->id);
		}

		#convert to comma separated value string
		$included=(implode($included_list, ','));


		$stmt = $this->db->query("SELECT * FROM category where parent_id=0 and id IN (".$included.")  ORDER by category ASC");	 

		

		return $stmt->result();
	}




	public function get_included_parent_categories($role_id){

		$stmt = $this->db->query("SELECT category.* FROM category LEFT JOIN role_category_inclusion on category.id=role_category_inclusion.category_id where role_category_inclusion.role_id=? and category.parent_id=0 ORDER by category.category ASC",array($role_id));
		return $stmt->result();
	}



	/////////////////////////////////////////////////////////////////////*
	// Children categories
	// Categories with a given parent_id
	//
	//////////////////////////////////////////////////////////////////////*/

	public function get_children_categories($role_id,$parent_id){
		$this->parent_id=(int) htmlentities(htmlspecialchars($parent_id));

		if($this->parent_id<=0) return NULL;

		$included_category_array=(self::get_included_children_categories($role_id,$parent_id));

		$included_list=array(0);

		#itirate objects and store to list
		for($x=0;$x<count($included_category_array);$x++){
			array_push($included_list, $included_category_array[$x]->id);
		}

		#convert to comma separated value string
		$included=(implode($included_list, ','));


		$query="SELECT * FROM category where parent_id=? and id IN (".$included.") ORDER by category ASC";
		$stmt=$this->db->query($query,array($this->parent_id));
		return $stmt->result();
	}





	public function get_category_details($id){
		$this->id=(int) htmlentities(htmlspecialchars($id));
		$query="SELECT * FROM category where id=?";
		$stmt=$this->db->query($query,array($this->id));
		return $stmt->result();
	}


	public function get_included_children_categories($role_id,$parent_id){
		$stmt = $this->db->query("SELECT category.* FROM category LEFT JOIN role_category_inclusion on category.id=role_category_inclusion.category_id where role_category_inclusion.role_id=? and category.parent_id=? ORDER by category.category ASC",array($role_id,$parent_id));
		return $stmt->result();
	}

	public function is_accessible($role_id,$id){
		$stmt = $this->db->query("SELECT count(*) as total FROM role_category_inclusion  where role_category_inclusion.role_id=? and category_id=?",array($role_id,$id));

		if(isset($stmt->result()[0]->total)){
			return $stmt->result()[0]->total>0;
		}
		
		return 0;
	}



}
