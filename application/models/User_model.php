<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	
	public function check_email($email){
		$this->db->where('email', $email);
		$row = $this->db->get(TABLE_USER, 1)->num_rows;

		if($row > 0){
			return false;
		}

		return true;
	}

	public function select_user_with_type(){
		$this->db->select('a.id_user,a.user_fullname,a.id_user_type,a.status, a.email as user_email, a.image, b.type_name as type');
		$this->db->from(TABLE_USER.' a');
		$this->db->join(TABLE_USER_TYPE.' b', 'a.'.F_USER_TYPE.' = b.'.F_USER_TYPE_ID, 'left');
		$this->db->order_by('a.'.F_USER_EMAIL, 'asc');
		return $this->db->get()->result_array();
	}

	public function insert_user($data){

		$this->db->where(F_USER_EMAIL,$data[F_USER_EMAIL]);
		$count = $this->db->get(TABLE_USER,1)->num_rows();
		if($count>0){
			return 'exist';
		}

		return $this->db->insert(TABLE_USER, $data);
	}

	public function update_user($id,$data){
		$this->db->where(F_USER_ID, $id);
		return $this->db->update(TABLE_USER, $data);
	}

	public function delete_user($id){
		$this->db->where(F_USER_ID, $id);
		return $this->db->delete(TABLE_USER);
	}

	public function update_password_to_default($id){
		$this->db->select(F_USER_USERNAME);
		$this->db->where(F_USER_ID, $id);
		$data = $this->db->get(TABLE_USER,1);

		if($data->num_rows()>0){

			$user = $data->row_array();

			$this->db->where(F_USER_ID, $id);
			return $this->db->update(TABLE_USER, array(F_USER_PASSWORD=>sha1($user[F_USER_USERNAME])));

		}

		return FALSE;
	}

	public function select_user_type(){
		return $this->db->get(TABLE_USER_TYPE)->result_array();
	}

	public function insert_user_type($data){
		return $this->db->insert(TABLE_USER_TYPE, $data);
	}

	public function update_user_type($id,$data){
		$this->db->where(F_USER_TYPE_ID, $id);
		return $this->db->update(TABLE_USER_TYPE, $data);
	}

	public function delete_user_type($id){
		$this->db->where(F_USER_TYPE_ID, $id);
		return $this->db->delete(TABLE_USER_TYPE);
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */