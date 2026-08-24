<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assignment_peralihan_model extends CI_Model {
	
	public function Hapus($id_pendidikan, $id_users){
				$data = $this->db->query("DELETE FROM zzz_fr_3_pendidikan_peralihan
										  WHERE id_pendidikan  = '$id_pendidikan' ");
	}

	public function Hapus_pengalaman($id_pengalaman){
				$data = $this->db->query("DELETE FROM zzz_fr_5_pengalaman_peralihan
										  WHERE id_pengalaman = '$id_pengalaman' ");
	}
	public function Hapus_bahasa($id_bahasa){
				$data = $this->db->query("DELETE FROM zzz_fr_4_bahasa_peralihan
										  WHERE id_bahasa_users = '$id_bahasa' ");
	}
	public function Insert($table, $data){

    	return $this->db->insert($table, $data);
	}
	public function Updating($table, $data,$field, $id){
		$this->db->where($field, $id);
		return $this->db->update($table, $data);
	}

	public function get_user_image($str) {
		$data = $this->db->query("SELECT * FROM users WHERE id = '$str'");
   	 	return $data->result();
	}
	public function get_profil($str) {
		$data = $this->db->query("SELECT a.*,jenis_kelamin,provinsi_name
								  FROM zzz_fr_1profil_peralihan a
								  LEFT JOIN x_master_jenis_kelamin b ON b.id_jenis_kelamin = a.id_jenis_kelamin
								  LEFT JOIN x_master_provinces c ON c.id_provinsi = a.id_provinsi 
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_tingkat_pengalaman($str) {
		$data = $this->db->query("SELECT *
								  FROM zzz_fr_2_tingkat_pengalaman_peralihan a
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_pengalaman($str) {
		$data = $this->db->query("SELECT * FROM zzz_fr_5_pengalaman_peralihan
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_bahasa($str) {
		$data = $this->db->query("SELECT a.*,b.bahasa
								  FROM zzz_fr_4_bahasa_peralihan a
								  LEFT JOIN x_master_bahasa b ON b.id_bahasa = a.id_bahasa
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_pendidikan($str) {
		$data = $this->db->query("SELECT *
								  FROM zzz_fr_3_pendidikan_peralihan
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}

	public function get_info_rekening($str) {
		$data = $this->db->query("SELECT a.*, b.nama_bank
								  FROM zzz_fr_6_info_rekening_peralihan a 
									LEFT JOIN x_master_bank b on a.id_bank = b.id_bank
								  WHERE a.id_users = '$str'");
   	 	return $data->result();
	}

	public function get_info_file($str) {
		$data = $this->db->query("SELECT *
								  FROM zzz_fr_7_file_peralihan a 
								  WHERE a.id_users = '$str'");
   	 	return $data->result();
	}
	


}