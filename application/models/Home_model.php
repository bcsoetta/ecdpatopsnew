<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	
	public function Insert($table, $data){

    	return $this->db->insert($table, $data);
	}

	public function Updating($table, $data,$field, $id){
		$this->db->where($field, $id);
		return $this->db->update($table, $data);
	}
}