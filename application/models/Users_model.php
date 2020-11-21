<?php

class Users_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getAdminUserData() {
        $sql = "SELECT * FROM user WHERE  is_deleted= 'N' AND role != 'Admin' ORDER BY created_at DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getuserById($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function user_email_exists($userEmail) {
        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->where('admin_email', $userEmail);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}

?>    