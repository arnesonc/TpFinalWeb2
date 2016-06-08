<?php
require_once(__DIR__."/../service/PaisService.php");

$metodo = $_POST["metodo"];

$paisService = new PaisService;

$result = null;

switch($metodo){
	case "getAllPais":
		$result = $paisService->getAllPais();
		break;
	default:
		echo "Método inexistente en el switch de PaisAjaxHelper.php";
}

echo json_encode($result);

?>