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

class Maintenance extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));

		//redirect to home page if not in maintenance
		parent::set_maintenance_off();

	}

	public function index(){

		$this->load->view('pages/maintenance');
	}
	
	


}
