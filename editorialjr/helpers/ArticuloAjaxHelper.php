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
	case "test":
		echo ("pega en el metodo");

		$titulo = $_POST['titulo'];
		$copete = $_POST['copete'];
		$contenido_adicional = $_POST['contenido'];
		$id_articulo = $_POST['id_articulo'];
		/* imagen */

		echo ("el titulo es ".$titulo);

		if (file_exists($_FILES["imagen-file"])){
			echo "existe la imagen";
		} else {
			echo "no existe";
		}

		/* guardo ?*/
		$id_seccion = $_POST['seccion'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$id_numero = $_POST['idNumero'];
		$id_articulo = $_POST['idArticulo'];
		$id_user = $_POST['idUser'];
		$id_estado_articulo = 1;
		$fecha_cierre = null;
		$url_contenido = "http://www.rischiocalcolato.it/wp-content/uploads/2013/05/Default.jpg";

		$result = $articuloService->createArticuloParametros($id_seccion, $id_user, $id_estado_articulo, $titulo, $lat, $lng, $fecha_cierre, $copete, $url_contenido, $contenido_adicional, $id_numero );
		break;
	default:
		echo "Método inexistente en el switch de ArticuloAjaxHelper.php";
}

echo json_encode($result);

?>