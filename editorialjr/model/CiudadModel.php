<?php

require_once(__DIR__."/../service/RegionService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class CiudadModel{
	public $id;
	public $id_region;
	public $descripcion;
	
	private $region;
	
	/**
	 * Obtiene un objeto RegionModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getRegion(){
		
		if(is_null($this->region)){
			$regionService = new RegionService;
			
			try {
				
				$this->region = $regionService->getRegionById($this->id_region);
				
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
		
		return $this->region;
	}
}

?>