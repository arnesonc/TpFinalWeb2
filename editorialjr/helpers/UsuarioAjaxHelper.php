<?php
require_once(__DIR__."/../service/UsuarioService.php");
require_once(__DIR__."/../model/UsuarioModel.php");

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
	case "disableUsuario":
	$idUsuario = $_POST["idUsuario"];
	$result = $usuarioService->disableUsuario($idUsuario);
	break;
	case "enableUsuario":
	$idUsuario = $_POST["idUsuario"];
	$result = $usuarioService->enableUsuario($idUsuario);
	break;
	case "getAllUsuarios":
	$result = $usuarioService->getAllUsuarios();
	break;
	case "getUsuarioById":
	$idUsuario = $_POST["idUsuario"];
	$result = $usuarioService->getUsuarioById($idUsuario);
	break;
	case "updateUsuarioParameters":
	$idUsuario = $_POST["idUsuario"];
	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];

	$result = $usuarioService->updateUsuarioParameters($idUsuario, $nombre, $apellido);
	break;
	case "checkUserAndPass":
	$email = $email = $_POST["email"];
	$pass = $_POST["pass"];
	$result = $usuarioService->checkUserAndPass($email, $pass);
	break;
	case "getAllUsuariosRedactores":
	$result = $usuarioService->getAllUsuariosRedactores();
	break;
	default:
	echo "Método inexistente en el switch de UsuarioAjaxHelper.php";
}

echo json_encode($result);

?>
