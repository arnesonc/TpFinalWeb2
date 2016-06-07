<?php

require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/NumeroModel.php");
require_once(__DIR__."/../common/LoggerHelper.php");

class NumeroService{
	
	private $dataAccess = null;
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	/**
	 * Obtiene una NumeroModel por su id
	 */
	public function getNumeroById($id){
		$sql = "SELECT id,
				    id_publicacion,
				    id_estado_numero,
				    url_portada,
				    fe_erratas,
				    precio,
				    fecha_publicado
				FROM numero
				WHERE id = $id;";
	
		try{
	
			$numeroDB = $this->dataAccess->getOneResult($sql);
	
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
	
			return null;
		}
	
		return $this->convertNumeroDBToNumeroModel($numeroDB);
	}
	
	/**
	 * Convierte un numero de la base de datos en un objeto NumeroModel y lo devuelve
	 * */
	private function convertNumeroDBToNumeroModel($numeroDB){
	
		/* Convierto el resultado de la BD a un objeto modelado */
		$numeroModel = new NumeroModel;
		$numeroModel->id = $numeroDB["id"];
		$numeroModel->id_publicacion = $numeroDB["id_publicacion"];
		$numeroModel->id_estado_numero = $numeroDB["id_estado_numero"];
		$numeroModel->url_portada = $numeroDB["url_portada"];
		$numeroModel->fe_erratas = $numeroDB["fe_erratas"];
		$numeroModel->precio = $numeroDB["precio"];
		$numeroModel->fecha_publicado = $numeroDB["fecha_publicado"];
	
		return $numeroModel;
	}


		/**
	 * Valida un objeto NumeroModel
	 **/
	private function validateNumero($numeroModel){
	
		$validationHelper = new ValidationHelper;
		
		if($validationHelper->validateNull($numeroModel->id_publicacion)
			||$validationHelper->validateIsSet($numeroModel->id_publicacion)
			||!$validationHelper->validateNumber($numeroModel->id_publicacion)
			){
			return "Debe seleccionar una publicacion para el numero";
		}
		
		if($validationHelper->validateNull($numeroModel->id_estado_numero)
			||$validationHelper->validateIsSet($numeroModel->id_estado_numero)
			||!$validationHelper->validateNumber($numeroModel->id_estado_numero)
			){
			return "Debe seleccionar un estado para el numero";
		}

		if(!$validationHelper->validateNull($numeroModel->url_portada)
			&&$validationHelper->validateIsSet($numeroModel->url_portada)
			&&!$validationHelper->validateText($numeroModel->url_portada,1,100)
			){
			return "La url de la portada debe contener entre 1 y 100 caracteres.";
		}

		if(!$validationHelper->validateNull($numeroModel->fe_erratas)
			&&$validationHelper->validateIsSet($numeroModel->fe_erratas)
			&&!$validationHelper->validateText($numeroModel->fe_erratas,1,500)
			){
			return "La fe de erratas puede contener como maximo 500 caracteres.";
		}

		if($validationHelper->validateNull($numeroModel->precio)
			||$validationHelper->validateIsSet($numeroModel->precio)
			||!$validationHelper->validateNumber($numeroModel->precio)
			){
			return "Debe poner un precio numerico";
		}


		return "";
	}

	public function createNumero($numeroModel){
		
		$message = $this->validateNumero($numeroModel);
		
		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if(empty($message)){
			
			$result = $this->insertNumero($numeroModel);
		}else{
			//En caso de ser invalido devuelve un mensaje de validacion
			$result= $message;
		}

		return $result;
	}

	/**
	* Crea una seccion a partir de los datos parametizados (por separado)
	**/
	public function createNumeroParametros($id_numero, $nombre){
		
		$seccionModel = new SeccionModel;
		$seccionModel->id_numero = $id_numero;
		$seccionModel->nombre = $nombre;

		return $this->createSeccion($seccionModel);
	}


	/**
	 * Inserta una nueva seccion, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 class NumeroModel{
	public $id;
	public $id_publicacion;
	public $id_estado_numero;
	public $url_portada;
	public $fe_erratas;
	public $precio;
	
	private $estado_numero;
	private $publicacion;
	 **/
	private function insertNumero($numeroModel){
		
		$sql = " INSERT INTO numero
				(id,
				id_publicacion,
				id_estado_numero,
				url_portada,
				fe_erratas,
				precio,
				fecha_publicado
				)
				VALUES
				(null,
				$numeroModel->id,
				$numeroModel->id_publicacion,
				$numeroModel->id_estado_numero,
				$numeroModel->url_portada,
				$numeroModel->fe_erratas,
				$numeroModel->precio,
				$numeroModel->fecha_publicado
				);
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
}

?>