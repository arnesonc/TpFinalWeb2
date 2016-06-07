<?php

require_once(__DIR__."/../service/ClienteService.php");
require_once(__DIR__."/../service/ArticuloService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class LecturaArticulosModel{
	public $id;
	public $id_articulo;
	public $id_cliente;
	
	private $cliente;
	private $articulo;
	
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
	 * Obtiene un objeto ArticuloModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getArticulo(){
	
		if(is_null($this->articulo)){
			$articuloService = new ArticuloService;
	
			try {
	
				$this->articulo = $articuloService->getArticuloById($this->id_articulo);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->articulo;
	}
}
?>