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
						<h3>Clientes</h3>
					</div>
				</div>
				<div class="row botonNuevo">
					<div class="col-lg-2">
						<button id='btnNuevoCliente' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Nuevo cliente</button>
					</div>
				</div>
				<!-- TABLA-->
				<div class="row">
					<div id="divTablaClientes" class="col-lg-12">
					</div>
				</div>

				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
			</div>
		</div>
	</div>
</div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /col -->
</div><!-- /row -->
</div>
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tituloModalCliente">Modal title</h4>
			</div>
			<div class="modal-body">
				<form id="signupForm" method="post" class="form-horizontal" action="">
					<fieldset>
						<div id="divEmailCliente" class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-5">
								<input id="email" name="email" placeholder="Email" class="form-control input-md" type="text" maxlength="50">
							</div>
						</div>

						<div id="divPassCliente" class="form-group">
							<label class="col-md-4 control-label" for="pass">Clave</label>
							<div class="col-md-5">
								<input id="pass" name="pass" placeholder="Clave" class="form-control input-md" type="password" maxlength="30">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="nombre">Nombre</label>
							<div class="col-md-5">
								<input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text" maxlength="30">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="apellido">Apellido</label>
							<div class="col-md-5">
								<input id="apellido" name="apellido" placeholder="Apellido" class="form-control input-md" type="text" maxlength="30">
							</div>
						</div>

						<!-- Se usa para saber si es edicion o alta -->
						<input id="hdnIdCliente" type="hidden" />
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

<!-- Js listar Cliente-->
<script src="js/ListarClientes.js" type="text/javascript"></script>


<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

</body>

</html>
