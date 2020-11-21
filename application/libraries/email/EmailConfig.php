<?php
 include 'Bean.php';
/**
   * Class represent object for email configuration
   * 
   * 
   * @package    email
   * @subpackage modal
   * @author     Adil Shaikh <adilshaikh8003@gmail..com>
   */
   
   Class EmailConfig extends Bean {
  
	private $id;
  	private $fromName;
	private $fromEmail;
	private $toEmail;
	private $subject;
	private $msgURL;
// 	private $body;
	
	public function getId(){
	return $this->id;
	}
	
	public function setId($argId){
		if($argId != ""){
			$this->id = $argId;
		}
	}

	public function getFromName(){
	return $this->fromName;
	}
	
	public function setFromName($argFromName){
		if($argFromName != ""){
			$this->fromName = $argFromName;
		}
	}
	
	public function getFromEmail(){
	return $this->fromEmail;
	}
	
	public function setFromEmail($argFromEmail){
		if($argFromEmail != ""){
			$this->fromEmail = $argFromEmail;
		}
	}
	
	public function getToEmail(){
	return $this->toEmail;
	}
	
	public function setToEmail($argToEmail){
		if($argToEmail != ""){
			$this->toEmail = $argToEmail;
		}
	}
	
	
	public function getSubject(){
	return $this->subject;
	}
	
	public function setSubject($argSubject){
		if($argSubject != ""){
			$this->subject = $argSubject;
		}
	}

	public function getBody(){
	return $this->body;
	}
	
	public function setMsgURL($argMsgURL){
		if($argMsgURL!=""){
			$this->msgURL = $argMsgURL;
		}
	}
	
	public function setBody($argBody){
		//if message url is present load html string from there
		if(!is_null($this->msgURL)){
//                    echo "in url";
			$this->body = file_get_contents($this->msgURL);
//                        echo "in url".$this->body;
		}else if($argBody != ""){
//                    echo "in body";
			$this->body = $argBody;
		}
//		echo "body".$this->body;
	}
	
	public function transfromMsg($parameters){
//		echo "in transform\n";
//		var_dump($parameters);
		//Array parameters
		if( $parameters!=NULL && sizeof($parameters)>0){
			
			for($i=1;$i<=sizeof($parameters);$i++){
				$str = $this->body;
				// echo ("$".$i);
				$this->body = str_replace("$".$i. " ", $parameters[$i-1], $str);
			}
		}
	}	
   }