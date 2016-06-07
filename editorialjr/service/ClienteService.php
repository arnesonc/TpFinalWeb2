<?php

require_once(__DIR__."/../common/LoggerHelper.php");
require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../common/ValidationHelper.php");
require_once(__DIR__."/../model/ClienteModel.php");

class ClienteService{
	
	private $dataAccess = null;
	
	function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene un ClienteModel por su Id
	 * */
	public function getClienteById($idCliente){
		
		$sql = "SELECT id,
				    email,
				    pass,
				    nombre,
				    apellido,
				    id_ciudad,
				    calle,
				    numero_calle,
				    codigo_postal,
				    piso,
				    departamento,
				    detalle_direccion,
				    id_estado_cliente
				FROM cliente
				WHERE id = $idCliente;";
		
		try{
				
			$clienteDB = $this->dataAccess->getOneResult($sql);
			
		}catch(Exception $e){
				
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;
		}
		
		return $this->convertClienteDBToClienteModel($clienteDB);
	}
	
	/**
	 * Convierte un clienteDB en un ClienteModel
	 * */
	private function convertClienteDBToClienteModel($clienteDB){
		
		$clienteModel = new ClienteModel;
		$clienteModel->id = $clienteDB["id"];
		$clienteModel->id_estado_cliente = $clienteDB["id_estado_cliente"];
		$clienteModel->id_ciudad = $clienteDB["id_ciudad"];
		$clienteModel->email = $clienteDB["email"];
		$clienteModel->pass = $clienteDB["pass"];
		$clienteModel->nombre = $clienteDB["nombre"];
		$clienteModel->apellido = $clienteDB["apellido"];
		$clienteModel->calle = $clienteDB["calle"];
		$clienteModel->numero_calle = $clienteDB["numero_calle"];
		$clienteModel->piso = $clienteDB["piso"];
		$clienteModel->departamento = $clienteDB["departamento"];
		$clienteModel->codigo_postal = $clienteDB["codigo_postal"];
		$clienteModel->detalle_direccion = $clienteDB["detalle_direccion"];
		
		return $clienteModel;
	}
	
	/**
	 *  Crea un cliente a partir de un objeto ClienteModel si pasa las validaciones, caso contrario devuelve
	 *  el mensaje de validacion correspondiente
	 **/
	public function createCliente($clienteModel){
	
		$message = $this->validateCliente($clienteModel);
	
		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if(empty($message)){
	
			$result = $this->insertCliente($clienteModel);
		}else{
			//En caso de ser invalido devuelve un mensaje de validacion
			$result= $message;
		}
	
		return $result;
	}
	
	/**
	 * Crea un cliente a partir de los datos parametizados (por separado)
	 **/
	public function createClienteParametros($email, $pass, $nombre, $apellido, $id_ciudad, $calle,
		$numero_calle, $codigo_postal, $piso, $departamento, $detalle_direccion, $id_estado_cliente){
	
			$clienteModel = new ClienteModel;
			$clienteModel->id_estado_cliente = $id_estado_cliente;
			$clienteModel->id_ciudad = $id_ciudad;
			$clienteModel->email = $email;
			$clienteModel->pass = $pass;
			$clienteModel->nombre = $nombre;
			$clienteModel->apellido = $apellido;
			$clienteModel->calle = $calle;
			$clienteModel->numero_calle = $numero_calle;
			$clienteModel->piso = $piso;
			$clienteModel->departamento = $departamento;
			$clienteModel->codigo_postal = $codigo_postal;
			$clienteModel->detalle_direccion = $detalle_direccion;

			return $this->createCliente($clienteModel);
	}
	
