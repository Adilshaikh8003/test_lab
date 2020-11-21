<?php

include 'EmailConfig.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

/**
 * Utility class to email
 * Make sure folder structure is maintained
 * config.xml file contains all the emails format is explained there
 * If you are designing emails using html files, make sure to crate html file at the same location as that of config
 *
 * @author Adil Shaikkh(adilshaikh8003@gmail.com)
 */
Class EmailSendUtil {

    const xml_file = "config.xml";

    //copy exact file location here
    static $universalMap = array();

    public static function sendEmail($configId, $parameters, $toEmail) {
        self::sendEmailWSubject($configId, $parameters, $toEmail, "");
    }

    /**
     * Function to send Email
     * @param $configId - is identifier from xml, $parameters - is an array of dynamic values passed
     */
    public static function sendEmailWSubject($configId, $parameters, $toEmail, $subject) {
        //load email config from xml to vaiable
        self::loadEmailConfig();

        //identify the right email config based on Id
        $emailConfig = self::$universalMap[$configId];
        // var_dump($parameters);
        // echo "\n calling \n";
        $emailConfig->transfromMsg($parameters);
        //send email
        return self::email($emailConfig, $toEmail, $subject);
    }

    public static function sendEmailWBCC($configId, $parameters, $toEmail, $subject, $bccEmail) {
        //load email config from xml to vaiable
        self::loadEmailConfig();

        //identify the right email config based on Id
        $emailConfig = self::$universalMap[$configId];
        // var_dump($parameters);
        // echo "\n calling \n";
        $emailConfig->transfromMsg($parameters);
        //send email
        self::emaiBcc($emailConfig, $toEmail, $subject, $bccEmail);
    }

    /*
     * @author  :Riyaj
     * @date    :3-10-2017
     * adding cc in email
     */

    public static function sendEmailCC($configId, $parameters, $toEmail, $ccEmail) {
        //load email config from xml to vaiable
        self::loadEmailConfig();

        //identify the right email config based on Id
        $emailConfig = self::$universalMap[$configId];
        // var_dump($parameters);
        // echo "\n calling \n";
        $emailConfig->transfromMsg($parameters);
        //send email
        self::emailCC($emailConfig, $toEmail, $ccEmail, "");
    }

    public static function sendEmailCCWSubject($configId, $parameters, $toEmail, $ccEmail, $sendSubject) {
        //load email config from xml to vaiable
        self::loadEmailConfig();

        //identify the right email config based on Id
        $emailConfig = self::$universalMap[$configId];
        // var_dump($parameters);
        // echo "\n calling \n";
        $emailConfig->transfromMsg($parameters);
        //send email
        self::emailCC($emailConfig, $toEmail, $ccEmail, $sendSubject);
    }

    public static function emailCC($emailConfig, $toEmail, $ccEmail, $argSubject) {
        echo $emailConfig . " " . $toEmail . " " . $ccEmail . " " . $argSubject;
        if ($toEmail == "") {
            $to = $emailConfig->getToEmail();
        } else {
            $to = $toEmail;
        }

        if ($argSubject == null || $argSubject == "") {
            $subject = $emailConfig->getSubject();
        } else {
            $subject = $argSubject;
        }


        $txt = $emailConfig->getBody();
        $mail = new PHPMailer();
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
            ));
             $mail->isSMTP();
//             $mail->SMTPDebug = 1;
//
            $mail->Host = "mail.mtlspl.com";
            $mail->SMTPAuth = true;
            $mail->Username = "help@mtlspl.com";
            $mail->Password = "help@12345";
//
            $mail->Port = 587;
            $mail->From = $emailConfig->getFromEmail();
            $mail->FromName = "Micro Testting Lab Solutions";
            $mail->AddAddress($toEmail);
            $mail->AddCC($ccEmail);
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $txt;
            return $mail->Send();
