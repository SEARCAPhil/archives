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

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

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
	 * Search Items
	 * 
	 * Searach items based on given inputs
	 * @return array()
	 */
	public function search(){

		$this->search_result=$this->item->search(@$this->session_privileges[0]->role_id,$this->input->get('search',true),$this->input->get('page',true));
		return $this->data=array('items'=>$this->search_result,'param'=>$this->input->get());
	}



	/**
	 * Index
	 * 
	 * Default display when system is online
	 * This will also load default configurations and authentication
	 * 
	 **/

	public function index()
	{	

		#detect if user is logged-out and logout parameter is give in the URI
		if($this->input->get('logout')!=NULL){ $this->auth->logout(); unset($_SESSION);  }

		# detect redirection
		if($this->input->get('redirect') && $this->input->get('loc')) {
			header('location:'.$this->input->get('loc')); 
			exit; 
		}

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





			#ID and title must be present to view the item
			#if not it is detected as a search call
			if(!is_null($this->input->get('item_id',true))&&!(is_null($this->input->get('title',true)))){


				//get item category
				$cat_id=isset($this->item_details[0]->cat_id)?$this->item_details[0]->cat_id:NULL;

				//update category details based on category_id of the Item
				$this->category_details=$this->category->get_category_details(@$this->session_privileges[0]->role_id,$cat_id);


				//check if readable content
				if(@$this->category_details[0]->read_privilege){
					$this->load->view('pages/item',self::get_item_details());
				}else{
					$this->load->view('errors/html/error_permission');	
				}


				
			}else{

				#detect search param
				if(!is_null($this->input->get('search'))){
					$this->load->view('pages/search.php',self::search());

				}else{

					#show list
					if(count($this->category_details)>0){
						$this->load->view('pages/list',self::get_categories());	
					}

					#no ID parameter in URI and no details available
					if(is_null($this->input->get('id',true))){
						$this->load->view('pages/index');
					}


					#with ID but no details available
					#check as well the category accessibility
					if(!is_null($this->input->get('id',true))&&!$this->category->is_accessible(@$this->session_privileges[0]->role_id,$this->input->get('id',true)))
					{
						$this->load->view('errors/html/error_permission');

					}
					
					

				}
				
			}

			//tracking with GA
			$this->load->view('pages/track.php',array('USER_ID'=>$this->session->name));

		}
		
		$this->load->view('pages/copyright.php');
		$this->load->view('pages/footer.php');

	}

	


}
