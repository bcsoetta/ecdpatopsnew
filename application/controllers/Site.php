<?php date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');
class Site extends MX_Controller {	
	public function __construct(){
		parent::__construct();		
		$this->load->model('setting_model');	

	}
	public function index(){
		$this->load->library('user_agent');
		$this->page->template('site/index');	
		$this->page->view();
	}
	public function logout(){
			$this->session->sess_destroy();		
			redirect(base_url());	
	}

	public function get(){
		$reqUser = $this->input->post('username');
		$reqPasswd = $this->input->post('password');
			// $ch = curl_init();
			// curl_setopt($ch, CURLOPT_URL,"https://hris.garudapratama.com/getemploye/esrm");
			// curl_setopt($ch, CURLOPT_POST, 1);
			// curl_setopt($ch, CURLOPT_POSTFIELDS,"reqUser=$reqUser&reqPasswd=$reqPasswd");
			
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// $server_output = curl_exec($ch);
			// curl_close ($ch);

			$datausers = json_decode($server_output);
				$sess_esrm = array(
						'position'  => 1,
				        'username'  => $reqUser,
				        'name'		=> 'Danang Yogi Susanto',
				        'company'	=> 1,
				        'branch'	=> 1,
				        'role'      => 1,
				        'logged_in' => TRUE
				);
				$this->session->set_userdata($sess_esrm);
				echo json_encode(array('logging_in' => true));
	}

}
/* End of file site.php *//* Location: ./application/controllers/site.php */