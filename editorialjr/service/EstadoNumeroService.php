<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../model/EstadoNumeroModel.php");

class EstadoNumeroService {
	
	private $dataAccess = null;
	
	function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un EstadoNumeroModel por id
	 * */
	public function getEstadoNumeroById($id){
		
		$sql = "SELECT id,
				    descripcion
				FROM estado_numero
				WHERE id = $id;";
		
		try{
		
			$estadoNumeroBD = $this->dataAccess->getOneResult($sql);
			
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}
		
		return $this->convertEstadoNumeroDBToEstadoNumeroModel($estadoNumeroBD);
	}
	
	/**
	 * Convierte un estado Numero de la base de datos en un objeto EstadoNumeroModel y lo devuelve
	 * */
	private function convertEstadoNumeroDBToEstadoNumeroModel($estadoNumeroBD){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$estadoNumeroModel = new EstadoNumeroModel;
		$estadoNumeroModel->id = $estadoNumeroBD["id"];
		$estadoNumeroModel->descripcion = $estadoNumeroBD["descripcion"];
	
		return $estadoNumeroModel;
	}
}

?>