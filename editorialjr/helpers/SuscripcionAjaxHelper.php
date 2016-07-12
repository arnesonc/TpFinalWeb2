<?php

require_once(__DIR__."/../service/SuscripcionService.php");
require_once(__DIR__."/../service/MercadoPagoService.php");

$metodo = $_POST["metodo"];

$suscripcionService = new SuscripcionService;
$mpService = new MercadoPagoService;

$result = null;

switch($metodo){
	case "suscribirCliente":
		$idCliente = $_POST["idCliente"];
		$idPublicacion = $_POST["idPublicacion"];
		$result = $mpService->pagar($idPublicacion,6);//monto de 6 numeros sumados
		$suscripcionService->suscribirCliente($idCliente,$idPublicacion,"suscripcion");
		break;
	case "getSuscripcionById":
		$idSuscripcion = $_POST["idSuscripcion"];
		$result = $suscripcionService->getSuscripcionById($idSuscripcion);
		break;
	case "getSuscripcionesByIdCliente":
		$idCliente = $_POST["idCliente"];
		$result = $suscripcionService->getSuscripcionesByIdCliente($idCliente);
		break;
	case "clienteSuscrito":
		$idCliente = $_POST["idCliente"];
		$idPublicacion = $_POST["idPublicacion"];
		$result = $suscripcionService->clienteSuscrito($idCliente,$idPublicacion);
		break;
	case "listarSuscripcionesDelCliente":
		$idCliente = $_POST["idCliente"];
		$result = $suscripcionService->getSuscripcionesByIdCliente($idCliente);
		break;
	default:
	echo "Método inexistente en el switch de SuscripcionAjaxHelper.php";
}

echo json_encode($result);

?>
