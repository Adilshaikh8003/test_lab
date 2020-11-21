<?php

class Profile_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }
    public function getUserData($user_id) {
        $sql = "SELECT * FROM user WHERE user_id='" . $user_id . "' AND is_deleted='N'";
        $query = $this->db->query($sql);
        return $query->row();
    }
}
?>    