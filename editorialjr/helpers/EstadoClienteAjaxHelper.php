<?php
require_once(__DIR__."/../service/EstadoClienteService.php");

$metodo = $_POST["metodo"];

$estadoClienteService = new EstadoClienteService;

$result = null;

switch($metodo){
	case "getEstadoClienteById":
		$id_cliente = $_POST["id_cliente"];
		$result = $estadoClienteService->getEstadoClienteById($id_cliente);
		break;
	default:
		echo "Método inexistente en el switch de UsuarioAjaxHelper.php";
}

echo json_encode($result);
?>