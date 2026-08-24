<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spmb_model extends MY_Model {
	
	private function item_status($id) {
		$status = array(
			'0' => '',
			'1' => 'Tidak Sesuai',
			'2' => 'Sesuai Sebagian',
			'3' => 'Sesuai Seluruhnya'
		);

		if ($id == null) {
			$return = '';
		} else {
			$return = $status[$id];	
		}

		return $return;
	}

	public function Delete($id_pendidikan, $id_users){
				$data = $this->db->query("DELETE FROM x_fr_pendidikan
										  WHERE id_pendidikan  = '$id_pendidikan' 
										  AND  id_users = '$id_users'");
	}
	public function Insert($table, $data, $itemID = ''){
		if ($table == 'spmb_header') {
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}

		if (!empty($itemID)) {
			$this->db->where('id', $itemID);
			$return = $this->db->update($table, $data);
		} else {
			$return = $this->db->insert($table, $data);
		}
    	return $return;
	}

	public function get_spmb_barang($id) {
		$data = $this->db->query("SELECT * FROM spmb_barang WHERE id = '$id' ")->row();
   	 	return $data;
	}
	public function get_spmb_sisa($id) {
		$data = $this->db->query("SELECT SUM(status) AS sisa FROM spmb_barang sb WHERE  nomor_dokumen = '$id'")->row();
   	 	return $data;
	}

	public function get_max_spmb() {
		$data = $this->get_doc_number('spmb_header');
		// $data = $this->db->query("SELECT MAX(id_dokumen) as id_dokumen FROM spmb_header")->row();
   	 	return $data;
	}
	public function get_spmb($search, $offset, $limit) {
		/**
		 * status on spmb_header 
		 * 1 = created, 2 = open, 3 = close
		 */
		$result = array(
			'data' => array(),
			'recordsTotal' => 0
		);

		if ($search <> '') {
			// $this->db->like('nomor_dokumen', $search);
			$this->db->group_start()
                ->like('nomor_dokumen', $search)
                ->or_like('nama', $search)
				->or_like('nomor_paspor', $search)
                ->group_end();
		}
		// $data = $this->db->query("SELECT * FROM spmb_header");
		$this->db->limit($limit, $offset);
		$this->db->order_by('id', 'DESC');
		$data = $this->db->get('spmb_header')->result_array();
		
		$return = array();

		foreach($data as $val) {
			// set status by spmb item
			$this->db->select('count(id) AS total');
			$this->db->where('status_barang <>', 3);
			
			$this->db->where('header_id', $val['id']);
			$query = $this->db->get('spmb_barang')->result();
			// echo $query[0]->total;
			/**
			 * status here 1= open, 2 = close, 3 = created
			 */
			$status = 2;
			if ($query[0]->total > 0) {
				$status = 1; //open
			}
			if ($val['status'] == 1) {
				$status = 3;
			}

			$return[] = array(
				'id' => $val['id'],
				'nomor_dokumen' => $val['nomor_dokumen'],
				'tanggal_dokumen' => $val['tanggal_dokumen'],
				'nama' => $val['nama'],
				'nomor_paspor' => $val['nomor_paspor'],
				'nomor_penerbangan' => $val['nomor_penerbangan'],
				'status' => $status
			);
		}
		// exit();
		$result['data'] = $return;

		$query = $this->db->query('select count(id) AS total from spmb_header ')->result();
		$total = $query[0]->total;
		// var_dump($total);
		$result['recordsTotal'] = $total;

		return $result;
	}
	public function get_spmb_list_item($id) {
		// $data = $this->db->query("SELECT * FROM spmb_barang where header_id = '$id'");
		$this->db->where('header_id', $id);
   	 	$this->db->select('id, nomor_dokumen, nama_barang, jumlah_satuan, jenis_kemasan, status, status_barang');
		$this->db->from('spmb_barang');
		$result = $this->db->get()->result_array();
		$return = array();
		
		foreach($result as $val) {
			$sisa = $val['status'];
			if ($val['status_barang'] == 1) {
				$sisa = $val['jumlah_satuan'];
			} elseif ($val['status_barang'] == 2) {
				$sisa = $val['jumlah_satuan'] - $val['status'];
			} elseif ($val['status_barang'] == 3) {
				$sisa = 0;
			} else {
				$sisa = $val['jumlah_satuan'];
			}

			$return[] = array(
				'id' => $val['id'],
				'nomor_dokumen' => $val['nomor_dokumen'],
				'nama_barang' => $val['nama_barang'],
				'jumlah_satuan' => $val['jumlah_satuan'],
				'jenis_kemasan' => $val['jenis_kemasan'],
				'status' => $sisa,
				'status_barang' => $this->item_status($val['status_barang'])
			);
		}
		return $return;
	}

	// get temporary data
	public function get_spmb_item_form($id) {
		$data = $this->db->query("SELECT * FROM spmb_barang_temp where nomor_dokumen = '$id'");
   	 	return $data->result();
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
								  FROM x_fr_profil a
								  LEFT JOIN x_master_jenis_kelamin b ON b.id_jenis_kelamin = a.id_jenis_kelamin
								  LEFT JOIN x_master_provinces c ON c.id_provinsi = a.id_provinsi 
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_tingkat_pengalaman($str) {
		$data = $this->db->query("SELECT *
								  FROM x_fr_tingkat_pengalaman a
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_pengalaman($str) {
		$data = $this->db->query("SELECT * FROM x_fr_pengalaman
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_bahasa($str) {
		$data = $this->db->query("SELECT a.*,b.bahasa
								  FROM x_fr_bahasa a
								  LEFT JOIN x_master_bahasa b ON b.id_bahasa = a.id_bahasa
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}
	public function get_pendidikan($str) {
		$data = $this->db->query("SELECT *
								  FROM x_fr_pendidikan
								  WHERE id_users = '$str'");
   	 	return $data->result();
	}

	public function get_info_file($str) {
		$data = $this->db->query("SELECT *
								  FROM x_fr_file a 
								  WHERE a.id_users = '$str'");
   	 	return $data->result();
	}
	
	/**
	 * robbi amirudin
	 */
	public function insert_temp_barang($header_id, $doc, $nip) {
		// $this->db->where('nomor_dokumen', $doc);
		$this->db->where('nip_user', $nip);
		$temp = $this->db->get('spmb_barang_temp')->result_array();
		// var_dump($temp); exit();
		foreach($temp as $val) {
			$items[] = array(
				'nama_barang'	=> $val['nama_barang'] ,
				'header_id'		=> $header_id,
				'currency_id'		=> $val['currency_id'],
				'category_id'		=> $val['category_id'],
				'jumlah_kemasan'=> $val['jumlah_kemasan'],
				'jenis_kemasan'	=> $val['jenis_kemasan'],
				'jumlah_satuan'	=> $val['jumlah_satuan'],
				'jenis_satuan'	=> $val['jenis_satuan'],
				'nilai_pabean'  => $val['nilai_pabean'],
				'hs_id'			=> $val['hs_id'],
				'created_at'	=> $val['created_at'],
				'updated_at'	=> $val['updated_at'],
				'nomor_dokumen'	=> $doc,
				'status'		=> $val['status'],
				'bruto'			=> $val['bruto'],
				'attachment'			=> $val['attachment'],
			);
		};

		$this->db->insert_batch('spmb_barang', $items);
		
		// $this->db->where('nomor_dokumen', $doc);
		$this->db->where('nip_user', $nip);
		return $this->db->delete('spmb_barang_temp');
	}

	public function insert_temp_docs($header_id, $nip) {
		$this->db->where('nip_user', $nip);
		$temp = $this->db->get('docs_temp')->result_array();
		// var_dump($temp); exit();
		foreach($temp as $val) {
			$items[] = array(
				'header_id'		=> $header_id,
				'doc_type' => $val['doc_type'],
				'doc_number' => $val['doc_number'],
				'doc_date' => $val['doc_date'],
				'doc_attach' => $val['doc_attach']
			);
		};

		$this->db->insert_batch('docs', $items);

		// $this->db->where('id >', 0);
		$this->db->where('nip_user', $nip);
		return $this->db->delete('docs_temp');
	}

	public function get_countries() {
		return $this->db->get('countries')->result_array();
	}

	public function get_categories() {
		return $this->db->get('item_categories')->result_array();
	}

	public function get_quantity_type() {
		return $this->db->get('quantity_type')->result_array();
	}
	
	public function get_spmb_list_docs($id, $nip) {
		$this->db->where('nip_user', $nip);
		$data = $this->db->get('docs_temp');
		// $data = $this->db->query("SELECT * FROM docs_temp");
   	 	return $data->result();
	}

	public function update_spmb_item($id, $status, $sisa, $note) {
		$this->db->where('id', $id);
		$this->db->set('status_barang', $status);
		$this->db->set('note', $note);
		/**
		 * sisa = jumlah barang sesuai
		 * rumus sisa real = qty - sisa
		 * jika status == 2 then qty - sisa = sisa else sisa = sisa
		 */
		// var_dump($sisa);
		if($status == 2) {	
			$this->db->set('status', $sisa);
		}
		return $this->db->update('spmb_barang');
	}

	public function reset_spmb_temp($nip = '') {
		// delete table temp with nip
		// $this->db->where('nip_user', $nip);
		// $a = $this->db->delete('spmb_barang_temp');
		$a = true;
		$this->db->where('nip_user', $nip);
		$b = $this->db->delete('docs_temp');
		
		// $a = $this->db->empty_table('docs_temp');
		// $b = $this->db->empty_table('spmb_barang_temp');
		
		$return = false;
		if ($a && $b) {
			$return = true;
		}
		
		return $return;
	}

	public function get_detail($params) {
		$result = array();
		// get data spmb complete
		// bandara_kedatangan
		$this->db->select('A.nama, A.tgl_lahir, A.nomor_paspor, A.nomor_telepon, A.nik_npwp_nib, A.kebangsaan, A.email, A.kantor_pabean_keberangkatan,
		A.kantor_pabean_kedatangan, A.nomor_penerbangan, A.nomor_dokumen, A.tanggal_dokumen, A.alamat, A.reason,
		A.print_status, A.occupation, A.input_by,
		B.name AS country_arrival, C.name AS nationality');
		$this->db->from('spmb_header A');
		$this->db->join('countries B', 'A.bandara_kedatangan = B.id');
		$this->db->join('countries C', 'A.kebangsaan = C.id');
		// get airport tujuan
		$this->db->where('A.id', $params);
		$header = $this->db->get()->result_array();

		$items = $this->get_items($params);

		$this->db->select('A.doc_type, A.doc_number, A.doc_date, A.doc_attach');
		$this->db->from('docs A');
		$this->db->where('A.header_id', $params);
		$docs = $this->db->get()->result_array();

		$result['result'] = $header[0];
		$result['result']['items'] = $items;
		$result['result']['docs'] = $docs;

		/**
		 * set status print to and no items can changed
		 */
		$this->db->select('count(id) AS total');
		$this->db->where('status_barang <>', 3);
			
		$this->db->where('header_id', $params);
		$query = $this->db->get('spmb_barang')->result();
		// echo $query[0]->total;
		if ($query[0]->total > 0) {
			// do nothing
		} else {
			// set status print as 1
			$this->db->where('id', $params);
			$this->db->set('print_status', 1);
			$this->db->update('spmb_header');
		}

		return $result;
		// print_r($data);
	}
	private function get_attachments($id) {
		$this->db->where('item_id', $id);
		return $this->db->get('spmb_barang_attachment')->result_array();
	}
	public function get_items($params) {
		// set header not a created again
		$this->db->set('status', 2);
		$this->db->where('id', $params);
		$this->db->update('spmb_header');
		// get items data
		// add jenis satuan
		$this->db->select('A.id, A.nama_barang, A.status_barang, A.status, A.nomor_dokumen, A.jumlah_kemasan, A.jenis_kemasan, A.jumlah_satuan, A.jenis_satuan, A.nilai_pabean AS harga_satuan, A.attachment,
			B.name AS category, C.name AS currency,
			A.bruto, A.note,
			D.name AS qty_type
		');
		$this->db->from('spmb_barang A');
		$this->db->join('item_categories B', 'A.category_id = B.id');
		$this->db->join('currency C', 'A.currency_id = C.id');
		$this->db->join('quantity_type D', 'A.jenis_satuan = D.id');
		$this->db->where('A.header_id', $params);
		$data_items = $this->db->get()->result_array();
		/**
		 * parsing data items
		 * status_item 1 = tidak sesuai, 2 = sesuai sebagian, 3 sesuai seluruhnya
		 * if status = 3 no edit available
		 */
		$items = array();
		foreach ($data_items as $val) {
			$sisa = $val['status'];
			if ($val['status_barang'] == 1) {
				$sisa = $val['jumlah_satuan'];
			} elseif ($val['status_barang'] == 2) {
				$sisa = $val['jumlah_satuan'] - $val['status'];
			} elseif ($val['status_barang'] == 3) {
				$sisa = 0;
			} else {
				$sisa = $val['jumlah_satuan'];
			}
			// attachment is array now
			$items[] = array(
				'item_id' => $val['id'],
				'doc_number' => $val['nomor_dokumen'],
				'item_name' => $val['nama_barang'],
				'qty' => $val['jumlah_satuan'],
				'qty_type' => $val['qty_type'],
				'package' => $val['jumlah_kemasan'],
				'package_type' => $val['jenis_kemasan'],
				'category' => $val['category'],
				'currency' => $val['currency'],
				'price' => $val['harga_satuan'],
				'remaining' => $sisa,
				'statusID' => $val['status_barang'],
				'status' => $this->item_status($val['status_barang']),
				'attachment' => $this->get_attachments($val['id']),
				'bruto' => $val['bruto'],
				'note' => $val['note']
			);
		}

		return $items;
	}

	public function get_docs_temp($id) {
		$this->db->where('key_header', $id);
		// $result = array();
		$this->db->select('id, doc_type, doc_number, doc_date');
		return $this->db->get('docs_temp')->result_array();
	}

	public function get_items_temp($id, $nip = '') {
		/*
		if (!empty($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where('nip_user', $nip);
		*/
		$this->db->where('key_header', $id);
		$result = array();
		$this->db->select('id, nama_barang, jumlah_satuan, jenis_satuan, currency_id, category_id, jumlah_kemasan, jenis_kemasan, bruto, nilai_pabean, attachment');
		$temp = $this->db->get('spmb_barang_temp')->result_array();
		foreach ($temp as $val) {
			$result[] = array(
				'itemID' => $val['id'],
				'itemName' => $val['nama_barang'],
				'qty' => $val['jumlah_satuan'],
				'qty_type' => $val['jenis_satuan'],
				'qty_pck' => $val['jumlah_kemasan'],
				'package' => $val['jenis_kemasan'],
				'bruto' => $val['bruto'],
				'price' => $val['nilai_pabean'],
				'currency' => $val['currency_id'],
				'category' => $val['category_id']
				// 'attachment' => $val['attachment']
			);
		}

		return $result;
	}

	public function delete_spmb_temp($id) {
		// attachment not already deleted
		$this->db->where('id', $id);
		return $this->db->delete('spmb_barang_temp');
	}

	public function delete_doc_temp($id) {
		// attachment not already deleted
		$this->db->where('id', $id);
		return $this->db->delete('docs_temp');
	}

	/**
	 * new transaction for header input 
	 */

	public function create_new_spmb($spmb, $nip) {
		$return_status = true;
		// $item_status = false;
		// $doc_status = false;

		$this->db->trans_start();
		// insert header first
		$this->db->insert('spmb_header', $spmb);
		$header_id =  $this->db->insert_id();
		
		// set year & number
        $this->db->set('year_increment', date('Y'));
        $this->db->set('number_increment', $spmb['id_dokumen']);
		$this->db->where('id', $header_id);
		$this->db->update('spmb_header');
		
		// insert table item from temp
		// params is key_header
		// $this->db->where('nip_user', $nip);
		$this->db->where('key_header', $nip);
		$temp = $this->db->get('spmb_barang_temp')->result_array();

		// insert itemp
		foreach($temp as $val) {
			$items = array(
				'nama_barang'	=> $val['nama_barang'] ,
				'header_id'		=> $header_id,
				'currency_id'		=> $val['currency_id'],
				'category_id'		=> $val['category_id'],
				'jumlah_kemasan'=> $val['jumlah_kemasan'],
				'jenis_kemasan'	=> $val['jenis_kemasan'],
				'jumlah_satuan'	=> $val['jumlah_satuan'],
				'jenis_satuan'	=> $val['jenis_satuan'],
				'nilai_pabean'  => $val['nilai_pabean'],
				'hs_id'			=> $val['hs_id'],
				// 'created_at'	=> $val['created_at'],
				// 'updated_at'	=> $val['updated_at'],
				'nomor_dokumen'	=> $spmb['nomor_dokumen'],
				'status'		=> $val['status'],
				'bruto'			=> $val['bruto'],
				'attachment'			=> $val['attachment']
			);

			$this->db->insert('spmb_barang', $items);
			$item_id = $this->db->insert_id();

			// insert items attachment from temp
			$this->db->where('key_item', $val['key_item']);
			$file_temp = $this->db->get('spmb_barang_attachment_temp')->result_array();
			if (count($file_temp) > 0) {
				$data_file = array();
				foreach ($file_temp as $row) {
					$data_file[] = array(
						'name' => $row['name'],
						'item_id' => $item_id
					);
				}

				$insert_file = $this->db->insert_batch('spmb_barang_attachment', $data_file);
				if ($insert_file) {
					// remove file temp after inserted
					$this->db->where('key_item', $val['key_item']);
					$this->db->delete('spmb_barang_attachment_temp');
				}
			}
		};
		// remove table temp after save
		$this->db->where('key_header', $nip);
        $this->db->delete('spmb_barang_temp');

		// insert table docs from temp
		$this->db->where('key_header', $nip);
		$temp_docs = $this->db->get('docs_temp')->result_array();

		foreach($temp_docs as $val) {
			$docs = array(
				'header_id'		=> $header_id,
				'doc_type' => $val['doc_type'],
				'doc_number' => $val['doc_number'],
				'doc_date' => $val['doc_date']
			);

			$this->db->insert('docs', $docs);
			$item_id = $this->db->insert_id();

			// insert items attachment from temp
			$this->db->where('key_item', $val['key_doc']);
			$file_temp = $this->db->get('docs_attachment_temp')->result_array();	
			
			if (count($file_temp) > 0) {
				$data_file = array();
				foreach ($file_temp as $row) {
					$data_file[] = array(
						'name' => $row['name'],
						'doc_id' => $item_id
					);
				}

				$insert_file = $this->db->insert_batch('docs_attachment', $data_file);
				if ($insert_file) {
					// remove file temp after inserted
					$this->db->where('key_item', $val['key_doc']);
					$this->db->delete('docs_attachment_temp');
				}
			}
		};

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$return_status = false;
		}

		return $return_status;
	}

	public function save_item_temp($params) {
		$users = $this->session->userdata('users');

		$data = array(
			'nama_barang' => $params['name'],
			'jumlah_kemasan' => $params['package'],
			'jenis_kemasan' => $params['packageType'],
			'jumlah_satuan' => $params['qty'],
			'jenis_satuan' => $params['qtyType'],
			'nilai_pabean' => $params['price'],
			'bruto' => $params['bruto'],
			'category_id' => $params['category'],
			'currency_id' => $params['currency'],
			'nip_user' => $users['nip'],
			'key_header' => $params['header'],
			'key_item' => $params['item']
		);
		$insert = $this->db->insert('spmb_barang_temp', $data);
		return $insert;
	}

	public function save_docs_temp($params) {
		$users = $this->session->userdata('users');

		$data = array(
			'doc_type' => $params['type'],
			'doc_number' => $params['number'],
			'doc_date' => $params['date'],
			'nip_user' => $users['nip'],
			'key_header' => $params['header'],
			'key_doc' => $params['item']
		);
		$insert = $this->db->insert('docs_temp', $data);
		return $insert;
	}

	public function save_item_attachment_temp($fileName, $key) {
        $this->db->set('name', $fileName);
        $this->db->set('key_item', $key);
        $this->db->insert('spmb_barang_attachment_temp');
    }

	public function save_docs_attachment_temp($fileName, $key) {
		$this->db->set('name', $fileName);
        $this->db->set('key_item', $key);
        $this->db->insert('docs_attachment_temp');
	}
}