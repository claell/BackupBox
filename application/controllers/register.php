<?php

class register extends CI_Controller {

    function index() {
        $data = null;
        $this->load->helper('form');
        $this->load->view('register',$data);
    }

    function register_user() {
        // Create an instance of the user model
        $this->load->model('user_m');
        $this->load->model('device_manager');

        // Grab the email and password from the form POST
        $userData = array();
        $userData["email"] 				= $this->input->post('email');
        $userData["password"]  			= $this->input->post('password');
        $userData["password_repeat"]  	= $this->input->post('password_repeat');
        $userData["firstname"]  		= $this->input->post('firstname');
        $userData["lastname"]  			= $this->input->post('lastname');
        $userData["unique_id"]  		= $this->input->post('unique_id');
        
        // Does user already exist? 
        if($this->user_m->does_user_exist($userData["email"])) {
			$this->session->set_userdata(array('error'=>"This email address is already registered.")); 
	        redirect('/register');	        	        
        }
        
        // Does passwords match? 
        if($userData["password_repeat"] != $userData["password"]) {
			$this->session->set_userdata(array('error'=>"Passwords do not match")); 
	        redirect('/register');	        
        }
        
        // Check if box exists
        $bb = $this->device_manager->getBackupBoxByUniqueId($userData["unique_id"]);
        
        if($bb == null) {
			$this->session->set_userdata(array('error'=>"There is no matching box with this ID: ".$userData["unique_id"])); 
	        redirect('/register');
        } else 
        if($bb->user_id > 0) {
			$this->session->set_userdata(array('error'=>"This Unique ID is already linked to an existing account.")); 
	        redirect('/register');
        }
        
		$new_user = $this->user_m->create_new_user($userData);
	
	    if ( isset($new_user) && $new_user > 0 ) {
			$this->device_manager->linkBackupBoxUser($new_user, $userData["unique_id"]);
	    }

        
        if( $userData["email"]  && $userData["password"]  && $this->user_m->validate_user($userData["email"] ,$userData["password"] )) {
            // If the user is valid, redirect to the main view
            redirect('/main/show_main');
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
        }

		echo("New user created");
    }

    function showphpinfo() {
        echo phpinfo();
    }


}
