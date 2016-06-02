<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/NumeroModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class NumeroService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una NumeroModel por su id
	 */
	public function getNumeroById($id){
		$sql = "SELECT id,
				    id_publicacion,
				    id_estado_numero,
				    url_portada,
				    fe_erratas,
				    precio,
				    fecha_publicado
				FROM numero
				WHERE id = $id;";
	
		try{
	
			$numeroDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertNumeroDBToNumeroModel($numeroDB);
	}
	
	/**
	 * Convierte un numero de la base de datos en un objeto NumeroModel y lo devuelve
	 * */
	private function convertNumeroDBToNumeroModel($numeroDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$numeroModel = new NumeroModel;
		$numeroModel->id = $numeroDB["id"];
		$numeroModel->id_publicacion = $numeroDB["id_publicacion"];
		$numeroModel->id_estado_numero = $numeroDB["id_estado_numero"];
		$numeroModel->url_portada = $numeroDB["url_portada"];
		$numeroModel->fe_erratas = $numeroDB["fe_erratas"];
		$numeroModel->precio = $numeroDB["precio"];
		$numeroModel->fecha_publicado = $numeroDB["fecha_publicado"];
	
		return $numeroModel;
	}
}

?>