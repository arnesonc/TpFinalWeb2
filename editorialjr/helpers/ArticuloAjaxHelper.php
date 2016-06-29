<?php
require_once(__DIR__."/../service/ArticuloService.php");
require_once (__DIR__ . "/../model/ArticuloModel.php");

$metodo = $_POST["metodo"];

$articuloService = new ArticuloService;

$result = null;

switch($metodo){
	case "getAllArticulos":
		$id_numero = $_POST["id_numero"];
		$result = $articuloService->getAllArticulosByIdNumero($id_numero);
		break;
	case "getAllArticulosFromNumByUser":
		$id_numero = $_POST["id_numero"];
		$id_user = $_POST["id_user"];
		$result = $articuloService->getAllArticulosFromNumByUser($id_user, $id_numero);
		break;
	default:
		echo "Método inexistente en el switch de ArticuloAjaxHelper.php";
}

echo json_encode($result);

?>