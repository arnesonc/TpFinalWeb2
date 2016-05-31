<?php

require_once(__DIR__."/../service/RolService.php");

class UsuarioModel{
	public $id;
	public $email;
	public $pass;
	public $nombre;
	public $apellido;
	public $id_estado_usuario;
	public $id_rol;
	/* esta privado para obligar a usar el objeto $rol del modo $usuario->getRol()->descripcion */
	private $rol;
	public $estado_usuario;
	
	/*
	 * Obtiene el objeto rol relacionado con el usuario, si lo tiene en memoria ya instanciado, 
	 * devuelve ese, si no, lo va a buscar a la BD (si es null).
	 * Lazy loading, solo lo voy a buscar si no lo tengo y lo necesito.
	 * */
	public function getRol(){

		/* Si no esta instanciado, lo voy a buscar */
		if(is_null($rol)){
			$rolService = new RolService;
			$rol = $rolService->getRolById($this->id_rol);
		}
		
		return $rol;
	}
}

?>