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

	public function monitoring(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 8;
		$this->page->template('impor/monitoring');
		$this->page->view('impor/monitoring', $data);
	}

	public function setting(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 9;
		$data['smtp'] = $this->import_model->get_smtp_setting(FALSE);
		$this->page->template('impor/setting');
		$this->page->view('impor/setting', $data);
	}

	public function setting_template(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 10;
		$data['smtp'] = $this->import_model->get_smtp_setting(FALSE);
		$data['formats'] = $this->import_model->get_notif_formats();
		$this->page->template('impor/setting_template');
		$this->page->view('impor/setting_template', $data);
	}

	public function setting_log(){
		$data['users'] = $this->auth();
		$data['menuActive'] = 11;
		$this->page->template('impor/setting_log');
		$this->page->view('impor/setting_log', $data);
	}

	public function search_notif_log() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$data['searchResult'] = $this->import_model->search_notif_log($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function save_setting() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$save = $this->import_model->save_setting($params);
		$save['message'] = !empty($save['status']) ? 'Pengaturan berhasil disimpan.' : 'Gagal menyimpan pengaturan.';
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save));
	}

	public function test_notification() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}

		$testEmail = isset($params['testEmail']) ? trim($params['testEmail']) : '';
		$subject = isset($params['subject']) ? trim($params['subject']) : '';
		$body = isset($params['body']) ? $params['body'] : '';
		$smtp = isset($params['smtp']) && is_array($params['smtp']) ? $params['smtp'] : array();

		$testEmail = str_replace(array("\r", "\n"), '', $testEmail);
		$subject = str_replace(array("\r", "\n"), '', $subject);

		$result = array('status' => false, 'message' => '');

		if ($testEmail === '' || !filter_var($testEmail, FILTER_VALIDATE_EMAIL)) {
			$result['message'] = 'Isi email tes yang valid terlebih dahulu.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}
		if ($subject === '') {
			$result['message'] = 'Subjek notifikasi masih kosong.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$placeholderMap = $this->import_model->notification_placeholder_map();
		$subject = $this->import_model->apply_notification_placeholders($subject, $placeholderMap, FALSE);
		$body = $this->import_model->apply_notification_placeholders($body, $placeholderMap, TRUE);
		$subject = str_replace(array("\r", "\n"), '', $subject);

		$stored = $this->import_model->get_smtp_setting(TRUE);
		$host = isset($smtp['host']) ? trim($smtp['host']) : '';
		$fromEmail = isset($smtp['fromEmail']) ? trim($smtp['fromEmail']) : '';
		$fromName = isset($smtp['fromName']) ? trim($smtp['fromName']) : 'PATOPS';
		$port = isset($smtp['port']) && $smtp['port'] !== '' ? (int) $smtp['port'] : 587;
		$user = isset($smtp['user']) ? $smtp['user'] : '';
		$pass = isset($smtp['pass']) ? $smtp['pass'] : '';
		$crypto = isset($smtp['crypto']) ? $smtp['crypto'] : '';

		if ($host === '' && !empty($stored['host'])) $host = $stored['host'];
		if ($fromEmail === '' && !empty($stored['fromEmail'])) $fromEmail = $stored['fromEmail'];
		if (($fromName === '' || $fromName === 'PATOPS') && !empty($stored['fromName'])) $fromName = $stored['fromName'];
		if ((empty($smtp['port']) || $smtp['port'] === '') && !empty($stored['port'])) $port = (int) $stored['port'];
		if ($user === '' && !empty($stored['user'])) $user = $stored['user'];
		if ($pass === '' && !empty($stored['pass'])) $pass = $stored['pass'];
		if ($crypto === '' && isset($stored['crypto'])) $crypto = $stored['crypto'];

		if ($host === '' || $fromEmail === '' || !filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
			$result['message'] = 'Lengkapi SMTP Host dan From Email sebelum tes kirim.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$sent = $this->send_smtp_mail($testEmail, $subject, $body !== '' ? $body : '<p>(isi notifikasi kosong)</p>', array(
			'host' => $host,
			'port' => $port,
			'user' => $user,
			'pass' => $pass,
			'crypto' => $crypto,
			'fromEmail' => $fromEmail,
			'fromName' => $fromName
		));

		if (!empty($sent['status'])) {
			$result['status'] = true;
			$result['message'] = 'Email tes berhasil dikirim ke ' . $testEmail . '.';
		} else {
			$result['message'] = 'Gagal mengirim email tes. Periksa pengaturan SMTP.';
		}

		$this->import_model->insert_notif_log(array(
			'import_id' => NULL,
			'format_id' => NULL,
			'send_when' => isset($params['when']) ? $params['when'] : NULL,
			'email' => $testEmail,
			'subject' => $subject,
			'status' => !empty($sent['status']) ? 'test' : 'failed',
			'message' => $result['message']
		));

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function preview_notification() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}
		$importId = isset($params['importId']) ? (int) $params['importId'] : 0;
		$result = array('status' => false, 'message' => '');

		$row = $this->import_model->get_import_row($importId);
		if (!$row) {
			$result['message'] = 'Data impor tidak ditemukan.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$email = isset($row['email']) ? trim($row['email']) : '';
		$email = str_replace(array("\r", "\n"), '', $email);
		if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$result['message'] = 'Email pemberitahu belum diisi atau tidak valid.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$format = $this->import_model->get_default_notif_format(TRUE);
		if (!$format) {
			$result['message'] = 'Template default belum tersedia. Buka Setting Template lalu simpan template default.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$map = $this->import_model->notification_placeholder_map($row);
		$subject = $this->import_model->apply_notification_placeholders($format['subject'], $map, FALSE);
		$body = $this->import_model->apply_notification_placeholders($format['body'], $map, TRUE);
		$subject = str_replace(array("\r", "\n"), '', $subject);

		$result['status'] = true;
		$result['importId'] = $importId;
		$result['email'] = $email;
		$result['name'] = isset($row['name']) ? $row['name'] : '';
		$result['formatId'] = $format['id'];
		$result['subject'] = $subject;
		$result['body'] = $body;
		$result['fields'] = array(
			array('key' => 'nama', 'value' => isset($map['{nama}']) ? $map['{nama}'] : ''),
			array('key' => 'email', 'value' => isset($map['{email}']) ? $map['{email}'] : ''),
			array('key' => 'nomor', 'value' => isset($map['{nomor}']) ? $map['{nomor}'] : ''),
			array('key' => 'tanggal', 'value' => isset($map['{tanggal}']) ? $map['{tanggal}'] : ''),
			array('key' => 'paspor', 'value' => isset($map['{paspor}']) ? $map['{paspor}'] : ''),
			array('key' => 'periode', 'value' => isset($map['{periode}']) ? $map['{periode}'] : ''),
			array('key' => 'jatuh_tempo', 'value' => isset($map['{jatuh_tempo}']) ? $map['{jatuh_tempo}'] : ''),
			array('key' => 'sisa_hari', 'value' => isset($map['{sisa_hari}']) ? $map['{sisa_hari}'] : ''),
			array('key' => 'status', 'value' => isset($map['{status}']) ? $map['{status}'] : '')
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function send_notification() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}

		$ids = array();
		if (!empty($params['importIds']) && is_array($params['importIds'])) {
			$ids = $params['importIds'];
		} elseif (!empty($params['importId'])) {
			$ids = array($params['importId']);
		}
		$clean = array();
		foreach ($ids as $id) {
			$id = (int) $id;
			if ($id > 0 && !in_array($id, $clean, TRUE)) {
				$clean[] = $id;
			}
		}
		if (count($clean) > 50) {
			$clean = array_slice($clean, 0, 50);
		}

		$result = array('status' => false, 'message' => '', 'success' => 0, 'failed' => 0, 'skipped' => 0);
		if (empty($clean)) {
			$result['message'] = 'Tidak ada data yang dipilih.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$smtp = $this->import_model->get_smtp_setting(TRUE);
		$host = isset($smtp['host']) ? trim($smtp['host']) : '';
		$fromEmail = isset($smtp['fromEmail']) ? trim($smtp['fromEmail']) : '';
		if ($host === '' || $fromEmail === '' || !filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
			$result['message'] = 'Lengkapi SMTP Host dan From Email di Setting terlebih dahulu.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		foreach ($clean as $importId) {
			$override = NULL;
			if (count($clean) === 1) {
				if (isset($params['subject']) || isset($params['body'])) {
					$override = array(
						'subject' => isset($params['subject']) ? $params['subject'] : '',
						'body' => isset($params['body']) ? $params['body'] : '',
						'format_id' => isset($params['formatId']) ? $params['formatId'] : NULL,
						'send_when' => 'default',
						'apply_placeholders' => FALSE
					);
				}
			}
			$one = $this->send_one_notification($importId, $smtp, $override);
			if (!empty($one['skipped'])) {
				$result['skipped']++;
			} elseif (!empty($one['status'])) {
				$result['success']++;
			} else {
				$result['failed']++;
			}
		}

		$result['status'] = $result['success'] > 0;
		if (count($clean) === 1) {
			$result['message'] = $result['success']
				? 'Notifikasi berhasil dikirim.'
				: ($result['skipped'] ? 'Email pemberitahu belum diisi atau tidak valid.' : 'Gagal mengirim notifikasi.');
		} else {
			$result['message'] = 'Terkirim: ' . $result['success'] . ', gagal: ' . $result['failed'] . ', dilewati: ' . $result['skipped'] . '.';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	private function send_one_notification($importId, $smtp, $override = NULL) {
		$row = $this->import_model->get_import_row($importId);
		if (!$row) {
			return array('status' => false, 'skipped' => true, 'message' => 'Data impor tidak ditemukan.');
		}

		$email = isset($row['email']) ? trim($row['email']) : '';
		$email = str_replace(array("\r", "\n"), '', $email);
		if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return array('status' => false, 'skipped' => true, 'message' => 'Email pemberitahu belum diisi atau tidak valid.');
		}

		$format = $this->import_model->get_default_notif_format(TRUE);
		$subject = '';
		$body = '';
		$formatId = NULL;
		$sendWhen = 'default';
		$applyPlaceholders = TRUE;

		if (is_array($override) && (isset($override['subject']) || isset($override['body']))) {
			$subject = isset($override['subject']) ? trim($override['subject']) : '';
			$body = isset($override['body']) ? $override['body'] : '';
			$formatId = !empty($override['format_id']) ? (int) $override['format_id'] : (isset($format['id']) ? $format['id'] : NULL);
			$sendWhen = isset($override['send_when']) ? $override['send_when'] : 'default';
			$applyPlaceholders = !empty($override['apply_placeholders']);
		} else {
			if (!$format) {
				$message = 'Template default belum tersedia.';
				$this->import_model->insert_notif_log(array(
					'import_id' => $importId,
					'format_id' => NULL,
					'send_when' => 'default',
					'email' => $email,
					'subject' => NULL,
					'status' => 'failed',
					'message' => $message
				));
				return array('status' => false, 'message' => $message);
			}
			$subject = isset($format['subject']) ? trim($format['subject']) : '';
			$body = isset($format['body']) ? $format['body'] : '';
			$formatId = isset($format['id']) ? $format['id'] : NULL;
		}

		if ($subject === '') {
			$message = 'Subjek template notifikasi masih kosong.';
			$this->import_model->insert_notif_log(array(
				'import_id' => $importId,
				'format_id' => $formatId,
				'send_when' => $sendWhen,
				'email' => $email,
				'subject' => $subject,
				'status' => 'failed',
				'message' => $message
			));
			return array('status' => false, 'message' => $message);
		}

		if ($applyPlaceholders) {
			$placeholderMap = $this->import_model->notification_placeholder_map($row);
			$subject = $this->import_model->apply_notification_placeholders($subject, $placeholderMap, FALSE);
			$body = $this->import_model->apply_notification_placeholders($body, $placeholderMap, TRUE);
		}
		$subject = str_replace(array("\r", "\n"), '', $subject);

		$sent = $this->send_smtp_mail($email, $subject, $body !== '' ? $body : '<p>(isi notifikasi kosong)</p>', $smtp);
		$message = !empty($sent['status'])
			? 'Notifikasi berhasil dikirim ke ' . $email . '.'
			: 'Gagal mengirim notifikasi. Periksa pengaturan SMTP.';

		$this->import_model->insert_notif_log(array(
			'import_id' => $importId,
			'format_id' => $formatId,
			'send_when' => $sendWhen,
			'email' => $email,
			'subject' => $subject,
			'status' => !empty($sent['status']) ? 'success' : 'failed',
			'message' => $message
		));

		return array('status' => !empty($sent['status']), 'message' => $message);
	}

	private function send_hook_notification($importId, $hook) {
		$smtp = $this->import_model->get_smtp_setting(TRUE);
		$host = isset($smtp['host']) ? trim($smtp['host']) : '';
		$fromEmail = isset($smtp['fromEmail']) ? trim($smtp['fromEmail']) : '';
		if ($host === '' || $fromEmail === '' || !filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
			$this->import_model->insert_notif_log(array(
				'import_id' => $importId,
				'format_id' => NULL,
				'send_when' => $hook,
				'email' => NULL,
				'subject' => NULL,
				'status' => 'failed',
				'message' => 'SMTP belum dilengkapi.'
			));
			return;
		}

		$format = $this->import_model->get_notif_format_by_when($hook);
		if (!$format) {
			return;
		}

		$this->send_one_notification($importId, $smtp, array(
			'subject' => $format['subject'],
			'body' => $format['body'],
			'format_id' => $format['id'],
			'send_when' => $hook,
			'apply_placeholders' => TRUE
		));
	}

	private function send_smtp_mail($to, $subject, $body, $smtp) {
		$host = isset($smtp['host']) ? trim($smtp['host']) : '';
		$fromEmail = isset($smtp['fromEmail']) ? trim($smtp['fromEmail']) : '';
		$fromName = isset($smtp['fromName']) && $smtp['fromName'] !== '' ? $smtp['fromName'] : 'PATOPS';
		$port = isset($smtp['port']) && $smtp['port'] !== '' ? (int) $smtp['port'] : 587;
		$user = isset($smtp['user']) ? $smtp['user'] : '';
		$pass = isset($smtp['pass']) ? $smtp['pass'] : '';
		$crypto = isset($smtp['crypto']) ? $smtp['crypto'] : '';
		if (!in_array($crypto, array('', 'tls', 'ssl'), true)) {
			$crypto = '';
		}

		$this->load->library('email');
		$this->email->clear(TRUE);
		$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => $host,
			'smtp_port' => $port,
			'smtp_user' => $user,
			'smtp_pass' => $pass,
			'smtp_crypto' => $crypto,
			'smtp_timeout' => 15,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n",
			'crlf' => "\r\n",
			'wordwrap' => TRUE
		));
		$this->email->from($fromEmail, $fromName);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);

		if ($this->email->send()) {
			return array('status' => true);
		}
		return array('status' => false);
	}

	public function search_monitoring() {
		$params = json_decode($this->input->raw_input_stream, TRUE);

		$data['searchResult'] = $this->import_model->search_monitoring($params);
		$data['headline'] = $this->import_model->monitoring_headline_counts();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function monitoring_summary() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}
		$dateFrom = isset($params['dateFrom']) ? trim($params['dateFrom']) : '';
		$dateUntil = isset($params['dateUntil']) ? trim($params['dateUntil']) : '';
		if ($dateFrom === '') {
			$dateFrom = '2020-01-01';
		}
		if ($dateUntil === '') {
			$dateUntil = date('Y-m-d');
		}
		$data = $this->import_model->monitoring_summary_counts($dateFrom, $dateUntil);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('status' => true, 'summary' => $data)));
	}

	public function search_reekspor() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}
		if (empty($params['dateFrom'])) {
			$params['dateFrom'] = '2020-01-01';
		}
		if (empty($params['dateUntil'])) {
			$params['dateUntil'] = date('Y-m-d');
		}
		$data = $this->import_model->search_reekspor($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('status' => true, 'searchResult' => $data)));
	}

	public function search_jaminan_definitif() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}
		if (empty($params['dateFrom'])) {
			$params['dateFrom'] = '2020-01-01';
		}
		if (empty($params['dateUntil'])) {
			$params['dateUntil'] = date('Y-m-d');
		}
		$data = $this->import_model->search_jaminan_definitif($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('status' => true, 'searchResult' => $data)));
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
		$headerId = isset($params['header']) ? (int) $params['header'] : 0;
		$before = $headerId ? $this->import_model->get_import_row($headerId) : NULL;

		$save_data =  $this->import_model->update_header($params);

		if ($save_data && $before && isset($before['status']) && (string) $before['status'] !== '3') {
			if (!$this->import_model->has_successful_notif($headerId, array('closed'))) {
				$this->send_hook_notification($headerId, 'closed');
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function create_new() {
		$params = json_decode($this->input->raw_input_stream, TRUE);

		$save_data =  $this->import_model->create_new($params['params'], $params['keys']);
		if ($save_data) {
			$this->import_model->delete_header_draft(FALSE);
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($save_data));
	}

	public function validate_email() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$email = isset($params['email']) ? trim($params['email']) : '';
		$email = str_replace(array("\r", "\n"), '', $email);

		$result = array('status' => false, 'message' => '');
		if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$result['message'] = 'Format email tidak valid.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$domain = substr(strrchr($email, '@'), 1);
		$mxOk = function_exists('checkdnsrr') ? @checkdnsrr($domain, 'MX') : false;
		$aOk = function_exists('checkdnsrr') ? @checkdnsrr($domain, 'A') : false;
		if (!$mxOk && !$aOk) {
			$result['message'] = 'Domain email tidak ditemukan atau tidak dapat menerima email.';
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			return;
		}

		$result['status'] = true;
		$result['message'] = 'Email valid dan domain aktif.';
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
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

		if (!$this->import_model->has_successful_notif($header, array('created', 'open'))) {
			$this->send_hook_notification($header, 'created');
		}

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

	public function save_draft() {
		$this->auth();
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$ok = $this->import_model->save_header_draft($params);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('status' => (bool) $ok)));
	}

	public function get_draft() {
		$this->auth();
		$draft = $this->import_model->get_header_draft();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'status' => $draft ? true : false,
				'draft' => $draft
			)));
	}
}