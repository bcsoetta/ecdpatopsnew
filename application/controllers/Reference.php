<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Reference extends MY_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('ecd_model');
	}

    public function index(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 6;
		
        $this->page->template('ecd/reference');
		$this->page->view('ecd/reference', $data);
	}

	public function create() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$save =  $this->ecd_model->save_reference($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save));
    }

	public function get_detail() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] =  $this->ecd_model->get_reference_goods($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    }

	public function search() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] =  $this->ecd_model->get_reference($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    }
}