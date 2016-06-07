<?php

class ValidationHelper{
	
	/**
	 * Verifica si la cantidad de caracteres de la variable esta dentro de los parametros
	 * minimo y maximo especificados (incluye los extremos)
	 * */
	public function validateText($text, $minLength, $maxLength){
		
		// Quita los espacios en blanco
		$text = trim($text);
		
		if(strlen($text) >= $minLength && strlen($text) <= $maxLength){
			return true;
		}else{
			return false;
		}
	}
	
	public function validateNumber($value){
		if(is_numeric($value)){
			return true;
		} else {
			return false;
		}
	}

	public function validateNull($value){
		if(is_null($value)){
			return true;
		}
		else{
			return false;
		}
	}

	public function validateIsSet($value){
		if(isset($value)){
			return true;
		}else{
			return false;
		}
	}
	
	public function validateBoolean($value){
		if($value == true || $value == false){
			return true;
		} else {
			return false;
		}
	}
}

?>