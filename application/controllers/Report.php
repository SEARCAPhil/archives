<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
		
		

	}

	public function short(){
		var_dump($this->input->get('id'));
	}





}
