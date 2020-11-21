<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
         $this->load->helper('url');
    }

    public function index() {
        $this->session->sess_destroy();
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('mobile_no');
        $this->session->unset_userdata('isAdmin');

        redirect(base_url() . "welcome");
    }

}
