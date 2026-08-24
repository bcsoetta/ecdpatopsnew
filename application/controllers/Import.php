<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('import_model');
	}

	private function get_kurs($id = false){
		$kurs = array();
		if (empty($id)) $host = 'https://api-patops.bcsoetta.org/kurs?number=150';
		else $host = 'https://api-patops.bcsoetta.org/kurs?id=1131';
		 // Get cURL resource
		$curl = curl_init();
		 // Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $host
		));
		 // Send the request & save response to $resp
		$resp = curl_exec($curl);
		 // Close request to clear up some resources
		curl_close($curl);
	 
		$data = json_decode($resp);
		if ($data) $kurs = $data->data;

		return $kurs;
	}

	private function change_status_import($header) {
		$this->import_model->change_status($header);
	}

	public function index(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 4;
		$data['office'] = $this->import_model->get_office();
		$data['packages'] = $this->import_model->get_package();	
		$data['categories'] = $this->import_model->get_categories();	
		$data['kurs'] = $this->get_kurs();
		// $data['usd'] = $this->get_kurs(true);
		$this->page->template('impor/index');	
		$this->page->view('impor/index',$data);
	}

	public function search() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] =  $this->import_model->search($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    }

	public function save_item_temp() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$save_data =  $this->import_model->save_item_temp($params);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function update_item_attachment_temp() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		// $save_data =  $this->import_model->save_item_temp($params, );

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function upload_items() {
		// session for ownership files
		$users = $this->session->userdata('users');
		// $prefix = $users['nip'];

		$config['upload_path']          = './assets/custom/temps/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['file_name']            = 'IS_' . time() . '_' . rand(1, 1000) . '.jpg';
        $config['overwrite'] = TRUE;
		
        $this->load->library('upload', $config);
		$data['status'] = false;
		// echo $_FILES['file']['name'];
		$item_key = $this->input->post('item_key');
		// print_r($_POST['file']); exit();
		if ($this->upload->do_upload('file')) {
            $data['status'] = true;
            $uploaded = $this->upload->data();

			// save filename to attachment type
			$save_data =  $this->import_model->save_item_attachment_temp($config['file_name'], $item_key);
        } else {
            $data['error_msg'] = $this->upload->display_errors();
        }

        echo json_encode($data);
	}

	public function upload_import() {
		$config['upload_path']          = './assets/custom/imports/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['file_name']            = 'IS_' . time() . '_' . rand(1, 1000) . '.jpg';
        $config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$data['status'] = false;

		if ($this->upload->do_upload('file')) {
            $data['status'] = true;
            $uploaded = $this->upload->data();
			$header_id = $this->input->post('header_id');
			// save filename to attachment type
			$save_data =  $this->import_model->save_import_attachments($config['file_name'], $header_id);
        } else {
            $data['error_msg'] = $this->upload->display_errors();
        }
	}

	public function update_header() {
		$params = json_decode($this->input->raw_input_stream, TRUE);

		$save_data =  $this->import_model->update_header($params);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function create_new() {
		$params = json_decode($this->input->raw_input_stream, TRUE);

		$save_data =  $this->import_model->create_new($params['params'], $params['keys']);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function get_detail() {
		$this->load->helper('my_helper');
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$header_id = $this->my_decrypt($params['header_id']);
		// echo $header_id; exit();
		$data =  $this->import_model->get_detail($header_id);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function print_form($id) {
		$this->load->helper('my_helper');
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->import_model->get_data_print($header);
		
		$this->change_status_import($header);

		$this->load->view('impor/print_page', $data);
	}

	public function print_form_is($id) {
		$this->load->helper('my_helper');
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->import_model->get_data_print($header);

		$this->change_status_import($header);
		
		$this->load->view('impor/print_page_is', $data);
	}

	public function print_form_return($id) {
		$this->load->helper('my_helper');
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->import_model->get_data_return($header);
		// print_r($data); exit();
		$this->load->view('impor/print_page_return', $data);
	}

	public function delete_item_temp() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$delete_data =  $this->import_model->delete_item_temp($params['params']);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($delete_data));
	}
}