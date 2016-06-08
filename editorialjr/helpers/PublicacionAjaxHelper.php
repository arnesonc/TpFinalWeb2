<?php
require_once(__DIR__."/../service/PublicacionService.php");

$metodo = $_POST["metodo"];

$publicacionService = new PublicacionService;

$result = null;

switch($metodo){
	case "getPublicacionById":
		$idPublicacion = $_POST["id"];

		$result = $publicacionService->getPublicacionById($idPublicacion);
		break;
	case "getAllPublicaciones"
	default:
		echo "Método inexistente en el switch de PublicacionAjaxHelper.php";
}

echo json_encode($result);

?>