//            echo "Message Sent OK\n";
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
        echo 'hicc';
        die;
    }

    public static function emaiBcc($emailConfig, $toEmail, $argSubject, $bcc) {

        if ($toEmail == "") {
            $to = "";
        } else {
            $to = $toEmail;
        }

        if ($argSubject == null || $argSubject == "") {
            $subject = $emailConfig->getSubject();
        } else {
            $subject = $argSubject;
        }


        $txt = $emailConfig->getBody();

        try {
            $mail = new PHPMailer();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
            ));
             $mail->isSMTP();
             $mail->SMTPDebug = 2;
            $mail->Host = "mail.mtlspl.com";
            $mail->SMTPAuth = true;
            $mail->Username = "help@mtlspl.com";
            $mail->Password = "help@12345";
//
            $mail->Port = 587;
            $mail->From = $emailConfig->getFromEmail();
            $mail->FromName = "Micro Testting Lab Solutions";
            if (!empty($to)) {
                $mail->AddAddress($to);
            } else if (!empty($bcc)) {
                foreach ($bcc as $bccs) {
                    $mail->addBCC($bccs);
                }
            }
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $txt;
            return $mail->Send();
            echo "Message Sent OK\n";
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
        echo 'hibcc';
        die;
    }

    public static function email($emailConfig, $toEmail, $argSubject) {

        if ($toEmail == "") {
            $to = $emailConfig->getToEmail();
        } else {
            $to = $toEmail;
        }

        if ($argSubject == null || $argSubject == "") {
            $subject = $emailConfig->getSubject();
        } else {
            $subject = $argSubject;
        }


        $txt = $emailConfig->getBody();

        try {
            $mail = new PHPMailer();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
            ));
            $mail->isSMTP();
//            $mail->SMTPDebug = 2;
            $mail->Host = "mail.mtlspl.com";
            $mail->SMTPAuth = true;
            $mail->Username = "help@mtlspl.com";
            $mail->Password = "help@12345";
//
            $mail->Port = 587;
            $mail->From = $emailConfig->getFromEmail();
            $mail->FromName = "Micro Testting Lab Solutions";
            $mail->AddAddress($to);
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $txt;
            return $mail->Send();
            // echo "Message Sent OK\n".$mail->Username;
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }

    /**
     * If map is already populated then just return existing map, else populate it
     */
    public static function loadEmailConfig() {
//        echo "inside";

        self::getMasterMap();
    }

    public static function getMasterMap() {
        // $xmlFile = __DIR__ . "\\" . self::xml_file;
        $xmlFile = "application/libraries/email/" . self::xml_file;
        //echo $xmlFile;
//        try{
        $tmpString = file_get_contents($xmlFile);

//            echo "\n content is here ".$tmpString;
//            echo simplexml_load_file($xmlFile, 'SimpleXMLElement', LIBXML_NOCDATA);
        $beforeDecode = json_encode(simplexml_load_string($tmpString, 'SimpleXMLElement', LIBXML_NOCDATA));

//        echo "<br>output  ".$beforeDecode;
//        }catch (Exception $e){
//            echo 'sdfsdfsdf'.$e->errorMessage();
//        }
//        echo $beforeDecode;
        $jsonDecoded = json_decode($beforeDecode);

//        echo var_dump($jsonDecoded);
//         echo sizeof($jsonDecoded->EmailConfig);

        $configSize = sizeof($jsonDecoded->EmailConfig);

        if ($configSize > 0) {

            for ($i = 0; $i < $configSize; $i++) {
                // echo $i;
                $config = $jsonDecoded->EmailConfig[$i];
                $id = $jsonDecoded->EmailConfig[$i]->id;
                // var_dump($config);
                $emailConfig = new EmailConfig();
                $emailConfig->setId($id);
                $emailConfig->setFromName($config->fromName);
                $emailConfig->setToEmail($config->toEmail);
                $emailConfig->setSubject($config->subject);
                // echo $config->body;
                // echo (string) $config->body;
                if (isset($config->msgURL))
                    $emailConfig->setMsgURL($config->msgURL);

//                 echo $config->body;
                $emailConfig->setBody((string) $config->body);
                $emailConfig->setFromEmail($config->fromEmail);
                // var_dump($emailConfig);
                self::$universalMap[$id] = $emailConfig;
            }
        }
    }

}
