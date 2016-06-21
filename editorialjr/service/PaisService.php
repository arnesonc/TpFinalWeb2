<?php
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../model/PaisModel.php");
require_once (__DIR__ . "/../helpers/LoggerHelper.php");
class PaisService {
	private $dataAccess = null;
	public function __construct() {
		$this->dataAccess = new DataAccess ();
	}

	/**
	 * Obtiene un PaisModel por su id
	 */
	public function getPaisById($idPais) {
		$sql = "SELECT id,
						descripcion
				FROM pais
				WHERE id = $idPais;";

		try {

			$paisDB = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );

			return null;
		}

		return $this->convertPaisDBToPaisModel ( $paisDB );
	}

	/**
	 * Convierte un pais de la base de datos en un objeto PaisModel y lo devuelve
	 */
	private function convertPaisDBToPaisModel($paisDB) {

		/* Convierto el resultado de la BD a un objeto modelado */
		$paisModel = new PaisModel ();
		$paisModel->id = $paisDB ["id"];
		$paisModel->descripcion = utf8_encode($paisDB ["descripcion"]);

		return $paisModel;
	}

	/* Obtiene un array con todos los paises */
	public function getAllPais() {
		$sql = "SELECT id,
				descripcion
				FROM pais
				ORDER BY descripcion;";

		try {
			$paisDBArray = $this->dataAccess->getMultipleResults($sql);

		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );

			return null;
		}

		$arrayPaisModel = array ();

		foreach ( $paisDBArray as $paisDB ) {

			$paisModel = $this->convertPaisDBToPaisModel($paisDB);

			$arrayPaisModel [] = $paisModel;
		}

		return $arrayPaisModel;
	}
}

?>
