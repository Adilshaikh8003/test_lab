<?php
//Steps:
//Make sure you include EmailSendUtil.php
//Define an array with parameters in the same sequence defined in the xml
include 'EmailSendUtil.php';
$str = array();
$str[0]="Adil";
$str[1]="Shaikh";
EmailSendUtil::sendEmail("systemRegistration",$str,"help@mtlspl.com");
