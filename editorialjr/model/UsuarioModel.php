<?php

require_once(__DIR__."/../service/RolService.php");
require_once(__DIR__."/../service/EstadoUsuarioService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class UsuarioModel{
	public $id;
	public $email;
	public $pass;
	public $nombre;
	public $apellido;
	public $id_estado_usuario;
	public $id_rol;
	public $descripcion_rol;
	public $descripcion_estado_usuario;
	public $descripcion_ciudad;

	/* esta privado para obligar a usar el objeto $rol del modo $usuario->getRol()->descripcion */
	private $rol;
	private $estado_usuario;

	/**
	 * Obtiene el objeto rol relacionado con el usuario, si lo tiene en memoria ya instanciado,
	 * devuelve ese, si no, lo va a buscar a la BD (si es null).
	 * Lazy loading, solo lo voy a buscar si no lo tengo y lo necesito.
	 * */
	public function getRol(){

		/* Si no esta instanciado, lo voy a buscar */
		if(is_null($this->rol)){
			$rolService = new RolService;

			try{
				$this->rol = $rolService->getRolById($this->id_rol);
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}

		return $this->rol;
	}

	/**
	 * Obtiene un objeto EstadoUsuario, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getEstadoUsuario(){

		if(is_null($this->estado_usuario)){
			$estadoUsuarioService = new EstadoUsuarioService;

			try {

				$this->estado_usuario = $estadoUsuarioService->getEstadoUsuarioById($this->id_estado_usuario);

			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}

		return $this->estado_usuario;
	}
}

?>
