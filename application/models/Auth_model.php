<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	public function check_user($email, $password){

		$this->db->where(F_USER_EMAIL, $email);
		$this->db->where(F_USER_PASSWORD, $password);
		$result = $this->db->get(TABLE_USER, 1);

		if($result->num_rows()>0){
			return $result->row_array();
		}

		return FALSE;

	}
	

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */