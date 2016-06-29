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
                        <h3>Numeros</h3>
                    </div>
                </div>
                <div class="row">
                    <div id="divTablaNumeros" class="col-lg-12"></div>
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
                                            <div class="col-md-5">
                                                <input id="precio" name="precio" placeholder="Precio"
                                                       class="form-control input-md" type="text" maxlength="10">
                                            </div>
                                        </div>


                                        <!-- FORMULARIO DE CARGA DE ARCHIVO -->
                                        <div id="formularioDeEdicion">
                                            <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" /> <input
                                                type="hidden" id="idNumero" name="idNumero" /><!-- HARDCODEADO -->
                                            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                            Seleccionar Imagen: <input name="fichero_usuario" type="file" />
                                        </div>
                                        <!-- FORMULARIO DE CARGA DE ARCHIVO -->


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
                                </form><!-- / modal form -->
                            </div>
                        </div>
                    </div>
                </div> <!-- /modal -->
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

<!-- Js listar numero-->
<script src="js/ListarNumeros.js" type="text/javascript"></script>

<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

<!-- Negrada -->
<script>listarNumeros(<?php echo $_POST['idPublicacion'] ?>)</script>
<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

</body>

</html>
