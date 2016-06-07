<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/ArticuloModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");
require_once(__DIR__."/../common/ValidationHelper.php");

class ArticuloService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un ArticuloModel por su id
	 */
	public function getArticuloById($id){
		$sql = "SELECT id,
			    id_seccion,
			    id_usuario,
			    id_estado_articulo,
			    titulo,
			    latitud,
			    longitud,
			    fecha_cierre,
			    copete,
			    url_contenido,
			    contenido_adicional
			FROM articulo
			WHERE id = $id;";
	
		try{
				
			$articuloDB = $this->dataAccess->getOneResult($sql);
				
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
				
			return null;
		}
	
		return $this->convertCiudadDBToCiudadModel($articuloDB);
	}
	
	/**
	 * Convierte un articulo de la base de datos en un objeto ArticuloModel y lo devuelve
	 * */
	private function convertArticuloDBToArticuloModel($articuloDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$articuloModel = new ArticuloModel;
		$articuloModel->id = $articuloDB["id"];
		$articuloModel->id_seccion = $articuloDB["id_seccion"];
		$articuloModel->id_usuario = $articuloDB["id_usuario"];
		$articuloModel->id_estado_articulo = $articuloDB["id_estado_articulo"];
		$articuloModel->titulo = $articuloDB["titulo"];
		$articuloModel->latitud = $articuloDB["latitud"];
		$articuloModel->longitud = $articuloDB["longitud"];
		$articuloModel->fecha_cierre = $articuloDB["fecha_cierre"];
		$articuloModel->copete = $articuloDB["copete"];
		$articuloModel->url_contenido = $articuloDB["url_contenido"];
		$articuloModel->contenido_adicional = $articuloDB["contenido_adicional"];
	
		return $articuloModel;
	}
	
	/**
	 *  Crea un articulo a partir de un objeto ArticuloModel si pasa las validaciones, caso contrario devuelve
	 *  el mensaje de validacion correspondiente
	 **/
	public function createArticulo($articuloModel){
	
		$message = $this->validateArticulo($articuloModel);
	
		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if(empty($message)){
				
			$result = $this->insertArticulo($articuloModel);
		}else{
			//En caso de ser invalido devuelve un mensaje de validacion
			$result= $message;
		}
	
		return $result;
	}
	
	/**
	 * Crea un articulo a partir de los datos parametizados (por separado)
	 **/
	public function createArticuloParametros($id_seccion, $id_usuario, $id_estado_articulo, $titulo, 
			$latitud, $longitud, $fecha_cierre, $copete, $url_contenido, $contenido_adicional){
	
		$articuloModel = new ArticuloModel;
		$articuloModel->id_seccion = $id_seccion;
		$articuloModel->id_usuario = $id_usuario;
		$articuloModel->id_estado_articulo = $id_estado_articulo;
		$articuloModel->titulo = $titulo;
		$articuloModel->latitud = $latitud;
		$articuloModel->longitud = $longitud;
		$articuloModel->fecha_cierre = $fecha_cierre;
		$articuloModel->copete = $copete;
		$articuloModel->url_contenido = $url_contenido;
		$articuloModel->contenido_adicional = $contenido_adicional;

		return $this->createArticulo($articuloModel);
	}
	
	/**
	 * Valida un objeto ArticuloModel
	 **/
	private function validateArticulo($articuloModel){
	
		$validationHelper = new ValidationHelper;
	
		if(is_null($articuloModel->id_seccion) 
				|| !isset($articuloModel->id_seccion) 
				|| !$validationHelper->validateNumber($articuloModel->id_seccion)){
			return "Debe selecionar al menos una sección.";
		}
		
		if(is_null($articuloModel->id_usuario)
				|| !isset($articuloModel->id_usuario)
				|| !$validationHelper->validateNumber($articuloModel->id_usuario)){
					return "Debe selecionar un usuario propietario del artículo.";
		}
		
		if(is_null($articuloModel->id_estado_articulo)
				|| !isset($articuloModel->id_estado_articulo)
				|| !$validationHelper->validateNumber($articuloModel->id_estado_articulo)){
					return "Debe selecionar el estado del artículo.";
		}
		
		if(!is_null($articuloModel->titulo)	&& !validateText($articuloModel->titulo, 1, 100)){
					return "El título no es válido. Debe poseer como máximo 100 caracteres.";
		}
		
		if(!is_null($articuloModel->latitud) && !validateText($articuloModel->latitud, 1, 100)){
			return "La latitud no es válida. Debe poseer como máximo 100 caracteres.";
		}
		
		if(!is_null($articuloModel->longitud) && !validateText($articuloModel->longitud, 1, 100)){
			return "La longitud no es válida. Debe poseer como máximo 100 caracteres.";
		}
		
		if(!is_null($articuloModel->copete)	&& !validateText($articuloModel->copete, 1, 200)){
			return "El copete no es válido. Debe poseer como máximo 200 caracteres.";
		}
		
		if(!is_null($articuloModel->url_contenido)	&& !validateText($articuloModel->url_contenido, 1, 100)){
			return "La url del contenido no es válida. Debe poseer como máximo 100 caracteres.";
		}
		
		if(!is_null($articuloModel->contenido_adicional) && !validateText($articuloModel->contenido_adicional, 1, 1000)){
			return "El contenido adicional no es válido. Debe poseer como máximo 1000 caracteres.";
		}
	
		return "";
	}
	
	/**
	 * Inserta un nuevo articulo a partir de un objeto ArticuloModel, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 **/
	private function insertArticulo($articuloModel){
	
		$sql = " INSERT INTO articulo
				(id,
				id_seccion,
				id_usuario,
				id_estado_articulo,
				titulo,
				latitud,
				longitud,
				fecha_cierre,
				copete,
				url_contenido,
				contenido_adicional)
				VALUES
				(null,
				$articuloModel->id_seccion,
				$articuloModel->id_usuario,
				$articuloModel->id_estado_articulo,
				'$articuloModel->titulo',
				'$articuloModel->latitud',
				'$articuloModel->longitud',
				'$articuloModel->fecha_cierre',
				'$articuloModel->copete',
				'$articuloModel->url_contenido',
				'$articuloModel->contenido_adicional');";
	
		try{
				
			// Ejecuta el insert en la BD
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