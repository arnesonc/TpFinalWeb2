<?php

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
$numeroModel = $numeroService->getNumeroById($id_numero);
$path = $numeroModel->getPath();
$structure = $GLOBALS['app_config']["ruta_publicaciones"] . $path;
$imagen_url  = $GLOBALS["ruta_publicaciones"] . $path . basename($_FILES['file']['name']);

$articuloService->createArticuloParametros($id_seccion, $id_user, $id_estado_articulo, $titulo, $lat, $lng, $fecha_cierre, $copete, $url_contenido, $contenido_adicional, $id_numero);

$id_articulo = $articuloService->ultimoInsert();
$imagenService->insertImagen($id_articulo,$imagen_url);
mkdir($structure, 0777, true);
$imagen = $GLOBALS['app_config']["ruta_publicaciones"] . $path . basename($_FILES['file']['name']);

//Redirige a la vista de articulos
$path = 'location:/../admin-listar-articulos.php?idnum='.$id_numero.'&idest='.$numeroModel->id_estado_numero;
header($path);

?>