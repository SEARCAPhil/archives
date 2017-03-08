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

class My_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();		
	}

	public function set_maintenance(){
		if(MAINTENANCE) header('location:'.base_url().'maintenance');
	}

	protected function set_maintenance_off(){
		#used in maintenance page to redirect to homepage
		if(!MAINTENANCE) header('location:'.base_url());	
	}

}
