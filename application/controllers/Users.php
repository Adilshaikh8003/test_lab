<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('users_model');
        $this->load->model('common_model');
        $this->load->library('session');
        $this->userId = $this->session->userdata('user_id');
    }

    public function index() {
        $this->load->view('users_view');
    }

    public function get_admin_users() {
        $arrUsers['status'] = FALSE;
        $arrJSON = array();
        $arrUsers = array();
        $profileData = $this->users_model->getAdminUserData();
        foreach ($profileData AS $objrow) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['user_id'] = $objrow->user_id;
            $arrTemp['first_name'] = $objrow->first_name;
            $arrTemp['last_name'] = $objrow->last_name;
            $arrTemp['email'] = $objrow->user_email;
            $arrTemp['mobile_no'] = $objrow->mobile_no;
            $arrTemp['created_at'] = date('M-d,Y', strtotime($objrow->created_at));
            $arrUsers[] = $arrTemp;
        }
        $arrJSON['data'] = $arrUsers;
        echo json_encode($arrJSON);
    }

    public function save_user() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $userEmail = $this->input->post('userEmail');
        $mobileNo = $this->input->post('mobileNo');
        //start the transaction
        $this->db->trans_begin();

        if (!empty($firstName) && !empty($lastName) && !empty($userEmail)) {
            $user_details = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'user_email' => $userEmail,
                'mobile_no' => $mobileNo,
                'role' => 'User',
                'created_by' => $this->userId
            );
            $user = $this->common_model->insertData('user', $user_details);
            if ($user) {
                //make transaction complete
                $this->db->trans_complete();
            }
            if ($this->db->trans_status() === FALSE) {
                //if something went wrong, rollback everything
                $this->db->trans_rollback();
                $arrReturn['status'] = FALSE;
                $arrReturn['msg'] = 'Please try again.';
            } else {
                $this->db->trans_commit();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'User save successfully.';
            }
        } else {
            $arrReturn['msg'] = 'Error while adding. Please try again.';
        }
        echo json_encode($arrReturn);
    }

    public function save_edit_user() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $userEmail = $this->input->post('userEmail');
        $mobileNo = $this->input->post('mobileNo');
        $userId = $this->input->post('userId');
        //start the transaction
        $this->db->trans_begin();

        if (!empty($firstName) && !empty($lastName) && !empty($userEmail)) {
            $user_where = array(
                'user_id' => $userId,
            );
            $user_details = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'user_email' => $userEmail,
                'mobile_no' => $mobileNo,
                'role' => 'User',
                'created_by' => $this->userId
            );
            $user = $this->common_model->updateData('user', $user_details, $user_where);
            if ($user) {
                //make transaction complete
                $this->db->trans_complete();
            }
            if ($this->db->trans_status() === FALSE) {
                //if something went wrong, rollback everything
                $this->db->trans_rollback();
                $arrReturn['status'] = FALSE;
                $arrReturn['msg'] = 'Please try again.';
            } else {
                $this->db->trans_commit();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'User save successfully.';
            }
        } else {
            $arrReturn['msg'] = 'Error while adding. Please try again.';
        }
        echo json_encode($arrReturn);
    }

    public function delete_admin_user() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $userId = $this->input->post('userId');
        //start the transaction
        $this->db->trans_begin();
        if (!empty($userId)) {
            $user_where = array(
                'user_id' => $userId,
            );
            $user_details = array(
                'deleted_by' => $this->userId,
                'is_deleted' => 'Y'
            );

            $user = $this->common_model->updateData('user', $user_details, $user_where);
            if ($user) {
                $this->db->trans_complete();
            }
            if ($this->db->trans_status() === FALSE) {
                //if something went wrong, rollback everything
                $this->db->trans_rollback();
                $arrReturn['status'] = FALSE;
                $arrReturn['msg'] = 'Please try again.';
            } else {
                $this->db->trans_commit();
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = 'User delete successfully.';
            }
        } else {
            $arrReturn['msg'] = 'Error while delete. Please try again.';
        }
        echo json_encode($arrReturn);
    }

    public function get_user_details() {
        $arrUsers['status'] = FALSE;
        $arrJSON = array();
        $arrUsers = array();
        $userId = $this->input->get('userId');
        $userData = $this->users_model->getuserById($userId);
        if ($userData) {
            $arrTemp = array();
            $arrTemp['status'] = TRUE;
            $arrTemp['user'] = $userData;
            $arrUsers[] = $arrTemp;
        }
        $arrJSON['data'] = $arrUsers;
        echo json_encode($arrJSON);
    }

    public function check_email() {
        $arrReturn = array();
        $arrReturn['status'] = FALSE;
        $userEmail = $this->input->post('userEmail');
//        $user_id = $this->session->userdata('user_id');
        if (($userEmail)) {
            $exists = $this->Admin_user_model->user_email_exists($userEmail);
            $count = count($exists);
            if ($count == 0) {
                $arrReturn['status'] = TRUE;
                $arrReturn['msg'] = "";
            } else {
                $arrReturn['status'] = FALSE;
                $arrReturn['msg'] = "Email address Already Exist";
            }
        } else {
            $arrReturn['status'] = FALSE;
            $arrReturn['msg'] = "";
        }
        echo json_encode($arrReturn);
        die;
    }

}
