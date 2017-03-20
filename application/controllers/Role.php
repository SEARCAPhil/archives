<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('item');
		$this->load->model('category');
		$this->load->model('privilege');
		$this->load->helper(array('form','url','pager'));
		$this->load->library(array('form_validation','session'));

		parent::set_maintenance();

		$this->session_privileges=array();
		$this->session_categories=array();
		$this->session_sub_categories=array();
		$this->session_category_is_accessible=0;


		self::load_privileges();
		self::load_menu();
		self::get_parent_categories();
		self::get_children_categories();

	}


	public function load_privileges(){
		$this->session_privileges=($this->privilege->get_privilege(@$_SESSION['priv']));
	}

	public function load_menu(){
		
		$this->menu=array(
			'category'=>1,
			'permission'=>$this->privilege->is_allowed_to_grant_role(),
			'materials'=>$this->privilege->is_allowed_to_write_materials()

		);


	}


	/**
	 * Get children categories
	 * 
	 * Display subcategories depending upon user/category privilege.
	 * It relies on get parameter to detect its parent
	 * @return array(data,param,details,items)
	 */

	public function get_children_categories(){
		$this->session_sub_categories=($this->category->get_children_categories(@$this->session_privileges[0]->role_id,$this->input->get('id',true)));	
	}

	public function get_parent_categories(){

		$this->session_categories=($this->category->get_parent_categories(@$this->session_privileges[0]->role_id));

	}


	public function get_all_children_categories($id){
		$role_id=(int) strip_tags(htmlentities(htmlspecialchars($this->input->get('role_id',true))));
		return $this->category->get_all_children_categories($id,$role_id);	
		
	}

	public function get_all_parent_categories(){
		$id=(int) strip_tags(htmlentities(htmlspecialchars($this->input->get('role_id',true))));
		return $this->category->get_all_parent_categories($id);
	}


	public function privilege(){
		$data=@json_decode($this->input->post('data',true));	
		$id=(int) strip_tags(htmlentities(htmlspecialchars($this->input->post('id',true))));

		if(!empty($id)&&$id>0){

			if(gettype($data)=='array'){			
				$this->privilege->_set_privilege($id,$data);
			}
	
		} 
	}



	public function index(){


		$this->load->view('pages/header.php');

		//prevent empty id
		$id=(int) strip_tags(htmlentities(htmlspecialchars($this->input->get('role_id',true))));
		if(empty($id)||$id<=0) return 0;


		//empty details if do not have privilege to view
		if(!$this->privilege->is_allowed_to_grant_role()){
			$details=array();
		}else{
			$details=($this->privilege->_get_privilege_details($id));	
		}
		
		

		$this->load->view('pages/navigation.php',array('data'=>$this->session_categories,'sub'=>$this->session_sub_categories,'param'=>$this->input->get(),'role'=>$details,'menu'=>$this->menu));


		//show only if have privilege to view
		if($this->privilege->is_allowed_to_grant_role()){
			$this->load->view('pages/role.php');
		}else{
			$this->load->view('errors/html/error_permission.php');
		}


		
		$this->load->view('pages/footer.php');
	}

}