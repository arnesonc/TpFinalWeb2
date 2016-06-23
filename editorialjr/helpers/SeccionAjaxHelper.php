<?php

require_once(__DIR__."/../service/SeccionService.php");

$metodo = $_POST["metodo"];

$seccionService = new SeccionService;

$result = null;

switch($metodo){
	case "getSeccionById":
	$idSeccion = $_POST["idSeccion"];

	$result = $seccionService->getSeccionById($idSeccion);
	break;
	case "getAllSecciones":
	$result = $seccionService->getAllSecciones();
	break;
	case "createSeccionParametros":
	$nombre = $_POST["nombre"];
	$result = $seccionService->createSeccionParametros($nombre);
	break;
	case "updateSeccion":
	$idSeccion = $_POST["idSeccion"];
	$nombre = $_POST["nombre"];
	$result = $seccionService->updateSeccion($idSeccion, $nombre);
	break;
	default:
	echo "Método inexistente en el switch de SeccionAjaxHelper.php";
}

echo json_encode($result);

?>
