<?php
include 'client-header.php';

?>
<div class="row">
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="http://www.accuweather.com/es/ar/buenos-aires/7894/weather-forecast/7894"
                           class="aw-widget-legal">
                        </a>
                        <div id="awcc1468366656627" class="aw-widget-current" data-locationkey="7894" data-unit="c"
                             data-language="es" data-useip="false" data-uid="awcc1468366656627"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Últimos Números</h2>
                    </div>
                </div>
            </div><!-- /#wrapper -->
        </div><!-- /row -->
        <div class="row">
            <div class="col-lg-12">
                <div id="divError" class="alert alert-danger oculto">
                </div>
                <div id="content" class="row text-center">
                </div>
            </div><!-- /#wrapper -->
        </div><!-- /row -->

        <section id="section_ultimos">
            <!-- paginado-->
            <div class="container">
                <div class="text-center">
                    <ul class="pagination">
                        <div id="page-selection">
                        </div>
                    </ul>
                </div>
            </div><!-- /paginado-->

        </section><!-- /ultimos -->

    </div>

    <!-- Modal para login -->
    <div class="modal fade" id="modalSeccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="tituloModalSeccion">Editorial Jr - Inicio de sesión</h4>
                </div>
                <div class="modal-body">
                    <form id="signupForm" class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">Email</label>
                                <div class="col-md-6">
                                    <input id="email" name="email" placeholder="Email" class="form-control input-md"
                                           maxLength="50" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="pass">Contraseña</label>
                                <div class="col-md-6">
                                    <input id="pass" name="pass" placeholder="Contraseña" class="form-control input-md"
                                           maxLength="50" type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="send"></label>
                                <div class="col-md-6">
                                    <div id="divMensajeError" class="col-md-12 alert alert-danger fade in oculto">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form><!-- /form -->
                </div>
                <div class="modal-footer">
                    <a href="/RegistrarCliente.php" type="button" class="btn btn-warning">Registrarse</a>
                    <button id="btnAceptarInicioSesion" type="button" class="btn btn-primary">Iniciar sesión</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->

    <footer class="container-fluid footer-distributed">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="footer-left">
                            <p class="footer-links">
                                <a href="/index.php">Home</a>
                                ·
                                <a href="#">About</a>
                                ·
                                <a href="/admin-login.php">Administrar</a>
                            </p>

                            <p>EditorialJR &copy; 2016</p>
                            <div class="qr"><?php echo "<img src='generarQr.php?info=https://github.com/germg/TpFinalWeb2' />"; ?></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-right">
                            <div class="footer-icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="https://github.com/germg/TpFinalWeb2" target=_blank""><i class="fa fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

<!-- Paginacion -->
<script src="js/jquery.bootpag.min.js"></script>

<!-- JS especifico -->
<script src="js/common.js"></script>

<!-- JS especifico -->
<script src="js/index.js"></script>

<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

<!-- Para el clima -->
<script src="js/launch.js" type="text/javascript"></script>

</body>

</html>
