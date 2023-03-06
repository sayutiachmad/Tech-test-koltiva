<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model','um_');
		
	}

	public function index(){
		$this->layout->set_header("Manage User Account");
		$this->layout->set_title("Manage User Account");
		$this->layout->set_sidebar_collapse(true);
		
		// $this->layout->set_style(base_url('assets/css/profile.css'));
		$this->layout->set_style(base_url('assets/plugins/cropper/cropper.bundle.css'));
		$this->layout->set_script(base_url('assets/plugins/cropper/cropper.bundle.js'));
		$this->layout->set_script(base_url('assets/js/user/user.js'));

		$data = array();
		$data['list_type'] = $this->gm_->select_user_type();

		$this->layout->set_content('user/user');
		$this->layout->render($data);
	}

	public function get_user(){
		if($this->input->is_ajax_request()){

			$result = $this->um_->select_user_with_type();

			echo json_encode(array('data'=>$result));

		}else{
			exit('No direct access allowed');
		}
	}

	public function save_user(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$data = array(
				F_USER_EMAIL	=> $post['ua_email_'],
				F_USER_FULLNAME	=> $post['ua_fullname_'],
				F_USER_PASSWORD	=> sha1($post['ua_password_']),
				F_USER_TYPE		=> $post['ua_user_type_']
			);

			$check_email = $this->um_->check_email($post['ua_email_']);

			if(!$check_email){
				echo json_encode(array('result' => 'exist'));
				return true;
			}

			$result = $this->um_->insert_user($data);

			echo json_encode(array('result'=>$result));

		}else{
			exit('No direct access allowed');
		}
	}

	public function change_user(){

		$post = $this->input->post();

		$status = (isset($post['ua_status_']) ? ($post['ua_status_']=='on' ? '1' : '0') : '0');

		$data = array(
			F_USER_FULLNAME	=> $post['ua_fullname_'],
			F_USER_TYPE		=> $post['ua_user_type_'],
			F_USER_STATUS	=> $status,
		);

		$result = $this->um_->update_user($post['ua_code_'],$data);

		echo json_encode(array('result'=>$result));
	}

	public function remove_user(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->um_->delete_user($post['ua_code_']);

			$msg = '';
			if($result){
				$msg = "Berhasil menghapus data!";
			}else{
				$msg = "Gagal menghapus data!";
			}

			echo json_encode(array('result'=>$result,'msg'=>$msg));
		}else{
			exit('No direct access allowed');
		}
	}

	public function reset_password(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->um_->update_password_to_default($post['ua_code_']);

			$msg = '';
			if($result){
				$msg = "Reset password user berhasil!";
			}else{
				$msg = "Oops! terjadi kesalahan saat melakukan reset password user!";
			}

			echo json_encode(array('result'=>$result,'msg'=>$msg));

		}else{
			exit('No direct access allowed');
		}
	}

	/////////////////////////////
	//halaman user type / role //
	/////////////////////////////

	public function type(){
		$this->layout->set_header("Manage User Type");
		$this->layout->set_title("Manage User Type");
		$this->layout->set_sidebar_collapse(true);

		$this->layout->set_script(base_url('assets/js/user/user_type.js'));

		$data = array();

		$this->layout->set_content('user/user_type');
		$this->layout->render($data);
	}


	public function get_user_type(){
		if($this->input->is_ajax_request()){

			$result = $this->um_->select_user_type();

			echo json_encode(array('data'=>$result));

		}else{
			exit('No direct access allowed');
		}
	}

	public function save_user_type(){
		if($this->input->is_ajax_request()){
			$post = $this->input->post();

			$data = array(
				F_USER_TYPE_NAME	=> $post['ut_name_']
			);

			if($post['ut_code_']>0){
				$result = $this->um_->update_user_type($post['ut_code_'],$data);
			}else{
				$result = $this->um_->insert_user_type($data);
			}

			echo json_encode(array('result'=>$result));
		}else{
			exit('No direct access allowed');
		}
	}

	public function remove_user_type(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->um_->delete_user_type($post['ut_code_']);

			$msg='';
			if($result){
				$msg = "User Type berhasil dihapus";
			}else{
				$msg = "Gagal menghapus User type!";
			}

			echo json_encode(array('result'=>$result,'msg'=>$msg));

		}else{
			exit('No direct access allowed');
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */