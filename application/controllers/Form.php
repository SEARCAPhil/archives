<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MY_Controller {


	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('category');
		$this->load->model('item');
		$this->load->model('file');
		$this->load->helper(array('form','url'));
		$this->load->library(array('form_validation','session'));
		$this->last_insert_result=null;

		parent::set_maintenance();
	}

	private function get_parent_categories(){

		$this->categories=$this->category->get_parent_categories();
		return $this->data=array('data'=>$this->categories,'param'=>$this->input->get(),'sub'=>self::get_children_categories()['data']);
	}

	private function get_children_categories(){

		$this->sub_categories=$this->category->get_children_categories($this->input->get('id',true));
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>self::get_items());
	}

	private function get_category_details(){

		$this->category_details=$this->category->get_category_details($this->input->get('id',true));
		return $this->data=$this->category_details;
	}

	private function get_items(){

		$this->items=$this->item->get_items($this->input->get('id',true));
		return $this->data=$this->items;
	}

	private function get_item_details(){

		$this->item=$this->item->get_item_details($this->input->get('id',true));
		return $this->data=array('data'=>$this->sub_categories,'param'=>$this->input->get(),'details'=>self::get_category_details(),'items'=>$this->item);
	}

	public function set_item(){
		return $this->data=array('data'=>$this->item->set_item($this->input->post(),$this->session->id));
	}

	public function update_item(){
		return $this->data=array('data'=>$this->item->update_item($this->input->post()));
	}


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
	public function index()
	{

		$this->load->view('pages/header.php');
		$this->load->view('pages/navigation.php',self::get_parent_categories());

		$this->form_validation->set_error_delimiters('<br/><pclass="text-danger">', '</p>');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content_description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
        {		
        		//update
        		if($this->input->get('id')){
        			$this->load->view('forms/item.php',self::get_item_details());
        		}else{
        		//add new

        			$this->load->view('forms/item.php');
        		}
                
        		#$this->load->view('pages/file-upload.php');	
        }
        else
        {
        		
        		if(is_null($this->input->post('id'))||empty($this->input->post('id'))){
        			//create new
            		$this->last_insert_result=self::set_item();

            	}else{
            		//update
            		$this->last_insert_result=self::update_item();
            	}
            	
				#var_dump($this->last_insert_result['data']);

            	/*if($this->last_insert_result>0){
            		$this->load->view('pages/file-upload.php',array('last_id'=>$this->last_insert_result));	
            	}*/
            	setcookie("dms-upload-id",$this->last_insert_result['data'],1,'/');
            	setcookie("dms-upload-cat",$this->input->post('series'),1,'/');

            	setcookie("dms-upload-id",$this->last_insert_result['data'],time()+3600,'/');
            	setcookie("dms-upload-cat",$this->input->post('series'),time()+3600,'/');

            	sleep(1);
            	header('location:'.site_url().'form/upload');
            	
                
        }
		
		$this->load->view('pages/footer.php');
		
	}


	public function upload(){

		$this->load->view('pages/header.php');
		$this->load->view('pages/navigation.php',self::get_parent_categories());
		if(isset($_COOKIE['dms-upload-id'])&&isset($_COOKIE['dms-upload-cat'])){
                $this->load->view('pages/file-upload.php',array('last_id'=>@$_COOKIE['dms-upload-id']));	
         }
		$this->load->view('pages/footer.php');
	}

	

	public function file(){


		if(isset($_COOKIE['dms-upload-id'])){

			if(!isset($_FILES['file'])){
				$error = array('error' => 'invalid file');
                 echo json_encode($error);
                 exit;
			}

			$inf=pathinfo($_FILES['file']['name']);
			
			#config
 			$config['file_name']          = @$_COOKIE['dms-upload-cat'].'.'.@$inf['extension'];
			$config['upload_path']          = './uploads/'.@$_COOKIE['dms-upload-cat'].'/'.@$_COOKIE['dms-upload-id'];
            $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|bmp';
            $config['max_size']             = 10000;
            $config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			
			#create directory
            if(!is_dir('./uploads/'.@$_COOKIE['dms-upload-cat'].'/'.@$_COOKIE['dms-upload-id'])){
            	mkdir('./uploads/'.@$_COOKIE['dms-upload-cat'].'/'.@$_COOKIE['dms-upload-id'],0777,true);
            }

           #upload file

            if (!$this->upload->do_upload('file'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode($error);

                   
            }
            else
            {
            	

            		$is_name_updated=$this->file->change_file_name(@$_COOKIE['dms-upload-id'],$_FILES['file']['name'],$config['file_name']);

            		if($is_name_updated==1){
            			$data = array('upload_data' => $this->upload->data());

	                    echo json_encode(array('data'=>$this->upload->data('file_name')));
	                    #expire the cookie
	                    setcookie("dms-upload-id",'',1);
	                     setcookie("dms-upload-cat",'',1);
	                 }else{
	                 	$error = array('error' => 'Oops Something went wrong. Please check file name and size.');
                    	echo json_encode($error);
	                 }

                    

                     
            }

            //$this->load->view('ajax/file.php');	

         }

	}


	public function success(){

		$this->load->view('pages/header.php');
		$this->load->view('pages/navigation.php',self::get_parent_categories());
		$this->load->view('pages/add-success.php');
		$this->load->view('pages/footer.php');
	}

}
