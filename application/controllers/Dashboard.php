<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $detect;

	public function __construct(){
		parent::__construct();
		//Do your magic here
	}

	public function index(){
		//judul tab/browser
		$this->layout->set_header("Dashboard");
		$this->layout->set_sidebar_collapse(true);
		
		//set judul halaman
		// $this->layout->set_title("Dashboard");

		//set breadcrumb
		// $this->layout->set_breadcrumb('Dashboard',base_url());

		$this->layout->set_script(base_url('assets/js/dashboard/dashboard.js'));

		$data = array();
		
		
		$this->layout->set_content('dashboard/dashboard');
		$this->layout->render($data);

	}

	

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */