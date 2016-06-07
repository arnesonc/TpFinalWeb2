<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/PublicacionModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class PublicacionService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una PublicacionModel por su id
	 */
	public function getPublicacionById($id){
		$sql = "SELECT id,
				    id_usuario,
				    nombre,
				    fecha_utlimo_numero,
				    url_ultima_portada,
				    destacado
				FROM publicacion
				WHERE id = $id;";
	
		try{
				
			$publicacionDB = $this->dataAccess->getOneResult($sql);
				
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
				
			return null;
		}
	
		return $this->convertPublicacionDBToPublicacionModel($publicacionDB);
	}
	
	/**
	 * Convierte un publicacion de la base de datos en un objeto PublicacionModel y lo devuelve
	 * */
	private function convertPublicacionDBToPublicacionModel($publicacionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$publicacionModel = new PublicacionModel;
		$publicacionModel->id = $publicacionDB["id"];
		$publicacionModel->id_usuario = $publicacionDB["id_usuario"];
		$publicacionModel->nombre = $publicacionDB["nombre"];
		$publicacionModel->fecha_utlimo_numero = $publicacionDB["fecha_utlimo_numero"];
		$publicacionModel->url_ultima_portada = $publicacionDB["url_ultima_portada"];
		$publicacionModel->destacado = $publicacionDB["destacado"];
	
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
	 * $publicacionModel = new PublicacionModel;
		$publicacionModel->id = $publicacionDB["id"];
		$publicacionModel->id_usuario = $publicacionDB["id_usuario"];
		$publicacionModel->nombre = $publicacionDB["nombre"];
		$publicacionModel->fecha_utlimo_numero = $publicacionDB["fecha_utlimo_numero"];
		$publicacionModel->url_ultima_portada = $publicacionDB["url_ultima_portada"];
		$publicacionModel->destacado = $publicacionDB["destacado"];
	 */
	private function validatePublicacion($publicacionModel) {
		$validationHelper = new ValidationHelper ();
	
		if ($validationHelper->validateNull ( $publicacionModel->id_usuario ) 
				|| $validationHelper->validateIsSet ( $publicacionModel->id_usuario ) 
				|| ! $validationHelper->validateNumber ( $publicacionModel->id_usuario )) {
			return "Debe seleccionar un editor para la publicacion";
		}
		
		if ($validationHelper->validateNull ( $publicacionModel->nombre ) 
				|| !$validationHelper->validateIsSet ( $publicacionModel->nombre ) 
				|| !$validationHelper->validateText ( $publicacionModel->nombre, 5, 50 )) {
			return "El nombre de la publicacion es obligatorio y debe contener entre 5 y 50 caracteres.";
		}
		
		if (!$validationHelper->validateNull ( $publicacionModel->nombre )
				&& $validationHelper->validateIsSet ( $publicacionModel->nombre )
				&& ! $validationHelper->validateText ( $publicacionModel->nombre, 5, 200 )) {
					return "Se debe especificar la url de la ultima portada";
		}
	//FIXME:falta checkdate!
		if ($validationHelper->validateNull ( $publicacionModel->destacado )
				|| $validationHelper->validateIsSet ( $publicacionModel->destacado )
				|| ! $validationHelper->validateBoolean ( $publicacionModel->destacado )) {
					return "No se conoce el estado de Publicacion destacada";
		}
	
		return "";
	}
	
	
	public function createNumero($numeroModel) {
		$message = $this->validateNumero ( $numeroModel );
	
		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if (empty ( $message )) {
				
			$result = $this->insertNumero ( $numeroModel );
		} else {
			// En caso de ser invalido devuelve un mensaje de validacion
			$result = $message;
		}
	
		return $result;
	}
	
	/**
	 * Crea una seccion a partir de los datos parametizados (por separado)
	 */
	public function createNumeroParametros($id_numero, $nombre) {
		$seccionModel = new SeccionModel ();
		$seccionModel->id_numero = $id_numero;
		$seccionModel->nombre = $nombre;
	
		return $this->createSeccion ( $seccionModel );
	}
	
	/**
	 * Inserta una nueva seccion, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 * class NumeroModel{
	 * public $id;
	 * public $id_publicacion;
	 * public $id_estado_numero;
	 * public $url_portada;
	 * public $fe_erratas;
	 * public $precio;
	 *
	 * private $estado_numero;
	 * private $publicacion;
	 */
	private function insertNumero($numeroModel) {
		$sql = " INSERT INTO numero
		(id,
		id_publicacion,
		id_estado_numero,
		url_portada,
		fe_erratas,
		precio,
		fecha_publicado
		)
		VALUES
		(null,
		$numeroModel->id,
		$numeroModel->id_publicacion,
		$numeroModel->id_estado_numero,
		$numeroModel->url_portada,
		$numeroModel->fe_erratas,
		$numeroModel->precio,
		$numeroModel->fecha_publicado
		);
		";
	
		try {
				
			// Ejecuta el insert en la BD
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