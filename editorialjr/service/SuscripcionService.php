<?php
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../model/SuscripcionModel.php");
require_once (__DIR__ . "/../service/PublicacionService.php");
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
		$sql = " SELECT
		s.id,
		s.id_cliente,
		s.id_publicacion,
		s.id_tipo_suscripcion,
		s.precio,
		s.fecha,
		p.nombre nombrePublicacion,
		ts.cantidad_meses
		FROM
		suscripcion s
		inner join
		publicacion p ON s.id_publicacion = p.id
		inner join
		tipo_suscripcion ts ON s.id_tipo_suscripcion = ts.id
		WHERE s.id = $id;";

		try {

			$suscripcionDB = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}
		return $this->convertSuscripcionDBToSuscripcionModel ( $suscripcionDB );
	}

	public function getSuscripcionesByIdCliente($idCliente){
		$sql = " SELECT
		s.id,
		s.id_cliente,
		s.id_publicacion,
		s.id_tipo_suscripcion,
		s.precio,
		s.fecha,
		p.nombre nombrePublicacion,
		ts.cantidad_meses
		FROM
		suscripcion s
		inner join
		publicacion p ON s.id_publicacion = p.id
		inner join
		tipo_suscripcion ts ON s.id_tipo_suscripcion = ts.id
		WHERE s.id_cliente = $idCliente;";

		try {

			$suscripcionDBArray = $this->dataAccess->getMultipleResults($sql);
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

		$arraySuscripcionesModel = array ();

		foreach ( $suscripcionDBArray as $suscripcionDB ) {
			$arraySuscripcionesModel [] = $this->convertSuscripcionDBToSuscripcionModel($suscripcionDB);;
		}

		return $arraySuscripcionesModel;
	}


			public function suscribirCliente($idCliente,$idPublicacion){
				$suscripcionModel = new SuscripcionModel ();
				$publicacionService = new PublicacionService ();

				$suscripcionModel->id_cliente = $idCliente;
				$suscripcionModel->id_publicacion = $idPublicacion;
				$suscripcionModel->id_tipo_suscripcion = 3; //FIXME: hardcodeado, siempre suscribe por 6 meses.
				$suscripcionModel->precio = $publicacionService->getLastPrecio($idPublicacion);

				return $this->createSuscripcion($suscripcionModel); //devuelve true si se suscribio correctamente.

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
		$suscripcionModel->nombrePublicacion = $suscripcionDB ["nombrePublicacion"];
		$suscripcionModel->cantidad_meses = $suscripcionDB ["cantidad_meses"];

		return $suscripcionModel;
	}

	// ver comentarios en Cliente service (mismo metodo).
	public function createSuscripcion($suscripcionModel) {
		$result = $this->insertSuscripcion ( $suscripcionModel );
		return $result;
	}

	private function insertSuscripcion($suscripcionModel){

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
