<?php 

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/RolModel.php");

class RolService{
	
	private $dataAccess = null;
	private $mensaje = "ha ocurrido un error.";
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/*
	 * Obtiene un usuario por su id y devuelve un objeto UsuarioModel
	 * */
	public function getRolById($idRol){
		
		$sql = " SELECT id, descripcion FROM rol WHERE id = $idRol;";
		
		try{
		
			$rolDB = $this->dataAccess->getOneResult($sql);			
		
		}catch(Exception $e){
			
			throw new Exception($mensaje);
		
		}
		return $this->convertRolDBToRolModel($rolDB);
	}
	
	/*
	 * Obtiene todos los roles en la base de datos y devuelve una lista de objetos RolModel
	 * */
	public function getAllRoles(){
		$sql = " SELECT id, descripcion FROM rol;";
		
		try{
			
			$rolDBArray = $this->dataAccess->getMultipleResults($sql);
		
		}catch(Exception $e){
			
			throw new Exception($mensaje);	
		
		}
		
		
		$arrayRolModel = array();
		
		foreach ($rolDBArray as $rolDB) {
		
			$rolModel = $this->convertRolDBToRolModel($rolDB);
			
			$arrayRolModel[] = $rolModel;
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

?>