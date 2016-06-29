<?php
require_once(__DIR__."/../service/PaisService.php");
//header('Content-Type: text/html; charset=utf-8');

//recibimos el metodo
$metodo = $_POST["metodo"];
//creamos un servicio para el modelo que vamos a querer tratar
$paisService = new PaisService;
//definimos un resultado, que sera el modelo que enviaremos
$result = null;
//dependiendo del metodo un switch nos dira que guardar en el resultado
switch($metodo){
	case "getAllPais":
		
		$result = $paisService->getAllPais();
		break;
	default:
		echo "Método inexistente en el switch de CiudadAjaxHelper.php";
}
//se envia el resultado por medio de json enconde.
echo json_encode($result);

?>