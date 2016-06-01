<?php

class SuscripcionModel{
	public $id_cliente;
	public $id_publicacion;
	public $id_tipo_suscripcion;
	public $precio;
	public $fecha;
	
	private $cliente;
	
	//FIXME: Completar cuando exista el service
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
}
?>