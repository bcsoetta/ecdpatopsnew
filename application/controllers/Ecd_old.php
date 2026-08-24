<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Ecd extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 0;
		$this->page->template('ecd/index');

		$this->page->view('ecd/index',$data);
	}

}