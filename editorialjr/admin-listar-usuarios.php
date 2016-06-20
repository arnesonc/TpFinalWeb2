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
				<div class="row">
					<div id="divTablaUsuarios" class="col-lg-2">
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

						<!-- <legend>Nuevo usuario</legend> -->

						<div class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-5">
								<input id="email" name="email" placeholder="Email" class="form-control input-md" type="text">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="pass">Clave</label>
							<div class="col-md-5">
								<input id="pass" name="pass" placeholder="Clave" class="form-control input-md" type="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="nombre">Nombre</label>
							<div class="col-md-5">
								<input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="apellido">Apellido</label>
							<div class="col-md-5">
								<input id="apellido" name="apellido" placeholder="Apellido" class="form-control input-md" type="text">
							</div>
						</div>

						<!-- <div class="form-group">
						<label class="col-md-4 control-label" for="send"></label>
						<div class="col-md-4">
						<button type="button" id="btnAceptar" name="send" class="btn btn-primary btn-lg">Registrar</button>
						<a href="#" class="btn btn-default btn-lg active" role="button">Cancelar</a>
					</div>
				</div> -->

			</fieldset>
		</form>
		<!-- /form -->
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary">Guardar</button>
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

<!-- Js listar usuario-->
<script src="js/RegistrarUsuario.js" type="text/javascript"></script>
<script src="js/ListarUsuarios.js" type="text/javascript"></script>


<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

</body>

</html>
