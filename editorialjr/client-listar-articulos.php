<?php
include 'client-header.php';
?>

<div class="row">
<div id="wrapper">
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
        </div>
    </div>
</div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /row -->
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

<!-- Js listar articulos-->
<script src="js/ClientListarArticulos.js" type="text/javascript"></script>

<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

<!-- Redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

<!-- Negrada -->
<script>
listarArticulos(
<?php if (isset($_GET["idnum"])) {
		echo $_GET["idnum"];
	}else{
		echo $_POST['idnum'];
	}
?>
);
</script>

</body>

</html>
