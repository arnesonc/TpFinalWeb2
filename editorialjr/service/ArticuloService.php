<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/ArticuloModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class ArticuloService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un ArticuloModel por su id
	 */
	public function getArticuloById($id){
		$sql = "SELECT id,
			    id_seccion,
			    id_usuario,
			    id_estado_articulo,
			    titulo,
			    latitud,
			    longitud,
			    fecha_cierre,
			    copete,
			    url_contenido,
			    contenido_adicional
			FROM articulo;";
	
		try{
				
			$articuloDB = $this->dataAccess->getOneResult($sql);
				
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
				
			return null;
		}
	
		return $this->convertCiudadDBToCiudadModel($articuloDB);
	}
	
	/**
	 * Convierte un articulo de la base de datos en un objeto ArticuloModel y lo devuelve
	 * */
	private function convertArticuloDBToArticuloModel($articuloDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$articuloModel = new ArticuloModel;
		$articuloModel->id = $articuloDB["id"];
		$articuloModel->id_seccion = $articuloDB["id_seccion"];
		$articuloModel->id_usuario = $articuloDB["id_usuario"];
		$articuloModel->id_estado_articulo = $articuloDB["id_estado_articulo"];
		$articuloModel->latitud = $articuloDB["latitud"];
		$articuloModel->longitud = $articuloDB["longitud"];
		$articuloModel->fecha_cierre = $articuloDB["fecha_cierre"];
		$articuloModel->copete = $articuloDB["copete"];
		$articuloModel->url_contenido = $articuloDB["url_contenido"];
		$articuloModel->contenido_adicional = $articuloDB["contenido_adicional"];
	
		return $articuloModel;
	}
}


?>