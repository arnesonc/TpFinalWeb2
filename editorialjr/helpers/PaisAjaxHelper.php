<?php
require_once(__DIR__."/../service/PaisService.php");
//header('Content-Type: text/html; charset=utf-8');

$metodo = $_POST["metodo"];

$paisService = new PaisService;

$result = null;

switch($metodo){
	case "getAllPais":
		
		$result = $paisService->getAllPais();
		break;
	default:
		echo "Método inexistente en el switch de CiudadAjaxHelper.php";
}

echo json_encode($result);

?>