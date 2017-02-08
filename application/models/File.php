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

	public function download($id){

			$this->id=(int) htmlentities(htmlspecialchars($id));
			

	}
}