	/**
	 * Valida un objeto ClienteModel
	 **/
	private function validateCliente($clienteModel){
	
		$validationHelper = new ValidationHelper;
	
		if(is_null($clienteModel->email) 
				|| !isset($clienteModel->email) 
				||!$validationHelper->validateText($clienteModel->email, 1, 50)){
			return "El email no es válido. Debe poseer como máximo 50 caracteres.";
		}
		
		if(!filter_var($clienteModel->email, FILTER_VALIDATE_EMAIL)){
			return "El email ingresado no tiene un formato correcto.";
		}
		
		if(is_null($clienteModel->pass) 
				|| !isset($clienteModel->pass) 
				||!$validationHelper->validateText($clienteModel->pass, 1, 30)){
			return "La contraseña no es válida. Debe poseer como máximo 30 caracteres.";
		}
		
		if(is_null($clienteModel->nombre) 
				|| !isset($clienteModel->nombre) 
				||!$validationHelper->validateText($clienteModel->nombre, 1, 30)){
			return "El nombre no es válido. Debe poseer como máximo 30 caracteres.";
		}
		
		if(is_null($clienteModel->apellido) 
				|| !isset($clienteModel->apellido) 
				||!$validationHelper->validateText($clienteModel->apellido, 1, 30)){
			return "El apellido no es válido. Debe poseer como máximo 30 caracteres.";
		}
	
		if(is_null($clienteModel->id_ciudad)
				|| !isset($clienteModel->id_ciudad)
				|| !$validationHelper->validateNumber($clienteModel->id_ciudad)){
					return "Debe selecionar una ciudad para el cliente.";
		}
		
		if(is_null($clienteModel->calle)
				|| !isset($clienteModel->calle)
				||!$validationHelper->validateText($clienteModel->calle, 1, 30)){
					return "La calle no es válida. Debe poseer como máximo 30 caracteres.";
		}
		
		if(is_null($clienteModel->numero_calle)
				|| !isset($clienteModel->numero_calle)
				||!$validationHelper->validateText($clienteModel->numero_calle 	, 1, 30)){
					return "El número de la calle no es válid. Debe poseer como máximo 30 caracteres.";
		}
		
		if(is_null($clienteModel->codigo_postal)
				|| !isset($clienteModel->codigo_postal)
				||!$validationHelper->validateText($clienteModel->codigo_postal, 1, 11)){
					return "El código postal no es válido. Debe poseer como máximo 11 caracteres.";
		}
		
		if(is_null($clienteModel->id_estado_cliente)
				|| !isset($clienteModel->id_estado_cliente)
				|| !$validationHelper->validateNumber($clienteModel->id_estado_cliente)){
					return "Debe selecionar el estado del cliente.";
		}
		
		if(!is_null($clienteModel->piso) && !validateText($clienteModel->piso, 1, 5)){
			return "El piso no es válido. Debe poseer como máximo 5 caracteres.";
		}
		
		if(!is_null($clienteModel->departamento) && !validateText($clienteModel->departamento, 1, 5)){
			return "El departamento no es válido. Debe poseer como máximo 5 caracteres.";
		}
		
		if(!is_null($clienteModel->detalle_direccion) && !validateText($clienteModel->detalle_direccion, 1, 150)){
			return "El detalle de la dirección no es válido. Debe poseer como máximo 150 caracteres.";
		}
	
		return "";
	}
	
	/**
	 * Inserta un nuevo cliente a partir de un objeto ClienteModel, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 **/
	private function insertCliente($clienteModel){
	
		$pass = md5($clienteModel->pass);
		
		$sql = " INSERT INTO cliente
					(id,
					email,
					pass,
					nombre,
					apellido,
					id_ciudad,
					calle,
					numero_calle,
					codigo_postal,
					piso,
					departamento,
					detalle_direccion,
					id_estado_cliente)
					VALUES
					(null,
					'$clienteModel->email',
					'$pass',
					'$clienteModel->nombre',
					'$clienteModel->apellido',
					$clienteModel->id_ciudad,
					'$clienteModel->calle',
					$clienteModel->numero_calle,
					'$clienteModel->codigo_postal',
					'$clienteModel->piso',
					'$clienteModel->departamento',
					'$clienteModel->detalle_direccion',
					$clienteModel->id_estado_cliente);";
	
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