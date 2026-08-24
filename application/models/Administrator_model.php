<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_model extends CI_Model {
	public function Insert($table, $data){
    	return $this->db->insert($table, $data);
	}
	public function Updating($table, $data,$field, $id){
		$this->db->where($field, $id);
		return $this->db->update($table, $data);
	}
	public function list_qr() {
		$data = $this->db->query("SELECT a.*,
										   b.customer_name,
										   c.building_name,
										   dd.location_name,
										   d.zone_name
									FROM qr_tbl a
									JOIN customer_tbl b ON b.id_customer = a.`id_customer`
									JOIN building_tbl c ON c.id_building = a.`id_building`
									JOIN location_tbl dd on dd.id_location = a.id_lokasi 
									JOIN zone_tbl d	ON d.`id_zone` = a.`id_zone`
								");
   	 	return $data->result();
	}

	public function list_desinfect($id) {
		$data = $this->db->query("	
									SELECT 
										   ROW_NUMBER() OVER (ORDER BY a.id_qr)row_num,
										   a.*,
										   b.customer_name,
										   c.building_name,
										   dd.location_name,
										   d.zone_name,
										   e.date_desinfect,
										   e.`by`
									FROM qr_tbl a
									JOIN customer_tbl b ON b.id_customer = a.`id_customer`
									JOIN building_tbl c ON c.id_building = a.`id_building`
									JOIN location_tbl dd on dd.id_location = a.id_lokasi 
									JOIN zone_tbl d	ON d.`id_zone` = a.`id_zone`
									JOIN desinfect_tbl e on e.id_qr  = a.id_qr 
									WHERE a.id_qr = '$id'
								");
   	 	return $data->result();
	}


	public function list_building() {
		$data = $this->db->query("	
									SELECT *
									FROM building_tbl
								");
   	 	return $data->result();
	}

	public function list_customer() {
		$data = $this->db->query("	
									SELECT *
									FROM customer_tbl
								");
   	 	return $data->result();
	}

	public function list_location() {
		$data = $this->db->query("	
									SELECT *
									FROM location_tbl
								");
   	 	return $data->result();
	}


}