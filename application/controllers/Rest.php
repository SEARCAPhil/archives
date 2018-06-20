<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest extends MY_Controller {

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
		$this->load->model(array('privilege','category','item','file'));
		$this->load->helper('url');
		$this->load->library(array('form_validation','session'));

		parent::set_maintenance();
		self::load_privileges();
	}

		/*
	 * Load account privileges
	 *
	 * */
	private function redirect_if_authenticated () {
		# redirects user to login page if unauthenticated
		if(!$this->session->token || !$this->session->id) {
			$loc = base_url(uri_string()).'?'.$_SERVER['QUERY_STRING'];
			header('location:'.base_url().'?redirect=true&loc='.$loc);
		}
	}

	public function load_privileges(){
		$this->session_privileges = ($this->privilege->get_privilege(@$_SESSION['priv']));
	}

	public function load_menu(){
		
		$this->menu=array(
			'category'=>1,
			'permission'=>$this->privilege->is_allowed_to_grant_role(),
			'materials'=>$this->privilege->is_allowed_to_write_materials()

		);


	}


	public function series(){
		$data=json_decode($this->input->raw_input_stream);
		echo json_encode($this->category->get_children_categories(@$this->session_privileges[0]->role_id,$data->id));
	}

	public function remove(){
		$data= (json_decode($this->input->raw_input_stream));
		echo $this->item->remove($data->id);
	}

	public function remove_attachment(){
		$data= (json_decode($this->input->raw_input_stream));
		echo $this->file->remove($data->id);
	}

	public function file_download_main(){
		self::redirect_if_authenticated();
		$details=$this->item->get_item_details($this->input->get('id',true));
		$dir='./uploads/';
		
	
		$base=$this->category->get_category_details(@$this->session_privileges[0]->role_id,@$details[0]->cat_id);
		$dir.=@$base[0]->id.'/'.$this->input->get('id',true).'/'.$details[0]->file_name;

		#must be able to have read privilege
		if(@$base[0]->read_privilege==1){
			if(file_exists($dir)&&isset($details[0]->cat_id)&&is_file($dir)){

			$returnFile=header("Content-Description: File Transfer"); 
			$returnFile+=header("Content-Type: application/octet-stream"); 
			$returnFile+=header("Content-Disposition: attachment; filename=".$details[0]->file_name);
			$returnFile+=ob_clean();
			$returnFile+=flush();
			$returnFile+=readfile($dir);
			
			echo $returnFile;

			}else{
				echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
			}

		}else{
			echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
		}
	}


	public function file_download_multiple(){
		self::redirect_if_authenticated();

		$details = $this->file->get_details($this->input->get('id',true));
		if(@!isset($details[0]->item_id)) exit;

		$item_details=$this->item->get_item_details($details[0]->item_id);
		$dir='./uploads/';
		
	
		$base=$this->category->get_category_details(@$this->session_privileges[0]->role_id,@$item_details[0]->cat_id);
		$dir.=@$base[0]->id.'/'.$details[0]->item_id.'/'.$details[0]->filename;

		#must be able to have read privilege
		if(@$base[0]->read_privilege==1){
			if(file_exists($dir)&&isset($item_details[0]->cat_id)&&is_file($dir)){

			$returnFile=header("Content-Description: File Transfer"); 
			$returnFile+=header("Content-Type: application/octet-stream"); 
			$returnFile+=header("Content-Disposition: attachment; filename=".$details[0]->filename);
			$returnFile+=ob_clean();
			$returnFile+=flush();
			$returnFile+=readfile($dir);
			
			echo $returnFile;

			}else{
				echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
			}

		}else{
			echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
		}
	}

	public function file_download(){
		
		if (!$this->input->get('multiple',true)) {
			self::file_download_main();
		} else {
			self::file_download_multiple();
		}

		
	}

}
