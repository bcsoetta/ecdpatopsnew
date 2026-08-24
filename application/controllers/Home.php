<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MX_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('authbc');
		$this->load->model('home_model');
	}

	public function index(){
		// this method will called while user have access
		$this->load->library('authbc');
		$data['users'] = $this->authbc->get_users();
		/**
		 * set session for user logged in
		 */
		$this->session->set_userdata($data);
		
		$this->page->template('home/index');	
		$this->page->view();
	}

}