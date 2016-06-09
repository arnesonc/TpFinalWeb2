<?php
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../model/SuscripcionModel.php");
require_once (__DIR__ . "/../helpers/LoggerHelper.php");
class SuscripcionService {
	private $dataAccess = null;
	public function __construct() {
		$this->dataAccess = new DataAccess ();
	}
	
	/*
	 * Obtiene una suscripcion por su id
	 */
	public function getSuscripcionById($id) {
		$sql = " SELECT id,
				    id_cliente,
				    id_publicacion,
				    id_tipo_suscripcion,
				    precio,
				    fecha
				FROM suscripcion
				WHERE id = $id;";
		
		try {
			
			$suscripcionDB = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}
		return $this->convertSuscripcionDBToSuscripcionModel ( $suscripcionDB );
	}
	
	/*
	 * Convierte una suscripcion de la base de datos en un objeto SuscripcionModel y lo devuelve
	 */
	private function convertSuscripcionDBToSuscripcionModel($suscripcionDB) {
		
		/* Convierto el resultado de la BD a un objeto modelado */
		$suscripcionModel = new SuscripcionModel ();
		$suscripcionModel->id = $suscripcionDB ["id"];
		$suscripcionModel->id_cliente = $suscripcionDB ["id_cliente"];
		$suscripcionModel->id_publicacion = $suscripcionDB ["id_publicacion"];
		$suscripcionModel->id_tipo_suscripcion = $suscripcionDB ["id_tipo_suscripcion"];
		$suscripcionModel->precio = $suscripcionDB ["precio"];
		$suscripcionModel->fecha = $suscripcionDB ["fecha"];
		
		return $suscripcionModel;
	}
	
	// ver comentarios en Cliente service (mismo metodo).
	public function createSuscripcion($suscripcionModel) {
		$result = $this->insertSuscripcion ( $suscripcionModel );
		return $result;
	}
	
	private function insertSuscripcion($suscripcionModel){
	
		$piso = is_null($clienteModel->piso) ? null : "'$articuloModel->latitud'";
		$departamento = is_null($clienteModel->departamento) ? null : "'$clienteModel->departamento'";
		$detalle_direccion = is_null($clienteModel->detalle_direccion) ? null : "'$clienteModel->detalle_direccion'";
	
		$sql = " INSERT 
		INTO suscripcion
		(
		id,
		id_cliente,
		id_publicacion,
		id_tipo_suscripcion,
		precio,
		fecha
		)
		VALUES
		(
		null,
		$suscripcionModel->id_cliente,
		$suscripcionModel->id_publicacion,
		$suscripcionModel->id_tipo_suscripcion,
		$suscripcionModel->precio,
		DATE(NOW())
		);";
	
		try{
			$this->dataAccess->execute($sql);
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return false;
		}
		return true;
		
	}
	
}
?>