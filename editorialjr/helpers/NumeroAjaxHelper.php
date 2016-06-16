<?php
require_once(__DIR__."/../service/NumeroService.php");

$metodo = $_POST["metodo"];

$numeroService = new NumeroService;

$result = null;

switch($metodo){
	case "getAllNumeros":
		$idPublicacion = $_POST["idPublicacion"];
		$result = $numeroService->getAllNumeros($idPublicacion);
		break;
	case "editarNumero":
		
		break;
	default:
		echo "Método inexistente en el switch de NumeroAjaxHelper.php";
}

echo json_encode($result);

?>