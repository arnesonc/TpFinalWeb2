<?php

require_once(__DIR__."/../service/PaisService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class RegionModel{
	
	 public $id;
	 public $id_pais;
	 public $descripcion;
	 
	 private $pais;
	 
	 /**
	  * Obtiene un objeto PaisModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	  * */
	 public function getPais(){
	 
	 	if(is_null($this->pais)){
	 		$paisService = new PaisService;
	 			
	 		try {
	 
	 			$this->pais = $paisService->getPaisById($this->id_pais);
	 
	 		}catch(Exeption $e){
	 			$logger = Logger::getRootLogger();
	 			$logger->error($e);
	 			return null;
	 		}
	 	}
	 
	 	return $this->pais;
	 }
}
?>