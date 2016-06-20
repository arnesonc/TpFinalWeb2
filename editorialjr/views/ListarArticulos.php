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

	<!-- seccion formulario -->
	<section id="formulario">
		<div class="container">

			<!-- title -->
			<div class="row">
				<div class="col-lg-12">
					<h3>Articulos</h3>
				</div>
			</div>
			<div class="row">
				<div id="divTablaArticulos" class="col-lg-12"></div>
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
<script>listarArticulos(<?php echo $_GET["id"]; ?>)</script>
</html>

