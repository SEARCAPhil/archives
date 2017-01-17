<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->helper(array('form','url','pager'));
		$this->load->library(array('form_validation','session'));
	}

	public function get_parent_categories(){

		$this->categories=$this->category->get_parent_categories();
		return $this->data=array('data'=>$this->categories,'param'=>$this->input->get(),'sub'=>self::get_children_categories()['data']);
	}

	public function get_children_categories(){

		$this->sub_categories=$this->category->get_children_categories($this->input->get('id',true));
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>self::get_items());
	}

	public function get_category_details(){

		$this->category_details=$this->category->get_category_details($this->input->get('id',true));
		return $this->data=$this->category_details;
	}

	public function get_items(){

		$this->items=$this->item->get_items($this->input->get('id',true),$this->input->get('page',true));
		return $this->data=$this->items;
	}

	public function get_item_details(){

		$this->item=$this->item->get_item_details($this->input->get('id',true));
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>$this->item);
	}

	public function search(){

		$this->search_result=$this->item->search($this->input->get('search',true),$this->input->get('page',true));
		return $this->data=array('items'=>$this->search_result,'param'=>$this->input->get());
	}

	public function index()
	{	
		
		if($this->input->get('logout')!=NULL){ $this->auth->logout(); unset($_SESSION);  }

		$this->load->view('pages/header.php');
		
		if($this->session->id==NULL){
			//sign-in
			$this->load->view('forms/login.php',array('data'=>$this->input->get('login_error')));


		}else{
			//load pages
			$this->load->view('pages/navigation.php',self::get_parent_categories());
			
			 #expire the cookie
	        setcookie("dms-upload-id",'',1);
	        setcookie("dms-upload-cat",'',1);

			#id and title must be present to view the item
			if(!is_null($this->input->get('id',true))&&!(is_null($this->input->get('title',true)))){
				$this->load->view('pages/item.php',self::get_item_details());
			}else{

				#detect search param
				if(!is_null($this->input->get('search'))){
					$this->load->view('pages/search.php',self::search());

				}else{
					$this->load->view('pages/list.php',self::get_children_categories());
				}
				
			}

		}
		

		$this->load->view('pages/footer.php');

	}

	public function authentication(){

		if ($this->form_validation->run() == FALSE){
				$auth=$this->auth->login($this->input->post('username'),$this->input->post('password'));

				if(isset($auth[0]->id)){
					$local_profile=$this->auth->profile_exists($auth[0]->id,$auth[0]->date_modified);
					if(isset($local_profile[0]->id)){
						//has updated local account
						$token=md5('--boundery--'.(integer)$local_profile[0]->id);
						$hash = password_hash($token, PASSWORD_BCRYPT);

						$_SESSION['id']=$local_profile[0]->id;
						$_SESSION['token']=$hash ;
						$_SESSION['uid']=$local_profile[0]->id;
						$_SESSION['dept']=$auth[0]->dept_id;
						$_SESSION['priv']=$auth[0]->priv;
						$_SESSION['position']=$local_profile[0]->position;
						$_SESSION['unit']=$auth[0]->dept_name;
						$_SESSION['name']=$local_profile[0]->profile_name;
						$_SESSION['image']=$local_profile[0]->profile_image;

						header('location:'.base_url());


					}else{
						//create a local account
						$local_account=$this->auth->create($auth[0]->id,$auth[0]->profile_name,$auth[0]->last_name,$auth[0]->first_name,$auth[0]->profile_image,$auth[0]->dept_name,$auth[0]->dept_alias,$auth[0]->position,$auth[0]->date_modified);
						if(!empty($local_account)){
							$token=md5('--boundery--'.(integer)$local_account);
							$hash = password_hash($token, PASSWORD_BCRYPT);
							$_SESSION['id']=$local_account;
							$_SESSION['token']=$hash ;
							$_SESSION['uid']=$local_profile[0]->id;
							$_SESSION['dept']=$auth[0]->dept_id;
							$_SESSION['priv']=$auth[0]->priv;
							$_SESSION['position']=$local_profile[0]->position;
							$_SESSION['unit']=$auth[0]->dept_name;
							$_SESSION['name']=$local_profile[0]->profile_name;
							$_SESSION['image']=$local_profile[0]->profile_image;
						}
					}

					header('location:'.base_url());
				}else{
					$this->login_error=1;
					header('location:'.base_url().'?login_error=true');
				}
				
		}
	}



}
