<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends MX_Controller {

    protected function auth() {
        // this method will called while user have access
		$this->load->library('authbc');
		$data['users'] = $this->authbc->get_users();
		/**
		 * set session for user logged in
		 */
		$this->session->set_userdata($data);
		// Jangan refresh last_user_activity di sini:
		// banyak AJAX memanggil auth() dan akan mencegah idle timeout.
        return $data['users'];
    }
    protected function my_decrypt($data) {
		// $salt = 10099/98/1/2/3;
		return  $data / 100 / 99 / 98/ 1 / 2/ 3;
	}

}