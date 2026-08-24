<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Valas_model extends MY_Model {

    private function data_ipl($id) {
        $data = array(
            '1' => 'Bilyet Giro',
            '2' => 'Warkat',
            '3' => 'Cek Perjalanan',
            '4' => 'Surat Sanggup Bayar',
            '5' => 'Sertifikat Deposito'
        );
        if (isset($data[$id])) {
            return $data[$id];
        } else {
            return '';
        }
    }
    
    public function get_countries() {
		return $this->db->get('countries')->result_array();
	}

	public function get_currencies() {
		return $this->db->get('currency_prm')->result_array();
	}

    /**
     * status
     * 1 = created, 2 = progress, 3 closed
     */
    public function search($params) {
        /*
        $this->db->select('A.id AS valasID, A.doc_number, A.arrival_date, A.attendance_name, A.passport_number, A.location, A.flight_number,
            A.nominal_in, B.name AS countryName, A.status
        ');
        */
        // $this->db->from('valas_data A');
        $this->db->select('A.id AS valasID, A.doc_number, A.arrival_date, A.name, A.identity_number, A.flight_number,  A.status,
            B.name AS countryName
        ');
        $this->db->from('arr_valas A');
        $this->db->join('countries B', 'A.id_country = B.id');

        // data not deleted
        $this->db->where('A.is_deleted', '0');
        $this->db->order_by('A.id', 'DESC');
        // parameters search 
        // unconment if we know where the arrival date come
        
        if (!empty($params['dateFrom'])) {
            $this->db->where('A.arrival_date >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.arrival_date <=', $params['dateUntil']);
        }
        if (!empty($params['docNumber'])) {
            // search by doc number / passenger name or origin country
            $this->db->group_start()
                ->like('A.doc_number', $params['docNumber'])
                ->or_like('A.name', $params['docNumber'])
                ->or_like('B.name', $params['docNumber'])
                ->group_end();

            // $this->db->like('A.doc_number', $params['docNumber']);
        }
        
        // set for pagination
        // limit +1 for next page indicator
        $limit = 20;
        $offset = ($params['page'] - 1) * $limit;

        $this->db->limit($limit + 1);
        $this->db->offset($offset);

        $result = array(
			'rows' => array(),
			'nav' => array(
				'page' => $params['page'],
				'last' => TRUE
			)
        );

        foreach ($this->db->get()->result_array() as $index => $row) {
            if ($index < $limit) {
                $result['rows'][$index] = array(
                    'valas' => $row['valasID'],
                    'docNumber' => $row['doc_number'],
                    'arrivalDate' => $row['arrival_date'],
                    'name' => $row['name'],
                    'passport' => $row['identity_number'],
                    // 'location' => $row['location'],
                    'flightNumber' => $row['flight_number'],
                    // 'nominal' => $row['nominal_in'],
                    'country' => $row['countryName'],
                    'status' => $row['status']
                );
            } else {
                $result['nav']['last'] = FALSE;
				break;
            }
        }

        return $result;
    }

    public function create_new($params) {
        $return_status = TRUE;
        /**
         * transaction
         * rollback if any process failed
         */
        $this->db->trans_start();
        // insert header first step 1
        $step1 = $params['step1'];
        $personal = $step1['personal'];
        $travel = $step1['travel'];
        $others = $step1['others'];
        $corp = $step1['corporate'];

        $step2 = $params['step2'];

		// personal
        $this->db->set('name', $personal['name']);
        $this->db->set('identity_number', $personal['identity']);
        $this->db->set('nationality', $personal['nationality']);
        $this->db->set('date_of_birth', $personal['birth']);
        $this->db->set('occupation', $personal['occupation']);
		$this->db->set('id_street', $personal['id_street']);
		$this->db->set('id_rt', $personal['id_rt']);
		$this->db->set('id_rw', $personal['id_rw']);
		$this->db->set('id_country', $personal['id_country']);
		$this->db->set('id_province', $personal['id_province']);
		$this->db->set('id_city', $personal['id_city']);
		$this->db->set('id_kecamatan', $personal['id_kecamatan']);
		$this->db->set('id_kelurahan', $personal['id_kelurahan']);
		$this->db->set('id_postal_code', $personal['id_postal_code']);
        $this->db->set('reason', $personal['reason']);

        // travel
        $this->db->set('flight_number', $travel['flight_number']);
		$this->db->set('arrival_date', $travel['arrival_date']);
        $this->db->set('last_port', $travel['last_port']);
        $this->db->set('next_port', $travel['next_port']);
        $this->db->set('local_street', $travel['local_street']);
		$this->db->set('local_rt', $travel['local_rt']);
		$this->db->set('local_rw', $travel['local_rw']);
		$this->db->set('local_province', $travel['local_province']);
		$this->db->set('local_city', $travel['local_city']);
		$this->db->set('local_kecamatan', $travel['local_kecamatan']);
		$this->db->set('local_kelurahan', $travel['local_kelurahan']);
		$this->db->set('local_postal_code', $travel['local_postal_code']);
        $this->db->set('purpose_of_visit', $travel['purpose']);
         
		// flags
        $this->db->set('type', '1');
        $this->db->set('intended_use', $step2['reason']);
        $this->db->set('is_suspicious', $step2['suspicious']);
        $this->db->set('is_result', $step2['result']);
        $this->db->set('is_count', $step2['count']);
		$this->db->set('is_permitted', $step2['permit']);
        
		// get session for created_by use
        $this->db->set('officer_name', $_SESSION['users']['name']);
        $this->db->set('officer_nip', $_SESSION['users']['nip']);

        $this->db->insert('arr_valas');
        $header_id = $this->db->insert_id();

        // collect data by reason (kepemilikan uang tunai)
        // 1 pribadi, 2 orang lain 3 perusahaan
        // insert to table other if any data other inserted
        $reason = $personal['reason'];
        if ($reason == '2') {
            $this->db->set('name', $others['other_name']);
            $this->db->set('nationality', $others['other_nationality']);
            $this->db->set('identity_number', $others['other_identity']);
            $this->db->set('date_of_birth', $others['other_birth']);
            $this->db->set('occupation', $others['other_occupation']);
			$this->db->set('street', $others['other_street']);
			$this->db->set('rt', $others['other_rt']);
			$this->db->set('rw', $others['other_rw']);
			$this->db->set('country', $others['other_country']);
			$this->db->set('province', $others['other_province']);
			$this->db->set('city', $others['other_city']);
			$this->db->set('kecamatan', $others['other_kecamatan']);
			$this->db->set('kelurahan', $others['other_kelurahan']);
			$this->db->set('postal_code', $others['other_postal_code']);
            $this->db->set('header_id', $header_id);
            $this->db->insert('arr_valas_others');
        } elseif ($reason == '3') {
            $this->db->set('name', $corp['corporate_name']);
            $this->db->set('type', $corp['corporate_type']);
			$this->db->set('street', $corp['corp_street']);
			$this->db->set('rt', $corp['corp_rt']);
			$this->db->set('rw', $corp['corp_rw']);
			$this->db->set('country', $corp['corp_country']);
			$this->db->set('province', $corp['corp_province']);
			$this->db->set('city', $corp['corp_city']);
			$this->db->set('kecamatan', $corp['corp_kecamatan']);
			$this->db->set('kelurahan', $corp['corp_kelurahan']);
			$this->db->set('postal_code', $corp['corp_postal_code']);
            $this->db->set('header_id', $header_id);
            $this->db->insert('arr_valas_corp');
        }

        // insert to table cash and ipl
        $cash = $step2['cash'];
        $ipl = $step2['ipl'];
        if (count($cash) > 0) {
            $dataCash = array();
            foreach($cash as $val) {
                $dataCash[] = array(
                    'currency' => $val['currency'],
                    'amount' => $val['amount'],
                    'header_id' => $header_id
                );
            }

            $this->db->insert_batch('arr_valas_cash', $dataCash);
        }
        // ipl has change
        if (count($ipl) > 0) {
            // print_r($ipl); exit();
            $dataIpl = array();
            foreach($ipl as $val) {
                if ($val['valas'] != '') {
                    $dataIpl[] = array(
                        'currency' => $val['valas'],
                        'amount' => $val['nominal'],
                        'type' => $val['type'],
                        'number' => $val['number'],
                        'date' => $val['date'],
                        'bank' => $val['bank'],
                        'header_id' => $header_id
                    );
                }
            }
            if (count($dataIpl) > 0) {
                $this->db->insert_batch('arr_valas_ipl', $dataIpl);
            }
        }

        // update doc_number here
        // doc number for arrival
        $increment_number =  $this->get_doc_number('arr_valas');
        $arr_doc_number  = $increment_number . '/KD/VALAS/SH/' . date('Y');
        $this->db->where('id', $header_id);
        $this->db->set('doc_number', $arr_doc_number);
        // set year & number
        $this->db->set('year_increment', date('Y'));
        $this->db->set('number_increment', $increment_number);
        $this->db->update('arr_valas');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
		{
			$return_status = FALSE;
		}

		$result = [
			'status' => $return_status,
			'header_id' => $header_id
		];

        return $result;
    }

    public function get_detail($header_id) {
        $return = array();

        $this->db->select('
			A.id,
			A.doc_number,
			A.created_date, 
			A.name, 
			A.identity_number, 
			B.name AS nationality, 
			A.date_of_birth, 
			A.occupation,
			A.id_street, 
			A.id_rt,
			A.id_rw,
			C.name AS id_country, 
			A.id_province,
			A.id_city,
			A.id_kecamatan,
			A.id_kelurahan,
			A.id_postal_code,
            A.flight_number, 
			A.arrival_date,
			A.last_port, 
			A.next_port, 
			A.local_street, 
			A.local_rt,
			A.local_rw,
			A.local_province,
			A.local_city,
			A.local_kecamatan,
			A.local_kelurahan,
			A.local_postal_code,
			A.purpose_of_visit,
            A.type,
			A.intended_use,
			A.reason,
			A.is_count, 
            A.is_suspicious, 
			A.is_permitted, 
			A.is_result, 
			A.officer_name, 
			A.officer_nip
        ');
        $this->db->where('A.id', $header_id);
        $this->db->from('arr_valas A');
        $this->db->join('countries B', 'A.nationality = B.id', 'left');
		$this->db->join('countries C', 'A.id_country = C.id', 'left');
        // get data as object
        $header = $this->db->get()->row();
        // var_dump($header);
        /**
         * check reason is personal (1), others(2) or corp(3)
         */
        $reason = $header->reason;
        $others = array();
        $corp = array();
        if ($reason == '2') {
			$this->db->select('
				A.id,
				A.name,
				B.name AS nationality,
				A.identity_number,
				A.date_of_birth,
				A.occupation,
				A.street,
				A.rt,
				A.rw,
				C.name AS country,
				A.province,
				A.city,
				A.kecamatan,
				A.kelurahan,
				A.postal_code
			');
            $this->db->where('header_id', $header_id);
			$this->db->from('arr_valas_others A');
			$this->db->join('countries B', 'A.nationality = B.id', 'left');
			$this->db->join('countries C', 'A.country = C.id', 'left');
            $others = $this->db->get()->row();
        }
        elseif ($reason == '3') {
			$this->db->select('
				A.id,
				A.name,
				A.type,
				A.street,
				A.rt,
				A.rw,
				B.name AS country,
				A.province,
				A.city,
				A.kecamatan,
				A.kelurahan,
				A.postal_code
			');
            $this->db->where('header_id', $header_id);
			$this->db->from('arr_valas_corp A');
			$this->db->join('countries B', 'A.country = B.id', 'left');
            $corp = $this->db->get()->row();
        }

        // get data cash and ipl for arrival
        $this->db->select('currency, amount');
        $this->db->from('arr_valas_cash');
        $this->db->where('header_id', $header_id);
        $arr_cash = $this->db->get()->result_array();

        $this->db->select('currency, amount, type, number, date, bank');
        $this->db->from('arr_valas_ipl');
        $this->db->where('header_id', $header_id);
        $data_ipl = $this->db->get()->result_array();
        $arr_ipl = array();
        foreach ($data_ipl as $val) {
            $arr_ipl[] = array(
                'currency' => $val['currency'], 
				'amount' => $val['amount'], 
				'type' => $this->data_ipl($val['type']),
				'number' => $val['number'], 
				'date' => $val['date'], 
				'bank' => $val['bank'], 
            );
        }
        // create new array with data object
        $return = array(
            'personal' => $header,
            'others' => $others,
            'corp' => $corp,
            'arrival_cash' => $arr_cash,
            'arrival_ipl' => $arr_ipl
        );
        // echo count($others) 
        
        return $return;
    }

	/**
	 * set status to closed
	 */
	public function close_doc($header_id)
	{
        $this->db->set('status', '3');
        $this->db->where('id', $header_id);
        $this->db->update('arr_valas');
	}

    public function delete($header) {
        $this->db->set('is_deleted', '1');
        $this->db->where('id', $header);
        return $this->db->update('arr_valas');
    }

	public function save_valas_attachments($fileName, $header_id, $remark)
	{
		$this->db->set('name', $fileName);
        $this->db->set('header_id', $header_id);
		$this->db->set('jenis', $remark);
        $this->db->insert('arr_valas_attachment');
	}

	public function get_attachments($header_id)
	{
		$this->db->select('jenis, name');
		$this->db->where('A.header_id', $header_id);
        $this->db->from('arr_valas_attachment A');
		$data_attachments = $this->db->get()->result_array();
		return $data_attachments;
	}
}