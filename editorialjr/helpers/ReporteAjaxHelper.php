<?php
require_once(__DIR__."/../service/ReporteService.php");

$metodo = $_POST["metodo"];

$reporteService = new ReporteService;

$result = null;

switch($metodo){
	case "generarReporteContenidistas":
	$result = $reporteService->generarReporteContenidistas();
	break;
	default:
	echo "Método inexistente en el switch de ReporteAjaxHelper.php";
}

echo json_encode($result);

?>
