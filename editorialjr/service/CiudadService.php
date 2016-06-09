<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/CiudadModel.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class CiudadService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una CiudadModel por su id
	 */
	public function getCiudadById($id){
		$sql = "SELECT id,
				    id_region,
				    descripcion
				FROM ciudad
				WHERE id = $id;";
		
		try{
			
			$ciudadDB = $this->dataAccess->getOneResult($sql);
			
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}
		
		return $this->convertCiudadDBToCiudadModel($ciudadDB);
	}

	/**
	* Obtiene ciudades por idRegion
	*/
	public function getCiudadesByIdRegion($idRegion){
		$sql = "SELECT id,
				    id_region,
				    descripcion
				FROM ciudad
				WHERE id_region = $idRegion;";

		try{
			
			$ciudadDBArray = $this->dataAccess->getMultipleResults($sql);
			
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}

		$arrayCiudadModel = array();
	
		foreach ($ciudadDBArray as $ciudadDB) {
	
			$ciudadModel = $this->convertCiudadDBToCiudadModel($ciudadDB);
	
			$arrayCiudadModel[] = $ciudadModel;
		}
	
		return $arrayCiudadModel;
	}
		
	/**
	 * Convierte una ciudad de la base de datos en un objeto CiudadModel y lo devuelve
	 * */
	private function convertCiudadDBToCiudadModel($ciudadDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$ciudadModel = new CiudadModel;
		$ciudadModel->id = $ciudadDB["id"];
		$ciudadModel->id_region = $ciudadDB["id_region"];
		$ciudadModel->descripcion = utf8_encode($ciudadDB["descripcion"]);
	
		return $ciudadModel;
	}
}

?>