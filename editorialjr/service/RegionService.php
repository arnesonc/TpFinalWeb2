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
	
	/*
	 * Convierte un estado cliente de la base de datos en un objeto EstadoClienteModel y lo devuelve
	 * */
	private function convertRegionDBToRegionModel($regionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$regionModel = new RegionModel;
		$regionModel->id = $regionDB["id"];
		$regionModel->id_region = $regionDB["id_pais"];
		$regionModel->descripcion = $regionDB["descripcion"];
	
		return $regionModel;
	}
}

?>