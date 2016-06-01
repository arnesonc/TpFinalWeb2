<?php
require_once(__DIR__."/../config/log4php/src/main/php/Logger.php");
Logger::configure(dirname(__FILE__).'/../config/log4php.properties');
require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/ImagenModel.php");

class ImagenService{
	
	private $dataAccess = null;
	private $mensaje = "ha ocurrido un error.";
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	public function getImagenById($idImagen){
		$sql = " SELECT id, id_articulo, url  FROM imagen WHERE id = $idImagen;";

		try{
		
			$imagenDB = $this->dataAccess->getOneResult($sql);
		
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;
		
		}
		return $this->convertImagenDBToImagenModel($imagenDB);
	}

	public function getAllImagesByIdArticulo($idArticulo){
	
		$sql = " SELECT id, url, id_articulo FROM imagen I  WHERE I.id_articulo = $idArticulo;";
	
		try{
	
			$imagenDBArray = $this->dataAccess->getMultipleResults($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($mensaje);
			return null;
		}
	
	
		$arrayImagenModel = array();
	
		foreach ($imagenDBArray as $imagenDB) {
	
			$imagenModel = $this->convertImagenDBToImagenModel($imagenDB);
	
			$arrayImagenModel[] = $imagenModel;
		}
	
		return $arrayImagenModel;
	}
	
	private function convertImagenDBToImagenModel($imagenDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$imagen = new ImagenModel;
		$imagen->id = $imagenDB["id"];
		$imagen->idArticulo =$imagenDB["id_articulo"];
		$imagen->url = $imagenDB["url"];
		return $imagen;
		
	}
	

	
}

?>