<?php
include 'EmailConfig.php';
$xml="config.xml";
$Json = json_encode(simplexml_load_file("config.xml"));
$Json =json_decode($Json);	
if($Json instanceof JSONObject){
//echo "one object";
}else if ($Json instanceof JSONArray){
//echo "multiple Object";
}else{
// echo var_dump($Json->EmailConfig[0]->fromName);
//echo sizeof($Json->EmailConfig);

$configSize = sizeof($Json->EmailConfig);


if( $configSize> 0){
$universalMap = array();
// echo "in";
for($i=0;$i<$configSize; $i++){
// echo $i;
$config = $Json->EmailConfig[$i];
$id = $Json->EmailConfig[$i]->id;
// var_dump($config);
$emailConfig = new EmailConfig();
$emailConfig->setId($id);
$emailConfig->setFromName($config->fromName);
$emailConfig->setToEmail($config->toEmail);
$emailConfig->setSubject($config->subject);
$emailConfig->setBody($config->body);
$emailConfig->setFromEmail($config->fromEmail);
// var_dump($emailConfig);
$universalMap[$id]=$emailConfig;
}
//var_dump($universalMap);
}
}
?>