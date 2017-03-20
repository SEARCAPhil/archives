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

		$this->session_privileges=array();
		$this->session_categories=array();
		$this->session_sub_categories=array();
		$this->session_category_is_accessible=0;


		self::load_privileges();
		self::load_menu();
		self::get_parent_categories();
		self::get_children_categories();
		


	}
	
	/*
	 * Load account privileges
	 *
	 * */

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


	public function get_categories(){
	
		return array('data'=>$this->session_categories,'sub'=>$this->session_sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>self::get_items(),'menu'=>$this->menu);
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

			$this->category_details=$this->category->get_category_details(@$this->session_privileges[0]->role_id,$this->input->get('id',true));

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

		$this->items=array('data'=>array());

		#check category read privilege before viewing
		if(@$this->category_details[0]->read_privilege){
			$this->items=$this->item->get_items($this->input->get('id',true),$this->input->get('page',true));	
		}

		
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
		
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>$this->item,'menu'=>$this->menu);
	}






	/**
	 * Search Items
	 * 
	 * Searach items based on given inputs
	 * @return array()
	 */
	public function search(){

		$this->search_result=$this->item->search($this->input->get('search',true),$this->input->get('page',true));
		return $this->data=array('items'=>$this->search_result,'param'=>$this->input->get());
	}





	/**
	 * Authentication
	 * 
	 * Check accounts from a central storage then check if it is already copied within system accounts
	 * If it is already exist the system then check against the timestamp to check if it is outdated.
	 * The system will create a new profile for an outdated one. To make the data consistent, old profile shall be retain
	 * so that old data indexing the old account will not be change. For instance, If user change their marital status hence change their surname,
	 * Only the new transaction they commited will only be affected. System will still use their old profile in all past transactions
	 * which may include printables(pdf),list, and directories. 
	 * @return array()
	 */

	public function authentication(){

		if ($this->form_validation->run() == FALSE){

			#authenticate
			$auth=$this->auth->login($this->input->post('username'),$this->input->post('password'));


			#check if authentication is successfull
			if(isset($auth[0]->id)&&isset($auth[0]->username)){
				
				#check if LOCAL account exist
				$local_account=$this->auth->account_exists($auth[0]->username);

				if(isset($local_account[0]->uid)){

					#check if LOCAL Profile already exists
					#check for local profile with the same ID and timestamp
					#Timestamp should be check if user profile is already expired
					$local_profile=$this->auth->profile_exists($local_account[0]->id,$auth[0]->date_modified);

					#set session cofiguration for local profile
					if(isset($local_profile[0]->id)){
						
						$token=md5('--boundery--'.(integer)$local_profile[0]->id);
						$hash = password_hash($token, PASSWORD_BCRYPT);


						$_SESSION['id']=$local_profile[0]->id;
						$_SESSION['token']=$hash ;
						$_SESSION['uid']=$local_profile[0]->uid;
						$_SESSION['dept']=$local_profile[0]->department;
						$_SESSION['priv']=$auth[0]->priv;
						$_SESSION['position']=$local_profile[0]->position;
						$_SESSION['name']=$local_profile[0]->profile_name;
						$_SESSION['image']=$local_profile[0]->profile_image;


						#redirect
						header('location:'.base_url());
					}else{

						$local_profile=$this->auth->create($local_account[0]->id,$auth[0]->profile_name,$auth[0]->last_name,$auth[0]->first_name,$auth[0]->profile_image,$auth[0]->dept_name,$auth[0]->dept_alias,$auth[0]->position,$auth[0]->date_modified);

						$token=md5('--boundery--'.(integer)$local_profile);
						$hash = password_hash($token, PASSWORD_BCRYPT);


						$_SESSION['id']=$local_profile;
						$_SESSION['token']=$hash ;
						$_SESSION['uid']=$auth[0]->uid;
						$_SESSION['dept']=$auth[0]->dept_name;
						$_SESSION['priv']=$auth[0]->priv;
						$_SESSION['position']=$auth[0]->position;
						$_SESSION['name']=$auth[0]->profile_name;
						$_SESSION['image']=$auth[0]->profile_image;


						#redirect
						header('location:'.base_url());

						

						#redirect
						header('location:'.base_url().'?login_error=true');
					}


				}else{
					#create a new local account
					$new_local_account=$this->auth->create_account($auth[0]->username,$auth[0]->id);

					
					if(!empty($new_local_account)){

						#create local account profile

						$local_profile=$this->auth->create($new_local_account,$auth[0]->profile_name,$auth[0]->last_name,$auth[0]->first_name,$auth[0]->profile_image,$auth[0]->dept_name,$auth[0]->dept_alias,$auth[0]->position,$auth[0]->date_modified);


						$token=md5('--boundery--'.(integer)$local_profile);
						$hash = password_hash($token, PASSWORD_BCRYPT);


						$_SESSION['id']=$local_profile;
						$_SESSION['token']=$hash ;
						$_SESSION['uid']=$auth[0]->uid;
						$_SESSION['dept']=$auth[0]->dept_name;
						$_SESSION['priv']=$auth[0]->priv;
						$_SESSION['position']=$auth[0]->position;
						$_SESSION['name']=$auth[0]->profile_name;
						$_SESSION['image']=$auth[0]->profile_image;


						#redirect
						header('location:'.base_url());
					}

				}

			}else{

				#invalid credentials
				$this->login_error=1;

				#redirect
				header('location:'.base_url().'?login_error=true');
			}
			
		}
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


		#detect if user is logedout and logout parameter is give in the URI
		if($this->input->get('logout')!=NULL){ $this->auth->logout(); unset($_SESSION);  }



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
			if(!is_null($this->input->get('id',true))&&!(is_null($this->input->get('title',true)))){
				$this->load->view('pages/item',self::get_item_details());
			}else{

				#detect search param
				if(!is_null($this->input->get('search'))){
					$this->load->view('pages/search.php',self::search());

				}else{

					#show list
					if(count(self::get_category_details())>0){
						$this->load->view('pages/list',self::get_categories());	
					}

					#no ID parameter in URI and no details available
					if(count(self::get_category_details())<=0&&is_null($this->input->get('id',true))){
						$this->load->view('pages/index');
					}


					#with ID but no details available
					#check as well the category accessibility
					if(count(self::get_category_details())<=0&&!is_null($this->input->get('id',true))&&!$this->category->is_accessible(@$this->session_privileges[0]->role_id,$this->input->get('id',true)))
					{
						$this->load->view('errors/html/error_permission');

					}
					
					

				}
				
			}

		}
		

		$this->load->view('pages/footer.php');

	}

	


}
