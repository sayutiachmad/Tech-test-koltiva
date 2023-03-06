<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profile extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_profile(){
		$ses = $this->session->userdata(SESSION_USER);
		$this->db->join(TABLE_USER_TYPE .' b', 'b.'.F_USER_TYPE_ID.' = a.'.F_USER_TYPE , 'left');
		$this->db->where('a.'.F_USER_ID, $ses[SESSION_USER_ID]);
		return $this->db->get(TABLE_USER .' a')->row_array();
	}


	public function save_profile($data){

		if (isset($data['pass'])) {
			
			$obj = array(
				F_USER_FULLNAME		=> $data['full_name'],
				F_USER_PASSWORD		=> sha1($data['pass']),
				F_USER_EMPLOYE		=> $data['emp'],
				F_USER_COMPANY		=> $data['com'],
				F_USER_UNIT			=> $data['unit'],
				F_USER_DEPARTMENT	=> $data['dep'],
			);
			$this->db->where(F_USER_ID, $data['id_u']);
			$this->db->update(TABLE_USER, $obj);

		}else{

			$obj = array(
				F_USER_FULLNAME		=> $data['full_name'],
				F_USER_EMPLOYE		=> $data['emp'],
				F_USER_COMPANY		=> $data['com'],
				F_USER_UNIT			=> $data['unit'],
				F_USER_DEPARTMENT	=> $data['dep'],
			);
			$this->db->where(F_USER_ID, $data['id_u']);
			$this->db->update(TABLE_USER, $obj);

		}

		return true;

	}


	public function editFotoPro($data,$file){
		$obj = array(
			F_USER_IMAGE => $file['path'].$file['name'],
			);
		$this->db->where(F_USER_ID, $data['id']);
		$this->db->update(TABLE_USER, $obj);
		return true;
	}

		public function update_profile($id,$data){
			$this->db->where(F_USER_ID, $id);
			return $this->db->update(TABLE_USER, $data);
		}
		
		public function update_password($id, $old, $new){
			$this->db->where(F_USER_ID, $id);
			$this->db->where(F_USER_PASSWORD, sha1($old));
			$old_result = $this->db->get(TABLE_USER,1)->num_rows();

			if($old_result>0){
				$this->db->set(F_USER_PASSWORD, sha1($new));
				$this->db->where(F_USER_ID, $id);
				return $this->db->update(TABLE_USER);
			}

			return VALUE_NOT_EXIST;
		}

		public function update_image($id, $path){
	        $this->db->where(F_USER_ID, $id);
	        return $this->db->update(TABLE_USER, array(F_USER_IMAGE=>$path));
	    }

	    public function select_profile_picture($id){
	    	$this->db->select(F_USER_IMAGE);
	    	$this->db->where(F_USER_ID, $id);
	    	return $this->db->get(TABLE_USER,1)->row_array();
	    }

}

/* End of file Model_profile.php */
/* Location: ./application/models/Model_profile.php */