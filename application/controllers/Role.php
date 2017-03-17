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
		self::get_parent_categories();
		self::get_children_categories();

	}


	public function load_privileges(){
		$this->session_privileges=($this->privilege->get_privilege(@$_SESSION['priv']));
	}



	/**
	 *Detect if item is available for viewing 
	 * 
	 * This will prevent access of items from ordinary user
	 * that should be only available for admin accounts
	 */

	public function is_available_for_user($is_private=1){

		return (!$is_private)||self::isAdmin();
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


	public function get_categories(){
		$details=self::get_category_details();
		return array('data'=>$this->session_categories,'sub'=>$this->session_sub_categories,'param'=>$this->input->get(),'details'=>$details,'items'=>self::get_items());
	}






	public function get_all_children_categories($id){

		return $this->category->get_all_children_categories($id);	
		
	}

	public function get_all_parent_categories(){

		return $this->category->get_all_parent_categories();

	}






	/**
	 * Get details
	 * 
	 * Display category details
	 * @return array()
	 */

	public function get_category_details(){

		$this->category_details=array();

		if($this->category->is_accessible(@$this->session_privileges[0]->role_id,$this->input->get('id',true))){

			$this->category_details=$this->category->get_category_details($this->input->get('id',true));

		}

		return $this->data=$this->category_details;		

	}





	/**
	 * Get Items
	 * 
	 * Display all items that fall under this category
	 * @return array()
	 */

	public function get_items(){

		$this->items=$this->item->get_items($this->input->get('id',true),$this->input->get('page',true));
		return $this->data=$this->items;
	}





	/**
	 * Get Item details
	 * 
	 * Display all information aof the item
	 * Items under a private category are only accessible by admin accounts
	 * @return array()
	 */

	public function get_item_details(){

		$item=$this->item->get_item_details($this->input->get('id',true));
		
		$this->item=[];
		#check if details can be viewd by ordinary user
		if(isset($item[0]->cat_id)){

			if($this->category->is_accessible(@$this->session_privileges[0]->role_id,$item[0]->cat_id)){

				$this->item=$item;
			}

		}

		
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>$this->item);
	}




	public function index(){

		$this->load->view('pages/header.php');
		$this->load->view('pages/navigation.php',self::get_categories());
		$this->load->view('pages/role.php');
		$this->load->view('pages/footer.php');
	}

}