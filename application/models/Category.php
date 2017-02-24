<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_parent_categories(){
		$stmt = $this->db->query("SELECT * FROM category where parent_id=0 ORDER by category ASC");
		return $stmt->result();
	}

	public function get_parent_categories_for_user_only(){
		$stmt = $this->db->query("SELECT * FROM category where parent_id=0 and is_private=0 ORDER by category ASC");
		return $stmt->result();
	}



	public function get_children_categories($parent_id){
		$this->parent_id=(int) htmlentities(htmlspecialchars($parent_id));
		$query="SELECT * FROM category where parent_id=? ORDER by category ASC";
		$stmt=$this->db->query($query,array($this->parent_id));
		return $stmt->result();
	}

	public function get_children_categories_for_user_only($parent_id){
		$this->parent_id=(int) htmlentities(htmlspecialchars($parent_id));
		$query="SELECT * FROM category where parent_id=? and is_private=0 ORDER by category ASC";
		$stmt=$this->db->query($query,array($this->parent_id));
		return $stmt->result();
	}

	public function get_category_details($id){
		$this->id=(int) htmlentities(htmlspecialchars($id));
		$query="SELECT * FROM category where id=?";
		$stmt=$this->db->query($query,array($this->id));
		return $stmt->result();
	}
}
