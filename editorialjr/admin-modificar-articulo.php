<?php
require_once(__DIR__."/common/Security.php");
include 'header.php';
include 'side-bar.php';

require_once(__DIR__."/service/SeccionService.php");
$seccionService = new SeccionService;
$arraySeccion = $seccionService->getAllSecciones();
?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <!-- title -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Articulo</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- form -->
                        <form class="form-horizontal" id="myForm" action="/helpers/ArticuloAjaxHelper.php" method="POST" enctype="multipart/form-data">
                            <fieldset>

                                <!-- Form Name -->
                                <legend>Editar Articulo</legend>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="Titulo">titulo</label>
                                    <div class="col-md-9">
                                        <input id="titulo" name="titulo" type="text" placeholder="titulo" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="copete">copete</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="copete" name="copete" placeholder="copete"></textarea>
                                    </div>
                                </div>

                                <!-- Cuerpo -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="cuerpo">cuerpo</label>
                                    <div class="col-md-9">
                                        <div id="summernote"></div>
                                    </div>
                                </div>

                                <!-- File Button
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="principal">imagen principal</label>
                                    <div class="col-md-9">
                                        <input id="imagen-file" name="file" class="file" type="file" accept="image/*">
                                    </div>
                                </div>
                                -->
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="seccion">seccion</label>
                                    <div class="col-md-9">
                                        <select id="seccion" name="seccion" class="form-control">
                                            <?php
                                            foreach ($arraySeccion as $key=>$seccion) {
                                                ?>
                                                <option  value="<?php echo $seccion->id;  ?>"><?php echo $seccion->nombre; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Map y demas hidden data-->
                                <div class="form-group">
                                  <!--  MAPA
                                    <label class="col-md-3 control-label" for="map">lugar</label>
                                    <div class="col-md-9">
                                        <div id="map"></div>
                                    </div>
                                  -->
                                    <input id="idArticulo" name="idArticulo" class="" type="hidden" value="">
                                    <input id="idNumero" name="idNumero" class="" type="hidden" value="">
                                    <input id="contenido" name="contenido" class="" type="hidden" value="">
                                    <input id="metodo" name="metodo" class="" type="hidden" value="updateArticuloParametros">
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="btnGuardar"></label>
                                    <div class="col-md-9">
                                        <button id="btnGuardar" type="button" name="btnGuardar" class="btn btn-primary">guardar</button>
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

<!-- Js editar articulo-->
<script src="js/ModificarArticulo.js" type="text/javascript"></script>

<!-- include summernote css/js-->
<link href="css/summerNote/summernote.css" rel="stylesheet">
<script src="js/summerNote/summernote.js"></script>

<!-- include summernote-ar-AR -->
<script src="lang/summernote-es-ES.js"></script>

<!-- inicializacion summerNote -->
<script>
$(document).ready(function() {
    $('#summernote').summernote({
        placeholder: 'cuerpo del articulo...',
        height: 300,
        lang: 'es-ES' // default: 'en-US'
    });
});
</script>

<!-- obtener variables post-->
<script>
    modificarArticulo(<?php echo $_POST['idArticulo']?>);
</script>

</body>

</html>
