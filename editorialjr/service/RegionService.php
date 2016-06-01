<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/RegionModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class RegionService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una RegionModel por su id
	 * */
	public function getRegionById($idRegion){
		$sql = "SELECT id,
						id_pais,
						descripcion
				FROM region
				WHERE id = $idRegion;";
	
		try{
				
			$regionDB = $this->dataAccess->getOneResult($sql);
				
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
				
			return null;
		}
	
		return $this->convertRegionDBToRegionModel($regionDB);
	}
	
	/**
	 * Convierte una region de la base de datos en un objeto RegionModel y lo devuelve
	 * */
	private function convertRegionDBToRegionModel($regionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$regionModel = new RegionModel;
		$regionModel->id = $regionDB["id"];
		$regionModel->id_pais = $regionDB["id_pais"];
		$regionModel->descripcion = $regionDB["descripcion"];
	
		return $regionModel;
	}
}

?>