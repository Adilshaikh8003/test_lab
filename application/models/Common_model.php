<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function insertData($tbl, $fld) {
        $this->db->insert($tbl, $fld);
        return $this->db->insert_id();
    }

    public function updateData($tbl, $fld, $where) {
        $this->db->where($where);
        return $this->db->update($tbl, $fld);
    }

    public function deleteData($tbl, $where) {
        $this->db->where($where);
        return $this->db->delete($tbl);
    }

    public function isUsedField($tbl, $where) {
        $this->db->where($where);
        $query = $this->db->get($tbl);
        return $query->result();
    }

    

}
