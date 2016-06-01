<?php

require_once(__DIR__."/../service/UsuarioService.php");
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
	
	//FIXME: Completar cuando exista el service de articulo
	private $seccion;
	private $estado_articulo;
	
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