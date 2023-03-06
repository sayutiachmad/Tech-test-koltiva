<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

	/**
     * 404 Error Handler
     *
     * @uses    CI_Exceptions::show_error()
     *
     * @param   string  $page       Page URI
     * @param   bool    $log_error  Whether to log the error
     * @return  void
     */
    public function show_404($page = '', $log_error = TRUE)
    {
        if (is_cli())
        {
            // For CLI
            $heading = 'Not Found';
            $message = 'The controller/method pair you requested was not found.';
            echo $this->show_error($heading, $message, 'error_404', 404);
        }
        else
        {
            // For view
            $CI = &get_instance();
            $CI->output->set_status_header('404');

            $CI->layout->set_title("Halaman Tidak Ditemukan");
			$CI->layout->set_sidebar_collapse(false);

			$CI->layout->set_content('errors/custom/error_404');
			$CI->layout->render(array());

            echo $CI->output->get_output();
        }

        // By default we log this, but allow a dev to skip it
        if ($log_error)
        {
            log_message('error', $heading.': '.$page);
        }

        exit(4); // EXIT_UNKNOWN_FILE
    }

}

/* End of file MY_Exceptions.php */
/* Location: ./application/core/MY_Exceptions.php */