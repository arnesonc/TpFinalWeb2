<?php

require_once(__DIR__."/../helpers/LoggerHelper.php");

/**
*	Clase que posee métodos para acceder a la base de datos
**/
class DataAccess{

	/**
	*	Realiza la conexión a la base de datos
	**/
	public function connect(){

		$params = parse_ini_file(__DIR__."/../config/db.ini");
		$mysqli = new mysqli($params["host"], $params["user"], $params["pass"], $params["schema"]);
		if ($mysqli->connect_errno) {
			$message = "\n Error: Fallo al conectarse a MySQL debido a: \nErrno: " . $mysqli->connect_errno . "\nError: " . $mysqli->connect_error . "\n";
			$logger = Logger::getRootLogger();
			$logger->error($message);
			throw new Exception($message);
		}

		return $mysqli;
	}

	/**
	*	Realiza una consulta que espera obtener como resultado solo un registro
	**/
	public function getOneResult($sql){

		$connection = $this->connect();

		$logger = Logger::getRootLogger();

		try{

			if (!$query = $connection->query($sql)){
				$mensaje = "No se pudo consultar. SQL: " . $sql;
				$logger->error($mensaje);
				throw new Exception($mensaje);
			}

			if ($query->num_rows === 0) {
			    return null;
			}

 			if ($query->num_rows > 1) {
 				$mensaje = "La consulta devolvió mas de un resultado.";
 				$logger->error($mensaje);
 				throw new Exception($mensaje);
			}

			$result = $query->fetch_assoc();

			$query->free();

		}catch(Exception $e){
			$mensaje = "Ha ocurrido un error: " . $e;
			$logger->error($mensaje);
			throw new Exception($mensaje);

		}finally{
			$connection->close();
		}
		return $result;
	}

	/**
	*	Realiza una consulta que espera recibir multiples registros
	**/
	public function getMultipleResults($sql){

		$connection = $this->connect();
		$logger = Logger::getRootLogger();

		try{

			if (!$query = $connection->query($sql)){
				$mensaje = "No se pudo consultar. SQL: " . $sql;
				$logger->error($mensaje);
				throw new Exception($mensaje);
			}

			if ($query->num_rows === 0) {
				$mensaje = "La consulta no devolvió resultados.";
				$logger->error($mensaje);
				throw new Exception($mensaje);
			}

			$array = array();

			while ($result = $query->fetch_assoc()) {
				array_push($array, $result);
			}

			$query->free();

		}catch(Exception $e){

			$mensaje = "Ha ocurrido un error: " . $e;
			$logger->error($mensaje);
			throw new Exception($mensaje);

		}finally{

			$connection->close();
		}

		return $array;
	}

	/**
	*	Ejecuta una sentencia sql. Ej: insert, update
	*	en caso de insert la variable $isInsert debe estar en true para devolver el id insertado
	*	no olvidar agregar select last_insert_id() en la sentencia de insert
	**/
	public function execute($sql, $isInsert = false){

		$connection = $this->connect();

		try{

			$connection->query($sql);

			if($isInsert){

				$id = $connection->insert_id;

				return $id;
			}else{

				return true;
			}

		}catch(Exception $e){

			$mensaje = "Ha ocurrido un error: " . $e;
			$logger = Logger::getRootLogger();
			$logger->error($mensaje);
			throw new Exception($mensaje);

		}finally{

			$connection->close();

		}
	}

} // Fin clase

?>
