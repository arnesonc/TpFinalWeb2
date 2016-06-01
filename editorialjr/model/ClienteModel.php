<?php

require_once(__DIR__."/../service/EstadoClienteService.php");
require_once(__DIR__."/../service/CiudadService.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class ClienteModel{

	public $id;
	public $id_estado_cliente;
	public $id_ciudad;
	public $email;
	public $nombre;
	public $apellido;
	public $calle;
	public $numero_calle;
	public $piso;
	public $departamento;
	public $codigo_postal;
	public $detalle_direccion;
	
	private $estado_cliente;
	private $ciudad;
	
	/**
	 * Obtiene un objeto EstadoClienteModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getEstadoCliente(){
		
		if(is_null($this->estado_cliente)){
			$estadoClienteService = new EstadoClienteService;
			try {
				
				$this->estado_cliente = $estadoClienteService->getEstadoClienteById($this->id_estado_cliente);
				
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
		
		return $this->estado_cliente;
	}
	
	/**
	 * Obtiene un objeto CiudadModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getCiudad(){
		
		if(is_null($this->ciudad)){
			$ciudadService = new CiudadService;
			$this->ciudad = $ciudadService->getCiudadById($this->id_ciudad);
		}
		
		return $this->ciudad;
	}
}

?>