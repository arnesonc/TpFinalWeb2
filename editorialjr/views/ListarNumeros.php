
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Title of the document</title>
<link rel="stylesheet" type="text/css" href="../css/datatables.min.css" />
</head>
<body>

	<div id="formularioDeEdicion">
		<form enctype="multipart/form-data"
			action="/helpers/NumeroFileHelper.php" method="POST">
			<!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" /> <input
				type="text" id="idNumero" name="idNumero" value="" />
			<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
			Enviar este fichero: <input name="fichero_usuario" type="file" /> <input
				type="submit" value="Enviar fichero" />
		</form>
	</div>
	<!-- seccion formulario -->
	<section id="formulario">
		<div class="container">

			<!-- title -->
			<div class="row">
				<div class="col-lg-12">
					<h3>Numeros</h3>
				</div>
			</div>
			<div class="row">
				<div id="divTablaNumeros" class="col-lg-12"></div>
			</div>

		</div>
	</section>
	<!-- /seccion formulario -->

	</div>


</body>


<script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/ListarArticulos.js" type="text/javascript"></script>
<script src="../js/ListarNumeros.js" type="text/javascript"></script>
<script src="../js/ListarPublicaciones.js" type="text/javascript"></script>
<script>listarNumeros(<?php echo $_GET["id"]; ?>)</script>
</html>
