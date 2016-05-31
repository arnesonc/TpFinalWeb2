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
}

?>