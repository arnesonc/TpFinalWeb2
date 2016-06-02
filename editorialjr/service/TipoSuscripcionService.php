<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/TipoSuscripcionModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class TipoSuscripcionService{

	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un ArticuloModel por su id
	 */
	public function getTipoSuscripcionById($id){
		$sql = "SELECT id,
						cantidad_meses
				FROM tipo_suscripcion
				WHERE id = $id;";
	
		try{
	
			$tipoSuscripcionDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertTipoSuscripcionDBToTipoSuscripcionModel($tipoSuscripcionDB);
	}
	
	/**
	 * Convierte un tipo de suscripcion de la base de datos en un objeto TipoSuscripcionModel y lo devuelve
	 * */
	private function convertTipoSuscripcionDBToTipoSuscripcionModel($tipoSuscripcionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$tipoSuscripcionModel = new TipoSuscripcionModel;
		$tipoSuscripcionModel->id = $tipoSuscripcionDB["id"];
		$tipoSuscripcionModel->cantidad_meses = $tipoSuscripcionDB["cantidad_meses"];
	
		return $tipoSuscripcionModel;
	}
}

?>