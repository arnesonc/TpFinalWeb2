<?php

require_once (__DIR__ . "/../service/NumeroService.php");
require_once (__DIR__ . "/../model/NumeroModel.php");

	$numeroService = new NumeroService;
		$idNumero = $_POST["idNumero"];
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
	$fichero_subido = $path . basename($_FILES['fichero_usuario']['name']);
	$numeroModel->url_portada = $fichero_subido;
	$numeroService->updateNumero($numeroModel);
	echo $fichero_subido;
	
	if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
		echo "El fichero es válido y se subió con éxito.\n";
	} else {
		echo "¡Posible ataque de subida de ficheros!\n";
	}
	
	echo 'Más información de depuración:';
	print_r($_FILES);

	
?>