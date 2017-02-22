<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest extends CI_Controller {

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
		$this->load->helper('url');
	}

	

	public function series(){
		$data=json_decode($this->input->raw_input_stream);
		

		echo json_encode($this->category->get_children_categories($data->id));
	}

	public function remove(){
		$data= (json_decode($this->input->raw_input_stream));

		echo $this->item->remove($data->id);
	}

	public function file_download(){

		$details=$this->item->get_item_category($this->input->get('id',true));
		$dir='./uploads/';
		
		
	
		$base=$this->category->get_category_details(@$details[0]->cat_id);
		$dir.=@$base[0]->id.'/'.$this->input->get('id',true).'/'.$details[0]->file_name;

		
		
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
		
		

	}

}
