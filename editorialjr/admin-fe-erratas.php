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
						<h3>Edición de numero publicado</h3>
					</div>
				</div>
				<!-- TABLA-->
				<div class="row">
					<div class="col-lg-12">
						<!-- form -->
						<form id="signupForm" method="post" class="form-horizontal"
							action="">
							<fieldset>

								<legend>Redacción de Fe de erratas</legend>

								<div class="form-group">
									<label class="col-md-4 control-label" for="nombre">Texto</label>
									<div class="col-md-4">
										<input id="texto" name="texto" class="form-control input-md"
											type="textbox">
									</div>
								</div>
								
								<input id="idNumero" name="idNumero" type="hidden" value="<?php echo $_POST["idNumero"]?>">
								<div class="form-group">
									<label class="col-md-4 control-label" for="send"></label>
									<div class="col-md-4">
										<button type="button" id="btnEnviar" name="send"
											class="btn btn-primary btn-lg">Enviar</button>
										<a href="#" class="btn btn-default btn-lg active"
											role="button">Cancelar</a>
									</div>
								</div>
							</fieldset>
						</form>
						<!-- /form -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
</div>
<!-- /col -->
</div>
<!-- /row -->
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
<!--Js de esta vista-->
    <script src="js/EditarFeErratas.js"></script>


<!-- Js Funciones comunes a los demas js-->
<script src="js/common.js" type="text/javascript"></script>
<!-- Negrada -->
<script>idPublicacion = (<?php echo $_POST['idPublicacion'] ?>);</script>
<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>
</body>

</html>