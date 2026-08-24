<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ecd_model extends CI_Model {
    // zone 0 is green, 1 is red
    // scan status 0 = no, 1 yes
    public function search($params) {
        $this->db->select('A.id AS ecdID, A.full_name, A.date_of_birth, A.passport_number,  A.flight_number, A.scan_status,
            A.zone, A.arrival_date, A.scan_by, A.scan_time
        ');
        $this->db->from('ecd_personal A');

        // search parameter
        if (!empty($params['dateFrom'])) {
            $this->db->where('A.arrival_date >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.arrival_date <=', $params['dateUntil']);
        }
        if (!empty($params['flightNumber'])) {
            // $this->db->like('A.flight_number', $params['flightNumber']);
            // zone
            $zone_code = strtolower($params['flightNumber']);
            $zone = '';
            if ($zone_code == 'merah') {
                $zone = '1';
            } elseif ($zone_code == 'hijau') {
                $zone = '0';
            }
            // echo $zone; exit();
            $this->db->group_start()
                // ->like('A.flight_number', $params['flightNumber'])
                ->like('A.full_name', $params['flightNumber'])
				->or_like('A.passport_number', $params['flightNumber'])
                ->or_like('A.scan_by', $params['flightNumber'])
                ->or_where('A.zone', $zone)
            ->group_end();

            if (!empty($zone)) {
                // $this->db->where('A.zone', $zone);
            }
        }

        $this->db->order_by('A.id', 'DESC');
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
                // set indo time
                $scan_time = '';
                $sppb = '';
                if ($row['scan_status'] == '1') {
                    if ($row['zone'] == '1') {
                        $sppb = '1';
                    } else {
                        $sppb = '0';
                    }
                }

                if (!empty($row['scan_time'])) {
                    $scan_time_array = explode(' ', $row['scan_time']);
                    // print_r($scan_time_array); exit();
                    $scan_time = date('d/m/Y', strtotime($scan_time_array[0])) . ' ' .  $scan_time_array[1];
                }             

                $result['rows'][$index] = array(
                    'ecd' => $row['ecdID'],
                    'name' => $row['full_name'],
                    'birth' => date('d/m/Y', strtotime($row['date_of_birth'])),
                    'passport' => $row['passport_number'],
                    'flight' => $row['flight_number'],
                    'scan' => $row['scan_status'],
                    'scan_by' => $row['scan_by'],
                    'scan_time' => $scan_time,
                    'sppb' => $sppb,
                    'zone' => $row['zone'],
                    'arrival_date' => date('d/m/Y', strtotime($row['arrival_date'])),
                );
            } else {
                $result['nav']['last'] = FALSE;
				break;
            }
        }

        return $result;
    }

    private function get_family($id) {
        $this->db->where('personal_id', $id);
        $fams = $this->db->get('ecd_personal_family')->result_array();

        $return = array();
        foreach($fams as $val) {
            $return[] = array(
                'id' => $val['id'],
                'full_name' => $val['full_name'],
                'passport_number' => $val['passport_number'],
                'date_of_birth' => date('d/m/Y', strtotime($val['date_of_birth']))
            );
        }

        return $return;
    }

    private function get_goods($id) {
        $this->db->where('personal_id', $id);
        $goods = $this->db->get('ecd_goods')->result_array();

        $return = array();
        foreach($goods as $val) {
            $return[] = array(
                'id' => $val['id'],
                'description' => $val['description'],
                'quantity' => $val['quantity'],
                'value' => setIDR($val['value']),
                'currency' => $val['currency']
            );
        }

        return $return;
    }

    private function get_declare($id) {
        $this->db->select('B.in_content AS declare');
        $this->db->from('ecd_declare_answer A');
        $this->db->join('ecd_goods_declare B', 'A.goods_declare_id = B.id');
        $this->db->where('A.personal_id', $id);
        $this->db->where('A.answer', '1');
        $goods = $this->db->get()->result_array();

        $return = array();
        foreach($goods as $val) {
            $return[] = array(
                'content' => $val['declare']
            );
        }

        return $return;
    }

    public function get_detail($val, $rao=FALSE) {
        $result = array();
        $data = array();
        $this->db->select('A.*, B.name AS nationality');
        $this->db->join('en_countries B', 'B.id = A.nationality', 'LEFT');
        
        if ($rao) {
            $this->db->where('A.qr_code', $val['qrcode']);
        } else {
            $this->db->where('A.id', $val['headerID']);
        }
        
        $data = $this->db->get('ecd_personal A')->row_array();
        
        // change status and officer
        if ($rao) {
            $this->db->set('scan_status', '1');
            $this->db->set('scan_by', $_SESSION['users']['name']);
            $this->db->set('scan_time', date('Y-m-d H:i:s'));
            $this->db->where('qr_code', $val['qrcode']);
            $this->db->update('ecd_personal');
        }
        // end change status and officer

        // get history data
        $this->db->select('header_reff_id');
        $this->db->from('ecd_reff_personal');
        $this->db->where('personal_id', $data['id']);
        $reff = $this->db->get()->result_array();
        $reff_data = array();
        $reff_id = array();
        foreach ($reff as $val) {
            $reff_id[] = $val['header_reff_id'];
        }
        $reff_data = array();
        if (count($reff) > 0) {
            $this->db->select('A.jumlah_barang, A.uraian_barang, A.satuan_barang, A.total_pungutan, B.jns_dok_hist, B.tgl_dok_hist, B.no_dok_hist');
            $this->db->from('reff_atensi_merah_barang A');
            $this->db->join('reff_atensi_merah_header B', 'A.header_id = B.id');
            $this->db->where_in('header_id', $reff_id);
            $reff_data = $this->db->get()->result_array();
        }
        // print_r($reff_data); exit();
        // goods
        $goods = $this->get_goods($data['id']);
        // get declare
        $declare = $this->get_declare($data['id']);
        // family
        $fams = $this->get_family($data['id']);
        
        $arrival_date = explode('-', $data['arrival_date']);
        $new_arrival = $arrival_date[2] . ' ' . get_month($arrival_date[1]) . ' ' . $arrival_date[0]; 
        $result = array(
            'personalID' => $data['id'],
            'name' => $data['full_name'],
            'nationality' => $data['nationality'],
            'nationality_text' => $data['nationality_text'],
            'birth' => date('d/m/Y', strtotime($data['date_of_birth'])),
            'occupation' => $data['occupation'],
            'passport' => $data['passport_number'],
            'address' => $data['address_in_indo'],
            'flight' => $data['flight_number'],
            'arrival' => $new_arrival,
            'baggage_in' => $data['baggage_in'],
            'baggage_ex' => $data['baggage_ex'],
            'scanned' => $data['scan_status'],
            'zone' => $data['zone'],
            'zone_by' => $data['zone_by'],
            'goods' => $goods,
            'family' => $fams,
            'declare' => $declare,
            'history' => $reff_data
        );
        
        return $result;
    }

    public function change_zone($params) {
        // add parameter zone by
        $this->db->set('zone', '1');
        $this->db->set('zone_by', 'RAO');
        $this->db->where('id', $params['personal']);
        return $this->db->update('ecd_personal');
    }
    
    public function get_reference_goods($params) {
        $this->db->select('uraian_barang, jumlah_barang, satuan_barang, total_pungutan');
        $this->db->where('header_id', $params['headerID']);
        return $this->db->get('reff_atensi_merah_barang')->result_array();
    }
    public function get_reference($params) {
        $this->db->select('A.id AS ecdID, A.nama, A.no_paspor, A.tgl_lahir,  A.jns_dok_hist, A.no_dok_hist,
            A.tgl_dok_hist
        ');
        $this->db->from('reff_atensi_merah_header A');

        // search parameter
        if (!empty($params['dateFrom'])) {
            $this->db->where('A.tgl_dok_hist >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.tgl_dok_hist <=', $params['dateUntil']);
        }
        if (!empty($params['flightNumber'])) {
            // search by doc number / passenger name or origin country
            $this->db->group_start()
                ->like('A.nama', $params['flightNumber'])
                ->or_like('A.no_paspor', $params['flightNumber'])
                ->or_like('A.no_dok_hist', $params['flightNumber'])
            ->group_end();
            // $this->db->like('A.flight_number', $params['flightNumber']);
        }

        $this->db->order_by('A.id', 'DESC');
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
                    'header' => $row['ecdID'],
                    'name' => $row['nama'],
                    'birth' => date('d/m/Y', strtotime($row['tgl_lahir'])),
                    'passport' => $row['no_paspor'],
                    'docType' => $row['jns_dok_hist'],
                    'docNumber' => $row['no_dok_hist'],
                    'docDate' => date('d/m/Y', strtotime($row['tgl_dok_hist']))
                );
            } else {
                $result['nav']['last'] = FALSE;
				break;
            }
        }

        return $result;
    }

    public function save_reference($params) {
        $return_status = TRUE;
        $this->db->trans_start();
        // get last doc number
        $this->db->select('MAX(number_increment) AS increment_number');
        $this->db->where('year_increment', date('Y'));
        $increment = $this->db->get('reff_atensi_merah_header')->row_array();
        $increment_number = $increment['increment_number'];
        // var_dump($increment_number); exit();
        if ($increment_number === NULL) {
            $increment_number = 1;
        } else {
            $increment_number++;
        }
        // change format number
        $docNumber = $increment_number . '/ANALIS' . '/' . date('Y');
        // $docNumber = 'A' . $increment_number . '-' . date('Y');
    
        // var_dump($docNumber); exit();
        // set increment
        $this->db->set('number_increment', $increment_number);
        $this->db->set('year_increment', date('Y'));

        // header first
        $this->db->set('nama', $params['name']);
        $this->db->set('no_paspor', $params['passport']);
        $this->db->set('tgl_lahir', $params['birt']);
        $this->db->set('jns_dok_hist', $params['type']);
        $this->db->set('no_dok_hist', $docNumber);
        // $this->db->set('no_dok_hist', $params['number']);
        $this->db->set('tgl_dok_hist', $params['date']);
        $save_header = $this->db->insert('reff_atensi_merah_header');

        if ($save_header) {
            $header_id = $this->db->insert_id();
            // insert goods
            $this->db->set('header_id', $header_id);
            $this->db->set('uraian_barang', $params['desc']);
            $this->db->set('jumlah_barang', $params['qty']);
            $this->db->set('satuan_barang', $params['pckg']);
            $this->db->set('total_pungutan', $params['total']);
            $save_goods = $this->db->insert('reff_atensi_merah_barang');
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
		{
			$return_status = FALSE;
		}

        return $return_status;
    }
} 