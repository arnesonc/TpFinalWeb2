<?php
require_once(__DIR__."/../service/EstadoNumeroService.php");

$metodo = $_POST["metodo"];

$estadoNumeroService = new EstadoNumeroService;

$result = null;

switch($metodo){
	case "getEstadoNumeroById":
		$id_numero = $_POST["id_numero"];
		$result = $estadoNumeroService->getEstadoNumeroById($id_numero);
		break;
	default:
		echo "Método inexistente en el switch de EstadoNumeroAjaxHelper.php";
}

echo json_encode($result);
?>