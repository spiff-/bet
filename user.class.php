<?php
require_once('dbhandler.class.php');

class User{

	private $id_user;
	private $nickname;
	private $email;
	private $points;

        function __construct($id_user = null, $nickname = null, $email = null, $points = null){
        	if($id_user == null){
        		$this->id_user = -2;
        		return;
        	}
        	$this->setId_user($id_user);
		$this->setNickname($nickname);
		$this->setEmail($email);
		$this->setPoints($points);
        }

	function __destruct() {
		$this->logout();
	}

        function addPoints($change){
        	$this->points += $change;
        }
        
	//******* GETS *********************        
	function getId_user(){
		return $this->id_user;
	}        

	function getNickname(){
		return $this->nickname;
	}        

	function getEmail(){
		return $this->email;
	}        

	function getPoints(){
		return $this->points;
	} 
	//**********************************       

	function isLogged(){
		return $this->id_user > 0;
	}        

	function login($nickname, $password){
		$db = new DBHandler();
		$data = $db->loginUser($nickname, $password);
		if ($data["id_user"] != NULL) {
			$this->setId_user($data["id_user"]);
			$this->setNickname($data["nickname"]);
			$this->setEmail($data["email"]);
			$this->setPoints($data["points"]);
		} else {
			$this->setId_user(-1);
		}
	} 
	   
	function logout(){
		if ($this->isLogged()) $this->update();
		$this->id_user = -3;
	}
	    
	//******* SETS *********************
	function setId_user($id_user){
		$this->id_user = $id_user;
	}        

	function setNickname($nickname){
		$this->nickname = $nickname;
	}        

	function setEmail($email){
		$this->email = $email;
	}        

	function setPoints($points){
		$this->points = $points;
	}	    
	//**********************************    

	function update(){
		$db = new DBHandler();
		$db->updatePoints($this->nickname, $this->points);
	}   
}

	/*
		INVENTADO
		id = -1 -> login incorrecto
		id = -2 -> usuario vacio
		id = -3 -> deslogueado
	*/
?>
