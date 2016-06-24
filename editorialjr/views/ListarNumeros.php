
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




	<div class="modal fade" id="modalNumero" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="tituloModalUsuario">Editar Numero</h4>
				</div>
				<div class="modal-body">
					<form id="updateForm" enctype="multipart/form-data"
						action="/helpers/NumeroFileHelper.php" method="POST"
						class="form-horizontal">
						<fieldset>
						
						
							<div id="divPrecioNumero" class="form-group">
								<label class="col-md-4 control-label" for="precio">Precio</label>
								<div class="col-md-7">
									<input id="precio" name="precio" placeholder="Precio"
										class="form-control input-md" type="text" maxlength="10">
								</div>
							</div>
							<!-- FORMULARIO DE CARGA DE ARCHIVO -->
							<div id="formularioDeEdicion" class="form-group">
								<label class="col-md-4 control-label">Seleccionar Imagen:</label>
								<div class="col-md-7">
									<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
									<input name="fichero_usuario" type="file"/>
								</div>
								<!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
								<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
								<input type="hidden" id="idNumero" name="idNumero" />
							</div>
							<!-- FORMULARIO DE CARGA DE ARCHIVO -->


<!-- 							<div id="formularioDeEdicion"> -->
								<!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
<!-- 								<input type="hidden" name="MAX_FILE_SIZE" value="30000" /> <input -->
<!-- 									type="hidden" id="idNumero" name="idNumero" /> -->
								<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
<!-- 								Seleccionar Imagen: <input name="fichero_usuario" type="file" class="form-control"/> -->
<!-- 							</div> -->



							<div class="form-group">
								<label class="col-md-4 control-label" for="send"></label>
								<div class="col-md-5">
									<div id="divMensajeError"
										class="col-md-12 alert alert-danger fade in oculto"></div>
								</div>
							</div>

							<!-- Se usa para saber si es edicion o alta -->
							<input id="hdnIdUsuario" type="hidden" />
						</fieldset>
						<div class="modal-footer">
							<button id="btnAceptar" type="submit" class="btn btn-primary">Guardar</button>
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Cancelar</button>
						</div>
					</form>
					<!-- /form -->
				</div>

			</div>
		</div>
	</div>



</body>


<!-- Js Funciones comunes a los demas js-->
<script src="../js/common.js" type="text/javascript"></script>

<script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/ListarArticulos.js" type="text/javascript"></script>
<script src="../js/ListarNumeros.js" type="text/javascript"></script>
<script src="../js/ListarPublicaciones.js" type="text/javascript"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.js"></script>

<script>listarNumeros(<?php echo $_GET["id"]; ?>)</script>
</html>
