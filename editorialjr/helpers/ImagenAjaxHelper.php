<?php
require_once(__DIR__."/../service/ImagenService.php");

$metodo = $_POST["metodo"];

$imagenService = new ImagenService;

$result = null;

switch($metodo){
	case "getAllImagesByIdArticulo":
		$id_articulo= $_POST["id_articulo"];
		$result = $imagenService->getAllImagesByIdArticulo($id_articulo);
		break;
	default:
		echo "Método inexistente en el switch de ImagenAjaxHelper.php";
}

echo json_encode($result);
?>