<?php

# ======================================================================== #
#  Title      Check Session 
#  Author:    Adil
#  Website:   Highleap
#  Date:      10-July-2019
# ======================================================================== #

defined('BASEPATH') OR exit('No direct script access allowed');

class Check_session {

    public $CI;

    public function __construct() {
        
        date_default_timezone_set('asia/kolkata');
        $this->CI = & get_instance();
        if (empty($this->CI->session->userdata('cust_id'))) {
            $this->CI->session->set_flashdata("msg_type", "ERROR");
            $this->CI->session->set_flashdata("msg", "Invalid attempt of login");
            redirect(base_url() . "rpadmin");
        } 
    }
}

?>