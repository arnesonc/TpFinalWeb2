<?php
require_once(__DIR__."/../service/NumeroService.php");
require_once (__DIR__ . "/../model/NumeroModel.php");

$metodo = $_POST["metodo"];

$numeroService = new NumeroService;

$result = null;

switch($metodo){
	case "getAllNumeros":
		$idPublicacion = $_POST["idPublicacion"];
		$result = $numeroService->getAllNumeros($idPublicacion);
		break;
		case "getNumerosPorSuscripcion":
			$idPublicacion = $_POST["idPublicacion"];
			$idCliente = $_POST["idCliente"];
			$result = $numeroService->getNumerosPorSuscripcion($idPublicacion,$idCliente);
			break;
	case "editarFeErratas":
		$idNumero = $_POST["idNumero"];
		$feErratas = $_POST["feErratas"];
		$result = $numeroService->editarFeErratas($idNumero,$feErratas);
		break;
	case "cambiarEstadoAPublicado":
		$idNumero = $_POST["idNumero"];
		$result = $numeroService->cambiarEstadoAPublicado($idNumero);
		break;
	case "getNumeroById":
		$idNumero = $_POST["idNumero"];
		$result = $numeroService->getNumeroById($idNumero);
		break;
	default:
		echo "Método inexistente en el switch de NumeroAjaxHelper.php";
}

echo json_encode($result);

?>
