<?php
require_once(__DIR__."/../service/CiudadService.php");

$metodo = $_POST["metodo"];

$ciudadService = new CiudadService;

$result = null;

switch($metodo){
	case "getCiudadesByIdRegion":
		$idRegion = $_POST["idRegion"];

		$result = $ciudadService->getCiudadesByIdRegion($idRegion);
		break;
	default:
		echo "Método inexistente en el switch de CiudadAjaxHelper.php";
}

echo json_encode($result);

?>