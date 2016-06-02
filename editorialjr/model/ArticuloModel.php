<?php

require_once(__DIR__."/../service/UsuarioService.php");
require_once(__DIR__."/../service/EstadoArticuloService.php");
require_once(__DIR__."/../service/SeccionService.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class ArticuloModel{
	public $id;
	public $id_seccion;
	public $id_usuario;
	public $id_estado_articulo;
	public $titulo;
	public $latitud;
	public $longitud;
	public $fechaCierre;
	public $copete;
	public $urlContenido;
	public $contenidoAdicional;
	
	private $usuario;
	private $estado_articulo;
	private $seccion;
	
	
	/**
	 * Obtiene un objeto PaisModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getUsuario(){
	
		if(is_null($this->usuario)){
			$usuarioService = new UsuarioService;
		 	
			try {
	
				$this->usuario = $usuarioService->getUsuarioById($this->id_usuario);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->usuario;
	}
	
	/**
	 * Obtiene un objeto EstadoArticulo, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getEstadoArticulo(){
	
		if(is_null($this->estado_articulo)){
			$estadoArticuloService = new EstadoArticuloService;
	
			try {
	
				$this->estado_articulo = $estadoArticuloService->getEstadoArticuloById($this->id_estado_articulo);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->estado_articulo;
	}
	
	/**
	 * Obtiene un objeto Seccion, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getSeccion(){
	
		if(is_null($this->seccion)){
			$seccionService = new SeccionService;
	
			try {
	
				$this->seccion = $seccionService->getSeccionById($this->id_seccion);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->seccion;
	}
}
?>