<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth_model','am_');
	}


	public function index(){
		redirect(base_url(),'refresh');
	}

	public function auth_login(){
		if($this->input->is_ajax_request()){

			$email = $this->input->post('lg_email_',true);
			$password = sha1($this->input->post('lg_password_',true));

			$result = $this->am_->check_user($email,$password);

			if(!$result){
				echo json_encode(array('result'=>$result,'msg'=>'Periksa kembali email atau password anda!'));
			}else{

				if($result['status']==0){
					echo json_encode(array('result'=>TRUE,'msg'=>'Akun anda tidak aktif, kontak admin untuk mengaktifkan akun anda'));
				}else{

					$userdata = array(
						SESSION_USER_ID 				=> $result[F_USER_ID],
						SESSION_USER_EMAIL				=> $result[F_USER_EMAIL],
						SESSION_USER_FULLNAME			=> $result[F_USER_FULLNAME],
						SESSION_USER_ROLE				=> $result[F_USER_TYPE],
						SESSION_USER_PROFILE_PICTURE	=> $result[F_USER_IMAGE]
					);
					
					$this->session->set_userdata(SESSION_USER,$userdata);
					echo json_encode(array('result'=>TRUE,'msg'=>''));

				}
			}

			return TRUE;

		}else{
			exit('No direct access allowed');
		}
	}

	public function auth_logout(){
		session_destroy();
		redirect(base_url(),'refresh');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */