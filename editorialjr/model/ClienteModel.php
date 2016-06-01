<?php

require_once(__DIR__."/../service/EstadoClienteService.php");

class ClienteModel{

	public $id;
	public $id_estado_cliente;
	public $id_ciudad;
	public $email;
	public $nombre;
	public $apellido;
	public $calle;
	public $numero;
	public $piso;
	public $departamento;
	public $codigo_postal;
	public $detalle_direccion;
	
	private $estado_cliente;
	
	/**
	 * Obtiene un objeto EstadoClienteModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getEstadoCliente(){
		
		if(is_null($this->estado_cliente)){
			$estadoClienteService = new EstadoClienteService;
			$this->estado_cliente = $estadoClienteService->getEstadoClienteById($this->id_estado_cliente);
		}
		
		return $this->estado_cliente;
	}
}

?>