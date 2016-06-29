<?php
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../model/RegionModel.php");
require_once (__DIR__ . "/../helpers/LoggerHelper.php");
class RegionService {
	private $dataAccess = null;
	public function __construct() {
		$this->dataAccess = new DataAccess ();
	}

	/**
	 * Obtiene una RegionModel por su id
	 */
	public function getRegionById($idRegion) {
		$sql = "SELECT id,
						id_pais,
						descripcion
				FROM region
				WHERE id = $idRegion;";

		try {

			$regionDB = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );

			return null;
		}

		return $this->convertRegionDBToRegionModel ( $regionDB );
	}

	/**
	 * Convierte una region de la base de datos en un objeto RegionModel y lo devuelve
	 */
	private function convertRegionDBToRegionModel($regionDB) {

		/* Convierto el resultado de la BD a un objeto modelado */
		$regionModel = new RegionModel ();
		$regionModel->id = $regionDB ["id"];
		$regionModel->id_pais = $regionDB ["id_pais"];
		$regionModel->descripcion = utf8_encode($regionDB ["descripcion"]);

		return $regionModel;
	}

	/**
	 * *Obtiene un array de regiones por id de pais.
	 */
	public function getRegionesByIdPais($idPais) {

		$sql = "SELECT id,
					id_pais,
					descripcion
				FROM region
				WHERE id_pais = $idPais
				ORDER BY descripcion;";

		try {

			$regionDBArray = $this->dataAccess->getMultipleResults ( $sql );

		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );

			return null;
		}

		$arrayRegionModel = array ();

		foreach ( $regionDBArray as $regionDB ) {

			$regionModel = $this->convertRegionDBToRegionModel ( $regionDB );

			$arrayRegionModel [] = $regionModel;
		}

		return $arrayRegionModel;
	}
}

?>
