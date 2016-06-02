<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/DescargasModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class CompraUnitariaService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un DescargasModel por su id
	 */
	public function getDescargaById($id){
		$sql = "SELECT id,
				    id_numero,
				    id_cliente,
				    fecha
				FROM descargas
				WHERE id = $id;";
	
		try{
	
			$descargaDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertCompraUnitariaDBToCompraUnitariaModel($descargaDB);
	}
	
	/**
	 * Convierte una descarga de la base de datos en un objeto DescargaModel y lo devuelve
	 * */
	private function convertDescargaDBToDescargaModel($descargaDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$descargasModel = new DescargasModel;
		$descargasModel->id = $descargaDB["id"];
		$descargasModel->id_numero = $descargaDB["id_numero"];
		$descargasModel->id_cliente = $descargaDB["id_cliente"];
		$descargasModel->fecha = $descargaDB["fecha"];
	
		return $descargasModel;
	}
}

?>