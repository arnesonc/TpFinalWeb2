<?php

require_once(__DIR__."/../service/NumeroService.php");

$metodo = $_POST["metodo"];

$numeroService = new NumeroService;

$result = null;

switch($metodo){
	case "uploadPortada":
		$fichero = $_FILES['fichero_usuario']['tmp_name'];
		$result = $numeroService->uploadPortada($fichero);
		break;
	default:
		echo "Método inexistente en el switch de UsuarioAjaxHelper.php";
}

echo json_encode($result);

?>