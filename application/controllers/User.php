<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function logout()
	{
		$this->load->model('import_model');
		$this->import_model->delete_header_draft(TRUE);
		$this->load->library('authbc');
		$this->authbc->logout();
	}
}