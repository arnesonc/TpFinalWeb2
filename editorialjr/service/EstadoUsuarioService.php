<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../model/EstadoUsuarioModel.php");

class EstadoUsuarioService {
	
	private $dataAccess = null;
	
	function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un EstadoUsuarioModel por idUsuario
	 * */
	public function getEstadoUsuarioById($id){
		
		$sql = "SELECT id,
				    descripcion
				FROM estado_usuario
				WHERE id = $id;";
		
		try{
		
			$estadoUsuarioBD = $this->dataAccess->getOneResult($sql);
			
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			
			return null;
		}
		
		return $this->convertEstadoUsuarioDBToEstadoUsuarioModel($estadoUsuarioBD);
	}
	
	/**
	 * Convierte un estado usuario de la base de datos en un objeto EstadoClienteModel y lo devuelve
	 * */
	private function convertEstadoUsuarioDBToEstadoUsuarioModel($estadoUsuarioBD){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$estadoUsuarioModel = new EstadoUsuarioModel;
		$estadoUsuarioModel->id = $estadoUsuarioBD["id"];
		$estadoUsuarioModel->descripcion = utf8_encode($estadoUsuarioBD["descripcion"]);
	
		return $estadoUsuarioModel;
	}
}

?>