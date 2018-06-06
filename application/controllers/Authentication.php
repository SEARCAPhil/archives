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

class Authentication extends MY_Controller {
    public function __construct () {
        parent::__construct();
		$this->load->database();
		$this->load->model('auth');
        $this->load->model('privilege');
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','session'));
    }

    private function register ($data) {
           
        # get local info
        $local_account = $this->auth->account_exists(@$data->mail);

        # register to DB
        if(!isset($local_account[0]->uid)){
            #create a new local account
            $new_local_account = $this->auth->create_account($data->mail,$data->id);

            if(!empty($new_local_account)){
                # create local account profile
                $local_profile = $this->auth->create($new_local_account,$data->displayName,$data->surname,$data->givenName,'',$data->department,@strtoupper(substr($data->department,0,4)),$data->jobTitle,$data->createdDateTime);
                
                # Session
                $token = md5('--boundery--'.(integer)$local_profile);
                $hash = password_hash($token, PASSWORD_BCRYPT);

                $_SESSION['id'] = $local_profile;
                $_SESSION['token'] = $hash ;
                $_SESSION['uid'] = $new_local_account;
                $_SESSION['dept'] = $data->department;
                $_SESSION['priv'] = null;
                $_SESSION['position'] = $data->jobTitle;
                $_SESSION['name'] = $data->displayName;
                $_SESSION['image'] = '';

                return 1;
                
            } 
        } else{
            $local_profile = $this->auth->profile_exists($local_account[0]->id);
           
            if(isset($local_profile[0]->id)){
                # normal login
                $token = md5('--boundery--'.(integer)$local_profile[0]->id);
                $hash = password_hash($token, PASSWORD_BCRYPT);

                $_SESSION['id'] = $local_profile[0]->id;
                $_SESSION['token'] = $hash ;
                $_SESSION['uid'] = $local_profile[0]->uid;
                $_SESSION['dept'] = $local_profile[0]->department;
                $_SESSION['priv'] = null;
                $_SESSION['position'] = $local_profile[0]->position;
                $_SESSION['name'] = $local_profile[0]->profile_name;
                $_SESSION['image'] = $local_profile[0]->profile_image;
                $_SESSION['name_alias'] = @substr($local_profile[0]->profile_name,0,2);
                return 1;
            } else {
				#invalid credentials
				$this->login_error = 1;
            }
        }
    }


    private function login($local_account) {
        $local_profile = $this->auth->profile_exists($local_account[0]->id);
           
        if(isset($local_profile[0]->id)){
            # normal login
            $token = md5('--boundery--'.(integer)$local_profile[0]->id);
            $hash = password_hash($token, PASSWORD_BCRYPT);

            $_SESSION['id'] = $local_profile[0]->id;
            $_SESSION['token'] = $hash ;
            $_SESSION['uid'] = $local_profile[0]->uid;
            $_SESSION['dept'] = $local_profile[0]->department;
            $_SESSION['priv'] = $local_profile[0]->priv;
            $_SESSION['position'] = $local_profile[0]->position;
            $_SESSION['name'] = $local_profile[0]->profile_name;
            $_SESSION['image'] = $local_profile[0]->profile_image;
            $_SESSION['name_alias'] = @substr($local_profile[0]->profile_name,0,2);
            return 1;
        } else {
            #invalid credentials
            $this->login_error = 1;
            return 0;
        }
    }
    public function o365 () {  

        $data = @json_decode($this->input->post('o365'));
        $is_signed_in = false;

        if (isset($data->mail)) {
            # get local info
            $local_account = $this->auth->account_exists(@$data->mail);
            # register if not present in DB
            if(!isset($local_account[0]->uid)){
                $is_signed_in = self::register($data);
            } else{
                $is_signed_in = self::login($local_account); 
            }
        } 

        if ($is_signed_in) {
            # detect if redirection is present
            if($this->input->post('redirect') && $this->input->post('loc')) {
                header('location:'.$this->input->post('loc')); 
                exit;   
            }

            header('location:'.base_url().'home/');
        }

    }


}