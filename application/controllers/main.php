<?php

class main extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }

  /**
   * This is the controller method that drives the application.
   * After a user logs in, show_main() is called and the main
   * application screen is set up.
   */
  function show_main() {
	$this->load->model('device_manager');
	$this->load->model('user_m');
    

    // Get some data from the user's session
    $user_id = $this->session->userdata('id');
    $is_admin = $this->session->userdata('isAdmin');
    $team_id = $this->session->userdata('teamId');
	$data['backupbox'] = $this->device_manager->getBackupBox($user_id);
	$data['devices'] = $this->device_manager->getDeviceList($data["backupbox"]->id);


    $data['is_admin'] = $is_admin;
    $data['email'] = $this->session->userdata('email');
    $data['name'] = $this->session->userdata('name');
    $data['avatar'] = $this->session->userdata('avatar');
    $data['tagline'] = $this->session->userdata('tagline');
    $data['teamId'] = $this->session->userdata('teamId');

	if($is_admin) {
		$data["all_boxes"] = $this->device_manager->getAllBackupBoxes();
	}

    $this->load->view('main',$data);
  }

  function devices($backupbox) {
	  $this->load->model('device_manager');
	  
	  $data["backupbox"] 	= $this->device_manager->getBackupBoxById($backupbox);
	  $data["devicelist"] 	= $this->device_manager->getDeviceList($backupbox);
	  $this->load->view('devices',$data);
  }

  function update_tagline() {
    $new_tagline = $this->input->post('message');
    $user_id = $this->session->userdata('id');

    if( isset($new_tagline) && $new_tagline != "" ) {
      $this->load->model('user_m');
      $saved = $this->user_m->update_tagline($user_id, $new_tagline);
    }

    if ( isset($saved) && $saved ) {
      $this->session->set_userdata(array('tagline'=>$new_tagline));
      echo "success";
    }
  }

}
