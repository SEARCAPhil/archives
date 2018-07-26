<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachments extends MY_Controller {

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
    
    private function show_image ($mime_type, $file) {
        header('Content-Type: '.$mime_type);
        $image = file_get_contents($file);
        echo $image;
    }


    private function show_pdf ($mime_type, $file, $filename) {
        header('Content-Type: '.$mime_type);
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Accept-Ranges: bytes');
        $pdf = file_get_contents($file);
        echo $pdf;
    }

	public function load_privileges(){
		$this->session_privileges = ($this->privilege->get_privilege(@$_SESSION['priv']));
	}

	public function show_preview_main () {
		$details = $this->item->get_item_details($this->input->get('id',true));
        $base = $this->category->get_category_details(@$this->session_privileges[0]->role_id,@$details[0]->cat_id); 
        $dir = '../uploads/';
        $dir.= @$base[0]->id.'/'.$this->input->get('id',true).'/'.$details[0]->file_name;
        # fileinfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = @(finfo_file($finfo, $dir));
        # redirect if not logged-in
		self::redirect_if_authenticated();

		#must have a read privilege
		if(@$base[0]->read_privilege==1){
			if(file_exists($dir)&&isset($details[0]->cat_id)&&is_file($dir)){      
                # show images
                if(strpos($mime_type, 'image') !== false) {
                self::show_image ($mime_type, $dir); 
                }

                if(strpos($mime_type, 'pdf') !== false) {
                    self::show_pdf ($mime_type, $dir, $details[0]->file_name); 
                } 

			}else{
				echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
			}

		}else{
			echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
		}
	}


	public function show_preview () {
		#file details
		$details = $this->file->get_details($this->input->get('id',true));
		if(@!isset($details[0]->item_id)) exit;
		# item details
		$item_details = $this->item->get_item_details($details[0]->item_id);
		#upload path
		$base = $this->category->get_category_details(@$this->session_privileges[0]->role_id,@$item_details[0]->cat_id); 
        $dir = '../uploads/';
		$dir.= @$base[0]->id.'/'.$details[0]->item_id.'/'.$details[0]->filename;
		
		# fileinfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = @(finfo_file($finfo, $dir));
        # redirect if not logged-in
		self::redirect_if_authenticated();

		#must have a read privilege
		if(@$base[0]->read_privilege==1){
			if(file_exists($dir)&&isset($item_details[0]->cat_id)&&is_file($dir)){      
                # show images
                if(strpos($mime_type, 'image') !== false) {
                self::show_image ($mime_type, $dir); 
                }

                if(strpos($mime_type, 'pdf') !== false) {
                    self::show_pdf ($mime_type, $dir, $details[0]->filename); 
                } 

			}else{
				echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
			}

		}else{
			echo '<center><h1><br/><br/>Oops!! File not found!</h1><p>The file you are trying to access is currently unavailable. Please try again later.</p></center>';
		}
	}

	public function index(){
       if ($this->input->get('id',true)) {

			if($this->input->get('multiple',true)) {
				return self::show_preview ();
			} else {
				# retrieve main file
				return self::show_preview_main ();
			}
		   
		 
	   }
	   

	}

}
