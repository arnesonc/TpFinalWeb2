<?php
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
                        <form class="form-horizontal">
                            <fieldset>

                                <!-- Form Name -->
                                <legend>Editar Articulo</legend>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="Titulo">titulo</label>
                                    <div class="col-md-9">
                                        <input id="Titulo" name="Titulo" type="text" placeholder="titulo" class="form-control input-md" required="">
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

                                <!-- File Button -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="principal">imagen principal</label>
                                    <div class="col-md-9">
                                        <input id="principal" name="principal" class="input-file" type="file">
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="seccion">seccion</label>
                                    <div class="col-md-9">
                                        <select id="seccion" name="seccion" class="form-control">
                                            <?php
                                            var_dump($arraySeccion);
                                            foreach ($arraySeccion as $key=>$seccion) {
                                                ?>
                                                <option  value="<?php echo $seccion->id;  ?>"><?php echo $seccion->nombre; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Map -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="map">lugar</label>
                                    <div class="col-md-9">
                                        <div id="map"></div>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="btnGuardar"></label>
                                    <div class="col-md-9">
                                        <button id="btnGuardar" name="btnGuardar" class="btn btn-primary">guardar</button>
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
<script src="js/EditarArticulo.js" type="text/javascript"></script>

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
    editarArticulo(<?php echo $_POST['idNumero'].','.$_POST['idArticulo'].','.$_POST['idUser']?>);
</script>

<!-- inicializacion google maps-->
<script type="text/javascript">

    var map;
    function initMap() {
        var myLatlng = {lat: -34.6695067, lng: -58.561731};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: myLatlng
        });

        marcador = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Lugar de los hechos'
        });

        google.maps.event.addListener(map, 'click', function(event) {
            marcador.setPosition(event.latLng);
            var lat = event.latLng.lat();
            var lon = event.latLng.lng();
            alert("la longitud es " + lon + " y la latitud es " +  lat);
        });

    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8qdt_ZyQL7Ea1dirrshhtQycf1UYGAQQ&callback=initMap">
</script>

</body>

</html>
