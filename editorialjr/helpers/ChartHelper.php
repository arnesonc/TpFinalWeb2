<?php

require_once(__DIR__."/../service/CompraUnitariaService.php");

$metodo = $_POST["metodo"];
$CompraUnitariaService = new CompraUnitariaService;

$result = null;

switch($metodo){
	case "getAllComprasUnitariasPorPeriodo":
	$dateStart = $_POST['dateStart'];
	$dateEnd = $_POST['dateEnd'];
	$result = $CompraUnitariaService->getAllComprasUnitariasPorPeriodo($dateStart,$dateEnd);
	break;
	case "getAllSuscripcionesPorPeriodo":
	$dateStart = $_POST['dateStart'];
	$dateEnd = $_POST['dateEnd'];
	$result = $CompraUnitariaService->getAllSuscripcionesPorPeriodo($dateStart,$dateEnd);
	break;
	default:
	echo "Método inexistente en el switch de ChartHelper.php";
}

echo json_encode($result);

?>
