<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('email/EmailSendUtil');
        $this->CI->load->library('sms_send');
    }

    public function notifywsubject($email_actionName, $parameter_array, $to_sendEmail, $send_subject) {
       
        $mailSend = EmailSendUtil::sendEmailWSubject($email_actionName, $parameter_array, $to_sendEmail, $send_subject);
         
        if ($mailSend) {
            return true;
        } else {
            return false;
        }
    }

    public function notifywbccmails($email_actionName, $parameter_array, $to_sendEmail, $send_subject, $bccemails, $mobile_number, $message) {
//        echo $email_actionName. $parameter_array. $to_sendEmail. $send_subject.$mobile_number.$message;die;
        if (empty($mobile_number) && !empty($bccemails)) {
            //sending mail
            EmailSendUtil::sendEmailWBCC($email_actionName, $parameter_array, $to_sendEmail, $send_subject, $bccemails);
        } else if (!empty($mobile_number) && empty($bccemails)) {
//            sending sms
            $this->CI->sms_send->sendsms($mobile_number, $message);
        } else {
//            sending sms& email both
            EmailSendUtil::sendEmailWBCC($email_actionName, $parameter_array, $to_sendEmail, $send_subject, $bccemails);
            $this->CI->sms_send->sendsms($mobile_number, $message);
        }
    }

    public function notifyCCEmail($email_actionName, $parameter_array, $to_sendEmail, $ccEmail, $mobile_number, $message, $send_subject) {
//        echo $email_actionName. $parameter_array. $to_sendEmail. $send_subject.$mobile_number.$message;die;
        if (empty($mobile_number) && (!empty($ccEmail) && empty($send_subject))) {
            //sending mail
            EmailSendUtil::sendEmailCC($email_actionName, $parameter_array, $to_sendEmail, $ccEmail);
        } else if (empty($mobile_number) && (!empty($ccEmail) && !empty($send_subject))) {
            //sending mail
            EmailSendUtil::sendEmailCCWSubject($email_actionName, $parameter_array, $to_sendEmail, $ccEmail, $send_subject);
        } else if (!empty($mobile_number) && empty($ccEmail)) {
//            sending sms
            $this->CI->sms_send->sendsms($mobile_number, $message);
        } else {
//            sending sms& email both
            EmailSendUtil::sendEmailCC($email_actionName, $parameter_array, $to_sendEmail, $ccEmail);
            $this->CI->sms_send->sendsms($mobile_number, $message);
        }
    }

    /*
     * @author  :Riyaj
     * @date    :17-11-2017
     */

    public function notify_message($mobile_number, $msg) {
        if (!empty($mobile_number) && !empty($msg)) {
            $this->CI->sms_send->sendsms($mobile_number, $msg);
            return TRUE;
        }
    }

}
