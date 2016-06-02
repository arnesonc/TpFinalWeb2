<?php 

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/RolModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class RolService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/*
	 * Obtiene un rol por su id
	 * */
	public function getRolById($id){
		
		$sql = " SELECT id, descripcion FROM rol WHERE id = $id;";
		
		try{
		
			$rolDB = $this->dataAccess->getOneResult($sql);			
		
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;
		
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
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;
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