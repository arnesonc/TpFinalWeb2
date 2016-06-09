<?php
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../model/PublicacionModel.php");
require_once (__DIR__ . "/../helpers/LoggerHelper.php");
require_once (__DIR__ . "/../model/NumeroModel.php");
class PublicacionService {
	private $dataAccess = null;
	public function __construct() {
		$this->dataAccess = new DataAccess ();
	}
	
	/**
	 * Obtiene una PublicacionModel por su id
	 */
	public function getPublicacionById($id) {
		$sql = "SELECT id,
				    id_usuario,
				    nombre,
				    fecha_utlimo_numero,
				    url_ultima_portada,
				    destacado
				FROM publicacion
				WHERE id = $id;";
		
		try {
			
			$publicacionDB = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			
			return null;
		}
		
		return $this->convertPublicacionDBToPublicacionModel ( $publicacionDB );
	}
	
	/**
	 * Convierte un publicacion de la base de datos en un objeto PublicacionModel y lo devuelve
	 */
	private function convertPublicacionDBToPublicacionModel($publicacionDB) {
		
		/* Convierto el resultado de la BD a un objeto modelado */
		$publicacionModel = new PublicacionModel ();
		$publicacionModel->id = $publicacionDB ["id"];
		$publicacionModel->id_usuario = $publicacionDB ["id_usuario"];
		$publicacionModel->nombre = utf8_encode($publicacionDB ["nombre"]);
		$publicacionModel->fecha_utlimo_numero = $publicacionDB ["fecha_utlimo_numero"];
		$publicacionModel->url_ultima_portada = $publicacionDB ["url_ultima_portada"];
		$publicacionModel->destacado = $publicacionDB ["destacado"];
		
		return $publicacionModel;
	}
	
	/*
	 * Obtiene todas las publicaciones de la base de datos
	 */
	public function getAllPublicaciones() {
		$sql = " SELECT id,
    			id_usuario,
   				nombre,
    			fecha_utlimo_numero,
    			url_ultima_portada,
    			destacado
				FROM publicacion;
				";
		
		try {
			$publicacionDBArray = $this->dataAccess->getMultipleResults ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}
		
		$arrayPublicacionModel = array ();
		
		foreach ( $publicacionDBArray as $publicacionDB ) {
			
			$publicacionModel = $this->convertPublicacionDBToPublicacionModel ( $publicacionDB );
			
			$arrayPublicacionModel [] = $publicacionModel;
		}
		
		return $arrayPublicacionModel;
	}
	
	/**
	 * Valida un objeto Publicacion Model
	 */
	private function validatePublicacion($publicacionModel) {
		$validationHelper = new ValidationHelper ();
		
		if ($validationHelper->validateNull ( $publicacionModel->id_usuario ) || $validationHelper->validateIsSet ( $publicacionModel->id_usuario ) || ! $validationHelper->validateNumber ( $publicacionModel->id_usuario )) {
			return "Debe seleccionar un editor para la publicacion";
		}
		
		if ($validationHelper->validateNull ( $publicacionModel->nombre ) || ! $validationHelper->validateIsSet ( $publicacionModel->nombre ) || ! $validationHelper->validateText ( $publicacionModel->nombre, 5, 50 )) {
			return "El nombre de la publicacion es obligatorio y debe contener entre 5 y 50 caracteres.";
		}
		
		if (! $validationHelper->validateNull ( $publicacionModel->nombre ) && $validationHelper->validateIsSet ( $publicacionModel->nombre ) && ! $validationHelper->validateText ( $publicacionModel->nombre, 5, 200 )) {
			return "Se debe especificar la url de la ultima portada";
		}

		if ($validationHelper->validateNull ( $publicacionModel->destacado ) || $validationHelper->validateIsSet ( $publicacionModel->destacado ) || ! $validationHelper->validateBoolean ( $publicacionModel->destacado )) {
			return "No se conoce el estado de Publicacion destacada";
		}
		
		return "";
	}
	/*
	 * Crea una publicacion obligando a crear un numero
	 */
	public function createPublicacionNumero($publicacionModel, $numeroModel) {
		
		$messagePublicacion = $this->validatePublicacion ( $publicacionModel );
		
		if (empty ( $messagePublicacion )) {
			return $messagePublicacion;
		}
		
		$numeroService = new NumeroService ();
		$messageNumero = $numeroService->validateNumero ( $numeroModel );
		
		if (empty ( $messageNumero )) {
			return $messageNumero;
		}
		
		try{
			$idPublicacion = $this->insertPublicacion ( $publicacionModel );
			$numeroModel->id_publicacion = $idPublicacion;
			$numeroService->createNumero( $numeroModel );
			
		}catch(Exception $e){
			return $e;
		}
		
		return "se creo publicacion y numero";
	}
	
	// TODO: se puede agregar crear publicacion por parametros.
	
	/**
	 * Inserta una nueva seccion, si tuvo exito devuelve el id de la publicacion
	 * caso contrario devuelve falso
	 */
	private function insertPublicacion($PublicacionModel) {
		
		$sql = " INSERT INTO publicacion
		(id,
    	id_usuario,
   		nombre,
    	destacado
		)
		VALUES
		(null,
		$PublicacionModel->id_usuario,
		'$PublicacionModel->nombre',
		'$PublicacionModel->destacado'
		);
		";
		try {
			// Ejecuta el insert en la BD
			$idPublicacion = $this->dataAccess->execute ( $sql, true );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return false;
		}
		return $idPublicacion;
	}
	
	public function getLastFecha($id_publicacion) {
	
		$sql = "SELECT
				MAX(fecha_publicado) as fecha_publicado
				FROM numero WHERE id_publicacion = $id_publicacion;";
		//busca los numeros de una publicacion en la bd
		try {
			$ultimaFechaDePublicacionDadaDB = $this->dataAccess->getOneResult( $sql )["fecha_publicado"];
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}
		return $ultimaFechaDePublicacionDadaDB;
	}
}

?>