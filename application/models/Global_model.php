<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	


	public function select_user_type($id=0){
		if($id>0){
			$this->db->where(F_USER_TYPE_ID, $id);
		}
		$this->db->order_by(F_USER_TYPE_ID, 'asc');
		$result = $this->db->get(TABLE_USER_TYPE);

		if($id>0){
			return $result->row_array();
		}else{
			return $result->result_array();
		}

		return FALSE;
	}



	public function select_user_login_detail($user_id, $role){

		$user_type = $this->select_user_type($role);

		return array();

	}

	public function get_single_data($table,$col="*",$where = null){
		$this->db->select($col);
		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get($table,1)->row_array();
	}

	public function get_select_list($table,$col="*",$order=null,$where=null, $like = null, $limit = null){
		$this->db->select($col);
		if($where != null){
			$this->db->where($where);
		}
		if($like != null){
			$this->db->like($like);
		}
		if($order!=null){
			$this->db->order_by($order);
		}
		if($limit != null){
			if(is_array($limit)){

				$this->db->limit($limit['limit'], $limit['offset']);

			}else{
				$this->db->limit($limit);
			}
		}
		return $this->db->get($table)->result_array();
	}

	

}

/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */