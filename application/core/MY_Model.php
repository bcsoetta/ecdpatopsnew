<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Model extends CI_Model {

    protected function get_doc_number($table) {
        // get last doc number
        $this->db->select('MAX(number_increment) AS increment_number');
        $this->db->where('year_increment', date('Y'));
        $increment = $this->db->get($table)->row_array();
        $increment_number = $increment['increment_number'];

        if ($increment_number === NULL) {
            $increment_number = 1;
        } else {
            $increment_number++;
        }

        return $increment_number;
    }
}