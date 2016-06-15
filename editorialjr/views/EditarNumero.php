<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
    <script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="/../js/EditarNumero.js" type="text/javascript"></script>
</head>

<body>
	<!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
	<form enctype="multipart/form-data" method="POST">
		<!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
		<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
		<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
		Enviar este fichero: <input id="fichero" name="fichero_usuario" type="file" />
		<input type="button" id="btnEnviar" value="Enviar fichero" />
	</form>
</body>

</html>
