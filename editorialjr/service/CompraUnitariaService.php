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
	public function getComprasUnitariasByIdCliente($idCliente){
		$sql = "SELECT id_cliente, id_numero, fecha, p.nombre nombrePublicacion
				from compra_unitaria cu
				left join numero n on cu.id_numero = n.id
				left join publicacion p on n.id_publicacion = p.id
				WHERE id_cliente = $idCliente;";

		try{

			$comprasUnitariasDBArray = $this->dataAccess->getMultipleResults($sql);

		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);

			return null;
		}

		$arrayComprasUnitariasModel = array ();

		foreach ( $comprasUnitariasDBArray as $compraUnitariaDB ) {
			$compraUnitariaModel = $this->convertCompraUnitariaDBToCompraUnitariaModel($compraUnitariaDB);
			$compraUnitariaModel->nombrePublicacion = $compraUnitariaDB["nombrePublicacion"];
			$arrayComprasUnitariasModel [] = $compraUnitariaModel;
		}

		return $arrayComprasUnitariasModel;
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
		INTO compra_unitaria
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
