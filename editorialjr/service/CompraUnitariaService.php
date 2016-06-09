<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/CompraUnitariaModel.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class CompraUnitariaService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un CompraUnitariaModel por su id
	 */
	public function getCompraUnitariaByIdCliente($idCliente){
		$sql = "SELECT id_cliente,
				    id_numero,
				    fecha
				FROM compra_unitaria
				WHERE id_cliente = $idCliente;";
	
		try{
	
			$compraUnitariaDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertCompraUnitariaDBToCompraUnitariaModel($compraUnitariaDB);
	}
	
	/**
	 * Convierte una compra unitaria de la base de datos en un objeto CompraUnitariaModel y lo devuelve
	 * */
	private function convertCompraUnitariaDBToCompraUnitariaModel($compraUnitariaDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$compraUnitariaModel = new CompraUnitariaModel;
		$compraUnitariaModel->id_cliente = $compraUnitariaDB["id_cliente"];
		$compraUnitariaModel->id_numero = $compraUnitariaDB["id_numero"];
		$compraUnitariaModel->fecha = $compraUnitariaDB["fecha"];
	
		return $compraUnitariaModel;
	}
	
	public function createCompraUnitaria($compraUnitariaModel){
		$result = $this->insertCompraUnitaria ( $compraUnitariaModel );
		return $result;
	}
	
	private function insertCompraUnitaria($compraUnitariaModel){
		//ver comentarios en articuloService para el mismo tipo de metodo.
		$sql = " INSERT 
		INTO compra_uitaria
		(
		id_cliente,
		id_numero,
		fecha
		)
		VALUES
		($compraUnitariaModel->id_cliente,
		$compraUnitariaModel->id_numero,
		DATE(NOW())
		);";
		
		try {	
			$this->dataAccess->execute ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );	
			return false;
		}
		return true;
	}
	
}

?>