<?php

/**
 * Home Controller
 * 
 * Default controller for the system
 * It holds function for getting categories , searching 
 * and User account identification.
 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Advance extends MY_Controller {


	public $data;
	private $categories;
	private $sub_categories;




	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('category');
		$this->load->model('item');
		$this->load->model('auth');
		$this->load->model('privilege');
		$this->load->helper(array('form','url','pager'));
		$this->load->library(array('form_validation','session'));

		parent::set_maintenance();


		self::load_privileges();
		self::load_menu();
		self::get_parent_categories();
		self::get_children_categories();
		self::get_category_details();
		self::get_items();
		self::get_item_details();
		


	}


	/*
	 * Load account privileges
	 *
	 * */
	public function load_privileges(){
		$this->session_privileges=($this->privilege->get_privilege(@$_SESSION['priv']));
	}




	/*
	* Load Menu Based on privilege
	*
	*/
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
	 * Get children categories based on role privilege
	 * It relies on get parameter to detect its parent
	 */

	public function get_children_categories(){
		$this->session_sub_categories=($this->category->get_children_categories(@$this->session_privileges[0]->role_id,$this->input->get('id',true)));	
	}


	public function get_parent_categories(){

		$this->session_categories=($this->category->get_parent_categories(@$this->session_privileges[0]->role_id));


	}


	public function get_category_details(){

		$this->category_details=array();
		if($this->category->is_accessible(@$this->session_privileges[0]->role_id,$this->input->get('id',true))){
			$this->category_details=$this->category->get_category_details(@$this->session_privileges[0]->role_id,$this->input->get('id',true));
		}	

	}



	/**
	 * Get Items
	 * 
	 * Display all items that fall under this category
	 * @return array()
	 */

	public function get_items(){

		$this->items=array('data'=>array());

		#check category read privilege before viewing
		if(@$this->category_details[0]->read_privilege) $this->items=$this->item->get_items(@$this->input->get('id',true),@$this->input->get('page',true));	
		
	}



	/**
	 * Show all categories,sub,para,details,menu and items
	 */
	public function get_categories(){
	
		return array('data'=>$this->session_categories,'sub'=>$this->session_sub_categories,'param'=>$this->input->get(),'details'=>$this->category_details,'items'=>$this->items,'menu'=>$this->menu);
	}



	/**
	 * Get Item details
	 * 
	 * Display all information aof the item
	 * Items under a private category are only accessible by admin accounts
	 * @return array()
	 */

	public function get_item_details(){

		$item=$this->item->get_item_details($this->input->get('item_id',true));
		
		$this->item_details=[];
		#check if details can be viewd by ordinary user
		if(isset($item[0]->cat_id)){

			if($this->category->is_accessible(@$this->session_privileges[0]->role_id,$item[0]->cat_id)){

				$this->item_details=$item;
			}

		}
		
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>$this->item_details,'menu'=>$this->menu);
	}


		/**
	 * ADVANCE Search Items
	 * 
	 * Searach items based on given inputs
	 * @return array()
	 */
	public function __advance_search(){
		$__params = [];
		# clean param
		foreach($this->input->get() as $key => $val) {
			$key = str_replace('__', '', $key);
			# parse __0__ , __1__, etc...
			
			$__val = abs((int) @filter_var($key, FILTER_SANITIZE_NUMBER_INT));
			$__name = $words = preg_replace('/[0-9]+/', '', $key);
			$__params[$__val] = isset($__params[$__val]) ? $__params[$__val] : [];
			$__params[$__val][$__name] = isset($__params[$__val][$__name]) ? $__params[$__val][$__name] : [];
				
			$__params[$__val][$__name] = $val;
		}

	
	
		$this->search_result=$this->item->search_advanced(@$this->session_privileges[0]->role_id,$__params,$this->input->get('page',true));
		return $this->data=array('items'=>$this->search_result,'param'=>$this->input->get());
	}


	/**
	 * Index
	 * 
	 * Default display when system is online
	 * This will also load default configurations and authentication
	 * 
	 **/

	public function __header(){

		#detect if user is logedout and logout parameter is give in the URI
		if($this->input->get('logout')!=NULL){ $this->auth->logout(); unset($_SESSION);  }


		#header
		$this->load->view('pages/header.php');
		
		

		if($this->session->id==NULL){
			//sign-in
			$this->load->view('forms/login.php',array('data'=>$this->input->get('login_error')));

		}else{

			//load pages
			$this->load->view('pages/navigation.php',self::get_categories());
			


			#expire the cookie
			#this cookie is used to detect which item is currently selected or uploaded
	        setcookie("dms-upload-id",'',1);
	        setcookie("dms-upload-cat",'',1);

		}
	}

	public function __footer(){

		
		$this->load->view('pages/copyright.php');
		$this->load->view('pages/footer.php');
	}

	public function index()
	{	



	}


	public function search(){

		self::__header();

		if(!is_null($this->session->id)){
			$fields = $this->item->__get_fields();
			$this->load->view('pages/search_advance.php', array('data' => array('fields' => $fields)));
		}

		self::__footer();
	}


	public function result(){
		self::__header();

		$this->load->view('pages/search_advance_results.php',self::__advance_search());
		self::__footer();	
	}
	
	


}
