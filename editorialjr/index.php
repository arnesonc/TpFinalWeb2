<?php
require_once(__DIR__."/common/sesionValidaIndex.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/footer-distributed.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editorial Jr</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Nuestro CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Side Bar CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- CSS de las Datatables-->
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/index.php">Editorial Jr</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                  <li>
                      <a href="#">About</a>
                  </li>
                  <li>
                      <a href="#">Services</a>
                  </li>
                  <?php
                      if(isset($_SESSION['session']) && isset($_SESSION['session']["login"])
                      && $_SESSION['session']["login"] == "ok"){
                  ?>
                          <li>
                              <a href="/client-listar-suscripciones.php">Mis Suscripciones</a>
                          </li>
                          <li>
                              <a href="client-listar-numeros-comprados.php">Mis Compras</a>
                          </li>
                          <li>
                              <a href="/logoutIndex.php">Cerrar sesión</a>
                          </li>
                  <?php }else{ ?>
                          <li>
                              <a id="btnIniciarSesion" href="#">Iniciar sesión</a>
                          </li>
                          <li>
                              <a href="RegistrarCliente.php">Registrarse</a>
                          </li>
                  <?php } ?>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>

<section id="section_ultimos">
    <div class="container">
        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Últimos Números</h3>
            </div>
        </div>
        <!-- /.row -->

        <div id="divError" class="alert alert-danger oculto">
        </div>

        <div id="content" class="row text-center">
        </div>

    </div>

    <!-- paginado-->
    <div class="container">
        <div class="text-center">
            <ul class="pagination">
                <div id="page-selection">
                </div>
            </ul>
        </div>
    </div><!-- /paginado-->
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
</section><!-- /ultimos -->

<!-- Footer -->

  <footer class="footer-distributed">

    <div class="footer-right">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="https://github.com/germg/TpFinalWeb2"><i class="fa fa-github"></i></a>

    </div>

    <div class="footer-left">

      <p class="footer-links">
        <a href="/index.php">Home</a>
        ·
        <a href="#">About</a>
        ·
        <a href="/admin-login.php">Administrar</a>
      </p>

      <p>EditorialJR &copy; 2016</p>
    </div>

  </footer>



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
</body>

</html>
