<?php
include 'header.php';
include 'side-bar.php';
?>
<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="row">

			<div class="col-lg-12">
				<!-- title -->
				<div class="row">
					<div class="col-lg-12">
						<h3>Usuarios</h3>
					</div>
				</div>
				<div id="divExito" class="alert alert-success oculto">
			  </div>
				<div id="divError" class="alert alert-danger oculto">
			  </div>
				<div class="row botonNuevo">
					<div class="col-lg-12">
						<button id='btnNuevoUsuario' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Nuevo usuario</button>
					</div>
				</div>
				<div class="row">
					<div id="divTablaUsuarios" class="col-lg-12">
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /col -->
</div><!-- /row -->
</div>
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tituloModalUsuario">Modal title</h4>
			</div>
			<div class="modal-body">
				<form id="signupForm" method="post" class="form-horizontal" action="">
					<fieldset>
						<div id="divEmailUsuario" class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-5">
								<input id="email" name="email" placeholder="Email" class="form-control input-md" type="text" maxlength="50">
							</div>
						</div>

						<div id="divPassUsuario" class="form-group">
							<label class="col-md-4 control-label" for="pass">Clave</label>
							<div class="col-md-5">
								<input id="pass" name="pass" placeholder="Clave" class="form-control input-md" type="password" maxlength="50">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="nombre">Nombre</label>
							<div class="col-md-5">
								<input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text" maxlength="50">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="apellido">Apellido</label>
							<div class="col-md-5">
								<input id="apellido" name="apellido" placeholder="Apellido" class="form-control input-md" type="text" maxlength="50">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="send"></label>
							<div class="col-md-5">
								<div id="divMensajeError" class="col-md-12 alert alert-danger fade in oculto">
								</div>
							</div>
						</div>

						<!-- Se usa para saber si es edicion o alta -->
						<input id="hdnIdUsuario" type="hidden" />
			</fieldset>
		</form>
		<!-- /form -->
	</div>
	<div class="modal-footer">
		<button id="btnAceptar" type="button" class="btn btn-primary">Guardar</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	</div>
</div>
</div>
</div>

<!-- Jquery-->
<script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
});
</script>

<!-- Js Funciones comunes a los demas js-->
<script src="js/common.js" type="text/javascript"></script>

<!-- Js listar usuario-->
<script src="js/ListarUsuarios.js" type="text/javascript"></script>

<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

</body>

</html>
