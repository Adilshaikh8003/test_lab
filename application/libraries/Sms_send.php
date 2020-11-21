<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_send {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
    }

    public function sendsms($send_mobile_number, $send_message) 
    {
        $res = array();
        //$authKey = "152470Akv1Fx1ceQi2591949fc"; //key modified by riyaj 15-05-2017
        $authKey = "235084AGhSrCV9s65b8a8889"; 
        //Multiple mobiles numbers separated by comma
        $mobileNumber = $send_mobile_number;

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "ESRENT";

        //Your message to send, Add URL encoding here.
        $message = urlencode($send_message);

        $response_type = 'json';

        //Define route 
        $route = "4";
        $country = 91;
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route,
            'country' => $country,
            'response' => $response_type
        );

        //API URL
        $url = "http://api.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);
        //        array_push($res, "send");
        //        echo json_encode($res);
    }
}
