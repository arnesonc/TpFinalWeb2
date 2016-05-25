<?php

require_once(__DIR__."/../common/DataAccess.php");

class UsuarioService{

/*	private $dataAccess = null;

	function __construct(){

		$dataAccess = new DataAccess;		

		if(is_null($dataAccess)){
			die("DataAccess null");	
		}
	}
*/	
	/**
		Obtiene un usuario por Id
		Devuelve el usuario de la BD
		TODO: Devolver objeto usuario
	**/
	public function getUsuarioById($id){
		
		$dataAccess = new DataAccess;		
		
		$sql = " select * from usuarios where idusuario = $id";

		$usuario = $dataAccess->getOneResult($sql);

		return $usuario;
	}
}

//$usuarioService = new UsuarioService;
//$usuarioService->getUsuarioById(1);

?>