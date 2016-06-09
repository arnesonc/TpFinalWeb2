<?php

require_once(__DIR__."/../service/UsuarioService.php");
require_once(__DIR__."/../service/NumeroService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class PublicacionModel{
	public $id;
	public $id_usuario;
	public $nombre;
	public $destacado;
	public $url_ultima_portada;
	public $fecha_ultimo_numero;
	private $usuario;
	
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
}
?>