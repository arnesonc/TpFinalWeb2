<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
</head>
<body>
<button type="button" onclick="getAllPublicaciones()">Ver todas Las Publicaciones</button>
<div id="divListaPublicaciones"></div>
<div id="divListaNumeros"></div>


<div id="formularioDeEdicion">
	<form enctype="multipart/form-data" action="/helpers/NumeroFileHelper.php" method="POST">
	    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
	    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
	    <input type="text" id="idNumero" name="idNumero" value="" />
	    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
	    Enviar este fichero: <input name="fichero_usuario" type="file" />
	    <input type="submit" value="Enviar fichero" />
	</form>
</div>


</body>
	<script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="../js/ListarNumeros.js" type="text/javascript"></script>
	<script src="../js/ListarPublicaciones.js" type="text/javascript"></script>
</html>

