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

    public function search_monitoring($params) {
        if (!is_array($params)) {
            $params = array();
        }
        $page = isset($params['page']) ? (int) $params['page'] : 1;
        if ($page < 1) $page = 1;

        $bpjExpr = $this->bpj_remain_expr();

        $this->db->select('A.id AS importID, A.doc_number, A.doc_date, A.name, A.passport, A.status, A.periode, A.email');
        $this->db->from('import A');
        $this->db->where('A.is_deleted', '0');
        $this->db->where('A.status !=', '3');

        if (!empty($params['dateFrom'])) {
            $this->db->where('A.doc_date >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.doc_date <=', $params['dateUntil']);
        }
        if (!empty($params['docNumber'])) {
            $this->db->like('A.doc_number', $params['docNumber']);
        }
        if (!empty($params['name'])) {
            $this->db->like('A.name', $params['name']);
        }
        if (!empty($params['passport'])) {
            $this->db->like('A.passport', $params['passport']);
        }
        if (isset($params['periode']) && $params['periode'] !== '') {
            if (is_numeric($params['periode'])) {
                $this->db->where('A.periode', $params['periode']);
            } else {
                $this->db->like('A.periode', $params['periode']);
            }
        }
        if (isset($params['status']) && $params['status'] !== '' && (string) $params['status'] !== '3') {
            $this->db->where('A.status', $params['status']);
        }
        $bpjDays = isset($params['bpjDays']) ? $params['bpjDays'] : '';
        $bpjOp = isset($params['bpjOp']) ? $params['bpjOp'] : '';
        $ops = array(
            'lt' => '<',
            'lte' => '<=',
            'gte' => '>=',
            'gt' => '>'
        );
        if ($bpjOp !== '' && isset($ops[$bpjOp]) && $bpjDays !== '' && is_numeric($bpjDays)) {
            $this->db->where($bpjExpr . ' ' . $ops[$bpjOp] . ' ' . (int) $bpjDays, null, false);
        }
        if (isset($params['bpjStatus']) && $params['bpjStatus'] !== '' && is_numeric($params['bpjStatus'])) {
            $this->db->where($bpjExpr . ' = ' . (int) $params['bpjStatus'], null, false);
        }
        $this->apply_headline_bucket(isset($params['headline']) ? $params['headline'] : '', $bpjExpr);

        $sortMap = array(
            'doc_date' => 'A.doc_date',
            'periode' => 'A.periode',
            'bpjStatus' => $bpjExpr
        );
        $sortBy = $bpjExpr;
        $sortDir = 'ASC';
        if (!empty($params['sortBy']) && isset($sortMap[$params['sortBy']])) {
            $sortBy = $sortMap[$params['sortBy']];
            if (!empty($params['sortDir'])) {
                $sortDir = (strtoupper($params['sortDir']) === 'DESC') ? 'DESC' : 'ASC';
            }
        }
        $this->db->order_by($sortBy, $sortDir, false);

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit + 1);
        $this->db->offset($offset);

        $result = array(
            'rows' => array(),
            'nav' => array(
                'page' => $page,
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
                    'status' => $row['status'],
                    'bpjStatus' => $this->bpj_status($row['doc_date'], $row['periode']),
                    'periode' => $row['periode'],
                    'email' => isset($row['email']) ? $row['email'] : ''
                );
            } else {
                $result['nav']['last'] = FALSE;
                break;
            }
        }

        return $result;
    }

    private function bpj_remain_expr() {
        return '(A.periode - DATEDIFF(CURDATE(), A.doc_date))';
    }

    private function apply_headline_bucket($headline, $bpjExpr) {
        if ($headline === 'overdue') {
            $this->db->where($bpjExpr . ' <= 0', null, false);
        } elseif ($headline === 'd7') {
            $this->db->where($bpjExpr . ' >= 1', null, false);
            $this->db->where($bpjExpr . ' <= 7', null, false);
        } elseif ($headline === 'd30') {
            $this->db->where($bpjExpr . ' >= 8', null, false);
            $this->db->where($bpjExpr . ' <= 30', null, false);
        }
    }

    public function monitoring_headline_counts() {
        $expr = $this->bpj_remain_expr();
        $this->db->select('SUM(CASE WHEN ' . $expr . ' <= 0 THEN 1 ELSE 0 END) AS overdue', FALSE);
        $this->db->select('SUM(CASE WHEN ' . $expr . ' >= 1 AND ' . $expr . ' <= 7 THEN 1 ELSE 0 END) AS d7', FALSE);
        $this->db->select('SUM(CASE WHEN ' . $expr . ' >= 8 AND ' . $expr . ' <= 30 THEN 1 ELSE 0 END) AS d30', FALSE);
        $this->db->from('import A');
        $this->db->where('A.is_deleted', '0');
        $this->db->where('A.status !=', '3');
        $row = $this->db->get()->row_array();
        return array(
            'overdue' => $row && isset($row['overdue']) ? (int) $row['overdue'] : 0,
            'd7' => $row && isset($row['d7']) ? (int) $row['d7'] : 0,
            'd30' => $row && isset($row['d30']) ? (int) $row['d30'] : 0
        );
    }

    public function get_first_doc_date() {
        $this->db->select_min('doc_date');
        $this->db->where('is_deleted', '0');
        $this->db->where('doc_date IS NOT NULL', null, false);
        $this->db->where('doc_date !=', '0000-00-00');
        $row = $this->db->get('import')->row_array();
        if ($row && !empty($row['doc_date'])) {
            return $row['doc_date'];
        }
        return date('Y-m-d');
    }

    public function monitoring_summary_counts($dateFrom = '', $dateUntil = '') {
        $this->db->select('COUNT(A.id) AS total', FALSE);
        $this->db->select('SUM(CASE WHEN A.status != \'3\' THEN 1 ELSE 0 END) AS active', FALSE);
        $this->db->select('SUM(CASE WHEN A.status = \'3\' AND A.re_status = \'1\' THEN 1 ELSE 0 END) AS reekspor', FALSE);
        $this->db->select('SUM(CASE WHEN A.status = \'3\' AND A.re_status IN (\'0\', \'2\') THEN 1 ELSE 0 END) AS jaminanCount', FALSE);
        $this->db->from('import A');
        $this->db->where('A.is_deleted', '0');
        if ($dateFrom !== '') {
            $this->db->where('A.doc_date >=', $dateFrom);
        }
        if ($dateUntil !== '') {
            $this->db->where('A.doc_date <=', $dateUntil);
        }
        $row = $this->db->get()->row_array();

        $this->db->select('COALESCE(SUM(G.nominal), 0) AS jaminanValue', FALSE);
        $this->db->from('import A');
        $this->db->join('import_guarantee G', 'A.id = G.header_id', 'inner');
        $this->db->where('A.is_deleted', '0');
        $this->db->where('A.status', '3');
        $this->db->where_in('A.re_status', array('0', '2'));
        if ($dateFrom !== '') {
            $this->db->where('A.doc_date >=', $dateFrom);
        }
        if ($dateUntil !== '') {
            $this->db->where('A.doc_date <=', $dateUntil);
        }
        $guar = $this->db->get()->row_array();

        return array(
            'total' => $row && isset($row['total']) ? (int) $row['total'] : 0,
            'active' => $row && isset($row['active']) ? (int) $row['active'] : 0,
            'reekspor' => $row && isset($row['reekspor']) ? (int) $row['reekspor'] : 0,
            'jaminanCount' => $row && isset($row['jaminanCount']) ? (int) $row['jaminanCount'] : 0,
            'jaminanValue' => $guar && isset($guar['jaminanValue']) ? (float) $guar['jaminanValue'] : 0,
            'dateFrom' => $dateFrom,
            'dateUntil' => $dateUntil,
            'defaultDateFrom' => '2020-01-01'
        );
    }

    public function search_reekspor($params) {
        if (!is_array($params)) {
            $params = array();
        }
        $page = isset($params['page']) ? (int) $params['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }

        $this->db->select('A.id AS importID, A.doc_number, A.doc_date, A.name, A.passport, A.re_date, A.re_doc_number, A.re_name, B.name AS re_office_name');
        $this->db->from('import A');
        $this->db->join('office B', 'A.re_office = B.id', 'left');
        $this->db->where('A.is_deleted', '0');
        $this->db->where('A.status', '3');
        $this->db->where('A.re_status', '1');

        if (!empty($params['dateFrom'])) {
            $this->db->where('A.doc_date >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.doc_date <=', $params['dateUntil']);
        }
        if (!empty($params['docNumber'])) {
            $this->db->like('A.doc_number', $params['docNumber']);
        }
        if (!empty($params['name'])) {
            $this->db->like('A.name', $params['name']);
        }
        if (!empty($params['passport'])) {
            $this->db->like('A.passport', $params['passport']);
        }
        if (!empty($params['reDate'])) {
            $this->db->like('A.re_date', $params['reDate']);
        }
        if (!empty($params['reDocNumber'])) {
            $this->db->like('A.re_doc_number', $params['reDocNumber']);
        }
        if (!empty($params['reOffice'])) {
            $this->db->like('B.name', $params['reOffice']);
        }

        $sortMap = array(
            'doc_date' => 'A.doc_date',
            'doc_number' => 'A.doc_number',
            'name' => 'A.name',
            'passport' => 'A.passport',
            're_date' => 'A.re_date',
            're_doc_number' => 'A.re_doc_number'
        );
        $sortBy = 'A.doc_date';
        $sortDir = 'ASC';
        if (!empty($params['sortBy']) && isset($sortMap[$params['sortBy']])) {
            $sortBy = $sortMap[$params['sortBy']];
            if (!empty($params['sortDir'])) {
                $sortDir = (strtoupper($params['sortDir']) === 'DESC') ? 'DESC' : 'ASC';
            }
        }
        $this->db->order_by($sortBy, $sortDir);

        $limit = 15;
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit + 1);
        $this->db->offset($offset);

        $result = array(
            'rows' => array(),
            'nav' => array('page' => $page, 'last' => TRUE)
        );
        foreach ($this->db->get()->result_array() as $index => $row) {
            if ($index < $limit) {
                $result['rows'][$index] = array(
                    'import' => $row['importID'],
                    'docNumber' => $row['doc_number'],
                    'docDate' => $row['doc_date'],
                    'name' => $row['name'],
                    'passport' => $row['passport'],
                    'reDate' => $row['re_date'],
                    'reDocNumber' => $row['re_doc_number'],
                    'reName' => $row['re_name'],
                    'reOffice' => $row['re_office_name']
                );
            } else {
                $result['nav']['last'] = FALSE;
                break;
            }
        }
        return $result;
    }

    public function search_jaminan_definitif($params) {
        if (!is_array($params)) {
            $params = array();
        }
        $page = isset($params['page']) ? (int) $params['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }

        $this->db->select('A.id AS importID, A.doc_number, A.doc_date, A.name, G.doc_number AS bpj_number, G.nominal');
        $this->db->from('import A');
        $this->db->join('import_guarantee G', 'A.id = G.header_id', 'inner');
        $this->db->where('A.is_deleted', '0');
        $this->db->where('A.status', '3');
        $this->db->where_in('A.re_status', array('0', '2'));

        if (!empty($params['dateFrom'])) {
            $this->db->where('A.doc_date >=', $params['dateFrom']);
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('A.doc_date <=', $params['dateUntil']);
        }
        if (!empty($params['bpjNumber'])) {
            $this->db->like('G.doc_number', $params['bpjNumber']);
        }
        if (!empty($params['docNumber'])) {
            $this->db->like('A.doc_number', $params['docNumber']);
        }
        if (!empty($params['name'])) {
            $this->db->like('A.name', $params['name']);
        }
        if (isset($params['nominal']) && $params['nominal'] !== '') {
            $this->db->like('G.nominal', $params['nominal']);
        }

        $sortMap = array(
            'doc_date' => 'A.doc_date',
            'doc_number' => 'A.doc_number',
            'bpj_number' => 'G.doc_number',
            'name' => 'A.name',
            'nominal' => 'G.nominal'
        );
        $sortBy = 'A.doc_date';
        $sortDir = 'ASC';
        if (!empty($params['sortBy']) && isset($sortMap[$params['sortBy']])) {
            $sortBy = $sortMap[$params['sortBy']];
            if (!empty($params['sortDir'])) {
                $sortDir = (strtoupper($params['sortDir']) === 'DESC') ? 'DESC' : 'ASC';
            }
        }
        $this->db->order_by($sortBy, $sortDir);

        $limit = 15;
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit + 1);
        $this->db->offset($offset);

        $result = array(
            'rows' => array(),
            'nav' => array('page' => $page, 'last' => TRUE)
        );
        foreach ($this->db->get()->result_array() as $index => $row) {
            if ($index < $limit) {
                $result['rows'][$index] = array(
                    'import' => $row['importID'],
                    'bpjNumber' => $row['bpj_number'],
                    'docNumber' => $row['doc_number'],
                    'docDate' => $row['doc_date'],
                    'name' => $row['name'],
                    'nominal' => $row['nominal']
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
        if (isset($personal['email'])) {
            $this->db->set('email', $personal['email']);
        }
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
            'bm_tax' => 10,
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

    private function encrypt_secret($plain) {
        if ($plain === '' || $plain === NULL) {
            return '';
        }
        $this->load->library('encryption');
        $encoded = $this->encryption->encrypt($plain);
        return $encoded ? $encoded : $plain;
    }

    private function decrypt_secret($cipher) {
        if ($cipher === '' || $cipher === NULL) {
            return '';
        }
        $this->load->library('encryption');
        $plain = $this->encryption->decrypt($cipher);
        if ($plain === FALSE) {
            return $cipher;
        }
        return $plain;
    }

    public function get_smtp_setting($include_password = FALSE) {
        $row = $this->db->get('import_smtp_setting')->row_array();
        if (!$row) {
            return array(
                'host' => '',
                'port' => '',
                'crypto' => '',
                'user' => '',
                'fromEmail' => '',
                'fromName' => '',
                'testEmail' => '',
                'hasPassword' => FALSE
            );
        }

        $data = array(
            'host' => $row['host'],
            'port' => $row['port'] ? (string) $row['port'] : '',
            'crypto' => $row['crypto'],
            'user' => $row['username'],
            'fromEmail' => $row['from_email'],
            'fromName' => $row['from_name'],
            'testEmail' => $row['test_email'],
            'hasPassword' => ($row['password'] !== '' && $row['password'] !== NULL)
        );
        if ($include_password) {
            $data['pass'] = $this->decrypt_secret($row['password']);
        }
        return $data;
    }

    public function get_notif_formats() {
        $this->ensure_default_notif_format();
        $this->db->order_by("CASE WHEN send_when = 'default' THEN 0 ELSE 1 END", 'ASC', FALSE);
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rows = $this->db->get('import_notif_format')->result_array();
        $formats = array();
        foreach ($rows as $row) {
            $formats[] = array(
                'id' => (int) $row['id'],
                'sendWhen' => (string) $row['send_when'],
                'subject' => $row['subject'],
                'body' => $row['body']
            );
        }
        return $formats;
    }

    public function notification_placeholder_map($row = NULL) {
        $map = array(
            '{nama}' => 'Nama Penumpang',
            '{email}' => 'penumpang@contoh.com',
            '{nomor}' => '1/IS/KPU.03/2026',
            '{tanggal}' => date('Y-m-d'),
            '{paspor}' => 'C1234567',
            '{periode}' => '90',
            '{jatuh_tempo}' => date('Y-m-d', strtotime('+90 days')),
            '{sisa_hari}' => '7',
            '{status}' => 'Created'
        );
        if (!is_array($row) || empty($row)) {
            return $map;
        }

        $docDate = isset($row['doc_date']) ? $row['doc_date'] : '';
        $periode = isset($row['periode']) ? (int) $row['periode'] : 0;
        $due = ($docDate !== '' && $periode > 0) ? date('Y-m-d', strtotime($docDate . ' +' . $periode . ' days')) : '';
        $remain = '';
        if ($docDate !== '' && $periode > 0) {
            $remain = (string) $this->bpj_status($docDate, $periode);
        }
        $statusLabel = array('1' => 'Created', '2' => 'Open', '3' => 'Closed');
        $status = isset($row['status']) && isset($statusLabel[$row['status']]) ? $statusLabel[$row['status']] : '';

        $map['{nama}'] = isset($row['name']) ? $row['name'] : '';
        $map['{email}'] = isset($row['email']) ? $row['email'] : '';
        $map['{nomor}'] = isset($row['doc_number']) ? $row['doc_number'] : '';
        $map['{tanggal}'] = $docDate;
        $map['{paspor}'] = isset($row['passport']) ? $row['passport'] : '';
        $map['{periode}'] = $periode ? (string) $periode : '';
        $map['{jatuh_tempo}'] = $due;
        $map['{sisa_hari}'] = $remain;
        $map['{status}'] = $status;
        return $map;
    }

    public function apply_notification_placeholders($text, $map, $as_html = TRUE) {
        if ($text === NULL || $text === '') {
            return '';
        }
        if (!is_array($map)) {
            $map = $this->notification_placeholder_map();
        }
        $values = array();
        foreach ($map as $key => $value) {
            $value = (string) $value;
            $values[$key] = $as_html ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
        }
        return str_replace(array_keys($values), array_values($values), $text);
    }

    public function save_setting($params) {
        if (!is_array($params)) {
            $params = array();
        }

        $smtp = isset($params['smtp']) && is_array($params['smtp']) ? $params['smtp'] : NULL;
        $formats = isset($params['formats']) && is_array($params['formats']) ? $params['formats'] : NULL;
        $hasTestEmail = array_key_exists('testEmail', $params);
        $testEmail = $hasTestEmail ? trim($params['testEmail']) : '';
        $allowedWhen = array('default', '0', '1', '2', '3', '4', '5', '6', '7', 'created', 'overdue', 'closed');
        $allowedCrypto = array('', 'tls', 'ssl');

        $this->db->trans_start();

        $existing = $this->db->get('import_smtp_setting')->row_array();
        if ($smtp !== NULL || $hasTestEmail) {
            if ($smtp !== NULL) {
                $host = isset($smtp['host']) ? trim($smtp['host']) : '';
                $port = isset($smtp['port']) && $smtp['port'] !== '' ? (int) $smtp['port'] : NULL;
                $crypto = isset($smtp['crypto']) ? $smtp['crypto'] : '';
                if (!in_array($crypto, $allowedCrypto, TRUE)) {
                    $crypto = '';
                }
                $user = isset($smtp['user']) ? trim($smtp['user']) : '';
                $pass = isset($smtp['pass']) ? $smtp['pass'] : '';
                $fromEmail = isset($smtp['fromEmail']) ? trim($smtp['fromEmail']) : '';
                $fromName = isset($smtp['fromName']) ? trim($smtp['fromName']) : '';

                $this->db->set('host', $host);
                $this->db->set('port', $port);
                $this->db->set('crypto', $crypto);
                $this->db->set('username', $user);
                $this->db->set('from_email', $fromEmail);
                $this->db->set('from_name', $fromName);
                if ($pass !== '') {
                    $this->db->set('password', $this->encrypt_secret($pass));
                } elseif (!$existing) {
                    $this->db->set('password', '');
                }
            }
            if ($hasTestEmail) {
                $this->db->set('test_email', $testEmail);
            }
            $this->db->set('updated_at', date('Y-m-d H:i:s'));
            if ($existing) {
                $this->db->where('id', $existing['id']);
                $this->db->update('import_smtp_setting');
            } else {
                $this->db->insert('import_smtp_setting');
            }
        }

        if ($formats !== NULL) {
            $keptDefault = $this->get_default_notif_format(FALSE);
            $this->db->empty_table('import_notif_format');
            $order = 0;
            $hasDefault = FALSE;
            foreach ($formats as $format) {
                if (!is_array($format)) {
                    continue;
                }
                $when = isset($format['sendWhen']) ? (string) $format['sendWhen'] : '';
                $subject = isset($format['subject']) ? trim($format['subject']) : '';
                $body = isset($format['body']) ? $format['body'] : '';
                if ($when === '' && $subject === '' && trim(strip_tags($body)) === '') {
                    continue;
                }
                if (!in_array($when, $allowedWhen, TRUE)) {
                    continue;
                }
                if ($when === 'default') {
                    if ($hasDefault) {
                        continue;
                    }
                    $hasDefault = TRUE;
                    $orderInsert = 0;
                } else {
                    $order++;
                    $orderInsert = $order;
                }
                $this->db->set('send_when', $when);
                $this->db->set('subject', $subject);
                $this->db->set('body', $body);
                $this->db->set('sort_order', $orderInsert);
                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->insert('import_notif_format');
            }
            if (!$hasDefault) {
                $this->insert_default_notif_format($keptDefault);
            }
        }

        $this->db->trans_complete();

        return array(
            'status' => $this->db->trans_status(),
            'smtp' => $this->get_smtp_setting(FALSE),
            'formats' => $this->get_notif_formats()
        );
    }

    public function get_import_row($id) {
        $id = (int) $id;
        if ($id < 1) {
            return NULL;
        }
        $this->db->where('id', $id);
        $this->db->where('is_deleted', '0');
        $row = $this->db->get('import')->row_array();
        return $row ? $row : NULL;
    }

    public function default_notif_seed() {
        return array(
            'sendWhen' => 'default',
            'subject' => 'Pengingat Impor Sementara {nomor}',
            'body' => '<p>Yth. {nama},</p><p>Dokumen Impor Sementara <strong>{nomor}</strong> tanggal {tanggal} (paspor {paspor}) memiliki jangka waktu {periode} hari.</p><p>Jatuh tempo: <strong>{jatuh_tempo}</strong> (sisa {sisa_hari} hari).</p><p>Status saat ini: {status}.</p><p>Mohon segera ditindaklanjuti.</p>'
        );
    }

    public function get_default_notif_format($ensure = TRUE) {
        if ($ensure) {
            $this->ensure_default_notif_format();
        }
        if (!$this->db->table_exists('import_notif_format')) {
            return NULL;
        }
        $this->db->where('send_when', 'default');
        $this->db->order_by('id', 'ASC');
        $row = $this->db->get('import_notif_format')->row_array();
        if (!$row) {
            return NULL;
        }
        return array(
            'id' => (int) $row['id'],
            'sendWhen' => 'default',
            'subject' => $row['subject'],
            'body' => $row['body']
        );
    }

    public function ensure_default_notif_format() {
        if (!$this->db->table_exists('import_notif_format')) {
            return FALSE;
        }
        $this->db->where('send_when', 'default');
        $existing = $this->db->get('import_notif_format')->row_array();
        if ($existing) {
            return TRUE;
        }
        return $this->insert_default_notif_format(NULL);
    }

    private function insert_default_notif_format($source) {
        if (!$this->db->table_exists('import_notif_format')) {
            return FALSE;
        }
        $seed = $this->default_notif_seed();
        $subject = (is_array($source) && !empty($source['subject'])) ? $source['subject'] : $seed['subject'];
        $body = (is_array($source) && isset($source['body'])) ? $source['body'] : $seed['body'];
        $this->db->set('send_when', 'default');
        $this->db->set('subject', $subject);
        $this->db->set('body', $body);
        $this->db->set('sort_order', 0);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        return $this->db->insert('import_notif_format');
    }

    public function remaining_days($doc_date, $periode) {
        return $this->bpj_status($doc_date, $periode);
    }

    public function send_when_label($when) {
        $map = array(
            '0' => 'Saat jatuh tempo',
            '1' => '1 hari sebelum JT',
            '2' => '2 hari sebelum JT',
            '3' => '3 hari sebelum JT',
            '4' => '4 hari sebelum JT',
            '5' => '5 hari sebelum JT',
            '6' => '6 hari sebelum JT',
            '7' => '7 hari sebelum JT',
            'created' => 'Saat status Open (cetak Form IS)',
            'open' => 'Saat status Open (cetak Form IS)',
            'overdue' => 'Lewat jatuh tempo',
            'closed' => 'Saat Closed',
            'default' => 'Template default (lonceng)'
        );
        $when = (string) $when;
        return isset($map[$when]) ? $map[$when] : $when;
    }

    public function resolve_notif_format($row) {
        $formats = $this->get_notif_formats();
        if (empty($formats)) {
            return NULL;
        }

        $remain = 0;
        if (isset($row['doc_date']) && isset($row['periode'])) {
            $remain = (int) $this->bpj_status($row['doc_date'], $row['periode']);
        }
        $status = isset($row['status']) ? (string) $row['status'] : '';
        $when = '';
        if ($status === '3') {
            $when = 'closed';
        } elseif ($remain < 0) {
            $when = 'overdue';
        } elseif ($remain >= 0 && $remain <= 7) {
            $when = (string) $remain;
        } elseif ($status === '1') {
            $when = 'created';
        }

        foreach ($formats as $format) {
            if ((string) $format['sendWhen'] === $when) {
                $format['matchedWhen'] = $when;
                return $format;
            }
        }

        $formats[0]['matchedWhen'] = $when !== '' ? $when : $formats[0]['sendWhen'];
        return $formats[0];
    }

    public function get_notif_format_by_when($when) {
        if (!$this->db->table_exists('import_notif_format')) {
            return NULL;
        }
        $try = array($when);
        if ($when === 'created' || $when === 'open') {
            $try = array('open', 'created');
        }
        foreach ($try as $hook) {
            $this->db->where('send_when', $hook);
            $this->db->order_by('id', 'ASC');
            $row = $this->db->get('import_notif_format')->row_array();
            if ($row) {
                return array(
                    'id' => (int) $row['id'],
                    'sendWhen' => (string) $row['send_when'],
                    'subject' => $row['subject'],
                    'body' => $row['body']
                );
            }
        }
        return NULL;
    }

    public function has_successful_notif($import_id, $hooks) {
        if (!$this->db->table_exists('import_notif_log')) {
            return FALSE;
        }
        $import_id = (int) $import_id;
        if ($import_id < 1 || empty($hooks) || !is_array($hooks)) {
            return FALSE;
        }
        $this->db->where('import_id', $import_id);
        $this->db->where('status', 'success');
        $this->db->where_in('send_when', $hooks);
        return $this->db->count_all_results('import_notif_log') > 0;
    }

    public function insert_notif_log($data) {
        if (!$this->db->table_exists('import_notif_log')) {
            return FALSE;
        }
        if (!is_array($data)) {
            $data = array();
        }
        $this->db->set('import_id', !empty($data['import_id']) ? (int) $data['import_id'] : NULL);
        $this->db->set('format_id', !empty($data['format_id']) ? (int) $data['format_id'] : NULL);
        $this->db->set('send_when', isset($data['send_when']) ? $data['send_when'] : NULL);
        $this->db->set('email', isset($data['email']) ? $data['email'] : NULL);
        $this->db->set('subject', isset($data['subject']) ? $data['subject'] : NULL);
        $this->db->set('status', isset($data['status']) ? $data['status'] : NULL);
        $this->db->set('message', isset($data['message']) ? $data['message'] : NULL);
        $this->db->set('sent_at', date('Y-m-d H:i:s'));
        return $this->db->insert('import_notif_log');
    }

    public function search_notif_log($params) {
        $result = array(
            'rows' => array(),
            'nav' => array(
                'page' => 1,
                'last' => TRUE
            ),
            'available' => FALSE
        );
        if (!$this->db->table_exists('import_notif_log')) {
            return $result;
        }
        $result['available'] = TRUE;

        if (!is_array($params)) {
            $params = array();
        }
        $page = isset($params['page']) ? (int) $params['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }

        $this->db->select('L.id, L.import_id, L.format_id, L.send_when, L.email, L.subject, L.status, L.message, L.sent_at, A.doc_number');
        $this->db->from('import_notif_log L');
        $this->db->join('import A', 'A.id = L.import_id', 'left');

        $keyword = isset($params['keyword']) ? trim($params['keyword']) : '';
        if ($keyword !== '') {
            $this->db->group_start();
            $this->db->like('L.email', $keyword);
            $this->db->or_like('L.subject', $keyword);
            $this->db->or_like('A.doc_number', $keyword);
            $this->db->group_end();
        }
        if (!empty($params['dateFrom'])) {
            $this->db->where('L.sent_at >=', $params['dateFrom'] . ' 00:00:00');
        }
        if (!empty($params['dateUntil'])) {
            $this->db->where('L.sent_at <=', $params['dateUntil'] . ' 23:59:59');
        }
        if (isset($params['status']) && $params['status'] !== '') {
            $this->db->where('L.status', $params['status']);
        }

        $this->db->order_by('L.sent_at', 'DESC');
        $this->db->order_by('L.id', 'DESC');

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit + 1);
        $this->db->offset($offset);

        $result['nav']['page'] = $page;
        foreach ($this->db->get()->result_array() as $index => $row) {
            if ($index < $limit) {
                $result['rows'][] = array(
                    'id' => (int) $row['id'],
                    'sentAt' => $row['sent_at'],
                    'docNumber' => $row['doc_number'],
                    'email' => $row['email'],
                    'sendWhen' => $this->send_when_label($row['send_when']),
                    'subject' => $row['subject'],
                    'status' => $row['status'],
                    'message' => $row['message']
                );
            } else {
                $result['nav']['last'] = FALSE;
                break;
            }
        }

        return $result;
    }

    private function current_officer_nip() {
        if (isset($_SESSION['users']['nip']) && $_SESSION['users']['nip'] !== '') {
            return (string) $_SESSION['users']['nip'];
        }
        return '';
    }

    public function get_header_draft() {
        if (!$this->db->table_exists('import_header_temp')) {
            return NULL;
        }
        $nip = $this->current_officer_nip();
        if ($nip === '') {
            return NULL;
        }
        $this->db->where('officer_nip', $nip);
        $row = $this->db->get('import_header_temp')->row_array();
        if (!$row) {
            return NULL;
        }
        $payload = array();
        if (!empty($row['payload'])) {
            $decoded = json_decode($row['payload'], TRUE);
            if (is_array($decoded)) {
                $payload = $decoded;
            }
        }
        $items = array();
        if (!empty($row['key_header'])) {
            $this->db->where('key_header', $row['key_header']);
            $items = $this->db->get('import_items_temp')->result_array();
        }
        return array(
            'keyHeader' => $row['key_header'],
            'currentTab' => (int) $row['current_tab'],
            'payload' => $payload,
            'items' => $items
        );
    }

    public function save_header_draft($params) {
        if (!$this->db->table_exists('import_header_temp')) {
            return FALSE;
        }
        $nip = $this->current_officer_nip();
        if ($nip === '') {
            return FALSE;
        }
        $keyHeader = isset($params['keyHeader']) ? (string) $params['keyHeader'] : '';
        $currentTab = isset($params['currentTab']) ? (int) $params['currentTab'] : 1;
        if ($currentTab < 1) {
            $currentTab = 1;
        }
        $payload = isset($params['payload']) ? $params['payload'] : array();
        if (!is_array($payload)) {
            $payload = array();
        }
        $now = date('Y-m-d H:i:s');
        $json = json_encode($payload);

        $this->db->where('officer_nip', $nip);
        $existing = $this->db->get('import_header_temp')->row_array();
        $this->db->set('key_header', $keyHeader);
        $this->db->set('current_tab', $currentTab);
        $this->db->set('payload', $json);
        $this->db->set('updated_at', $now);
        if ($existing) {
            $this->db->where('id', $existing['id']);
            return $this->db->update('import_header_temp');
        }
        $this->db->set('officer_nip', $nip);
        $this->db->set('created_at', $now);
        return $this->db->insert('import_header_temp');
    }

    public function delete_header_draft($all = FALSE) {
        if (!$this->db->table_exists('import_header_temp')) {
            return TRUE;
        }
        $keys = array();
        if ($all) {
            $rows = $this->db->get('import_header_temp')->result_array();
            foreach ($rows as $row) {
                if (!empty($row['key_header'])) {
                    $keys[] = $row['key_header'];
                }
            }
            $this->db->empty_table('import_header_temp');
        } else {
            $nip = $this->current_officer_nip();
            if ($nip === '') {
                return TRUE;
            }
            $this->db->where('officer_nip', $nip);
            $row = $this->db->get('import_header_temp')->row_array();
            if ($row && !empty($row['key_header'])) {
                $keys[] = $row['key_header'];
            }
            $this->db->where('officer_nip', $nip);
            $this->db->delete('import_header_temp');
        }
        foreach ($keys as $key) {
            $this->db->where('key_header', $key);
            $this->db->delete('import_items_temp');
        }
        return TRUE;
    }

}