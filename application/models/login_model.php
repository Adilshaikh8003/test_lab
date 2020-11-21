<?php

class Login_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }
    public function getUserData($userEmail) {
        $sql = "SELECT * FROM user WHERE user_email='" . $userEmail . "' AND is_deleted='N'";
        $query = $this->db->query($sql);
        return $query->row();
    }
}
?>    