<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom404 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		
		$this->output->set_status_header('404');
		
		$this->layout->set_title("Halaman Tidak Ditemukan");
		$this->layout->set_sidebar_collapse(true);

		$this->layout->set_content('errors/custom/error_404');
		$this->layout->render($data);

	}

}

/* End of file CustomError.php */
/* Location: ./application/controllers/errors/CustomError.php */