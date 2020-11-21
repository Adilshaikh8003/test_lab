<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Profile_model');
        $this->load->model('login_model');
        $this->load->model('common_model');
    }

    public function index() {
        $this->load->view('profile_view');
    }

    public function get_user() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $user_id = $this->session->userdata('user_id');
        $profileData = $this->Profile_model->getUserData($user_id);
        if ($profileData) {
            $arrReturn['status'] = TRUE;
            $arrReturn['user'] = $profileData;
        }
        echo json_encode($arrReturn);
        die;
    }

//    public function update_profile() {
//        $arrReturn = array();
//        $arrReturn['status'] = FALSE;
//        if (($this->input->post('firstName') != "") && ($this->input->post('lastName') != "" && $this->input->post('userEmail') != "" && $this->input->post('mobileNo') != "")) {
//            
//        } else {
//            $arrReturn['status'] = "failed";
//            $arrReturn['message'] = "Error while updating profile";
//        }
//        header('Content-Type: application/json');
//        echo json_encode($arrReturn);
//        die;
//    }
    public function update_profile() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $mobileNo = $this->input->post('mobileNo');
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $userEmail = $this->input->post('userEmail');
        $user_id = $this->session->userdata('user_id');

        if (!empty($mobileNo) && !empty($firstName) && !empty($lastName)) {
            $where = array("user_id" => $user_id);
            $updateData = (array(
                'mobile_no' => $mobileNo,
                'user_email' => $userEmail,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'modified_by' => $this->session->userdata('user_id'),
                'modified_at' => date("Y-m-d H:i:s"),
            ));
            $updatedResult = $this->common_model->updateData('user', $updateData, $where);
            if ($updatedResult) {
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = "Your profile update successfully";
            } else {
                $arrReturn['status'] = FALSE;
                $arrReturn['msg'] = "Error while update Your profile";
            }
        } else {
            $arrReturn['status'] = FALSE;
            $arrReturn['msg'] = "Required parameter missing or invalid";
        }
        echo json_encode($arrReturn);
        die;
    }

}
