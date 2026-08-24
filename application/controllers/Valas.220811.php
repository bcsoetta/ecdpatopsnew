<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Valas extends MY_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('valas_model');
	}

    public function index(){
        $data['users'] = $this->auth();
		$data['menuActive'] = 2;
		// get country
		$data['countries'] = $this->valas_model->get_countries();
		
        $this->page->template('valas/index');
		$this->page->view('valas/index',$data);
    }

    public function search() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] =  $this->valas_model->search($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    }

	public function delete() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result =  $this->valas_model->delete($params['params']);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function create_new() {
		$params = json_decode($this->input->raw_input_stream, TRUE);

		$save_data =  $this->valas_model->create_new($params);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function print_doc($id) {
		// echo $id;
		// echo $this->my_decrypt($id);
		$this->load->helper('my_helper');
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->valas_model->get_detail($header);
		
		$this->load->view('valas/print_page', $data);
	}
}