<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
<?php require_once(__DIR__."/../service/NumeroService.php"); 

?>
    <script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="/../js/EditarNumero.js" type="text/javascript"></script>
</head>

<body>
<!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
<form enctype="multipart/form-data" action="__URL__" method="POST">
    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
    Enviar este fichero: <input name="fichero_usuario" type="file" />
    <input type="submit" value="Enviar fichero" />
</form>
</body>

</html>
