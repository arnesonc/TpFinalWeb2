<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/PublicacionModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class PublicacionService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una PublicacionModel por su id
	 */
	public function getPublicacionById($id){
		$sql = "SELECT id,
				    id_usuario,
				    nombre,
				    fecha_utlimo_numero,
				    url_ultima_portada,
				    destacado
				FROM publicacion
				WHERE id = $id;";
	
		try{
				
			$publicacionDB = $this->dataAccess->getOneResult($sql);
				
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
				
			return null;
		}
	
		return $this->convertPublicacionDBToPublicacionModel($publicacionDB);
	}
	
	/**
	 * Convierte un publicacion de la base de datos en un objeto PublicacionModel y lo devuelve
	 * */
	private function convertPublicacionDBToPublicacionModel($publicacionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$publicacionModel = new PublicacionModel;
		$publicacionModel->id = $publicacionDB["id"];
		$publicacionModel->id_usuario = $publicacionDB["id_usuario"];
		$publicacionModel->nombre = $publicacionDB["nombre"];
		$publicacionModel->fecha_utlimo_numero = $publicacionDB["fecha_utlimo_numero"];
		$publicacionModel->url_ultima_portada = $publicacionDB["url_ultima_portada"];
		$publicacionModel->destacado = $publicacionDB["destacado"];
	
		return $publicacionModel;
	}	
}

?>