<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout
{
	protected $CI;
	protected $content = null;
	protected $header = '';
	protected $title = '';
	protected $titlesmall = '';
	protected $breadcrumb = null;
	protected $script = null;
	protected $style = null;
	protected $head_tag = null;
	protected $foot_tag = null;
    protected $sidebar_collapse = false;
    protected $base_navigation = '';
	private $_auth = true;
    private $sess = array();

	private $main_view = "main_view";
	private $login_view = "login/login_alt";

	protected $crumb_count = 0;

	public function __construct()
	{
        $this->CI =& get_instance();
        $this->sess = $this->CI->session->userdata(SESSION_USER);
        $this->_auth = (!empty($this->sess) ? true : false);
	}

	//getter

	public function get_header() {
        return $this->header;
    }
    
    public function get_title() {
        return $this->title;
    }

    public function get_titlesmall(){
    	return $this->titlesmall;
    }

    public function get_breadcrumb() {
        return $this->breadcrumb;
    }

    public function get_style(){
    	return $this->style;
    }

    public function get_script(){
    	return $this->script;
    }

    public function get_head_tag(){
    	return $this->head_tag;
    }

    public function get_foot_tag(){
    	return $this->foot_tag;
    }

    public function get_sidebar_collapse(){
        return $this->sidebar_collapse;
    }


    private function get_user_detail(){
        $user_id = $this->sess[SESSION_USER_ID];
        $role = $this->sess[SESSION_USER_ROLE];

        $result = $this->CI->gm_->select_user_login_detail($user_id, $role);

        return $result;
    }

    private function get_base_navigation(){
        return $this->base_navigation;
    }
    
    //setter
    
    public function set_header($header) {
        
        if(!is_string($header)){
            throw new Exception ("Header have to be String");
        }
        
        $this->header = $header;
    }
    
    
    public function set_title($title) {
        
        if(!is_string($title)){
            throw new Exception ("Title have to be String");
        }
        
        $this->title = $title;
    }
    
    public function set_titlesmall($titlesmall) {
        
        if(!is_string($titlesmall)){
            throw new Exception ("title small have to be String");
        }
        
        $this->titlesmall = $titlesmall;
    }

    public function set_breadcrumb($name,$link=null) {
        if(!is_string($name)){
            throw new Exception ("Breadcrumb have to be String");
        }

        $val = '';

        if(!is_null($link)){
            $val = '<li class="breadcrumb-item"><a href="'.$link.'">'.$name.'</a></li>';
        }else{
            $val = '<li class="breadcrumb-item active">'.$name.'</li>';
        }
        
        $this->breadcrumb = $this->breadcrumb . $val;

        $this->crumb_count = $this->crumb_count+1;
    }

    public function set_style($link){
    	if(!is_string($link)){
            throw new Exception ("style have to be String");
        }

        $val = '';

        $val = '<link href="'.$link.'" rel="stylesheet">';
        $this->style = $this->style . $val;
        
    }

    public function set_script($link){
    	if(!is_string($link)){
            throw new Exception ("script have to be String");
        }

        $val = '';

        $val = '<script src="'.$link.'"></script>';
        $this->script = $this->script . $val;


    }

    public function set_head_tag($head_tag){
    	if(!is_string($head_tag)){
            throw new Exception ("Head Tag have to be String");
        }

        $this->head_tag = $head_tag;
    }

    public function set_foot_tag($foot_tag){
    	if(!is_string($foot_tag)){
            throw new Exception ("Head Tag have to be String");
        }

        $this->foot_tag = $foot_tag;
    }

    public function set_content($content=""){
    	if(!is_string($content)){
            throw new Exception ("Content have to be String");
        }

        $this->content = $content;
    }

    public function set_sidebar_collapse($status){
        if(!is_bool($status)){
            throw new Exception("Only allow boolean type data");
        }

        $this->sidebar_collapse = $status;
    }

    public function set_base_navigation($navigation = ''){
        if(!is_string($navigation)){
            throw new Exception('Base Navigation have to be String');
        }

        $this->base_navigation = $navigation;
    }


    public function render($data = array()){

    	if($this->_auth){
    		if(!$this->CI->input->is_ajax_request()){

                $data['sub_view'] = $this->content;

                $data['head_tag'] = $this->head_tag;
                $data['foot_tag'] = $this->foot_tag;

                $data['style'] = $this->style;
                $data['script'] = $this->script;

                $data['top_title'] = $this->header;
                $data['title'] = $this->title;
                $data['titlesmall'] = $this->titlesmall;
                $data['breadcrumb'] = $this->breadcrumb;

                $data['sidebar_collapse'] = $this->sidebar_collapse;

                $data['sess_data'] = $this->sess;
                $data['user_detail'] = $this->get_user_detail();


    			$this->CI->load->view($this->main_view,$data,false);
    			return;
    		}else{
    			return;
    		}
    	}

        

    	$this->CI->load->view($this->login_view);
    }
	

}

/* End of file Layout.php */
/* Location: ./application/libraries/Layout.php */
