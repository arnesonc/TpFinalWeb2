<?php
require_once(__DIR__."/../service/EstadoArticuloService.php");

$metodo = $_POST["metodo"];

$estadoArticuloService = new EstadoArticuloService;

$result = null;

switch($metodo){
	case "getEstadoArticuloById":
		$id_articulo = $_POST["id_articulo"];
		$result = $estadoArticuloService->getEstadoArticuloById($id_articulo);
		break;
	default:
		echo "Método inexistente en el switch de EstadoArticuloAjaxHelper.php";
}

echo json_encode($result);
?>