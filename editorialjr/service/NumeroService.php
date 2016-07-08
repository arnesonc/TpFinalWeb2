<?php
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../common/AppConfig.php");
require_once (__DIR__ . "/../model/NumeroModel.php");
require_once (__DIR__ . "/../service/PublicacionService.php");
require_once (__DIR__ . "/../helpers/LoggerHelper.php");

class NumeroService {
	private $dataAccess = null;
	public function __construct() {
		$this->dataAccess = new DataAccess ();
	}

	/**
	 * Obtiene una NumeroModel por su id
	 */
	public function getNumeroById($id) {
		$sql = "SELECT
		id,
		id_publicacion,
		id_estado_numero,
		url_portada,
		fe_erratas,
		precio,
		fecha_publicado,
		numero_revista
		FROM numero
		WHERE
		id = $id;";

		try {

			$numeroDB = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );

			return null;
		}

		return $this->convertNumeroDBToNumeroModel ( $numeroDB );
	}

	/**
	 * Convierte un numero de la base de datos en un objeto NumeroModel y lo devuelve
	 */
	private function convertNumeroDBToNumeroModel($numeroDB) {

		/* Convierto el resultado de la BD a un objeto modelado */
		$numeroModel = new NumeroModel ();
		$numeroModel->id = $numeroDB ["id"];
		$numeroModel->id_publicacion = $numeroDB ["id_publicacion"];
		$numeroModel->id_estado_numero = $numeroDB ["id_estado_numero"];
		$numeroModel->url_portada = $numeroDB ["url_portada"];
		(is_null($numeroDB ["fe_erratas"])) ? $numeroModel->fe_erratas = null : $numeroModel->fe_erratas = utf8_encode ($numeroDB ["fe_erratas"]);
		$numeroModel->precio = $numeroDB ["precio"];
		$numeroModel->fecha_publicado = $numeroDB ["fecha_publicado"];
		$numeroModel->numero_revista = $numeroDB["numero_revista"];

		return $numeroModel;
	}

	/**
	 * Valida un objeto NumeroModel
	 */
	public function validateNumero($numeroModel) {
		$validationHelper = new ValidationHelper ();

		if ($validationHelper->validateNull ( $numeroModel->id_estado_numero ) || ! $validationHelper->validateIsSet ( $numeroModel->id_estado_numero ) || ! $validationHelper->validateNumber ( $numeroModel->id_estado_numero )) {
			return "Debe seleccionar un estado para el numero";
		}

		if (! $validationHelper->validateNull ( $numeroModel->url_portada ) && $validationHelper->validateIsSet ( $numeroModel->url_portada ) && ! $validationHelper->validateText ( $numeroModel->url_portada, 1, 100 )) {
			return "La url de la portada debe contener entre 1 y 100 caracteres.";
		}

		if (! $validationHelper->validateNull ( $numeroModel->fe_erratas ) && $validationHelper->validateIsSet ( $numeroModel->fe_erratas ) && ! $validationHelper->validateText ( $numeroModel->fe_erratas, 1, 500 )) {
			return "La fe de erratas puede contener como maximo 500 caracteres.";
		}

		if ($validationHelper->validateNull ( $numeroModel->precio ) || ! $validationHelper->validateIsSet ( $numeroModel->precio ) || ! $validationHelper->validateNumber ( $numeroModel->precio )) {
			return "Debe poner un precio numerico";
		}

		return "";
	}


	public function generateNumeroRevista($numeroModel){

		$sql = "SELECT
		count(*) + 1 numero_revista
		FROM
		numero
		WHERE
		id_publicacion = $numeroModel->id_publicacion
		GROUP BY id_publicacion;";

		$result = $this->dataAccess->getOneResult($sql);

		$numeroRevista = is_null($result) ? 1 : $result["numero_revista"];

		return $numeroRevista;
	}

	//Crea un directorio donde se alojaran los archivos. retorna el path del directorio creado.
	private function createPath($numeroModel){

		$publicacion = $numeroModel->getPublicacion ();
		$numeroRevista = $this->generateNumeroRevista($numeroModel);
		$pathname = $GLOBALS ['app_config'] ["ruta_publicaciones"] . $numeroModel->id_publicacion . "_" . $publicacion->nombre . "/numero" . $numeroRevista;

		return $pathname;
	}

	// Crea un nuevo numero, si hay error, retorna un mensaje, sino devuelve true o false, dependiendo de si pudo crear el directorio.
	public function createNumero($numeroModel) {
		// añade el path de la portada en su creacion sera generica.
		$numeroModel->url_portada = "./img/portada.png";
		$pathname = $this->createPath($numeroModel);
		mkdir ( $pathname, 0777, true );
		//añade el numero de revista en su creacion.
		$numeroModel->numero_revista = $this->generateNumeroRevista($numeroModel);
		$message = $this->validateNumero ( $numeroModel );

		if (empty ( $message )) {
			$idNumero = $this->insertNumero ( $numeroModel );
		} else {
			return $message;
		}
		return true;
	}

	/**
	 * Crea un numero a partir de los datos parametizados (por separado)
	 */

	public function createNumeroParametros($id_publicacion, $id_estado_numero, $fe_erratas, $precio) {
		$numeroModel = new NumeroModel ();
		$numeroModel->id_publicacion = $id_publicacion;
		$numeroModel->id_estado_numero = $id_estado_numero;
		$numeroModel->fe_erratas = $fe_erratas;
		$numeroModel->precio = $precio;
		return $this->createNumero ( $numeroModel );
	}

	// Inserta un numero, si tuvo exito devuelve su id
	// caso contrario devuelve falso
	private function insertNumero($numeroModel) {
		$url_portada = is_null ( $numeroModel->url_portada ) ? 'null' : "'$numeroModel->url_portada'";
		$fe_erratas = is_null ( $numeroModel->fe_erratas ) ? 'null' : "'$numeroModel->fe_erratas'";

		$sql = " INSERT INTO numero
				(
				id,
				id_publicacion,
				id_estado_numero,
				url_portada,
				fe_erratas,
				precio,
				fecha_publicado,
				numero_revista
				)
				VALUES
				(
				null,
				$numeroModel->id_publicacion,
				$numeroModel->id_estado_numero,
				$url_portada,
				$fe_erratas,
				$numeroModel->precio,
				null,
				$numeroModel->numero_revista
				);
				";
		try {
			// Ejecuta el insert en la BD
			$idNumero = $this->dataAccess->execute ( $sql, true );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return false;
		}

		return $idNumero;
	}

	/*
	 * Obtiene todos los numeros relacionados con una publicacion y los aloja en un array.
	 */
	public function getAllNumeros($id_publicacion) {
		$sql = " SELECT id,
    			id_publicacion,
    			id_estado_numero,
   				url_portada,
    			fe_erratas,
    			precio,
    			fecha_publicado,
    			numero_revista
				FROM numero WHERE id_publicacion = $id_publicacion;";
		// busca los numeros de una publicacion en la bd
		try {
			$numeroDBArray = $this->dataAccess->getMultipleResults ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

		$arrayNumeroModel = array ();

		foreach ( $numeroDBArray as $numeroDB ) {

			$numeroModel = $this->convertNumeroDBToNumeroModel ( $numeroDB );

			$arrayNumeroModel [] = $numeroModel;
		}

		return $arrayNumeroModel;
	}

	public function updateNumero($numeroModel){

		$sql = "UPDATE numero
		SET url_portada= '$numeroModel->url_portada',precio = $numeroModel->precio
		WHERE id= $numeroModel->id;";
		try {
			$this->dataAccess->execute ( $sql );
			return true;
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

	}

	public function editarFeErratas($idNumero,$feErratas){

		$numeroModel = $this->getNumeroById($idNumero);
		$estadoPublicado = 2;
		if($numeroModel->id_estado_numero == $estadoPublicado){
			$sql = "UPDATE numero
			SET fe_erratas= '$feErratas'
			WHERE id= $idNumero;";

			try {
				$this->dataAccess->execute ( $sql );
				return true;
			} catch ( Exception $e ) {
				$logger = Logger::getRootLogger ();
				$logger->error ( $e );
				return null;
			}
		} else {
			return("No se puede editar una FeErratas si el numero no fue publicado.");
		}

	}

	public function cambiarEstadoAPublicado($idNumero){

		$publicacionService = new PublicacionService();

		$numeroModel = $this->getNumeroById($idNumero);
		$estadoNoPublicado = 1;

		if($numeroModel->id_estado_numero == $estadoNoPublicado){

			$sql = "UPDATE numero
					SET id_estado_numero= 2,
					fecha_publicado = DATE(NOW())
					WHERE id= $idNumero;";
			try {
				//agregamos a su vez la urle de la portada en la publicacion.
				$publicacionService->addUltimaPortadaDelUltimoNumero($numeroModel->url_portada,$numeroModel->id_publicacion);
				$this->dataAccess->execute ( $sql );
				return "exito!";
			} catch ( Exception $e ) {
				$logger = Logger::getRootLogger ();
				$logger->error ( $e );
				return null;
			}

		} else {
			return("No se puede publicar un numero que ya fue publicado! doh.");
		}
	}

	/**
	* Obtiene la cantidad de compras de un numero por id publicacion. Devuelve los registros directos de la base de datos para armar el reporte de productos.
	*/
	public function getComprasUnitariasDeNumerosPorIdPublicacion($idPublicacion){
		$sql = "select
					    n.id,
					    en.descripcion estado,
					    n.numero_revista,
					    CONCAT('AR$ ', FORMAT(n.precio, 2)) precio,
					    case when n.fecha_publicado is null then 'Aún no publicado' else n.fecha_publicado end fecha_publicado,
					    count(cu.id_numero) cantidadCompras
					from
					    numero n
					        inner join
					    estado_numero en ON n.id_estado_numero = en.id
					        left join
					    compra_unitaria cu ON cu.id_numero = n.id
					where n.id_publicacion = $idPublicacion
					group by n.id;";

					try {
						$numeroDBArray = $this->dataAccess->getMultipleResults ( $sql );
					} catch ( Exception $e ) {
						$logger = Logger::getRootLogger ();
						$logger->error ( $e );
						return null;
					}

					return $numeroDBArray;
	}
}

?>
