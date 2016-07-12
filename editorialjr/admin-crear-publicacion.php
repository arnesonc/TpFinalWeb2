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
                        <h3>Publicaciones</h3>
                    </div>
                </div>
                <!-- TABLA-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- form -->
                        <form id="signupForm" method="post" class="form-horizontal" action="">
                            <fieldset>

                                <legend>Nueva Publicacion</legend>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nombre">Nombre de Publicacion</label>
                                    <div class="col-md-4">
                                        <input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="precio">Precio de numero inicial</label>
                                    <div class="col-md-4">
                                        <input id="precio" name="precio" placeholder="Precio" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="destacado">Tipo de publicacion</label>
                                  <div class="checkbox">
                                      <label class="col-md-4 control-label" for="destacado"><input id="destacado" name="destacado" type="checkbox" value="1">Publicacion destacada</label>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="send"></label>
                                    <div class="col-md-4">
                                        <button type="button" id="btnCrear" name="send" class="btn btn-primary btn-md">Crear Publicacion</button>
                                        <a href="#" class="btn btn-default btn-md active" role="button">Cancelar</a>
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

<!-- Js listar Cliente-->
<script src="js/CrearPublicacion.js" type="text/javascript"></script>

<!-- Js maskMoney-->
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

</body>

</html>
