<?php

require_once(__DIR__."/../service/CompraUnitariaService.php");

$metodo = $_POST["metodo"];

$compraUnitariaService = new CompraUnitariaService;

$result = null;

switch($metodo){
	case "getComprasUnitariasByIdCliente":
	$idCliente = $_POST["idCliente"];
	$result = $compraUnitariaService->getComprasUnitariasByIdCliente($idCliente);
	break;
	default:
	echo "Método inexistente en el switch de CompraUnitariaAjaxHelper.php";
}

echo json_encode($result);

?>
