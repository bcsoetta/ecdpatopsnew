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
        $this->db->join('countries B', 'A.origin_country = B.id');

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
        $this->db->set('residence_address', $personal['address']);
        $this->db->set('occupation', $personal['occupation']);
        $this->db->set('reason', $personal['reason']);
        // for origin country
        $this->db->set('origin_country', $personal['country']);
        // travel
        $this->db->set('flight_number', $travel['flightNumber']);
        $this->db->set('last_port', $travel['place']);
        $this->db->set('next_port', $travel['destination']);
        $this->db->set('address_in_indonesia', $travel['indonesianaddress']);
        $this->db->set('purpose_of_visit', $travel['purpose']);
        $this->db->set('arrival_date', $travel['arrivalDate']);
        /**
         * step2
         * type = departure (2) or arrival (1)
         * type always be 1 
         */ 
        // $type = $step2['type'];
         
        $this->db->set('type', '1');
        $this->db->set('intended_use', $step2['reason']);
        $this->db->set('is_suspicious', $step2['suspicious']);
        $this->db->set('is_result', $step2['result']);
        $this->db->set('is_count', $step2['count']);
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
            $this->db->set('name', $others['otherName']);
            $this->db->set('nationality', $others['otherNationality']);
            $this->db->set('identity_number', $others['otherIdentity']);
            $this->db->set('date_of_birth', $others['otherBirth']);
            $this->db->set('residence_address', $others['otherAddress']);
            $this->db->set('occupation', $others['otherOccupation']);
            $this->db->set('header_id', $header_id);
            $this->db->insert('arr_valas_others');
        } elseif ($reason == '3') {
            // corporate table
            $this->db->set('name', $corp['corporatename']);
            $this->db->set('address', $corp['corporateaddress']);
            $this->db->set('type', $corp['corporatetype']);
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

        return $return_status;
    }

    public function get_detail($header_id) {
        $return = array();

        $this->db->select('A.name, A.created_date, B.name AS nationality, A.identity_number, A.date_of_birth, A.residence_address, A.occupation,
            A.reason,
            A.flight_number, A.last_port, A.next_port, A.address_in_indonesia, A.purpose_of_visit,
            A.type,
            A.is_suspicious, A.is_result, A.officer_name, A.officer_nip, A.is_count, A.doc_number
        ');
        $this->db->where('A.id', $header_id);
        $this->db->from('arr_valas A');
        $this->db->join('countries B', 'A.nationality = B.id');
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
            $this->db->where('header_id', $header_id);
            $others = $this->db->get('arr_valas_others')->row();
        }
        elseif ($reason == '3') {
            $this->db->where('header_id', $header_id);
            $corp = $this->db->get('arr_valas_corp')->row();
        }

        // get data cash and ipl for arrival
        $this->db->select('currency, amount');
        $this->db->from('arr_valas_cash');
        $this->db->where('header_id', $header_id);
        $arr_cash = $this->db->get()->result_array();

        $this->db->select('currency, amount, type');
        $this->db->from('arr_valas_ipl');
        $this->db->where('header_id', $header_id);
        $data_ipl = $this->db->get()->result_array();
        $arr_ipl = array();
        foreach ($data_ipl as $val) {
            $arr_ipl[] = array(
                'currency' => $val['currency'], 'amount' => $val['amount'], 'type' => $this->data_ipl($val['type'])
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
        /**
         * set status to closed
         */
        $this->db->set('status', '3');
        $this->db->where('id', $header_id);
        $this->db->update('arr_valas');
        
        return $return;
    }

    public function delete($header) {
        $this->db->set('is_deleted', '1');
        $this->db->where('id', $header);
        return $this->db->update('arr_valas');
    }
}