<?php

require_once(__DIR__."/../helpers/LoggerHelper.php");
require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../helpers/ValidationHelper.php");
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

    public function getClienteByEmail($email){

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
				WHERE email = '$email';";

        try{

            $clienteDB = $this->dataAccess->getOneResult($sql);

        }catch(Exception $e){

            $logger = Logger::getRootLogger();
            $logger->error($e);
            return null;
        }

        if(is_null($clienteDB)){
            return null;
        }

        return $this->convertClienteDBToClienteModel($clienteDB);
    }

	/**
	 * Obtiene una lista de clientes (incluye inactivos)
	 */
	public function getAllClientes() {
		$sql = " SELECT
						c.id,
				    c.email,
				    c.pass,
				    c.nombre,
				    c.apellido,
				    c.id_ciudad,
				    c.calle,
				    c.numero_calle,
				    c.codigo_postal,
				    c.piso,
				    c.departamento,
				    c.detalle_direccion,
				    c.id_estado_cliente,
						ec.descripcion descripcion_estado_cliente,
						ci.descripcion descripcion_ciudad
				FROM cliente c
				INNER JOIN estado_cliente ec on c.id_estado_cliente = ec.id
				INNER JOIN ciudad ci on c.id_ciudad = ci.id;";

		try {

			$clientesBDArray = $this->dataAccess->getMultipleResults($sql);
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

		$arrayClientesModel = array ();

		foreach ( $clientesBDArray as $clienteDB ) {

			$clienteModel = $this->convertClienteDBToClienteModel($clienteDB);
			$clienteModel->descripcion_estado_cliente = $clienteDB["descripcion_estado_cliente"];
			$clienteModel->descripcion_ciudad = $clienteDB["descripcion_ciudad"];

			$arrayClientesModel [] = $clienteModel;
		}

		return $arrayClientesModel;
	}

	/**
	 * Convierte un clienteDB en un ClienteModel
	 * */
	private function convertClienteDBToClienteModel($clienteDB){

		$clienteModel = new ClienteModel;
		$clienteModel->id = $clienteDB["id"];
		$clienteModel->id_estado_cliente = $clienteDB["id_estado_cliente"];
		$clienteModel->id_ciudad = $clienteDB["id_ciudad"];
		$clienteModel->email = utf8_encode($clienteDB["email"]);
		$clienteModel->pass = utf8_encode($clienteDB["pass"]);
		$clienteModel->nombre =utf8_encode( $clienteDB["nombre"]);
		$clienteModel->apellido = utf8_encode($clienteDB["apellido"]);
		$clienteModel->calle = utf8_encode($clienteDB["calle"]);
		$clienteModel->numero_calle = $clienteDB["numero_calle"];
		$clienteModel->piso = $clienteDB["piso"];
		$clienteModel->departamento = utf8_encode($clienteDB["departamento"]);
		$clienteModel->codigo_postal = $clienteDB["codigo_postal"];
		$clienteModel->detalle_direccion = utf8_encode($clienteDB["detalle_direccion"]);

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

			$id = $this->insertCliente($clienteModel);
		}else{
			//En caso de ser invalido devuelve un mensaje de validacion
			return $message;
		}

        $usuarioModel = $this->getClienteById($id);
        // Luego de inserta el usuario le crea la sesión para luego re dirigir a la pantalla principal
        // con la sesión iniciada
        $this->createSession($usuarioModel);

		return true;
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

		if($this->emailExists($clienteModel->email)){
			return "El email ingresado ya existe.";
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
					return "El número de la calle no es válido. Debe poseer como máximo 30 caracteres.";
		}

		if(is_null($clienteModel->codigo_postal)
				|| !isset($clienteModel->codigo_postal)
				||!$validationHelper->validateText($clienteModel->codigo_postal, 1, 11)){
					return "El código postal no es válido. Debe poseer como máximo 11 caracteres.";
		}

		if(!is_null($clienteModel->piso) && !$validationHelper->validateText($clienteModel->piso, 1, 5)){
			return "El piso no es válido. Debe poseer como máximo 5 caracteres.";
		}

		if(!is_null($clienteModel->departamento) && !$validationHelper->validateText($clienteModel->departamento, 1, 5)){
			return "El departamento no es válido. Debe poseer como máximo 5 caracteres.";
		}

		if(!is_null($clienteModel->detalle_direccion) && !$validationHelper->validateText($clienteModel->detalle_direccion, 1, 150)){
			return "El detalle de la dirección no es válido. Debe poseer como máximo 150 caracteres.";
		}

		return "";
	}
	private function emailExists($email){
		$sql = "SELECT email
		FROM cliente
		WHERE email = '$email';";

		try{
			$email = $this->dataAccess->getOneResult($sql);

			return !is_null($email["email"]);
		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);
			return null;
		}
	}
	/**
	 * Inserta un nuevo cliente a partir de un objeto ClienteModel, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 **/
	private function insertCliente($clienteModel){

		$pass = md5($clienteModel->pass);

		//si el campo es null el sql lo coloca null, caso contraro inserta el valor con las 'quotes' correspondientes.
		$piso = is_null($clienteModel->piso) ? 'null' : "'$clienteModel->piso'";
		$departamento = is_null($clienteModel->departamento) ? 'null' : "'$clienteModel->departamento'";
		$detalle_direccion = is_null($clienteModel->detalle_direccion) ? 'null' : "'$clienteModel->detalle_direccion'";

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
					$piso,
					$departamento,
					$detalle_direccion,
					1);";

		try{

			// Ejecuta el insert en la BD
			$id = $this->dataAccess->execute($sql, true);

		}catch(Exception $e){
			$logger = Logger::getRootLogger();
			$logger->error($e);

			return false;
		}

		return $id;
	}

    public function checkUserAndPass($email,$pass) {
        $validationHelper = new ValidationHelper();

        if (is_null ( $email ) || ! isset ( $email ) || ! $validationHelper->validateText ( $email, 1, 50 )) {
            return "El email no es válido. Debe poseer como máximo 50 caracteres.";
        }

        if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
            return "El email ingresado no tiene un formato correcto.";
        }

        if (is_null ( $pass ) || ! isset ( $pass ) || ! $validationHelper->validateText ( $pass, 1, 50 )) {
            return "La contraseña no es válida. Debe poseer como máximo 50 caracteres.";
        }

        $clienteModel = $this->getClienteByEmail($email);

        if(is_null($clienteModel) || !isset($clienteModel)){
            return "Cliente no registrado en el sistema.";
        }

        if ($clienteModel->pass != md5(trim($pass))) {
            return "Usuario y/o contraseña inválida.";
        }

        if ($clienteModel->getEstadoCliente()->descripcion == "inactivo"){
            return "El cliente se encuentra desactivado.";
        }

        $this->createSession($clienteModel);

        return true;
    }

    public function createSession($clienteModel){
        session_start();
        $_SESSION['session'] = array(
            "login" => "ok",
            "id" => $clienteModel->id,
            "nombre" => $clienteModel->nombre);
    }
}

?>
