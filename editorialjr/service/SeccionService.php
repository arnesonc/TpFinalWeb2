<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/SeccionModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class SeccionService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una SeccionModel por su id
	 */
	public function getSeccionById($id){
		$sql = "SELECT id,
				    id_numero,
				    nombre
				FROM seccion
				WHERE id = $id;";
	
		try{
	
			$seccionDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertCiudadDBToCiudadModel($seccionDB);
	}
	
	/**
	 * Convierte una seccion de la base de datos en un objeto SeccionModel y lo devuelve
	 * */
	private function convertSeccionDBToSeccionModel($seccionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$seccionModel = new SeccionModel;
		$seccionModel->id = $seccionDB["id"];
		$seccionModel->id_numero = $seccionDB["id_numero"];
		$seccionModel->nombre = $seccionDB["nombre"];
	
		return $seccionModel;
	}
}

?>