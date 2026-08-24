<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {

	function get_Auth($username,$pass) {
			$data = $this->db->query("SELECT * FROM users WHERE username = '$username' AND password ='$pass'");
			return $data;
	}

	public function Updating($table, $data,$field, $id){
		$this->db->where($field, $id);
		return $this->db->update($table, $data);
	}
									
}