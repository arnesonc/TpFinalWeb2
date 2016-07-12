<?php

require_once (__DIR__ . "/../service/NumeroService.php");
require_once (__DIR__ . "/../model/NumeroModel.php");

	$numeroService = new NumeroService;
		$idNumero = $_POST["idNumero"];
		$precio = $_POST["precio"];

		$numeroModel = $numeroService->getNumeroById($idNumero);
	/*
	//El nombre original del fichero en la máquina del cliente.
	$_FILES['fichero_usuario']['name'];
	//El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
	$_FILES['fichero_usuario']['tmp_name'];
	//El código de error asociado a esta subida.
	$_FILES['fichero_usuario']['error'];
	*/

	$path = $numeroModel->getPath();

	$fichero_subido = $GLOBALS['app_config']["ruta_publicaciones"] . $path . basename($_FILES['fichero_usuario']['name']);
	$numeroModel->url_portada = $path . basename($_FILES['fichero_usuario']['name']);
	$numeroModel->precio = $precio;
	$numeroService->updateNumero($numeroModel);
	//echo $fichero_subido;
	if($_FILES['fichero_usuario']['size'] == 0) {
		$id_publicacion = $numeroModel->id_publicacion;
		$path = 'location:/../admin-listar-numeros.php?idpub='.$id_publicacion;
		header($path);
	}

	if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
		$id_publicacion = $numeroModel->id_publicacion;
		$path = 'location:/../admin-listar-numeros.php?idpub='.$id_publicacion;
		header($path);
	} else {
 			echo "¡Posible ataque de subida de ficheros!\n";
			echo 'Más información de depuración:';
			print_r($_FILES);
  	}

?>
