<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../model/EstadoArticuloModel.php");

class EstadoArticuloService {
	
	private $dataAccess = null;
	
	function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un EstadoArticuloModel por id
	 * */
	public function getEstadoArticuloById($id){
		
		$sql = "SELECT id,
				    descripcion
				FROM estado_articulo
				WHERE id = $id;";
		
		try{
		
			$estadoArticuloBD = $this->dataAccess->getOneResult($sql);
			
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}
		
		return $this->convertEstadoArticuloDBToEstadoArticuloModel($estadoArticuloBD);
	}
	
	
	public function getCantidadArticulosEnDraft($id_numero){
				$sql = "SELECT COUNT * cantidad
				FROM articulo
				WHERE id_numero = $id_numero AND id_estado_articulo = 1;";
				//DIE($sql);
		try{
			$result = $this->dataAccess->getOneResult($sql);
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;
		}
		return $result["cantidad"];
	}

	/**
	 * Convierte un estado articulo de la base de datos en un objeto EstadoArticuloModel y lo devuelve
	 * */
	private function convertEstadoArticuloDBToEstadoArticuloModel($estadoArticuloBD){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$estadoArticuloModel = new EstadoArticuloModel;
		$estadoArticuloModel->id = $estadoArticuloBD["id"];
		$estadoArticuloModel->descripcion = $estadoArticuloBD["descripcion"];
	
		return $estadoArticuloModel;
	}
}

?>