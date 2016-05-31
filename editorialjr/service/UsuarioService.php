<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/UsuarioModel.php");

/**
	Clase que agrupa el modelado del objeto y los métodos que implementa.
**/
class UsuarioService{
	
	private $dataAccess = null;
	
	function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
		Obtiene un usuario por email
		Devuelve el usuario de la BD
	**/
	public function getUsuarioByEmail($email){
		
		$sql = " SELECT 
					id,
	    			id_estado_usuario,
	    			id_rol,
	    			email,
	    			pass,
	    			nombre,
	    			apellido
				FROM usuario
				WHERE email = '$email' and id_estado_usuario = 1;";

		//$usuarioBD = DataAccess::getOneResult($sql);

		$usuarioBD = $this->dataAccess->getOneResult($sql);
		
		/* Convierto el resultado de la BD a un objeto modelado */
		$usuarioModel = new UsuarioModel;
		$usuarioModel->id = $usuarioBD["id"];
		$usuarioModel->email = $usuarioBD["email"];
		$usuarioModel->pass = $usuarioBD["pass"];
		$usuarioModel->nombre = $usuarioBD["nombre"];
		$usuarioModel->apellido = $usuarioBD["apellido"];
		$usuarioModel->id_estado_usuario = $usuarioBD["id_estado_usuario"];
		$usuarioModel->id_rol = $usuarioBD["id_rol"];
		
		return $usuarioModel;
	}
}

?>