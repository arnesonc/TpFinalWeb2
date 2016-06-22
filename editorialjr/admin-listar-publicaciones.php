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
                        <h3>Publicaciones</h3>
                    </div>
                </div>
                <!-- TABLA-->
                <div class="row">
                    <div id="divTablaPublicaciones" class="col-lg-12">
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

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<!-- Js Funciones comunes a los demas js-->
<script src="js/common.js" type="text/javascript"></script>

<!-- Js listar Publicaciones-->
<script src="js/ListarPublicaciones.js" type="text/javascript"></script>



<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

</body>

</html>