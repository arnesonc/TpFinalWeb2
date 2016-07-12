<?php

require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/ImagenModel.php");

class ImagenService{
	
	private $dataAccess = null;
	
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
			$logger->error($e);
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
		$imagen->id_articulo =$imagenDB["id_articulo"];
		$imagen->url = $imagenDB["url"];
		return $imagen;
		
	}

	public function insertImagen($id_articulo, $url_imagen){
		/* Convierto la variable de url en modelo */
		$imagenModel = new ImagenModel;

		$imagenModel->id_articulo = $id_articulo;
		$imagenModel->url = $url_imagen;

		$sql = " INSERT INTO imagen
				(id,
				id_articulo,
				url)
				VALUES
				(null,
				'$imagenModel->id_articulo',
				'$imagenModel->url');";

		try {

			// Ejecuta el insert en la BD
			$this->dataAccess->execute($sql);
		} catch (Exception $e) {
			$logger = Logger::getRootLogger();
			$logger->error($e);

			return false;
		}

		return true;
	}

	public function getImagenUrlByArticuloId($id_articulo){
		$sql = " SELECT url  FROM imagen WHERE id_articulo = $id_articulo;";

		try{

			$sqlResult = $this->dataAccess->getOneResult($sql);

		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;

		}
		return $sqlResult["url"];
	}
}

?>