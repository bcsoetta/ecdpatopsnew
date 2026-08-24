<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Rao extends MY_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('ecd_model');
	}

    public function index(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 7;
		
        $this->page->template('ecd/rao');
		$this->page->view('ecd/rao', $data);
	}

	public function get_detail() {
		$this->load->helper('my_helper');
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$data['data'] = $this->ecd_model->get_detail($params, TRUE);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function change_zone() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$data = $this->ecd_model->change_zone($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
}