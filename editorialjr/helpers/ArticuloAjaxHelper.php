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
	case "cerrarArticulo":
		$idArticulo = $_POST["idArticulo"];
		$result = $articuloService->cerrarArticulo($idArticulo);
		break;
	case "test":

		echo ("pega en el metodo<br>");

		$titulo = $_POST['titulo'];
		$copete = $_POST['copete'];
		$contenido_adicional = "contenido adicional";
		$id_articulo = $_POST['id_articulo'];
		$id_seccion = $_POST['seccion'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$id_numero = $_POST['idNumero'];
		$id_articulo = $_POST['idArticulo'];
		$id_user = $_POST['idUser'];
		$id_estado_articulo = 1;
		$fecha_cierre = null;
		$url_contenido = $_POST['contenido'];

		/* -----------------------------imagen-------------------------------- */


		$numeroModel = $numeroService->getNumeroById($id_numero);

		$path = $numeroModel->getPath();

		$structure = $GLOBALS['app_config']["ruta_publicaciones"] . $path;

		$imagen_url  = $path . basename($_FILES['file']['name']);

		echo ("la url de la imagen es ".$imagen_url."<br>");

		$imagenService->insertImagen($id_articulo,$imagen_url);

		mkdir($structure, 0777, true);

		$imagen = $GLOBALS['app_config']["ruta_publicaciones"] . $path . basename($_FILES['file']['name']);

		if(!move_uploaded_file($_FILES['file']['tmp_name'], $imagen)){
			echo ('no pudo mover el archivo <br>');
		}

		//$url_fetch = $imagenService->getImagenUrlByArticuloId($id_articulo);

		//echo("<img src='".$url_fetch."' alt='test' width='100%' height='100%'>");

		/*--------------------------------------------------------------------------------*/

		$result = $articuloService->createArticuloParametros($id_seccion, $id_user, $id_estado_articulo, $titulo, $lat, $lng, $fecha_cierre, $copete, $url_contenido, $contenido_adicional, $id_numero);

		break;
	default:
		echo "Método inexistente en el switch de ArticuloAjaxHelper.php";
}

echo json_encode($result);

?>
