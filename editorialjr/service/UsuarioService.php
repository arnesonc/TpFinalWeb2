<?php
require_once (__DIR__ . "/../helpers/LoggerHelper.php");
require_once (__DIR__ . "/../common/DataAccess.php");
require_once (__DIR__ . "/../helpers/ValidationHelper.php");
require_once (__DIR__ . "/../model/UsuarioModel.php");

/**
 * Clase que agrupa el modelado del objeto y los métodos que implementa.
 */
class UsuarioService {

	private $dataAccess = null;

	function __construct() {
		$this->dataAccess = new DataAccess ();
	}

	/**
	 * Obtiene un UsuarioModel por su id
	 */
	public function getUsuarioById($idUsuario) {

		$sql = "SELECT id,
				    id_estado_usuario,
				    id_rol,
				    email,
				    pass,
				    nombre,
				    apellido
				FROM usuario
				WHERE id = $idUsuario;";

		try {

			$usuarioBD = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {

			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

		return $this->convertUsuarioDBToUsuarioModel ( $usuarioBD );
	}

	/**
	 * Obtiene un usuario por email
	 * Devuelve el usuario de la BD
	 */
	public function getUsuarioByEmail($email) {
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

		try {

			$usuarioBD = $this->dataAccess->getOneResult ( $sql );
		} catch ( Exception $e ) {

			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

		if(is_null($usuarioBD)){
			return null;
		}else{
			return $this->convertUsuarioDBToUsuarioModel ( $usuarioBD );
		}
	}

	/**
	 * Obtiene una lista de usuarios (incluye inactivos)
	 */
	public function getAllUsuarios() {
		$sql = " SELECT
				u.id,
				u.id_estado_usuario,
				u.id_rol,
				u.email,
				u.pass,
				u.nombre,
				u.apellido,
				r.descripcion descripcion_rol,
				eu.descripcion descripcion_estado_usuario
				FROM usuario u
				inner join rol r on u.id_rol = r.id
				inner join estado_usuario eu on u.id_estado_usuario = eu.id;";

		try {

			$usuarioBDArray = $this->dataAccess->getMultipleResults ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return null;
		}

		$arrayUsuarioModel = array ();

		foreach ( $usuarioBDArray as $usuarioDB ) {

			$usuarioModel = $this->convertUsuarioDBToUsuarioModel ( $usuarioDB );
			$usuarioModel->descripcion_rol = $usuarioDB["descripcion_rol"];
			$usuarioModel->descripcion_estado_usuario = $usuarioDB["descripcion_estado_usuario"];

			$arrayUsuarioModel [] = $usuarioModel;
		}

		return $arrayUsuarioModel;
	}

	/**
	 * Convierte un usuarioDB en UsuarioModel
	 */
	private function convertUsuarioDBToUsuarioModel($usuarioBD) {

		/* Convierto el resultado de la BD a un objeto modelado */
		$usuarioModel = new UsuarioModel ();
		$usuarioModel->id = $usuarioBD ["id"];
		$usuarioModel->email = utf8_encode($usuarioBD ["email"]);
		$usuarioModel->pass = utf8_encode($usuarioBD ["pass"]);
		$usuarioModel->nombre = utf8_encode($usuarioBD ["nombre"]);
		$usuarioModel->apellido = utf8_encode($usuarioBD ["apellido"]);
		$usuarioModel->id_estado_usuario = $usuarioBD ["id_estado_usuario"];
		$usuarioModel->id_rol = $usuarioBD ["id_rol"];

		return $usuarioModel;
	}

	/**
	 * Crea un usuario a partir de un objeto UsuarioModel si pasa las validaciones, caso contrario devuelve
	 * el mensaje de validacion correspondiente
	 */
	public function createUsuario($usuarioModel) {
		$message = $this->validateUsuario ( $usuarioModel, true );

		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if (empty ( $message )) {

			$result = $this->insertUsuario ($usuarioModel);
		} else {
			// En caso de ser invalido devuelve un mensaje de validacion
			$result = $message;
		}

		return $result;
	}

	/**
	 * Crea un usuario a partir de los datos parametizados (por separado)
	 */
	public function createUsuarioParametros($email, $pass, $nombre, $apellido) {
		$usuarioModel = new UsuarioModel ();
		$usuarioModel->email = $email;
		$usuarioModel->pass = $pass;
		$usuarioModel->nombre = $nombre;
		$usuarioModel->apellido = $apellido;

		return $this->createUsuario ( $usuarioModel );
	}

	/**
	 * Valida un objeto UsuarioModel
	 */
	private function validateUsuario($usuarioModel, $isInsert) {
		$validationHelper = new ValidationHelper ();

		if ($isInsert && (is_null ( $usuarioModel->email ) || ! isset ( $usuarioModel->email ) || ! $validationHelper->validateText ( $usuarioModel->email, 1, 50 ))) {
			return "El email no es válido. Debe poseer como máximo 50 caracteres.";
		}

		if ($isInsert && (!filter_var ( $usuarioModel->email, FILTER_VALIDATE_EMAIL ))) {
			return "El email ingresado no tiene un formato correcto.";
		}

		if($isInsert && ($this->emailExists($usuarioModel->email))){
			return "El email ingresado ya existe.";
		}

		if ($isInsert && (is_null ( $usuarioModel->pass ) || ! isset ( $usuarioModel->pass ) || ! $validationHelper->validateText ( $usuarioModel->pass, 1, 50 ))) {
			return "La contraseña no es válida. Debe poseer como máximo 50 caracteres.";
		}

		if (is_null ( $usuarioModel->nombre ) || ! isset ( $usuarioModel->nombre ) || ! $validationHelper->validateText ( $usuarioModel->nombre, 1, 50 )) {
			return "El nombre no es válido. Debe poseer como máximo 50 caracteres.";
		}

		if (is_null ( $usuarioModel->apellido ) || ! isset ( $usuarioModel->apellido ) || ! $validationHelper->validateText ( $usuarioModel->apellido, 1, 50 )) {
			return "El apellido no es válido. Debe poseer como máximo 50 caracteres.";
		}

		return "";
	}

	private function emailExists($email){
		$sql = "SELECT email
		FROM usuario
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
	 * Inserta un nuevo usuario a partir de un objeto UsuarioModel, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 */
	private function insertUsuario($usuarioModel) {

		// Encripta en md5 la contraseña
		$pass = md5 ( $usuarioModel->pass );
		// Por defecto se crea como estado 1 = activo y con rol 2 = redactor
		$sql = " INSERT INTO usuario
				(id,
				id_estado_usuario,
				id_rol,
				email,
				pass,
				nombre,
				apellido)
				VALUES
				(null,
				1,
				2,
				'$usuarioModel->email',
				'$pass',
				'$usuarioModel->nombre',
				'$usuarioModel->apellido');";

		try {

			// Ejecuta el insert en la BD
			$id = $this->dataAccess->execute ($sql, true);
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return false;
		}

		return $id;
	}

	/**
	 * Inactiva un usuario por su id
	 */
	public function disableUsuario($idUsuario) {
		$sql = "UPDATE usuario
				SET
				id_estado_usuario = 2
				WHERE id = $idUsuario;";

		try {

			// Ejecuta el update en la BD
			$this->dataAccess->execute ( $sql );
		} catch ( Exception $e ) {

			$logger->error ( $e );
			return false;
		}

		return true;
	}

	/**
	 * Activa un usuario por su id
	 */
	public function enableUsuario($idUsuario) {
		$sql = "UPDATE usuario
				SET
				id_estado_usuario = 1
				WHERE id = $idUsuario;";

		try {

			// Ejecuta el update en la BD
			$this->dataAccess->execute ( $sql );
		} catch ( Exception $e ) {

			$logger->error ( $e );
			return false;
		}

		return true;
	}

	/**
	 * Actualiza un usuario a partir de los datos parametizados (por separado)
	 */
	public function updateUsuarioParameters($id, $nombre, $apellido) {
		$usuarioModel = new UsuarioModel ();
		$usuarioModel->id = $id;
		$usuarioModel->nombre = $nombre;
		$usuarioModel->apellido = $apellido;

		$message = $this->validateUsuario ( $usuarioModel, false );

		// Si esta vacio, no hay mensaje de error por lo tanto es válido
		if (empty ( $message )) {
			$result = $this->updateUsuario ( $usuarioModel );
		} else {
			// En caso de ser invalido devuelve un mensaje de validacion
			$result = $message;
		}

		return $result;
	}

	/**
	 * Actualiza un usuario a partir de un objeto UsuarioModel, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 */
	private function updateUsuario($usuarioModel) {

		$sql = " UPDATE usuario
				SET
				nombre = '$usuarioModel->nombre',
				apellido = '$usuarioModel->apellido'
				WHERE id = $usuarioModel->id;";

		try {
			// Ejecuta el insert en la BD
			$this->dataAccess->execute ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return false;
		}

		return true;
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

		$myUser = $this->getUsuarioByEmail($email);

		if(!isset($myUser)){
			return "Usuario no registrado en el sistema.";
		}

		if ($myUser->pass != md5($pass)) {
			return "Usuario y/o contraseña inválida.";
		}

		if($myUser->getRol()->descripcion != "administrador"){
			return "No posee permisos para iniciar sesión.";
		}

		session_start();
		$_SESSION['session'] = array(
				"login" => "ok",
				"id" => $myUser->id,
				"nombre" => $myUser->nombre,
				"rol" => $myUser->id_rol);

		return true;
	}
}

?>
