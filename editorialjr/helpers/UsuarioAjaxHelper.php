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
	case "createUsuarioParametros":
		
		/* Los campos deben venir validados desde js y se vuelven a validar en usuario service */
		$email = $_POST["email"];
		$pass = $_POST["pass"];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];

		$result = $usuarioService->createUsuarioParametros($email, $pass, $nombre, $apellido);
		break;	
	default:
		echo "Método inexistente en el switch de UsuarioAjaxHelper.php";
}

echo json_encode($result);

?>