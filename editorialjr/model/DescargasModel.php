<?php

require_once(__DIR__."/../service/ClienteService.php");
require_once(__DIR__."/../service/NumeroService.php");
require_once(__DIR__."/../common/LoggerHelper.php");

 class DescargasModel{
 	public $id;
 	public $id_numero;
 	public $id_cliente;
 	public $Fecha;
 	
 	private $cliente;
 	private $numero;
 	
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
 	 * Obtiene un objeto NumeroModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
 	 * */
 	public function getNumero(){
 	
 		if(is_null($this->numero)){
 			$numeroService = new NumeroService;
 				
 			try {
 	
 				$this->numero = $numeroService->getNumeroById($this->id_numero);
 	
 			}catch(Exeption $e){
 				$logger = Logger::getRootLogger();
 				$logger->error($e);
 				return null;
 			}
 		}
 	
 		return $this->numero;
 	}
 }
 ?>