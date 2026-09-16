<?php date_default_timezone_set("Asia/Bangkok");

defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MX_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('authbc');
		$this->load->model('home_model');
	}

	public function index(){
		// this method will called while user have access
		$this->load->library('authbc');
		$data['users'] = $this->authbc->get_users();
		/**
		 * set session for user logged in
		 */
		$this->session->set_userdata($data);
		// last_user_activity hanya di-set saat login halaman / keep-alive eksplisit
		if (!(int) $this->session->userdata('last_user_activity')) {
			$this->session->set_userdata('last_user_activity', time());
		}
		
		$this->page->template('home/index');	
		$this->page->view();
	}

	public function session_ping() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		if (!is_array($params)) {
			$params = array();
		}
		$keep = !empty($params['keep']);

		$users = $this->session->userdata('users');
		if (empty($users)) {
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
				->set_output(json_encode(array(
					'status' => false,
					'auth' => false,
					'message' => 'Session berakhir.'
				)));
			return;
		}

		$ttl = (int) $this->config->item('sess_expiration');
		if ($ttl < 60) {
			$ttl = 7200;
		}
		$warnBefore = 300;
		$now = time();
		$last = (int) $this->session->userdata('last_user_activity');
		if ($last < 1) {
			$last = $now;
			$this->session->set_userdata('last_user_activity', $last);
		}

		$elapsed = $now - $last;
		if ($elapsed > $ttl) {
			$this->session->sess_destroy();
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
				->set_output(json_encode(array(
					'status' => false,
					'auth' => false,
					'message' => 'Session berakhir karena tidak ada aktivitas.'
				)));
			return;
		}

		if ($keep) {
			$last = $now;
			$this->session->set_userdata('last_user_activity', $last);
			$elapsed = 0;
		}

		$remaining = $ttl - $elapsed;
		if ($remaining < 0) {
			$remaining = 0;
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'status' => true,
				'auth' => true,
				'ttl' => $ttl,
				'warnBefore' => $warnBefore,
				'remaining' => $remaining,
				'serverTime' => $now
			)));
	}

}