<?php 
	class User{

		private $id_user;
		private $nickname;
		private $email;
		private $points;
	
        function __construct($id_user = null, $nickname = null, $email = null, $points = null){
        	if($id_user == null){
        		$id_user = -2;
        		return;
        	}
        	//continuar constructor
        }

        function changePoints($change){
        	$points += $change;
        }

        function exists(){
        	//comprueba si existe este usuario en la db
        }
        
		//******* GETS *********************        
	    function getId_user(){
	    	return $id_user;
	    }        

	    function getNickname(){
	    	return $nickname;
	    }        

	    function getEmail(){
	    	return $email;
	    }        

	    function getPoints(){
	    	return $points;
	    } 
	    //**********************************       

	    function isLogged(){
	    	return $id_user > 0;
	    }        

	    function login($email,$pass){
	    	//...
	    } 
	           
	    function logout(){
	    	$id_user = -3;
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
	    	//guarda los cambios en la db
	    }   
	}

	/*
		INVENTADO
		id = -1 -> login incorrecto
		id = -2 -> usuario vacio
		id = -3 -> deslogueado
	*/
?>
