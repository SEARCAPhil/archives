<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function change_file_name($id,$original_file_name,$file_name){

		$this->id=htmlentities(htmlspecialchars($id));
		$original_file_name=htmlentities(htmlspecialchars($original_file_name));
		$sql='UPDATE item set original_file_name=?, file_name=? where id=?';
		$stmt = $this->db->query($sql,array($original_file_name,$file_name,$this->id));
		return $this->db->affected_rows();

	}

	public function save($id,$original_file_name,$file_name){

		$this->id = htmlentities(htmlspecialchars($id));
		$original_file_name = htmlentities(htmlspecialchars($original_file_name));
		$sql='INSERT INTO attachments(item_id, original_filename, filename) values (?,?,?)';
		$stmt = $this->db->query($sql,array($this->id,$original_file_name,$file_name));
		return $this->db->affected_rows();

	}

	public function download($id){
		$this->id=(int) htmlentities(htmlspecialchars($id));	
	}

	public function get_details($id){
		$this->id = (int) $id;
		$query = "SELECT * FROM attachments where id=?";
		$stmt=$this->db->query($query,array($this->id));
		return $stmt->result();
	}
}
