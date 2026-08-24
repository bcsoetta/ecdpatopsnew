<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_model extends MY_Model {

    /**
     * bpj status
     * <= 14 days is red
     * 15 - 60 is yellow
     * 61 - 90 is green
     */
    private function bpj_status($doc_date, $periode) {
        $now = time(); // or your date as well
        $your_date = strtotime($doc_date);
        $datediff = $now - $your_date;

        $bpj = round($datediff / (60 * 60 * 24));
        $bpj_status = $periode - $bpj;
        return $bpj_status;
    }

    private function identity_type($id) {
        $type = array(
            '1' => 'NPWP',
            '2' => 'KTP',
            '3' => 'Paspor'
        );

        return isset($type[$id]) ? $type[$id] : '';
    }

    private function return_type($id) {
        $type = array(
            '1' => 'Diambil Sendiri',
            '2' => 'Transfer Bank',
            '3' => 'Sponsor'
        );

        return isset($type[$id]) ? $type[$id] : '';
    }

    public function change_status($header_id) {
        $this->db->set('status', 2);
        $this->db->where('id', $header_id);
        $this->db->where('status !=', 3);
        $this->db->update('import');
    }

    public function get_office() {
        return $this->db->get('office')->result_array();
    }

    public function get_package() {
        return $this->db->get('quantity_type')->result_array();
    }

    public function get_categories() {
        return $this->db->get('item_categories')->result_array();
    }

    public function search($params) {
        $this->db->select('A.id AS importID, A.doc_number, A.doc_date, A.name, A.passport,  A.status, A.periode
        ');
        $this->db->from('import A');
        // data not deleted
        $this->db->where('A.is_deleted', '0');
        // search parameter
        if (!empty($params['dateFrom'])) {
            $this->db->where('A.doc_date >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.doc_date <=', $params['dateUntil']);
        }
        if (!empty($params['docNumber'])) {
            // search by doc number / passenger name or origin country
            $this->db->group_start()
                ->like('A.doc_number', $params['docNumber'])
                ->or_like('A.name', $params['docNumber'])
                ->group_end();
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
                    'import' => $row['importID'],
                    'docNumber' => $row['doc_number'],
                    'docDate' => $row['doc_date'],
                    'name' => $row['name'],
                    'passport' => $row['passport'],
                    // 'flightNumber' => $row['flight_number'],
                    'status' => $row['status'],
                    'bpjStatus' => $this->bpj_status($row['doc_date'], $row['periode']),
                    'periode' => $row['periode']
                );
            } else {
                $result['nav']['last'] = FALSE;
				break;
            }
        }

        return $result;
    }

    public function create_new($params, $keys) {
        $return_status = TRUE;

        $this->db->trans_start();
        // insert header first
        $personal = $params['personal'];
        $this->db->set('name', $personal['name']);
        $this->db->set('doc_date', date('Y-m-d'));
        $this->db->set('identity_type', $personal['identityType']);
        $this->db->set('address', $personal['address']);
        $this->db->set('passport', $personal['identity']);
        $this->db->set('periode', $personal['periode']);
        $this->db->set('return_type', $personal['returnGuarantee']);
        $this->db->set('airport_in', $personal['airportIn']);
        $this->db->set('airport_out', $personal['airportOut']);
        $this->db->set('inv_number', $personal['invNumber']);
        $this->db->set('inv_date', $personal['invDate']);
        $this->db->set('inv_date_out', $personal['invDateOut']);
        $this->db->set('inv_number', $personal['invNumber']);
        $this->db->set('carrier_info', $personal['carrierName']);
        $this->db->set('officer_name', $_SESSION['users']['name']);
        $this->db->set('officer_nip', $_SESSION['users']['nip']);
        $this->db->insert('import');
        $header_id = $this->db->insert_id();

        // insert to table account
        $this->db->set('name', $personal['accountName']);
        $this->db->set('number', $personal['accountNumber']);
        $this->db->set('bank', $personal['accountBank']);
        $this->db->set('header_id', $header_id);
        $this->db->insert('import_account');

        // insert to table sponsor
        $this->db->set('name', $personal['sponsName']);
        $this->db->set('address', $personal['sponsAddress']);
        $this->db->set('phone', $personal['sponsPhone']);
        $this->db->set('identity_number', $personal['sponsNik']);
        $this->db->set('location', $personal['sponsLocation']);
        $this->db->set('reason', $personal['sponsReason']);
        $this->db->set('header_id', $header_id);
        $this->db->insert('import_sponsor');

        // insert to table guarantee
        $guarantee_number = $header_id . '/BPJ/KPU.03/' . date('Y');
        $guar = $params['guarantee'];
        $this->db->set('type', $guar['guaranteeType']);
        $this->db->set('name', $guar['guaranteeName']);
        $this->db->set('address', $guar['guaranteeAddress']);
        $this->db->set('nominal', $guar['guaranteeNominal']);
        $this->db->set('source', $guar['source']);
        $this->db->set('source_number', $guar['sourceNumber']);
        $this->db->set('source_date', $guar['sourceDate']);
        $this->db->set('treasurer_name', $guar['treasurerName']);
        $this->db->set('treasurer_nip', $guar['treasurerNip']);
        $this->db->set('doc_number', $guarantee_number);
        $this->db->set('header_id', $header_id);
        $this->db->insert('import_guarantee');

        // insert to items from temp
        $this->db->where('key_header', $keys['header']);
        $data_temp = $this->db->get('import_items_temp')->result_array();

        if (count($data_temp) > 0) {
            foreach ($data_temp as $val) {
                $this->db->set('name', $val['name']);
                $this->db->set('quantity', $val['quantity']);
                $this->db->set('bruto', $val['bruto']);
                $this->db->set('package_type', $val['package_type']);
                $this->db->set('description', $val['description']);
                $this->db->set('currency', $val['currency']);
                $this->db->set('kurs', $val['kurs']);
                $this->db->set('fob', $val['fob']);
                $this->db->set('freight', $val['freight']);
                $this->db->set('insurance', $val['insurance']);
                $this->db->set('cif', $val['cif']);
                $this->db->set('free', $val['free']);
                $this->db->set('fine_tax', $val['fine_tax']);
                $this->db->set('free_value', $val['free_value']);
                $this->db->set('free_currency', $val['free_currency']);
                $this->db->set('bm_tax', $val['bm_tax']);
                $this->db->set('ppn_tax', $val['ppn_tax']);
                $this->db->set('pph_tax', $val['pph_tax']);
                $this->db->set('ppnbm_tax', $val['ppnbm_tax']);
                $this->db->set('header_id', $header_id);
                $this->db->set('pos_code', $val['pos_code']);
                $this->db->set('pos_desc', $val['pos_desc']);
                $this->db->insert('import_items');

                $item_id = $this->db->insert_id();

                // insert items attachment from temp
                $this->db->where('key_item', $val['key_item']);
                $file_temp = $this->db->get('import_items_attachment_temp')->result_array();
                if (count($file_temp) > 0) {
                    $data_file = array();
                    foreach ($file_temp as $row) {
                        $data_file[] = array(
                            'name' => $row['name'],
                            'item_id' => $item_id
                        );
                    }

                    $insert_file = $this->db->insert_batch('import_items_attachment', $data_file);
                    if ($insert_file) {
                        // remove file temp after inserted
                        $this->db->where('key_item', $val['key_item']);
                        $this->db->delete('import_items_attachment_temp');
                    }
                }
            }
        }

        // remove items from temp after inserted
        $this->db->where('key_header', $keys['header']);
        $this->db->delete('import_items_temp');
        $increment_number =  $this->get_doc_number('import');
        $re_doc_number = $increment_number . '/BPJ/KPU.03/' . date('Y');
        $doc_number  = $increment_number . '/IS/KPU.03/' . date('Y');
        $this->db->where('id', $header_id);
        $this->db->set('re_doc_number', $re_doc_number);
        $this->db->set('doc_number', $doc_number);
        // set year & number
        $this->db->set('year_increment', date('Y'));
        $this->db->set('number_increment', $increment_number);
        $this->db->update('import');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
		{
			$return_status = FALSE;
		}

        return $return_status;
    }

    public function delete_item_temp($params) {
        $return = array();
        $this->db->where('id', $params['itemID']);
        $is_deleted = $this->db->delete('import_items_temp');

        if ($is_deleted) {
            $this->db->where('key_header', $params['keyHeader']);
            $return['data'] = $this->db->get('import_items_temp')->result_array();
        }
        return $return;
    }

    public function save_item_temp($val) {
        $result = array();
        $dataItems = array(
            'name' => $val['name'],
            'quantity' => $val['quantity'],
            'bruto' => $val['bruto'],
            'package_type' => $val['package'],
            'currency' => $val['currency'],
            'kurs' => $val['kurs'],
            'fob' => $val['fob'],
            'freight' => $val['freight'],
            'insurance' => $val['insurance'],
            'cif' => $val['cif'],
            'free' => $val['freeIDR'],
            'bm_tax' => $val['pabeanIn'],
            'ppn_tax' => $val['ppn'],
            'pph_tax' => $val['pph'],
            'ppnbm_tax' => $val['ppnbm'],
            'fine_tax' => $val['fine'],
            'free_value' => $val['free_value'],
            'free_currency' => $val['free_currency'],
            'key_header' => $val['keyHeader'],
            'key_item' => $val['keyItem'],
            'description' => $val['description'],
            'pos_code' => $val['posCode'],
            'pos_desc' => $val['posDesc']
        );
        $insert = $this->db->insert('import_items_temp', $dataItems);

        if ($insert) {
            $this->db->where('key_header', $val['keyHeader']);
            $result['data'] = $this->db->get('import_items_temp')->result_array();
        }
        
        return $result;
    }

    public function save_item_attachment_temp($fileName, $key) {
        $this->db->set('name', $fileName);
        $this->db->set('key_item', $key);
        $this->db->insert('import_items_attachment_temp');
    }

    public function save_import_attachments($fileName, $key) {
        $this->db->set('name', $fileName);
        $this->db->set('header_id', $key);
        $this->db->insert('import_reexport_attachments');
    }

    public function update_header($params) {
        // 0 = tidak sesuai, 1 = sesuai, 2 = jatuh tempo
        $this->db->set('re_notes', $params['notes']);
        $this->db->set('re_status', $params['key']);
        if($params['key'] == 1) {
            // $re_doc_number = $params['header'] . '/BPJ/KPU.03/' . date('Y');
            $this->db->set('re_office', $params['office']);
            $this->db->set('re_date', $params['date']);
            $this->db->set('re_name', $params['name']);
            // $this->db->set('re_doc_number', $re_doc_number);
        }  elseif($params['key'] == 2) {
            $this->db->set('re_date', $params['date']);
        }
        
        $this->db->set('status', '3');
        $this->db->where('id', $params['header']);
        return $this->db->update('import');
    }

    public function get_detail($header_id) {
        $result = array(
            'header' => array(),
            'items' => array(),
            'account' => array(),
            'sponsor' => array()
        );
        
        $this->db->select('A.doc_number, A.identity_type, A.doc_date, A.name, A.address, A.passport, A.periode, A.inv_number,
            A.return_type, B.name AS airport_in, C.name AS airport_out, A.inv_date, A.carrier_info, A.periode, A.inv_date_out
        ');
        $this->db->from('import A');
        $this->db->join('office B', 'A.airport_in = B.id');
        $this->db->join('office C', 'A.airport_out = C.id');
        $this->db->where('A.id', $header_id);
        $data_header = $this->db->get()->row_array();
        $header = array(
            'doc' => $data_header['doc_number'],
            'identity_type' => $this->identity_type($data_header['identity_type']),
            'doc_date' => $data_header['doc_date'],
            'name' => $data_header['name'],
            'address' => $data_header['address'],
            'identity_number' => $data_header['passport'],
            'periode' => $data_header['periode'],
            'return_type' => $this->return_type($data_header['return_type']),
            'airport_in' => $data_header['airport_in'],
            'airport_out' => $data_header['airport_out'],
            'inv_number' => $data_header['inv_number'],
            'inv_date' => $data_header['inv_date'],
            'carrier' => $data_header['carrier_info'],
            'periode' => $data_header['periode'],
            'date_out' => date('d M Y', strtotime($data_header['inv_date_out']))
        );
        // account
        $this->db->select('name, number, bank');
        $this->db->where('header_id', $header_id);
        $account = $this->db->get('import_account')->row_array();

        $this->db->select('A.id AS item_id, A.name, A.quantity, A.bruto, A.description, B.name AS package, A.kurs, A.bm_tax,
            A.cif, A.free, A.ppn_tax, A.pph_tax, A.ppnbm_tax, A.fob, A.freight, A.insurance, A.currency
        ');
        $this->db->from('import_items A');
        $this->db->join('quantity_type B', 'A.package_type = B.id');
        $this->db->where('A.header_id', $header_id);
        $data_items = $this->db->get()->result_array();
        $items = array();
        $items_key = array();
        foreach ($data_items as $val) {
            // nilai barang is cif * kurs
            $pabean_value = round($val['cif'] * $val['kurs']);
            $free = $val['free'];
            // nilai pabean = nilai paben - pembebasan
            $multiplier = $pabean_value - $free;
            
        
            $bmIdr = ceil(((($multiplier * $val['bm_tax']) / 100) / 1000)) * 1000;
            // echo $bmIdr; exit();
            $ppnIdr = ceil((((($multiplier + $bmIdr) * $val['ppn_tax']) / 100) / 1000)) * 1000;
            $ppnbmIdr = ceil((((($multiplier + $bmIdr) * $val['ppnbm_tax']) / 100) / 1000)) * 1000;
            $pphIdr = ceil((((($multiplier + $bmIdr) * $val['pph_tax']) / 100) / 1000)) * 1000;
            
            $items_key[] = $val['item_id'];

            $items[$val['item_id']] = array(
                'item' => $val['item_id'],
                'name' => $val['name'],
                'qty' => $val['quantity'],
                'bruto' => $val['bruto'],
                'desc' => $val['description'],
                'type' => $val['package'],
                'itemValue' => setIdr($pabean_value),
                'cif' => $val['cif'],
                'currency' => $val['currency'],
                'hs' => 'BM: ' . $val['bm_tax'] . '%, PPn: ' . $val['ppn_tax'] . '%, PPnbm: ' . $val['ppnbm_tax'] . '%, PPh: ' . $val['pph_tax'] . '%',
                'bmIdr' => setIDR($bmIdr), 'ppnIdr' => setIDR($ppnIdr), 'ppnbmIdr' => setIDR($ppnbmIdr), 'pphIdr' => setIDR($pphIdr),
                'total' => setIDR($bmIdr + $ppnIdr + $ppnbmIdr + $pphIdr),
                'attachments' => array()
            );
        }
        // get attachments
        if (count($items) > 0) {
            $this->db->where_in('item_id', $items_key);
            $attachs = $this->db->get('import_items_attachment')->result_array();
            
            foreach($attachs as $val) {
                $items[$val['item_id']]['attachments'][] = array(
                    'name' => $val['name']
                );
            }
        }

        // get sponsor
        $this->db->select('location, reason');
        $this->db->where('header_id', $header_id);
        $sponsor = $this->db->get('import_sponsor')->row_array();


        $result['header'] = $header;
        $result['items'] = array_values($items);
        $result['account'] = $account;
        $result['sponsor'] = $sponsor;
        return $result;
    }

    public function get_data_print($header_id) {
        $data = array();
        $this->db->select('A.doc_number, A.identity_type, A.doc_date, A.name, A.address, A.passport, A.officer_name, A.officer_nip,
            A.carrier_info, B.name AS airport_in, C.name AS airport_out, A.return_type, A.created_at, A.inv_date_out, A.re_doc_number,
            A.periode, A.inv_number, A.inv_date
        ');
        $this->db->from('import A');
        $this->db->join('office B', 'A.airport_in = B.id');
        $this->db->join('office C', 'A.airport_out = C.id');    
        $this->db->where('A.id', $header_id);
        $data['header'] = $this->db->get()->row();

        // get guarantee
        $this->db->select('type, name, address, nominal, treasurer_name, treasurer_nip, doc_number, source, source_number, source_date');
        $this->db->where('header_id', $header_id);
        $data['warrant'] = $this->db->get('import_guarantee')->row();
        
        // get account
        $this->db->select('name, number, bank');
        $this->db->where('header_id', $header_id);
        $data['account'] = $this->db->get('import_account')->row();

        // get sponsor
        $this->db->select('name, address, phone, identity_number, location, reason');
        $this->db->where('header_id', $header_id);
        $data['sponsor'] = $this->db->get('import_sponsor')->row();

        $this->db->select('A.*, B.name AS package_name');
        $this->db->from('import_items A');
        $this->db->join('quantity_type B', 'A.package_type =  B.id');
        $this->db->where('A.header_id', $header_id);
        $items = $this->db->get()->result_array();
        // restructure data import
        $items_array = array();
        $bpj = array();
        $bm = 0;
        $ppn = 0;
        $ppnbm = 0;
        $pph = 0;
        $total = 0;
        $bmtax = '';
        $ppntax = '';
        $ppnbmtax = '';
        $pphtax = '';
        $name = '';
        $last = count($items);
        $separator = ', ';
        foreach ($items as $index => $val) {
            if ($index == ($last - 1)) {
                $separator = '';
            }
            $pabean_value = round($val['cif'] * $val['kurs']);
            $free = $val['free'];
            // nilai pabean = nilai paben - pembebasan
            $multiplier = $pabean_value - $free;
            
        
            $bmIdr = ceil(((($multiplier * $val['bm_tax']) / 100) / 1000)) * 1000;
            // echo $bmIdr; exit();
            $ppnIdr = ceil((((($multiplier + $bmIdr) * $val['ppn_tax']) / 100) / 1000)) * 1000;
            $ppnbmIdr = ceil((((($multiplier + $bmIdr) * $val['ppnbm_tax']) / 100) / 1000)) * 1000;
            $pphIdr = ceil((((($multiplier + $bmIdr) * $val['pph_tax']) / 100) / 1000)) * 1000;
            
            $name .=  $val['name'] . $separator;
            // set total
            $bmtax .= $val['bm_tax'] . $separator;
            $ppntax .= $val['ppn_tax'] . $separator;
            $ppnbmtax .= $val['ppnbm_tax'] . $separator;
            $pphtax .= $val['pph_tax'] . $separator;
            $bm += $bmIdr;
            $ppn += $ppnIdr;
            $ppnbm += $ppnbmIdr;
            $pph += $pphIdr;
            $total = $bm + $ppn + $ppnbm + $pph; 
            $bpj = array(
                'desc' => $name, 'bmtax' => $bmtax, 'ppntax' => $ppntax, 'ppnbmtax' => $ppnbmtax, 'pphtax' => $pphtax,
                'bm' => $bm, 'ppn' => $ppn, 'ppnbm' => $ppnbm, 'pph' => $pph, 'total' => $total, 'code' => $val['pos_code']
            );

            $items_array[] = array(
                'desc' => $val['quantity'] . ' ' . $val['name'],
                'quantity' => $val['quantity'],
                'package' => $val['package_name'],
                'name' => $val['name'],
                'description' => $val['description'],
                'kurs' => $val['kurs'],
                'fob' => $val['fob'],
                'freight' => $val['freight'],
                'currency' => $val['currency'],
                'insurance' => $val['insurance'],
                'pabean_value' => setIDR($multiplier),
                'code' => $val['pos_code'],
                'hs' => $val['pos_code'] . '<br />' . 'BM: ' . $val['bm_tax'] . '%, PPn: ' . $val['ppn_tax'] . '%, PPnbm: ' . $val['ppnbm_tax'] . '%, PPh: ' . $val['pph_tax'] . '%',
                'bmIdr' => setIDR($bmIdr), 'ppnIdr' => setIDR($ppnIdr), 'ppnbmIdr' => setIDR($ppnbmIdr), 'pphIdr' => setIDR($pphIdr),
                'total' => setIDR($bmIdr + $ppnIdr + $ppnbmIdr + $pphIdr)
            );
        }
        $data['items'] = $items_array;
        $data['bpj'] = $bpj;
        return $data;
    }  

    public function get_data_return($header_id) {
        $data = array();
        $this->db->select('A.name, A.passport, B.nominal, A.officer_name, A.re_doc_number, A.re_name, A.re_date');
        $this->db->from('import A');
        $this->db->join('import_guarantee B', 'A.id = B.header_id');
        $this->db->where('A.id', $header_id);
        $data['header'] = $this->db->get()->row_array();

        // get items
        $this->db->select('name, bruto');
        $this->db->from('import_items');
        $this->db->where('header_id', $header_id);
        $items = array();
        $items = $this->db->get()->result_array();
        $stringName = '';
        $stringBruto = 0;
        foreach($items as $index => $val) {
            $separator = ', ';
            if ($index == (count($items) - 1)) {
                $separator = '';
            }

            $stringName .= $val['name'] . $separator;
            $stringBruto += $val['bruto'];
        }

        $data['items'] = array(
            'name' => $stringName, 'bruto' => $stringBruto
        );

        return $data;
    }

}