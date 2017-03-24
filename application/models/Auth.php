<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function login($username,$password){
		$password=sha1($password);
		$sql="SELECT login_db_instance_1.accounts.account_username as username,login_db_instance_1.accounts.id,login_db_instance_1.doc_sys_privilege.priv,login_db_instance_1.account_profile.profile_image,login_db_instance_1.account_profile.profile_name,login_db_instance_1.account_profile.profile_name,login_db_instance_1.account_profile.position,login_db_instance_1.account_profile.first_name,login_db_instance_1.account_profile.last_name,login_db_instance_1.account_profile.date_modified,login_db_instance_1.department.dept_name,login_db_instance_1.department.dept_id,login_db_instance_1.department.dept_alias FROM login_db_instance_1.accounts left join login_db_instance_1.account_profile on login_db_instance_1.account_profile.uid=accounts.id left JOIN login_db_instance_1.department on login_db_instance_1.department.dept_id=account_profile.dept_id left join login_db_instance_1.doc_sys_privilege on login_db_instance_1.doc_sys_privilege.uid=login_db_instance_1.accounts.id where login_db_instance_1.accounts.account_username=? and login_db_instance_1.accounts.account_password=?";
		$stmt = $this->db->query($sql,array($username,$password));
		return $stmt->result();
	}


	function account_exists($username){
		$this->username=htmlentities(htmlspecialchars($username));
		$sql="SELECT * FROM account where username=? ORDER BY id DESC LIMIT 1";
		$statement=$this->db->query($sql,array($this->username));
		return $statement->result();		
	}


	function profile_exists($user_id,$date_modified){
	
		$this->user_id=htmlentities(htmlspecialchars($user_id));
		$this->date=htmlentities(htmlspecialchars($date_modified));

		$sql="SELECT * FROM account_profile where uid=? and date_modified=? ORDER BY id DESC LIMIT 1";
		$statement=$this->db->query($sql,array($this->user_id,$this->date));
		return $statement->result();		
	}


	function create_account($username,$uid){
		$this->username=htmlentities(htmlspecialchars($username));
		$this->uid=htmlentities(htmlspecialchars($uid));
		$sql="INSERT INTO account(username,uid)values(?,?)";
		$statement=$this->db->query($sql,array($this->username,$this->uid));
		
		return $this->db->insert_id();
	}


	function create($uid,$full_name,$last_name,$first_name,$image,$department,$alias,$position,$date_modified){
			
		$this->uid=htmlentities(htmlspecialchars($uid));
		$this->full_name=@htmlentities(htmlspecialchars($full_name));
		$this->last_name=@htmlentities(htmlspecialchars($last_name));
		$this->first_name=@htmlentities(htmlspecialchars($first_name));
		$this->image=@htmlentities(htmlspecialchars($image));
		$this->department=@htmlentities(htmlspecialchars($department));
		$this->alias=@htmlentities(htmlspecialchars($alias));
		$this->position=@htmlentities(htmlspecialchars($position));
		$this->date_modified=@htmlentities(htmlspecialchars($date_modified));
		
		
		$sql="INSERT INTO account_profile(profile_name,last_name,first_name,profile_image,department,department_alias,position,date_modified,uid)values(?,?,?,?,?,?,?,?,?)";
		$statement=$this->db->query($sql,array($this->full_name,$this->last_name,$this->first_name,$this->image,$this->department,$this->alias,$this->position,$this->date_modified,$this->uid));
		
		return $this->db->insert_id();	

	}

	function logout(){

	    $user_data = $this->session->all_userdata();

	    foreach ($user_data as $key => $value) {
	        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	            $this->session->unset_userdata($key);
	        }
	    }

	}


}
