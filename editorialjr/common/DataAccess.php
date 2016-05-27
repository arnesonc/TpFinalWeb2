<?php

/**
	Clase que posee métodos para acceder a la base de datos
**/
class DataAccess{
	
	/**
		Realiza la conexión a la base de datos
	**/
	public function connect(){
		
		$mysqli = new mysqli("localhost","usuarioeditorial","usuarioeditorial", "editorialjr");		

		if ($mysqli->connect_errno) {
			die("Error: Fallo al conectarse a MySQL debido a: \nErrno: " . $mysqli->connect_errno . "\nError: " . $mysqli->connect_error . "\n");
		}
		
		return $mysqli;
	}

	/**
		Realiza una consulta que espera obtener como resultado solo un registro
	**/
	public function getOneResult($sql){

		$connection = self::connect();

		try{
			
			if (!$query = $connection->query($sql)){
				die("No se pudo consultar. SQL: " . $sql);
			}

			if ($query->num_rows === 0) {
			    return null;
			}

 				if ($query->num_rows > 1) {
			    die("La consulta devolvió mas de un resultado.");
			}

			$result = $query->fetch_assoc();

			$query->free();

		}catch(Exception $e){
			die("Ha ocurrido un error: " . $e);
			
		}finally{
			$connection->close();	
		}

		return $result;
	}

	/**
		Realiza una consulta que espera recibir multiples registros
	**/
	public function getMultipleResults($sql){

		$connection = self::connect();

		try{

			if (!$query = $connection->query($sql)){
				die("No se pudo consultar. SQL: " . $sql);
			}

			if ($query->num_rows === 0) {
			    die("La consulta no devolvió resultados.");
			}

			$array = array();

			while ($result = $query->fetch_assoc()) {
				array_push($array, $result);
			}

			$query->free();

		}catch(Exception $e){
			die("Ha ocurrido un error: " . $e);

		}finally{
			$connection->close();	
		}

		return $array;
	}

	/**
		Ejecuta una sentencia sql. Ej: insert, update
	**/
	public function execute($sql){
		
		$connection = self::connect();

		try{

			$connection->query($sql);

			return true;

		}catch(Exception $e){
			die("Ha ocurrido un error: " . $e);

		}finally{
			$connection->close();	
		}
	}

} // Fin clase

?>