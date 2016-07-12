<?php
require_once('Security.php');
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
						<h3>Generar reporte</h3>
					</div>
				</div>
        <div id="divError" class="alert alert-danger oculto">
			  </div>
        <div class="row">
          <div class="col-lg-9">
            Contenidistas
          </div>
          <div class="col-lg-3">
            <button id='btnReporteContenidistas' class='btn btn-primary' title="Generar reporte de contenidistas"><span class='glyphicon glyphicon-download-alt'></span></button>
          </div>
        </div>
        <div class="row marginTopBottom">
          <div class="col-lg-9">
            Clientes y productos adquiridos
          </div>
          <div class="col-lg-3">
            <button id='btnReporteClientes' class='btn btn-primary' title="Generar reporte de clientes y productos adquiridos"><span class='glyphicon glyphicon-download-alt'></span></button>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-9">
            Productos
          </div>
          <div class="col-lg-3">
            <button id='btnReporteProductos' class='btn btn-primary' title="Generar reporte de productos"><span class='glyphicon glyphicon-download-alt'></span></button>
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

<!-- Jquery-->
<script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>
|
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
<script src="js/GenerarReporte.js" type="text/javascript"></script>

<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

</body>

</html>
