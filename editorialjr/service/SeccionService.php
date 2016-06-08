<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/SeccionModel.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../helpers/ValidationHelper.php");

class SeccionService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una SeccionModel por su id
	 */
	public function getSeccionById($id){
		$sql = "SELECT id,
				    id_numero,
				    nombre
				FROM seccion
				WHERE id = $id;";
	
		try{
	
			$seccionDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertCiudadDBToCiudadModel($seccionDB);
	}
	
	/**
	 * Obtiene una lista de SeccionModel por id_numero
	 */
	public function getAllSeccionesByIdNumeo($idNumero){
		$sql = "SELECT id,
				id_numero,
				nombre
				FROM seccion
				WHERE id_numero = $idNumero;";
	
		try{
	
			$seccionDB = $this->dataAccess->getMultipleResults($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		$arraySeccionModel = array ();
		
		foreach ($seccionDBArray as $seccionDB) {
			
			$seccionModel = $this->convertSeccionDBToSeccionModel($seccionDB);
			
			$arraySeccionModel [] = $seccionModel;
		}
		
		return $arraySeccionModel;
	}
	
	/**
	 * Convierte una seccion de la base de datos en un objeto SeccionModel y lo devuelve
	 * */
	private function convertSeccionDBToSeccionModel($seccionDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$seccionModel = new SeccionModel;
		$seccionModel->id = $seccionDB["id"];
		$seccionModel->id_numero = $seccionDB["id_numero"];
		$seccionModel->nombre = $seccionDB["nombre"];
	
		return $seccionModel;
	}

	/**
	 * Valida un objeto ServiceModel
	 **/
	private function validateSeccion($seccionModel){
	
		$validationHelper = new ValidationHelper;
		
		if($validationHelper->validateNull($serviceModel->id_numero)
			||$validationHelper->validateIsSet($serviceModel->id_numero)
			||!$validationHelper->validateNumber($serviceModel->id_numero)
			){
			return "Debe seleccionar un número para la sección";
		}
		
		if($validationHelper->validateNull($serviceModel->nombre)
			||$validationHelper->validateIsSet($serviceModel->nombre)
			||!$validationHelper->validateText($serviceModel->nombre,5,50)
			){
			return "El nombre de la seccion debe tener entre 5 y 50 caracteres.";
		}

		return "";
	}


	/**
	 *  Crea un usuario a partir de un objeto UsuarioModel si pasa las validaciones, caso contrario devuelve
	 *  el mensaje de validacion correspondiente
	 **/
	public function createSeccion($seccionModel){
		
		$message = $this->validateSeccion($seccionModel);
		
		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if(empty($message)){
			
			$result = $this->insertSeccion($seccionModel);
		}else{
			//En caso de ser invalido devuelve un mensaje de validacion
			$result= $message;
		}

		return $result;
	}

	/**
	* Crea una seccion a partir de los datos parametizados (por separado)
	**/
	public function createSeccionParametros($id_numero, $nombre){
		
		$seccionModel = new SeccionModel;
		$seccionModel->id_numero = $id_numero;
		$seccionModel->nombre = $nombre;

		return $this->createSeccion($seccionModel);
	}


	/**
	 * Inserta una nueva seccion, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 **/
	private function insertSeccion($seccionModel){
		
		$sql = " INSERT INTO seccion
				(id,
				id_numero,
				nombre)
				VALUES
				(null,
				$seccionModel->id_numero,
				'$seccionModel->nombre');
				";

		try{
			
			// Ejecuta el insert en la BD
			$this->dataAccess->execute($sql);

		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return false;
			
		}
		
		return true;
	}
}

?>