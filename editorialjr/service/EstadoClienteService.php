<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../model/EstadoClienteModel.php");

class EstadoClienteService {
	
	private $dataAccess = null;
	
	function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un EstadoUsuarioModel por id
	 * */
	public function getEstadoClienteById($id){
		
		$sql = "SELECT id,
				    descripcion
				FROM estado_cliente
				WHERE id = $id;";
		
		try{
		
			$estadoClienteBD = $this->dataAccess->getOneResult($sql);
		
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}
		return $this->convertEstadoClienteDBToEstadoClienteModel($estadoClienteBD);
	}
	
	/**
	 * Convierte un estado cliente de la base de datos en un objeto EstadoClienteModel y lo devuelve
	 * */
	private function convertEstadoClienteDBToEstadoClienteModel($estadoClienteDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$estadoClienteModel = new EstadoClienteModel;
		$estadoClienteModel->id = $estadoClienteDB["id"];
		$estadoClienteModel->descripcion = $estadoClienteDB["descripcion"];
	
		return $estadoClienteModel;
	}
}

?>