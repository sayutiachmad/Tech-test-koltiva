<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_profile','_model');
	}

	public function index(){
		$this->layout->set_header("Manage profile");
		$this->layout->set_title("Manage profile");
		$this->layout->set_sidebar_collapse(true);

		$this->layout->set_style(base_url('assets/plugins/cropper/cropper.bundle.css'));
		$this->layout->set_script(base_url('assets/plugins/cropper/cropper.bundle.js'));
		
		$this->layout->set_style(base_url('assets/css/profile.css'));
		$this->layout->set_script(base_url('assets/js/profile/profile.js'));

		$data['profile'] = $this->_model->get_profile();

		$this->layout->set_breadcrumb('profile');


		$this->layout->set_content('profile/profile');
		$this->layout->render($data);
	}

	public function change_profile(){
		if ($this->input->is_ajax_request()) {
			
			$post = $this->input->post();

			$data = array(
				F_USER_FULLNAME	=> $post['pr_fullname_']
			);

			$result = $this->_model->update_profile($post['pr_user_code_'],$data);

			echo json_encode(array('result'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function change_password(){

		$post = $this->input->post();

		if($post['pr_new_password_']!=$post['pr_confirm_new_password_']){
			echo json_encode(array('result'=>VALUE_NOT_MATCH));
			return;
		}

		$result = $this->_model->update_password($post['pr_user_code_'],$post['pr_old_password_'],$post['pr_new_password_']);		

		echo json_encode(array('result'=>$result));

	}

	public function save_image(){
	    if($this->input->is_ajax_request()){
	    	$id_user = $this->input->post('code');
	        $filename = 'profile.png';
	        $img = $_POST['imgdata'];
	        $img = str_replace('data:image/png;base64,', '', $img);
	        $img = str_replace(' ', '+', $img);
	        $data = base64_decode($img);

	        $filesize = strlen($data);
	        if($filesize>1000000){
	            echo json_encode(array('result'=>false,'msg'=>'Ukuran file tidak boleh melebihi 1MB'));
	        }else{
	            $path = './assets/images/uploads/profiles/';
	            $filename = date('ymdhis').".png";

	            $result = false;
	            if(file_put_contents($path.$filename,$data)){

	                $result = $this->_model->update_image($id_user,$path.$filename);
	                if($result){
	                	unset($_SESSION[SESSION_USER][SESSION_USER_PROFILE_PICTURE]);
	                	$_SESSION[SESSION_USER][SESSION_USER_PROFILE_PICTURE] = $path.$filename;
	                }
	            }

	            echo json_encode(array('result'=>$result));
	        }



	    }else{
	        show_404();
	    }
	}

	function get_profpic(){
        if($this->input->is_ajax_request()){

        	$id = $this->input->post('code_',true);

            $result = $this->_model->select_profile_picture($id);

            echo json_encode(array('image'=>$result));

        }else{
            show_404();
        }
    }

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */