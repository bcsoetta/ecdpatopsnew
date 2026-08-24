<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Ecd extends MY_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('ecd_model');
	}

    public function index(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 5;
		
        $this->page->template('ecd/index');
		$this->page->view('ecd/index', $data);
	}

	public function search() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] =  $this->ecd_model->search($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    }

	public function get_detail() {
		$this->load->helper('my_helper');
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$data['data'] = $this->ecd_model->get_detail($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
}