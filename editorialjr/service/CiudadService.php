<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/CiudadModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class CiudadService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	public function getCiudadById($idCiudad){
		$sql = "SELECT id,
				    id_region,
				    descripcion
				FROM ciudad
				WHERE id = $idCiudad;";
		
		try{
			
			$ciudadDB = $this->dataAccess->getOneResult($sql);
			
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}
		
		return $this->convertCiudadDBToCiudadModel($ciudadDB);
	}
		
	/*
	 * Convierte un estado cliente de la base de datos en un objeto EstadoClienteModel y lo devuelve
	 * */
	private function convertCiudadDBToCiudadModel($ciudadDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$ciudadModel = new CiudadModel;
		$ciudadModel->id = $ciudadDB["id"];
		$ciudadModel->id_region = $ciudadDB["id_region"];
		$ciudadModel->descripcion = $ciudadDB["descripcion"];
	
		return $ciudadModel;
	}
}

?>