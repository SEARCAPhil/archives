<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Model {
	//session data
	

	public function __construct(){
		parent::__construct();
		$this->session_privilege_data=array();
	}

	public function get_privilege($role){

		/*-----------------------------------------
		* Privilege Default
		* change to dfault user privilege if not present on the role table
		* Comment the code below to set the role to NULL
		*/
		if(is_null($role)) $role='general';


		$sql="SELECT role.id,role.role,role_privilege.*, role_privilege.id as role_privilege_id FROM role LEFT JOIN role_privilege on role.id=role_privilege.role_id where role.role=? ORDER BY role.id DESC LIMIT 1";

		$stmt = $this->db->query($sql,array($role));

		$result=$stmt->result();

		$this->session_privilege_data=$result;

		return $result;
	}


}