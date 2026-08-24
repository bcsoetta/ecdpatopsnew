<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Departure extends MY_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('departure_model');
		$this->load->model('valas_model');
	}


    public function index(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 3;
		// get country
		$data['countries'] = $this->valas_model->get_countries();
		$data['currencies'] = $this->valas_model->get_currencies();
		
        $this->page->template('valas/departure');
		$this->page->view('valas/departure',$data);
	}

	public function search() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] =  $this->departure_model->search($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    }

	public function create_new() {
		$params = json_decode($this->input->raw_input_stream, TRUE);

		$save_result =  $this->departure_model->create_new($params);
		if ($save_result['status'] == TRUE) {
			$output = $save_result['header_id'];
		} else {
			$output = FALSE;
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}

	public function upload_file() {
		$config['upload_path']          = './assets/custom/departure/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 2000;
		$config['file_name']            = 'DEPARTURE_' . time() . '_' . rand(1, 1000) . '.jpg';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$data['status'] = false;

		if ($this->upload->do_upload('file')) {
			$data['status'] = true;
			$this->upload->data();
			$header_id = $this->input->post('header_id');
			$remark = $this->input->post('remark');
			// save filename to attachment type
			$this->departure_model->save_departure_attachments($config['file_name'], $header_id, $remark);
		} else {
			$data['error_msg'] = $this->upload->display_errors();
		}
	}

	public function delete() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result =  $this->departure_model->delete($params['params']);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function print_arrival($id) {
		// echo $id;
		// echo $this->my_decrypt($id);
		$this->load->helper('my_helper');
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->get_data($header);
		
		$this->load->view('valas/print_dep_arrival', $data);
	}

	public function print_departure($id) {
		$this->load->helper('my_helper');
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->departure_model->get_departure($header);
		
		$this->load->view('valas/print_departure', $data);
	}

	public function get_detail()
	{
		$this->load->helper('my_helper');
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$header_id = $this->my_decrypt($params['header_id']);
		$data =  $this->get_data($header_id);
		$attachments = $this->departure_model->get_attachments($header_id);
		$data['attachments'] = $attachments;
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	private function get_data($header_id)
	{
		$data =  $this->departure_model->get_detail($header_id);
		$data['personal']->id_address = $this->construct_address(
			$data['personal']->id_street,
			$data['personal']->id_rt,
			$data['personal']->id_rw,
			$data['personal']->id_country,
			$data['personal']->id_province,
			$data['personal']->id_city,
			$data['personal']->id_kecamatan,
			$data['personal']->id_kelurahan,
			$data['personal']->id_postal_code
		);
		$data['personal']->local_address = $this->construct_address(
			$data['personal']->local_street,
			$data['personal']->local_rt,
			$data['personal']->local_rw,
			'',
			$data['personal']->local_province,
			$data['personal']->local_city,
			$data['personal']->local_kecamatan,
			$data['personal']->local_kelurahan,
			$data['personal']->local_postal_code
		);
		if ($data['others'] != []) {
			$data['others']->address = $this->construct_address(
				$data['others']->street,
				$data['others']->rt,
				$data['others']->rw,
				$data['others']->country,
				$data['others']->province,
				$data['others']->city,
				$data['others']->kecamatan,
				$data['others']->kelurahan,
				$data['others']->postal_code
			);
		};
		if ($data['corp'] != []) {
			$data['corp']->address = $this->construct_address(
				$data['corp']->street,
				$data['corp']->rt,
				$data['corp']->rw,
				$data['corp']->country,
				$data['corp']->province,
				$data['corp']->city,
				$data['corp']->kecamatan,
				$data['corp']->kelurahan,
				$data['corp']->postal_code
			);
		}
		return $data;
	}

	private function construct_address($street, $rt, $rw, $country, $province, $city, $kecamatan, $kelurahan, $postal_code)
	{
		$address = $street;
		$address = ($rt != '') ? "$address RT $rt" : $address;
		$address = ($rw != '') ? "$address RW ${rw}" : $address;
		$address = ($kelurahan != '') ? "$address ${kelurahan}," : $address;
		$address = ($kecamatan != '') ? "$address ${kecamatan}," : $address;
		$address = ($city != '') ? "$address ${city}," : $address;
		$address = ($province != '') ? "$address ${province}," : $address;
		$address = ($country != '') ? "$address ${country}" : $address;
		$address = ($postal_code != '') ? "$address ${postal_code}" : $address;
		return $address;
	}
}