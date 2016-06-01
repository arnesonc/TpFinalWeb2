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
	
}

?>