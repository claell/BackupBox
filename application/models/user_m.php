<?php


class user_m extends CI_Model {

    var $details;

	/**
	 * Validates an logs in give user. 
	 *
	 * @param email			Email of user
	 * @param password		Password to validate
	 */
    function validate_user( $email, $password ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('user');
        $this->db->where('email',$email );
        $this->db->where( 'password', sha1($password) );
        $login = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($login) && count($login) == 1 ) {
            // Set the users details into the $details property of this class
            $this->details = $login[0];
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }

        return false;
    }

	/**
	 * Stores user data in a session
	 *
	 */
    function set_session() {
        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        $this->session->set_userdata( array(
                'id'=>$this->details->id,
                'name'=> $this->details->firstName . ' ' . $this->details->lastName,
                'email'=>$this->details->email,
                'isAdmin'=>$this->details->isAdmin,
                'isLoggedIn'=>true
            )
        );
    }

	/**
	 * Creates a new user
	 *
	 * @param userData An array of all needed parameters to create new user
	 */
    function  create_new_user( $userData ) {
      $data['firstName'] 		= $userData['firstname'];
      $data['lastName'] 		= $userData['lastname'];
      $data['unique_id'] 		= $userData['unique_id'];
      $data['email'] 			= $userData['email'];
      $data['password'] 		= sha1($userData['password']);

      $this->db->insert('user',$data);
      return $this->db->insert_id(); 
    }

	/**
	 * Gets a user object from the database
	 *
	 * @param user_id User ID of the object to fetch
	 */
	function getUser( $email ) {
		$this->db->from("user");
		$this->db->where("email", $email); 
		$user = $this->db->get()->result();
		
		if(count($user)) {
			return new User($user->id, $user->email, $user->firstname, $user->lastname, $user->is_admin);	
		}
		
		return null;
	}

	/**
	 * Gets the current logged in User Object
	 *
	 */
	function getCurrentUser( $user_id ) {
		if( $this->session->userdata('isLoggedIn') ) {
			return getUser($this->session->userdata('email'));
		}
	}

	/**
	 * Checks to see wether a user already exists with give email address. Used during registration. 
	 *
	 * @param user_id User ID of the object to fetch
	 */
    function  does_user_exist( $email ) {
        $this->db->from('user');
        $this->db->where('email',$email );
        $result = $this->db->get()->result();
        
        if(count($result) == 1) {
	        return true; 
        }
        
        return false; 
    }

}

/**
 * Container for the user table in the databse. 
 * 
 */
class User {
	
	public $id; 
	public $email; 
	public $firstname; 
	public $lastname; 
	public $is_admin; 
	
	/**
	 * Constructor for a new user
	 *
	 * @param id 			The Database ID of this user
	 * @param email 		E-mail address of the user
	 * @param firstname 	Firstname of user
	 * @param lastname 		Lastname of user
	 * @param is_admin 		Wether user is part of admin or not
	 */
	public function __construct($id, $email, $user_id, $firstname, $lastname, $is_admin) {
		$this->id 			= $id; 
		$this->email 		= $email; 
		$this->firstname 	= $firstname; 
		$this->lastname 	= $lastname; 
		$this->is_admin 	= $is_admin; 
	}
	
}