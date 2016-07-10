<?php

require_once(__DIR__."/../service/SuscripcionService.php");

$metodo = $_POST["metodo"];

$suscripcionService = new SuscripcionService;

$result = null;

switch($metodo){
	case "suscribirCliente":
		$idCliente = $_POST["idCliente"];
		$idPublicacion = $_POST["idPublicacion"];
		$result = $suscripcionService->suscribirCliente($idCliente,$idPublicacion);
		break;
	case "getSuscripcionById":
	$idSuscripcion = $_POST["idSuscripcion"];
	$result = $suscripcionService->getSuscripcionById($idSuscripcion);
	break;
	case "getSuscripcionesByIdCliente":
	$idCliente = $_POST["idCliente"];
	$result = $suscripcionService->getSuscripcionesByIdCliente($idCliente);
	break;
	default:
	echo "Método inexistente en el switch de SuscripcionAjaxHelper.php";
}

echo json_encode($result);

?>
