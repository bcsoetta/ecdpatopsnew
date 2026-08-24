<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Spmb extends MY_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('authbc');
		$this->load->model('spmb_model');
	}

	public function index(){
		$data['users'] = $this->auth();
		
		$this->page->template('spmb/index');
		/**
		 * set active menu
		 */
		$data['menuActive'] = 1;
		
		$data['countries'] = $this->spmb_model->get_countries();	
		$data['categories'] = $this->spmb_model->get_categories();
		$data['qty_type'] = $this->spmb_model->get_quantity_type();
		$this->page->view('spmb/index',$data);

	}
	public function max_spmb(){
		$max = $this->spmb_model->get_max_spmb();
		// $max = $max->id_dokumen+1 ;
		return $max;
    }

	// create new spmb
	public function new_spmb(){
        $date = date("Y-m-d");
        $dateinsert = date("Y-m-d H:i:s");
		$spmb_pab_depart = $this->input->POST("spmb_pab_depart");
		$spmb_pab_arrival = $this->input->POST("spmb_pab_arrival");
		$spmb_flight_numb = $this->input->POST("spmb_flight_numb");
		$spmb_pass_numb = $this->input->POST("spmb_pass_numb");
		$spmb_name = $this->input->POST("spmb_name");
		$spmb_datebirth = $this->input->POST("spmb_datebirth");
		$spmb_occupation = $this->input->POST("spmb_occupation");
		$spmb_npwp = $this->input->POST("spmb_npwp");
		$spmb_reason = $this->input->POST("spmb_reason");
		$spmb_phone = $this->input->POST("spmb_phone");
		$spmb_email = $this->input->POST("spmb_email");
		$spmb_nationality = $this->input->POST("spmb_nationality");
		$spmb_airport_dep = $this->input->POST("spmb_airport_dep");
		$spmb_airport_arrival = $this->input->POST("spmb_airport_arrival");
		$spmb_address =$this->input->POST("spmb_address");
		$max = $this->max_spmb();
		// $maxdok = $max.'/KB/T3U/SH/2021';
		$maxdok  = $max . '/KB/T3U/SH/' . date('Y');

		$users = $this->session->userdata('users');
		// key header
		$key_header = $this->input->POST("key_header");

		$spmb  = array(
							'nama' 			 => $spmb_name,
							'tgl_lahir'		 => $spmb_datebirth,
							'nomor_paspor' 	 => $spmb_pass_numb,
							'nomor_telepon'	 => $spmb_phone,
							'nik_npwp_nib' 	 => $spmb_npwp,
							'reason' 	 => $spmb_reason,
							'kebangsaan' 	 => $spmb_nationality,
							'alamat' 	 => $spmb_address,
							'occupation' 	 => $spmb_occupation,
							'email'			 => $spmb_email,
							'created_at' 	 => $dateinsert,
							'kantor_pabean_keberangkatan' => $spmb_pab_depart,
							'kantor_pabean_kedatangan' =>  $spmb_pab_arrival,
							'bandara_keberangkatan' => $spmb_airport_dep ,
							'bandara_kedatangan' 	=> $spmb_airport_arrival,
							'nomor_penerbangan' 	=> $spmb_flight_numb,
							'id_dokumen'	=> $max,
							'nomor_dokumen'	=> $maxdok,
							'tanggal_dokumen' => $date,
							'status'	=> '1',
							'input_by' => $users['name'] .'-'. $users['nip']
							// 'input_by' => $this->session->userdata('name'),
						);
		/**
		 * set to transaction query
		 */
		$trans_query = $this->spmb_model->create_new_spmb($spmb, $key_header);
		$return['status'] = 'error';
		
		if ($trans_query) {
			$return['status'] = 'ok';
		}
		// var_dump($trans_query); exit();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($return));
    }

	public function new_docs_item() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$save_data =  $this->spmb_model->save_docs_temp($params);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

    public function new_spmb_item(){
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$save_data =  $this->spmb_model->save_item_temp($params);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
    }

    public function spmb_goods_verification(){
    	$date = date("Y-m-d");
        $dateinsert = date("Y-m-d H:i:s");
    	$spmb_item_id 		= $this->input->POST("spmb_item_id");
		$spmb_item_status = $this->input->post('item_status');
		$spmb_item_note = $this->input->post('spmb_verified_note');
		$spmb_item_verified = 0;
		
		if ($this->input->POST("spmb_item_verified")) {
			$spmb_item_verified = $this->input->POST("spmb_item_verified");
		}
    	
		$update = $this->spmb_model->update_spmb_item($spmb_item_id, $spmb_item_status, $spmb_item_verified, $spmb_item_note);
		if ($update) {
			echo json_encode(1);
		}
        // $spmb_verified_note = $this->input->POST("spmb_verified_note");
		/*
        $barang_detail = $this->spmb_model->get_spmb_barang($spmb_item_id);

        $sisa = $barang_detail->jumlah_satuan  -  $spmb_item_verified ;


		$data_sisa = array(
		            	'status' => $sisa,
		        	);

        $is_data_sisa          = $this->spmb_model->Updating('spmb_barang', $data_sisa, 'id', $spmb_item_id);
        $sisa_total = $this->spmb_model->get_spmb_sisa($barang_detail->nomor_dokumen);
        $sisa_total = $sisa_total->sisa ;
        
        if ($sisa_total == 0) {
        	$data_header = array(
				            	'status' => 3,
				        	);
		    $is_data_sisa          = $this->spmb_model->Updating('spmb_header', $data_header, 'nomor_dokumen', $barang_detail->nomor_dokumen);
        }
        
        else{
			$data_header = array(
		            	'status' => 2,
		        	);
        	$is_data_sisa          = $this->spmb_model->Updating('spmb_header', $data_header, 'nomor_dokumen', $barang_detail->nomor_dokumen);
        }
		
		if ($is_data_sisa) {
			echo json_encode(1);
		}
		else{
			var_dump($is_data_sisa);
		}
		*/
    }
    

    public function spmb_list(){
		$search = '';

		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
		}
		// $search  = $_POST['search']['value'];
		// echo $search; exit();
		$start = $_POST['start'];
		$length = $_POST['length'];

        $list = $this->spmb_model->get_spmb($search, $start, $length);
        // $data = array();
        // foreach ($list as $listdata) {
        //     $row    = array();
        //     $row[]  = $listdata->id_bahasa_users;
        //     $row[]  = $listdata->bahasa;
        //     $row[]  = $listdata->lisan;
        //     $row[]  = $listdata->tulisan;
        //     $row[]  = $listdata->utama;
        //     $data[] = $row;
        // }
        $output = array(
            'data' => $list['data'],
			'recordsTotal' => $list['recordsTotal'],
			'recordsFiltered' => $list['recordsTotal']
        );

        echo json_encode($output);
    }

    public function spmb_item_list($id){
        $list = $this->spmb_model->get_spmb_list_item($id);
        // $data = array();
        // foreach ($list as $listdata) {
        //     $row    = array();
        //     $row[]  = $listdata->id_bahasa_users;
        //     $row[]  = $listdata->bahasa;
        //     $row[]  = $listdata->lisan;
        //     $row[]  = $listdata->tulisan;
        //     $row[]  = $listdata->utama;
        //     $data[] = $row;
        // }
        $output = array(
            "data" => $list
        );
        echo json_encode($output);
    }
    public function spmb_item_form(){
        $str  = $this->input->POST('str');
        $list = $this->spmb_model->get_spmb_item_form($str);
        $data = array();
        $no = 1;
        foreach ($list as $listdata) {
            $row    = array();
            $row[]  = $no++.'.';
            $row[]  = $listdata->nama_barang;
            $row[]  = $listdata->jumlah_satuan;
            $row[]  = $listdata->jenis_kemasan;
            $row[]  = $listdata->nilai_pabean;
            $row[]  = $listdata->bruto;
            $row[]  = $listdata->attachment;
            $data[] = $row;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

	/**
	 * upload document
	 */
	public function upload_document() {
		$config['upload_path']          = './assets/custom/docs/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        // $config['max_size']             = 500;
        $config['file_name']            = time() . '.jpg';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        $data['status'] = false;

        if ($this->upload->do_upload('file')) {
            $data['status'] = true;
			/**
			 * set session file for multiple users input
			 */
			$users = $this->session->userdata('users');
			$session[$users['name']] = array('file_id' => $config['file_name']);
			// $session = array('file_id' => $config['file_name']);
			$this->session->set_userdata($session);
			// $data['file'] = $config['file_name'] ;
            $uploaded = $this->upload->data();
        } else {
            $data['error_msg'] = $this->upload->display_errors();
        }

        echo json_encode($data);
	}

	public function upload_item() {
		$config['upload_path']          = './assets/custom/items/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        // $config['max_size']             = 500;
        $config['file_name']            = time() . '.jpg';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        $data['status'] = false;

        if ($this->upload->do_upload('file')) {
            $data['status'] = true;
			$users = $this->session->userdata('users');
			
			$session[$users['name']] = array('item_id' => $config['file_name']);
			// $session = array('item_id' => $config['file_name']);
			$this->session->set_userdata($session);
			// $data['file'] = $config['file_name'] ;
            $uploaded = $this->upload->data();
        } else {
            $data['error_msg'] = $this->upload->display_errors();
        }

        echo json_encode($data);
	}

	public function spmb_list_docs(){
        $str  = $this->input->POST('str');
		// users params
		$users = $this->session->userdata('users');
		$nip = $users['nip'];
        $list = $this->spmb_model->get_spmb_list_docs($str, $nip);
        $data = array();
        $no = 1;
        foreach ($list as $listdata) {
            $row    = array();
            $row[]  = $no++.'.';
            $row[]  = $listdata->doc_type;
            $row[]  = $listdata->doc_number;
            $row[]  = $listdata->doc_date;
            $row[]  = $listdata->doc_attach;

            $data[] = $row;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

	public function print_doc($id) {
		// echo $id;
		// echo $this->my_decrypt($id);
		$data = array();
		$header = $this->my_decrypt($id);
		$data =  $this->spmb_model->get_detail($header);
		$this->load->view('spmb/print_page', $data);
	}
	// while pop up new spmb showed
	public function reset_spmb_temp(){
		$users = $this->session->userdata('users');
	
		$execute = $this->spmb_model->reset_spmb_temp($users['nip']);
		if ($execute) {
			echo json_encode(true);
		} else {
			var_dump($execute);
			echo json_encode('error');
		}
	}

	public function get_detail() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result= $this->spmb_model->get_detail($params['header']);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
		// var_dump($params); 
	}

	public function get_item_only() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result= $this->spmb_model->get_items($params['header']);	

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('items' => $result)));
	}

	public function get_docs_temp() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result= $this->spmb_model->get_docs_temp($params['key_header']);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('items' => $result)));
	}
	public function get_item_temp() {
		// item for edit with id
		// edit function removed
		$params = json_decode($this->input->raw_input_stream, TRUE);
		/*
		$itemID = '';
		if ($params['itemID']) {
			$itemID = $params['itemID'];
		}
		*/
		
		// $users = $this->session->userdata('users');
		// $nip = $users['nip'];

		$result= $this->spmb_model->get_items_temp($params['key_header']);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('items' => $result)));
	}

	public function delete_item() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result= $this->spmb_model->delete_spmb_temp($params['itemID']);

		$return = array('status' => 'ok');
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($return));
	}

	public function delete_doc() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$result= $this->spmb_model->delete_doc_temp($params['itemID']);

		$return = array('status' => 'ok');
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($return));
	}

	public function upload_docs() {
		$config['upload_path']          = './assets/custom/docs/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['file_name']            = 'SPMB_' . time() . '_' . rand(1, 1000) . '.jpg';
        $config['overwrite'] = TRUE;
		
        $this->load->library('upload', $config);
		$data['status'] = false;

		$item_key = $this->input->post('item_key');
		
		if ($this->upload->do_upload('file')) {
            $data['status'] = true;
            $uploaded = $this->upload->data();

			// save filename to attachment type
			$save_data =  $this->spmb_model->save_docs_attachment_temp($config['file_name'], $item_key);
        } else {
            $data['error_msg'] = $this->upload->display_errors();
        }

        echo json_encode($data);
	}

	public function upload_items() {
		$config['upload_path']          = './assets/custom/items/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['file_name']            = 'SPMB_' . time() . '_' . rand(1, 1000) . '.jpg';
        $config['overwrite'] = TRUE;
		
        $this->load->library('upload', $config);
		$data['status'] = false;

		$item_key = $this->input->post('item_key');
		
		if ($this->upload->do_upload('file')) {
            $data['status'] = true;
            $uploaded = $this->upload->data();

			// save filename to attachment type
			$save_data =  $this->spmb_model->save_item_attachment_temp($config['file_name'], $item_key);
        } else {
            $data['error_msg'] = $this->upload->display_errors();
        }

        echo json_encode($data);
	}
}