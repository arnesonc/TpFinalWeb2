<?php
require_once(__DIR__."/../service/EstadoUsuarioService.php");

$metodo = $_POST["metodo"];

$estadoUsuarioService = new estadoUsuarioService;

$result = null;

switch($metodo){
	case "getEstadoUsuarioById":
		$id_usuario = $_POST["id_usuario"];
		$result = $estadoUsuarioService->getEstadoUsuarioById($id_usuario);
		break;
	default:
		echo "Método inexistente en el switch de UsuarioAjaxHelper.php";
}

echo json_encode($result);
?>