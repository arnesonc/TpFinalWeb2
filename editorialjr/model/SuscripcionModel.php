<?php

require_once(__DIR__."/../service/PublicacionService.php");
require_once(__DIR__."/../service/TipoSuscripcionService.php");
require_once(__DIR__."/../service/ClienteService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class SuscripcionModel{
	public $id_cliente;
	public $id_publicacion;
	public $id_tipo_suscripcion;
	public $precio;
	public $fecha;
	
	private $cliente;
	private $publicacion;
	private $tipo_suscripcion;
	
	/**
	 * Obtiene un objeto ClienteModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getCliente(){
	
		if(is_null($this->cliente)){
			$clienteService = new ClienteService;
				
			try {
	
				$this->cliente = $clienteService->getClienteById($this->id_cliente);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->cliente;
	}
	
	/**
	 * Obtiene un objeto Publicacion, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getPublicacion(){
	
		if(is_null($this->publicacion)){
			$publicacionService = new PublicacionService;
	
			try {
	
				$this->publicacion = $publicacionService->getPublicacionById($this->id_publicacion);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->publicacion;
	}
	
	/**
	 * Obtiene un objeto TipoSuscripcion, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getTipoSuscripcion(){
	
		if(is_null($this->tipo_suscripcion)){
			$tipoSuscripcionService = new TipoSuscripcionService;
	
			try {
	
				$this->tipo_suscripcion = $tipoSuscripcionService->getTipoSuscripcionById($this->id_tipo_suscripcion);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->tipo_suscripcion;
	}
}
?>