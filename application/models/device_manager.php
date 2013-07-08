<?php

/**
 * Manager that deals with devices associated with eacb user. 
 * 
 * 
 */
class device_manager extends CI_Model {

    var $details;

   /**
    * Get all devices linked to users account. 
    * 
    * @user_id User to collect devices from. 
    */
	public function getDeviceList( $id ) {
		$devices = array();
		
        $this->db->from('backupbox_devices');
        $this->db->join('backupboxes', 'backupbox_devices.backupbox_id = backupboxes.id', 'INNER');
        $this->db->where('backupboxes.id', $id );
        $db_devices = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($db_devices) && count($db_devices) > 0 ) {
			foreach($db_devices as $db_d) {
				$dev = $this->getDevice($db_d->device); 
				$dev->id = $db_d->id;
				$dev->last_successful_backup = $db_d->last_successful_backup;
				$dev->backup_size = $db_d->backup_size;
				$dev->device_size = $db_d->device_size;
				$dev->pending_backup = $db_d->pending_backup;
				array_push($devices, $dev);
			}

            return $devices;
        }

        return null;
		
	}
	
   /**
    * Get a device object by its UDEV device ID
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function getDevice( $device_id ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('devices');
        $this->db->where('id', $device_id );
        $device = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($device) && count($device) > 0 ) {
            $d = new Device($device[0]->id,$device[0]->name,$this->getVendor($device[0]->vendor), $device[0]->type);
            return $d;
        }

        return null;
    }

   /**
    * Get a device object by its UDEV device ID
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function getVendor( $vendor_id ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('vendors');
        $this->db->where('id', $vendor_id );
        $vendor = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($vendor) && count($vendor) > 0 ) {
            $v = new Vendor($vendor[0]->id,$vendor[0]->name);
            return $v;
        }

        return null;
    }

   /**
    * Get a device object by its UDEV device ID
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function getBackupBoxByUniqueId( $box_id ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('backupboxes');
        $this->db->where('box_id', $box_id );
        $backupbox = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($backupbox) && count($backupbox) > 0 ) {
            $b = new BackupBox($backupbox[0]->id);
			$b->box_id = $backupbox[0]->box_id;
			$b->user_id = $backupbox[0]->user_id;
			$b->last_ping = $backupbox[0]->last_ping;
			$b->free_space = $backupbox[0]->free_space;
			$b->available_space = $backupbox[0]->available_space;
			$b->local_ip = $backupbox[0]->local_ip;
			$b->public_ip = $backupbox[0]->public_ip;
            return $b;
        }

        return null;
    }

   /**
    * Get a device object by its UDEV device ID
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function getBackupBox( $user_id ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('backupboxes');
        $this->db->where('user_id', $user_id );
        $backupbox = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($backupbox) && count($backupbox) > 0 ) {
            $b = new BackupBox($backupbox[0]->id);
			$b->box_id = $backupbox[0]->box_id;
			$b->user_id = $backupbox[0]->user_id;
			$b->last_ping = $backupbox[0]->last_ping;
			$b->free_space = $backupbox[0]->free_space;
			$b->available_space = $backupbox[0]->available_space;
			$b->local_ip = $backupbox[0]->local_ip;
			$b->public_ip = $backupbox[0]->public_ip;
            return $b;
        }

        return null;
    }

   /**
    * Get a device object by its UDEV device ID
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function getBackupBoxById( $id ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('backupboxes');
        $this->db->where('id', $id );
        $backupbox = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($backupbox) && count($backupbox) > 0 ) {
            $b = new BackupBox($backupbox[0]->id);
			$b->box_id = $backupbox[0]->box_id;
			$b->user_id = $backupbox[0]->user_id;
			$b->last_ping = $backupbox[0]->last_ping;
			$b->free_space = $backupbox[0]->free_space;
			$b->available_space = $backupbox[0]->available_space;
			$b->local_ip = $backupbox[0]->local_ip;
			$b->public_ip = $backupbox[0]->public_ip;
            return $b;
        }

        return null;
    }

   /**
    * Lets admin user view all current boxes.
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function getAllBackupBoxes( ) {
		$boxes = array();
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('backupboxes');
        $backupbox = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($backupbox) && count($backupbox) > 0 ) {
			foreach($backupbox as $b) {
				array_push($boxes, $this->getBackupBox($b->user_id));
			}
			return $boxes;
        }

        return null;
    }

   /**
    * Get a device object by its UDEV device ID
    * 
    * @device_id Device ID collected by the UDEV rule
    */
    public function linkBackupBoxUser( $user_id, $box_id ) {
    	$data = array("user_id"=>$user_id);
        $this->db->where("box_id", $box_id);
        $this->db->update('backupboxes',$data);
    }

}


/**
 * Container for the device table in the databse. 
 * 
 */
class Device {
	
	public $id; 
	public $name; 
	public $vendor;
	public $type;
	public $backup_size; 
	public $last_successful_backup;
	public $pending_backup;
	public $device_size;
	public $device_used_space;
	public $icons = array(0 => "unknown", 1 => "smartphone", 2 => "camera", 3 => "usb", 4 => "computer");	
		
	public function __construct($id, $name, $vendor, $type) {
		$this->id = $id; 
		$this->name = $name; 
		$this->vendor = $vendor;
		$this->type = $type;
	}
	
}

/**
 * Container for the vendor table in the databse. 
 * 
 */
class Vendor {
	
	public $id; 
	public $name; 
	
	public function __construct($id, $name) {
		$this->id = $id; 
		$this->name = $name; 
	}
	
}

/**
 * Container for the vendor table in the databse. 
 * 
 */
class BackupBox {
	
	public $id; 
	public $box_id; 
	public $user_id; 
	public $last_ping; 
	public $free_space; 
	public $available_space; 
	public $local_ip; 
	public $public_ip; 
	
	public function __construct($id) {
		$this->id = $id; 
	}
}