<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->library('session');
//        $this->load->library('Email_content');
//        $this->load->library('notification');
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function login() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        if (($this->input->post('userEmail') != "") && ($this->input->post('password') != "")) {

            //  $email = $this->input->post('email');
            $password = $this->input->post('password');
            $userEmail = $this->input->post('userEmail');
            $user_data = $this->login_model->getUserData($userEmail);

            if (!empty($user_data)) {
                if (($user_data->is_active == 'Y') && ($user_data->is_deleted == 'N')) {
                    if (password_verify($password, $user_data->password)) {
                        if ($user_data->is_active == 'N') {
                            $arrReturn['status'] = "failed";
                            $arrReturn['message'] = "User not active";
                        } else {
                            $this->session->set_userdata(array(
                                'user_id' => $user_data->user_id,
                                'user_email' => $user_data->user_email,
                                'first_name' => $user_data->first_name,
                                'last_name' => $user_data->last_name,
                                'mobile_no' => $user_data->mobile_no,
                                'is_logged_in' => true,
                            ));
                            $arrReturn['status'] = "true";
                            $arrReturn['message'] = "Logged in Sucessfully";
                        }
                    } else {
                        $this->session->set_flashdata("result", "Password-error");
                        $arrReturn['status'] = "failed";
                        $arrReturn['message'] = "Password error";
                    }
                } else {
                    $arrReturn['status'] = "failed";
                    $arrReturn['message'] = "User not active";
                }
            } else {
                $arrReturn['status'] = "failed";
                $arrReturn['message'] = "User not exist";
            }
        } else {
            $arrReturn['status'] = "failed";
            $arrReturn['message'] = "Error while requesting";
        }
        header('Content-Type: application/json');
        echo json_encode($arrReturn);
        die;
    }

}
