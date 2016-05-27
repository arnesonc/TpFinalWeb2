<?php 

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/RolModel.php");

class RolService{
	
	/*
	 * Obtiene un usuario por su id y devuelve un objeto UsuarioModel
	 * */
	public function getRolById($idRol){
		
		$sql = " SELECT id, descripcion FROM rol WHERE id = $idRol;";
		
		$rolDB = DataAccess::getOneResult($sql);
		
		return self::convertRolDBToRolModel($rolDB);
	}
	
	/*
	 * Obtiene todos los roles en la base de datos y devuelve una lista de objetos RolModel
	 * */
	public function getAllRoles(){
		$sql = " SELECT id, descripcion FROM rol;";
		
		$rolDBArray = DataAccess::getMultipleResults($sql);
		
		$arrayRolModel = array();
		
		foreach ($rolDBArray as $rolDB) {
			$rol = self::convertRolDBToRolModel($rolDB);
			
			$arrayRolModel[] = $rol;
		}
		
		return $arrayRolModel;
	}
	
	/*
	 * Convierte un rol de la base de datos en un objeto RolModel y lo devuelve
	 * */
	private function convertRolDBToRolModel($rolDB){
		
		/* Convierto el resultado de la BD a un objeto modelado */
		$rol = new RolModel;
		$rol->id = $rolDB["id"];
		$rol->descripcion = $rolDB["descripcion"];
		
		return $rol;
	}
}

php?>