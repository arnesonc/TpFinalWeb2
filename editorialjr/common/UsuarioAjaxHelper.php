<?php
require_once(__DIR__."/../service/UsuarioService.php");

$metodo = $_POST["metodo"];

$usuarioService = new UsuarioService;

$result = null;

switch($metodo){
	case "getUsuarioByEmail":
		$emailUsuario = $_POST["emailUsuario"];
		
		$result = $usuarioService->getUsuarioByEmail($emailUsuario);
		break;
	default:
		echo "Método inexistente en el switch de UsuarioAjaxHelper.php";
}

echo $result->nombre;

?>