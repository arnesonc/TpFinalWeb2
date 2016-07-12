<?php

require_once(__DIR__."/../service/CompraUnitariaService.php");
require_once(__DIR__."/../service/MercadoPagoService.php");

$metodo = $_POST["metodo"];

$compraUnitariaService = new CompraUnitariaService;

$result = null;

switch($metodo){
	case "getComprasUnitariasByIdCliente":
		$idCliente = $_POST["idCliente"];
		$result = $compraUnitariaService->getComprasUnitariasByIdCliente($idCliente);
		break;
	case "comprarUltimoNumero":
		$idCliente = $_POST["idCliente"];
		$idPublicacion = $_POST["idPublicacion"];
		$result = $mpService->pagar($idPublicacion,1);//el monto de un solo numero
		$compraUnitariaService->comprarUltimoNumero($idCliente,$idPublicacion);
		break;
	default:
	echo "Método inexistente en el switch de CompraUnitariaAjaxHelper.php";
}

echo json_encode($result);

?>
