<?php
require_once(__DIR__."/../service/ArticuloService.php");
require_once (__DIR__ . "/../model/ArticuloModel.php");
require_once (__DIR__ . "/../service/NumeroService.php");
require_once (__DIR__ . "/../model/NumeroModel.php");

$numeroService = new NumeroService;

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
		$id_seccion = $_POST['seccion'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$id_numero = $_POST['idNumero'];
		$id_articulo = $_POST['idArticulo'];
		$id_user = $_POST['idUser'];
		$id_estado_articulo = 1;
		$fecha_cierre = null;
		$url_contenido = "http://www.rischiocalcolato.it/wp-content/uploads/2013/05/Default.jpg";

		/* -----------------------------imagen-------------------------------- */


		$numeroModel = $numeroService->getNumeroById($idNumero);
		/*
        //El nombre original del fichero en la máquina del cliente.
        $_FILES['fichero_usuario']['name'];
        //El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
        $_FILES['fichero_usuario']['tmp_name'];
        //El código de error asociado a esta subida.
        $_FILES['fichero_usuario']['error'];
        */

		$path = $numeroModel->getPath();

		$fichero_subido = $GLOBALS['app_config']["ruta_publicaciones"] . $path . basename($_FILES['fichero_usuario']['name']);
		$numeroModel->url_portada = $path . basename($_FILES['fichero_usuario']['name']);
		$numeroModel->precio = $precio;
		$numeroService->updateNumero($numeroModel);
		//echo $fichero_subido;
		if($_FILES['fichero_usuario']['size'] == 0) {
			$id_publicacion = $numeroModel->id_publicacion;
			$path = 'location:/../admin-listar-numeros.php?idpub='.$id_publicacion;
			header($path);
		}

		if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
			$id_publicacion = $numeroModel->id_publicacion;
			$path = 'location:/../admin-listar-numeros.php?idpub='.$id_publicacion;
			header($path);
		} else {
			echo "¡Posible ataque de subida de ficheros!\n";
			echo 'Más información de depuración:';
			print_r($_FILES);
		}

		/*--------------------------------------------------------------------------------*/

		$result = $articuloService->createArticuloParametros($id_seccion, $id_user, $id_estado_articulo, $titulo, $lat, $lng, $fecha_cierre, $copete, $url_contenido, $contenido_adicional, $id_numero );
		break;
	default:
		echo "Método inexistente en el switch de ArticuloAjaxHelper.php";
}

echo json_encode($result);

?>