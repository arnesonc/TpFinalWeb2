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
		$result = $publicacionService->getAllPublicaciones(); // retorna un array de PublicacionModel.
		break;
	case "createPublicacionNumero":
		$id_usuario = $_POST["id_usuario"];
		$nombre = $_POST["nombre"];
		$destacado = $_POST["destacado"];
		$precio = $_POST["precio"];
		$result = $publicacionService->createPublicacionNumeroParametros($id_usuario, $nombre, $destacado, $precio);
		break;
	case "updatePublicacionParameters":
		$nombre = $_POST["nombre"];
		$destacado = $_POST["destacado"];
		$id = $_POST["idPublicacion"];
		$result = $publicacionService->updatePublicacionParameters ($id, $nombre, $destacado);
		break;
	case "getNumberOfPublications":
		$result = $publicacionService->getNumberOfPublications();
		break;
	case "getPublicacionesPaginado":
		$offset = $_POST["offset"];
		$itemsPorPagina = $_POST["itemsPorPagina"];
		$result = $publicacionService->getPublicacionesPaginado($offset, $itemsPorPagina);
		break;
	case "obtenerPublicacionesByIdUser":
		$idCliente = $_POST["idCliente"];
		$result = $publicacionService->obtenerPublicacionesByIdUser($idCliente);
		break;
	default:
		echo "Método inexistente en el switch de PublicacionAjaxHelper.php";
		break;
}

echo json_encode($result);

?>
