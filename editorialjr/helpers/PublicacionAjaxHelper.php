<?php
require_once(__DIR__."/../service/PublicacionService.php");

$metodo = $_POST["metodo"];

$publicacionService = new PublicacionService;
$numeroService = new NumeroService;

$result = null;

switch($metodo){
	case "getPublicacionById":
		$idPublicacion = $_POST["id"];

		$result = $publicacionService->getPublicacionById($idPublicacion);
		break;
	case "getAllPublicaciones":
			break;
	case "createPublicacionNumero":
		$id_usuario = $_POST["id_usuario"];
		$nombre = $_POST["nombre"];
		$destacado = $_POST["destacado"];
		$precio = $_POST["precio"];
		$result = $publicacionService->createPublicacionNumeroParametros($id_usuario, $nombre, $destacado, $precio);
		
	default:
		echo "Método inexistente en el switch de PublicacionAjaxHelper.php";
}

echo json_encode($result);

?>