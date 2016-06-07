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
		
		return $this->convertUsuarioDBToUsuarioModel ( $usuarioBD );
	}
	
	/**
	 * Obtiene una lista de usuarios (incluye inactivos)
	 */
	public function getAllUsuarios() {
		$sql = " SELECT
				id,
				id_estado_usuario,
				id_rol,
				email,
				pass,
				nombre,
				apellido
				FROM usuario;";
		
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
			
			$arrayUsuarioModel [] = $usuarioModel;
		}
		
		return $arrayUsuarioModel;
	}
	
	/**
	 * Convierte un usuarioDB en UsuarioModel
	 */
	public function convertUsuarioDBToUsuarioModel($usuarioBD) {
		
		/* Convierto el resultado de la BD a un objeto modelado */
		$usuarioModel = new UsuarioModel ();
		$usuarioModel->id = $usuarioBD ["id"];
		$usuarioModel->email = $usuarioBD ["email"];
		$usuarioModel->pass = $usuarioBD ["pass"];
		$usuarioModel->nombre = $usuarioBD ["nombre"];
		$usuarioModel->apellido = $usuarioBD ["apellido"];
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
			
			$result = $this->insertUsuario ( $usuarioModel );
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
	private function validateUsuario($usuarioModel, $validatePass) {
		$validationHelper = new ValidationHelper ();
		
		if (is_null ( $usuarioModel->email ) || ! isset ( $usuarioModel->email ) || ! $validationHelper->validateText ( $usuarioModel->email, 1, 50 )) {
			return "El email no es válido. Debe poseer como máximo 50 caracteres.";
		}
		
		if (! filter_var ( $usuarioModel->email, FILTER_VALIDATE_EMAIL )) {
			return "El email ingresado no tiene un formato correcto.";
		}
		
		if ($validatePass && is_null ( $usuarioModel->pass ) || ! isset ( $usuarioModel->pass ) || ! $validationHelper->validateText ( $usuarioModel->pass, 1, 50 )) {
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
	
	/**
	 * Inserta un nuevo usuario a partir de un objeto UsuarioModel, si tuvo exito devuelve verdadero
	 * caso contrario devuelve falso
	 */
	private function insertUsuario($usuarioModel) {
		
		// Encripta en md5 la contraseña
		$pass = md5 ( $usuarioModel->pass );
		
		// Por defecto se crea como activo y con rol 2 = redactor
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
			$this->dataAccess->execute ( $sql );
		} catch ( Exception $e ) {
			$logger = Logger::getRootLogger ();
			$logger->error ( $e );
			return false;
		}
		
		return true;
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
	 * Actualiza un usuario a partir de los datos parametizados (por separado)
	 */
	public function updateUsuarioParameters($id, $id_estado_usuario, $email, $pass, $nombre, $apellido) {
		$usuarioModel = new UsuarioModel ();
		$usuarioModel->id = $id;
		$usuarioModel->id_estado_usuario = $id_estado_usuario;
		$usuarioModel->id_rol = $id_rol;
		$usuarioModel->email = $email;
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
				id_estado_usuario = $usuarioModel->id_estado_usuario,
				id_rol = $usuarioModel->id_rol,
				email = '$usuarioModel->email',
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
}

?>