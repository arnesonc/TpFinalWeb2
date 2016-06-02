<?php

require_once(__DIR__."/../service/NumeroService.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class SeccionModel{
	public $id;
	public $id_numero;
	public $nombre;
	
	private $numero;
	
	/**
	 * Obtiene un objeto Numero, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getNumero(){
	
		if(is_null($this->numero)){
			$numeroService = new NumeroService;
	
			try {
	
				$this->numero = $numeroService->geNumeroById($this->id_numero);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->numero;
	}
}
?>