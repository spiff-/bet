<?php

	class Bet{

		private $id_bet;
		private $id_cat;
		private $question;
		private $max_points;
		private $ends;
		private $options;
		private $resolved;
		private $invalidated;

        function __construct($id_bet, $id_cat = null, $question = null, $max_points = null, $ends = null, $options = null){
	    	if($id_user > 0){
	    		//buscar en la db
	    	}else{
				if(($id_cat != null) && ($question != null) && ($max_points != null) && ($ends != null)){
					$this->id_cat = $id_cat;
					$this->question = $question;
					$this->max_points = $max_points;
					$this->ends = $ends;
					$this->create();

					if($options != null)
						addOptions($options);
				}
				else return; //error, excepciones?
			}
        }

		function addOptions($options){
			if(is_array($options))
				foreach($options as $option)
						addOptions($option);
			else{
				//añadir opcion a la db
				$this->options[count($this->options)] = $options;
		}

		function betted($id_bet_option == null){
			$total = 0;
			if($id_bet_option == null)
				foreach($options as $option)
						$total  += betted($option["id_bet_option"]);
			else
				$ total = xx; //buscar en la db el total de esa opcion

			return $total;				
		}

		function create(){
			//crear bet en la db y asignar id
		}
	
		function currentOdds($id_bet_option){
			$total = betted();
			$option = betted($id_bet_option);
			return round(2,$total/$option);//revisar en php.net 
		}

		function details(){
			return array("id_bet" => $id_bet, "id_cat" => $id_cat, "question" => $question, 
						 "max_points" => $max_points, "ends" => $ends, "options" => $options);
		}

		function invalidate{
			if($invalidated)
				return;

			//devolver a cada apostante lo apostado		
			if($resolved){
				//quitar a cada ganador lo ganado
			}	
		}

		function isInvalidated(){
			return $invalidated;
		}

		function isResolved(){
			return $resolved;
		}	

		function resolve($id_option){
			if((time() < $ends) || ($resolved) || ($invalidated))
				return;
			
			$total = betted();
			//asignar a cada usuario su parte proporcional		
		}
	}
?>
