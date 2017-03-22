<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Model {
	//session data
	

	public function __construct(){
		parent::__construct();
		$this->session_privilege_data=array();
	}

	public function _get_roles(){

	

		$sql="SELECT * from role";

		$stmt = $this->db->query($sql);

		$result=$stmt->result();

		return $result;
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

	public function _get_privilege_details($role_id){


		$sql="SELECT * FROM role where id=? ORDER BY role.id DESC LIMIT 1";

		$stmt = $this->db->query($sql,array($role_id));

		return $stmt->result();
	}

	public function _set_privilege($role_id,$data=array()){
		/*---------------------------
		* Flush old privilegews before adding new one
		* response 200 -ok
		* 300 - failed
		*/

		$response=array();
		$response['status']=300;

		$this->db->trans_begin();

		$sql="DELETE FROM role_category_inclusion where role_id=?";

		$stmt = $this->db->query($sql,array($role_id));
		

		for($x=0;$x<count($data);$x++){
			$id=@$data[$x]->id; 	
			$read=@$data[$x]->read; 
			$write=@$data[$x]->write; 
			$update=@$data[$x]->update; 
			$delete=@$data[$x]->delete; 

			$sql2="INSERT INTO role_category_inclusion(role_id,category_id,read_privilege,write_privilege,update_privilege,delete_privilege) values(?,?,?,?,?,?)";
			$stmt2 = $this->db->query($sql2,array($role_id,$id,$read,$write,$update,$delete));
		}


		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		}
		else
		{
		        $this->db->trans_commit();
		        $response['status']=200;
		}

		echo json_encode($response);
	}

	public function is_allowed_to_grant_role(){
		return $this->session_privilege_data[0]->grant_role_privilege==1;
	}

	
	public function is_allowed_to_write_materials(){
		return $this->session_privilege_data[0]->write_materials_privilege==1;
	}





}