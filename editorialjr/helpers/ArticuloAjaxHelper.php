<?php
require_once(__DIR__."/../service/ArticuloService.php");
require_once (__DIR__ . "/../model/ArticuloModel.php");
require_once (__DIR__ . "/../service/NumeroService.php");
require_once (__DIR__ . "/../model/NumeroModel.php");
require_once (__DIR__ . "/../service/ImagenService.php");


$numeroService = new NumeroService;

$metodo = $_POST["metodo"];

$articuloService = new ArticuloService;

$imagenService = new ImagenService;

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
	case "getAllArticulosFromNum":
			$id_numero = $_POST["id_numero"];
			$result = $articuloService->getAllArticulosFromNum($id_numero);
			break;
	case "cerrarArticulo":
		$idArticulo = $_POST["idArticulo"];
		$result = $articuloService->cerrarArticulo($idArticulo);
		break;
	case "createArticuloParametros":
		require_once (__DIR__ . "/ArticuloFileHelper.php");
		break;
	case "getArticuloById":
		$id_articulo = $_POST['id_articulo'];
		$result = $articuloService->getArticuloById($id_articulo);
		break;
	case "getImagenUrlByArticuloId":
		$id_articulo = $_POST['idArticulo'];
		$result = $imagenService->getImagenUrlByArticuloId($id_articulo);
		break;
	default:
		echo "Método inexistente en el switch de ArticuloAjaxHelper.php";
		break;
}
echo json_encode($result);
?>
