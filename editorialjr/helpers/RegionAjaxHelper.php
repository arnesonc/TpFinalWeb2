<?php
require_once(__DIR__."/../service/RegionService.php");

$metodo = $_POST["metodo"];

$regionService = new RegionService;

$result = null;

switch($metodo){
	case "getRegionesByIdPais":
		$idPais = $_POST["idPais"];
		$result = $regionService->getRegionesByIdPais($idPais);
		break;
	default:
		echo "Método inexistente en el switch de RegionAjaxHelper.php";
}

echo json_encode($result);
?>