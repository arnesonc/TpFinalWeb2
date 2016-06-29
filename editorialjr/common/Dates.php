<?php

class Dates{
	//funcion que obtiene la fecha en formato YYYY-MM-DD como en la base de datos.
	public function getDate(){
		$d = date("d");
		$m = date("m");
		$y = date("Y");
		$dia = $y.'-'.$m.'-'.$d;
		return $dia;
	}	
}


?>