<?php

class ping extends CI_Controller{

    function index() {
		print_r($_POST);
		$public_ip 			= $_POST["public_ip"];
		$local_ip 			= $_POST["local_ip"];
		$uuid				= $_POST["uuid"];
		$available_space 	= $_POST["available_space"];
		$free_space 		= $_POST["free_space"];
		$numdevices 		= $_POST["numdevices"];
		$devices			= array();
		
		// Parse all device information		
		for( $i = 0; $i < $numdevices; $i++) {
			$variables = explode(";", $_POST["device".$i]);
			$device = array();
			
			foreach($variables as $variable) {
				$attributes = explode("=", $variable);
				$device[$attributes[0]] = $attributes[1];
			}
			
			array_push($devices, $device);
		}
		

		print_r($devices);

        $this->db->from('backupboxes');
        $this->db->where('box_id', $uuid );
        $boxes = $this->db->get()->result();

		if(count($boxes) > 0) {
			$data = array(
			   'box_id' => $uuid ,
			   'free_space' => $free_space,
			   'public_ip' => $public_ip,
			   'local_ip' => $local_ip,
			   'available_space' => $available_space, 
			   'last_ping' => date("Y-m-d H:i:s")
			);
			
			$this->db->where('box_id', $uuid);
			$this->db->update('backupboxes', $data); 			
		} else {
			$data = array(
			   'box_id' => $uuid,
			   'free_space' => $free_space,
			   'public_ip' => $public_ip,
			   'local_ip' => $local_ip,
			   'available_space' => $available_space, 
			   'last_ping' => date("Y-m-d H:i:s")
			);
			
			$this->db->insert('backupboxes', $data);
			$box_id = $this->db->insert_id();
			
			//'last_successful_backup' => $device["lastbackup"],

			foreach($devices as $device) {
				print_r($device);
				$data = array(
				   'backupbox_id' => $box_id,
				   'backup_size' => $device["size"],
				   'device' => $device["deviceId"],
				   'pending_backup' => $device["pendingbackup"]
				);
				
				$this->db->insert('backupbox_devices', $data);				
			}
			
		}

    }
    
}
